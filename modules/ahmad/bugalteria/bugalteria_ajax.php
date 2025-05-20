<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

$STUDY_YEARS = select("study_years", "*", "", "id", false, "");



switch($option){
	
	case "getDatas":
		$date = date("d.m.Y", strtotime($_REQUEST['date']));
		
		define('MY_URL', $_REQUEST['my_url']);
		
		include("views/statistic_data.php");
		exit;
	break;
	
	case "getMMTNumber":
		$name = trim($_REQUEST['fullname']);
		
		function clearPhone($n){
			$search = ['(', ') ', '-', ''];
			$replace = ['', '', '', ''];
			$n = str_replace($search, $replace, $n);
			return $n;
		}
		
		
		$data = explode("\n", file_get_contents("data.txt"));
		
		$new_data = [];
		foreach($data as $item){
			$t = explode("	", $item);
			
			$new_data[$t[1]]['mmtNumber'] = trim($t[0]);
			$new_data[$t[1]]['name'] = trim($t[1]);
			$new_data[$t[1]]['phone'] = clearPhone(trim($t[2]));
			$new_data[$t[1]]['parent_phone'] = '+992'.clearPhone(trim($t[3]));
			$new_data[$t[1]]['spec'] = trim($t[4]);
			$new_data[$t[1]]['title_spec'] = trim($t[5]);
			$new_data[$t[1]]['id_s_v'] = trim($t[6]);
			$new_data[$t[1]]['id_s_t'] = trim($t[7]);
			$new_data[$t[1]]['score'] = str_replace(",", ".", trim($t[8]));
			//print_arr($new_data);
		}
		
		if(isset($new_data[@$name])){
			$result['mmtNumber'] = $new_data[$name]['mmtNumber'];
			$result['phone'] = $new_data[$name]['phone'];
			$result['parent_phone'] = $new_data[$name]['parent_phone'];
			$result['score'] = $new_data[$name]['score'];
			
			$info = "Ихтисос: <b>{$new_data[$name]['spec']} - {$new_data[$name]['title_spec']}</b> <br>
			Намуди таҳсил: <b>{$new_data[$name]['id_s_v']}</b> <br>
			Шакли таҳсил: <b>{$new_data[$name]['id_s_t']}</b>
			";
			
			$result['info'] = $info;
			
			echo json_encode($result);
		}else {
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
		
		
		$faculties = query("SELECT * FROM `faculties` ORDER BY `id`");
		
		
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
			$s_y_info = select("study_years", "*", "", "id", false, "1");
			
			$start = $s_y_info[0]['id'];
			$start_course = $id_course - 1;
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
		$id_faculty = @$_REQUEST['id_faculty'];

		$name = @strval($_REQUEST['fullname']);
		$login = makeLogin($name, rand(1,100));
		
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
	
	case "getHisobVaraqaForm":
		$id_student = $_REQUEST['id_student'];
		$id_spec = @$_REQUEST['id_spec'];
		$id_s_v = @$_REQUEST['id_s_v'];
		$id_s_l = @$_REQUEST['id_s_l'];
		$foreign = @$_REQUEST['foreign'];
		$S_Y = S_Y;
		define('MY_URL', $_REQUEST['my_url']);
		
		$checks = query("SELECT * FROM `rasidho` WHERE `id_student` = '$id_student' ORDER BY `id` DESC");
		
		
		if(isset($id_Spec)){
			$query = query("SELECT `qabul_plan`.*, `qabul_plan_detail`.* FROM `qabul_plan_detail` 
						INNER JOIN `qabul_plan` ON `qabul_plan_detail`.`id_qabul_plan` = `qabul_plan`.`id`
						WHERE `qabul_plan_detail`.`id_s_t` = '1' AND `qabul_plan`.`s_y` = '$S_Y' 
						AND `qabul_plan_detail`.`id_spec` = '$id_spec' AND `qabul_plan_detail`.`id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v'");
			
			
			if($foreign!=null && $foreign!=''){
				$money = $query[0]['money_other'];
			} else {
				$money = $query[0]['money'];
			}
		}
		include("ajax/getHisobVaraqaForm.php");
		exit;
	break;
	
}


?>