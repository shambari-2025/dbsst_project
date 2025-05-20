<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

$STUDY_YEARS = select("study_years", "*", "", "id", false, "");



switch($option){
	case "getGroups":
		define('MY_URL', $_REQUEST['my_url']);
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		
		$groups = "
		SELECT
			`std_study_groups`.*,
			`faculties`.`title` AS `faculty_title`,
			`faculties`.`short_title` AS `faculty_short`,
			`specialties`.`code` AS `spec_code`,
			`specialties`.`title_tj` AS `spec_title_tj`,
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
		WHERE ";
		
		if(!empty($id_faculty)){
			$groups .= "`std_study_groups`.`id_faculty` = '$id_faculty' AND ";
		}
		
		if(!empty($id_s_l)){
			$groups .= "`std_study_groups`.`id_s_l` = '$id_s_l' AND ";
		}
		
		if(!empty($id_s_v)){
			$groups .= "`std_study_groups`.`id_s_v` = '$id_s_v' AND ";
		}
		
		
		$groups .= "`std_study_groups`.`status` = '-1' AND `std_study_groups`.`s_y` = '".S_Y."'
		ORDER BY 
			`std_study_groups`.`id_faculty`, `std_study_groups`.`id_s_l`, `std_study_groups`.`id_s_v`,
			`std_study_groups`.`id_course`, `std_study_groups`.`id_spec`
		";
		
		
		$groups = query($groups);
		
		
		include("views/group_list_data.php");
		exit;
	break;
	
	case "getAddForm":
		define('MY_URL', $_REQUEST['my_url']);
		
		$faculties = query("SELECT * FROM `faculties` ORDER BY `id`");
		$studylevels = query("SELECT * FROM `study_level` ORDER BY `id`");
		$countries = select("countries", "*", "", "id", false, "");
		
		$all_teachers = query("SELECT * FROM `users` WHERE `access_type` IN (1,2) AND `id` NOT IN 
		(SELECT `id_user` FROM `commission_module` WHERE `s_y` = '".S_Y."')
		ORDER BY `fullname_tj`");
		
		include("ajax/addForm.php");
		exit;
	break;
	
	
	
	case "getEditForm":
		$id = $_REQUEST['id'];
		define('MY_URL', $_REQUEST['my_url']);
		
		$faculties = query("SELECT * FROM `faculties` ORDER BY `id`");
		$studylevels = query("SELECT * FROM `study_level` ORDER BY `id`");
		$countries = select("countries", "*", "", "id", false, "");
		
		$all_teachers = query("SELECT * FROM `users` WHERE `access_type` IN (1,2) ORDER BY `fullname_tj`");
		
		
		$commission = query("SELECT * FROM `commission_module` WHERE `id` = '$id'");
		
		include("ajax/editForm.php");
		exit;
	break;
	
	case "getAddDavrForm":
		define('MY_URL', $_REQUEST['my_url']);
		
		
		include("ajax/getAddDavrForm.php");
		exit;
	break;
	
	
	case "getEditDavrForm":
		$id = $_REQUEST['id'];
		define('MY_URL', $_REQUEST['my_url']);
		
		$davr = query("SELECT * FROM `davrho` WHERE `id` = '$id' AND `s_y` = '".S_Y."'");
		
		include("ajax/getEditDavrForm.php");
		exit;
	break;
	
	case "getDatas":
		$date_start = $_REQUEST['date_start'].' 00:00:00';
		$date_finish = $_REQUEST['date_finish'].' 23:59:59';
		
		define('MY_URL', $_REQUEST['my_url']);
		
		include("views/statistic_data.php");
		exit;
	break;
	
	case "getMMTNumber":
		if(isset($_REQUEST['fullname']))
			$fullname = trim(@$_REQUEST['fullname']);
		if(isset($_REQUEST['passport']))
			$passport = trim(@$_REQUEST['passport']);
		
		$id_davr = trim(@$_REQUEST['id_davr']);
		
		
		$check = query("SELECT * FROM `davrho` WHERE `id` = $id_davr AND `file` IS NOT NULL");
		
		if(!empty($check)){
		
			$file_to_open = $_SERVER['DOCUMENT_ROOT']."/userfiles/davrho/davr_$id_davr.json";
			$jsonData = file_get_contents($file_to_open);
			
			$new_data = json_decode($jsonData, true);
			
			//print_arr($new_data);
			
			
			if(isset($new_data[@$passport])){
				$result['mmtNumber'] = $new_data[$passport]['mmtNumber'];
				$result['name'] = $new_data[$passport]['name'];
				$result['birthday'] = $new_data[$passport]['birthday'];
				$result['jins'] = $new_data[$passport]['jins'];
				$result['country'] = $new_data[$passport]['country'];
				$result['nation'] = $new_data[$passport]['nation'];
				$result['region'] = $new_data[$passport]['region'];
				$result['district'] = $new_data[$passport]['district'];
				$result['sanai_dodani_passport'] = $new_data[$passport]['sanai_dodani_passport'];
				$result['maqomot'] = $new_data[$passport]['maqomot'];
				$result['current_address'] = $new_data[$passport]['current_address'];
				/*
				$result['number_scholl'] = $new_data[$passport]['number_scholl'];
				
				$hj = explode(" ", $new_data[$passport]['hujjati_xatm']);
				
				$hujjati_xatm = mb_substr(trim($hj[0]),0,-1);
				$silsila = trim($hj[1]);
				$number = mb_substr(trim($hj[2]), 1);
				
				$result['hujjati_xatm'] = $hujjati_xatm;
				$result['silsila'] = $silsila;
				$result['number_hujjat'] = $number;
				
				$result['soli_xatm'] = $new_data[$passport]['soli_xatm'];
				*/
				$result['phone'] = $new_data[$passport]['phone'];
				$result['parent_phone'] = $new_data[$passport]['parent_phone'];
				
				$code = substr($new_data[$passport]['spec'], 0, 1)."-".substr($new_data[$passport]['spec'], 1);
				
				$spec = query("SELECT * FROM `specialties` WHERE `id_s_l` = 1 AND `code` = '$code'");
				
				$result['id_faculty'] = @$spec[0]['id_faculty'];
				$result['id_spec'] = @$spec[0]['id'];
				
				//$result['title_spec'] = $new_data[$passport]['title_spec'];
				$result['id_s_v'] = $new_data[$passport]['id_s_v'];
				
				if($result['id_s_v'] == 2){
					$result['id_faculty'] = 8;
					$spec = query("SELECT * FROM `specialties` WHERE `id_faculty` = '{$result['id_faculty']}' AND `id_s_l` = 1 AND `code` = '$code'");
					$result['id_spec'] = @$spec[0]['id'];
				}
				
				
				$result['id_s_t'] = $new_data[$passport]['id_s_t'];
				$result['score'] = $new_data[$passport]['score'];
				
				$info = "Ихтисос: <b>{$new_data[$passport]['spec']}</b> <br>
				Намуди таҳсил: <b>{$new_data[$passport]['id_s_v']}</b> <br>
				Шакли таҳсил: <b>{$new_data[$passport]['id_s_t']}</b>
				";
				
				echo json_encode($result);
			
			}elseif(isset($fullname)){
				foreach ($new_data as $key => $record) {
					if ($record['name'] == $fullname) {
						//print_arr($record); // Return the matching record
						
						$result['mmtNumber'] = $record['mmtNumber'];
						$result['name'] = $record['name'];
						if(!empty($record['birthday']))
							$result['birthday'] = $record['birthday'];
						if(!empty($record['jins']))
							$result['jins'] = $record['jins'];
						$result['country'] = $record['country'];
						if(!empty($record['nation']))
							$result['nation'] = $record['nation'];
						if(!empty($record['region']))
							$result['region'] = $record['region'];
						if(!empty($record['district']))
							$result['district'] = $record['district'];
						if(!empty($record['sanai_dodani_passport']))
							$result['sanai_dodani_passport'] = $record['sanai_dodani_passport'];
						if(!empty($record['maqomot']))
							$result['maqomot'] = $record['maqomot'];
						if(!empty($record['passport']))
							$result['passport'] = $record['passport'];
						if(!empty($record['current_address']))
							$result['current_address'] = $record['current_address'];
						/*
						$result['number_scholl'] = $record['number_scholl'];
						
						$hj = explode(" ", $record['hujjati_xatm']);
						
						$hujjati_xatm = mb_substr(trim($hj[0]),0,-1);
						$silsila = trim($hj[1]);
						$number = mb_substr(trim($hj[2]), 1);
						
						$result['hujjati_xatm'] = $hujjati_xatm;
						$result['silsila'] = $silsila;
						$result['number_hujjat'] = $number;
						
						$result['soli_xatm'] = $record['soli_xatm'];
						*/
						$result['phone'] = $record['phone'];
						$result['parent_phone'] = $record['parent_phone'];
						
						$code = substr($record['spec'], 0, 1)."-".substr($record['spec'], 1);
						
						$spec = query("SELECT * FROM `specialties` WHERE `id_s_l` = 1 AND `code` = '$code'");
						
						$result['id_faculty'] = @$spec[0]['id_faculty'];
						$result['id_spec'] = @$spec[0]['id'];
						
						//$result['title_spec'] = $record['title_spec'];
						$result['id_s_v'] = $record['id_s_v'];
						$result['id_s_t'] = $record['id_s_t'];
						if(!empty($record['score']))
							$result['score'] = $record['score'];
						
						$info = "Ихтисос: <b>{$record['spec']}</b> <br>
						Намуди таҳсил: <b>{$record['id_s_v']}</b> <br>
						Шакли таҳсил: <b>{$record['id_s_t']}</b>
						";
						echo json_encode($result);
					}
				}
			}else {
				$result['error'] = true;
				echo json_encode($result);
			}
		}else{
			$result['error'] = true;
			echo json_encode($result);
		}
		exit;
	break;
	
	case "getstudenteditform":
		$id_student = $_REQUEST['id_student'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$student = query("SELECT `student_mmt_information`.*, `user_udecation`.*, `user_passports`.*, `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		
		define('MY_URL', $_REQUEST['my_url']);
		
		
		if(MY_URL == URL.'admin/'){
			$faculties = query("SELECT * FROM `faculties` ORDER BY `id`");
		}else {
			$commission = query("SELECT * FROM `commission_module` WHERE `id_user` = '{$_SESSION['user']['id']}'");
			if($commission[0]['id_faculties'] == 'ALL'){
				$where = "";
			}else {
				$where = "WHERE `id` IN ({$commission[0]['id_faculties']})";
			}
			$faculties = query("SELECT * FROM `faculties` $where ORDER BY `id`");
		}
		
		
		$studylevels = select("study_level", "*", "", "id", false, "");
		$studyviews = select("study_view", "*", "", "id", false, "");
		$studytypes = select("study_type", "*", "", "id", false, "");
		
		$id_faculty = $student[0]['id_faculty'];
		$id_s_v = $student[0]['id_s_v'];
		$id_course = $student[0]['id_course'];
		$id_spec = $student[0]['id_spec'];
		$id_s_l = $student[0]['id_s_l'];
		
		$old_nt = query("SELECT * FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND 
		`id_spec` = '$id_spec' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		$id_nt = $old_nt[0]['id_nt'];
		
		$specs = select("specialties", "*", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l'", "id", false, "");
		
		$courses = select("course", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "id", false, "");
		
		$countries = select("countries", "*", "", "id", false, "");
		$regions = select("regions", "*", "", "id", false, "");
		
		$id_region = $student[0]['id_region'];
		
		$districts = select("districts", "*", "`id_region` = '$id_region'", "name", false, "");
		
		$nations = select("nations", "*", "", "id", false, "");
		$vazi_oilavi = select("vazi_oilavi", "*", "", "id", false, "");
		
		$davrho = query("SELECT * FROM `davrho` WHERE `s_y` = '".S_Y."' ORDER BY `id`");
		
		include("ajax/getstudenteditform.php");
		exit;
	break;
	
	
	case "getstudentdeleteform":
		$id_student = $_REQUEST['id_student'];
		$s_y = S_Y;
		$h_y = H_Y;
		
		$student = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
		ORDER BY `users`.`fullname`
		");
		
		define('MY_URL', $_REQUEST['my_url']);
		
		include("ajax/getstudentdeleteform.php");
		exit;
	break;
	
	case "forIntiqol":
		$id_student = $_REQUEST['id_student'];
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_spec = $_REQUEST['id_spec'];
		$id_s_v = $_REQUEST['id_s_v'];
		
		$info = select("students", "*", "`id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id", false, "");
		
		if($id_faculty == $info[0]['id_faculty'] && $id_s_l == $info[0]['id_s_l'] && $id_spec == $info[0]['id_spec'] && $id_s_v == $info[0]['id_s_v']){
			echo "dontshow";
		}else echo "showit";
		exit;
	break;
	
	case "getSpecs":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		
		$specs = select("specialties", "*", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l'", "id", false, "");
		
		include("ajax/specsforfaculty.php");
		exit;
	break;
	
	
	case "getShartnomaMoney":
		$S_Y = S_Y;
		$id_spec = $_REQUEST['id_spec'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$other = $_REQUEST['other'];
		
		$query = query("SELECT `qabul_plan`.*, `qabul_plan_detail`.* FROM `qabul_plan_detail` 
					INNER JOIN `qabul_plan` ON `qabul_plan_detail`.`id_qabul_plan` = `qabul_plan`.`id`
					WHERE `qabul_plan_detail`.`id_s_t` = '1' AND `qabul_plan`.`s_y` = '$S_Y' 
					AND `qabul_plan_detail`.`id_spec` = '$id_spec' AND `qabul_plan_detail`.`id_s_l` = '$id_s_l'
					AND `qabul_plan_detail`.`id_s_v` = '$id_s_v'
					");
		
		if($other == 'xoriji'){
			if(!empty($query))
				echo $query[0]['money_other'];
		}else {
			if(!empty($query))
				echo $query[0]['money'];
		}
		exit;
	break;
	
	
	
	case "getSemestr":
		$id_course = $_REQUEST['id_course'];
		
		if($id_course == 1){
			$start = S_Y;
			$start_course = $id_course;
		}else{
			$s_y_info = select("study_years", "*", "", "id", true, "1");
			
			
			$start = $s_y_info[0]['id'];
			$start_course = $id_course;
		}
		
		if(H_Y == 1)
			$h_y_end = 1;
		else
			$h_y_end = 2;
		
		include("ajax/semestrs.php");
		exit;
	break;
	
	
	case "getDistricts":
		$id_region = $_REQUEST['id_region'];
		
		$districts = select("districts", "*", "`id_region` = '$id_region'", "name", false, "");
		include("ajax/districts.php");
		exit;
	break;
	
	
	case "getRegions":
		$id_country = $_REQUEST['id_country'];
		
		$regions = select("regions", "*", "`id_country` = '$id_country'", "name", false, "");
		include("ajax/regions.php");
		exit;
	break;
	
	case "makeLogin":
		
		$id_faculty = $_REQUEST['id_faculty'];
		
		$data = query("SELECT `users`.*, `students`.* FROM `users` 
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		WHERE 
			`students`.`id_faculty` = '$id_faculty' AND 
			`students`.`s_y` = '".S_Y."' ORDER BY `users`.`id` DESC LIMIT 1");
		
		if(empty($data)){
			$login = date("Y").sprintf("%02d", $id_faculty).sprintf("%04d", 1);
		}else{
			$login = $data[0]['login'] + 1;
		}
		
		
		if($login){
			$result = $login;
		}else{
			$result = 'error';
		}
		echo $result;
		exit;
	break;
	
	case "isBusylogin":
		$login = @strval($_REQUEST['login']);
		$id_student = $_REQUEST['id_student'];
		
		echo Mybusylogin($login, $id_student);
		exit;
	break;
	
	case "getShartnomaForm":
		$id_student = $_REQUEST['id_student'];
		$id_spec = $_REQUEST['id_spec'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_s_l = $_REQUEST['id_s_l'];
		$foreign = $_REQUEST['foreign'];
		$S_Y = S_Y;
		define('MY_URL', $_REQUEST['my_url']);
		
		$checks = query("SELECT * FROM `rasidho` WHERE `id_student` = '$id_student' ORDER BY `id` DESC");
		
		
		
		$query = query("SELECT `qabul_plan`.*, `qabul_plan_detail`.* FROM `qabul_plan_detail` 
					INNER JOIN `qabul_plan` ON `qabul_plan_detail`.`id_qabul_plan` = `qabul_plan`.`id`
					WHERE `qabul_plan_detail`.`id_s_t` = '1' AND `qabul_plan`.`s_y` = '$S_Y' 
					AND `qabul_plan_detail`.`id_spec` = '$id_spec' AND `qabul_plan_detail`.`id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v'");
		
		if(!empty($query)){
			if($foreign!=null && $foreign!=''){
				$money = $query[0]['money_other'];
			} else {
				$money = $query[0]['money'];
			}
		}else{
			echo "Дар нақшаи қабул маълумот оиди маблағи таҳсилот нест!";
		}
		
		include("ajax/getShartnomaForm.php");
		exit;
	break;
	
}


?>