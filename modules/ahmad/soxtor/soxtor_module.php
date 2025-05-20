<?php


switch($action){
	
	case "iq_problem":
		$s_y = $_REQUEST['s_y'];
		
		$departaments = query("SELECT * FROM `departaments` WHERE `s_y` = '".S_Y."' ORDER BY `title`");
		
		$iqtibosho = query("SELECT * FROM `iqtibosho` WHERE `s_y` = '$s_y' AND `id_departament` IS NULL
		ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`");
		
		$page_info['title'] = 'Иқтибосҳо: Проблема';
	break;
	
	case "sarbori":
		
		if(isset($_SESSION['user']['admin'])){
			$id_departament = $_REQUEST['id'];
		}
		else $id_departament = @$id_departament;
		
		
		if($_SESSION['user']['id'] == 1){
			$fan_list = query("
			SELECT 
				`iqtibosho`.*,
				`faculties`.`title` AS `faculty_title`,
				`faculties`.`short_title` AS `faculty_short`,
				`specialties`.`code` AS `spec_code`,
				`specialties`.`title_tj` AS `spec_title_tj`,
				`specialties`.`title_ru` AS `spec_title_ru`,
				`specialties`.`title_en` AS `spec_title_en`,
				`study_level`.`title` AS `s_l_title`,
				`study_view`.`title` AS `s_v_title`,
				`course`.`title` AS `course_title`,
				`groups`.`title` AS `group_title`,
				`fan_test`.`title_tj`,
				`sarboriho`.`id_teacher`,
				`users`.`fullname_tj` 
			FROM `iqtibosho` 
			
			INNER JOIN `faculties` ON `iqtibosho`.`id_faculty` = `faculties`.`id`
			INNER JOIN `specialties` ON `iqtibosho`.`id_spec` = `specialties`.`id`
			INNER JOIN `study_level` ON `iqtibosho`.`id_s_l` = `study_level`.`id`
			INNER JOIN `study_view` ON `iqtibosho`.`id_s_v` = `study_view`.`id`
			INNER JOIN `course` ON `iqtibosho`.`id_course` = `course`.`id`
			INNER JOIN `groups` ON `iqtibosho`.`id_group` = `groups`.`id`
			
			INNER JOIN `fan_test` ON `fan_test`.`id` = `iqtibosho`.`id_fan`
			
			LEFT JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
			LEFT JOIN `users` ON `users`.`id` = `sarboriho`.`id_teacher`
			
			WHERE 
			`iqtibosho`.`parent_group` IS NULL AND
			`iqtibosho`.`s_y` = '".S_Y."' AND 
			`iqtibosho`.`id_departament` = '$id_departament' 
			ORDER BY 
			`iqtibosho`.`id_course`, 
			`iqtibosho`.`semestr`, 
			`iqtibosho`.`id_s_l`, 
			`iqtibosho`.`id_s_v`, 
			`iqtibosho`.`id_fan`, 
			`iqtibosho`.`id_spec`, 
			`iqtibosho`.`id_group`, 
			`iqtibosho`.`id_fan`
			");
			
		}else{
			$fan_list = query("
			SELECT 
				`iqtibosho`.*,
				`faculties`.`title` AS `faculty_title`,
				`faculties`.`short_title` AS `faculty_short`,
				`specialties`.`code` AS `spec_code`,
				`specialties`.`title_tj` AS `spec_title_tj`,
				`specialties`.`title_ru` AS `spec_title_ru`,
				`specialties`.`title_en` AS `spec_title_en`,
				`study_level`.`title` AS `s_l_title`,
				`study_view`.`title` AS `s_v_title`,
				`course`.`title` AS `course_title`,
				`groups`.`title` AS `group_title`,
				`fan_test`.`title_tj`,
				`sarboriho`.`id_teacher`,
				`users`.`fullname_tj` 
			FROM `iqtibosho` 
			
			INNER JOIN `faculties` ON `iqtibosho`.`id_faculty` = `faculties`.`id`
			INNER JOIN `specialties` ON `iqtibosho`.`id_spec` = `specialties`.`id`
			INNER JOIN `study_level` ON `iqtibosho`.`id_s_l` = `study_level`.`id`
			INNER JOIN `study_view` ON `iqtibosho`.`id_s_v` = `study_view`.`id`
			INNER JOIN `course` ON `iqtibosho`.`id_course` = `course`.`id`
			INNER JOIN `groups` ON `iqtibosho`.`id_group` = `groups`.`id`
			
			INNER JOIN `fan_test` ON `fan_test`.`id` = `iqtibosho`.`id_fan`
			LEFT JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
			LEFT JOIN `users` ON `users`.`id` = `sarboriho`.`id_teacher`
			
			WHERE 
				`iqtibosho`.`parent_group` IS NULL AND
				`iqtibosho`.`s_y` = '".S_Y."' AND 
				`iqtibosho`.`id_departament` = '$id_departament' 
			ORDER BY 
			`iqtibosho`.`id_course`, 
			`iqtibosho`.`semestr`, 
			`iqtibosho`.`id_s_l`, 
			`iqtibosho`.`id_s_v`, 
			`iqtibosho`.`id_fan`, 
			`iqtibosho`.`id_spec`, 
			`iqtibosho`.`id_group`, 
			`iqtibosho`.`id_fan`
			");
		}
		
		$all_credits = count_summa_where("iqtibosho", "credits", "`id_departament` = '$id_departament' AND `s_y` = '".S_Y."'");
		
		
		//$query = "SELECT SUM(`soat`) FROM `$table`";
		
		$query = query("SELECT SUM(`iqtibosho`.`credits`) as `credits` FROM `iqtibosho`
		INNER JOIN `sarboriho` ON `sarboriho`.`id_iqtibos` = `iqtibosho`.`id`
		WHERE `iqtibosho`.`id_departament` = '$id_departament' AND `sarboriho`.`id_teacher` IS NOT NULL");
		
		$taqsimshuda = $query[0]['credits'];
		
		
		$teachers = query("SELECT * FROM `users` WHERE `id` IN 
		(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` = '$id_departament' AND `s_y` = '".S_Y."')
		ORDER BY `fullname_tj`");
		
		$page_info['title'] = 'Сарборӣ: '.getDepartament($id_departament);
	break;
	
	case "no_taqsim":
		/*
		if(isset($_SESSION['user']['admin'])){
			$id_departament = $_REQUEST['id'];
		}
		else $id_departament = @$id_departament;
		*/
		
		$fan_list = query("SELECT * FROM `iqtibosho` WHERE `id_departament` IS NOT NULL AND `id_fan` != 1748 AND `id` NOT IN (SELECT DISTINCT(`id_iqtibos`) FROM `sarboriho`)
		ORDER BY `id_s_l`, `id_s_v`");
		
		/*
		$teachers = query("SELECT * FROM `users` WHERE `id` IN 
		(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` = '$id_departament' AND `s_y` = '".S_Y."')
		ORDER BY `fullname_tj`");
		*/
		$page_info['title'] = 'Тақсимношудаҳо';
	break;
	
	case "member_list":
		
		if(isset($_SESSION['user']['admin'])){
			$id_departament = $_REQUEST['id'];
		}
		else $id_departament = $id_departament;
		
		$members = query("SELECT * FROM `users` WHERE `id` IN 
		(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` = '$id_departament' AND `s_y` = '".S_Y."')
		ORDER BY `fullname_tj`");
		
		$members = query("SELECT `users`.*, 
		`departaments_member`.`id` AS `member_id`, 
		`departaments_member`.`id_credits_table` AS `id_credits_table`, 
		`departaments_member`.`id_worker_type` AS `id_worker_type`,
		
		`credits_table`.`vazifa`,
		`credits_table`.`soat`,
		`credits_table`.`credit`
		FROM `users` 
		INNER JOIN `departaments_member` ON `departaments_member`.`id_teacher` = `users`.`id` AND `departaments_member`.`s_y` = '".S_Y."'
		LEFT JOIN `credits_table` ON `departaments_member`.`id_credits_table` = `credits_table`.`id`
		WHERE `departaments_member`.`id_departament` = '$id_departament'
		ORDER BY `users`.`fullname_tj`
		");
		
		
		$page_info['title'] = getDepartament($id_departament).': Руйхати омӯзгорҳо';
	break;
	
	case "delete_teacher":
		$id_departament=$_REQUEST['id_departament'];
		$id_teacher=$_REQUEST['id_teacher'];
		if(delete("departaments_member", "`id_departament`='$id_departament' AND `id_teacher`='$id_teacher' AND `s_y`='".S_Y."'")){
			redirect();
		}
	break;
	
	case "fan_list":
		if(!isset($_REQUEST['id']))
			$id_departament = $id_departament;
		else
			$id_departament = $_REQUEST['id'];
		
		
		//$fanho = select("fan", "*", "`id_departament` = '$id_departament'", "title_".LANG, false, "");
		
		$fanho = query("SELECT DISTINCT(`iqtibosho`.`id_fan`), `fan_test`.* 
		FROM `iqtibosho` 
		INNER JOIN `fan_test` ON `fan_test`.`id` = `iqtibosho`.`id_fan`
		WHERE `iqtibosho`.`id_departament` = '$id_departament' ORDER BY `fan_test`.`title_tj`");
		
		
		$page_info['title'] = getDepartament($id_departament).': Руйхати фанҳо';
		
	break;
	
	case "departaments_list":
		//$departaments = select("departaments", "*", "", "title", false, "");
		/*
		$departaments = query("
			SELECT `departaments`.*, COUNT(`fan_test`.`id`) as `fanho`
			FROM `departaments`
			LEFT JOIN `fan` ON `fan`.`id_departament` = `departaments`.`id`
			GROUP BY `departaments`.`id`, `departaments`.`title`
		");
		*/
		
		$departaments = query("SELECT `departaments`.*, COUNT(`departaments_member`.`id`) as `members`
		FROM `departaments`
		LEFT JOIN `departaments_member` ON `departaments_member`.`id_departament` = `departaments`.`id`
		AND `departaments_member`.`s_y` = `departaments`.`s_y`
		WHERE `departaments`.`s_y` = '".S_Y."' GROUP BY `departaments`.`id`, `departaments`.`title` 
		ORDER BY `departaments`.`id`");
		
		$page_info['title'] = 'Руйхати кафедраҳо';
	break;
	
	
	case "faculties_list":
		//$faculties = select("faculties", "*", "", "title", false, "");
		
		$faculties = query("SELECT `faculties`.*, `faculties_settings`.*, COUNT(`specialties`.`id`) as `specs` 
		FROM `faculties` 
		LEFT JOIN `specialties` ON `specialties`.`id_faculty` = `faculties`.`id`
		LEFT JOIN `faculties_settings` ON `faculties`.`id` = `faculties_settings`.`id_faculty`
		WHERE `faculties_settings`.`s_y` = '".S_Y."' AND `faculties_settings`.`h_y` = '".H_Y."'
		GROUP BY `faculties`.`id`, `faculties`.`title`, `faculties_settings`.`id`, `specialties`.`id_faculty`
		");
		
		$page_info['title'] = 'Руйхати факултетҳо';
	break;
	
	case "soxtor_list":
		function array_to_tree($array, $sub = 0){
			$a = array();
			foreach($array as $v) {
				if($sub == $v['pid']) {
					$b = array_to_tree($array, $v['id']);
					if(!empty($b)) {
						$a[$v['id']] = $v;
						$a[$v['id']]['children'] = $b;
					} else {
						$a[$v['id']] = $v;
					}
				}
			}
			return $a;
		}
		
		$data=query("SELECT * FROM `structure` WHERE `deleted` = '0' ORDER BY `pos`");
		
		$datas = array_to_tree($data);
		
		
		$page_info['title'] = 'Иeрархияи сохтори Донишгоҳ';
	break;
	
	case "soxtor_edit":
		$id = $_REQUEST['id'];
		$info = query("SELECT * FROM `structure` WHERE `id` = '$id'");
		$page_info['title'] = "Таҳриркунии сохтор";
	break;
	
	case "soxtor_update":
		$id = $_REQUEST['id'];
		$name = $_REQUEST['name'];
		$name_short_tj = $_REQUEST['name_short_tj'];
		$name_short_ru = $_REQUEST['name_short_ru'];
		$name_full_tj = $_REQUEST['name_full_tj'];
		$name_full_ru = $_REQUEST['name_full_ru'];
		$detail_tj = $_REQUEST['detail_tj'];
		$detail_ru = $_REQUEST['detail_ru'];
		unset($fields);
		$fields = array('name' => $name,
				'name_short_tj' => $name_short_tj,
				'name_short_ru' => $name_short_ru,
				'name_full_tj' => $name_full_tj,
				'name_full_ru' => $name_full_ru,
				'detail_tj' => $detail_tj,
				'detail_ru' => $detail_ru
				);
		if($id){
			update("structure", $fields, "`id` = '$id'", true);
		}
		redirect(MY_URL."?option=soxtor&action=soxtor_list");
	break;
	
	case "soxtor_add":
		$id = $_REQUEST['id'];
		$page_info['title'] = "Иловакунии сохтор";
	break;
	
	case "soxtor_insert":
		$id = $_REQUEST['id'];
		$table = "structure";
		$data['pid'] = "'".clear_admin($id)."'";
		$data['name'] = "'".clear_admin($_REQUEST['name'])."'";
		$data['name_short_tj'] = "'".clear_admin($_REQUEST['name_short_tj'])."'";
		$data['name_short_ru'] = "'".clear_admin($_REQUEST['name_short_ru'])."'";
		$data['name_full_tj'] = "'".clear_admin($_REQUEST['name_full_tj'])."'";
		$data['name_full_ru'] = "'".clear_admin($_REQUEST['name_full_ru'])."'";
		$data['detail_tj'] = "'".clear_admin($_REQUEST['detail_tj'])."'";
		$data['detail_ru'] = "'".clear_admin($_REQUEST['detail_ru'])."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);

		if($id){
			insert($table, $fields, $data);
		}		
		redirect(MY_URL."?option=soxtor&action=soxtor_list");
	break;
	
	case "soxtor_delete":
		$id = $_REQUEST['id'];
		if($id){
			delete("structure", "`id` = '$id'", true);
			//exit;
		}
		redirect(MY_URL."?option=soxtor&action=soxtor_list");
	break;
	
	case "specs_list":
		$id = $_REQUEST['id'];
		
		$specs = query("SELECT * FROM `specialties` WHERE `id_faculty` = '$id' ORDER BY `code`");
		$page_info['title'] = getFaculty($id).': Руйхати ихтисосҳо';
	break;
	
	case "facultet_insert":
		
		$data['title'] = "'".clear_admin($_REQUEST['title'])."'";
		$data['short_title'] = "'".clear_admin($_REQUEST['short_title'])."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		$id_faculty = insert("faculties", $fields, $data);
		
		
		unset($data, $data);
		
		$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
		$data['id_decan'] = "'".clear_admin($_REQUEST['id_decan'])."'";
		$data['s_y'] = "'".clear_admin(S_Y)."'";
		$data['h_y'] = "'".clear_admin(H_Y)."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		insert("faculties_settings", $fields, $data);
		
		redirect();
	break;
	
	case "facultet_updated":
		$id = $_REQUEST['id'];
		$fields = array('title' => $_REQUEST['title'], 'short_title' => $_REQUEST['short_title']);
		update("faculties", $fields, "`id` = '$id'");
		
		
		$id = $_REQUEST['id_faculty'];
		$fields = array('id_decan' => $_REQUEST['id_decan']);
		update("faculties_settings", $fields, "`id` = '$id'");
		
		
		$id = $_REQUEST['id'];
		redirect();
	break;
	
	case "spec_insert":
		$table = 'specialties';
		
		$data['id_faculty'] = "'".clear_admin($_REQUEST['id_faculty'])."'";
		$data['title_tj'] = "'".clear_admin($_REQUEST['title_tj'])."'";
		$data['title_ru'] = "'".clear_admin($_REQUEST['title_ru'])."'";
		$data['title_en'] = "'".clear_admin($_REQUEST['title_en'])."'";
		$data['code'] = "'".clear_admin($_REQUEST['code'])."'";
		$data['id_s_l'] = "'".clear_admin($_REQUEST['id_s_l'])."'";
		
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		insert($table, $fields, $data);
		redirect();
	break;
	
	case "spec_update":
		$id = $_REQUEST['id'];
		$fields['title_tj'] = $_REQUEST['title_tj'];
		$fields['title_ru'] = $_REQUEST['title_ru'];
		$fields['title_en'] = $_REQUEST['title_en'];
		$fields['code'] = $_REQUEST['code'];
		$fields['id_s_l'] = $_REQUEST['id_s_l'];
		
		if(update("specialties", $fields, "`id` = '$id'")){
			redirect();
		}
	break;
	
	case "departament_insert":
		$table = 'departaments';
		
		$data['title'] = "'".clear_admin($_REQUEST['title'])."'";
		if(!empty($_REQUEST['id_mudir']))
			$data['id_mudir'] = "'".clear_admin($_REQUEST['id_mudir'])."'";
		$data['s_y'] = "'".clear_admin(S_Y)."'";
		$data['h_y'] = "'".clear_admin(H_Y)."'";
		
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		insert($table, $fields, $data);
		redirect();
	break;
	
	case "departament_update":
		$id = $_REQUEST['id'];
		
		if(!empty($_REQUEST['title']))
			$fields['title'] = $_REQUEST['title'];
		if(!empty($_REQUEST['id_mudir']))
			$fields['id_mudir'] = $_REQUEST['id_mudir'];
		
		if(update("departaments", $fields, "`id` = '$id'")){
			redirect();
		}
	break;
	
	
	
	case "fan_insert":
		$table = 'fan';
		
		$data['id_departament'] = "'".clear_admin($_REQUEST['id_departament'])."'";
		$data['title_tj'] = "'".clear_admin($_REQUEST['title_tj'])."'";
		$data['title_ru'] = "'".clear_admin($_REQUEST['title_ru'])."'";
		$data['title_en'] = "'".clear_admin($_REQUEST['title_en'])."'";
		
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		insert($table, $fields, $data);
		redirect();
	break;
	
	case "fan_update":
		$id = $_REQUEST['id'];
		$fields['id_departament'] = $_REQUEST['id_departament'];
		$fields['title_tj'] = $_REQUEST['title_tj'];
		$fields['title_ru'] = $_REQUEST['title_ru'];
		$fields['title_en'] = $_REQUEST['title_en'];
		
		if(update("fan", $fields, "`id` = '$id'")){
			redirect();
		}
	break;
	
	case "dep_member_insert":
		$table = 'departaments_member';
		
		$data['id_teacher'] = "'".clear_admin($_REQUEST['id_teacher'])."'";
		$data['id_departament'] = "'".clear_admin($_REQUEST['id_departament'])."'";
		$data['id_credits_table'] = "'".clear_admin($_REQUEST['id_credits_table'])."'";
		$data['id_worker_type'] = "'".clear_admin($_REQUEST['id_worker_type'])."'";
		$data['s_y'] = "'".clear_admin(S_Y)."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		insert($table, $fields, $data);
		redirect();
	break;
	
	case "dep_member_update":
		$id = $_REQUEST['id'];
		$fields['id_teacher'] = $_REQUEST['id_teacher'];
		$fields['id_credits_table'] = $_REQUEST['id_credits_table'];
		$fields['id_worker_type'] = $_REQUEST['id_worker_type'];
		
		if(update("departaments_member", $fields, "`id` = '$id'")){
			redirect();
		}
		
		
	break;
	
	case "insert_kk":
		$teachers = $_REQUEST['teacher'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$soatho = $_REQUEST['soatho'];
		$type_kk = $_REQUEST['type_kk'];
		$i = 0;
		foreach($teachers as $item){
			$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `type` = '$type_kk' AND `id_teacher` ='$item'");
			if(empty($check)){	
				unset($data, $fields);
				$data['id_iqtibos'] = "'".clear_admin($id_iqtibos)."'";
				$data['type'] = "'$type_kk'";
				$data['soat'] = "'".clear_admin($_REQUEST['soat'][$i])."'";
				$data['id_teacher'] = "'".clear_admin($item)."'";
				$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
				$data['date_add'] = "'".date("d.m.Y, H:i:s", time())."'";
				$data['s_y'] = "'".clear_admin(S_Y)."'";
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				insert("sarboriho", $fields, $data, true);
			}else{
				unset($fields);
				$fields['id_teacher'] = $item;
				$fields['editor'] = $_SESSION['user']['id'];
				$fields['date_update'] = date("d.m.Y, H:i:s", time());
				
				update("sarboriho", $fields, "`id` = '{$check[0]['id']}' AND `type`= '$type'", 1);
			}
			$i++;
		}
		redirect();
	break;
	
	case "clean_kk":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$type_kk = $_REQUEST['type_kk'];
		if($id_iqtibos){
			delete("sarboriho", "`id_iqtibos` = '$id_iqtibos' AND `type` = '$type_kk'", 1);
			redirect();
		}
	break;
	
	
}


?>