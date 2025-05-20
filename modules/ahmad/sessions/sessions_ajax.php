<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

$STUDY_YEARS = select("study_years", "*", "", "id", false, "");

switch($option){
	
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
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE `students`.`id_student` = `users`.`id`
		AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
		AND `students`.`id_s_v` = '$id_s_v' 
		AND `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
		ORDER BY `users`.`fullname`
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
		$id_s_v = $_REQUEST['id_s_v'];
		$s_y = S_Y;
		$h_y = H_Y;
		
		$info_start = select("students", "*", "`id_student` = '$id_student'", "id", false, "1");
		$start_s_y = $info_start[0]['s_y'];
		
		$info_end = select("students", "*", "`id_student` = '$id_student'", "id", true, "1");
		$end_s_y = $info_end[0]['s_y'];
		
		$STUDY_YEARS = select("study_years", "*", "`id` >= '$start_s_y' AND `id` <= '$end_s_y'", "id", false, "");
		
		define('MY_URL', $_REQUEST['my_url']);
		
		$fanlist = query("
		SELECT 
		`nt_content`.`id_fan`, `nt_content`.`k_k`, `nt_content`.`c_u`,
		`std_teacherscore`.`id_student`,
		`nt_content`.`id_course`,
		`nt_content`.`h_y` as `nt_h_y`,
		
		ROUND(SUM(`std_teacherscore`.`h1`+`std_teacherscore`.`h2`+`std_teacherscore`.`h3`+`std_teacherscore`.`h4`+`std_teacherscore`.`h5`+`std_teacherscore`.`h6`+`std_teacherscore`.`h7`+`std_teacherscore`.`h8` +`std_teacherscore`.`rating_1`) / 2, 2) as `r_1`,
		
		CASE WHEN `nt_content`.`id_course` = 4 AND `nt_content`.`h_y` = 2 THEN
			ROUND(SUM(`std_teacherscore`.`h1`+`std_teacherscore`.`h2`+`std_teacherscore`.`h3`+`std_teacherscore`.`h4`+`std_teacherscore`.`h5`+`std_teacherscore`.`h6`+`std_teacherscore`.`h7`+`std_teacherscore`.`h8` +`std_teacherscore`.`rating_1`) / 2, 2)
		ELSE
			ROUND(SUM(`std_teacherscore`.`h9`+`std_teacherscore`.`h10`+`std_teacherscore`.`h11`+`std_teacherscore`.`h12`+`std_teacherscore`.`h13`+`std_teacherscore`.`h14`+`std_teacherscore`.`h15`+`std_teacherscore`.`h16`+`std_teacherscore`.`rating_2`) / 2, 2)
		END as `r_2`,
		
		ROUND(COALESCE(`dop_results`.`score`, 0), 2) as `dop_score`,
		COALESCE(`std_resultsimt`.`score`, 0) as `imt_score`,
		CASE WHEN `std_resultsimt`.`score` = 0 THEN 0 
		ELSE 
			CASE WHEN `nt_content`.`id_course` = 4 AND `nt_content`.`h_y` = 2 THEN
				COALESCE(ROUND(`std_resultsimt`.`score` + 
				COALESCE(ROUND(SUM(`std_teacherscore`.`h1`+`std_teacherscore`.`h2`+`std_teacherscore`.`h3`+`std_teacherscore`.`h4`+`std_teacherscore`.`h5`+`std_teacherscore`.`h6`+`std_teacherscore`.`h7`+`std_teacherscore`.`h8`+`std_teacherscore`.`rating_1`+ `std_teacherscore`.`h1`+`std_teacherscore`.`h2`+`std_teacherscore`.`h3`+`std_teacherscore`.`h4`+`std_teacherscore`.`h5`+`std_teacherscore`.`h6`+`std_teacherscore`.`h7`+`std_teacherscore`.`h8`+`std_teacherscore`.`rating_2`) / 2, 2), 0), 2), 0)
			ELSE
				COALESCE(ROUND(`std_resultsimt`.`score` + 
				COALESCE(ROUND(SUM(`std_teacherscore`.`h1`+`std_teacherscore`.`h2`+`std_teacherscore`.`h3`+`std_teacherscore`.`h4`+`std_teacherscore`.`h5`+`std_teacherscore`.`h6`+`std_teacherscore`.`h7`+`std_teacherscore`.`h8`+`std_teacherscore`.`h9`+`std_teacherscore`.`h10`+`std_teacherscore`.`h11`+`std_teacherscore`.`h12`+`std_teacherscore`.`h13`+`std_teacherscore`.`h14`+`std_teacherscore`.`h15`+`std_teacherscore`.`h16`+`std_teacherscore`.`rating_1`+`std_teacherscore`.`rating_2`) / 2, 2), 0), 2), 0)
			END
		
		END as `allscore`,
		
		`std_resultsimt`.`date`,
		`std_resultsimt`.`ip`,
		`std_teacherscore`.`s_y`,
		`std_teacherscore`.`h_y`
		FROM `nt_content`
		
		LEFT JOIN `std_teacherscore` ON `nt_content`.`id_fan` = `std_teacherscore`.`id_fan` AND `nt_content`.`id_course` = `std_teacherscore`.`id_course`
		AND `nt_content`.`h_y` = `std_teacherscore`.`h_y`
		AND `std_teacherscore`.`id_student` = '$id_student'
		
		LEFT JOIN  `dop_results` ON `nt_content`.`id_fan` = `dop_results`.`id_fan` AND `dop_results`.`s_y` = '$s_y' AND `dop_results`.`h_y` = '$h_y'
		AND `nt_content`.`h_y` = `dop_results`.`h_y`
		AND `dop_results`.`id_student` = '$id_student'
		LEFT JOIN `std_resultsimt` ON `nt_content`.`id_fan` = `std_resultsimt`.`id_fan`
		AND `nt_content`.`h_y` = `std_resultsimt`.`h_y`
		AND `std_resultsimt`.`id_student` = '$id_student'
		WHERE `id_nt` = '$id_nt' AND `nt_content`.`id_course` = '$id_course' AND `nt_content`.`h_y` = '$h_y'
		GROUP BY `nt_content`.`id`, `std_teacherscore`.`id`, `dop_results`.`id`, `std_resultsimt`.`id`
		ORDER BY `std_teacherscore`.`s_y` DESC, `std_teacherscore`.`h_y`, `nt_content`.`id_fan`
		");
		
		include("ajax/getimtinfo.php");
		exit;
	break;
	
	case "getimtinfo_SY_HY":
		$id_nt = $_REQUEST['id_nt'];
		$id_student = $_REQUEST['id_student'];
		
		$id_s_v = $_REQUEST['id_s_v'];
		
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		$info = select("students", array("id_course"), "`id_student` = '$id_student' AND `s_y` = '$s_y' AND `h_y` = '$h_y'", "id", false, "");
		
		if(!empty($info)){
			$id_course = $info[0]['id_course'];
			//define('MY_URL', $_REQUEST['my_url']);
			
			$fanlist = query("
			SELECT 
			`nt_content`.`id_fan`, `nt_content`.`k_k`, `nt_content`.`c_u`,
			`std_teacherscore`.`id_student`,
			`nt_content`.`id_course`,
			`nt_content`.`h_y` as `nt_h_y`,
			ROUND(SUM(`std_teacherscore`.`h1`+`std_teacherscore`.`h2`+`std_teacherscore`.`h3`+`std_teacherscore`.`h4`+`std_teacherscore`.`h5`+`std_teacherscore`.`h6`+`std_teacherscore`.`h7`+`std_teacherscore`.`h8` +`std_teacherscore`.`rating_1`) / 2, 2) as `r_1`,
		
			CASE WHEN `nt_content`.`id_course` = 4 AND `nt_content`.`h_y` = 2 THEN
				ROUND(SUM(`std_teacherscore`.`h1`+`std_teacherscore`.`h2`+`std_teacherscore`.`h3`+`std_teacherscore`.`h4`+`std_teacherscore`.`h5`+`std_teacherscore`.`h6`+`std_teacherscore`.`h7`+`std_teacherscore`.`h8` +`std_teacherscore`.`rating_1`) / 2, 2)
			ELSE
				ROUND(SUM(`std_teacherscore`.`h9`+`std_teacherscore`.`h10`+`std_teacherscore`.`h11`+`std_teacherscore`.`h12`+`std_teacherscore`.`h13`+`std_teacherscore`.`h14`+`std_teacherscore`.`h15`+`std_teacherscore`.`h16`+`std_teacherscore`.`rating_2`) / 2, 2)
			END as `r_2`,
			
			ROUND(COALESCE(`dop_results`.`score`, 0), 2) as `dop_score`,
			COALESCE(`std_resultsimt`.`score`, 0) as `imt_score`,
			CASE WHEN `std_resultsimt`.`score` = 0 THEN 0 
			ELSE 
				CASE WHEN `nt_content`.`id_course` = 4 AND `nt_content`.`h_y` = 2 THEN
					COALESCE(ROUND(`std_resultsimt`.`score` + 
					COALESCE(ROUND(SUM(`std_teacherscore`.`h1`+`std_teacherscore`.`h2`+`std_teacherscore`.`h3`+`std_teacherscore`.`h4`+`std_teacherscore`.`h5`+`std_teacherscore`.`h6`+`std_teacherscore`.`h7`+`std_teacherscore`.`h8`+`std_teacherscore`.`rating_1`+ `std_teacherscore`.`h1`+`std_teacherscore`.`h2`+`std_teacherscore`.`h3`+`std_teacherscore`.`h4`+`std_teacherscore`.`h5`+`std_teacherscore`.`h6`+`std_teacherscore`.`h7`+`std_teacherscore`.`h8`+`std_teacherscore`.`rating_2`) / 2, 2), 0), 2), 0)
				ELSE
					COALESCE(ROUND(`std_resultsimt`.`score` + 
					COALESCE(ROUND(SUM(`std_teacherscore`.`h1`+`std_teacherscore`.`h2`+`std_teacherscore`.`h3`+`std_teacherscore`.`h4`+`std_teacherscore`.`h5`+`std_teacherscore`.`h6`+`std_teacherscore`.`h7`+`std_teacherscore`.`h8`+`std_teacherscore`.`h9`+`std_teacherscore`.`h10`+`std_teacherscore`.`h11`+`std_teacherscore`.`h12`+`std_teacherscore`.`h13`+`std_teacherscore`.`h14`+`std_teacherscore`.`h15`+`std_teacherscore`.`h16`+`std_teacherscore`.`rating_1`+`std_teacherscore`.`rating_2`) / 2, 2), 0), 2), 0)
				END
			
			END as `allscore`,
			`std_resultsimt`.`date`,
			`std_resultsimt`.`ip`,
			`std_teacherscore`.`s_y`,
			`std_teacherscore`.`h_y`
			FROM `nt_content`
			
			LEFT JOIN `std_teacherscore` ON `nt_content`.`id_fan` = `std_teacherscore`.`id_fan` AND `nt_content`.`id_course` = `std_teacherscore`.`id_course`
			AND `nt_content`.`h_y` = `std_teacherscore`.`h_y`
			AND `std_teacherscore`.`id_student` = '$id_student'
			
			LEFT JOIN  `dop_results` ON `nt_content`.`id_fan` = `dop_results`.`id_fan` AND `dop_results`.`s_y` = '$s_y' AND `dop_results`.`h_y` = '$h_y' 
			AND `nt_content`.`h_y` = `dop_results`.`h_y`
			AND `dop_results`.`id_student` = '$id_student'
			LEFT JOIN `std_resultsimt` ON `nt_content`.`id_fan` = `std_resultsimt`.`id_fan`
			AND `nt_content`.`h_y` = `std_resultsimt`.`h_y`
			AND `std_resultsimt`.`id_student` = '$id_student'
			WHERE `id_nt` = '$id_nt' AND `nt_content`.`id_course` = '$id_course' AND `nt_content`.`h_y` = '$h_y'
			GROUP BY `nt_content`.`id`, `std_teacherscore`.`id`, `dop_results`.`id`, `std_resultsimt`.`id`
			ORDER BY `std_teacherscore`.`s_y` DESC, `std_teacherscore`.`h_y`, `nt_content`.`id_fan`
			");
		}else{
			$fanlist = false;
		}
		
		include("ajax/imtresfile.php");
		exit;
	break;
	
	case "getstudentinfo":
		$id_student = $_REQUEST['id_student'];
		
		$student = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		ORDER BY `users`.`fullname`
		");
		
		define('MY_URL', $_REQUEST['my_url']);
		
		$history = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' ORDER BY `id_course`, `h_y`");
		
		include("ajax/getstudentinfo.php");
		exit;
	break;
	
	case "getstudenteditform":
		$id_student = $_REQUEST['id_student'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$student = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		ORDER BY `users`.`fullname`
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
		
		include("ajax/getstudenteditform.php");
		exit;
	break;
	
	
	case "getstudentdeleteform":
		$id_student = $_REQUEST['id_student'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$student = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
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
	
	case "getSemestr":
		$id_course = $_REQUEST['id_course'];
		
		if($id_course == 1){
			$start = S_Y;
			$start_course = $id_course;
		}else {
			$s_y_info = select("study_years", "*", "", "id", false, "");
			
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
	
	case "makeLogin":
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
	
}


?>