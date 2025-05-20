<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$page_info['title']?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="author" content="colorlib" />
		
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/davrifaol.css">
	</head>
	
	<body style="width:94%; margin: 15px auto 0 auto">
		<?=$page_info['title'];?>
		<table class="table" style="font-size: 14px !important">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th class="counter">№</th>
					<th>Факултет</th>
					<th>Зинаи<br>таҳсил</th>
					<th>Шакли<br>таҳсил</th>
					<th>Курс</th>
					<th>Ихтисос</th>
					<th>Гуруҳ </th>
					<th>Ному насаб</th>																																
					<th>Намуди<br>таҳсил</th>																																
				</tr>
			</thead>
			<tbody class="center" id="tbody">
				<?php if(isset($_SESSION['user']['admin'])):?>
					<?php $S_R = $_SESSION['superarr'];?>
				<?php else:?>
					<?php $S_R = $_SESSION['students'];?>
				<?php endif;?>
				
				<?php $i = 1;?>
				
				
				<?php foreach($S_R as $fac):?>
					<?php $id_faculty = $fac['id'];//echo getFaculty($id_faculty);?>
						<?php foreach($fac['level'] as $studylevel):?>
							<?php $id_s_l = $studylevel['id'];?>
							<?php foreach($studylevel['view'] as $studyview):?>
								<?php $id_s_v = $studyview['id'];?>
								<?php foreach($studyview['course'] as $course):?>
									<?php $id_course = $course['id'];?>
									<?php foreach($course['spec'] as $spec):?>
										<?php $id_spec = $spec['id'];?>
										<?php foreach($spec['groups'] as $group):?>
											<?php $id_group = $group['id'];?>
												<?php $students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, 2);?>
												<?php foreach($students as $student):?>
													<?php 
														$id_student = $student['id_student'];
														$infoN2 = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '2'");
														$student_fac = @$infoN2[0]['id_faculty'];
														$student_s_l = @$infoN2[0]['id_s_l'];
														$student_s_v = @$infoN2[0]['id_s_v'];
														$student_course = @$infoN2[0]['id_course'];
														$student_spec = @$infoN2[0]['id_spec'];
														$student_group = @$infoN2[0]['id_group'];
														$student_s_t = @$infoN2[0]['id_s_t'];
														
														if(!empty($infoN2)){
															//Қарздорӣ аз фанҳои нимсолаи 2
															$qarzhoN2 = query("SELECT * FROM `results` 
																				WHERE 
																					`id_faculty` = '$student_fac' AND 
																					`id_s_l` = '$student_s_l' AND 
																					`id_s_v` = '$student_s_v' AND
																					`id_course` = '$student_course'	AND
																					`id_spec` = '$student_spec'	AND 
																					`id_group` = '$student_group' AND 
																					`id_student` = '$id_student' AND 
																					`s_y` = '$S_Y' AND 
																					`h_y` = '2' 
																				HAVING 
																					COALESCE(`total_score`, 0) < 50 AND
																					COALESCE(`trimestr_score`, 0) < 50
																			");
															//Қарздорӣ аз Кори курси
															$id_nt = getNT($student_fac, $student_s_l, $student_s_v, $student_course, $student_spec, $student_group, $S_Y, 2);				
															$semestr2 = getSemestr($student_course, 2);
															$qarzi_kk2 = query("SELECT `nt_content`.*, `results`.* FROM `nt_content` INNER JOIN `results` ON
																				`nt_content`.`id_fan` = `results`.`id_fan`
																				WHERE `nt_content`.`id_nt` = '$id_nt' AND
																					`nt_content`.`semestr` = '$semestr2' AND 
																					`nt_content`.`k_k` IS NOT NULL AND
																					`results`.`id_student` = '$id_student' AND
																					COALESCE(`results`.`kori_kursi`, 0) < 50 AND
																					`s_y` = '$S_Y' AND
																					`h_y` = '2'
																			");
														}
														
														$infoN1 = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '1'");
														$student_fac = @$infoN1[0]['id_faculty'];
														$student_s_l = @$infoN1[0]['id_s_l'];
														$student_s_v = @$infoN1[0]['id_s_v'];
														$student_course = @$infoN1[0]['id_course'];
														$student_spec = @$infoN1[0]['id_spec'];
														$student_group = @$infoN1[0]['id_group'];
														
														if(!empty($infoN1)){
															//Қарздорӣ аз фанҳои нимсолаи 1
															$qarzhoN1 = query("SELECT * FROM `results` 
																				WHERE 
																					`id_faculty` = '$student_fac' AND 
																					`id_s_l` = '$student_s_l' AND 
																					`id_s_v` = '$student_s_v' AND
																					`id_course` = '$student_course'	AND
																					`id_spec` = '$student_spec'	AND 
																					`id_group` = '$student_group' AND 
																					`id_student` = '$id_student' AND 
																					`s_y` = '$S_Y' AND 
																					`h_y` = '1' 
																				HAVING 
																					COALESCE(`total_score`, 0) < 50 AND
																					COALESCE(`trimestr_score`, 0) < 50
																			");
															//Қарздорӣ аз Кори курсӣ
															$id_nt = getNT($student_fac, $student_s_l, $student_s_v, $student_course, $student_spec, $student_group, $S_Y, 1);
															$semestr1 = getSemestr($student_course, 1);
															$qarzi_kk1 = query("SELECT `nt_content`.*, `results`.* FROM `nt_content` INNER JOIN `results` ON
																				`nt_content`.`id_fan` = `results`.`id_fan`
																				WHERE `nt_content`.`id_nt` = '$id_nt' AND
																					`nt_content`.`semestr` = '$semestr1' AND 
																					`nt_content`.`k_k` IS NOT NULL AND
																					`results`.`id_student` = '$id_student' AND
																					COALESCE(`results`.`kori_kursi`, 0) < 50 AND
																					`s_y` = '$S_Y' AND
																					`h_y` = '1'
																			");
														}
													?>
													<?php if(empty($qarzhoN1) && empty($qarzhoN2) && empty($qarzi_kk1) && empty($qarzi_kk2)):?>
														<tr>
															<td><?=$i?></td>
															<td><?=getFacultyShort($id_faculty)?></td>
															<td><?=getStudyLevel($id_s_l)?></td>
															<td><?=getStudyView($id_s_v)?></td>
															<td><?=$id_course?></td>
															<td><?=getSpecialtyCode($id_spec)?></td>
															<td><?=getGroup($id_group)?></td>
															<td class="left"><?=$student['fullname_tj']?></td>
															<td><?=getStudyType($student_s_t)?></td>												
														</tr>
														<?php $i++;?>
													<?php endif;?>
												<?php endforeach;?>
										<?php endforeach;?>
									<?php endforeach;?>
								<?php endforeach;?>
					<?php //exit;?>
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>