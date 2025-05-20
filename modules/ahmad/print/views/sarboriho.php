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
						<th>Факултет</th>
						<th>Курс</th>
						<th>Гуруҳ</th>
						<th>Зинаи таҳсил</th>
						<th>Ном фан</th>
						<th>Намуди дарс</th>
						<th>Омӯзгор</th>
						<th>Кафедра</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($list as $item):?>
						
						<tr>
							<td class="center" style="width: 20px"><?=++$counter?></td>
							<td class="center">
								<?=getFacultyShort($item['id_faculty'])?>
							</td>
							<td class="center">
								<?=$item['id_course']?>
							</td>
							<td class="center">
								<?=getSpecialtyCode($item['id_spec'])?><?=getGroup2($item['id_group'])?> - <?=getStudyView($item['id_s_v'])?>
							</td>
							
							<td><?=getStudyLevel($item['id_s_l'])?></td>
							<td><?=getFanTest($item['id_fan'])?></td>
							
							<td><?=$dars_namud[$item['type']]?></td>
							
							<td class="center">
								<?=getUserName($item['id_teacher'])?>
							</td>
							<td class="center">
								<?=getDepartament($item['id_departament'])?>
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