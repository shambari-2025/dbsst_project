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
						<th>#</th>
						<th>Факултет</th>
						<th>Ихтисос</th>
						<th>Зинаи таҳсил</th>
						<th>Намуди таҳсил</th>
						<th>Курс</th>
						<th>Гуруҳ</th>
						<th>Шакли таҳсил</th>
						<th>Ному насаб номи падар</th>
						<th>Ҷинс</th>
						<th>Рақами шиноснома</th>
						<th>Мақомоти шиносномадиҳи</th>
						<th>Рузи таваллуд</th>
						<th>Телефон</th>
						<th>Телефони волидайн</th>
						<th>Вилоят/Минтақа</th>
						<th>Ноҳия/Шаҳр</th>
						<th>Миллат</th>
						<th>Ятим</th>
						<th>Ҷойи зист</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($students as $item):?>
						<tr>
							<td class="center" style="width: 20px"><?=++$counter?>.</td>
							
							<td class="center">
								<?=$item['faculty_short']?>
							</td>
							
							<td class="center">
								<?=$item['spec_code']?>
							</td>
							<td class="center"><?=$item['study_level_title']?></td>
							<td class="center"><?=$item['study_view_title']?></td>
							<td class="center"><?=$item['id_course']?></td>
							<td class="center"><?=$item['group_title']?></td>
							<td class="center"><?=$item['study_type_title']?></td>
							<td class="center"><?=$item['fullname_tj']?></td>
							<td class="center"><?=getJins($item['jins'])?></td>
							<td class="center"><?=$item['number']?></td>
							<td class="center"><?=$item['maqomot']?></td>
							<td class="center"><?=makeDay($item['birthday'])?></td>
							<td class="center"><?=$item['phone']?></td>
							<td class="center"><?=$item['phone_parents']?></td>
							<td class="center"><?=$item['region_title']?></td>
							<td class="center"><?=$item['district_title']?></td>
							<td class="center"><?=$item['nation_title']?></td>
							<td class="center"><?=$item['vazi_oilavi_title']?></td>
							<td class="center"><?=$item['address']?></td>
							
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			<br>
			<br>
		</div>
	</body>
	
</html>