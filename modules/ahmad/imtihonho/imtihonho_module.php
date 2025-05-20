<?php


switch($action){
	
	case "suporidand":
		if(isset($_REQUEST['date'])){
			$date = $_REQUEST['date'];
		}else
			$date = date("Y-m-d");
		$page_info['title'] = "Имтиҳон супориданд: $date";
		
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$datas = query("SELECT 
			`faculties`.`title` as `faculty_title`,
			`faculties`.`short_title` as `faculty_short`,
			`specialties`.`code` as `spec_code`,
			`specialties`.`title_tj` as `spec_title_tj`,
			`groups`.`title` as `group_title`,
			`fan_test`.`title_tj` as `fan_title`,
			`tests`.`imt_type`,
			`study_level`.`title` as `study_level_title`,
			`study_view`.`title` as `study_view_title`,
			`users`.`fullname_tj`,
			`results`.*
		FROM `results` 
		INNER JOIN `faculties` ON `results`.`id_faculty` = `faculties`.`id`
		INNER JOIN `specialties` ON `results`.`id_spec` = `specialties`.`id`
		INNER JOIN `groups` ON `results`.`id_group` = `groups`.`id`
		INNER JOIN `fan_test` ON `results`.`id_fan` = `fan_test`.`id`
		
		INNER JOIN `tests` ON 
			`results`.`id_faculty` = `tests`.`id_faculty` AND 
			`results`.`id_s_l` = `tests`.`id_s_l` AND
			`results`.`id_s_v` = `tests`.`id_s_v` AND
			`results`.`id_course` = `tests`.`id_course` AND
			`results`.`id_spec` = `tests`.`id_spec` AND
			`results`.`id_group` = `tests`.`id_group` AND
			`results`.`id_fan` = `tests`.`id_fan` AND
			`results`.`s_y` = `tests`.`s_y` AND
			`results`.`h_y` = `tests`.`h_y`
		
		INNER JOIN `study_level` ON `results`.`id_s_l` = `study_level`.`id`
		INNER JOIN `study_view` ON `results`.`id_s_v` = `study_view`.`id`
		INNER JOIN `users` ON `results`.`id_student` = `users`.`id`
		WHERE `results`.`id_s_v` = 1 AND
		`results`.`imt_add_date` LIKE '%$date%' ORDER BY `results`.`imt_add_date` DESC");
		
	break;
	
	case "nasuporidand":
		$page_info['title'] = "Иштирок накарданд";
		
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$datas = query("
			SELECT
				COUNT(`students`.`id_student`) as `fanho`,
				`students`.`id_faculty`,
				`students`.`id_course`,
				`students`.`id_spec`,
				`students`.`id_group`,
				`students`.`id_s_t`,
				`students`.`id_student`,
				`users`.`fullname_tj`,
				`users`.`jins`,
				
				`faculties`.`title` as `faculty_title`,
				`faculties`.`short_title` as `faculty_short`,
				`specialties`.`code` as `spec_code`,
				`specialties`.`title_tj` as `spec_title_tj`,
				`groups`.`title` as `group_title`,
				`study_level`.`title` as `study_level_title`,
				`study_view`.`title` as `study_view_title`,
				`study_type`.`title` as `study_type_title`,
				
				MIN(COALESCE(`results`.`imt_score`, 0)) AS `min`,
				MAX(COALESCE(`results`.`imt_score`, 0)) AS `max`
			FROM
				`students`
			INNER JOIN `results` ON `students`.`id_faculty` = `results`.`id_faculty` AND `students`.`id_s_l` = `results`.`id_s_l` AND `students`.`id_s_v` = `results`.`id_s_v` AND `students`.`id_course` = `results`.`id_course` AND `students`.`id_spec` = `results`.`id_spec` AND `students`.`id_group` = `results`.`id_group` AND `students`.`id_student` = `results`.`id_student` AND `students`.`s_y` = `results`.`s_y` AND `students`.`h_y` = `results`.`h_y`
			INNER JOIN `users` ON `students`.`id_student` = `users`.`id`
			INNER JOIN `faculties` ON `students`.`id_faculty` = `faculties`.`id`
			INNER JOIN `specialties` ON `students`.`id_spec` = `specialties`.`id`
			INNER JOIN `groups` ON `students`.`id_group` = `groups`.`id`
			INNER JOIN `study_level` ON `students`.`id_s_l` = `study_level`.`id`
			INNER JOIN `study_view` ON `students`.`id_s_v` = `study_view`.`id`
			INNER JOIN `study_type` ON `students`.`id_s_t` = `study_type`.`id`
		
			WHERE
				results.id_fan != '642' AND `students`.`status` = '1' AND 
				`students`.`id_student` IN(
				SELECT
					`id_student`
				FROM
					`students`
				WHERE
					`status` = '1' AND `id_s_l` = '1' AND `id_s_v` = '1' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'
			) AND `results`.`s_y` = '$S_Y' AND `results`.`h_y` = '$H_Y'
			GROUP BY
				`students`.`id_faculty`,
				`students`.`id_course`,
				`students`.`id_spec`,
				`students`.`id_group`,
				`students`.`id_s_t`,
				`students`.`id_student`,
				`users`.`fullname_tj`,
				`faculties`.`id`,
				`specialties`.`id`,
				`groups`.`id`,
				`study_level`.`id`,
				`study_view`.`id`,
				`study_type`.`id`
				
			HAVING
				`min` = 0 AND `max` = 0
			ORDER BY
				`students`.`id_faculty` ASC,
				`students`.`id_course` ASC,
				`students`.`id_spec` ASC,
				`students`.`id_group` ASC,
				`max`
			DESC
				,
				`min`
			DESC
				,
				`users`.`fullname_tj` ASC;
		");
		
	break;
	
	case "qarzdorho":
		
		$id_s_l = 1;
		$id_s_v = 1;
		
		$S_Y = 24;
		$H_Y = 1;
		
		
		/*
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
			
			`tests`.*, 
			`iqtibosho`.`id_departament`, `iqtibosho`.`semestr`,
			`departaments`.`title` as `departament`,
			`sarboriho`.`id_teacher`,
			`results`.`results_id`, 
			IFNULL(MAX(`results`.`total_score`), 0) as `total_score`, 
			`std_study_groups`.`id_nt`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		INNER JOIN `faculties` ON `students`.`id_faculty` = `faculties`.`id`
		INNER JOIN `specialties` ON `students`.`id_spec` = `specialties`.`id`
		INNER JOIN `study_type` ON `students`.`id_s_t` = `study_type`.`id`
		INNER JOIN `study_view` ON `students`.`id_s_v` = `study_view`.`id`
		INNER JOIN `study_level` ON `students`.`id_s_l` = `study_level`.`id`
		INNER JOIN `groups` ON `students`.`id_group` = `groups`.`id`
		
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
		INNER JOIN `fan_test` ON `tests`.`id_fan` = `fan_test`.`id`	
		WHERE 
		`sarboriho`.`type` = 'lk_plan' 
		AND `students`.`status` = '1' 
		AND `students`.`id_s_l` = '$id_s_l'
		AND `students`.`id_s_v` = '$id_s_v'
		
		AND `students`.`s_y` = '$S_Y' 
		AND `students`.`h_y` = '$H_Y'
		GROUP BY 
		`students`.`id`, `tests`.`id`, `results`.`results_id`, `std_study_groups`.`id`, `sarboriho`.`id`
		HAVING
			`total_score` < 50.00 
		ORDER BY `students`.`id_faculty`, `students`.`id_s_l`, `students`.`id_s_v`,
		`students`.`id_course`, `students`.`id_spec`, `students`.`id_group`,
		`users`.`fullname_tj`, `tests`.`id_fan`
		LIMIT 1
		");
		*/
		
		// $qarzdorho = query("
			// SELECT 
				// `students`.*, 
				// `faculties`.`short_title` AS `faculty_short`, 
				// `specialties`.`code` AS `spec_code`, 
				// `study_type`.`title` as `study_type_title`, 
				// `study_view`.`title` as `study_view_title`, 
				// `study_level`.`title` as `study_level_title`, 
				// `groups`.`title` AS `group_title`, 
				// `fan_test`.`title_tj` AS `fan_title`, 
				// `users`.`fullname_tj` as `student_name`, 
				// `teacher_users`.`fullname_tj` as `teacher_name`,
				// `tests`.*, 
				// `iqtibosho`.`id_departament`, `iqtibosho`.`semestr`,
				// `departaments`.`title` as `departament`,
				// `sarboriho`.`id_teacher`,
				// `results`.`results_id`, 
				// `results`.`nf_1_score` + `results`.`nf_2_score` as `nf_score`,
				// IFNULL(MAX(`results`.`total_score`), 0) as `total_score`, 
				// `std_study_groups`.`id_nt`
			// FROM 
				// `users`
			// INNER JOIN `students` ON 
				// `students`.`id_student` = `users`.`id` 
			// INNER JOIN `faculties` ON 
				// `students`.`id_faculty` = `faculties`.`id`
			// INNER JOIN `specialties` ON 
				// `students`.`id_spec` = `specialties`.`id`
			// INNER JOIN `study_type` ON 
				// `students`.`id_s_t` = `study_type`.`id`
			// INNER JOIN `study_view` ON 
				// `students`.`id_s_v` = `study_view`.`id`
			// INNER JOIN `study_level` ON 
				// `students`.`id_s_l` = `study_level`.`id`
			// INNER JOIN `groups` ON 
				// `students`.`id_group` = `groups`.`id`
			// INNER JOIN `std_study_groups` ON 
				// `std_study_groups`.`status` = 1 AND  
				// `students`.`id_faculty` = `std_study_groups`.`id_faculty` AND 
				// `students`.`id_s_l` = `std_study_groups`.`id_s_l` AND 
				// `students`.`id_s_v` = `std_study_groups`.`id_s_v` AND 
				// `students`.`id_course` = `std_study_groups`.`id_course` AND 
				// `students`.`id_spec` = `std_study_groups`.`id_spec` AND 
				// `students`.`id_group` = `std_study_groups`.`id_group` AND
				// `students`.`s_y` = `std_study_groups`.`s_y` AND
				// `students`.`h_y` = `std_study_groups`.`h_y`
			// INNER JOIN `tests` ON 
				// `students`.`id_faculty` = `tests`.`id_faculty` AND 
				// `students`.`id_s_l` = `tests`.`id_s_l` AND 
				// `students`.`id_s_v` = `tests`.`id_s_v` AND 
				// `students`.`id_course` = `tests`.`id_course` AND 
				// `students`.`id_spec` = `tests`.`id_spec` AND 
				// `students`.`id_group` = `tests`.`id_group` AND
				// `students`.`s_y` = `tests`.`s_y` AND
				// `students`.`h_y` = `tests`.`h_y`
			// INNER JOIN `iqtibosho` ON 
				// `iqtibosho`.`id` = `tests`.`id_iqtibos`
			// INNER JOIN `departaments` ON 
				// `departaments`.`id` = `iqtibosho`.`id_departament`
			// INNER JOIN `sarboriho` ON 
				// `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
			// INNER JOIN `users` AS `teacher_users` ON 
				// `sarboriho`.`id_teacher` = `teacher_users`.`id`
			// INNER JOIN `results` ON 
				// `tests`.`id_fan` = `results`.`id_fan` AND 
				// `students`.`id_student` = `results`.`id_student` AND 
				// `students`.`id_faculty` = `results`.`id_faculty` AND 
				// `students`.`id_s_l` = `results`.`id_s_l` AND 
				// `students`.`id_s_v` = `results`.`id_s_v` AND 
				// `students`.`id_course` = `results`.`id_course` AND 
				// `students`.`id_spec` = `results`.`id_spec` AND 
				// `students`.`id_group` = `results`.`id_group` AND
				// `students`.`s_y` = `results`.`s_y` AND
				// `students`.`h_y` = `results`.`h_y`
			// INNER JOIN `fan_test` ON 
				// `tests`.`id_fan` = `fan_test`.`id`	
			// WHERE 
				// `sarboriho`.`type` = 'lk_plan' 
				// AND `students`.`status` = '1' 
				// AND `students`.`id_s_l` = '$id_s_l'
				// AND `students`.`id_s_v` = '$id_s_v'
				// AND `students`.`s_y` = '$S_Y' 
				// AND `students`.`h_y` = '$H_Y'
			// GROUP BY 
				// `students`.`id`, `tests`.`id`, `results`.`results_id`, `std_study_groups`.`id`, `sarboriho`.`id`
			// HAVING
				// `total_score` < 50.00 
			// ORDER BY 
				// `students`.`id_faculty`, `students`.`id_s_l`, `students`.`id_s_v`,
				// `students`.`id_course`, `students`.`id_spec`, `students`.`id_group`,
				// `users`.`fullname_tj`, `tests`.`id_fan`
		// ");
		
		
		$qarzdorho = getQarzdorho($id_faculty=false, $id_s_l, $id_s_v, $id_course=false, $id_spec=false, $id_group=false, $S_Y, $H_Y);
		$page_info['title'] = 'Қарздорҳо';
		
	break;
	
	case "bartaraf_kardand":
		$id_s_l = 1;
		$id_s_v = 1;
		
		$S_Y = 24;
		$H_Y = 1;
		
		$bartaraf_kardand = getBartaraf($id_faculty=false, $id_s_l, $id_s_v, $id_course=false, $id_spec=false, $id_group=false, $S_Y, $H_Y);
		$page_info['title'] = 'Бартараф карданд';
		
	break;
	
}
?>