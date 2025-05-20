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
					<th>ID</th>
					<th>Ному насаб</th>
					<th>Шӯъба</th>
					<th>Факултет</th>
					<th>Курс</th>
					<th>Ихтисос<br>(Гуруҳ)</th>
					<th>Ноҳия</th>
					<th>Суроға</th>
					<th>Таввалуд</th>
					<th>Миллат</th>
					<th>Ҷинс</th>
					<th>Шакли таҳсил</th>
					<th>Тел</th>
					<th>Фармон</th>												
				</tr>
			</thead>
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php foreach($students as $s):?>
					<tr>
						<td><?=$i;?>.</td>
						<td><?=$s['id_student']?></td>
						<td class="left"><?=getUserName($s['id_student'])?></td>
						<td><?=getStudyLevel($s['id_s_l']).",".getStudyView($s['id_s_v'])?></td>
						<td><?=getFaculty($s['id_faculty'])?></td>
						<td><?=$s['id_course']?></td>
						<td><?=getSpecialtyCode($s['id_spec']).getGroup($s['id_group'])?></td>
						<td><?=getDistrict($s['id_district'])?></td>
						<td><?=$s['address']?></td>
						<td>
							<?php
								if(isset($s['birthday']))
									echo date("d.m.Y", strtotime($s['birthday']))
							?>
						
						</td>
						<td><?=getNation($s['id_nation'])?></td>
						<td><?=getJins($s['jins'])?></td>
						<td><?=getStudyType($s['id_s_t'])?></td>
						<td><?=$s['phone']?></td>
						<td><?=$s['farmon_text']?></td>
						
					</tr>
					<?php $i++;?>
				<?php endforeach;?>
			</tbody>
		</table>
		<meta http-equiv="refresh" content="600">
	</body>
</html>