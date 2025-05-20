<?php
include '../vendor/autoload.php'; // Путь к файлу autoload.php в вашем проекте
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



switch($action){
	
	case "statsessia":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$page_info['title'] = "Омори сессия вобаста ба шакли имтиҳонҳо";
		include("views/{$action}.php");
		exit;
	break;
	
	case "qarzdorhoj":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$page_info['title'] = "ДОНИШҶӮЁНЕ КИ ҚАРЗДОР ШУДААНД";
		include("views/{$action}.php");
		exit;
	break;
	
	case "res_sessia":
		$id_departament = $_REQUEST['id_departament'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		if($H_Y == 1){
			$semestrs = "1,3,5,7,9";
		}else{
			$semestrs = "2,4,6,8,10";
		}
		$teachers = query("SELECT DISTINCT(`id_teacher`), `users`.`fullname_tj` FROM `sarboriho` 
							INNER JOIN `iqtibosho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id` 
							INNER JOIN `users` ON `sarboriho`.`id_teacher` = `users`.`id`
						WHERE `sarboriho`.`type` = 'lk_plan' AND 
							`iqtibosho`.`id_departament` = '$id_departament' AND 
							`iqtibosho`.`s_y` = '$S_Y' AND 
							`iqtibosho`.`semestr` IN ($semestrs)
						ORDER BY `users`.`fullname_tj` ASC
						");		
		$page_info['title'] = "Ҳисоботи " . getDepartament($id_departament) . " оиди натиҷагирӣ аз " . getHalfYear($H_Y) . "и соли таҳсили " . getStudyYear($S_Y);
		include("views/vedomost/{$action}.php");
		exit;
	break;
	case "todayexamresults":
		if(isset($_REQUEST['date'])){
			$date = $_REQUEST['date'];
		}else{
			$date = date('Y-m-d');
		}
		$tests = query("SELECT * FROM `tests` 
							WHERE `datetime` LIKE '%$date%'
							ORDER BY `id_faculty` ASC, 
								`id_s_l` ASC,
								`id_s_v` ASC,
								`id_course` ASC,
								`id_spec` ASC,
								`id_group` ASC
						");
		
		$page_info['title'] = "Натиҷаи имтиҳонҳо дар санаи ".date('d.m.Y', strtotime($date)). " дар ".UNI_NAME;
		include("views/{$action}.php");
		exit;
	break;
	
	case "vedomosti_shifohi":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$teachers = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
					
		$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		$id_faculty = $data_iq[0]['id_faculty'];
		$id_s_l = $data_iq[0]['id_s_l'];
		$id_s_v = $data_iq[0]['id_s_v'];
		$id_course = $data_iq[0]['id_course'];
		$id_spec = $data_iq[0]['id_spec'];
		$id_group = $data_iq[0]['id_group'];
		$semestr = $data_iq[0]['semestr'];
		$id_fan = $data_iq[0]['id_fan'];
		$id_cafedra = $data_iq[0]['id_departament'];
		$credits = $data_iq[0]['credits'];
		if($semestr % 2 == 0){
			$H_Y = 2;
		}else $H_Y = 1;
		$S_Y = $data_iq[0]['s_y'];
		$page_info['title'] = "Варақаи ҷавоби имтиҳонӣ";
		$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
		include("views/vedomost/{$action}.php");
		exit;
	break;
	
	case "examlist":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$teachers = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
					
		$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		$id_faculty = $data_iq[0]['id_faculty'];
		$id_s_l = $data_iq[0]['id_s_l'];
		$id_s_v = $data_iq[0]['id_s_v'];
		$id_course = $data_iq[0]['id_course'];
		$id_spec = $data_iq[0]['id_spec'];
		$id_group = $data_iq[0]['id_group'];
		$semestr = $data_iq[0]['semestr'];
		$id_fan = $data_iq[0]['id_fan'];
		$credits = $data_iq[0]['credits'];
		if($semestr % 2 == 0){
			$H_Y = 2;
		}else $H_Y = 1;
		$S_Y = $data_iq[0]['s_y'];
		$page_info['title'] = "Варақаи ҷавоби имтиҳонӣ";
		$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
		include("views/{$action}.php");
		exit;
	break;
	
	case "davomot_1":
		$rating = 2;
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$datas = query("SELECT id_student, SUM(absents) AS `total_absents` FROM 
		`students_absents` 
		WHERE `s_y` = '$S_Y' AND `h_y` = '$H_Y' 
		
		GROUP BY id_student
		");
		
		$page_info['title'] = "НБ";
		include("views/davomot/{$action}.php");
		exit;
	break;
	
	case "davomot_2":
		$rating = 1;
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$datas = query("SELECT `students_absents`.* FROM `students_absents`

		WHERE `rating` = '$rating' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' 
		ORDER BY `students_absents`.`id_fan`");
		
		$page_info['title'] = "НБ";
		include("views/davomot/{$action}.php");
		exit;
	break;
	
	case "rating_kmd":
		$rating = $_REQUEST['rating'];
		$page_info['title'] = "Назорати КМД аз рейтинги $rating";
		include("views/vedomost/{$action}.php");
		exit;
	break;
	
	case "results_nf":
		$rating = $_REQUEST['rating'];
		$iqtibosho = query("SELECT * FROM `iqtibosho` 
							WHERE `semestr` IN(".SEMESTRS.") AND 
								`s_y` = '".S_Y."' 
							ORDER BY `id_faculty` ASC,
								`id_s_l` ASC,
								`id_s_v` ASC,
								`id_course` ASC,
								`id_spec` ASC,
								`id_group` ASC,
								`id_fan` ASC
							");
		$page_info['title'] = "Натиҷаҳои рейтинги $rating";
		include("views/vedomost/{$action}.php");
		exit;
	break;
	
	case "results_imt":
		$iqtibosho = query("SELECT * FROM `iqtibosho` 
							WHERE `semestr` IN(".SEMESTRS.") AND 
								`s_y` = '".S_Y."' 
							ORDER BY `id_faculty` ASC,
								`id_s_l` ASC,
								`id_s_v` ASC,
								`id_course` ASC,
								`id_spec` ASC,
								`id_group` ASC,
								`id_fan` ASC
							");
		$page_info['title'] = "Натиҷаҳои имтиҳонҳо";
		include("views/vedomost/{$action}.php");
		exit;
	break;
	
	case "khorijshudagon":
		
		$students = query("
			SELECT 
				s.*,
				users.*,
				sf.*
			FROM 
				students s
			INNER JOIN 
				stds_farmonho sf ON s.id_student = sf.id_student 
								 AND s.s_y = sf.s_y 
								 AND s.h_y = sf.h_y
			INNER JOIN 
				(SELECT MAX(id) AS max_id
				 FROM students
				 WHERE status = '0'
				 GROUP BY id_student) subq ON s.id = subq.max_id
			INNER JOIN users ON s.id_student = users.id
			WHERE 
				s.status = '0' 
			ORDER BY 
				s.id_faculty ASC,
				s.id_s_l ASC,
				s.id_s_v ASC,
				s.s_y ASC,
				s.h_y ASC,
				s.id_course ASC,
				s.id_spec ASC,
				s.id_group ASC,
				users.fullname_tj ASC
		");
		
		$page_info['title'] = "Хориҷшудагон";
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "joi_kor":
		$korgarho = query("SELECT * FROM `user_passports` 
							WHERE `user_passports`.`joi_kor` IS NOT NULL						
						");
		$page_info['title'] = "Омори ҷои кор";
		include("views/{$action}.php");
		exit;
	break;
	
	case "cont_fac":
		$id_faculty = $_REQUEST['id_faculty'];
		$page_info['title'] = "Чопи контингенти ".getFaculty($id_faculty);
		include("views/{$action}.php");
		exit;
	break;
	 
	case "farmonhoi_student":
		$id_student = $_REQUEST['id_student'];
		$farmonho  = query("SELECT * FROM `stds_farmonho` WHERE `id_student` = '$id_student' ORDER BY `farmon_date` ASC");
		$page_info['title']  = "Фармонҳои ".getUserName($id_student); 
		include("views/{$action}.php");
		exit;
	break;
	
	case "kvota":
		$s_y = 24;
		$h_y = 1;
		
		$datas = query("
		SELECT `users`.`fullname_tj`, `users`.`phone`, `students`.* FROM `users`
		INNER JOIN `students` ON `users`.`id` = `students`.`id_student` AND `students`.`id_s_t` = '3'
		WHERE `students`.`status` = '-1' AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
		ORDER BY `students`.`id`
		");
		
		include("views/{$action}.php");
		exit;
		
	break;
	
	
	case "yatimon":
		$s_y = 24;
		$h_y = 1;
		
		$datas = query("
		SELECT `users`.`fullname_tj`, `users`.`phone`, `students`.* FROM `users`
		INNER JOIN `students` ON `users`.`id` = `students`.`id_student` AND `students`.`vazi_oilavi` != 1
		WHERE `students`.`status` = '-1' AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
		ORDER BY `students`.`id`
		");
		
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "omor_qabul":
		$groups_ruzona = query("SELECT * FROM `std_study_groups` WHERE `status` = '-1' AND `id_s_v` = '1' AND `s_y` = '".S_Y."'
		ORDER BY `id_faculty`, `id_s_l`, `id_spec`");
		
		
		$groups_fosilavi = query("SELECT * FROM `std_study_groups` WHERE `status` = '-1' AND `id_s_v` = '2' AND `s_y` = '".S_Y."'
		ORDER BY `id_faculty`, `id_s_l`, `id_spec`");
		include("views/{$action}.php");
		exit;
	break;
	
	case "dovtalab_mahorat":
		$students = query("SELECT * FROM `users_2` WHERE `type` = 1 AND `ac` = 24 AND `level` = 6 ORDER BY `users_2`.`fio` ASC");
		
		$page_info['title'] = "Руйхати довталабон барои имтиҳонҳои маҳорат";
		include("views/{$action}.php");
		exit;
	break;
	
	case "kori_kursi_hisobot":
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		if($H_Y == 1)
			$semestrs = '1,3,5,7,9';
		else
			$semestrs = '2,4,6,8,10';
			
		
		$iqtibosho  = query("SELECT * FROM `iqtibosho`
								WHERE `iqtibosho`.`semestr` IN ($semestrs) AND
									(`iqtibosho`.`loihai_kursi` IS NOT NULL OR `iqtibosho`.`kori_kursi` IS NOT NULL) AND
									`iqtibosho`.`id_s_l` = '$id_s_l' AND
									`iqtibosho`.`id_s_v` = '$id_s_v' AND
									`iqtibosho`.`s_y` = '$S_Y'
								ORDER BY `id_faculty` ASC,
									`id_course` ASC,
									`id_spec` ASC,
									`id_group` ASC
							");
		
		$page_info['title'] = "Нишондоди саволномаҳо";
		include("views/{$action}.php");
		exit;
		exit;
	break;
	
	case "hissob_varaqa":
		$start_day = '2023-11-01';
		$end_day = '2023-12-22';
		$end_day = date("Y-m-d");
		
		$s_y = 23;
		$h_y = 2;
		
		
		$datas = query("SELECT * FROM `rasidho` WHERE `tranid` IS NULL AND `check_date` 
		BETWEEN '$start_day' AND '$end_day' ORDER BY `check_date` DESC;");
		
		/*
		$datas = query("
		SELECT 
			`students`.*,
			`rasidho`.*,
			`student_mmt_information`.*,
			`study_type`.`title` as `study_type_title`,
			`study_level`.`title` as `study_level_title`,
			`users`.* 
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id` 
		INNER JOIN `study_type` ON `students`.`id_s_t` = `study_type`.`id`
		INNER JOIN `study_level` ON `students`.`id_s_l` = `study_level`.`id`
		INNER JOIN `rasidho` ON `students`.`id_student` = `rasidho`.`id_student`
		
		WHERE 
		
		`rasidho`.`tranid` IS NULL AND `rasidho`.`check_date` 
		BETWEEN '$start_day' AND '$end_day'
		
		AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
		ORDER BY `users`.`fullname_tj`");
		
		print_arr($datas);
		*/
		$page_info['title'] = "Ҳисобварақа";
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		include("views/{$action}.php");
		exit;
	break;
	
	case "tests_statistic":
		
		
		if(empty($_REQUEST['id_s_v']) || empty($_REQUEST['h_y'])){
			echo "параметрҳоро илова кунед. &id_s_v=1&h_y=2";
			exit;
		}
		$id_s_v = $_REQUEST['id_s_v'];
		//$H_Y = $_REQUEST['h_y'];
		
		$black_list = '34,35,36,37,38,1748, 1740';
		
		$fanho = query("SELECT * FROM `tests` WHERE `id_s_v` = '$id_s_v' AND 
		`id_fan` NOT IN ($black_list) AND `imt_type` = '1'  ORDER BY `id_faculty`, `id_course`, `id_spec`, `id_group`
		
		");
		
		$page_info['title'] = "Нишондоди саволномаҳо";
		include("views/{$action}.php");
		exit;
	break;
	
	case "teacher_sarbori":
		//$id_teacher = $_SESSION['user']['id'];
		
		$id_teacher = $_REQUEST['id_teacher'];
		
		$lessons = query("
		SELECT 
			`iqtibosho`.*,
			`sarboriho`.*
		FROM `iqtibosho`
		INNER JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
		WHERE 
		`iqtibosho`.`semestr` IN (1,2,3,4,5,6,7,8,9,10) AND 
		`sarboriho`.`type` = 'lk_plan' 
		AND `sarboriho`.`id_teacher` = '$id_teacher'
		ORDER BY `iqtibosho`.`semestr`, `iqtibosho`.`id_fan`
		");
		
		$page_info['title'] = "Сарбории омӯзгор";
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "res_rating":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$rating = $_REQUEST['rating'];
		$iqtibos = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		$id_faculty = $iqtibos[0]['id_faculty'];
		$id_s_l = $iqtibos[0]['id_s_l'];
		$id_s_v = $iqtibos[0]['id_s_v'];
		$id_course = $iqtibos[0]['id_course'];
		$id_spec = $iqtibos[0]['id_spec'];
		$id_group = $iqtibos[0]['id_group'];
		$S_Y = $iqtibos[0]['s_y'];
		$H_Y = getNimsolaBySemestr($iqtibos[0]['semestr']);
		$id_fan = $iqtibos[0]['id_fan'];
		
		$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
		$page_info['title'] = 'Ҳисоботи рейтинг';
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/vedomost/{$action}.php");
		exit;
	break;
	
	case "res_imt":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$iqtibos = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		$id_faculty = $iqtibos[0]['id_faculty'];
		$id_s_l = $iqtibos[0]['id_s_l'];
		$id_s_v = $iqtibos[0]['id_s_v'];
		$id_course = $iqtibos[0]['id_course'];
		$id_spec = $iqtibos[0]['id_spec'];
		$id_group = $iqtibos[0]['id_group'];
		$S_Y = $iqtibos[0]['s_y'];
		$H_Y = getNimsolaBySemestr($iqtibos[0]['semestr']);
		$id_fan = $iqtibos[0]['id_fan'];
		
		$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
		$page_info['title'] = 'Ҳисоботи имтиҳон';
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/vedomost/{$action}.php");
		exit;
	break;
	
	
	
	case "rating_results":
		
		
		if(isset($_REQUEST['s_y']) && isset($_REQUEST['h_y'])){
			$S_Y = $_REQUEST['s_y'];
			$H_Y = $_REQUEST['h_y'];
		}else {
			$S_Y = S_Y;
			$H_Y = H_Y;
		}
		
		if(isset($_REQUEST['id_faculty'])){
			$id_faculty = $_REQUEST['id_faculty'];
			$where = "`std_study_groups`.`id_faculty` = '$id_faculty' AND ";
			$page_info['title'] = 'Натиҷагири аз рейтинг / '.getFacultyShort($id_faculty);
		}else{
			$where = '';
			$page_info['title'] = 'Натиҷагири аз рейтинг';
		}
		
		/*
		$departaments = query("
			SELECT `departaments`.*, COUNT(`fan`.`id`) as `fanho`
			FROM `departaments`
			LEFT JOIN `fan` ON `fan`.`id_departament` = `departaments`.`id`
			GROUP BY `departaments`.`id`, `departaments`.`title`
		");
		*/
		
		$groups = query("SELECT *	FROM `std_study_groups` 
							WHERE $where `std_study_groups`.`status` = '1' AND 
								`std_study_groups`.`s_y` = '$S_Y' AND 
								`std_study_groups`.`h_y` = '$H_Y'
							GROUP BY `std_study_groups`.`id`
							
							ORDER BY `std_study_groups`.`id_faculty`, `std_study_groups`.`id_s_l`, `std_study_groups`.`id_s_v`, 
							`std_study_groups`.`id_course`, `std_study_groups`.`id_spec`, `std_study_groups`.`id_group`
		
		");
		// $groups = query2("SELECT `std_study_groups`.*, COUNT(`students`.`id`) as `std_count`
		// FROM `std_study_groups` 
		// INNER JOIN `students` ON 
			// `students`.`id_faculty` = `std_study_groups`.`id_faculty` AND 
			// `students`.`id_s_l` = `std_study_groups`.`id_s_l` AND 
			// `students`.`id_s_v` = `std_study_groups`.`id_s_v` AND 
			// `students`.`id_course` = `std_study_groups`.`id_course` AND 
			// `students`.`id_spec` = `std_study_groups`.`id_spec` AND 
			// `students`.`id_group` = `std_study_groups`.`id_group` AND
			// `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
		// WHERE $where `students`.`status` = '1' AND `std_study_groups`.`status` = '1' AND`std_study_groups`.`id_s_l` = '1' AND `std_study_groups`.`id_s_v` = '1'  
		// AND `std_study_groups`.`s_y` = '$S_Y' AND `std_study_groups`.`h_y` = '$H_Y'
		// GROUP BY `std_study_groups`.`id`
		
		// ORDER BY `std_study_groups`.`id_faculty`, `std_study_groups`.`id_s_l`, `std_study_groups`.`id_s_v`, 
		// `std_study_groups`.`id_course`, `std_study_groups`.`id_spec`, `std_study_groups`.`id_group`
		
		// ");
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		include("views/vedomost/{$action}.php");
		exit;
	break;
	
	case "svodni_rating":
		$rating = $_REQUEST['rating'];
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		
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
		
		$id_nt = @$group_options[0]['id_nt'];
		$lang = @$group_options[0]['lang'];
		/*Муайян намудани гурӯҳ*/
		
		/*Баровардани фанхо аз руи нақшаи таълимӣ*/
		$semestr = getSemestr($id_course, H_Y);
		/*Баровардани фанхо аз руи нақшаи таълимӣ*/
		
		
		
		$fanlist = query("
		
		SELECT
			`nt_content`.*,
			`iqtibosho`.*
		FROM
			`iqtibosho`
		INNER JOIN `nt_content` ON `nt_content`.`id_nt` = `iqtibosho`.`id_nt` 
		AND `nt_content`.`id_fan` = `iqtibosho`.`id_fan`
		AND `nt_content`.`semestr` = `iqtibosho`.`semestr`
		AND `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$semestr'
		WHERE
			`iqtibosho`.`id_fan` != '1748' AND `iqtibosho`.`id_group` = '$id_group';
		");
		
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		
		$page_info['title'] = "Сводни ведомости рейтинги $rating / ".getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup2($id_group);
		
		//$page_info['title'] = "Сводни ведомости рейтинги $rating";
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		include("views/vedomost/{$action}.php");
		exit;
	break;
	
	case "svodni_imtihon":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
		
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
			`std_study_groups`.`id_s_v` = '$id_s_v' AND `std_study_groups`.`s_y` = '$S_Y' AND `std_study_groups`.`h_y` = '$H_Y'
					
		");
		
		$id_nt = @$group_options[0]['id_nt'];
		$lang = @$group_options[0]['lang'];
		/*Муайян намудани гурӯҳ*/
		
		/*Баровардани фанхо аз руи нақшаи таълимӣ*/
		$semestr = getSemestr($id_course, $H_Y);
		/*Баровардани фанхо аз руи нақшаи таълимӣ*/
		
		
		$fanlist = query("
		
		SELECT
			`nt_content`.*,
			`iqtibosho`.*
		FROM
			`iqtibosho`
		INNER JOIN `nt_content` ON `nt_content`.`id_nt` = `iqtibosho`.`id_nt` 
		AND `nt_content`.`id_fan` = `iqtibosho`.`id_fan`
		AND `nt_content`.`semestr` = `iqtibosho`.`semestr`
		AND `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$semestr'
		WHERE
			`iqtibosho`.`id_fan` != '1748' AND `iqtibosho`.`id_group` = '$id_group';
		");
		
		
		
		$page_info['title'] = "Сводни ведомости имтиҳонӣ / ".getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup2($id_group);
		
		//$page_info['title'] = "Сводни ведомости рейтинги $rating";
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		include("views/vedomost/{$action}.php");
		exit;
	break;
	
	case "svodni_imtihon_t":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
		
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
			`std_study_groups`.`id_s_v` = '$id_s_v' AND `std_study_groups`.`s_y` = '$S_Y' AND `std_study_groups`.`h_y` = '$H_Y'
					
		");
		
		$id_nt = @$group_options[0]['id_nt'];
		$lang = @$group_options[0]['lang'];
		/*Муайян намудани гурӯҳ*/
		
		/*Баровардани фанхо аз руи нақшаи таълимӣ*/
		$semestr = getSemestr($id_course, $H_Y);
		/*Баровардани фанхо аз руи нақшаи таълимӣ*/
		
		
		$fanlist = query("
		
		SELECT
			`nt_content`.*,
			`iqtibosho`.*
		FROM
			`iqtibosho`
		INNER JOIN `nt_content` ON `nt_content`.`id_nt` = `iqtibosho`.`id_nt` 
		AND `nt_content`.`id_fan` = `iqtibosho`.`id_fan`
		AND `nt_content`.`semestr` = `iqtibosho`.`semestr`
		AND `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$semestr'
		WHERE
			`iqtibosho`.`id_fan` != '1748' AND `iqtibosho`.`id_group` = '$id_group';
		");
		
		
		
		$page_info['title'] = "Сводни ведомости имтиҳонӣ(баъди триместр) / ".getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup2($id_group);
		
		//$page_info['title'] = "Сводни ведомости рейтинги $rating";
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		include("views/vedomost/{$action}.php");
		exit;
	break;
	
	case "vedomost":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		$check_faculty = query("SELECT `id_faculty` FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		
		// if($check_faculty[0]['id_faculty'] == 7){
			// $file = "vedomost_7.php";
		// }else{
			$file = "vedomost.php";
		//}
		
		if(isset($_SESSION['user']['admin']) || isset($contingent_module)){
			
		
			$teachers = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
			
			$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data_iq[0]['id_faculty'];
			$id_s_l = $data_iq[0]['id_s_l'];
			$id_s_v = $data_iq[0]['id_s_v'];
			$id_course = $data_iq[0]['id_course'];
			$id_spec = $data_iq[0]['id_spec'];
			$id_group = $data_iq[0]['id_group'];
			$semestr = $data_iq[0]['semestr'];
			$credits = $data_iq[0]['credits'];
			

			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_departament = $data_iq[0]['id_departament'];
			$id_fan = $data_iq[0]['id_fan'];
			
			$S_Y = $data_iq[0]['s_y'];

			$lang  =  getZaboniTahsil($id_faculty, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group, $S_Y, $H_Y);
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			$date_imt = query("SELECT `datetime` FROM `tests` WHERE `id_iqtibos`='$id_iqtibos'");
			$date_imt = @$date_imt[0]['datetime'];
			
			$page_info['title'] = 'Чопи ведомост / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			include("views/vedomost/{$file}");
			
		}else{
			$id_teacher = $_SESSION['user']['id'];
			//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
			$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
			
			if(!empty($check)){
				
				$teachers = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
			
				$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
				$id_faculty = $data_iq[0]['id_faculty'];
				$id_s_l = $data_iq[0]['id_s_l'];
				$id_s_v = $data_iq[0]['id_s_v'];
				$id_course = $data_iq[0]['id_course'];
				$id_spec = $data_iq[0]['id_spec'];
				$id_group = $data_iq[0]['id_group'];
				$semestr = $data_iq[0]['semestr'];
				
				if($semestr % 2 == 0){
					$H_Y = 2;
				}else $H_Y = 1;
				
				$id_departament = $data_iq[0]['id_departament'];
				$id_fan = $data_iq[0]['id_fan'];
				
				$S_Y = $data_iq[0]['s_y'];
				
				$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
				
				$page_info['title'] = 'Чопи ведомост / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);
				setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
				
				$date_imt = query("SELECT `datetime` FROM `tests` WHERE `id_iqtibos`='$id_iqtibos'");
				$date_imt = $date_imt[0]['datetime'];
				
				include("views/vedomost/{$file}");
			}else{
				$page_info['title'] = "Шумо барои дидани ведомости ин фан иҷозат надоред!!!";
				echo $page_info['title'];
				setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			}
		}
		exit;
	break;
	
	case "vedomost_trimestr":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		$check_faculty = query("SELECT `id_faculty` FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		
		if($check_faculty[0]['id_faculty'] == 7){
			$file = "vedomost_7.php";
		}else{
			$file = "vedomost_trimestr.php";
		}
		
		if(isset($_SESSION['user']['admin']) || isset($contingent_module)){
			
		
			$teachers = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
			
			$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data_iq[0]['id_faculty'];
			$id_s_l = $data_iq[0]['id_s_l'];
			$id_s_v = $data_iq[0]['id_s_v'];
			$id_course = $data_iq[0]['id_course'];
			$id_spec = $data_iq[0]['id_spec'];
			$id_group = $data_iq[0]['id_group'];
			$semestr = $data_iq[0]['semestr'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_departament = $data_iq[0]['id_departament'];
			$id_fan = $data_iq[0]['id_fan'];
			
			$S_Y = $data_iq[0]['s_y'];
			
			$students = query("SELECT `results`.*, `students`.*, `users`.* FROM `results` INNER JOIN `students` INNER JOIN `users`
								ON `results`.`id_student` = `users`.`id` AND
									`results`.`id_student` = `students`.`id_student`
								WHERE `results`.`id_faculty`='$id_faculty' AND
									`results`.`id_s_l` = '$id_s_l' AND
									`results`.`id_s_v` = '$id_s_v' AND
									`results`.`id_course` = '$id_course' AND
									`results`.`id_spec` = '$id_spec' AND
									`results`.`id_group` = '$id_group' AND
									`results`.`id_fan` = '$id_fan' AND
									`results`.`trimestr_score` > '0' AND
									`results`.`s_y` = '$S_Y' AND
									`results`.`h_y` = '$H_Y' AND
									`students`.`status` = '1' AND
									`students`.`s_y` = '$S_Y' AND
									`students`.`h_y` = '$H_Y'
								ORDER BY `users`.`fullname_tj`
							");
			
			//print_arr($students);exit;
			
			$date_imt = query("SELECT `datetime` FROM `tests` WHERE `id_iqtibos`='$id_iqtibos'");
			$date_imt = @$date_imt[0]['datetime'];
			
			$page_info['title'] = 'Чопи ведомост / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			include("views/vedomost/{$file}");
			
		}else{
			$id_teacher = $_SESSION['user']['id'];
			//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
			$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
			
			if(!empty($check)){
				
				$teachers = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
			
				$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
				$id_faculty = $data_iq[0]['id_faculty'];
				$id_s_l = $data_iq[0]['id_s_l'];
				$id_s_v = $data_iq[0]['id_s_v'];
				$id_course = $data_iq[0]['id_course'];
				$id_spec = $data_iq[0]['id_spec'];
				$id_group = $data_iq[0]['id_group'];
				$semestr = $data_iq[0]['semestr'];
				
				if($semestr % 2 == 0){
					$H_Y = 2;
				}else $H_Y = 1;
				
				$id_departament = $data_iq[0]['id_departament'];
				$id_fan = $data_iq[0]['id_fan'];
				
				$S_Y = $data_iq[0]['s_y'];
				
				$students = query("SELECT `results`.*, `students`.*, `users`.* FROM `results` INNER JOIN `students` INNER JOIN `users`
								ON `results`.`id_student` = `users`.`id` AND
									`results`.`id_student` = `students`.`id_student`
								WHERE `results`.`id_faculty`='$id_faculty' AND
									`results`.`id_s_l` = '$id_s_l' AND
									`results`.`id_s_v` = '$id_s_v' AND
									`results`.`id_course` = '$id_course' AND
									`results`.`id_spec` = '$id_spec' AND
									`results`.`id_group` = '$id_group' AND
									`results`.`id_fan` = '$id_fan' AND
									`results`.`trimestr_score` > '0' AND
									`results`.`s_y` = '$S_Y' AND
									`results`.`h_y` = '$H_Y' AND
									`students`.`status` = '1' AND
									`students`.`s_y` = '$S_Y' AND
									`students`.`h_y` = '$H_Y'
								ORDER BY `users`.`fullname_tj`
							");
			
			
				
				$page_info['title'] = 'Чопи ведомост / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);
				setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
				
				$date_imt = query("SELECT `datetime` FROM `tests` WHERE `id_iqtibos`='$id_iqtibos'");
				$date_imt = $date_imt[0]['datetime'];
				
				include("views/vedomost/{$file}");
			}else{
				$page_info['title'] = "Шумо барои дидани ведомости триместр аз ин фан иҷозат надоред!!!";
				echo $page_info['title'];
				setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			}
		}
		exit;
	break;
	
	case "vedomost_kk":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		//if(isset($_SESSION['user']['admin'])){
			
		
			$teachers = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
			
			$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data_iq[0]['id_faculty'];
			$id_s_l = $data_iq[0]['id_s_l'];
			$id_s_v = $data_iq[0]['id_s_v'];
			$id_course = $data_iq[0]['id_course'];
			$id_spec = $data_iq[0]['id_spec'];
			$id_group = $data_iq[0]['id_group'];
			$semestr = $data_iq[0]['semestr'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_departament = $data_iq[0]['id_departament'];
			$id_fan = $data_iq[0]['id_fan'];
			
			$S_Y = $data_iq[0]['s_y'];
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			$page_info['title'] = 'Чопи ведомости кори курсӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			include("views/vedomost/{$action}.php");
			
		//}else{
			$id_teacher = $_SESSION['user']['id'];
			//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
			$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
			
			if(!empty($check)){
				
				$teachers = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
			
				$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
				$id_faculty = $data_iq[0]['id_faculty'];
				$id_s_l = $data_iq[0]['id_s_l'];
				$id_s_v = $data_iq[0]['id_s_v'];
				$id_course = $data_iq[0]['id_course'];
				$id_spec = $data_iq[0]['id_spec'];
				$id_group = $data_iq[0]['id_group'];
				$semestr = $data_iq[0]['semestr'];
				
				if($semestr % 2 == 0){
					$H_Y = 2;
				}else $H_Y = 1;
				
				$id_departament = $data_iq[0]['id_departament'];
				$id_fan = $data_iq[0]['id_fan'];
				
				$S_Y = $data_iq[0]['s_y'];
				
				$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
				
				$page_info['title'] = 'Чопи ведомости кори курсӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);
				setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
				
				include("views/vedomost/{$action}.php");
			//}else{
				//$page_info['title'] = "Шумо барои дидани ведомости ин фан иҷозат надоред!!!";
				//echo $page_info['title'];
				//setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			//}
		}
		exit;
	break;
	
	case "vedomost_ilm":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		if(isset($_SESSION['user']['admin'])){
			
		
			$teachers = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
			
			$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data_iq[0]['id_faculty'];
			$id_s_l = $data_iq[0]['id_s_l'];
			$id_s_v = $data_iq[0]['id_s_v'];
			$id_course = $data_iq[0]['id_course'];
			$id_spec = $data_iq[0]['id_spec'];
			$id_group = $data_iq[0]['id_group'];
			$semestr = $data_iq[0]['semestr'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_departament = $data_iq[0]['id_departament'];
			$id_fan = $data_iq[0]['id_fan'];
			
			$S_Y = $data_iq[0]['s_y'];
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			$page_info['title'] = 'Чопи ведомост / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			include("views/vedomost/{$action}.php");
			
		}else{
			$id_teacher = $_SESSION['user']['id'];
			//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
			$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
			
			if(!empty($check)){
				
				$teachers = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
			
				$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
				$id_faculty = $data_iq[0]['id_faculty'];
				$id_s_l = $data_iq[0]['id_s_l'];
				$id_s_v = $data_iq[0]['id_s_v'];
				$id_course = $data_iq[0]['id_course'];
				$id_spec = $data_iq[0]['id_spec'];
				$id_group = $data_iq[0]['id_group'];
				$semestr = $data_iq[0]['semestr'];
				
				if($semestr % 2 == 0){
					$H_Y = 2;
				}else $H_Y = 1;
				
				$id_departament = $data_iq[0]['id_departament'];
				$id_fan = $data_iq[0]['id_fan'];
				
				$S_Y = $data_iq[0]['s_y'];
				
				$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
				
				$page_info['title'] = 'Чопи ведомост / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);
				setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
				
				include("views/vedomost/{$action}.php");
			}else{
				$page_info['title'] = "Шумо барои дидани ведомости ин фан иҷозат надоред!!!";
				echo $page_info['title'];
				setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			}
		}
		exit;
	break;
	
	
	case "credit_problem":
		//SELECT * FROM `nt_content` WHERE `c_u` > 6
		
		$list = query("
		SELECT 
			`nt_content`.*,
			`nt_list`.*
		FROM `nt_content`
		INNER JOIN `nt_list` ON `nt_list`.`id` = `nt_content`.`id_nt`
		WHERE `nt_content`.`c_u` > 6
		");
		
		$page_info['title'] = "Кредитҳои >6";
		
		
		include("views/{$action}.php");
		exit;
	break;
	
	case "sarboriho":
		
		$list = query("
		SELECT 
			`iqtibosho`.*,
			`sarboriho`.*
		FROM `iqtibosho`
		INNER JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
		ORDER BY `iqtibosho`.`id_faculty`, `iqtibosho`.`id_course`, `iqtibosho`.`id_spec`, `iqtibosho`.`id_group`
		");
		
		
		$page_info['title'] = "Сарбориҳо";
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "sarboriho_export":
		$list = query("
		SELECT 
			`iqtibosho`.*,
			`sarboriho`.*
		FROM `iqtibosho`
		INNER JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
		ORDER BY `iqtibosho`.`id_faculty`, `iqtibosho`.`id_course`, `iqtibosho`.`id_spec`, `iqtibosho`.`id_group`
		");
		
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Руйхати тақсимоти фанҳо'); // Задайте здесь нужное имя
		
		// Задаем значения в ячейки
		$sheet->setCellValue('A1', '№');
		$sheet->setCellValue('B1', 'Факултет');
		$sheet->setCellValue('C1', 'Курс');
		$sheet->setCellValue('D1', 'Гуруҳ');
		$sheet->setCellValue('E1', 'Зинаи таҳсил');
		$sheet->setCellValue('F1', 'Ном фан');
		$sheet->setCellValue('G1', 'Намуди дарс');
		$sheet->setCellValue('H1', 'Омӯзгор');
		$sheet->setCellValue('I1', 'Кафедра');
		
		$style = $sheet->getStyle('A1:I1');
		
		// Применяем жирное форматирование к ячейке
		$style->getFont()->setBold(true);
		$style->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
		$style->getFill()->getStartColor()->setARGB('FFFFFF00'); // Укажите здесь нужный цвет
		
		$counter = 2;
		$i = 1;
		foreach($list as $item){
			$sheet->setCellValue("A{$counter}", $i++);
			$sheet->setCellValue("B{$counter}", getFacultyShort($item['id_faculty']));
			$sheet->setCellValue("C{$counter}", $item['id_course']);
			$sheet->setCellValue("D{$counter}", getSpecialtyCode($item['id_spec']).' '.getGroup2($item['id_group']).'-'.getStudyView($item['id_s_v']));
			$sheet->setCellValue("E{$counter}", getStudyLevel($item['id_s_l']));
			$sheet->setCellValue("F{$counter}", getFanTest($item['id_fan']));
			$sheet->setCellValue("G{$counter}", $dars_namud[$item['type']]);
			$sheet->setCellValue("H{$counter}", getUserName($item['id_teacher']));
			$sheet->setCellValue("I{$counter}", getDepartament($item['id_departament']));
			
			
			$counter++;
		}
		
		// Настроим автоматическую ширину для всех столбцов
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		
		
		// Создаем объект класса Xlsx Writer
		$writer = new Xlsx($spreadsheet);

		// Указываем имя файла
		$filename = 'example.xlsx';

		// Определяем тип контента для заголовков HTTP
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		// Отправляем файл в поток вывода (output)
		$writer->save('php://output');
		
		
		
		
		
		$page_info['title'] = "Сарбориҳо файл";
		
		exit;
	break;
	
	case "trimestr":
		//type = 11
		
		$students = query("SELECT 
		`rasidho`.*, 
		`students`.*, 
		`users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` AND `students`.`foreign` IS NULL
		INNER JOIN `rasidho` ON `rasidho`.`id_student` = `users`.`id`
		
		WHERE 
		`rasidho`.`type` = '11' AND
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		ORDER BY `students`.`id_faculty`, `students`.`id_course`, `students`.`id_spec`,  `students`.`id_group`
		"); 
		
		$page_info['title'] = "Триместр ";
		include("views/{$action}.php");
		exit;
		exit;
	break;
	
	case "dgwos":
		$groups = query("SELECT * FROM `std_study_groups`");
		
		foreach($groups as $item){
			
			$stds = query("SELECT * FROM `students` WHERE 
			`status` = '1' AND
			`id_faculty` = '{$item['id_faculty']}' AND
			`id_s_l` = '{$item['id_s_l']}' AND
			`id_s_v` = '{$item['id_s_v']}' AND
			`id_course` = '{$item['id_course']}' AND
			`id_spec` = '{$item['id_spec']}' AND
			`id_group` = '{$item['id_group']}'");
			
			if(empty($stds)){
				delete("std_study_groups", "`id` = '{$item['id']}'");
				echo $item['id']." ";
			}
		}
		exit;
	break;
	
	case "hissobot_kassa":
		$id_faculty = $_REQUEST['id_faculty'];
		
		$datas = query("SELECT * FROM `std_study_groups` WHERE `status` = 1 AND `id_faculty` = '$id_faculty' 
		AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
		ORDER BY `id_course`, `id_spec`, `id_group`");
		
		$page_info['title'] = "Ҳисобот касса: ".getFaculty($id_faculty);
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "hissobot_kassa_trimestr":
		$page_info['title'] = "Чекҳои триместр";
		include("views/{$action}.php");
		exit;
	break;
	
	case "hissobot_kassa_litsey":
		
		$page_info['title'] = "Ҳисобот касса: Литсей";
		include("views/{$action}.php");
		exit;
	break;
	
	
	
	
	
	
	case "blanka_namuna";
		$groups = query("SELECT DISTINCT(`id_spec`), `id_faculty`,`id_s_l`,`id_s_v`,`id_course`,`id_group` FROM `state_groups`
		WHERE `id_course` = '1'
		ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_group`
		");
		
		
		
		$page_info['title'] = "Бланка намуна";
		include("views/{$action}.php");
		exit;
	break;
	
	case "baxa":
		
		$students = query("SELECT 
		`user_udecation`.*, 
		`user_passports`.*, 
		`students`.*, 
		`users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		
		WHERE 
		`students`.`status` = '1' AND 
		
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		ORDER BY `students`.`id_faculty`, `students`.`id_course`, `students`.`id_spec`, `students`.`id_group`, `users`.`fullname_tj`"); 
		
		$page_info['title'] = "BAXA";
		include("views/{$action}.php");
		exit;
	break;
	
	case "davatnoma":
		$id_davr = $_REQUEST['id_davr'];
		$students = query("SELECT 
		`student_mmt_information`.*, 
		`user_udecation`.*, 
		`user_passports`.*, 
		`students`.*, 
		`users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` AND `students`.`foreign` IS NULL
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		AND `student_mmt_information`.`davri_qabul_mmt` = '$id_davr'
		WHERE 
		`students`.`status` = '-1' AND 
		`students`.`id_s_l` = '1' AND 
		`students`.`id_s_t` = '1' AND 
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		ORDER BY `students`.`id_faculty`, `students`.`id_spec`, `students`.`id_group`
		"); 
		
		$page_info['title'] = "Даъватнома";
		include("views/{$action}.php");
		exit;
	break;
	
	case "farmon_kvota":
		$id_davr = $_REQUEST['id_davr']; 
		
		$groups = query("SELECT * FROM `std_study_groups` WHERE `id_s_l` = 1 AND `id_course` = 2 AND `s_y` = 23 AND `h_y` = 1 
		ORDER BY `id_faculty`, `id_s_v`, `id_spec`, `id_group`");
		
		$page_info['title'] = "Фармоиш";
		include("views/{$action}.php");
		exit;
	break;
	
	case "farmon":
		$id_davr = $_REQUEST['id_davr'];
		$groups = query("SELECT * FROM `std_study_groups` WHERE `id_s_l` = 1 AND `id_course` = 1 AND `s_y` = 23 AND `h_y` = 1 
		ORDER BY `id_faculty`, `id_s_v`, `id_spec`, `id_group`");
		
		
		$page_info['title'] = "Фармоиш: $id_davr";
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/{$action}.php");
		exit;
	break;
	
	case "peshnihod_commission":
		$id_davr = $_REQUEST['id_davr'];
		
		$page_info['title'] = "Пешниҳоди тақсимоти даври $id_davr";
		include("views/{$action}.php");
		exit;
	break;
	
	case "peshnihod_it_m2":
		$page_info['title'] = "Пешниҳоди идомаи таҳсил ва маълумоти дуюм";
		include("views/{$action}.php");
		exit;
	break;
	
	case "peshnihod_magistratura":
		$page_info['title'] = "Пешниҳоди магистратура";
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "export":	
		$S_Y = 24;
		$H_Y = 1;
		$students = query("SELECT 
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
		
		WHERE `students`.`status` = '-1' AND 
		`students`.`s_y` = '$S_Y' AND 
		`students`.`h_y` = '$H_Y'
		ORDER BY 
			`students`.`id_faculty`,
			`students`.`id_s_l`,
			`students`.`id_s_v`,
			`students`.`id_course`,
			`students`.`id_spec`,
			`students`.`id_group`
		");
		
		$page_info['title'] = "Export";
		include("views/export.php");
		exit;
	break;
	
	case "export_for_import":	
		$S_Y = 24;
		$H_Y = 1;
		$students = query("SELECT 
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
		LEFT JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		LEFT JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		
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
		
		WHERE `students`.`status` = '1' AND 
		`students`.`s_y` = '$S_Y' AND 
		`students`.`h_y` = '$H_Y'
		ORDER BY 
			`students`.`id_faculty`,
			`students`.`id_s_l`,
			`students`.`id_s_v`,
			`students`.`id_course`,
			`students`.`id_spec`,
			`students`.`id_group`,
			`users`.`fullname_tj`
		");
		
		$page_info['title'] = "Export for IMPORT";
		include("views/export_for_import.php");
		exit;
	break;
	
	case "export_m2":	
		//$datas = query("SELECT * FROM `std_study_groups` WHERE `id_course` = '1' AND `id_s_l` = '2' ORDER BY `id_faculty`");
		
		
		$students = query("SELECT 
		`users`.*, `students`.*, `user_passports`.*, `user_udecation`.*
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		WHERE
		`students`.`id_course` = '1' AND `students`.`id_s_l` = '2' AND
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		
		ORDER BY `students`.`id_faculty`, `students`.`id_spec`
		");
		
		
		$page_info['title'] = "Export M2";
		include("views/export_m2.php");
		exit;
	break;
	
	case "export_after_college":	
		//$datas = query("SELECT * FROM `std_study_groups` WHERE `id_course` = '1' AND `id_s_l` = '2' ORDER BY `id_faculty`");
		
		$students = query("SELECT 
		`users`.*, `students`.*, `user_passports`.*, `user_udecation`.*
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		WHERE
		`user_udecation`.`id_khatm_namud` = '2' AND
		`student_mmt_information`.`davri_qabul_mmt` = '4' AND
		`students`.`status` = '-1' AND
		`students`.`id_s_l` = '1' AND 
		`students`.`foreign` IS NULL AND
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		
		ORDER BY `students`.`id_faculty`, `students`.`id_spec`
		");
		
		
		$page_info['title'] = "Export After College";
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "dovtalab_list":
		
		$students = query("SELECT 
		`users`.*, `students`.*, `user_passports`.*, `user_udecation`.*
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		WHERE
		`student_mmt_information`.`number_mmt` IS NOT NULL AND
		`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		
		ORDER BY `students`.`id_faculty`, `students`.`id_spec`
		");
		
		
		$page_info['title'] = "Руйхати довталабон";
		include("views/{$action}.php");
		exit;
	break;
	
	case "commission_statistic":
		if(isset($_REQUEST['date_start'])){
			$date_start = $_REQUEST['date_start'];
			$date_finish = $_REQUEST['date_finish'];
		}
		else {
			$date_start = false;
			$date_finish = false;
		}
		
		
		
		include("../modules/commission/views/statistic_data.php");
		exit;
	break;
	
	case "print_check":
		$id = $_REQUEST['id'];
		$check = @$_REQUEST['id_check'];
		
		$type = $_REQUEST['type'];
		
		$check = query("SELECT * FROM `rasidho` WHERE `id_student` = '$id' and type='$type' ");
		
		$id_check = $check[0]['id'];
		$id_student = $check[0]['id_student'];
		
		$student = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		if(count($check) == 0 ){echo "Расид сохта нашудааст.";exit;}
		
		
		$page_info['title'] = "Чопи расид: №$id";
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "print_check1":
		$id_check = $_REQUEST['id'];
		
		$check = query("SELECT * FROM `rasidho` WHERE `id` = '$id_check'");
		
		$type = $check[0]['type'];
		$id_student = $check[0]['id_student'];
		
		$student = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		if(count($check) == 0 ){echo "Расид сохта нашудааст.";exit;}
		
		
		$page_info['title'] = "Чопи расид: №$id_check";
		
		$action = 'print_check';
		include("views/{$action}.php");
		exit;
	break;
	
	
	
	case "dovtalab_info":
		$id_student = $_REQUEST['id'];
		
		$student = query("SELECT `student_mmt_information`.*, `user_udecation`.*, `user_passports`.*, `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		$page_info['title'] = "Чопи маълумотномаи: ".getUserName($id_student);
		
		
		$info = query("SELECT COUNT(`id`) as `n` FROM `students` WHERE `status` = '-1' AND 
		`id_faculty` = '{$student[0]['id_faculty']}' AND 
		`id_s_l` = '{$student[0]['id_s_l']}' AND 
		`id_s_v` = '{$student[0]['id_s_v']}' AND 
		`id_spec` = '{$student[0]['id_spec']}' AND 
		`id_student` < '$id_student' AND `s_y` = '".S_Y."'");
		
		$number = $info[0]['n'] + 1;
		
		include("views/{$action}.php");
		exit;
	break;
	
	case "ariza":
		$id_student = $_REQUEST['id'];
		
		$student = query("SELECT `student_mmt_information`.*, `user_udecation`.*, `user_passports`.*, `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		LEFT JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		$page_info['title'] = "Чопи аризаи: ".getUserName($id_student);
		
		include("views/{$action}.php");
		exit;
	break;
	
	
	
	
	
	case "zabonkhat":
		$id_student = $_REQUEST['id'];
		
		
		
		$student = query("SELECT `student_mmt_information`.*, `user_udecation`.*, `user_passports`.*, `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		LEFT JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		$checks = query("SELECT * FROM `rasidho` WHERE `type` = '2' AND `payed` = '1' AND `id_student` = '$id_student' ORDER BY `id` DESC LIMIT 1");
		
		
		if(!empty($checks) || $student[0]['id_s_t'] != 1){	
			
			
			$checks = query("SELECT * FROM `rasidho` WHERE `type` = '2' AND `payed` = '1' AND `id_student` = '$id_student' ORDER BY `id` DESC LIMIT 1");
			
			$page_info['title'] = "Чопи забонхат: ".getUserName($id_student);
			
			include("views/{$action}.php");
		}else {
			echo "Расид пардохт нашудааст!";
		}
		exit;
	break;
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	case "peshnihod_t_pad":
		$page_info['title'] = "Пешниҳоди сессия";
		
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "peshnihod_session":
		$page_info['title'] = "Пешниҳоди сессия";
		
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "shartnoma":
		
		$page_info['title'] = "Ҳисобкунии шартномаҳои таҳсил";
		
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		include("views/{$action}.php");
		exit;
		
		//$money = getMoneyShartnoma($item['id'], S_Y);
	break;
	
	
	case "vedomost":
		$page_info['title'] = "Супоридани ведомостҳо ";
		
		include("views/{$action}.php");
		exit;
	break;
	
	case "tabel_student":
		if(isset($_REQUEST['id_student'])){
			
			$id_student = $_REQUEST['id_student'];
			$s_y = $_REQUEST['s_y'];
			$h_y = $_REQUEST['h_y'];
			
			$student = query("SELECT `students`.*, `users`.* FROM `users`
			INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
			WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
			AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
			ORDER BY `users`.`fullname_tj`");
			
			$page_info['title'] = "Табели донишҷӯ: ".$student[0]['fullname_tj'];
		
		}else{
			
			$id_faculty = $_REQUEST['id_faculty'];
			$id_s_v = $_REQUEST['id_s_v'];
			$id_course = $_REQUEST['id_course'];
			$id_spec = $_REQUEST['id_spec'];
			$id_group = $_REQUEST['id_group'];
			
			
			/* Баровардани контингенти гурух */
			$students = query("SELECT `students`.*, `users`.* FROM `users`
			INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
			WHERE `students`.`status` = '1'
			AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
			AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
			AND `students`.`id_s_v` = '$id_s_v' 
			AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
			ORDER BY `users`.`fullname_tj`
			");
			/* Баровардани контингенти гурух */
			
			
			
			
			$page_info['title'] = "Табели донишҷӯён";
		}
		
		include("views/{$action}.php");
		exit;
	break;
	
	case "studentlist":
		$page_info['title'] = 'Руйхати донишҷӯён';
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		
		/* Баровардани контингенти гурух */
		$students = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		WHERE `students`.`status` = '1'
		AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
		AND `students`.`id_s_v` = '$id_s_v' 
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		ORDER BY `users`.`fullname_tj`
		");
		/* Баровардани контингенти гурух */
		
		
		
		
		$start_day = strtotime("26 December 2022");
		$end_date = strtotime("7 January 2023");
		
		$f_date = new DateTime("2022-12-26");
		$l_date = new DateTime("2023-01-08");
		$period = new DatePeriod($f_date, new DateInterval('P1D'), $l_date);
		
		$arrayOfDays = array_map(
			function($item){
				return $item->format('d.m.Y');
			},
			iterator_to_array($period)
		);
		
		
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "tabel":
		$month = $_REQUEST['month'];
		$year = date("Y");

		$days = date('t', mktime(0, 0, 0, $month, 1, $year)); // 29
		
		$users = [1 => 1, 2 => 884, 3 => 885];
		
		$vazifa = [
			1 => 'Сардори марказ',
			2 => 'Муовини сардор',
			3 => 'Муттасади аудиовизуалӣ',
		];
		
		$page_info['title'] = 'Табел';
		include("views/{$action}.php");
		exit;
	break;
	
	case "obuna":
		$page_info['title'] = 'Барои обуна';
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/{$action}.php");
		exit;
	break;
	
	case "oblava":
		
		$page_info['title'] = 'Руйхат барои кадр';
		
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/{$action}.php");
		exit;
	break;
	
	case "shakli_5":
		$page_info['title'] = 'Шакли 5';
		
		$s_y = S_Y;
		$h_y = H_Y;
		
		//setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		include("views/{$action}.php");
		exit;
	break;
	
	case "svodni":
		$id = $_REQUEST['id'];
		
		$query = query("SELECT * FROM `jd` WHERE `id` = '$id'");
		
		$id_faculty = $query[0]['id_faculty'];
		$id_course = $query[0]['id_course'];
		$id_spec = $query[0]['id_spec'];
		$id_group = $query[0]['id_group'];
		$id_fan = $query[0]['id_fan'];
		$id_teacher = $query[0]['id_teacher'];
		
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$id_s_v = 2;
		$id_leader_mbd = 1;
		
		/* Баровардани контингенти гурух */
		$students = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		WHERE `students`.`status` = '1'
		AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
		AND `students`.`id_s_v` = '$id_s_v' 
		AND `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
		ORDER BY `users`.`fullname_tj`
		");
		/* Баровардани контингенти гурух */
		
		
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		$group_options = select("std_study_groups", array("id_nt", "lang"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'", "id", false, "");
		$id_nt = @$group_options[0]['id_nt'];
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		
		/*Баровардани фанхо аз руи нақшаи таълимӣ*/
		$fanlist = query("
		SELECT `jd`.*, `nt_content`.* FROM `nt_content`
		INNER JOIN `jd` ON `jd`.`id_fan` = `nt_content`.`id_fan` AND `jd`.`id_course` = `nt_content`.`id_course`
		WHERE `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`id_course` = '$id_course'
		AND `nt_content`.`h_y` = '$H_Y'
		AND `jd`.`id_faculty` = '$id_faculty' AND `jd`.`id_course` = '$id_course' 
		AND `jd`.`id_spec` = '$id_spec' AND `jd`.`id_group` = '$id_group' 
		AND `jd`.`s_y` = '$S_Y' AND `jd`.`h_y` = '$H_Y'
		");
		/*Баровардани фанхо аз руи нақшаи таълимӣ*/
		
		
		$query = query("SELECT SUM(`c_u`) as `credit_sum` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `id_course` = '$id_course' AND `h_y` = '$H_Y'");
		$sum_credit = $query[0]['credit_sum'];
		
		$page_info['title'] = 'Сводни ведомост: '.getStudyYear($S_Y).' нимсола: '.$H_Y.'; '.getFaculty($id_faculty). '; '.getCourse($id_course).'; Ихтисос: '.getSpecialtyCode($id_spec).' '.getGroup2($id_group);
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/{$action}.php");
		exit;
	break;
	
	case "print_imt":
		$id = $_REQUEST['id'];
		
		$query = query("SELECT * FROM `jd` WHERE `id` = '$id'");
		
		$id_faculty = $query[0]['id_faculty'];
		$id_course = $query[0]['id_course'];
		$id_spec = $query[0]['id_spec'];
		$id_group = $query[0]['id_group'];
		$id_fan = $query[0]['id_fan'];
		$id_teacher = $query[0]['id_teacher'];
		
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$id_s_v = 2;
		$id_leader_mbd = 1;
		
		/* Баровардани контингенти гурух */
		$students = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		WHERE `students`.`status` = '1'
		AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
		AND `students`.`id_s_v` = '$id_s_v' 
		AND `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
		ORDER BY `users`.`fullname_tj`
		");
		/* Баровардани контингенти гурух */
		
		
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		$group_options = select("std_study_groups", array("id_nt", "lang"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'", "id", false, "");
		$id_nt = @$group_options[0]['id_nt'];
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		
		$page_info['title'] = 'Ведомости имтиҳонии фаннӣ: '.getFan($id_fan);
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/{$action}.php");
		exit;
	break;
	
	case "print_kk":
		$id = $_REQUEST['id'];
		
		$query = query("SELECT * FROM `jd` WHERE `id` = '$id'");
		
		$id_faculty = $query[0]['id_faculty'];
		$id_course = $query[0]['id_course'];
		$id_spec = $query[0]['id_spec'];
		$id_group = $query[0]['id_group'];
		$id_fan = $query[0]['id_fan'];
		$id_teacher = $query[0]['id_teacher'];
		
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$id_s_v = 2;
		
		
		/* Баровардани контингенти гурух */
		$students = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		WHERE `students`.`status` = '1'
		AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
		AND `students`.`id_s_v` = '$id_s_v' 
		AND `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
		ORDER BY `users`.`fullname_tj`
		");
		/* Баровардани контингенти гурух */
		
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		$group_options = select("std_study_groups", array("id_nt", "lang"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'", "id", false, "");
		$id_nt = @$group_options[0]['id_nt'];
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		
		$page_info['title'] = 'Ведомости кори курсӣ аз фанни '.getFan($id_fan);
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/{$action}.php");
		exit;
	break;
	
	case "print_nf":
		$id = $_REQUEST['id'];
		
		$query = query("SELECT * FROM `jd` WHERE `id` = '$id'");
		
		$id_faculty = $query[0]['id_faculty'];
		$id_course = $query[0]['id_course'];
		$id_spec = $query[0]['id_spec'];
		$id_group = $query[0]['id_group'];
		$id_fan = $query[0]['id_fan'];
		$id_teacher = $query[0]['id_teacher'];
		
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$id_s_v = 2;
		
		
		/* Баровардани контингенти гурух */
		$students = query("SELECT `students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		WHERE `students`.`status` = '1'
		AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
		AND `students`.`id_s_v` = '$id_s_v' 
		AND `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
		ORDER BY `users`.`fullname_tj`
		");
		/* Баровардани контингенти гурух */
		
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		$group_options = select("std_study_groups", array("id_nt", "lang"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'", "id", false, "");
		$id_nt = @$group_options[0]['id_nt'];
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		
		$page_info['title'] = 'Ведомости фанни '.getFan($id_fan);
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/{$action}.php");
		exit;
	break;
	
	case "dep_member_list":
		$id_departament = $_REQUEST['id'];
		
		$members = query("SELECT * FROM `users` WHERE `id` IN 
		(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` = '$id_departament' AND `s_y` = '".S_Y."')
		ORDER BY `fullname_tj`");
		
		
		$page_info['title'] = 'Руйхати аъзоёни кафедраи '.getDepartament($id_departament);
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/{$action}.php");
		exit;
	break;
	
	case "contingent":
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$page_info['title'] = 'Контингент';
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "login":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		
		$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		
		$page_info['title'] = 'Логинҳо ва паролҳо';
		include("views/{$action}.php");
		exit;
	break;
	
	case "davrifaol":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$students = select("students", array('id_student'), "
		`id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group'",
		"id_student", false, "");
		
		$array = [];
		foreach ($students as $item){
			$array[] = $item['id_student'];
		}
		
		$id_student = implode(",", $array);
		
		$nepodusk = select("std_nedopusk", array("DISTINCT(id_student)"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'", "id_student", false, "");
		
		$ishtirok_kardand = select("std_resultsimt", array("DISTINCT(id_student)"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'", "id_student", false, "");
		
		
		$page_info['title'] = 'Ҷадвали даври фаъол';
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "statisticincourse":
		if(isset($_REQUEST['id_faculty'])){
			$id_faculty = $_REQUEST['id_faculty'];
			$all_stds_where = "`id_faculty` = '$id_faculty' AND ";
			$mw_where = "`students`.`status` = '1' AND `students`.`id_faculty` = '$id_faculty' AND ";
			$mw_where1 = "`std_table`.`status` = '1' AND `std_table`.`id_faculty` = '$id_faculty' AND ";
		}else{
			$all_stds_where = "";
			$mw_where = "`students`.`status` = '1' AND ";
			$mw_where1 = "`std_table`.`status` = '1' AND ";
		}
		
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$statistic = query("
		select `std_table`.`id_course`, count(`std_table`.`id`) as `all`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '1' AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' ORDER BY `id_course`) as `mans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '0' AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' ORDER BY `id_course`) as `woman`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `students`.`id_s_v` = 1 AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' ORDER BY `id_course`) as `all_ruz`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '1' AND `students`.`id_s_v` = 1 AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' ORDER BY `id_course`) as `ruz_mans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '0' AND `students`.`id_s_v` = 1 AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' ORDER BY `id_course`) as `ruz_womans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `students`.`id_s_v` = 2 AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' ORDER BY `id_course`) as `all_fos`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '1' AND `students`.`id_s_v` = 2 AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' ORDER BY `id_course`) as `fos_mans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '0' AND `students`.`id_s_v` = 2 AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' ORDER BY `id_course`) as `fos_womans`,
		`std_table`.`s_y`,
		`std_table`.`h_y`
		from `students` as `std_table` WHERE $mw_where1 `std_table`.`s_y` = '".S_Y."' AND `std_table`.`h_y` = '".S_Y."' GROUP BY 1 ORDER BY `std_table`.`id_course`
		
		");
		
		$page_info['title'] = 'Ҷадвали нишондод дар курсҳо';
		include("views/{$action}.php");
		exit;
	break;
	
	case "statisticingroups":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$statistic = query("
			SELECT `id_faculty`,`title`, 
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as allgroups,
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `id_s_v` = 1 AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as ruzona,
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `id_s_v` = 2 AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as fosilavi,
			`s_y`, `h_y`
			FROM `real_faculties` as `r_f` WHERE `s_y` = '".$S_Y."' AND `h_y` = '".$H_Y."' ORDER BY `title`
		");
		$page_info['title'] = 'Ҷадвали нишондод дар гурӯҳҳои академӣ';
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "transcript":
		$id_student = $_REQUEST['id_student'];
		
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		$info_start = select("students", "*", "`id_student` = '$id_student'", "id", false, "1");
		$start_id_course = $info_start[0]['id_course'];
		
		$info_end = select("students", "*", "`id_student` = '$id_student'", "id", true, "1");
		$end_id_course = $info_end[0]['id_course'];
		
		
		$info = query("SELECT * FROM `students` WHERE `status` = '1' AND `id_student` = '$id_student' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		$id_faculty = $info[0]['id_faculty'];
		$id_s_l = $info[0]['id_s_l'];
		$id_s_v = $info[0]['id_s_v'];
		$id_course = $info[0]['id_course'];
		$id_spec = $info[0]['id_spec'];
		$id_group = $info[0]['id_group'];
		$id_student = $info[0]['id_student'];
		$id_s_t = $info[0]['id_s_t'];
		
		
		$info_group = select("std_study_groups", "*", "
		`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_s_v` = '$id_s_v' AND `s_y` = '$s_y' AND `h_y` = '$h_y'", "id", false, "");
		
		$id_nt = $info_group[0]['id_nt'];
		$lang = $info_group[0]['lang'];
		
		$semestr = getSemestr($id_course, $h_y);
		
		$info = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` <= $semestr AND `id_fan` != 1748 ORDER BY `semestr` ASC, `id_fan` ASC");
		
		$fanlist = query("
		
		SELECT
			`nt_content`.*,
			`results`.*,
			`fan_test`.`title_tj`,
			`iqtibosho`.`id` as `id_iqtibos`
		FROM
			`iqtibosho`
		INNER JOIN `nt_content` ON `nt_content`.`id_nt` = `iqtibosho`.`id_nt` 
		AND `nt_content`.`id_fan` = `iqtibosho`.`id_fan`
		AND `nt_content`.`semestr` = `iqtibosho`.`semestr`
		
		
		INNER JOIN `results` ON `results`.`id_fan` = `iqtibosho`.`id_fan` AND 
		`results`.`id_course` = `iqtibosho`.`id_course`
		
		INNER JOIN `fan_test` ON `fan_test`.`id` = `iqtibosho`.`id_fan`
		
		WHERE
			`nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` < '$semestr' AND
			
			`results`.`id_student` = '$id_student' AND `iqtibosho`.`id_group` = '$id_group'
			
		ORDER BY `results`.`id_fan`
		");
		
		// Путь и имя файла, в который нужно сохранить QR-код
		$file = $_SERVER['DOCUMENT_ROOT']."/userfiles/qr-transcripts/$id_student.png";
		
		if(!file_exists($file)){
			// Подключаем библиотеку QR Code
			include('../phpqrcode/qrlib.php');
			
			// Ссылка, которую нужно закодировать в QR-код
			$link = URL."transcript.php?id_student=$id_student&s_y=$s_y&h_y=$h_y";
			
			// Размер QR-кода в пикселях
			$size = 3;
			// Генерируем QR-код и сохраняем его в файл
			QRcode::png($link, $file, QR_ECLEVEL_Q, $size);
		}
		
		$page_info['title'] = 'Транскрипт: '.getUserName($id_student);
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		
		include("views/{$action}.php");
		exit;
	break; 
	
	case "transcript2":
		$id_student = $_REQUEST['id_student'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$info_std = query("SELECT `students`.*, (SELECT MIN(`s_y`) FROM `students` WHERE `id_student` = '$id_student' AND `h_y`='1')  as `minsy` FROM `students`
							WHERE `id_student` = '$id_student' AND	
								`s_y` = '$S_Y' AND
								`h_y` = '$H_Y'
						");
		//print_arr($info_std);
		
		
		$id_faculty = $info_std[0]['id_faculty'];
		$id_s_l = $info_std[0]['id_s_l'];
		$id_s_v = $info_std[0]['id_s_v'];
		$id_s_t = $info_std[0]['id_s_t'];
		$id_course = $info_std[0]['id_course'];
		$id_spec = $info_std[0]['id_spec'];
		$id_group = $info_std[0]['id_group'];
		
		$semestr = getSemestr($id_course, $H_Y);
		
		$id_nt = query("SELECT `id_nt` FROM `std_study_groups` 
							WHERE `id_faculty` = '$id_faculty'
								AND `id_s_l` = '$id_s_l'
								AND `id_s_v` = '$id_s_v'
								AND `id_course` = '$id_course'
								AND `id_spec` = '$id_spec'
								AND `id_group` = '$id_group'
								AND `s_y` = '$S_Y'
								AND `h_y` = '$H_Y'
					");
		$id_nt = $id_nt[0]['id_nt'];
		
		// Путь и имя файла, в который нужно сохранить QR-код
		$file = $_SERVER['DOCUMENT_ROOT']."/userfiles/qr-transcripts/$id_student.png";
		
		if(file_exists($file)){
			unlink($file);
			// Подключаем библиотеку QR Code
			include('../phpqrcode/qrlib.php');
			
			// Ссылка, которую нужно закодировать в QR-код
			$link = URL."transcript.php?id_student=$id_student&s_y=$S_Y&h_y=$H_Y";
			
			// Размер QR-кода в пикселях
			$size = 3;
			// Генерируем QR-код и сохраняем его в файл
			QRcode::png($link, $file, QR_ECLEVEL_Q, $size);
		}else{
			// Подключаем библиотеку QR Code
			include('../phpqrcode/qrlib.php');
			
			// Ссылка, которую нужно закодировать в QR-код
			$link = URL."transcript.php?id_student=$id_student&s_y=$S_Y&h_y=$H_Y";
			
			// Размер QR-кода в пикселях
			$size = 3;
			// Генерируем QR-код и сохраняем его в файл
			QRcode::png($link, $file, QR_ECLEVEL_Q, $size);
		}
		
		$page_info['title'] = 'Транскрипт: '.getUserName($id_student);
		include("views/{$action}.php");
		exit;
	break;
	
	case "vkladish":
		$id_student = $_REQUEST['id_student'];
		$id_s_l = $_REQUEST['id_s_l'];
		$info = query("SELECT `users`.*, 
							   `user_udecation`.*, 
							   `students`.*, 
							   `diploms`.*, 
							   (SELECT MAX(`s_y`) FROM `students` WHERE `id_student` = '$id_student' AND `h_y`='2')  as `maxsy`, 
							   (SELECT MIN(`s_y`) FROM `students` WHERE `id_student` = '$id_student' AND `h_y`='1')  as `minsy` 
						FROM `users`
						INNER JOIN `user_udecation` 
						INNER JOIN `students`
						INNER JOIN `diploms`
						ON `users`.`id` = `user_udecation`.`id_user` AND
							`users`.`id` = `students`.`id_student` AND
							`users`.`id` = `diploms`.`id_student`
						WHERE `users`.`id` = '$id_student' AND
							`students`.`id_student` = '$id_student' AND
							`students`.`id_s_l` = '$id_s_l' AND
							`students`.`status` = '1' AND
							`diploms`.`id_student` = '$id_student' AND
							`diploms`.`id_s_l` = '$id_s_l'
						GROUP BY 
								`users`.`id`, 
								`user_udecation`.`id`, 
								`students`.`id`, 
								`students`.`id_student`,
								`students`.`id_s_l`, 
								`students`.`status`,
								`diploms`.`id`
					");
		if(empty($info)){
			echo "<h2>Маълумотҳо дар бораи диплом ворид карда нашудаанд</h2>";
			exit;
		}
					
		$id_faculty = $info[0]['id_faculty'];
		$id_s_l = $info[0]['id_s_l'];
		$id_s_v = $info[0]['id_s_v'];
		$id_course = $info[0]['id_course'];
		$id_spec = $info[0]['id_spec'];
		$id_group = $info[0]['id_group'];
		$S_Y = $info[0]['s_y'];
		$H_Y = $info[0]['h_y'];
		$id_nt = getNT($id_faculty, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group, $S_Y, $H_Y);
		
		$semestrs = query("SELECT COUNT(DISTINCT `semestr`) as `semestrs` FROM `nt_content` 
							WHERE `id_nt` = '$id_nt' 
						");
		$muhlati_tahsil = $semestrs[0]['semestrs'] / 2;
		
		$birthday = $info[0]['birthday'];
		$id_khatm = @$info[0]['id_hujjat'];
		$dokhilshavi = $info[0]['minsy'];
		
		$soli_xatm = $info[0]['soli_xatm'];
		$diplom_number = $info[0]['diplom_number'];
		$diplom_reg_number = $info[0]['diplom_reg_number'];
		$date_gek = $info[0]['date_gek'];
		$kasb = $info[0]['kasb'];
	
		
		$page_info['title'] = 'Илова ба диплом: '.getUserName($id_student);
		include("views/{$action}.php");
		exit;
	break;
	
	
	case "studentinfo":
		$id_student = $_REQUEST['id_student'];
		$student = query("SELECT `students`.*, `users`.*, `user_passports`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `users`.`id` = `user_passports`.`id_user`
		WHERE `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		ORDER BY `users`.`fullname_tj`
		");
		
		$history = query("SELECT * FROM `students` WHERE `status` = '1' AND `id_student` = '$id_student' ORDER BY `id_course`, `h_y`");
		
		
		//array_pop($history);
		//print_arr($history);
		
		$page_info['title'] = 'Маълумотнома: '.getUserName($id_student);
		
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		include("views/{$action}.php");
		exit;
	break;
	
	case "farqiyat_ariza":
		$id_farqiyat=$_REQUEST['id_farqiyat'];
		$query = query("SELECT * FROM `farqiyatho` WHERE `id`='$id_farqiyat'");
		$id_student = $query[0]['id_student'];
		$student=query("SELECT * FROM `students` WHERE `id` IN (SELECT MAX(`id`) FROM `students` WHERE `students`.`id_student` = '$id_student')");
		$fans = query("SELECT * FROM `farqiyatho_content` WHERE `id_farqiyat`='$id_farqiyat'");
		$all_credits=query("SELECT SUM(credit) as `credits` FROM `farqiyatho_content` WHERE `id_farqiyat`='$id_farqiyat'");
		$all_money=query("SELECT SUM(money) as `moneys` FROM `farqiyatho_content` WHERE `id_farqiyat`='$id_farqiyat'");
		$page_info['title'] = "Чопи аризаи фарқият: ".getUserName($id_student);
		include("views/{$action}.php");
		exit;
	break;
	
	case "farqiyat_vedomost":
		$id_student=$_REQUEST['id_student'];
		$id_farqiyat=$_REQUEST['id_farqiyat'];
		$info_std=query("SELECT * FROM `students` WHERE `id` IN (SELECT MAX(`id`) FROM `students` WHERE `students`.`id_student` = '$id_student')");
		$raznitsa = query("SELECT * FROM `farqiyatho_content` WHERE `id_farqiyat`='$id_farqiyat'");
		$page_info['title'] = "Чопи ведости фарқият: ".getUserName($id_student);
		include("views/{$action}.php");
		exit;
	break;
	
	case "farqiyat_vedomosti_pur":
		$id_student = $_REQUEST['id_student'];
		$id_farqiyat = $_REQUEST['id_farqiyat'];
		$info_std = query("SELECT * FROM `students` WHERE `id` IN (SELECT MAX(`id`) FROM `students` WHERE `students`.`id_student` = '$id_student')");
		$raznitsa = query("SELECT * FROM `farqiyatho_content` WHERE `id_farqiyat`='$id_farqiyat' ORDER BY `s_y` ASC, `h_y` ASC");
		$page_info['title'] = "Чопи ведости фарқият: ".getUserName($id_student);
		include("views/{$action}.php");
		exit;
	break;
	
	case "trimestr_ariza":
		$id_trimestr=$_REQUEST['id_trimestr'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$query = query("SELECT * FROM `trimestr` WHERE `id`='$id_trimestr'");
		$id_student = $query[0]['id_student'];
		$student=query("SELECT * FROM `students` WHERE `status` = '1' AND `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$fans = query("SELECT * FROM `trimestr_content` WHERE `id_trimestr`='$id_trimestr'");
		$all_credits=query("SELECT SUM(c_u) as `credits` FROM `trimestr_content` WHERE `id_trimestr`='$id_trimestr'");
		$all_faol_credits=query("SELECT SUM(c_f_u) as `faol_credits` FROM `trimestr_content` WHERE `id_trimestr`='$id_trimestr'");
		$all_money=query("SELECT SUM(money) as `moneys` FROM `trimestr_content` WHERE `id_trimestr`='$id_trimestr'");
		$page_info['title'] = "Чопи аризаи триместр: ".getUserName($id_student);
		include("views/{$action}.php");
		exit;
	break;
	
	case "suporidand":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$page_info['title'] = "СУПОРИДАНД";
		include("views/{$action}.php");
		exit;
	break;	
	
	case "suporidand2":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$page_info['title'] = "СУПОРИДАНД";
		include("views/{$action}.php");
		exit;
	break;	
	
	case "suporidand3":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$page_info['title'] = "СУПОРИДАНД3";
		include("views/{$action}.php");
		exit;
	break;		
	
	case "forma342":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$page_info['title'] = "Формаи 34-2";
		include("views/{$action}.php");
		exit;
	break;	
	
	case "forma342t":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$page_info['title'] = "Формаи 34-2";
		include("views/{$action}.php");
		exit;
	break;	
	
	case "nedopusk":
		$page_info['title'] = "ДОНИШҶӮЁНЕ КИ БА ИМТИҲОН РОҲ НАДОРАНД";
		include("views/{$action}.php");
		exit;
	break;
	
	case "qarzdorho":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$page_info['title'] = "ДОНИШҶӮЁНЕ КИ ҚАРЗДОР ШУДААНД";
		include("views/{$action}.php");
		exit;
	break;
	
	case "qarzdorho2":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$page_info['title'] = "ДОНИШҶӮЁНЕ КИ ҚАРЗДОР ШУДААНД";
		include("views/{$action}.php");
		exit;
	break;
	
	case "qarzdorho_allfan":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$page_info['title'] = "ДОНИШҶӮЁНЕ КИ АЗ ҲАМАИ ФАНҲОИ ТАЪЛИМӢ ҚАРЗДОР ШУДААНД";
		include("views/{$action}.php");
		exit;
	break;
	
	case "qarzdorho_money":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$page_info['title'] = "МАБЛАҒИ ТАХМИНИИ АЗ НАТИҶАИ ТРИМЕСТР БАДАСТОЯНДА";
		include("views/{$action}.php");
		exit;
	break;
	
	case "qarzdorhofx":
		$page_info['title'] = "ДОНИШҶӮЁНЕ КИ БАҲОИ FX ГИРИФТАНД";
		include("views/{$action}.php");
		exit;
	break;
	
	case "qarzdorhofx_sh":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$page_info['title'] = "ДОНИШҶӮЁНЕ КИ АЗ ИМТИҲОНҲОИ ШИФОҲӢ БАҲОИ FX ГИРИФТАНД";
		include("views/{$action}.php");
		exit;
	break;
	
	case "stipendia":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		//$students = query("SELECT `id_student` FROM `students` WHERE `status` = '1' AND `id_s_l` = '1' AND `id_s_v` = '1' AND `id_s_t` IN (2,3) AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_s_t` ASC, `id_faculty` ASC, `id_course` ASC, `id_spec` ASC, `id_group` ASC");
		$results  = query("SELECT 
								`students`.`id_faculty`, 
								`students`.`id_course`, 
								`students`.`id_spec`, 
								`students`.`id_group`,
								`students`.`id_s_t`,
								`students`.`id_student`, 
								`users`.`fullname_tj`, 
								MIN(COALESCE(`results`.`total_score`, 0)) as `min`, 
								MAX(COALESCE(`results`.`total_score`, 0)) as `max` 
							FROM 
								`students` 
							INNER JOIN 
								`results` ON 
								`students`.`id_faculty` = `results`.`id_faculty` AND 
								`students`.`id_s_l` = `results`.`id_s_l` AND 
								`students`.`id_s_v` = `results`.`id_s_v` AND 
								`students`.`id_course` = `results`.`id_course` AND 
								`students`.`id_spec` = `results`.`id_spec` AND 
								`students`.`id_group` = `results`.`id_group` AND 
								`students`.`id_student` = `results`.`id_student` AND 
								`students`.`s_y` = `results`.`s_y` AND 
								`students`.`h_y` = `results`.`h_y` 
							INNER JOIN 
								`users` ON 
								`students`.`id_student` = `users`.`id` 
							WHERE 
								`students`.`id_student` IN ( 
									SELECT 
										`id_student` 
									FROM 
										`students` 
									WHERE 
										`status` = '1' AND 
										`id_s_l` = '1' AND 
										`id_s_v` = '1' AND 
										`id_s_t` IN (2,3) AND 
										`s_y` = '$S_Y' AND 
										`h_y` = '$H_Y' 
								) AND 
								`results`.`s_y` = '$S_Y' AND 
								`results`.`h_y` = '$H_Y' 
							GROUP BY 
								`students`.`id_faculty`, 
								`students`.`id_course`, 
								`students`.`id_spec`, 
								`students`.`id_group`,
								`students`.`id_s_t`,
								`students`.`id_student`, 
								`users`.`fullname_tj`
							HAVING 
								`min` >= 90 AND `max` <= 100
								OR (`min` >= 75 AND `max` <= 100)
								OR (`min` >= 75 AND `min` < 90)
							ORDER BY 
								`students`.`id_faculty` ASC, 
								`students`.`id_course` ASC, 
								`students`.`id_spec` ASC, 
								`students`.`id_group` ASC,
								`max` DESC, `min` DESC, 
								`users`.`fullname_tj` ASC;
								

						");
		//exit;
		$page_info['title'] = "РӮЙХАТИ ГИРАНДАГОНИ СТИПЕНДИЯ (баҳои аъло, хубу аъло, хуб)";
		include("views/{$action}.php");
		exit;
 	break;
	
	case "stipendia2":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$students = query("SELECT `students`.*, `users`.`fullname_tj` FROM `students` INNER JOIN `users` ON 
							`students`.`id_student` = `users`.`id`
							WHERE `status` = '1' AND `id_faculty`!=7 AND `id_s_l` = '1' AND `id_s_v` = '1' AND `id_s_t` IN (2,3) AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' 
							ORDER BY `id_faculty` ASC, `id_course` ASC, `id_spec` ASC, `id_group` ASC, `users`.`fullname_tj` ASC");
		$page_info['title'] = "РӮЙХАТИ ГИРАНДАГОНИ СТИПЕНДИЯ (то 2 баҳои қаноатбахш)";
		include("views/{$action}.php");
		exit;
 	break;
	
	case "trimestr_sum":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
 		$students = query("SELECT 
								DISTINCT(`trimestr`.`id_student`),
								`trimestr_content`.`id_faculty`, 
								`trimestr_content`.`id_s_l`, 
								`trimestr_content`.`id_s_v`, 
								`trimestr_content`.`id_course`,
								`trimestr_content`.`id_spec`,
								`trimestr_content`.`id_group`,
								`trimestr`.`money`,
								`trimestr`.`date` 
							FROM `trimestr` INNER JOIN `trimestr_content` on `trimestr`.`id` = `trimestr_content`.`id_trimestr`
							WHERE `trimestr`.`s_y` = '$S_Y' AND `trimestr`.`h_y` = '$H_Y'
							GROUP BY
								`trimestr_content`.`id_faculty`, 
								`trimestr_content`.`id_s_l`, 
								`trimestr_content`.`id_s_v`, 
								`trimestr_content`.`id_course`, 
								`trimestr_content`.`id_spec`, 
								`trimestr_content`.`id_group`, 
								`trimestr`.`id_student`, 
								`trimestr`.`money`, 
								`trimestr`.`date` 
							ORDER BY `trimestr_content`.`id_faculty` ASC, 
								`trimestr_content`.`id_s_l` ASC, 
								`trimestr_content`.`id_s_v` ASC, 
								`trimestr_content`.`id_course` ASC,
								`trimestr_content`.`id_spec` ASC,
								`trimestr_content`.`id_group` ASC
						");
		$page_info['title'] = "РӮЙХАТИ ДАР ТРИМЕСТР АРИЗА ДОШТАГИҲО";
		include("views/{$action}.php");
		exit;
	break;
	
	case "examtypes":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$tests = query("SELECT `tests`.*, `sarboriho`.`id_teacher` FROM `tests` INNER JOIN `sarboriho` 
							ON `tests`.`id_iqtibos` = `sarboriho`.`id_iqtibos`							
							WHERE `tests`.`s_y` = '$S_Y' AND `tests`.`h_y` = '$H_Y' AND
									(CASE 
										WHEN `tests`.`id_fan` IN (606, 634, 1747, 626, 634, 619) THEN `sarboriho`.`type`='am_plan' 
										ELSE `sarboriho`.`type`='lk_plan'
									END)
							ORDER BY `id_s_l` ASC,
									`id_s_v` ASC,
									`id_faculty` ASC, 
									`id_course` ASC,
									`id_spec` ASC,
									`id_group` ASC,
									`id_fan` ASC
						");
		$page_info['title'] = "Шакли имтиҳонҳо";
		include("views/{$action}.php");
		exit;
	break;
	
	case "xorijshudaho":
		$students = query("SELECT `stds_farmonho`.*, `students`.*, `user_passports`.*,  `users`.* FROM `stds_farmonho` INNER JOIN `students` 
								ON `stds_farmonho`.`id_student` = `students`.`id_student`
							INNER JOIN `user_passports` 
								ON `stds_farmonho`.`id_student` = `user_passports`.`id_user`
							INNER JOIN `users`
								ON `stds_farmonho`.`id_student` = `users`.`id`
							WHERE `students`.`id` IN (SELECT MAX(`id`) FROM `students` WHERE `students`.`id_student` = `stds_farmonho`.`id_student`)
							ORDER BY `students`.`id_s_l` ASC,
								`students`.`id_s_v` ASC,
								`students`.`id_faculty` ASC,
								`students`.`id_course` ASC,
								`students`.`id_spec` ASC,
								`students`.`id_group` ASC
						");
		//print_arr($students);exit;
		$page_info['title'] = "РУЙХАТИ ТО ҲАМИН РУЗ ХОРИҶШУДАГИҲО";
		include("views/{$action}.php");
		exit;
	break;
	
	case "khatmkunandagon":
		$id_s_t = $_REQUEST['id_s_t'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$students = query("SELECT `students`.*, 
									`users`.*, 
									`user_passports`.* 
							FROM `students` INNER JOIN `users` ON
								`students`.`id_student` = `users`.`id`
							INNER JOIN `user_passports` ON 
								`students`.`id_student` = `user_passports`.`id_user`
							WHERE 
								`students`.`status` = '1' AND
								`students`.`id_course` >= 4 AND
								`students`.`id_s_t` = '$id_s_t' AND 
								`students`.`s_y` = '$S_Y' AND
								`students`.`h_y` = '$H_Y'
							ORDER BY 
								`students`.`id_faculty` ASC,
								`students`.`id_course` ASC,
								`students`.`id_spec` ASC,
								`students`.`id_group` ASC
								
						");
		$page_info['title'] = "Руйхати хатмкунандагон тибқи ".getStudyType($id_s_t);
		include("views/{$action}.php");
		exit;
	break;
	
	case "fanhoi_bemalim":
		$S_Y = $_REQUEST['s_y'];
		$iqtibosho = query("SELECT * FROM `iqtibosho` WHERE `s_y`='$S_Y' AND `id_faculty`!='7' AND `id` NOT IN (SELECT `id_iqtibos` FROM `sarboriho`) ORDER BY `id_faculty` ASC, `id_s_l` ASC, `id_s_v` ASC, `id_course` ASC, `id_spec` ASC, `id_group` ASC, `semestr` ASC");
		//echo count($iqtibosho);
		$page_info['title'] = "РУЙХАТИ ФАНҲОИ ТАҚСИМОТНАШУДА ДАР СОЛИ ТАҲСИЛИ ".getStudyYear($S_Y);
		include("views/{$action}.php");
		exit;
	break;
	
	case "listok":
		$id_student = $_REQUEST['id_student'];
		
		$info = query("SELECT * FROM `students` 
						WHERE `status`='1' AND 
							`id_student`='$id_student' 	AND 
							`s_y`=(
								SELECT MAX(`s_y`) FROM `students` WHERE `id_student` = '$id_student'
								) AND 
							`h_y`=(
								SELECT MAX(`h_y`) FROM `students` WHERE `id_student` = '$id_student' AND `s_y` IN (SELECT MAX(`s_y`) FROM `students` WHERE `id_student` = '$id_student'))
					");
		
		
		// $info = query2("SELECT * FROM `students` 
			// WHERE `status`='1' 
				// AND `id_student`='$id_student' 
				// AND `s_y`=(SELECT MAX(`s_y`) FROM `students` WHERE `id_student` = '$id_student') 
				// AND `h_y`= '".H_Y."' 
		// ");
		$id_faculty = $info[0]['id_faculty'];
		$id_course = $info[0]['id_course'];
		$id_spec = $info[0]['id_spec'];
		$id_group = $info[0]['id_group'];
		$id_s_v = $info[0]['id_s_v'];
		$id_s_l = $info[0]['id_s_l'];
		$id_s_t = $info[0]['id_s_t'];
		$s_y = $info[0]['s_y'];
		$h_y = $info[0]['h_y'];
		
		$id_nt = query("SELECT `id_nt` FROM `std_study_groups` 
							WHERE `id_faculty` = '$id_faculty'
								AND `id_s_l` = '$id_s_l'
								AND `id_s_v` = '$id_s_v'
								AND `id_course` = '$id_course'
								AND `id_spec` = '$id_spec'
								AND `id_group` = '$id_group'
								AND `s_y` = '$s_y'
								AND `h_y` = '$h_y'
					");
		$id_nt = $id_nt[0]['id_nt'];
		
		$year  = query("SELECT MIN(`s_y`) as `s_y` FROM `students` WHERE `id_student` = '$id_student' AND `id_s_l` = '$id_s_l'");
		$year = $year[0]['s_y'];
		
		$userinfo = query("SELECT `users`.*, `user_passports`.*, `user_udecation`.* FROM `users` INNER JOIN `user_passports` INNER JOIN `user_udecation`
						ON `users`.`id` = `user_passports`.`id_user`
						AND `users`.`id` = `user_udecation`.`id_user`
						WHERE `users`.`id`='$id_student'
					");
		
		$page_info['title'] = "Варақаи шахсии донишҷӯ";
		include("views/{$action}.php");
		exit;		
	break;
	
	case "prostin":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$students  = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
		
		$semestr = getSemestr($id_course, $H_Y);
		
		$id_nt = query("SELECT `id_nt` FROM `std_study_groups` 
							WHERE `id_faculty` = '$id_faculty'
								AND `id_s_l` = '$id_s_l'
								AND `id_s_v` = '$id_s_v'
								AND `id_course` = '$id_course'
								AND `id_spec` = '$id_spec'
								AND `id_group` = '$id_group'
								AND `s_y` = '$S_Y'
								AND `h_y` = '$H_Y'
					");
		$id_nt = $id_nt[0]['id_nt'];
		
		$page_info['title'] = "ПРОСТИН";
		include("views/{$action}.php");
		exit;
	break;
	
	case "hisobotigek":
		$id_faculty = $_REQUEST['id_faculty'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = 2;
		$page_info['title'] = "Ҳисоботи имтиҳони давлатӣ";
		include("views/{$action}.php");
		exit;
	break;
	
	case "besurat":
		$students = query("SELECT `users`.*, `students`.*, `users_biometric`.* FROM `users` 
							INNER JOIN `students` ON `users`.`id` = `students`.`id_student`
							LEFT JOIN `users_biometric` ON `users`.`id` = `users_biometric`.`id_user`
							WHERE `students`.`status` = '1' 
								AND `students`.`s_y` = '".S_Y."' 
								AND `students`.`h_y` = '".H_Y."'
								AND `users`.`id` IN(
									SELECT DISTINCT(`id_student`) FROM `students` 
										WHERE `status` = '1' AND `s_y` = '".S_Y. "' AND `h_y` = '".H_Y."'
								)
							ORDER BY `students`.`id_faculty` ASC,
								`students`.`id_s_l` ASC,
								`students`.`id_s_v` ASC,
								`students`.`id_course` ASC,
								`students`.`id_spec` ASC,
								`students`.`id_group` ASC,
								`users`.`fullname_tj` ASC
						");
		$page_info['title'] = 'Руйхати донишҷӯёне, ки сурат ва изи ангушт надоранд';
		//exit;
		include("views/{$action}.php");
		exit;
	break;
	
	case "balance":
		$S_Y = 23;
		$H_Y = 2;
		$page_info['title'] = 'Руйхати баланси донишҷӯён';
		$students =  query("SELECT * FROM `students` INNER JOIN `users`
								ON `students`.`id_student`  = `users`.`id`
								WHERE `students`.`status` = '1' AND 
									`students`.`id_s_t` = '1' AND 
									`students`.`s_y` = '$S_Y' AND 
									`students`.`h_y` = '$H_Y'
								ORDER BY `students`.`id_faculty` ASC,
									`students`.`id_s_l` ASC,
									`students`.`id_s_v` ASC,
									`students`.`id_course` ASC,
									`students`.`id_spec` ASC, 
									`students`.`id_group` ASC,
									`users`.`fullname_tj` ASC
						");
		include("views/{$action}.php");
		exit;
	break;
	
	case "balance_f":
		$S_Y = S_Y;
		$H_Y = H_Y;
		$page_info['title'] = 'Руйхати қарздории факултетҳо ба ҳолати '.date('d.m.Y');
		$faculties = query("SELECT * FROM `real_faculties` WHERE `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_faculty`");
		include("views/{$action}.php");
		exit;
	break;
	
	case "pardoxthoi_donishju":
		$id_student = $_REQUEST['id'];
		$page_info['title'] = 'Маблағҳои пардохткардаи '.getUserName($id_student);
		$rasidho = query("SELECT * FROM `rasidho` WHERE `id_student` = '$id_student' ORDER BY `id`");
		include("views/{$action}.php");
		exit;
	break;
	
	case "balancelit":
		$S_Y = 23;
		$H_Y = 2;
		$page_info['title'] = 'Руйхати баланси хонандагони литсей';
		$students =  query("SELECT * FROM `student_litsey` INNER JOIN `users`
								ON `student_litsey`.`id_xonanda`  = `users`.`id`
								WHERE 
									`student_litsey`.`s_y` = '$S_Y' AND 
									`student_litsey`.`h_y` = '$H_Y'
								ORDER BY 
									`student_litsey`.`id_sinf` ASC,
									`student_litsey`.`id_group` ASC,
									`users`.`fullname_tj` ASC
						");
		include("views/{$action}.php");
		exit;
	break;
	
	case "studentproblems":
		$S_Y  = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y']; 
 		$page_info['title'] = 'Руйхати донишҷӯёни проблемадошта';
		include("views/{$action}.php");
		exit;
	break;
	
	case "kursbakurs":
		$S_Y = $_REQUEST['s_y'];
		$page_info['title'] = 'Руйхати донишҷӯён барои курс ба курс';
		include("views/{$action}.php");
		exit;
	break;
	
	case "diplomialo":
		$S_Y  = $_REQUEST['s_y'];
		$H_Y = 2;
		$students  = query("SELECT `id_student` 
								FROM `results` 
								WHERE `id_fan` IN (37, 1740, 2548) AND
									`total_score` IS NOT NULL AND
									`s_y` = '$S_Y' AND
									`h_y` = '$H_Y'
								ORDER BY `id_faculty` ASC,
									`id_s_l` ASC, 
									`id_s_v` ASC,
									`id_course` ASC, 
									`id_spec` ASC,
									`id_group` ASC
							");
		$page_info['title'] = 'Руйхати номзадҳо барои дипломи аъло';
		include("views/{$action}.php");
		exit;
	break;
	
	case "check_kassa":
		$check = query("SELECT * FROM `rasidho` WHERE `check_date`>='2024-05-01' AND `check_date`<='2024-05-31' AND `payed_from` IS NULL ORDER BY `tranid` ASC");
		$page_info['title'] = 'Руйхати чекҳо';
		include("views/{$action}.php");
		exit;
	break;
	
	case "bejik":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		
		include('../phpqrcode/qrlib.php');
		
		$page_info['title'] = "БЕҶИК";
		include("views/bejik/{$action}.php");
		exit;
	break;
	
	case "navruzi":
		$datas = explode("\n", file_get_contents("../modules/print/views/bejik/list.txt"));
		//$info = array;
		$i = 1;
		foreach($datas as $item){
			$item = trim($item);
			$query  = query("SELECT `birthday` FROM `users` WHERE `fullname_tj` LIKE '%$item%'");
			$info[$i]['id'] = $i;
			$info[$i]['name'] = $item;
			if(!empty($query)){
				$info[$i]['birthday'] = $query[0]['birthday'];
			}else{
				$info[$i]['birthday'] = "";
			}
			$i++;
		}
		//print_arr($info);//exit;
		$page_info['title'] = "РУЙХАТ";
		include("views/bejik/{$action}.php");
		exit;
	break;
	
	case "double":
		$page_info['title'] = "Дубликатҳо";
		$users = query ("SELECT `fullname_tj`, COUNT(`fullname_tj`) AS `count` FROM `users` GROUP BY `fullname_tj` HAVING `count` > 1;");
		$ids = '';
		foreach($users as $user){
			$name = $user['fullname_tj'];
			$zap = query("SELECT * FROM `users` WHERE `fullname_tj`='$name'");
			foreach($zap as $item){
				echo $item['id'].". ".$item['fullname_tj']."<br>";
				$ids.=$item['id'].","; 
			}
		}
		//echo $ids."<br><br><br>";
		$ids = substr($ids, 0, -1);
		$students = query2("SELECT * FROM `students` WHERE `id_student` IN ($ids) AND `status` = '1'");
		echo "<br><br><br>";
		$i=1;
		foreach($students as $item){
			echo $i.". ".$item['id_student'].">".getUserName($item['id_student']).">".getFacultyShort($item['id_faculty']).">"
				.getStudyView($item['id_s_v']).">".getCourse($item['id_course']).">".getSpecialtyCode($item['id_spec'])."<br>";
			$i++;
		}
		exit;
	break;
	
}

?>