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
					<th>Ихтисос</th>
					<th>Гуруҳ </th>
					<th>Ному насаб</th>											
					<th>Сурат</th>											
					<th>Изи ангушт</th>											
				</tr>
			</thead>
			
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php foreach($students as $s):?>
						<?php $file = $_SERVER['DOCUMENT_ROOT']."/userfiles/students/".$s['photo'];?>
						<?php if(!file_exists($file) || $s['photo'] == NULL || $s['scan1_finger1'] == NULL):?>
							<tr>
								<td><?=$i;?>.</td>
								<td><?=getFacultyShort($s['id_faculty'])?></td>
								<td><?=getStudyLevel($s['id_s_l'])?></td>
								<td><?=getStudyView($s['id_s_v'])?></td>
								<td><?=$s['id_course']?></td>
								<td><?=getSpecialtyCode($s['id_spec'])?></td>
								<td><?=getGroup($s['id_group'])?></td>
								<td class="left"><?=getUserName($s['id_student'])?></td>
								<td>
									<?php if(!file_exists($file) || empty($s['photo'])):?>надорад<?php else:?>дорад<?php endif;?>
								</td>
								<td>
									<?php if(empty($s['scan1_finger1'])):?>надорад<?php else:?>дорад<?php endif;?>
								</td>
							</tr>
						<?php $i++;?>
						<?php endif;?>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>