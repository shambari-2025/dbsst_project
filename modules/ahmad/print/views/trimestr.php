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
						<th>Факултет</th>
						<th>Курс</th>
						<th>Гуруҳ</th>
						<th>Маблағ</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($students as $item):?>
						<?php $id_faculty = $item['id_faculty']?>
						<?php $id_s_l = $item['id_s_l']?>
						<?php $id_s_v = $item['id_s_v']?>
						<?php $id_course = $item['id_course']?>
						<?php $id_spec = $item['id_spec']?>
						<?php $id_group = $item['id_group']?>
						<tr>
							<td class="center" style="width: 20px"><?=++$counter?></td>
							<td><?=$item['fullname_tj']?></td>
							<td><?=getFacultyShort($item['id_faculty'])?></td>
							<td class="center"><?=$id_course?></td>
							<td class="center">
								<?=getSpecialtyCode($item['id_spec'])?><?=getGroup2($id_group)?>
							</td>
							<td class="center">
								<?=$item['check_money']?>
							</td>
						</tr>
						
					<?php endforeach;?>
				</tbody>
			</table>
			<br>
			<br>
		</div>
	</body>
	
</html>