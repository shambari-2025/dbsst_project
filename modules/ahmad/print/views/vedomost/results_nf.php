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
		
		
		<h2 class="center">Натиҷаҳои дар соли таҳсили 20<?=S_Y?>-20<?=S_Y+1?>, нимсолаи <?=H_Y?></h2>
		
		<div class="floatleft">
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th>№</th>
						<th>Факулта</th>
						<th>Курс</th>
						<th>Гуруҳ</th>
						<th>Ҳамагӣ</th>
						<th>Супорид Р<?-$rating?></th>
						<th>% Р<?-$rating?></th>
						<th>Насупорид Р<?-$rating?></th>
						<th>% Р<?-$rating?></th>
						<th>Фан</th>
						<th>Иштирок накард<br>донишҷӯ</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 0;?>
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
							<td class="center" style="width: 20px"><?=++$counter?></td>
							<td class="left"><?=getFaculty($id_faculty)?></td>
							<td class="center"><?=$id_course?></td>
							<td class="center"><?=getSpecialtyCode($id_spec)?><?=getGroup($id_group)?></td>
							<td class="center"><?=$std_count=count_table_where("students", "`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
							<td class="center"><?=$std_suporid=count_table_where("results", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_fan`= '$id_fan' AND IFNULL(`nf_{$rating}_score_r`, 0) > 0 AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
							<td class="center"><?php if($std_count > 0 ) echo round($std_suporid/$std_count * 100, 2);?></td>
							<td class="center"><?=$std_nasuporid = $std_count - $std_suporid?></td>
							<td class="center"><?php if($std_count > 0 ) echo round($std_nasuporid/$std_count * 100, 2);?></td>
							<td><?=getFanTest($id_fan)?></td>
							<td>
								<?php if($std_nasuporid > 0):?>
									<?php $nasuporidagiho = query("SELECT `id_student` FROM `results` 
																	WHERE `id_faculty` = '$id_faculty' AND 
																		`id_s_l` = '$id_s_l' AND 
																		`id_s_v` = '$id_s_v' AND 
																		`id_course` = '$id_course' AND 
																		`id_spec` = '$id_spec' AND 
																		`id_group` = '$id_group' AND 
																		`id_fan`= '$id_fan' AND 
																		IFNULL(`nf_{$rating}_score_r`, 0) = 0 AND 
																		`s_y` = '".S_Y."' AND 
																		`h_y` = '".H_Y."' AND 
																		`id_student` IN (SELECT `id_student` FROM `students`
																							WHERE `status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."')
																													
																
																")?>
									<?php foreach($nasuporidagiho as $n):?>
										<?=@getUserName($n['id_student'])?><br>
									<?php endforeach;?>
								<?php endif;?>
								<?php if($std_nasuporid == $std_count):?>
									<b style="color: red">Аз ин фан ягон донишҷӯ рейтинг насупоридааст</b>
								<?php endif;?>
							</td>
						</tr>
						<?php// if($id_faculty==2){exit;}?>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</body>
	
</html>