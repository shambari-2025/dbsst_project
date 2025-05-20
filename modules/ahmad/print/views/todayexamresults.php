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
		<h4 class="bold center"><?=$page_info['title']?></h4>
		<?php// print_arr($rasidho);?>
		<table class="table transcript"  style="font-size: 14px !important">
			<thead>
				<tr>
					<th>№</th>
					<th>Факулетет</th>
					<th>Зинаи таҳсил/Шакли таҳсил</th>
					<th>Курс</th>
					<th>Гуруҳ</th>
					<th>Номи фан</th>
					<th>Ному насаби омузгор</th>
					<th>Таърихи рузи имтиҳон</th>
					<th>Шакли қабули имтиҳон (тестӣ-шифоҳӣ)</th>
					<th>Шумораи донишҷӯён</th>
					<th>Шумораи донишҷӯёни дар имтиҳон иштирок карда</th>
					<th>Шумораи донишҷӯёни холи заруриро гирифта</th>
					<th>Фоизи азхудкунӣ %</th>
					<th>Эзоҳ (камбудиҳо ва пешниҳодҳо).</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;?>
				<?php foreach($tests as $item):?>
					<?php
						$id_faculty = $item['id_faculty'];
						$id_s_l = $item['id_s_l'];
						$id_s_v = $item['id_s_v'];
						$id_course= $item['id_course'];
						$id_spec= $item['id_spec'];
						$id_group= $item['id_group'];
						$id_fan = $item['id_fan'];
						$s_y = $item['s_y'];
						$h_y = $item['h_y'];
					?>
					<tr>
						<td class="center"><?=$i?>.</td>
						<td class="center"><?=getFacultyShort($id_faculty)?></td>
						<td class="center"><?=getStudyLevel($id_s_l)?>, <?=getStudyView($id_s_v)?></td>
						<td class="center"><?=$id_course?></td>
						<td class="center"><?=getSpecialtyCode($id_spec)?> <?=getGroup($id_group)?></td>
						<td><?=getFanTest($id_fan)?></td>
						<td>
							<?php
								$teacher = query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '{$item['id_iqtibos']}'");
								echo getUserName($teacher[0]['id_teacher']);
							?>
						</td>
						<td class="center"><?=date('d.m.Y', strtotime($item['datetime']))?></td>
						<td class="center"><?=$imt_types[$item['imt_type']]?></td>
						<td class="center">
							<?php 
								$students = query("SELECT DISTINCT(`id_student`) FROM `students` 
													WHERE  `status` = '1' AND 
														`id_faculty` = '$id_faculty' AND
														`id_s_l` = '$id_s_l' AND 
														`id_s_v` = '$id_s_v' AND
														`id_course` = '$id_course' AND
														`id_spec` = '$id_spec' AND 
														`id_group` = '$id_group' AND 
														`s_y` = '$s_y' AND 
														`h_y` = '$h_y'");
								echo $stds = count($students);
							?>
						</td>
						<td class="center">
							<?php
								echo $ishtirok = count_table_where("results", "`id_faculty` = '$id_faculty' AND 
																			`id_s_l` = '$id_s_l' AND 
																			`id_s_v` = '$id_s_v' AND 
																			`id_course` = '$id_course' AND 
																			`id_spec` = '$id_spec' AND 
																			`id_group` = '$id_group' AND 
																			`id_fan` = '$id_fan' AND 
																			`imt_score` IS NOT NULL AND
																			`s_y` = '$s_y' AND 
																			`h_y` = '$h_y'
															");
							?>
						</td>
						<td class="center">
							<?php
								echo $bahogirifta = count_table_where("results", "`id_faculty` = '$id_faculty' AND 
																			`id_s_l` = '$id_s_l' AND 
																			`id_s_v` = '$id_s_v' AND 
																			`id_course` = '$id_course' AND 
																			`id_spec` = '$id_spec' AND 
																			`id_group` = '$id_group' AND 
																			`id_fan` = '$id_fan' AND 
																			`total_score` >=50 AND
																			`s_y` = '$s_y' AND 
																			`h_y` = '$h_y'
															");
							?>
						</td>
						<td class="center"><?=@round($bahogirifta / $stds * 100, 1)?></td>
						<td></td>
					</tr>
					<?php //exit;?>
					<?phpif($id_faculty == 2) {exit;}?>
					<?php $i++;?>
				<?php endforeach;?>
			</tbody>
		</table>		
	</body>
	
</html>