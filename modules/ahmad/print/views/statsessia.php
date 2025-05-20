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
		<p><?=$page_info['title']?></p>
		<p class="bold center">Нишондиҳандаи дараҷаи азхудкунӣ ва сатҳи сифат дар факултетҳои донишгоҳ(имтиҳонҳои шакли шифоҳӣ-хаттӣ) дар <?=getHalfYear($H_Y)?>и соли таҳсили <?=getStudyYear($S_Y)?></p>
		<table class="table transcript" style="width:100%;">
			<thead>
				<tr>
					<th>№</th>
					<th class="center bold">Факултет</th>
					<th class="center bold">Дараҷаи азхудкунӣ %</th>
					<th class="center bold">Сатҳи сифат%</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = $un_azkhud = $un_sifat = 0;?>
				<?php if(isset($_SESSION['user']['admin'])):?>
					<?php $S_R = $_SESSION['superarr'];?>
				<?php else:?>
					<?php $S_R = $_SESSION['students'];?>
				<?php endif;?>
				
				<?php foreach($S_R as $fac):?>
					<tr class="center">
						<td>
							<?=++$counter?>.
						</td>
						<td class="left"><?=$fac['short'];?></td>
						<?php
							$id_faculty = $fac['id'];
							$fans = query("SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_fan`");
							$allresults = query("SELECT * FROM `results` 
												WHERE `id_faculty` = '$id_faculty' AND 
													`s_y` = '$S_Y' AND 
													`h_y` = '$H_Y' AND 
													`id_fan` IN (
														SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `imt_type` != '1' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_fan`
													)
											");
							$azkhud = query("SELECT * FROM `results` 
												WHERE `id_faculty` = '$id_faculty' AND 
													`s_y` = '$S_Y' AND 
													`h_y` = '$H_Y' AND 
													`id_fan` IN (
														SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `imt_type` != '1' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_fan`
													) AND 
													`total_score` >= '50' 
											");
							$sifat = query("SELECT * FROM `results` 
												WHERE `id_faculty` = '$id_faculty' AND 
													`s_y` = '$S_Y' AND 
													`h_y` = '$H_Y' AND 
													`id_fan` IN (
														SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `imt_type` != '1' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_fan`
													) AND 
													`total_score` >= '75' 
											");
						?>
						<td>
							<?php if($allresults){
								echo $az = round(count($azkhud) / count($allresults) * 100, 2);
								$un_azkhud += $az;							
							}
							?>
						</td>
						<td>
							<?php if($allresults){
								echo $s = round(count($sifat) / count($allresults) * 100, 2);
								$un_sifat += $s;							
							}
							?>
						</td>
						
					</tr>
				<?php endforeach;?>
					
				<tr class="bold center">
					<td colspan="2">Ҳамагӣ дар ДТТ</td>
					<td><?=round($un_azkhud / ($counter - 1), 2);?></td>
					<td><?=round($un_sifat / ($counter - 1), 2)?></td>
				</tr>
			</tbody>
		</table>
		<br>
		<br>
		<br>
		<br>
		<br>
		<p class="bold center">Нишондиҳандаи дараҷаи азхудкунӣ ва сатҳи сифат дар факултетҳои донишгоҳ(имтиҳонҳои шакли тестӣ) дар <?=getHalfYear($H_Y)?>и соли таҳсили <?=getStudyYear($S_Y)?></p>
		<table class="table transcript" style="width:100%;">
			<thead>
				<tr>
					<th>№</th>
					<th class="center bold">Факултет</th>
					<th class="center bold">Дараҷаи азхудкунӣ %</th>
					<th class="center bold">Сатҳи сифат%</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = $un_azkhud = $un_sifat = 0;?>
				<?php if(isset($_SESSION['user']['admin'])):?>
					<?php $S_R = $_SESSION['superarr'];?>
				<?php else:?>
					<?php $S_R = $_SESSION['students'];?>
				<?php endif;?>
				
				<?php foreach($S_R as $fac):?>
					<tr class="center">
						<td>
							<?=++$counter?>.
						</td>
						<td class="left"><?=$fac['short'];?></td>
						<?php
							$id_faculty = $fac['id'];
							$fans = query("SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_fan`");
							$allresults = query("SELECT * FROM `results` 
												WHERE `id_faculty` = '$id_faculty' AND 
													`s_y` = '$S_Y' AND 
													`h_y` = '$H_Y' AND 
													`id_fan` IN (
														SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `imt_type` = '1' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_fan`
													)
											");
							$azkhud = query("SELECT * FROM `results` 
												WHERE `id_faculty` = '$id_faculty' AND 
													`s_y` = '$S_Y' AND 
													`h_y` = '$H_Y' AND 
													`id_fan` IN (
														SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `imt_type` = '1' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_fan`
													) AND 
													`total_score` >= '50' 
											");
							$sifat = query("SELECT * FROM `results` 
												WHERE `id_faculty` = '$id_faculty' AND 
													`s_y` = '$S_Y' AND 
													`h_y` = '$H_Y' AND 
													`id_fan` IN (
														SELECT DISTINCT(`id_fan`) FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `imt_type` = '1' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_fan`
													) AND 
													`total_score` >= '75' 
											");
						?>
						<td>
							<?php if($allresults){
								echo $az = round(count($azkhud) / count($allresults) * 100, 2);
								$un_azkhud += $az;							
							}
							?>
						</td>
						<td>
							<?php if($allresults){
								echo $s = round(count($sifat) / count($allresults) * 100, 2);
								$un_sifat += $s;							
							}
							?>
						</td>
						
					</tr>
				<?php endforeach;?>
					
				<tr class="bold center">
					<td colspan="2">Ҳамагӣ дар ДТТ</td>
					<td><?=round($un_azkhud / ($counter - 2), 2);?></td>
					<td><?=round($un_sifat / ($counter - 2), 2)?></td>
				</tr>
			</tbody>
		</table>
	</body>
</html>