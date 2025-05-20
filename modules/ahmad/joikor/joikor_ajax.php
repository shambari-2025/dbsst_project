<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "getstudenteditform":
		$id_student = $_REQUEST['id_student'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		$user = query("SELECT `users`.*, `user_passports`.* FROM `users`  INNER JOIN `user_passports`
						ON `users`.`id`  = `user_passports`.`id_user`
						WHERE `users`.`id` = '$id_student'
						");
		
		include("ajax/shubai2form.php");
		exit;
	break;
	
}


?>