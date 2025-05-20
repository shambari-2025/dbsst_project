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
					<th class="left">Ному насаб</th>
					<th>Факултет</th>
					<th>Шакли <br>таҳсил</th>
					<th>Намуди<br> таҳсил</th>
					<th>Курс</th>
					<th>Ихтисос</th>
					<th>Гуруҳ </th>
					<th>Фан</th>
					<th>Хол</th>
					<th>Маблағ</th>												
				</tr>
			</thead>
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php $study_level = query("SELECT DISTINCT (`id_s_l`) FROM `students` WHERE `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_s_l`");?>
				<?php foreach($study_level as $s_l):?>
					<?php $study_view = query("SELECT DISTINCT (`id_s_v`) FROM `students` WHERE `id_s_l` = '{$s_l['id_s_l']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_s_v`");?>
					<?php foreach($study_view as $s_v):?>
						<?php 
							$s_l['id_s_l']=1;
							$s_v['id_s_v']=1;
						?>
							<?php $facs = query("SELECT DISTINCT (`id_faculty`) FROM `students` WHERE `id_faculty` != '7' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'  AND `id_s_l` = '{$s_l['id_s_l']}' AND `id_s_v`='{$s_v['id_s_v']}' AND `status`='1' ORDER BY `id_faculty`");?>

							<?php foreach($facs as $fac):?>
								<?php $course = query("SELECT DISTINCT (`id_course`) FROM `students` WHERE `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' AND `id_s_l` = '{$s_l['id_s_l']}' AND `id_s_v`='{$s_v['id_s_v']}' AND `status`='1' ORDER BY `id_course`");?>
								<?php foreach($course as $c):?>
									<?php $specs = query("SELECT DISTINCT (`id_spec`) FROM `students` WHERE `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' AND `id_s_l` = '{$s_l['id_s_l']}' AND `id_s_v`='{$s_v['id_s_v']}' AND `status`='1' ORDER BY `id_spec`");?>
									<?php foreach($specs as $s):?>
										<?php $groups = query("SELECT DISTINCT(`id_group`) FROM `students` WHERE `id_spec` = '{$s['id_spec']}' AND `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' AND `id_s_l` = '{$s_l['id_s_l']}' AND `id_s_v`='{$s_v['id_s_v']}' AND `status`='1' ORDER BY `id_group`");?>
										<?php foreach($groups as $g):?>
											<?php 
												$students = query("SELECT * FROM `users` WHERE `id` IN 
																		(SELECT DISTINCT (`id_student`) FROM `students` WHERE `id_group` = '{$g['id_group']}' AND `id_spec` = '{$s['id_spec']}' AND `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' AND `id_s_l` = '{$s_l['id_s_l']}' AND `id_s_v`='{$s_v['id_s_v']}' AND `status`='1')
																	ORDER BY `fullname_tj`
																	");
												$tests = query("SELECT * FROM `tests` WHERE `id_group` = '{$g['id_group']}' AND `id_spec` = '{$s['id_spec']}' AND `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' AND `id_s_l` = '{$s_l['id_s_l']}' AND `id_s_v`='{$s_v['id_s_v']}'");
												$id_tests ='';
												foreach($tests as $test){
													$id_tests.=$test['id_fan'].",";
												}
												$id_tests = substr($id_tests, 0, -1);
												if($id_tests == '')
													$id_tests = 0;
												
												$id_nt = query("SELECT `id_nt` FROM `std_study_groups` WHERE `id_group` = '{$g['id_group']}' AND `id_spec` = '{$s['id_spec']}' AND `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' AND `id_s_l` = '{$s_l['id_s_l']}' AND `id_s_v`='{$s_v['id_s_v']}'");
												$id_nt = $id_nt[0]['id_nt'];
												$semestr = getSemestr($c['id_course'], $H_Y);
												$shartnoma = getSharnomaMoneyBySY($c['id_course'], $s['id_spec'], $s_l['id_s_l'], $s_v['id_s_v'], S_Y);
											?>
											<?php foreach($students as $std):?>
													<?php $results = query("SELECT 
																				`id_fan`, 
																				COALESCE(`total_score`, 0) AS `total_score`, 
																				`imt_author`
																			FROM 
																				`results` 
																			WHERE 
																				`id_fan` IN ($id_tests) 
																				AND COALESCE(`imt_score`, 0) >= 0 
																				AND `id_student` = '{$std['id']}'
																				AND `id_group` = '{$g['id_group']}'
																				AND `id_spec` = '{$s['id_spec']}'
																				AND `id_course` = '{$c['id_course']}'
																				AND `id_faculty` = '{$fac['id_faculty']}'
																				AND `s_y` = '$S_Y' 
																				AND `h_y` = '$H_Y' 
																				AND `id_s_l` = '{$s_l['id_s_l']}'
																				AND `id_s_v` = '{$s_v['id_s_v']}'
																				AND `trimestr_score` IS NULL
																			GROUP BY 
																				`id_fan`, `imt_author`, `total_score` 
																			HAVING 
																				COALESCE(`total_score`, 0) < 50.00 
																			ORDER BY 
																				`id_fan`;

																		");
													?>																
												
												<?php if(count($results) > 0):?>
													<?php foreach($results as $r):?>
														<tr>
															<td><?=$i;?></td>
															<td class="left"><?=getUserName($std['id'])?></td>
															<td><?=getFacultyShort($fac['id_faculty'])?></td>
															<td><?=getStudyLevel($s_l['id_s_l'])?></td>
															<td><?=getStudyView($s_v['id_s_v'])?></td>
															<td><?=$c['id_course']?></td>
															<td><?=getSpecialtyCode2($s['id_spec'])?></td>
															<td><?=getGroup($g['id_group'])?></td>
															<td class="left"><?=getFanTest($r['id_fan'])?></td>
															<td><?=$r['total_score']?></td>
															<td class="left">
																<?php if($r['total_score'] >=45):?>
																	0
																<?php else:?>
																	<?php
																		$c_f_u = getCreditiFaol($id_nt, $semestr, $r['id_fan']);
																		echo $money = round($shartnoma / 60 * $c_f_u);															
																	?>
																<?php endif?>
															</td>
															<?php $i++;?>
														</tr>
													<?php endforeach;?>
												<?php endif;?>
											<?php endforeach;?>
										<?php endforeach;?>
									<?php endforeach;?>
								<?php endforeach;?>
							<?php endforeach;?>
							<?php exit;?>
					<?php endforeach;?>
				<?php endforeach;?>
			</tbody>
		</table>
		<meta http-equiv="refresh" content="600">
	</body>
</html>