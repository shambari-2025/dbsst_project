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
		<p class="center">
			Омори ҷойҳои кории донишҷӯн
		</p>
		<table class="table transcript" style="width:100%;">
			<thead class="center">
				<tr>
					<th class="counter">№</th>
					<th style="width: 40%">Ному насаб</th>											
					<th>Ҷинс</th>
					<th>Соли <br>таваллуд</th>																				
					<th>Вазъи <br>оилавӣ</th>																				
					<th>Нишонии ҷои зист</th>																				
					<th>Курс ва ихтисос</th>																				
					<th>Намуди <br>таҳсил</th>																				
					<th>Шакли <br>таҳсил</th>																				
					<th>Рақами <br>телефон</th>																				
					<th>Ҷои кор (вазифа)</th>																																							
				</tr>
			</thead>
			<tbody>
			<?php $counter = 0;?>
			<?php foreach($korgarho as $k):?>
				<?php
					$info  = query("SELECT `users`.*, `students`.* FROM `users` 
									INNER JOIN `students` ON `users`.`id` = `students`.`id_student`
									WHERE `users`.`id` = {$k['id_user']} AND
										`students`.`id_course` IN (SELECT MAX(`id_course`) FROM `students` WHERE `id_student` = {$k['id_user']})
									")
				?>
				<tr>
					<td><?=++$counter;?></td>
					<td><?=getUserName($k['id_user']);?></td>
					<td><?=getJins($info[0]['jins']);?></td>
					<td><?=date('d.m.Y', strtotime($info[0]['birthday']));?></td>
					<td><?=$info[0]['v_oilavi'];?></td>
					<td><?=$k['address'];?></td>
					<td><?=getSpecialtyCode($info[0]['id_spec']);?></td>
					<td><?=getStudyType($info[0]['id_s_t']);?></td>
					<td><?=getStudyView($info[0]['id_s_v']);?></td>
					<td><?=$info[0]['phone'];?></td>
					<td><?=$k['joi_kor'];?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>