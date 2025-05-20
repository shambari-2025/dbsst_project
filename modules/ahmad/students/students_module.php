<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}

switch($action){
	case "set_ijozat":
		$id_student = $_REQUEST['id_student'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$check = query("SELECT `id` FROM `shurbo` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		if(!empty($check)){
			delete("shurbo", "`id` = '".$check[0]['id']."'");
		}else{
			$data['id_student'] = "'".clear_admin($id_student)."'";	
			$data['s_y'] = $S_Y;	
			$data['h_y'] = $H_Y;	
			$fields = array_keys($data);
			$data = implode(",", $data);
			insert("shurbo", $fields, $data);
		}
		redirect();
	break;
	
	case "syncstdsresults":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		$query = "UPDATE `results` SET `id_group` = '$id_group' 
					WHERE `id_faculty` = '$id_faculty' AND
						`id_s_l` = '$id_s_l' AND 
						`id_s_v` = '$id_s_v' AND 
						`id_course` = '$id_course' AND 
						`id_spec` = '$id_spec' AND 
						`s_y` = '".S_Y."' AND 
						`h_y`  = '".H_Y."' AND
						`id_student` IN (SELECT `id_student` FROM `students` 
											WHERE `status` = '1' AND
												`id_faculty` = '$id_faculty' AND 
												`id_s_l` = '$id_s_l' AND 
												`id_s_v` = '$id_s_v' AND 
												`id_course` = '$id_course' AND 
												`id_spec`  =  '$id_spec' AND 
												`id_group` = '$id_group' AND 
												`s_y` = '".S_Y."' AND 
												`h_y` = '".H_Y."'
										)
				";
		//echo $query;
		update_query($query);
		redirect();
	break;
	
	case "tasdiq_trimestr":
		if($_SESSION['user']['id'] == 52){
			$datas = query("SELECT * FROM `trimestr` WHERE `status` IS NULL ORDER BY `id` DESC");
			$page_info['title'] = "Тасдиқи триместр";
		}
		
	break;
	
	case "tasdiq":
		if($_SESSION['user']['id'] == 52){
			$id = $_REQUEST['id'];
			
			$fields['status'] = 1;
			update("trimestr", $fields, "`id` = '$id'");
			redirect();
		}
	break;
	
	case "insert_diplominfo":	
		$id_student = $_REQUEST['id_student'];
		$id_s_l = $_REQUEST['id_s_l'];
		$soli_xatm = $_REQUEST['soli_xatm'];
		$diplom_number = $_REQUEST['diplom_number'];
		$diplom_reg_number = $_REQUEST['diplom_reg_number'];
		$date_gek = $_REQUEST['date_gek'];
		$kasb = $_REQUEST['kasb'];
		$check  = query("SELECT * FROM `diploms` WHERE `id_student` = '$id_student' AND `id_s_l` = '$id_s_l'");
		if(empty($check)){
			$data['id_student'] = "'".clear_admin($id_student)."'";
			$data['id_s_l'] = "'".clear_admin($id_s_l)."'";
			$data['soli_xatm'] = "'".clear_admin($soli_xatm)."'";
			$data['diplom_number'] = "'".clear_admin($diplom_number)."'";
			$data['diplom_reg_number'] = "'".clear_admin($diplom_reg_number)."'";
			$data['date_gek'] = "'".clear_admin($date_gek)."'";
			$data['kasb'] = "'".clear_admin($kasb)."'";	
			$data['add_author'] = "'".clear_admin($_SESSION['user']['id'])."'";	
			$fields = array_keys($data);
			$data = implode(",", $data);
			insert("diploms", $fields, $data);
		}else{
			$fields = array('soli_xatm' => $soli_xatm,
							'diplom_number' => $diplom_number,
							'diplom_reg_number' => $diplom_reg_number,
							'date_gek' => $date_gek,
							'kasb' => $kasb,
							'add_author' => $_SESSION['user']['id']
			);
			update("diploms", $fields, "`id` = '{$check[0]['id']}'");
		}
		redirect();
		
	break;
	
	case "qarzdorho":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		
		$qarzdorho = query("
		SELECT 
			`students`.*,
			`faculties`.`short_title` AS `faculty_short`,
			`specialties`.`code` AS `spec_code`,
			`study_type`.`title` as `study_type_title`,
			`study_view`.`title` as `study_view_title`,
			`study_level`.`title` as `study_level_title`,
			`groups`.`title` AS `group_title`,
			`fan_test`.`title_tj` AS `fan_title`,
			`users`.`fullname_tj`,
			`tests`.*,
			`results`.`id`, IFNULL(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`), 0) as `total_score`,
			`std_study_groups`.`id_nt`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		INNER JOIN `faculties` ON `students`.`id_faculty` = `faculties`.`id`
		INNER JOIN `specialties` ON `students`.`id_spec` = `specialties`.`id`
		INNER JOIN `study_type` ON `students`.`id_s_t` = `study_type`.`id`
		INNER JOIN `study_view` ON `students`.`id_s_v` = `study_view`.`id`
		INNER JOIN `study_level` ON `students`.`id_s_l` = `study_level`.`id`
		INNER JOIN `groups` ON `students`.`id_group` = `groups`.`id`
		
		INNER JOIN `std_study_groups` ON 
			`students`.`id_faculty` = `std_study_groups`.`id_faculty` AND 
			`students`.`id_s_l` = `std_study_groups`.`id_s_l` AND 
			`students`.`id_s_v` = `std_study_groups`.`id_s_v` AND 
			`students`.`id_course` = `std_study_groups`.`id_course` AND 
			`students`.`id_spec` = `std_study_groups`.`id_spec` AND 
			`students`.`id_group` = `std_study_groups`.`id_group` AND
			`students`.`s_y` = `std_study_groups`.`s_y` AND
			`students`.`h_y` = `std_study_groups`.`h_y`
		INNER JOIN `tests` ON 
			`students`.`id_faculty` = `tests`.`id_faculty` AND 
			`students`.`id_s_l` = `tests`.`id_s_l` AND 
			`students`.`id_s_v` = `tests`.`id_s_v` AND 
			`students`.`id_course` = `tests`.`id_course` AND 
			`students`.`id_spec` = `tests`.`id_spec` AND 
			`students`.`id_group` = `tests`.`id_group` AND
			`students`.`s_y` = `tests`.`s_y` AND
			`students`.`h_y` = `tests`.`h_y`
			
		INNER JOIN `results` ON
			`tests`.`id_fan` = `results`.`id_fan` AND 
			`students`.`id_student` = `results`.`id_student` AND 
			`students`.`id_faculty` = `results`.`id_faculty` AND 
			`students`.`id_s_l` = `results`.`id_s_l` AND 
			`students`.`id_s_v` = `results`.`id_s_v` AND 
			`students`.`id_course` = `results`.`id_course` AND 
			`students`.`id_spec` = `results`.`id_spec` AND 
			`students`.`id_group` = `results`.`id_group` AND
			`students`.`s_y` = `results`.`s_y` AND
			`students`.`h_y` = `results`.`h_y`
		INNER JOIN `fan_test` ON `tests`.`id_fan` = `fan_test`.`id`	
		WHERE `students`.`status` = '1' 
		AND `students`.`id_faculty` = '$id_faculty'
		AND `students`.`id_s_l` = '$id_s_l'
		AND `students`.`id_s_v` = '$id_s_v'
		AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec'
		AND `students`.`id_group` = '$id_group'
		AND `students`.`s_y` = '$s_y' 
		AND `students`.`h_y` = '$h_y'
		GROUP BY `students`.`id`, `tests`.`id`, `results`.`id`, `std_study_groups`.`id`
		HAVING
			`total_score` < 50.00 
		ORDER BY `students`.`id_faculty`, `students`.`id_s_l`, `students`.`id_s_v`,
		`students`.`id_course`, `students`.`id_spec`, `students`.`id_group`,
		`users`.`fullname_tj`, `tests`.`id_fan`
		");
		
		
		$group_options = query("
		SELECT
			`std_study_groups`.*,
			`faculties`.`title` AS `faculty_title`,
			`faculties`.`short_title` AS `faculty_short`,
			`specialties`.`code` AS `spec_code`,
			`specialties`.`title_tj` AS `spec_title_tj`,
			`specialties`.`title_ru` AS `spec_title_ru`,
			`specialties`.`title_en` AS `spec_title_en`,
			`study_level`.`title` AS `s_l_title`,
			`study_view`.`title` AS `s_v_title`,
			`course`.`title` AS `course_title`,
			`groups`.`title` AS `group_title`
		FROM
			`std_study_groups`
		INNER JOIN `faculties` ON `std_study_groups`.`id_faculty` = `faculties`.`id`
		INNER JOIN `specialties` ON `std_study_groups`.`id_spec` = `specialties`.`id`
		INNER JOIN `study_level` ON `std_study_groups`.`id_s_l` = `study_level`.`id`
		INNER JOIN `study_view` ON `std_study_groups`.`id_s_v` = `study_view`.`id`
		INNER JOIN `course` ON `std_study_groups`.`id_course` = `course`.`id`
		INNER JOIN `groups` ON `std_study_groups`.`id_group` = `groups`.`id`
		WHERE
			`std_study_groups`.`id_faculty` = '$id_faculty' AND 
			`std_study_groups`.`id_s_l` = '$id_s_l' AND 
			`std_study_groups`.`id_s_v` = '$id_s_v' AND 
			`std_study_groups`.`id_course` = '$id_course' AND 
			`std_study_groups`.`id_spec` = '$id_spec' AND 
			`std_study_groups`.`id_group` = '$id_group' AND 
			`std_study_groups`.`s_y` = '$s_y' AND 
			`std_study_groups`.`h_y` = '$h_y'
					
		");
		
		
		$page_info['title'] = 'Қарздорҳои ин гурӯҳ / '.$group_options[0]['faculty_short'].' / '.$group_options[0]['s_l_title'].' / '.$group_options[0]['s_v_title'].' / '.$group_options[0]['course_title'].' / '.$group_options[0]['spec_code'].' / '.$group_options[0]['group_title'];
		
	break;	
	
	case "groups":
		$data = query("SELECT * FROM `state_groups`");
		
		foreach($data as $item){
			$id_faculty = $item['id_faculty'];
			$id_s_l = $item['id_s_l'];
			$id_s_v = $item['id_s_v'];
			$id_course = $item['id_course'];
			$id_spec = $item['id_spec'];
			$id_group = $item['id_group'];
			$s_y = $item['s_y'];
			$h_y = $item['h_y'];
			
			$check = query("SELECT * FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v'
			AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
			
			
			if(empty($check)){
				echo "id_faculty ". $id_faculty.'<br>';
				echo "id_s_l ". $id_s_l.'<br>';
				echo "id_s_v ". $id_s_v.'<br>';
				echo "id_course ". $id_course.'<br>';
				echo "id_spec ". $id_spec.'<br>';
				echo "id_group ". $id_group.'<br>';
				echo "s_y ". $s_y.'<br>';
				echo "h_y ". $h_y.'<br>';
				echo "-------------<br>";
			}
			
		}
		
		exit;
	break;
	
	case "results":
		/*
		if(empty($test_center_module) && !isset($_SESSION['user']['admin'])){
			echo "Шумо барои дидани ин саҳифа иҷозат надоред";
			exit;
		}
		*/
		$id_student = $_REQUEST['id_student'];
		$id_fan = $_REQUEST['id_fan'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		$result = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		$variants = query("SELECT * FROM `results_variants` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y' ORDER BY `id` DESC");
		
		$id_questions = explode(",", $variants[0]['id_questions']);
		$id_answers = explode("^", $variants[0]['id_answers']);
		
		
		$page_info['title'] = "Натиҷаи донишҷӯ / ".getUserName($id_student).' / '.getFanTest($id_fan);
	break;
	
	case "results_rating":
		/*
		if(empty($test_center_module) && !isset($_SESSION['user']['admin'])){
			echo "Шумо барои дидани ин саҳифа иҷозат надоред";
			exit;
		}
		*/
		$id_student = $_REQUEST['id_student'];
		$id = @$_REQUEST['id'];
		$id_fan = $_REQUEST['id_fan'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		$result = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		$variants = query("SELECT * FROM `results_variants` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y' ORDER BY `id` DESC");
		
		if(!isset($_REQUEST['id'])){
			
			foreach($variants as $variant){
				echo "<p><a href='".MY_URL."?option=students&action=results_rating&id_student=".$id_student."&id_fan=".$id_fan."&s_y=".$s_y."&h_y=".$h_y."&id=".$variant['id']."'>".$variant['date'].'</a></p>';
			}
			exit;
		}
		$variants = query("SELECT * FROM `results_variants` WHERE `id` = '$id'");
		
		$id_questions = explode(",", $variants[0]['id_questions']);
		$id_answers = explode("^", $variants[0]['id_answers']);
		
		
		$page_info['title'] = "Натиҷаи донишҷӯ / ".getUserName($id_student).' / '.getFanTest($id_fan);
	break;
	
	case "problems":
		$page_info['title'] = "Камбудиҳо";
		
		$groups = query("SELECT * FROM `std_study_groups` WHERE `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`");
		
	break;
	
	case "checks":
		if(isset($_REQUEST['page'])){
			$page = $_REQUEST['page'];
		}else $page = 1;
		
		$perpage = 50;
		$count_all = count_table_where("rasidho", "`s_y` = '".S_Y."'");
		$pages_count = ceil($count_all / $perpage);
		
		if(!$pages_count) $pages_count = 1; 
		
		if($page > $pages_count) {
			$page = $pages_count; 
			redirect(MY_URL."?option=students&action=checks");
		}
		
		$start_pos = ($page - 1) * $perpage;
		
		$checks = query("SELECT * FROM `rasidho` WHERE `s_y` = '".S_Y."' ORDER BY `id` DESC, `op_date` DESC LIMIT $start_pos, $perpage");
		
		$page_info['title'] = "Расидҳо: саҳифаи $page аз $pages_count";
	break;
	
	
	case "add":
		
		$faculties = select("faculties", "*", "", "id", false, "");
		$studylevels = select("study_level", "*", "", "id", false, "");
		$studyviews = select("study_view", "*", "", "id", false, "");
		$studytypes = select("study_type", "*", "", "id", false, "");
		
		$courses = select("course", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "id", false, "");
		
		$countries = select("countries", "*", "", "id", false, "");
		//$regions = select("regions", "*", "", "id", false, "");
		
		
		$nations = select("nations", "*", "", "id", false, "");
		$vazi_oilavi = select("vazi_oilavi", "*", "", "id", false, "");
		
		$page_info['title'] = 'Иловакунии донишҷӯ';
	break;
	
	case "insert":
		$page_info['title'] = "Иловакунии донишҷӯ: ".$_REQUEST['fullname'];
		
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		$table = "users";
		$data['fullname_tj'] = "'".clear_admin($_REQUEST['fullname'])."'";
		$data['fullname_ru'] = "'".clear_admin($_REQUEST['fullname_ru'])."'";
		if(!empty($_REQUEST['birthday']))
			$data['birthday'] = "'".clear_admin($_REQUEST['birthday'])."'";
		$data['jins'] = "'".clear_admin($_REQUEST['jins'])."'";
		$data['login'] = "'".clear_admin($_REQUEST['login'])."'";
		$data['password'] = "'".clear_admin($_REQUEST['password'])."'";
		if(!empty($_REQUEST['email']))
			$data['email'] = "'".clear_admin($_REQUEST['email'])."'";
		if(!empty($_REQUEST['phone']))
			$data['phone'] = "'".clear_admin($_REQUEST['phone'])."'";
		if(!empty($_REQUEST['parent_phone']))
			$data['phone_parents'] = "'".clear_admin($_REQUEST['parent_phone'])."'";
		
		if(!empty($_REQUEST['vazi_ijtimoi']))
			$data['v_ijtimoi'] = "'".clear_admin($_REQUEST['vazi_ijtimoi'])."'";
		
		if(!empty($_REQUEST['az_oilai_ki']))
			$data['from_family'] = "'".clear_admin($_REQUEST['az_oilai_ki'])."'";
		
		if(!empty($_REQUEST['vazi_oilavi_form']))
			$data['v_oilavi'] = "'".clear_admin($_REQUEST['vazi_oilavi_form'])."'";
		
		
		if(!empty($_REQUEST['family_info']))
			$data['family_info'] = "'".clear_admin($_REQUEST['family_info'])."'";
		
		if(!empty($_REQUEST['xobgoh']))
			$data['xobgoh'] = "'".clear_admin(1)."'";
		
		$data['access'] = 1;
		$data['access_type'] = 3;
		$data['added_by'] = "'".$_SESSION['user']['id']."'";
		$data['added_time'] = "'".date("Y-m-d H:i:s")."'";
		
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		
		if($id_student = insert($table, $fields, $data)){
			
			/*PASSPORT DATAS*/
			$table = "user_passports";
			$passport_data['id_user'] = "'".clear_admin($id_student)."'";
			if(!empty($_REQUEST['number_passport']))
				$passport_data['number'] = "'".clear_admin($_REQUEST['number_passport'])."'";
			
			if(!empty($_REQUEST['sanai_dodani_passport']))
				$passport_data['date'] = "'".clear_admin($_REQUEST['sanai_dodani_passport'])."'";
			
			if(!empty($_REQUEST['maqomot']))
				$passport_data['maqomot'] = "'".clear_admin($_REQUEST['maqomot'])."'";
			
			if(!empty($_REQUEST['id_country']))
				$passport_data['id_country'] = "'".clear_admin($_REQUEST['id_country'])."'";
			if(!empty($_REQUEST['id_nation']))
				$passport_data['id_nation'] = "'".clear_admin($_REQUEST['id_nation'])."'";
			if(!empty($_REQUEST['id_region']))
				$passport_data['id_region'] = "'".clear_admin($_REQUEST['id_region'])."'";
			
			if(!empty($_REQUEST['id_district']))
				$passport_data['id_district'] = "'".clear_admin($_REQUEST['id_district'])."'";
			
			if(!empty($_REQUEST['current_address']))
				$passport_data['address'] = "'".clear_admin($_REQUEST['current_address'])."'";
			
			$passport_fields = array_keys($passport_data);
			$passport_data = implode(",", $passport_data);
			
			insert($table, $passport_fields, $passport_data);
			/*PASSPORT DATAS*/
			
			/*USER EDUCATION*/
			$table = "user_udecation";
			$edu_data['id_user'] = "'".clear_admin($id_student)."'";
			if(!empty($_REQUEST['number_hujjat'])){
				$edu_data['id_khatm_namud'] = "'".clear_admin($_REQUEST['xatm_namud'])."'";
				$edu_data['id_hujjat'] = "'".clear_admin($_REQUEST['hujjati_xatm'])."'";
				if(!empty($_REQUEST['soli_xatm']))
					$edu_data['soli_xatm'] = "'".clear_admin($_REQUEST['soli_xatm'])."'";
				$edu_data['silsila'] = "'".clear_admin($_REQUEST['silsila'])."'";
				$edu_data['number_hujjat'] = "'".clear_admin($_REQUEST['number_hujjat'])."'";
				$edu_data['date_hujjat'] = "'".clear_admin($_REQUEST['date_hujjat'])."'";
				$edu_data['number_scholl'] = "'".clear_admin($_REQUEST['number_scholl'])."'";
			}
			
			if(!empty($_REQUEST['muasisa_name']))
				$edu_data['muasisa_name'] = "'".clear_admin($_REQUEST['muasisa_name'])."'";
			$edu_data['muasisa_lang'] = "'".clear_admin($_REQUEST['muasisa_lang'])."'";
			
			$edu_fields = array_keys($edu_data);
			$edu_data = implode(",", $edu_data);
			insert($table, $edu_fields, $edu_data);
			/*USER EDUCATION*/
			
			
			$table = "students";
			$counter = 1;
			foreach($_REQUEST['semestr'] as $key => $value){
				
				unset($data, $fields);
				$explode = explode("_", $value);	
				$S_Y = $explode[0];
				$H_Y = $explode[1];
				$course = $explode[2];
				
				$data['id_student'] = "'".clear_admin($id_student)."'";
				$data['id_faculty'] = "'".clear_admin($_REQUEST['id_faculty'])."'";
				$data['id_s_l'] = "'".clear_admin($_REQUEST['id_s_l'])."'";
				$data['id_s_v'] = "'".clear_admin($_REQUEST['id_s_v'])."'";
				$data['id_course'] = "'".clear_admin($course)."'";
				
				$data['id_spec'] = "'".clear_admin($_REQUEST['id_spec'])."'";
				
				$data['id_group'] = "'".clear_admin($_REQUEST['id_group'])."'";
				$data['id_s_t'] = "'".clear_admin($_REQUEST['id_s_t'])."'";
				$data['vazi_oilavi'] = "'".clear_admin($_REQUEST['vazi_oilavi'])."'";
				
				$data['s_y'] = $S_Y;
				$data['h_y'] = $H_Y;
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				if(insert($table, $fields, $data)){
					
					/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
					isGroupIsset($_REQUEST['id_faculty'], $_REQUEST['id_course'], $_REQUEST['id_spec'], $_REQUEST['id_group'], $_REQUEST['id_s_l'], $_REQUEST['id_s_v'], $S_Y, $H_Y);
					/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
				}
				$counter++;
			}
			
			if($_FILES['photo']['name']){
				$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['photo']['name'])); // расширение картинки
				
				if(in_array($baseimgExt, ALLOWED_IMG_FROMAT)){
					$baseimgName = "{$id_student}.{$baseimgExt}";
					$baseimgTmpName = $_FILES['photo']['tmp_name'];
					if(move_uploaded_file($baseimgTmpName, "../userfiles/students/$baseimgName")){
						$fields = array('photo' => $baseimgName);
						update("users", $fields, "`id` = '$id_student'");
					}
				}else{
					$data['id_user'] = $id_student;
					$data['author'] = $_SESSION['user']['id'];
					$data['file'] = "'".$_FILES['photo']['name']."'";
					$data['date'] = "'".date("d.m.Y, H:i:s")."'";
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					
					insert("rat", $fields, $data);
				}
			}
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			redirect();	
		}
	break;
	
	case "update_student":
		
		$id_student = $_REQUEST['id_student'];
		$page_info['title'] = "Таҳриркунии донишҷӯ ".getUserName($id_student);
		
		$fields_users['fullname_tj'] = $_REQUEST['fullname_tj'];
		$fields_users['fullname_ru'] = $_REQUEST['fullname_ru'];
		$fields_users['jins'] = $_REQUEST['jins'];
		$fields_users['login'] = $_REQUEST['login'];
		$fields_users['password'] = $_REQUEST['password'];
		$fields_users['birthday'] = $_REQUEST['birthday'];
		
		if(!empty($_REQUEST['email']))
			$fields_users['email'] = $_REQUEST['email'];
		if(!empty($_REQUEST['phone']))
			$fields_users['phone'] = $_REQUEST['phone'];
		if(!empty($_REQUEST['parent_phone']))
			$fields_users['phone_parents'] = $_REQUEST['parent_phone'];
		
		$fields_users['v_ijtimoi'] = $_REQUEST['vazi_ijtimoi'];
		$fields_users['from_family'] = $_REQUEST['az_oilai_ki'];
		$fields_users['v_oilavi'] = $_REQUEST['vazi_oilavi_form'];
		$fields_users['family_info'] = $_REQUEST['family_info'];
		
		if(!empty($_REQUEST['xobgoh']))
			$fields_users['xobgoh'] = 1;
		if(!empty($_REQUEST['unvoni_harbi']))
			$fields_users['unvoni_harbi'] = $_REQUEST['unvoni_harbi'];
		if(!empty($_REQUEST['lashkar']))
			$fields_users['lashkar'] = $_REQUEST['lashkar'];
		
		update("users", $fields_users, "`id` = '$id_student'");
		
		if($_FILES['photo']['name']){
			$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['photo']['name'])); // расширение картинки
			
			if(in_array($baseimgExt, ALLOWED_IMG_FROMAT)){
			
				$baseimgName = "{$id_student}.{$baseimgExt}";
				$baseimgTmpName = $_FILES['photo']['tmp_name'];
				if(move_uploaded_file($baseimgTmpName, "../userfiles/students/$baseimgName")){
					$fields_photo = array('photo' => $baseimgName);
					update("users", $fields_photo, "`id` = '$id_student'");
				}
			}else{
				$data['id_user'] = $id_student;
				$data['author'] = $_SESSION['user']['id'];
				$data['file'] = "'".$_FILES['photo']['name']."'";
				$data['date'] = "'".date("d.m.Y, H:i:s")."'";
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				insert("rat", $fields, $data);
			}
		}
		
		
		
		/*PASSPORT DATAS*/
		$fields_passport['number'] = $_REQUEST['number_passport'];
		$fields_passport['date'] = $_REQUEST['sanai_dodani_passport'];
		$fields_passport['maqomot'] = $_REQUEST['maqomot'];
		if(!empty($_REQUEST['id_country']))
			$fields_passport['id_country'] = $_REQUEST['id_country'];
		
		if(!empty($_REQUEST['id_region']))
			$fields_passport['id_region'] = $_REQUEST['id_region'];
		if(!empty($_REQUEST['id_district']))
			$fields_passport['id_district'] = $_REQUEST['id_district'];
		if(!empty($_REQUEST['current_address']))
			$fields_passport['address'] = $_REQUEST['current_address'];
		
		$fields_passport['id_nation'] = $_REQUEST['id_nation'];
		
		update("user_passports", $fields_passport, "`id_user` = '$id_student'");
		/*PASSPORT DATAS*/
		
		
		/* STUDENTS */
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		
		$fields_student['id_faculty'] = $_REQUEST['id_faculty'];
		$fields_student['id_s_l'] = $_REQUEST['id_s_l'];
		$fields_student['id_spec'] = $_REQUEST['id_spec'];
		$fields_student['id_s_v'] = $_REQUEST['id_s_v'];
		if(!empty($_REQUEST['foreign']))
			$fields_student['foreign'] = 1;
		$fields_student['id_course'] = $_REQUEST['id_course'];
		$fields_student['id_group'] = $_REQUEST['id_group'];
		$fields_student['id_s_t'] = $_REQUEST['id_s_t'];
		$fields_student['vazi_oilavi'] = $_REQUEST['vazi_oilavi'];
		
		
		/*Маълумотҳои пешинаи донишҷӯ*/
		$student_info = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$old_id_faculty = $student_info[0]['id_faculty'];
		$old_id_s_l = $student_info[0]['id_s_l'];
		$old_id_s_v = $student_info[0]['id_s_v'];
		$old_id_course = $student_info[0]['id_course'];
		$old_id_spec = $student_info[0]['id_spec'];
		$old_id_group = $student_info[0]['id_group'];
		$old_id_s_t = $student_info[0]['id_s_t'];
		/*Маълумотҳои пешинаи донишҷӯ*/
		
		if(update("students", $fields_student, "`id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")){
			/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
			isGroupIsset($_REQUEST['id_faculty'], $_REQUEST['id_course'], $_REQUEST['id_spec'], $_REQUEST['id_group'], $_REQUEST['id_s_l'], $_REQUEST['id_s_v'], $S_Y, $H_Y);
			/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
		}
		

		
		/*Муайян мекунем ки дар гурух чанд донишҷуи дигар боқи мемонад*/
		$info_group = query("SELECT COUNT(`id`) as `count` FROM `students` WHERE 
		`id_faculty` = '$old_id_faculty' AND 
		`id_s_l` = '$old_id_s_l' AND 
		`id_s_v` = '$old_id_s_v' AND 
		`id_course` = '$old_id_course' AND 
		`id_spec` = '$old_id_spec' AND 
		`id_group` = '$old_id_group' AND 
		`s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		/*Муайян мекунем ки дар гурух чанд донишҷуи дигар боқи мемонад*/
		
		
		/*Агар ҳамин донишҷӯ ягона донишҷуи гурух бошад пас аз контингенти гуруххо нест мекунем гурухро*/
		if($info_group[0]['count'] == 0){
			unset($_SESSION['superarr'][$old_id_faculty]["level"][$old_id_s_l]["view"][$old_id_s_v]["course"][$old_id_course]['spec'][$old_id_spec]['groups'][$old_id_group]);
			delete("std_study_groups", "
			`id_faculty` = '$old_id_faculty' AND 
			`id_s_l` = '$old_id_s_l' AND 
			`id_s_v` = '$old_id_s_v' AND
			`id_course` = '$old_id_course' AND 
			`id_spec` = '$old_id_spec' AND 
			`id_group` = '$old_id_group' AND 
			`s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		}
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		redirect();	
		/*Агар ҳамин донишҷӯ ягона донишҷуи гурух бошад пас аз контингенти гуруххо нест мекунем гурухро*/
		/* STUDENTS */
		
	break;
	
	case "update_student_old":
		$id_student = $_REQUEST['id_student'];
		$old_id_nt = $_REQUEST['id_nt'];
		
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$id_faculty = clear_admin($_REQUEST['id_faculty']);
		$id_course = clear_admin($_REQUEST['id_course']);
		$id_spec = clear_admin($_REQUEST['id_spec']);
		$id_group = clear_admin($_REQUEST['id_group']);
		$id_s_l = clear_admin($_REQUEST['id_s_l']);
		$id_s_t = clear_admin($_REQUEST['id_s_t']);
		$id_s_v = clear_admin($_REQUEST['id_s_v']);
		
		/*
		$new_nt = query("SELECT * FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$new_id_nt = $new_nt[0]['id_nt'];
		
		$old_nt_content = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$old_id_nt' AND `id_course` < '$id_course' ORDER BY `id_course`, `h_y`, `id_fan`");
		$new_nt_content = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$new_id_nt' AND `id_course` < '$id_course' ORDER BY `id_course`, `h_y`, `id_fan`");
		
		
		function udiffCompare($a, $b){
			return $a['id_fan'] - $b['id_fan'];
		}

		$raznitsa = array_udiff($new_nt_content, $old_nt_content, 'udiffCompare');
		
		include("help.php");
		exit;
		*/
		
		
		/*Маълумотҳои пешинаи донишҷӯ*/
		$student_info = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$old_id_faculty = $student_info[0]['id_faculty'];
		$old_id_course = $student_info[0]['id_course'];
		$old_id_spec = $student_info[0]['id_spec'];
		$old_id_group = $student_info[0]['id_group'];
		$old_id_s_l = $student_info[0]['id_s_l'];
		$old_id_s_t = $student_info[0]['id_s_t'];
		$old_id_s_v = $student_info[0]['id_s_v'];
		/*Маълумотҳои пешинаи донишҷӯ*/
		
		
		/*Муайян мекунем ки дар гурух чанд донишҷуи дигар боқи мемонад*/
		$info_group = query("SELECT COUNT(`id`) as `count` FROM `students` WHERE 
		`id_faculty` = '$old_id_faculty' AND `id_course` = '$old_id_course' AND `id_spec` = '$old_id_spec' AND 
		`id_group` = '$old_id_group' AND `id_s_l` = '$old_id_s_l' AND `id_s_v` = '$old_id_s_v' AND 
		`s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		/*Муайян мекунем ки дар гурух чанд донишҷуи дигар боқи мемонад*/
		
		$fields = array(
			'id_faculty' => $id_faculty,
			'id_course' => $id_course,
			'id_spec' => $id_spec,
			'id_group' => $id_group,
			'id_s_l' => $id_s_l,
			'id_s_t' => $id_s_t,
			'id_s_v' => $id_s_v
		);
		
		if(update("students", $fields, "`id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")){
			
			/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
			isGroupIsset($id_faculty, $id_course, $id_spec, $id_group, $id_s_l, $id_s_v, $S_Y, $H_Y);
			/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
			
			/* Дар таблитсаи students_farmonho интиқол карданаш*/
			if(!empty($_REQUEST['farmon_number']) && !empty($_REQUEST['farmon_date'])){
				unset($data, $fields);
				$data['id_student'] = "'".clear_admin($id_student)."'";
				$data['farmon_type'] = "'3'";
				$data['farmon_number'] = "'".clear_admin($_REQUEST['farmon_number'])."'";
				$data['farmon_date'] = "'".clear_admin($_REQUEST['farmon_date'])."'";
				$data['s_y'] = S_Y;
				$data['h_y'] = H_Y;
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				insert("students_farmonho", $fields, $data);
			}
			/* Дар таблитсаи students_farmonho интиқол карданаш*/
		}
		
		/*Агар ҳамин донишҷӯ ягона донишҷуи гурух бошад пас аз контингенти гуруххо нест мекунем гурухро*/
		if($info_group[0]['count'] == 1){
			unset($_SESSION['superarr'][$old_id_faculty]["view"][$old_id_s_v]["course"][$old_id_course]['spec'][$old_id_spec]['groups'][$old_id_group]);
			delete("std_study_groups", "`id_faculty` = '$old_id_faculty' AND `id_course` = '$old_id_course' AND `id_spec` = '$old_id_spec' AND `id_group` = '$old_id_group' AND `id_s_l` = '$old_id_s_l' AND `id_s_v` = '$old_id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
			redirect();
		}else redirect();	
		/*Агар ҳамин донишҷӯ ягона донишҷуи гурух бошад пас аз контингенти гуруххо нест мекунем гурухро*/
	break;
	
	case "delete_student":
		$id_student = $_REQUEST['id_student'];
		$S_Y = $_REQUEST['S_Y'];
		$H_Y = $_REQUEST['H_Y'];
		$author=$_SESSION['user']['id'];
		
		
		$data['id_student'] = "'".clear_admin($id_student)."'";
		$data['farmon_type'] = "'1'";
		$data['farmon_number'] = "'".clear_admin($_REQUEST['farmon_number'])."'";
		$data['id_sabab_khorij'] = "'".clear_admin($_REQUEST['id_sabab_khorij'])."'";
		$data['farmon_date'] = "'".clear_admin($_REQUEST['farmon_date'])."'";
		$data['farmon_text'] = "'".clear_admin($_REQUEST['farmon_text'])."'";
		$data['asos_text'] = "'".clear_admin($_REQUEST['asos_text'])."'";
		$data['farmon_add_time'] = "'".date('Y-m-d H:i:s')."'";
		$data['author'] = "'".clear_admin($author)."'";
		$data['s_y'] = "'".clear_admin($S_Y)."'";
		$data['h_y'] = "'".clear_admin($H_Y)."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		if(insert("stds_farmonho", $fields, $data)){	
			$fields = array('status' => "0");
			if(update("students", $fields, "`id_student` = '$id_student' AND `status`='1' AND `s_y` = '".$S_Y."' AND `h_y` = '".$H_Y."'")){
				redirect();
			}
		}
		
	break;
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		$s_y = S_Y;
		$h_y = H_Y;
		
		
		
		$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		
		
		/*Муайян намудани гурӯҳ*/
		
		
		$group_options = query("
		SELECT
			`std_study_groups`.*,
			`faculties`.`title` AS `faculty_title`,
			`faculties`.`short_title` AS `faculty_short`,
			`specialties`.`code` AS `spec_code`,
			`specialties`.`title_tj` AS `spec_title_tj`,
			`specialties`.`title_ru` AS `spec_title_ru`,
			`specialties`.`title_en` AS `spec_title_en`,
			`study_level`.`title` AS `s_l_title`,
			`study_view`.`title` AS `s_v_title`,
			`course`.`title` AS `course_title`,
			`groups`.`title` AS `group_title`
		FROM
			`std_study_groups`
		INNER JOIN `faculties` ON `std_study_groups`.`id_faculty` = `faculties`.`id`
		INNER JOIN `specialties` ON `std_study_groups`.`id_spec` = `specialties`.`id`
		INNER JOIN `study_level` ON `std_study_groups`.`id_s_l` = `study_level`.`id`
		INNER JOIN `study_view` ON `std_study_groups`.`id_s_v` = `study_view`.`id`
		INNER JOIN `course` ON `std_study_groups`.`id_course` = `course`.`id`
		INNER JOIN `groups` ON `std_study_groups`.`id_group` = `groups`.`id`
		WHERE
			`std_study_groups`.`status` = '1' AND 
			`std_study_groups`.`id_faculty` = '$id_faculty' AND 
			`std_study_groups`.`id_s_l` = '$id_s_l' AND 
			`std_study_groups`.`id_s_v` = '$id_s_v' AND 
			`std_study_groups`.`id_course` = '$id_course' AND 
			`std_study_groups`.`id_spec` = '$id_spec' AND 
			`std_study_groups`.`id_group` = '$id_group' AND 
			`std_study_groups`.`s_y` = '$s_y' AND 
			`std_study_groups`.`h_y` = '$h_y'
					
		");
		$id_study_group = @$group_options[0]['id'];
		$id_nt = @$group_options[0]['id_nt'];
		$lang = @$group_options[0]['lang'];
		/*Муайян намудани гурӯҳ*/
		
		
		
		
		
		$semestr = getSemestr($id_course, 1);
		$students_r1 = count_table_where("students", "
			`status` = '1' AND
			`id_faculty` = '$id_faculty' AND
			`id_s_l` = '$id_s_l' AND
			`id_s_v` = '$id_s_v' AND
			`id_course` = '$id_course' AND
			`id_spec` = '$id_spec' AND
			`id_group` = '$id_group' AND
			`s_y` = '$s_y' AND
			`h_y` = '1'
		");
		$fanlist_1 = getFanList($id_nt, $semestr, $id_group);
		
		
		
		$semestr = getSemestr($id_course, H_Y);
		$students_r2 = count_table_where("students", "
			`status` = '1' AND
			`id_faculty` = '$id_faculty' AND
			`id_s_l` = '$id_s_l' AND
			`id_s_v` = '$id_s_v' AND
			`id_course` = '$id_course' AND
			`id_spec` = '$id_spec' AND
			`id_group` = '$id_group' AND
			`s_y` = '$s_y' AND
			`h_y` = '2'
		");
		$fanlist_2 = getFanList($id_nt, $semestr, $id_group);
		
		
		
		
		
		// $semestr = getSemestr($id_course, 1);
		// $fanlist_1 = query("
		
		// SELECT
			// `nt_content`.*,
			// `iqtibosho`.*
		// FROM
			// `iqtibosho`
		// INNER JOIN `nt_content` ON `nt_content`.`id_nt` = `iqtibosho`.`id_nt` 
		// AND `nt_content`.`id_fan` = `iqtibosho`.`id_fan`
		// AND `nt_content`.`semestr` = `iqtibosho`.`semestr`
		// AND `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$semestr'
		// WHERE `iqtibosho`.`s_y` = '$s_y' AND
			// `iqtibosho`.`id_group` = '$id_group' AND `iqtibosho`.`id_fan` != '1748';
		// ");
		
		// Баровардани фанхо аз руи нақшаи таълимӣ
		// $semestr = getSemestr($id_course, H_Y);
		// Баровардани фанхо аз руи нақшаи таълимӣ
		
		
		// $fanlist_2 = query("
		
		// SELECT
			// `nt_content`.*,
			// `iqtibosho`.*
		// FROM
			// `iqtibosho`
		// INNER JOIN `nt_content` ON `nt_content`.`id_nt` = `iqtibosho`.`id_nt` 
		// AND `nt_content`.`id_fan` = `iqtibosho`.`id_fan`
		// AND `nt_content`.`semestr` = `iqtibosho`.`semestr`
		// AND `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$semestr'
		// WHERE `iqtibosho`.`s_y` = '$s_y' AND
			// `iqtibosho`.`id_group` = '$id_group' AND `iqtibosho`.`id_fan` != '1748';
		// ");
		
		
		$page_info['title'] = 'Донишҷӯён / '.$group_options[0]['faculty_short'].' / '.$group_options[0]['s_l_title'].' / '.$group_options[0]['s_v_title'].' / '.$group_options[0]['course_title'].' / '.$group_options[0]['spec_code'].' / '.$group_options[0]['group_title'];
	break;
	
	case "addoldresults":
		$id_student=$_REQUEST['id_student'];
		$info_std=query("SELECT * FROM `students` WHERE `id_course` IN (SELECT MAX(`id_course`) FROM `students` WHERE `id_student` = '$id_student') AND `id_student` = '$id_student'");
		$id_faculty=$info_std[0]['id_faculty'];
		$id_course=$info_std[0]['id_course'];
		$id_spec=$info_std[0]['id_spec'];
		$id_group=$info_std[0]['id_group'];
		$id_s_l=$info_std[0]['id_s_l'];
		$id_s_v=$info_std[0]['id_s_v'];
		$current_semestr=getSemestr($id_course, H_Y);
		$id_nt=query("SELECT * FROM `std_study_groups` WHERE `id_faculty`='$id_faculty' 
						AND `id_course`='$id_course' AND `id_spec`='$id_spec' AND `id_group` = '$id_group'
						AND `id_s_l`='$id_s_l' AND `id_s_v`='$id_s_v' 
						AND `s_y`='".S_Y."' AND `h_y`='".H_Y."' 
					");
		$id_nt=$id_nt[0]['id_nt'];
		$fans_nt=query("SELECT * FROM `nt_content` WHERE `id_nt`='$id_nt' AND `semestr`<'$current_semestr' AND `id_fan`!=1748 ORDER BY `semestr`");
		$results_student=query("SELECT * FROM `results` WHERE `id_student`='$id_student'");
		function udiffCompare($a, $b){
			return $a['id_fan'] - $b['id_fan'];
		}
		$allfans = array_udiff($fans_nt, $results_student, 'udiffCompare');
		$page_info['title'] = "Иловакунии натиҷаҳои пешинаи донишҷӯ дар асоси транскрипти пешниҳодшуда";
	break;
	
	case "addfarmon":
		$id_student = $_REQUEST['id_student'];
		$ftypes = query("SELECT * FROM `stds_farmon_type`");
		$page_info['title'] = "Иловакунии фармонҳо";
	break;
	
	case "insert_farmon":
		$id_student = $_REQUEST['id_student'];
		$author=$_SESSION['user']['id'];
		unset($data, $fields);
		$data['id_student'] = "'".clear_admin($id_student)."'";
		$data['farmon_type'] = "'".clear_admin($_REQUEST['type'])."'";
		$data['farmon_number'] = "'".clear_admin($_REQUEST['farmon_number'])."'";
		$data['farmon_date'] = "'".clear_admin($_REQUEST['farmon_date'])."'";
		$data['farmon_text'] = "'".clear_admin($_REQUEST['farmon_text'])."'";
		$data['asos_text'] = "'".clear_admin($_REQUEST['asos_text'])."'";
		$data['farmon_add_time'] = "'".date('Y-m-d H:i:s')."'";
		$data['author'] = "'".clear_admin($author)."'";
		$fields = array_keys($data);
		$data = implode(",", $data);
		insert("stds_farmonho", $fields, $data);
		redirect();
	break;
	
	case "insert_oldresults":
		$table = "results";
		$id_student = $_REQUEST['id_student'];
		$author=$_SESSION['user']['id'];
		for($i=0;$i<=count($_REQUEST['fan']);$i++){
			if(isset($_REQUEST['fan'][$i])){
				$id_fan=$_REQUEST['fan'][$i];
				$id_course=$_REQUEST['course'][$i];
				$id_sy=$_REQUEST['s_y'][$i];
				$id_hy=$_REQUEST['h_y'][$i];
				$total_score=floatval($_REQUEST['total_score'][$i]);
				if(isset($_REQUEST['kori_kursi'][$i]))
					$kori_kursi=floatval($_REQUEST['kori_kursi'][$i]);
				if(!empty($total_score)){
					$check = query("SELECT * FROM `results` WHERE `id_student`='$id_student' AND `id_fan`='$id_fan' AND `s_y`='$id_sy' AND `h_y`='$id_hy'");
					if(empty($check)){
						unset($data, $fields);
						$data['id_student'] = "'".clear_admin($id_student)."'";
						$data['id_course'] = "'".clear_admin($id_course)."'";
						$data['id_fan'] = "'".clear_admin($id_fan)."'";
						$data['s_y'] = "'".clear_admin($id_sy)."'";
						$data['h_y'] = "'".clear_admin($id_hy)."'";
						$data['total_score'] = "'".clear_admin($total_score)."'";
						$data['total_score_author'] = "'".clear_admin($author)."'";
						if(isset($kori_kursi)){
							$data['kori_kursi'] = "'".clear_admin($kori_kursi)."'";								
						}
						$semestr = getSemestr($id_course, $id_hy);
						$data['semestr'] = "'".clear_admin($semestr)."'";
						
						$fields = array_keys($data);
						$data = implode(",", $data);
						insert($table, $fields, $data);
					}
				}
			}
		}
		redirect();
	break;
	
	case "create_raznitsa":
		$id_student = $_REQUEST['id_student'];
		$student=query("SELECT * FROM `students` WHERE `id` IN (SELECT MAX(`id`) FROM `students` WHERE `students`.`id_student` = '$id_student')");
		$specs = query("
			SELECT * FROM `std_study_groups` WHERE `id_course` = '{$student[0]['id_course']}' 
			AND `id_s_l`='{$student[0]['id_s_l']}' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
			AND `id_nt`!='NULL'
			ORDER BY `id_spec` ASC, `id_s_v` ASC
		");
		// Аз массив ҳамаи элементҳое, ки дар онҳо id_s_v ва id_spec якхелаанд кам мекунад!
		$filtered = array_reduce($specs, function ($filtered, $item) {
			$filtered[$item['id_s_v'].$item['id_spec']] = $item;
			return $filtered;
		});
		$specs = array_values($filtered);
		// Аз массив ҳамаи элементҳое, ки дар онҳо id_s_v ва id_spec якхелаанд кам мекунад!
		
		//print_arr($specs);exit;
		$ariza = query("SELECT * FROM `farqiyatho` WHERE `id_student` = '$id_student' ORDER BY `s_y` DESC, `h_y` ASC");
		
		$page_info['title'] = "Сохтани аризаи фарқият ва фанҳои он";
	break;
	
	case "save_raznitsa":
		//print_arr($_REQUEST['type']);exit;
		$table = "farqiyatho";
		$id_student = $_REQUEST['id_student'];
		$author=$_SESSION['user']['id'];
		$check = query("SELECT * FROM `farqiyatho` WHERE `id_student`='$id_student' AND `s_y`='".S_Y."' AND `h_y`='".H_Y."'");
		if(empty($check)){
			unset($data, $fields);
			$data['id_student'] = "'".clear_admin($id_student)."'";
			$data['author'] = "'".clear_admin($author)."'";
			$data['s_y'] = "'".clear_admin(S_Y)."'";
			$data['h_y'] = "'".clear_admin(H_Y)."'";						
			$fields = array_keys($data);
			$data = implode(",", $data);
			if($id_farqiyat=insert($table, $fields, $data)){
				for($i=1;$i<=count($_REQUEST['fan']);$i++){				
					if(isset($_REQUEST["teacher_$i"])){
						unset($data, $fields);
						
						$data['id_farqiyat'] = "'".clear_admin($id_farqiyat)."'";
						$data['id_fan'] = "'".clear_admin($_REQUEST['fan'][$i])."'";
						$data['type'] = "'".clear_admin($_REQUEST['type'][$i])."'";
						$data['credit'] = "'".clear_admin($_REQUEST['credit'][$i])."'";
						$data['money'] = "'".clear_admin($_REQUEST['money'][$i])."'";
						$data['id_course'] = "'".clear_admin($_REQUEST['course'][$i])."'";
						$data['id_teacher'] = "'".clear_admin($_REQUEST["teacher_$i"])."'";
						$data['s_y'] = "'".clear_admin($_REQUEST['s_y'][$i])."'";
						$data['h_y'] = "'".clear_admin($_REQUEST['h_y'][$i])."'";			
						
						$fields = array_keys($data);
						$data = implode(",", $data);
						insert("farqiyatho_content", $fields, $data);
					}
				}
			}
		}
		else{
			$id_farqiyat = $check[0]['id'];
			for($i=1;$i<=count($_REQUEST['fan']);$i++){
				if(isset($_REQUEST["teacher_$i"])){
					$fields = array('id_teacher' => $_REQUEST["teacher_$i"]);
					update("farqiyatho_content", $fields, "`id_farqiyat` = '$id' AND `id_fan` = '{$_REQUEST['fan'][$i]}' AND `type` = '{$_REQUEST['type'][$i]}' AND `s_y`='{$_REQUEST['s_y'][$i]}' AND `h_y`='{$_REQUEST['h_y'][$i]}'");
				}
			}
		}
		redirect();
	break;

	case "delete_farqiyat":
		$id_farqiyat=$_REQUEST['id_farqiyat'];
		if($id_farqiyat){
			delete("farqiyatho", "`id` = '$id_farqiyat'");
			delete("farqiyatho_content", "`id_farqiyat` = '$id_farqiyat'");
		}
		redirect();
	break;
	
	case "ijozati_farqiyat":
		$id_farqiyat = $_REQUEST['id_farqiyat'];
		$farqiyat = query("SELECT * FROM `farqiyatho` WHERE `id`='$id_farqiyat'");
		$status = $farqiyat[0]['status'];
		if($status == 0){
			$fields = array('status' => 1); 
			update("farqiyatho", $fields, "`id` = '$id_farqiyat'", true);
		}else{
			$fields = array('status' => 0); 
			update("farqiyatho", $fields, "`id` = '$id_farqiyat'", true);
		}
		redirect();
	break;
	
	case "tasdiqi_farqiyat":
		$page_info['title'] = "Тасдиқи фарқият";
	break;
	
	
	case "groupsettings_update":
		$id = clear_admin($_REQUEST['id']);
		$id_nt = clear_admin($_REQUEST['id_nt']);
		$lang = clear_admin($_REQUEST['lang']);
		
		$fields = array('id_nt' => "$id_nt", 'lang' => "$lang");
		
		if(update("std_study_groups", $fields, "`id` = '$id'")){
			redirect();
		}
		
	break;
	
	case "studentstatistic":
		
		$page_info['title'] = "Омори донишҷуён";
		
		if(isset($_REQUEST['id_faculty'])){
			$id_faculty = $_REQUEST['id_faculty'];
			$all_stds_where = "`id_faculty` = '$id_faculty' AND ";
			$mw_where = "`students`.`status` = '1' AND `students`.`id_faculty` = '$id_faculty' AND ";
			$mw_where1 = "`std_table`.`status` = '1' AND `std_table`.`id_faculty` = '$id_faculty' AND ";
		}else{
			$all_stds_where = "";
			$mw_where = "`students`.`status` = '1' AND ";
			$mw_where1 = "`std_table`.`status` = '1' AND ";
		}
		
		
		$all_students = select2("students", array("Count(id)"), "`status` = '1' AND $all_stds_where `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id", false, "");
		$all_students = $all_students[0]['Count(`id`)'];
		
		
		$ruzona = select("students", array("Count(id)"), "`status` = '1' AND $all_stds_where `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id", false, "");
		$ruzona = $ruzona[0]['Count(`id`)'];
		
		$fosilavi = select("students", array("Count(id)"), "`status` = '1' AND $all_stds_where `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id", false, "");
		$fosilavi = $fosilavi[0]['Count(`id`)'];
		
		
		
		$query = query("select count(`students`.`id`) as `mans`,
		(SELECT COUNT(`students`.`id`) FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `users`.`jins` = '1' AND `id_s_v` = 1 AND `s_y` = ".S_Y." AND `h_y` = ".H_Y.") as `m_ruzona`,
		(SELECT COUNT(`students`.`id`) FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `users`.`jins` = '1' AND `id_s_v` = 2 AND `s_y` = ".S_Y." AND `h_y` = ".H_Y.") as `m_fosilavi`,
		(select count(`students`.`id`) as `womans`
		from `students` left join `users` on `students`.`id_student`  = `users`.`id`
		where $mw_where `users`.`jins` = '0' AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y.") as `womans`,
		(SELECT COUNT(`students`.`id`) FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `users`.`jins` = '0' AND `id_s_v` = 1 AND `s_y` = ".S_Y." AND `h_y` = ".H_Y.") as `w_ruzona`,
		(SELECT COUNT(`students`.`id`) FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `users`.`jins` = '0' AND `id_s_v` = 2 AND `s_y` = ".S_Y." AND `h_y` = ".H_Y.") as `w_fosilavi`
		from `students` left join `users` on `students`.`id_student`  = `users`.`id`
		where $mw_where `users`.`jins` = '1' AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y."");
		
		
		$statistic = query("
		SELECT `std_table`.`id_course`, count(`std_table`.`id`) as `all`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '1' AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `mans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '0' AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `woman`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `students`.`id_s_v` = 1 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `all_ruz`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '1' AND `students`.`id_s_v` = 1 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `ruz_mans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '0' AND `students`.`id_s_v` = 1 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `ruz_womans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `students`.`id_s_v` = 2 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `all_fos`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '1' AND `students`.`id_s_v` = 2 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `fos_mans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '0' AND `students`.`id_s_v` = 2 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `fos_womans`,
		`std_table`.`s_y`,
		`std_table`.`h_y`
		from `students` as `std_table` WHERE $mw_where1 `std_table`.`s_y` = ".S_Y." AND `std_table`.`h_y` = ".H_Y." GROUP BY 1 ORDER BY `std_table`.`id_course`
		");
		
		
		$faculties = select("real_faculties", "*", "`s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "title", false, "");
		
	break;
	
	case "groupstatistic":
		$page_info['title'] = "Омори гурӯҳҳо";
		$statistic = query("
			SELECT `id_faculty`,`title`,
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as allgroups,
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `id_s_l` = '1' AND `id_s_v` = 1 AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as bak_ruzona,
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `id_s_l` = '1' AND `id_s_v` = 2 AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as bak_fosilavi,
			
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `id_s_l` = '2' AND `id_s_v` = 2 AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as t2_fosilavi,
			
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `id_s_l` = '3' AND `id_s_v` = 1 AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as mag_ruzona,
			
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `id_s_l` = '4' AND `id_s_v` = 1 AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as doc_ruzona,
			`s_y`, `h_y`
			FROM `real_faculties` as `r_f` WHERE `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_faculty`
		");
		
		$date = date("Y-m-d", time());
		$count_users = query("SELECT COUNT(`id`) as `users` FROM `users` WHERE `id` IN(SELECT `id_user` FROM `_datasonline` WHERE `date` = '$date') ORDER BY `access_type`, `last_login` DESC");
		$users = query("SELECT * FROM `users` WHERE `id` IN(SELECT `id_user` FROM `_datasonline` WHERE `date` = '$date') ORDER BY `access_type`, `last_login` DESC LIMIT 50");
		
		
		
		$count_teachers = query("SELECT COUNT(`id`) as `teachers` FROM `users` WHERE `access_type` = 2 AND `id` IN(SELECT `id_user` FROM `_datasonline` WHERE `date` = '$date')");
		$count_students = query("SELECT COUNT(`id`) as `students` FROM `users` WHERE `access_type` = 3 AND `id` IN(SELECT `id_user` FROM `_datasonline` WHERE `date` = '$date')");
		
		
	break;
	
	
	
	case "structure":
		$page_info['title'] = "Сохтор";
		
	break;
	
	case "harakat":
		$page_info['title'] = "Ҳаракат";
	break;
	
	case "mintaqa":
		$page_info['title'] = "Омори минтақавӣ";
		$regions = select("regions", "*", "", "name", false, "");
	break;
	
	case "district":
		$id_district = $_REQUEST['id_district'];
		
		$j_where = "";
		if(isset($_REQUEST['jins'])){
			$jins = $_REQUEST['jins'];
			$j_where = "AND `users`.`jins` = '$jins'";
		}
		
		$students = query("SELECT * FROM `students` INNER JOIN `users` ON `students`.`id_student` = `users`.`id` 
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' 
		WHERE `students`.`status` = '1' AND `users`.`id_district` = '$id_district' $j_where
		ORDER BY `students`.`id_course`, `students`.`id_spec`, `users`.`fullname`");
		
		$page_info['title'] = "Шаҳр/Ноҳия: ".getDistrict($id_district);
		
	break;
	
	case "create_trimestr":
		$id_student = $_REQUEST['id_student'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$info_std=query("SELECT * FROM `students` WHERE `status` = '1' AND `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$id_faculty=$info_std[0]['id_faculty'];
		$id_s_l=$info_std[0]['id_s_l'];
		$id_s_v=$info_std[0]['id_s_v'];
		$id_course=$info_std[0]['id_course'];
		$id_spec=$info_std[0]['id_spec'];
		$id_group=$info_std[0]['id_group'];
		
		
		$nt = query("SELECT `id_nt` FROM `std_study_groups` WHERE 
		`status` = '1' AND
		`id_faculty` = '$id_faculty' AND 
		`id_s_l` = '$id_s_l' AND 
		`id_s_v` = '$id_s_v' AND 
		`id_course` = '$id_course' AND 
		`id_spec` = '$id_spec' AND 
		`id_group` = '$id_group' AND
		`s_y` = '$S_Y' AND
		`h_y` = '$H_Y'
		");
		
		$id_nt = $nt[0]['id_nt'];
		
		$semestr = getSemestr($id_course, H_Y);
		
		$qarzho = query("
		SELECT `nt_content`.*, `results`.*, ROUND(IFNULL(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`), 0), 2) as `score_total`
		
		FROM `nt_content` 
		LEFT JOIN `results` ON `nt_content`.`id_fan` = `results`.`id_fan`
		WHERE `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` <= $semestr AND
		`results`.`id_student` = $id_student AND
		`trimestr_score` IS NULL 
		
		HAVING
			`score_total` < 50.00 
		");
		
		
		/*
		$qarzho = query("SELECT *,IFNULL(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`), 0) as `score_total` FROM `results` WHERE 
		`id_faculty` = '$id_faculty' AND 
		`id_s_l` = '$id_s_l' AND 
		`id_s_v` = '$id_s_v' AND 
		`id_course` = '$id_course' AND 
		`id_spec` = '$id_spec' AND 
		`id_group` = '$id_group' AND 
		`id_student` = '$id_student' AND 
		`trimestr_score` IS NULL 
		
		HAVING
			`score_total` < 50.00 
		");
		
		print_arr($qarzho);
		exit;
		*/

		$ariza = query("SELECT * FROM `trimestr` WHERE `id_student` = '$id_student' ");
		
		$page_info['title'] = "Сохтани триместр";
	break;
	
	case "save_trimestr":
		$id_student = $_REQUEST['id_student'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$author = $_SESSION['user']['id'];
		$fans = $_REQUEST['fans'];
		$fans = implode(",", $fans);
		
		$info_std=query("SELECT * FROM `students` WHERE `status` = '1' AND `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$id_faculty=$info_std[0]['id_faculty'];
		$id_s_l=$info_std[0]['id_s_l'];
		$id_s_v=$info_std[0]['id_s_v'];
		$id_course=$info_std[0]['id_course'];
		$id_spec=$info_std[0]['id_spec'];
		$id_group=$info_std[0]['id_group'];
		$foreign=$info_std[0]['foreign'];
		
		$shartnoma = getSharnomaMoneyBySY($id_course, $id_spec, $id_s_l, $id_s_v, S_Y, $foreign);

		$id_nt = query("SELECT `id_nt` FROM `std_study_groups` WHERE `status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$id_nt = $id_nt[0]['id_nt'];
		
		$semestr = getSemestr($id_course, $H_Y);
		
		// $qarzho = query("
		// SELECT `nt_content`.*, `results`.*, ROUND(IFNULL(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`), 0), 2) as `score_total`
		
		// FROM `nt_content` 
		// LEFT JOIN `results` ON `nt_content`.`id_fan` = `results`.`id_fan` AND 
		// `nt_content`.`semestr` = `results`.`semestr`
		// WHERE `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` <= $semestr AND
		// `results`.`id_student` = $id_student AND
		// `trimestr_score` IS NULL 
		
		// HAVING
			// `score_total` < 50.00 
		// ");
		
		
		
		$qarzho = query2("SELECT *,IFNULL(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`), 0) as `score_total` 
						FROM `results` 
						WHERE `id_faculty` = '$id_faculty' AND 
							`id_s_l` = '$id_s_l' AND 
							`id_s_v` = '$id_s_v' AND 
							`id_course` = '$id_course' AND 
							`id_spec` = '$id_spec' AND 
							`id_group` = '$id_group' AND 
							`id_student` = '$id_student' AND 
							`id_fan` IN ($fans) AND 
							`trimestr_score` IS NULL AND 
							`s_y` = '$S_Y' AND 
							`h_y` = '$H_Y'
						HAVING
							`score_total` < 50.00 
					");

		
		///Сохтани аризаи триместр
		unset($data, $fields);
		$data['id_student'] = $id_student;
		$data['author'] = $author;
		$data['date'] = "'".date('Y-m-d')."'";
		$data['s_y'] = $qarzho[0]['s_y'];
		$data['h_y'] = $qarzho[0]['h_y'];
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		$id_trimestr = insert("trimestr", $fields, $data);				
		//exit;
		///Сохтани аризаи триместр

		//Сохтани контенти триместр
		$all_money = 0;
		foreach($qarzho as $q){
			$id_fan = $q['id_fan'];

			$test = query2("SELECT * FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
			
			
			$imt_type = $test[0]['imt_type'];

			$old_score = $q['score_total'];
			$c_f_u = getCreditiFaol($id_nt, $semestr, $id_fan);
			if($old_score >= 45 && $old_score < 50){
				$money = 0;
			}else{
				$money = $c_f_u * 64;					
				//$money = round($shartnoma / 60 * $c_f_u);					
			// echo "semest>".$semestr."shartnoma>".$shartnoma."cfu>".$c_f_u;
			// echo $money;
				// exit;
			}
			$all_money += $money;
			$type_lesson = '';
			$arr = array(606,634,1747,626,634,619);
			//$search = array_search($id_fan, $arr);
			
			if(array_search($id_fan, $arr) !== false){
				$type_lesson = 'am_plan';
			}else{
				$type_lesson = 'lk_plan';
			}
				$type_lesson = 'lk_plan';
			
			$id_teacher = query2("SELECT `id_teacher` FROM `sarboriho` 
									WHERE `id_iqtibos` = {$test[0]['id_iqtibos']} AND 
									`type` = '$type_lesson'
								");
			//exit;
			$id_teacher = $id_teacher[0]['id_teacher'];
			unset($data, $fields);
			$data['id_trimestr'] = $id_trimestr;
			$data['id_faculty'] = $id_faculty;
			$data['id_s_l'] = $id_s_l;
			$data['id_s_v'] = $id_s_v;
			$data['id_course'] = $id_course;
			$data['id_spec'] = $id_spec;
			$data['id_group'] = $id_group;
			$data['id_fan'] = $id_fan;
			$data['imt_type'] = $imt_type;
			$data['old_score'] = $old_score;
			//$data['c_u'] = $q['c_u'];
			$data['c_f_u'] = $c_f_u;
			$data['money'] = $money;
			$data['id_teacher'] = $id_teacher;
			$data['s_y'] = $q['s_y'];
			$data['h_y'] = $q['h_y'];
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			insert("trimestr_content", $fields, $data);
		}
		
		//Сохтани контенти триместр
		//Маблағи умумиро дар trimest апдейт мекунем.
		update_query("UPDATE `trimestr` SET `money` = '$all_money' WHERE `id` =  '$id_trimestr'");
		//Маблағи умумиро дар trimest апдейт мекунем.
		redirect();
	
	break;
	
	case "delete_trimestr":
		$id_trimestr=$_REQUEST['id_trimestr'];
		if($id_trimestr){
			delete("trimestr", "`id` = '$id_trimestr'");
			delete("trimestr_content", "`id_trimestr` = '$id_trimestr'");
		}
		redirect();
	break;
	
	case "khorijshudaho":
		$id_faculty = $_REQUEST['id_faculty'];
		$students = query("SELECT 
								s.*,
								users.*,
								sf.*
							FROM 
								students s
							INNER JOIN 
								stds_farmonho sf ON s.id_student = sf.id_student 
												 AND s.s_y = sf.s_y 
												 AND s.h_y = sf.h_y
							INNER JOIN 
								(SELECT MAX(id) AS max_id
								 FROM students
								 WHERE status = '0' 
								   AND id_faculty = '$id_faculty'
								 GROUP BY id_student) subq ON s.id = subq.max_id
							INNER JOIN users ON s.id_student = users.id
							WHERE 
								s.status = '0' 
								AND s.id_faculty = '$id_faculty'
							ORDER BY 
								s.id_s_l ASC,
								s.id_s_v ASC,
								s.s_y ASC,
								s.h_y ASC,
								s.id_course ASC,
								s.id_spec ASC,
								s.id_group ASC,
								users.fullname_tj ASC
						");
		$page_info['title'] = "Донишҷӯёни хориҷшуда аз факултети ".getFacultyShort($id_faculty);
	break;
	
	case "restore_student":
		$id_status0 = $_REQUEST['id_status0'];
		$infostd_status0 = query2("SELECT * FROM `students` WHERE `id` = '$id_status0'");
		$id_student = $infostd_status0[0]['id_student'];
		$author = $_SESSION['user']['id'];
		//exit;

		$data['id_student'] = "'".clear_admin($id_student)."'";
		$data['farmon_type'] = "'2'";
		$data['farmon_number'] = "'".clear_admin($_REQUEST['farmon_number'])."'";
		$data['farmon_date'] = "'".clear_admin($_REQUEST['farmon_date'])."'";
		$data['farmon_text'] = "'".clear_admin($_REQUEST['farmon_text'])."'";
		$data['farmon_add_time'] = "'".date('Y-m-d H:i:s')."'";
		$data['author'] = "'".clear_admin($author)."'";
		$data['s_y'] = "'".clear_admin(S_Y)."'";
		$data['h_y'] = "'".clear_admin(H_Y)."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		if(insert("stds_farmonho", $fields, $data)){	
			$fields = array('status' => "1", 
							'id_faculty' => $_REQUEST['id_faculty'],
							'id_course' => $_REQUEST['id_course'],
							'id_spec' => $_REQUEST['id_spec'],
							'id_group' => $_REQUEST['id_group'],
							's_y' => S_Y,
							'h_y' => H_Y
							);
			if(update("students", $fields, "`id` = '$id_status0'")){
				redirect();
			}
		}
		
	break;
	
}


?>