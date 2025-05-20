<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

$STUDY_YEARS = select("study_years", "*", "", "id", false, "");



switch($option){
	
	case "getOrderForm":
		$id_user = @$_REQUEST['id_student'];
		
		$S_Y = S_Y;
		define('MY_URL', $_REQUEST['my_url']);
		
		$checks = query("SELECT * FROM `rasidho` WHERE `id_student` = '$id_user' ORDER BY `id` DESC");
		
		
		include("ajax/getOrderForm.php");
		exit;
	break;
	case "makeLogin":
		
		$name = @strval($_REQUEST['fullname']);
		$login = makeLogin($name, rand(1,100));
		
		if($login){
			$result = $login;
		}else{
			$result = 'error';
		}
		echo $result;
		exit;
	break;
	
	case "getDistricts":
		$id_region = $_REQUEST['id_region'];
		
		$districts = select("districts", "*", "`id_region` = '$id_region'", "name", false, "");
		include("ajax/districts.php");
		exit;
	break;
	
	case "getShartnomaForm":
		$id_student = $_REQUEST['id_student'];
		$S_Y = S_Y;
		define('MY_URL', $_REQUEST['my_url']);
		include("ajax/getShartnomaForm.php");
		exit;
	break;
	
}


?>