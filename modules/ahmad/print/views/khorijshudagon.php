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
						<th>ID</th>
						<th>Ному насаб номи падар</th>
						<th>Зинаи таҳсил</th>
						<th>Шакли таҳсил</th>
						<th>Намуди таҳсил</th>
						<th>Курс</th>
						<th>Ихтисос</th>
						<th>Ҷинс</th>
						<th>Соли хориҷшавӣ</th>
						<th>Нимсолаи хориҷшавӣ</th>
						<th>Рақами фармон</th>
						<th>Санаи фармон</th>
						<th>Сабаби хориҷшавӣ</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($students as $item):?>
						<tr class="center">
							<td style="width: 20px"><?=++$counter?>.</td>
							<td><?=getFaculty($item['id_faculty'])?></td>
							<td><?=$item['id_student']?></td>
							<td class="left"><?=$item['fullname_tj']?></td>
							<td><?=getStudyLevel($item['id_s_l'])?></td>
							<td><?=getStudyView($item['id_s_v'])?></td>
							<td><?=getStudyType($item['id_s_t'])?></td>
							
							<td><?=$item['id_course']?></td>
							<td><?=getSpecialtyCode($item['id_spec'])?> <?=getGroup($item['id_group'])?></td>
							<td class="center"><?=getJins($item['jins'])?></td>
							<td><?=getStudyYear($item['s_y'])?></td>
							<td><?=$item['h_y']?></td>
							<td class="center">
								<?=$item['farmon_number']?>
							</td>
							<td class="center">
								<?=formatDate($item['farmon_date'])?>
							</td>
							
							<td class="center">
								<?php if($item['id_sabab_khorij']):?>
									<?=$sabab_khorij[$item['id_sabab_khorij']]?>
								<?php endif;?>
							</td>
							
							
						</tr>
						<?php //exit;?>
					<?php endforeach;?>
				</tbody>
			</table>
			<br>
			<br>
		</div>
	</body>
	
</html>