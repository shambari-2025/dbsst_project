<?php
if(isset($_REQUEST['do'])){
	include('../../lib/header_file.php');
	$action = empty($_REQUEST['do']) ? 'main' : $_REQUEST['do'];
}

switch($action){
	
	case "list":
		$faculties = select("faculties", "*", "", "id", false, "");
		$studylevels = select("study_level", "*", "", "id", false, "");
		$studyviews = select("study_view", "*", "", "id", true, "");
		
		$courses = select("course", "*", "", "id", false, "");
		$groups = select("groups", "*", "", "id", false, "");
		
		$study_years = select("study_years", "*", "", "id", false, "");
		
		$page_info['title'] = 'Иловакуни ба руйхати VIP';
	break;
	
	case "start":
		$s_y = $_REQUEST['s_y'];
		$h_y = $_REQUEST['h_y'];
		
		$vip_list = query("SELECT `students`.*, `users`.`fullname`, `_vip_list`.* FROM `users`
		INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
		INNER JOIN `_vip_list` ON `_vip_list`.`id_student` = `students`.`id_student`
		AND `_vip_list`.`s_y` = `students`.`s_y`
		AND `_vip_list`.`h_y` = `students`.`h_y`
		WHERE `_vip_list`.`status` IS NULL AND
		`_vip_list`.`s_y` = '$s_y' AND `_vip_list`.`h_y` = '$h_y' AND
		`students`.`s_y` = '$s_y' AND `students`.`h_y` = '$h_y'
		");
		
		if(!empty($vip_list)){
		
			$res_array = []; // Барои маълумотҳоро ҷамъ кардан
			foreach($vip_list as $student){
				$id_student = $student['id_student'];
				$id_faculty = $student['id_faculty'];
				$id_course = $student['id_course'];
				$id_spec = $student['id_spec'];
				$id_group = $student['id_group'];
				$author = $student['author'];
				
				unset($fields);
				$fields['status'] = '1';
				update("_vip_list", $fields, "`id_student` = '".$student['id_student']."' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
				
				echo $id_student.' '.getUserName($id_student).'<br>';
				
				$fanho = query("SELECT * FROM `jd` WHERE `id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
				
				foreach($fanho as $f_item){
					$id_fan = $f_item['id_fan'];
					
					$result = query("SELECT * FROM `results` WHERE `id_student` = '$id_student' AND `id_fan` = '$id_fan' AND `s_y` = '$s_y' AND `h_y` = '$h_y'");
					
					if(empty($result)){
						echo " &nbsp;&nbsp;&nbsp;&nbsp;".getFan($id_fan).'<br>';
						// Агар ягон натиҷа надошта бошад
						$nf_1_score = rand(16, 24);
						$nf_1_add_date = date("d.m.y, H:i");
						$nf_1_author = $_SESSION['user']['id'];
						
						$nf_2_score = rand(16, 24);
						$nf_2_add_date = date("d.m.y, H:i");
						$nf_2_author = $_SESSION['user']['id'];
						
						$imt_score = rand(25, 37);
						$imt_add_date = date("d.m.y, ").rand(8, 16).":".rand(10, 59);
						$imt_author = $_SESSION['user']['id'];
						
						echo " &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; НФ1: $nf_1_score, НФ2: $nf_1_score, ИМТИҲОН: $imt_score,<br>";
						
						$res_array[] = "(
							'{$id_faculty}',
							'{$id_student}',
							'{$id_course}',
							'{$id_spec}',
							'{$id_group}',
							'{$id_fan}',
							'1',
							
							'{$nf_1_score}',
							'{$nf_1_add_date}',
							'{$nf_1_author}',
							
							'{$nf_2_score}',
							'{$nf_2_add_date}',
							'{$nf_2_author}',
							
							'{$imt_score}',
							'{$imt_add_date}',
							'{$imt_author}',
							
							'{$s_y}',
							'{$h_y}'
						)";
						// Агар ягон натиҷа надошта бошад барои ҳамин фан 
					}else{
						// обновит кадан даркор
						echo " &nbsp;&nbsp;&nbsp;&nbsp;".getFan($id_fan).'<br>';
						
						$id_res = $result[0]['id'];
						
						unset($fields);
						if($result[0]['nf_1_score'] <= 15){
							$fields['nf_1_score'] = rand(16, 24);
						}
						
						if($result[0]['nf_2_score'] <= 15){
							$fields['nf_2_score'] = rand(16, 24);
						}
						
						if(is_null($result[0]['imt_score']) || $result[0]['imt_score'] <= 25){
							$fields['imt_score'] = rand(25, 37);
							if(is_null($result[0]['imt_add_date']))
								$fields['imt_add_date'] = date("d.m.y, ").rand(8, 16).":".rand(10, 59);
						}
						
						if(isset($fields)){
							update("results", $fields, "`id` = '$id_res'");
							echo "updated ;)<br>";
						}
						
						// обновит кадан даркор
					}
				}
				
				echo "<br>==========================================<br>";
			}
			
			if(isset($res_array)){
				$str = implode(",", $res_array);
				$query = "INSERT INTO `results` (
				`id_faculty`, `id_student`, `id_course`, `id_spec`, `id_group`, `id_fan`, `type`, 
				`nf_1_score`, `nf_1_add_date`, `nf_1_author`,
				`nf_2_score`, `nf_2_add_date`, `nf_2_author`, 
				`imt_score`, `imt_add_date`, `imt_author`, 
				`s_y`, `h_y`) VALUES $str";
			
				if(!empty($res_array))
					if(insert_query($query)) echo "okey ;)";
				else echo "Барои коркард маълумот нест!";
			}
		}else{
			echo "Ҳама маълумотҳо ҷо ба ҷо шуданд.";
		}
		exit;
	break;
	
}


?>