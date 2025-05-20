<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

switch($option){
	
	case "selanamoi":
		$id = $_REQUEST['id'];
		define("MY_URL", $_REQUEST['my_url']);
		
		$info = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id'");
		
		$id_faculty = $info[0]['id_faculty'];
		$id_s_l = $info[0]['id_s_l'];
		$id_s_v = $info[0]['id_s_v'];
		$id_course = $info[0]['id_course'];
		$id_spec = $info[0]['id_spec'];
		$id_group = $info[0]['id_group'];
		$semestr = $info[0]['semestr'];
		$id_departament = $info[0]['id_departament'];
		$id_fan = $info[0]['id_fan'];
		$s_y = $info[0]['s_y'];
		
		$in_group = count_table_where("students", "
		`status` = '1' AND 
		`id_faculty` = '$id_faculty' AND 
		`id_s_l` = '$id_s_l' AND 
		`id_s_v` = '$id_s_v' AND 
		`id_course` = '$id_course' AND 
		`id_spec` = '$id_spec' AND 
		`id_group` = '$id_group' AND 
		`s_y` = '".S_Y."'");
		
		
		$datas = query("SELECT * FROM `iqtibosho` WHERE `id` != '$id' AND
		`parent_group` IS NULL AND 
		`id_faculty` = '$id_faculty' AND 
		`id_course` = '$id_course' AND 
		`semestr` = '$semestr' AND 
		`id_departament` = '$id_departament' AND 
		`id_fan` = '$id_fan' AND 
		`s_y` = '$s_y'");
		
		include("ajax/selanamoi.php");
		exit;
	break;
	
	
	case "update_iqtibos_id":
		$id = clear_admin($_REQUEST['id']);
		$field = clear_admin($_REQUEST['field']);
		$value = clear_admin($_REQUEST['value']);
		
		if($value == 0 || $value == ''){
			$data[$field] = 'NULL';
		}else{
			$data[$field] = $value;
		}
		
		update("iqtibosho", $data, "`id` = '$id'");
		exit;
	break;
	
	case "addFan":
		define("MY_URL", $_REQUEST['my_url']);
		
		include("ajax/fan_add.php");
		exit;
	break;
	
	case "editIqtibosForm":
		$id_nt = $_REQUEST['id_nt'];
		$id_course = $_REQUEST['id_course'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		if($id_course == 1){
			$semestrs = [1,2];
		}elseif($id_course == 2){
			$semestrs = [3,4];
		}elseif($id_course == 3){
			$semestrs = [5,6];
		}elseif($id_course == 4){
			$semestrs = [7,8];
		}elseif($id_course == 5){
			$semestrs = [9,10];
		}
		
		$info_nt = query("SELECT * FROM `nt_list` WHERE `id` = '$id_nt'");
		$id_s_l = $info_nt[0]['id_s_l'];
		$id_s_v = $info_nt[0]['id_s_v'];
		$id_spec = $info_nt[0]['id_spec'];
		
		$check_datas = query("SELECT * FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` IN (". implode(",", $semestrs) .") ORDER BY `semestr`, `id_fan`");
		//$check_datas = query("SELECT DISTINCT(`id_spec`), `semestr`, `id_fan` FROM `iqtibosho` WHERE id_nt` = '$id_nt' AND `semestr` IN (". implode(",", $semestrs) .") ORDER BY `semestr`, `id_fan`");
		
		
		$departaments = query("SELECT * FROM `departaments` WHERE `s_y` = '".S_Y."' ORDER BY `title`");
		
		
		
		include("ajax/editIqtibosForm.php");
		exit;
	break;
	
	case "addForm2":
		$file = $_REQUEST['file'];
		$id_faculty = @$_REQUEST['id_faculty'];
		$id_departament = @$_REQUEST['id_departament'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		$teachers = query("SELECT * FROM `users` WHERE `access_type` = '2' ORDER BY `fullname_tj`");
		$departaments = query("SELECT * FROM `departaments` ORDER BY `title`");
		$studylevels = select("study_level", "*", "", "id", false, "");
		
		$all_teachers = query("SELECT * FROM `users` WHERE `access_type` = '2' AND `id` NOT IN 
		(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` = '$id_departament' AND `s_y` = '".S_Y."')
		ORDER BY `fullname_tj`");
		
		include("ajax/{$file}.php");
		exit;
	break;
	
	case "updateIqtibos":
		//$id_fan = $_REQUEST['id_fan'];
		$id = $_REQUEST['id'];
		$id_departament = $_REQUEST['id_departament'];
		
		$fields['id_departament'] = $id_departament;
		//update("iqtibosho", $fields, "`id_fan` = '$id_fan'");
		update("iqtibosho", $fields, "`id` = '$id'");
		exit;
	break;
	
	
	
	case "editContentForm":
		$id = $_REQUEST['id'];
		define("MY_URL", $_REQUEST['my_url']);
		$fanho = select("fan_test", "*", "", "title_tj", false, "");
		
		$nt_content = query("SELECT * FROM `nt_content` WHERE `id` = '$id'");
		
		include("ajax/editContentForm.php");
		exit;
	break;
	
	
	case "uploadForm":
		$id_nt = $_REQUEST['id_nt'];
		
		$check = query("SELECT * FROM `nt_list` WHERE `id` = '$id_nt'");
		
		if($check[0]['id_s_v'] == 1){
			if($check[0]['id_s_l'] == 1){
				$url_upload = 'uploadData';
			}elseif($check[0]['id_s_l'] == 3){
				$url_upload = 'uploadDataMG';
			}
		}else{
			
			if($check[0]['id_s_l'] == 1){
				//$url_upload = 'uploadDataFosilavi';
				$url_upload = 'uploadData';
			}else{
				$url_upload = 'uploadDataM2';
			}
			
		}
		
		define("MY_URL", $_REQUEST['my_url']);
		
		include("ajax/uploadform.php");
		exit;
	break;
	
	case "addForm":
		$id_nt = $_REQUEST['id_nt'];
		
		define("MY_URL", $_REQUEST['my_url']);
		
		
		$courses = select("course", "*", "", "id", false, "");
		$fanho = query("SELECT * FROM `fan_test` ORDER BY `title_tj`");
		$rand = rand(1, 500);
		include("ajax/addform.php");
		exit;
	break;
	
	case "getNewRow":
		$fanho = select("fan_test", "*", "", "title_tj", false, "");
		
		$rand = rand(1, 500);
		include("ajax/credit_part.php");
		exit;
	break;
	
}


?>