<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}

switch($action){
	
	case "list":
		unset($_SESSION['questions']);
		$id_student = $_SESSION['user']['id'];
		
		
		$semestr= getSemestr($id_course, H_Y);
		
		$fanho = query("
		
		SELECT
			`nt_content`.*,
			`iqtibosho`.*
		FROM
			`iqtibosho`
		INNER JOIN `nt_content` ON `nt_content`.`id_nt` = `iqtibosho`.`id_nt` 
		AND `nt_content`.`id_fan` = `iqtibosho`.`id_fan`
		AND `nt_content`.`semestr` = `iqtibosho`.`semestr`
		AND `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$semestr'
		WHERE `iqtibosho`.`s_y` = '".S_Y."' AND
			`iqtibosho`.`id_group` = '$id_group' AND `iqtibosho`.`id_fan` != '1748';
		");
		
		
		$page_info['title'] = 'Фанҳои дарсии ман';
	break;
	
	case "fan":
		$id_fan = $_REQUEST['id_fan'];
		$weeks = query("SELECT * FROM `weeks` ORDER BY `id`");
		
		$page_info['title'] = 'Маводҳои фан: '.getFan($id_fan);
	break;
	
	case "read":
		$id_mavod = $_REQUEST['id_mavod'];
		
		$mavod = query("SELECT * FROM `mavodho` WHERE `id` = '$id_mavod'");
		
		$query = update_query("UPDATE `mavodho` SET `views` = `views` + 1 WHERE `id` = '$id_mavod'");
		
		$id_week = $mavod[0]['id_week'];
		$id_fan = $mavod[0]['id_fan'];
		
		$page_info['title'] = "Хондани мавзуъ: ".getFan($id_fan).': '.getWeek($id_week).': '. $mavod[0]['title'];
	break;
	
	case "suporish":
		
		$id_suporish = $_REQUEST['id_suporish'];
		$suporish = query("SELECT * FROM `suporishho` WHERE `id` = '$id_suporish'");
		
		$id_week = $suporish[0]['id_week'];
		$id_fan = $suporish[0]['id_fan'];
		
		$page_info['title'] = "Иҷрокунии супориш: ".getFan($id_fan).': '.getWeek($id_week).': '. $suporish[0]['title'];
	break;
	
	case "myinfo":
		$page_info['title'] = 'Маълумотномаи ман';
	break;
	
	case "contact":
		$page_info['title'] = 'Тамос';
	break;
	
}


?>