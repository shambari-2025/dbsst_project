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
			padding: 3px;
		}
		
		@page:left{
			@bottom-left {
				content: "Page " counter(page) " of " counter(pages);
			}
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:14px">
		
		
		<div style="width: 260px; float: right">
			<p>
				Ба директори ДТМИК<br>
				н.и.т., дотсент <?=ShortName(RECTOR)?>
			</p>
			
		</div>
		
		<br><br><br>
		<br><br><br>
		
		<p class="bold center">П Е Ш Н И Ҳ О Д</p>
		
		
		<p style="text-align: justify">
			&nbsp;&nbsp;&nbsp;&nbsp; Садорати маркази таҳсилоти фосилавӣ ва технологияҳои инноватсионии таълимӣ 
			тибқи талаботи Низомномаи таҷрибаомӯзии пешаздипломӣ дар муассисаҳои  таҳсилоти олии
			касбии Ҷумҳурии Тоҷикистон, рӯйхати донишҷӯёни курсҳои 4-умро барои гузаштан аз
			таҷрибаомӯзии пешаздипломӣ пешниҳод менамояд.
		</p>
		<br>
		<?php $groups = query("SELECT * FROM `std_study_groups` WHERE `id_course` = '4' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_course` ASC, `id_spec` ASC");?>
		
		
		<?php foreach ($groups as $item):?>
			<?php $id_course = $item['id_course'];?>
			<?php $id_spec = $item['id_spec'];?>
			<?php $id_group = $item['id_group'];?>
			<?php $id_s_v = $item['id_s_v'];?>
			
			<?php 
			
				/* Баровардани контингенти гурух */
				$students = query("SELECT `students`.*, `users`.* FROM `users`
				INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
				WHERE `students`.`status` = '1'
				AND `students`.`id_course` = '$id_course'
				AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
				AND `students`.`id_s_v` = '$id_s_v' 
				AND `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
				ORDER BY `users`.`fullname`
				");
				/* Баровардани контингенти гурух */
			?>
			
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th style="width:50px">№</th>
						<th style="width:350px">Ному насаб</th>
						<th>Ҷинс</th>
						<th>Шакли таҳсил</th>
						<th>Миллат</th>
						<th>Соли таваллуд</th>
					</tr>
					<tr>
						<th colspan="7" class="center">Ихтисоси <?=getSpecialtyCode($item['id_spec'])?> - «<?=getSpecialtyTitle($item['id_spec'])?>»</td>
					</tr>
				</thead>
				
				<tbody>
					<?php $counter = 1;?>
					<?php foreach($students as $student):?>
						<tr class="center">
							<td><?=$counter++?>.</td>
							<td class="left"><?=$student['fullname']?></td>
							<td><?=getJins($student['jins'])?></td>
							<td>
								<?=getStudyView($student['id_s_v'])?>,<br>
								<?=getStudyType($student['id_s_t'])?>
							</td>
							<td><?=getNation($student['id_nation'])?></td>
							<td><?=formatDate($student['birthday'])?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			
			
			<br>
		<?php endforeach;?>
		
		<br><br><br>
		
		<p class="center">Сардори маркази ТФ ва ТИТ: <?=str_repeat("&nbsp;", 45);?> Бобоев А.С.</p>
		
	</body>
	
</html>