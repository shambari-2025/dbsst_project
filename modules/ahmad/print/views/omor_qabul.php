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
		<h2>Миқдори ҳуҷҷатҳои супоридаи довталабон тибқи феҳарсти тақсимот аз ҷоними ММТ дар даври асосӣ аз 25.07 то 08.08.2024</h2>
		<div class="floatleft">
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th rowspan="3">№</th>
						<th rowspan="3">Тахасус</th>
						<th colspan="4">Рӯзона</th>
						
						<th rowspan="3" style="width: 70px">Ҳамаги</th>
					</tr>
					<tr>
						<th colspan="2">Буҷавӣ</th>
						<th colspan="2">Шартномавӣ</th>
					</tr>
					<tr>
						<th style="width: 70px">З</th>
						<th style="width: 70px">М</th>
						<th style="width: 70px">З</th>
						<th style="width: 70px">М</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($groups_ruzona as $item):?>
						<?php $id_faculty = $item['id_faculty'];?>
						<?php $id_s_l = $item['id_s_l'];?>
						<?php $id_s_v = $item['id_s_v'];?>
						<?php $id_course = $item['id_course'];?>
						<?php $id_spec = $item['id_spec'];?>
						<?php $id_group = $item['id_group'];?>
						<tr class="center">
							<th><?=++$counter?>.</th>
							<td class="left">
								<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup($item['id_group'])?> - <?=getSpecialtyTitle($item['id_spec'])?>
							</td>
							<td>
								<?php
								$student = query("SELECT 
								COUNT(`users`.`id`) as `total` 
								FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
								INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
								INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
								INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
								WHERE
								`users`.`jins` = '0' AND 
								`student_mmt_information`.`number_mmt` IS NOT NULL AND
								`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
								`students`.`status` = '-1' AND
								`students`.`id_faculty` = '$id_faculty' AND 
								`students`.`id_s_l` = '$id_s_l' AND 
								`students`.`id_s_v` = '$id_s_v' AND
								`students`.`id_spec` = '$id_spec' AND
								`students`.`id_group` = '$id_group' AND
								`students`.`id_s_t` = '1' AND
								`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								");
								?>
								<?=$student[0]['total']?>
							</td>
							
							<td>
								<?php
								$student = query("SELECT 
								COUNT(`users`.`id`) as `total` 
								FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
								INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
								INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
								INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
								WHERE
								`users`.`jins` = '1' AND 
								`student_mmt_information`.`number_mmt` IS NOT NULL AND
								`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
								`students`.`status` = '-1' AND
								`students`.`id_faculty` = '$id_faculty' AND 
								`students`.`id_s_l` = '$id_s_l' AND 
								`students`.`id_s_v` = '$id_s_v' AND
								`students`.`id_spec` = '$id_spec' AND
								`students`.`id_group` = '$id_group' AND
								`students`.`id_s_t` = '1' AND
								`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								");
								?>
								<?=$student[0]['total']?>
							</td>
							
							<td>
								<?php
								$student = query("SELECT 
								COUNT(`users`.`id`) as `total` 
								FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
								INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
								INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
								INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
								WHERE
								`users`.`jins` = '0' AND 
								`student_mmt_information`.`number_mmt` IS NOT NULL AND
								`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
								`students`.`status` = '-1' AND
								`students`.`id_faculty` = '$id_faculty' AND 
								`students`.`id_s_l` = '$id_s_l' AND 
								`students`.`id_s_v` = '$id_s_v' AND
								`students`.`id_spec` = '$id_spec' AND
								`students`.`id_group` = '$id_group' AND
								`students`.`id_s_t` = '2' AND
								`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								");
								?>
								<?=$student[0]['total']?>
							</td>
							
							<td>
								<?php
								$student = query("SELECT 
								COUNT(`users`.`id`) as `total` 
								FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
								INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
								INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
								INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
								WHERE
								`users`.`jins` = '1' AND 
								`student_mmt_information`.`number_mmt` IS NOT NULL AND
								`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
								`students`.`status` = '-1' AND
								`students`.`id_faculty` = '$id_faculty' AND 
								`students`.`id_s_l` = '$id_s_l' AND 
								`students`.`id_s_v` = '$id_s_v' AND
								`students`.`id_spec` = '$id_spec' AND
								`students`.`id_group` = '$id_group' AND
								`students`.`id_s_t` = '2' AND
								`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								");
								?>
								<?=$student[0]['total']?>
							</td>
							
							<td>
								<?php
								$student = query("SELECT 
								COUNT(`users`.`id`) as `total` 
								FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
								INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
								INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
								INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
								WHERE
								
								`student_mmt_information`.`number_mmt` IS NOT NULL AND
								`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
								`students`.`status` = '-1' AND
								`students`.`id_faculty` = '$id_faculty' AND 
								`students`.`id_s_l` = '$id_s_l' AND 
								`students`.`id_s_v` = '$id_s_v' AND
								`students`.`id_spec` = '$id_spec' AND
								`students`.`id_group` = '$id_group' AND
								
								`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								");
								?>
								<?=$student[0]['total']?>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
				
			</table>
			<br>
			<br>
			
			<div class="floatleft">
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th rowspan="3">№</th>
						<th rowspan="3">Тахасус</th>
						<th colspan="2">Фосилавӣ</th>
						<th rowspan="3">Ҳамаги</th>
					</tr>
					<tr>
						<th colspan="2">Шартномавӣ</th>
					</tr>
					<tr>
						<th>З</th>
						<th>М</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($groups_fosilavi as $item):?>
						<?php $id_faculty = $item['id_faculty'];?>
						<?php $id_s_l = $item['id_s_l'];?>
						<?php $id_s_v = $item['id_s_v'];?>
						<?php $id_spec = $item['id_spec'];?>
						<tr class="center">
							<th><?=++$counter?>.</th>
							<td class="left">
								
								<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup($item['id_group'])?> - <?=getSpecialtyTitle($item['id_spec'])?>
							</td>
							<td>
								<?php
								$student = query("SELECT 
								COUNT(`users`.`id`) as `total` 
								FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
								INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
								INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
								INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
								WHERE
								`users`.`jins` = '0' AND 
								`student_mmt_information`.`number_mmt` IS NOT NULL AND
								`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
								`students`.`status` = '-1' AND
								`students`.`id_faculty` = '$id_faculty' AND 
								`students`.`id_s_l` = '$id_s_l' AND 
								`students`.`id_s_v` = '$id_s_v' AND
								`students`.`id_spec` = '$id_spec' AND
								`students`.`id_group` = '$id_group' AND
								`students`.`id_s_t` = '1' AND
								`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								");
								?>
								<?=$student[0]['total']?>
							</td>
							
							<td>
								<?php
								$student = query("SELECT 
								COUNT(`users`.`id`) as `total` 
								FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
								INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
								INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
								INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
								WHERE
								`users`.`jins` = '1' AND 
								`student_mmt_information`.`number_mmt` IS NOT NULL AND
								`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
								`students`.`status` = '-1' AND
								`students`.`id_faculty` = '$id_faculty' AND 
								`students`.`id_s_l` = '$id_s_l' AND 
								`students`.`id_s_v` = '$id_s_v' AND
								`students`.`id_spec` = '$id_spec' AND
								`students`.`id_group` = '$id_group' AND
								`students`.`id_s_t` = '1' AND
								`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								");
								?>
								<?=$student[0]['total']?>
							</td>
							
							<td>
								<?php
								$student = query("SELECT 
								COUNT(`users`.`id`) as `total` 
								FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
								INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
								INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
								INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
								WHERE
								
								`student_mmt_information`.`number_mmt` IS NOT NULL AND
								`student_mmt_information`.`total_score_mmt` IS NOT NULL AND
								`students`.`status` = '-1' AND
								`students`.`id_faculty` = '$id_faculty' AND 
								`students`.`id_s_l` = '$id_s_l' AND 
								`students`.`id_s_v` = '$id_s_v' AND
								`students`.`id_spec` = '$id_spec' AND
								`students`.`id_group` = '$id_group' AND
								
								`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								");
								?>
								<?=$student[0]['total']?>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
				
			</table>
			<br>
			<br>
		</div>
		</div>
	</body>
	
</html>