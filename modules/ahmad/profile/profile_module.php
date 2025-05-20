<?php


switch($action){
	
	case "myprofile":
		$id = $_SESSION['user']['id'];
		$user_info = query2("SELECT * FROM `users` WHERE `id`='$id'");
		$page_info['title'] = 'Профили ман';
	break;
	
	case "updatepass":
		$id = $_SESSION['user']['id'];
		$pass = trim($_REQUEST['password']);
		$pass1 = trim($_REQUEST['password1']);
		if(!empty($pass) && !empty($pass1)){
			if($pass === $pass1){
				$fields['password'] = $pass;
				update("users", $fields, "`id` = '$id'");
				
			}
		}
		redirect();
	break;
	
	
	
	
	case "addmaterial":
		$id = $_REQUEST['id'];
		
		$weeks = query("SELECT * FROM `weeks` ORDER BY `id`");
		
		$info = query("SELECT * FROM `jd` WHERE `id` = '$id'");
		
		$id_fan = $info[0]['id_fan'];
		
		$page_info['title'] = 'Руйхати мавзуъҳо: '.getFan($id_fan);
	break;
	
	case "addlesson":
		$id_jd = $_REQUEST['id_jd'];
		$id_fan = $_REQUEST['id_fan'];
		$id_week = $_REQUEST['id_week'];
		
		$info_jd = query("SELECT * FROM `jd` WHERE `id` = '$id_jd'");
		
		$page_info['title'] = 'Иловакунии мавзуъ ба '.getFan($id_fan). ' барои '.getWeek($id_week);
	break;
	
	case "addsuporish":
		$id_jd = $_REQUEST['id_jd'];
		$id_fan = $_REQUEST['id_fan'];
		$id_week = $_REQUEST['id_week'];
		
		$info_jd = query("SELECT * FROM `jd` WHERE `id` = '$id_jd'");
		
		$page_info['title'] = 'Иловакунии супориш ба '.getFan($id_fan). ' барои '.getWeek($id_week);
	break;
	
	case "editlesson":
		$id = $_REQUEST['id'];
		
		$lesson = query("SELECT * FROM `mavodho` WHERE `id` = '$id'");
		$id_week = $lesson[0]['id_week'];
		$id_fan = $lesson[0]['id_fan'];
		$page_info['title'] = 'Таҳриркунии мавзуъ: '.getFan($id_fan). ': '.getWeek($id_week);
	break;
	
	case "editsuporish":
		$id = $_REQUEST['id'];
		
		$suporish = query("SELECT * FROM `suporishho` WHERE `id` = '$id'");
		$id_week = $suporish[0]['id_week'];
		$id_fan = $suporish[0]['id_fan'];
		$page_info['title'] = 'Таҳриркунии супориш: '.getFan($id_fan). ': '.getWeek($id_week);
	break;
	
	case "update_lesson":
		$id = $_REQUEST['id'];
		$id_jd = $_REQUEST['id_jd'];
		
		$fields = array(
			'title' => $_REQUEST['title'],
			'text' => $_REQUEST['text'],
			'updated' => date("d.m.Y, H:i:s", time()),
			'updated_by' => $_SESSION['user']['id']
		);
		update("mavodho", $fields, "`id` = '$id'");
		redirect(MY_URL."?option=mylessons&action=addmaterial&id=".$id_jd);
	break;
	
	case "update_suporish":
		$id = $_REQUEST['id'];
		$id_jd = $_REQUEST['id_jd'];
		
		
		$fields = array(
			'title' => $_REQUEST['title'],
			'text' => $_REQUEST['text'],
			'updated' => date("d.m.Y, H:i:s", time()),
			'updated_by' => $_SESSION['user']['id']
		);
		update("suporishho", $fields, "`id` = '$id'");
		redirect(MY_URL."?option=mylessons&action=addmaterial&id=".$id_jd);
	break;
	
	case "insert_lesson":
		$check = query("SELECT * FROM `mavodho` WHERE `id_fan` = '".$_REQUEST['id_fan']."' AND `id_week` = '".$_REQUEST['id_week']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
		
		if(empty($check)){
			$table = 'mavodho';
			$data['id_jd'] = "'".clear_admin($_REQUEST['id_jd'])."'";
			$data['id_week'] = "'".clear_admin($_REQUEST['id_week'])."'";
			$data['id_fan'] = "'".clear_admin($_REQUEST['id_fan'])."'";
			$data['title'] = "'".clear_admin($_REQUEST['title'])."'";
			$data['text'] = "'".addslashes($_REQUEST['text'])."'";
			$data['date'] = "'".clear_admin(date("d.m.Y, H:i:s", time()))."'";
			$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data['s_y'] = "'".clear_admin(S_Y)."'";
			$data['h_y'] = "'".clear_admin(H_Y)."'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			insert($table, $fields, $data);
		}
		redirect(MY_URL."?option=mylessons&action=addmaterial&id=".$_REQUEST['id_jd']);
	break;
	
	case "insert_suporish":
		$check = query("SELECT * FROM `suporishho` WHERE `id_fan` = '".$_REQUEST['id_fan']."' AND `id_week` = '".$_REQUEST['id_week']."'");
		
		if(empty($check)){
			$table = 'suporishho';
			$data['id_jd'] = "'".clear_admin($_REQUEST['id_jd'])."'";
			$data['id_week'] = "'".clear_admin($_REQUEST['id_week'])."'";
			$data['id_fan'] = "'".clear_admin($_REQUEST['id_fan'])."'";
			$data['title'] = "'".clear_admin($_REQUEST['title'])."'";
			$data['text'] = "'".addslashes($_REQUEST['text'])."'";
			$data['date'] = "'".clear_admin(date("d.m.Y, H:i:s", time()))."'";
			$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data['s_y'] = "'".clear_admin(S_Y)."'";
			$data['h_y'] = "'".clear_admin(H_Y)."'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			insert($table, $fields, $data);
		}
		redirect(MY_URL."?option=mylessons&action=addmaterial&id=".$_REQUEST['id_jd']);
	break;
	
	case "list":
		$page_info['title'] = 'Дарсҳои ман';
		//$lessons = query("SELECT * FROM `jd` WHERE `id_teacher` = '".$_SESSION['user']['id']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_faculty`, `id_course`, `id_spec`, `id_fan`");
			
	break;
	
}


?>