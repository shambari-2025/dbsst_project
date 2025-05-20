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
					<th>Курс</th>
					<th>Ихтисос</th>
					<th>Гуруҳ </th>
					<th>Ному насаб</th>
					<th>Шакли таҳсил</th>
					<th>Намуди стипендия</th>												
				</tr>
			</thead>
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php foreach($results as $r):?>
					<tr>
						<td><?=$i;?>.</td>
						<td><?=getFacultyShort($r['id_faculty'])?></td>
						<td><?=$r['id_course']?></td>
						<td><?=getSpecialtyCode($r['id_spec'])?></td>
						<td><?=getGroup($r['id_group'])?></td>
						<td class="left"><?=getUserName($r['id_student'])?></td>
						<td><?=getStudyType($r['id_s_t'])?></td>
						<td>
							<?php if($r['min'] >=90):?>
								Аъло
							<?php elseif($r['min'] >= 75 && $r['max']>=90):?>
								Хубу аъло
							<?php else:?>
								Хуб
							<?php endif;?>
						</td>
					</tr>
					<?php $i++;?>
				<?php endforeach;?>
			</tbody>
		</table>
		<meta http-equiv="refresh" content="600">
	</body>
</html>