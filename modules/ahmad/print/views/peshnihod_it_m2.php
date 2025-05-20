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
			font-size: 14px;
		}
		p {
			margin: 0;
			padding: 3px;
		}
		
		@media print {
			* {
				-webkit-print-color-adjust: exact !important;
				color-adjust: exact !important;
			}
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
				д.и.т., профессор <?=ShortName(RECTOR)?>
			</p>
			
		</div>
		
		<br><br><br>
		<br><br><br>
		
		<p class="bold center">ПЕШНИҲОД</p>
		
		<p style="text-align: justify">
			&nbsp;&nbsp;&nbsp;&nbsp; Комиссияи қабули ДТМИК мутобиқи қоидаҳои қабули донишҷӯён ба муассисаҳои олии касбӣ барои идомаи таҳсил 
			баъд аз хатми муассисаҳои таҳсилоти миёнаи касбӣ ва қоидаҳои қабули донишҷӯён барои гирифтани таҳсилоти олии дуюм ба Шумо 
			рӯйхати довталабоне, ки тавассути суҳбат дар барои идомаи таҳсил баъд аз хатми муассисаҳои таҳсилоти миёнаи касбӣ ва 
			таҳсилоти дуюми олии касбӣ аз санҷиш гузаштанд, барои қабул намудани онҳо ба равия, курс, ихтисосҳои мувофиқ ва шакли таҳсил пешниҳод менамояд:
		</p>
		<br>
		
		<p class="center bold">§1<br>
			БАРОИ ИДОМАИ ТАҲСИЛ БАЪД АЗ ХАТМИ МУАССИСАҲОИ ТАҲСИЛОТИ МИЁНАИ КАСБӢ<br>
			Ба курси 2- юм барои қабул пешниҳод менамояд:
		</p>
		
		<?php $groups_idoma = query("SELECT * FROM `std_study_groups` WHERE `status` = '-1' AND `id_s_l` = '1' AND `id_course` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_s_v` ASC, `id_course` ASC, `id_faculty` ASC, `id_spec` ASC");?>
		
		<?php $i = 0;?>
		<?php foreach ($groups_idoma as $item):?>
			<?php $id_faculty = $item['id_faculty'];?>
			<?php $id_s_l = $item['id_s_l'];?>
			<?php $id_s_v = $item['id_s_v'];?>
			<?php $id_course = $item['id_course'];?>
			<?php $id_spec = $item['id_spec'];?>
			<?php $id_group = $item['id_group'];?>
			
			<?php
			
				/* Баровардани контингенти гурух */
				$students = query("SELECT `student_mmt_information`.*, `students`.*, `user_passports`.*, `user_udecation`.*, `users`.* FROM `users`
				INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
				INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
				INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id` AND `user_udecation`.`id_khatm_namud` = 2
				INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
				WHERE `students`.`status` = '-1'
				AND `students`.`id_faculty` = '$id_faculty' AND 
				`students`.`id_s_l` = '$id_s_l'
				AND `students`.`id_s_v` = '$id_s_v' 
				AND `students`.`id_course` = '$id_course'
				AND `students`.`id_spec` = '$id_spec' 
				AND `students`.`id_group` = '$id_group'
				AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
				ORDER BY `users`.`fullname_tj`");
				/* Баровардани контингенти гурух */
			?>
			
			<?php if($students):?>
				<p class="center bold" style="font-size: 20px">Ихтисоси <?=getSpecialtyCode($item['id_spec'])?> - «<?=getSpecialtyTitle($item['id_spec'])?>» - <?=getStudyView($id_s_v)?></p>
				<table class="table transcript" style="width:96%; margin: 0 auto;">
					<thead>
						<tr>
							<th style="width:50px">т/р</th>
							<th style="width: 230px">Ному насаб</th>
							<!---
							<th style="width: 80px">Соли таваллуд</th>
							<th>Суроға</th>
							<th style="width:150px">Телефон</th>
							-->
							<th style="width: 130px">Шакли таҳсил</th>
						</tr>
					</thead>
					<tbody>
						<?php $counter = 0;?>
						<?php foreach($students as $student):?>
							<tr>
								<td class="center"><?=++$counter?>.</td>
								<td><?=$student['fullname_tj']?></td>
								<!---
								<td><?=formatDate($student['birthday'])?></td>
								<td>
									<?=getRegion($student['id_region'])?>, <?=getDistrict($student['id_district'])?>,
									<?=$student['address']?>
								</td>
								<td>
									<?=str_replace("+992","", $student['phone'])?>
									<?=str_replace("+992","", $student['phone_parents'])?>
								</td>
								-->
								<td class="center"><?=getStudyType($student['id_s_t'])?></td>
							</tr>
							<?php $i++;?>
						<?php endforeach;?>
					</tbody>
				</table>
				<br>
			
			<?php endif;?>
		<?php endforeach;?>
		
		<br>
		
		<p class="center bold">§2<br>
			БАРОИ ГИРИФТАНИ ТАҲСИЛОТИ ДУЮМИ ОЛИИ КАСБӢ<br>
		</p>
		
		
		<?php $groups_m2 = query("SELECT * FROM `std_study_groups` WHERE `status` = '-1' AND `id_s_l` = '1' AND `id_course` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_s_v` ASC, `id_course` ASC, `id_faculty` ASC, `id_spec` ASC");?>
		
		<?php $i = 0;?>
		<?php foreach ($groups_m2 as $item):?>
			<?php $id_faculty = $item['id_faculty'];?>
			<?php $id_s_l = $item['id_s_l'];?>
			<?php $id_s_v = $item['id_s_v'];?>
			<?php $id_course = $item['id_course'];?>
			<?php $id_spec = $item['id_spec'];?>
			<?php $id_group = $item['id_group'];?>
			
			
			<?php
			
				/* Баровардани контингенти гурух */
				$students = query("SELECT `student_mmt_information`.*, `students`.*, `user_passports`.*, `user_udecation`.*, `users`.* FROM `users`
				INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
				INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
				INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id` AND `user_udecation`.`id_khatm_namud` = 3
				INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
				WHERE `students`.`status` = '-1'
				AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_s_l` = '$id_s_l'
				AND `students`.`id_s_v` = '$id_s_v' 
				AND `students`.`id_course` = '$id_course'
				AND `students`.`id_spec` = '$id_spec' 
				AND `students`.`id_group` = '$id_group'
				AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
				ORDER BY `users`.`fullname_tj`");
				/* Баровардани контингенти гурух */
			?>
			
			<?php if($students):?>
				<p class="center bold" style="font-size: 20px">Ихтисоси <?=str_replace("м 2-юм", "", getSpecialtyCode($item['id_spec']))?> - «<?=getSpecialtyTitle($item['id_spec'])?>» - <?=getStudyView($id_s_v)?></p>
				<table class="table transcript" style="width:96%; margin: 0 auto;">
					<thead>
						<tr>
							<th style="width:50px">т/р</th>
							<th style="width: 230px">Ному насаб</th>
							<!---
							<th style="width: 80px">Соли таваллуд</th>
							<th>Суроға</th>
							<th style="width:150px">Телефон</th>
							-->
							<th style="width: 130px">Шакли таҳсил</th>
						</tr>
					</thead>
					<tbody>
						<?php $counter = 0;?>
						<?php foreach($students as $student):?>
							<tr>
								<td class="center"><?=++$counter?>.</td>
								<td><?=$student['fullname_tj']?></td>
								<!---
								<td><?=formatDate($student['birthday'])?></td>
								<td>
									<?=getRegion($student['id_region'])?>, <?=getDistrict($student['id_district'])?>,
									<?=$student['address']?>
								</td>
								<td>
									<?=str_replace("+992","", $student['phone'])?>
									<?=str_replace("+992","", $student['phone_parents'])?>
								</td>
								-->
								<td class="center"><?=getStudyType($student['id_s_t'])?></td>
							</tr>
							<?php $i++;?>
						<?php endforeach;?>
					</tbody>
				</table>
				<br>
			
			<?php endif;?>
		<?php endforeach;?>
		
		<br><br><br>
		
		
		<?//=$i?>
		
		<table style="width: 70%;margin: 0 auto;">
			<tr>
				<td>Котиби  масъули комиссияи қабул:</td>
				<td></td>
				<td>Ҳакимов И. Б.</td>
			</tr>
			
			
		</table>
		
	</body>
	
</html>