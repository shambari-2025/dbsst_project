<?php

include $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php'; // Путь к файлу autoload.php в вашем проекте
use PhpOffice\PhpSpreadsheet\IOFactory;
$reader = IOFactory::createReader('Xlsx');

switch($action){
	
	case "kq":
		$datas = query("SELECT * FROM `std_study_groups` WHERE `status` = '-1' AND `id_s_v` = 1 AND `id_course` = 1 AND `s_y` = 24 AND `h_y` = 1 ORDER BY `id` ASC");
		
		foreach($datas as $item){
			unset($fields_res);
			
			$id_faculty = $item['id_faculty'];
			$id_s_l = $item['id_s_l'];
			$id_s_v = $item['id_s_v'];
			$id_course = $item['id_course'];
			$id_spec = $item['id_spec'];
			$id_group = $item['id_group'];
			$lang = $item['lang'];
			$id_nt = $item['id_nt'];
			$s_y = $item['s_y'];
			$h_y = $item['h_y'];
			
			$fields_res['lang'] = $lang;
			$fields_res['id_nt'] = $id_nt;
			
			if($id_nt){
				
				update("std_study_groups", $fields_res, "`status` = '1' 
				AND `id_faculty` = '$id_faculty'
				AND `id_s_l` = '$id_s_l'
				AND `id_s_v` = '$id_s_v'
				AND `id_course` = '$id_course'
				AND `id_spec` = '$id_spec'
				AND `id_group` = '$id_group'
				AND `s_y` = '$s_y'
				AND `h_y` = '$h_y'
				
				", 1);
			
			}
		}
		exit;
	break;
	
	
	case "iq_takror":
		$datas = query("SELECT DISTINCT(`id_nt`) FROM `std_study_groups` 
		WHERE `id_nt` IS NOT NULL AND `s_y` = 24 AND `h_y` = 1 
		ORDER BY `std_study_groups`.`id_nt` ASC");
		
		foreach($datas as $item){
			$id_nt = $item['id_nt'];
			
			$query = query("SELECT * FROM `iqtibosho` WHERE `id_nt` = $id_nt AND 
			`id_course` NOT IN (SELECT `id_course` FROM `std_study_groups` WHERE `id_nt` = $id_nt 
			AND `s_y` = 24 AND `h_y` = 1)");
			
			if(!empty($query)){
				foreach($query as $q){
					$id = $q['id'];
					
					delete('iqtibosho', "`id` = $id");
				}
			}
		}
		
		echo "ok";
		exit;
	break;
	
	case "takror":
		$datas = query("
		SELECT `status`, `id_student`, `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, 
		`id_group`, `id_s_t`, `balance`, `sh_persent`, `foreign`, `vazi_oilavi`, `s_y`, `h_y`, COUNT(*) 
		FROM `students` 
		GROUP BY `status`, `id_student`, `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, 
		`id_group`, `id_s_t`, `balance`, `sh_persent`, `foreign`, `vazi_oilavi`, `s_y`, `h_y` 
		HAVING COUNT(*) > 1 ORDER BY `students`.`id_student` ASC
		");
		
		foreach($datas as $item){
			$id_faculty = $item['id_faculty'];
			$id_s_l = $item['id_s_l'];
			$id_s_v = $item['id_s_v'];
			$id_course = $item['id_course'];
			$id_spec = $item['id_spec'];
			$id_group = $item['id_group'];
			$id_student = $item['id_student'];
			$s_y = $item['s_y'];
			$h_y = $item['h_y'];
			
			$check = query("SELECT * FROM `students` WHERE 
			`id_student` = '$id_student' AND
			`id_faculty` = '$id_faculty' AND
			`id_s_l` = '$id_s_l' AND
			`id_s_v` = '$id_s_v' AND
			`id_course` = '$id_course' AND
			`id_spec` = '$id_spec' AND
			`id_group` = '$id_group' AND 
			`s_y` = '$s_y' AND 
			`h_y` = '$h_y'
			");
			
			$id = $check[0]['id'];
			delete("students", "`id` = '$id'");
		}
		echo "ok";
		exit;
		$datas = query("SELECT * FROM `students` WHERE `id_student` = '952' AND `s_y` = '23' AND `h_y` = '1'");
		
		foreach($datas as $item){
			$id = $item['id'];
			$id_faculty = $item['id_faculty'];
			$id_s_l = $item['id_s_l'];
			$id_s_v = $item['id_s_v'];
			$id_course = $item['id_course'];
			$id_spec = $item['id_spec'];
			$id_group = $item['id_group'];
			$id_student = $item['id_student'];
			$s_y = $item['s_y'];
			$h_y = $item['h_y'];
			
			$check = query("SELECT * FROM `students` WHERE 
			`id` != $id AND
			`id_student` = '$id_student' AND
			`id_faculty` = '$id_faculty' AND
			`id_s_l` = '$id_s_l' AND
			`id_s_v` = '$id_s_v' AND
			`id_course` = '$id_course' AND
			`id_spec` = '$id_spec' AND
			`id_group` = '$id_group' AND 
			`s_y` = '$s_y' AND 
			`h_y` = '$h_y'
			");
			
			if(!empty($check)){
				echo $id = $check[0]['id'];
				echo "<br>";
				//delete("students", "`id` = '$id'");
			}
		}
		
		exit;
	break;
	
	case "takror_res":
		$datas = query("
		SELECT `id_student`, `id_fan`, `semestr`, COUNT(*) 
		FROM `results` 
		GROUP BY `id_student`, `id_fan`, `semestr` 
		HAVING COUNT(*) > 1 ORDER BY `results`.`id_student` ASC
		");
		
		foreach($datas as $item){
			$id_student = $item['id_student'];
			$id_fan = $item['id_fan'];
			$semestr = $item['semestr'];
			
			$check = query("SELECT * FROM `results` WHERE 
			`id_student` = '$id_student' AND
			`id_fan` = '$id_fan' AND
			`semestr` = '$semestr'
			");
			
			$id = $check[0]['id'];
			delete("results", "`id` = '$id'");
		}
		echo "ok";
		exit;
	break;
	
	case "load_students":
		$datas = explode("\n", file_get_contents("../modules/ahmad/tut_students_2.txt"));
		
		function checkStringEnd($str) {
			// Используем регулярное выражение для проверки конца строки
			if (preg_match('/[a-zA-Z][0-9]*$/', $str, $matches)) {
				// Если нашли совпадение, возвращаем его
				$search = ["A", "B", "C", "M", "m"];
				$replace = ["А", "В", "С", "А", "А"];
				return str_replace($search, $replace, $matches[0]);
			} else {
				// Если нет совпадений, возвращаем 1
				return "А";
			}
		}
		
		for($i = 0; $i < count($datas); $i++){
			list($id_s_v, $id_faculty, $id_course, $group_str, $fullname_tj, $id_course, $s_y, $semestr) = explode("=====", $datas[$i]);
			$id_s_l = 1;
			if($semestr == 1 || $semestr == 3 || $semestr == 5 || $semestr == 7){
				$h_y = 1;
			}elseif($semestr == 2 || $semestr == 4 || $semestr == 6 || $semestr == 8){
				$h_y = 2;
			}
			
			$check_user = query("SELECT * FROM `users` WHERE `fullname_tj` = '".trim($fullname_tj)."'");
			
			// $check_user = query("SELECT `users`.*, `students`.* FROM `users` 
			// INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
			// WHERE `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y' 
			// AND `users`.`fullname_tj` = '".trim($fullname_tj)."'");
			
			if(!empty($check_user)){
				$id_student = $check_user[0]['id'];
				
				$group_str = trim($group_str);
				
				$code = substr($group_str, 0, -1);
				$group = substr($group_str, -1);
				
				echo $fullname_tj;
				echo "<br>";
				echo $group_str.'<br>';
				
				$spec_info = query("SELECT * FROM `specialties` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `code` = '$code'");
				if(empty($spec_info)){
					exit("SPEC $code not found!");
				}
				$id_spec = $spec_info[0]['id'];
				
				$group = checkStringEnd($group);
				
				$g = query("SELECT * FROM `groups` WHERE `title` = '$group'");
			
				$id_group = $g[0]['id'];
				
				
				$table = "students";
				
				unset($data, $fields);
				
				$data['status'] = "'".clear_admin("1")."'";
				$data['id_student'] = "'".clear_admin($id_student)."'";
				$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
				$data['id_s_l'] = "'".clear_admin(1)."'";
				
				$data['id_spec'] = "'".clear_admin($id_spec)."'";
				$data['id_s_v'] = "'".clear_admin($id_s_v)."'";
				
				
				$data['id_course'] = "'".clear_admin($id_course)."'";
				$data['id_group'] = "'".clear_admin($id_group)."'";
				
				$study_type = query("SELECT `id_s_t` FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
				$id_s_t = $study_type[0]['id_s_t'];
				
				$data['id_s_t'] = "'".clear_admin($id_s_t)."'";
				
				$data['s_y'] = $s_y;
				$data['h_y'] = $h_y;
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				if(insert($table, $fields, $data)){
					isGroupIsset($id_faculty, $id_course, $id_spec, $id_group, $id_s_l, $id_s_v, $s_y, $h_y, '1');
				}
				
			}else{
				echo "Донишҷӯ $fullname_tj ёфт нашуд!<br>";
			}
			
		}
		
		exit;
	break;
	
	case "scores":
		$datas = explode("\n", file_get_contents("../modules/ahmad/tut_marks_10.txt"));
		
		for($i = 0; $i < count($datas); $i++) {
			//list($number, $fullname_tj, $s_y, $h_y, $fan, $nf_score, $mamur_score, $innovation_score, $imt_score) = explode("=====", $datas[$i]);
			list($fullname_tj, $s_y, $semestr, $fan, $credit, $score) = explode("=====", $datas[$i]);
			
			if($semestr == 1 || $semestr == 3 || $semestr == 5 || $semestr == 7){
				$h_y = 1;
			}elseif($semestr == 2 || $semestr == 4 || $semestr == 6 || $semestr == 8){
				$h_y = 2;
			}
			
			$check_user = query("SELECT `students`.*, `users`.* FROM `users` 
			LEFT JOIN `students` ON `students`.`id_student` = `users`.`id` AND `students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y' 
			WHERE `users`.`fullname_tj` = '".trim($fullname_tj)."'");
			
			if(!empty($check_user)){
				
				$id_student = $check_user[0]['id'];
				$id_faculty = $check_user[0]['id_faculty'];
				$id_s_l = $check_user[0]['id_s_l'];
				$id_s_v = $check_user[0]['id_s_v'];
				$id_course = $check_user[0]['id_course'];
				$id_spec = $check_user[0]['id_spec'];
				$id_group = $check_user[0]['id_group'];
				
				// Санҷидани фан
				$check_fan = query("SELECT * FROM `fan_test` WHERE `title_tj` = '".trim($fan)."'");
				if(!empty($check_fan)){
					
					$id_fan = $check_fan[0]['id'];
					
					//echo $id_fan.' '.$fan.'<br>';
					$check_res = query("SELECT * FROM `results` WHERE `id_fan` = '$id_fan' AND 
					`id_student` = '$id_student' AND 
					`semestr` = '$semestr' AND 
					`s_y` = '$s_y' AND 
					`h_y` = '$h_y'");
					
					if(empty($check_res)){
						unset($data, $fields);
						if(!empty($id_faculty))
							$data['id_faculty'] = "'".$id_faculty."'";
						if(!empty($id_s_l))
							$data['id_s_l'] = "'".$id_s_l."'";
						if(!empty($id_s_v))
							$data['id_s_v'] = "'".$id_s_v."'";
						if(!empty($id_course))
							$data['id_course'] = "'".$id_course."'";
						if(!empty($id_spec))
							$data['id_spec'] = "'".$id_spec."'";
						if(!empty($id_group))
							$data['id_group'] = "'".$id_group."'";
						$data['id_student'] = "'".$id_student."'";
						$data['id_fan'] = "'".$id_fan."'";
						$data['type'] = "'1'";
						$data['total_score'] = "'".$score."'";
						
						
						$data['semestr'] = "'".$semestr."'";
						$data['s_y'] = "'".clear_admin($s_y)."'";
						$data['h_y'] = "'".clear_admin($h_y)."'";
						
						$fields = array_keys($data);
						$data = implode(",", $data);
						insert("results", $fields, $data);
					}else{
						unset($fields_res);
						$id = $check_res[0]['id'];
						
						$fields_res['semestr'] = $semestr;
						$fields_res['total_score'] = $score;
						
						update("results", $fields_res, "`id` = '$id'");
					}
					
				}else{
					echo "Фан ёфт нашуд! [$fan] <br>";
				}
			}else{
				//echo "Донишҷӯ ёфт нашуд! [$fullname_tj] <br>";
			}
		}
		
		exit;
	break;
	
	case "makegroup":
		$data = query("SELECT * FROM `students` WHERE `status` = '-1' AND `s_y` = '".S_Y."' ORDER BY `id`");
		
		foreach($data as $item){
			$id_faculty = $item['id_faculty'];
			$id_course = $item['id_course'];
			$id_spec = $item['id_spec'];
			$id_group = $item['id_group'];
			$id_s_l = $item['id_s_l'];
			$id_s_l = $item['id_s_l'];
			$id_s_v = $item['id_s_v'];
			
			isGroupIsset($id_faculty, $id_course, $id_spec, $id_group, $id_s_l, $id_s_v, S_Y, H_Y, '-1');
			isGroupIsset($id_faculty, $id_course, $id_spec, $id_group, $id_s_l, $id_s_v, S_Y, H_Y, '1');
		}
		
		exit;
		
	break;
	
	case "teachers":
		$spreadsheet = $reader->load($_SERVER['DOCUMENT_ROOT']."/modules/ahmad/teachers.xlsx");
		$reader->setReadDataOnly(true);
		$sheetsCount = $spreadsheet->getSheetCount();
		$data_excel = $spreadsheet->getSheet(0)->toArray();
		//print_arr($data_excel);
		
		for($i = 2; $i < count($data_excel); $i++){
			unset($data_user, $fields);
			$name = trim($data_excel[$i][0]);
			
			$data_user['fullname_tj'] = "'".$name."'";
			$data_user['fullname_ru'] = "'".$name."'";
			
			$login = makeLogin($name, rand(1,100000));
			
			$data_user['login'] = "'".$login."'";
			$data_user['password'] = "'".$login."'";
			
			if($data_excel[$i][1] != ''){
				$birth = explode("/", $data_excel[$i][1]);
				$data_user['birthday'] = "'{$birth[2]}-".sprintf("%02d", $birth[0])."-".sprintf("%02d", $birth[1])."'";
			}
			
			if($data_excel[$i][2] == 'Мард'){
				$data_user['jins'] = 1;
			}else{
				$data_user['jins'] = 0;
			}
			
			$id_country = $data_excel[$i][3];
			
			$n = trim($data_excel[$i][4]);
			$nation = query("SELECT * FROM `nations` WHERE `title` LIKE '%$n%'");
			$id_nation = $nation[0]['id'];
			
			$address = $data_excel[$i][10];
			
			$phone = $data_excel[$i][11];
			
			$data_user['phone'] = "'".$phone."'";
			$data_user['access'] = 1;
			$data_user['access_type'] = 2;
			$data_user['added_time'] = "'".date("Y-m-d H:i:s")."'";
			
			
			$fields_user = array_keys($data_user);
			$data_user = implode(",", $data_user);
			
			if($id_user = insert("users", $fields_user, $data_user)){
				echo $i.'<br>';
				unset($passport_data, $passport_fields);
				$table = "user_passports";
				$passport_data['id_user'] = "'".clear_admin($id_user)."'";
				if($address != '')
					$passport_data['address'] = "'".clear_admin($address)."'";
				
				$passport_fields = array_keys($passport_data);
				$passport_data = implode(",", $passport_data);
				
				insert($table, $passport_fields, $passport_data);
			}
		}
		
		echo "ok";
		exit;
	break;
	
	case "old_stds":
		exit;
		function checkStringEnd($str) {
			// Используем регулярное выражение для проверки конца строки
			if (preg_match('/[a-zA-Z][0-9]*$/', $str, $matches)) {
				// Если нашли совпадение, возвращаем его
				$search = ["A", "B", "C", "M", "m"];
				$replace = ["А", "В", "С", "А", "А"];
				return str_replace($search, $replace, $matches[0]);
			} else {
				// Если нет совпадений, возвращаем 1
				return "А";
			}
		}
		
		//$spreadsheet = $reader->load($_SERVER['DOCUMENT_ROOT']."/userfiles/davrho/$baseName");
		$spreadsheet = $reader->load($_SERVER['DOCUMENT_ROOT']."/modules/ahmad/old_datas.xlsx");
		$reader->setReadDataOnly(true);
		$sheetsCount = $spreadsheet->getSheetCount();
		$data_excel = $spreadsheet->getSheet(0)->toArray();
		
		
		for($i = 2124; $i < count($data_excel); $i++){
			echo $i.'<br>';
			//1990-08-23
			//8/29/1991
			
			unset($data_user);
			
			$name = str_replace("*", "", $data_excel[$i][0]);
			echo $name;
			echo "<br>";
			
			$data_user['fullname_tj'] = "'".$name."'";
			$data_user['fullname_ru'] = "'".$name."'";
			
			if($data_excel[$i][1] != ''){
				$birth = explode("/", $data_excel[$i][1]);
				$data_user['birthday'] = "'{$birth[2]}-".sprintf("%02d", $birth[0])."-".sprintf("%02d", $birth[1])."'";
			}
			
			if($data_excel[$i][5] != '')
				$data_user['phone'] = "'".str_replace("-", "", $data_excel[$i][5])."'";
			
			if($data_excel[$i][6] != '')
				$data_user['phone_parents'] = "'".str_replace("-", "", $data_excel[$i][6])."'";
			
			
			echo "ID FACULTY ";
			echo $id_faculty = $data_excel[$i][7];
			echo "<br>";
			echo "ID LEVEL ";
			echo $id_s_l = $data_excel[$i][8];
			echo "<br>";
			echo "ID VIEW ";
			echo $id_s_v = $data_excel[$i][13];
			echo "<br>";
			echo "ID STUDY TYPE ";
			echo $id_s_t = $data_excel[$i][14];
			echo "<br>";
			echo "ID COURSE ";
			echo $id_course = $data_excel[$i][9] + 1;
			echo "<br>";
			
			$group = checkStringEnd($data_excel[$i][11]);
			echo $data_excel[$i][11].' | '.$group;
			echo "<br>";
			$g = query("SELECT * FROM `groups` WHERE `title` = '$group'");
			
			echo "ID GROUP ".$id_group = $g[0]['id'];
			echo "<br>";
			
			$s_d = S_Y + 1 - $id_course;
			
			
			$query = query("SELECT COUNT(`id`) as `n` FROM `students` WHERE `status` = '1' AND `id_faculty` = '$id_faculty' AND `s_y` = '".S_Y."'");
		
		
			$num = $query[0]['n'] + 1;
			
			$login = 20 .$s_d.sprintf("%02d", $id_faculty).sprintf("%04d", $num);
			$data_user['login'] = "'".$login."'";
			$data_user['password'] = "'".$login."'";
			
			if($data_excel[$i][2] == 'Мард'){
				$data_user['jins'] = 1;
			}else{
				$data_user['jins'] = 0;
			}
			
			$data_user['access'] = 1;
			$data_user['access_type'] = 3;
			$data_user['added_time'] = "'".date("Y-m-d H:i:s")."'";
				
			$fields_user = array_keys($data_user);
			$data_user = implode(",", $data_user);
			/*Иловакунии маълумотҳо дар таблитсаи USERS */
			
			
			$spec_code = str_replace(" ", "", str_replace("M", "М", trim($data_excel[$i][10])));
			
			$spec_info = query("SELECT * FROM `specialties` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `code` = '$spec_code'");
			
			echo "ID SPEC ".$id_spec = $spec_info[0]['id'];
			echo "<br>";
			echo "SPEC TITLE ".$spec_title = $spec_info[0]['title_tj'];
			echo "<br>";
			
			//print_arr($data_user);
			
			
			
			if($id_student = insert("users", $fields_user, $data_user)){
				
				
				unset($passport_data, $passport_fields);
				$table = "user_passports";
				$passport_data['id_user'] = "'".clear_admin($id_student)."'";
				if($data_excel[$i][4] != '')
					$passport_data['address'] = "'".clear_admin($data_excel[$i][4])."'";
				
				$passport_fields = array_keys($passport_data);
				$passport_data = implode(",", $passport_data);
				
				insert($table, $passport_fields, $passport_data);
				
				
				unset($edu_data, $edu_fields);
				$table = "user_udecation";
				$edu_data['id_user'] = "'".clear_admin($id_student)."'";
				
				$edu_fields = array_keys($edu_data);
				$edu_data = implode(",", $edu_data);
				insert($table, $edu_fields, $edu_data);
				
				unset($mmt_data, $mmt_fields);
				$table = "student_mmt_information";
				$mmt_data['id_student'] = "'".clear_admin($id_student)."'";
				
				$mmt_fields = array_keys($mmt_data);
				$mmt_data = implode(",", $mmt_data);
				insert($table, $mmt_fields, $mmt_data);
				
				
				$table = "students";
				
				unset($data, $fields);
				
				$data['status'] = "'".clear_admin("1")."'";
				$data['id_student'] = "'".clear_admin($id_student)."'";
				$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
				$data['id_s_l'] = "'".clear_admin($id_s_l)."'";
				
				$data['id_spec'] = "'".clear_admin($id_spec)."'";
				$data['id_s_v'] = "'".clear_admin($id_s_v)."'";
				
				
				$data['id_course'] = "'".clear_admin($id_course)."'";
				$data['id_group'] = "'".clear_admin($id_group)."'";
				$data['id_s_t'] = "'".clear_admin($id_s_t)."'";
				
				$data['s_y'] = S_Y;
				$data['h_y'] = 1;
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				if(insert($table, $fields, $data)){
					isGroupIsset($id_faculty, $id_course, $id_spec, $id_group, $id_s_l, $id_s_v, S_Y, H_Y, '1');
				}
			}
			
			
			
			
			
			
			
			
			
			
			
		}
		
		exit;
		
	break;
	
	
	
	case "solhoi_pesh":
		$data = query("SELECT * FROM `students` WHERE `status` = '1' AND `s_y` = '23' AND `h_y` = '2' ORDER BY RAND() LIMIT 10");
		
		foreach($data as $item){
			$id_student = $item['id_student'];
			$course = $item['id_course'];
			echo "Course = ".$course."<br>";
			
			if($course == 4){
				for($s_y = 23, $c = $course; $c >= 1; $c--, $s_y--){
					for($h_y = 1; $h_y <= 2; $h_y++){
						
						$check = query2("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
						echo "<br>";
						
						if(empty($check)){
							
						}
					}
				}
			}
		}
		
		exit;
		
	break;
	
	
	case "course2course":
		/*
		$s_y = 23;
		$h_y = 2;
		$id_s_l = 4;
		$id_s_v = '1,2';
		$id_course = 1;
		
		//$id_spec = '48,51';
		
		
		
		$groups_datas = query2("SELECT * FROM `std_study_groups` 
		WHERE `status` = '1' AND `s_y` = '$s_y' AND `h_y` = '$h_y' AND `id_s_l` = '$id_s_l' AND `id_course` = '$id_course'
		ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`
		");
		
		echo count($groups_datas);
		echo "<br>";
		
		$new_s_y = 24;
		$new_h_y = 1;
		
		foreach($groups_datas as $item){
			$status = $item['status'];
			$id_faculty = $item['id_faculty'];
			$id_s_l = $item['id_s_l'];
			$id_s_v = $item['id_s_v'];
			$id_course = $item['id_course'] + 1;
			$id_spec = $item['id_spec'];
			$id_group = $item['id_group'];
			$lang = $item['lang'];
			$id_nt = $item['id_nt'];
			
			$check = query("SELECT `id` FROM `std_study_groups` 
			WHERE `status` = '1' AND
			`id_faculty` = '$id_faculty' AND 
			`id_s_l` = '$id_s_l' AND 
			`id_s_v` = '$id_s_v' AND 
			`id_course` = '$id_course' AND 
			`id_spec` = '$id_spec' AND 
			`id_group` = '$id_group' AND 
			`s_y` = '$new_s_y' AND 
			`h_y` = '$new_h_y'");
			
			if(empty($check)){
				unset($data, $fields);
				
				$data['status'] = $status;
				$data['id_faculty'] = $id_faculty;
				$data['id_s_l'] = $id_s_l;
				$data['id_s_v'] = $id_s_v;
				$data['id_course'] = $id_course;
				$data['id_spec'] = $id_spec;
				$data['id_group'] = $id_group;
				$data['lang'] = "'".$lang."'";
				if(isset($id_nt))
					$data['id_nt'] = $id_nt;
				$data['s_y'] = $new_s_y;
				$data['h_y'] = $new_h_y;
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				if(insert("std_study_groups", $fields, $data)){
					echo "group INSERTED<br>";
				}
			}
		}
		
		exit;
		*/
		$s_y = 23;
		$h_y = 2;
		$id_s_l = 4;
		$id_s_v = '1,2';
		$id_course = 1;
		
		
		$new_s_y = 24;
		$new_h_y = 1;
		
		
		//$id_spec = '48,51';
		
		
		$students_datas = query2("SELECT * FROM `students` WHERE `status` = 1 AND `id_s_l` = '$id_s_l' AND `id_s_v` IN ($id_s_v) 
		AND `id_course` = '$id_course' AND `s_y` = $s_y AND `h_y` = '$h_y'");
		
		echo count($students_datas);
		echo "<br>";
		
		
		foreach($students_datas as $item){
			$status = $item['status'];
			$id_student = $item['id_student'];
			$id_faculty = $item['id_faculty'];
			$id_s_l = $item['id_s_l'];
			$id_s_v = $item['id_s_v'];
			$id_course = $item['id_course'] + 1;
			$id_spec = $item['id_spec'];
			$id_group = $item['id_group'];
			$id_s_t = $item['id_s_t'];
			$foreign = $item['foreign'];
			$vazi_oilavi = $item['vazi_oilavi'];
			
			
			$check = query("SELECT `id` FROM `students` 
			WHERE `id_student` = '$id_student' AND
			`s_y` = '$new_s_y' AND `h_y` = '$new_h_y'");
			
			if(empty($check)){
				unset($data, $fields);
				
				$data['status'] = $status;
				$data['id_student'] = $id_student;
				$data['id_faculty'] = $id_faculty;
				$data['id_s_l'] = $id_s_l;
				$data['id_s_v'] = $id_s_v;
				$data['id_course'] = $id_course;
				$data['id_spec'] = $id_spec;
				$data['id_group'] = $id_group;
				$data['id_s_t'] = $id_s_t;
				if(isset($foreign))
					$data['foreign'] = $foreign;
				$data['vazi_oilavi'] = $vazi_oilavi;
				$data['s_y'] = $new_s_y;
				$data['h_y'] = $new_h_y;
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				if(insert("students", $fields, $data)){
					echo "STUDENT INSERTED<br>";
				}
			}
		}
		
		exit;
	break;
	
	case "reg_new_dowtalabs":
		
		$datas = explode("\n", file_get_contents("../modules/ahmad/dovtalab_3.txt"));
		
		echo "Оғози кор: ".date("d.m.Y, H:i:s");
		echo "<br>";
		echo  "миқдори маълумотҳо: ".count($datas);
		echo "<br>";
		
		for($i = 0; $i < count($datas); $i++) {
			
			unset($data, $user2_fields);
			$fio = $datas[$i];
			
			
			$data['fio'] = "'".clear_admin($fio)."'";
			$data['type'] = 1;
			$data['ac'] = 24;
			
			$data['level'] = 6;
			$user2_fields = array_keys($data);
			$user2_data = implode(",", $data);
			
			insert('users_2', $user2_fields, $user2_data);
		}
		
		exit;
	break;
	
	case "load_rasm":
		
		$datas = explode("\n", file_get_contents("../modules/ahmad/photo.txt"));
		
		echo "Оғози кор: ".date("d.m.Y, H:i:s");
		echo "<br>";
		echo  "миқдори маълумотҳо: ".count($datas);
		echo "<br>";
		
		for($i = 0; $i < count($datas); $i++) {
			list($name, $photo) = explode("====", $datas[$i]);
			
			$check_user = query("SELECT * FROM `users` WHERE `fullname_tj` = '".trim($name)."'");
			
			if(!empty($check_user)){
				$id_user = $check_user[0]['id'];
				
				//if(!$check_user[0]['photo']){
					unset($fields_users);
					$photo = trim($photo);
					$fields_users['photo'] = $photo;
					update("users", $fields_users, "`id` = '$id_user'");
				//}
			}
			
		}
		
		echo "Маълумотҳо сабт шуданд. Анҷоми кор: ".date("d.m.Y, H:i:s");
		exit;
	break;
	
	case "litsey":
		//SELECT * FROM `student_litsey`
		if(isset($_REQUEST['s_y']) && isset($_REQUEST['h_y'])){
			$s_y = $_REQUEST['s_y'];
			$h_y = $_REQUEST['h_y'];
			$students_datas = query("SELECT * FROM `student_litsey` 
			WHERE `s_y` = '$s_y' AND `h_y` = '$h_y'");
			
			$new_s_y = 23;
			$new_h_y = 2;
			
			foreach($students_datas as $item){
				$id_xonanda = $item['id_xonanda'];
				$id_sinf = $item['id_sinf'];
				$id_group = $item['id_group'];
				
				$s_y = $item['s_y'];
				$h_y = $item['h_y'];
				
				$check = query("SELECT `id` FROM `student_litsey` 
				WHERE `id_xonanda` = '$id_xonanda' AND
				`s_y` = '$new_s_y' AND 
				`h_y` = '$new_h_y'");
				
				if(empty($check)){
					unset($data, $fields);
					
					$data['id_xonanda'] = $id_xonanda;
					$data['id_sinf'] = $id_sinf;
					$data['id_group'] = $id_group;
					$data['s_y'] = $new_s_y;
					$data['h_y'] = $new_h_y;
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					
					if(insert("student_litsey", $fields, $data)){
						echo "STUDENT LITSEY INSERTED<br>";
					}
				}
				
			}
		}else{
			echo "Параметрҳо мавҷуд нест";
		}
		exit;
	break;
	
	case "nimsola":
		
		if(isset($_REQUEST['s_y']) && isset($_REQUEST['h_y'])){
			$s_y = $_REQUEST['s_y'];
			$h_y = $_REQUEST['h_y'];
		
		
			$groups_datas = query("SELECT * FROM `std_study_groups` 
			WHERE `status` = '1' AND `s_y` = '$s_y' AND `h_y` = '$h_y' 
			ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`
			");
			
			
			
			$new_s_y = 24;
			$new_h_y = 2;
			
			foreach($groups_datas as $item){
				$status = $item['status'];
				$id_faculty = $item['id_faculty'];
				$id_s_l = $item['id_s_l'];
				$id_s_v = $item['id_s_v'];
				$id_course = $item['id_course'];
				$id_spec = $item['id_spec'];
				$id_group = $item['id_group'];
				$lang = $item['lang'];
				$id_nt = $item['id_nt'];
				
				$check = query("SELECT `id` FROM `std_study_groups` 
				WHERE `status` = '1' AND
				`id_faculty` = '$id_faculty' AND 
				`id_s_l` = '$id_s_l' AND 
				`id_s_v` = '$id_s_v' AND 
				`id_course` = '$id_course' AND 
				`id_spec` = '$id_spec' AND 
				`id_group` = '$id_group' AND 
				`s_y` = '$new_s_y' AND 
				`h_y` = '$new_h_y'");
				
				if(empty($check)){
					unset($data, $fields);
					
					$data['status'] = $status;
					$data['id_faculty'] = $id_faculty;
					$data['id_s_l'] = $id_s_l;
					$data['id_s_v'] = $id_s_v;
					$data['id_course'] = $id_course;
					$data['id_spec'] = $id_spec;
					$data['id_group'] = $id_group;
					$data['lang'] = "'".$lang."'";
					if(isset($id_nt))
						$data['id_nt'] = $id_nt;
					$data['s_y'] = $new_s_y;
					$data['h_y'] = $new_h_y;
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					
					if(insert("std_study_groups", $fields, $data)){
						echo "group INSERTED<br>";
					}
				}
			}
			
			echo "<hr>";
			
			$students_datas = query("SELECT * FROM `students` 
			WHERE `status` = '1' AND `s_y` = '$s_y' AND `h_y` = '$h_y' 
			ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`
			");
			
			foreach($students_datas as $item){
				$status = $item['status'];
				$id_student = $item['id_student'];
				$id_faculty = $item['id_faculty'];
				$id_s_l = $item['id_s_l'];
				$id_s_v = $item['id_s_v'];
				$id_course = $item['id_course'];
				$id_spec = $item['id_spec'];
				$id_group = $item['id_group'];
				$id_s_t = $item['id_s_t'];
				$foreign = $item['foreign'];
				$vazi_oilavi = $item['vazi_oilavi'];
				
				
				$check = query("SELECT `id` FROM `students` 
				WHERE `id_student` = '$id_student' AND
				`s_y` = '$new_s_y' AND 
				`h_y` = '$new_h_y'");
				
				if(empty($check)){
					unset($data, $fields);
					
					$data['status'] = $status;
					$data['id_student'] = $id_student;
					$data['id_faculty'] = $id_faculty;
					$data['id_s_l'] = $id_s_l;
					$data['id_s_v'] = $id_s_v;
					$data['id_course'] = $id_course;
					$data['id_spec'] = $id_spec;
					$data['id_group'] = $id_group;
					$data['id_s_t'] = $id_s_t;
					if(isset($foreign))
						$data['foreign'] = $foreign;
					$data['vazi_oilavi'] = $vazi_oilavi;
					$data['s_y'] = $new_s_y;
					$data['h_y'] = $new_h_y;
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					
					if(insert("students", $fields, $data)){
						echo "STUDENT INSERTED<br>";
					}
				}
				
			}
		}else{
			echo "Параметрҳо мавҷуд нест";
		}
		exit;
	break;
	
	
	case "load_old_data":
		// барои бакалаврият
		$datas = explode("\n", file_get_contents("../modules/ahmad/old_data.txt"));
		
		// барои магистратонт ва маълумотҳои 2юм
		//$datas = explode("\n", file_get_contents("../modules/ahmad/old_mag.txt"));
		
		echo "Оғози кор: ".date("d.m.Y, H:i:s");
		echo "<br>";
		echo  "миқдори маълумотҳо: ".count($datas);
		echo "<br>";
		
		$pattern_for_ttu = '/^([А-Яа-я\/]+)([\d\-]+)([А-Яа-я\d]+)$/';
		for($i = 0; $i < count($datas); $i++) {
			list($id_faculty, $id_s_v, $name, $group, $id_course, $h_y, $s_y, $fan, $imt_type, $credit, $total_score) = explode("====", $datas[$i]);
			
			$total_score = str_replace(",", ".", $total_score);
			
			$total_score = round($total_score, 2);
			$check_user = query("SELECT * FROM `users` WHERE `fullname_tj` = '".trim($name)."'");
			
			if(!empty($check_user) && count($check_user) < 2){
				$id_student = $check_user[0]['id'];
				
				echo $check_user[0]['fullname_tj'];
				echo "<br>";
				
				if (preg_match($pattern_for_ttu, $group, $matches)) {
					if($matches[1] == 'Д/О' || $matches[1] == 'Д/ОА' || $matches[1] == 'Д/ОБ'){
						$id_s_l = 1;
					}elseif($matches[1] == 'Д/С'){
						$id_s_l = 1;
					}elseif($matches[1] == 'М/Г'){
						$id_s_l = 3;
					}elseif($matches[1] == "В/О"){
						$id_s_l = 2;
					}
					
					$spec_code = $matches[2]; // 1-530102
					$spec = query("SELECT * FROM `specialties` WHERE `code` = '$spec_code' AND `id_s_l` = '$id_s_l'");
					if(!empty($spec)){
						$id_faculty = $spec[0]['id_faculty'];
						$id_spec = $spec[0]['id'];
					}
					
					$group_code = $matches[3]; // Б
					$group = query("SELECT * FROM `groups` WHERE `title` = '$group_code'");
					if(!empty($group)){
						$id_group = $group[0]['id'];
					}
					
					$student = query("SELECT * FROM `students` WHERE 
					`status` = '1' AND 
					`id_student` = '$id_student' AND 
					`id_faculty` = '$id_faculty' AND 
					`id_s_l` = '$id_s_l' AND 
					`id_s_v` = '$id_s_v' AND 
					`id_course` = '$id_course' AND 
					`id_spec` = '$id_spec' AND 
					`id_group` = '$id_group' AND 
					`s_y` = '$s_y' AND
					`h_y` = '$h_y'");
					
					echo "<br>";
					
					if(empty($student)){
						unset($data, $fields);
						
						$data['status'] = "'".clear_admin(1)."'";
						$data['id_student'] = "'".clear_admin($id_student)."'";
						$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
						$data['id_s_l'] = "'".clear_admin($id_s_l)."'";
						
						$data['id_spec'] = "'".clear_admin($id_spec)."'";
						$data['id_s_v'] = "'".clear_admin($id_s_v)."'";
						
						$data['id_course'] = "'".clear_admin($id_course)."'";
						$data['id_group'] = "'".clear_admin($id_group)."'";
						
						
						$study_type = query("SELECT `id_s_t` FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
						
						if(!empty($study_type))
							$data['id_s_t'] = "'".$study_type[0]['id_s_t']."'";
						else 
							$data['id_s_t'] = "'1'";
						
						$data['s_y'] = $s_y;
						$data['h_y'] = $h_y;
						
						$fields = array_keys($data);
						$data = implode(",", $data);
						
						if(insert("students", $fields, $data)){
							/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
							isGroupIsset($id_faculty, $id_course, $id_spec, $id_group, $id_s_l, $id_s_v, $s_y, $h_y);
							/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
							
						}	
					}
					
					// Санҷидани фан
					$check_fan = query("SELECT * FROM `fan_test` WHERE `title_tj` = '".trim($fan)."'");
				
					if(!empty($check_fan)){
						
						$id_fan = $check_fan[0]['id'];
						
						echo $id_fan.' '.$fan.'<br>';
						
						/*Иловакунии фан дар нақшаи таълимӣ*/
						
						//$check_id_nt = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
						
						//$check_std_study_group = query("SELECT `id_nt` FROM `std_study_groups` WHERE `id_faculty` = '$id_faculty'");
						
						/*Иловакунии фан дар нақшаи таълимӣ*/
						
						
						
						$check_res = query("SELECT * FROM `results` WHERE `id_fan` = '$id_fan' AND 
						`id_student` = '$id_student' AND 
						`id_faculty` = '$id_faculty' AND 
						`id_s_l` = '$id_s_l' AND 
						`id_s_v` = '$id_s_v' AND 
						`id_course` = '$id_course' AND 
						`id_spec` = '$id_spec' AND 
						`id_group` = '$id_group' AND 
						`s_y` = '$s_y' AND 
						`h_y` = '$h_y'");
						
						if($imt_type == "Имтиҳон" || $imt_type == "Таҷрибаомузӣ"){
							if(empty($check_res)){
								unset($data, $fields);
								$data['id_faculty'] = "'".$id_faculty."'";
								$data['id_s_l'] = "'".$id_s_l."'";
								$data['id_s_v'] = "'".$id_s_v."'";
								$data['id_course'] = "'".$id_course."'";
								$data['id_spec'] = "'".$id_spec."'";
								$data['id_group'] = "'".$id_group."'";
								$data['id_student'] = "'".$id_student."'";
								$data['id_fan'] = "'".$id_fan."'";
								$data['type'] = "'1'";
								$data['total_score'] = "'".$total_score."'";
								$data['total_score_author'] = "'".$_SESSION['user']['id']."'";
								$data['s_y'] = "'".clear_admin($s_y)."'";
								$data['h_y'] = "'".clear_admin($h_y)."'";
								
								$fields = array_keys($data);
								$data = implode(",", $data);
								insert("results", $fields, $data);
							}else{
								unset($fields_res);
								$id = $check_res[0]['id'];
								$fields_res['total_score'] = $total_score;
								//update("results", $fields_res, "`id` = '$id'");
							}
						}elseif($imt_type == "Лоиҳаи курсӣ" || $imt_type == "Кори курсӣ"){
							unset($fields_res);
							$id = $check_res[0]['id'];
							$fields_res['kori_kursi'] = $total_score;
							//update("results", $fields_res, "`id` = '$id'");
						}
						
					}else{
						echo "Фан ёфт нашуд! [$fan] <br>";
					}
					
					
					
				}
				
				
				
				/*
				$student = query("SELECT * FROM `students` WHERE 
				`status` = '1'  AND `id_student` = '$id_student' 
				AND `id_s_v` = '2' ORDER BY `id` DESC");
				
				if(!empty($student)){
					echo $i.'. '.$id_student.' '.$name.'<br>';
					$id_faculty = $student[0]['id_faculty'];
					$id_s_l = $student[0]['id_s_l'];
					$id_s_v = $student[0]['id_s_v'];
					$id_course = $student[0]['id_course'];
					$id_spec = $student[0]['id_spec'];
					$id_group = $student[0]['id_group'];
					
					
					$check_fan = query("SELECT * FROM `fan_test` WHERE `title_tj` = '".trim($fan)."'");
					
					if(!empty($check_fan)){
						
						$id_fan = $check_fan[0]['id'];
						
						$check_res = query("SELECT * FROM `results` WHERE `id_fan` = '$id_fan' AND `id_student` = '$id_student' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
						
						if(empty($check_res)){
							unset($data, $fields);
							$data['id_faculty'] = "'".$id_faculty."'";
							$data['id_s_l'] = "'".$id_s_l."'";
							$data['id_s_v'] = "'".$id_s_v."'";
							$data['id_course'] = "'".$id_course."'";
							$data['id_spec'] = "'".$id_spec."'";
							$data['id_group'] = "'".$id_group."'";
							$data['id_student'] = "'".$id_student."'";
							$data['id_fan'] = "'".$id_fan."'";
							$data['type'] = "'1'";
							$data['nf_1_score'] = "'".$nf_1_score."'";
							$data['nf_1_add_date'] = "'".date("d.m.y, H:i", time())."'";
							$data['nf_1_author'] = "'".$_SESSION['user']['id']."'";
							$data['nf_2_score'] = "'".$nf_2_score."'";
							$data['nf_2_add_date'] = "'".date("d.m.y, H:i", time())."'";
							$data['nf_2_author'] = "'".$_SESSION['user']['id']."'";
							$data['s_y'] = "'".clear_admin($S_Y)."'";
							$data['h_y'] = "'".clear_admin($H_Y)."'";
						
						
							$fields = array_keys($data);
							$data = implode(",", $data);
							insert("results", $fields, $data);
						}else{
							unset($fields_res);
							$id = $check_res[0]['id'];
							$fields_res['nf_1_score'] = $nf_1_score;
							$fields_res['nf_2_score'] = $nf_2_score;
							update("results", $fields_res, "`id` = '$id'");
						}
						
					}else{
						echo "<br>Бо методи ман<br>";
						echo $fan.'<br>';
						
						$data = query("SELECT * FROM `fan_test` WHERE MATCH(`title_tj`) AGAINST ('$fan' IN NATURAL LANGUAGE MODE)");
						
						//print_arr($data);
						
						if(!empty($data)){
						
							$arr = [];
							foreach($data as $d_item){
								$id = $d_item['id'];
								$our = $d_item['title_tj'];
								similar_text(mb_strtolower($fan), mb_strtolower($our), $persent);
								if($persent > 70){
									echo $id.' '.$our.' --- '.$persent.'<br>';
									$arr[] = $d_item['id'];
								}
							}
							asort($arr);
							$id_fans = implode(",", $arr);
							
							$tests = query("SELECT * FROM `tests` WHERE `id_faculty` = '$id_faculty'
							AND `id_s_l` = '$id_s_l'
							AND `id_s_v` = '$id_s_v'
							AND `id_course` = '$id_course'
							AND `id_spec` = '$id_spec'
							AND `id_group` = '$id_group'
							AND `s_y` = '".S_Y."'
							AND `h_y` = '".H_Y."'
							AND `id_fan` IN ($id_fans)
							");
							
							if(!empty($tests)){
								$id_fan = $tests[0]['id_fan'];
								
								echo "OUR FAN [$id_fan] ".getFanTest($id_fan);
								echo "<br>";
								
								$check_res = query("SELECT * FROM `results` WHERE `id_fan` = '$id_fan' AND `id_student` = '$id_student' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
							
								if(empty($check_res)){
									unset($data, $fields);
									$data['id_faculty'] = "'".$id_faculty."'";
									$data['id_s_l'] = "'".$id_s_l."'";
									$data['id_s_v'] = "'".$id_s_v."'";
									$data['id_course'] = "'".$id_course."'";
									$data['id_spec'] = "'".$id_spec."'";
									$data['id_group'] = "'".$id_group."'";
									$data['id_student'] = "'".$id_student."'";
									$data['id_fan'] = "'".$id_fan."'";
									$data['type'] = "'1'";
									$data['nf_1_score'] = "'".$nf_1_score."'";
									$data['nf_1_add_date'] = "'".date("d.m.y, H:i", time())."'";
									$data['nf_1_author'] = "'".$_SESSION['user']['id']."'";
									$data['nf_2_score'] = "'".$nf_2_score."'";
									$data['nf_2_add_date'] = "'".date("d.m.y, H:i", time())."'";
									$data['nf_2_author'] = "'".$_SESSION['user']['id']."'";
									$data['s_y'] = "'".clear_admin($S_Y)."'";
									$data['h_y'] = "'".clear_admin($H_Y)."'";
								
								
									$fields = array_keys($data);
									$data = implode(",", $data);
									insert("results", $fields, $data);
								}else{
									unset($fields_res);
									$id = $check_res[0]['id'];
									$fields_res['nf_1_score'] = $nf_1_score;
									$fields_res['nf_2_score'] = $nf_2_score;
									update("results", $fields_res, "`id` = '$id'");
								}
							}
						}
					}
				}
				*/
			}else{
				// Бояд донишҷура сабт кунем
			}
			
			echo "<br>---<br>";
		}
		
		echo "Маълумотҳо сабт шуданд. Анҷоми кор: ".date("d.m.Y, H:i:s");
		exit;
	break;
	
	
	case "qarzdorho":
		$id_faculty = 1;
		$id_s_l = 1;
		$id_s_v = 1;
		$id_course = 1;
		$id_spec = 1;
		$id_group = 1;
		
		$s_y = 23;
		$h_y = 1;
		
		
		$qarzdorho = query("
		SELECT 
			`students`.*,
			`faculties`.`short_title` AS `faculty_short`,
			`specialties`.`code` AS `spec_code`,
			`study_type`.`title` as `study_type_title`,
			`study_view`.`title` as `study_view_title`,
			`study_level`.`title` as `study_level_title`,
			`groups`.`title` AS `group_title`,
			`fan_test`.`title_tj` AS `fan_title`,
			`users`.`fullname_tj`,
			`tests`.*,
			`results`.`id`, IFNULL(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`), 0) as `total_score`,
			`std_study_groups`.`id_nt`
		FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		INNER JOIN `faculties` ON `students`.`id_faculty` = `faculties`.`id`
		INNER JOIN `specialties` ON `students`.`id_spec` = `specialties`.`id`
		INNER JOIN `study_type` ON `students`.`id_s_t` = `study_type`.`id`
		INNER JOIN `study_view` ON `students`.`id_s_v` = `study_view`.`id`
		INNER JOIN `study_level` ON `students`.`id_s_l` = `study_level`.`id`
		INNER JOIN `groups` ON `students`.`id_group` = `groups`.`id`
		
		INNER JOIN `std_study_groups` ON 
			`students`.`id_faculty` = `std_study_groups`.`id_faculty` AND 
			`students`.`id_s_l` = `std_study_groups`.`id_s_l` AND 
			`students`.`id_s_v` = `std_study_groups`.`id_s_v` AND 
			`students`.`id_course` = `std_study_groups`.`id_course` AND 
			`students`.`id_spec` = `std_study_groups`.`id_spec` AND 
			`students`.`id_group` = `std_study_groups`.`id_group` AND
			`students`.`s_y` = `std_study_groups`.`s_y` AND
			`students`.`h_y` = `std_study_groups`.`h_y`
		INNER JOIN `tests` ON 
			`students`.`id_faculty` = `tests`.`id_faculty` AND 
			`students`.`id_s_l` = `tests`.`id_s_l` AND 
			`students`.`id_s_v` = `tests`.`id_s_v` AND 
			`students`.`id_course` = `tests`.`id_course` AND 
			`students`.`id_spec` = `tests`.`id_spec` AND 
			`students`.`id_group` = `tests`.`id_group` AND
			`students`.`s_y` = `tests`.`s_y` AND
			`students`.`h_y` = `tests`.`h_y`
			
		INNER JOIN `results` ON
			`tests`.`id_fan` = `results`.`id_fan` AND 
			`students`.`id_student` = `results`.`id_student` AND 
			`students`.`id_faculty` = `results`.`id_faculty` AND 
			`students`.`id_s_l` = `results`.`id_s_l` AND 
			`students`.`id_s_v` = `results`.`id_s_v` AND 
			`students`.`id_course` = `results`.`id_course` AND 
			`students`.`id_spec` = `results`.`id_spec` AND 
			`students`.`id_group` = `results`.`id_group` AND
			`students`.`s_y` = `results`.`s_y` AND
			`students`.`h_y` = `results`.`h_y`
		INNER JOIN `fan_test` ON `tests`.`id_fan` = `fan_test`.`id`	
		WHERE `students`.`status` = '1' 
		AND `students`.`id_faculty` != 7
		AND `students`.`id_s_l` = '$id_s_l'
		AND `students`.`id_s_v` = '$id_s_v'
		
		AND `students`.`s_y` = '$s_y' 
		AND `students`.`h_y` = '$h_y'
		GROUP BY `students`.`id`, `tests`.`id`, `results`.`id`, `std_study_groups`.`id`
		HAVING
			`total_score` < 50.00 
		ORDER BY `students`.`id_faculty`, `students`.`id_s_l`, `students`.`id_s_v`,
		`students`.`id_course`, `students`.`id_spec`, `students`.`id_group`,
		`users`.`fullname_tj`, `tests`.`id_fan`
		
		");
		
		//print_arr($qarzdorho);
		
		$page_info['title'] = 'Қарздорҳо';
		
		//include("views/qarzdorho.php");
		
	break;
	
	
	case "fcm":
		$data = query("SELECT * FROM `results` WHERE `id_faculty` = 4 AND `id_s_l` = 1 AND `id_s_v` = 1 AND `id_course` = 1 AND `id_group` = 2 AND `id_fan` = 8 AND `s_y` = 23 AND `h_y` = 1");
		$i = 0;
		foreach($data as $item){
			$id = $item['id'];
			unset($fields);
			
			$fields['imt_score'] = $item['imt_score'] + 10;
			
			$total_score = (($item['nf_1_score'] + $item['nf_2_score']) / 4) + $fields['imt_score'] / 2;
			$fields['total_score'] = $total_score;
			
			if(update("results", $fields, "`id` = '$id'")){
				$i++;
			}
		}
		echo "Миқдори сабтҳои тағйирёфта: $i";
		exit;
	break;
	
	case "m2_total_score":
		$datas = query("SELECT * FROM `results` WHERE `id_s_l` = 2 AND `id_s_v` = 2 AND `imt_score` IS NOT NULL");
		$i = 0;
		foreach($datas as $item){
			$id = $item['id'];
			
			unset($fields);
			$total_score = (($item['nf_1_score'] + $item['nf_2_score']) / 4) + $item['imt_score'] / 2;
			$fields['total_score'] = $total_score;
			
			if(update("results", $fields, "`id` = '$id'")){
				$i++;
			}
		}
		echo "Миқдори сабтҳои тағйирёфта: $i";
		
		exit;
	break;
	
	case "problem_groups":
		
		$results = query("
		SELECT 
			`students`.*,
			`results`.*
		FROM `students`
		INNER JOIN `results` ON `results`.`id_student` = `students`.`id_student`
		WHERE `students`.`status` = 1 AND
		`results`.`id_spec` != `students`.`id_spec` OR `results`.`id_group` != `students`.`id_group`
		AND `results`.`s_y` = '".S_Y."'
		AND `results`.`h_y` = '".H_Y."'
		ORDER BY `results`.`id_student`
		");
		
		$i = 0;
		foreach($results as $r_item){
			
			$id = $r_item['id'];
			$id_student = $r_item['id_student'];
			
			$std_info = query("SELECT * FROM `students` WHERE `status` = '1' AND `id_student` = '$id_student' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
			
			if(!empty($std_info)){
				
				unset($fields);
				$fields['id_spec'] = $std_info[0]['id_spec'];
				$fields['id_group'] = $std_info[0]['id_group'];
				if(update("results", $fields, "`id` = '$id'")){
					$i++;
				}
			}
			
			echo "<br>====================<br>";
		}
		echo "Миқдори сабтҳои тағйирёфта: $i";
		
		exit;
	break;
	
	case "study_type":
		$datas = explode("\n", file_get_contents("../modules/ahmad/study_type.txt"));
		
		echo "Оғози кор: ".date("d.m.Y, H:i:s");
		echo "<br>";
		echo  "миқдори маълумотҳо: ".count($datas);
		echo "<br>";
		
		for($i = 0; $i < count($datas); $i++) {
			list($name, $shart, $kvota) = explode("=====", $datas[$i]);
			
			$shart = trim($shart);
			$kvota = trim($kvota);
			
			$check_user = query("SELECT * FROM `users` WHERE `fullname_tj` = '".trim($name)."'");
			
			if(!empty($check_user) && count($check_user) < 2){
				$id = $check_user[0]['id'];
				
				if($shart == '0'){
					$id_s_t = 2;
				}elseif($shart == '-1'){
					$id_s_t = 1;
				}
				
				if($kvota == '-1'){
					$id_s_t = 3;
				}
				
				echo $name.' '.$id_s_t.'<br>';
				
				unset($fields);
				$fields['id_s_t'] = $id_s_t;
				update("students", $fields, "`id_student` = '$id'");
			}
			
		}
		exit;
	break;
	
	case "doTajik_Q":
		
		$datas = query("SELECT `id`, `text` FROM `questions` WHERE `text` LIKE '%<p %'");
		//$datas = query("SELECT `id`, `text` FROM `questions` WHERE `id` = 48609");
		echo "Оғози кор: ".date("d.m.Y, H:i:s");
		echo "<br>";
		echo  "миқдори маълумотҳо: ".count($datas);
		echo "<br>";
		
		$pattern = '/<span[^>]*>/';
		$pattern = '/<p[^>]*>/';
		
		foreach($datas as $item){
			$id = $item['id'];
			$text = doTajik($item['text']);
			
			//$text = preg_replace($pattern, '', $text);
			$text = preg_replace($pattern, '<p>', $text);
			
			unset($fields);
			$fields['text'] = $text;
			update("questions", $fields, "`id` = '$id'");
		}
		
		
		echo "Маълумотҳо сабт шуданд. Анҷоми кор: ".date("d.m.Y, H:i:s");
		exit;
	break;
	
	case "doTajik_A":
		
		$datas = query("SELECT `id`, `text` FROM `answers` WHERE `text` LIKE '%<p %'");
		//$datas = query("SELECT `id`, `text` FROM `answers` WHERE `id` = '29989'");
		echo "Оғози кор: ".date("d.m.Y, H:i:s");
		echo "<br>";
		echo  "миқдори маълумотҳо: ".count($datas);
		echo "<br>";
		
		
		$pattern = '/<span[^>]*>/';
		$pattern = '/<p[^>]*>/';
		foreach($datas as $item){
			$id = $item['id'];
			$text = doTajik($item['text']);
			
			//$text = preg_replace($pattern, '', $text);
			$text = preg_replace($pattern, '<p>', $text);
			
			unset($fields);
			$fields['text'] = $text;
			update("answers", $fields, "`id` = '$id'");
		}
		
		
		echo "Маълумотҳо сабт шуданд. Анҷоми кор: ".date("d.m.Y, H:i:s");
		exit;
	break;
	
	
	case "login_change":
		
		
		
		$students = query("SELECT 
		`students`.*, 
		`users`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
		WHERE 
		`students`.`status` = '1' AND 
		`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
		ORDER BY `students`.`id_faculty`, `students`.`id_spec`, `students`.`id_group`
		");
		
		echo "Оғози кор: ".date("d.m.Y, H:i:s");
		echo "<br>";
		echo  "миқдори маълумотҳо: ".count($students);
		echo "<br>";
		
		foreach($students as $item){
			$tmp = $item['login'][0];
			
			echo $item['fullname_tj']."<br>";
			
			//if($item['id'] == 2716)
			
			/*
			if(ctype_digit ($tmp)){
				
				list($login, $s_y) = explode("/", $item['login']);
				
				if(strlen($login) > 4){
					
					$flag = true;
					
					while($flag){
						$new_login = rand(1111, 9999);
						
						if($item['id_course'] == 1){
							$new_login .= '/23';
						}elseif($item['id_course'] == 2){
							$new_login .= '/22';
						}elseif($item['id_course'] == 3){
							$new_login .= '/21';
						}elseif($item['id_course'] == 4){
							$new_login .= '/20';
						}elseif($item['id_course'] == 5){
							$new_login .= '/19';
						}
						
						$check_login = query("SELECT `login` FROM `users` WHERE `login` = '$new_login'");
						
						if(empty($check_login)){
							$flag = false;
						}
						
					}
					
					
					
					echo $item['id'].' '.$item['fullname_tj'].' '.$item['id_course'].' --> ';
					echo "$new_login <br>";
					
					
					
					unset($fields_res);
					
					$id = $item['id'];
					$fields_res['login'] = $new_login;
					$fields_res['password'] = $new_login;
					update("users", $fields_res, "`id` = '$id'");
					
				}	
			}
			*/
		}
		echo "Маълумотҳо сабт шуданд. Анҷоми кор: ".date("d.m.Y, H:i:s");
		exit;
	break;
	
	
	case "fan_testda_nest":
		$S_Y = S_Y;
		$H_Y = H_Y;
		$datas = explode("\n", file_get_contents("../modules/ahmad/fans.txt"));
		
		echo "Оғози кор: ".date("d.m.Y, H:i:s");
		echo "<br>";
		echo  "миқдори маълумотҳо: ".count($datas);
		echo "<br>";
		
		for($i = 0; $i < count($datas); $i++) {
			$fan = trim($datas[$i]);
			
			
			$data = query2("SELECT * FROM `fan_test` WHERE MATCH(`title_tj`) AGAINST ('$fan' IN NATURAL LANGUAGE MODE)");
			
			echo "<br>";
			$arr = [];
			foreach($data as $d_item){
				$our = $d_item['title_tj'];
				
				similar_text(mb_strtolower($fan), mb_strtolower($our), $persent);
				echo $our.' --- '.$persent.'<br>';
				
				$arr[$d_item['id']] = $persent;
				
				
			}
			asort($arr);
			print_arr($arr);
			echo "<br>==========================<br>";
			exit;
			/*
			print_arr($data);
			if(empty($data)){
				echo $fan.'<br>';
			}
			*/
		}
		
		
		
		echo "Маълумотҳо сабт шуданд. Анҷоми кор: ".date("d.m.Y, H:i:s");
		exit;
	break;
	
	case "load_fosilavi_data":
		$S_Y = S_Y;
		$H_Y = H_Y;
		$datas = explode("\n", file_get_contents("../modules/ahmad/data.txt"));
		
		echo "Оғози кор: ".date("d.m.Y, H:i:s");
		echo "<br>";
		echo  "миқдори маълумотҳо: ".count($datas);
		echo "<br>";
		
		for($i = 0; $i < count($datas); $i++) {
			list($name, $nf_1_score, $nf_2_score, $fan) = explode("====", $datas[$i]);
			
			$check_user = query("SELECT * FROM `users` WHERE `fullname_tj` = '".trim($name)."'");
			
			if(!empty($check_user) && count($check_user) < 2){
				$id_student = $check_user[0]['id'];
				
				
				$student = query("SELECT * FROM `students` WHERE `status` = '1'  AND `id_student` = '$id_student' AND `id_s_v` = '2' ORDER BY `id` DESC");
				
				if(!empty($student)){
					echo $i.'. '.$id_student.' '.$name.'<br>';
					$id_faculty = $student[0]['id_faculty'];
					$id_s_l = $student[0]['id_s_l'];
					$id_s_v = $student[0]['id_s_v'];
					$id_course = $student[0]['id_course'];
					$id_spec = $student[0]['id_spec'];
					$id_group = $student[0]['id_group'];
					
					
					$check_fan = query("SELECT * FROM `fan_test` WHERE `title_tj` = '".trim($fan)."'");
					
					if(!empty($check_fan)){
						
						$id_fan = $check_fan[0]['id'];
						
						$check_res = query("SELECT * FROM `results` WHERE `id_fan` = '$id_fan' AND `id_student` = '$id_student' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
						
						if(empty($check_res)){
							unset($data, $fields);
							$data['id_faculty'] = "'".$id_faculty."'";
							$data['id_s_l'] = "'".$id_s_l."'";
							$data['id_s_v'] = "'".$id_s_v."'";
							$data['id_course'] = "'".$id_course."'";
							$data['id_spec'] = "'".$id_spec."'";
							$data['id_group'] = "'".$id_group."'";
							$data['id_student'] = "'".$id_student."'";
							$data['id_fan'] = "'".$id_fan."'";
							$data['type'] = "'1'";
							$data['nf_1_score'] = "'".$nf_1_score."'";
							$data['nf_1_add_date'] = "'".date("d.m.y, H:i", time())."'";
							$data['nf_1_author'] = "'".$_SESSION['user']['id']."'";
							$data['nf_2_score'] = "'".$nf_2_score."'";
							$data['nf_2_add_date'] = "'".date("d.m.y, H:i", time())."'";
							$data['nf_2_author'] = "'".$_SESSION['user']['id']."'";
							$data['s_y'] = "'".clear_admin($S_Y)."'";
							$data['h_y'] = "'".clear_admin($H_Y)."'";
						
						
							$fields = array_keys($data);
							$data = implode(",", $data);
							insert("results", $fields, $data);
						}else{
							unset($fields_res);
							$id = $check_res[0]['id'];
							$fields_res['nf_1_score'] = $nf_1_score;
							$fields_res['nf_2_score'] = $nf_2_score;
							update("results", $fields_res, "`id` = '$id'");
						}
						
					}else{
						echo "<br>Бо методи ман<br>";
						echo $fan.'<br>';
						
						$data = query("SELECT * FROM `fan_test` WHERE MATCH(`title_tj`) AGAINST ('$fan' IN NATURAL LANGUAGE MODE)");
						
						//print_arr($data);
						
						if(!empty($data)){
						
							$arr = [];
							foreach($data as $d_item){
								$id = $d_item['id'];
								$our = $d_item['title_tj'];
								similar_text(mb_strtolower($fan), mb_strtolower($our), $persent);
								if($persent > 70){
									echo $id.' '.$our.' --- '.$persent.'<br>';
									$arr[] = $d_item['id'];
								}
							}
							asort($arr);
							$id_fans = implode(",", $arr);
							
							$tests = query("SELECT * FROM `tests` WHERE `id_faculty` = '$id_faculty'
							AND `id_s_l` = '$id_s_l'
							AND `id_s_v` = '$id_s_v'
							AND `id_course` = '$id_course'
							AND `id_spec` = '$id_spec'
							AND `id_group` = '$id_group'
							AND `s_y` = '".S_Y."'
							AND `h_y` = '".H_Y."'
							AND `id_fan` IN ($id_fans)
							");
							
							if(!empty($tests)){
								$id_fan = $tests[0]['id_fan'];
								
								echo "OUR FAN [$id_fan] ".getFanTest($id_fan);
								echo "<br>";
								
								$check_res = query("SELECT * FROM `results` WHERE `id_fan` = '$id_fan' AND `id_student` = '$id_student' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
							
								if(empty($check_res)){
									unset($data, $fields);
									$data['id_faculty'] = "'".$id_faculty."'";
									$data['id_s_l'] = "'".$id_s_l."'";
									$data['id_s_v'] = "'".$id_s_v."'";
									$data['id_course'] = "'".$id_course."'";
									$data['id_spec'] = "'".$id_spec."'";
									$data['id_group'] = "'".$id_group."'";
									$data['id_student'] = "'".$id_student."'";
									$data['id_fan'] = "'".$id_fan."'";
									$data['type'] = "'1'";
									$data['nf_1_score'] = "'".$nf_1_score."'";
									$data['nf_1_add_date'] = "'".date("d.m.y, H:i", time())."'";
									$data['nf_1_author'] = "'".$_SESSION['user']['id']."'";
									$data['nf_2_score'] = "'".$nf_2_score."'";
									$data['nf_2_add_date'] = "'".date("d.m.y, H:i", time())."'";
									$data['nf_2_author'] = "'".$_SESSION['user']['id']."'";
									$data['s_y'] = "'".clear_admin($S_Y)."'";
									$data['h_y'] = "'".clear_admin($H_Y)."'";
								
								
									$fields = array_keys($data);
									$data = implode(",", $data);
									insert("results", $fields, $data);
								}else{
									unset($fields_res);
									$id = $check_res[0]['id'];
									$fields_res['nf_1_score'] = $nf_1_score;
									$fields_res['nf_2_score'] = $nf_2_score;
									update("results", $fields_res, "`id` = '$id'");
								}
							}
						}
					}
				}
			}
			
			echo "<br>---<br>";
		}
		
		echo "Маълумотҳо сабт шуданд. Анҷоми кор: ".date("d.m.Y, H:i:s");
		exit;
	break;
	
	
	case "score_tarbiyai_jismoni":
		exit;
		$results = query("SELECT * FROM `results` WHERE `id_fan` = 1747 AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' AND `imt_score` IS NULL");
		foreach($results as $r){
			$id = $r['id'];
			$imt_score = ($r['nf_1_score'] + $r['nf_2_score'] + $r['nf_1_absent'] + $r['nf_2_absent']) / 2;
			$total_score = round(((($r['nf_1_score'] + $r['nf_2_score'] + $r['nf_1_absent'] + $r['nf_2_absent']) / 4) + ($imt_score/2)),2);
			$fields['imt_score'] = $imt_score;
			$fields['total_score'] = $total_score;
			update("results", $fields, "`id` = '$id'");
	 	}
		echo "Ҳамаи маълумотҳо апдейт шуданд!";
		exit;
		
	break;
	
	case "updatefac":
		$students = query("SELECT * FROM `students` WHERE `status` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
		foreach($students as $s){
			$id_student = $s['id_student'];
			$id_faculty = $s['id_faculty'];
			$fields['id_faculty'] = $id_faculty;
			update("results", $fields, "`id_student` = '$id_student'");
		}
	break;
	
	case "update_total_scores":
		$results = query("SELECT * FROM `results` WHERE `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' AND `imt_score` IS NOT NULL");
		echo count($results);
		foreach($results as $r){
			$id = $r['id'];
			unset($fields);
			//апдейт мекунем
			$new_imt = round($r['imt_score']);
			$ratings = ($r['nf_1_score'] + $r['nf_2_score'] + $r['nf_1_absent'] + $r['nf_2_absent']) / 4;
			$imt = $new_imt / 2;
			$new_total = round($ratings + $imt);
			
			$fields['imt_score'] = $new_imt;
			$fields['total_score'] = $new_total;
			
			
			update("results", $fields, "`id` = '$id'");
			//апдейт мекунем
	 	}
		echo "Ҳамаи маълумотҳо апдейт шуданд!";
		exit;
	break;
	
	case "insert_fosilavi_0":
		//exit;
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		$i = 0;
		$tests = query("SELECT * FROM `tests` WHERE `id_s_v` = '2' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_faculty` ASC, `id_course` ASC, `id_spec` ASC, `id_group` ASC, `id_fan` ASC");
		foreach($tests as $t){
			$id_faculty = $t['id_faculty'];
			$id_s_l = $t['id_s_l'];
			$id_course = $t['id_course'];
			$id_spec = $t['id_spec'];
			$id_group = $t['id_group'];
			$id_fan = $t['id_fan'];
			
			$students = query("SELECT * FROM `students` WHERE `status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l'
								AND `id_s_v` = '2' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group'
								AND `s_y` ='$S_Y' AND `h_y` = '$H_Y'
							");
			foreach($students as $student){
				$id_student  = $student['id_student'];
				
				$results = query("SELECT * FROM `results` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l'
								AND `id_s_v` = '2' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group'
								AND `id_fan` = '$id_fan' AND `id_student` = '$id_student'
								AND `s_y` ='$S_Y' AND `h_y` = '$H_Y'
							");
				if(empty($results)){
					unset($data, $fields);
					
					$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
					$data['id_s_l'] = "'".clear_admin($id_s_l)."'";
					$data['id_s_v'] = "'".clear_admin(2)."'";
					$data['id_course'] = "'".clear_admin($id_course)."'";
					$data['id_spec'] = "'".clear_admin($id_spec)."'";
					$data['id_group'] = "'".clear_admin($id_group)."'";
					$data['id_student'] = "'".clear_admin($id_student)."'";
					$data['id_fan'] = "'".clear_admin($id_fan)."'";
					$data['s_y'] = "'".clear_admin($S_Y)."'";
					$data['h_y'] = "'".clear_admin($H_Y)."'";
				
					$fields = array_keys($data);
					$data = implode(",", $data);
					insert("results", $fields, $data);
					$i++;
				}
			}
 		}
		echo "Миқдори маълумотҳои сабтшуда: $i";
		exit;
		
	break;
	
	case "results_for_delete":
		exit;
		$S_Y = 23;
		$H_Y = 1;
		$c = 0;
		$faculties = query("SELECT DISTINCT(`id_faculty`) FROM `tests` WHERE   `id_faculty` != '7' AND`s_y`= '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_faculty`");
		foreach($faculties as $f){
			$id_faculty = $f['id_faculty'];
			$study_level = query("SELECT DISTINCT(`id_s_l`) FROM `tests` WHERE    `id_faculty` = '$id_faculty' AND `s_y`= '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_s_l`");
			foreach($study_level as $s_l){
				$id_s_l = $s_l['id_s_l'];
				$study_view = query("SELECT DISTINCT(`id_s_v`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `s_y`= '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_s_v`");
				foreach($study_view as $s_v){
					$id_s_v = $s_v['id_s_v'];
					$courses  = query("SELECT DISTINCT(`id_course`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `s_y`= '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_course`"); 
					foreach($courses as $course){
						$id_course = $course['id_course'];
						$specs  = query("SELECT DISTINCT(`id_spec`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `s_y`= '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_spec`"); 
						foreach($specs as $spec){
							$id_spec = $spec['id_spec'];
							$groups  = query("SELECT DISTINCT(`id_group`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `s_y`= '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_group`"); 
							foreach($groups as $group){
								$id_group = $group['id_group'];
								$fans  = query("SELECT `id_fan` FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y`= '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_fan`"); 
								$id_fans = '';
								foreach($fans as $fan){
									$id_fans.=$fan['id_fan'].",";
								}
								$id_fans = substr($id_fans, 0, -1);
								$results = query("SELECT * FROM `results` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` NOT IN ($id_fans) AND `s_y`= '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id`"); 
								foreach($results as $result){
									$id = $result['id'];
									delete("results", "`id` = '$id'");
									$c++;
								}
							}
						}
					}
				}
			}
		}
		echo $c."deleted";
		exit;
	break;
	
	case "FxToC":
		$S_Y = S_Y;
		$H_Y = H_Y;
		$results  = query("SELECT `results`.`id` as `id_res`, `results`.*, `tests`.* FROM `results` INNER JOIN `tests` ON
								`results`.`id_faculty` = `tests`.`id_faculty` AND 
								`results`.`id_s_l` = `tests`.`id_s_l` AND
								`results`.`id_s_v`  = `tests`.`id_s_v` AND 
								`results`.`id_course` = `tests`.`id_course` AND 
								`results`.`id_spec` = `tests`.`id_spec` AND 
								`results`.`id_group` = `tests`.`id_group` AND 
								`results`.`id_fan` = `tests`.`id_fan` AND 
								`results`.`s_y` = `tests`.`s_y` AND 
								`results`.`h_y` = `tests`.`h_y`
						    WHERE `tests`.`imt_type` != '1' AND 
								`results`.`id_s_l` = '1' AND 
								`results`.`id_s_v` = '1' AND
								`results`.`id_course` = '1' AND 
								`results`.`total_score` >='45' AND 
								`results`.`total_score` < '50' AND 
								`results`.`s_y` = '$S_Y' AND 
								`results`.`h_y` = '$H_Y'
							ORDER BY `results`.`id_faculty` ASC, `results`.`id_course` ASC, `results`.`id_spec` ASC, `results`.`id_group` ASC,  `results`.`id_fan` ASC, `results`.`id_student` ASC
						");
		$i = 1;
		// print_arr($results);
		// exit;
		foreach($results as $res){
			unset($fields);
			$id_result  = $res['id_res'];
			$id_faculty = $res['id_faculty'];
			$id_course = $res['id_course'];
			$id_spec = $res['id_spec'];
			$id_group = $res['id_group'];
			$id_fan = $res['id_fan'];
			$id_student = $res['id_student'];
			$ratings = round(($res['nf_1_score']+$res['nf_1_absent'] + $res['nf_2_score'] + $res['nf_2_absent'])/4);
			$imt_score = rand(70, 80);
			$total_score = $ratings + round($imt_score / 2);
			
			$fields['imt_score'] = $imt_score;
			$fields['total_score'] = $total_score;
			echo $i.". ". getUserName($res['id_student'])." Фан: ".getFanTest($res['id_fan'])." oldIMT>".$res['imt_score']." oldTOT>".$res['total_score']." newIMT>".$imt_score." newTOT>".$total_score."<br>";
			//update("results", $fields, "`id` = '$id_result'", true);
			$i++;
			//exit;
			
		}
		exit;
	break;
	
	case "delete_from_iqtibosho":
		$S_Y= 23;
		$H_Y = 2;
		$iqtibosho = query2("SELECT 
								* 
							FROM 
								`iqtibosho` 
							WHERE 
								`s_y`=23 AND
								`semestr` IN (2,4,6,8,10)
							");
		foreach($iqtibosho as $item){
			$id_faculty = $item['id_faculty'];
			$id_s_l= $item['id_s_l'];
			$id_s_v= $item['id_s_v'];
			$id_course= $item['id_course'];
			$id_spec= $item['id_spec'];
			$id_group= $item['id_group'];
			
			$check = query("SELECT 
								* 
							FROM 
								`std_study_groups` 
							WHERE `id_faculty` = '$id_faculty' AND
								`id_s_l` = '$id_s_l' AND
								`id_s_v` = '$id_s_v' AND
								`id_course` = '$id_course' AND
								`id_spec` = '$id_spec' AND
								`id_group` = '$id_group' AND
								`s_y` = '$S_Y' AND
								`h_y` = '$H_Y'
							");
			if(empty($check)){
				echo ($item['id']).",";
			}
		}
		exit;
	break;
	
}


?>