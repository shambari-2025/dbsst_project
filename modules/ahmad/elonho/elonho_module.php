<?php


switch($action){
	
	case "add":
		
		$page_info['title'] = 'Иловакунии эълонҳо';
	break;
	
	case "insert":
		if($_REQUEST['title'] != '' AND $_REQUEST['text'] != ''){
			$data['type'] = "'".clear_admin($_REQUEST['type'])."'";
			$data['title'] = "'".clear_admin($_REQUEST['title'])."'";
			$data['text'] = "'".($_REQUEST['text'])."'";
			$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data['add_date'] = "'".date("Y-m-d H:i:s")."'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			insert("elonho", $fields, $data);
			redirect();
		}else{
			
			exit("Ном ва матни эълон бояд холи набошанд!");
		}
	break;
	
	case "list":
		if(isset($_SESSION['user']['admin'])){
			$elonho = query("SELECT * FROM `elonho` ORDER BY `id` DESC");
		}else{
			if($_SESSION['user']['access_type'] == 2){
				$type = 1;
			}elseif($_SESSION['user']['access_type'] == 3){
				$type = 2;
			}
			$elonho = query("SELECT * FROM `elonho` WHERE `type` IN ($type, 3) ORDER BY `id` DESC");
			
		}
		$page_info['title'] = 'Руйхати эълонҳо';
	break;
	
	case "edit":
		$id = $_REQUEST['id'];
		
		$elon = query("SELECT * FROM `elonho` WHERE `id` = '$id'"); 
		$page_info['title'] = 'Таҳриркунии эълон: '.$elon[0]['title'];
	break;
	
	case "update":
		$id = $_REQUEST['id'];
		$fields['type'] = $_REQUEST['type'];
		$fields['title'] = $_REQUEST['title'];
		$fields['text'] = $_REQUEST['text'];
		$fields['editor'] = $_SESSION['user']['id'];
		$fields['edit_date'] = date("Y-m-d H:i:s");
		update("elonho", $fields, "`id` = '$id'");
		
		redirect(MY_URL."?option=elonho&action=list");
	break;
	
	case "delete":
		$id = $_REQUEST['id'];
		
		delete("elonho", "`id` = '$id'");
		redirect();
	break;
}
?>