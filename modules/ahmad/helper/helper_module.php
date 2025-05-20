<?php

include '../vendor/autoload.php'; // Путь к файлу autoload.php в вашем проекте
use PhpOffice\PhpSpreadsheet\IOFactory;
$reader = IOFactory::createReader('Xlsx');


switch($action){
	
	case "ceil":
		$results  = query("SELECT * FROM `results` WHERE `total_score`>=49.5");
		print_arr($results);
		exit;
	break;
	
	case "mmt":
		include("../phpQuery/phpQuery.php");
		$code = $_REQUEST['code'];
		
		// 215 - ДТМИК
		// 111 - ДДК
		// 116 - ДДМИТ
		// 101 - ДМТ
		
		
		$univers = [
			215 => "ДТМИК",
			111 => "ДДК",
			116 => "ДДМИТ",
			101 => "ДМТ",
			104 => "ДТТ ба номи М. Осимӣ",
			107 => "ДТТ"
		];
		
		$page_info['title'] = 'Интихоб дар ММТ: '.$univers[$code];
		
		
		
		$url = "https://stat.ntc.tj/Y23/USPSelection?Code=$code";
		$file1 = file_get_contents($url);
		
		$doc = phpQuery::newDocument($file1);
		$ps = $doc->find(".divTable:eq(1)")->text();
		
		$t = explode(" ", $ps);
		$total_page = $t[15];
		
		$h_intixob = 0;
		
		$j = 0;
		$myData = [];
		for($page = 1; $page <= $total_page; $page++){
		
			$url = "https://stat.ntc.tj/Y23/USPSelection?page=$page&Code=$code";
			$file1 = file_get_contents($url);
			
			$doc = phpQuery::newDocument($file1);
			for($i = 5; $i <= 24; $i++){
				$datas = $doc->find(".divTable:eq(0) .table1 tr:eq($i)");
				
				if(!empty($datas)){
					foreach ($datas as $data){
						
						
						$spec = pq($data)->find("td:eq(0)")->text();
						$spec_title = pq($data)->find("td:eq(1)")->text();
						$myData[$j]['spec'] = $spec.' '.$spec_title;
						
						$ruzona_fosilavi = pq($data)->find("td:eq(2)")->text();
						$myData[$j]['ruzona_fosilavi'] = $ruzona_fosilavi;
						
						$mablagh_guzori = pq($data)->find("td:eq(3)")->text();
						$myData[$j]['mablagh_guzori'] = $mablagh_guzori;
						
						$naqsha = pq($data)->find("td:eq(5)")->text();
						$myData[$j]['naqsha'] = $naqsha;
						
						$intixob = pq($data)->find("td:eq(6)")->text();
						$myData[$j]['intixob'] = $intixob;
						
						for($l = 1; $l <= 12; $l++){
							$v = 6+$l;
							$myData[$j]["intixob_{$l}"] = pq($data)->find("td:eq($v)")->text();
						}
						$j++;
					}
				}
			}
			
		}
		
	break;
	
	case "stp":
		$id_faculty = 1;
		$id_s_l = 1;
		$id_s_v = 1;
		$id_course = 1;
		$id_spec = 1;
		$id_group = 1;
		
		$s_y = 23;
		$h_y = 1;
		
		
		$alo = query("
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
			`results`.`id`,
			IFNULL(MIN(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`)), 0) AS `min`, 
			IFNULL(MAX(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`)), 0) AS `max`,
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
		AND `students`.`id_faculty` = '$id_faculty'
		AND `students`.`id_s_l` = '$id_s_l'
		AND `students`.`id_s_v` = '$id_s_v'
		AND `students`.`id_course` = '$id_course'
		AND `students`.`id_spec` = '$id_spec'
		AND `students`.`id_group` = '$id_group'
		
		AND `students`.`s_y` = '$s_y' 
		AND `students`.`h_y` = '$h_y'
		GROUP BY `students`.`id`, `tests`.`id`, `results`.`id`, `std_study_groups`.`id`
		HAVING
			`min` >= 90.00
		
		ORDER BY `students`.`id_faculty`, `students`.`id_s_l`, `students`.`id_s_v`,
		`students`.`id_course`, `students`.`id_spec`, `students`.`id_group`,
		`users`.`fullname_tj`, `tests`.`id_fan`
		
		");
		
		
		print_arr($alo);
		
		exit;
	break;
	
	case "delete_rasm":
		$files = scandir($_SERVER['DOCUMENT_ROOT'] .'/userfiles/students');
		$count = 0;
		//for($i = 2; $i < 1000; $i++){
		for($i = 2; $i < count($files); $i++){
			$file = $_SERVER['DOCUMENT_ROOT'] .'/userfiles/students/'.$files[$i];
			
			$check = query("SELECT * FROM `users` WHERE `photo` = '".$files[$i]."'");
			
			if(empty($check)){
				unlink($file);
				$count++;
			}
			
		}
		echo "DELETED $count FILES";
		exit;
	break;
	
	case "load_rasm":
		
		$datas = explode("\n", file_get_contents("../modules/helper/datas.txt"));
		
		echo "Оғози кор: ".date("d.m.Y, H:i:s");
		echo "<br>";
		echo  "миқдори маълумотҳо: ".count($datas);
		echo "<br>";
		
		for($i = 0; $i < count($datas); $i++) {
			list($name, $photo, $scan2_finger1, $scan2_finger2, $scan1_finger1, $scan1_finger2) = explode("==========", $datas[$i]);
			
			$check_user = query("SELECT * FROM `users` WHERE `fullname_tj` = '".trim($name)."'");
			
			if(!empty($check_user)){
				$id_user = $check_user[0]['id'];
				
				if(!$check_user[0]['photo']){
					unset($fields_users);
					
					$fields_users['photo'] = $photo;
					update("users", $fields_users, "`id` = '$id_user'");
				}
				
				
				$check_biometric = query("SELECT * FROM `users_biometric` WHERE `id_user` = '$id_user'");
				
				if(empty($check_biometric)){
					unset($data, $fields);
					
					$data['id_user'] = "'".$id_user."'";
					$data['scan1_finger1'] = "'".$scan1_finger1."'";
					$data['scan1_finger2'] = "'".$scan1_finger2."'";
					$data['scan2_finger1'] = "'".$scan2_finger1."'";
					$data['scan2_finger2'] = "'".$scan2_finger2."'";
					$data['added_by'] = "'".$_SESSION['user']['id']."'";
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					insert("users_biometric", $fields, $data);
				}
				
			}
			
		}
		
		echo "Маълумотҳо сабт шуданд. Анҷоми кор: ".date("d.m.Y, H:i:s");
		exit;
	break;
	
	
	case "d2s":
		
		$datas = query("SELECT * FROM `students` WHERE `status` = '-1' ORDER BY `id`");
		
		foreach($datas as $item){
			$check = query("SELECT `id` FROM `students` WHERE `id_student` = '{$item['id_student']}' AND `status` = '1'");
			
			if(empty($check)){
				unset($data, $fields);
				
				$data['status'] = "'1'";
				$data['id_student'] = "'".clear_admin($item['id_student'])."'";
				$data['id_faculty'] = "'".clear_admin($item['id_faculty'])."'";
				$data['id_course'] = "'".clear_admin($item['id_course'])."'";
				$data['id_spec'] = "'".clear_admin($item['id_spec'])."'";
				$data['id_group'] = "'".clear_admin($item['id_group'])."'";
				$data['id_s_l'] = "'".clear_admin($item['id_s_l'])."'";
				$data['id_s_v'] = "'".clear_admin($item['id_s_v'])."'";
				$data['id_s_t'] = "'".clear_admin($item['id_s_t'])."'";
				if($item['foreign'])
					$data['foreign'] = "'".clear_admin($item['foreign'])."'";
				$data['vazi_oilavi'] = "'".clear_admin($item['vazi_oilavi'])."'";
				$data['s_y'] = "'".clear_admin($item['s_y'])."'";
				$data['h_y'] = "'".clear_admin($item['h_y'])."'";
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				insert("students", $fields, $data);
				echo $item['id_student'].">ok<br>";
			}
		}
		exit;
	break;
	
	case "memcached":
		
		
		phpinfo();
		exit;
	break;
	
	case "import_workers":
		exit;
		$datas = query("SELECT * FROM `2024_PD_workers` ORDER BY `id`");
		
		foreach($datas as $item){
			
			$isset = query("SELECT * FROM `users` WHERE `fullname_tj` = '{$item['Fio']}'");
			
			if(empty($isset)){
				unset($data, $fields);
				
				$data['fullname_tj'] = "'".clear_admin($item['Fio'])."'";
				$data['fullname_ru'] = "'".clear_admin($item['fior'])."'";
				
				if($item['Gender'] == 80){
					$jins = 1;
				}else{
					$jins = 0;
				}
				$data['jins'] = "'".clear_admin($jins)."'";
				$data_user['jins'] = "'".clear_admin($item['Gender'])."'";
				
				$birthday = substr($item['BornDate'], 0, 10);
				if($birthday != '1901-01-01')
					$data['birthday'] = "'".clear_admin($birthday)."'";
				
				
				if(busylogin($item['fa_Login'])){
					$login = makeLogin($item['Fio'], rand(1,1000000));
				}else
					$login = $item['fa_Login'];
				
				$data['login'] = "'".clear_admin($login)."'";
				
				$data['password'] = "'".clear_admin($login)."'";
				$data['email'] = "'".clear_admin($item['Email'])."'";
				$data['phone'] = "'".clear_admin($item['Tel'])."'";
				$data['access'] = 1;
				$data['access_type'] = 2; // 2 - омӯзгор
				
				$data['added_by'] = "'".$_SESSION['user']['id']."'";
				$data['added_time'] = "'".date("d.m.Y, H:i:s", time())."'";
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				/*Иловакунии маълумотҳо дар таблитсаи USERS */
				
				if($id_teacher = insert("users", $fields, $data)){
					unset($passport_data, $passport_fields);
					/*PASSPORT DATAS*/
					$table = "user_passports";
					$passport_data['id_user'] = "'".clear_admin($id_teacher)."'";
					
					if (preg_match('/^(.*?)\s(.*)$/', $item['PassportData'], $matches)) {
						$part1 = $matches[1]; // Первая часть: А3301620
						$part2 = $matches[2]; // Вторая часть: ШКД н. Сино

						$passport_data['number'] = "'".clear_admin($matches[1])."'";
						$passport_data['maqomot'] = "'".clear_admin($matches[2])."'";
						
					}
					$passport_data['id_nation'] = "'".clear_admin(1)."'";
					
					$passport_data['address'] = "'".clear_admin($item['Address'])."'";
					
					$passport_fields = array_keys($passport_data);
					$passport_data = implode(",", $passport_data);
					
					insert($table, $passport_fields, $passport_data);
					/*PASSPORT DATAS*/
					
					
					unset($edu_data, $edu_fields);
					/*USER EDUCATION*/
					$table = "user_udecation";
					$edu_data['id_user'] = "'".clear_admin($id_teacher)."'";
					$edu_fields = array_keys($edu_data);
					$edu_data = implode(",", $edu_data);
					insert($table, $edu_fields, $edu_data);
					/*USER EDUCATION*/
					
					echo "OK<br>";
				}
			}
		}
		
		exit;
	break;
	
	
	case "import_nt":
		$id_nt = 263;
		$spreadsheet = $reader->load("НТ 2018_1-26 02 03-23.xlsx");
		
		$reader->setReadDataOnly(true);

		// Количество листов
		$sheetsCount = $spreadsheet->getSheetCount();

		$data = $spreadsheet->getSheet(0)->toArray();
		
		
		$start_pos = findIndexInTwoDimensionalArray($data, "БАХШИ ФАНҲОИ ЗАМИНАВӢ");
		echo "START_POS: $start_pos<br>";
		
		$second_part = array_slice($data, $start_pos); 
		
		
		$end_pos = findIndexInTwoDimensionalArray($second_part, "Ҳамагӣ");
		echo "END_POS: $end_pos<br>";
		
		$black_list = [
			"Модули фанҳои забонӣ", 
			"Модули фанҳои табиӣ-иқтисодӣ ва технологияи информатсионӣ",
			"БАХШИ ФАНҲОИ ТАХАССУСӢ",
			"Модули фанҳои умумикасбӣ",
			"Модули фанҳои тахассусӣ",
			"Модули фанҳои тахассусӣ",
			"БАХШИ ФАНҲОИ ИНТИХОБӢ",
			"Модули фанҳои интихобии бахши 1",
			"Модули фанҳои интихобии бахши 2",
			"БАХШИ ТАҶРИБАОМӮЗӢ",
			"АТТЕСТАТСИЯИ ХАТМ",
		];
		/*
		$new_arr = [];
		for($j = 0, $i = $start_pos + 2; $i < $start_pos + $end_pos; $i++) {
			if(in_array($data[$i][1], $black_list)) continue;
			$new_arr[$j]['title'] = $data[$i][1];
			$new_arr[$j]['credit'] = $data[$i][29];
			if(!empty($data[$i][31]))
				$new_arr[$j]['imtihon'] = str_replace(".", ",", $data[$i][31]);
			else 
				$new_arr[$j]['imtihon'] = $data[$i][31];
			
			$new_arr[$j]['k_k'] = $data[$i][35];
			$new_arr[$j]['credit_faol'] = $data[$i][37];
			$new_arr[$j]['credit_aud'] = $data[$i][40];
			$new_arr[$j]['credit_kmro'] = $data[$i][43];
			$new_arr[$j]['credit_kmd'] = $data[$i][46];
			
			$new_arr[$j]['sem_1'] = $data[$i][49];
			$new_arr[$j]['sem_2'] = $data[$i][51];
			$new_arr[$j]['sem_3'] = $data[$i][53];
			$new_arr[$j]['sem_4'] = $data[$i][55];
			$new_arr[$j]['sem_5'] = $data[$i][57];
			$new_arr[$j]['sem_6'] = $data[$i][59];
			$new_arr[$j]['sem_7'] = $data[$i][61];
			$new_arr[$j]['sem_8'] = $data[$i][63];
			$new_arr[$j]['sem_9'] = @$data[$i][65];
			$new_arr[$j]['sem_10'] = @$data[$i][67];
			
			$j++;
		}
		
		
		foreach($new_arr as $item){
			$check = query("SELECT * FROM `fan_test` WHERE `title_tj` = '{$item['title']}'");
			if(empty($check)){
				unset($fan_data);
				$fan_data['title_tj'] = "'".clear_admin($item['title'])."'";
				$fan_fields = array_keys($fan_data);
				$fan_data = implode(",", $fan_data);
				$id_fan = insert("fan_test", $fan_fields, $fan_data);
			}else{
				$id_fan = $check[0]['id'];
			}
			
			if(!empty($item['imtihon']) && count($sems = explode(",", $item['imtihon'])) > 1){
				print_arr($sems);
				for($i = 0; $i < count($sems); $i++){
					unset($nt_data);
					$nt_data['id_nt'] = "'$id_nt'";
					
					$nt_data['semestr'] = "'".clear_admin($sems[$i])."'";
					$nt_data['id_fan'] = "'".clear_admin($id_fan)."'";
					if($item['k_k'])
						$nt_data['k_k'] = "'".clear_admin(1)."'";
					$nt_data['c_u'] = "'".clear_admin($item['sem_'.$sems[$i]])."'";
					$nt_data['c_f_u'] = "'".clear_admin($item['credit_faol'])."'";
					if($item['credit_aud'])
						$nt_data['c_a'] = "'".clear_admin($item['credit_aud'])."'";
					else
						$nt_data['c_a'] = "'".clear_admin(0)."'";
					$nt_data['cmro'] = "'".clear_admin($item['credit_kmro'])."'";
					$nt_data['cmd'] = "'".clear_admin($item['credit_kmd'])."'";
					$nt_data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
					
					
					$nt_fields = array_keys($nt_data);
					$nt_data = implode(",", $nt_data);
					insert("nt_content", $nt_fields, $nt_data, 1);
				}
				
			}else{
				
				if(!empty($item['sem_1'])) {
					$semestr = 1;
					$credit = $item['sem_1'];
				}
				elseif(!empty($item['sem_2'])) {
					$semestr = 2;
					$credit = $item['sem_2'];
				}
				elseif(!empty($item['sem_3'])) {
					$semestr = 3;
					$credit = $item['sem_3'];
				}
				elseif(!empty($item['sem_4'])) {
					$semestr = 4;
					$credit = $item['sem_4'];
				}
				elseif(!empty($item['sem_5'])) {
					$semestr = 5;
					$credit = $item['sem_5'];
				}
				elseif(!empty($item['sem_6'])) {
					$semestr = 6;
					$credit = $item['sem_6'];
				}
				elseif(!empty($item['sem_7'])) {
					$semestr = 7;
					$credit = $item['sem_7'];
				}
				elseif(!empty($item['sem_8'])) {
					$semestr = 8;
					$credit = $item['sem_8'];
				}
				elseif(!empty($item['sem_9'])) {
					$semestr = 9;
					$credit = $item['sem_9'];
				}
				elseif(!empty($item['sem_10'])) {
					$semestr = 10;
					$credit = $item['sem_10'];
				}
				
				
				unset($nt_data);
				$nt_data['id_nt'] = "'$id_nt'";
				$nt_data['semestr'] = "'".clear_admin($semestr)."'";
				$nt_data['id_fan'] = "'".clear_admin($id_fan)."'";
				if($item['k_k'])
					$nt_data['k_k'] = "'".clear_admin(1)."'";
				$nt_data['c_u'] = "'".clear_admin($credit)."'";
				$nt_data['c_f_u'] = "'".clear_admin($item['credit_faol'])."'";
				if($item['credit_aud'])
					$nt_data['c_a'] = "'".clear_admin($item['credit_aud'])."'";
				else
					$nt_data['c_a'] = "'".clear_admin(0)."'";
				
				$nt_data['cmro'] = "'".clear_admin($item['credit_kmro'])."'";
				$nt_data['cmd'] = "'".clear_admin($item['credit_kmd'])."'";
				$nt_data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
				
				print_arr($nt_data);
				
				$nt_fields = array_keys($nt_data);
				$nt_data = implode(",", $nt_data);
				insert("nt_content", $nt_fields, $nt_data, 1);
			}
			echo "<br>";	
		}
		echo "NT OK<br>";
		*/
		/*ИНТИХОБӢ*/
		
		$intixobi = $spreadsheet->getSheet(1)->toArray();
		
		
		$start_pos = findIndexInTwoDimensionalArray($intixobi, "Модули фанҳои интихобии бахши 1");
		echo "START_POS: $start_pos<br>";
		$black_list = [
			"Модули фанҳои интихобии бахши 2",
		];
		
		print_arr($intixobi);
		
		$new_arr = [];
		for($j = 0, $i = $start_pos + 2; $i < count($intixobi); $i++) {
			if(empty($intixobi[$i][1]) || empty($intixobi[$i][2])) continue;
			if(in_array($intixobi[$i][1], $black_list)) continue;
			
			$new_arr[$j]['title'] = $intixobi[$i][1];
			$new_arr[$j]['credit'] = $intixobi[$i][29];
			if(!empty($intixobi[$i][31]))
				$new_arr[$j]['imtihon'] = str_replace(".", ",", $intixobi[$i][31]);
			else 
				$new_arr[$j]['imtihon'] = $intixobi[$i][31];
			
			$new_arr[$j]['k_k'] = $intixobi[$i][35];
			$new_arr[$j]['credit_faol'] = $intixobi[$i][37];
			$new_arr[$j]['credit_aud'] = $intixobi[$i][40];
			$new_arr[$j]['credit_kmro'] = $intixobi[$i][43];
			$new_arr[$j]['credit_kmd'] = $intixobi[$i][46];
			
			$new_arr[$j]['sem_1'] = $intixobi[$i][49];
			$new_arr[$j]['sem_2'] = $intixobi[$i][51];
			$new_arr[$j]['sem_3'] = $intixobi[$i][53];
			$new_arr[$j]['sem_4'] = $intixobi[$i][55];
			$new_arr[$j]['sem_5'] = $intixobi[$i][57];
			$new_arr[$j]['sem_6'] = $intixobi[$i][59];
			$new_arr[$j]['sem_7'] = $intixobi[$i][61];
			$new_arr[$j]['sem_8'] = $intixobi[$i][63];
			$new_arr[$j]['sem_9'] = @$intixobi[$i][65];
			$new_arr[$j]['sem_10'] = @$intixobi[$i][67];
			
			$j++;
		}
		
		print_arr($new_arr);
		exit;
		foreach($new_arr as $item){
			$check = query("SELECT * FROM `fan_test` WHERE `title_tj` = '{$item['title']}'");
			if(empty($check)){
				unset($fan_data);
				$fan_data['title_tj'] = "'".clear_admin($item['title'])."'";
				$fan_fields = array_keys($fan_data);
				$fan_data = implode(",", $fan_data);
				$id_fan = insert("fan_test", $fan_fields, $fan_data);
			}else{
				$id_fan = $check[0]['id'];
			}
			
			if(!empty($item['imtihon']) && count($sems = explode(",", $item['imtihon'])) > 1){
				
				for($i = 0; $i < count($sems); $i++){
					unset($nt_data);
					$nt_data['id_nt'] = "'$id_nt'";
					
					$nt_data['semestr'] = "'".clear_admin($sems[$i])."'";
					$nt_data['id_fan'] = "'".clear_admin($id_fan)."'";
					$nt_data['intixobi'] = "'".clear_admin(1)."'";
					$nt_data['c_u'] = "'".clear_admin($item['sem_'.$sems[$i]])."'";
					$nt_data['c_f_u'] = "'".clear_admin($item['credit_faol'])."'";
					if($item['credit_aud'])
						$nt_data['c_a'] = "'".clear_admin($item['credit_aud'])."'";
					else
						$nt_data['c_a'] = "'".clear_admin(0)."'";
					$nt_data['cmro'] = "'".clear_admin($item['credit_kmro'])."'";
					$nt_data['cmd'] = "'".clear_admin($item['credit_kmd'])."'";
					$nt_data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
					
					
					$nt_fields = array_keys($nt_data);
					$nt_data = implode(",", $nt_data);
					insert("nt_content", $nt_fields, $nt_data, 1);
				}
				
			}else{
			
				if(!empty($item['sem_1'])) {
					$semestr = 1;
					$credit = $item['sem_1'];
				}
				elseif(!empty($item['sem_2'])) {
					$semestr = 2;
					$credit = $item['sem_2'];
				}
				elseif(!empty($item['sem_3'])) {
					$semestr = 3;
					$credit = $item['sem_3'];
				}
				elseif(!empty($item['sem_4'])) {
					$semestr = 4;
					$credit = $item['sem_4'];
				}
				elseif(!empty($item['sem_5'])) {
					$semestr = 5;
					$credit = $item['sem_5'];
				}
				elseif(!empty($item['sem_6'])) {
					$semestr = 6;
					$credit = $item['sem_6'];
				}
				elseif(!empty($item['sem_7'])) {
					$semestr = 7;
					$credit = $item['sem_7'];
				}
				elseif(!empty($item['sem_8'])) {
					$semestr = 8;
					$credit = $item['sem_8'];
				}
				elseif(!empty($item['sem_9'])) {
					$semestr = 9;
					$credit = $item['sem_9'];
				}
				elseif(!empty($item['sem_10'])) {
					$semestr = 10;
					$credit = $item['sem_10'];
				}
				
				unset($nt_data);
				$nt_data['id_nt'] = "'$id_nt'";
				$nt_data['semestr'] = "'".clear_admin($semestr)."'";
				$nt_data['id_fan'] = "'".clear_admin($id_fan)."'";
				$nt_data['intixobi'] = "'".clear_admin(1)."'";
				$nt_data['c_u'] = "'".$credit."'";
				$nt_data['c_f_u'] = "'".clear_admin($item['credit_faol'])."'";
				if($item['credit_aud'])
					$nt_data['c_a'] = "'".clear_admin($item['credit_aud'])."'";
				else
					$nt_data['c_a'] = "'".clear_admin(0)."'";
				
				$nt_data['cmro'] = "'".clear_admin($item['credit_kmro'])."'";
				$nt_data['cmd'] = "'".clear_admin($item['credit_kmd'])."'";
				$nt_data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
				
				$nt_fields = array_keys($nt_data);
				$nt_data = implode(",", $nt_data);
				insert("nt_content", $nt_fields, $nt_data, 1);
				echo "<br>";
			}
			
		}
		echo "OK";
		exit;
	break;
	
	
	case "import_nt_mg":
		$id_nt = 264;
		$spreadsheet = $reader->load("530102 МГ.xlsx");
		
		$reader->setReadDataOnly(true);

		// Количество листов
		$sheetsCount = $spreadsheet->getSheetCount();

		$data = $spreadsheet->getSheet(0)->toArray();
		
		
		
		$new_arr = [];
		for($j = 1, $i = 1; $i <= 14; $i++) {
			
			$new_arr[$j]['title'] = $data[$i][0];
			$new_arr[$j]['credit'] = $data[$i][1];
			if(!empty($data[$i][2]))
				$new_arr[$j]['imtihon'] = str_replace(".", ",", $data[$i][2]);
			else 
				$new_arr[$j]['imtihon'] = $data[$i][2];
			
			//$new_arr[$j]['k_k'] = $data[$i][34];
			$new_arr[$j]['credit_faol'] = $data[$i][3];
			$new_arr[$j]['credit_aud'] = $data[$i][4];
			$new_arr[$j]['credit_kmro'] = $data[$i][5];
			$new_arr[$j]['credit_kmd'] = $data[$i][6];
			
			$new_arr[$j]['sem_1'] = $data[$i][7];
			$new_arr[$j]['sem_2'] = $data[$i][8];
			$new_arr[$j]['sem_3'] = $data[$i][9];
			$new_arr[$j]['sem_4'] = $data[$i][10];
			
			$j++;
		}
		
		
		foreach($new_arr as $item){
			$check = query("SELECT * FROM `fan_test` WHERE `title_tj` = '{$item['title']}'");
			if(empty($check)){
				unset($fan_data);
				$fan_data['title_tj'] = "'".clear_admin($item['title'])."'";
				$fan_fields = array_keys($fan_data);
				$fan_data = implode(",", $fan_data);
				$id_fan = insert("fan_test", $fan_fields, $fan_data);
			}else{
				$id_fan = $check[0]['id'];
			}
			
			if(!empty($item['imtihon']) && count($sems = explode(",", $item['imtihon'])) > 1){
				print_arr($sems);
				for($i = 0; $i < count($sems); $i++){
					unset($nt_data);
					$nt_data['id_nt'] = "'$id_nt'";
					
					$nt_data['semestr'] = "'".clear_admin($sems[$i])."'";
					$nt_data['id_fan'] = "'".clear_admin($id_fan)."'";
					/*
					if($item['k_k'])
						$nt_data['k_k'] = "'".clear_admin(1)."'";
					*/
					$nt_data['c_u'] = "'".clear_admin($item['sem_'.$sems[$i]])."'";
					$nt_data['c_f_u'] = "'".clear_admin($item['credit_faol'])."'";
					if($item['credit_aud'])
						$nt_data['c_a'] = "'".clear_admin($item['credit_aud'])."'";
					else
						$nt_data['c_a'] = "'".clear_admin(0)."'";
					$nt_data['cmro'] = "'".clear_admin($item['credit_kmro'])."'";
					$nt_data['cmd'] = "'".clear_admin($item['credit_kmd'])."'";
					$nt_data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
					
					
					$nt_fields = array_keys($nt_data);
					$nt_data = implode(",", $nt_data);
					insert("nt_content", $nt_fields, $nt_data, 1);
				}
				
			}else{
				
				if(!empty($item['sem_1'])) {
					$semestr = 1;
					$credit = $item['sem_1'];
				}
				elseif(!empty($item['sem_2'])) {
					$semestr = 2;
					$credit = $item['sem_2'];
				}
				elseif(!empty($item['sem_3'])) {
					$semestr = 3;
					$credit = $item['sem_3'];
				}
				elseif(!empty($item['sem_4'])) {
					$semestr = 4;
					$credit = $item['sem_4'];
				}
				
				
				
				unset($nt_data);
				$nt_data['id_nt'] = "'$id_nt'";
				$nt_data['semestr'] = "'".clear_admin($semestr)."'";
				$nt_data['id_fan'] = "'".clear_admin($id_fan)."'";
				/*
				if($item['k_k'])
					$nt_data['k_k'] = "'".clear_admin(1)."'";
				*/
				$nt_data['c_u'] = "'".clear_admin($credit)."'";
				$nt_data['c_f_u'] = "'".clear_admin($item['credit_faol'])."'";
				if($item['credit_aud'])
					$nt_data['c_a'] = "'".clear_admin($item['credit_aud'])."'";
				else
					$nt_data['c_a'] = "'".clear_admin(0)."'";
				
				$nt_data['cmro'] = "'".clear_admin($item['credit_kmro'])."'";
				$nt_data['cmd'] = "'".clear_admin($item['credit_kmd'])."'";
				$nt_data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
				
				$nt_fields = array_keys($nt_data);
				$nt_data = implode(",", $nt_data);
				insert("nt_content", $nt_fields, $nt_data, 1);
			}
			echo "<br>";	
		}
		echo "NT OK<br>";
		
		
		/*ИНТИХОБӢ*/
		
		$intixobi = $spreadsheet->getSheet(1)->toArray();
		
		
		$new_arr = [];
		for($j = 0, $i = 1; $i < count($intixobi); $i++) {
			
			$new_arr[$j]['title'] = $intixobi[$i][0];
			$new_arr[$j]['credit'] = $intixobi[$i][1];
			if(!empty($intixobi[$i][2]))
				$new_arr[$j]['imtihon'] = str_replace(".", ",", $intixobi[$i][2]);
			else 
				$new_arr[$j]['imtihon'] = $intixobi[$i][2];
			
			
			$new_arr[$j]['credit_faol'] = $intixobi[$i][3];
			$new_arr[$j]['credit_aud'] = $intixobi[$i][4];
			$new_arr[$j]['credit_kmro'] = $intixobi[$i][5];
			$new_arr[$j]['credit_kmd'] = $intixobi[$i][6];
			
			$new_arr[$j]['sem_1'] = $intixobi[$i][7];
			$new_arr[$j]['sem_2'] = $intixobi[$i][8];
			$new_arr[$j]['sem_3'] = $intixobi[$i][9];
			$new_arr[$j]['sem_4'] = $intixobi[$i][10];
			
			$j++;
		}
		
		
		foreach($new_arr as $item){
			$check = query("SELECT * FROM `fan_test` WHERE `title_tj` = '{$item['title']}'");
			if(empty($check)){
				unset($fan_data);
				$fan_data['title_tj'] = "'".clear_admin($item['title'])."'";
				$fan_fields = array_keys($fan_data);
				$fan_data = implode(",", $fan_data);
				$id_fan = insert("fan_test", $fan_fields, $fan_data);
			}else{
				$id_fan = $check[0]['id'];
			}
			
			if(!empty($item['imtihon']) && count($sems = explode(",", $item['imtihon'])) > 1){
				
				for($i = 0; $i < count($sems); $i++){
					unset($nt_data);
					$nt_data['id_nt'] = "'$id_nt'";
					
					$nt_data['semestr'] = "'".clear_admin($sems[$i])."'";
					$nt_data['id_fan'] = "'".clear_admin($id_fan)."'";
					$nt_data['intixobi'] = "'".clear_admin(1)."'";
					$nt_data['c_u'] = "'".clear_admin($item['sem_'.$sems[$i]])."'";
					$nt_data['c_f_u'] = "'".clear_admin($item['credit_faol'])."'";
					if($item['credit_aud'])
						$nt_data['c_a'] = "'".clear_admin($item['credit_aud'])."'";
					else
						$nt_data['c_a'] = "'".clear_admin(0)."'";
					$nt_data['cmro'] = "'".clear_admin($item['credit_kmro'])."'";
					$nt_data['cmd'] = "'".clear_admin($item['credit_kmd'])."'";
					$nt_data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
					
					
					$nt_fields = array_keys($nt_data);
					$nt_data = implode(",", $nt_data);
					insert("nt_content", $nt_fields, $nt_data, 1);
				}
				
			}else{
			
				if(!empty($item['sem_1'])) {
					$semestr = 1;
					$credit = $item['sem_1'];
				}
				elseif(!empty($item['sem_2'])) {
					$semestr = 2;
					$credit = $item['sem_2'];
				}
				elseif(!empty($item['sem_3'])) {
					$semestr = 3;
					$credit = $item['sem_3'];
				}
				elseif(!empty($item['sem_4'])) {
					$semestr = 4;
					$credit = $item['sem_4'];
				}
				
				
				unset($nt_data);
				$nt_data['id_nt'] = "'$id_nt'";
				$nt_data['semestr'] = "'".clear_admin($semestr)."'";
				$nt_data['id_fan'] = "'".clear_admin($id_fan)."'";
				$nt_data['intixobi'] = "'".clear_admin(1)."'";
				$nt_data['c_u'] = "'".$credit."'";
				$nt_data['c_f_u'] = "'".clear_admin($item['credit_faol'])."'";
				if($item['credit_aud'])
					$nt_data['c_a'] = "'".clear_admin($item['credit_aud'])."'";
				else
					$nt_data['c_a'] = "'".clear_admin(0)."'";
				
				$nt_data['cmro'] = "'".clear_admin($item['credit_kmro'])."'";
				$nt_data['cmd'] = "'".clear_admin($item['credit_kmd'])."'";
				$nt_data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
				
				$nt_fields = array_keys($nt_data);
				$nt_data = implode(",", $nt_data);
				insert("nt_content", $nt_fields, $nt_data, 1);
				echo "<br>";
			}
			
		}
		echo "OK";
		exit;
	break;
	
	
	
	
	
	
	
	
	
	
	
	
	case "nt":
		include("PHPExcel.php");
		
		$excel = PHPExcel_IOFactory::load('../modules/helper/НТ 430101.xlsx');
		
		$b = $excel->getActiveSheet()->getCell('B37');
		echo $b;
		exit;
	break;
	
	case "add_litsey":
		
		exit;
		/*
		1726 - охирон запись
		*/
		$pattern_for_litsey = '/^(\d+)([А-Яа-я]\d*)$/u';
		
		$litsey_students = query("SELECT * FROM `2024_Kont` WHERE `edu_KodFaculty` = '11' ORDER BY `edu_Course` ASC");
		
		
		$counter = 0;
		foreach($litsey_students as $item){
			unset($data_user, $fields_user);
			$table = "users";
			$data_user['fullname_tj'] = "'".clear_admin($item['FioTj'])."'";
			$data_user['fullname_ru'] = "'".clear_admin($item['FioRus'])."'";
			$birthday = substr($item['DateBorn'], 0, 10);
			
			if($birthday != '1901-01-01')
				$data_user['birthday'] = "'".clear_admin($birthday)."'";
			$data_user['jins'] = "'".clear_admin($item['Gender'])."'";
			
			$login = makeLogin($item['FioTj'], rand(1,1000));
			$data_user['login'] = "'".clear_admin($login)."'";
			$data_user['password'] = "'".clear_admin($login)."'";
			$data_user['email'] = "'".clear_admin($item['email'])."'";
			$data_user['phone'] = "'".clear_admin($item['cnt_Phone'])."'";
			$data_user['phone_parents'] = "'".clear_admin($item['cnt_PhoneParent'])."'";
			
			
			$data_user['access'] = 1;
			$data_user['access_type'] = 4;
			$data_user['added_by'] = "'".$_SESSION['user']['id']."'";
			$data_user['added_time'] = "'".date("d.m.Y, H:i:s", time())."'";
			
			$fields_user = array_keys($data_user);
			$data_user = implode(",", $data_user);
			/*Иловакунии маълумотҳо дар таблитсаи USERS */
			
			if($id_student = insert($table, $fields_user, $data_user)){
				++$counter;
				unset($passport_data, $passport_fields);
				/*PASSPORT DATAS*/
				$table = "user_passports";
				$passport_data['id_user'] = "'".clear_admin($id_student)."'";
				$passport_data['id_country'] = "'".clear_admin(1)."'";
				$passport_data['id_nation'] = "'".clear_admin(1)."'";
				
				if(!empty($item['cnt_Adress1']))
					$passport_data['address'] = "'".clear_admin($item['cnt_Adress1'])."'";
				
				$passport_fields = array_keys($passport_data);
				$passport_data = implode(",", $passport_data);
				
				insert($table, $passport_fields, $passport_data);
				/*PASSPORT DATAS*/
				
				$table = "student_litsey";
				unset($data, $fields);
				$S_Y = S_Y;
				$H_Y = H_Y;
				
				preg_match($pattern_for_litsey, $item['edu_KodGroup'], $matches_litset);
				
				$data['id_xonanda'] = "'".clear_admin($id_student)."'";
				$data['id_sinf'] = "'".clear_admin(($matches_litset[1] + 1))."'";
				
				$group_code = $matches_litset[2]; // Б
				$group = query("SELECT * FROM `groups` WHERE `title` = '$group_code'");
				
				$data['id_group'] = "'".clear_admin($group[0]['id'])."'";
				$data['s_y'] = $S_Y;
				$data['h_y'] = $H_Y;
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				
				if(insert($table, $fields, $data)){
					
					/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
					//isGroupIsset($_REQUEST['id_faculty'], $_REQUEST['id_course'], $_REQUEST['id_spec'], $_REQUEST['id_group'], $_REQUEST['id_s_l'], $_REQUEST['id_s_v'], $S_Y, $H_Y);
					/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
				}
				
				
			}
			
			
		}
		echo "Сабт шуд: $counter";
		exit;
	break;
	
	case "add_students":
		exit;
		$datas = query("SELECT * FROM `2024_Kont` ORDER BY `edu_KodFaculty`");
		
		
		$pattern_for_ttu = '/^([А-Яа-я\/]+)([\d\-]+)([А-Яа-я\d]+)$/';
		$counter = 0;
		foreach($datas as $item){
			
			if (preg_match($pattern_for_ttu, $item['edu_KodGroup'], $matches)) {
				
				if($matches[1] == 'Д/О' || $matches[1] == 'Д/ОА' || $matches[1] == 'Д/ОБ'){
					$id_s_l = 1;
					$id_s_v = 1;
				}elseif($matches[1] == 'Д/С'){
					$id_s_l = 1;
					$id_s_v = 2;
				}elseif($matches[1] == 'М/Г'){
					$id_s_l = 3;
					$id_s_v = 1;
				}elseif($matches[1] == "В/О"){
					$id_s_l = 2;
					$id_s_v = 2;
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
				
				unset($data_user, $fields_user);
				$table = "users";
				$data_user['fullname_tj'] = "'".clear_admin($item['FioTj'])."'";
				$data_user['fullname_ru'] = "'".clear_admin($item['FioRus'])."'";
				$birthday = substr($item['DateBorn'], 0, 10);
				
				if($birthday != '1901-01-01')
					$data_user['birthday'] = "'".clear_admin($birthday)."'";
				$data_user['jins'] = "'".clear_admin($item['Gender'])."'";
				
				$login = makeLogin($item['FioTj'], rand(1,1000000));
				$data_user['login'] = "'".clear_admin($login)."'";
				$data_user['password'] = "'".clear_admin($login)."'";
				$data_user['email'] = "'".clear_admin($item['email'])."'";
				$data_user['phone'] = "'".clear_admin($item['cnt_Phone'])."'";
				$data_user['phone_parents'] = "'".clear_admin($item['cnt_PhoneParent'])."'";
				$data_user['family_info'] = "'".clear_admin($item['Parents'])."'";
				
				$data_user['access'] = 1;
				$data_user['access_type'] = 3;
				$data_user['added_by'] = "'".$_SESSION['user']['id']."'";
				$data_user['added_time'] = "'".date("d.m.Y, H:i:s", time())."'";
				
				$fields_user = array_keys($data_user);
				$data_user = implode(",", $data_user);
				/*Иловакунии маълумотҳо дар таблитсаи USERS */
				
				if($id_student = insert($table, $fields_user, $data_user)){
					echo $id_student;
					echo "<br>";
					
					$counter++;
					/*PASSPORT DATAS*/
					unset($passport_data, $passport_fields);
					$table = "user_passports";
					$passport_data['id_user'] = "'".clear_admin($id_student)."'";
					$passport_data['number'] = "'".clear_admin($item['Number_pas'])."'";
					if($item['Date_vid_pas'])
						$passport_data['date'] = "'".clear_admin(substr($item['Date_vid_pas'], 0, 10))."'";
					$passport_data['maqomot'] = "'".clear_admin($item['Makom_vid_pas'])."'";
					$passport_data['id_country'] = "'".clear_admin(1)."'";
					$passport_data['id_nation'] = "'".clear_admin(1)."'";
					$passport_data['address'] = "'".clear_admin($item['cnt_Adress1'])."'";
					
					$passport_fields = array_keys($passport_data);
					$passport_data = implode(",", $passport_data);
					
					insert($table, $passport_fields, $passport_data);
					/*PASSPORT DATAS*/
					
					/*USER EDUCATION*/
					unset($edu_data, $edu_fields);
					$table = "user_udecation";
					$edu_data['id_user'] = "'".clear_admin($id_student)."'";
					$edu_data['soli_xatm'] = "'".clear_admin($item['EndSch'])."'";
					
					$edu_data['number_hujjat'] = "'".clear_admin($item['SerialDoc'])."'";
					
					if($item['DataDoc'])
						$edu_data['date_hujjat'] = "'".clear_admin(substr($item['DataDoc'], 0, 10))."'";
					if($item['NSchool'])
						$edu_data['number_scholl'] = "'".clear_admin($item['NSchool'])."'";
					$edu_data['spec'] = "'".clear_admin($item['fKvalif_Spec'])."'";
					
					$edu_fields = array_keys($edu_data);
					$edu_data = implode(",", $edu_data);
					insert($table, $edu_fields, $edu_data);
					/*USER EDUCATION*/
					
					/*MMT INFORMATION*/
					unset($mmt_data, $mmt_fields);
					$table = "student_mmt_information";
					$mmt_data['id_student'] = "'".clear_admin($id_student)."'";
					
					if(is_numeric($item['Number_mmtnp']))
						$mmt_data['number_mmt'] = "'".clear_admin($item['Number_mmtnp'])."'";
					
					if(!empty($item['Otsenka']))
						$mmt_data['total_score_mmt'] = "'".clear_admin($item['Otsenka'])."'";
					
					$mmt_fields = array_keys($mmt_data);
					$mmt_data = implode(",", $mmt_data);
					insert($table, $mmt_fields, $mmt_data);
					
					/*MMT INFORMATION*/
					
					$table = "students";
					unset($data, $fields);
					
					$data['status'] = "'".clear_admin(1)."'";
					$data['id_student'] = "'".clear_admin($id_student)."'";
					$data['id_faculty'] = "'".clear_admin($id_faculty)."'";
					$data['id_s_l'] = "'".clear_admin($id_s_l)."'";
					
					$data['id_spec'] = "'".clear_admin($id_spec)."'";
					$data['id_s_v'] = "'".clear_admin($id_s_v)."'";
					
					$id_course = ($item['edu_Course'] + 1);
					$data['id_course'] = "'".clear_admin($id_course)."'";
					$data['id_group'] = "'".clear_admin($id_group)."'";
					
					if($item['edu_Dog'] == '-1')
						$data['id_s_t'] = "'".clear_admin(1)."'";
					
					if($item['Kvota'] == '1')
						$data['id_s_t'] = "'".clear_admin(3)."'";
					
					$data['s_y'] = S_Y;
					$data['h_y'] = H_Y;
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					
					if(insert($table, $fields, $data)){
						/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
						isGroupIsset($id_faculty, $id_course, $id_spec, $id_group, $id_s_l, $id_s_v, S_Y, H_Y);
						/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
					}	
				}
				/*
				echo "ID_FACULTY: $id_faculty ==> ".getFaculty($id_faculty).'<br>';	
				echo "ID_STUDY_LEVEL: $id_s_l ==> ".getStudyLevel($id_s_l).'<br>';	
				echo "ID_STUDY_VIEW: $id_s_v ==> ".getStudyView($id_s_v).'<br>';
				echo "ID_COURSE: {$item['edu_Course']} ==> ".$id_course = $item['edu_Course'].'<br>';
				echo "ID_SPEC: $id_spec ==> ".getSpecialtyCode($id_spec).' - '.getSpecialtyTitle($id_spec).'<br>';
				echo "ID_GROUP: $id_group ==> ".getGroup2($id_group);
				*/
			} else {
				echo "<span style='color:red'>Строка '{$item['edu_KodGroup']}' не соответствует формату</span><br>";
				exit("444444444444444444");
			}
			
		}
		echo "Сабт шуд $counter";
		exit;
	break;
	
	case "balance":
		$S_Y  = 24;
		$H_Y = 1;
		$students =  query2("SELECT * FROM `students` 
								WHERE `status` = '1' AND 
									`id_s_t` = '1' AND 
									`s_y` = '$S_Y' AND 
									`h_y` = '$H_Y'
								ORDER BY `id_faculty` ASC,
									`id_s_l` ASC,
									`id_s_v` ASC,
									`id_course` ASC,
									`id_spec` ASC, 
									`id_group` ASC	
						");
		foreach($students as $student){
			$id  = $student['id'];
			$id_student  = $student['id_student'];
			$id_faculty = $student['id_faculty'];
			$id_s_l = $student['id_s_l'];
			$id_s_v = $student['id_s_v'];
			$id_course = $student['id_course'];
			$id_spec = $student['id_spec'];
			$id_group = $student['id_group'];
			$foreign=$student['foreign'];
			
			$shartnoma = getSharnomaMoneyBySY($id_course, $id_spec, $id_s_l, $id_s_v, $S_Y, $foreign);
			if($shartnoma){
				unset($fields);
				$balance = $shartnoma / 2;
				$fields = array('balance' => $balance);
				update("students", $fields, "`id` = '$id'", true);
			}
			//exit;
		}
		//print_arr($students);
		exit;
	break;
	
	case "restore_results":
		exit;
		$old_results = query("SELECT * FROM `results_old` ORDER BY `id`");
		foreach($old_results as $result){
			$id_result  = $result['id'];
			$imt_score = $result['imt_score'];
			$total_score = $result['total_score'];
			if(empty($imt_score))
				$imt_score = NULL;
			if(empty($total_score))
				$total_score = NULL;
			
			
			$fields['imt_score'] = $imt_score;
			$fields['total_score'] = $total_score;
			update("results", $fields, "`id` = '$id_result'", true);

		}
		echo "ok";
	break;
	
	case "fanforedit":
		echo "<h3>Барои магистрҳо ва М2</h3>";
		$datas = explode("\n", file_get_contents("../modules/helper/magm2.txt"));
		$c = 1;
		foreach($datas as $fan){
			$check_fan = query("SELECT * FROM `fan_test` WHERE `title_tj` = '".trim($fan)."'");
			if(empty($check_fan)){
				echo $c.". ".$fan."<br>";
				$c++;
			}
		}
		
		echo "<h3>Барои бакалаврҳо</h3>";
		$datas = explode("\n", file_get_contents("../modules/helper/bac.txt"));
		$c = 1;
		foreach($datas as $fan){
			$check_fan = query("SELECT * FROM `fan_test` WHERE `title_tj` = '".trim($fan)."'");
			if(empty($check_fan)){
				echo $c.". ".$fan."<br>";
				$c++;
			}
		}
		exit;
	break;
	
	case "correct_score":
		$S_Y = S_Y;
		$H_Y = H_Y;
		$results  = query("SELECT * FROM `results` WHERE `imt_score` IS NULL AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		foreach($results as $result){
			$id_result = $result['id'];
			$nf1 = $result['nf_1_score'] + $result['nf_1_absent'] + $result['nf_1_score_r'];
			$nf2 = $result['nf_2_score'] + $result['nf_2_absent'] + $result['nf_2_score_r'];
			$nfs = ($nf1 + $nf2) / 2 * 0.6;
			$imt_score = 0;
			$total_score = round($nfs + $imt_score);
			$fields['imt_score'] = $imt_score;
			$fields['total_score'] = $total_score;
			update("results", $fields, "`id` = '$id_result'", true);
			//exit;
		}
		exit;
	break;
	
	
	
}


?>