<?php


switch($action){
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		
		$students = getContingent(-1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		$page_info['title'] = 'Шуъбаи 2-юм '.getStudyView($id_s_v).' '.getCourse($id_course).' '.getSpecialtyCode($id_spec).' '.getGroup($id_group);
		
	break;
	
	case "updatebiometric":
		$id_student = $_REQUEST['id_student'];
		
		
		if($_FILES['photo']['name']){
			
			$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['photo']['name'])); // расширение картинки
			$baseimgName = "{$id_student}.{$baseimgExt}";
			$baseimgTmpName = $_FILES['photo']['tmp_name'];
			if(move_uploaded_file($baseimgTmpName, "../userfiles/students/$baseimgName")){
				
				$fields = array('photo' => $baseimgName);
				update("users", $fields, "`id` = '$id_student'");
			}
		}
		
		$check = query("SELECT * FROM `users_biometric` WHERE `id_user` = '$id_student'");
		
		unset($fields);
		
		if(empty($check)){
			$data['id_user'] = "'".clear_admin($id_student)."'";
			$data['scan1_finger1'] = "'".clear_admin($_REQUEST['scan1_finger1'])."'";
			$data['scan1_finger2'] = "'".clear_admin($_REQUEST['scan1_finger2'])."'";
			$data['scan2_finger1'] = "'".clear_admin($_REQUEST['scan2_finger1'])."'";
			$data['scan2_finger2'] = "'".clear_admin($_REQUEST['scan2_finger2'])."'";
			$data['added_by'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data['added_date'] = "'".clear_admin(date("Y-m-d H:i:s"))."'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			insert("users_biometric", $fields, $data);
		} else {
			$id = $_REQUEST['id'];
			
			$fields['scan1_finger1'] = $_REQUEST['scan1_finger1'];
			$fields['scan1_finger2'] = $_REQUEST['scan1_finger2'];
			$fields['scan2_finger1'] = $_REQUEST['scan2_finger1'];
			$fields['scan2_finger2'] = $_REQUEST['scan2_finger2'];
			$fields['updated_by'] = $_SESSION['user']['id'];
			$fields['updated_date'] = date("Y-m-d H:i:s");
			
			update("users_biometric", $fields, "`id` = '$id'");
			
		}
		redirect();
	break;
	
}


?>