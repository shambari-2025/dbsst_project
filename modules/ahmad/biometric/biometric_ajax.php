<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "biometric":
		$id_student = $_REQUEST['id_student'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		$user = query("SELECT * FROM `users` WHERE `id` = '$id_student'");
		
		@$users_biometric = query("SELECT * FROM `users_biometric` WHERE `id_user` = '$id_student'");
		
		include("ajax/biometricform.php");
		exit;
	break;
	
}


?>