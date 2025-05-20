<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "getDavriFaol":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$result = getDavriFaol($S_Y, $H_Y);
		
		if(!$result){
			include("ajax/no_answer.php");
			exit;
		}
		
		$all_student = query("SELECT COUNT(`id`) as `students` FROM `students` WHERE `status` = '1' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$students = $all_student[0]['students'];
		
		$suporidand = query("SELECT COUNT(DISTINCT(`id_student`)) as `suporidand` FROM `_pres_results` WHERE `imt_score` IS NOT NULL AND `s_y` = '$H_Y' AND `h_y` = '$H_Y'");
		$ishtirok_kardand = $suporidand[0]['suporidand'];
		
		include("ajax/d_f.php");
		exit;
	break;
	
	
}


?>