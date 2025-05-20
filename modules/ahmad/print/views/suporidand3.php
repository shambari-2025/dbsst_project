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
		<!--<h3 style="text-align:center">ФОРМАИ 34(2)</h3>-->
		<table class="table transcript" style="width:100%;">
			<thead>
				<tr>
					<td rowspan="3"><div class="vertical">Факултет</div></td>
					<td rowspan="3"><div class="vertical">Буҷавӣ</div></td>
					<td rowspan="3"><div class="vertical">Шартномавӣ</div></td>
					<td rowspan="4"><div class="vertical">Квота</div></td>
					<td rowspan="3"><div class="vertical">Ҳамаги<br>донишҷуён</div></td>
					<td colspan="19" class="center">Супориданд</td>
					<td rowspan="3"><div class="vertical">Азхудкунии <br>мутлақ %</div></td>
					<td colspan="9" class="center">Баҳои ғайриқаноатбахш гирифтанд</td>
					<td rowspan="3"><div class="vertical">Абсолютная<br>успеваемость</div></td>
				</tr>
				<tr>
					<td colspan="3" class="center">Аъло</td>
					<td colspan="3" class="center">Хубу аъло</td>
					<td colspan="3" class="center">Хуб</td>
					<td rowspan="2"><div class="vertical">Сифат %</div></td>
					<td colspan="3" class="center">Омехта</td>
					<td colspan="3" class="center">Қаноатбаш</td>
					<td rowspan="2"><div class="vertical">Буҷавӣ</div></td>
					<td rowspan="2"><div class="vertical">Шартномавӣ</div></td>
					<td rowspan="2"><div class="vertical">Ҳамагӣ</div></td>
					<td colspan="2" class="center">Аз як <br>фанн</td>
					<td colspan="2" class="center">Аз ду <br>фанн</td>
					<td colspan="2" class="center">Аз се ва <br>зиёда фанн</td>
					<td rowspan="2"><div class="vertical">Ҳамагӣ</div></td>
					<td rowspan="2"><div class="vertical">Буҷавӣ</div></td>
					<td rowspan="2"><div class="vertical">Шартномавӣ</div></td>
				</tr>
				<tr>
					<td><div class="vertical">Ҳамагӣ</div></td>
					<td><div class="vertical">Буҷавӣ</div></td>
					<td><div class="vertical">Шартномавӣ</div></td>
					<td><div class="vertical">Ҳамагӣ</div></td>
					<td><div class="vertical">Буҷавӣ</div></td>
					<td><div class="vertical">Шартномавӣ</div></td>
					<td><div class="vertical">Ҳамагӣ</div></td>
					<td><div class="vertical">Буҷавӣ</div></td>
					<td><div class="vertical">Шартномавӣ</div></td>
					<td><div class="vertical">Ҳамагӣ</div></td>
					<td><div class="vertical">Буҷавӣ</div></td>
					<td><div class="vertical">Шартномавӣ</div></td>
					<td><div class="vertical">Ҳамагӣ</div></td>
					<td><div class="vertical">Буҷавӣ</div></td>
					<td><div class="vertical">Шартномавӣ</div></td>
					<td><div class="vertical">Буҷавӣ</div></td>
					<td><div class="vertical">Шартномавӣ</div></td>
					<td><div class="vertical">Буҷавӣ</div></td>
					<td><div class="vertical">Шартномавӣ</div></td>
					<td><div class="vertical">Буҷавӣ</div></td>
					<td><div class="vertical">Шартномавӣ</div></td>
				</tr>
			</thead>
			<tbody>
			<?php 
				function forma34($id_faculty, $S_Y, $H_Y, $id_s_l, $id_s_v,  $S_T = false){
					if($S_T == 1){
						$s_t = '(1)';
					}if($S_T == 2){
						$s_t = '(2,3)';
					}if(empty($S_T)){
						$s_t = '(1,2,3)';
					}
					$query = query("SELECT
											r.`id_student`,
											r.`id_faculty`,
											r.`id_course`,
											r.`id_spec`,
											r.`id_group`,
											GROUP_CONCAT(DISTINCT r.`id_fan` ORDER BY r.`id_fan` ASC) AS `id_fans`, 
											IFNULL(MIN(CASE WHEN COALESCE(r.`total_score`, 0) < 50 THEN COALESCE(r.`trimestr_score`, 0) ELSE COALESCE(r.`total_score`, 0) END), 0) AS `min`,
											IFNULL(MAX(CASE WHEN COALESCE(r.`total_score`, 0) < 50 THEN COALESCE(r.`trimestr_score`, 0) ELSE COALESCE(r.`total_score`, 0) END), 0) AS `max`
										FROM `results` r
										WHERE r.`id_faculty` = '$id_faculty' 
											AND r.`id_course` < 4
											AND r.`s_y` = '$S_Y' 
											AND r.`h_y` = '$H_Y' 
											AND r.`id_student` IN (
												SELECT DISTINCT s.`id_student`
												FROM `students` s
												WHERE s.`status` = '1' 
													AND s.`id_faculty` = '$id_faculty' 
													AND s.`id_s_l` = '$id_s_l' 
													AND s.`id_s_v` = '$id_s_v' 
													AND s.`id_course` < 4
													AND s.`id_s_t` IN $s_t
													AND s.`s_y` = '$S_Y'
													AND s.`h_y` = '$H_Y'
											)
										GROUP BY r.`id_student`, r.`id_faculty`, r.`id_course`, r.`id_spec`, r.`id_group`
										ORDER BY r.`id_faculty` ASC, r.`id_course` ASC, r.`id_spec` ASC, r.`id_group` ASC, r.`id_student` ASC
									");

				
					if(empty($query)) return false;
					
					$res['5'] = $res['45'] = $res['4'] = $res['3'] = $res['345'] = $res['fx'] = $res['f']  = 0;
					foreach($query as $item){
						
						//echo $item['min']. ' '.$item['max'];
						
						if($item['min'] >= 90 && $item['max'] < 120){
							//echo "alo";
							$res['5']++;
							$res['students']['5'][$item['id_student']]['student'] = getUserName($item['id_student']);
							$res['students']['5'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
							$res['students']['5'][$item['id_student']]['id_course'] = $item['id_course'];
							$res['students']['5'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
							
						}
						elseif($item['min'] >= 75 && $item['max'] < 90){
							//echo "xub";
							$res['4']++;
							$res['students']['4'][$item['id_student']]['student'] = getUserName($item['id_student']);
							$res['students']['4'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
							$res['students']['4'][$item['id_student']]['id_course'] = $item['id_course'];
							$res['students']['4'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
						}
						
						elseif($item['min'] >= 75 && $item['max'] < 120){
							//echo "xub/alo";
							$res['45']++;
							$res['students']['45'][$item['id_student']]['student'] = getUserName($item['id_student']);
							$res['students']['45'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
							$res['students']['45'][$item['id_student']]['id_course'] = $item['id_course'];
							$res['students']['45'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
						}elseif($item['min'] >= 50 && $item['max'] < 75){
							//echo "qanoatbaxsh";
							$res['3']++;
							$res['students']['3'][$item['id_student']]['student'] = getUserName($item['id_student']);
							$res['students']['3'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
							$res['students']['3'][$item['id_student']]['id_course'] = $item['id_course'];
							$res['students']['3'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
						}
						elseif($item['min'] >= 50 && $item['max'] < 120){
							$res['345']++;
							$res['students']['345'][$item['id_student']]['student'] = getUserName($item['id_student']);
							$res['students']['345'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
							$res['students']['345'][$item['id_student']]['id_course'] = $item['id_course'];
							$res['students']['345'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
						}
						elseif($item['min'] >= 45 && $item['min'] < 50){
							$res['fx']++;
						}
						elseif($item['min'] < 45){
							$res['f']++;
						}
					}
//											   COUNT(CASE WHEN `total_score` < 50 THEN 1 ELSE NULL END) as `count_total_score_lt_50`
					
					$qarzdorho = query("SELECT
											`id_student`,
											`id_faculty`,
											`id_course`,
											`id_spec`,
											`id_group`,
											COUNT(CASE WHEN COALESCE(`total_score`, 0) < 50 AND COALESCE(`trimestr_score`, 0) < 50 THEN 1 ELSE NULL END) as `count_total_score_lt_50`
										FROM
											`results`
										WHERE
											`id_faculty` = '$id_faculty'
											AND `id_course` < 4
											AND `s_y` = '$S_Y'
											AND `h_y` = '$H_Y'
											AND `id_student` IN (
												SELECT DISTINCT `id_student`
												FROM `students`
												WHERE
													`status` = '1'
													AND `id_faculty` = '$id_faculty'
													AND `id_s_l` = '$id_s_l'
													AND `id_s_v` = '$id_s_v'
													AND `id_course` < 4
													AND `id_s_t` IN $s_t
													AND `s_y` = '$S_Y'
													AND `h_y` = '$H_Y'
											)
										GROUP BY
											`id_student`, `id_faculty`, `id_course`, `id_spec`, `id_group`  
										HAVING  `count_total_score_lt_50` > 0


										");
					$res['qarz1fan'] = $res['qarz2fan'] = $res['qarz3fan'] = 0;
					foreach($qarzdorho as $q){
						if($q['count_total_score_lt_50'] == 1){
							$res['qarz1fan']++; 
						}if($q['count_total_score_lt_50'] == 2){
							$res['qarz2fan']++;
						}if($q['count_total_score_lt_50'] >= 3){
							$res['qarz3fan']++;
						}
					}

						
					//print_arr($res);
					//exit;
					return $res;
				}
				
			?>
			<?php
				$un_buj = $un_sh = $un_kv = $un_all = $un5 = $un_buj5 = $un_sh5 = $un45 = $un_buj45 = $un_sh45 = $un4 = $un_buj4 = $un_sh4 = $un345 = $un_buj345 = $un_sh345 = $un3 = $un_buj3 = $un_sh3 = $unsup = $unsup_b = $unsup_sh = $un1_b = $un1_sh = $un2_b = $un2_sh = $un3_b = $un3_sh = $unnas = $unnas_b = $unnas_sh = 0;
			?>
				<?php if(isset($_SESSION['user']['admin'])):?>
					<?php $S_R = $_SESSION['superarr'];?>
				<?php else:?>
					<?php $S_R = $_SESSION['students'];?>
				<?php endif;?>
				<?php foreach($S_R as $fac):?>
					<?php if($fac['id'] != 7):?>
						<?php $res_all = forma34($fac['id'], $S_Y, $H_Y, $id_s_l, $id_s_v)?>
						<?php $res_bujavi = forma34($fac['id'], $S_Y, $H_Y, $id_s_l, $id_s_v, 2)?>
						<?php $res_shartnomavi = forma34($fac['id'], $S_Y, $H_Y, $id_s_l, $id_s_v, 1)?>
						<tr class="center">
							<td class="left"><?=$fac['short'];?></td>
							<td>
								<?php
									echo $buj = count_table_where("students", "`status` = '1' AND `id_faculty` = '{$fac['id']}' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` < 4 AND `id_s_t` = '2' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
									$un_buj += $buj;
								?>
							</td>
							<td>
								<?php
									echo $shart = count_table_where("students", "`status` = '1' AND `id_faculty` = '{$fac['id']}' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` < 4 AND `id_s_t` = '1' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
									$un_sh +=$shart;
								?>
							</td>
							<td>
								<?php
									echo $kv = count_table_where("students", "`status` = '1' AND `id_faculty` = '{$fac['id']}' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` < 4 AND `id_s_t` = '3' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
									$un_kv += $kv;
								?>
							</td>
							<td>
								<?php
									echo @$all_stds = count_table_where("students", "`status` = '1' AND `id_faculty` = '{$fac['id']}' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` < 4 AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
									$un_all += @$all_stds;								
								?>
							</td>
							<td>
								<?php
									echo @$res_all['5'];
									$un5 += @$res_all['5'];
								?>					
							</td>	
							<td>
								<?php
									echo @$res_bujavi['5'];
									$un_buj5 +=@$res_bujavi['5'];
								?>
							</td>	
							<td>
								<?php
									echo @$res_shartnomavi['5'];
									$un_sh5 +=@$res_shartnomavi['5'];
								?>
							</td>	
							<td>
								<?php
									echo @$res_all['45'];
								//	print_arr($res_all['students']['45']);
									$un45 += @$res_all['45'];	
								?>
							</td>	
							<td>
								<?php
									echo @$res_bujavi['45'];
									$un_buj45 +=@$res_bujavi['45'];
								?>
							</td>	
							<td>
								<?php 
									echo @$res_shartnomavi['45'];
									$un_sh45 += @$res_shartnomavi['45'];
								?>
							</td>								
							<td>
								<?php
									echo @$res_all['4'];
								//	print_arr($res_all['students']['4']);
									$un4 += @$res_all['4'];
								?>
							</td>	
							<td>
								<?php
									echo @$res_bujavi['4'];
									$un_buj4 += @$res_bujavi['4'];
								?>
							</td>	
							<td>
								<?php
									echo @$res_shartnomavi['4'];
									$un_sh4 += @$res_shartnomavi['4'];
								?>
							</td>	
							<td>
								<?php
									echo round(($sifat = (@$res_all['5'] + @$res_all['45'] + @$res_all['4']) / @$all_stds * 100),1);
								?>
							</td>
							<td>
								<?php
									echo @$res_all['345'];
									$un345 += @$res_all['345'];
									//print_arr($res_all['students']['345']);
								?>
							</td>	
							<td>
								<?php 
									echo @$res_bujavi['345'];
									$un_buj345 += @$res_bujavi['345'];
								?>
							</td>	
							<td>
								<?php
									echo @$res_shartnomavi['345'];
									$un_sh345 += @$res_shartnomavi['345'];
								?>
							</td>	
							<td>
								<?php
									echo @$res_all['3'];
									//print_arr($res_all['students']['3']);
									$un3 += @$res_all['3'];
								?>
							</td>	
							<td>
								<?php
									echo @$res_bujavi['3'];
									$un_buj3 += @$res_bujavi['3'];	
								?>
							</td>	
							<td>
								<?php
									echo @$res_shartnomavi['3'];
									$un_sh3 += @$res_shartnomavi['3'];
								?>
							</td>
							<td>
								<?php
									echo @($res_bujavi['5'] + $res_bujavi['45'] + $res_bujavi['4'] + $res_bujavi['345'] + $res_bujavi['3']);
									$unsup_b += @($res_bujavi['5'] + $res_bujavi['45'] + $res_bujavi['4'] + $res_bujavi['345'] + $res_bujavi['3']);
								?>
							</td>	
							<td>
								<?php
									echo @($res_shartnomavi['5'] + $res_shartnomavi['45'] + $res_shartnomavi['4'] + $res_shartnomavi['345'] + $res_shartnomavi['3']) ;
									$unsup_sh += @($res_shartnomavi['5'] + $res_shartnomavi['45'] + $res_shartnomavi['4'] + $res_shartnomavi['345'] + $res_shartnomavi['3']);
								?>
							</td>	
							<td>
								<?php
									echo @($res_all['5'] + $res_all['45'] + $res_all['4'] + $res_all['345'] + $res_all['3']) ;
									$unsup += @($res_all['5'] + $res_all['45'] + $res_all['4'] + $res_all['345'] + $res_all['3']) ;
								?>
							</td>	
							<!--<td><?=getSuporid($fac['id'], 2, $id_s_l, $id_s_v)?></td>
							<td><?=getSuporid($fac['id'], 1, $id_s_l, $id_s_v)?></td>
							<td><?=getSuporid($fac['id'], 3, $id_s_l, $id_s_v)?></td>-->
							<td>
								<?php
									echo round(($az_mutlaq = (@$res_all['5'] + @$res_all['45'] + @$res_all['4'] + @$res_all['345'] + @$res_all['3']) / $all_stds * 100),1) ;
								?>
							</td>
							<td>
								<?php
									echo @$res_bujavi['qarz1fan'];
									$un1_b += @$res_bujavi['qarz1fan'];
								?>
							</td>
							<td>
								<?php
									echo @$res_shartnomavi['qarz1fan'];
									$un1_sh += @$res_shartnomavi['qarz1fan'];
								?>
							</td>
							<td>
								<?php
									echo @$res_bujavi['qarz2fan'];
									$un2_b += @$res_bujavi['qarz2fan'];
								?>
							</td>
							<td>
								<?php
									echo @$res_shartnomavi['qarz2fan'];
									$un2_sh += @$res_shartnomavi['qarz2fan'];
								?>
							</td>			
							<td>
								<?php
									echo @$res_bujavi['qarz3fan'];
									$un3_b += @$res_bujavi['qarz3fan'];
								?>
							</td>
							<td>
								<?php 
									echo @$res_shartnomavi['qarz3fan'];
									$un3_sh += @$res_shartnomavi['qarz3fan'];
								?>
							</td>
							<td>
								<?php
									echo @$res_all['f']+@$res_all['fx'];
									$unnas += @$res_all['f']+@$res_all['fx'];
								?>
							</td>	
							<td>
								<?php
									echo @$res_bujavi['f']+@$res_bujavi['fx'];
									$unnas_b += @$res_bujavi['f']+@$res_bujavi['fx'];
								?>
							</td>	
							<td>
								<?php 
									echo @$res_shartnomavi['f']+@$res_shartnomavi['fx'];
									$unnas_sh += @$res_shartnomavi['f']+@$res_shartnomavi['fx'];
								?>
							</td>	
							<td></td>
						</tr>
					<?php endif;?>
				<?php //exit;?>	
				<?php endforeach;?>
					
				<tr class="bold center">
					<td>Ҳамагӣ дар Донишгоҳ</td>
					<td><?=$un_buj?></td>
					<td><?=$un_sh?></td>
					<td><?=$un_kv?></td>
					<td><?=$un_all?></td>
					<td><?=$un5?></td>
					<td><?=$un_buj5?></td>
					<td><?=$un_sh5?></td>
					<td><?=$un45?></td>
					<td><?=$un_buj45?></td>
					<td><?=$un_sh45?></td>
					<td><?=$un4?></td>
					<td><?=$un_buj4?></td>
					<td><?=$un_sh4?></td>
					<td><?=round(($un5+$un45+$un4)/$un_all*100,1)?></td>
					<td><?=$un345?></td>
					<td><?=$un_buj345?></td>
					<td><?=$un_sh345?></td>
					<td><?=$un3?></td>
					<td><?=$un_buj3?></td>
					<td><?=$un_sh3?></td>
					<td><?=$unsup_b?></td>
					<td><?=$unsup_sh?></td>
					<td><?=$unsup?></td>
					<td><?=round(($unsup / $un_all * 100), 1)?></td>
					<td><?=$un1_b?></td>
					<td><?=$un1_sh?></td>
					<td><?=$un2_b?></td>
					<td><?=$un2_sh?></td>
					<td><?=$un3_b?></td>
					<td><?=$un3_sh?></td>
					<td><?=$unnas?></td>
					<td><?=$unnas_b?></td>
					<td><?=$unnas_sh?></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</body>
</html>