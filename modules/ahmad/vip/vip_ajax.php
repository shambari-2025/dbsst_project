<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];


switch($option){
	case "getStudenList":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		$id_s_v = 2; // 1-рӯзона, 2 - фосилавӣ
		
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		
		/* Баровардани контингенти гурух */
		$students = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE `students`.`id_student` = `users`.`id`
		AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
		AND `students`.`id_s_v` = '$id_s_v' 
		AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
		ORDER BY `users`.`fullname`
		");
		/* Баровардани контингенти гурух */
		
		include("ajax/studen_list.php");
		exit;
	break;
	
	case "addVIP":
		$id_student = $_REQUEST['id_student'];
		$text = $_REQUEST['text'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		$data['id_student'] = "'".clear_admin($id_student)."'";
		$data['text'] = "'".clear_admin($text)."'";
		$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
		$data['s_y'] = "'".clear_admin($s_y)."'";
		$data['h_y'] = "'".clear_admin($h_y)."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		insert("_vip_list", $fields, $data);
		
		$page_info['title'] = "ADD to VIP: ".getUserName($id_student). ": $s_y: $h_y";
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		echo "ok";
		exit;
	break;
	
	case "deleteVIP":
		$id_student = $_REQUEST['id_student'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		delete("_vip_list", "`id_student` = '$id_student' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		$page_info['title'] = "DELETE from VIP: ".getUserName($id_student). ": $s_y: $h_y";
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		echo "ok";
		exit;
	break;
	
}


?>