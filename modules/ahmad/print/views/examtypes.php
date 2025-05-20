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
					<th>Факултет</th>
					<th>Зинаи таҳсил</th>
					<th>Шакли таҳсил</th>
					<th>Курс</th>
					<th>Ихтисос<br>(Гуруҳ)</th>
					<th>Ному насаби омӯзгор</th>
					<th>Фан</th>
					<th>Намуди имтиҳон</th>												
				</tr>
			</thead>
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php foreach($tests as $t):?>
					<tr>
						<td><?=$i;?>.</td>
						<td><?=getFacultyShort($t['id_faculty'])?></td>
						<td><?=getStudyLevel($t['id_s_l'])?></td>
						<td><?=getStudyView($t['id_s_v'])?></td>
						<td><?=$t['id_course']?></td>
						<td><?=getSpecialtyCode($t['id_spec']).getGroup($t['id_group'])?></td>
						<td class="left"><?=getUserName($t['id_teacher'])?></td>
						<td class="left"><?=getFanTest($t['id_fan'])?></td>
						<td>Т</td>
					</tr>
					<?php $i++;?>
				<?php endforeach;?>
			</tbody>
		</table>
		<meta http-equiv="refresh" content="600">
	</body>
</html>