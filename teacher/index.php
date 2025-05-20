<?php
include('../lib/header_file.php');

if (!isset($_SESSION['user']['true']) || !isset($_SESSION['user']['teacher'])){
	redirect(URL."?option=login");
}

define('MY_URL', URL.'teacher/');

/*Вақти охирон амал*/
$now = date("Y-m-d H:i:s");
$query = update_query("UPDATE `users` SET `last_login` = '$now' WHERE `id` = '{$_SESSION['user']['id']}'");


$user_info = query("SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}'");

$commission = query("SELECT * FROM `commission_module` WHERE `id_user` = '{$_SESSION['user']['id']}'");

	$option = empty($_REQUEST['option']) ? 'mylessons' : $_REQUEST['option'];
	$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

$file = 'universalfile';

if(!empty($commission)){
	$_SESSION['commission'] = MakeMenuCQ($commission);
}


$department_education = query("SELECT * FROM `department_education` WHERE `id_user` = '{$_SESSION['user']['id']}'");




//unset($_SESSION['superarr_education']);
if(!isset($_SESSION['superarr_education'])){
	if(!empty($department_education)){
		$_SESSION['superarr_education'] = MakeMenu($department_education);
	}
}


/*
if($_SESSION['user']['id'] == 6) {
	print_arr($_SESSION['superarr']);
	exit("STOP");
}
*/

$biometric_module = query("SELECT * FROM `biometric_module` WHERE `id_user` = '{$_SESSION['user']['id']}'");

//unset($_SESSION['biometric']);
if(!isset($_SESSION['biometric'])){
	if(!empty($biometric_module)){
		$_SESSION['biometric'] = MakeMenu($biometric_module);
	}
}
/* руйхати донишҷӯён*/



$contingent_module = query("SELECT * FROM `contingent_module` WHERE `id_user` = '{$_SESSION['user']['id']}'");


//unset($_SESSION['students']);
if(!isset($_SESSION['students'])){
	if(!empty($contingent_module)){
		$_SESSION['students'] = MakeMenuDecan($contingent_module);
	}
}

/* руйхати донишҷӯён*/


$test_center_module = query("SELECT * FROM `test_center_module` WHERE `id_user` = '{$_SESSION['user']['id']}'");
//unset($_SESSION['tests']);
if(!isset($_SESSION['tests'])){
	if(!empty($test_center_module)){
		$_SESSION['tests'] = MakeMenu($test_center_module);
	}
}


$bugaltaria_module = query("SELECT * FROM `bugaltaria_module` WHERE `id_user` = '{$_SESSION['user']['id']}'");



//unset($_SESSION['bugaltaria']);
if(!isset($_SESSION['bugaltaria'])){
	if(!empty($bugaltaria_module)){
		$_SESSION['bugaltaria'] = MakeMenu($bugaltaria_module);
	}
}
$teacher_module = query("SELECT * FROM `teacher_module` WHERE `id_user` = '{$_SESSION['user']['id']}'");

/*ОМӮЗГОР*/
unset($_SESSION['teacher_module']);
if(!isset($_SESSION['teacher_module'])){
	if(!empty($teacher_module)){
		$id_departament = $teacher_module[0]['id'];
		$_SESSION['teacher_module'] = MakeMenuLitsey();
	}
}
/*ОМӮЗГОР*/



$departaments_module = query("SELECT * FROM `departaments` WHERE `id_mudir` = '{$_SESSION['user']['id']}'");

/*КАФЕДРА*/
unset($_SESSION['departaments_module']);
if(!isset($_SESSION['departaments_module'])){
	if(!empty($departaments_module)){
		$id_departament = $departaments_module[0]['id'];
		$_SESSION['departaments_module'] = MakeMenuLitsey();
	}
}
/*КАФЕДРА*/


$litsey_module = query("SELECT * FROM `litsey_module` WHERE `id_user` = '{$_SESSION['user']['id']}'");

/*ЛИТСЕЙ*/
//unset($_SESSION['litsey']);
if(!isset($_SESSION['litsey'])){
	if(!empty($litsey_module)){
		$_SESSION['litsey'] = MakeMenuLitsey();
	}
}
/*ЛИТСЕЙ*/


$khobgoh_module = query("SELECT * FROM `khobgoh_module` WHERE `id_user` = '{$_SESSION['user']['id']}'");


if(!empty($khobgoh_module)){
	//unset($_SESSION['superarr']);
	if(!isset($_SESSION['superarr'])){
		$_SESSION['superarr'] = MakeSuperMenu();
	}
}

/* ҶОИ КОР*/
if($_SESSION['user']['id'] == 3203){
	if(!isset($_SESSION['superarr'])){
		$_SESSION['superarr'] = MakeSuperMenu();
	}
}
/* ҶОИ КОР*/
/* ПРОРЕКТОР*/
if($_SESSION['user']['id'] == 16){
	if(!isset($_SESSION['superarr'])){
		$_SESSION['students'] = MakeSuperMenu();
	}
}
/* ПРОРЕКТОР*/

$rasid_query = query("SELECT * FROM `rasid_module` WHERE `id_user` = '{$_SESSION['user']['id']}'");

$birthdays_teachers = query("SELECT `id`, `fullname_tj`, `birthday`, `jins`, `photo`, `access_type` FROM `users` WHERE `access_type` != '3' AND `birthday` LIKE '%".date("m-d")."%'");
$birthdays_students = query("SELECT `users`.`id`, `users`.`fullname_tj`, `users`.`birthday`, `users`.`jins`, `users`.`photo`, `users`.`access_type` FROM `users` 
INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
WHERE `students`.`status` = 1 AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
AND `access_type` = '3' AND `birthday` LIKE '%".date("m-d")."%'");


$birthdays = array_merge($birthdays_teachers, $birthdays_students);

$teacher_info = query("SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}'");

$w = date("w");

$datas_jd = query("SELECT * FROM `jd` WHERE `id_s_l` = '1' AND `id_s_v` = '1' AND `id_teacher` = '".$_SESSION['user']['id']."' AND `ruz` = '$w' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY   `soat`");

switch($option){
	case "elonho":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "jd":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "sessions":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "joikor":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "teachers":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	
	case "tests":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	
	case "search":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "questions":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "soxtor":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "naqsha":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "nt":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "students":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "prorector":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "biometric":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "bugalteria":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "commission":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "kassa":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "print":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "mylessons":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "scores":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "study":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "litsey":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "khobgoh":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "profile":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "change_syhy":
		$s_y = $_REQUEST['study_year'];
		$h_y = $_REQUEST['half_year'];
		$fields = array('s_y' => $s_y,
						'h_y' => $h_y
			);
		update("users", $fields, "`id` = '{$_SESSION['user']['id']}'");
		unset($_SESSION['students']);
		redirect();
	break;
	
	default:
		redirect();
	break;
}

/*Вақти онлайн будани истифодабаранда*/
setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
include("views/teacher.php");
?>
