<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$page_info['title']?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/davrifaol.css">
	</head>
	
	<body>
		
		<div class="table-responsive davrifaol">
			
			
			<h3 class="center">
			Руйхати донишҷӯён
			дар соли таҳсили <?=getStudyYear($S_Y)?> нимсолаи <?=$H_Y?>
			</h3>
			
			<table class="table">
			<thead class="center">
				<tr>
					<th>№</th>
					<th>Факултет</th>
					<th>Зинаи таҳсил</th>
					<th>Шакли таҳсил</th>
					<th>Курс</th>
					<th>Ихтисос</th>
					<th>Намуди таҳсил</th>
					<th>Ному насаб</th>
					<th>Ҷинс</th>
					<th>Миллат</th>
					<th>Соли таваллуд</th>
					<th>Телефон</th>
					<th>Рақами шиноснома</th>
					<th>Қайди шиноснома</th>
					<th>Атестат</th>
					<th>Вилоят/Минтақа</th>
					<th>Ноҳия/Шаҳр</th>
					<th>Суроға</th>
					<th>Вазъи оилавӣ</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($_SESSION['superarr'] as $f_item):?>
				<?php $id_faculty = $f_item['id'];?>
				<?php $counter = 0;?>
				<?php foreach($f_item['level'] as $l_item):?>
					<?php $id_s_l = $l_item['id'];?>
					
					<?php foreach($l_item['view'] as $v_item):?>
						<?php $id_s_v = $v_item['id'];?>
						
						<?php foreach($v_item['course'] as $c_item):?>
							<?php $id_course = $c_item['id'];?>
							
							<?php foreach($c_item['spec'] as $s_item):?>
								<?php $id_spec = $s_item['id'];?>
								
								<?php foreach($s_item['groups'] as $g_item):?>
									<?php $id_group = $g_item['id'];?>
									
									<?php
									/* Баровардани контингенти гурух */
									$students = query("SELECT 
									`user_udecation`.*,
									`user_passports`.*,
									
									`vazi_oilavi`.`title` as `vazi_oilavi_title`,
									
									`countries`.`title` as `country_title`,
									`regions`.`name` as `region_title`,
									`districts`.`name` as `district_title`,
									`nations`.`title` as `nation_title`,
									
									`faculties`.`title` as `faculty_title`,
									`faculties`.`short_title` as `faculty_short`,
									
									`specialties`.`code` as `spec_code`,
									`specialties`.`title_tj` as `spec_title_tj`,
									`specialties`.`title_ru` as `spec_title_ru`,
									`specialties`.`title_en` as `spec_title_en`,
									
									`groups`.`title` as `group_title`,
									
									`study_level`.`title` as `study_level_title`,
									`study_type`.`title` as `study_type_title`,
									`study_view`.`title` as `study_view_title`,
									
									`students`.*,
									`users`.* 
								FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
								INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
								INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
								
								LEFT JOIN `vazi_oilavi` ON `students`.`vazi_oilavi` = `vazi_oilavi`.`id`
								LEFT JOIN `countries` ON `user_passports`.`id_country` = `countries`.`id`
								LEFT JOIN `regions` ON `user_passports`.`id_region` = `regions`.`id`
								LEFT JOIN `districts` ON `user_passports`.`id_district` = `districts`.`id`
								LEFT JOIN `nations` ON `user_passports`.`id_nation` = `nations`.`id`
								
								INNER JOIN `faculties` ON `students`.`id_faculty` = `faculties`.`id`
								INNER JOIN `specialties` ON `students`.`id_spec` = `specialties`.`id`
								INNER JOIN `groups` ON `students`.`id_group` = `groups`.`id`
								
								INNER JOIN `study_type` ON `students`.`id_s_t` = `study_type`.`id`
								INNER JOIN `study_level` ON `students`.`id_s_l` = `study_level`.`id`
								INNER JOIN `study_view` ON `students`.`id_s_v` = `study_view`.`id`
								
								WHERE `students`.`status` = 1 AND 
								`students`.`id_faculty` = '$id_faculty' AND 
								`students`.`id_s_l` = '$id_s_l' AND 
								`students`.`id_s_v` = '$id_s_v' AND 
								`students`.`id_course` = '$id_course' AND 
								`students`.`id_spec` = '$id_spec' AND 
								`students`.`id_group` = '$id_group' AND 
								`students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
								");
									/* Баровардани контингенти гурух */
									?>
									
									
											
											<?php foreach($students as $student):?>
												<tr>
													<td><?=++$counter?>.</td>
													<td><?=$student['faculty_title']?></td>
													<td><?=$student['study_level_title']?></td>
													<td><?=$student['study_view_title']?></td>
													<td><?=$student['id_course']?></td>
													<td><?=$student['spec_code']?> <?=$student['group_title']?></td>
													<td><?=$student['study_type_title']?></td>
													<td><?=$student['fullname_tj']?></td>
													<td><?=getJins($student['jins'])?></td>
													<td><?=$student['nation_title']?></td>
													<td><?=$student['birthday']?></td>
													<td><?=$student['phone']?></td>
													<td><?=$student['number']?></td>
													<td><?=$student['maqomot']?></td>
													<td><?=$student['silsila']?> <?=$student['number_hujjat']?></td>
													<td><?=$student['region_title']?></td>
													<td><?=$student['district_title']?></td>
													<td><?=$student['address']?></td>
													<td><?=$student['vazi_oilavi_title']?></td>
													
												</tr>
											<?php endforeach;?>
											
										
								<?php endforeach;?>
							<?php endforeach;?>
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endforeach;?>
			</tbody>
			</table>
		</div>
		
	
	</body>
	
</html>