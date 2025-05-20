<?php

include '../vendor/autoload.php'; // Путь к файлу autoload.php в вашем проекте
use PhpOffice\PhpSpreadsheet\IOFactory;
$reader = IOFactory::createReader('Xlsx');


switch($action){
	
	case "fanho":
		$page_info['title'] = 'Фанҳо';
		
		$departaments = query("SELECT * FROM `departaments` WHERE `s_y` = '".S_Y."' ORDER BY `title`");
		
		$fanho = query("SELECT DISTINCT(`id_fan`), `fan_test`.`title_tj` 
		FROM `iqtibosho`
		INNER JOIN `fan_test` ON `fan_test`.`id` = `iqtibosho`.`id_fan`
		ORDER BY `fan_test`.`title_tj`
		");
	break;
	
	case "selanamoi":
		$page_info['title'] = 'Селанамоӣ';
		
		$faculties = select("faculties", "*", "", "id", false, "");
		
		if(isset($_SESSION['user']['admin'])){
			$departaments = query("SELECT * FROM `departaments` ORDER BY `departaments`.`title` ASC");
			
			if(isset($_REQUEST['id_faculty']) && isset($_REQUEST['id_departament'])){
				
				$id_faculty = $_REQUEST['id_faculty'];
				$id_departament = $_REQUEST['id_departament'];
				$s_y = S_Y;
				
				$datas = query("SELECT 
					`iqtibosho`.*,
					`faculties`.`title` AS `faculty_title`,
					`faculties`.`short_title` AS `faculty_short`,
					`specialties`.`code` AS `spec_code`,
					`specialties`.`title_tj` AS `spec_title_tj`,
					`specialties`.`title_ru` AS `spec_title_ru`,
					`specialties`.`title_en` AS `spec_title_en`,
					`study_level`.`title` AS `s_l_title`,
					`study_view`.`title` AS `s_v_title`,
					`course`.`title` AS `course_title`,
					`groups`.`title` AS `group_title`,
					`fan_test`.`title_tj` 
				
				FROM `iqtibosho` 
				INNER JOIN `faculties` ON `iqtibosho`.`id_faculty` = `faculties`.`id`
				INNER JOIN `specialties` ON `iqtibosho`.`id_spec` = `specialties`.`id`
				INNER JOIN `study_level` ON `iqtibosho`.`id_s_l` = `study_level`.`id`
				INNER JOIN `study_view` ON `iqtibosho`.`id_s_v` = `study_view`.`id`
				INNER JOIN `course` ON `iqtibosho`.`id_course` = `course`.`id`
				INNER JOIN `groups` ON `iqtibosho`.`id_group` = `groups`.`id`
				
				INNER JOIN `fan_test` ON `fan_test`.`id` = `iqtibosho`.`id_fan`
				WHERE 
				`iqtibosho`.`parent_group` IS NULL AND 
				`iqtibosho`.`id_faculty` = '$id_faculty' AND 
				`iqtibosho`.`id_departament` = '$id_departament' AND 
				`iqtibosho`.`lk_soat` IS NOT NULL AND 
				`iqtibosho`.`s_y` = '$s_y'
				ORDER BY 
				`iqtibosho`.`id_fan`, 
				`iqtibosho`.`id_course`, 
				`iqtibosho`.`id_spec`, 
				`iqtibosho`.`id_group`,
				`iqtibosho`.`semestr`");
			}else{
				$datas = [];
			}
		}else{
			
			if(isset($_REQUEST['id_faculty'])){
				
				$id_faculty = $_REQUEST['id_faculty'];
				$s_y = S_Y;
				$datas = query("SELECT 
					`iqtibosho`.*,
					`faculties`.`title` AS `faculty_title`,
					`faculties`.`short_title` AS `faculty_short`,
					`specialties`.`code` AS `spec_code`,
					`specialties`.`title_tj` AS `spec_title_tj`,
					`specialties`.`title_ru` AS `spec_title_ru`,
					`specialties`.`title_en` AS `spec_title_en`,
					`study_level`.`title` AS `s_l_title`,
					`study_view`.`title` AS `s_v_title`,
					`course`.`title` AS `course_title`,
					`groups`.`title` AS `group_title`,
					`fan_test`.`title_tj` 
				
				FROM `iqtibosho` 
				INNER JOIN `faculties` ON `iqtibosho`.`id_faculty` = `faculties`.`id`
				INNER JOIN `specialties` ON `iqtibosho`.`id_spec` = `specialties`.`id`
				INNER JOIN `study_level` ON `iqtibosho`.`id_s_l` = `study_level`.`id`
				INNER JOIN `study_view` ON `iqtibosho`.`id_s_v` = `study_view`.`id`
				INNER JOIN `course` ON `iqtibosho`.`id_course` = `course`.`id`
				INNER JOIN `groups` ON `iqtibosho`.`id_group` = `groups`.`id`
				
				INNER JOIN `fan_test` ON `fan_test`.`id` = `iqtibosho`.`id_fan`
				WHERE 
				`iqtibosho`.`parent_group` IS NULL AND 
				`iqtibosho`.`id_faculty` = '$id_faculty' AND 
				`iqtibosho`.`id_departament` = '$id_departament' AND 
				`iqtibosho`.`lk_soat` IS NOT NULL AND 
				`iqtibosho`.`s_y` = '$s_y'
				ORDER BY 
				`iqtibosho`.`id_fan`, 
				`iqtibosho`.`id_course`, 
				`iqtibosho`.`id_spec`, 
				`iqtibosho`.`id_group`,
				`iqtibosho`.`semestr`");
				
				
			}else{
				$datas = [];
			}
		}
		
	break;
	
	case "update_selanamoi":
		$id = $_REQUEST['id'];
		
		$info = query("SELECT * FROM `iqtibosho` WHERE `id` = '$id'");
		
		$id_faculty = $info[0]['id_faculty'];
		$id_course = $info[0]['id_course'];
		$id_spec = $info[0]['id_spec'];
		$id_group = $info[0]['id_group'];
		$semestr = $info[0]['semestr'];
		$id_departament = $info[0]['id_departament'];
		$id_fan = $info[0]['id_fan'];
		$s_y = $info[0]['s_y'];
		
		$datas = query("SELECT * FROM `iqtibosho` WHERE `id` != '$id' AND
		`id_faculty` = '$id_faculty' AND 
		`id_course` = '$id_course' AND 
		`semestr` = '$semestr' AND 
		`id_departament` = '$id_departament' AND 
		`id_fan` = '$id_fan' AND 
		`s_y` = '$s_y'");
		
		// foreach($datas as $item){
			// $item_id = $item['id'];
			// unset($fields);
			// $fields['parent_group'] = 'NULL';
			// update("iqtibosho", $fields, "`id` = '$item_id'");
		// }
		
		if(isset($_REQUEST["checkbox"])){
			foreach($_REQUEST["checkbox"] as $item){
				$id_for_update = $item;
				
				unset($fields);
				$fields['parent_group'] = $id;
				update("iqtibosho", $fields, "`id` = '$id_for_update'");
			}
		}
		
		redirect();
	break;
	
	case "delete_selanamoi":
		$id = $_REQUEST['id'];
		$fields['parent_group'] = 'NULL';
		update("iqtibosho", $fields, "`id` = '$id'");
		redirect();
	break;
	
	case "bigcredit":
		$data = explode("\n", file_get_contents("bigcredit.txt"));
		
		for($i = 0; $i < count($data); $i++){
			list($semestr, $fan, $credit, $lk_plan, $am_plan, $ozm_plan, $cmro_soat) = explode("	", $data[$i]);
			
			$fan = trim($fan);
			
			$check = query("SELECT * FROM `fan_test` WHERE `title_tj` LIKE '".$fan."'");
			if(!empty($check)){
				$id_fan = $check[0]['id'];
				
				$iq_data = query("SELECT * FROM `iqtibosho` WHERE `id_fan` = '$id_fan' AND `semestr` = '$semestr' AND `credits` = '$credit'");
				
				foreach($iq_data as $item){
					$id = $item['id'];
					
					if(!empty($lk_plan)){
						$fields['lk_plan'] = $lk_plan;
					}else{
						$fields['lk_plan'] = 'NULL';
					}
					if(!empty($am_plan)){
						$fields['am_plan'] = $am_plan;
					}else{
						$fields['am_plan'] = 'NULL';
					}
					if(!empty($ozm_plan)){
						$fields['ozm_plan'] = $ozm_plan;
					}else{
						$fields['ozm_plan'] = 'NULL';
					}
					if(!empty($cmro_soat)){
						$fields['cmro_soat'] = $cmro_soat;
					}else{
						$fields['cmro_soat'] = 'NULL';
					}
					
					update("iqtibosho", $fields, "`id` = '$id'");
					
				}
				
				
			}
		}
		
		
		exit;
	break;
	
	
	case "find_twin":
		$datas = query("SELECT * FROM `iqtibosho` ORDER BY `id_faculty`, `id_s_l`, `id_s_v`, `id_course`, `id_spec`, `id_group`");
		
		$counter = 0;
		foreach($datas as $item){
			
			$id = $item['id'];
			$id_faculty = $item['id_faculty'];
			$id_s_l = $item['id_s_l'];
			$id_s_v = $item['id_s_v'];
			$id_course = $item['id_course'];
			$id_spec = $item['id_spec'];
			$id_group = $item['id_group'];
			$id_nt = $item['id_nt'];
			
			$check = query("SELECT * FROM `std_study_groups` WHERE id_nt = $id_nt AND id_faculty = $id_faculty AND id_s_l = $id_s_l AND id_s_v = $id_s_v AND id_course = $id_course AND id_spec = $id_spec AND id_group = $id_group");
			
			if(empty($check)){
				echo $id;
				echo "<br>";
				
				delete("sarboriho", "`id_iqtibos` = '$id'");
				delete("iqtibosho", "`id` = '$id'");
				
				$counter++;
			}
		}
		echo $counter.'<br>';
		exit;
		
	break;
	
	case "load_datas":
		$data = explode("\n", file_get_contents("datas.txt"));
		
		$black_list = [
			"Д/О1-440105-01Б"
		];
		
		$pattern_for_ttu = '/^([А-Яа-я\/]+)([\d\-]+)([А-Яа-я\d]+)$/';
		
		for($i = 4800; $i < count($data); $i++){
			list($id_course, $spec, $fan, $type, $teacher, $departament) = explode("	", $data[$i]);
			
			$id_s_l = 1;
			
			if (preg_match($pattern_for_ttu, $spec, $matches)) {
				
				
				$fan = trim($fan);
				$fan_query = query("SELECT * FROM `fan_test` WHERE `title_tj` LIKE '$fan'");
				
				$teacher = trim($teacher);
				$teachers = query("SELECT * FROM `users` WHERE `fullname_tj` LIKE '%".$teacher."%'");
				
				// Агар мо фанро дар таблитсаи фанщҳоямон дошта бошем
				if(!empty($fan_query) && !empty($teachers)){
					echo "<br>Қадами ".($i+1)."<br>";
					$id_fan = $fan_query[0]['id'];
					$id_teacher = $teachers[0]['id'];
					
					echo $id_fan.' '.$fan;
					echo "<br>";
					
					if($matches[1] == 'Д/О'){
						$id_s_l = 1;
						$id_s_v = 1;
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
					
					
					echo $id_faculty. ' '.getFacultyShort($id_faculty);
					echo "<br>";
					echo $id_s_l. ' '.getStudyLevel($id_s_l);
					echo "<br>";
					echo $id_s_v.' '.getStudyView($id_s_v);
					echo "<br>";
					echo $id_spec. ' '.getSpecialtyCode($id_spec);
					echo "<br>";
					echo $id_group. ' '.getGroup2($id_group);
					echo "<br>";
					
					
					echo "Дархост барои баровардани иқтибос<br>";
					
					unset($iq_query);
					$iq_query = query2("SELECT * FROM `iqtibosho` WHERE `semestr` IN (1, 3, 5, 7, 9) AND 
					`id_faculty` = $id_faculty AND `id_s_l` = $id_s_l AND `id_s_v` = $id_s_v AND 
					`id_course` = $id_course AND `id_spec` = $id_spec AND `id_group` = $id_group
					AND `id_fan` = $id_fan
					");
					
					//print_arr($iq_query);
					if(!empty($iq_query)){
						$id_iqtibos = $iq_query[0]['id'];
						
						echo "<br>";
						echo "Кредит: ".$iq_query[0]['credits'];
						echo "<br>";
						
						$t = array_search($type, $dars_namud);
						
						if($id_fan != 1748 AND $iq_query[0]['credits'] <= 6){
						
							echo "<br>Дархост барои баровардани дидани сарбории фани $fan $t<br>";
							$sarb = query("SELECT * FROM `sarboriho` WHERE `id_iqtibos` = $id_iqtibos AND `type` = '$t'");
							
							if(empty($sarb)){
								echo "Омузгорро ба ин фан вобаст мекунем<br>";
								
								unset($fields, $data_insert);
								$data_insert['id_iqtibos'] = "'".clear_admin($id_iqtibos)."'";
								$data_insert['type'] = "'".clear_admin($t)."'";
								$data_insert['soat'] = "'".clear_admin($iq_query[0][$t])."'";
								$data_insert['id_teacher'] = "'".clear_admin($id_teacher)."'";
								$data_insert['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
								$data_insert['date_add'] = "'".date("d.m.Y, H:i:s", time())."'";
								
								print_arr($data_insert);
								
								$fields = array_keys($data_insert);
								$data_insert = implode(",", $data_insert);
								
								if(insert('sarboriho', $fields, $data_insert, 1)){
									echo "---Вобаст шуд!!!";
								}
								
							}
							else {
								echo "Ба ин фан алакай омузгор вобаст шудааст!!!";
							}
						}
						
						echo "<br>================<br>";
					}
				}	
				
				
			}
			
			
			
		}
		
		
		
		//1	Д/О1-440105-01Б	Физика	Лексия	Ёдалиева Зулфия Нуралиевна	Физика
		/*
		for($i = 3486; $i < count($data); $i++){
			list($id_course, $spec, $fan, $type, $teacher, $departament) = explode("	", $data[$i]);
			
			$teachers = query("SELECT * FROM `users` WHERE `fullname_tj` LIKE '%".trim($teacher)."%'");
			
			if($teachers){
				$id_teacher = $teachers[0]['id'];
				
				echo $i.'. '.$id_teacher.' '.$teacher.' ';
				
				$pos = mb_strpos($departament, "(");
				
				if($pos){
					$dep = trim(mb_substr($departament, 0, $pos));
				}else{
					$dep  = trim($departament);
				}
				
				echo $dep;
				echo "<br>";
				$dep = trim($dep);
				
				$d = query2("SELECT * FROM `departaments` WHERE `title` LIKE '%".$dep."%'");
				print_arr($d);
				
				echo $id_departament = $d[0]['id'];
				
				$members = query2("SELECT * FROM `departaments_member` WHERE `id_teacher` = '$id_teacher' AND `id_departament` = '$id_departament'");
				
				if(empty($members)){
					unset($fields, $data_insert);
					$table = 'departaments_member';
					$data_insert['id_teacher'] = "'".clear_admin($id_teacher)."'";
					$data_insert['id_departament'] = "'".clear_admin($id_departament)."'";
					$data_insert['s_y'] = "'".clear_admin(S_Y)."'";
					
					$fields = array_keys($data_insert);
					$data_insert = implode(",", $data_insert);
					
					insert($table, $fields, $data_insert, 1);
					echo "MEMBER_INSERTED<br>";
				}
				
				echo "<br>=====================";
				echo "<br>";
			}
			
			
			
		}
		*/
		//count($data)
		/*
		for($i = 0; $i < count($data); $i++){
			list($id_course, $spec, $fan, $type, $teacher, $departament) = explode("	", $data[$i]);
			$fan = trim($fan);
			
			
			$check = query("SELECT * FROM `fan_test` WHERE `title_tj` LIKE '%".$fan."%'");
			
			
			
			
			if(!empty($check)){
				
				if($check[0]['id'] != 1748){
					
					$id_fan = $check[0]['id'];
					
					
					$pos = mb_strpos($departament, "(");
						
					if($pos){
						$dep = trim(mb_substr($departament, 0, $pos));
					}else{
						$dep  = trim($departament);
					}
					
					$dep = trim($dep);
					
					$d = query("SELECT * FROM `departaments` WHERE `title` LIKE '%".$dep."%'");
					
					$id_departament = $d[0]['id'];
					
					$iqtibos = query("SELECT * FROM `iqtibosho` WHERE `id_fan` = $id_fan AND `id_departament` IS NULL");
					print_arr($iqtibos);
					
					$query_update = update_query("UPDATE `iqtibosho` SET `id_departament` = $id_departament WHERE `id_fan` = '$id_fan'");
					
					if($query_update){
						echo $fan;
						echo "<br>";
					}
				}
				
			}
			
		}
		*/
		
		exit;
	break;
	
	
	case "fan_insert":
		$table = 'fan_test';
		
		$data['title_tj'] = "'".clear_admin($_REQUEST['title_tj'])."'";
		if($_REQUEST['title_ru'])
			$data['title_ru'] = "'".clear_admin($_REQUEST['title_ru'])."'";
		if($_REQUEST['title_en'])
			$data['title_en'] = "'".clear_admin($_REQUEST['title_en'])."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		
		insert($table, $fields, $data);
		redirect();
	break;
	
	case "short_dep":
		$data = query("SELECT * FROM `departaments` ORDER BY `departaments`.`title` ASC");
		mb_internal_encoding("UTF-8");
		
		foreach($data as $item){
			$id = $item['id'];
			
			$title = $item['title'];
			$words = explode(" ", $title);
			
			if(count($words) > 1){
				$short = '';
				foreach($words as $w){
					if($w != 'ва')
						$short .= mb_substr(mb_strtoupper($w), 0, 1);
					else $short .= $w;
				}
			}else {
				$short = $words[0];
			}
			
			$fields['short'] = $short;
		
			update("departaments", $fields, "`id` = '$id'");
		}
		
		echo "OK";
		exit;
	break;
	
	case "review_iqtibosho":
		$datas = query("SELECT * FROM `iqtibosho` WHERE `s_y` = '".S_Y."'");
		
		foreach($datas as $nt_data){
			$id = $nt_data['id'];
			if($nt_data['credits'] == 6 || $nt_data['credits'] == 5){
				$fields_update['lk_soat'] = 32;
				$fields_update['am_soat'] = 16;
				$fields_update['cmro_soat'] = 48;
				$fields_update['hamagi'] = $fields_update['lk_soat'] + $fields_update['am_soat'] + $fields_update['cmro_soat'];
				
			}elseif($nt_data['credits'] == 4){
				$fields_update['lk_soat'] = 32;
				$fields_update['am_soat'] = 16;
				$fields_update['cmro_soat'] = 24;
				$fields_update['hamagi'] = $fields_update['lk_soat'] + $fields_update['am_soat'] + $fields_update['cmro_soat'];
				
			}elseif($nt_data['credits'] == 3){
				$fields_update['lk_soat'] = 16;
				$fields_update['am_soat'] = 8;
				$fields_update['cmro_soat'] = 24;
				$fields_update['hamagi'] = $fields_update['lk_soat'] + $fields_update['am_soat'] + $fields_update['cmro_soat'];
				
			}elseif($nt_data['credits'] == 2){
				$fields_update['lk_soat'] = 6;
				$fields_update['am_soat'] = 6;
				$fields_update['cmro_soat'] = 12;
				$fields_update['hamagi'] = $fields_update['lk_soat'] + $fields_update['am_soat'] + $fields_update['cmro_soat'];
				
			}elseif($nt_data['credits'] == 1.5){
				$fields_update['lk_soat'] = 6;
				$fields_update['am_soat'] = 6;
				$fields_update['cmro_soat'] = 12;
				$fields_update['hamagi'] = $fields_update['lk_soat'] + $fields_update['am_soat'] + $fields_update['cmro_soat'];
				
			}
			
			update("iqtibosho", $fields_update, "`id` = '$id'");
		}
		
		exit;
	break;
	
	case "update_iqtibos":
		$id_nt = $_REQUEST['id_nt'];
		$id_course = $_REQUEST['id_course'];
		
		if($id_course == 1){
			$semestrs = '1, 2';
		}elseif($id_course == 2){
			$semestrs = '3, 4';
		}elseif($id_course == 3){
			$semestrs = '5, 6';
		}elseif($id_course == 4){
			$semestrs = '7, 8';
		}elseif($id_course == 5){
			$semestrs = '9, 10';
		}
		
		$check_group = query("SELECT * FROM `std_study_groups` WHERE `id_nt` = '$id_nt' AND `id_course` = '$id_course' ORDER BY `id_course`");
		
		foreach($check_group as $g_item){
			$id_faculty = $g_item['id_faculty'];
			$id_s_l = $g_item['id_s_l'];
			$id_s_v = $g_item['id_s_v'];
			$id_course = $g_item['id_course'];
			$id_spec = $g_item['id_spec'];
			$id_group = $g_item['id_group'];
			
			$arrs = explode(", ", $semestrs);
			
			foreach($arrs as $arr){
			
				$getdatas = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = $arr ORDER BY `semestr`, `id_fan`");
				
				
				unset($fan);
				$fans = [];
				foreach($getdatas as $nt_data){
					$semestr = $nt_data['semestr'];
					$id_fan = $nt_data['id_fan'];
					
					$fan[] = $id_fan;
					
					$check_iqtibos = query("SELECT `id` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `id_course` = '$id_course' 
					AND `semestr` = '$semestr' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan'");
					
					if(empty($check_iqtibos)){
						
						unset($data, $fields);
					
						$data['id_nt'] = $id_nt;
						$data['semestr'] = $semestr;
						
						$data['id_faculty'] = $g_item['id_faculty'];
						$data['id_s_l'] = $g_item['id_s_l'];
						$data['id_s_v'] = $g_item['id_s_v'];
						$data['id_course'] = $g_item['id_course'];
						$data['id_spec'] = $g_item['id_spec'];
						$data['id_group'] = $g_item['id_group'];
						
						$data['id_fan'] = $id_fan;
						$data['credits'] = $nt_data['c_u'];
						if($nt_data['k_k']){
							$data['kori_kursi'] = count_table_where("students", "`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group'");
						}	
						
						if($nt_data['c_u'] == 6 || $nt_data['c_u'] == 5){
							$data['lk_soat'] = 32;
							$data['am_soat'] = 16;
							$data['cmro_soat'] = 48;
							$data['hamagi'] = $data['lk_soat'] + $data['am_soat'] + $data['cmro_soat'];
							
						}elseif($nt_data['c_u'] == 4){
							$data['lk_soat'] = 32;
							$data['am_soat'] = 16;
							$data['cmro_soat'] = 24;
							$data['hamagi'] = $data['lk_soat'] + $data['am_soat'] + $data['cmro_soat'];
							
						}elseif($nt_data['c_u'] == 3){
							$data['lk_soat'] = 16;
							$data['am_soat'] = 8;
							$data['cmro_soat'] = 24;
							$data['hamagi'] = $data['lk_soat'] + $data['am_soat'] + $data['cmro_soat'];
							
						}elseif($nt_data['c_u'] == 2){
							$data['lk_soat'] = 6;
							$data['am_soat'] = 6;
							$data['cmro_soat'] = 12;
							$data['hamagi'] = $data['lk_soat'] + $data['am_soat'] + $data['cmro_soat'];
							
						}elseif($nt_data['c_u'] == 1.5){
							$data['lk_soat'] = 6;
							$data['am_soat'] = 6;
							$data['cmro_soat'] = 12;
							$data['hamagi'] = $data['lk_soat'] + $data['am_soat'] + $data['cmro_soat'];
							
						}
						
						$data['imtihon'] = $semestr;
						
						/*
						if($nt_data['c_u'] == 6 || $nt_data['c_u'] == 5 || $nt_data['c_u'] == 4){
							$data['credits_audtr'] = '2.65';
							$data['soathoi_darsi'] = '64';
							$data['cmro_credit'] = '1.35';
							$data['cmro_soat'] = '32';
							$data['lk_plan'] = '32';
							$data['ozm_plan'] = '16';
							$data['am_plan'] = '16';
							$data['hamagi'] = '96';
							
						}elseif($nt_data['c_u'] == 3){
							$data['credits_audtr'] = '1.35';
							$data['soathoi_darsi'] = '32';
							$data['cmro_credit'] = '0.65';
							$data['cmro_soat'] = '16';
							$data['imtihon'] = $semestr;
							$data['lk_plan'] = '16';
							$data['am_plan'] = '16';
							$data['hamagi'] = '48';
							
						}elseif($nt_data['c_u'] == 1){
							$data['credits_audtr'] = '0.65';
							$data['soathoi_darsi'] = '16';
							$data['imtihon'] = $semestr;
							$data['am_plan'] = '16';
							$data['hamagi'] = '16';
						}
						*/
						
						$fields = array_keys($data);
						$data = implode(",", $data);
						insert("iqtibosho", $fields, $data);
					}else{
						// UPDATE DATAS
						$id = $check_iqtibos[0]['id'];
						
						if($nt_data['c_u'] == 6 || $nt_data['c_u'] == 5){
							$fields_update['lk_soat'] = 32;
							$fields_update['am_soat'] = 16;
							$fields_update['cmro_soat'] = 48;
							$fields_update['hamagi'] = $fields_update['lk_soat'] + $fields_update['am_soat'] + $fields_update['cmro_soat'];
							
						}elseif($nt_data['c_u'] == 4){
							$fields_update['lk_soat'] = 32;
							$fields_update['am_soat'] = 16;
							$fields_update['cmro_soat'] = 24;
							$fields_update['hamagi'] = $fields_update['lk_soat'] + $fields_update['am_soat'] + $fields_update['cmro_soat'];
							
						}elseif($nt_data['c_u'] == 3){
							$fields_update['lk_soat'] = 16;
							$fields_update['am_soat'] = 8;
							$fields_update['cmro_soat'] = 24;
							$fields_update['hamagi'] = $fields_update['lk_soat'] + $fields_update['am_soat'] + $fields_update['cmro_soat'];
							
						}elseif($nt_data['c_u'] == 2){
							$fields_update['lk_soat'] = 6;
							$fields_update['am_soat'] = 6;
							$fields_update['cmro_soat'] = 12;
							$fields_update['hamagi'] = $fields_update['lk_soat'] + $fields_update['am_soat'] + $fields_update['cmro_soat'];
							
						}elseif($nt_data['c_u'] == 1.5){
							$fields_update['lk_soat'] = 6;
							$fields_update['am_soat'] = 6;
							$fields_update['cmro_soat'] = 12;
							$fields_update['hamagi'] = $fields_update['lk_soat'] + $fields_update['am_soat'] + $fields_update['cmro_soat'];
							
						}
						
						$fields_update['imtihon'] = $semestr;
						$fields_update['semestr'] = $semestr;
						$fields_update['credits'] = $nt_data['c_u'];
						$fields_update['id_faculty'] = $g_item['id_faculty'];
						$fields_update['id_s_l'] = $g_item['id_s_l'];
						$fields_update['id_s_v'] = $g_item['id_s_v'];
						$fields_update['id_course'] = $g_item['id_course'];
						$fields_update['id_spec'] = $g_item['id_spec'];
						$fields_update['id_group'] = $g_item['id_group'];

						update("iqtibosho", $fields_update, "`id` = '$id'");
						
						
						// UPDATE DATAS
					}
				}
				
				$fordelete = query("SELECT `id` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `id_course` = '$id_course' 
				AND `semestr` = $arr AND `id_fan` NOT IN (".implode(",", $fan).")");
				
				foreach($fordelete as $item){
					$id_iqtibos = $item['id'];
					delete("sarboriho", "`id_iqtibos` = '$id_iqtibos'");
				}
				
				delete("iqtibosho", "`id_nt` = '$id_nt' AND `id_course` = '$id_course' 
				AND `semestr` = $arr AND `id_fan` NOT IN (".implode(",", $fan).")");
			}
			
		}
		
		
		
		
		redirect();
	break;
	
	case "load_iqtibos":
		$nts = query("SELECT * FROM `nt_list` ORDER BY `id`");
		
		foreach($nts as $nt_item){
			$id_nt = $nt_item['id'];
			
			$check_group = query("SELECT * FROM `std_study_groups` WHERE `id_nt` = '$id_nt' ORDER BY `id_course`");
			
			foreach($check_group as $g_item){
				$id_faculty = $g_item['id_faculty'];
				$id_s_l = $g_item['id_s_l'];
				$id_s_v = $g_item['id_s_v'];
				$id_course = $g_item['id_course'];
				$id_spec = $g_item['id_spec'];
				$id_group = $g_item['id_group'];
				
				echo "Барои курси ".$g_item['id_course'];
				
				echo "<br>";
				
				if($g_item['id_course'] == 1){
					$semestrs = '1, 2';
				}elseif($g_item['id_course'] == 2){
					$semestrs = '3, 4';
				}elseif($g_item['id_course'] == 3){
					$semestrs = '5, 6';
				}elseif($g_item['id_course'] == 4){
					$semestrs = '7, 8';
				}elseif($g_item['id_course'] == 5){
					$semestrs = '9, 10';
				}
				
				$getdatas = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` IN ($semestrs) ORDER BY `semestr`, `id_fan`");
				
				foreach($getdatas as $nt_data){
					$semestr = $nt_data['semestr'];
					$id_fan = $nt_data['id_fan'];
					
					$check_iqtibos = query("SELECT `id` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND 
					`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' 
					AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `semestr` = '$semestr' AND `id_fan` = '$id_fan'");
					
					if(empty($check_iqtibos)){
						echo "Барои нимсолаи $semestr";
						echo "<br>";
						unset($data, $fields);
					
						$data['id_nt'] = $id_nt;
						$data['semestr'] = $semestr;
						
						$data['id_faculty'] = $g_item['id_faculty'];
						$data['id_s_l'] = $g_item['id_s_l'];
						$data['id_s_v'] = $g_item['id_s_v'];
						$data['id_course'] = $g_item['id_course'];
						$data['id_spec'] = $g_item['id_spec'];
						$data['id_group'] = $g_item['id_group'];
						
						$data['id_fan'] = $id_fan;
						$data['credits'] = $nt_data['c_u'];
						if($nt_data['k_k']){
							$data['kori_kursi'] = count_table_where("students", "`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group'");
						}	
						
						
						
						if($nt_data['c_u'] == 6 || $nt_data['c_u'] == 5 || $nt_data['c_u'] == 4){
							$data['credits_audtr'] = '2.65';
							$data['soathoi_darsi'] = '64';
							$data['cmro_credit'] = '1.35';
							$data['cmro_soat'] = '32';
							$data['imtihon'] = '3';
							$data['lk_plan'] = '32';
							$data['ozm_plan'] = '16';
							$data['am_plan'] = '16';
							$data['hamagi'] = '96';
							
						}elseif($nt_data['c_u'] == 3){
							$data['credits_audtr'] = '1.35';
							$data['soathoi_darsi'] = '32';
							$data['cmro_credit'] = '0.65';
							$data['cmro_soat'] = '16';
							$data['imtihon'] = '3';
							$data['lk_plan'] = '16';
							$data['am_plan'] = '16';
							$data['hamagi'] = '48';
							
						}elseif($nt_data['c_u'] == 1){
							$data['credits_audtr'] = '0.65';
							$data['soathoi_darsi'] = '16';
							$data['imtihon'] = '3';
							$data['am_plan'] = '16';
							$data['hamagi'] = '16';
						}
						
						$fields = array_keys($data);
						$data = implode(",", $data);
						if(insert("iqtibosho", $fields, $data, 1)){
							echo "Иқтибос илова шуд!<br>";
						}
					}else{
						// UPDATE DATAS
						$id = $check_iqtibos[0]['id'];
						
						$fields_update['id_faculty'] = $g_item['id_faculty'];
						$fields_update['id_s_l'] = $g_item['id_s_l'];
						$fields_update['id_s_v'] = $g_item['id_s_v'];
						$fields_update['id_course'] = $g_item['id_course'];
						$fields_update['id_spec'] = $g_item['id_spec'];
						$fields_update['id_group'] = $g_item['id_group'];
		
						update("iqtibosho", $fields_update, "`id` = '$id'", 1);
						echo "<br>";
						
						// UPDATE DATAS
					}
				}
				
				
			}
			
		}
		
		exit;
	break;
	
	case "_tj":
		$id_fan = 643;
		$list = query("SELECT * FROM `nt_list` WHERE `id_s_v` = '1'");
		
		foreach($list as $item){
			$id_nt = $item['id'];
			
			for($s = 1; $s <= 2; $s++){
				$check = query("SELECT `id` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' AND `id_fan` = '$id_fan'");
				
				if(empty($check)){
					unset($data, $fields);

					$data['id_nt'] = $id_nt;
					$data['semestr'] = "'$s'";
					$data['id_fan'] = "'$id_fan'";
					$data['c_u'] = "'1'";
					$data['c_f_u'] = "'1'";
					$data['c_a'] = "'1'";
					$data['cmro'] = "'1'";
					$data['cmd'] = "'1'";
					$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					if(insert("nt_content", $fields, $data)){
						echo "Илова шуд!<br>";
					}
				}
			}
		}
		
		echo count($list);
		exit;
	break;
	
	
	case "_sc":
		$id_fan = 1748;
		$list = query("SELECT * FROM `nt_list` WHERE `id_s_v` = '1'");
		
		foreach($list as $item){
			$id_nt = $item['id'];
			
			$semestrs = query("SELECT COUNT(DISTINCT(`semestr`)) as `semestrs` FROM `nt_content` WHERE `id_nt` = '$id_nt'");
			
			for($s = 1; $s <= $semestrs[0]['semestrs']; $s++){
				$check = query("SELECT `id` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' AND `id_fan` = '$id_fan'");
				
				if(empty($check)){
					unset($data, $fields);

					$data['id_nt'] = $id_nt;
					$data['semestr'] = "'$s'";
					$data['id_fan'] = "'$id_fan'";
					$data['c_u'] = "'1'";
					$data['c_f_u'] = "'1'";
					$data['c_a'] = "'1'";
					$data['cmro'] = "'0'";
					$data['cmd'] = "'0'";
					$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					if(insert("nt_content", $fields, $data)){
						echo "Илова шуд!<br>";
					}
				}
			}
		}
		
		echo count($list);
		exit;
	break;
	
	case "add":
		$faculties = select("faculties", "*", "", "id", false, "");
		$studylevels = select("study_level", "*", "", "id", false, "");
		$studyviews = select("study_view", "*", "", "id", false, "");
		
		$page_info['title'] = 'Иловакунии нақшаи таълимӣ';
	break;
	
	case "insert":
		$table = "nt_list";
		$data['id_faculty'] = "'".clear_admin(doTajik($_REQUEST['id_faculty']))."'";
		$data['id_spec'] = "'".clear_admin($_REQUEST['id_spec'])."'";
		$data['id_s_v'] = "'".clear_admin($_REQUEST['id_s_v'])."'";
		$data['id_s_l'] = "'".clear_admin($_REQUEST['id_s_l'])."'";
		$data['soli_tasdiq'] = "'".clear_admin($_REQUEST['soli_tasdiq'])."'";
		$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
		
		$fields = array_keys($data);
		$data = implode(",", $data);
		/*Иловакунии маълумотҳо дар таблитсаи USERS */
		
		if($id_nt = insert($table, $fields, $data)){
			redirect(MY_URL."?option=nt&action=nt_list&id_nt=$id_nt");
		}
	break;
	
	case "updateContent":
		$id = $_REQUEST['id'];
		
		$fields['id_fan'] = $_REQUEST['fan'];
		$fields['semestr'] = $_REQUEST['semestr'];
		if(isset($_REQUEST['intixobi']) && !empty($_REQUEST['intixobi']))
			$fields['intixobi'] = 1;
		else{
			$fields['intixobi'] = "NULL";
		}
		
		if(isset($_REQUEST['kori_c']) && !empty($_REQUEST['kori_c']))
			$fields['k_k'] = 1;
		else{
			$fields['k_k'] = "NULL";
		}
		$fields['c_u'] = $_REQUEST['c_umumi'];
		$fields['c_f_u'] = $_REQUEST['c_f_umumi'];
		$fields['c_a'] = $_REQUEST['c_aud'];
		$fields['cmro'] = $_REQUEST['cmro'];
		$fields['cmd'] = $_REQUEST['cmd'];
		
		if(update("nt_content", $fields, "`id` = '$id'")){
			redirect();
		}
	break;
	
	
	case "uploadData":
		$id_nt = $_REQUEST['id_nt'];
		if($_FILES['nt_file']['name']){
			$BaseName = "nt_".$id_nt.".xlxs";
			$BaseTmpName = $_FILES['nt_file']['tmp_name'];
			
			if(move_uploaded_file($BaseTmpName, "../userfiles/naqshaho/$BaseName")){
				$file = "../userfiles/naqshaho/$BaseName";
				
				$spreadsheet = $reader->load($file);
				
				
				
				$reader->setReadDataOnly(true);
				$sheetsCount = $spreadsheet->getSheetCount();
				$data = $spreadsheet->getSheet(0)->toArray();
				// Замена подстроки в каждом элементе массива
				$data = array_map('doTajik', $data);
				
				
				$start_pos = findIndexInTwoDimensionalArray($data, "БАХШИ ФАНҲОИ ЗАМИНАВӢ");
				if(!$start_pos)
					$start_pos = findIndexInTwoDimensionalArray($data, "БАХШИ ФАНҲОИ ЗАМИНАВӢ ");
				$second_part = array_slice($data, $start_pos);
				$end_pos = findIndexInTwoDimensionalArray($second_part, "Ҷамъ:");
				
				
				
				
				$black_list = [
					"Модули фанҳои забонӣ",
					"Модули фанҳои иҷтимоӣ-гуманитарӣ",
					"Модули фанҳои забон",
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
					"АТТЕСТАТСИЯИ НИҲОӢ",
				];
				
				
				
				$new_arr = [];
				for($j = 0, $i = $start_pos + 2; $i < $start_pos + $end_pos; $i++) {
					
					if(in_array(trim($data[$i][2]), $black_list)) continue;
					
					$new_arr[$j]['title'] = doTajik(trim($data[$i][2]));
					$new_arr[$j]['credit'] = trim($data[$i][27]);
					if(!empty($data[$i][29]))
						$new_arr[$j]['imtihon'] = str_replace(".", ",", trim($data[$i][29]));
					else 
						$new_arr[$j]['imtihon'] = trim($data[$i][29]);
					
					$new_arr[$j]['k_k'] = $data[$i][33];
					$new_arr[$j]['credit_faol'] = $data[$i][35];
					$new_arr[$j]['credit_aud'] = $data[$i][38];
					$new_arr[$j]['credit_kmro'] = $data[$i][41];
					$new_arr[$j]['credit_kmd'] = $data[$i][44];
					
					$new_arr[$j]['sem_1'] = $data[$i][47];
					$new_arr[$j]['sem_2'] = $data[$i][49];
					$new_arr[$j]['sem_3'] = $data[$i][51];
					$new_arr[$j]['sem_4'] = $data[$i][53];
					$new_arr[$j]['sem_5'] = $data[$i][55];
					$new_arr[$j]['sem_6'] = $data[$i][57];
					$new_arr[$j]['sem_7'] = $data[$i][61];
					$new_arr[$j]['sem_8'] = $data[$i][64];
					$new_arr[$j]['sem_9'] = @$data[$i][67];
					$new_arr[$j]['sem_10'] = @$data[$i][70];
					$j++;
				}
				
				
				foreach($new_arr as $item){
					$check = query("SELECT * FROM `fan_test` WHERE `title_tj` = '{$item['title']}'");
					//$check = query("SELECT * FROM `fan_test` WHERE `title_tj` != '{$item['title']}' AND MATCH(`title_tj`) AGAINST ('{$item['title']}' IN NATURAL LANGUAGE MODE) LIMIT 1");
					if(empty($check)){
						unset($fan_data);
						$fan_data['title_tj'] = "'".clear_admin(doTajik($item['title']))."'";
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
							insert("nt_content", $nt_fields, $nt_data);
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
						if(!empty($item['imtihon'])){
							if($item['k_k'])
								$nt_data['k_k'] = "'".clear_admin(1)."'";
						}
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
						insert("nt_content", $nt_fields, $nt_data);
					}
				}
				
				/*
				$intixobi = $spreadsheet->getSheet(1)->toArray();
				
				// Замена подстроки в каждом элементе массива
				$intixobi = array_map('doTajik', $intixobi);
				
				$start_pos = findIndexInTwoDimensionalArray($intixobi, "Модули фанҳои интихобии бахши 1");
				$black_list = [
					"Модули фанҳои интихобии бахши 2",
				];
				
				
				
				$new_arr = [];
				for($j = 0, $i = $start_pos + 1; $i < count($intixobi); $i++) {
					//if(empty($intixobi[$i][1]) || empty($intixobi[$i][2])) continue;
					if(in_array(trim($intixobi[$i][2]), $black_list)) continue;
					
					$new_arr[$j]['title'] = trim(doTajik($intixobi[$i][2]));
					if($intixobi[$i][0] == ''){
						$new_arr[$j]['credit'] = trim($intixobi[$i-1][23]);
					}else
						$new_arr[$j]['credit'] = trim($intixobi[$i][23]);
					
					if(!empty($intixobi[$i][29]))
						$new_arr[$j]['imtihon'] = str_replace(".", ",", trim($intixobi[$i][29]));
					else 
						$new_arr[$j]['imtihon'] = trim($intixobi[$i][29]);
					
					
					
					if($intixobi[$i][0] == ''){
						$new_arr[$j]['credit_faol'] = $intixobi[$i-1][37];
						$new_arr[$j]['credit_aud'] = $intixobi[$i-1][41];
						$new_arr[$j]['credit_kmro'] = $intixobi[$i-1][45];
						$new_arr[$j]['credit_kmd'] = $intixobi[$i-1][48];
						
						$new_arr[$j]['sem_1'] = $intixobi[$i-1][51];
						$new_arr[$j]['sem_1'] = $intixobi[$i-1][51];
						$new_arr[$j]['sem_2'] = $intixobi[$i-1][53];
						$new_arr[$j]['sem_3'] = $intixobi[$i-1][55];
						$new_arr[$j]['sem_4'] = $intixobi[$i-1][57];
						$new_arr[$j]['sem_5'] = $intixobi[$i-1][59];
						$new_arr[$j]['sem_6'] = $intixobi[$i-1][61];
						$new_arr[$j]['sem_7'] = $intixobi[$i-1][63];
						$new_arr[$j]['sem_8'] = $intixobi[$i-1][65];
						$new_arr[$j]['sem_9'] = @$intixobi[$i-1][67];
						$new_arr[$j]['sem_10'] = @$intixobi[$i-1][69];
					}else{
						$new_arr[$j]['credit_faol'] = $intixobi[$i][37];
						$new_arr[$j]['credit_aud'] = $intixobi[$i][41];
						$new_arr[$j]['credit_kmro'] = $intixobi[$i][45];
						$new_arr[$j]['credit_kmd'] = $intixobi[$i][48];
					
						$new_arr[$j]['sem_1'] = $intixobi[$i][51];
						$new_arr[$j]['sem_1'] = $intixobi[$i][51];
						$new_arr[$j]['sem_2'] = $intixobi[$i][53];
						$new_arr[$j]['sem_3'] = $intixobi[$i][55];
						$new_arr[$j]['sem_4'] = $intixobi[$i][57];
						$new_arr[$j]['sem_5'] = $intixobi[$i][59];
						$new_arr[$j]['sem_6'] = $intixobi[$i][61];
						$new_arr[$j]['sem_7'] = $intixobi[$i][63];
						$new_arr[$j]['sem_8'] = $intixobi[$i][65];
						$new_arr[$j]['sem_9'] = @$intixobi[$i][67];
						$new_arr[$j]['sem_10'] = @$intixobi[$i][69];
					}
					$j++;
				}
				
				foreach($new_arr as $item){
					$check = query("SELECT * FROM `fan_test` WHERE `title_tj` = '{$item['title']}'");
					//$check = query("SELECT * FROM `fan_test` WHERE `title_tj` != '{$item['title']}' AND MATCH(`title_tj`) AGAINST ('{$item['title']}' IN NATURAL LANGUAGE MODE) LIMIT 1");
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
							insert("nt_content", $nt_fields, $nt_data);
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
						insert("nt_content", $nt_fields, $nt_data);
					}
				}
				
				*/
				unlink($file);
			}
			redirect();
		}
	break;
	
	case "txt_load":
		$id_nt = $_REQUEST['id_nt'];
		$datas = explode("\n", file_get_contents("../modules/nt/{$id_nt}.txt"));
		
		$black_list = [
			"БАХШИ ФАНҲОИ ЗАМИНАВӢ",
			"Модули фанҳои забонӣ",
			"Модули фанҳои иҷтимоӣ-гуманитарӣ",
			"Модули фанҳои забон",
			"Модули фанҳои табиӣ-иқтисодӣ ва технологияи информатсионӣ",
			"БАХШИ ФАНҲОИ ТАХАССУСӢ",
			"Модули фанҳои умумикасбӣ",
			"Модули фанҳои тахассусӣ",
			"БАХШИ ФАНҲОИ ИНТИХОБӢ",
			"Модули фанҳои интихобии бахши 1",
			"Модули фанҳои интихобии бахши 2",
			"БАХШИ ТАҶРИБАОМӮЗӢ",
			"АТТЕСТАТСИЯИ ХАТМ",
			"АТТЕСТАТСИЯИ НИҲОӢ",
		];
		
		$new_arr = [];
		for($j = 0, $i = 0; $i < count($datas); $i++){
			//list($fullname_tj, $s_y, $h_y, $fan, $nf_score, $mamur_score, $innovation_score, $imt_score) = explode("====", $datas[$i]);
			
			$data = explode("====", $datas[$i]);
			
			if(in_array(trim(doTajik($data[0])), $black_list)) continue;
			$new_arr[$j]['title'] = trim(doTajik($data[0]));
			$new_arr[$j]['credit'] = trim($data[1]);
			if(!empty($data[2]))
				$new_arr[$j]['imtihon'] = str_replace(".", ",", trim($data[2]));
			else 
				$new_arr[$j]['imtihon'] = trim($data[2]);
			
			
			$new_arr[$j]['k_k'] = trim($data[3]);
			$new_arr[$j]['credit_faol'] = trim($data[5]);
			$new_arr[$j]['credit_aud'] = trim(str_replace(',','.',$data[6]));
			$new_arr[$j]['credit_kmro'] = trim(str_replace(',','.',$data[7]));
			$new_arr[$j]['credit_kmd'] = trim($data[8]);
			
			
			$new_arr[$j]['sem_1'] = trim($data[9]);
			$new_arr[$j]['sem_2'] = trim($data[10]);
			$new_arr[$j]['sem_3'] = trim($data[11]);
			$new_arr[$j]['sem_4'] = trim($data[12]);
			$new_arr[$j]['sem_5'] = trim($data[13]);
			$new_arr[$j]['sem_6'] = trim($data[14]);
			$new_arr[$j]['sem_7'] = trim($data[15]);
			$new_arr[$j]['sem_8'] = trim($data[16]);
			$new_arr[$j]['sem_9'] = trim(@$data[17]);
			$new_arr[$j]['sem_10'] = trim(@$data[18]);
			
			$j++;
		}
		
		
		
		foreach($new_arr as $item){
			
			$check = query("SELECT * FROM `fan_test` WHERE `title_tj` = '{$item['title']}'");
			//$check = query("SELECT * FROM `fan_test` WHERE `title_tj` != '{$item['title']}' AND MATCH(`title_tj`) AGAINST ('{$item['title']}' IN NATURAL LANGUAGE MODE) LIMIT 1");
			if(empty($check)){
				unset($fan_data);
				$fan_data['title_tj'] = "'".clear_admin(doTajik($item['title']))."'";
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
				
				if(!empty($item['imtihon'])){
					if($item['k_k'])
						$nt_data['k_k'] = "'".clear_admin(1)."'";
				}
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
		}
		echo "<br>OK<br>";
		exit;
	break;
	
	case "uploadDataFosilavi":
		$id_nt = $_REQUEST['id_nt'];
		if($_FILES['nt_file']['name']){
			$BaseName = "nt_".$id_nt.".xlxs";
			$BaseTmpName = $_FILES['nt_file']['tmp_name'];
			
			if(move_uploaded_file($BaseTmpName, "../userfiles/naqshaho/$BaseName")){
				$file = "../userfiles/naqshaho/$BaseName";
				
				$spreadsheet = $reader->load($file);
				
				
				
				$reader->setReadDataOnly(true);
				$sheetsCount = $spreadsheet->getSheetCount();
				$data = $spreadsheet->getSheet(0)->toArray();
				// Замена подстроки в каждом элементе массива
				$data = array_map('doTajik', $data);
				
				
				$start_pos = findIndexInTwoDimensionalArray($data, "БАХШИ ФАНҲОИ ЗАМИНАВӢ");
				if(!$start_pos)
					$start_pos = findIndexInTwoDimensionalArray($data, "БАХШИ ФАНҲОИ ЗАМИНАВӢ ");
				$second_part = array_slice($data, $start_pos);
				$end_pos = findIndexInTwoDimensionalArray($second_part, "Ҳамагӣ");
				
				
				
				
				$black_list = [
					"Модули фанҳои забонӣ",
					"Модули фанҳои иҷтимоӣ-гуманитарӣ",
					"Модули фанҳои забон",
					"Модули фанҳои табиӣ-иқтисодӣ ва технологияи информатсионӣ",
					"БАХШИ ФАНҲОИ ТАХАССУСӢ",
					"Модули фанҳои умумикасбӣ",
					
					"Модули фанҳои тахассусӣ",
					
					"БАХШИ ФАНҲОИ ИНТИХОБӢ",
					"Модули фанҳои интихобии бахши 1",
					"Модули фанҳои интихобии бахши 2",
					"БАХШИ ТАҶРИБАОМӮЗӢ",
					"АТТЕСТАТСИЯИ ХАТМ",
					"АТТЕСТАТСИЯИ НИҲОӢ",
				];
				
				
				
				$new_arr = [];
				for($j = 0, $i = $start_pos + 2; $i < $start_pos + $end_pos; $i++) {
					
					if(in_array(trim($data[$i][2]), $black_list)) continue;
					
					$new_arr[$j]['title'] = doTajik(trim($data[$i][2]));
					$new_arr[$j]['credit'] = trim($data[$i][22]);
					if(!empty($data[$i][28]))
						$new_arr[$j]['imtihon'] = str_replace(".", ",", trim($data[$i][28]));
					else 
						$new_arr[$j]['imtihon'] = trim($data[$i][28]);
					
					$new_arr[$j]['k_k'] = $data[$i][31];
					$new_arr[$j]['credit_faol'] = $data[$i][35];
					$new_arr[$j]['credit_aud'] = $data[$i][39];
					$new_arr[$j]['credit_kmro'] = $data[$i][44];
					$new_arr[$j]['credit_kmd'] = $data[$i][48];
					
					$new_arr[$j]['sem_1'] = $data[$i][51];
					$new_arr[$j]['sem_2'] = $data[$i][53];
					$new_arr[$j]['sem_3'] = $data[$i][55];
					$new_arr[$j]['sem_4'] = $data[$i][57];
					$new_arr[$j]['sem_5'] = $data[$i][59];
					$new_arr[$j]['sem_6'] = $data[$i][61];
					$new_arr[$j]['sem_7'] = $data[$i][63];
					$new_arr[$j]['sem_8'] = $data[$i][65];
					$new_arr[$j]['sem_9'] = @$data[$i][67];
					$new_arr[$j]['sem_10'] = @$data[$i][69];
					$j++;
				}
				
				
				
				foreach($new_arr as $item){
					$check = query("SELECT * FROM `fan_test` WHERE `title_tj` = '{$item['title']}'");
					//$check = query("SELECT * FROM `fan_test` WHERE `title_tj` != '{$item['title']}' AND MATCH(`title_tj`) AGAINST ('{$item['title']}' IN NATURAL LANGUAGE MODE) LIMIT 1");
					if(empty($check)){
						unset($fan_data);
						$fan_data['title_tj'] = "'".clear_admin(doTajik($item['title']))."'";
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
							insert("nt_content", $nt_fields, $nt_data);
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
						if(!empty($item['imtihon'])){
							if($item['k_k'])
								$nt_data['k_k'] = "'".clear_admin(1)."'";
						}
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
						insert("nt_content", $nt_fields, $nt_data);
					}
				}
				
				
				/*ИНТИХОБӢ*/
				$intixobi = $spreadsheet->getSheet(1)->toArray();
				
				// Замена подстроки в каждом элементе массива
				$intixobi = array_map('doTajik', $intixobi);
				
				$start_pos = findIndexInTwoDimensionalArray($intixobi, "Модули фанҳои интихобии бахши 1");
				$black_list = [
					"Модули фанҳои интихобии бахши 2",
				];
				
				
				
				$new_arr = [];
				for($j = 0, $i = $start_pos + 1; $i < count($intixobi); $i++) {
					//if(empty($intixobi[$i][1]) || empty($intixobi[$i][2])) continue;
					if(in_array(trim($intixobi[$i][2]), $black_list)) continue;
					
					$new_arr[$j]['title'] = trim(doTajik($intixobi[$i][2]));
					if($intixobi[$i][0] == ''){
						$new_arr[$j]['credit'] = trim($intixobi[$i-1][23]);
					}else
						$new_arr[$j]['credit'] = trim($intixobi[$i][23]);
					
					if(!empty($intixobi[$i][29]))
						$new_arr[$j]['imtihon'] = str_replace(".", ",", trim($intixobi[$i][29]));
					else 
						$new_arr[$j]['imtihon'] = trim($intixobi[$i][29]);
					
					
					
					if($intixobi[$i][0] == ''){
						$new_arr[$j]['credit_faol'] = $intixobi[$i-1][37];
						$new_arr[$j]['credit_aud'] = $intixobi[$i-1][41];
						$new_arr[$j]['credit_kmro'] = $intixobi[$i-1][45];
						$new_arr[$j]['credit_kmd'] = $intixobi[$i-1][48];
						
						$new_arr[$j]['sem_1'] = $intixobi[$i-1][51];
						$new_arr[$j]['sem_1'] = $intixobi[$i-1][51];
						$new_arr[$j]['sem_2'] = $intixobi[$i-1][53];
						$new_arr[$j]['sem_3'] = $intixobi[$i-1][55];
						$new_arr[$j]['sem_4'] = $intixobi[$i-1][57];
						$new_arr[$j]['sem_5'] = $intixobi[$i-1][59];
						$new_arr[$j]['sem_6'] = $intixobi[$i-1][61];
						$new_arr[$j]['sem_7'] = $intixobi[$i-1][63];
						$new_arr[$j]['sem_8'] = $intixobi[$i-1][65];
						$new_arr[$j]['sem_9'] = @$intixobi[$i-1][67];
						$new_arr[$j]['sem_10'] = @$intixobi[$i-1][69];
					}else{
						$new_arr[$j]['credit_faol'] = $intixobi[$i][37];
						$new_arr[$j]['credit_aud'] = $intixobi[$i][41];
						$new_arr[$j]['credit_kmro'] = $intixobi[$i][45];
						$new_arr[$j]['credit_kmd'] = $intixobi[$i][48];
					
						$new_arr[$j]['sem_1'] = $intixobi[$i][51];
						$new_arr[$j]['sem_1'] = $intixobi[$i][51];
						$new_arr[$j]['sem_2'] = $intixobi[$i][53];
						$new_arr[$j]['sem_3'] = $intixobi[$i][55];
						$new_arr[$j]['sem_4'] = $intixobi[$i][57];
						$new_arr[$j]['sem_5'] = $intixobi[$i][59];
						$new_arr[$j]['sem_6'] = $intixobi[$i][61];
						$new_arr[$j]['sem_7'] = $intixobi[$i][63];
						$new_arr[$j]['sem_8'] = $intixobi[$i][65];
						$new_arr[$j]['sem_9'] = @$intixobi[$i][67];
						$new_arr[$j]['sem_10'] = @$intixobi[$i][69];
					}
					$j++;
				}
				
				
				
				foreach($new_arr as $item){
					$check = query("SELECT * FROM `fan_test` WHERE `title_tj` = '{$item['title']}'");
					//$check = query("SELECT * FROM `fan_test` WHERE `title_tj` != '{$item['title']}' AND MATCH(`title_tj`) AGAINST ('{$item['title']}' IN NATURAL LANGUAGE MODE) LIMIT 1");
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
							insert("nt_content", $nt_fields, $nt_data);
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
						insert("nt_content", $nt_fields, $nt_data);
					}
				}
				unlink($file);
			}
			redirect();
		}
	break;
	
	
	case "uploadDataM2":
		$id_nt = $_REQUEST['id_nt'];
		if($_FILES['nt_file']['name']){
			$BaseName = "nt_".$id_nt.".xlxs";
			$BaseTmpName = $_FILES['nt_file']['tmp_name'];
			
			if(move_uploaded_file($BaseTmpName, "../userfiles/naqshaho/$BaseName")){
				$file = "../userfiles/naqshaho/$BaseName";
				
				$spreadsheet = $reader->load($file);
				
				$reader->setReadDataOnly(true);
				// Количество листов
				$sheetsCount = $spreadsheet->getSheetCount();

				$data = $spreadsheet->getSheet(0)->toArray();
				
				$start_pos = findIndexInTwoDimensionalArray($data, "БАХШИ ФАНҲОИ ТАХАССУСӢ");
				
				$second_part = array_slice($data, $start_pos); 
				
				
				$end_pos = findIndexInTwoDimensionalArray($second_part, "Ҳамагӣ");
				
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
				
				$new_arr = [];
				for($j = 0, $i = $start_pos + 2; $i < $start_pos + $end_pos; $i++) {
					if(in_array(trim($data[$i][1]), $black_list)) continue;
					$new_arr[$j]['title'] = $data[$i][1];
					$new_arr[$j]['credit'] = $data[$i][22];
					if(!empty($data[$i][28]))
						$new_arr[$j]['imtihon'] = str_replace(".", ",", $data[$i][28]);
					else 
						$new_arr[$j]['imtihon'] = $data[$i][28];
					
					$new_arr[$j]['k_k'] = $data[$i][34];
					$new_arr[$j]['credit_faol'] = $data[$i][37];
					$new_arr[$j]['credit_aud'] = $data[$i][41];
					$new_arr[$j]['credit_kmro'] = $data[$i][45];
					$new_arr[$j]['credit_kmd'] = $data[$i][48];
					
					$new_arr[$j]['sem_1'] = $data[$i][51];
					$new_arr[$j]['sem_2'] = $data[$i][53];
					$new_arr[$j]['sem_3'] = $data[$i][55];
					$new_arr[$j]['sem_4'] = $data[$i][57];
					$new_arr[$j]['sem_5'] = $data[$i][59];
					$new_arr[$j]['sem_6'] = $data[$i][61];
					
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
							insert("nt_content", $nt_fields, $nt_data);
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
						
						$nt_fields = array_keys($nt_data);
						$nt_data = implode(",", $nt_data);
						insert("nt_content", $nt_fields, $nt_data);
					}
				}
				
				
				/*ИНТИХОБӢ*/
				
				$intixobi = $spreadsheet->getSheet(1)->toArray();
				
				$start_pos = findIndexInTwoDimensionalArray($intixobi, "Модули фанҳои интихобии бахши 2");
				echo "START_POS: $start_pos<br>";
				$black_list = [
					"Модули фанҳои интихобии бахши 2",
				];
				
				
				$new_arr = [];
				for($j = 0, $i = $start_pos + 2; $i < count($intixobi); $i++) {
					if(empty($intixobi[$i][1]) || empty($intixobi[$i][2])) continue;
					if(in_array($intixobi[$i][1], $black_list)) continue;
					
					$new_arr[$j]['title'] = $intixobi[$i][1];
					$new_arr[$j]['credit'] = $intixobi[$i][2];
					if(!empty($intixobi[$i][3]))
						$new_arr[$j]['imtihon'] = str_replace(".", ",", $intixobi[$i][3]);
					else 
						$new_arr[$j]['imtihon'] = $intixobi[$i][3];
					
					
					$new_arr[$j]['credit_faol'] = $intixobi[$i][6];
					$new_arr[$j]['credit_aud'] = $intixobi[$i][7];
					$new_arr[$j]['credit_kmro'] = $intixobi[$i][8];
					$new_arr[$j]['credit_kmd'] = $intixobi[$i][9];
					
					$new_arr[$j]['sem_1'] = $intixobi[$i][10];
					$new_arr[$j]['sem_2'] = $intixobi[$i][11];
					$new_arr[$j]['sem_3'] = $intixobi[$i][12];
					$new_arr[$j]['sem_4'] = $intixobi[$i][13];
					$new_arr[$j]['sem_5'] = $intixobi[$i][14];
					$new_arr[$j]['sem_6'] = $intixobi[$i][15];
					
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
							insert("nt_content", $nt_fields, $nt_data);
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
						insert("nt_content", $nt_fields, $nt_data);
					}
					
				}
				
				
				unlink($file);
			}
			redirect();
		}
	break;
	
	case "uploadDataMG":
		$id_nt = $_REQUEST['id_nt'];
		if($_FILES['nt_file']['name']){
			$BaseName = "nt_".$id_nt.".xlxs";
			$BaseTmpName = $_FILES['nt_file']['tmp_name'];
			
			if(move_uploaded_file($BaseTmpName, "../userfiles/naqshaho/$BaseName")){
				$file = "../userfiles/naqshaho/$BaseName";
				
				$spreadsheet = $reader->load($file);
				
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
							insert("nt_content", $nt_fields, $nt_data);
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
						insert("nt_content", $nt_fields, $nt_data);
					}
				}
				
				
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
							insert("nt_content", $nt_fields, $nt_data);
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
						insert("nt_content", $nt_fields, $nt_data);
					}
				}
				unlink($file);
			}
			redirect();
		}
	break;
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		
		
		$S_Y_FOR_NT = select("nt_list", array("DISTINCT(soli_tasdiq)"), "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v'", "soli_tasdiq", false, "");
		
		$page_info['title'] = 'Нақшаҳои таълимӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v);
	break;
	
	case "list_iqtibos":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_v = $_REQUEST['id_s_v'];
		
		
		$S_Y_FOR_NT = select("nt_list", array("DISTINCT(soli_tasdiq)"), "`id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v'", "soli_tasdiq", false, "");
		
		$page_info['title'] = 'Иқтибосҳо';
	break;
	
	case "nt_list":
		$id_nt = $_REQUEST['id_nt'];
		
		$info_nt = select("nt_list", "*", "`id` = '$id_nt'", "id", false, "");
		$id_faculty = $info_nt[0]['id_faculty'];
		$id_spec = $info_nt[0]['id_spec'];
		$id_s_v = $info_nt[0]['id_s_v'];
		$id_s_l = $info_nt[0]['id_s_l'];
		$soli_tasdiq = $info_nt[0]['soli_tasdiq'];
		
		
		$other_nts = query("SELECT * FROM `nt_list` WHERE 
		`id` != '$id_nt' AND 
		`id_faculty` = '$id_faculty' AND
		`id_s_l` = '$id_s_l' AND 
		`id_s_v` = '$id_s_v' AND 
		`soli_tasdiq` = '$soli_tasdiq'");
		
		//print_arr($other_nts);exit;
		
		$semestrs = query("SELECT DISTINCT(`semestr`) FROM `nt_content` WHERE `id_nt` = '$id_nt' ORDER BY `semestr`");
		
		
		$groups = query("SELECT DISTINCT `id_course` FROM `std_study_groups` WHERE `id_nt` = '$id_nt' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_course`");
		$page_info['title'] = 'Нақшаи таълимӣ / '.getFacultyShort($id_faculty).' / '.getStudyLevel($id_s_l).' / '.getStudyView($id_s_v).' / '.($soli_tasdiq).' / '.getSpecialtyCode($id_spec);
	
		
	break;
	
	case "deletefan":
		$id_ntcontent=$_REQUEST['id_ntcontent'];
		if(delete("nt_content","`id`='$id_ntcontent'")){
			redirect();
		}		
	break;
	
	case "deletent":
		$id_nt=$_REQUEST['id_nt'];
		if(!empty($id_nt)){
			delete("nt_content", "`id_nt`='$id_nt'"); //Ҳамаи фанҳои ҳамин нақшаро аз nt_content удалит мекунем
			delete("nt_list", "`id`='$id_nt'"); //Нақшаро удалит мекунем
			redirect();
		}
	break;
	
	case "addData":
		$id_nt = $_REQUEST['id_nt'];
		for($i=0; $i < count($_REQUEST['fan']); $i++){
			unset($data, $fields);

			$data['id_nt'] = $id_nt;
			$data['semestr'] = "'".getSemestr($_REQUEST['course'], $_REQUEST['h_y'])."'";
			$data['id_fan'] = "'".clear_admin($_REQUEST['fan'][$i])."'";
			
			if($_REQUEST['intixobi'][$i])
				$data['intixobi'] = "1";
			
			
			if($_REQUEST['kori_c'][$i])
				$data['k_k'] = "'1'";
			
			$data['c_u'] = "'".clear_admin($_REQUEST['c_umumi'][$i])."'";
			$data['c_f_u'] = "'".clear_admin($_REQUEST['c_f_umumi'][$i])."'";
			$data['c_a'] = "'".clear_admin($_REQUEST['c_aud'][$i])."'";
			$data['cmro'] = "'".clear_admin($_REQUEST['cmro'][$i])."'";
			$data['cmd'] = "'".clear_admin($_REQUEST['cmd'][$i])."'";
			$data['author'] = "'".clear_admin($_SESSION['user']['id'])."'";
			
			$fields = array_keys($data);
			$data = implode(",", $data);
			
			insert("nt_content", $fields, $data);
		}
		
		redirect();
	break;
	
}


?>