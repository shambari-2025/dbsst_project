<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}

switch($action){
	
	
	case "list":
		
		$users = getOnline();
		
		$page_info['title'] = 'Онлайн';
	break;
}


?>