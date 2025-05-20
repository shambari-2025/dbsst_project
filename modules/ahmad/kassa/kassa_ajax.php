<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "getDatas":
		// $from_date = $_REQUEST['from_date']." 00:00:00";
		// $to_date = $_REQUEST['to_date']." 23:59:59";
		$from_date = $_REQUEST['from_date'];
		$to_date = $_REQUEST['to_date'];
		
		$date_from = date("d.m.Y", strtotime($from_date));
		$date = date("d.m.Y", strtotime($to_date));
		
		$hujjat = count_summa_where("rasidho", "check_money", "`type` = '1' AND `payed` = '1' AND `check_date` >= '$from_date' AND `check_date` <= '$to_date'");
		$shartnoma_inkassa = count_summa_where("rasidho", "check_money", "`type` = '2' AND `payed` = '1' AND `bank` IS NULL AND `check_date` >= '$from_date' AND `check_date` <= '$to_date'");
		
		$trimestr = count_summa_where("rasidho", "check_money", "`type` = '3' AND `payed` = '1' AND `check_date` >= '$from_date' AND `check_date` <= '$to_date'");
		$farqiyat = count_summa_where("rasidho", "check_money", "`type` = '4' AND `payed` = '1' AND `check_date` >= '$from_date' AND `check_date` <= '$to_date'");
		
		$xobgoh = count_summa_where("rasidho", "check_money", "`type` = '5' AND `payed` = '1' AND `check_date` >= '$from_date' AND `check_date` <= '$to_date'");
		
		
		$total = count_summa_where("rasidho", "check_money", "`payed_from` IS NULL AND  `type` IN (1,2,3,4,5) AND `payed` = '1' AND `check_date` >= '$from_date' AND `check_date` <= '$to_date'");
		include("views/daromadho.php");
		exit;
	break;
	
	
	case "addForm":
		$id = $_REQUEST['id'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		
		
		/*Collect datas*/
		$specialties = query("SELECT * FROM `specialties` ORDER BY `id_faculty`");
		$studyviews = query("SELECT * FROM `study_view`");
		$studytype = query("SELECT * FROM `study_type`");
		$studylevel = query("SELECT * FROM `study_level`");
		/*Collect datas*/
		
		
		include("ajax/addform.php");
		exit;
	break;
	
	
	
	case "getNewRow":
		/*Collect datas*/
		$specialties = query("SELECT * FROM `specialties` ORDER BY `id_faculty`");
		$studyviews = query("SELECT * FROM `study_view`");
		$studytype = query("SELECT * FROM `study_type`");
		$studylevel = query("SELECT * FROM `study_level`");
		/*Collect datas*/
		
		
		include("ajax/data_part.php");
		exit;
	break;
}


?>