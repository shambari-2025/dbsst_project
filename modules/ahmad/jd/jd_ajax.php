<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "active":
		$id = $_REQUEST['id'];
		$status = $_REQUEST['set'];
		
		$fields = ['active' => "$status"];
		
		if(update('jd', $fields, "`id` = '$id'"))
			echo true;
		else
			echo false;
		exit;
	break;
	
	case "editForm":
		$id = $_REQUEST['id'];
		$query = query("SELECT * FROM `jd` WHERE `id` = '$id'");
		
		$id_faculty = $query[0]['id_faculty'];
		$id_course = $query[0]['id_course'];
		$id_spec = $query[0]['id_spec'];
		$id_group = $query[0]['id_group'];
		$h_y = $query[0]['h_y'];
		
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		$group_options = select("std_study_groups", array("id_nt", "lang"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id", false, "");
		$id_nt = @$group_options[0]['id_nt'];
		$lang = @$group_options[0]['lang'];
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		
		define("MY_URL", $_REQUEST['my_url']);
		
		$fanho = query("
		SELECT * FROM `fan` WHERE `id` IN
		(SELECT `id_fan` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `id_course` = '$id_course' AND `h_y` = '$h_y')
		ORDER BY `id`");
		
		
		$teachers = query("SELECT * FROM `users` WHERE `access_type` != '3' ORDER BY `fullname_tj`");
		
		include("ajax/editForm.php");
		exit;
	break;
	
	case "getSpecs":
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_course = $_REQUEST['id_course'];
		$id_s_l = $_REQUEST['id_s_l'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		$specs = query2("
		SELECT * FROM `specialties` WHERE `id` IN
		(SELECT `id_spec` FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty'
		AND `id_course` = '$id_course' AND `id_s_l`='$id_s_l' AND `s_y` = '$s_y' AND `h_y` = '$h_y')
		");
		
		include("ajax/specsforfaculty.php");
		exit;
	break;
	
	
	case "getFanFromNT":
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		
		if(!empty($id_spec)){
			$info = query("SELECT * FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty'
			AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
			
			$id_nt = $info[0]['id_nt'];
			
			$semestr = getSemestr($id_course, $h_y);
			$fanho = query("
			SELECT * FROM `fan_test` WHERE `id` IN
			(SELECT `id_fan` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$semestr')
			OR `id`IN
			(SELECT `id_fan` FROM `jd` WHERE `id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$s_y' AND `h_y` = '$h_y')
			ORDER BY `id`
			") ;
			/*$fanho = query("
			SELECT * FROM `fan_test` WHERE `id` IN
			(SELECT `id_fan` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$semestr')
			AND `id` NOT IN
			(SELECT `id_fan` FROM `jd` WHERE `id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$s_y' AND `h_y` = '$h_y')
			ORDER BY `id`
			") ;*/
			
			$teachers = query("SELECT * FROM `users` WHERE `access_type` != '3' ORDER BY `fullname_tj`");
			
			$l_type = query("SELECT * FROM `lessons_type`");
			
			include("ajax/fanlist.php");
		}
		exit;
	break;
	
	
	case "getNewRow":
		$fanho = select("fan", "*", "", "title_tj", false, "");
		include("ajax/credit_part.php");
		exit;
	break;
	
}


?>