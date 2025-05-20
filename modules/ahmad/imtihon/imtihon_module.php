<?php


switch($action){
	case "davrifaol":
		$page_info['title'] = "Даври фаъол";
		$result = getDavriFaol(S_Y, H_Y);
		
		$all_student = query("SELECT COUNT(`id`) as `students` FROM `students` WHERE `status` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
		$students = $all_student[0]['students'];
		
		$suporidand = query("SELECT COUNT(DISTINCT(`id_student`)) as `suporidand` FROM `_pres_results` WHERE `imt_score` IS NOT NULL AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
		$ishtirok_kardand = $suporidand[0]['suporidand'];
	break;
	
	case "qarzdorho":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$page_info['title'] = "ДОНИШҶӮЁНЕ КИ ҚАРЗДОР ШУДААНД";
	break;
	
}


?>