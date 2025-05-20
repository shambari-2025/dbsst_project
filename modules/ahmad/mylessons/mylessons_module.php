<?php


switch($action){
	
	case "addmaterial":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		$weeks = query("SELECT * FROM `weeks` ORDER BY `id`");
		
		$info = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		$id_faculty = $info[0]['id_faculty'];
		$id_course = $info[0]['id_course'];
		$id_spec = $info[0]['id_spec'];
		$id_group = $info[0]['id_group'];
		$id_fan = $info[0]['id_fan'];
		$S_Y = $info[0]['s_y'];
		$H_Y = getNimsolaBySemestr($info[0]['semestr']);
		
		$page_info['title'] = 'Руйхати мавзуъҳо: '.getFanTest($id_fan);
	break;
	
	case "addlesson":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$id_fan = $_REQUEST['id_fan'];
		$id_week = $_REQUEST['id_week'];
		
		$info = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		$id_faculty = $info[0]['id_faculty'];
		$id_course = $info[0]['id_course'];
		$id_spec = $info[0]['id_spec'];
		$id_group = $info[0]['id_group'];
		$S_Y = $info[0]['s_y'];
		$H_Y = getNimsolaBySemestr($info[0]['semestr']);
		
		$page_info['title'] = 'Иловакунии мавзуъ аз фанни '.getFanTest($id_fan). ' барои '.getWeek($id_week);
	break;
	
	case "addsuporish":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$id_fan = $_REQUEST['id_fan'];
		$id_week = $_REQUEST['id_week'];
		
		$info = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		$id_faculty = $info[0]['id_faculty'];
		$id_course = $info[0]['id_course'];
		$id_spec = $info[0]['id_spec'];
		$id_group = $info[0]['id_group'];
		$S_Y = $info[0]['s_y'];
		$H_Y = getNimsolaBySemestr($info[0]['semestr']);
		
		$page_info['title'] = 'Иловакунии супориш ба '.getFanTest($id_fan). ' барои '.getWeek($id_week);
	break;
	
	case "editlesson":
		$id = $_REQUEST['id'];
		
		$lesson = query("SELECT * FROM `mavodho` WHERE `id` = '$id'");
		$id_week = $lesson[0]['id_week'];
		$id_fan = $lesson[0]['id_fan'];
		
		$id_iqtibos = $lesson[0]['id_iqtibos'];
		$info = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		$id_faculty = $info[0]['id_faculty'];
		$id_course = $info[0]['id_course'];
		$id_spec = $info[0]['id_spec'];
		$id_group = $info[0]['id_group'];
		
		$page_info['title'] = 'Таҳриркунии мавзуъ: '.getFanTest($id_fan). ': '.getWeek($id_week);
	break;
	
	case "editsuporish":
		$id = $_REQUEST['id'];
		
		$suporish = query("SELECT * FROM `suporishho` WHERE `id` = '$id'");
		$id_week = $suporish[0]['id_week'];
		$id_fan = $suporish[0]['id_fan'];
		
		$id_iqtibos = $suporish[0]['id_iqtibos'];
		$info = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
		$id_faculty = $info[0]['id_faculty'];
		$id_course = $info[0]['id_course'];
		$id_spec = $info[0]['id_spec'];
		$id_group = $info[0]['id_group'];
		$page_info['title'] = 'Таҳриркунии супориш: '.getFan($id_fan). ': '.getWeek($id_week);
	break;
	
	case "update_lesson":
		$id = $_REQUEST['id'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		$fields = array(
			'title' => $_REQUEST['title'],
			'text' => $_REQUEST['text'],
			'updated' => date("d.m.Y, H:i:s", time()),
			'updated_by' => $_SESSION['user']['id']
		);
		update("mavodho", $fields, "`id` = '$id'");
		redirect(MY_URL."?option=mylessons&action=addmaterial&id_iqtibos=".$id_iqtibos);
	break;
	
	case "update_suporish":
		$id = $_REQUEST['id'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		
		$fields = array(
			'title' => $_REQUEST['title'],
			'text' => $_REQUEST['text'],
			'updated' => date("d.m.Y, H:i:s", time()),
			'updated_by' => $_SESSION['user']['id']
		);
		update("suporishho", $fields, "`id` = '$id'");
		redirect(MY_URL."?option=mylessons&action=addmaterial&id_iqtibos=".$id_iqtibos);
	break;
	
	case "insert_lesson":
		$check = query("SELECT * FROM `mavodho` WHERE `id_iqtibos` = '".$_REQUEST['id_iqtibos']."' AND `id_fan` = '".$_REQUEST['id_fan']."' AND `id_week` = '".$_REQUEST['id_week']."' AND `s_y` = '".$_REQUEST['s_y']."' AND `h_y` = '".$_REQUEST['h_y']."'");
		
		if(empty($check)){
			$table = 'mavodho';
			$data['id_iqtibos'] = "'".clear_admin($_REQUEST['id_iqtibos'])."'";
			$data['id_week'] = "'".clear_admin($_REQUEST['id_week'])."'";
			$data['id_fan'] = "'".clear_admin($_REQUEST['id_fan'])."'";
			$data['title'] = "'".clear_admin($_REQUEST['title'])."'";
			$data['text'] = "'".addslashes($_REQUEST['text'])."'";
			$data['date'] = "'".clear_admin(date("d.m.Y, H:i:s", time()))."'";
			$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data['s_y'] = "'".clear_admin($_REQUEST['s_y'])."'";
			$data['h_y'] = "'".clear_admin($_REQUEST['h_y'])."'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			insert($table, $fields, $data, true);
		}
		redirect(MY_URL."?option=mylessons&action=addmaterial&id_iqtibos=".$_REQUEST['id_iqtibos']);
	break;
	
	case "insert_suporish":
		$check = query("SELECT * FROM `suporishho` WHERE `id_iqtibos` = '".$_REQUEST['id_iqtibos']."' AND `id_fan` = '".$_REQUEST['id_fan']."' AND `id_week` = '".$_REQUEST['id_week']."' AND `s_y` = '".$_REQUEST['s_y']."' AND `h_y` = '".$_REQUEST['h_y']."'");
		
		if(empty($check)){
			$table = 'suporishho';
			$data['id_iqtibos'] = "'".clear_admin($_REQUEST['id_iqtibos'])."'";
			$data['id_week'] = "'".clear_admin($_REQUEST['id_week'])."'";
			$data['id_fan'] = "'".clear_admin($_REQUEST['id_fan'])."'";
			$data['title'] = "'".clear_admin($_REQUEST['title'])."'";
			$data['text'] = "'".addslashes($_REQUEST['text'])."'";
			$data['date'] = "'".clear_admin(date("d.m.Y, H:i:s", time()))."'";
			$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data['s_y'] = "'".clear_admin($_REQUEST['s_y'])."'";
			$data['h_y'] = "'".clear_admin($_REQUEST['h_y'])."'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			insert($table, $fields, $data);
		}
		redirect(MY_URL."?option=mylessons&action=addmaterial&id_iqtibos=".$_REQUEST['id_iqtibos']);
	break;
	
	case "deletelesson":
		$id = $_REQUEST['id'];
		delete("mavodho", "`id` = $id");
		redirect();
	break;
	
	case "deletesuporish":
		$id = $_REQUEST['id'];
		delete("suporishho", "`id` = $id");
		redirect();
	break;
	
	case "zhurnal":
		$id_teacher = $_SESSION['user']['id'];
		$page_info['title'] = 'Журнали электронӣ';
		
		$lessons_n_1 = query("
		SELECT 
			`iqtibosho`.*,
			`sarboriho`.*
		FROM `iqtibosho`
		INNER JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
		WHERE `iqtibosho`.`s_y` = '".S_Y."' AND
		`iqtibosho`.`semestr` IN (1,3,5,7,9) AND 
		(`sarboriho`.`type` = 'lk_plan')
		AND `sarboriho`.`id_teacher` = '$id_teacher'
		ORDER BY `iqtibosho`.`semestr`, `iqtibosho`.`id_fan`
		");
		
		$lessons_n_2 = query("
		SELECT 
			`iqtibosho`.*,
			`sarboriho`.*
		FROM `iqtibosho`
		INNER JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
		WHERE `iqtibosho`.`s_y` = '".S_Y."' AND
		`iqtibosho`.`semestr` IN (2,4,6,8,10) AND 
		(`sarboriho`.`type` = 'lk_plan')
		AND `sarboriho`.`id_teacher` = '$id_teacher'
		ORDER BY `iqtibosho`.`semestr`, `iqtibosho`.`id_fan`
		");
		
	break;
	
	case "insert_absent":
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
				$id_student = $item['id'];
				unset($data, $fields, $fields_update);
				
				$soats = $_REQUEST["soat_$id_student"];
				if(isset($soats)){
					$s = count($soats);
					$check = query("SELECT `id` FROM `students_absents` WHERE `id_fan` = '$id_fan' AND `id_student` = '$id_student' AND `semestr` = '$semestr'");
					if(empty($check)){
						
						$data['id_student'] = "'".$id_student."'";
						$data['id_fan'] = "'".$id_fan."'";
						
						if(WEEK < 9){
							$data['rating'] = "'1'";
						}else{
							$data['rating'] = "'2'";
						}
						
						$data['absents'] = "'".$s."'";
						$data['semestr'] = "'".clear_admin($semestr)."'";
						$data['s_y'] = "'".clear_admin($S_Y)."'";
						$data['h_y'] = "'".clear_admin($H_Y)."'";
						
						
						$fields_insert = array_keys($data);
						$data = implode(",", $data);
						
						$page_info['title'] = 'Журнали электронӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group).' / '.getFanTest($id_fan);;
						setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
						
						insert("students_absents", $fields_insert, $data);
					}else{
						$query = update_query("UPDATE `students_absents` SET `absents` = `absents` + $s 
						WHERE `id` = '".$check[0]['id']."'");
					}
					
				}
			}
		}
		
		redirect();
	break;
	
	case "list":
		
		unset($_SESSION['questions']);
		$id_teacher = $_SESSION['user']['id'];
		$page_info['title'] = 'Дарсҳои ман';
		//$lessons = query("SELECT * FROM `jd` WHERE `id_teacher` = '".$_SESSION['user']['id']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_faculty`, `id_course`, `id_spec`, `id_fan`");
		//1747
		
		$lessons_n1 = query("
		SELECT 
			`iqtibosho`.*,
			`tests`.`r_1_access`,
			`tests`.`r_2_access`,
			`sarboriho`.*
			
		FROM `iqtibosho`
		INNER JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
		LEFT JOIN `tests` ON `iqtibosho`.`id` = `tests`.`id_iqtibos`
		WHERE `iqtibosho`.`s_y` = '".S_Y."' AND
		`iqtibosho`.`semestr` IN (1,3,5,7,9) AND 
		(`sarboriho`.`type` = 'lk_plan' OR `sarboriho`.`type` = 'kori_kursi' OR `sarboriho`.`type` = 'loihai_kursi')
		AND `sarboriho`.`id_teacher` = '$id_teacher'
		ORDER BY `iqtibosho`.`semestr`, `iqtibosho`.`id_fan`
		");
		
		$lessons_n1_2 = query("
			SELECT 
				`iqtibosho`.*,
				`sarboriho`.*
			FROM `iqtibosho`
			INNER JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
			WHERE  `iqtibosho`.`s_y` = '".S_Y."' AND
			`iqtibosho`.`semestr` IN (1,3,5,7,9) AND 
			`sarboriho`.`type` = 'am_plan' 
			AND `sarboriho`.`id_teacher` = '$id_teacher'
			AND `iqtibosho`.`id_fan` IN(606,634,1747,626,634,619)
			ORDER BY `iqtibosho`.`semestr`, `iqtibosho`.`id_fan`
			");
			
		$lessons_n_1 = array_merge($lessons_n1,$lessons_n1_2);	
		
		
		
		
		
		$lessons_n2 = query("
		SELECT 
			`iqtibosho`.*,
			`tests`.`r_1_access`,
			`tests`.`r_2_access`,
			`sarboriho`.*
			
		FROM `iqtibosho`
		INNER JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
		LEFT JOIN `tests` ON `iqtibosho`.`id` = `tests`.`id_iqtibos`
		WHERE `iqtibosho`.`s_y` = '".S_Y."' AND
		`iqtibosho`.`semestr` IN (2,4,6,8,10) AND 
		(`sarboriho`.`type` = 'lk_plan' OR `sarboriho`.`type` = 'kori_kursi' OR `sarboriho`.`type` = 'loihai_kursi')
		AND `sarboriho`.`id_teacher` = '$id_teacher'
		ORDER BY `iqtibosho`.`semestr`, `iqtibosho`.`id_fan`
		");
		
		$lessons_n2_2 = query("
			SELECT 
				`iqtibosho`.*,
				`sarboriho`.*
			FROM `iqtibosho`
			INNER JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
			WHERE  `iqtibosho`.`s_y` = '".S_Y."' AND
			`iqtibosho`.`semestr` IN (2,4,6,8,10) AND 
			`sarboriho`.`type` = 'am_plan' 
			AND `sarboriho`.`id_teacher` = '$id_teacher'
			AND `iqtibosho`.`id_fan` IN(606,634,1747,626,634,619)
			ORDER BY `iqtibosho`.`semestr`, `iqtibosho`.`id_fan`
			");
		
		
		
		$lessons_n_2 = array_merge($lessons_n2,$lessons_n2_2);	
		
	break;
	
}


?>