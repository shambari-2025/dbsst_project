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
		<?=$page_info['title'];?>
		<table class="table" style="font-size: 14px !important">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th class="counter">№</th>
					<th>ID-иқтибос</th>
					<th>Нимсола</th>
					<th>Факултет</th>
					<th>Зинаи таҳсил</th>
					<th>Намуди таҳсил</th>
					<th>Курс</th>
					<th>Ихтисос<br>Гуруҳ</th>
					<th>Фан</th>
					<th>Кафедра</th>											
				</tr>
			</thead>
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php foreach($iqtibosho as $item):?>
					<tr>
						<td><?=$i;?>.</td>
						<td><?=$item['id']?></td>
						<td><?=$item['semestr']?></td>
						<td><?=getFacultyShort($item['id_faculty'])?></td>
						<td><?=getStudyLevel($item['id_s_l'])?></td>
						<td><?=getStudyView($item['id_s_v'])?></td>
						<td><?=$item['id_course']?></td>
						<td><?=getSpecialtyCode($item['id_spec'])." ".getGroup($item['id_group'])?></td>
						<td class="left"><?=getFanTest($item['id_fan'])?></td>
						<?php if($item['id_departament']):?>
							<td class="left"><?=getDepartament($item['id_departament'])?></td>
						<?php else:?>
							<td class="left" style="font-weight: bold; color: red;">КАФЕДРА НАДОРАД!!!</td>
						<?php endif;?>
					</tr>
					<?php //exit;?>
					<?php $i++;?>
				<?php endforeach;?>
			</tbody>
		</table>
		<meta http-equiv="refresh" content="600">
	</body>
</html>