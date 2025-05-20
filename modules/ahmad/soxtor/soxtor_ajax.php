<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "setSoatbay":
		$id = $_REQUEST['id'];
		
		$query = query("SELECT `soatbay` FROM `iqtibosho` WHERE `id` = '$id'");
		
		
		if(empty($query[0]['soatbay'])){
			$fields['soatbay'] = 1;
		}else{
			$fields['soatbay'] = 'NULL';
		}
		
		update("iqtibosho", $fields, "`id` = '$id'", 1);
		exit;
	break;
	
	case "insertSarbori":
		
		$id_teacher = $_REQUEST['id_teacher'];
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		$lesson_type = $_REQUEST['lesson_type'];
		$lesson_soat = $_REQUEST['lesson_soat'];
		
		$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `type` = '$lesson_type'");
		
		if(empty($check)){
			
			$data['id_iqtibos'] = "'".clear_admin($id_iqtibos)."'";
			$data['type'] = "'".clear_admin($lesson_type)."'";
			$data['soat'] = "'".clear_admin($lesson_soat)."'";
			$data['id_teacher'] = "'".clear_admin($id_teacher)."'";
			$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
			$data['date_add'] = "'".date("d.m.Y, H:i:s", time())."'";
			$data['s_y'] = "'".S_Y."'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			insert("sarboriho", $fields, $data, 1);
		}else{
			if(!empty($id_teacher)){
				$fields['id_teacher'] = $id_teacher;
			}else{
				$fields['id_teacher'] = 'NULL';
			}
			$fields['editor'] = $_SESSION['user']['id'];
			$fields['date_update'] = date("d.m.Y, H:i:s", time());
			
			update("sarboriho", $fields, "`id` = '{$check[0]['id']}'");
		}
		
		$childs = query("SELECT * FROM `iqtibosho` WHERE `parent_group` = '$id_iqtibos' ORDER BY `id`");
		
		foreach($childs as $item){
			$id = $item['id'];
			$check = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id' AND `type` = '$lesson_type'");
			
			if(empty($check)){
				unset($data, $fields);
				$data['id_iqtibos'] = "'".clear_admin($id)."'";
				$data['type'] = "'".clear_admin($lesson_type)."'";
				$data['soat'] = "'".clear_admin($lesson_soat)."'";
				$data['id_teacher'] = "'".clear_admin($id_teacher)."'";
				$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
				$data['date_add'] = "'".date("d.m.Y, H:i:s", time())."'";
				$data['s_y'] = "'".S_Y."'";
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				insert("sarboriho", $fields, $data, 1);
			}else{
				if(!empty($id_teacher)){
					$fields['id_teacher'] = $id_teacher;
				}else{
					$fields['id_teacher'] = 'NULL';
				}
				unset($fields);
				$fields['id_teacher'] = $id_teacher;
				$fields['editor'] = $_SESSION['user']['id'];
				$fields['date_update'] = date("d.m.Y, H:i:s", time());
				
				update("sarboriho", $fields, "`id` = '{$check[0]['id']}'");
			}
		}
		
		exit;
		if(empty($check)){
			//insert
			
		}else{
			//update
			$fields['id_teacher'] = $id_teacher;
			update("sarboriho", $fields, "`id` = '{$check[0]['id']}'");
		}
		exit;
		//update("iqtibosho", $fields, "`id_fan` = '$id_fan'");
		exit;
		
	break;
	
	case "addForm":
		$file = $_REQUEST['file'];
		$id_faculty = @$_REQUEST['id_faculty'];
		$id_departament = @$_REQUEST['id_departament'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		$teachers = query("SELECT * FROM `users` WHERE `access_type` = '2' ORDER BY `fullname_tj`");
		$departaments = query("SELECT * FROM `departaments` ORDER BY `title`");
		$studylevels = select("study_level", "*", "", "id", false, "");
		
		$all_teachers = query("SELECT * FROM `users` WHERE `access_type` IN (1,2) AND `id` NOT IN 
		(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` = '$id_departament' AND `s_y` = '".S_Y."')
		ORDER BY `fullname_tj`");
		
		$vazifaho = query("SELECT * FROM `credits_table` ORDER BY `credit` DESC");
		include("ajax/{$file}.php");
		exit;
	break;
	
	case "getVazifaDetails":
		$id = $_REQUEST['id'];
		$info = query("SELECT * FROM `credits_table` WHERE `id` = '$id'");
		
		echo 'Соат: '.$info[0]['soat'].' | Кредит: '.$info[0]['credit'];
		exit;
	break;
	
	case "editMemberForm":
		$id = $_REQUEST['id'];
		define("MY_URL", $_REQUEST['my_url']);
		
		$info = query("SELECT * FROM `departaments_member` WHERE `id` = '$id'");
		
		$id_departament = $info[0]['id_departament'];
		
		$all_teachers = query("SELECT * FROM `users` WHERE `access_type` IN (1,2) ORDER BY `fullname_tj`");
		
		$vazifaho = query("SELECT * FROM `credits_table` ORDER BY `credit` DESC");
		
		include("ajax/editMemberForm.php");
		exit;
	break;
	
	case "editForm":
		$file = $_REQUEST['file'];
		define("MY_URL", $_REQUEST['my_url']);
		
		$id = $_REQUEST['id'];
		
		//$faculty = query("SELECT * FROM `faculties` WHERE `id` = '$id'");
		
		$faculty = query("SELECT `faculties`.*, `faculties_settings`.* FROM `faculties` 
		LEFT JOIN `faculties_settings` ON `faculties`.`id` = `faculties_settings`.`id_faculty`
		WHERE `faculties`.`id` = '$id' AND
		
		`faculties_settings`.`s_y` = '".S_Y."' AND `faculties_settings`.`h_y` = '".H_Y."'
		GROUP BY `faculties`.`id`, `faculties`.`title`, `faculties_settings`.`id`
		");
		
		$spec = query("SELECT * FROM `specialties` WHERE `id` = '$id'");
		
		$departament = query("SELECT * FROM `departaments` WHERE `id` = '$id'");
		$departaments = query("SELECT * FROM `departaments` ORDER BY `title`");
		
		
		$teachers = query("SELECT * FROM `users` WHERE `access_type` != '3' ORDER BY `fullname_tj`");
		
		$studylevels = select("study_level", "*", "", "id", false, "");
		include("ajax/{$file}.php");
		exit;
	break;
	
	case "infoFan":
		$id_fan = $_REQUEST['id_fan'];
		$id_departament = $_REQUEST['id_departament'];
		$file = $_REQUEST['file'];
		define("MY_URL", $_REQUEST['my_url']);
		
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		
		$list = query("SELECT `iqtibosho`.*, `nt_list`.* 
		FROM `iqtibosho` 
		INNER JOIN `nt_list` ON `iqtibosho`.`id_nt` = `nt_list`.`id`
		WHERE `iqtibosho`.`id_departament` = '$id_departament' AND `iqtibosho`.`id_fan` = '$id_fan'
		ORDER BY `iqtibosho`.`semestr`, `nt_list`.`id_faculty`");
		
		/*
		$list = query2("SELECT `nt_content`.*, `nt_list`.* FROM `nt_list`
		INNER JOIN `nt_content` ON `nt_list`.`id` = `nt_content`.`id_nt`
		WHERE `nt_content`.`id_nt` IN (SELECT DISTINCT(`id_nt`) FROM `std_study_groups` WHERE `s_y` = '$S_Y' AND `h_y` = '$H_Y')
		AND `id_fan` = '$id_fan'  ORDER BY `nt_content`.`id`");
		
		
		print_arr($query);
		exit;
		$query = query("SELECT * FROM `nt_content` WHERE `id_nt` IN (SELECT DISTINCT(`id_nt`) FROM `std_study_groups` 
		WHERE `s_y` = 1 AND `h_y` = 2) AND `id_fan` = '212' AND`h_y` = 2 ORDER BY `id`");
		
		$naqshaho = query("SELECT DISTINCT(`id_nt`) FROM `std_study_groups` WHERE `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		
		echo $id_fan;
		exit;
		*/
		include("ajax/{$file}.php");
		exit;
	break;
	
	case "gettaqsimotikkform":
		$id_iqtibos = $_REQUEST['id_iqtibos'];
		
		$students = $_REQUEST['students'];
		
		$soatho = $students * 3;
		
		$id_departament = $_REQUEST['id_departament'];
		//$soatho = $_REQUEST['soatho'];
		$text = $_REQUEST['text'];
		$type_kk = $_REQUEST['type_kk'];
		
		$taqsimshuda = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `type`='$type_kk'");
		
		$teachers = query("SELECT * FROM `users` WHERE `id` IN 
							(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` = '$id_departament' AND `s_y` = '".S_Y."')
							ORDER BY `fullname_tj`
							");
		define('MY_URL', $_REQUEST['my_url']);
		include("ajax/gettaqsimotikkform.php");
		exit;
	break;
	
	case "getNewRow":
		$id_departament = $_REQUEST['id_departament'];
		$teachers = query("SELECT * FROM `users` WHERE `id` IN 
							(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` = '$id_departament' AND `s_y` = '".S_Y."')
							ORDER BY `fullname_tj`
						");
		include("ajax/addRow.php");
		exit;
	break;
}


?>