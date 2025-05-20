<div class="card">
	<div class="card-header">
		<h5><?=$page_info['title']?></h5>
	</div>
	<div class="card-block">
		<?php //$study_level = query("SELECT DISTINCT (`id_s_l`) FROM `students` WHERE `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_s_l`");?>
		<?php //foreach($study_level as $s_l):?>
			<?php //$study_view = query("SELECT DISTINCT (`id_s_v`) FROM `students` WHERE `id_s_l` = '{$s_l['id_s_l']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_s_v`");?>
			<?php //foreach($study_view as $s_v):?>
				<?php 
					$s_l['id_s_l']=1;
					$s_v['id_s_v']=1;
				?>
		
				<table class="table" style="font-size: 14px !important">
					<thead class="center">
						<tr style="background-color: #263544; color: #fff">
							<th class="counter">№</th>
							<th class="left">Ному насаб</th>
							<th>Факултет</th>
							<th>Курс</th>
							<th>Ихтисос</th>
							<th>Гуруҳ </th>
							<th>Фан</th>
							<th>Хол</th>
							<th>Маблағ</th>												
							<th>Ш/И</th>																							
						</tr>
					</thead>
					<?php $i=1;?>
					<tbody class="center" id="tbody">
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
										?>
										<?php foreach($students as $std):?>
											<?php /*$results = query("SELECT id_fan, `total_score`
																	FROM `results`
																	WHERE `id_fan` IN ($id_tests) AND `imt_score` >= '0' AND `id_student` = '{$std['id']}' AND `id_group` = '{$g['id_group']}' AND `id_spec` = '{$s['id_spec']}' AND `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND s_y = '$S_Y' AND h_y = '$H_Y' AND `id_s_l` = '{$s_l['id_s_l']}' AND `id_s_v`='{$s_v['id_s_v']}'
																	GROUP BY `id_fan`, `total_score` HAVING `total_score` < '50.00' ORDER BY `id_fan`");
											*/?>
												
											<?php $results = query("SELECT 
																		`results`.`id_fan` as `id_fan`, 
																		COALESCE(`total_score`, 0) AS `total_score`, 
																		COALESCE(`trimestr_score`, 0) AS `trimestr_score`, 
																		`imt_author`, `tests`.`imt_type` AS `imt_type`
																	FROM 
																		`results` INNER JOIN `tests` ON
																		`results`.`id_faculty` = `tests`.`id_faculty` AND
																		`results`.`id_s_l` = `tests`.`id_s_l` AND
																		`results`.`id_s_v` = `tests`.`id_s_v` AND
																		`results`.`id_course` = `tests`.`id_course` AND
																		`results`.`id_spec` = `tests`.`id_spec` AND
																		`results`.`id_group` = `tests`.`id_group` AND
																		`results`.`id_fan` = `tests`.`id_fan` AND
																		`results`.`s_y` = `tests`.`s_y` AND
																		`results`.`h_y` = `tests`.`h_y`
																	WHERE 
																		`results`.`id_fan` IN ($id_tests) 
																		AND COALESCE(`results`.`imt_score`, 0) >= 0 
																		AND `results`.`id_student` = '{$std['id']}'
																		AND `results`.`id_group` = '{$g['id_group']}'
																		AND `results`.`id_spec` = '{$s['id_spec']}'
																		AND `results`.`id_course` = '{$c['id_course']}'
																		AND `results`.`id_faculty` = '{$fac['id_faculty']}'
																		AND `results`.`s_y` = '$S_Y' 
																		AND `results`.`h_y` = '$H_Y' 
																		AND `results`.`id_s_l` = '{$s_l['id_s_l']}'
																		AND `results`.`id_s_v` = '{$s_v['id_s_v']}'
																	GROUP BY 
																		`results`.`id_fan`, 
																		`total_score`, 
																		`trimestr_score`, 
																		`imt_author`, 
																		`tests`.`imt_type` 
																	HAVING 
																		COALESCE(`total_score`, 0) < 50 
																		AND COALESCE(`trimestr_score`, 0) < 50 
																	ORDER BY 
																		`results`.`id_fan`;

																	");
											?>																
											
											<?php if(count($results) > 0):?>
												<?php foreach($results as $r):?>
													<tr>
														<td><?=$i;?></td>
														<td class="left"><?=getUserName($std['id'])?></td>
														<td><?=getFacultyShort($fac['id_faculty'])?></td>
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
																	$id_nt = query("SELECT `id_nt` FROM `std_study_groups` WHERE `id_group` = '{$g['id_group']}' AND `id_spec` = '{$s['id_spec']}' AND `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' AND `id_s_l` = '{$s_l['id_s_l']}' AND `id_s_v`='{$s_v['id_s_v']}'");
																	$id_nt = $id_nt[0]['id_nt'];
																	$semestr = getSemestr($c['id_course'], $H_Y);
																	$c_f_u = getCreditiFaol($id_nt, $semestr, $r['id_fan']);
																	$shartnoma = getSharnomaMoneyBySY($c['id_course'], $s['id_spec'], $s_l['id_s_l'], $s_v['id_s_v'], $S_Y);
																	echo $money = round($shartnoma / 60 * $c_f_u);															
																?>
															<?php endif?>
														</td>
														<td>
															<?php
																if($r['imt_type'] == 1)
																	echo "тестӣ";
																else
																	echo "шифоҳӣ";
																?>
																</td>
														<?php $i++;?>
													</tr>
												<?php endforeach;?>
											<?php endif;?>
										<?php endforeach;?>
										<?php// exit;?>
									<?php endforeach;?>
								<?php endforeach;?>
							<?php endforeach;?>
						<?php endforeach;?>
					</tbody>
				</table>
			<?php// endforeach;?>
		<?php //endforeach;?>
	</div>
</div>