<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "updateSetting":
		$id_fan = $_REQUEST['id_fan'];
		$field = $_REQUEST['field'];
		$value = $_REQUEST['value'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		$check = query("SELECT `id` FROM `tests_settings` WHERE `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		if(empty($check)){
			$data['id_fan'] = "'$id_fan'";
			$data[$field] = "'$value'";
			$data['s_y'] = "'$s_y'";
			$data['h_y'] = "'$h_y'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			insert('tests_settings', $fields, $data);
		}else{
			$id = $check[0]['id'];
			$fields[$field] = $value;
		
			update("tests_settings", $fields, "`id` = '$id'");
		}
		
		print_arr($_REQUEST);
		
		exit;
	break;
	case "UpdateType":
		$id = $_REQUEST['id'];
		
		$fields['imt_type'] = $_REQUEST['imt_type'];
		
		update("tests", $fields, "`id` = '$id'");
		exit;
	break;
	
	case "UpdateTestType":
		$id = $_REQUEST['id'];
		
		$fields['test_type'] = $_REQUEST['test_type'];
		
		update("tests", $fields, "`id` = '$id'");
		exit;
	break;
	
	case "UpdateDate":
		$id = $_REQUEST['id'];
		$field = $_REQUEST['field'];
		
		$fields[$field] = $_REQUEST['datetime'];
		
		update("tests", $fields, "`id` = '$id'");
		exit;
	break;
	
	case "statisticTest":
		$id_fan = $_REQUEST['id_fan'];
		
		include("ajax/statisticTest.php");
		exit;
	break;
	
	case "status":
		$id = $_REQUEST['id'];
		$status = $_REQUEST['set'];
		
		$fields = [
			'status' => "$status"
		];
		
		if(update('tests', $fields, "`id` = '$id'"))
			echo true;
		else
			echo false;
		exit;
	break;
	
	
	case "editForm":
		$id = $_REQUEST['id'];
		define("MY_URL", $_REQUEST['my_url']);
		
		
		$test = query("SELECT * FROM `tests` WHERE `id` =  '$id'");
		
		
		include("ajax/editForm.php");
		exit;
	break;
	
	/*IIIIIIIIIIIIII*/
	case "getFans":
		$h_y = $_REQUEST['h_y'];
		$fans = query("SELECT *	FROM `fan_test`	WHERE `id` IN(SELECT DISTINCT(`id_fan`)	FROM `questions` WHERE `h_y` = '$h_y') ORDER BY	`title_tj`");
		include("ajax/getFans.php");
		exit;
	break;
	
	case "getAuthors":
		$h_y = $_REQUEST['h_y'];
		$id_fan = $_REQUEST['id_fan'];
		$authors = query("SELECT `id`, `fullname_tj` FROM `users` WHERE `id` IN(SELECT DISTINCT(`author`) FROM `questions` WHERE `id_fan` = '$id_fan' AND `h_y` = '$h_y') ORDER BY	`fullname_tj`");
		include("ajax/getAuthors.php");
		exit;
	break;
	
	case "getLang":
		$h_y = $_REQUEST['h_y'];
		$id_fan = $_REQUEST['id_fan'];
		$author = $_REQUEST['author'];
		$zabon = query("SELECT DISTINCT(`lang`) FROM `questions` WHERE `id_fan` = '$id_fan' AND `h_y` = '$h_y' AND `author` = '$author'");
		include("ajax/getLang.php");
		exit;
	break;
	
	case "getRating":
		$h_y = $_REQUEST['h_y'];
		$id_fan = $_REQUEST['id_fan'];
		$author = $_REQUEST['author'];
		$zabon = $_REQUEST['zabon'];
		$rating = query("SELECT DISTINCT(`rating`) FROM `questions` WHERE `id_fan` = '$id_fan' AND lang = '$zabon' AND `h_y` = '$h_y' AND `author` = '$author'");
		include("ajax/getRating.php");
		exit;
	break;
	
	case "getQuests":
		$h_y = $_REQUEST['h_y'];
		$id_fan = $_REQUEST['id_fan'];
		$author = $_REQUEST['author'];
		$zabon = $_REQUEST['lang'];
		$rating = $_REQUEST['rating'];
		$questions = query2("SELECT * FROM `questions` WHERE `id_fan` = '$id_fan' AND `h_y` = '$h_y' AND `author` = '$author' AND `lang` = '$zabon' AND `rating` = '$rating'");
		include("ajax/getQuests.php");
		exit;
	break;
	
	case "getSpecs":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		
		$specs = query("SELECT DISTINCT (`id_spec`) FROM `std_study_groups` 
						WHERE `id_faculty` = '$id_faculty' AND 
							`id_s_l` = '$id_s_l' AND 
							`id_s_v` = '$id_s_v' AND 
							`id_course` = '$id_course' AND 
							`s_y` = '".S_Y."' AND 
							`h_y` = '".H_Y."'
						ORDER BY `id_spec`
						");
		include("ajax/getSpecs.php");
		exit;
	break;
	
	case "getGroups":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec  = $_REQUEST['id_spec'];
		$groups = query("SELECT DISTINCT (`id_group`) FROM `std_study_groups` 
						WHERE `id_faculty` = '$id_faculty' AND 
							`id_s_l` = '$id_s_l' AND 
							`id_s_v` = '$id_s_v' AND 
							`id_course` = '$id_course' AND 
							`id_spec` = '$id_spec' AND 
							`s_y` = '".S_Y."' AND 
							`h_y` = '".H_Y."'
						ORDER BY `id_group`
						");
		include("ajax/getGroups.php");
		exit;
	break;
	
	case "getFan":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec  = $_REQUEST['id_spec'];
		$id_group  = $_REQUEST['id_group'];
		$semestr = getSemestr($id_course, H_Y);
		$fans = query("SELECT * FROM `iqtibosho` 
						WHERE `id_faculty` = '$id_faculty' AND 
							`id_s_l` = '$id_s_l' AND 
							`id_s_v` = '$id_s_v' AND 
							`id_course` = '$id_course' AND 
							`id_spec` = '$id_spec' AND 
							`id_group` = '$id_group' AND 
							`s_y` = '".S_Y."' AND 
							`semestr` = '$semestr' AND
							`id_fan` != 1748
						ORDER BY `id_group`
						");
		include("ajax/getFan.php");
		exit;
	break;
	
	case "getTeachers":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec  = $_REQUEST['id_spec'];
		$id_group  = $_REQUEST['id_group'];
		$semestr = getSemestr($id_course, H_Y);
		$id_fan = $_REQUEST['id_fan'];
		$teachers = query("SELECT DISTINCT(`sarboriho`.`id_teacher`), `iqtibosho`.* FROM `iqtibosho` 
						INNER JOIN `sarboriho` ON `iqtibosho`.`id` = `sarboriho`.`id_iqtibos`
						WHERE `iqtibosho`.`id_faculty` = '$id_faculty' AND 
							`iqtibosho`.`id_s_l` = '$id_s_l' AND 
							`iqtibosho`.`id_s_v` = '$id_s_v' AND 
							`iqtibosho`.`id_course` = '$id_course' AND 
							`iqtibosho`.`id_spec` = '$id_spec' AND 
							`iqtibosho`.`id_group` = '$id_group' AND 
							`iqtibosho`.`s_y` = '".S_Y."' AND 
							`iqtibosho`.`semestr` = '$semestr' AND
							`iqtibosho`.`id_fan` = '$id_fan'
						");
		include("ajax/getTeachers.php");
		exit;
	break;
	/*IIIIIIIIIIIIII*/
	
}


?>