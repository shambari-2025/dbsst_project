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

			</div>
		</div>
		
		
		<h2 class="center"><?=$page_info['title']?></h2>
		
		<div class="floatleft">
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th>Ному насаби омузгор</th>
						<th>Номгуи фанҳо</th>
						<th>Курс</th>
						<th>Ихтисос</th>
						<th style="transform-origin: center; transform: rotate(180deg);writing-mode: vertical-rl; height: 150px;">Миқдори <br>донишҷӯён</th>
						<th style="transform-origin: center; transform: rotate(180deg);writing-mode: vertical-rl; height: 150px;">Миқдори КМД қабулшуда аз ҷониби омӯзгор</th>
						<th style="transform-origin: center; transform: rotate(180deg);writing-mode: vertical-rl; height: 150px;">Тафтиш дар кафедра</th>
					</tr>
				</thead>
				<tbody>
					<?php $cafedraho = query("SELECT DISTINCT(`id_departament`) FROM `iqtibosho` WHERE `s_y` = '".S_Y."' AND `semestr` IN (".SEMESTRS.") AND `id_departament` IS NOT NULL");?>
					<?php foreach($cafedraho  as $cafedra):?>
						<?php $id_cafedra = $cafedra['id_departament'];?>
						<tr>
							<td colspan="7" style="text-align: center; background-color: #98d798;"><?=getDepartament($id_cafedra)?></td>
						</tr>
						<?php $teachers = query("SELECT DISTINCT(`id_teacher`) FROM `sarboriho` 
													WHERE `id_iqtibos` IN (SELECT `id` FROM `iqtibosho` 
																				WHERE `id_departament` = '$id_cafedra' AND
																						`s_y` = '".S_Y."' AND 
																						`semestr` IN (".SEMESTRS."))
													")
						?>
						<?php foreach($teachers as $teacher):?>
							<?php 
								$id_teacher = $teacher['id_teacher'];
								$fanho = query("SELECT `iqtibosho`.*, `sarboriho`.* FROM `iqtibosho` INNER JOIN `sarboriho` 
													ON `iqtibosho`.`id` = `sarboriho`.`id_iqtibos` 
													WHERE `sarboriho`.`id_teacher` = '$id_teacher' AND
														`sarboriho`.`type` = 'lk_plan' AND 
														`iqtibosho`.`s_y` = '".S_Y."' AND 
														`iqtibosho`.`semestr` IN(".SEMESTRS.") AND 
														`iqtibosho`.`id_departament` = '$id_cafedra'
													ORDER BY `iqtibosho`.`id_faculty` ASC,
														`iqtibosho`.`id_s_l` ASC, 
														`iqtibosho`.`id_s_v` ASC, 
														`iqtibosho`.`id_faculty` ASC, 
														`iqtibosho`.`id_course` ASC,
														`iqtibosho`.`id_fan` ASC,
														`iqtibosho`.`id_spec` ASC, 
														`iqtibosho`.`id_group` ASC
									");
							?>
							<tr>
								<td rowspan="<?=count($fanho)?>"><?=getUserName($id_teacher)?></td>
								<?php foreach($fanho as $fan):?>
									<?php 
										$id_faculty = $fan['id_faculty'];
										$id_s_l = $fan['id_s_l'];
										$id_s_v = $fan['id_s_v'];
										$id_course = $fan['id_course'];
										$id_course = $fan['id_course'];
										$id_spec = $fan['id_spec'];
										$id_group = $fan['id_group'];
										$id_fan = $fan['id_fan'];
									?>
									<td><?=getFanTest($id_fan)?></td>
									<td class="center"><?=$id_course?></td>
									<td class="center"><?=getSpecialtyCode($id_spec)?><?=getGroup($id_group)?></td>
									<td class="center">
										<?=$stds=count_table_where("students", "`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");?>
									</td>
									<td class="center">
										<?=$suporid=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND IFNULL(`nf_{$rating}_score`, 0) > '0' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");?>
									</td>
									<td></td>
									</tr>
								<?php endforeach;?>
							</tr>
							<?php //exit;?>
						<?php endforeach;?>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</body>
	
</html>