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
		<h3><?=$page_info['title'];?></h3>
		<table class="table transcript" style="font-size: 14px !important">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th class="counter">№</th>
					<th>Факултет</th>
					<th>СОЛОНА</th>
					<th>ПАРДОХТ</th>
					<th>БАҚИЯ</th>										
				</tr>
			</thead>
			
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php $all_solona = $all_pardokht = 0;?>
				<?php foreach($faculties as $faculty):?>
						<tr>
							<td><?=$i;?>.</td>
							<td class="left"><?=$faculty['short_title']?></td>
							<td>
								<?php
									$solona = query("SELECT SUM(`balance`) AS `solona` FROM `students` 
														WHERE `id_student` IN(
															SELECT `id_student` FROM `students` 
																WHERE `status` = '1' AND 
																	`id_faculty` = {$faculty['id_faculty']} AND
																	`s_y` = '$S_Y' AND
																	`h_y` = '$H_Y'
															)
													");
									$pardokht = query("SELECT SUM(`check_money`) AS `pardokht` FROM `rasidho` 
										WHERE `id_student` IN(
											SELECT `id_student` FROM `students` 
												WHERE `status` = '1' AND 
													`id_faculty` = {$faculty['id_faculty']} AND
													`s_y` = '$S_Y' AND
													`h_y` = '$H_Y'
											) AND
											`type` = '2' AND
											`s_y` = '$S_Y'	
									");
								$all_solona += round($solona[0]['solona'], 2);
								$all_pardokht += round($pardokht[0]['pardokht'], 2);
								?>
								<?=makeBeauty(round($solona[0]['solona'], 2))?>
							</td>
							<td>
								<?=makeBeauty(round($pardokht[0]['pardokht'], 2))?>
							</td>
							<td><?=makeBeauty(round($solona[0]['solona'] - $pardokht[0]['pardokht'], 2))?></td>
						</tr>
						<?php $i++;?>
				<?php endforeach;?>
				<tr class="bold">
					<td colspan="2">ҲАМАГӢ</td>
					<td><?=makeBeauty($all_solona)?></td>
					<td><?=makeBeauty($all_pardokht)?></td>
					<td><?=makeBeauty(round($all_solona - $all_pardokht, 2))?></td>
				</tr>
			</tbody>
		</table>
	</body>
</html>