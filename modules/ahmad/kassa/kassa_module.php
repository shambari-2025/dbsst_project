<?php


switch($action){
	
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
	
	
	case "commission":
		/* Баровардани контингенти гурух */
		$dovtalabs = query("SELECT 
			`rasidho`.`id` as `id_check`, 
			`rasidho`.`type` as `type_check`, 
			`rasidho`.`check_money` as `money_check`, 
			`rasidho`.`check_date` as `check_date`, 
		
		`users`.* FROM `users`
		INNER JOIN `rasidho` ON `rasidho`.`id_student` = `users`.`id` AND `rasidho`.`payed` = '0'
		ORDER BY `rasidho`.`id` DESC
		");
		
		$page_info['title'] = 'Руйхати расидҳо барои пардохт';
	break;
	
	case "list_xatmkunandagon":
		/* Баровардани контингенти гурух */
		$xatmkunandagon = query("SELECT 
			`rasidho`.`id` as `id_check`, 
			`rasidho`.`type` as `type_check`, 
			`rasidho`.`check_money` as `money_check`, 
			`rasidho`.`check_date` as `check_date`, 
		
		`users_2`.* FROM `users_2`
		INNER JOIN `rasidho` ON `rasidho`.`id_student` = `users_2`.`id` AND `rasidho`.`payed` = '0'
		ORDER BY `rasidho`.`id` DESC
		");
		
		// AND `rasidho`.`check_date` = '".date("Y-m-d")."'
		/* Баровардани контингенти гурух */
		
		$page_info['title'] = 'Пардохти хатмкунандагон';
	break;
	
	case "hissobot_kassa":
		
		$faculties = query("SELECT * FROM `faculties` ORDER BY `id`");
		$hujjat = count_summa_where("rasidho", "check_money", "`type` = '1' AND `payed` = '1'");
		
		$shartnoma_inkassa = count_summa_where("rasidho", "check_money", "`type` = '2' AND `payed` = '1' AND `bank` IS NULL");
		
		$trimestr = count_summa_where("rasidho", "check_money", "`type` = '3' AND `payed` = '1'");
		$farqiyat = count_summa_where("rasidho", "check_money", "`type` = '4' AND `payed` = '1'");
		$xobgoh = count_summa_where("rasidho", "check_money", "`type` = '5' AND `payed` = '1'");
		
		$total = count_summa_where("rasidho", "check_money", "`payed` = '1'");
		
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
		/*
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
		*/
		/* Баровардани контингенти гурух */
		$dovtalabs = query("SELECT 
			`rasidho`.`id` as `id_check`, 
			`rasidho`.`type` as `type_check`, 
			`rasidho`.`bank` as `bank`, 
			`rasidho`.`check_money` as `money_check`, 
			`rasidho`.`check_date` as `check_date`, 
		
		`users`.* FROM `users`
		INNER JOIN `rasidho` ON `rasidho`.`id_student` = `users`.`id` AND `rasidho`.`payed` = '1'
		ORDER BY `rasidho`.`id` DESC LIMIT $start_pos, $perpage
		");
		
		// AND `rasidho`.`check_date` = '".date("Y-m-d")."'
		/* Баровардани контингенти гурух */
		
		$page_info['title'] = "Расидҳои пардохтшуда: саҳифаи $page аз $pages_count";
	break;
	
	
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		
		$students = getContingent(-1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		$page_info['title'] = 'Донишҷӯён '.getStudyView($id_s_v).' '.getCourse($id_course).' '.getSpecialtyCode($id_spec).' '.getGroup($id_group);
		
	break;
	
	
	case "creat_check":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		
		$students = getContingent(-1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		$page_info['title'] = 'Донишҷӯён '.getStudyView($id_s_v).' '.getCourse($id_course).' '.getSpecialtyCode($id_spec).' '.getGroup($id_group);
		
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