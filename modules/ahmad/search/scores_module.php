<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}

switch($action){
	
	case "insert_nb":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$rating = $_REQUEST['rating'];
		$id_teacher = $_SESSION['user']['id'];
		
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			
			
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
			
			$id_fan = $data_iq[0]['id_fan'];
			
		
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			
			$counter = 0;
			foreach($students as $item){
				
				unset($data, $fields, $fields_update);
				
				
				if($rating == 1){
					$absents_r_1 = clear_admin($_REQUEST['absents_r_1'][$counter]);
					
				}elseif($rating == 2){
					$absents_r_2 = clear_admin($_REQUEST['absents_r_2'][$counter]);
				}
				
				
				$check = query("SELECT * FROM `students_absents` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `rating` = '$rating' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
				
				if(empty($check)){
					// Бояд сабт кунем малумотҳоро
					$data['id_student'] = "'".clear_admin($item['id'])."'";
					$data['id_fan'] = "'".clear_admin($id_fan)."'";
					$data['rating'] = "'".clear_admin($rating)."'";
					if($rating == 1){
						if(!empty($_REQUEST['absents_r_1'][$counter])){
							$data['absents'] = "'".clear_admin($absents_r_1)."'";
						}
					}else{
						if(!empty($_REQUEST['absents_r_2'][$counter])){
							$data['absents'] = "'".clear_admin($absents_r_2)."'";
						}
					}
					$data['semestr'] = "'".clear_admin($semestr)."'";
					$data['s_y'] = "'".clear_admin($S_Y)."'";
					$data['h_y'] = "'".clear_admin($H_Y)."'";
					
					
					$fields_insert = array_keys($data);
					$data = implode(",", $data);
					
					$page_info['title'] = 'Иловакунии НБ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
					setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
					if(!empty($_REQUEST['absents_r_1'][$counter]) || !empty($_REQUEST['absents_r_2'][$counter])){
						insert("students_absents", $fields_insert, $data);
					}
				}
				else{
					// Бояд обновит кунем
					if(!empty($_REQUEST['absents_r_1'][$counter]) || !empty($_REQUEST['absents_r_2'][$counter])){
						if($rating == 1){
							$query = update_query("UPDATE `students_absents` SET `absents` = `absents` + $absents_r_1 WHERE `id` = '".$check[0]['id']."'", 1);
					
						}elseif($rating == 2){
							$query = update_query("UPDATE `students_absents` SET `absents` = `absents` + $absents_r_2 WHERE `id` = '".$check[0]['id']."'", 1);
						}
					}
					
				}
				
				$counter++;
			}
		}
		
		redirect();
	break;
	
	case "insert_score_nf":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$rating = $_REQUEST['rating'];
		$id_teacher = $_SESSION['user']['id'];
		
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			
			
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
			
			$id_fan = $data_iq[0]['id_fan'];
			
		
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			$setting = query("SELECT `score` FROM `tests_settings` WHERE `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '".H_Y."'");
			
			if(!empty($setting)){
				$max = $setting[0]['score'];
			}else{
				$max = 30;
			}
		
			$counter = 0;
			foreach($students as $item){
				
				unset($data, $fields, $fields_update);
				
				
				if($rating == 1){
					$nf_1_score = clear_admin($_REQUEST['nf_1_score'][$counter]);
					if(!empty($_REQUEST['nf_1_score_r'][$counter])){
						$nf_1_score_r = clear_admin($_REQUEST['nf_1_score_r'][$counter]);
					}
					if($nf_1_score < 0 && $nf_1_score > $max) redirect();
					
				}elseif($rating == 2){
					$nf_2_score = clear_admin($_REQUEST['nf_2_score'][$counter]);
					if(!empty($_REQUEST['nf_2_score_r'][$counter])){
						$nf_2_score_r = clear_admin($_REQUEST['nf_2_score_r'][$counter]);
					}
					if($nf_2_score < 0 && $nf_2_score > $max) redirect();
					
				}
				
				
				$check = query("SELECT * FROM `results` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `id_course` = '$id_course' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
				
				if(empty($check)){
					// Бояд сабт кунем малумотҳоро
					$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
					$data['id_student'] = "'".clear_admin($item['id'])."'";
					$data['id_s_l'] = "'".clear_admin($item['id_s_l'])."'";
					$data['id_s_v'] = "'".clear_admin($item['id_s_v'])."'";
					$data['id_course'] = "'".clear_admin($id_course)."'";
					$data['id_spec'] = "'".clear_admin($id_spec)."'";
					$data['id_group'] = "'".clear_admin($id_group)."'";
					$data['id_fan'] = "'".clear_admin($id_fan)."'";
					$data['type'] = "'".clear_admin(1)."'";
					
					
					
					if($rating == 1){
						if(!empty($_REQUEST['nf_1_score'][$counter])){
							$data['nf_1_score'] = "'".clear_admin($nf_1_score)."'";
						}else{
							$data['nf_1_score'] = 0;
						}
						
						if(isset($_REQUEST['nf_1_score_r'][$counter])){
							if(!empty($_REQUEST['nf_1_score_r'][$counter])){
								$data['nf_1_score_r'] = "'".clear_admin($nf_1_score_r)."'";
							}else{
								$data['nf_1_score_r'] = 0;
							}
						}
						
						$data['nf_1_add_date'] = "'".date("d.m.y, H:i", time())."'";
						$data['nf_1_author'] = "'".$_SESSION['user']['id']."'";
						
					}elseif($rating == 2){
						if(!empty($_REQUEST['nf_2_score'][$counter])){
							$data['nf_2_score'] = "'".clear_admin($nf_2_score)."'";
						}else{
							$data['nf_2_score'] = 0;
						}
						
						if(isset($_REQUEST['nf_2_score_r'][$counter])){
							if(!empty($_REQUEST['nf_2_score_r'][$counter])){
								$data['nf_2_score_r'] = "'".clear_admin($nf_2_score_r)."'";
							}else{
								$data['nf_2_score_r'] = 0;
							}
						}
						
						$data['nf_2_add_date'] = "'".date("d.m.y, H:i", time())."'";
						$data['nf_2_author'] = "'".$_SESSION['user']['id']."'";
					}
					
					
					$data['semestr'] = "'".clear_admin($semestr)."'";
					$data['s_y'] = "'".clear_admin($S_Y)."'";
					$data['h_y'] = "'".clear_admin($H_Y)."'";
					
					
					$fields_insert = array_keys($data);
					$data = implode(",", $data);
					
					$page_info['title'] = 'Холгузорӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
					setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
					
					insert("results", $fields_insert, $data);
				}
				else{
					// Бояд обновит кунем
					
					if($rating == 1){
						if($check[0]['nf_1_score'] != $nf_1_score){
							// Агар холи нав барои nf_1_score бошад
							if(!empty($_REQUEST['nf_1_score'][$counter])){
								$fields_update['nf_1_score'] = $nf_1_score;
							}else {
								$fields_update['nf_1_score'] = 0;
							}
						}
						
						if(isset($_REQUEST['nf_1_score_r'][$counter])){
							if($check[0]['nf_1_score_r'] != $nf_1_score_r){
								// Агар холи нав барои nf_1_score_r бошад
								if(!empty($_REQUEST['nf_1_score_r'][$counter])){
									$fields_update['nf_1_score_r'] = $nf_1_score_r;
								}else{
									$fields_update['nf_1_score_r'] = 0;
								}
							}
						}
					}elseif($rating == 2){
					
					
						if($check[0]['nf_2_score'] != $nf_2_score){
							// Агар холи нав барои nf_2_score бошад
							if(!empty($_REQUEST['nf_2_score'][$counter])){
								$fields_update['nf_2_score'] = $nf_2_score;
							}else {
								$fields_update['nf_2_score'] = 0;
							}
						}
						
						if(isset($_REQUEST['nf_2_score_r'][$counter])){
							if($check[0]['nf_2_score_r'] != @$nf_2_score_r){
								// Агар холи нав барои nf_2_absent бошад
								if(!empty($_REQUEST['nf_2_score_r'][$counter])){
									$fields_update['nf_2_score_r'] = $nf_2_score_r;
								}else{
									$fields_update['nf_2_score_r'] = 0;
								}
							}
						}
						
						$fields_update['nf_2_add_date'] = date("d.m.y, H:i", time());
						$fields_update['nf_2_author'] = $_SESSION['user']['id'];
					}
					
					
					/*
					if($check[0]['nf_2_score'] != $nf_2_score){
						// Агар холи нав бошад
						if(isset($_REQUEST['nf_2'][$counter])){
							$fields['nf_2_score'] = $nf_2_score;
							$fields['nf_2_edit_date'] = date("d.m.y, H:i", time());
							$fields['nf_2_editor'] = $_SESSION['user']['id'];
							
							unset($data2, $fields2);
							$data2['id_student'] = "'".clear_admin($item['id'])."'";
							$data2['id_fan'] = "'".clear_admin($id_fan)."'";
							$data2['score_type'] = "'2'";
							$data2['old_score'] = "'".clear_admin($check[0]['nf_2_score'])."'";
							$data2['new_score'] = "'".clear_admin($nf_2_score)."'";
							$data2['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
							$data2['date'] = "'".clear_admin(date("d.m.y, H:i", time()))."'";
							
							$fields2 = array_keys($data2);
							$data2 = implode(",", $data2);
							insert("score_history", $fields2, $data2);
						}
					}
					*/
					
					
					if(isset($fields_update)){
						$page_info['title'] = 'Тағйирдиҳии холҳо / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
						setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
						update("results", $fields_update, "`id` = '".$check[0]['id']."'", 1);
					}
					
				}
				
				$counter++;
			}
		}
		
		redirect();
	break;
	
	
	case "insert_score_nf_rating":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$rating = $_REQUEST['rating'];
		$id_teacher = $_SESSION['user']['id'];
		
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			
			
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
			
			$id_fan = $data_iq[0]['id_fan'];
			
		
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			$max = 50;
			
			$counter = 0;
			foreach($students as $item){
				
				unset($data, $fields, $fields_update);
				
				
				if($rating == 1){
					$nf_1_score_r = clear_admin($_REQUEST['nf_1_score_r'][$counter]);
					//$nf_1_absent = clear_admin($_REQUEST['nf_1_absent'][$counter]);
					
					if($nf_1_score_r < 0 && $nf_1_score_r > $max) redirect();
					//if($nf_1_absent < 0 && $nf_1_absent > $max) redirect();
				}elseif($rating == 2){
					$nf_2_score_r = clear_admin($_REQUEST['nf_2_score_r'][$counter]);
					//$nf_2_absent = clear_admin($_REQUEST['nf_2_absent'][$counter]);
					
					if($nf_2_score_r < 0 && $nf_2_score_r > $max) redirect();
					//if($nf_2_absent < 0 && $nf_2_absent > 20) redirect();
				}
				
				
				$check = query("SELECT * FROM `results` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `id_course` = '$id_course' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
				
				if(empty($check)){
					// Бояд сабт кунем малумотҳоро
					$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
					$data['id_student'] = "'".clear_admin($item['id'])."'";
					$data['id_s_l'] = "'".clear_admin($item['id_s_l'])."'";
					$data['id_s_v'] = "'".clear_admin($item['id_s_v'])."'";
					$data['id_course'] = "'".clear_admin($id_course)."'";
					$data['id_spec'] = "'".clear_admin($id_spec)."'";
					$data['id_group'] = "'".clear_admin($id_group)."'";
					$data['id_fan'] = "'".clear_admin($id_fan)."'";
					$data['type'] = "'".clear_admin(1)."'";
					
					
					
					if($rating == 1){
						if(!empty($_REQUEST['nf_1_score_r'][$counter])){
							$data['nf_1_score_r'] = "'".clear_admin($nf_1_score_r)."'";
						}else{
							$data['nf_1_score_r'] = 0;
						}
					}elseif($rating == 2){
						if(!empty($_REQUEST['nf_2_score_r'][$counter])){
							$data['nf_2_score_r'] = "'".clear_admin($nf_2_score_r)."'";
						}else{
							$data['nf_2_score_r'] = 0;
						}
					}
					
					
					$data['semestr'] = "'".clear_admin($semestr)."'";
					$data['s_y'] = "'".clear_admin($S_Y)."'";
					$data['h_y'] = "'".clear_admin($H_Y)."'";
					
					
					$fields_insert = array_keys($data);
					$data = implode(",", $data);
					
					$page_info['title'] = 'Холгузорӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
					setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
					
					insert("results", $fields_insert, $data);
				}
				else{
					// Бояд обновит кунем
					
					if($rating == 1){
						if($check[0]['nf_1_score_r'] != $nf_1_score_r){
							// Агар холи нав барои nf_1_score_r бошад
							if(!empty($_REQUEST['nf_1_score_r'][$counter])){
								$fields_update['nf_1_score_r'] = $nf_1_score_r;
							}else {
								$fields_update['nf_1_score_r'] = 0;
							}
						}
					
					}elseif($rating == 2){
					
					
						if($check[0]['nf_2_score_r'] != $nf_2_score_r){
							// Агар холи нав барои nf_2_score_r бошад
							if(!empty($_REQUEST['nf_2_score_r'][$counter])){
								$fields_update['nf_2_score_r'] = $nf_2_score_r;
							}else {
								$fields_update['nf_2_score_r'] = 0;
							}
						}
						
						
					}
					
					
					if(isset($fields_update)){
						$page_info['title'] = 'Тағйирдиҳии холҳо / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
						setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
						update("results", $fields_update, "`id` = '".$check[0]['id']."'");
					}
					
				}
				
				$counter++;
			}
		}
		
		redirect();
	break;
	
	
	case "insert_score_m2":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$imt_type = $_REQUEST['imt_type'];
		$id_teacher = $_SESSION['user']['id'];
		
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			
			
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
			
			$id_fan = $data_iq[0]['id_fan'];
			
		
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			
			$counter = 0;
			foreach($students as $item){
				
				unset($data, $fields, $fields_update);
				
				$nf_1_score = clear_admin($_REQUEST['nf_1_score'][$counter]);
				$nf_2_score = clear_admin($_REQUEST['nf_2_score'][$counter]);
				
				if($imt_type != 1)
					$imt_score = clear_admin($_REQUEST['imt_score'][$counter]);
				
				
				if($nf_1_score < 0 && $nf_1_score > 100) redirect();
				if($nf_2_score < 0 && $nf_2_score > 100) redirect();
				if($imt_type != 1)
					if($imt_score < 0 && $imt_score > 100) redirect();
				
				
				$check = query("SELECT * FROM `results` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `id_course` = '$id_course' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
				
				if(empty($check)){
					// Бояд сабт кунем малумотҳоро
					$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
					$data['id_student'] = "'".clear_admin($item['id'])."'";
					$data['id_s_l'] = "'".clear_admin($item['id_s_l'])."'";
					$data['id_s_v'] = "'".clear_admin($item['id_s_v'])."'";
					$data['id_course'] = "'".clear_admin($id_course)."'";
					$data['id_spec'] = "'".clear_admin($id_spec)."'";
					$data['id_group'] = "'".clear_admin($id_group)."'";
					$data['id_fan'] = "'".clear_admin($id_fan)."'";
					$data['type'] = "'".clear_admin(1)."'";
					
					/* НФ 1 */
					if(!empty($_REQUEST['nf_1_score'][$counter])){
						$data['nf_1_score'] = "'".clear_admin($nf_1_score)."'";
					}else{
						$data['nf_1_score'] = 0;
					}
					
					$data['nf_1_add_date'] = "'".date("d.m.y, H:i", time())."'";
					$data['nf_1_author'] = "'".$_SESSION['user']['id']."'";
					/* НФ 1 */
					
					
					
					/* НФ 2 */
					if(!empty($_REQUEST['nf_2_score'][$counter])){
						$data['nf_2_score'] = "'".clear_admin($nf_2_score)."'";
					}else{
						$data['nf_2_score'] = 0;
					}
					
					$data['nf_2_add_date'] = "'".date("d.m.y, H:i", time())."'";
					$data['nf_2_author'] = "'".$_SESSION['user']['id']."'";
					/* НФ 2 */
					
					
					if($imt_type != 1){
						/* ИМТ */
						if(!empty($_REQUEST['imt_score'][$counter])){
							$data['imt_score'] = "'".clear_admin($imt_score)."'";
						}else{
							$data['imt_score'] = 0;
						}
						
						$total_score = (($nf_1_score + $nf_2_score) / 4) + $imt_score / 2;
						$data['total_score'] = "'".clear_admin($total_score)."'";
						
						
						$data['imt_add_date'] = "'".date("d.m.y, H:i", time())."'";
						$data['imt_author'] = "'".$_SESSION['user']['id']."'";
						/* ИМТ */
					}
					
					$data['s_y'] = "'".clear_admin($S_Y)."'";
					$data['h_y'] = "'".clear_admin($H_Y)."'";
					
					
					$fields_insert = array_keys($data);
					$data = implode(",", $data);
					
					$page_info['title'] = 'Холгузорӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
					setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
					
					insert("results", $fields_insert, $data);
				}
				else{
					// Бояд обновит кунем
					
					if($check[0]['nf_1_score'] != $nf_1_score){
						// Агар холи нав барои nf_1_score бошад
						if(!empty($_REQUEST['nf_1_score'][$counter])){
							$fields_update['nf_1_score'] = $nf_1_score;
						}else {
							$fields_update['nf_1_score'] = 0;
						}
					}
					
					
					if($check[0]['nf_2_score'] != $nf_2_score){
						// Агар холи нав барои nf_2_score бошад
						if(!empty($_REQUEST['nf_2_score'][$counter])){
							$fields_update['nf_2_score'] = $nf_2_score;
						}else {
							$fields_update['nf_2_score'] = 0;
						}
					}
					
					if($imt_type != 1){
						//if($check[0]['imt_score'] != $imt_score){
							// Агар холи нав барои imt_score бошад
							if(!empty($_REQUEST['imt_score'][$counter])){
								$fields_update['imt_score'] = $imt_score;
							}else {
								$fields_update['imt_score'] = 0;
							}
							
							$total_score = (($check[0]['nf_1_score'] + $check[0]['nf_2_score']) / 4) + $imt_score / 2;
							$fields_update['total_score'] = $total_score;
						//}
					}
					
					
					
					
					/*
					if($check[0]['nf_2_score'] != $nf_2_score){
						// Агар холи нав бошад
						if(isset($_REQUEST['nf_2'][$counter])){
							$fields['nf_2_score'] = $nf_2_score;
							$fields['nf_2_edit_date'] = date("d.m.y, H:i", time());
							$fields['nf_2_editor'] = $_SESSION['user']['id'];
							
							unset($data2, $fields2);
							$data2['id_student'] = "'".clear_admin($item['id'])."'";
							$data2['id_fan'] = "'".clear_admin($id_fan)."'";
							$data2['score_type'] = "'2'";
							$data2['old_score'] = "'".clear_admin($check[0]['nf_2_score'])."'";
							$data2['new_score'] = "'".clear_admin($nf_2_score)."'";
							$data2['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
							$data2['date'] = "'".clear_admin(date("d.m.y, H:i", time()))."'";
							
							$fields2 = array_keys($data2);
							$data2 = implode(",", $data2);
							insert("score_history", $fields2, $data2);
						}
					}
					*/
					
					
					if(isset($fields_update)){
						$page_info['title'] = 'Тағйирдиҳии холҳо / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
						setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
						update("results", $fields_update, "`id` = '".$check[0]['id']."'");
					}
					
				}
				
				$counter++;
			}
		}
		
		redirect();
	break;
	
	
	case "insert_score_kk":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$id_teacher = $_SESSION['user']['id'];
		
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
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
			
			
			$id_fan = $data_iq[0]['id_fan'];
			
		
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			
			
			$counter = 0;
			foreach($students as $item){
				
				unset($data, $fields, $fields_update);
				
				$kori_kursi = clear_admin($_REQUEST['kori_kursi'][$counter]);
				
				if($kori_kursi < 0 && $kori_kursi > 100) redirect();
				$check = query("SELECT * FROM `results` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `id_course` = '$id_course' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
				
				if(empty($check)){
					// Бояд сабт кунем малумотҳоро
					$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
					$data['id_student'] = "'".clear_admin($item['id'])."'";
					$data['id_s_l'] = "'".clear_admin($item['id_s_l'])."'";
					$data['id_s_v'] = "'".clear_admin($item['id_s_v'])."'";
					$data['id_course'] = "'".clear_admin($id_course)."'";
					$data['id_spec'] = "'".clear_admin($id_spec)."'";
					$data['id_group'] = "'".clear_admin($id_group)."'";
					$data['id_fan'] = "'".clear_admin($id_fan)."'";
					$data['type'] = "'".clear_admin(1)."'";
					
					if(!empty($_REQUEST['kori_kursi'][$counter])){
						$data['kori_kursi'] = "'".clear_admin($kori_kursi)."'";
					}else{
						$data['kori_kursi'] = 0;
					}
					
					$data['kori_kursi_add_date'] = "'".date("d.m.y, H:i", time())."'";
					$data['kori_kursi_author'] = "'".$_SESSION['user']['id']."'";
					
					$data['s_y'] = "'".clear_admin($S_Y)."'";
					$data['h_y'] = "'".clear_admin($H_Y)."'";
					
					
					$fields_insert = array_keys($data);
					$data = implode(",", $data);
					
					$page_info['title'] = 'Холгузории кори курсӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
					setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
					
					insert("results", $fields_insert, $data);
				}
				else{
					// Бояд обновит кунем
					
					
					if($check[0]['kori_kursi'] != $kori_kursi){
						// Агар холи нав барои nf_2_score бошад
						if(!empty($_REQUEST['kori_kursi'][$counter])){
							$fields_update['kori_kursi'] = $kori_kursi;
						}else {
							$fields_update['kori_kursi'] = 0;
						}
					}
					
					if(isset($fields_update)){
						$id = $check[0]['id'];
						$page_info['title'] = 'Тағйирдиҳии холҳои кори курсӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
						setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
						
						update("results", $fields_update, "`id` = '$id'");
					}
					
				}
				
				$counter++;
			}
		}
		
		redirect();
	break;
	
	case "insert_score_ilm":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$id_teacher = $_SESSION['user']['id'];
		
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
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
			
			
			$id_fan = $data_iq[0]['id_fan'];
			
		
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			
			
			$counter = 0;
			foreach($students as $item){
				
				unset($data, $fields, $fields_update);
				
				$total_score = clear_admin($_REQUEST['total_score'][$counter]);
				
				if($total_score < 0 && $total_score > 100) redirect();
				$check = query("SELECT * FROM `results` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `id_course` = '$id_course' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
				
				if(empty($check)){
					// Бояд сабт кунем малумотҳоро
					$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
					$data['id_student'] = "'".clear_admin($item['id'])."'";
					$data['id_s_l'] = "'".clear_admin($item['id_s_l'])."'";
					$data['id_s_v'] = "'".clear_admin($item['id_s_v'])."'";
					$data['id_course'] = "'".clear_admin($id_course)."'";
					$data['id_spec'] = "'".clear_admin($id_spec)."'";
					$data['id_group'] = "'".clear_admin($id_group)."'";
					$data['id_fan'] = "'".clear_admin($id_fan)."'";
					$data['type'] = "'".clear_admin(1)."'";
					
					if(!empty($_REQUEST['total_score'][$counter])){
						$data['total_score'] = "'".clear_admin($total_score)."'";
					}else{
						$data['total_score'] = 0;
					}
					
					
					$data['total_score_author'] = "'".$_SESSION['user']['id']."'";
					
					$data['s_y'] = "'".clear_admin($S_Y)."'";
					$data['h_y'] = "'".clear_admin($H_Y)."'";
					
					
					$fields_insert = array_keys($data);
					$data = implode(",", $data);
					
					$page_info['title'] = 'Холгузорӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
					setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
					
					insert("results", $fields_insert, $data);
				}
				else{
					// Бояд обновит кунем
					
					if($check[0]['total_score'] != $total_score){
						if(!empty($_REQUEST['total_score'][$counter])){
							$fields_update['total_score'] = $total_score;
						}else {
							$fields_update['total_score'] = 0;
						}
					}
					
					if(isset($fields_update)){
						$id = $check[0]['id'];
						$page_info['title'] = 'Тағйирдиҳии холҳо / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
						setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
						
						update("results", $fields_update, "`id` = '$id'");
					}
					
				}
				
				$counter++;
			}
		}
		
		redirect();
	break;
	
	
	case "insert_score_imt":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$id_teacher = $_SESSION['user']['id'];
		
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
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
			
			
			$id_fan = $data_iq[0]['id_fan'];
			
		
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			
			$info = query("SELECT * FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");

			$lang = $info[0]['lang'];
			$id_nt = $info[0]['id_nt'];

			
			$counter = 0;
			foreach($students as $item){
				$imt_score = clear_admin($_REQUEST['imt_score'][$counter]);
				$id_student = $item['id'];
			
				
				if($item['id_s_t'] == 1){
					$mablagi_shartnoma = query("SELECT SUM(`balance`) as `balance` FROM `students` WHERE `id_student` = '$id_student'");
					$mablagi_shartnoma = $mablagi_shartnoma[0]['balance'];
					$mablag_suporid = query("SELECT SUM(`check_money`) as `sum` FROM `rasidho` WHERE `type` = '2' AND `id_student` = '$id_student'");
					$mablag_suporid = $mablag_suporid[0]['sum'];
					
					/* Барои нимсолаи 2 */
					if($mablag_suporid < $mablagi_shartnoma){
						$imt_score = 0;
					}
					
				}
				
				
				
				
				$check = query("SELECT * FROM `results` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `id_course` = '$id_course' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
				
				$semestr = getSemestr($id_course, $H_Y);
				$check_kk = query("SELECT * FROM `nt_content` WHERE `k_k` = '1' AND `id_nt` = '$id_nt' AND `id_fan` = '$id_fan' AND `semestr` = '$semestr'");
				
				
				/* ТАФТИШИ КОРИ КУРСӢ / ЛОИҲАИ КУРСӢ */
				if(!empty($check_kk)){
					if($check[0]['kori_kursi'] < 50){
						/*
						$_SESSION['kori_kursi'] = 'Донишҷуёне ки кори курсиро насупоридаанд холи имтиҳони намегиранд!';
						continue;
						*/
						$imt_score = 0;
					}
				}
					
				/* ТАФТИШИ КОРИ КУРСӢ / ЛОИҲАИ КУРСӢ */
				
				
				// $qarzho = query("SELECT * FROM `results` 
					// WHERE `id_student` = '".$item['id']."' AND `s_y` = '".S_Y."' AND `h_y` = '1' 
					// HAVING 
						// COALESCE(`total_score`, 0) < 50 AND COALESCE(`trimestr_score`, 0) < 50
				// ");
				
				if(!empty($qarzho)){
					$imt_score = 0;
				}
				//echo $imt_score;exit;
				$qarzi_kk = query("SELECT `nt_content`.*, `results`.* FROM `nt_content` INNER JOIN `results` ON
					`nt_content`.`id_fan` = `results`.`id_fan` AND 
					`nt_content`.`semestr` = `results`.`semestr`
					WHERE `nt_content`.`id_nt` = '$id_nt' AND
						`nt_content`.`k_k` IS NOT NULL AND
						`results`.`id_student` = '".$item['id']."' AND 
						`results`.`semestr` < $semestr AND
						COALESCE(`results`.`kori_kursi`, 0) < 50
				");
				
				if(!empty($qarzi_kk)){
					$imt_score = 0;
				}
				// if($item['id']==1404){
						// echo "ID=".$item['id']." Sup>".$mablag_suporid. "shart>".$mablagi_shartnoma." baho>".$imt_score;  exit;
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
					WHERE `farqiyatho`.`id_student` = '".$item['id']."' AND
						`farqiyatho_content`.`type` = '1' AND
						COALESCE(`results`.`total_score`, 0) < 50
						
				");
				// агар фарқият тасдиқ нашуда бошад
				$farqiyat = query("SELECT * FROM `farqiyatho` 
									WHERE `id_student` = '".$item['id']."' AND 
										`status` = '0'
								");
				
				if(!empty($farqiyat)){
					$imt_score = 0;
				}
			
				
				unset($data, $fields, $fields_update);
				
				
				
				if($imt_score < 0 && $imt_score > 100) redirect();
				
				if(empty($check)){
					// Бояд сабт кунем малумотҳоро
					$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
					$data['id_student'] = "'".clear_admin($item['id'])."'";
					$data['id_s_l'] = "'".clear_admin($item['id_s_l'])."'";
					$data['id_s_v'] = "'".clear_admin($item['id_s_v'])."'";
					$data['id_course'] = "'".clear_admin($id_course)."'";
					$data['id_spec'] = "'".clear_admin($id_spec)."'";
					$data['id_group'] = "'".clear_admin($id_group)."'";
					$data['id_fan'] = "'".clear_admin($id_fan)."'";
					$data['type'] = "'".clear_admin(1)."'";
					
					if(!empty($_REQUEST['imt_score'][$counter])){
						$data['imt_score'] = "'".clear_admin($imt_score)."'";
					}else{
						$data['imt_score'] = 0;
					}
					
					$data['imt_add_date'] = "'".date("d.m.y, H:i", time())."'";
					$data['imt_author'] = "'".$_SESSION['user']['id']."'";
					
					$data['s_y'] = "'".clear_admin($S_Y)."'";
					$data['h_y'] = "'".clear_admin($H_Y)."'";
					
					
					$fields_insert = array_keys($data);
					$data = implode(",", $data);
					
					$page_info['title'] = 'Холгузории имтиҳон / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
					setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
					
					insert("results", $fields_insert, $data);
				}
				else{
					// Бояд обновит кунем
					$score = ($check[0]['nf_1_score'] + $check[0]['nf_1_absent'] + $check[0]['nf_1_score_r'] + $check[0]['nf_2_score'] + $check[0]['nf_2_absent'] + $check[0]['nf_2_score_r']) / 2 * 0.6;
					
					if($score >= GUZARISH_SCORE){
						
						if($check[0]['imt_score'] != $imt_score){
							// Агар холи нав барои nf_2_score бошад
							if(!empty($_REQUEST['imt_score'][$counter])){
								$fields_update['imt_score'] = $imt_score;
							}else {
								$fields_update['imt_score'] = 0;
							}
							$fields_update['imt_add_date'] = date("d.m.y, H:i", time());
							$fields_update['imt_author'] = $_SESSION['user']['id'];
							
							$total_score = ($check[0]['nf_1_score'] + $check[0]['nf_1_absent'] + $check[0]['nf_1_score_r'] + $check[0]['nf_2_score'] + $check[0]['nf_2_absent'] + $check[0]['nf_2_score_r']) / 2 * 0.6 + $imt_score * 0.4;
							$fields_update['total_score'] = round($total_score);
						}
						
						
						
						if(isset($fields_update)){
							$page_info['title'] = 'Тағйирдиҳии холҳои имтиҳонӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
							setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
							
							update("results", $fields_update, "`id` = ".$check[0]['id'], 1);
						}
					}
				}
				
				$counter++;
			}
			
			// обновит одним запросом
		}
		
		redirect();
	break;
	
	
}


?>