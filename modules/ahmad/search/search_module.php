<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}

$studyView = query("SELECT * FROM `study_view` ORDER BY `id` DESC");
$courses = query("SELECT * FROM `course` ORDER BY `id`");
$specialties = query("SELECT * FROM `specialties` ORDER BY `code`");

switch($action){
	
	case "tmp":
		$word = trim($_REQUEST['search']);
		$url = MY_URL."?option=search&action=list&word=$word#:~:text=$word";
		redirect($url);
	break;
	
	case "list":
		$word = trim($_REQUEST['word']);
		if(isset($_SESSION['user']['admin'])){
			// Поиск барои Администратор
			$students = Search($word);
		}else{
			// Поиск барои омузгорон
			$students = SearchByTeachers($word, $contingent_module);
		}
		$page_info['title'] = 'Ҷустуҷу: '.$word;
	break;
}


?>