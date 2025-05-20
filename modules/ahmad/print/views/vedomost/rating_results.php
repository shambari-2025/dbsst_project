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
	
	<style>
		* {
			font-family: "Palatino Linotype";
		}
		p {
			margin: 0;
			padding: 4px;
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
		<div class="col-xl-12 col-md-12">
			<div class="card-block">
			<!--	<a href="<?=MY_URL?>?option=print&action=rating_results<?php if(isset($id_faculty)):?>&id_faculty=<?=$id_faculty?><?php endif;?>&s_y=23&h_y=1">
					Соли таҳсили 2023-2024 нимсолаи 1
				</a>
				<br><br>
				<a href="<?=MY_URL?>?option=print&action=rating_results<?php if(isset($id_faculty)):?>&id_faculty=<?=$id_faculty?><?php endif;?>&s_y=23&h_y=2">
					Соли таҳсили 2023-2024 нимсолаи 2
				</a>
				<br><br>
				
				<a href="<?=MY_URL?>?option=print&action=rating_results<?php if(isset($id_faculty)):?>&id_faculty=<?=$id_faculty?><?php endif;?>&s_y=23&h_y=2">
					Соли таҳсили 2024-2025 нимсолаи 1
				</a>
				<br><br>
			</div>-->
		</div>
		
		
		<h2 class="center">Натиҷаҳо дар соли таҳсили 20<?=$S_Y?>-20<?=$S_Y+1?>, нимсолаи <?=$H_Y?></h2>
		
		<div class="floatleft">
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th>№</th>
						<th>Факулта</th>
						<th>Курс</th>
						<th>Гуруҳ</th>
						<th>Ҳамаги</th>
						<th>Супорид Р1</th>
						<th>% Р1</th>
						<th>Насупорид Р1</th>
						<th>% Р1</th>
						
						<th>Супорид Р2</th>
						<th>% Р2</th>
						<th>Насупорид Р2</th>
						<th>% Р2</th>
						
						<th>Имтиҳон</th>
						<th>% ИМТ</th>
						
						<th>Фан</th>
						<th>Омӯзгор(он)</th>
					</tr>
				</thead>
				<tbody>
					<?php $datas = [];?>
					
					<?php $counter = $hamagi_s = $hamagi_s2 = $hamagi_imt = $total_stds = $total_stds_suporidand = $total_stds_suporidand2 = $total_stds_suporidand_imt = 0;?>
					<?php //print_arr($groups);?>
					<?php foreach($groups as $g_item):?>
						<?php $id_faculty = $g_item['id_faculty']?>
						<?php $id_s_l = $g_item['id_s_l']?>
						<?php $id_s_v = $g_item['id_s_v']?>
						<?php $id_course = $g_item['id_course']?>
						<?php $id_spec = $g_item['id_spec']?>
						<?php $id_group = $g_item['id_group']?>
						<?php $id_nt = $g_item['id_nt']?>
						<?php $h_y = $g_item['h_y']?>
						<?php $students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, $S_Y, $H_Y)?>
						<?php $total_stds += $std_count = count($students)?>
						<?php //$total_stds += $std_count = $g_item['std_count']?>
						
						<?php $semestr = getSemestr($id_course, $h_y);?>
						
						
						
						<?php $n = next($groups)?>
						
						<?php if(!empty($n)):?>
							<?php $n_id_course = $n['id_course'];?>
						<?php endif;?>
						
						<?php
						$fanlist = query("
						SELECT
							`nt_content`.*,
							`iqtibosho`.*
						FROM
							`iqtibosho`
						INNER JOIN `nt_content` ON `nt_content`.`id_nt` = `iqtibosho`.`id_nt` 
						AND `nt_content`.`id_fan` = `iqtibosho`.`id_fan`
						AND `nt_content`.`semestr` = `iqtibosho`.`semestr`
						AND `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$semestr'
						WHERE `iqtibosho`.`s_y` = '$S_Y' AND `nt_content`.`id_fan` != 1748 AND
							`iqtibosho`.`id_group` = '$id_group';
						");?>
						
						<?php if(!empty($fanlist)):?>
							<?php $total_in_group = $total_in_group2 = $total_in_group_imt = 0; ?>
							<?php $counter_fan = 0;?>
							<?php foreach($fanlist as $f_item):?>
								<?php $id_fan = $f_item['id_fan']?>
								<?php if(!in_array($id_fan, NOT_RATING)):?>
								<tr>
									<td class="center" style="width: 20px"><?=++$counter_fan?></td>
									<td class="center">
										<?=getFacultyShort($id_faculty)?>
									</td>
									<td class="center"><?=$id_course?></td>
									<td class="center"><?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group)?></td>
									<td class="center"><?=$std_count?><?php// if($id_spec==5){print_arr($g_item);}?></td>
									<td class="center">
										<?php
											//Супориданд
											$res_count = count_table_where("results", 
											"(IFNULL(`nf_1_score`,0) + IFNULL(`nf_1_absent`,0)+IFNULL(`nf_1_score_r`, 0)) > 50 AND
											`id_faculty` = '$id_faculty' AND 
											`id_s_l` = '$id_s_l' AND 
											`id_s_v` = '$id_s_v' AND 
											`id_spec` = '$id_spec' AND 
											`id_course` = '$id_course' AND 
											`id_group` = '$id_group' AND 
											`id_fan` = '$id_fan' AND
											`s_y` = '$S_Y' AND
											`h_y` = '$H_Y'
											");
										?>
										
										<?php $hamagi_s += $res_count?>
										<?php $total_in_group += $res_count?>
										<?=$res_count?>
									</td>
									<td class="center"><?=round($res_count/$std_count * 100, 2)?> %</td>
									<td class="center"><?=$nas = $std_count-$res_count?></td>
									<td class="center"><?=round($nas/$std_count * 100, 2)?> %</td>
									<td class="center">
										<?php
											//Супориданд
											$res_count2 = count_table_where("results", 
											"(IFNULL(`nf_2_score`,0) + IFNULL(`nf_2_absent`,0)+IFNULL(`nf_2_score_r`, 0)) > 50 AND
											`id_faculty` = '$id_faculty' AND 
											`id_s_l` = '$id_s_l' AND 
											`id_s_v` = '$id_s_v' AND 
											`id_spec` = '$id_spec' AND 
											`id_course` = '$id_course' AND 
											`id_group` = '$id_group' AND 
											`id_fan` = '$id_fan' AND
											`s_y` = '$S_Y' AND
											`h_y` = '$H_Y'
											");
										?>
										
										<?php $hamagi_s2 += $res_count2?>
										<?php $total_in_group2 += $res_count2?>
										<?=$res_count2?>
									</td>
									<td class="center"><?=round($res_count2/$std_count * 100, 2)?> %</td>
									<td class="center"><?=$nas = $std_count-$res_count2?></td>
									<td class="center"><?=round($nas/$std_count * 100, 2)?> %</td>
									
									<td class="center">
										<?php
											//Супориданд
											$res_count_imt = query("
											SELECT *, IFNULL(IF(`results`.`total_score` IS NULL, 0, `results`.`total_score`), 0) as `total_score` 
											FROM `results` WHERE 
											`id_faculty` = '$id_faculty' AND 
											`id_s_l` = '$id_s_l' AND 
											`id_s_v` = '$id_s_v' AND 
											`id_spec` = '$id_spec' AND 
											`id_course` = '$id_course' AND 
											`id_group` = '$id_group' AND 
											`id_fan` = '$id_fan' AND
											`s_y` = '$S_Y' AND
											`h_y` = '$H_Y'
											HAVING `total_score` >= 50.00 
											");
											
											
										?>
										
										<?php $hamagi_imt += count($res_count_imt)?>
										<?php $total_in_group_imt += count($res_count_imt)?>
										<?=count($res_count_imt)?>
									</td>
									<td class="center"><?=round(count($res_count_imt)/$std_count * 100, 2)?> %</td>
									
									
									<td>
										<?=getFanTest($f_item['id_fan'])?> 
									</td>
									<td>
										<?php
											$id_iqtibos = $f_item['id'];
											$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
											foreach($teachers as $teacher){
												echo getUserName($teacher['id_teacher'])."<br>";
											}
										?>
									</td>
								</tr>
							<?php //exit;?>
								
								<?php endif;?>
							<?php endforeach;?>
							<tr class="center bold" style="background: yellow">
								<td colspan="4"><?=++$counter?>.  <?=getFacultyShort($id_faculty)?> - Курси <?=$id_course?> - <?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group)?></td>
								<td>
									<?=$std_count?>
								</td>
								
								<td>
									<?php $total_stds_suporidand += $srznach_suporidand = floor($total_in_group / $counter_fan) ?>
									<?=$srznach_suporidand?>
								</td>
								
								<td><?=round($srznach_suporidand / $std_count * 100, 2 )?> %</td>
								<td></td>
								<td></td>
								<td>
									<?php $total_stds_suporidand2 += $srznach_suporidand2 = floor($total_in_group2 / $counter_fan) ?>
									<?=$srznach_suporidand2?>
								</td>
								
								<td><?=round($srznach_suporidand2 / $std_count * 100, 2 )?> %</td>
								
								<td>
									<?php $total_stds_suporidand_imt += $srznach_suporidand_imt = floor($total_in_group_imt / $counter_fan) ?>
									<?=$srznach_suporidand_imt?>
								</td>
								
								<td><?=round($srznach_suporidand_imt / $std_count * 100, 2 )?> %</td>
								
								<td colspan="2"></td>
								
							</tr>
							<?php// exit;?>
							
							
							
							<?php if($id_course != $n_id_course || $counter == count($groups)):?>
								
								<?php 
								$datas[$id_course]['id_course'] = $id_course;
								$datas[$id_course]['total_stds'] = $total_stds;
								$datas[$id_course]['total_stds_suporidand'] = $total_stds_suporidand;
								$datas[$id_course]['total_stds_suporidand2'] = $total_stds_suporidand2;
								$datas[$id_course]['total_stds_suporidand_imt'] = $total_stds_suporidand_imt;
								$datas[$id_course]['persent'] = round($total_stds_suporidand / $total_stds * 100, 2 );
								$datas[$id_course]['persent2'] = round($total_stds_suporidand2 / $total_stds * 100, 2 );
								$datas[$id_course]['persent_imt'] = round($total_stds_suporidand_imt / $total_stds * 100, 2 );
								?>
								
								<tr class="center bold" style="background: green; color: #fff">
									<td colspan="4">Ҳамаги дар <?=getFacultyShort($id_faculty)?> дар курси <?=$id_course?></td>
									<td><?=$total_stds?></td>
									<td><?=$total_stds_suporidand?></td>
									<td><?=round($total_stds_suporidand / $total_stds * 100, 2 )?> %</td>
									
									<td><?=$total_stds_suporidand2?></td>
									<td><?=round($total_stds_suporidand2 / $total_stds * 100, 2 )?> %</td>
									
									<td><?=$total_stds_suporidand_imt?></td>
									<td><?=round($total_stds_suporidand_imt / $total_stds * 100, 2 )?> %</td>
									
									
									<td colspan="2"></td>
								</tr>
								
								<?php $total_stds = $total_stds_suporidand = $total_stds_suporidand2 = $total_stds_suporidand_imt = 0?>
							<?php endif;?>
							
						<?php else:?>
							<tr class="center bold" style="background: red; color: #fff">
								<td colspan="9"><?=++$counter?>.  <?=getFacultyShort($id_faculty)?> - Курси <?=$id_course?> - <?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group)?> - Фанҳо ёфт нашуданд!</td>
							</tr>
						<?php endif;?>
						
						
						
					<?php endforeach;?>
					
					<tr>
						<td colspan="9"><p></p></td>
					</tr>
					
					<?php if(isset($id_faculty)):?>
						<?php $t_std = $t_sdt_s = $t_sdt_s2 = $t_sdt_s_imt = 0?>
						<?php foreach($datas as $item):?>
							<?php $t_std += $item['total_stds']?>
							<?php $t_sdt_s += $item['total_stds_suporidand']?>
							<?php $t_sdt_s2 += $item['total_stds_suporidand2']?>
							<?php $t_sdt_s_imt += $item['total_stds_suporidand_imt']?>
							<tr class="center bold">
								<td colspan="4">Ҳамаги дар курси <?=$item['id_course']?></td>
								<td><?=$item['total_stds']?></td>
								<td><?=$item['total_stds_suporidand']?></td>
								<td><?=$item['persent']?> %</td>
								
								<td><?=$item['total_stds_suporidand2']?></td>
								<td><?=$item['persent2']?> %</td>
								
								<td><?=$item['total_stds_suporidand_imt']?></td>
								<td><?=$item['persent_imt']?> %</td>
							</tr>
						<?php endforeach;?>
						<tr class="center bold" style="background: green; color: #fff">
							<td colspan="4">Ҳамаги дар факултет</td>
							<td><?=$t_std?></td>
							<td><?=$t_sdt_s?></td>
							<td><?=round($t_sdt_s / $t_std * 100, 2 )?> %</td>
							
							<td><?=$t_sdt_s2?></td>
							<td><?=round($t_sdt_s2 / $t_std * 100, 2 )?> %</td>
							
							<td><?=$t_sdt_s_imt?></td>
							<td><?=round($t_sdt_s_imt / $t_std * 100, 2 )?> %</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			
			<br>
			<br>
			<!--Ҳамаги супориданд <?=$hamagi_s?>-->
			<br>
		</div>
	</body>
	
</html>