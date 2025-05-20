<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

$STUDY_YEARS = select("study_years", "*", "", "id", false, "");

switch($option){
	
	
	case "getAddDiplomInfo":
		$id_student  = $_REQUEST['id_student'];
		$id_s_l = $_REQUEST['id_s_l'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		include("ajax/getAddDiplomInfo.php");
		exit;
	break;
	
	case "showuseractions":
		$id_user = $_REQUEST['id_user'];
		$date = $_REQUEST['date'];
		
		$page_info['title'] = "Дидани амалиётҳо: ".getUserName($id_user);
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		$datas = query("SELECT * FROM `_datasonline` WHERE `id_user` = '$id_user' AND `date` = '$date' ORDER BY `id` DESC");
		
		include("ajax/useractions.php");
		exit;
	break;
	
	case "getArchiveForm":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		$courses = select("course", "*", "", "id", false, "");
		
		
		define("MY_URL", $_REQUEST['my_url']);
		
		include("ajax/archive.php");
		exit;
	break;
	
	case "getArchiveList":
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		/* Баровардани контингенти гурух */
		$students = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE 
		`students`.`status` = '1'
		AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
		AND `students`.`id_s_v` = '$id_s_v' 
		AND `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
		ORDER BY `users`.`fullname_tj`
		");
		/* Баровардани контингенти гурух */
		include("ajax/archivelist.php");
		exit;
	break;
	
	case "showstatistic":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_v = $_REQUEST['id_s_v'];
		
		include("ajax/showstatistic.php");
		exit;
	break;
	
	case "todaystatistic":
		$date = $_REQUEST['date'];
	
		$users = query("SELECT * FROM `users` WHERE `id` IN(SELECT `id_user` FROM `_datasonline` WHERE `date` = '$date') ORDER BY `access_type`, `last_login` DESC");
		
		$count_users = query("SELECT COUNT(`id`) as `users` FROM `users` WHERE `id` IN(SELECT `id_user` FROM `_datasonline` WHERE `date` = '$date') ORDER BY `access_type`, `last_login` DESC");
		$count_teachers = query("SELECT COUNT(`id`) as `teachers` FROM `users` WHERE `access_type` = 2 AND `id` IN(SELECT `id_user` FROM `_datasonline` WHERE `date` = '$date')");
		$count_students = query("SELECT COUNT(`id`) as `students` FROM `users` WHERE `access_type` = 3 AND `id` IN(SELECT `id_user` FROM `_datasonline` WHERE `date` = '$date')");
		
		include("views/todaystatistic.php");
		exit;
	break;
	
	case "groupsettings":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		
		$settings = query("SELECT `id`, `id_nt`, `lang` FROM `std_study_groups` WHERE `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' AND
		`id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group'");
		
		$id = $settings[0]['id'];
		$id_nt = $settings[0]['id_nt'];
		$lang = $settings[0]['lang'];
		
		$nts = select("nt_list", "*", "`id_faculty` = '$id_faculty'
		AND `id_spec` = '$id_spec' AND `id_s_v` = '$id_s_v'", "soli_tasdiq", false, "");
		
		include("ajax/groupsettings.php");
		exit;
	break;
	
	case "getimtinfo":
		
		$id_nt = $_REQUEST['id_nt'];
		$id_student = $_REQUEST['id_student'];
		$id_course = $_REQUEST['id_course'];
		
		$semestr = getSemestr($id_course, H_Y);
		$id_s_v = $_REQUEST['id_s_v'];
		
		
		
		if(isset($_REQUEST['s_y'])){
			$s_y = $_REQUEST['s_y'];
			$h_y = $_REQUEST['h_y'];
		}else{
			$s_y = S_Y;
			$h_y = H_Y;
		}
		
		$student_info = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		$id_group = $student_info[0]['id_group'];
		
		
		define('MY_URL', $_REQUEST['my_url']);
		
		$semestr = getSemestr($id_course, $h_y);
		
		$fanlist = query("
		
		SELECT
			`nt_content`.`id_nt`, `nt_content`.`semestr`, `nt_content`.`id_fan` as `fan_id`,
			`nt_content`.`intixobi`, `nt_content`.`k_k`, `nt_content`.`c_u`,
			`results`.`id` as `results_id`, `results`.*,
			`fan_test`.`title_tj`,
			`iqtibosho`.`id` as `id_iqtibos`
		FROM
			`iqtibosho`
		INNER JOIN `nt_content` ON `nt_content`.`id_nt` = `iqtibosho`.`id_nt` 
		AND `nt_content`.`id_fan` = `iqtibosho`.`id_fan`
		AND `iqtibosho`.`s_y` = '$s_y'  AND `iqtibosho`.`semestr` = '$semestr'
		AND `nt_content`.`semestr` = `iqtibosho`.`semestr`
		AND `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$semestr'
		
		LEFT JOIN `results` ON 
			`results`.`id_student` = '$id_student' AND 
			`results`.`id_fan` = `iqtibosho`.`id_fan` AND 
			`results`.`id_course` = `iqtibosho`.`id_course` AND 
			`results`.`s_y` = '".S_Y."' AND 
			`results`.`h_y` = '".H_Y."'
		INNER JOIN `fan_test` ON `fan_test`.`id` = `iqtibosho`.`id_fan`
		
		WHERE
			`iqtibosho`.`id_group` = '$id_group'
		ORDER BY `results`.`id_fan`
		");
		
		//print_arr($fanlist);
		
		$page_info['title'] = 'Натиҷаи имтиҳонҳо: '.getUserName($id_student).': '.getStudyYear($s_y).': '.$h_y;
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("ajax/getimtinfo.php");
		exit;
	break;
	
	case "getimtinfo_SY_HY":
		$id_nt = $_REQUEST['id_nt'];
		$id_student = $_REQUEST['id_student'];
		define('MY_URL', $_REQUEST['my_url']);
		
		$id_s_v = $_REQUEST['id_s_v'];
		
		$s_y = $_REQUEST['s_y'];
		$c_semestr = $_REQUEST['c_semestr'];
		$semestr = $_REQUEST['semestr'];
		
		$id_course = getCourseBySemestr($semestr);
		$h_y = getNimsolaBySemestr($semestr);
		
		$student_info = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND 
		`id_course` = '$id_course' AND `h_y` = '$h_y'");
		
		$s_y = @$student_info[0]['s_y'];
		$id_group = @$student_info[0]['id_group'];
		
		if($c_semestr == $semestr){
			//sss
			$fanlist = query("
			SELECT
				`nt_content`.`id_nt`, `nt_content`.`semestr`, `nt_content`.`id_fan` as `fan_id`,
				`nt_content`.`intixobi`, `nt_content`.`k_k`, `nt_content`.`c_u`,
				`results`.`id` as `results_id`, `results`.*,
				`fan_test`.`title_tj`,
				`iqtibosho`.`id` as `id_iqtibos`
			FROM
				`iqtibosho`
			
			INNER JOIN `nt_content` ON `nt_content`.`id_nt` = `iqtibosho`.`id_nt`
			AND `nt_content`.`id_fan` = `iqtibosho`.`id_fan` 
			AND `iqtibosho`.`s_y` = '$s_y'  AND `iqtibosho`.`semestr` = '$semestr'
			AND `nt_content`.`semestr` = `iqtibosho`.`semestr` AND
			`nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$semestr' 
			
			LEFT JOIN `results` ON `results`.`id_fan` = `iqtibosho`.`id_fan` 
			AND `results`.`id_course` = `iqtibosho`.`id_course`
			AND `results`.`id_student` = '$id_student' 
			AND `results`.`s_y` = '$s_y' 
			AND `results`.`semestr` = '$semestr'
			
			INNER JOIN `fan_test` ON `fan_test`.`id` = `iqtibosho`.`id_fan`
			
			WHERE
				`iqtibosho`.`id_group` = '$id_group'
				
			ORDER BY `results`.`id_fan`
			");
			
			//print_arr($fanlist);
		}else{
			
			$fanlist = getResultsBySemestr($id_student, $id_group, $id_nt, $semestr);
		}
		
		$page_info['title'] = 'Натиҷаи имтиҳонҳо: '.getUserName($id_student).': '.getStudyYear($s_y).': '.$semestr;
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		include("ajax/imtresfile.php");
		exit;
	break;
	
	case "getstudentinfo":
		$id_student = $_REQUEST['id_student'];
		if(!isset($_REQUEST['s_y'])){
			$s_y = S_Y;
			$h_y = H_Y;
		}else{
			$s_y = $_REQUEST['s_y'];
			$h_y = $_REQUEST['h_y'];
		
		}
		
		
		$student = query("SELECT 
			`user_udecation`.*,
			`user_passports`.*,
			
			`vazi_oilavi`.`title` as `vazi_oilavi_title`,
			
			`countries`.`title` as `country_title`,
			`regions`.`name` as `region_title`,
			`districts`.`name` as `district_title`,
			`nations`.`title` as `nation_title`,
			
			`faculties`.`title` as `faculty_title`,
			`faculties`.`short_title` as `faculty_short`,
			
			`specialties`.`code` as `spec_code`,
			`specialties`.`title_tj` as `spec_title_tj`,
			`specialties`.`title_ru` as `spec_title_ru`,
			`specialties`.`title_en` as `spec_title_en`,
			
			`groups`.`title` as `group_title`,
			
			`study_level`.`title` as `study_level_title`,
			`study_type`.`title` as `study_type_title`,
			`study_view`.`title` as `study_view_title`,
			
			`students`.*,
			`users`.* 
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		
		LEFT JOIN `vazi_oilavi` ON `students`.`vazi_oilavi` = `vazi_oilavi`.`id`
		LEFT JOIN `countries` ON `user_passports`.`id_country` = `countries`.`id`
		LEFT JOIN `regions` ON `user_passports`.`id_region` = `regions`.`id`
		LEFT JOIN `districts` ON `user_passports`.`id_district` = `districts`.`id`
		LEFT JOIN `nations` ON `user_passports`.`id_nation` = `nations`.`id`
		
		INNER JOIN `faculties` ON `students`.`id_faculty` = `faculties`.`id`
		INNER JOIN `specialties` ON `students`.`id_spec` = `specialties`.`id`
		INNER JOIN `groups` ON `students`.`id_group` = `groups`.`id`
		
		INNER JOIN `study_type` ON `students`.`id_s_t` = `study_type`.`id`
		INNER JOIN `study_level` ON `students`.`id_s_l` = `study_level`.`id`
		INNER JOIN `study_view` ON `students`.`id_s_v` = `study_view`.`id`
		
		WHERE `students`.`status` = 1 AND `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
		");
		
		
		/*
		$specs = query("
			SELECT * FROM `std_study_groups` WHERE `id_course` = '{$student[0]['id_course']}' 
			AND `id_s_l`='{$student[0]['id_s_l']}' AND `s_y` = '$s_y' AND `h_y` = '$h_y'
			AND `id_nt`!='NULL'
			ORDER BY `id_spec` ASC, `id_s_v` ASC
		");
		*/
		define('MY_URL', $_REQUEST['my_url']);
		
		$history = query("SELECT * FROM `students` WHERE `status` = 1 AND `id_student` = '$id_student' ORDER BY `id_course`, `h_y`");
		
		include("ajax/getstudentinfo.php");
		exit;
	break;
	
	case "getstudentactions":
		$id_student = $_REQUEST['id_student'];
		define('MY_URL', $_REQUEST['my_url']);
		//$month = $_REQUEST['month'];
		
		$month = date("m", time());
		$year = date("Y");

		$days = date('t', mktime(0, 0, 0, $month, 1, $year)); // 29
		
		
		include("ajax/getstudentactions.php");
		exit;
	break;
	
	case "getstudentactions2":
		$id_student = $_REQUEST['id_student'];
		define('MY_URL', $_REQUEST['my_url']);
		
		$month = $_REQUEST['month'];
		$year = $_REQUEST['s_y'];
		
		$days = date('t', mktime(0, 0, 0, $month, 1, $year)); // 29
		
		
		include("ajax/actions_info.php");
		exit;
	break;
	
	case "getRasidForm":
		$id_student = $_REQUEST['id_student'];
		$S_Y = S_Y;
		define('MY_URL', $_REQUEST['my_url']);
		
		$checks = query("SELECT * FROM `rasidho` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' ORDER BY `id` DESC");
		
		include("ajax/getRasidForm.php");
		exit;
	break;
	
	case "CheckDelete":
		$id_student = $_REQUEST['id_student'];
		$id = $_REQUEST['id_check'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		define('MY_URL', $_REQUEST['my_url']);
		
		
		delete("rasidho", "`id` = '$id'");
		$checks = query("SELECT * FROM `rasidho` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' ORDER BY `id` DESC");
		
		include("ajax/_check_list.php");
		exit;
	break;
	
	case "CheckInsert":
		$id_student = $_REQUEST['id_student'];
		$check_number = $_REQUEST['check_number'];
		$check_date = $_REQUEST['check_date'];
		$check_money = $_REQUEST['check_money'];
		
		$data['id_student'] = "'".$_REQUEST['id_student']."'";
		$data['check_number'] = "'".$_REQUEST['check_number']."'";
		$data['check_date'] = "'".$_REQUEST['check_date']."'";
		$data['check_money'] = "'".$_REQUEST['check_money']."'";
		
		$data['s_y'] = "'".S_Y."'";
		
		$data['author'] = "'".$_SESSION['user']['id']."'";
		$data['op_date'] = "'".date("d.m.Y, H:i:s", time())."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		insert("rasidho", $fields, $data);
		
		
		$S_Y = S_Y;
		$H_Y = H_Y;
		define('MY_URL', $_REQUEST['my_url']);
		
		$checks = query("SELECT * FROM `rasidho` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' ORDER BY `id` DESC");
		
		include("ajax/_check_list.php");
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
		LEFT JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		define('MY_URL', $_REQUEST['my_url']);
		
		
		$faculties = select("faculties", "*", "", "id", false, "");
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
		ORDER BY `users`.`fullname_tj`
		");
		$STUDY_YEARS = select("study_years", "*", "", "id", false, "");
		
		define('MY_URL', $_REQUEST['my_url']);
		
		include("ajax/getstudentdeleteform.php");
		exit;
	break;
	
	case "getstudentrestoreform":
		$id_student = $_REQUEST['id_student'];
		$s_y_xorij = $_REQUEST['sy_xorij'];
		$h_y_xorij = $_REQUEST['hy_xorij'];
		
		$infostd_status0 = query("SELECT `students`.`id` as `id_status0`, `students`.*, `users`.* FROM `students` INNER JOIN `users` 
								ON `students`.`id_student` = `users`.`id`
								WHERE `students`.`status` = '0' AND
									`students`.`id_student` = '$id_student' AND  
									`students`.`s_y` = '$s_y_xorij' AND 
									`students`.`h_y` = '$h_y_xorij'
							");
							//print_arr($infostd_status0);
		$id_status0 = $infostd_status0[0]['id_status0'];
		
		$faculties = select("faculties", "*", "", "id", false, "");
		$courses = select("course", "*", "", "id", false, "");
		$specialties = select("specialties", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "id", false, "");
		
		define('MY_URL', $_REQUEST['my_url']);
		
		include("ajax/getstudentrestoreform.php");
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
		$other = $_REQUEST['other'];
		
		$query = query("SELECT `qabul_plan`.*, `qabul_plan_detail`.* FROM `qabul_plan_detail` 
					INNER JOIN `qabul_plan` ON `qabul_plan_detail`.`id_qabul_plan` = `qabul_plan`.`id`
					WHERE `qabul_plan`.`s_y` = '$S_Y' 
					AND `qabul_plan_detail`.`id_spec` = '$id_spec' AND `qabul_plan_detail`.`id_s_l` = '$id_s_l'");
		
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
		
		if(H_Y == 1){
			$semestrs = $id_course * 2 - 1;
		}else{
			$semestrs = $id_course * 2 - 1;
		}
		
		$end_s_y = S_Y - floor($semestrs / 2);
		
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
	
	case "getstudentraznitsaform":
		$id_student = $_REQUEST['id_student'];
		//$id_nt_oldspec = $_REQUEST['id_spec'];
		$info_std=query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y`='".S_Y."' AND `h_y`='".H_Y."'");
		$id_faculty=$info_std[0]['id_faculty'];
		$id_course=$info_std[0]['id_course'];
		$id_spec=$info_std[0]['id_spec'];
		$id_s_l=$info_std[0]['id_s_l'];
		$id_s_v=$info_std[0]['id_s_v'];
		$xoriji=$info_std[0]['foreign'];

		if($xoriji)
			$xoriji = 'xoriji';
		$current_semestr=getSemestr($id_course, H_Y);
		$id_nt=query("SELECT * FROM `std_study_groups` WHERE `id_faculty`='$id_faculty' 
						AND `id_course`='$id_course' AND `id_spec`='$id_spec' 
						AND `id_s_l`='$id_s_l' AND `id_s_v`='$id_s_v' 
						AND `s_y`='".S_Y."' AND `h_y`='".H_Y."' 
					");
		$id_nt=$id_nt[0]['id_nt'];	
		$fans_nt=query("SELECT * FROM `nt_content` WHERE `id_nt`='$id_nt' AND `semestr`<'$current_semestr' AND `id_fan`!=1748 ORDER BY `semestr`");
		// if($id_nt_oldspec != -1)
			// $fans_nt_oldspec=query("SELECT * FROM `nt_content` WHERE `id_nt`='$id_nt_oldspec' AND `semestr`<'$current_semestr'  ORDER BY `semestr`");
		// else
			// $fans_nt_oldspec=query("SELECT * FROM `results` WHERE `id_student`='$id_student'");
			
		// $res_student=query("SELECT * FROM `results` WHERE `id_student`='$id_student' ORDER BY `s_y` ASC, `h_y` ASC");
		// $fans=query("SELECT * FROM `iqtibosho` INNER JOIN `sarboriho` ON `iqtibosho`.`id`=`sarboriho`.`id_iqtibos` WHERE `semestr`<='$current_semestr' AND `id_nt`='$id_nt_newspec' AND `sarboriho`.`type`='lk_plan' AND `sarboriho`.`soat`>0 AND `id_fan`!=1748");
		
		// function compareArrays($array1, $array2, $key1, $key2) {
			// $result = array();
			
			// foreach ($array1 as $item1) {
				// foreach ($array2 as $item2) {
					// if ($item1[$key1] == $item2[$key1] && $item1[$key2] == $item2[$key2]) {
						// $result[] = $item1;
					// }
				// }
			// }
			
			// return $result;
		// }
		// $raznitsa = compareArrays($fans_nt, $fans_nt_oldspec, 'id_fan', 'semestr');
		
		
		
		//print_arr($raznitsa);
		
		
		////////////////////////////
		
		// function udiffCompare($a, $b){
			// return $a['id_fan'] - $b['id_fan'];
		// }
		
		//$raznitsa = array_udiff($fans_nt, $fans_nt_oldspec, 'udiffCompare');
		//$teachers = query("SELECT * FROM `users` WHERE `access_type` = '2' ORDER BY `fullname_tj`");
		$raznitsa = $fans_nt;
		
		$shartnoma = getSharnomaMoneyBySY($id_course, $id_spec, $id_s_l, $id_s_v, S_Y, $xoriji);
		define('MY_URL', $_REQUEST['my_url']);
		include("ajax/getstudentraznitsaform.php");
		exit;
	break;
	
	case "getstudenttrimestrform":
		$id_student = $_REQUEST['id_student'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$info_std=query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$id_faculty=$info_std[0]['id_faculty'];
		$id_course=$info_std[0]['id_course'];
		$id_spec=$info_std[0]['id_spec'];
		$id_group=$info_std[0]['id_group'];
		$id_s_l=$info_std[0]['id_s_l'];
		$id_s_v=$info_std[0]['id_s_v'];
		$xoriji=$info_std[0]['foreign'];

		if($xoriji)
			$xoriji = 'xoriji';
		$shartnoma = getSharnomaMoneyBySY($id_course, $id_spec, $id_s_l, $id_s_v, S_Y, $xoriji);
		
		$qarzho = query("SELECT *, IFNULL(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`), 0) as `score_total` FROM `results` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' 
								AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_student` = '$id_student' 
								AND `id_fan` NOT IN(
									SELECT `id_fan` FROM `trimestr_content` INNER JOIN `trimestr` ON `trimestr_content`.`id_trimestr` = `trimestr`.`id`
									WHERE `trimestr`.`id_student` = '$id_student' AND `trimestr`.`s_y` = '$S_Y' AND `trimestr`.`h_y` = '$H_Y'
								) 
								AND `trimestr_score` IS NULL AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'
								HAVING `score_total` < 50.00 
								");
		
		$semestr=getSemestr($id_course, $H_Y);
		$id_nt=query("SELECT * FROM `std_study_groups` WHERE 
						`status` = '1' AND
						`id_faculty`='$id_faculty' 
						AND `id_course`='$id_course' AND `id_spec`='$id_spec' 
						AND `id_s_l`='$id_s_l' AND `id_s_v`='$id_s_v' 
						AND `s_y`='$S_Y' AND `h_y`='$H_Y' 
					");
		$id_nt=$id_nt[0]['id_nt'];	
		
		
		// $qarzho = query("
		// SELECT `nt_content`.*, `results`.*, ROUND(IFNULL(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`), 0), 2) as `score_total`
		
		// FROM `nt_content` 
		// LEFT JOIN `results` ON `nt_content`.`id_fan` = `results`.`id_fan` AND 
		// `nt_content`.`semestr` = `results`.`semestr`
		// WHERE `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` <= $semestr AND
		// `results`.`id_student` = $id_student AND
		// `trimestr_score` IS NULL 
		
		// HAVING
			// `score_total` < 50.00 
		// ");
		
		
		define('MY_URL', $_REQUEST['my_url']);
		include("ajax/getstudenttrimestrform.php");
		exit;
	break;
	
}


?>