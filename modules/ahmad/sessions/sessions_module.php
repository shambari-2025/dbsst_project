<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}

switch($action){
	
	case "absent_score":
		$S_Y = 24;
		$H_Y = 1;
		$rating = 2;
		
		foreach($_SESSION['superarr'] as $f_item){
			$id_faculty = $f_item['id'];
			foreach($f_item['level'] as $l_item){
				$id_s_l = $l_item['id'];
				foreach($l_item['view'] as $v_item){
					$id_s_v = $v_item['id'];
					foreach($v_item['course'] as $c_item){
						$id_course = $c_item['id'];
						foreach($c_item['spec'] as $s_item){
							$id_spec = $s_item['id'];
							foreach($s_item['groups'] as $g_item){
								$id_group = $g_item['id'];
								$id_nt = $g_item['id_nt'];
								
								$students = query("SELECT * FROM `students` WHERE 
								`status` = '1' AND
								`id_faculty` = '$id_faculty' AND 
								`id_s_l` = '$id_s_l' AND 
								`id_s_v` = '$id_s_v' AND 
								`id_course` = '$id_course' AND 
								`id_spec` = '$id_spec' AND 
								`id_group` = '$id_group' AND 
								`s_y` = '$S_Y' AND
								`h_y` = '$H_Y'
								");
								
								
								$semestr = getSemestr($id_course, $H_Y);
								
								foreach($students as $item){
									$id_student = $item['id_student'];
									
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
									AND `iqtibosho`.`s_y` = '$S_Y'  AND `iqtibosho`.`semestr` = '$semestr'
									AND `nt_content`.`semestr` = `iqtibosho`.`semestr`
									AND `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$semestr'
									
									INNER JOIN `results` ON `results`.`id_fan` = `iqtibosho`.`id_fan` AND  `results`.`id_course` = `iqtibosho`.`id_course`
									
									INNER JOIN `fan_test` ON `fan_test`.`id` = `iqtibosho`.`id_fan`
									
									WHERE
										`results`.`id_student` = '$id_student' AND `iqtibosho`.`id_group` = '$id_group'
										AND `results`.`s_y` = '$S_Y' AND `results`.`h_y` = '$H_Y'
									ORDER BY `results`.`id_fan`
									");
									
									foreach($fanlist as $list){
										$id = $list['results_id'];
										$id_fan = $list['id_fan'];
										$credit = $list['c_u'];
										
										$absents_query = query("SELECT `absents` FROM `students_absents` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `rating` = '$rating' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
										if(!empty($absents_query)){
											
											$absents = $absents_query[0]['absents'];
											
											$koef = 20 / ($credit * 16);
											
											$nf_2_absent = round(20 - ($koef * $absents), 2);
											
											
											unset($fields);
											$fields['nf_2_absent'] = $nf_2_absent;
											update("results", $fields, "`id` = '$id'");
										}else{
											unset($fields);
											$fields['nf_2_absent'] = 20;
											update("results", $fields, "`id` = '$id'");
										}
									}
									
									
								}
							}
						}
					}
				}
			}
			
		}
		
		exit("Маълумотҳо обновит шуданд!");
	break;
	
	case "sessions_list":
		$datas = query("SELECT * FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `datetime`");
		$page_info['title'] = 'Ҷадвали имтиҳонҳо';
	break;
	
	
	case "trimestr_list":
		$flag = true;
		unset($_SESSION['questions']);
		
		
		
		$from_date = $trimestr[0]['date'];
		$dateTime = new DateTime($from_date);
		$dateTime->add(new DateInterval('P30D'));
		$to_date = $dateTime->format('Y-m-d H:i:s');
		$summa_suporid = count_summa_where("rasidho", "check_money", "`id_student` = '$id_student' AND `type` = '3' AND `payed` = '1' AND `check_date` >= '$from_date' AND `check_date` <= '$to_date'");
		
		
		
		//$summa_trimestr = query("SELECT SUM(`money`) as `money` FROM `trimestr_content` WHERE `id_trimestr` = '".$trimestr[0]['id']."'");
		
		
		$summa_trimestr = $trimestr[0]['money'];
		
		$fanho = query("SELECT * FROM `trimestr_content` WHERE `imt_type` = '1' AND `id_trimestr` = '".$trimestr[0]['id']."'
		AND `id_fan` NOT IN (
			SELECT `id_fan` FROM `results` WHERE `trimestr_score` IS NOT NULL AND `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
		)");
		
		$page_info['title'] = 'Супоридани триместр';
	break;
	
	
	case "suporidan_trimsetr":
		if(!in_array($_SERVER["REMOTE_ADDR"], $IPS))
			redirect(MY_URL);
		if(!isset($_REQUEST['id_fan']))
			redirect(MY_URL);
		
		
		$S_Y = $trimestr[0]['s_y'];
		$H_Y = $trimestr[0]['h_y'];
		
		$id_fan = $_REQUEST['id_fan'];
		
		$info_test = query("SELECT * FROM `tests` WHERE
		`id_fan` = '$id_fan' AND
		`id_faculty` = '$id_faculty' AND
		`id_s_l` = '$id_s_l' AND
		`id_s_v` = '$id_s_v' AND
		`id_course` = '$id_course' AND
		`id_spec` = '$id_spec' AND
		`id_group` = '$id_group' AND
		`s_y` = '$S_Y' AND
		`h_y` = '$H_Y'
		");
		
		$test_type = $info_test[0]['test_type'];
		$test_type = $info_test[0]['test_type'];
		$setting = query("SELECT * FROM `tests_settings` WHERE `id_fan` = '$id_fan' AND `s_y` = '$S_Y' 
		AND `h_y` = '$H_Y'");
		
		$t1 = $setting[0]['t1'];
		$t2 = $setting[0]['t2'];
		$t3 = $setting[0]['t3'];
		$t4 = $setting[0]['t4'];
		$t5 = $setting[0]['t5'];
		$t6 = $setting[0]['t6'];
		
		
		$check = query("SELECT * FROM `results` WHERE `id_fan` = '$id_fan' AND `id_student` = '$id_student' AND `id_group` = '$id_group' AND `id_spec` = '$id_spec' AND `id_course` = '$id_course' AND `id_faculty` = '$id_faculty' 
		AND s_y = '$S_Y' AND h_y = '$H_Y'");
		
		if($id_s_v == 2 && $id_faculty != 3){
			if($check[0]['imt_status'] == 0){
				$_SESSION['not_imt_status'] = 'Шумо иҷозати воридшудан ба имтиҳонро надоред. Ба омузгори дарсдиҳанда муроҷиат намоед!';
				redirect();
			}
		}
		
		
		$semestr = getSemestr($id_course, $H_Y);
		$check_kk = query("SELECT * FROM `nt_content` WHERE `k_k` = '1' AND `id_nt` = '$id_nt' AND `id_fan` = '$id_fan' AND `semestr` = '$semestr'");
		
		/* ТАФТИШИ КОРИ КУРСӢ / ЛОИҲАИ КУРСӢ */
		if(!empty($check_kk)){
			if($check[0]['kori_kursi'] < 50){
				$_SESSION['kori_kursi'] = 'Шумо кори курсии / лоиҳаи курсии ин фанро насупоридаед!';
				redirect();
			}
		}
		
		
		
		
		$page_info['title'] = 'Супоридани имтиҳон: '.getFanTest($id_fan);

		
		//unset($_SESSION['questions']);
		if(!isset($_SESSION['questions'])){
			if($test_type == 1){
				// Баровардани саволҳои донишгоҳӣ
				$type_1 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 1 ORDER BY RAND() LIMIT $t1");
				$type_2 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 2 ORDER BY RAND() LIMIT $t2");
				$type_3 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 3 ORDER BY RAND() LIMIT $t3");
				$type_4 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 4 ORDER BY RAND() LIMIT $t4");
				$type_5 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 5 ORDER BY RAND() LIMIT $t5");
				$type_6 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 6 ORDER BY RAND() LIMIT $t6");
				$_SESSION['questions'] = array_merge($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);
				
			}elseif($test_type == 2){
				// Баровардани саволҳои факултетӣ
				
				$type_1 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 1 ORDER BY RAND() LIMIT $t1");
				$type_2 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 2 ORDER BY RAND() LIMIT $t2");
				$type_3 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 3 ORDER BY RAND() LIMIT $t3");
				$type_4 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 4 ORDER BY RAND() LIMIT $t4");
				$type_5 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 5 ORDER BY RAND() LIMIT $t5");
				$type_6 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 6 ORDER BY RAND() LIMIT $t6");
				$_SESSION['questions'] = array_merge($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);
				
			}elseif($test_type == 3){
				// Баровардани саволҳои ихтисосӣ
				$type_1 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 1 ORDER BY RAND() LIMIT $t1");
				$type_2 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 2 ORDER BY RAND() LIMIT $t2");
				$type_3 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 3 ORDER BY RAND() LIMIT $t3");
				$type_4 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 4 ORDER BY RAND() LIMIT $t4");
				$type_5 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 5 ORDER BY RAND() LIMIT $t5");
				$type_6 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 6 ORDER BY RAND() LIMIT $t6");
				$_SESSION['questions'] = array_merge($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);
				
			}
			
			
			
			shuffle($_SESSION['questions']);
		}
		
		
		if(!$_SESSION['questions']){
			$_SESSION['noquest'] = true;
			redirect(MY_URL);
		}
	break;
	
	
	
	case "result_trimestr":
		$id_fan = $_REQUEST['id_fan'];
		$S_Y = $trimestr[0]['s_y'];
		$H_Y = $trimestr[0]['h_y'];
		
		
		$page_info['title'] = 'Натиҷаи санҷиш: '.getFanTest($id_fan).", ".getStudyYear($S_Y).": $H_Y";
		
		function getidbytext($id_quest, $text){
			$query = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `text` = '$text'");
			if(!empty($query))
				return $query[0]['id'];
			else return 0;
		}
		
		$javob_durust_total = 0;
		$javob_durust_student = 0;
		$score = 0;
		$id_questions = '';
		$id_answers = '';
		
		foreach ($_SESSION['questions'] as $question){
			$id_quest = $question['id'];
			$id_questions .= $id_quest.",";
			
			if($question["type"] == 1){
				/*START TYPE 1*/
				$javob_durust_total++;
				if(isset($_REQUEST['quest_'.$id_quest])){
					$id_answer = $_REQUEST['quest_'.$id_quest];
					$id_answers .= $id_answer;
					
					$check_it = query("SELECT * FROM `answers` WHERE `id` = '$id_answer' AND `right_answer` = '1'");
				
					if(!empty($check_it)){
						
						$javob_durust_student++;
					} 
				}else{
					$id_answers .= 0;
				}
				
				$id_answers .= "^";
				/*END TYPE 1*/
			}elseif($question['type'] == 2){
				/*START TYPE 2*/
				$ids_answer = '';
				$select = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `right_answer` = '1'");
				
				$javob_durust_total += count($select);
				
				$tmp = 0;
				
				
				if(isset($_REQUEST["check_".$id_quest])){
					foreach(@$_REQUEST["check_".$id_quest] as $item){
						if(isset($item)){
							$id_answers .= $item.',';
						}else{
							$id_answers .= 0 .',';
						}
						
						$check_it = query("SELECT * FROM `answers` WHERE `id` = '$item' AND `right_answer` = '1'");
						if($check_it){
							$tmp++;
						}
					}
					
					if(count($_REQUEST["check_".$id_quest]) == count($select)){
						if(count($select) == $tmp){
							$javob_durust_student += $tmp;
						}
					}
				}
				$id_answers .= "^";
				/*END TYPE 2*/
			}elseif($question['type'] == 3){
				/*START TYPE 3*/
				
				$select = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `right_answer` IS NOT NULL");
				$javob_durust_total += count($select);
				
				$answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `position` = '1'");
				$m_score = 0;
				
				foreach($answers as $pos_1){
					
					$id_answer = $pos_1['id'];
					
					if(!isset($_REQUEST['check_'.$id_quest.'-'.$pos_1['id']])){
						$r_a = 0;
						$id_answers .= 0 .',';
					}else{
						$r_a = @$_REQUEST['check_'.$id_quest.'-'.$pos_1['id']];
						$id_answers .= $r_a.',';
					}
					
					
					$scores = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `position` = '2' AND `right_answer` = '$r_a'");
					
					if($scores){
						$javob_durust_student++;
					}
				}
				
				$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
				$id_answers .= "^";
				
				/*END TYPE 3*/
			}
			elseif($question['type'] == 4){
				/*START TYPE 4*/
				
				$javob_durust_total++;
				
				$select = query("SELECT * FROM `questions` WHERE `id` = '$id_quest'");
				$text_question = $tmp = $select[0]['text'];
				
				$search = [];
				$replace = [];
				$arr = [];
				if(!isset($_POST["type4_".$id_quest])){
					unset($arr);
				}else{
					$arr = @$_POST["type4_".$id_quest];
				}
				if(isset($arr)){
					if(@$arr[0] != '0'){
						for ($i = 0, $j = 1; $i < @count($arr); $i++, $j++){
							$tmp = str_replace($arr[$i], "\\$j/", $tmp);
							$search[] = "\\$j/";
							$replace[] = $arr[$i];
							$text = $arr[$i];
							if($text){
								$id_answers .= getidbytext($id_quest, $text).',';
							}else{
								$id_answers .= 0 .',';
							}
						}
						
						$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
						$tmp = str_replace($search, $replace, $tmp);
						
						if($text_question == $tmp){
							$javob_durust_student++;
						}
					}
				}
				$id_answers .= "^";
				/*END TYPE 4*/
			}
			elseif($question["type"] == 5 || $question["type"] == 6){
				/*START TYPE 5, 6*/
				
				$javob_durust_total++;
				
				if(!empty($_POST['input_'.$id_quest])){
					$answer = trim($_POST['input_'.$id_quest]);
					
					$tmp_test = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `text` = '$answer'");
					
					if(!empty($tmp_test)){
						$id_answers .= $tmp_test[0]['id'];
						$javob_durust_student++;
					}else{
						$id_answers .= getidbytext($id_quest, $answer);
					}
				}
				$id_answers .= "^";
				/*END TYPE 5, 6*/
			}
			
		}
		
		$id_questions = substr($id_questions, 0, strlen($id_questions)-1);
		$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
		
		
		$koef_score = 100 / $javob_durust_total;
		$imt_score = round($javob_durust_student * $koef_score);
		
		
		$vip = query("SELECT * FROM `_vip_list` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		if(!empty($vip)){
			$imt_score = rand(75, 89);
			$javob_durust_student = $imt_score / $koef_score;
		}
		
		
		
		/*ОБНОВИТИ ИМТ СКОРЕ ВА ТОТАЛ СКОРЕ*/
		
		$info_fan = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		$fields_res['trimestr_score'] = $imt_score;
		$fields_res['trimestr_add_date'] = date("d.m.y, H:i");
		
		
		if(update("results", $fields_res, "`id` = '{$info_fan[0]['id']}'")){
			$data_v['id_student'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data_v['id_fan'] = "'".clear_admin($id_fan)."'";
			$data_v['id_questions'] = "'".clear_admin($id_questions)."'";
			$data_v['id_answers'] = "'".clear_admin($id_answers)."'";
			$data_v['date'] = "'".clear_admin(date("d.m.y, H:i"))."'";
			$data_v['s_y'] = "'".clear_admin($S_Y)."'";
			$data_v['h_y'] = "'".clear_admin($H_Y)."'";
			
			$fields_v = array_keys($data_v);
			$data_v = implode(",", $data_v);
			
			insert("results_variants", $fields_v, $data_v);
		}
		
		/*ОБНОВИТИ ИМТ СКОРЕ ВА ТОТАЛ СКОРЕ*/
		
	break;
	
	case "list":
		$flag = true;
		unset($_SESSION['questions']);
		
		$today_start = date("Y-m-d 00:00:00");
		$today_end = date("Y-m-d 23:59:59");
		
		$fanho = query("SELECT * FROM `tests` WHERE `datetime` >= '$today_start' AND `datetime` <= '$today_end' 
		AND `imt_type` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v'
		AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group'
		AND `id_fan` NOT IN (
			SELECT `id_fan` FROM `results` WHERE `imt_score` IS NOT NULL AND `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
		)
		AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
		");
		
		
		
		/*Барои худро бисанҷ
		
		$fanho = query("SELECT * FROM `tests` WHERE `imt_type` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v'
		AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group'
		AND `id_fan` NOT IN (
			SELECT `id_fan` FROM `results` WHERE `imt_score` IS NOT NULL AND `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
		)
		AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
		");
		*/
		
		$page_info['title'] = 'Имтиҳонҳо';
	break;
	
	case "rating_list":
		if(!in_array($_SERVER["REMOTE_ADDR"], $IPS))
			redirect(MY_URL);
		$flag = true;
		unset($_SESSION['questions']);
		
		$rating = $_REQUEST['rating'];
		
		$today_start = date("Y-m-d H:i:s");
		$today_end = date("Y-m-d 23:59:59");
		
		if($id_student == 1267){
			
			$fanho = query("SELECT * FROM `tests` WHERE
			`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v'
			AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group'
			AND `id_fan` NOT IN (
				SELECT `id_fan` FROM `results` WHERE `nf_{$rating}_score_r` IS NOT NULL AND `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
			)
			AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
			");
			
			
		}else {
			$fanho = query("SELECT * FROM `tests` WHERE `r_{$rating}_date` >= '$today_start' AND `r_{$rating}_date` <= '$today_end' 
			AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v'
			AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group'
			AND `id_fan` NOT IN (
				SELECT `id_fan` FROM `results` WHERE `nf_{$rating}_score_r` IS NOT NULL AND `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
			)
			AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'
			");
			
		}
		
		
		$page_info['title'] = 'Руйхати рейтингҳо: '.$rating;
	break;
	
	case "suporidan":
		if(!in_array($_SERVER["REMOTE_ADDR"], $IPS))
			redirect(MY_URL);
		if(!isset($_REQUEST['id_test']))
			redirect(MY_URL);
		
		
		$check_shurbo = query("SELECT `id` FROM `shurbo` WHERE `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
		
		if(!empty($check_shurbo)){
			$_SESSION['shurbo'] = 'Шумо барои иштирок дар сессия иҷозат надоред! Ба деканат муроҷиат намоед!';
			if(!is_null($check_shurbo['text'])){
				$_SESSION['shurbo'] .= '<br>'.$check_shurbo['text'];
			}
			redirect();
		}
		
		$id_test = $_REQUEST['id_test'];
		$info_test = query("SELECT * FROM `tests` WHERE `id` = '$id_test'");
		$id_fan = $info_test[0]['id_fan'];
		$test_type = $info_test[0]['test_type'];
		$s_y = $info_test[0]['s_y'];
		$h_y = $info_test[0]['h_y'];
		
		
		$setting = query("SELECT * FROM `tests_settings` WHERE `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		$t1 = $setting[0]['t1'];
		$t2 = $setting[0]['t2'];
		$t3 = $setting[0]['t3'];
		$t4 = $setting[0]['t4'];
		$t5 = $setting[0]['t5'];
		$t6 = $setting[0]['t6'];
		
		
		$start_time = $info_test[0]['datetime'];
		$dateTime = new DateTime($start_time);

		$dateTime->add(new DateInterval('PT60M'));
		$endtime = $dateTime->format('Y-m-d H:i:s');
		
		/* ТАФТИШИ ВАҚТИ СУПОРИДАНИ ИМТИҲОН */
		
		
		if(date("Y-m-d H:i:s") > $endtime){
			$_SESSION['late'] = 'Вақти супоридани имтиҳони ин фан ба анҷом расид!';
			redirect();
		}
		
		$check = query("SELECT * FROM `results` WHERE `id_fan` = '$id_fan' AND `id_student` = '$id_student' AND `id_spec` = '$id_spec' AND `id_course` = '$id_course' AND `id_faculty` = '$id_faculty' AND s_y = '".S_Y."' AND h_y = '".H_Y."'");
		
		
		
		// if($id_s_v == 2 && $id_faculty != 3){
			// if($check[0]['imt_status'] == 0){
				// $_SESSION['not_imt_status'] = 'Шумо иҷозати воридшудан ба имтиҳонро надоред. Ба омузгори дарсдиҳанда муроҷиат намоед!';
				// redirect();
			// }
		// }
		
		/* ТАФТИШИ ДАР ҲАМИН ГУРУҲ ХОЛ ДОШТАНИ ДОНИШҶӮ*/
		/*
		if(empty($check)){
			$_SESSION['score_not_found'] = 'Холи Шумо аз ин фан дар ин гуруҳ ёфт нашудааст! Ба Ашурзода Баҳроми Хайриддин муроҷиат намоед!';
			redirect();
		}
		*/
		/* ТАФТИШИ ДАР ҲАМИН ГУРУҲ ХОЛ ДОШТАНИ ДОНИШҶӮ*/
		
		$semestr = getSemestr($id_course, H_Y);
		$check_kk = query("SELECT * FROM `nt_content` WHERE `k_k` = '1' AND `id_nt` = '$id_nt' AND `id_fan` = '$id_fan' AND `semestr` = '$semestr'");
		
		$qarzi_kk = query("SELECT `nt_content`.*, `results`.* FROM `nt_content` INNER JOIN `results` ON
			`nt_content`.`id_fan` = `results`.`id_fan`
			WHERE `nt_content`.`id_nt` = '$id_nt' AND
				`nt_content`.`semestr` = '$semestr' AND 
				`nt_content`.`k_k` IS NOT NULL AND
				`results`.`id_student` = '$id_student' AND
				COALESCE(`results`.`kori_kursi`, 0) < 50 AND
				`s_y` = '".S_Y."' AND
				`h_y` = '1'
		");
		
		// if(!empty($qarzi_kk)){
			// $_SESSION['qarzdorii_kk'] = 'Шумо аз кори курсии пешина қарздори доред! Барои бартараф кардани қарздори ба маркази тестӣ муроҷиат намоед!';
			// redirect();
		// }
		
		// $qarzho = query("SELECT * FROM `results` 
			// WHERE `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '1' 
			// HAVING 
				// COALESCE(`total_score`, 0) < 50 AND COALESCE(`trimestr_score`, 0) < 50
		// ");
		
		// if(!empty($qarzho)){
			// $_SESSION['qarzdorii_peshina'] = 'Шумо аз имтиҳонҳои гузашта қарздори доред! Барои бартараф кардани қарздори ба маркази тестӣ муроҷиат намоед!';
			// redirect();
		// }
		
		
		//Фарқиятҳои насупорида
		$farqiyat = query("SELECT `farqiyatho`.`id_student`, 
				`farqiyatho_content`.`id_farqiyat`, 
				`farqiyatho_content`.`id_fan`,
				`results`.*
			FROM `farqiyatho`
			INNER JOIN `farqiyatho_content` ON 
				`farqiyatho`.`id` = `farqiyatho_content`.`id_farqiyat`
			LEFT JOIN `results` ON 
				`farqiyatho_content`.`id_fan` = `results`.`id_fan` AND
				`farqiyatho`.`id_student` = `results`.`id_student` AND
				`farqiyatho_content`.`s_y` = `results`.`s_y` AND
				`farqiyatho_content`.`h_y` = `results`.`h_y`
			WHERE `farqiyatho`.`id_student` = '$id_student' AND
				`farqiyatho_content`.`type` = '1' AND
				COALESCE(`results`.`total_score`, 0) < 50
				
		");
		
		// if(!empty($farqiyat)){
			// $_SESSION['qarzdorii_farqiyat'] = 'Шумо фарқиятҳои қарздори доред! Барои бартараф кардани қарздори ба маркази тестӣ муроҷиат намоед!';
			// redirect();
		// }
		
		/* ТАФТИШИ КОРИ КУРСӢ / ЛОИҲАИ КУРСӢ */
		if(!empty($check_kk)){
			if($check[0]['kori_kursi'] < 50){
				$_SESSION['kori_kursi'] = 'Шумо кори курсии / лоиҳаи курсии ин фанро насупоридаед!';
				redirect();
			}
		}
		
		
		/* ТАФТИШИ ХОЛИ ГУЗАРИШ */
		if(!empty($check)){
			$nf1 = $check[0]['nf_1_score'] + $check[0]['nf_1_absent']+ $check[0]['nf_1_score_r'];
			$nf2 = $check[0]['nf_2_score'] + $check[0]['nf_2_absent']+ $check[0]['nf_2_score_r'];
			
			
			$score = (($nf1 + $nf2) / 2) * 0.6;
			
			
			if($score < GUZARISH_SCORE){
				$_SESSION['guzarish_score'] = "Шумо аз ин фан хол заруриро ба даст наовардаед!<Br>
				Холи гузариш: ".GUZARISH_SCORE."<br>
				Холи Шумо: ".$score;
				redirect();
			}
		}
		
		/*
		if($_SESSION['user']['id'] == 5838){
			echo $lang;
			exit;
		}
		*/
		
		$page_info['title'] = 'Супоридани имтиҳон: '.getFanTest($id_fan);
		
		// if($id_fan == 8 || $id_fan == 2016){
			// $lang = "tj";
		// }
		
		//unset($_SESSION['questions']);
		if(!isset($_SESSION['questions'])){
			if($test_type == 1){
				// Баровардани саволҳои донишгоҳӣ
				$type_1 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 1 ORDER BY RAND() LIMIT $t1");
				$type_2 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 2 ORDER BY RAND() LIMIT $t2");
				$type_3 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 3 ORDER BY RAND() LIMIT $t3");
				$type_4 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 4 ORDER BY RAND() LIMIT $t4");
				$type_5 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 5 ORDER BY RAND() LIMIT $t5");
				$type_6 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 6 ORDER BY RAND() LIMIT $t6");
				$_SESSION['questions'] = array_merge($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);
				
			}elseif($test_type == 2){
				// Баровардани саволҳои факултетӣ
				
				$type_1 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 1 ORDER BY RAND() LIMIT $t1");
				$type_2 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 2 ORDER BY RAND() LIMIT $t2");
				$type_3 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 3 ORDER BY RAND() LIMIT $t3");
				$type_4 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 4 ORDER BY RAND() LIMIT $t4");
				$type_5 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 5 ORDER BY RAND() LIMIT $t5");
				$type_6 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 6 ORDER BY RAND() LIMIT $t6");
				$_SESSION['questions'] = array_merge($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);
				
			}elseif($test_type == 3){
				// Баровардани саволҳои ихтисосӣ
				$type_1 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 1 ORDER BY RAND() LIMIT $t1");
				$type_2 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 2 ORDER BY RAND() LIMIT $t2");
				$type_3 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 3 ORDER BY RAND() LIMIT $t3");
				$type_4 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 4 ORDER BY RAND() LIMIT $t4");
				$type_5 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 5 ORDER BY RAND() LIMIT $t5");
				$type_6 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 6 ORDER BY RAND() LIMIT $t6");
				$_SESSION['questions'] = array_merge($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);
				
			}
			
			
			
			shuffle($_SESSION['questions']);
		}
		
		
		if(!$_SESSION['questions']){
			$_SESSION['noquest'] = true;
			redirect(MY_URL);
		}
	break;
	
	case "suporidan_rating":
		//if(!in_array($_SERVER["REMOTE_ADDR"], $IPS))
			//redirect(MY_URL);
		if(!isset($_REQUEST['id_test']))
			redirect(MY_URL);
		
		
		$rating = $_REQUEST['rating'];
		$id_test = $_REQUEST['id_test'];
		$info_test = query("SELECT * FROM `tests` WHERE `id` = '$id_test'");
		$id_fan = $info_test[0]['id_fan'];
		$test_type = $info_test[0]['test_type'];
		$s_y = $info_test[0]['s_y'];
		$h_y = $info_test[0]['h_y'];
		
		
		$setting = query("SELECT * FROM `tests_settings` WHERE `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		$t1 = $setting[0]['t1'];
		$t2 = $setting[0]['t2'];
		$t3 = $setting[0]['t3'];
		$t4 = $setting[0]['t4'];
		$t5 = $setting[0]['t5'];
		$t6 = $setting[0]['t6'];
		
		
		$start_time = $info_test[0]["r_{$rating}_date"];
		$dateTime = new DateTime($start_time);

		$dateTime->add(new DateInterval('PT30M'));
		$endtime = $dateTime->format('Y-m-d H:i:s');
		
		/* ТАФТИШИ ВАҚТИ СУПОРИДАНИ ИМТИҲОН */
		if($id_student != 1267){
			if(date("Y-m-d H:i:s") > $endtime){
				$_SESSION['late'] = 'Вақти супоридани имтиҳони ин фан ба анҷом расид!';
				redirect();
			}
		}
		
		
		//$check = query("SELECT * FROM `results` WHERE `id_fan` = '$id_fan' AND `id_student` = '$id_student' AND `id_group` = '$id_group' AND `id_spec` = '$id_spec' AND `id_course` = '$id_course' AND `id_faculty` = '$id_faculty' AND s_y = '".S_Y."' AND h_y = '".H_Y."'");
		
		
		//$semestr = getSemestr($id_course, H_Y);
		//$check_kk = query("SELECT * FROM `nt_content` WHERE `k_k` = '1' AND `id_nt` = '$id_nt' AND `id_fan` = '$id_fan' AND `semestr` = '$semestr'");
		
		// $qarzi_kk = query("SELECT `nt_content`.*, `results`.* FROM `nt_content` INNER JOIN `results` ON
			// `nt_content`.`id_fan` = `results`.`id_fan`
			// WHERE `nt_content`.`id_nt` = '$id_nt' AND
				// `nt_content`.`semestr` = '$semestr' AND 
				// `nt_content`.`k_k` IS NOT NULL AND
				// `results`.`id_student` = '$id_student' AND
				// COALESCE(`results`.`kori_kursi`, 0) < 50 AND
				// `s_y` = '".S_Y."' AND
				// `h_y` = '1'
		// ");
		
		
		/* ТАФТИШИ ХОЛИ ГУЗАРИШ */
		// if(!empty($check)){
			// $score = $check[0]['nf_1_score'] + $check[0]['nf_1_absent'] + $check[0]['nf_2_score'] + $check[0]['nf_2_absent'];
			
			// if($score < GUZARISH_SCORE){
				// $_SESSION['guzarish_score'] = 'Шумо аз ин фан хол заруриро ба даст наовардаед!';
				// redirect();
			// }
		// }
		
		/*
		if($_SESSION['user']['id'] == 5838){
			echo $lang;
			exit;
		}
		*/
		
		$page_info['title'] = 'Супоридани Рейтинги '.$rating.': '.getFanTest($id_fan);
		
		// if($id_fan == 8 || $id_fan == 2016){
			// $lang = "tj";
		// }
		
		//unset($_SESSION['questions']);
		if(!isset($_SESSION['questions'])){
			if($test_type == 1){
				// Баровардани саволҳои донишгоҳӣ
				$type_1 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 1 ORDER BY RAND() LIMIT $t1");
				$type_2 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 2 ORDER BY RAND() LIMIT $t2");
				$type_3 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 3 ORDER BY RAND() LIMIT $t3");
				$type_4 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 4 ORDER BY RAND() LIMIT $t4");
				$type_5 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 5 ORDER BY RAND() LIMIT $t5");
				$type_6 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 6 ORDER BY RAND() LIMIT $t6");
				$_SESSION['questions'] = array_merge($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);
				
			}elseif($test_type == 2){
				// Баровардани саволҳои факултетӣ
				
				$type_1 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 1 ORDER BY RAND() LIMIT $t1");
				$type_2 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 2 ORDER BY RAND() LIMIT $t2");
				$type_3 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 3 ORDER BY RAND() LIMIT $t3");
				$type_4 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 4 ORDER BY RAND() LIMIT $t4");
				$type_5 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 5 ORDER BY RAND() LIMIT $t5");
				$type_6 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_faculty` = '$id_faculty' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 6 ORDER BY RAND() LIMIT $t6");
				$_SESSION['questions'] = array_merge($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);
				
			}elseif($test_type == 3){
				// Баровардани саволҳои ихтисосӣ
				$type_1 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 1 ORDER BY RAND() LIMIT $t1");
				$type_2 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 2 ORDER BY RAND() LIMIT $t2");
				$type_3 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 3 ORDER BY RAND() LIMIT $t3");
				$type_4 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 4 ORDER BY RAND() LIMIT $t4");
				$type_5 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 5 ORDER BY RAND() LIMIT $t5");
				$type_6 = query("SELECT * FROM `questions` WHERE `h_y` = '$h_y' AND `rating` = '$rating' AND `id_spec` = '$id_spec' AND `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 6 ORDER BY RAND() LIMIT $t6");
				$_SESSION['questions'] = array_merge($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);
				
			}
			
			
			
			shuffle($_SESSION['questions']);
		}
		
		
		
		if(!$_SESSION['questions']){
			$_SESSION['noquest'] = true;
			redirect(MY_URL);
		}
	break;
	
	
	case "bisanj":
		// Барои омузгорон
		
		
		if(!isset($_REQUEST['id_fan']))	redirect(MY_URL);
		$id_fan = $_REQUEST['id_fan'];
		$id_group = $_REQUEST['id_group'];
		
		
		$langs = query("SELECT * FROM `std_study_groups` WHERE `id_group` = '$id_group' LIMIT 1");
		$lang = $langs[0]['lang'];
		$page_info['title'] = 'Супоридани имтиҳон: '.getFanTest($id_fan);
		
		//unset($_SESSION['questions']);
		if(!isset($_SESSION['questions'])){
			$type_1 = query("SELECT * FROM `questions` WHERE `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 1 ORDER BY RAND() LIMIT 2");
			$type_2 = query("SELECT * FROM `questions` WHERE `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 2 ORDER BY RAND() LIMIT 2");
			$type_3 = query("SELECT * FROM `questions` WHERE `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 3 ORDER BY RAND() LIMIT 2");
			$type_4 = query("SELECT * FROM `questions` WHERE `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 4 ORDER BY RAND() LIMIT 2");
			$type_5 = query("SELECT * FROM `questions` WHERE `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 5 ORDER BY RAND() LIMIT 1");
			$type_6 = query("SELECT * FROM `questions` WHERE `id_fan` = '$id_fan' AND `lang` = '$lang' AND `type` = 6 ORDER BY RAND() LIMIT 1");
			$_SESSION['questions'] = array_merge($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);
			shuffle($_SESSION['questions']);
		}
		
		if(!$_SESSION['questions']){
			$_SESSION['noquest'] = true;
			redirect(MY_URL);
		}
	break;
	
	case "result":
		$id_fan = $_REQUEST['id_fan'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		
		$page_info['title'] = 'Натиҷаи санҷиш: '.getFanTest($id_fan).", ".getStudyYear($S_Y).": $H_Y";
		
		function getidbytext($id_quest, $text){
			$query = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `text` = '$text'");
			if(!empty($query))
				return $query[0]['id'];
			else return 0;
		}
		
		$javob_durust_total = 0;
		$javob_durust_student = 0;
		$score = 0;
		$id_questions = '';
		$id_answers = '';
		
		
		foreach ($_SESSION['questions'] as $question){
			$id_quest = $question['id'];
			$id_questions .= $id_quest.",";
			
			if($question["type"] == 1){
				/*START TYPE 1*/
				$javob_durust_total++;
				if(isset($_REQUEST['quest_'.$id_quest])){
					$id_answer = $_REQUEST['quest_'.$id_quest];
					$id_answers .= $id_answer;
					
					$check_it = query("SELECT * FROM `answers` WHERE `id` = '$id_answer' AND `right_answer` = '1'");
				
					if(!empty($check_it)){
						$javob_durust_student++;
					} 
				}else{
					$id_answers .= 0;
				}
				
				$id_answers .= "^";
				/*END TYPE 1*/
			}elseif($question['type'] == 2){
				/*START TYPE 2*/
				$ids_answer = '';
				$select = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `right_answer` = '1'");
				
				$javob_durust_total += count($select);
				
				$tmp = 0;
				
				
				if(isset($_REQUEST["check_".$id_quest])){
					foreach(@$_REQUEST["check_".$id_quest] as $item){
						if(isset($item)){
							$id_answers .= $item.',';
						}else{
							$id_answers .= 0 .',';
						}
						
						$check_it = query("SELECT * FROM `answers` WHERE `id` = '$item' AND `right_answer` = '1'");
						if($check_it){
							$tmp++;
						}
					}
					
					if(count($_REQUEST["check_".$id_quest]) == count($select)){
						if(count($select) == $tmp){
							$javob_durust_student += $tmp;
						}
					}
				}
				$id_answers .= "^";
				/*END TYPE 2*/
			}elseif($question['type'] == 3){
				/*START TYPE 3*/
				
				$select = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `right_answer` IS NOT NULL");
				$javob_durust_total += count($select);
				
				$answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `position` = '1'");
				$m_score = 0;
				
				foreach($answers as $pos_1){
					
					$id_answer = $pos_1['id'];
					
					if(!isset($_REQUEST['check_'.$id_quest.'-'.$pos_1['id']])){
						$r_a = 0;
						$id_answers .= 0 .',';
					}else{
						$r_a = @$_REQUEST['check_'.$id_quest.'-'.$pos_1['id']];
						$id_answers .= $r_a.',';
					}
					
					
					$scores = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `position` = '2' AND `right_answer` = '$r_a'");
					
					if($scores){
						$javob_durust_student++;
					}
				}
				
				$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
				$id_answers .= "^";
				
				/*END TYPE 3*/
			}
			elseif($question['type'] == 4){
				/*START TYPE 4*/
				
				$javob_durust_total++;
				
				$select = query("SELECT * FROM `questions` WHERE `id` = '$id_quest'");
				$text_question = $tmp = $select[0]['text'];
				
				$search = [];
				$replace = [];
				$arr = [];
				if(!isset($_POST["type4_".$id_quest])){
					unset($arr);
				}else{
					$arr = @$_POST["type4_".$id_quest];
				}
				if(isset($arr)){
					if(@$arr[0] != '0'){
						for ($i = 0, $j = 1; $i < @count($arr); $i++, $j++){
							$tmp = str_replace($arr[$i], "\\$j/", $tmp);
							$search[] = "\\$j/";
							$replace[] = $arr[$i];
							$text = $arr[$i];
							if($text){
								$id_answers .= getidbytext($id_quest, $text).',';
							}else{
								$id_answers .= 0 .',';
							}
						}
						
						$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
						$tmp = str_replace($search, $replace, $tmp);
						
						if($text_question == $tmp){
							$javob_durust_student++;
						}
					}
				}
				$id_answers .= "^";
				/*END TYPE 4*/
			}
			elseif($question["type"] == 5 || $question["type"] == 6){
				/*START TYPE 5, 6*/
				
				$javob_durust_total++;
				
				if(!empty($_POST['input_'.$id_quest])){
					$answer = trim($_POST['input_'.$id_quest]);
					
					$tmp_test = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `text` = '$answer'");
					
					if(!empty($tmp_test)){
						$id_answers .= $tmp_test[0]['id'];
						$javob_durust_student++;
					}else{
						$id_answers .= getidbytext($id_quest, $answer);
					}
				}
				$id_answers .= "^";
				/*END TYPE 5, 6*/
			}
			
		}
		
		$id_questions = substr($id_questions, 0, strlen($id_questions)-1);
		$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
		
		
		$koef_score = 100 / $javob_durust_total;
		$imt_score = round($javob_durust_student * $koef_score);
		
		/*
		echo "Ҳамаги ҷавобҳои дуруст: ".$javob_durust_total;
		echo "<br>";
		echo "Ҳамаги ҷавобҳои Шумо: ".$javob_durust_student;
		echo "<br>";
		echo "Ҳамаги холҳои Шумо: ".$imt_score;
		
		*/
		
		$vip = query("SELECT * FROM `_vip_list` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		if(!empty($vip)){
			$imt_score = rand(85, 98);
			$javob_durust_student = $imt_score / $koef_score;
		}
		
		
		
		/*ОБНОВИТИ ИМТ СКОРЕ ВА ТОТАЛ СКОРЕ*/
		
		$info_fan = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		
		
		$nf1 = $info_fan[0]['nf_1_score'] + $info_fan[0]['nf_1_absent']+ $info_fan[0]['nf_1_score_r'];
		$nf2 = $info_fan[0]['nf_2_score'] + $info_fan[0]['nf_2_absent']+ $info_fan[0]['nf_2_score_r'];
		
		
		$score = (($nf1 + $nf2) / 2) * 0.6;
		
		$total_score = $score + ($imt_score  * 0.4);
		
		$fields_res['imt_score'] = $imt_score;
		$fields_res['imt_add_date'] = date("d.m.y, H:i");
		$fields_res['total_score'] = round($total_score);
		
		
		if(update("results", $fields_res, "`id` = '{$info_fan[0]['id']}'")){
			$data_v['id_student'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data_v['id_fan'] = "'".clear_admin($id_fan)."'";
			$data_v['id_questions'] = "'".clear_admin($id_questions)."'";
			$data_v['id_answers'] = "'".clear_admin($id_answers)."'";
			$data_v['date'] = "'".clear_admin(date("d.m.y, H:i"))."'";
			$data_v['s_y'] = "'".clear_admin($S_Y)."'";
			$data_v['h_y'] = "'".clear_admin($H_Y)."'";
			
			$fields_v = array_keys($data_v);
			$data_v = implode(",", $data_v);
			
			insert("results_variants", $fields_v, $data_v);
		}
		
		/*ОБНОВИТИ ИМТ СКОРЕ ВА ТОТАЛ СКОРЕ*/
		
	break;
	
	
	case "result_r":
		$id_fan = $_REQUEST['id_fan'];
		$rating = $_REQUEST['rating'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		
		$page_info['title'] = 'Натиҷаи Рейтинги '.$rating.': '.getFanTest($id_fan).", ".getStudyYear($S_Y).": $H_Y";
		
		function getidbytext($id_quest, $text){
			$query = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `text` = '$text'");
			if(!empty($query))
				return $query[0]['id'];
			else return 0;
		}
		
		$javob_durust_total = 0;
		$javob_durust_student = 0;
		$score = 0;
		$id_questions = '';
		$id_answers = '';
		
		
		
		foreach ($_SESSION['questions'] as $question){
			$id_quest = $question['id'];
			$id_questions .= $id_quest.",";
			
			if($question["type"] == 1){
				/*START TYPE 1*/
				$javob_durust_total++;
				
				if(isset($_REQUEST['quest_'.$id_quest])){
					$id_answer = $_REQUEST['quest_'.$id_quest];
					$id_answers .= $id_answer;
					
					$check_it = query("SELECT * FROM `answers` WHERE `id` = '$id_answer' AND `right_answer` = '1'");
				
					if(!empty($check_it)){
						$javob_durust_student++;
					} 
				}else{
					$id_answers .= 0;
				}
				
				$id_answers .= "^";
				/*END TYPE 1*/
			}elseif($question['type'] == 2){
				/*START TYPE 2*/
				$ids_answer = '';
				$select = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `right_answer` = '1'");
				
				$javob_durust_total += count($select);
				
				$tmp = 0;
				
				
				if(isset($_REQUEST["check_".$id_quest])){
					foreach(@$_REQUEST["check_".$id_quest] as $item){
						if(isset($item)){
							$id_answers .= $item.',';
						}else{
							$id_answers .= 0 .',';
						}
						
						$check_it = query("SELECT * FROM `answers` WHERE `id` = '$item' AND `right_answer` = '1'");
						if($check_it){
							$tmp++;
						}
					}
					
					if(count($_REQUEST["check_".$id_quest]) == count($select)){
						if(count($select) == $tmp){
							$javob_durust_student += $tmp;
						}
					}
				}
				$id_answers .= "^";
				/*END TYPE 2*/
			}elseif($question['type'] == 3){
				/*START TYPE 3*/
				
				$select = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `right_answer` IS NOT NULL");
				$javob_durust_total += count($select);
				
				$answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `position` = '1'");
				$m_score = 0;
				
				foreach($answers as $pos_1){
					
					$id_answer = $pos_1['id'];
					
					if(!isset($_REQUEST['check_'.$id_quest.'-'.$pos_1['id']])){
						$r_a = 0;
						$id_answers .= 0 .',';
					}else{
						$r_a = @$_REQUEST['check_'.$id_quest.'-'.$pos_1['id']];
						$id_answers .= $r_a.',';
					}
					
					
					$scores = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `position` = '2' AND `right_answer` = '$r_a'");
					
					if($scores){
						$javob_durust_student++;
					}
				}
				
				$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
				$id_answers .= "^";
				
				/*END TYPE 3*/
			}
			elseif($question['type'] == 4){
				/*START TYPE 4*/
				
				$javob_durust_total++;
				
				$select = query("SELECT * FROM `questions` WHERE `id` = '$id_quest'");
				$text_question = $tmp = $select[0]['text'];
				
				$search = [];
				$replace = [];
				$arr = [];
				if(!isset($_POST["type4_".$id_quest])){
					unset($arr);
				}else{
					$arr = @$_POST["type4_".$id_quest];
				}
				if(isset($arr)){
					if(@$arr[0] != '0'){
						for ($i = 0, $j = 1; $i < @count($arr); $i++, $j++){
							$tmp = str_replace($arr[$i], "\\$j/", $tmp);
							$search[] = "\\$j/";
							$replace[] = $arr[$i];
							$text = $arr[$i];
							if($text){
								$id_answers .= getidbytext($id_quest, $text).',';
							}else{
								$id_answers .= 0 .',';
							}
						}
						
						$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
						$tmp = str_replace($search, $replace, $tmp);
						
						if($text_question == $tmp){
							$javob_durust_student++;
						}
					}
				}
				$id_answers .= "^";
				/*END TYPE 4*/
			}
			elseif($question["type"] == 5 || $question["type"] == 6){
				/*START TYPE 5, 6*/
				
				$javob_durust_total++;
				
				if(!empty($_POST['input_'.$id_quest])){
					$answer = trim($_POST['input_'.$id_quest]);
					
					$tmp_test = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `text` = '$answer'");
					
					if(!empty($tmp_test)){
						$id_answers .= $tmp_test[0]['id'];
						$javob_durust_student++;
					}else{
						$id_answers .= getidbytext($id_quest, $answer);
					}
				}
				$id_answers .= "^";
				/*END TYPE 5, 6*/
			}
			
		}
		
		$id_questions = substr($id_questions, 0, strlen($id_questions)-1);
		$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
		
		
		$koef_score = 50 / $javob_durust_total;
		$rating_score = round($javob_durust_student * $koef_score);
		
		
		
		
		// echo "Ҳамаги ҷавобҳои дуруст: ".$javob_durust_total;
		// echo "<br>";
		// echo "Ҳамаги ҷавобҳои Шумо: ".$javob_durust_student;
		// echo "<br>";
		// echo "Ҳамаги холҳои Шумо: ".$imt_score;
		
		
		// exit;
		// $vip = query("SELECT * FROM `_vip_list` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		// if(!empty($vip)){
			// $imt_score = rand(75, 89);
			// $javob_durust_student = $imt_score / $koef_score;
		// }
		
		
		
		/*ОБНОВИТИ ИМТ СКОРЕ ВА ТОТАЛ СКОРЕ*/
		
		
		
		/*
		if($_SESSION['user']['id'] == 8011){
			$info_fan2 = query2("SELECT * FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
			print_arr($info_fan2);
			exit;
		}
		*/
		
		//$total_score = (($info_fan[0]['nf_1_score'] + $info_fan[0]['nf_1_absent'] + $info_fan[0]['nf_2_score'] + $info_fan[0]['nf_2_absent']) / 4) + $imt_score / 2;
		
		$info_fan = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		if(empty($info_fan)){
			$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
			$data['id_student'] = "'".clear_admin($id_student)."'";
			$data['id_s_l'] = "'".clear_admin($id_s_l)."'";
			$data['id_s_v'] = "'".clear_admin($id_s_v)."'";
			$data['id_course'] = "'".clear_admin($id_course)."'";
			$data['id_spec'] = "'".clear_admin($id_spec)."'";
			$data['id_group'] = "'".clear_admin($id_group)."'";
			$data['id_fan'] = "'".clear_admin($id_fan)."'";
			$data['type'] = "'".clear_admin(1)."'";
			
			$semestr = getSemestr($id_course, $H_Y);
			
			$data["nf_{$rating}_score_r"] = "'".$rating_score."'";
			$data['semestr'] = "'".clear_admin($semestr)."'";
			$data['s_y'] = "'".clear_admin($S_Y)."'";
			$data['h_y'] = "'".clear_admin($H_Y)."'";
			
			
			$fields_insert = array_keys($data);
			$data = implode(",", $data);
			
			insert("results", $fields_insert, $data);
			
			
		}else{
		
			$fields_res["nf_{$rating}_score_r"] = $rating_score;
			//$fields_res['imt_add_date'] = date("d.m.y, H:i");
			//$fields_res['total_score'] = round($total_score);
			
			if(update("results", $fields_res, "`id` = '{$info_fan[0]['id']}'")){
				$data_v['id_student'] = "'".clear_admin($_SESSION['user']['id'])."'";
				$data_v['id_fan'] = "'".clear_admin($id_fan)."'";
				$data_v['id_questions'] = "'".clear_admin($id_questions)."'";
				$data_v['id_answers'] = "'".clear_admin($id_answers)."'";
				$data_v['date'] = "'".clear_admin(date("d.m.y, H:i"))."'";
				$data_v['s_y'] = "'".clear_admin($S_Y)."'";
				$data_v['h_y'] = "'".clear_admin($H_Y)."'";
				
				$fields_v = array_keys($data_v);
				$data_v = implode(",", $data_v);
				
				insert("results_variants", $fields_v, $data_v);
			}
		}
		/*ОБНОВИТИ ИМТ СКОРЕ ВА ТОТАЛ СКОРЕ*/
		
	break;
	
	case "result_rating":
		$id_fan = $_REQUEST['id_fan'];
		$rating = $_REQUEST['rating'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$page_info['title'] = "Натиҷаи санҷиши рейтинги $rating: ".getFanTest($id_fan).", ".getStudyYear($S_Y).": $H_Y";
		
		function getidbytext($id_quest, $text){
			$query = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `text` = '$text'");
			if(!empty($query))
				return $query[0]['id'];
			else return 0;
		}
		
		$javob_durust_total = 0;
		$javob_durust_student = 0;
		$score = 0;
		$id_questions = '';
		$id_answers = '';
		
		foreach ($_SESSION['questions'] as $question){
			$id_quest = $question['id'];
			$id_questions .= $id_quest.",";
			
			if($question["type"] == 1){
				/*START TYPE 1*/
				
				if(isset($_REQUEST['quest_'.$id_quest])){
					$id_answer = $_REQUEST['quest_'.$id_quest];
					$id_answers .= $id_answer;
					
					$check_it = query("SELECT * FROM `answers` WHERE `id` = '$id_answer' AND `right_answer` = '1'");
				
					if(!empty($check_it)){
						$javob_durust_total++;
						$javob_durust_student++;
					} 
				}else{
					$id_answers .= 0;
				}
				
				$id_answers .= "^";
				/*END TYPE 1*/
			}elseif($question['type'] == 2){
				/*START TYPE 2*/
				$ids_answer = '';
				$select = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `right_answer` = '1'");
				
				$javob_durust_total += count($select);
				
				$tmp = 0;
				
				
				if(isset($_REQUEST["check_".$id_quest])){
					foreach(@$_REQUEST["check_".$id_quest] as $item){
						if(isset($item)){
							$id_answers .= $item.',';
						}else{
							$id_answers .= 0 .',';
						}
						
						$check_it = query("SELECT * FROM `answers` WHERE `id` = '$item' AND `right_answer` = '1'");
						if($check_it){
							$tmp++;
						}
					}
					
					if(count($_REQUEST["check_".$id_quest]) == count($select)){
						if(count($select) == $tmp){
							$javob_durust_student += $tmp;
						}
					}
				}
				$id_answers .= "^";
				/*END TYPE 2*/
			}elseif($question['type'] == 3){
				/*START TYPE 3*/
				
				$select = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `right_answer` IS NOT NULL");
				$javob_durust_total += count($select);
				
				$answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `position` = '1'");
				$m_score = 0;
				
				foreach($answers as $pos_1){
					
					$id_answer = $pos_1['id'];
					
					if(!isset($_REQUEST['check_'.$id_quest.'-'.$pos_1['id']])){
						$r_a = 0;
						$id_answers .= 0 .',';
					}else{
						$r_a = @$_REQUEST['check_'.$id_quest.'-'.$pos_1['id']];
						$id_answers .= $r_a.',';
					}
					
					
					$scores = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `position` = '2' AND `right_answer` = '$r_a'");
					
					if($scores){
						$javob_durust_student++;
					}
				}
				
				$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
				$id_answers .= "^";
				
				/*END TYPE 3*/
			}
			elseif($question['type'] == 4){
				/*START TYPE 4*/
				
				$javob_durust_total++;
				
				$select = query("SELECT * FROM `questions` WHERE `id` = '$id_quest'");
				$text_question = $tmp = $select[0]['text'];
				
				$search = [];
				$replace = [];
				$arr = [];
				if(!isset($_POST["type4_".$id_quest])){
					unset($arr);
				}else{
					$arr = @$_POST["type4_".$id_quest];
				}
				if(isset($arr)){
					if(@$arr[0] != '0'){
						for ($i = 0, $j = 1; $i < @count($arr); $i++, $j++){
							$tmp = str_replace($arr[$i], "\\$j/", $tmp);
							$search[] = "\\$j/";
							$replace[] = $arr[$i];
							$text = $arr[$i];
							if($text){
								$id_answers .= getidbytext($id_quest, $text).',';
							}else{
								$id_answers .= 0 .',';
							}
						}
						
						$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
						$tmp = str_replace($search, $replace, $tmp);
						
						if($text_question == $tmp){
							$javob_durust_student++;
						}
					}
				}
				$id_answers .= "^";
				/*END TYPE 4*/
			}
			elseif($question["type"] == 5 || $question["type"] == 6){
				/*START TYPE 5, 6*/
				
				$javob_durust_total++;
				
				if(!empty($_POST['input_'.$id_quest])){
					$answer = trim($_POST['input_'.$id_quest]);
					
					$tmp_test = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `text` = '$answer'");
					
					if(!empty($tmp_test)){
						$id_answers .= $tmp_test[0]['id'];
						$javob_durust_student++;
					}else{
						$id_answers .= getidbytext($id_quest, $answer);
					}
				}
				$id_answers .= "^";
				/*END TYPE 5, 6*/
			}
			
		}
		
		$id_questions = substr($id_questions, 0, strlen($id_questions)-1);
		$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
		
		
		$koef_score = 100 / $javob_durust_total;
		$score = round($javob_durust_student * $koef_score);
		
		/*
		echo "Ҳамаги ҷавобҳои дуруст: ".$javob_durust_total;
		echo "<br>";
		echo "Ҳамаги ҷавобҳои Шумо: ".$javob_durust_student;
		echo "<br>";
		echo "Ҳамаги холҳои Шумо: ".$imt_score;
		
		
		
		$vip = query("SELECT * FROM `_vip_list` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		if(!empty($vip)){
			$score = rand(75, 89);
			$javob_durust_student = $score / $koef_score;
		}
		
		*/
		
		$results = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		if(empty($results)){
			// натиҷа ёфт нашуд дар таблитса бояд илова карда шавад
			
			$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
			$data['id_s_l'] = "'".clear_admin($id_s_l)."'";
			$data['id_s_v'] = "'".clear_admin($id_s_v)."'";
			$data['id_course'] = "'".clear_admin($id_course)."'";
			$data['id_spec'] = "'".clear_admin($id_spec)."'";
			$data['id_group'] = "'".clear_admin($id_group)."'";
			$data['id_student'] = "'".clear_admin($id_student)."'";
			$data['id_fan'] = "'".clear_admin($id_fan)."'";
			$data['type'] = "'".clear_admin(1)."'"; // имтиҳон
			
			
			if($rating == 1){
				$data['nf_1_score'] = "'".clear_admin($score)."'";
				$data['nf_1_add_date'] = "'".clear_admin(date("d.m.y, H:i"))."'";
				$data['nf_1_author'] = "'".clear_admin($id_student)."'";
			}elseif($rating == 2){
				$data['nf_2_score'] = "'".clear_admin($score)."'";
				$data['nf_2_add_date'] = "'".clear_admin(date("d.m.y, H:i"))."'";
				$data['nf_2_author'] = "'".clear_admin($id_student)."'";
			}
			
			$data['s_y'] = "'".clear_admin($S_Y)."'";
			$data['h_y'] = "'".clear_admin($H_Y)."'";
			
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			/*Иловакунии маълумотҳо дар таблитсаи USERS */
			
			insert("results", $fields, $data);
			
		}else{
			// натиҷаро сабт кардан даркор
			$id = $results[0]['id'];
			
			if($rating == 1){
				$fields['nf_1_score'] = $score;
				$fields['nf_1_add_date'] = date("d.m.y, H:i");
				$fields['nf_1_author'] = $id_student;
			}elseif($rating == 2){
				$fields['nf_2_score'] = $score;
				$fields['nf_2_add_date'] = date("d.m.y, H:i");
				$fields['nf_2_author'] = $id_student;
			}
			update("results", $fields, "`id` = '$id'");
		}
	break;
	
	case "result_teacher":
		$id_fan = $_REQUEST['id_fan'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		
		$page_info['title'] = 'Натиҷаи санҷиш: '.getFanTest($id_fan).", ".getStudyYear($S_Y).": $H_Y";
		
		function getidbytext($id_quest, $text){
			$query = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `text` = '$text'");
			if(!empty($query))
				return $query[0]['id'];
			else return 0;
		}
		
		$javob_durust_total = 0;
		$javob_durust_student = 0;
		$score = 0;
		$id_questions = '';
		$id_answers = '';
		
		foreach ($_SESSION['questions'] as $question){
			$id_quest = $question['id'];
			$id_questions .= $id_quest.",";
			
			if($question["type"] == 1){
				/*START TYPE 1*/
				
				if(isset($_REQUEST['quest_'.$id_quest])){
					$id_answer = $_REQUEST['quest_'.$id_quest];
					$id_answers .= $id_answer;
					
					$check_it = query("SELECT * FROM `answers` WHERE `id` = '$id_answer' AND `right_answer` = '1'");
				
					if(!empty($check_it)){
						$javob_durust_total++;
						$javob_durust_student++;
					} 
				}else{
					$id_answers .= 0;
				}
				
				$id_answers .= "^";
				/*END TYPE 1*/
			}elseif($question['type'] == 2){
				/*START TYPE 2*/
				$ids_answer = '';
				$select = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `right_answer` = '1'");
				
				$javob_durust_total += count($select);
				
				$tmp = 0;
				if(isset($_REQUEST["check_".$id_quest])){
					foreach(@$_REQUEST["check_".$id_quest] as $item){
						if(isset($item)){
							$id_answers .= $item.',';
						}else{
							$id_answers .= 0 .',';
						}
						
						$check_it = query("SELECT * FROM `answers` WHERE `id` = '$item' AND `right_answer` = '1'");
						if(!empty($check_it)){
							$tmp++;
						}
					}
					
					
					if(count($select) == $tmp){
						$javob_durust_student += $tmp;
					}
				}
				$id_answers .= "^";
				/*END TYPE 2*/
			}elseif($question['type'] == 3){
				/*START TYPE 3*/
				
				$select = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `right_answer` IS NOT NULL");
				$javob_durust_total += count($select);
				
				$answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `position` = '1'");
				$m_score = 0;
				
				foreach($answers as $pos_1){
					
					$id_answer = $pos_1['id'];
					
					if(!isset($_REQUEST['check_'.$id_quest.'-'.$pos_1['id']])){
						$r_a = 0;
						$id_answers .= 0 .',';
					}else{
						$r_a = @$_REQUEST['check_'.$id_quest.'-'.$pos_1['id']];
						$id_answers .= $r_a.',';
					}
					
					
					$scores = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `position` = '2' AND `right_answer` = '$r_a'");
					
					if($scores){
						$javob_durust_student++;
					}
				}
				
				$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
				$id_answers .= "^";
				
				/*END TYPE 3*/
			}
			elseif($question['type'] == 4){
				/*START TYPE 4*/
				
				$javob_durust_total++;
				
				$select = query("SELECT * FROM `questions` WHERE `id` = '$id_quest'");
				$text_question = $tmp = $select[0]['text'];
				
				$search = [];
				$replace = [];
				$arr = [];
				if(!isset($_POST["type4_".$id_quest])){
					unset($arr);
				}else{
					$arr = @$_POST["type4_".$id_quest];
				}
				if(isset($arr)){
					if(@$arr[0] != '0'){
						for ($i = 0, $j = 1; $i < @count($arr); $i++, $j++){
							$tmp = str_replace($arr[$i], "\\$j/", $tmp);
							$search[] = "\\$j/";
							$replace[] = $arr[$i];
							$text = $arr[$i];
							if($text){
								$id_answers .= getidbytext($id_quest, $text).',';
							}else{
								$id_answers .= 0 .',';
							}
						}
						
						$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
						$tmp = str_replace($search, $replace, $tmp);
						
						if($text_question == $tmp){
							$javob_durust_student++;
						}
					}
				}
				$id_answers .= "^";
				/*END TYPE 4*/
			}
			elseif($question["type"] == 5 || $question["type"] == 6){
				/*START TYPE 5, 6*/
				
				$javob_durust_total++;
				
				if(!empty($_POST['input_'.$id_quest])){
					$answer = trim($_POST['input_'.$id_quest]);
					
					$tmp_test = query("SELECT * FROM `answers` WHERE `id_question` = '$id_quest' AND `text` = '$answer'");
					
					if(!empty($tmp_test)){
						$id_answers .= $tmp_test[0]['id'];
						$javob_durust_student++;
					}else{
						$id_answers .= getidbytext($id_quest, $answer);
					}
				}
				$id_answers .= "^";
				/*END TYPE 5, 6*/
			}
			
		}
		
		$id_questions = substr($id_questions, 0, strlen($id_questions)-1);
		$id_answers = substr($id_answers, 0, strlen($id_answers)-1);
		
		
		$koef_score = 100 / $javob_durust_total;
		
		//echo "Ҳамаги ҷавобҳои дуруст: ".$javob_durust_total;
		echo "<br>";
		$score = $javob_durust_student * $koef_score;
		
		echo "Ҳамаги ҷавобҳои Шумо: ".$javob_durust_student;
		echo "<br>";
		echo "Ҳамаги холҳои Шумо: ".$score;
		
		
		$data['id_fan'] = "'".clear_admin($id_fan)."'";
		$data['id_teacher'] = "'".clear_admin($_SESSION['user']['id'])."'";
		
		$data['score'] = "'".clear_admin($score)."'";
		$data['date'] = "'".clear_admin(date("d.m.y, H:i"))."'";
		
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		if(insert("results_teacher", $fields, $data)){
			$data_v['id_student'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data_v['id_fan'] = "'".clear_admin($id_fan)."'";
			$data_v['id_questions'] = "'".clear_admin($id_questions)."'";
			$data_v['id_answers'] = "'".clear_admin($id_answers)."'";
			$data_v['date'] = "'".clear_admin(date("d.m.y, H:i"))."'";
			$data_v['s_y'] = "'".clear_admin(S_Y)."'";
			$data_v['h_y'] = "'".clear_admin(H_Y)."'";
			
			$fields_v = array_keys($data_v);
			$data_v = implode(",", $data_v);
			
			insert("results_variants", $fields_v, $data_v);
		}
		echo "<br>";
		echo '<a href="'.MY_URL.'">Ба аввал</a>';
		exit;
		
		
		
		$results = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		if(empty($results)){
			// натиҷа ёфт нашуд дар таблитса бояд илова карда шавад
			
			$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
			$data['id_student'] = "'".clear_admin($id_student)."'";
			$data['id_course'] = "'".clear_admin($id_course)."'";
			$data['id_spec'] = "'".clear_admin($id_spec)."'";
			$data['id_group'] = "'".clear_admin($id_group)."'";
			$data['id_fan'] = "'".clear_admin($id_fan)."'";
			$data['type'] = "'".clear_admin(1)."'"; // имтиҳон
			
			$data['imt_score'] = "'".clear_admin($imt_score)."'";
			$data['imt_add_date'] = "'".clear_admin(date("d.m.y, H:i"))."'";
			$data['imt_author'] = "'".clear_admin($id_student)."'";
			$data['s_y'] = "'".clear_admin($S_Y)."'";
			$data['h_y'] = "'".clear_admin($H_Y)."'";
			
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			/*Иловакунии маълумотҳо дар таблитсаи USERS */
			
			insert("results", $fields, $data);
			
		}else{
			// натиҷаро сабт кардан даркор
			$id = $results[0]['id'];
			
			$fields['imt_score'] = $imt_score;
			$fields['imt_add_date'] = date("d.m.y, H:i");
			
			update("results", $fields, "`id` = '$id'");
		}
		
	break;
	
}


?>