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
		<p>Ҷадвали санҷиши кори курсӣ барои зинаи таҳсили <?=getStudyLevel($id_s_l)?>, шакли таҳсили <?=getStudyView($id_s_v)?> дар нимсолаи <?=$H_Y?>, соли таҳсили <?=getStudyYear($S_Y)?></p>
		<table class="table" style="font-size: 14px !important">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th class="counter" rowspan="2">№</th>
					<th rowspan="2">Номи фан</th>
					<th rowspan="2">Курс</th>
					<th rowspan="2">Гуруҳ</th>
					<th rowspan="2">Намуди кор</th>
					<th rowspan="2">Шумораи донишҷӯён<br>дар гурӯҳ</th>
					<th rowspan="2">Миқдори донишҷӯёне, <br>ки баҳои мусбӣ гирифтанд</th>
					<th colspan="3">БАҲО</th>
					<th rowspan="2">Ному насаби омузгор</th>
					<th rowspan="2">Факултет</th>
					<th rowspan="2">Кафедра</th>												
				</tr>
				<tr style="background-color: #263544; color: #fff">
					<th>Аъло</th>
					<th>Хуб</th>
					<th>Миёна</th>
				</tr>
			</thead>
			
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php foreach($iqtibosho as $iqtibos):?>
					<?php 
						$id_iqtibos = $iqtibos['id'];
						$id_faculty = $iqtibos['id_faculty'];
						$id_course = $iqtibos['id_course'];
						$id_spec = $iqtibos['id_spec'];
						$id_group = $iqtibos['id_group'];
						$id_fan = $iqtibos['id_fan'];
					?>
						<tr>
							<td><?=$i;?>.</td>
							<td class="left"><?=getFanTest($iqtibos['id_fan']);?></td>
							<td><?=$iqtibos['id_course']?></td>
							<td><?=getSpecialtyCode($iqtibos['id_spec']).getGroup($iqtibos['id_group'])?></td>
							<td>
								<?php if($iqtibos['loihai_kursi']):?>
									Лоиҳаи курсӣ
								<?php elseif($iqtibos['kori_kursi']):?>
									Кори курсӣ
								<?php endif;?>
							</td>
							<td>
								<?php
									echo $students = count_table_where("students", "`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_l' AND `id_course` = '$id_course' AND `id_spec`='$id_spec' AND `id_group`='$id_group' AND `s_y`='$S_Y' AND `h_y`='$H_Y'")
								?>
							</td>
							<td>
								<?php
									echo $results = count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_l' AND `id_course` = '$id_course' AND `id_spec`='$id_spec' AND `id_group`='$id_group' AND `id_fan` ='$id_fan' AND `kori_kursi` >= '50' AND `s_y`='$S_Y' AND `h_y`='$H_Y'")
								?>
							</td>
							<td>
								<?php
									echo $alo = count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_l' AND `id_course` = '$id_course' AND `id_spec`='$id_spec' AND `id_group`='$id_group' AND `id_fan` ='$id_fan' AND `kori_kursi` >= '90' AND `s_y`='$S_Y' AND `h_y`='$H_Y'")
								?>
							</td>
							<td>
								<?php
									echo $khub = count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_l' AND `id_course` = '$id_course' AND `id_spec`='$id_spec' AND `id_group`='$id_group' AND `id_fan` ='$id_fan' AND `kori_kursi` >= '75' AND `kori_kursi` < '90' AND `s_y`='$S_Y' AND `h_y`='$H_Y'")
								?>
							</td>
							<td>
								<?php
									echo $miyona = count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_l' AND `id_course` = '$id_course' AND `id_spec`='$id_spec' AND `id_group`='$id_group' AND `id_fan` ='$id_fan' AND `kori_kursi` >= '50' AND `kori_kursi` < '75' AND `s_y`='$S_Y' AND `h_y`='$H_Y'")
								?>
							</td>
							<td>
								<?php 
									$teacher = query("SELECT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND (`type`='loihai_kursi' OR `type`='kori_kursi')");
									echo @getUserName($teacher[0]['id_teacher']);								
								?>
							</td>
							<td><?=getFaculty($iqtibos['id_faculty'])?></td>
							<td class="left"><?=getDepartament($iqtibos['id_departament'])?></td>
						</tr>
						<?php $i++;?>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>