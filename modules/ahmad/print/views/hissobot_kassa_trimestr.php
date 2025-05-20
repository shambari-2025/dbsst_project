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
		
		<div class="floatleft">
			
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th>№</th>
						<th>Ному насаб</th>
						<th>Санаи таҳвил</th>
						<th>Асос</th>
						<th>Маблағ</th>
					</tr>
				</thead>
				
				<?php
				
					$datas = query("SELECT `rasidho`.*, `users`.`fullname_tj` FROM `rasidho`
					INNER JOIN `users` ON `rasidho`.`id_student` = `users`.`id`
					WHERE `rasidho`.`type` = 3 ORDER BY `rasidho`.`check_date` DESC")
				?>
				
				<tbody>
					<?php $counter = $all_money = 0;?>
					<?php foreach($datas as $item):?>
						<tr>
							<td class="center" style="width: 20px"><?=++$counter?>.</td>
							<td><?=$item['fullname_tj']?></td>
							<td class="center">
								<?=formatDate($item['check_date'])?>
							</td>
							<td class="center">
								Пардохт барои триместр
							</td>
							<td class="center">
								<?php $all_money += $item['check_money']?>
								<?=$item['check_money']?>
							</td>
							
							
						</tr>
					<?php endforeach;?>
					
					<tr class="center bold" style="background: yellow">
						<td colspan="4"><p></p></td>
						<td>
							<?=$all_money?>
						</td>
					</tr>
					
				</tbody>
			</table>
			<br>
			<br>
			<br>
		</div>
	</body>
	
</html>