<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}


include $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php'; // Путь к файлу autoload.php в вашем проекте
use PhpOffice\PhpSpreadsheet\IOFactory;
$reader = IOFactory::createReader('Xlsx');


switch($action){
	case "group_list":
		$page_info['title'] = 'Гуруҳҳо';
		
		$faculties = select("faculties", "*", "", "id", false, "");
		$studylevels = select("study_level", "*", "", "id", false, "");
		$studyviews = select("study_view", "*", "", "id", false, "");
		
		
		$groups = query("
		SELECT
			`std_study_groups`.*,
			`faculties`.`title` AS `faculty_title`,
			`faculties`.`short_title` AS `faculty_short`,
			`specialties`.`code` AS `spec_code`,
			`specialties`.`title_tj` AS `spec_title_tj`,
			`study_level`.`title` AS `s_l_title`,
			`study_view`.`title` AS `s_v_title`,
			`course`.`title` AS `course_title`,
			`groups`.`title` AS `group_title`
		FROM
			`std_study_groups`
		INNER JOIN `faculties` ON `std_study_groups`.`id_faculty` = `faculties`.`id`
		INNER JOIN `specialties` ON `std_study_groups`.`id_spec` = `specialties`.`id`
		INNER JOIN `study_level` ON `std_study_groups`.`id_s_l` = `study_level`.`id`
		INNER JOIN `study_view` ON `std_study_groups`.`id_s_v` = `study_view`.`id`
		INNER JOIN `course` ON `std_study_groups`.`id_course` = `course`.`id`
		INNER JOIN `groups` ON `std_study_groups`.`id_group` = `groups`.`id`
		WHERE
			`std_study_groups`.`status` = '-1' AND `std_study_groups`.`s_y` = '".S_Y."'
		ORDER BY 
			`std_study_groups`.`id_faculty`, `std_study_groups`.`id_s_l`, `std_study_groups`.`id_s_v`,
			`std_study_groups`.`id_course`, `std_study_groups`.`id_spec`
		");
		
		
		
	break;
	
	
	case "del_group":
		$id = $_REQUEST['id'];
		
		delete("std_study_groups", "`id` = '$id'");
		redirect(MY_URL);
	break;
	
	case "freeplaces":
		$list = query("SELECT * FROM `qabul_plan` WHERE `s_y` = '".S_Y."'");
		
		$id = $list[0]['id'];
		$naqsha_details = query("SELECT * FROM `qabul_plan_detail` WHERE `id_qabul_plan` = '$id' ORDER BY `id_spec`, `id_s_l`");
		
		$page_info['title'] = 'Ҷойҳои холӣ';
	break;
	
	case "shartnoma":
		$faculties = query("SELECT * FROM `faculties` ORDER BY `id`");
		
		$page_info['title'] = 'Шартномасупорӣ';

	break;
	
	case "d2s":
		$S_Y = $_REQUEST['s_y'];
		$H_Y = $_REQUEST['h_y'];
		
		if(!isset($S_Y) || !isset($H_Y)) exit('Соли таҳсил ва нимсола вуҷуд надорад! &s_y='.S_Y.'&h_y=1');
		
		$datas = query("SELECT * FROM `students` WHERE `status` = '-1' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id`");
		
		foreach($datas as $item){
			$check = query("SELECT `id` FROM `students` WHERE `id_student` = '{$item['id_student']}' AND (`status` = '1' OR `status` = '0')");
			
			if(empty($check)){
				unset($data, $fields);
				
				$data['status'] = "'1'";
				$data['id_student'] = "'".clear_admin($item['id_student'])."'";
				$data['id_faculty'] = "'".clear_admin($item['id_faculty'])."'";
				$data['id_s_l'] = "'".clear_admin($item['id_s_l'])."'";
				$data['id_s_v'] = "'".clear_admin($item['id_s_v'])."'";
				$data['id_course'] = "'".clear_admin($item['id_course'])."'";
				$data['id_spec'] = "'".clear_admin($item['id_spec'])."'";
				$data['id_group'] = "'".clear_admin($item['id_group'])."'";
				$data['id_s_t'] = "'".clear_admin($item['id_s_t'])."'";
				if($item['foreign'])
					$data['foreign'] = "'".clear_admin($item['foreign'])."'";
				$data['vazi_oilavi'] = "'".clear_admin($item['vazi_oilavi'])."'";
				$data['s_y'] = "'".clear_admin($item['s_y'])."'";
				$data['h_y'] = "'".clear_admin($item['h_y'])."'";
				
				$fields = array_keys($data);
				$data = implode(",", $data);
				insert("students", $fields, $data);
				//echo $item['id_student'].">ok<br>";
			}
		}
		echo "Ҳамаи довталабон ба фармоиш фиристода шуданд!";
		exit;
	break;
	
	case "delete_dovtalab":
		$id = $_REQUEST['id'];
		
		delete("users", "`id` = '$id'");
		delete("students", "`id_student` = '$id'");
		delete("user_passports", "`id_user` = '$id'");
		delete("user_udecation", "`id_user` = '$id'");
		
		redirect();
		
	break;
	
	case "insert_davr":
		$data['title'] = "'".clear_admin($_REQUEST['title'])."'";
		$data['short'] = "'".clear_admin($_REQUEST['short'])."'";
		$data['start_date'] = "'".clear_admin($_REQUEST['start_date'])."'";
		$data['finish_date'] = "'".clear_admin($_REQUEST['finish_date'])."'";
		$data['s_y'] = "'".S_Y."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		if($id = insert("davrho", $fields, $data)){
			if($_FILES['file']['name']){
				$baseExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['file']['name'])); // расширение картинки
				$baseName = "davr_{$id}.{$baseExt}";
				$baseTmpName = $_FILES['file']['tmp_name'];
				if(move_uploaded_file($baseTmpName, "../userfiles/davrho/$baseName")){
					$fields = array('file' => $baseName);
					update("davrho", $fields, "`id` = '$id'");
					
					
					function extract_number_part($string) {
						// Регулярное выражение для поиска части строки с номером
						preg_match('/№\d+/', $string, $matches);
						// Если совпадение найдено, вернуть его, иначе вернуть пустую строку
						return $matches[0] ?? '';
					}
					
					
					
					$spreadsheet = $reader->load($_SERVER['DOCUMENT_ROOT']."/userfiles/davrho/$baseName");
					
					$reader->setReadDataOnly(true);
					$sheetsCount = $spreadsheet->getSheetCount();
					$data = $spreadsheet->getSheet(0)->toArray();
					
					
					if(!file_exists($_SERVER['DOCUMENT_ROOT']."/userfiles/davrho/davr_$id_davr.json")){
					
						$new_data = [];
						for($i = 1; $i < count($data); $i++){
							$new_data[$data[$i][8]]['mmtNumber'] = trim($data[$i][0]);
							$new_data[$data[$i][8]]['name'] = trim($data[$i][1]);
							
							$s_d_sh = explode("/", trim($data[$i][2]));
							$yyyy = $s_d_sh[2];
							$mm = $s_d_sh[0];
							$dd = $s_d_sh[1];
							
							$date = "$yyyy-$mm-$dd";
							
							$new_data[$data[$i][8]]['birthday'] = date('Y-m-d', strtotime($date));
							
							
							if(mb_strtolower(trim($data[$i][3])) == 'мард'){
								$j = 1;
							}else $j = 0;
							
							$new_data[$data[$i][8]]['jins'] = trim($j);
							
							
							
							$new_data[$data[$i][8]]['country'] = 1;
							
							
							$n = trim($data[$i][5]);
							$nation = query("SELECT * FROM `nations` WHERE `title` LIKE '%$n%'");
							
							$id_nation = $nation[0]['id'];
							
							$new_data[$data[$i][8]]['nation'] = $id_nation;
							
							$d = trim($data[$i][6]);
							
							$district = query("SELECT * FROM `districts` WHERE `name` LIKE '%$d%'");
							$id_region = $district[0]['id_region'];
							$id_district = $district[0]['id'];
							print_arr($district);
							
							exit;
							$new_data[$data[$i][8]]['region'] = $id_region;
							$new_data[$data[$i][8]]['district'] = $id_district;
							$new_data[$data[$i][8]]['passport'] = trim($data[$i][8]);
							
							//м/р/сол
							//8/2/2019
							//2018-07-22
							$s_d_sh = explode("/", trim($data[$i][7]));
							$yyyy = $s_d_sh[2];
							$mm = $s_d_sh[0];
							$dd = $s_d_sh[1];
							
							$date = "$yyyy-$mm-$dd";
							
							
							$new_data[$data[$i][8]]['sanai_dodani_passport'] = date('Y-m-d', strtotime($date));
							$new_data[$data[$i][8]]['maqomot'] = trim($data[$i][9]);
							$new_data[$data[$i][8]]['current_address'] = trim($data[$i][10]);
							/*
							$new_data[$data[$i][8]]['number_scholl'] = extract_number_part($data[$i][11]);
							$new_data[$data[$i][8]]['hujjati_xatm'] = trim($data[$i][12]);
							$new_data[$data[$i][8]]['soli_xatm'] = trim($data[$i][13]);
							*/
							
							$new_data[$data[$i][8]]['phone'] = trim(clearPhone($data[$i][11]));
							$new_data[$data[$i][8]]['parent_phone'] = trim(clearPhone($data[$i][12]));
							$new_data[$data[$i][8]]['spec'] = trim($data[$i][13]);
							//$new_data[$data[$i][8]]['title_spec'] = trim($data[$i][17]);
							
							if(mb_strtolower(trim($data[$i][15])) == "рӯзона"){
								$id_s_v = 1;
							}else $id_s_v = 2;
							
							if(mb_strtolower(trim($data[$i][16])) == "пулакӣ"){
								$id_s_t = 1;
							}else $id_s_t = 2;
							
							$new_data[$data[$i][8]]['id_s_v'] = trim($id_s_v);
							$new_data[$data[$i][8]]['id_s_t'] = trim($id_s_t);
							$new_data[$data[$i][8]]['score'] = trim($data[$i][17]);
						}
						
						// 2. Преобразуем массив в строку JSON
						$jsonData = json_encode($new_data, JSON_UNESCAPED_UNICODE);

						// 3. Сохраняем строку JSON в файл
						$file_to_save = $_SERVER['DOCUMENT_ROOT']."/userfiles/davrho/davr_$id.json";
						
						file_put_contents($file_to_save, $jsonData);
					}
				}
			}
		}
		redirect();
	break;
	
	case "update_davr":
		$id = $_REQUEST['id'];
		
		$fields['title'] = $_REQUEST['title'];
		$fields['short'] = $_REQUEST['short'];
		$fields['start_date'] = $_REQUEST['start_date'];
		$fields['finish_date'] = $_REQUEST['finish_date'];
		
		update("davrho", $fields, "`id` = '$id'");
		
		if($_FILES['file']['name']){
			$baseExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['file']['name'])); // расширение картинки
			$baseName = "davr_{$id}.{$baseExt}";
			$baseTmpName = $_FILES['file']['tmp_name'];
			if(move_uploaded_file($baseTmpName, "../userfiles/davrho/$baseName")){
				$fields = array('file' => $baseName);
				update("davrho", $fields, "`id` = '$id'");
				
				function extract_number_part($string) {
					// Регулярное выражение для поиска части строки с номером
					preg_match('/№\d+/', $string, $matches);
					// Если совпадение найдено, вернуть его, иначе вернуть пустую строку
					return $matches[0] ?? '';
				}
				
				
				
				$spreadsheet = $reader->load($_SERVER['DOCUMENT_ROOT']."/userfiles/davrho/$baseName");
				
				$reader->setReadDataOnly(true);
				$sheetsCount = $spreadsheet->getSheetCount();
				$data = $spreadsheet->getSheet(0)->toArray();
				
				
				$new_data = [];
				for($i = 1; $i < count($data); $i++){
					$new_data[$data[$i][1]]['mmtNumber'] = trim($data[$i][0]);
					$new_data[$data[$i][1]]['name'] = trim($data[$i][1]);
					
					if(!empty($data[$i][2])){
						$s_d_sh = explode("/", trim($data[$i][2]));
						$yyyy = $s_d_sh[2];
						$mm = $s_d_sh[0];
						$dd = $s_d_sh[1];
						
						$date = "$yyyy-$mm-$dd";
						
						$new_data[$data[$i][1]]['birthday'] = date('Y-m-d', strtotime($date));
					}
					
					if(!empty($data[$i][3])){
						if(mb_strtolower(trim($data[$i][3])) == 'мард'){
							$j = 1;
						}else $j = 0;
						
						$new_data[$data[$i][1]]['jins'] = trim($j);
					}
					
					$new_data[$data[$i][1]]['country'] = 1;
					
					if(!empty($data[$i][5])){
						$n = trim($data[$i][5]);
						$nation = query("SELECT * FROM `nations` WHERE `title` LIKE '%$n%'");
						$id_nation = $nation[0]['id'];
						$new_data[$data[$i][1]]['nation'] = $id_nation;
					}
					
					if(!empty($data[$i][6])){
						$d = trim($data[$i][6]);
						$district = query("SELECT * FROM `districts` WHERE `name` LIKE '%$d%'");
						$id_region = $district[0]['id_region'];
						$id_district = $district[0]['id'];
						
						$new_data[$data[$i][1]]['region'] = $id_region;
						$new_data[$data[$i][1]]['district'] = $id_district;
					}
					
					if(!empty($data[$i][8])){
						$new_data[$data[$i][1]]['passport'] = trim($data[$i][8]);
					}
					
					if(!empty($data[$i][7])){
						$s_d_sh = explode("/", trim($data[$i][7]));
						$yyyy = $s_d_sh[2];
						$mm = $s_d_sh[0];
						$dd = $s_d_sh[1];
						$date = "$yyyy-$mm-$dd";	
						$new_data[$data[$i][1]]['sanai_dodani_passport'] = date('Y-m-d', strtotime($date));
					}
					
					if(!empty($data[$i][9])){
						$new_data[$data[$i][1]]['maqomot'] = trim($data[$i][9]);
					}
					
					if(!empty($data[$i][10])){
						$new_data[$data[$i][1]]['current_address'] = trim($data[$i][10]);
					}
					/*
					$new_data[$data[$i][7]]['number_scholl'] = extract_number_part($data[$i][11]);
					$new_data[$data[$i][7]]['hujjati_xatm'] = trim($data[$i][12]);
					$new_data[$data[$i][7]]['soli_xatm'] = trim($data[$i][13]);
					*/
					
					$new_data[$data[$i][1]]['phone'] = trim(clearPhone($data[$i][11]));
					$new_data[$data[$i][1]]['parent_phone'] = trim(clearPhone($data[$i][12]));
					$new_data[$data[$i][1]]['spec'] = trim($data[$i][13]);
					//$new_data[$data[$i][1]]['title_spec'] = trim($data[$i][17]);
					
					if(mb_strtolower(trim($data[$i][15])) == "рӯзона"){
						$id_s_v = 1;
					}else $id_s_v = 2;
					
					if(mb_strtolower(trim($data[$i][16])) == "пулакӣ"){
						$id_s_t = 1;
					}else $id_s_t = 2;
					
					$new_data[$data[$i][1]]['id_s_v'] = trim($id_s_v);
					$new_data[$data[$i][1]]['id_s_t'] = trim($id_s_t);
					if(!empty($data[$i][17])){
						$new_data[$data[$i][1]]['score'] = trim($data[$i][17]);
					}
				}
				
				
				// 2. Преобразуем массив в строку JSON
				$jsonData = json_encode($new_data, JSON_UNESCAPED_UNICODE);

				// 3. Сохраняем строку JSON в файл
				$file_to_save = $_SERVER['DOCUMENT_ROOT']."/userfiles/davrho/davr_$id.json";
				
				file_put_contents($file_to_save, $jsonData);
				
			}
		}
		
		
		redirect();
	break;
	
	case "income":
		if(MY_URL == URL.'admin/'){
			$students = query("SELECT 
			`users`.*, `students`.*, `user_passports`.*
			FROM `users`
			INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
			INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
			WHERE
			`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'  AND `students`.`status` = '-1'
			ORDER BY `students`.`id_faculty`, `students`.`id_spec`
			");
		
		}else{
			if($commission[0]['id_faculties'] == 'ALL'){
				$where = "";
			}else {
				$where = "`students`.`id_faculty` IN ({$commission[0]['id_faculties']}) AND ";
			}
			
			$students = query("SELECT 
			`users`.*, `students`.*, `user_passports`.* 
			FROM `users`
			INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
			INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
			WHERE $where
			`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' AND `students`.`status` = '-1'
			ORDER BY `students`.`id_faculty`, `students`.`id_spec`
			");
		}
		
		$page_info['title'] = 'Довталабони воридшуда';
	break;
	
	case "telephone":
		$id_davr = $_REQUEST['id_davr'];
		
		$davr = query("SELECT * FROM `davrho` WHERE `id` = '$id_davr'");
		
		$page_info['title'] = 'Руйхати телефонҳо / '.$davr[0]['short'];
		
		
		$file_to_open = $_SERVER['DOCUMENT_ROOT']."/userfiles/davrho/davr_{$id_davr}.json";
		$jsonData = file_get_contents($file_to_open);
		
		$datas = json_decode($jsonData, true);
		
		
	break;
	
	case "bill":
		$ourData = file_get_contents();
		// Преобразуем в массив
		$array = json_decode($ourData, true);
		print_arr($array); // выводим массив
		exit;
	break;
	
	
	case "region_statistic":
		$page_info['title'] = "Омори минтақавӣ";
		$regions = select("regions", "*", "", "name", false, "");
	break;
	
	case "myitems":
		$page_info['title'] = 'Сабтҳои ман';
		
		if(isset($_SESSION['user']['admin'])){
			/* Баровардани контингенти гурух */
			$students = query("SELECT `students`.*, `users`.* FROM `users`
			INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
			WHERE `students`.`status` = '-1'
			AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
			ORDER BY `users`.`id` DESC
			");
		}else{
			/* Баровардани контингенти гурух */
			$students = query("SELECT `students`.*, `users`.* FROM `users`
			INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
			WHERE `students`.`status` = '-1' AND `users`.`added_by` = '".$_SESSION['user']['id']."'
			AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
			ORDER BY `users`.`id` DESC
			");
		}
		/* Баровардани контингенти гурух */
	break;
	
	case "statistic":
		//$date = date("d.m.Y");
		//$date = "26.07.2023";//date("d.m.Y");
		$date_start = false;
		$date_finish = false;
		
		$page_info['title'] = 'Омори коммисияи қабул';
	break;
	
	
	case "settings":
		$page_info['title'] = 'Ҷурсозиҳои коммисияи қабул';
		
		$datas = query("SELECT `commission_module`.*, 
		`users`.`fullname_tj`,
		`users`.`jins`,
		`users`.`photo`
		FROM `commission_module` 
		INNER JOIN `users` ON `users`.`id` = `commission_module`.`id_user`
		WHERE `commission_module`.`s_y` = '".S_Y."'");
		
		
		$davr_datas = query("SELECT * FROM `davrho` WHERE `s_y` = '".S_Y."' ORDER BY `id`");
		
	break;
	
	case "insert_member":
		$data['id_user'] = "'".$_REQUEST['id_user']."'";
		
		$faculties = $_REQUEST['faculties'];
		if(count($faculties) > 1){
			$ids = [];
			for($i = 1; $i < count($faculties); $i++){
				$ids[] = $faculties[$i];
			}
			$ids = implode(",", $ids);
			$data['id_faculties'] = "'".$ids."'";
		}else {
			$data['id_faculties'] = "'".$faculties[0]."'";
		}
		
		$studylevels = $_REQUEST['study_level'];
		if(count($studylevels) > 1){
			$ids = [];
			for($i = 1; $i < count($studylevels); $i++){
				$ids[] = $studylevels[$i];
			}
			$ids = implode(",", $ids);
			$data['id_s_l'] = "'".$ids."'";
		}else {
			$data['id_s_l'] = "'".$studylevels[0]."'";
		}
		
		$countries = $_REQUEST['countries'];
		if(count($countries) > 1){
			$ids = [];
			for($i = 1; $i < count($countries); $i++){
				$ids[] = $countries[$i];
			}
			$ids = implode(",", $ids);
			$data['id_countries'] = "'".$ids."'";
		}else {
			$data['id_countries'] = "'".$countries[0]."'";
		}
		
		
		$data['s_y'] = "'".S_Y."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		insert('commission_module', $fields, $data);
		redirect();
	break;
	
	case "update_member":
		$id = $_REQUEST['id'];
		$fields['id_user'] = $_REQUEST['id_user'];
		
		$faculties = $_REQUEST['faculties'];
		if(count($faculties) > 1){
			$ids = [];
			for($i = 1; $i < count($faculties); $i++){
				$ids[] = $faculties[$i];
			}
			$ids = implode(",", $ids);
			$fields['id_faculties'] = $ids;
		}else {
			$fields['id_faculties'] = $faculties[0];
		}
		
		$studylevels = $_REQUEST['study_level'];
		if(count($studylevels) > 1){
			$ids = [];
			for($i = 1; $i < count($studylevels); $i++){
				$ids[] = $studylevels[$i];
			}
			$ids = implode(",", $ids);
			$fields['id_s_l'] = $ids;
		}else {
			$fields['id_s_l'] = $studylevels[0];
		}
		
		$countries = $_REQUEST['countries'];
		if(count($countries) > 1){
			$ids = [];
			for($i = 1; $i < count($countries); $i++){
				$ids[] = $countries[$i];
			}
			$ids = implode(",", $ids);
			$fields['id_countries'] = $ids;
		}else {
			$fields['id_countries'] = $countries[0];
		}
		
		
		update("commission_module", $fields, "`id` = '$id'", 1);
		
		redirect();
	break;
	
	case "delete_member":
		$id = $_REQUEST['id'];
		
		delete("commission_module", "`id` = '$id'");
		redirect();
	break;
	
	
	case "add":
		if(MY_URL == URL.'admin/'){
			$faculties = select("faculties", "*", "", "id", false, "");
			
			$specialties = query("SELECT * FROM `specialties` ORDER BY `id_faculty`, `id`");
			
			$studylevels = select("study_level", "*", "", "id", false, "");
			$countries = select("countries", "*", "", "id", false, "");
			
		}else{
			if($commission[0]['id_faculties'] == 'ALL'){
				$where = "";
			}else {
				$where = "WHERE `id` IN ({$commission[0]['id_faculties']})";
			}
			
			$faculties = query("SELECT * FROM `faculties` $where ORDER BY `id`");
			
			if($commission[0]['id_faculties'] == 'ALL'){
				$f_w = '';
			}else{
				$f_w = "WHERE `id_faculty` IN ({$commission[0]['id_faculties']}) AND ";
			}
			
			if($commission[0]['id_s_l'] == 'ALL'){
				$s_l_h = '';
			}else{
				$s_l_h = " AND `id_s_l` IN ({$commission[0]['id_s_l']})";
			}
			
			
			$specialties = query("SELECT * FROM `specialties` $f_w $s_l_h ORDER BY `id_faculty`, `id`");
			
			
			if($commission[0]['id_s_l'] == 'ALL'){
				$where = "";
			}else {
				$where = "WHERE `id` IN ({$commission[0]['id_s_l']})";
			}
			
			$studylevels = query("SELECT * FROM `study_level` $where ORDER BY `id`");
			
			/*COUNTRIES*/
			if($commission[0]['id_countries'] == 'ALL'){
				$where = "";
			}else {
				$where = "WHERE `id` IN ({$commission[0]['id_countries']})";
			}
			
			$countries = query("SELECT * FROM `countries` $where ORDER BY `id`");
		}
		
		
		$studytypes = select("study_type", "*", "", "id", false, "");
		$studyviews = select("study_view", "*", "", "id", false, "");
		$courses = select("course", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "title", false, "");
		$vazi_oilavi = select("vazi_oilavi", "*", "", "id", false, "");
		$nations = select("nations", "*", "", "id", false, "");
		
		$regions = query("SELECT * FROM `regions` ORDER BY `id`");
		$districts = query("SELECT * FROM `districts` ORDER BY `id_region`, id");
		
		
		$davrho = query("SELECT * FROM `davrho` WHERE `finish_date` >= CURDATE() AND `s_y` = '".S_Y."' ORDER BY `students` DESC");
		
		
		$page_info['title'] = 'Иловакунии довталаб';
	break;
	
	case "insert":
		$page_info['title'] = "Сабткунии довталаб: ".$_REQUEST['fullname'];
		$id_faculty = $_REQUEST['id_faculty'];
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		$table = "users";
		$data['fullname_tj'] = "'".clear_admin($_REQUEST['fullname'])."'";
		$data['fullname_ru'] = "'".clear_admin($_REQUEST['fullname_ru'])."'";
		$data['birthday'] = "'".clear_admin($_REQUEST['birthday'])."'";
		$data['jins'] = "'".clear_admin($_REQUEST['jins'])."'";
		
		/*
		if(busylogin($_REQUEST['login'])){
			$query = query("SELECT COUNT(`id`) as `n` FROM `students` WHERE `status` = '-1' AND `id_faculty` = '$id_faculty' AND `s_y` = '".S_Y."'");
			$num = $query[0]['n'] + 1;
			$login = date("Y").sprintf("%02d", $id_faculty).sprintf("%04d", $num);
			
			$data['login'] = "'".$login."'";
			$data['password'] = "'".$login."'";
		}else{
			$data['login'] = "'".clear_admin($_REQUEST['login'])."'";
			$data['password'] = "'".clear_admin($_REQUEST['password'])."'";
		}
		
		
		$data_login = query("SELECT `users`.*, `students`.* FROM `users` 
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		WHERE 
			`students`.`status` = '-1' AND 
			`students`.`id_faculty` = '$id_faculty' AND 
			`students`.`s_y` = '".S_Y."' ORDER BY `users`.`id` DESC LIMIT 1");
		
		$login = $data_login[0]['login'] + 1;
		
		$data['login'] = "'".clear_admin($login)."'";
		$data['password'] = "'".clear_admin($login)."'";
		*/
		
		$data['login'] = "'".clear_admin($_REQUEST['login'])."'";
		$data['password'] = "'".clear_admin($_REQUEST['password'])."'";
		
		if(!empty($_REQUEST['email']))
			$data['email'] = "'".clear_admin($_REQUEST['email'])."'";
		if(!empty($_REQUEST['phone']))
			$data['phone'] = "'".clear_admin($_REQUEST['phone'])."'";
		if(!empty($_REQUEST['parent_phone']))
			$data['phone_parents'] = "'".clear_admin($_REQUEST['parent_phone'])."'";
		$data['v_ijtimoi'] = "'".clear_admin($_REQUEST['vazi_ijtimoi'])."'";
		$data['from_family'] = "'".clear_admin($_REQUEST['az_oilai_ki'])."'";
		$data['v_oilavi'] = "'".clear_admin($_REQUEST['vazi_oilavi_form'])."'";
		$data['family_info'] = "'".clear_admin($_REQUEST['family_info'])."'";
		
		if(!empty($_REQUEST['xobgoh']))
			$data['xobgoh'] = "'".clear_admin(1)."'";
		
		if(!empty($_REQUEST['unvoni_harbi']))
			$data['unvoni_harbi'] = "'".clear_admin($_REQUEST['unvoni_harbi'])."'";
		
		if(!empty($_REQUEST['lashkar']))
			$data['lashkar'] = "'".clear_admin($_REQUEST['lashkar'])."'";
		
		$data['access'] = 1;
		$data['access_type'] = 3;
		$data['added_by'] = "'".$_SESSION['user']['id']."'";
		$data['added_time'] = "'".date("Y-m-d H:i:s")."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		
		if($id_student = insert($table, $fields, $data)){
			
			/*PASSPORT DATAS*/
			$table = "user_passports";
			$passport_data['id_user'] = "'".clear_admin($id_student)."'";
			$passport_data['number'] = "'".clear_admin($_REQUEST['number_passport'])."'";
			$passport_data['date'] = "'".clear_admin($_REQUEST['sanai_dodani_passport'])."'";
			$passport_data['maqomot'] = "'".clear_admin($_REQUEST['maqomot'])."'";
			$passport_data['id_country'] = "'".clear_admin($_REQUEST['id_country'])."'";
			$passport_data['id_nation'] = "'".clear_admin($_REQUEST['id_nation'])."'";
			if(!empty($_REQUEST['id_region']))
				$passport_data['id_region'] = "'".clear_admin($_REQUEST['id_region'])."'";
			
			if(!empty($_REQUEST['id_district']))
				$passport_data['id_district'] = "'".clear_admin($_REQUEST['id_district'])."'";
			$passport_data['address'] = "'".clear_admin($_REQUEST['current_address'])."'";
			
			$passport_fields = array_keys($passport_data);
			$passport_data = implode(",", $passport_data);
			
			insert($table, $passport_fields, $passport_data);
			/*PASSPORT DATAS*/
			
			/*USER EDUCATION*/
			$table = "user_udecation";
			$edu_data['id_user'] = "'".clear_admin($id_student)."'";
			$edu_data['id_khatm_namud'] = "'".clear_admin($_REQUEST['xatm_namud'])."'";
			$edu_data['id_hujjat'] = "'".clear_admin($_REQUEST['hujjati_xatm'])."'";
			$edu_data['soli_xatm'] = "'".clear_admin($_REQUEST['soli_xatm'])."'";
			$edu_data['silsila'] = "'".clear_admin($_REQUEST['silsila'])."'";
			$edu_data['number_hujjat'] = "'".clear_admin($_REQUEST['number_hujjat'])."'";
			$edu_data['date_hujjat'] = "'".clear_admin($_REQUEST['date_hujjat'])."'";
			$edu_data['number_scholl'] = "'".clear_admin($_REQUEST['number_scholl'])."'";
			$edu_data['spec'] = "'".clear_admin($_REQUEST['spec'])."'";
			
			if(!empty($_REQUEST['muasisa_name']))
				$edu_data['muasisa_name'] = "'".clear_admin($_REQUEST['muasisa_name'])."'";
			$edu_data['muasisa_lang'] = "'".clear_admin($_REQUEST['muasisa_lang'])."'";
			
			$edu_fields = array_keys($edu_data);
			$edu_data = implode(",", $edu_data);
			insert($table, $edu_fields, $edu_data);
			/*USER EDUCATION*/
			
			/*MMT INFORMATION*/
			
			$table = "student_mmt_information";
			$mmt_data['id_student'] = "'".clear_admin($id_student)."'";
			if(!empty($_REQUEST['number_mmt']))
				$mmt_data['number_mmt'] = "'".clear_admin($_REQUEST['number_mmt'])."'";
			
			if(!empty($_REQUEST['score_mmt']))
				$mmt_data['total_score_mmt'] = "'".clear_admin(floatval($_REQUEST['score_mmt']))."'";
			
			if(!empty($_REQUEST['davr']))
				$mmt_data['davri_qabul_mmt'] = "'".clear_admin($_REQUEST['davr'])."'";
			
			$mmt_fields = array_keys($mmt_data);
			$mmt_data = implode(",", $mmt_data);
			insert($table, $mmt_fields, $mmt_data);
			
			/*MMT INFORMATION*/
			
			/*RASID*/
			/*
			$table = "rasidho";
			$rasid_data['type'] = "'".clear_admin(1)."'";
			$rasid_data['id_student'] = "'".clear_admin($id_student)."'";
			$rasid_data['check_date'] = "'".clear_admin(date("Y-m-d"))."'";
			$rasid_data['check_money'] = "'".clear_admin(HUJJAT_MONEY)."'";
			$rasid_data['s_y'] = "'".clear_admin(S_Y)."'";
			$rasid_data['author'] = "'".$_SESSION['user']['id']."'";
			
			$rasid_fields = array_keys($rasid_data);
			$rasid_data = implode(",", $rasid_data);
			insert($table, $rasid_fields, $rasid_data);
			*/
			/*RASID*/
			
			
			
			$table = "students";
			
			unset($data, $fields);
			
			$data['status'] = "'".clear_admin("-1")."'";
			$data['id_student'] = "'".clear_admin($id_student)."'";
			$data['id_faculty'] = "'".clear_admin($_REQUEST['id_faculty'])."'";
			$data['id_s_l'] = "'".clear_admin($_REQUEST['id_s_l'])."'";
			
			$data['id_spec'] = "'".clear_admin($_REQUEST['id_spec'])."'";
			$data['id_s_v'] = "'".clear_admin($_REQUEST['id_s_v'])."'";
			
			if(!empty($_REQUEST['foreign']))
				$data['foreign'] = "'1'";
			
			$data['id_course'] = "'".clear_admin($_REQUEST['id_course'])."'";
			$data['id_group'] = "'".clear_admin($_REQUEST['id_group'])."'";
			$data['id_s_t'] = "'".clear_admin($_REQUEST['id_s_t'])."'";
			$data['vazi_oilavi'] = "'".clear_admin($_REQUEST['vazi_oilavi'])."'";
			
			$data['s_y'] = S_Y;
			$data['h_y'] = 1;
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			if(insert($table, $fields, $data)){
				/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
				isGroupIsset($_REQUEST['id_faculty'], $_REQUEST['id_course'], $_REQUEST['id_spec'], $_REQUEST['id_group'], $_REQUEST['id_s_l'], $_REQUEST['id_s_v'], S_Y, H_Y, "-1");
				isGroupIsset($_REQUEST['id_faculty'], $_REQUEST['id_course'], $_REQUEST['id_spec'], $_REQUEST['id_group'], $_REQUEST['id_s_l'], $_REQUEST['id_s_v'], S_Y, H_Y);
				/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
			}
				
			
			
			if($_FILES['photo']['name']){
				$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['photo']['name'])); // расширение картинки
				$baseimgName = "{$id_student}.{$baseimgExt}";
				$baseimgTmpName = $_FILES['photo']['tmp_name'];
				if(move_uploaded_file($baseimgTmpName, "../userfiles/students/$baseimgName")){
					$fields = array('photo' => $baseimgName);
					update("users", $fields, "`id` = '$id_student'");
				}
			}
			setUserOnlineData($_SESSION['user']['id'], $_SERVER['REQUEST_URI'], $page_info['title']);
			redirect(MY_URL."?option=commission&action=list&id_faculty={$_REQUEST['id_faculty']}&id_s_l={$_REQUEST['id_s_l']}&id_s_v={$_REQUEST['id_s_v']}&id_course={$_REQUEST['id_course']}&id_spec={$_REQUEST['id_spec']}&id_group={$_REQUEST['id_group']}");	
		}
	break;
	
	case "create_check":
		$id_student = $_REQUEST['id_student'];
		/*RASID*/
		$table = "rasidho";
		$rasid_data['tranid'] = "'".clear_admin($_REQUEST['check_number'])."'";
		$rasid_data['type'] = "'".clear_admin($_REQUEST['type'])."'";
		$rasid_data['id_student'] = "'".clear_admin($id_student)."'";
		$rasid_data['check_date'] = "'".clear_admin($_REQUEST['check_date'])."'";
		$rasid_data['check_money'] = "'".clear_admin($_REQUEST['check_money'])."'";
		$rasid_data['s_y'] = "'".clear_admin(S_Y)."'";
		$rasid_data['payed'] = "'".clear_admin(1)."'";
		$rasid_data['author'] = "'".$_SESSION['user']['id']."'";
		
		$rasid_fields = array_keys($rasid_data);
		$rasid_data = implode(",", $rasid_data);
		insert($table, $rasid_fields, $rasid_data);
		/*RASID*/
		
		redirect();
	break;
	
	case "update_student":
		
		$id_student = $_REQUEST['id_student'];
		
		$fields_users['fullname_tj'] = $_REQUEST['fullname_tj'];
		$fields_users['fullname_ru'] = $_REQUEST['fullname_ru'];
		$fields_users['jins'] = $_REQUEST['jins'];
		$fields_users['login'] = $_REQUEST['login'];
		$fields_users['password'] = $_REQUEST['password'];
		$fields_users['birthday'] = $_REQUEST['birthday'];
		
		if(!empty($_REQUEST['email']))
			$fields_users['email'] = $_REQUEST['email'];
		if(!empty($_REQUEST['phone']))
			$fields_users['phone'] = $_REQUEST['phone'];
		if(!empty($_REQUEST['parent_phone']))
			$fields_users['phone_parents'] = $_REQUEST['parent_phone'];
		
		$fields_users['v_ijtimoi'] = $_REQUEST['vazi_ijtimoi'];
		$fields_users['from_family'] = $_REQUEST['az_oilai_ki'];
		$fields_users['v_oilavi'] = $_REQUEST['vazi_oilavi_form'];
		$fields_users['family_info'] = $_REQUEST['family_info'];
		
		if(!empty($_REQUEST['xobgoh']))
			$fields_users['xobgoh'] = 1;
		if(!empty($_REQUEST['unvoni_harbi']))
			$fields_users['unvoni_harbi'] = $_REQUEST['unvoni_harbi'];
		if(!empty($_REQUEST['lashkar']))
			$fields_users['lashkar'] = $_REQUEST['lashkar'];
		
		update("users", $fields_users, "`id` = '$id_student'");
		
		if($_FILES['photo']['name']){
			$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['photo']['name'])); // расширение картинки
			$baseimgName = "{$id_student}.{$baseimgExt}";
			$baseimgTmpName = $_FILES['photo']['tmp_name'];
			if(move_uploaded_file($baseimgTmpName, "../userfiles/students/$baseimgName")){
				$fields_photo = array('photo' => $baseimgName);
				update("users", $fields_photo, "`id` = '$id_student'");
			}
		}
		
		
		
		/*PASSPORT DATAS*/
		$fields_passport['number'] = $_REQUEST['number_passport'];
		$fields_passport['date'] = $_REQUEST['sanai_dodani_passport'];
		$fields_passport['maqomot'] = $_REQUEST['maqomot'];
		if(!empty($_REQUEST['id_country']))
			$fields_passport['id_country'] = $_REQUEST['id_country'];
		
		if(!empty($_REQUEST['id_region']))
			$fields_passport['id_region'] = $_REQUEST['id_region'];
		if(!empty($_REQUEST['id_district']))
			$fields_passport['id_district'] = $_REQUEST['id_district'];
		if(!empty($_REQUEST['current_address']))
			$fields_passport['address'] = $_REQUEST['current_address'];
		
		$fields_passport['id_nation'] = $_REQUEST['id_nation'];
		
		update("user_passports", $fields_passport, "`id_user` = '$id_student'");
		/*PASSPORT DATAS*/
		
		
		/*USER EDUCATION*/
		$fields_edu['id_khatm_namud'] = $_REQUEST['xatm_namud'];
		$fields_edu['id_hujjat'] = $_REQUEST['hujjati_xatm'];
		$fields_edu['soli_xatm'] = $_REQUEST['soli_xatm'];
		$fields_edu['silsila'] = $_REQUEST['silsila'];
		$fields_edu['number_hujjat'] = $_REQUEST['number_hujjat'];
		$fields_edu['date_hujjat'] = $_REQUEST['date_hujjat'];
		if(!empty($_REQUEST['number_scholl']))
			$fields_edu['number_scholl'] = $_REQUEST['number_scholl'];
		$fields_edu['spec'] = $_REQUEST['spec'];
		if(!empty($_REQUEST['muasisa_name']))
			$fields_edu['muasisa_name'] = $_REQUEST['muasisa_name'];
		$fields_edu['muasisa_lang'] = $_REQUEST['muasisa_lang'];
		
		update("user_udecation", $fields_edu, "`id_user` = '$id_student'", 1);
		/*USER EDUCATION*/
		
		
		/*MMT INFORMATION*/
		$check = query("SELECT * FROM `student_mmt_information` WHERE `id_student` = '$id_student'");
		if(!empty($check)){
			
			if(!empty($_REQUEST['number_mmt']))
				$fields_mmt['number_mmt'] = $_REQUEST['number_mmt'];
			else	
				$fields_mmt['number_mmt'] = 'NULL';
			if(!empty($_REQUEST['score_mmt']))
				$fields_mmt['total_score_mmt'] = $_REQUEST['score_mmt'];
			else
				$fields_mmt['total_score_mmt'] = 'NULL';
			if(!empty($_REQUEST['davr']))
				$fields_mmt['davri_qabul_mmt'] = $_REQUEST['davr'];
			
			if(isset($fields_mmt))
				update("student_mmt_information", $fields_mmt, "`id_student` = '$id_student'");
			
		}
		/*MMT INFORMATION*/
		
		/* STUDENTS */
		$S_Y = S_Y;
		$H_Y = H_Y;
		
		
		$fields_student['id_faculty'] = $_REQUEST['id_faculty'];
		$fields_student['id_s_l'] = $_REQUEST['id_s_l'];
		$fields_student['id_spec'] = $_REQUEST['id_spec'];
		$fields_student['id_s_v'] = $_REQUEST['id_s_v'];
		if(!empty($_REQUEST['foreign']))
			$fields_student['foreign'] = 1;
		$fields_student['id_course'] = $_REQUEST['id_course'];
		$fields_student['id_group'] = $_REQUEST['id_group'];
		$fields_student['id_s_t'] = $_REQUEST['id_s_t'];
		$fields_student['vazi_oilavi'] = $_REQUEST['vazi_oilavi'];
		
		
		if(update("students", $fields_student, "`id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")){
			/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
			isGroupIsset($_REQUEST['id_faculty'], $_REQUEST['id_course'], $_REQUEST['id_spec'], $_REQUEST['id_group'], $_REQUEST['id_s_l'], $_REQUEST['id_s_v'], $S_Y, $H_Y);
			/* Санҷиш барои вуҷуд доштани ин гуруҳ дар таблитсаи std_study_groups */
		}
		
		/*Маълумотҳои пешинаи донишҷӯ*/
		$student_info = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		$old_id_faculty = $student_info[0]['id_faculty'];
		$old_id_s_l = $student_info[0]['id_s_l'];
		$old_id_s_v = $student_info[0]['id_s_v'];
		$old_id_course = $student_info[0]['id_course'];
		$old_id_spec = $student_info[0]['id_spec'];
		$old_id_group = $student_info[0]['id_group'];
		$old_id_s_t = $student_info[0]['id_s_t'];
		/*Маълумотҳои пешинаи донишҷӯ*/
		
		/*Муайян мекунем ки дар гурух чанд донишҷуи дигар боқи мемонад*/
		$info_group = query("SELECT COUNT(`id`) as `count` FROM `students` WHERE 
		`id_faculty` = '$old_id_faculty' AND 
		`id_s_l` = '$old_id_s_l' AND 
		`id_s_v` = '$old_id_s_v' AND 
		`id_course` = '$old_id_course' AND 
		`id_spec` = '$old_id_spec' AND 
		`id_group` = '$old_id_group' AND 
		`s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		/*Муайян мекунем ки дар гурух чанд донишҷуи дигар боқи мемонад*/
		
		
		/*Агар ҳамин донишҷӯ ягона донишҷуи гурух бошад пас аз контингенти гуруххо нест мекунем гурухро*/
		if($info_group[0]['count'] == 0){
			unset($_SESSION['superarr'][$old_id_faculty]["level"][$old_id_s_l]["view"][$old_id_s_v]["course"][$old_id_course]['spec'][$old_id_spec]['groups'][$old_id_group]);
			delete("std_study_groups", "
			`id_faculty` = '$old_id_faculty' AND 
			`id_s_l` = '$old_id_s_l' AND 
			`id_s_v` = '$old_id_s_v' AND
			`id_course` = '$old_id_course' AND 
			`id_spec` = '$old_id_spec' AND 
			`id_group` = '$old_id_group' AND 
			`s_y` = '$S_Y' AND `h_y` = '$H_Y'");
		}
		redirect();	
		/*Агар ҳамин донишҷӯ ягона донишҷуи гурух бошад пас аз контингенти гуруххо нест мекунем гурухро*/
		/* STUDENTS */
		
	break;
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		
		if(MY_URL != URL.'admin/'){
			if($commission[0]['id_faculties'] != 'ALL' AND (!in_array($id_faculty, explode(",", $commission[0]['id_faculties'])))){
				redirect(MY_URL);
			}
		}
		
		/* Баровардани контингенти гурух */
		$students = getContingent("-1", $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		/* Баровардани контингенти гурух */
		
		if(empty($students)){
			$students = getContingent("1", $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
		}
	
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		$group_options = select("std_study_groups", array("id", "id_nt", "lang"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_s_v` = '$id_s_v' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id", false, "");
		$id_study_group = @$group_options[0]['id'];
		$id_nt = @$group_options[0]['id_nt'];
		$lang = @$group_options[0]['lang'];
		/*Муайян намудани нақшаи таълимии гурӯҳ*/
		
		/*Баровардани фанхо аз руи нақшаи таълимӣ*/
		/*
		$fanlist = query("SELECT * FROM `nt_content`  
		WHERE `id_nt` = '$id_nt' AND `id_course` = '$id_course' AND `h_y` = '".H_Y."' ORDER BY `id_fan`");
		*/
		/*Баровардани фанхо аз руи нақшаи таълимӣ*/

		
		//$nepodusk = select("std_nedopusk", array("DISTINCT(id_student)"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_student", false, "");
		
		//$ishtirok_kardand = select2("std_resultsimt", array("DISTINCT(id_student)"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id_student", false, "");
		
		$page_info['title'] = 'Коммиссияи қабул / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.getCourse($id_course).' / '.getSpecialtyCode($id_spec).' / '.getGroup($id_group);
		
	break;
	
	case "studentstatistic":
		
		$page_info['title'] = "Омори донишҷуён";
		
		if(isset($_REQUEST['id_faculty'])){
			$id_faculty = $_REQUEST['id_faculty'];
			$all_stds_where = "`id_faculty` = '$id_faculty' AND ";
			$mw_where = "`students`.`status` = '1' AND `students`.`id_faculty` = '$id_faculty' AND ";
			$mw_where1 = "`std_table`.`status` = '1' AND `std_table`.`id_faculty` = '$id_faculty' AND ";
		}else{
			$all_stds_where = "";
			$mw_where = "`students`.`status` = '1' AND ";
			$mw_where1 = "`std_table`.`status` = '1' AND ";
		}
		
		
		$all_students = select("students", array("Count(id)"), "`status` = '1' AND $all_stds_where `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id", false, "");
		$all_students = $all_students[0]['Count(`id`)'];
		
		
		$ruzona = select("students", array("Count(id)"), "`status` = '1' AND $all_stds_where `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id", false, "");
		$ruzona = $ruzona[0]['Count(`id`)'];
		
		$fosilavi = select("students", array("Count(id)"), "`status` = '1' AND $all_stds_where `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id", false, "");
		$fosilavi = $fosilavi[0]['Count(`id`)'];
		
		
		
		$query = query("select count(`students`.`id`) as `mans`,
		(SELECT COUNT(`students`.`id`) FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `users`.`jins` = '1' AND `id_s_v` = 1 AND `s_y` = ".S_Y." AND `h_y` = ".H_Y.") as `m_ruzona`,
		(SELECT COUNT(`students`.`id`) FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `users`.`jins` = '1' AND `id_s_v` = 2 AND `s_y` = ".S_Y." AND `h_y` = ".H_Y.") as `m_fosilavi`,
		(select count(`students`.`id`) as `womans`
		from `students` left join `users` on `students`.`id_student`  = `users`.`id`
		where $mw_where `users`.`jins` = '0' AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y.") as `womans`,
		(SELECT COUNT(`students`.`id`) FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `users`.`jins` = '0' AND `id_s_v` = 1 AND `s_y` = ".S_Y." AND `h_y` = ".H_Y.") as `w_ruzona`,
		(SELECT COUNT(`students`.`id`) FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `users`.`jins` = '0' AND `id_s_v` = 2 AND `s_y` = ".S_Y." AND `h_y` = ".H_Y.") as `w_fosilavi`
		from `students` left join `users` on `students`.`id_student`  = `users`.`id`
		where $mw_where `users`.`jins` = '1' AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y."");
		
		
		$statistic = query("
		SELECT `std_table`.`id_course`, count(`std_table`.`id`) as `all`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '1' AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `mans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '0' AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `woman`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `students`.`id_s_v` = 1 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `all_ruz`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '1' AND `students`.`id_s_v` = 1 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `ruz_mans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '0' AND `students`.`id_s_v` = 1 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `ruz_womans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `students`.`id_s_v` = 2 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `all_fos`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '1' AND `students`.`id_s_v` = 2 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `fos_mans`,
		(SELECT COUNT(`students`.`id`) as `mans` FROM `students` left join `users` on `students`.`id_student`  = `users`.`id` WHERE $mw_where `students`.`id_course` = `std_table`.`id_course` AND `users`.`jins` = '0' AND `students`.`id_s_v` = 2 AND `students`.`s_y` = ".S_Y." AND `students`.`h_y` = ".H_Y." ORDER BY `id_course`) as `fos_womans`,
		`std_table`.`s_y`,
		`std_table`.`h_y`
		from `students` as `std_table` WHERE $mw_where1 `std_table`.`s_y` = ".S_Y." AND `std_table`.`h_y` = ".H_Y." GROUP BY 1 ORDER BY `std_table`.`id_course`
		");
		
		
		$faculties = select("real_faculties", "*", "`s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "title", false, "");
		
	break;
	
	case "groupstatistic":
		$page_info['title'] = "Омори гурӯҳҳо";
		$statistic = query("
			SELECT `id_faculty`,`title`, 
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as allgroups,
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `id_s_v` = 1 AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as ruzona,
			(SELECT COUNT(`id_faculty`) FROM `state_groups` WHERE `id_faculty` = `r_f`.`id_faculty` AND `id_s_v` = 2 AND `s_y` = `r_f`.`s_y` AND `h_y` = `r_f`.`h_y`) as fosilavi,
			`s_y`, `h_y`
			FROM `real_faculties` as `r_f` WHERE `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `title`
		");
		
		$date = date("Y-m-d", time());
		$users = query("SELECT * FROM `users` WHERE `id` IN(SELECT `id_user` FROM `_datasonline` WHERE `date` = '$date') ORDER BY `access_type`, `last_login` DESC");
	break;
	
	
	case "mintaqa":
		$page_info['title'] = "Омори минтақавӣ";
		$regions = select("regions", "*", "", "name", false, "");
	break;
	
	case "district":
		$id_district = $_REQUEST['id_district'];
		
		$j_where = "";
		if(isset($_REQUEST['jins'])){
			$jins = $_REQUEST['jins'];
			$j_where = "AND `users`.`jins` = '$jins'";
		}
		
		$students = query("SELECT * FROM `students` INNER JOIN `users` ON `students`.`id_student` = `users`.`id` 
		AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."' 
		WHERE `students`.`status` = '1' AND `users`.`id_district` = '$id_district' $j_where
		ORDER BY `students`.`id_course`, `students`.`id_spec`, `users`.`fullname`");
		
		$page_info['title'] = "Шаҳр/Ноҳия: ".getDistrict($id_district);
		
	break;
	
}


?>