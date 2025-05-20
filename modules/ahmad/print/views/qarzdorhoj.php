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
		
		<?php $study_level = query("SELECT DISTINCT (`id_s_l`) FROM `students` WHERE `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_s_l`");?>
		<?php foreach($study_level as $s_l):?>
			<?php $study_view = query("SELECT DISTINCT (`id_s_v`) FROM `students` WHERE `id_s_l` = '{$s_l['id_s_l']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_s_v`");?>
			<?php foreach($study_view as $s_v):?>
				<!--<p style="text-align: center;font-size: 30px;font-weight: bold;"> Зинаи "<?=getStudyLevel($s_l['id_s_l'])?>" (<?=getStudyView($s_v['id_s_v'])?>)</p>-->
				<p style="text-align:center;font-size: 30px;font-weight: bold;">Донишҷӯёни қарзи академи доштаи <?=UNI_NAME?> аз нимсолаи <?=$H_Y?> соли таҳсили  <?=getStudyYear($S_Y)?></p>
				<?php 
					$i = 0;
					$cf = 1;
					$s_l['id_s_l']=1;
					$s_v['id_s_v']=1;
				?>
				<table class="table transcript" style="width:100%;">
					<tr class="center" style="font-weight:bold;">
						<td>№</td>
						<td>№№</td>
						<td>Фак</td>
						<td>Курс</td>
						<td>Ихтисос/<br>гуруҳ</td>
						<td>Ному насаб</td>
						<td>Миқдори <br>фан(ҳо)</td>
						<td>Супорид</td>
						<td>Фан(ҳо)</td>
						<td>Кр.</td>
						<td>Баҳо</td>
						<td>Маблағ</td>
					</tr>
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
									<?php $j=0;?>
									<?php 
										$id_nt = getNT($fac['id_faculty'], $s_l['id_s_l'], $s_v['id_s_v'], $c['id_course'], $s['id_spec'], $g['id_group'], $S_Y, $H_Y);
										$semestr = getSemestr($c['id_course'], $H_Y);
									?>
									<?php foreach($students as $std):?>
										<?
										?>
										<?php /*$results = query("SELECT id_fan, `total_score`
																FROM `results`
																WHERE `id_fan` IN ($id_tests) AND `imt_score` >= '0' AND `id_student` = '{$std['id']}' AND `id_group` = '{$g['id_group']}' AND `id_spec` = '{$s['id_spec']}' AND `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND s_y = '$S_Y' AND h_y = '$H_Y' AND `id_s_l` = '{$s_l['id_s_l']}' AND `id_s_v`='{$s_v['id_s_v']}'
																GROUP BY `id_fan`, `total_score` HAVING `total_score` < '50.00' ORDER BY `id_fan`");
										*/?>
																
										<?php $results = query("SELECT 
																		`id_fan`, 
																		COALESCE(`total_score`, 0) AS `total_score` 
																	FROM 
																		`results` 
																	WHERE 
																		`id_fan` IN ($id_tests) 
																		AND `id_student` = '{$std['id']}'
																		AND `id_group` = '{$g['id_group']}'
																		AND `id_spec` = '{$s['id_spec']}'
																		AND `id_course` = '{$c['id_course']}'
																		AND `id_faculty` = '{$fac['id_faculty']}'
																		AND `s_y` = '$S_Y' 
																		AND `h_y` = '$H_Y' 
																		AND `id_s_l` = '{$s_l['id_s_l']}'
																		AND `id_s_v` = '{$s_v['id_s_v']}'
																	GROUP BY 
																		`id_fan`, `total_score`, `trimestr_score` 
																	HAVING 
																		COALESCE(`total_score`, 0) < 50 AND
																		COALESCE(`trimestr_score`, 0) < 50 
																	ORDER BY 
																		`id_fan`;

																");
										?>							
										
										
										
										<?php if(count($results) > 0):?>
										<?php $j++; $i++;?>
											<tr>
												<td rowspan="<?=count($results)?>">
													<?=$i.".";?>
												</td>
												<td rowspan="<?=count($results)?>">
													<?=$j.".";?>
												</td>
												<td rowspan="<?=count($results)?>">
													<?=getFacultyShort($fac['id_faculty']);?>
												</td>
												<td rowspan="<?=count($results)?>">
													<?=$c['id_course'];?>
												</td>
												<td rowspan="<?=count($results)?>">
													<?=getSpecialtyCode($s['id_spec']);?><?=getGroup($g['id_group'])?>
												</td>
												<td rowspan="<?=count($results)?>">
													<?=getUserName($std['id']);?>
												</td>
												<td rowspan="<?=count($results)?>" style="text-align:center;">
													<?=count($results)?>
												</td>
												<td rowspan="<?=count($results)?>" style="text-align:center;">
													<?php
														$today = date('Y-m-d');
														$pardoxtho = query("SELECT SUM(`check_money`) as `sum` FROM `rasidho` 
																			WHERE `id_student` = '{$std['id']}' AND 
																				`type` = '11' AND
																				`check_date` > '2025-01-13' AND 
																				`check_date` <= '$today'
																		");
														echo $pardoxtho[0]['sum'];
													?>
												</td>
												<?php foreach($results as $item):?>
													<td>
														<?=getFanTest($item['id_fan'])?>
													</td>
													<?php 
														$credit = getCreditiFaol($id_nt, $semestr, $item['id_fan']);
														$xoriji  = query("SELECT `foreign` FROM `students` WHERE `id_student` = '{$std['id']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
														$xoriji = $xoriji[0]['foreign'];
														if($xoriji)
															$xoriji = 'xoriji';
														$shartnoma = getSharnomaMoneyBySY($c['id_course'], $s['id_spec'], $s_l['id_s_l'], $s_v['id_s_v'], $S_Y, $xoriji);
													?>
													<td style="text-align:center;"><?=$credit;?></td>
													<td style="text-align:center;"><?=getLatter($item['total_score'])?></td>
													<td style="text-align:center;">
														<?php if($item['total_score']<45):?>
															<?=$credit * 64?>
														<?php else:?>
															0
														<?php endif;?>
													</td>
													</tr>
													<?php $cf++;?>
												<?php endforeach;?>
												<?php //exit;?>
											</tr>
										<?php endif;?>
									<?php endforeach;?>
								<?php endforeach;?>
							<?php endforeach;?>
						<?php endforeach;?>
					<?php endforeach;?>
				</table>
				<br><br>
				Шумораи умумии донишҷӯёни қарздор дар зинаи <?=getStudyLevel($s_l['id_s_l'])?>, намуди таҳсили <?=getStudyView($s_v['id_s_v'])?> <?=$i?>-нафар.<br> 
				Миқдори  умумии фанҳои қарздоршудаи донишҷӯён <?=$cf?>
				<?php// echo $cf;?>
				<br>
				<?php exit;?>
				<?php endforeach;?>
			<?php endforeach;?>
		  <meta http-equiv="refresh" content="600">
	</body>
</html>