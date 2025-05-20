<?php


switch($action){
	
	case "add_student":
		
		$faculties = select("faculties", "*", "", "id", false, "");
		$studylevels = select("study_level", "*", "", "id", false, "");
		$countries = select("countries", "*", "", "id", false, "");
		
		$studytypes = select("study_type", "*", "", "id", false, "");
		$studyviews = select("study_view", "*", "", "id", false, "");
		$courses = select("course", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "id", false, "");
		$vazi_oilavi = select("vazi_oilavi", "*", "", "id", false, "");
		$nations = select("nations", "*", "", "id", false, "");
		
		$page_info['title'] = 'Барқароркунии донишҷӯ';
	break;
	
	
	case "insert_student":
		$page_info['title'] = "Барқароркунии донишҷӯ: ".$_REQUEST['fullname'];
		
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		$table = "users";
		$data['fullname_tj'] = "'".clear_admin($_REQUEST['fullname'])."'";
		$data['fullname_ru'] = "'".clear_admin($_REQUEST['fullname_ru'])."'";
		$data['birthday'] = "'".clear_admin($_REQUEST['birthday'])."'";
		$data['jins'] = "'".clear_admin($_REQUEST['jins'])."'";
		$data['login'] = "'".clear_admin($_REQUEST['login'])."'";
		$data['password'] = "'".clear_admin($_REQUEST['password'])."'";
		if(!empty($_REQUEST['email']))
			$data['email'] = "'".clear_admin($_REQUEST['email'])."'";
		if(!empty($_REQUEST['phone']))
			$data['phone'] = "'".clear_admin($_REQUEST['phone'])."'";
		if(!empty($_REQUEST['parent_phone']))
			$data['phone_parents'] = "'".clear_admin($_REQUEST['parent_phone'])."'";
		$data['v_ijtimoi'] = "'".clear_admin($_REQUEST['vazi_ijtimoi'])."'";
		$data['from_family'] = "'".clear_admin($_REQUEST['az_oilai_ki'])."'";
		$data['v_oilavi'] = "'".clear_admin($_REQUEST['vazi_oilavi_form'])."'";
		$data['family_info'] = "'".clear_admin($_REQUEST['family_info'])."'";
		
		if(!empty($_REQUEST['xobgoh']))
			$data['xobgoh'] = "'".clear_admin(1)."'";
		
		if(!empty($_REQUEST['unvoni_harbi']))
			$data['unvoni_harbi'] = "'".clear_admin($_REQUEST['unvoni_harbi'])."'";
		
		if(!empty($_REQUEST['lashkar']))
			$data['lashkar'] = "'".clear_admin($_REQUEST['lashkar'])."'";
		
		$data['access'] = 1;
		$data['access_type'] = 3;
		$data['added_by'] = "'".$_SESSION['user']['id']."'";
		$data['added_time'] = "'".date("d.m.Y, H:i:s", time())."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		
		if($id_student = insert($table, $fields, $data)){
			/*PASSPORT DATAS*/
			$table = "user_passports";
			$passport_data['id_user'] = "'".clear_admin($id_student)."'";
			$passport_data['number'] = "'".clear_admin($_REQUEST['number_passport'])."'";
			$passport_data['date'] = "'".clear_admin($_REQUEST['sanai_dodani_passport'])."'";
			$passport_data['maqomot'] = "'".clear_admin($_REQUEST['maqomot'])."'";
			$passport_data['id_country'] = "'".clear_admin($_REQUEST['id_country'])."'";
			$passport_data['id_nation'] = "'".clear_admin($_REQUEST['id_nation'])."'";
			if(!empty($_REQUEST['id_region']))
				$passport_data['id_region'] = "'".clear_admin($_REQUEST['id_region'])."'";
			
			if(!empty($_REQUEST['id_district']))
				$passport_data['id_district'] = "'".clear_admin($_REQUEST['id_district'])."'";
			$passport_data['address'] = "'".clear_admin($_REQUEST['current_address'])."'";
			
			$passport_fields = array_keys($passport_data);
			$passport_data = implode(",", $passport_data);
			
			insert($table, $passport_fields, $passport_data);
			/*PASSPORT DATAS*/
			
			/*USER EDUCATION*/
			$table = "user_udecation";
			$edu_data['id_user'] = "'".clear_admin($id_student)."'";
			$edu_data['id_khatm_namud'] = "'".clear_admin($_REQUEST['xatm_namud'])."'";
			$edu_data['id_hujjat'] = "'".clear_admin($_REQUEST['hujjati_xatm'])."'";
			$edu_data['soli_xatm'] = "'".clear_admin($_REQUEST['soli_xatm'])."'";
			$edu_data['silsila'] = "'".clear_admin($_REQUEST['silsila'])."'";
			$edu_data['number_hujjat'] = "'".clear_admin($_REQUEST['number_hujjat'])."'";
			$edu_data['date_hujjat'] = "'".clear_admin($_REQUEST['date_hujjat'])."'";
			$edu_data['number_scholl'] = "'".clear_admin($_REQUEST['number_scholl'])."'";
			$edu_data['spec'] = "'".clear_admin($_REQUEST['spec'])."'";
			
			if(!empty($_REQUEST['muasisa_name']))
				$edu_data['muasisa_name'] = "'".clear_admin($_REQUEST['muasisa_name'])."'";
			$edu_data['muasisa_lang'] = "'".clear_admin($_REQUEST['muasisa_lang'])."'";
			
			$edu_fields = array_keys($edu_data);
			$edu_data = implode(",", $edu_data);
			insert($table, $edu_fields, $edu_data);
			/*USER EDUCATION*/
			
			/*MMT INFORMATION*/
			
			$table = "student_mmt_information";
			$mmt_data['id_student'] = "'".clear_admin($id_student)."'";
			if(!empty($_REQUEST['number_mmt']))
				$mmt_data['number_mmt'] = "'".clear_admin($_REQUEST['number_mmt'])."'";
			
			if(!empty($_REQUEST['score_mmt']))
				$mmt_data['total_score_mmt'] = "'".clear_admin(floatval($_REQUEST['score_mmt']))."'";
			
			$mmt_data['davri_qabul_mmt'] = "'10'";
			$mmt_fields = array_keys($mmt_data);
			$mmt_data = implode(",", $mmt_data);
			insert($table, $mmt_fields, $mmt_data);
			
			/*MMT INFORMATION*/
			
			$table = "students";
			$counter = 1;
			foreach($_REQUEST['semestr'] as $key => $value){
				
				unset($data, $fields);
				$explode = explode("_", $value);	
				$S_Y = $explode[0];
				$H_Y = $explode[1];
				
				$data['status'] = "'".clear_admin("1")."'";
				$data['id_student'] = "'".clear_admin($id_student)."'";
				$data['id_faculty'] = "'".clear_admin($_REQUEST['id_faculty'])."'";
				$data['id_s_l'] = "'".clear_admin($_REQUEST['id_s_l'])."'";
				
				$data['id_spec'] = "'".clear_admin($_REQUEST['id_spec'])."'";
				$data['id_s_v'] = "'".clear_admin($_REQUEST['id_s_v'])."'";
				
				if($_REQUEST['foreign'])
					$data['foreign'] = "'1'";
				
				$data['id_course'] = "'".clear_admin($_REQUEST['id_course'])."'";
				$data['id_group'] = "'".clear_admin($_REQUEST['id_group'])."'";
				$data['id_s_t'] = "'".clear_admin($_REQUEST['id_s_t'])."'";
				$data['vazi_oilavi'] = "'".clear_admin($_REQUEST['vazi_oilavi'])."'";
				
				$data['s_y'] = $S_Y;
				$data['h_y'] = $H_Y;
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				if(insert($table, $fields, $data)){
					/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
					isGroupIsset($_REQUEST['id_faculty'], $_REQUEST['id_course'], $_REQUEST['id_spec'], $_REQUEST['id_group'], $_REQUEST['id_s_l'], $_REQUEST['id_s_v'], $S_Y, $H_Y);
					/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
				}
				$counter++;
			}
			
			if($_FILES['photo']['name']){
				$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['photo']['name'])); // расширение картинки
				$baseimgName = "{$id_student}.{$baseimgExt}";
				$baseimgTmpName = $_FILES['photo']['tmp_name'];
				if(move_uploaded_file($baseimgTmpName, "../userfiles/students/$baseimgName")){
					$fields = array('photo' => $baseimgName);
					update("users", $fields, "`id` = '$id_student'");
				}
			}
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			redirect(MY_URL."?option=bugalteria&action=list&id_faculty={$_REQUEST['id_faculty']}&id_s_l={$_REQUEST['id_s_l']}&id_s_v={$_REQUEST['id_s_v']}&id_course={$_REQUEST['id_course']}&id_spec={$_REQUEST['id_spec']}&id_group={$_REQUEST['id_group']}");	
		}
	break;
	
	case "update_student":
		
		$id_student = $_REQUEST['id_student'];
		
		
		/*MMT INFORMATION*/
		$check = query("SELECT * FROM `student_mmt_information` WHERE `id_student` = '$id_student'");
		if(!empty($check)){
			$fields_mmt['davri_qabul_mmt'] = 9;
			update("student_mmt_information", $fields_mmt, "`id_student` = '$id_student'");
		}
		/*MMT INFORMATION*/
		
		/* STUDENTS */
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		
		$fields_student['id_faculty'] = $_REQUEST['id_faculty'];
		$fields_student['id_s_l'] = $_REQUEST['id_s_l'];
		$fields_student['id_spec'] = $_REQUEST['id_spec'];
		$fields_student['id_s_v'] = $_REQUEST['id_s_v'];
		$fields_student['id_course'] = $_REQUEST['id_course'];
		$fields_student['id_group'] = $_REQUEST['id_group'];
		$fields_student['id_s_t'] = $_REQUEST['id_s_t'];
		
		if(update("students", $fields_student, "`id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")){
			/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
			isGroupIsset($_REQUEST['id_faculty'], $_REQUEST['id_course'], $_REQUEST['id_spec'], $_REQUEST['id_group'], $_REQUEST['id_s_l'], $_REQUEST['id_s_v'], $S_Y, $H_Y);
			/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
		}
		
		/*Маълумотҳои пешинаи донишҷӯ*/
		$student_info = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$old_id_faculty = $student_info[0]['id_faculty'];
		$old_id_s_l = $student_info[0]['id_s_l'];
		$old_id_s_v = $student_info[0]['id_s_v'];
		$old_id_course = $student_info[0]['id_course'];
		$old_id_spec = $student_info[0]['id_spec'];
		$old_id_group = $student_info[0]['id_group'];
		$old_id_s_t = $student_info[0]['id_s_t'];
		/*Маълумотҳои пешинаи донишҷӯ*/
		
		/*Муайян мекунем ки дар гурух чанд донишҷуи дигар боқи мемонад*/
		$info_group = query("SELECT COUNT(`id`) as `count` FROM `students` WHERE 
		`id_faculty` = '$old_id_faculty' AND 
		`id_s_l` = '$old_id_s_l' AND 
		`id_s_v` = '$old_id_s_v' AND 
		`id_course` = '$old_id_course' AND 
		`id_spec` = '$old_id_spec' AND 
		`id_group` = '$old_id_group' AND 
		`s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		/*Муайян мекунем ки дар гурух чанд донишҷуи дигар боқи мемонад*/
		
		
		/*Агар ҳамин донишҷӯ ягона донишҷуи гурух бошад пас аз контингенти гуруххо нест мекунем гурухро*/
		if($info_group[0]['count'] == 0){
			unset($_SESSION['superarr'][$old_id_faculty]["level"][$old_id_s_l]["view"][$old_id_s_v]["course"][$old_id_course]['spec'][$old_id_spec]['groups'][$old_id_group]);
			delete("std_study_groups", "
			`id_faculty` = '$old_id_faculty' AND 
			`id_s_l` = '$old_id_s_l' AND 
			`id_s_v` = '$old_id_s_v' AND
			`id_course` = '$old_id_course' AND 
			`id_spec` = '$old_id_spec' AND 
			`id_group` = '$old_id_group' AND 
			`s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		}
		redirect();	
		/*Агар ҳамин донишҷӯ ягона донишҷуи гурух бошад пас аз контингенти гуруххо нест мекунем гурухро*/
		/* STUDENTS */
		
	break;
	
	
	
	
	
	case "list_bugalteria":
		
		if(isset($_REQUEST['letter'])){
			$q = "WHERE `fio` LIKE '".mb_strtolower($_REQUEST['letter'])."%'";
			$page_info['title'] = 'Хатмкунандагон: '.$_REQUEST['letter'];
			
			$students = query("SELECT * FROM `users_2` $q ORDER BY `fio`");
		} else {
			
			if(isset($_REQUEST['page'])){
				$page = $_REQUEST['page'];
			}else $page = 1;
			
			$perpage = 50;
			$count_all = count_table_where("users_2", "");
			$pages_count = ceil($count_all / $perpage);
			
			if(!$pages_count) $pages_count = 1; 
			
			if($page > $pages_count) {
				$page = $pages_count; 
				redirect(MY_URL."?option=bugalteria&action=list_bugalteria");
			}
			
			$start_pos = ($page - 1) * $perpage;
			
			
			$students = query("SELECT * FROM `users_2` ORDER BY `fio` LIMIT $start_pos, $perpage");
			
			$page_info['title'] = "Хатмкунандагон саҳифаи $page аз $pages_count";
		}
		
	break;
	
	
	case "list_khobgoh":
		if(isset($_REQUEST['letter'])){
			$q = " AND `fullname_tj` LIKE '".$_REQUEST['letter']."%'";
			$page_info['title'] = 'Истиқоматкунандагон: '.$_REQUEST['letter'];
		} else {
			$q = '';
			$page_info['title'] = 'Истиқоматкунандагон';
		}
		
		$teachers = query("SELECT `users`.*, `khobgoh`.`id_khobgoh`, `khobgoh`.`number_home` FROM `users` 
		INNER JOIN `khobgoh` ON `khobgoh`.`id_user` = `users`.`id`
		WHERE `access_type` IN (3,6,2)  $q ORDER BY `access_type`, `fullname_tj`");
		
	break;
	
	case "op_check":
		$id = $_REQUEST['id'];
		$type = @$_REQUEST['type'];
		$fields['payed'] = 1;
		$fields['payed_date'] = date("Y-m-d H:i:s");
		$fields['payed_author'] = $_SESSION['user']['id'];
		
		update("rasidho", $fields, "`id` = '$id'");
		redirect();
	break;
	
	case "op_checkinbank":
		$id = $_REQUEST['id'];
		$type = @$_REQUEST['type'];
		$fields['bank'] = 1;
		$fields['payed'] = 1;
		$fields['payed_date'] = date("Y-m-d H:i:s");
		$fields['payed_author'] = $_SESSION['user']['id'];
		
		update("rasidho", $fields, "`id` = '$id'");
		redirect();
	break;
	
	case "delete_check":
		$id = $_REQUEST['id'];
		delete("rasidho", "`id` = '$id'");
		redirect();
	break;
	
	case "add":
		if(MY_URL == URL.'admin/'){
			$faculties = select("faculties", "*", "", "id", false, "");
			$studylevels = select("study_level", "*", "", "id", false, "");
			$countries = select("countries", "*", "", "id", false, "");
			
		}else{
			if($bugaltaria_module[0]['id_faculties'] == 'ALL'){
				$where = "";
			}else {
				$where = "WHERE `id` IN ({$bugaltaria_module[0]['id_faculties']})";
			}
			
			$faculties = query("SELECT * FROM `faculties` $where ORDER BY `id`");
			
			
			if($bugaltaria_module[0]['id_s_l'] == 'ALL'){
				$where = "";
			}else {
				$where = "WHERE `id` IN ({$bugaltaria_module[0]['id_s_l']})";
			}
			
			$studylevels = query("SELECT * FROM `study_level` $where ORDER BY `id`");
			
		}
		
		
		
		$page_info['title'] = 'Иловакунии хатмкунанда';
	break;
	
	
	
	case "insert":
	
		$page_info['title'] = "Иловакунии User_2: ".$_REQUEST['fullname'];
		
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		$table = "users_2";
		$data['fio'] = "'".clear_admin($_REQUEST['fullname'])."'";
		$data['type'] = "'".clear_admin($_REQUEST['type'])."'";
	
		$data['log'] = "'".clear_admin($_REQUEST['login'])."'";
		$data['pass'] = "'".clear_admin($_REQUEST['password'])."'";
		
		
		$data['ac'] = 22;
		
		$data['level'] = 4;
		$user2_fields = array_keys($data);
		$user2_data = implode(",", $data);
		
		insert($table, $user2_fields, $user2_data);
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		redirect(MY_URL."?option=bugalteria&action=add");	
	break;
	
	case "commission":
		/* Баровардани контингенти гурух */
		$dovtalabs = query("SELECT 
			`rasidho`.`id` as `id_check`, 
			`rasidho`.`type` as `type_check`, 
			`rasidho`.`check_money` as `money_check`, 
			`rasidho`.`check_date` as `check_date`, 
		
		`students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		INNER JOIN `rasidho` ON `rasidho`.`id_student` = `users`.`id` AND `rasidho`.`payed` = '0'
		WHERE  `students`.`status` = '1' 
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		ORDER BY `rasidho`.`id` DESC
		");
		
		// AND `rasidho`.`check_date` = '".date("Y-m-d")."'
		/* Баровардани контингенти гурух */
		
		$page_info['title'] = 'Пардохт барои комисияи қабул';
	break;
	
	
	case "create_check":
		$id_student = $_REQUEST['id_student'];
		
		/*RASID*/
		$table = "rasidho";
		$rasid_data['type'] =  $_REQUEST['type'];
		$rasid_data['id_student'] = "'".clear_admin($id_student)."'";
		$rasid_data['check_date'] = "'".clear_admin(date("Y-m-d"))."'";
		$rasid_data['check_money'] = "'".clear_admin($_REQUEST['check_money'])."'";
		$rasid_data['s_y'] = "'".clear_admin(S_Y)."'";
		$rasid_data['author'] = "'".$_SESSION['user']['id']."'";
		
		$rasid_fields = array_keys($rasid_data);
		$rasid_data = implode(",", $rasid_data);
		insert($table, $rasid_fields, $rasid_data);
		/*RASID*/
		
		redirect();
	break;
	
	case "insert_hisob_varaqa":
		$id_student = $_REQUEST['id_student'];
		
		/*RASID*/
		$table = "rasidho";
		$rasid_data['type'] = 2;
		$rasid_data['id_student'] = "'".clear_admin($id_student)."'";
		$rasid_data['payed_from'] = "'".clear_admin($_REQUEST['payed_from'])."'";
		$rasid_data['check_date'] = "'".clear_admin($_REQUEST['check_date'])."'";
		$rasid_data['payed_date'] = "'".clear_admin(date("Y-m-d"))."'";
		$rasid_data['check_money'] = "'".clear_admin($_REQUEST['check_money'])."'";
		$rasid_data['payed'] = "'".clear_admin(1)."'";
		$rasid_data['bank'] = "'".clear_admin(1)."'";
		$rasid_data['s_y'] = "'".clear_admin(S_Y)."'";
		$rasid_data['author'] = "'".$_SESSION['user']['id']."'";
		
		$rasid_fields = array_keys($rasid_data);
		$rasid_data = implode(",", $rasid_data);
		insert($table, $rasid_fields, $rasid_data);
		/*RASID*/
		
		redirect();
	break;
	
	case "hissobot_kassa":
		
		$shartnoma_inkassa = count_summa_where("rasidho", "check_money", "`type` = '2' AND `payed` = '1' AND `bank` IS NULL");
		$shartnoma_inbank = count_summa_where("rasidho", "check_money", "`type` = '2' AND `payed` = '1' AND `bank` = '1'");
		$hujjat = count_summa_where("rasidho", "check_money", "`type` = '1' AND `payed` = '1'");
		
		
		$date = date("d.m.Y");
		
		/*------------------------------*/
		if(isset($_REQUEST['page'])){
			$page = $_REQUEST['page'];
		}else $page = 1;
		
		$perpage = 50;
		$count_all = count_table_where("rasidho", "`payed` = '1'");
		$pages_count = ceil($count_all / $perpage);
		
		if(!$pages_count) $pages_count = 1; 
		
		if($page > $pages_count) {
			$page = $pages_count; 
			redirect(MY_URL."?option=kassa&action=hissobot_kassa");
		}
		
		$start_pos = ($page - 1) * $perpage;
		
		
		/* Баровардани контингенти гурух */
		$dovtalabs = query("SELECT 
			`rasidho`.`id` as `id_check`, 
			`rasidho`.`type` as `type_check`, 
			`rasidho`.`bank` as `bank`, 
			`rasidho`.`check_money` as `money_check`, 
			`rasidho`.`check_date` as `check_date`, 
		
		`students`.*, `users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		INNER JOIN `rasidho` ON `rasidho`.`id_student` = `users`.`id` AND `rasidho`.`payed` = '1'
		WHERE  `students`.`status` = '1' OR `students`.`status` = '-1'
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		ORDER BY `rasidho`.`id` DESC LIMIT $start_pos, $perpage
		");
		
		// AND `rasidho`.`check_date` = '".date("Y-m-d")."'
		/* Баровардани контингенти гурух */
		
		$page_info['title'] = "Пардохт барои комисияи қабул: саҳифаи $page аз $pages_count";
	break;
	
	
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		
		$students = getContingent("1", $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		$page_info['title'] = 'Бугалтерия / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group);
	break;
	
	
	
	case "qabul":
		$list = query("SELECT * FROM `qabul_plan` ORDER BY `id`");
		$page_info['title'] = 'Нақшаҳои қабул';
	break;
	
	case "detail":
		$id = $_REQUEST['id'];
		
		$info = query("SELECT * FROM `qabul_plan` WHERE `id` = '$id'");
		$s_y = $info[0]['s_y'];
		$page_info['title'] = 'Нақшаи қабули соли '.getStudyYear($s_y);
		
		$naqsha_details = query("SELECT * FROM `qabul_plan_detail` WHERE `id_qabul_plan` = '$id' ORDER BY `id_spec`, `id_s_l`");
		
	break;
	
	
	case "addData":
		$id = $_REQUEST['id'];
		for($i=0; $i < count($_REQUEST['id_spec']); $i++){
			unset($data, $fields);

			$data['id_qabul_plan'] = $id;
			
			$data['id_spec'] = "'".clear_admin($_REQUEST['id_spec'][$i])."'";
			$data['id_s_l'] = "'".clear_admin($_REQUEST['id_s_l'][$i])."'";
			$data['id_s_v'] = "'".clear_admin($_REQUEST['id_s_v'][$i])."'";
			$data['id_s_t'] = "'".clear_admin($_REQUEST['id_s_t'][$i])."'";
			
			if($_REQUEST['money'][$i])
				$data['money'] = "'".clear_admin($_REQUEST['money'][$i])."'";
			
			if($_REQUEST['money_other'][$i])
				$data['money_other'] = "'".clear_admin($_REQUEST['money_other'][$i])."'";
			
			$data['lang'] = "'".clear_admin($_REQUEST['lang'][$i])."'";
			$data['plan'] = "'".clear_admin($_REQUEST['plan'][$i])."'";
			
			
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			insert("qabul_plan_detail", $fields, $data);
		}
		
		redirect();
	break;
	
	case "deleteitem":
		$id = $_REQUEST['id'];
		
		delete('qabul_plan_detail', "`id` = '$id'");
		redirect();
	break;
	
	
}


?>