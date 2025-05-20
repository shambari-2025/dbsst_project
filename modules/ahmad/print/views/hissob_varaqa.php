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
						<th>Ном ва насаб</th>
						<th>Факултет</th>
						<th>Номи муассисаи пардохткунанда</th>
						<th>Маблағ</th>
						<th>Санаи пардохт</th>
						<th>Илова кард</th>
						
					</tr>
				</thead>
				
				<tbody>
					<?php $total_students = 0;?>
					<?php $counter = 0;?>
					<?php $total_money = 0;?>
					<?php foreach($datas as $item):?>
						<?php $info = query("SELECT * FROM `students` WHERE `status` = 1 ANd `id_student` = '".$item['id_student']."'");?>
						<tr>
							<td class="center" style="width: 20px"><?=++$counter?>.</td>
							<td><?=getUserName($item['id_student'])?></td>
							<td class="center">
								<?=getFaculty($info[0]['id_faculty'])?>
							</td>
							
							<td class="center">
								<?=$item['payed_from']?>
							</td>
							
							<td class="center">
								<?php $total_money += $item['check_money']?>
								<?=$item['check_money']?>
							</td>
							<td class="center">
								<?=date('d.m.Y', strtotime($item['check_date']))?>
							</td>
							
							<td><?=getUserName($item['author'])?></td>
						</tr>
						<?php $total_students++;?>
					<?php endforeach;?>
					<tr class="bold">
						<td colspan="4"></td>
						<td><?=$total_money?></td>
						
					</tr>
				</tbody>
			</table>
			<br>
			<?php //echo $total_students;?>
			<br>
			<br>
		</div>
	</body>
	
</html>