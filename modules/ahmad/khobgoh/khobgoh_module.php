<?php


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
	case "create_check":
		$id_user = $_REQUEST['id_user'];
		
		/*RASID*/
		$table = "rasidho";
		$rasid_data['type'] =  $_REQUEST['type'];
		$rasid_data['id_student'] = "'".clear_admin($id_user)."'";
		$rasid_data['check_date'] = "'".clear_admin(date("Y-m-d"))."'";
		$rasid_data['check_money'] = "'".clear_admin($_REQUEST['check_money'])."'";
		$rasid_data['s_y'] = "'".clear_admin(S_Y)."'";
		$rasid_data['author'] = "'".$_SESSION['user']['id']."'";
		
		$rasid_fields = array_keys($rasid_data);
		$rasid_data = implode(",", $rasid_data);
		insert($table, $rasid_fields, $rasid_data);
		/*RASID*/
		
		redirect();
	break;
	case "delete_user":
		$id_user = $_REQUEST['id'];
		delete("khobgoh", "`id_user` = '$id_user' AND `s_y` = '".S_Y."'");
		redirect();
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
		$data['access_type'] = 6; // 6 - истиқоматкунандаи хоббгоҳ
		
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
			$passport_data['id_country'] = "'".clear_admin($_REQUEST['id_country'])."'";
			
			$passport_data['id_region'] = "'".clear_admin($_REQUEST['id_region'])."'";
			$passport_data['id_district'] = "'".clear_admin($_REQUEST['id_district'])."'";
						
			$passport_fields = array_keys($passport_data);
			$passport_data = implode(",", $passport_data);
			
			insert($table, $passport_fields, $passport_data);
			/*PASSPORT DATAS*/
			
			/*KHOBGOH DARAS*/
			$table = "khobgoh";
			$khobgoh_data['id_khobgoh'] =  $_REQUEST['type'];
			$khobgoh_data['id_user'] = "'".clear_admin($id_teacher)."'";
			$khobgoh_data['number_home'] = "'".clear_admin($_REQUEST['number_home'])."'";
			$khobgoh_data['s_y'] = "'".clear_admin(S_Y)."'";
			$khobgoh_data['author'] = "'".$_SESSION['user']['id']."'";
			
			$khobgoh_fields = array_keys($khobgoh_data);
			$khobgoh_data = implode(",", $khobgoh_data);
			insert($table, $khobgoh_fields, $khobgoh_data);
			/*KHOBGOH DARAS*/	
			
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
	case "order_khobgoh":
		$id_student = $_REQUEST['id_student'];	
		/*RASID*/
		$table = "khobgoh";
		$khobgoh_data['id_khobgoh'] =  $_REQUEST['type'];
		$khobgoh_data['id_user'] = "'".clear_admin($id_student)."'";
		$khobgoh_data['number_home'] = "'".clear_admin($_REQUEST['number_home'])."'";
		$khobgoh_data['s_y'] = "'".clear_admin(S_Y)."'";
		$khobgoh_data['author'] = "'".$_SESSION['user']['id']."'";
		
		$khobgoh_fields = array_keys($khobgoh_data);
		$khobgoh_data = implode(",", $khobgoh_data);
		insert($table, $khobgoh_fields, $khobgoh_data);
		/*RASID*/
		
		redirect();
	break;
	case "order_omuzgor":
		$id_student = $_REQUEST['id_techer'];	
		/*RASID*/
		$table = "khobgoh";
		$khobgoh_data['id_khobgoh'] =  $_REQUEST['type'];
		$khobgoh_data['id_user'] = "'".clear_admin($id_techer)."'";
		$khobgoh_data['number_home'] = "'".clear_admin($_REQUEST['number_home'])."'";
		$khobgoh_data['s_y'] = "'".clear_admin(S_Y)."'";
		$khobgoh_data['author'] = "'".$_SESSION['user']['id']."'";
		
		$khobgoh_fields = array_keys($khobgoh_data);
		$khobgoh_data = implode(",", $khobgoh_data);
		insert($table, $khobgoh_fields, $khobgoh_data);
		/*RASID*/
		
		redirect();
	break;
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		$students = getContingent(false, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		$page_info['title'] = 'Хобгоҳ / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group);
		
	break;
	
	case "list_khobgoh":
		if(isset($_REQUEST['letter'])){
			$q = " AND `fullname_tj` LIKE '".$_REQUEST['letter']."%'";
			$page_info['title'] = 'Истиқоматкунандагон: '.$_REQUEST['letter'];
		} else {
			$q = '';
			$page_info['title'] = 'Истиқоматкунандагон';
		}
		
		$teachers = query("SELECT `users`.*, `khobgoh`.`id_khobgoh`, `khobgoh`.`number_home` FROM `users` 
		INNER JOIN `khobgoh` ON `khobgoh`.`id_user` = `users`.`id`
		WHERE `access_type` IN (2,3,4,5,6)  $q ORDER BY `access_type`, `fullname_tj`");
		
	break;
	
	case "list_omuzgor":
		if(isset($_REQUEST['letter'])){
			$q = " AND `fullname_tj` LIKE '".$_REQUEST['letter']."%'";
			$page_info['title'] = 'Руйхати омӯзгорҳо: '.$_REQUEST['letter'];
		} else {
			$q = '';
			$page_info['title'] = 'Руйхати омӯзгорҳо';
		}
		
		$teachers = query("SELECT * FROM `users` WHERE `access_type` IN (2,6)  $q ORDER BY `access_type`, `fullname_tj`");
		
	break;
}


?>