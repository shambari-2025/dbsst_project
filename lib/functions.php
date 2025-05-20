<?php
	
	function getFanList($id_nt, $semestr, $id_group){
		
		$fanlist = query("
			SELECT
				`nt_content`.`id_nt`, `nt_content`.`semestr`, `nt_content`.`id_fan` as `fan_id`,
				`nt_content`.`intixobi`, `nt_content`.`k_k`, `nt_content`.`c_u`,
				`tests`.`imt_type`,
				`fan_test`.`title_tj`, 
				`iqtibosho`.`id` as `id_iqtibos`, `iqtibosho`.*,
				`users`.`fullname_tj` as `teacher`
			FROM
				`nt_content`
			LEFT JOIN `iqtibosho` ON 
				`nt_content`.`id_nt` = `iqtibosho`.`id_nt` AND 
				`nt_content`.`id_fan` = `iqtibosho`.`id_fan` AND 
				`nt_content`.`semestr` = `iqtibosho`.`semestr`
			LEFT JOIN `tests` ON 
				`tests`.`id_iqtibos` = `iqtibosho`.`id`
			LEFT JOIN `sarboriho` ON 
				`sarboriho`.`id_iqtibos` = `iqtibosho`.`id` AND
				`sarboriho`.`type` = 'lk_plan'
			
			LEFT JOIN `users` ON 
				`users`.`id` = `sarboriho`.`id_teacher`
			
			INNER JOIN `fan_test` ON 
				`fan_test`.`id` = `nt_content`.`id_fan`
				
			WHERE 
				`nt_content`.`id_nt` = '$id_nt' AND 
				`nt_content`.`id_fan` != '1748' AND 
				`nt_content`.`semestr` = '$semestr' AND 
				`iqtibosho`.`id_group` = '$id_group'
		");
		// print_arr($fanlist);
		// exit;
		return $fanlist;
		
	}
	
	function getQarzdorho($id_faculty, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group, $S_Y, $H_Y){
		
		if($id_faculty)
			$faculty_where = " AND `students`.`id_faculty` = '$id_faculty' ";
		else $faculty_where = '';
		
		if($id_s_l)
			$s_l_where = " AND `students`.`id_s_l` = '$id_s_l' ";
		else $s_l_where = '';
		
		if($id_s_v)
			$s_v_where = " AND `students`.`id_s_v` = '$id_s_v' ";
		else $s_v_where = '';
		
		if($id_course)
			$course_where = " AND `students`.`id_course` = '$id_course' ";
		else $course_where = '';
		
		if($id_spec)
			$spec_where = " AND `students`.`id_spec` = '$id_spec' ";
		else $spec_where = '';
		
		if($id_group)
			$group_where = " AND `students`.`id_group` = '$id_group' ";
		else $group_where = '';
		
		
		$qarzdorho = query("
			SELECT 
				`students`.*, 
				`faculties`.`short_title` AS `faculty_short`, 
				`specialties`.`code` AS `spec_code`, 
				`study_type`.`title` as `study_type_title`, 
				`study_view`.`title` as `study_view_title`, 
				`study_level`.`title` as `study_level_title`, 
				`groups`.`title` AS `group_title`, 
				`fan_test`.`title_tj` AS `fan_title`, 
				`users`.`fullname_tj` as `student_name`, 
				`teacher_users`.`fullname_tj` as `teacher_name`,
				`tests`.*, 
				`iqtibosho`.`id_departament`, `iqtibosho`.`semestr`,
				`departaments`.`title` as `departament`,
				`sarboriho`.`id_teacher`,
				`results`.`id`,
				`results`.`imt_score`,
				((`results`.`nf_1_score` + `results`.`nf_1_absent` + `results`.`nf_1_score_r` + `results`.`nf_1_score` + `results`.`nf_1_absent` + `results`.`nf_1_score_r`) / 2) * 0.6 as `nf_score`,
				
				IFNULL(MAX(`results`.`total_score`), 0) as `total_score`, 
				`std_study_groups`.`id_nt`
			FROM 
				`users`
			INNER JOIN `students` ON 
				`students`.`id_student` = `users`.`id` 
			INNER JOIN `faculties` ON 
				`students`.`id_faculty` = `faculties`.`id`
			INNER JOIN `specialties` ON 
				`students`.`id_spec` = `specialties`.`id`
			INNER JOIN `study_type` ON 
				`students`.`id_s_t` = `study_type`.`id`
			INNER JOIN `study_view` ON 
				`students`.`id_s_v` = `study_view`.`id`
			INNER JOIN `study_level` ON 
				`students`.`id_s_l` = `study_level`.`id`
			INNER JOIN `groups` ON 
				`students`.`id_group` = `groups`.`id`
			INNER JOIN `std_study_groups` ON 
				`std_study_groups`.`status` = 1 AND  
				`students`.`id_faculty` = `std_study_groups`.`id_faculty` AND 
				`students`.`id_s_l` = `std_study_groups`.`id_s_l` AND 
				`students`.`id_s_v` = `std_study_groups`.`id_s_v` AND 
				`students`.`id_course` = `std_study_groups`.`id_course` AND 
				`students`.`id_spec` = `std_study_groups`.`id_spec` AND 
				`students`.`id_group` = `std_study_groups`.`id_group` AND
				`students`.`s_y` = `std_study_groups`.`s_y` AND
				`students`.`h_y` = `std_study_groups`.`h_y`
			INNER JOIN `tests` ON 
				`students`.`id_faculty` = `tests`.`id_faculty` AND 
				`students`.`id_s_l` = `tests`.`id_s_l` AND 
				`students`.`id_s_v` = `tests`.`id_s_v` AND 
				`students`.`id_course` = `tests`.`id_course` AND 
				`students`.`id_spec` = `tests`.`id_spec` AND 
				`students`.`id_group` = `tests`.`id_group` AND
				`students`.`s_y` = `tests`.`s_y` AND
				`students`.`h_y` = `tests`.`h_y`
			INNER JOIN `iqtibosho` ON 
				`iqtibosho`.`id` = `tests`.`id_iqtibos`
			INNER JOIN `departaments` ON 
				`departaments`.`id` = `iqtibosho`.`id_departament`
			INNER JOIN `sarboriho` ON 
				`sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
			INNER JOIN `users` AS `teacher_users` ON 
				`sarboriho`.`id_teacher` = `teacher_users`.`id`
			INNER JOIN `results` ON 
				`tests`.`id_fan` = `results`.`id_fan` AND 
				`students`.`id_student` = `results`.`id_student` AND 
				`students`.`id_faculty` = `results`.`id_faculty` AND 
				`students`.`id_s_l` = `results`.`id_s_l` AND 
				`students`.`id_s_v` = `results`.`id_s_v` AND 
				`students`.`id_course` = `results`.`id_course` AND 
				`students`.`id_spec` = `results`.`id_spec` AND 
				`students`.`id_group` = `results`.`id_group` AND
				`students`.`s_y` = `results`.`s_y` AND
				`students`.`h_y` = `results`.`h_y`
			INNER JOIN `fan_test` ON 
				`tests`.`id_fan` = `fan_test`.`id`	
			WHERE 
				`sarboriho`.`type` = 'lk_plan' 
				AND `students`.`status` = '1'
				
				$faculty_where
				$s_l_where
				$s_v_where
				$course_where
				$spec_where
				$group_where
				AND `students`.`s_y` = '$S_Y' 
				AND `students`.`h_y` = '$H_Y'
			GROUP BY 
				`students`.`id`, `tests`.`id`, `results`.`id`, `std_study_groups`.`id`, `sarboriho`.`id`
			HAVING
				`total_score` < 50.00 
			ORDER BY 
				`students`.`id_faculty`, `students`.`id_s_l`, `students`.`id_s_v`,
				`students`.`id_course`, `students`.`id_spec`, `students`.`id_group`,
				`users`.`fullname_tj`, `tests`.`id_fan`
		");
		
		
		return $qarzdorho;
	}
	
	function getBartaraf($id_faculty, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group, $S_Y, $H_Y){
		
		if($id_faculty)
			$faculty_where = " AND `students`.`id_faculty` = '$id_faculty' ";
		else $faculty_where = '';
		
		if($id_s_l)
			$s_l_where = " AND `students`.`id_s_l` = '$id_s_l' ";
		else $s_l_where = '';
		
		if($id_s_v)
			$s_v_where = " AND `students`.`id_s_v` = '$id_s_v' ";
		else $s_v_where = '';
		
		if($id_course)
			$course_where = " AND `students`.`id_course` = '$id_course' ";
		else $course_where = '';
		
		if($id_spec)
			$spec_where = " AND `students`.`id_spec` = '$id_spec' ";
		else $spec_where = '';
		
		if($id_group)
			$group_where = " AND `students`.`id_group` = '$id_group' ";
		else $group_where = '';
		
		
		$bartaraf = query("
			SELECT 
				`students`.*, 
				`faculties`.`short_title` AS `faculty_short`, 
				`specialties`.`code` AS `spec_code`, 
				`study_type`.`title` as `study_type_title`, 
				`study_view`.`title` as `study_view_title`, 
				`study_level`.`title` as `study_level_title`, 
				`groups`.`title` AS `group_title`, 
				`fan_test`.`title_tj` AS `fan_title`, 
				`users`.`fullname_tj` as `student_name`, 
				`teacher_users`.`fullname_tj` as `teacher_name`,
				`tests`.*, 
				`iqtibosho`.`id_departament`, `iqtibosho`.`semestr`,
				`departaments`.`title` as `departament`,
				`sarboriho`.`id_teacher`,
				`results`.`id`,
				IFNULL(MAX(`results`.`total_score`), 0) as `total_score`, 
				IFNULL(MAX(`results`.`trimestr_score`), 0) as `trimestr_score`, 
				`std_study_groups`.`id_nt`
			FROM 
				`users`
			INNER JOIN `students` ON 
				`students`.`id_student` = `users`.`id` 
			INNER JOIN `faculties` ON 
				`students`.`id_faculty` = `faculties`.`id`
			INNER JOIN `specialties` ON 
				`students`.`id_spec` = `specialties`.`id`
			INNER JOIN `study_type` ON 
				`students`.`id_s_t` = `study_type`.`id`
			INNER JOIN `study_view` ON 
				`students`.`id_s_v` = `study_view`.`id`
			INNER JOIN `study_level` ON 
				`students`.`id_s_l` = `study_level`.`id`
			INNER JOIN `groups` ON 
				`students`.`id_group` = `groups`.`id`
			INNER JOIN `std_study_groups` ON 
				`std_study_groups`.`status` = 1 AND  
				`students`.`id_faculty` = `std_study_groups`.`id_faculty` AND 
				`students`.`id_s_l` = `std_study_groups`.`id_s_l` AND 
				`students`.`id_s_v` = `std_study_groups`.`id_s_v` AND 
				`students`.`id_course` = `std_study_groups`.`id_course` AND 
				`students`.`id_spec` = `std_study_groups`.`id_spec` AND 
				`students`.`id_group` = `std_study_groups`.`id_group` AND
				`students`.`s_y` = `std_study_groups`.`s_y` AND
				`students`.`h_y` = `std_study_groups`.`h_y`
			INNER JOIN `tests` ON 
				`students`.`id_faculty` = `tests`.`id_faculty` AND 
				`students`.`id_s_l` = `tests`.`id_s_l` AND 
				`students`.`id_s_v` = `tests`.`id_s_v` AND 
				`students`.`id_course` = `tests`.`id_course` AND 
				`students`.`id_spec` = `tests`.`id_spec` AND 
				`students`.`id_group` = `tests`.`id_group` AND
				`students`.`s_y` = `tests`.`s_y` AND
				`students`.`h_y` = `tests`.`h_y`
			INNER JOIN `iqtibosho` ON 
				`iqtibosho`.`id` = `tests`.`id_iqtibos`
			INNER JOIN `departaments` ON 
				`departaments`.`id` = `iqtibosho`.`id_departament`
			INNER JOIN `sarboriho` ON 
				`sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
			INNER JOIN `users` AS `teacher_users` ON 
				`sarboriho`.`id_teacher` = `teacher_users`.`id`
			INNER JOIN `results` ON 
				`tests`.`id_fan` = `results`.`id_fan` AND 
				`students`.`id_student` = `results`.`id_student` AND 
				`students`.`id_faculty` = `results`.`id_faculty` AND 
				`students`.`id_s_l` = `results`.`id_s_l` AND 
				`students`.`id_s_v` = `results`.`id_s_v` AND 
				`students`.`id_course` = `results`.`id_course` AND 
				`students`.`id_spec` = `results`.`id_spec` AND 
				`students`.`id_group` = `results`.`id_group` AND
				`students`.`s_y` = `results`.`s_y` AND
				`students`.`h_y` = `results`.`h_y`
			INNER JOIN `fan_test` ON 
				`tests`.`id_fan` = `fan_test`.`id`	
			WHERE 
				`sarboriho`.`type` = 'lk_plan' 
				AND `students`.`status` = '1'
				
				$faculty_where
				$s_l_where
				$s_v_where
				$course_where
				$spec_where
				$group_where
				AND `students`.`s_y` = '$S_Y' 
				AND `students`.`h_y` = '$H_Y'
			GROUP BY 
				`students`.`id`, `tests`.`id`, `results`.`id`, `std_study_groups`.`id`, `sarboriho`.`id`
			HAVING
				`total_score` < 50.00 AND `trimestr_score` >= 50
			ORDER BY 
				`students`.`id_faculty`, `students`.`id_s_l`, `students`.`id_s_v`,
				`students`.`id_course`, `students`.`id_spec`, `students`.`id_group`,
				`users`.`fullname_tj`, `tests`.`id_fan`
		");
		
		
		return $bartaraf;
	}
	
	function weeksSinceDate($date) {
		// Переводим дату в метку времени
		$startDate = strtotime($date);
		$currentDate = time();
		
		// Проверяем, что начальная дата корректна
		if ($startDate === false) {
			return "Неправильный формат даты";
		}
		
		// Вычисляем разницу в секундах и переводим в недели
		$differenceInSeconds = $currentDate - $startDate;
		$weeks = floor($differenceInSeconds / (60 * 60 * 24 * 7));
		
		// Увеличиваем на одну неделю, если начальная дата не совпадает с текущей неделей
		if (date('W', $startDate) !== date('W', $currentDate)) {
			$weeks += 1;
		}
		
		return $weeks;
	}
	
	function getResultsBySemestr($id_student, $id_group, $id_nt, $semestr){
		$fanlist = query("
			SELECT 
			`tut_db_asu`.`nt_content`.*, 
			`fan_test`.`title_tj`, 
			`fan_test`.`id` AS `fan_id`,
			`tests`.`imt_type`,
			`tut_db_asu`.`results`.`id` AS `results_id`, 
			`tut_db_asu`.`results`.`id_fan` AS `id_fan`, 
			`tut_db_asu`.`results`.`nf_1_score` AS `nf_1_score`, 
			`tut_db_asu`.`results`.`nf_1_absent` AS `nf_1_absent`,
			`tut_db_asu`.`results`.`nf_1_score_r` AS `nf_1_score_r`,

			
			`tut_db_asu`.`results`.`nf_2_score` AS `nf_2_score`, 
			`tut_db_asu`.`results`.`nf_2_absent` AS `nf_2_absent`, 
			`tut_db_asu`.`results`.`nf_2_score_r` AS `nf_2_score_r`,
			
			COALESCE(`tut_db_asu`.`results`.`kori_kursi`, 0) AS `kori_kursi`, 
			`tut_db_asu`.`results`.`imt_score` AS `imt_score`, 
			`tut_db_asu`.`results`.`imt_add_date` AS `imt_date`, 
			`tut_db_asu`.`results`.`total_score` AS `total_score`, 
			`tut_db_asu`.`results`.`trimestr_score` AS `trimestr_score`, 
			(
				CASE 
					WHEN `tut_db_asu`.`results`.`imt_score` IS NULL 
					THEN 0 
					ELSE (
						`tut_db_asu`.`results`.`nf_1_score` + `tut_db_asu`.`results`.`nf_1_absent` + `tut_db_asu`.`results`.`nf_1_score_r`
						+
						`tut_db_asu`.`results`.`nf_2_score` + `tut_db_asu`.`results`.`nf_2_absent` + `tut_db_asu`.`results`.`nf_2_score_r` 
						+
						COALESCE(`tut_db_asu`.`results`.`imt_score`, 0)
					)
				END
			) AS `allscore`,
			`iqtibosho`.`id` as `id_iqtibos`
		FROM 
			`tut_db_asu`.`nt_content`
		LEFT JOIN 
			`tut_db_asu`.`results` 
			ON `results`.`id_student` = '$id_student' 
			AND `results`.`semestr` = `nt_content`.`semestr` 
			AND `results`.`id_fan` = `nt_content`.`id_fan`
		LEFT JOIN `iqtibosho` ON 
			`nt_content`.`id_nt` = `iqtibosho`.`id_nt` AND 
			`nt_content`.`id_fan` = `iqtibosho`.`id_fan` AND 
			`nt_content`.`semestr` = `iqtibosho`.`semestr` AND
			`iqtibosho`.`id_group` = '$id_group'
		LEFT JOIN `tests` ON 
			`tests`.`id_iqtibos` = `iqtibosho`.`id`
		LEFT JOIN 
			`fan_test` 
			ON `fan_test`.`id` = `nt_content`.`id_fan`
		WHERE 
			`nt_content`.`id_nt` = '$id_nt' 
			AND `nt_content`.`semestr` = '$semestr'
		GROUP BY 
			`tut_db_asu`.`nt_content`.`id`, 
			`tut_db_asu`.`results`.`id`,
			`tests`.`id`,
			`iqtibosho`.`id`
		ORDER BY 
			`fan_test`.`id`");
		
		return $fanlist;
	}
	
	function getNumberDelo ($id_faculty, $id_s_l, $id_s_v, $id_spec, $id_student){
		$info = query("SELECT COUNT(`id`) as `n` FROM `students` WHERE `status` = '-1' AND
		`id_faculty` = '$id_faculty' AND 
		`id_s_l` = '$id_s_l' AND 
		`id_s_v` = '$id_s_v' AND 
		`id_spec` = '$id_spec' AND 
		
		`id_student` < '$id_student' AND `s_y` = '".S_Y."'");
		
		return $number = $info[0]['n'] + 1;
	}
	
	
	function MakeAdminMenu(){
		$datas = query("
		SELECT
			`std_study_groups`.*,
			`faculties`.`title` AS `faculty_title`,
			`faculties`.`title` AS `faculty_title`,
			`faculties`.`short_title` AS `faculty_short`,
			`course`.`title` AS `course_title`,
			`specialties`.`code` AS `spec_code`,
			`specialties`.`title_tj` AS `spec_title_tj`,
			`groups`.`title` AS `group_title`,
			`study_level`.`title` AS `study_level_title`,
			`study_view`.`title` AS `study_view_title`
		FROM
			`std_study_groups`
		INNER JOIN `faculties` ON `std_study_groups`.`id_faculty` = `faculties`.`id`
		INNER JOIN `course` ON `std_study_groups`.`id_course` = `course`.`id`
		INNER JOIN `specialties` ON `std_study_groups`.`id_spec` = `specialties`.`id`
		INNER JOIN `groups` ON `std_study_groups`.`id_group` = `groups`.`id`

		INNER JOIN `study_level` ON `std_study_groups`.`id_s_l` = `study_level`.`id`
		INNER JOIN `study_view` ON `std_study_groups`.`id_s_v` = `study_view`.`id`
		
		WHERE `std_study_groups`.`status` = '1' AND `std_study_groups`.`s_y` = '".S_Y."' AND `std_study_groups`.`h_y` = '".H_Y."' 
		
		ORDER BY
			`std_study_groups`.`id_faculty`,
			`std_study_groups`.`id_s_l`,
			`std_study_groups`.`id_s_v`,
			`std_study_groups`.`id_course`,
			`std_study_groups`.`id_spec`,
			`std_study_groups`.`id_group`
		");
		
		$tree = [];
		foreach ($datas as $row) {
			$idFaculty = $row['id_faculty'];
			$idS_L = $row['id_s_l'];
			$idS_V = $row['id_s_v'];
			$idCourse = $row['id_course'];
			$idSpec = $row['id_spec'];
			$idGroup = $row['id_group'];

			// Построение древовидной структуры
			$tree[$idFaculty]['id'] = $idFaculty;
			$tree[$idFaculty]['title'] = $row['faculty_title'];
			$tree[$idFaculty]['short'] = $row['faculty_short'];
			$tree[$idFaculty]['level'][$idS_L]['id'] = $idS_L;
			$tree[$idFaculty]['level'][$idS_L]['title'] = $row['study_level_title']; // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['id'] = $idS_V;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['title'] = $row['study_view_title']; // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['id'] = $idCourse;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['title'] = $row['course_title']; // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['id'] = $idSpec;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['code'] = $row['spec_code']; // Замените на фактический код
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['title'] = $row['spec_title_tj']; // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['groups'][$idGroup]['id'] = $idGroup;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['groups'][$idGroup]['title'] = $row['group_title'];
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['groups'][$idGroup]['id_nt'] = $row['id_nt'];
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['groups'][$idGroup]['lang'] = $row['lang'];
		}
		
		
		return $tree;
	}
	
	
	function MakeMenuCQ($commission = false) {
		if(MY_URL == URL.'admin/'){
			$datas = query("
			SELECT
				`std_study_groups`.*,
				`faculties`.`title` AS `faculty_title`,
				`faculties`.`title` AS `faculty_title`,
				`faculties`.`short_title` AS `faculty_short`,
				`course`.`title` AS `course_title`,
				`specialties`.`code` AS `spec_code`,
				`specialties`.`title_tj` AS `spec_title_tj`,
				`groups`.`title` AS `group_title`,
				`study_level`.`title` AS `study_level_title`,
				`study_view`.`title` AS `study_view_title`
			FROM
				`std_study_groups`
			INNER JOIN `faculties` ON `std_study_groups`.`id_faculty` = `faculties`.`id`
			INNER JOIN `course` ON `std_study_groups`.`id_course` = `course`.`id`
			INNER JOIN `specialties` ON `std_study_groups`.`id_spec` = `specialties`.`id`
			INNER JOIN `groups` ON `std_study_groups`.`id_group` = `groups`.`id`

			INNER JOIN `study_level` ON `std_study_groups`.`id_s_l` = `study_level`.`id`
			INNER JOIN `study_view` ON `std_study_groups`.`id_s_v` = `study_view`.`id`
			
			WHERE `std_study_groups`.`status` = '-1' AND `std_study_groups`.`s_y` = '".S_Y."' AND `std_study_groups`.`h_y` = '".H_Y."' 
			
			ORDER BY
				`std_study_groups`.`id_faculty`,
				`std_study_groups`.`id_s_l`,
				`std_study_groups`.`id_s_v`,
				`std_study_groups`.`id_course`,
				`std_study_groups`.`id_spec`,
				`std_study_groups`.`id_group`
			");
			
			
		}else{
			
			if($commission[0]['id_faculties'] == 'ALL'){
				$where_fac = "";
			}else {
				$where_fac = " AND `std_study_groups`.`id_faculty` IN ({$commission[0]['id_faculties']}) ";
			}
			
        if($commission[0]['id_s_l'] == 'ALL'){
				$where_s_l = "";
			}else {
				$where_s_l = " AND `std_study_groups`.`id_s_l` IN ({$commission[0]['id_s_l']})  ";
			}
			
			
			
			
			
			$datas = query("
			SELECT
				`std_study_groups`.*,
				`faculties`.`title` AS `faculty_title`,
				`faculties`.`title` AS `faculty_title`,
				`faculties`.`short_title` AS `faculty_short`,
				`course`.`title` AS `course_title`,
				`specialties`.`code` AS `spec_code`,
				`specialties`.`title_tj` AS `spec_title_tj`,
				`groups`.`title` AS `group_title`,
				`study_level`.`title` AS `study_level_title`,
				`study_view`.`title` AS `study_view_title`
			FROM
				`std_study_groups`
			INNER JOIN `faculties` ON `std_study_groups`.`id_faculty` = `faculties`.`id`
			INNER JOIN `course` ON `std_study_groups`.`id_course` = `course`.`id`
			INNER JOIN `specialties` ON `std_study_groups`.`id_spec` = `specialties`.`id`
			INNER JOIN `groups` ON `std_study_groups`.`id_group` = `groups`.`id`

			INNER JOIN `study_level` ON `std_study_groups`.`id_s_l` = `study_level`.`id`
			INNER JOIN `study_view` ON `std_study_groups`.`id_s_v` = `study_view`.`id`
			
			WHERE `std_study_groups`.`status` = '-1' 
			$where_fac
			$where_s_l
			AND `std_study_groups`.`s_y` = '".S_Y."' AND `std_study_groups`.`h_y` = '".H_Y."' 
			
			ORDER BY
				`std_study_groups`.`id_faculty`,
				`std_study_groups`.`id_s_l`,
				`std_study_groups`.`id_s_v`,
				`std_study_groups`.`id_course`,
				`std_study_groups`.`id_spec`,
				`std_study_groups`.`id_group`
			");
		}
		
		
		
		
		$tree = [];
		foreach ($datas as $row) {
			$idFaculty = $row['id_faculty'];
			$idS_L = $row['id_s_l'];
			$idS_V = $row['id_s_v'];
			$idCourse = $row['id_course'];
			$idSpec = $row['id_spec'];
			$idGroup = $row['id_group'];

			// Построение древовидной структуры
			$tree[$idFaculty]['id'] = $idFaculty;
			$tree[$idFaculty]['title'] = $row['faculty_title'];
			$tree[$idFaculty]['short'] = $row['faculty_short'];
			$tree[$idFaculty]['level'][$idS_L]['id'] = $idS_L;
			$tree[$idFaculty]['level'][$idS_L]['title'] = $row['study_level_title']; // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['id'] = $idS_V;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['title'] = $row['study_view_title']; // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['id'] = $idCourse;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['title'] = $row['course_title']; // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['id'] = $idSpec;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['code'] = $row['spec_code']; // Замените на фактический код
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['title'] = $row['spec_title_tj']; // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['groups'][$idGroup]['id'] = $idGroup;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['groups'][$idGroup]['title'] = $row['group_title']; // Замените на фактический заголовок
		}
		
		
		return $tree;
		
	}
	
	function countElements(array $array): int {
		$count = 0;
		foreach ($array as $element) {
			if (is_array($element)) {
				// Рекурсивно считаем элементы в подмассиве
				$count += countElements($element);
			} else {
				$count++;
			}
		}
		return $count;
	}
	
	function makeShort($text){
		
		$words = explode(' ', $text);
		
		$abbreviation = '';
		foreach ($words as $word) {
			if($word == 'ва'){
				$abbreviation .= $word;
			}else
				$abbreviation .= mb_strtoupper(mb_substr($word, 0, 1));
		}
		
		return $abbreviation;
	}
	
	
	function clearPhone($n){
		if(!empty($n)){			
			$search = ['(', ') ', '-', ''];
			$replace = ['', '', '', ''];
			$n = str_replace($search, $replace, $n);
			return $n;
		}
		return '';
	}
	
	
	function gettextbyid($id){
		$group = select("answers", "*", "`id` = '$id'", "id", false, "");
		return $group[0]['text'];
	}
	
	function getImtType($id_fan, $id_faculty, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group, $s_y, $h_y){
		
		$query = query("SELECT * FROM `tests` WHERE `id_faculty` = '$id_faculty' 
		AND `id_s_l` = '$id_s_l' 
		AND `id_s_v` = '$id_s_v' 
		AND `id_course` = '$id_course' 
		AND `id_spec` = '$id_spec' 
		AND `id_group` = '$id_group'
		AND `id_fan` = '$id_fan'
		AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		if(!empty($query))
			return $query;
	}
	
	function getKK($id_student, $id_fan, $s_y, $h_y){
		$query = query("SELECT `kori_kursi` FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		if(!empty($query[0]['kori_kursi']))
			return $query[0]['kori_kursi'];
		else return 0;
	}
	
	function Search($word) {
		
		$res = query("
			SELECT u.*, s.* 
			FROM users u 
			INNER JOIN students s 
			ON u.id = s.id_student 
			WHERE (u.fullname_tj LIKE '%$word%' 
				OR u.id = '$word' 
				OR u.phone LIKE '%$word%') 
			AND s.id = (
				SELECT id 
				FROM students s2 
				WHERE s2.id_student = u.id 
				ORDER BY s2.s_y DESC, s2.id DESC 
				LIMIT 1
			)
		");
		// print_arr($res);
		// exit;
		return $res;
		/*
		$res = query2("
			SELECT u.*, s.*
			FROM users u
			INNER JOIN students s ON u.id = s.id_student
			WHERE (u.fullname_tj LIKE '%$word%' OR u.id = '$word' OR u.phone LIKE '%$word%')
			AND s.id = (
				SELECT MAX(id)
				FROM students s
				WHERE s.id_student = u.id
			)
		");
		print_arr($res);
		
		exit;
		return $res;
		$res = query("
			SELECT `users`.*, `students`.*
			FROM `users`
			INNER JOIN `students` ON `users`.`id` = `students`.`id_student`
			WHERE
			(`users`.`fullname_tj` LIKE '%$word%' OR `users`.`id` = '$word')
			AND `students`.`id` = (
				SELECT MAX(`id`)
				FROM `students`
				WHERE `students`.`id_student` = `users`.`id` AND `students`.`s_y` = '".S_Y."'
			)
		");
		
		
		$res = query2("
			SELECT u.*, s.*
			FROM users u
			INNER JOIN students s ON u.id = s.id_student
			WHERE (u.fullname_tj LIKE '%$word%' OR u.id = '$word')
			
			AND s.s_y = (
				SELECT MAX(s_y)
				FROM students s
				WHERE s.id_student = u.id
			)
		");
		
		print_arr($res);
		exit;
		*/
		return $res;
	}
	
	function SearchByTeachers($word, $options) {
		
		
		if($options[0]['id_faculty'] == 'ALL'){
			$where_fac = "";
		}else {
			$where_fac = "`s`.`id_faculty` IN ({$options[0]['id_faculty']}) AND ";
		}
		
		if($options[0]['id_s_l'] == 'ALL'){
			$where_s_l = "";
		}else {
			$where_s_l = "`s`.`id_s_l` IN ({$options[0]['id_s_l']}) AND ";
		}
		
		if($options[0]['id_s_v'] == 'ALL'){
			$where_s_v = "";
		}else {
			$where_s_v = "`s`.`id_s_v` IN ({$options[0]['id_s_v']}) AND ";
		}
		
		$res = query("
			SELECT u.*, s.* 
			FROM users u 
			INNER JOIN students s 
			ON u.id = s.id_student 
			WHERE ($where_fac $where_s_l $where_s_v u.fullname_tj LIKE '%$word%' 
				OR u.id = '$word' 
				OR u.phone LIKE '%$word%') 
			AND s.id = (
				SELECT id 
				FROM students s2 
				WHERE s2.id_student = u.id 
				ORDER BY s2.s_y DESC, s2.id DESC 
				LIMIT 1
			)
		");
		
		return $res;
	}
	
	function MakeSuperMenu(){
		$sql = query("SELECT * FROM `std_study_groups` ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`");
		// Создание древовидной структуры
		$tree = [];

		foreach ($sql as $row) {
			$idFaculty = $row['id_faculty'];
			$idS_L = $row['id_s_l'];
			$idS_V = $row['id_s_v'];
			$idCourse = $row['id_course'];
			$idSpec = $row['id_spec'];
			$idGroup = $row['id_group'];

			// Построение древовидной структуры
			$tree[$idFaculty]['id'] = $idFaculty;
			$tree[$idFaculty]['title'] = getFaculty($idFaculty); // Замените на фактический заголовок
			$tree[$idFaculty]['short'] = getFacultyShort($idFaculty); // Замените на фактическое сокращение
			$tree[$idFaculty]['level'][$idS_L]['id'] = $idS_L;
			$tree[$idFaculty]['level'][$idS_L]['title'] = getStudyLevel($idS_L); // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['id'] = $idS_V;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['title'] = getStudyView($idS_V); // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['id'] = $idCourse;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['title'] = getCourse($idCourse); // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['id'] = $idSpec;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['code'] = getSpecialtyCode($idSpec); // Замените на фактический код
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['title'] = getSpecialtyTitle($idSpec); // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['groups'][$idGroup]['id'] = $idGroup;
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['groups'][$idGroup]['title'] = getGroup($idGroup); // Замените на фактический заголовок
			$tree[$idFaculty]['level'][$idS_L]['view'][$idS_V]['course'][$idCourse]['spec'][$idSpec]['groups'][$idGroup]['short'] = getGroup2($idGroup); // Замените на фактический заголовок
		}
		return $tree;
	}
	
	
	function getUserNameXatm($id){
		$query = select("users_2", "*", "`id` = '$id'", "id", false, "");
		return $query[0]['fio'];
	}
	
	function getShortNameXatm($id){
		$query = select("users_2", "*", "`id` = '$id'", "id", false, "");
		$name = $query[0]['fio'];
		$exp = explode(" ", $name);
		
		$new_name = $exp[0].' ';
		for($i = 1; $i < count($exp); $i++){
			$new_name .= mb_substr($exp[$i],0,1).'. ';
		}
		
		return trim($new_name);
	}
	
	function getStudentKhobgoh($id, $S_Y){
		
		$query = query("SELECT * FROM khobgoh WHERE id_user = '$id' AND `s_y` = '$S_Y'");
		
		if(!empty($query)){
			$datas['id_khobgoh'] = $query[0]['id_khobgoh'];
			$datas['number_home'] = $query[0]['number_home'];
			return $datas;
		}else {
			return false;
		}
	}
	
	function getTeacherByIq($id_iqtibos, $type){
		$query = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `type` = '$type'");
		
		if(!empty($query)) return $query[0]['id_teacher'];
		else return false;
	}
	
	
	function MakeMenuLitsey(){
		if(!isset($_SESSION['litsey'])){
			$sinfho = query("SELECT DISTINCT(`id_sinf`) FROM `student_litsey` WHERE `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_sinf`");
			
			$superarr = array();
			foreach($sinfho as $sinf){
				$id_sinf = $sinf['id_sinf'];
				
				$superarr[$id_sinf]["id"] = $id_sinf;
				$superarr[$id_sinf]["title"] = "Синфи $id_sinf";
				
				$groups = query("SELECT DISTINCT(`id_group`) FROM `student_litsey` WHERE `id_sinf` = '$id_sinf' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_group`");
				
				foreach($groups as $group) {
					$id_group = $group['id_group'];
					
					$superarr[$id_sinf]["groups"][$id_group]['id'] = $id_group;
					$superarr[$id_sinf]["groups"][$id_group]['title'] = getGroup2($id_group);
					
				}
			}
			return $superarr;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	function getStatisticMMT($id_faculty, $id_s_l, $id_s_v, $id_s_t, $date_start = false, $date_finish = false){
		
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		
		//
		$student = query("SELECT 
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		WHERE
		`student_mmt_information`.`number_mmt` IS NOT NULL AND
		`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
		`students`.`status` = '-1' AND
		`students`.`id_faculty` = '$id_faculty' AND 
		`students`.`id_s_l` = '$id_s_l' AND 
		`students`.`id_s_v` = '$id_s_v' AND 
		`students`.`id_s_t` = '$id_s_t' AND
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		//print_arr($student);
		return $student[0]['total'];
	}
	
	function getStatisticMMTJins($id_faculty, $id_s_l, $id_s_v, $jins, $date_start = false, $date_finish = false){
		
		if($id_s_v){
			$study_view = "`students`.`id_s_v` = '$id_s_v' AND ";
		}else {
			$study_view = "";
		}
		
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		//`users`.*, `students`.*, `user_passports`.*, `user_udecation`.*
		$student = query("SELECT 
		COUNT(`users`.`id`) as `total` 
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		WHERE
		`users`.`jins` = '$jins' AND 
		`student_mmt_information`.`number_mmt` IS NOT NULL AND
		`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
		`students`.`status` = '-1' AND
		`students`.`id_faculty` = '$id_faculty' AND 
		`students`.`id_s_l` = '$id_s_l' AND 
		$study_view
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		//print_arr($student);
		return $student[0]['total'];
	}
	
	function getStatisticKvota($id_faculty, $id_s_l, $date_start = false, $date_finish = false){
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		$student = query("SELECT 
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		WHERE
		`students`.`status` = '-1' AND
		`students`.`id_faculty` = '$id_faculty' AND 
		`students`.`id_s_l` = '$id_s_l' AND 
		`students`.`id_s_t` = '3' AND
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		return $student[0]['total'];
	}
	
	
	function getStatistic($id_faculty, $date_start = false, $date_finish = false) {
		
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		$student = query("SELECT 
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		WHERE
		`students`.`status` = '-1' AND
		`students`.`id_faculty` = '$id_faculty' AND 
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		/*
		foreach($student as $item){
			echo $item['id'].' ';
		}
		*/
		return $student[0]['total'];
	}
	
	function getStatisticXoriji($id_faculty, $date_start = false, $date_finish = false) {
		
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		$student = query("SELECT
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		WHERE
		`students`.`status` = '-1' AND
		`students`.`id_faculty` = '$id_faculty' AND 
		`students`.`foreign` = '1' AND
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		
		return $student[0]['total'];
		
	}
	
	function getStatisticMDOK($id_faculty, $date_start = false, $date_finish = false){
		
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		//`users`.`id`
		$student = query("SELECT
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		WHERE
		`students`.`status` = '-1' AND
		`students`.`id_faculty` = '$id_faculty' AND 
		`students`.`id_s_l` = '2' AND 
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		/*
		foreach($student as $item){
			echo $item['id'].' ';
		}
		*/
		return $student[0]['total'];
		
	}
	
	function getStatisticAfterCollege($id_faculty, $id_s_v, $id_s_t = false, $date_start = false, $date_finish = false){
		if($id_s_t){
			$study_type = "`students`.`id_s_t` = '$id_s_t' AND ";
		}else {
			$study_type = "";
		}
		
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		//`users`.*, `students`.*, `user_passports`.*, `user_udecation`.*
		$student = query("SELECT
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		WHERE
		`user_udecation`.`id_khatm_namud` = '2' AND
		
		`students`.`status` = '-1' AND
		`students`.`id_course` = '2' AND
		`students`.`id_faculty` = '$id_faculty' AND 
		`students`.`id_s_l` = '1' AND 
		`students`.`id_s_v` = '$id_s_v' AND 
		`students`.`foreign` IS NULL AND
		$study_type
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		//print_arr($student);
		return $student[0]['total'];
		
	}
	
	function getStatisticMagistr($id_faculty, $id_s_t, $date_start = false, $date_finish = false){
		
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		//`users`.`id`
		$student = query("SELECT
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		WHERE
		`students`.`status` = '-1' AND
		`students`.`id_faculty` = '$id_faculty' AND 
		`students`.`id_s_l` = '3' AND 
		`students`.`id_s_t` = '$id_s_t' AND 
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		/*
		foreach($student as $item){
			echo $item['id'].' ';
		}
		*/
		return $student[0]['total'];
		
	}
	
	function getStatisticPhD($id_faculty, $id_s_t, $date_start = false, $date_finish = false){
		
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		//`users`.`id`
		$student = query("SELECT
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		WHERE
		`students`.`status` = '-1' AND
		`students`.`id_faculty` = '$id_faculty' AND 
		`students`.`id_s_l` = '4' AND 
		`students`.`id_s_t` = '$id_s_t' AND 
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		/*
		foreach($student as $item){
			echo $item['id'].' ';
		}
		*/
		return $student[0]['total'];
		
	}
	
	/*SELECT student_mmt_information.*, students.*, users.* FROM users 
	INNER JOIN students ON students.id_student = users.id 
	INNER JOIN student_mmt_information ON student_mmt_information.id_student = users.id 
	WHERE number_mmt IS NULL AND total_score_mmt IS NULL AND davri_qabul_mmt = 3 AND students.id_s_l=1 AND 
	students.foreign IS NULL AND students.status=-1;*/
	
	
	function getStatisticDoxili($id_faculty, $id_s_v, $id_s_t, $date_start = false, $date_finish = false){
		
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		//`users`.`id`
		$student = query("SELECT
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		WHERE
		`students`.`status` = '-1' AND
		`student_mmt_information`.`davri_qabul_mmt` = '3' AND
		`student_mmt_information`.`number_mmt` IS NULL AND `student_mmt_information`.`total_score_mmt` IS NULL
		AND `students`.`foreign` IS NULL AND
		`students`.`id_faculty` = '$id_faculty' AND 
		`students`.`id_s_l` = '1' AND 
		`students`.`id_s_t` = '$id_s_t' AND 
		`students`.`id_s_v` = '$id_s_v' AND 
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		/*
		foreach($student as $item){
			echo $item['id'].' ';
		}
		*/
		return $student[0]['total'];
		
	}
	
	function getStatisticDoxiliBujRuzFos($id_faculty, $id_s_t, $date_start = false, $date_finish = false){
		
		if($date_start && $date_finish){
			$datequery = "`users`.`added_time` BETWEEN '$date_start' AND '$date_finish' AND ";
		}else {
			$datequery = "";
		}
		
		//`users`.`id`
		$student = query("SELECT
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
		WHERE
		`students`.`status` = '-1' AND
		`student_mmt_information`.`davri_qabul_mmt` = '3' AND
		`student_mmt_information`.`number_mmt` IS NULL AND `student_mmt_information`.`total_score_mmt` IS NULL
		AND `students`.`foreign` IS NULL AND
		`students`.`id_faculty` = '$id_faculty' AND 
		`students`.`id_s_l` = '1' AND 
		`students`.`id_s_t` = '$id_s_t' AND 
		$datequery
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		");
		
		/*
		foreach($student as $item){
			echo $item['id'].' ';
		}
		*/
		return $student[0]['total'];
		
	}
	
	
	function getShartnomaNumber($id_student){
		
		$info = query("SELECT COUNT(`id`) as `n` FROM `students` WHERE `status` = '-1' AND
		`id_student` < '$id_student' AND `id_s_t` = '1' AND `s_y` = '".S_Y."'");
		
		$number = $info[0]['n'] + 1;
		$number = sprintf ("%04d", $number);
		return $number.'/'.S_Y;
	}
	
	
	
	function findIndexInTwoDimensionalArray($array, $valueToFind) {
		foreach ($array as $rowIndex => $row) {
			foreach ($row as $colIndex => $element) {
				if ($element === $valueToFind) {
					return $rowIndex;
				}
			}
		}
		return null; // Если значение не найдено
	}
	
	
	function getSharnomaMoneyBySY($id_course, $id_spec, $id_s_l, $id_s_v, $S_Y, $xoriji = false){
		
		//echo $xoriji;
		
		$S_Y = $S_Y - $id_course + 1;
		
		$query = query("SELECT `qabul_plan`.*, `qabul_plan_detail`.* FROM `qabul_plan_detail` 
					INNER JOIN `qabul_plan` ON `qabul_plan_detail`.`id_qabul_plan` = `qabul_plan`.`id`
					WHERE `qabul_plan_detail`.`id_s_t` = '1' AND `qabul_plan`.`s_y` = '$S_Y' 
					AND `qabul_plan_detail`.`id_spec` = '$id_spec' AND `qabul_plan_detail`.`id_s_l` = '$id_s_l'
					AND `qabul_plan_detail`.`id_s_v` = '$id_s_v'
					");

		//print_arr($query);
		
		if($xoriji == 'xoriji' || isset($xoriji)){
			if(!empty($query))
				return $query[0]['money_other'];
		}else {
			if(!empty($query))
				return $query[0]['money'];
		}
	}
	
	
	function getStudentMMTbyDavr($id_davr) {
		$student = query("SELECT 
		COUNT(`users`.`id`) as `total`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
		INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id` 
		AND `student_mmt_information`.`davri_qabul_mmt` = '$id_davr'
		WHERE
		`student_mmt_information`.`number_mmt` IS NOT NULL AND
		`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
		`students`.`status` = '-1' AND
		`students`.`s_y` = '".S_Y."'
		");

		return $student[0]['total'];
	}
?>
