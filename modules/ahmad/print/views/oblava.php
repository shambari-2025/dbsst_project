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
		
		<p class="center bold" style="font-size: 20px">Маркази таҳсилоти фосилавӣ ва технологияҳои инноватсионии таълимӣ</p>
		
		<?php $groups = query("SELECT * FROM `std_study_groups` WHERE `id_course` = '4' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_faculty`");?>
		
		<?php foreach($groups as $g_item):?>
			<?php $id_faculty = $g_item['id_faculty'];?>
			<?php $id_course = $g_item['id_course'];?>
			<?php $id_spec = $g_item['id_spec'];?>
			<?php $id_group = $g_item['id_group'];?>
			<?php $id_s_v = $g_item['id_s_v'];?>
			
			<?php
				$students = query("SELECT `students`.*, `users`.* FROM `users`
				INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE 
				`students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
				AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
				AND `students`.`id_s_v` = '$id_s_v' 
				AND `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
				ORDER BY `users`.`fullname`
				");
			?>
			<div class="floatleft">
				<?php if($students):?>
				
					<p>Факулта - <?=getFaculty($f_item['id'])?>.</p>
					
					<table class="table transcript" style="width:100%; font-size:15px">
						<thead>
							<tr>
								<th>№ т/р</th>
								<th>Ному насаб</th>
								<th>Санаи таваллуд</th>
								<th>Курс</th>
								<th>Ихтисос</th>
								<th>Суроға</th>
							</tr>
						</thead>
						
						<tbody>
							<?php $counter = 0;?>
							<?php foreach($students as $item):?>
								<tr>
									<td class="center" style="width: 30px"><?=++$counter?>.</td>
									<td style="width: 300px"><?=$item['fullname']?></td>
									<td style="width: 100px" class="center"><?=formatDate($item['birthday'])?></td>
									<td style="width: 100px" class="center"><?=$item['id_course']?></td>
									<td style="width: 100px" class="center"><?=getSpecialtyCode($item['id_spec'])?></td>
									<td><?=$item['current_address']?></td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				<?php endif;?>
			</div>
			<br>
		<?php endforeach;?>
		<br>
		<br>
		<p class="center bold" style="font-size: 16px">Сардори маркази ТФ ва ТИТ: <?=str_repeat("&nbsp;", 60)?> Бобоев А.С.</p>
		
		<br>
		<br>
		
		
	</body>
	
</html>
