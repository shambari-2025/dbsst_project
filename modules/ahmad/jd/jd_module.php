<?php


switch($action){
	case "add":
		$faculties = select("faculties", "*", "", "id", false, "");
		$studylevels = select("study_level", "*", "", "id", false, "");
		$studyviews = select("study_view", "*", "", "id", false, "");
		
		$courses = select("course", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "id", false, "");
		
		$study_years = select("study_years", "*", "", "id", false, "");
		
		$page_info['title'] = 'Иловакунии ҷадвали дарсӣ';
	break;
	
	case "insert":
		$table = "jd";
		
		for($i=1;$i<=6;$i++){
			for($j=1;$j<=7;$j++){
				if(!empty($_REQUEST['teacher'][$i][$j][0])){
					$check = query("SELECT * FROM `jd` WHERE 
					`id_faculty` = {$_REQUEST['faculty']} AND 
					`bast` = {$_REQUEST['bast']} AND 
					`id_s_l` = {$_REQUEST['id_s_l']} AND 
					`id_s_v` = {$_REQUEST['id_s_v']} AND 
					`id_course` = {$_REQUEST['course']} AND
					`id_spec` = {$_REQUEST['specialty']} AND
					`id_group` = {$_REQUEST['group']} AND
					`ruz` = '$i' AND
					`soat` = '$j' AND 
					`s_y` = {$_REQUEST['s_y']} AND
					`h_y` = {$_REQUEST['h_y']}
					");
					if(empty($check)){
						unset($data, $fields);
						$data['id_faculty'] = "'".clear_admin($_REQUEST['faculty'])."'";
						$data['bast'] = "'".clear_admin($_REQUEST['bast'])."'";
						$data['id_s_l'] = "'".clear_admin($_REQUEST['id_s_l'])."'";
						$data['id_s_v'] = "'".clear_admin($_REQUEST['id_s_v'])."'";
						$data['id_course'] = "'".clear_admin($_REQUEST['course'])."'";
						$data['id_spec'] = "'".clear_admin($_REQUEST['specialty'])."'";
						$data['id_group'] = "'".clear_admin($_REQUEST['group'])."'";
						$data['ruz'] = "'".clear_admin($i)."'";
						$data['soat'] = "'".clear_admin($j)."'";
						$data['id_fan'] = "'".clear_admin($_REQUEST['fan'][$i][$j][0])."'";
						$data['lessons_type'] = "'".clear_admin($_REQUEST['l_type'][$i][$j][0])."'";
						$data['id_teacher'] = "'".clear_admin($_REQUEST['teacher'][$i][$j][0])."'";
						
						$data['s_y'] = "'".clear_admin($_REQUEST['s_y'])."'";
						$data['h_y'] = "'".clear_admin($_REQUEST['h_y'])."'";
						
						$fields = array_keys($data);
						$data = implode(",", $data);
						
						insert($table, $fields, $data);
					}else{
						$id_jd=$check[0]['id'];
						$fields = array('id_faculty' => $_REQUEST['faculty'],
										'bast' => $_REQUEST['bast'],
										'id_s_l' => $_REQUEST['id_s_l'],
										'id_s_v' => $_REQUEST['id_s_v'],
										'id_course' => $_REQUEST['course'],
										'id_spec' => $_REQUEST['specialty'],
										'id_group' => $_REQUEST['group'],
										'ruz' => $i,
										'soat' => $j,
										'id_fan' => $_REQUEST['fan'][$i][$j][0],
										'lessons_type' => $_REQUEST['l_type'][$i][$j][0],
										'id_teacher' => $_REQUEST['teacher'][$i][$j][0],
										's_y' => $_REQUEST['s_y'],
										'h_y' => $_REQUEST['h_y']
										);
						update("jd", $fields, "`id` = '$id_jd'");	
					}
				}
			}
		}
		
		/*
		
		for($i = 0; $i < count($_REQUEST['fan']); $i++){
			if(isset($_REQUEST['teacher'][$i])){
				
				$check = query("SELECT * FROM `jd` WHERE 
				`id_faculty` = {$_REQUEST['faculty']} AND 
				`id_course` = {$_REQUEST['course']} AND
				`id_spec` = {$_REQUEST['specialty']} AND
				`id_group` = {$_REQUEST['group']} AND
				`id_fan` = {$_REQUEST['fan'][$i]} AND
				`s_y` = {$_REQUEST['s_y']} AND
				`h_y` = {$_REQUEST['h_y']}
				");
				
				if(empty($check)){
				
					unset($data, $fields);
					$data['id_faculty'] = "'".clear_admin($_REQUEST['faculty'])."'";
					$data['id_course'] = "'".clear_admin($_REQUEST['course'])."'";
					$data['id_spec'] = "'".clear_admin($_REQUEST['specialty'])."'";
					$data['id_group'] = "'".clear_admin($_REQUEST['group'])."'";
					
					$data['id_fan'] = "'".clear_admin($_REQUEST['fan'][$i])."'";
					$data['id_teacher'] = "'".clear_admin($_REQUEST['teacher'][$i])."'";
					
					$data['s_y'] = "'".clear_admin($_REQUEST['s_y'])."'";
					$data['h_y'] = "'".clear_admin($_REQUEST['h_y'])."'";
					
					$fields = array_keys($data);
					$data = implode(",", $data);
					
					insert($table, $fields, $data);
				}
			}
		}*/
		redirect();
		
	break;
	
	case "update":
		$id = $_REQUEST['id'];
		
		$fields = array('id_fan' => $_REQUEST['fan'], 'id_teacher' => $_REQUEST['teacher']);
		
		if(update("jd", $fields, "`id` = '$id'")){
			redirect();
		}
	break;
	
	case "delete":
		$id = $_REQUEST['id'];
		
		delete("jd", "`id` = '$id'");
		redirect();
	break;
	
	case "list":
		$id_faculty = $_REQUEST['id_faculty'];
		$id_s_l = $_REQUEST['id_s_l'];
		$id_s_v = $_REQUEST['id_s_v'];
		$id_course = $_REQUEST['id_course'];
		$id_spec = $_REQUEST['id_spec'];
		$id_group = $_REQUEST['id_group'];
		if(isset($_REQUEST['s_y']) || isset($_REQUEST['h_y'])){
			$S_Y = $_REQUEST['s_y'];
			$H_Y = $_REQUEST['h_y'];
		}else{
			$S_Y = S_Y;
			$H_Y = H_Y;
		}
		
		
		$page_info['title'] = 'Ҷадвали дарсҳо: '.getFaculty($id_faculty).': '.getCourse($id_course);
		
		//print_arr($_SESSION['superarr'][$id_faculty]['view'][2]['course'][$id_course]['spec']);
		
		//exit;
	break;
	
}


?>