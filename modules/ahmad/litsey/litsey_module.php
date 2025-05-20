<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}

switch($action){
	
	case "add":
		$groups = select("groups", "*", "", "id", false, "");
		$countries = select("countries", "*", "", "id", false, "");
		$nations = select("nations", "*", "", "id", false, "");
		$vazi_oilavi = select("vazi_oilavi", "*", "", "id", false, "");
		
		
		$page_info['title'] = 'Иловакунии хонандаи литсей';
	break;
	
	case "insert":
		$page_info['title'] = "Иловакунии хонандаи литсей: ".$_REQUEST['fullname'];
		
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		$table = "users";
		$data['fullname_tj'] = "'".clear_admin($_REQUEST['fullname'])."'";
		$data['fullname_ru'] = "'".clear_admin($_REQUEST['fullname_ru'])."'";
		$data['birthday'] = "'".clear_admin($_REQUEST['birthday'])."'";
		$data['jins'] = "'".clear_admin($_REQUEST['jins'])."'";
		$data['login'] = "'".clear_admin($_REQUEST['login'])."'";
		$data['password'] = "'".clear_admin($_REQUEST['password'])."'";
		$data['email'] = "'".clear_admin($_REQUEST['email'])."'";
		$data['phone'] = "'".clear_admin($_REQUEST['phone'])."'";
		$data['phone_parents'] = "'".clear_admin($_REQUEST['parent_phone'])."'";
		$data['v_ijtimoi'] = "'".clear_admin($_REQUEST['vazi_ijtimoi'])."'";
		$data['from_family'] = "'".clear_admin($_REQUEST['az_oilai_ki'])."'";
		$data['v_oilavi'] = "'".clear_admin($_REQUEST['vazi_oilavi'])."'";
		$data['family_info'] = "'".clear_admin($_REQUEST['family_info'])."'";
		
		$data['access'] = 1;
		$data['access_type'] = 4;
		$data['added_by'] = "'".$_SESSION['user']['id']."'";
		$data['added_time'] = "'".date("d.m.Y, H:i:s", time())."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		
		if($id_student = insert($table, $fields, $data)){
			
			/*PASSPORT DATAS*/
			$table = "user_passports";
			$passport_data['id_user'] = "'".clear_admin($id_student)."'";
			$passport_data['id_country'] = "'".clear_admin($_REQUEST['id_country'])."'";
			$passport_data['id_nation'] = "'".clear_admin($_REQUEST['id_nation'])."'";
			$passport_data['id_region'] = "'".clear_admin($_REQUEST['id_region'])."'";
			$passport_data['id_district'] = "'".clear_admin($_REQUEST['id_district'])."'";
			$passport_data['address'] = "'".clear_admin($_REQUEST['current_address'])."'";
			
			$passport_fields = array_keys($passport_data);
			$passport_data = implode(",", $passport_data);
			
			insert($table, $passport_fields, $passport_data);
			/*PASSPORT DATAS*/
			
			$table = "student_litsey";
			unset($data, $fields);
			$S_Y = S_Y;
			$H_Y = H_Y;
			
			$data['id_xonanda'] = "'".clear_admin($id_student)."'";
			$data['id_sinf'] = "'".clear_admin($_REQUEST['id_sinf'])."'";
			$data['id_group'] = "'".clear_admin($_REQUEST['id_group'])."'";
			$data['s_y'] = $S_Y;
			$data['h_y'] = $H_Y;
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			if(insert($table, $fields, $data)){
				
				/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
				//isGroupIsset($_REQUEST['id_faculty'], $_REQUEST['id_course'], $_REQUEST['id_spec'], $_REQUEST['id_group'], $_REQUEST['id_s_l'], $_REQUEST['id_s_v'], $S_Y, $H_Y);
				/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
			}
			
			if($_FILES['photo']['name']){
				$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['photo']['name'])); // расширение картинки
				if(in_array($baseimgExt, ALLOWED_IMG_FROMAT)){
				
					$baseimgName = "{$id_student}.{$baseimgExt}";
					$baseimgTmpName = $_FILES['photo']['tmp_name'];
					if(move_uploaded_file($baseimgTmpName, "../userfiles/litsey/$baseimgName")){
						$fields = array('photo' => $baseimgName);
						update("users", $fields, "`id` = '$id_student'");
					}
				}else{
					$data['id_user'] = $id_student;
					$data['author'] = $_SESSION['user']['id'];
					$data['file'] = "'".$_FILES['photo']['name']."'";
					$data['date'] = "'".date("d.m.Y, H:i:s")."'";
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					
					insert("rat", $fields, $data);
				}
			}
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			redirect();	
		}
	break;
	
	case "update_user":
		$id_student = $_REQUEST['id_student'];
		$page_info['title'] = "Таҳриркунии донишҷӯ ".$_REQUEST['fullname'];
		
		$fullname = clear_admin($_REQUEST['fullname']);
		$jins = clear_admin($_REQUEST['jins']);
		$login = clear_admin($_REQUEST['login']);
		$password = clear_admin($_REQUEST['password']);
		$birthday = clear_admin($_REQUEST['birthday']);
		$number_passport = clear_admin($_REQUEST['number_passport']);
		$phone = clear_admin($_REQUEST['phone']);
		$id_country = clear_admin($_REQUEST['id_country']);
		$id_region = clear_admin($_REQUEST['id_region']);
		$id_district = clear_admin($_REQUEST['id_district']);
		$id_nation = clear_admin($_REQUEST['id_nation']);
		$current_address = clear_admin($_REQUEST['current_address']);
		
		$fields = array(
			'fullname' => $fullname,
			'jins' => $jins,
			'login' => $login,
			'password' => $password,
			'birthday' => $birthday,
			'birthday' => $birthday,
			'number_passport' => $number_passport,
			'phone' => $phone,
			'id_country' => $id_country,
			'id_region' => $id_region,
			'id_district' => $id_district,
			'id_nation' => $id_nation,
			'current_address' => $current_address
		);
		
		update("users", $fields, "`id` = '$id_student'");
		
		
		/*Барои муайян кардани вази оилавӣ*/
		$S_Y = S_Y;
		$H_Y = H_Y;
		$fields2 = ['vazi_oilavi' => clear_admin($_REQUEST['vazi_oilavi'])];
		update("students", $fields2, "`id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		/*Барои муайян кардани вази оилавӣ*/
		
		if($_FILES['photo']['name']){
			$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['photo']['name'])); // расширение картинки
			if(in_array($baseimgExt, ALLOWED_IMG_FROMAT)){
				$baseimgName = "{$id_student}.{$baseimgExt}";
				$baseimgTmpName = $_FILES['photo']['tmp_name'];
				if(move_uploaded_file($baseimgTmpName, "../userfiles/students/$baseimgName")){
					$fields = array('photo' => $baseimgName);
					update("users", $fields, "`id` = '$id_student'");
				}
			}else{
				$data['id_user'] = $id_student;
				$data['author'] = $_SESSION['user']['id'];
				$data['file'] = "'".$_FILES['photo']['name']."'";
				$data['date'] = "'".date("d.m.Y, H:i:s")."'";
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				insert("rat", $fields, $data);
			}
		}
		setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
		redirect();	
	break;
	
	case "update_student":
		$id_student = $_REQUEST['id_student'];
		$old_id_nt = $_REQUEST['id_nt'];
		
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		$id_faculty = clear_admin($_REQUEST['id_faculty']);
		$id_course = clear_admin($_REQUEST['id_course']);
		$id_spec = clear_admin($_REQUEST['id_spec']);
		$id_group = clear_admin($_REQUEST['id_group']);
		$id_s_l = clear_admin($_REQUEST['id_s_l']);
		$id_s_t = clear_admin($_REQUEST['id_s_t']);
		$id_s_v = clear_admin($_REQUEST['id_s_v']);
		
		/*
		$new_nt = query("SELECT * FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$new_id_nt = $new_nt[0]['id_nt'];
		
		$old_nt_content = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$old_id_nt' AND `id_course` < '$id_course' ORDER BY `id_course`, `h_y`, `id_fan`");
		$new_nt_content = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$new_id_nt' AND `id_course` < '$id_course' ORDER BY `id_course`, `h_y`, `id_fan`");
		
		
		function udiffCompare($a, $b){
			return $a['id_fan'] - $b['id_fan'];
		}

		$raznitsa = array_udiff($new_nt_content, $old_nt_content, 'udiffCompare');
		
		include("help.php");
		exit;
		*/
		
		
		/*Маълумотҳои пешинаи донишҷӯ*/
		$student_info = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$old_id_faculty = $student_info[0]['id_faculty'];
		$old_id_course = $student_info[0]['id_course'];
		$old_id_spec = $student_info[0]['id_spec'];
		$old_id_group = $student_info[0]['id_group'];
		$old_id_s_l = $student_info[0]['id_s_l'];
		$old_id_s_t = $student_info[0]['id_s_t'];
		$old_id_s_v = $student_info[0]['id_s_v'];
		/*Маълумотҳои пешинаи донишҷӯ*/
		
		
		/*Муайян мекунем ки дар гурух чанд донишҷуи дигар боқи мемонад*/
		$info_group = query("SELECT COUNT(`id`) as `count` FROM `students` WHERE 
		`id_faculty` = '$old_id_faculty' AND `id_course` = '$old_id_course' AND `id_spec` = '$old_id_spec' AND 
		`id_group` = '$old_id_group' AND `id_s_l` = '$old_id_s_l' AND `id_s_v` = '$old_id_s_v' AND 
		`s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		/*Муайян мекунем ки дар гурух чанд донишҷуи дигар боқи мемонад*/
		
		$fields = array(
			'id_faculty' => $id_faculty,
			'id_course' => $id_course,
			'id_spec' => $id_spec,
			'id_group' => $id_group,
			'id_s_l' => $id_s_l,
			'id_s_t' => $id_s_t,
			'id_s_v' => $id_s_v
		);
		
		if(update("students", $fields, "`id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")){
			
			/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
			isGroupIsset($id_faculty, $id_course, $id_spec, $id_group, $id_s_l, $id_s_v, $S_Y, $H_Y);
			/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
			
			/* Дар таблитсаи students_farmonho интиқол карданаш*/
			if(!empty($_REQUEST['farmon_number']) && !empty($_REQUEST['farmon_date'])){
				unset($data, $fields);
				$data['id_student'] = "'".clear_admin($id_student)."'";
				$data['farmon_type'] = "'3'";
				$data['farmon_number'] = "'".clear_admin($_REQUEST['farmon_number'])."'";
				$data['farmon_date'] = "'".clear_admin($_REQUEST['farmon_date'])."'";
				$data['s_y'] = S_Y;
				$data['h_y'] = H_Y;
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				insert("students_farmonho", $fields, $data);
			}
			/* Дар таблитсаи students_farmonho интиқол карданаш*/
		}
		
		/*Агар ҳамин донишҷӯ ягона донишҷуи гурух бошад пас аз контингенти гуруххо нест мекунем гурухро*/
		if($info_group[0]['count'] == 1){
			unset($_SESSION['superarr'][$old_id_faculty]["view"][$old_id_s_v]["course"][$old_id_course]['spec'][$old_id_spec]['groups'][$old_id_group]);
			delete("std_study_groups", "`id_faculty` = '$old_id_faculty' AND `id_course` = '$old_id_course' AND `id_spec` = '$old_id_spec' AND `id_group` = '$old_id_group' AND `id_s_l` = '$old_id_s_l' AND `id_s_v` = '$old_id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
			redirect();
		}else redirect();	
		/*Агар ҳамин донишҷӯ ягона донишҷуи гурух бошад пас аз контингенти гуруххо нест мекунем гурухро*/
	break;
	
	case "list":
		$id_sinf = $_REQUEST['id_sinf'];
		$id_group = $_REQUEST['id_group'];
		
		
		/* Баровардани контингенти гурух */
		$students = query("SELECT `student_litsey`.*, `user_passports`.*, `users`.*  FROM `users`
		INNER JOIN `student_litsey` ON `student_litsey`.`id_xonanda` = `users`.`id` 
		INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
		WHERE `student_litsey`.`id_sinf` = '$id_sinf' AND `student_litsey`.`id_group` = '$id_group'
		AND `student_litsey`.`s_y` = '".S_Y."' AND `student_litsey`.`h_y` = '".H_Y."'
		ORDER BY `users`.`fullname_tj`
		");
		/* Баровардани контингенти гурух */
		
		$page_info['title'] = 'Хонандагони литсей / Синфи '.$id_sinf.' / '.getGroup2($id_group);
		
	break;
	
	case "statistic":
		$page_info['title'] = 'Омори хонандагони литсей';
	break;
	
	case "delete_xonanda":
		$id = $_REQUEST['id'];
		
		if(delete("users", "`id` = '$id'")){
			delete("student_litsey", "`id_xonanda` = '$id' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
			
			delete("rasidho", "`id_student` = '$id' AND `s_y` = '".S_Y."'");
		}
		
		redirect();
	break;
	
	
	
}


?>