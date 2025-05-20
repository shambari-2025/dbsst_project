<?php
	function getContingentSH2($id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $s_y, $h_y) {
		
			/* Баровардани контингенти гурух */
			$students = query2("
			SELECT 
				`students`.*,
				`users`.* 
			FROM `users`
			INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
			
			WHERE `students`.`status` = '1' 
			AND	`students`.`id_faculty` = '$id_faculty' AND `students`.`id_s_l` = '$id_s_l'
			AND `students`.`id_course` = '$id_course'
			AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
			AND `students`.`id_s_v` = '$id_s_v' 
			AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
			ORDER BY `users`.`fullname_tj`");
			/* Баровардани контингенти гурух */
			//exit;
			return $students;
		}

switch($action){
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$students = getContingentSH2($id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		
		$page_info['title'] = 'Ҷои кор: '.getStudyView($id_s_v).' '.getCourse($id_course).' '.getSpecialtyCode($id_spec).' '.getGroup($id_group);
	break;
	
	case "update_joikor":
		$id_student = $_REQUEST['id_student'];
		/*PASSPORT DATAS*/
		$fields_passport['joi_kor'] = $_REQUEST['joikor'];
		update("user_passports", $fields_passport, "`id_user` = '$id_student'");
		/*PASSPORT DATAS*/
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		redirect();			
	break;
}


?>