<?php
include('../lib/header_file.php');


if (!isset($_SESSION['user']['true'])){
	redirect(URL."?option=login");
}

if(IMT_STATUS == 1){
	$option = empty($_REQUEST['option']) ? 'sessions' : $_REQUEST['option'];
	$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];
}else{
	$option = empty($_REQUEST['option']) ? 'study' : $_REQUEST['option'];
	$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];
}

$file = 'universalfile';

define('MY_URL', URL.'student/');

/*Вақти охирон амал*/
$now = date("Y-m-d H:i:s");
$query = update_query("UPDATE `users` SET `last_login` = '$now' WHERE `id` = '".@$_SESSION['user']['id']."'");




$id_student = $_SESSION['user']['id'];

$student = query("SELECT `students`.*, `users`.* FROM `users`
INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
WHERE `students`.`status` = '1' AND `students`.`id_student` = '$id_student' AND `users`.`id` = '$id_student'
AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
");

if(empty($student)){
	redirect(URL."?option=logout");
}


$id_faculty = $student[0]['id_faculty'];
$id_s_l = $student[0]['id_s_l'];
$id_s_v = $student[0]['id_s_v'];
$id_s_t = $student[0]['id_s_t'];
$id_course = $student[0]['id_course'];
$id_spec = $student[0]['id_spec'];
$id_group = $student[0]['id_group'];
$xoriji = $student[0]['foreign'];

if($id_s_t == 1) {
	$mablagi_shartnoma = getSharnomaMoneyBySY($id_course, $id_spec, $id_s_l, $id_s_v, S_Y, $xoriji);
	$mablag_suporid = getMoneyShartnoma($id_student, S_Y);
}


$info = query("SELECT * FROM `std_study_groups` WHERE `status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");

$lang = $info[0]['lang'];
$id_nt = $info[0]['id_nt'];


/*ТРИМЕСТР ЧЕК*/
if($id_course >=4){
	$trimestr_1 = query("SELECT * FROM `trimestr` WHERE `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '1' ORDER BY `id` DESC LIMIT 1");
	$trimestr_2 = query("SELECT * FROM `trimestr` WHERE `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '2' ORDER BY `id` DESC LIMIT 1");
	$trimestr = array_merge($trimestr_1, $trimestr_2);
}else{
	$trimestr = query("SELECT * FROM `trimestr` WHERE `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '1' ORDER BY `id` DESC LIMIT 1");
}
/*ТРИМЕСТР ЧЕК*/



switch($option){
	case "elonho":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "study":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "profile":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	case "sessions":
		include($_SERVER['DOCUMENT_ROOT']."/modules/$option/{$option}_module.php");
	break;
	
	
	default:
		redirect();
	break;
}


/*Вақти онлайн будани истифодабаранда*/
setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
include("views/student.php");
?>
