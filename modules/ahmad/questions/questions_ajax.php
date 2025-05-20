<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];


switch($option){
	case "addForm":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		
		$id_faculty = $data_iq[0]['id_faculty'];
		$id_s_l = $data_iq[0]['id_s_l'];
		$id_s_v = $data_iq[0]['id_s_v'];
		$id_course = $data_iq[0]['id_course'];
		$id_spec = $data_iq[0]['id_spec'];
		$id_group = $data_iq[0]['id_group'];
		$semestr = $data_iq[0]['semestr'];
		
		$id_departament = $data_iq[0]['id_departament'];
		$id_fan = $data_iq[0]['id_fan'];
		
		$S_Y = S_Y;
		
		
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
			`std_study_groups`.`id_faculty` = '$id_faculty' AND `std_study_groups`.`id_course` = '$id_course' AND 
			`std_study_groups`.`id_spec` = '$id_spec' AND `std_study_groups`.`id_group` = '$id_group' AND 
			`std_study_groups`.`id_s_v` = '$id_s_v' AND `std_study_groups`.`s_y` = '".S_Y."' AND `std_study_groups`.`h_y` = '".H_Y."'
					
		");
		
		$lang = $group_options[0]['lang'];
		
		
		define("MY_URL", $_REQUEST['my_url']);
		
		
		
		include("ajax/addform.php");
		exit;
	break;
	
	case "updateRating":
		$id = $_REQUEST['id'];
		$rating = $_REQUEST['rating'];
		
		$fields['rating'] = $rating;
		update("questions", $fields, "`id` = '$id'");
		exit;
	break;
	
}


?>