<?php



switch($action){
	case "dotj_questions":
		$table = 'questions';
		$questions = query("SELECT * FROM `$table`");
		
		foreach($questions as $item){
			$id = $item['id'];
			$fields['text'] = doTajik($item['text']);
			
			update("$table", $fields, "`id` = '$id'");
		}
		echo "ok";
		exit;
	break;
	
	case "dotj_answers":
		$table = 'answers';
		$answers = query("SELECT * FROM `$table`");
		
		foreach($answers as $item){
			$id = $item['id'];
			$fields['text'] = doTajik($item['text']);
			
			update("$table", $fields, "`id` = '$id'");
		}
		echo "ok";
		exit;
	break;
	
	
	case "downloadtest":
		$id_fan = $_REQUEST['id_fan'];
		
		$datas = query("SELECT * FROM `questions` WHERE `id_fan` = '$id_fan'");
		exit;
	break;
	
	case "fanlist":
		$fanlist = query("SELECT DISTINCT(`tests`.`id_fan`), `tests`.`s_y`, `tests`.`h_y`, `fan_test`.*,
		`tests_settings`.`score`, 
		`tests_settings`.`t1`,
		`tests_settings`.`t2`,
		`tests_settings`.`t3`,
		`tests_settings`.`t4`,
		`tests_settings`.`t5`,
		`tests_settings`.`t6`
		FROM `tests` 
		INNER JOIN `fan_test` ON `fan_test`.`id` = `tests`.`id_fan`
		LEFT JOIN `tests_settings` ON `tests`.`id_fan` = `tests_settings`.`id_fan` 
		AND `tests`.`s_y` = `tests_settings`.`s_y` 
		AND `tests`.`h_y` = `tests_settings`.`h_y` 
		WHERE `tests`.`s_y` = '".S_Y."' AND  `tests`.`h_y` = '".H_Y."' ORDER BY `fan_test`.`title_tj`");
		
		
		$page_info['title'] = 'Руйхати фанҳо';
	break;
	
	case "load":
		//$datas = query("SELECT * FROM `iqtibosho` WHERE `id_fan` != 1748 AND `semestr` IN (1,3,5,7,9) ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`");
		$s_y = S_Y;
		$datas = query("SELECT * FROM `iqtibosho` 
		WHERE `s_y` = '$s_y'
		ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`");
		
		//print_arr($datas);
		
		echo count($datas);
		
		foreach($datas as $item){
			
			$check = query("SELECT * FROM `tests` WHERE 
				`id_iqtibos` = '{$item['id']}' AND 
				`id_faculty` = '{$item['id_faculty']}' AND 
				`id_s_l` = '{$item['id_s_l']}' AND 
				`id_s_v` = '{$item['id_s_v']}' AND 
				`id_course` = '{$item['id_course']}' AND 
				`id_spec` = '{$item['id_spec']}' AND 
				`id_group` = '{$item['id_group']}' AND 
				`id_fan` = '{$item['id_fan']}' 
			");
			
			if(empty($check)){
				unset($data, $field);
				
				$data['id_iqtibos'] = "'".$item['id']."'";
				$data['id_faculty'] = "'".$item['id_faculty']."'";
				$data['id_s_l'] = "'".$item['id_s_l']."'";
				$data['id_s_v'] = "'".$item['id_s_v']."'";
				$data['id_course'] = "'".$item['id_course']."'";
				$data['id_spec'] = "'".$item['id_spec']."'";
				$data['id_group'] = "'".$item['id_group']."'";
				$data['id_fan'] = "'".$item['id_fan']."'";
				$data['status'] = "'0'";
				$data['s_y'] = "'".$item['s_y']."'";
				if($item['semestr'] % 2 == 0){
					$data['h_y'] = "'2'";
				}else
					$data['h_y'] = "'1'";
				
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				insert('tests', $fields, $data);
			}else{
				$id = $check[0]['id'];
				
				
				if($item['id_fan'] != $check[0]['id_fan']){
					echo "Дар $id id_fan иваз шудааст! <br>";
					$fields_update['id_fan'] = $item['id_fan'];
				}
				
				if($item['semestr'] % 2 == 0){
					$fields_update['h_y'] = 2;
				}else 
					$fields_update['h_y'] = 1;
				
				update("tests", $fields_update, "`id` = '$id'");
			}
		}
		exit;
	
	break;
	
	case "imt_statistic":
		
		$page_info['title'] = 'Статистикаи ведомостҳо';
	break;
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		
		if(isset($_REQUEST['s_y'])){
			$s_y = $_REQUEST['s_y'];
			$h_y = $_REQUEST['h_y'];
		}else{
			$s_y = S_Y;
			$h_y = H_Y;
		}
		
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
			`std_study_groups`.`status` = '1' AND 
			`std_study_groups`.`id_faculty` = '$id_faculty' AND 
			`std_study_groups`.`id_s_l` = '$id_s_l' AND 
			`std_study_groups`.`id_s_v` = '$id_s_v' AND  
			`std_study_groups`.`s_y` = '$s_y' AND 
			`std_study_groups`.`h_y` = '$h_y'
					
		");
		
		$page_info['title'] = 'Тестҳо / '.$group_options[0]['faculty_short'].' / '.$group_options[0]['s_l_title'].' / '.$group_options[0]['s_v_title'].' / '.$group_options[0]['course_title'];
	
		
	break;
	
	case "update":
		$id = $_REQUEST['id'];
		
		$fields['imt_type'] = $_REQUEST['imt_type'];
		$fields['datetime'] = $_REQUEST['datetime'];
		
		update("tests", $fields, "`id` = '$id'");
		redirect();
	break;
	
	case "transfer":
		$faculties = select("faculties", "*", "", "id", false, "");
		$studylevels = select("study_level", "*", "", "id", false, "");
		
		$studyviews = select("study_view", "*", "", "id", false, "");
		$courses = select("course", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "id", false, "");
		
		
		$teachers = query("SELECT * FROM `users` WHERE `access_type` = '2' ORDER BY `fullname_tj`");
		
		//$fanho = query("SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `imt_type` = '1' ORDER BY `id_fan`");
		
		$fanho = query("SELECT DISTINCT (`tests`.`id_fan`), `fan_test`.`title_tj` FROM `tests` INNER JOIN `fan_test` ON `tests`.`id_fan` = `fan_test`.`id` WHERE `imt_type` = '1' ORDER BY `fan_test`.`title_tj`");
		
		$page_info['title'] = 'Трансфери саволномаҳо';
	break;
	
	case "transfer_quests":
		exit("COMING SOON!!!");
		
		$author_from = $_REQUEST['author_from'];
		$id_fan_from = $_REQUEST['id_fan_from'];
		$lang_from = $_REQUEST['lang_from'];
		$type = $_REQUEST['type'];
		
		
		$id_faculty_to = $_REQUEST['id_faculty_to'];
		$id_s_l_to = $_REQUEST['id_s_l_to'];
		$id_s_v_to = $_REQUEST['id_s_v_to'];
		$id_course_to = $_REQUEST['id_course_to'];
		$id_spec_to = $_REQUEST['id_spec_to'];
		$id_group_to = $_REQUEST['id_group_to'];
		
		
		$author_to = $_REQUEST['author_to'];
		$id_fan_to = $_REQUEST['id_fan_to'];
		$lang_to = $_REQUEST['lang_to'];
		
		
		if($type == 'all'){
			// HAMAI NAMUDI SAVOLHO GUZARONIDA SHAVAD
			$questions = query("SELECT * FROM `questions` WHERE `author` = '$author_from' AND `id_fan` = '$id_fan_from' AND `lang` = '$lang_from' ORDER BY `type`");
		}else{
			$questions = query("SELECT * FROM `questions` WHERE `author` = '$author_from' AND `type` = '$type' AND `id_fan` = '$id_fan_from' AND `lang` = '$lang_from' ORDER BY `type`");
		}
		
		
		foreach($questions as $item){
			unset($data_question, $fields_question);
			$id_question = $item['id'];
			
			$data_question['id_faculty'] = "'$id_faculty_to'";
			$data_question['id_s_l'] = "'$id_s_l_to'";
			$data_question['id_s_v'] = "'$id_s_v_to'";
			$data_question['id_course'] = "'$id_course_to'";
			$data_question['id_spec'] = "'$id_spec_to'";
			$data_question['id_fan'] = "'$id_fan_to'";
			$data_question['lang'] = "'$lang_to'";
			$data_question['type'] = "'".$item['type']."'";
			$data_question['text'] = "'".$item['text']."'";
			$data_question['author'] = "'".$author_to."'";
			$data_question['s_y'] = "'".S_Y."'";
			$data_question['h_y'] = "'".H_Y."'";
			
			$fields_question = array_keys($data_question);
			$data_question = implode(",", $data_question);
			
			if($new_id_question = insert('questions', $fields_question, $data_question)){
				$answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_question' ORDER BY `id`");
				
				foreach($answers as $answer){
					unset($data_answer, $fields_answer);
					$data_answer['id_question'] = "'$new_id_question'";
					$data_answer['text'] = "'".$answer['text']."'";
					$data_answer['position'] = "'".$answer['position']."'";
					
					if($answer['right_answer']){
						$data_answer['right_answer'] = "'".$answer['right_answer']."'";
					}
					
					
					$fields_answer = array_keys($data_answer);
					$data_answer = implode(",", $data_answer);
					insert("answers", $fields_answer, $data_answer);
				}
			}
		}
		
		$_SESSION['transfer'] = true;
		redirect();
	break;
	
	
	case "delete":
		$id = $_REQUEST['id'];
		if(delete("tests","`id` = '$id'")){
			redirect();
		}
	break;
}


?><?php


switch($action){
	
	case "fanlist":
		$fanho = query("SELECT DISTINCT(`tests`.`id_fan`), `tests`.`s_y`, `tests`.`h_y`, `fan_test`.*,
		`tests_settings`.`score`
		FROM `tests` 
		INNER JOIN `fan_test` ON `fan_test`.`id` = `tests`.`id_fan`
		LEFT JOIN `tests_settings` ON `tests`.`id_fan` = `tests_settings`.`id_fan` 
		AND `tests`.`s_y` = `tests_settings`.`s_y` 
		AND `tests`.`h_y` = `tests_settings`.`h_y` 
		WHERE `tests`.`s_y` = '".S_Y."' AND  `tests`.`h_y` = '".H_Y."' ORDER BY `fan_test`.`title_tj`");
		
		
		$page_info['title'] = 'Руйхати фанҳо';
	break;
	
	case "load":
		//$datas = query("SELECT * FROM `iqtibosho` WHERE `id_fan` != 1748 AND `semestr` IN (1,3,5,7,9) ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`");
		$s_y = S_Y;
		$datas = query("SELECT * FROM `iqtibosho` 
		WHERE `s_y` = '$s_y'
		ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`");
		
		//print_arr($datas);
		
		echo count($datas);
		
		foreach($datas as $item){
			
			$check = query("SELECT * FROM `tests` WHERE 
				`id_iqtibos` = '{$item['id']}' AND 
				`id_faculty` = '{$item['id_faculty']}' AND 
				`id_s_l` = '{$item['id_s_l']}' AND 
				`id_s_v` = '{$item['id_s_v']}' AND 
				`id_course` = '{$item['id_course']}' AND 
				`id_spec` = '{$item['id_spec']}' AND 
				`id_group` = '{$item['id_group']}' AND 
				`id_fan` = '{$item['id_fan']}' 
			");
			
			if(empty($check)){
				unset($data, $field);
				
				$data['id_iqtibos'] = "'".$item['id']."'";
				$data['id_faculty'] = "'".$item['id_faculty']."'";
				$data['id_s_l'] = "'".$item['id_s_l']."'";
				$data['id_s_v'] = "'".$item['id_s_v']."'";
				$data['id_course'] = "'".$item['id_course']."'";
				$data['id_spec'] = "'".$item['id_spec']."'";
				$data['id_group'] = "'".$item['id_group']."'";
				$data['id_fan'] = "'".$item['id_fan']."'";
				$data['status'] = "'0'";
				$data['s_y'] = "'".$item['s_y']."'";
				if($item['semestr'] % 2 == 0){
					$data['h_y'] = "'2'";
				}else
					$data['h_y'] = "'1'";
				
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				insert('tests', $fields, $data);
			}else{
				$id = $check[0]['id'];
				
				
				if($item['id_fan'] != $check[0]['id_fan']){
					echo "Дар $id id_fan иваз шудааст! <br>";
					$fields_update['id_fan'] = $item['id_fan'];
				}
				
				if($item['semestr'] % 2 == 0){
					$fields_update['h_y'] = 2;
				}else 
					$fields_update['h_y'] = 1;
				
				update("tests", $fields_update, "`id` = '$id'");
			}
		}
		exit;
	
	break;
	
	case "imt_statistic":
		
		$page_info['title'] = 'Статистикаи ведомостҳо';
	break;
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		
		if(isset($_REQUEST['s_y'])){
			$s_y = $_REQUEST['s_y'];
			$h_y = $_REQUEST['h_y'];
		}else{
			$s_y = S_Y;
			$h_y = H_Y;
		}
		
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
			`std_study_groups`.`id_faculty` = '$id_faculty' AND 
			`std_study_groups`.`id_s_l` = '$id_s_l' AND 
			`std_study_groups`.`id_s_v` = '$id_s_v' AND  
			`std_study_groups`.`s_y` = '$s_y' AND 
			`std_study_groups`.`h_y` = '$h_y'
					
		");
		
		$page_info['title'] = 'Тестҳо / '.$group_options[0]['faculty_short'].' / '.$group_options[0]['s_l_title'].' / '.$group_options[0]['s_v_title'].' / '.$group_options[0]['course_title'];
	break;
	
	case "update":
		$id = $_REQUEST['id'];
		
		$fields['imt_type'] = $_REQUEST['imt_type'];
		$fields['datetime'] = $_REQUEST['datetime'];
		
		update("tests", $fields, "`id` = '$id'");
		redirect();
	break;
	
	case "transfer":
		$faculties = select("faculties", "*", "", "id", false, "");
		$studylevels = select("study_level", "*", "", "id", false, "");
		
		$studyviews = select("study_view", "*", "", "id", false, "");
		$courses = select("course", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "id", false, "");
		
		
		$teachers = query("SELECT * FROM `users` WHERE `access_type` = '2' ORDER BY `fullname_tj`");
		
		//$fanho = query("SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `imt_type` = '1' ORDER BY `id_fan`");
		
		$fanho = query("SELECT DISTINCT (`tests`.`id_fan`), `fan_test`.`title_tj` FROM `tests` INNER JOIN `fan_test` ON `tests`.`id_fan` = `fan_test`.`id` WHERE `imt_type` = '1' ORDER BY `fan_test`.`title_tj`");
		
		$page_info['title'] = 'Трансфери саволномаҳо';
	break;
	
	case "transfer_quests":
		exit("COMING SOON!!!");
		
		$author_from = $_REQUEST['author_from'];
		$id_fan_from = $_REQUEST['id_fan_from'];
		$lang_from = $_REQUEST['lang_from'];
		$type = $_REQUEST['type'];
		
		
		$id_faculty_to = $_REQUEST['id_faculty_to'];
		$id_s_l_to = $_REQUEST['id_s_l_to'];
		$id_s_v_to = $_REQUEST['id_s_v_to'];
		$id_course_to = $_REQUEST['id_course_to'];
		$id_spec_to = $_REQUEST['id_spec_to'];
		$id_group_to = $_REQUEST['id_group_to'];
		
		
		$author_to = $_REQUEST['author_to'];
		$id_fan_to = $_REQUEST['id_fan_to'];
		$lang_to = $_REQUEST['lang_to'];
		
		
		if($type == 'all'){
			// HAMAI NAMUDI SAVOLHO GUZARONIDA SHAVAD
			$questions = query("SELECT * FROM `questions` WHERE `author` = '$author_from' AND `id_fan` = '$id_fan_from' AND `lang` = '$lang_from' ORDER BY `type`");
		}else{
			$questions = query("SELECT * FROM `questions` WHERE `author` = '$author_from' AND `type` = '$type' AND `id_fan` = '$id_fan_from' AND `lang` = '$lang_from' ORDER BY `type`");
		}
		
		
		foreach($questions as $item){
			unset($data_question, $fields_question);
			$id_question = $item['id'];
			
			$data_question['id_faculty'] = "'$id_faculty_to'";
			$data_question['id_s_l'] = "'$id_s_l_to'";
			$data_question['id_s_v'] = "'$id_s_v_to'";
			$data_question['id_course'] = "'$id_course_to'";
			$data_question['id_spec'] = "'$id_spec_to'";
			$data_question['id_fan'] = "'$id_fan_to'";
			$data_question['lang'] = "'$lang_to'";
			$data_question['type'] = "'".$item['type']."'";
			$data_question['text'] = "'".$item['text']."'";
			$data_question['author'] = "'".$author_to."'";
			$data_question['s_y'] = "'".S_Y."'";
			$data_question['h_y'] = "'".H_Y."'";
			
			$fields_question = array_keys($data_question);
			$data_question = implode(",", $data_question);
			
			if($new_id_question = insert('questions', $fields_question, $data_question)){
				$answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_question' ORDER BY `id`");
				
				foreach($answers as $answer){
					unset($data_answer, $fields_answer);
					$data_answer['id_question'] = "'$new_id_question'";
					$data_answer['text'] = "'".$answer['text']."'";
					$data_answer['position'] = "'".$answer['position']."'";
					
					if($answer['right_answer']){
						$data_answer['right_answer'] = "'".$answer['right_answer']."'";
					}
					
					
					$fields_answer = array_keys($data_answer);
					$data_answer = implode(",", $data_answer);
					insert("answers", $fields_answer, $data_answer);
				}
			}
		}
		
		$_SESSION['transfer'] = true;
		redirect();
	break;
	
	
	case "delete":
		$id = $_REQUEST['id'];
		if(delete("tests","`id` = '$id'")){
			redirect();
		}
	break;
	
	
	/*IIIIIIIIIIII*/
	case "transfer2":
		$faculties = select("faculties", "*", "", "id", false, "");
		$studylevels = select("study_level", "*", "", "id", false, "");
		
		$studyviews = select("study_view", "*", "", "id", false, "");
		$courses = select("course", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "id", false, "");
		
		
		$teachers = query("SELECT * FROM `users` WHERE `access_type` = '2' ORDER BY `fullname_tj`");
		
		//$fanho = query("SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `imt_type` = '1' ORDER BY `id_fan`");
		
		$fanho = query("SELECT DISTINCT (`tests`.`id_fan`), `fan_test`.`title_tj` FROM `tests` INNER JOIN `fan_test` ON `tests`.`id_fan` = `fan_test`.`id` WHERE `imt_type` = '1' ORDER BY `fan_test`.`title_tj`");
		
		$page_info['title'] = 'Трансфери саволномаҳо';
	break;	
	
	case "transfer2_quests":		
		
		$hy_from = $_REQUEST['hy_from'];
		$id_fan_from = $_REQUEST['id_fan_from'];
		$author_from = $_REQUEST['author_from'];
		$lang_from = $_REQUEST['lang_from'];
		$rating_from = $_REQUEST['rating_from'];
		
		
		$id_faculty_to = $_REQUEST['id_faculty_to'];
		$id_s_l_to = $_REQUEST['id_s_l_to'];
		$id_s_v_to = $_REQUEST['id_s_v_to'];
		$id_course_to = $_REQUEST['id_course_to'];
		$id_spec_to = $_REQUEST['id_spec_to'];
		$id_group_to = $_REQUEST['id_group_to'];
		$id_fan_to = $_REQUEST['id_fan_to'];
		$author_to = $_REQUEST['author_to'];
		$lang_to = $_REQUEST['lang_to'];
		$rating_to = $_REQUEST['rating_to'];
		
		
		$questions = query("SELECT * FROM `questions` WHERE `author` = '$author_from' AND `id_fan` = '$id_fan_from' AND `rating` = '$rating_from' AND `lang` = '$lang_from' AND `h_y` = '$hy_from' ORDER BY `type`");
		
		foreach($questions as $item){
			unset($data_question, $fields_question);
			$id_question = $item['id'];
			$data_question['id_faculty'] = "'$id_faculty_to'";
			$data_question['id_s_l'] = "'$id_s_l_to'";
			$data_question['id_s_v'] = "'$id_s_v_to'";
			$data_question['id_course'] = "'$id_course_to'";
			$data_question['id_spec'] = "'$id_spec_to'";
			$data_question['id_fan'] = "'$id_fan_to'";
			$data_question['lang'] = "'$lang_to'";
			$data_question['rating'] = "'$rating_to'";
			$data_question['type'] = "'".$item['type']."'";
			$data_question['text'] = "'".$item['text']."'";
			$data_question['author'] = "'".$author_to."'";
			$data_question['s_y'] = "'".S_Y."'";
			$data_question['h_y'] = "'".H_Y."'";
			
			$fields_question = array_keys($data_question);
			$data_question = implode(",", $data_question);
			
			if($new_id_question = insert('questions', $fields_question, $data_question)){
				$answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_question' ORDER BY `id`");
				
				foreach($answers as $answer){
					unset($data_answer, $fields_answer);
					$data_answer['id_question'] = "'$new_id_question'";
					$data_answer['text'] = "'".$answer['text']."'";
					$data_answer['position'] = "'".$answer['position']."'";
					
					if($answer['right_answer']){
						$data_answer['right_answer'] = "'".$answer['right_answer']."'";
					}
					
					
					$fields_answer = array_keys($data_answer);
					$data_answer = implode(",", $data_answer);
					insert("answers", $fields_answer, $data_answer);
				}
			}
		}
		
		$_SESSION['transfer'] = true;
		redirect();
	break;
	/*IIIIIIIIIIII*/
}


?>