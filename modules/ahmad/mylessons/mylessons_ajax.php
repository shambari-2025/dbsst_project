<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "getZhurnalForm":
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
			
			$v = date("w");
			
			// $datas = query("SELECT * FROM `jd` WHERE `ruz` = '$v' AND `id_fan` = '$id_fan' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' ORDER BY `soat`");
			
			// if(empty($datas)){
				// exit("Шумо имрӯз дарс надоред!");
			// }
			
			$datas = [];
			
			$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);
			include("ajax/getZhurnalForm.php");
		}else{
			echo "Шумо барои кушодани ин журнал иҷозат надоред!!!";
		}
		
		exit;
	break;
	
	case "getSpecs":
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_course = $_REQUEST['id_course'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		$specs = query("
		SELECT * FROM `specialties` WHERE `id` IN
		(SELECT `id_spec` FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty'
		AND `id_course` = '$id_course' AND `s_y` = '$s_y' AND `h_y` = '$h_y')
		");
		
		include("ajax/specsforfaculty.php");
		exit;
	break;
	
	
	case "getFanFromNT":
		
		$id_faculty = $_REQUEST['id_faculty'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		
		if(!empty($id_spec)){
			$info = query("SELECT `*` FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty'
			AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
			
			$id_nt = $info[0]['id_nt'];
			
			$fanho = query("
			SELECT * FROM `fan` WHERE `id` IN
			(SELECT `id_fan` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `id_course` = '$id_course' AND `h_y` = '$h_y')
			ORDER BY `id`");
			
			
			$teachers = query("SELECT * FROM `users` WHERE `access_type` != '3' ORDER BY `fullname`");
			include("ajax/fanlist.php");
		}
		exit;
	break;
	
	
	case "getNewRow":
		$fanho = select("fan", "*", "", "title", false, "");
		include("ajax/credit_part.php");
		exit;
	break;
	
}


?>