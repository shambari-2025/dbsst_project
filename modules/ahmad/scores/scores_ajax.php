<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "IMTstatus":
		$id = $_REQUEST['id'];
		$imt_status = $_REQUEST['set'];
		
		$fields = [
			'imt_status' => "$imt_status"
		];
		
		if(update("results", $fields, "`id` = '$id'", 1))
			echo true;
		else
			echo false;
		exit;
	break;
	
	case "getStudentList":
		$id_teacher = $_SESSION['user']['id'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		$title = $_REQUEST['title'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			$data = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data[0]['id_faculty'];
			$id_s_l = $data[0]['id_s_l'];
			$id_s_v = $data[0]['id_s_v'];
			$id_course = $data[0]['id_course'];
			$id_spec = $data[0]['id_spec'];
			$id_group = $data[0]['id_group'];
			$semestr = $data[0]['semestr'];
			$S_Y = $data[0]['s_y'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			$id_fan = $data[0]['id_fan'];
			
			$page_info['title'] = "Кушодани равзанаи ".$title;
			
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			include("ajax/getStudentList.php");
		}else{
			echo "Шумо барои дидани руйхати донишҷӯёни ин гуруҳ иҷозат надоред!!!";
		}
		
		exit;
	break;
	
	case "setAppellation":
		$score = $_REQUEST['score'];
		$id_student = $_REQUEST['id_student'];
		$id_fan = $_REQUEST['id_fan'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		
		$result = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' 
		AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
		
		$id = $result[0]['id'];
		$fields['imt_score'] = $result[0]['imt_score'] + $score;
		$fields['total_score'] = $result[0]['total_score'] + ($score/2);
		
		if(update("results", $fields, "`id` = '$id'", 1)){
			/*История*/
			$data['id_student'] = "'".clear_admin($id_student)."'";
			$data['id_fan'] = "'".clear_admin($id_fan)."'";
			
			$data['score_type'] = "'6'";
			
			if(isset($result[0]['imt_score'])){
				$data['old_score'] = "'".clear_admin($result[0]['imt_score'])."'";
			}else{
				$data['old_score'] = "'0'";
			}
			
			$data['new_score'] = "'".clear_admin($result[0]['imt_score'] + $score)."'";
			$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data['date'] = "'".clear_admin(date("d.m.y, H:i", time()))."'";
			
			$fields2 = array_keys($data);
			$data = implode(",", $data);
			insert("score_history", $fields2, $data);
			
			/*История*/
		}
		echo true;
		exit;
	break;
	
	case "getIMTScoreForm":
		$id_teacher = $_SESSION['user']['id'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		$title = $_REQUEST['title'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		$check_test = query("SELECT `imt_type` FROM `tests` WHERE `id_iqtibos` = '$id_iqtibos'");
		
		if($check_test[0]['imt_type'] == 1){
			echo "Ин фан тести мебошад!!!";
			exit;
		}
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			$data = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data[0]['id_faculty'];
			$id_s_l = $data[0]['id_s_l'];
			$id_s_v = $data[0]['id_s_v'];
			$id_course = $data[0]['id_course'];
			$id_spec = $data[0]['id_spec'];
			$id_group = $data[0]['id_group'];
			$semestr = $data[0]['semestr'];
			$S_Y = $data[0]['s_y'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_fan = $data[0]['id_fan'];
			
			$page_info['title'] = "Кушодани равзанаи ".$title;
			
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			
			
			include("ajax/getIMTScoreForm.php");
		}else{
			echo "Шумо барои холгузори ба ин фан иҷозат надоред!!!";
		}
		
		
		exit;
	break;
	
	case "getNFScoreForm":
		$id_teacher = $_SESSION['user']['id'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$rating = $_REQUEST['rating'];
		
		$title = $_REQUEST['title'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			$data = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data[0]['id_faculty'];
			$id_s_l = $data[0]['id_s_l'];
			$id_s_v = $data[0]['id_s_v'];
			$id_course = $data[0]['id_course'];
			$id_spec = $data[0]['id_spec'];
			$id_group = $data[0]['id_group'];
			$semestr = $data[0]['semestr'];
			$S_Y = $data[0]['s_y'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_fan = $data[0]['id_fan'];
			
			$page_info['title'] = "Кушодани равзанаи ".$title;
			
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			
			$setting = query("SELECT `score` FROM `tests_settings` WHERE `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '".H_Y."'");
			
			if(!empty($setting)){
				$max = $setting[0]['score'];
			}else{
				$max = 30;
			}
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			include("ajax/getNFScoreForm.php");
		}else{
			echo "Шумо барои холгузори ба ин фан иҷозат надоред!!!";
		}
		
		
		exit;
	break;
	
	case "getAddNBForm":
		$id_teacher = $_SESSION['user']['id'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$rating = $_REQUEST['rating'];
		
		$title = $_REQUEST['title'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			$data = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data[0]['id_faculty'];
			$id_s_l = $data[0]['id_s_l'];
			$id_s_v = $data[0]['id_s_v'];
			$id_course = $data[0]['id_course'];
			$id_spec = $data[0]['id_spec'];
			$id_group = $data[0]['id_group'];
			$semestr = $data[0]['semestr'];
			$S_Y = $data[0]['s_y'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_fan = $data[0]['id_fan'];
			
			$page_info['title'] = "Кушодани равзанаи ".$title;
			
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			
			$setting = query("SELECT `score` FROM `tests_settings` WHERE `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '".H_Y."'");
			
			if(!empty($setting)){
				$max = $setting[0]['score'];
			}else{
				$max = 30;
			}
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			include("ajax/getAddNBForm.php");
		}else{
			echo "Шумо барои холгузори ба ин фан иҷозат надоред!!!";
		}
		
		
		exit;
	break;
	
	
	case "getRatingScoreForm":
		$id_teacher = $_SESSION['user']['id'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$rating = $_REQUEST['rating'];
		
		$title = $_REQUEST['title'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			$data = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data[0]['id_faculty'];
			$id_s_l = $data[0]['id_s_l'];
			$id_s_v = $data[0]['id_s_v'];
			$id_course = $data[0]['id_course'];
			$id_spec = $data[0]['id_spec'];
			$id_group = $data[0]['id_group'];
			$semestr = $data[0]['semestr'];
			$S_Y = $data[0]['s_y'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_fan = $data[0]['id_fan'];
			
			$page_info['title'] = "Кушодани равзанаи ".$title;
			
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			
			$max = 50;
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			include("ajax/getRatingScoreForm.php");
		}else{
			echo "Шумо барои холгузори ба ин фан иҷозат надоред!!!";
		}
		
		
		exit;
	break;
	
	case "getNFScoreFormM2":
		$id_teacher = $_SESSION['user']['id'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$imt_type = $_REQUEST['imt_type'];
		
		$title = $_REQUEST['title'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			$data = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data[0]['id_faculty'];
			$id_s_l = $data[0]['id_s_l'];
			$id_s_v = $data[0]['id_s_v'];
			$id_course = $data[0]['id_course'];
			$id_spec = $data[0]['id_spec'];
			$id_group = $data[0]['id_group'];
			$semestr = $data[0]['semestr'];
			$S_Y = $data[0]['s_y'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_fan = $data[0]['id_fan'];
			
			$page_info['title'] = "Кушодани равзанаи ".$title;
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			include("ajax/getNFScoreFormM2.php");
		}else{
			echo "Шумо барои холгузори ба ин фан иҷозат надоред!!!";
		}
		exit;
	break;
	
	case "getKKScoreForm":
		$id_teacher = $_SESSION['user']['id'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		$title = $_REQUEST['title'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			$data = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data[0]['id_faculty'];
			$id_s_l = $data[0]['id_s_l'];
			$id_s_v = $data[0]['id_s_v'];
			$id_course = $data[0]['id_course'];
			$id_spec = $data[0]['id_spec'];
			$id_group = $data[0]['id_group'];
			$semestr = $data[0]['semestr'];
			$S_Y = $data[0]['s_y'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_fan = $data[0]['id_fan'];
			
			$page_info['title'] = "Кушодани равзанаи холгузории кори курсӣ ".$title;
			
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			include("ajax/getKKScoreForm.php");
		}else{
			echo "Шумо барои холгузори ба ин фан иҷозат надоред!!!";
		}
		
		
		exit;
	break;
	
	case "getILMScoreForm":
		$id_teacher = $_SESSION['user']['id'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		$title = $_REQUEST['title'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		//Санҷиш барои муайян фаҳмидан, ҳамин фан ба ҳамин омузгор дахл дорад ё не
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `id_teacher` = '$id_teacher'");
		
		if(!empty($check) || isset($_SESSION['user']['admin'])){
			$data = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id_iqtibos'");
			$id_faculty = $data[0]['id_faculty'];
			$id_s_l = $data[0]['id_s_l'];
			$id_s_v = $data[0]['id_s_v'];
			$id_course = $data[0]['id_course'];
			$id_spec = $data[0]['id_spec'];
			$id_group = $data[0]['id_group'];
			$semestr = $data[0]['semestr'];
			$S_Y = $data[0]['s_y'];
			
			if($semestr % 2 == 0){
				$H_Y = 2;
			}else $H_Y = 1;
			
			$id_fan = $data[0]['id_fan'];
			
			$page_info['title'] = "Кушодани равзанаи холгузории кори курсӣ ".$title;
			
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			include("ajax/getILMScoreForm.php");
		}else{
			echo "Шумо барои холгузори ба ин фан иҷозат надоред!!!";
		}
		
		
		exit;
	break;
	
	case "delete_result":
		$id = $_REQUEST['id'];
		
		$fields_update['imt_score'] = 'NULL';
		$fields_update['total_score'] = 'NULL';
		
		update("results", $fields_update, "`id` = '$id'");
		exit;
	break;
	
	case "update_results":
		$id = $_REQUEST['id'];
		$table = $_REQUEST['table'];
		$id_student = $_REQUEST['id_student'];
		$id_fan = @$_REQUEST['id_fan'];
		$value = $_REQUEST['value'];
		$field = $_REQUEST['field'];
		
		$semestr = $_REQUEST['c_semestr'];
		
		$id_course = getCourseBySemestr($semestr);
		$h_y = getNimsolaBySemestr($semestr);
		
		$std_info = query("SELECT * FROM `students` 
		WHERE `id_student` = '$id_student' AND `id_course` = '$id_course' AND `h_y` = '$h_y'");
		$id_faculty = $std_info[0]['id_faculty'];
		$id_s_l = $std_info[0]['id_s_l'];
		$id_s_v = $std_info[0]['id_s_v'];
		$id_course = $std_info[0]['id_course'];
		$id_spec = $std_info[0]['id_spec'];
		$id_group = $std_info[0]['id_group'];
		
		if($table == 'results'){
			$check = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `semestr` = '$semestr'");
			
			
			if(empty($check)){
				// insert
				if(!empty($id_faculty))
					$data_r['id_faculty'] = "'".clear_admin($id_faculty)."'";
				if(!empty($id_s_l))
					$data_r['id_s_l'] = "'".clear_admin($id_s_l)."'";
				if(!empty($id_s_v))
					$data_r['id_s_v'] = "'".clear_admin($id_s_v)."'";
				if(!empty($id_course))
					$data_r['id_course'] = "'".clear_admin($id_course)."'";
				if(!empty($id_spec))
					$data_r['id_spec'] = "'".clear_admin($id_spec)."'";
				if(!empty($id_group))
					$data_r['id_group'] = "'".clear_admin($id_group)."'";
				$data_r['id_student'] = "'".clear_admin($id_student)."'";
				$data_r['id_fan'] = "'".clear_admin($id_fan)."'";
				$data_r['type'] = "'1'";
				$data_r[$field] = "'".clear_admin($value)."'";
				
				$data_r['semestr'] = "'".$semestr."'";
				
				
				$fields_r = array_keys($data_r);
				$data_r = implode(",", $data_r);
				
				insert("results", $fields_r, $data_r);
				
				// insert
			}else{
				
				// update
				/*История*/
				
				$data['id_student'] = "'".clear_admin($id_student)."'";
				$data['id_fan'] = "'".clear_admin($id_fan)."'";
				if($field == 'nf_1_score'){
					$data['score_type'] = "'1'";
				}elseif($field == 'nf_1_absent'){
					$data['score_type'] = "'2'";
				}elseif($field == 'nf_1_score_r'){
					$data['score_type'] = "'3'";
				}elseif($field == 'nf_2_score'){
					$data['score_type'] = "'4'";
				}elseif($field == 'nf_2_absent'){
					$data['score_type'] = "'5'";
				}elseif($field == 'nf_2_score_r'){
					$data['score_type'] = "'6'";
				}elseif($field == 'imt_score'){
					$data['score_type'] = "'7'";
				}elseif($field == 'trimestr_score'){
					$data['score_type'] = "'8'";
				}elseif($field == 'total_score'){
					$data['score_type'] = "'9'";
				}
				
				if(isset($check[0][$field])){
					$data['old_score'] = "'".clear_admin($check[0][$field])."'";
				}else{
					$data['old_score'] = "'0'";
				}
				
				$data['new_score'] = "'".clear_admin($value)."'";
				$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
				$data['date'] = "'".clear_admin(date("d.m.y, H:i", time()))."'";
				
				$fields2 = array_keys($data);
				$data = implode(",", $data);
				insert("score_history", $fields2, $data, 1);
				/*История*/
				
				$id = $check[0]['id'];
				if($value == '')
					$fields[$field] = 'NULL';
				else
					$fields[$field] = $value;
				$fields['semestr'] = $semestr;
				if(update("results", $fields, "`id` = '$id'", 1)){
					$check_new = query("SELECT * FROM `results` WHERE `id` = '$id'");
					if($field != 'total_score'){
						$value = ($check_new[0]['nf_1_score'] + $check_new[0]['nf_1_absent'] + $check_new[0]['nf_1_score_r'] + $check_new[0]['nf_2_score'] + $check_new[0]['nf_2_absent'] + $check_new[0]['nf_2_score_r'])/ 2 * 0.6 + ($check_new[0]['imt_score'] * 0.4);
						$fields_update['total_score'] = $value;
					}else{
						$fields_update['total_score'] = $value;
					}
					update("results", $fields_update, "`id` = '$id'", 1);
				}
			}
		}elseif($table == 'dop_score') {
			$check = query("SELECT * FROM `dop_score` WHERE `id` = '$id'");
			
			if(empty($check)){
				
				$data_d['id_student'] = "'".clear_admin($id_student)."'";
				$data_d[$field] = "'".clear_admin($value)."'";
				$data_d['s_y'] = "'".clear_admin($s_y)."'";
				$data_d['h_y'] = "'".clear_admin($h_y)."'";
				
				$fields_d = array_keys($data_d);
				$data_d = implode(",", $data_d);
				
				insert("dop_score", $fields_d, $data_d, 1);
			}else{
				$fields[$field] = $value;
				update("dop_score", $fields, "`id` = '$id'");
			}
		}
		exit;
	break;
	
	
	
	
}


?>