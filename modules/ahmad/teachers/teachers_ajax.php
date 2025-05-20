<?php
include('../../lib/header_file.php');

$option = empty($_REQUEST['option']) ? 'main' : $_REQUEST['option'];
$action = empty($_REQUEST['action']) ? 'list' : $_REQUEST['action'];

$STUDY_YEARS = select("study_years", "*", "", "id", false, "");

switch($option){
	
	case "rating_access":
		$id = $_REQUEST['id'];
		$status = $_REQUEST['set'];
		
		$fields = [
			'rating_access' => "$status"
		];
		
		if(update('users', $fields, "`id` = '$id'"))
			echo true;
		else
			echo false;
		exit;
	break;
	
	case "getteacherinfo":
		$id_teacher = $_REQUEST['id_teacher'];
		
		$teacher = query("SELECT `users`.*, `user_passports`.* FROM `users` 
		INNER JOIN `user_passports` ON `users`.`id` = `user_passports`.`id_user`
		WHERE `users`.`id` = '$id_teacher'");
		
		
		define('MY_URL', $_REQUEST['my_url']);
		
		include("ajax/getteacherinfo.php");
		exit;
	break;
	
	case "getteacherlessons":
		$id_teacher = $_REQUEST['id_teacher'];
		
		//$lessons = query("SELECT * FROM `sarboriho` WHERE `type` = 'lk_plan' AND `id_teacher` = '$id_teacher' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_faculty`, `id_course`, `id_spec`, `id_fan`");
		
		$lessons = query("SELECT `iqtibosho`.*, `sarboriho` .*
		FROM `iqtibosho`
		INNER JOIN `sarboriho` ON `iqtibosho`.`id` = `sarboriho`.`id_iqtibos`
		WHERE 
		`iqtibosho`.`semestr` IN (".SEMESTRS.")
		AND `sarboriho`.`id_teacher` = '$id_teacher' 
		ORDER BY 
		`iqtibosho`.`id_faculty`");
		
		
		
		define('MY_URL', $_REQUEST['my_url']);
		include("ajax/getteacherlessons.php");
		exit;
	break;
	
	case "getteachereditform":
		$id_teacher = $_REQUEST['id_teacher'];
		define('MY_URL', $_REQUEST['my_url']);
		
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$teacher = query("SELECT * FROM `users` INNER JOIN `user_passports` ON `users`.`id`=`user_passports`.`id_user` WHERE `users`.`id` = '$id_teacher'");
		
		
		$countries = select("countries", "*", "", "id", false, "");
		$regions = select("regions", "*", "", "id", false, "");
		
		$id_region = $teacher[0]['id_region'];
		
		$districts = select("districts", "*", "`id_region` = '$id_region'", "name", false, "");
		
		$nations = select("nations", "*", "", "id", false, "");
		
		include("ajax/getteachereditform.php");
		exit;
	break;
	
	
	case "getteacherdeleteform":
		$id_teacher = $_REQUEST['id_teacher'];
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$teacher = query("SELECT * FROM `users` WHERE `id` = '$id_teacher'");
		
		define('MY_URL', $_REQUEST['my_url']);
		
		include("ajax/getteacherdeleteform.php");
		exit;
	break;
	
	case "getDistricts":
		$id_region = $_REQUEST['id_region'];
		
		$districts = select("districts", "*", "`id_region` = '$id_region'", "name", false, "");
		include("ajax/districts.php");
		exit;
	break;
	
	case "makeLogin":
		$name = @strval($_REQUEST['fullname']);
		$login = makeLogin($name, rand(1,100));
		
		if($login){
			$result = $login;
		}else{
			$result = 'error';
		}
		echo $result;
		exit;
	break;
	
	case "isBusylogin":
		$login = @strval($_REQUEST['login']);
		$id_student = $_REQUEST['id_student'];
		
		echo Mybusylogin($login, $id_student);
		exit;
	break;
	
	case "getstudentscoreraznitsa":
		$id_student = $_REQUEST['id_student'];
		$id_teacher = $_REQUEST['id_teacher'];
		
		define('MY_URL', $_REQUEST['my_url']);
		
		$fans = query("SELECT `farqiyatho_content`.*
						FROM `farqiyatho_content` INNER JOIN `farqiyatho` ON 
						`farqiyatho_content`.`id_farqiyat` = `farqiyatho`.`id`
						WHERE `farqiyatho`.`id_student` = '$id_student' 
						AND `farqiyatho_content`.`id_teacher` = '$id_teacher'
						AND `farqiyatho_content`.`status` = '0'
					");
		include("ajax/getstudentscoreraznitsa.php");
		exit;
	break;
	
	case "getstudentscoretrimestr":
		$id_student = $_REQUEST['id_student'];
		$id_teacher = $_REQUEST['id_teacher'];
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		$info_std = query("SELECT * FROM `students` WHERE `status` = '1' AND `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$id_faculty = $info_std[0]['id_faculty'];
		$id_s_l = $info_std[0]['id_s_l'];
		$id_s_v = $info_std[0]['id_s_v'];
		$id_course = $info_std[0]['id_course'];
		$id_spec = $info_std[0]['id_spec'];
		$id_group = $info_std[0]['id_group'];
		$id_s_t = $info_std[0]['id_s_t'];
		$foreign = $info_std[0]['foreign'];
		
		define('MY_URL', $_REQUEST['my_url']);
		
		$trimestr = query("SELECT `trimestr_content`.*, `trimestr`.`id_student`, `trimestr`.`date`, `trimestr`.`money` as `all_money`
						FROM `trimestr_content` INNER JOIN `trimestr` ON 
						`trimestr_content`.`id_trimestr` = `trimestr`.`id`
						WHERE `trimestr`.`id_student` = '$id_student' 
						AND `trimestr_content`.`imt_type` != '1'
						AND `trimestr_content`.`id_teacher` = '$id_teacher'
						AND `trimestr_content`.`status` = '0'
					");			
		$flag = true;		
		include("ajax/getstudentscoretrimestr.php");
		exit;
	break;
	
}


?>