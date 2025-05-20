<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "getSpecs":
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_course = $_REQUEST['id_course'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		$specs = query("
		SELECT * FROM `specialties` WHERE `id` IN
		(SELECT `id_spec` FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty'
		AND `id_course` = '$id_course' AND `s_y` = '$s_y' AND `h_y` = '$h_y')
		");
		
		include("ajax/specsforfaculty.php");
		exit;
	break;
	
	
	case "getFanFromNT":
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		
		if(!empty($id_spec)){
			$info = query("SELECT `*` FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty'
			AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
			
			$id_nt = $info[0]['id_nt'];
			
			$fanho = query("
			SELECT * FROM `fan` WHERE `id` IN
			(SELECT `id_fan` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `id_course` = '$id_course' AND `h_y` = '$h_y')
			ORDER BY `id`");
			
			
			$teachers = query("SELECT * FROM `users` WHERE `access_type` != '3' ORDER BY `fullname`");
			include("ajax/fanlist.php");
		}
		exit;
	break;
	
	
	case "getNewRow":
		$fanho = select("fan", "*", "", "title", false, "");
		include("ajax/credit_part.php");
		exit;
	break;
	
}


?>