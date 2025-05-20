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
					<th>Қарздорӣ <br>аз фанҳо</th>																						
					<th>Қарздорӣ <br>аз КК</th>																						
					<th>Фарқиятҳои<br>насупорида</th>																						
					<th>Қарздорӣ<br>аз шартнома</th>																						
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
												<?php $students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y);?>
												<?php foreach($students as $student):?>
													<?php 
														$id_student = $student['id_student'];
														$info_std = query("SELECT * FROM `students` WHERE `status` = '1' AND `id_student` = '$id_student' AND `s_y` = '$S_Y' AND `h_y` = '1'");
														$student_fac = @$info_std[0]['id_faculty'];
														$student_s_l = @$info_std[0]['id_s_l'];
														$student_s_v = @$info_std[0]['id_s_v'];
														$student_course = @$info_std[0]['id_course'];
														$student_spec = @$info_std[0]['id_spec'];
														$student_group = @$info_std[0]['id_group'];
														
														if(!empty($info_std)){
															//Қарздорӣ аз фанҳо
															$qarzho = query("SELECT * FROM `results` 
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
															//Қарздорӣ аз Кори курси
															$id_nt = getNT($student_fac, $student_s_l, $student_s_v, $student_course, $student_spec, $student_group, $S_Y, 1);				
															$semestr = getSemestr($student_course, 1);
															$qarzi_kk = query("SELECT `nt_content`.*, `results`.* FROM `nt_content` INNER JOIN `results` ON
																				`nt_content`.`id_fan` = `results`.`id_fan`
																				WHERE `nt_content`.`id_nt` = '$id_nt' AND
																					`nt_content`.`semestr` = '$semestr' AND 
																					`nt_content`.`k_k` IS NOT NULL AND
																					`results`.`id_student` = '$id_student' AND
																					COALESCE(`results`.`kori_kursi`, 0) < 50 AND
																					`s_y` = '$S_Y' AND
																					`h_y` = '1'
																			");
															//Фарқиятҳои насупорида
															$farqiyat = query("SELECT `farqiyatho`.`id_student`, 
																					`farqiyatho_content`.`id_farqiyat`, 
																					`farqiyatho_content`.`id_fan`,
																					`results`.*
																				FROM `farqiyatho`
																				INNER JOIN `farqiyatho_content` ON 
																					`farqiyatho`.`id` = `farqiyatho_content`.`id_farqiyat`
																				LEFT JOIN `results` ON 
																					`farqiyatho_content`.`id_fan` = `results`.`id_fan` AND
																					`farqiyatho`.`id_student` = `results`.`id_student` AND
																					`farqiyatho_content`.`s_y` = `results`.`s_y` AND
																					`farqiyatho_content`.`h_y` = `results`.`h_y`
																				WHERE `farqiyatho`.`id_student` = '$id_student' AND
																					`farqiyatho_content`.`type` = '1' AND
																					COALESCE(`results`.`total_score`, 0) < 50
																					
																			");
															//Қарздорӣ аз шартнома
															$N1 = getBalanceStudent($id_student, $S_Y, 1);
															$N2 = getBalanceStudent($id_student, $S_Y, 2);
															$mablagi_suporida = getMoneyShartnoma($id_student, $S_Y);
															$qarzdori_shartnoma = (float)$mablagi_suporida - (float)$N1 - (float)$N2;
														}
													?>
													<?php if(!empty($qarzho) || !empty($qarzi_kk) || !empty($farqiyat) || $qarzdori_shartnoma < 0):?>
														<tr>
															<td><?=$i?></td>
															<td><?=getFacultyShort($id_faculty)?></td>
															<td><?=getStudyLevel($id_s_l)?></td>
															<td><?=getStudyView($id_s_v)?></td>
															<td><?=$id_course?></td>
															<td><?=getSpecialtyCode($id_spec)?></td>
															<td><?=getGroup($id_group)?></td>
															<td class="left"><?=$student['fullname_tj']?>[<?=$id_student?>]</td>
															<td>
																<?php if(!empty($qarzho)):?>
																	аз <?=count($qarzho)?> фан
																<?php endif;?>
															</td>
															<td>
																<?php if(!empty($qarzi_kk)):?>
																	аз <?=count($qarzi_kk)?> фан
																<?php endif;?>
															</td>
															<td>
																<?php if(!empty($farqiyat)):?>
																	аз <?=count($farqiyat)?> фан
																<?php endif;?>
															</td>
															<td>
																<?php if($qarzdori_shartnoma < 0):?>
																	<?=$qarzdori_shartnoma;?>
																<?php endif;?>
															</td>
														</tr>
														<?php $i++;?>
													<?php endif;?>
												<?php endforeach;?>
										<?php endforeach;?>
									<?php endforeach;?>
								<?php endforeach;?>
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>