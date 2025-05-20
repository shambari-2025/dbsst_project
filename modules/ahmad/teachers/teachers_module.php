<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}

switch($action){
	
	case "add":
		
		$faculties = select("faculties", "*", "", "id", false, "");
		$studylevels = select("study_level", "*", "", "id", false, "");
		$studyviews = select("study_view", "*", "", "id", true, "");
		$studytypes = select("study_type", "*", "", "id", false, "");
		
		$courses = select("course", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "id", false, "");
		
		$countries = select("countries", "*", "", "id", false, "");
		$regions = select("regions", "*", "", "id", false, "");
		
		$nations = select("nations", "*", "", "id", false, "");
		
		$page_info['title'] = 'Иловакунии омӯзгор';
	break;
	
	case "insert":
		$page_info['title'] = "Иловакунӣ: ".$_REQUEST['fullname'];
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		$table = "users";
		$data['fullname_tj'] = "'".clear_admin($_REQUEST['fullname'])."'";
		$data['fullname_ru'] = "'".clear_admin($_REQUEST['fullname_ru'])."'";
		$data['birthday'] = "'".clear_admin($_REQUEST['birthday'])."'";
		$data['jins'] = "'".clear_admin($_REQUEST['jins'])."'";
		$data['login'] = "'".clear_admin($_REQUEST['login'])."'";
		$data['password'] = "'".clear_admin($_REQUEST['password'])."'";
		$data['email'] = "'".clear_admin($_REQUEST['email'])."'";
		$data['phone'] = "'".clear_admin($_REQUEST['phone'])."'";
		$data['phone_parents'] = "'".clear_admin($_REQUEST['parent_phone'])."'";
		$data['v_ijtimoi'] = "'".clear_admin($_REQUEST['vazi_ijtimoi'])."'";
		$data['from_family'] = "'".clear_admin($_REQUEST['az_oilai_ki'])."'";
		$data['v_oilavi'] = "'".clear_admin($_REQUEST['vazi_oilavi_form'])."'";
		$data['family_info'] = "'".clear_admin($_REQUEST['family_info'])."'";
		$data['access'] = 1;
		$data['access_type'] = 2; // 2 - омӯзгор
		
		$data['added_by'] = "'".$_SESSION['user']['id']."'";
		$data['added_time'] = "'".date("d.m.Y, H:i:s", time())."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		
		if($id_teacher = insert($table, $fields, $data)){
			
			/*PASSPORT DATAS*/
			$table = "user_passports";
			$passport_data['id_user'] = "'".clear_admin($id_teacher)."'";
			$passport_data['number'] = "'".clear_admin($_REQUEST['number_passport'])."'";
			$passport_data['date'] = "'".clear_admin($_REQUEST['sanai_dodani_passport'])."'";
			$passport_data['maqomot'] = "'".clear_admin($_REQUEST['maqomot'])."'";
			
			if(!empty($_REQUEST['id_country']))
				$passport_data['id_country'] = "'".clear_admin($_REQUEST['id_country'])."'";
			if(!empty($_REQUEST['id_nation']))
				$passport_data['id_nation'] = "'".clear_admin($_REQUEST['id_nation'])."'";
			
			if(!empty($_REQUEST['id_region']))
				$passport_data['id_region'] = "'".clear_admin($_REQUEST['id_region'])."'";
			
			if(!empty($_REQUEST['id_district']))
				$passport_data['id_district'] = "'".clear_admin($_REQUEST['id_district'])."'";
			$passport_data['address'] = "'".clear_admin($_REQUEST['current_address'])."'";
			
			$passport_fields = array_keys($passport_data);
			$passport_data = implode(",", $passport_data);
			
			insert($table, $passport_fields, $passport_data);
			/*PASSPORT DATAS*/
			
			
			/*USER EDUCATION*/
			$table = "user_udecation";
			$edu_data['id_user'] = "'".clear_admin($id_teacher)."'";
			if(!empty($_REQUEST['id_khatm_namud']))
				$edu_data['id_khatm_namud'] = "'".clear_admin($_REQUEST['xatm_namud'])."'";
			
			if(!empty($_REQUEST['id_hujjat']))
				$edu_data['id_hujjat'] = "'".clear_admin($_REQUEST['hujjati_xatm'])."'";
			
			if(!empty($_REQUEST['soli_xatm']))
				$edu_data['soli_xatm'] = "'".clear_admin($_REQUEST['soli_xatm'])."'";
			
			if(!empty($_REQUEST['silsila']))
				$edu_data['silsila'] = "'".clear_admin($_REQUEST['silsila'])."'";
			
			if(!empty($_REQUEST['number_hujjat']))
				$edu_data['number_hujjat'] = "'".clear_admin($_REQUEST['number_hujjat'])."'";
			
			if(!empty($_REQUEST['date_hujjat']))
				$edu_data['date_hujjat'] = "'".clear_admin($_REQUEST['date_hujjat'])."'";
			
			if(!empty($_REQUEST['number_scholl']))
				$edu_data['number_scholl'] = "'".clear_admin($_REQUEST['number_scholl'])."'";
			
			if(!empty($_REQUEST['muasisa_name']))
				$edu_data['muasisa_name'] = "'".clear_admin($_REQUEST['muasisa_name'])."'";
			$edu_data['muasisa_lang'] = "'".clear_admin($_REQUEST['muasisa_lang'])."'";
			
			$edu_fields = array_keys($edu_data);
			$edu_data = implode(",", $edu_data);
			insert($table, $edu_fields, $edu_data);
			/*USER EDUCATION*/
			
			
			
			if($_FILES['photo']['name']){
				$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['photo']['name'])); // расширение картинки
				$baseimgName = "{$id_teacher}.{$baseimgExt}";
				$baseimgTmpName = $_FILES['photo']['tmp_name'];
				if(move_uploaded_file($baseimgTmpName, "../userfiles/teachers/$baseimgName")){
					$fields = array('photo' => $baseimgName);
					update("users", $fields, "`id` = '$id_teacher'");
				}
			}
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			redirect();	
		}
	break;
	
	case "update_user":
		$id_teacher = $_REQUEST['id_teacher'];
		
		$page_info['title'] = "Таҳриркунӣ ".$_REQUEST['fullname'];
		
		$fullname = clear_admin($_REQUEST['fullname']);
		$jins = clear_admin($_REQUEST['jins']);
		$login = clear_admin($_REQUEST['login']);
		$password = clear_admin($_REQUEST['password']);
		$birthday = clear_admin($_REQUEST['birthday']);
		$phone = clear_admin($_REQUEST['phone']);
		
		$number_passport = clear_admin($_REQUEST['number_passport']);
		$id_country = clear_admin($_REQUEST['id_country']);
		$id_region = clear_admin($_REQUEST['id_region']);
		$id_district = clear_admin($_REQUEST['id_district']);
		$id_nation = clear_admin($_REQUEST['id_nation']);
		$current_address = clear_admin($_REQUEST['current_address']);
		
		
		$fields['fullname_tj'] = clear_admin($_REQUEST['fullname']);
		$fields['login'] = clear_admin($_REQUEST['login']);
		$fields['password'] = clear_admin($_REQUEST['password']);
		$fields['birthday'] = clear_admin($_REQUEST['birthday']);
		$fields['jins'] = clear_admin($_REQUEST['jins']);
		$fields['phone'] = clear_admin($_REQUEST['phone']);
		
		update("users", $fields, "`id` = '$id_teacher'", 1);
		
		$fields_passport['number'] = clear_admin($_REQUEST['number_passport']);
		$fields_passport['id_country'] = clear_admin($_REQUEST['id_country']);
		$fields_passport['id_nation'] = clear_admin($_REQUEST['id_nation']);
		$fields_passport['id_region'] = clear_admin($_REQUEST['id_region']);
		$fields_passport['id_district'] = clear_admin($_REQUEST['id_district']);
		$fields_passport['address'] = clear_admin($_REQUEST['current_address']);
		
		update("user_passports", $fields_passport, "`id_user` = '$id_teacher'", 1);
		
		
		
		if($_FILES['photo']['name']){
			$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['photo']['name'])); // расширение картинки
			$baseimgName = "{$id_teacher}.{$baseimgExt}";
			$baseimgTmpName = $_FILES['photo']['tmp_name'];
			if(move_uploaded_file($baseimgTmpName, "../userfiles/teachers/$baseimgName")){
				$fields = array('photo' => $baseimgName);
				update("users", $fields, "`id` = '$id_teacher'");
			}
		}
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		redirect();	
	break;
	
	case "list":
		if(isset($_REQUEST['letter'])){
			$q = " AND `fullname_tj` LIKE '".$_REQUEST['letter']."%'";
			$page_info['title'] = 'Руйхати омӯзгорҳо: '.$_REQUEST['letter'];
		} else {
			$q = '';
			$page_info['title'] = 'Руйхати омӯзгорҳо';
		}
		
		
		
		if(isset($_REQUEST['page'])){
			$page = $_REQUEST['page'];
		}else $page = 1;
		
		$perpage = 50;
		$count_all = count_table_where("users", "`access_type` = '2'");
		$pages_count = ceil($count_all / $perpage);
		
		if(!$pages_count) $pages_count = 1; 
		
		if($page > $pages_count) {
			$page = $pages_count; 
			redirect(MY_URL."?option=teachers&action=list");
		}
		
		$start_pos = ($page - 1) * $perpage;
		$teachers = query("SELECT * FROM `users` WHERE `access_type` = '2' $q ORDER BY `access_type`, `fullname_tj` LIMIT $start_pos, $perpage");
		
	break;
	
	case "up_mavod":
		$mavodho = query("SELECT * FROM `suporishho`");
		
		foreach($mavodho as $item){
			unset($fields);
			$id = $item['id'];
			$text = doTajik($item['text']);
			$fields = array('text' => $text);
			update("suporishho", $fields, "`id` = '$id'");
		}
		exit;
	break;
	
	case "score_farqiyat":
		$students = query("SELECT DISTINCT(`id_student`) FROM `farqiyatho` INNER JOIN `farqiyatho_content`
							ON `farqiyatho`.`id`=`farqiyatho_content`.`id_farqiyat` 
							WHERE `id_teacher`='{$_SESSION['user']['id']}'
							AND `farqiyatho`.`status`='1' AND `farqiyatho_content`.`status`='0'  
						");
		$page_info['title'] =  "Гузоштани баҳо ба фарқияти донишҷӯён";
	break;

	case "insert_score_raznitsa":
		$table = "results";
		$id_student = $_REQUEST['id_student'];
		$author = $_SESSION['user']['id'];
		for($i=1; $i<=count($_REQUEST['farqiyat']); $i++){
			$id = $_REQUEST['farqiyat'][$i];
			$score = $_REQUEST['score'][$i-1];
			$check = query("SELECT * FROM `farqiyatho_content` WHERE `id` = '$id' AND `status`=0");
			$type = $check[0]['type'];
			if($check && !empty($score) && $score >= 50 && $score <=100){
				if($type == 1){
					unset($data, $fields);
					$data['id_student'] = "'".clear_admin($id_student)."'";
					$data['id_course'] = "'".clear_admin($check[0]['id_course'])."'";
					$data['id_fan'] = "'".clear_admin($check[0]['id_fan'])."'";
					$data['total_score'] = "'".clear_admin($score)."'";
					$data['total_score_author'] = "'".clear_admin($author)."'";
					$data['s_y'] = "'".clear_admin($check[0]['s_y'])."'";
					$data['h_y'] = "'".clear_admin($check[0]['h_y'])."'";
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					if(insert($table, $fields, $data)){
						$fields = array('status' => 1);
						update("farqiyatho_content", $fields, "`id` = '$id'");
					}
				}if($type == 2){
					$res = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' 
									AND `id_fan` = '{$check[0]['id_fan']}'
									AND `id_course` = '{$check[0]['id_course']}'
									AND `s_y` = '{$check[0]['s_y']}'
									AND `h_y` = '{$check[0]['h_y']}'
								");
					if(!empty($res)){
						$fields = array('kori_kursi' => $score,
										'kori_kursi_author' => $author
						);
						update("results", $fields, "`id_student` = '$id_student' AND `id_fan` = '{$check[0]['id_fan']}' AND `s_y` = '{$check[0]['s_y']}' AND `h_y` = '{$check[0]['h_y']}'", true);
						$fields = array('status' => 1);
						update("farqiyatho_content", $fields, "`id` = '$id'");
					}else{
						unset($data, $fields);
						$data['id_student'] = "'".clear_admin($id_student)."'";
						$data['id_course'] = "'".clear_admin($check[0]['id_course'])."'";
						$data['id_fan'] = "'".clear_admin($check[0]['id_fan'])."'";
						$data['kori_kursi'] = "'".clear_admin($score)."'";
						$data['kori_kursi_author'] = "'".clear_admin($author)."'";
						$data['s_y'] = "'".clear_admin($check[0]['s_y'])."'";
						$data['h_y'] = "'".clear_admin($check[0]['h_y'])."'";
						
						$fields = array_keys($data);
						$data = implode(",", $data);
						if(insert($table, $fields, $data)){
							$fields = array('status' => 1);
							update("farqiyatho_content", $fields, "`id` = '$id'");
						}
					}
				}
			}
		}
		redirect();
	break;
	
	case "score_trimestr":
		// $study_years = query("SELECT DISTINCT(`s_y`) FROM `trimestr_content`
								// WHERE `id_teacher`='{$_SESSION['user']['id']}' AND
									// `trimestr_content`.`status` = '0'
							// ");
		// foreach($study_years as $sy){
			// $half_year = 
		// }
		// print_arr($study_years);
		// $students = query("SELECT DISTINCT(`id_student`), `trimestr`.`s_y`, `trimestr`.`h_y` FROM `trimestr` INNER JOIN `trimestr_content`
							// ON `trimestr`.`id`=`trimestr_content`.`id_trimestr` 
							// WHERE `id_teacher`='{$_SESSION['user']['id']}'
							// AND `trimestr_content`.`status`='0'  
						// ");
		// $S_Y = S_Y;
		// $H_Y = 1;
		// $students = query("SELECT DISTINCT(`id_student`), `trimestr`.`s_y`, `trimestr`.`h_y` FROM `trimestr` INNER JOIN `trimestr_content`
							// ON `trimestr`.`id`=`trimestr_content`.`id_trimestr` 
							// WHERE `id_teacher`='{$_SESSION['user']['id']}'
							// AND `trimestr_content`.`status`='0' AND `trimestr`.`s_y` = '$S_Y' AND `trimestr`.`h_y` = '$H_Y' 
						// ");
		
		$page_info['title'] =  "Гузоштани баҳо ба фарқияти донишҷӯён";
	break;
	
	
	case "insert_score_trimestr":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$id_student = $_REQUEST['id_student'];
		$author = $_SESSION['user']['id'];
		
		$info_std = query("SELECT * FROM `students` WHERE `status` = '1' AND `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		$id_faculty = $info_std[0]['id_faculty'];
		$id_s_l = $info_std[0]['id_s_l'];
		$id_s_v = $info_std[0]['id_s_v'];
		$id_course = $info_std[0]['id_course'];
		$id_spec = $info_std[0]['id_spec'];
		$id_group = $info_std[0]['id_group'];
		
		for($i=1; $i<=count($_REQUEST['trimestr']); $i++){
			$id = $_REQUEST['trimestr'][$i];
			$score = $_REQUEST['score'][$i-1];
			$check = query("SELECT * FROM `trimestr_content` WHERE `id` = '$id' AND `status`=0");
			if($check && !empty($score) && $score >= 50 && $score <=100){
				unset($fields);
					$fields = array('trimestr_score' => $score,
									'trimestr_add_date' => date("d.m.y, H:i"),
									'trimestr_author' => $author
									);
					$id_fan = $check[0]['id_fan'];
					if(update("results", $fields, "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'", true)){
						unset($fields_tr);
						$fields_tr = array('status' => 1);
						update("trimestr_content", $fields_tr, "`id` = '$id'");
					}
			}
		}
	//	exit;
		redirect();
	break;
	
	
}


?>