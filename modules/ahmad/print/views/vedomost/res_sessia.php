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
		.vertical {
			transform-origin: center; 
			transform: rotate(180deg);
			writing-mode: vertical-rl; 
			height: 150px;
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
	
		<h2 class="center"><?=$page_info['title']?></h2>
		
		<div class="floatleft">
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th rowspan="3">№</th>
						<th rowspan="3">Фан</th>
						<th rowspan="3">Омӯзгор</th>
						<th rowspan="3" class="vertical">Шакли таҳсил</th>
						<th rowspan="3" class="vertical">Курс</th>
						<th rowspan="3">Гуруҳ</th>
						<th rowspan="3" class="vertical">Шумораи донишҷу</th>
						<th colspan="2">Рухсат нест</th>
						<th rowspan="3" class="vertical">Ҳозир нашуд</th>
						<th colspan="3">Супориданд</th>
						<th colspan="11">Баҳо</th>
					</tr>
					<tr>
						<th rowspan="2" class="vertical">аз фан</th>
						<th rowspan="2" class="vertical">аз шартн</th>
						<th rowspan="2" class="vertical">Нафар</th>
						<th rowspan="2" class="vertical">% аз ҳозир</th>
						<th rowspan="2" class="vertical">% аз умум</th>
						<th>0</th>
						<th>1</th>
						<th>1,33</th>
						<th>1,67</th>
						<th>2</th>
						<th>2,33</th>
						<th>2,67</th>
						<th>3</th>
						<th>3,33</th>
						<th>3,67</th>
						<th>4</th>
					</tr>
					<tr>
						<th>F</th>
						<th>D</th>
						<th>D+</th>
						<th>C-</th>
						<th>C</th>
						<th>C+</th>
						<th>B-</th>
						<th>B</th>
						<th>B+</th>
						<th>A-</th>
						<th>A</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($teachers as $teacher):?>
						<?php 
							$id_teacher = $teacher['id_teacher'];
							$iqtibosho = query("SELECT `iqtibosho`.*, `sarboriho`.* FROM `iqtibosho` 
							INNER JOIN `sarboriho` ON `iqtibosho`.`id` = `sarboriho`.`id_iqtibos`
							WHERE  `iqtibosho`.`id_departament` = '$id_departament' AND 
								`iqtibosho`.`s_y` = '$S_Y' AND 
								`iqtibosho`.`semestr` IN ($semestrs) AND 
								`sarboriho`.`type` = 'lk_plan' AND 
								`sarboriho`.`id_teacher` = '$id_teacher'
							ORDER BY 
								`iqtibosho`.`id_faculty` ASC, 
								`iqtibosho`.`id_s_l` ASC, 
								`iqtibosho`.`id_s_v` ASC, 
								`iqtibosho`.`id_course` ASC, 
								`iqtibosho`.`id_spec` ASC, 
								`iqtibosho`.`id_group` ASC, 
								`iqtibosho`.`id_fan` ASC 
							");
						?>
						<?php $counter = $allstds = $allf = $alld = $alldp = $allcm = $allc = $allcp = $allbm = $allb = $allbp = $allam = $alla = 0;?>
						<?php foreach($iqtibosho as $iqtibos):?>
							<?php
								$id_faculty = $iqtibos['id_faculty'];
								$id_s_l = $iqtibos['id_s_l'];
								$id_s_v = $iqtibos['id_s_v'];
								$id_course = $iqtibos['id_course'];
								$id_spec = $iqtibos['id_spec'];
								$id_group = $iqtibos['id_group'];
								$id_fan = $iqtibos['id_fan'];
							?>
							<tr>
								<td><?=++$counter?></td>
								<td><?=getFanTest($id_fan)?></td>
								<td><?=$teacher['fullname_tj']?></td>
								<td class="center"><?=mb_substr(getStudyLevel($id_s_l),0,1)?> <?=mb_substr(getStudyView($id_s_v),0,1)?></td>
								<td class="center"><?=$id_course?></td>
								<td class="center"><?=getSpecialtyCode($id_spec)?> <?=getGroup($id_group)?></td>
								<td class="center"><?=$stds=count_table_where("students", "`status`='1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $allstds+=$stds;?>
								<td class="center"></td>
								<td class="center"></td>
								<td class="center"></td>
								<td class="center"></td>
								<td class="center"></td>
								<td class="center"></td>
								<?php $id_stds = "SELECT DISTINCT(`id_student`) FROM `students` WHERE `status`='1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' "?>
								
								<td class="center"><?=$f = count_table_where("results", "`id_student` IN ($id_stds) AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND IFNULL(`total_score`,0) < '50' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $allf+=$f;?>
								<td class="center"><?=$d=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `total_score` >= '50' AND `total_score` < '55' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $alld+=$d;?>
								<td class="center"><?=$dp=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `total_score` >= '55' AND `total_score` < '60' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $alldp+=$dp;?>
								<td class="center"><?=$cm=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `total_score` >= '60' AND `total_score` < '65' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $allcm+=$cm;?>
								<td class="center"><?=$c=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `total_score` >= '65' AND `total_score` < '70' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $allc+=$c;?>
								<td class="center"><?=$cp=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `total_score` >= '70' AND `total_score` < '75' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $allcp+=$cp;?>
								<td class="center"><?=$bm=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `total_score` >= '75' AND `total_score` < '80' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $allbm+=$bm;?>
								<td class="center"><?=$b=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `total_score` >= '80' AND `total_score` < '85' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $allb+=$b;?>
								<td class="center"><?=$bp=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `total_score` >= '85' AND `total_score` < '90' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $allbp+=$bp;?>
								<td class="center"><?=$am=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `total_score` >= '90' AND `total_score` < '95' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $allam+=$am;?>
								<td class="center"><?=$a=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan` = '$id_fan' AND `total_score` >= '95' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'")?></td>
								<?php $alla+=$a;?>
							</tr>
						<?php endforeach?>
						<tr style="font-weight: bold;background-color: beige;">
							<td colspan="5" class="right"> Ҳамагӣ</td>
							<td class="center"><?=$counter?></td>
							<td class="center"><?=$allstds?></td>
							<td class="center"></td>
							<td class="center"></td>
							<td class="center"></td>
							<td class="center"></td>
							<td class="center"></td>
							<td class="center"></td>
							<td class="center"><?=$allf?></td>
							<td class="center"><?=$alld?></td>
							<td class="center"><?=$alldp?></td>
							<td class="center"><?=$allcm?></td>
							<td class="center"><?=$allc?></td>
							<td class="center"><?=$allcp?></td>
							<td class="center"><?=$allbm?></td>
							<td class="center"><?=$allb?></td>
							<td class="center"><?=$allbp?></td>
							<td class="center"><?=$allam?></td>
							<td class="center"><?=$alla?></td>
						</tr>
						
					<?php endforeach;?>
						<?php exit;?>
				</tbody>
			</table>
			
			<br>
			<br>
			<!--Ҳамаги супориданд <?=$hamagi_s?>-->
			<br>
		</div>
	</body>
	
</html>