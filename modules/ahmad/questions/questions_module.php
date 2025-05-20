<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}

switch($action){
	
	case "list":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		
		$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		$id_faculty = $data_iq[0]['id_faculty'];
		$id_s_l = $data_iq[0]['id_s_l'];
		$id_s_v = $data_iq[0]['id_s_v'];
		$id_course = $data_iq[0]['id_course'];
		$id_spec = $data_iq[0]['id_spec'];
		$id_group = $data_iq[0]['id_group'];
		$semestr = $data_iq[0]['semestr'];
		$S_Y = $data_iq[0]['s_y'];
		
		if($semestr % 2 == 0){
			$H_Y = 2;
		}else $H_Y = 1;
		
		
		$id_departament = $data_iq[0]['id_departament'];
		$id_fan = $data_iq[0]['id_fan'];
		
		
		
		
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
		
		$page_info['title'] = 'Саволнома / '.$group_options[0]['faculty_short'].' / '.
		$group_options[0]['s_l_title'].' / '.$group_options[0]['s_v_title'].' / '.
		$group_options[0]['course_title'].' / '.$group_options[0]['spec_code'].' / '.getFanTest($id_fan);
		
		
		
		$test_option = query("SELECT * FROM `tests` WHERE `id_iqtibos` = '$id_iqtibos'");
		
		if($test_option[0]['test_type'] == 1){
			$w = "";
		}
		elseif($test_option[0]['test_type'] == 2){
			$w = "`id_faculty` = '$id_faculty' AND ";
		}
		elseif($test_option[0]['test_type'] == 3){
			$w = "`id_spec` = '$id_spec' AND ";
		}
		
		if(isset($_SESSION['user']['admin']) || !empty($test_center_module)){
			$questions = query("SELECT * FROM `questions` WHERE $w `id_fan` = '$id_fan' AND `lang` = '$lang' AND `h_y` = '$H_Y'");
		}else{
			$questions = query("SELECT * FROM `questions` WHERE $w `id_fan` = '$id_fan' AND `lang` = '$lang' AND `h_y` = '$H_Y' AND `author` = '".$_SESSION['user']['id']."'");
		}
		
		
	break;
	
	
	case "add":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$type = $_REQUEST['type'];
		$count = $_REQUEST['count'];
		
		
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
		
		
		$page_info['title'] = 'Иловакунии савол / '.$group_options[0]['faculty_short'].' / '.
		$group_options[0]['s_l_title'].' / '.$group_options[0]['s_v_title'].' / '.
		$group_options[0]['course_title'].' / '.$group_options[0]['spec_code'].' / '.getFanTest($id_fan).' / '.getLang($lang).' / '.$questions_type[$type].' / '.$count;
		
	break;
	
	case "insert_question":
		
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$type = $_REQUEST['type'];
		$count = $_REQUEST['count'];
		$lang = $_REQUEST['lang'];
		
		
		$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		
		$id_faculty = $data_iq[0]['id_faculty'];
		$id_s_l = $data_iq[0]['id_s_l'];
		$id_s_v = $data_iq[0]['id_s_v'];
		$id_course = $data_iq[0]['id_course'];
		$id_spec = $data_iq[0]['id_spec'];
		$id_fan = $data_iq[0]['id_fan'];
		
		
		for($i = 1; $i <= $count; $i++) {
			$question_text = trim($_REQUEST["savol_$i"]);
			if(!empty($question_text)){
				unset($data_question);
				$data_question['id_faculty'] = "'$id_faculty'";
				$data_question['id_s_l'] = "'$id_s_l'";
				$data_question['id_s_v'] = "'$id_s_v'";
				$data_question['id_course'] = "'$id_course'";
				$data_question['id_spec'] = "'$id_spec'";
				$data_question['id_fan'] = "'$id_fan'";
				$data_question['lang'] = "'$lang'";
				$data_question['type'] = "'$type'";
				
				if(WEEK < 10)
					$data_question['rating'] = "'1'";
				else
					$data_question['rating'] = "'2'";
				
				// Чзои лишний удалит
				$pattern = '/<span[^>]*>/';
				$question_text = preg_replace($pattern, '', $question_text);
				
				
				// Чзои лишний удалит
				$data_question['text'] = "'$question_text'";
				$data_question['author'] = "'".$_SESSION['user']['id']."'";
				$data_question['s_y'] = "'".S_Y."'";
				$data_question['h_y'] = "'".H_Y."'";
				
				$fields_question = array_keys($data_question);
				$data_question = implode(",", $data_question);
				
				if($id_question = insert('questions', $fields_question, $data_question)){
					
					if($type == 1){
						// Барои саволҳои оддӣ
						for($j = 1; $j <= 4; $j++){
							unset($data_answer);
							
							$right_answer = $_REQUEST["variant_$i"];
							$text = trim($_REQUEST["answer_{$i}_{$j}"]);
							
							$data_answer['id_question'] = "'$id_question'";
							// Чзои лишний удалит
							$pattern = '/<span[^>]*>/';
							$text = preg_replace($pattern, '', $text);
							
							// Чзои лишний удалит
							
							
							$data_answer['text'] = "'$text'";
							$data_answer['position'] = "'1'";
							if($right_answer == $j){
								$data_answer['right_answer'] = "'1'";
							}
							
							
							$fields_answer = array_keys($data_answer);
							$data_answer = implode(",", $data_answer);
							insert("answers", $fields_answer, $data_answer);
						}
					}
					elseif($type == 2){
						// Барои саволҳои бисёр интихоба
						for($j = 1; $j <= 4; $j++){
							unset($data_answer);
							
							$right_answer = @$_REQUEST["variant_{$i}_{$j}"];
							
							$text = trim($_REQUEST["answer_{$i}_{$j}"]);
							
							$data_answer['id_question'] = "'$id_question'";
							$data_answer['text'] = "'$text'";
							$data_answer['position'] = "'1'";
							if($right_answer == $j){
								$data_answer['right_answer'] = "'1'";
							}
							
							$fields_answer = array_keys($data_answer);
							$data_answer = implode(",", $data_answer);
							insert("answers", $fields_answer, $data_answer);
						}
					}
					elseif($type == 3){
						// Барои саволҳои мувофиқат
						for($j = 1; $j <= 5; $j++){
							$letter = trim(@$_REQUEST["letter_{$i}_{$j}"]);
							$number = trim($_REQUEST["number_{$i}_{$j}"]);
							
							if(!empty($letter)){
								unset($data_answer);
								$data_answer['id_question'] = "'$id_question'";
								$data_answer['text'] = "'$letter'";
								$data_answer['position'] = "'1'";
								
								
								$fields_answer = array_keys($data_answer);
								$data_answer = implode(",", $data_answer);
								$id_letter = insert("answers", $fields_answer, $data_answer);
							}
							if(!empty($number)){
								unset($data_answer);
								$data_answer['id_question'] = "'$id_question'";
								$data_answer['text'] = "'$number'";
								$data_answer['position'] = "'2'";
								
								$fields_answer = array_keys($data_answer);
								$data_answer = implode(",", $data_answer);
								
								if($id_number = insert("answers", $fields_answer, $data_answer)){
									if(!empty($letter)){
										$fields = array('right_answer' => $id_letter.'-'.$id_number);
										update("answers", $fields, "`id` = '$id_number'");
									}
								}
							}
						}
						
					}
					elseif($type == 4){
						for($j = 1; $j <= 4; $j++){
							unset($data_answer);
							
							$text = trim($_REQUEST["answer_{$i}_{$j}"]);
							
							$data_answer['id_question'] = "'$id_question'";
							$data_answer['text'] = "'$text'";
							$data_answer['position'] = "'1'";
							$data_answer['right_answer'] = "'1'";
							
							$fields_answer = array_keys($data_answer);
							$data_answer = implode(",", $data_answer);
							insert("answers", $fields_answer, $data_answer);
						}
					}
					elseif($type == 5 || $type == 6){
						// Барои саволҳои дохилкунии матн ва адад
						for($j = 1; $j <= 1; $j++){
							unset($data_answer);
							
							$right_answer = $_REQUEST["variant_$i"];
							$text = trim($_REQUEST["answer_{$i}_{$j}"]);
							
							$data_answer['id_question'] = "'$id_question'";
							$data_answer['text'] = "'$text'";
							$data_answer['position'] = "'1'";
							if($right_answer == $j){
								$data_answer['right_answer'] = "'1'";
							}
							
							$fields_answer = array_keys($data_answer);
							$data_answer = implode(",", $data_answer);
							insert("answers", $fields_answer, $data_answer);
						}
					}
					// Барои дигар намуди саволҳо
				}
			}
		}
		
		redirect(MY_URL."?option=questions&action=list&id_iqtibos=$id_iqtibos");
		exit;
	break;
	
	
	
	
	
	case "insert":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$type = $_REQUEST['type'];
		$lang = $_REQUEST['lang'];
		
		
		$data_iq = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		
		$id_faculty = $data_iq[0]['id_faculty'];
		$id_s_l = $data_iq[0]['id_s_l'];
		$id_s_v = $data_iq[0]['id_s_v'];
		$id_course = $data_iq[0]['id_course'];
		$id_spec = $data_iq[0]['id_spec'];
		$id_fan = $data_iq[0]['id_fan'];
		$s_y = $data_iq[0]['s_y'];
		if($data_iq[0]['semestr'] % 2 == 0){
			$h_y = 2;
		}else{
			$h_y = 1;
		}
		
		
		if($_FILES['savolnoma']['name']){
		
			$BaseName = "file_".$id_iqtibos.".docx";
			$BaseTmpName = $_FILES['savolnoma']['tmp_name'];
			
			if(move_uploaded_file($BaseTmpName, "../userfiles/_docx/$BaseName")){
				$file = "../userfiles/_docx/$BaseName";
				$text = docx2text($file);
				$text = getErrors($text);
				
			}
			
			
			
			if($text != false){
				$save = SaveQuestionAndAnswer($id_faculty, $id_s_l, $id_s_v, $id_course, $id_spec, $id_fan, $lang, $type, $text, $s_y, $h_y);
			}
			
			if($save){
				unlink($file);
			}
			redirect();
		}
	break;
	
	case "update_question":
		$id_question = $_REQUEST['id'];
		$type = $_REQUEST['type'];
		$url = $_REQUEST['url'];
		
		$text_savol = $_REQUEST['savol'];
		
		$fields_question['text'] = $text_savol;
		
		if(update("questions", $fields_question, "`id` = '$id_question'")){
			
			if($type == 1 || $type == 5 || $type == 6){
				// Типи оддӣ, дохилкунии рақам, дохилкунии матн
				$right_answer = $_REQUEST["variant_{$id_question}"];
				$answers = $_REQUEST['answer'];
				
				foreach ($answers as $value => $key){
					$fields_answers['text'] = $key;
					$fields_answers['right_answer'] = 'NULL';
					update("answers", $fields_answers, "`id` = '$value'");
				}
				
				$fields_answers_2['right_answer'] = 1;
				update("answers", $fields_answers_2, "`id` = '$right_answer'");
				
			}elseif($type == 2){
				// Типи бисёринтихоба
				$answers = $_REQUEST['answer'];
				foreach ($answers as $value => $key){
					$fields_answers['text'] = $key;
					$fields_answers['right_answer'] = 'NULL';
					update("answers", $fields_answers, "`id` = '$value'");
				}
				
				for($i = 0; $i < count($_REQUEST["variant_{$id_question}"]); $i++){
					if(isset($_REQUEST["variant_{$id_question}"][$i])){
						$right_answer = $_REQUEST["variant_{$id_question}"][$i];
						
						$fields_answers_2['right_answer'] = 1;
						update("answers", $fields_answers_2, "`id` = '$right_answer'");
					}
				}
			}elseif($type == 3){
				// типи Мувофиқат
				$answers_1 = $_REQUEST['number'];
				foreach ($answers_1 as $value => $key){
					
					$fields_answers['text'] = $key;
					update("answers", $fields_answers, "`id` = '$value'");
				}
				
				$answers_2 = $_REQUEST['letter'];
				foreach ($answers_2 as $value => $key){
					
					$fields_answers['text'] = $key;
					update("answers", $fields_answers, "`id` = '$value'");
				}
			}elseif($type == 4){
				$answers = $_REQUEST['answer'];
				
				foreach ($answers as $value => $key){
					$fields_answers['text'] = $key;
					update("answers", $fields_answers, "`id` = '$value'");
				}
			}
			
		}
		
		redirect($url);
	break;
	
	case "check":
		
		$questions = query("SELECT * FROM `_questions`");
		foreach($questions as $item){
			$id_quest = $item['id'];
			$text_quest = $item['text'];
			
			
			$answers = query("SELECT * FROM `_answers` WHERE `id_quest` = '$id_quest' ORDER BY `right_answer` DESC");
			foreach($answers as $a_item){
				if($a_item['right_answer']){
					continue 2;
				}else {
					echo "<span style='color:red'>Ҷавоби дуруст надорад</span><br>";
					echo "$id_quest $text_quest<br>";
					
					delete("_questions", "`id` = '$id_quest'");
				}
			}
		}
		
		exit;
	break;
	
	
	
	case "editquestion":
		$id = $_REQUEST['id'];
		$question = query("SELECT * FROM `questions` WHERE `id` = '$id'");
		
		$id_fan = $question[0]['id_fan'];
		$text = $question[0]['text'];
		$type = $question[0]['type'];
		
		
		$answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id' ORDER BY `id`");
		
		$page_info['title'] = "Таҳриркунии савол: ";//.getFan($id_fan).': '.$text;
		
	break;
	
	case "delete":
		$id = $_REQUEST['id'];
		
		if(delete("questions", "`id` = '$id'")){
			delete("answers", "`id_question` = '$id'");
		}
		redirect();
	break;
	
	case "correcttype3":
		// Ҳамаи саволҳои то санаи 24.12.2024 сабтшуда ислоҳ шудаанд. 
		$date = '2024-12-29 00:00:00';
		$answers = query("SELECT * FROM `answers` 
							WHERE `id_question` IN(
								SELECT `id` FROM `questions` 
									WHERE `type` = '3' AND 
									`date` >= '$date'
								) AND
							`position` = '2' AND 
							`right_answer` IS NOT NULL
						");
		foreach($answers as $answer){
			$id_answer = $answer['id'];
			$right_answer = $answer['right_answer'];
			$right_answer = explode("-", $right_answer);
			if($id_answer != $right_answer[1]){
				$l = $id_answer - 1;
				$r = $id_answer;
				$field['right_answer'] = "$l-$r";
				update("answers", $field, "`id` = '$id_answer'", 1);
			}
		}
		echo "Ҳамаи саволҳо дуруст шуданд";
		exit;
		
	break;
}


?>