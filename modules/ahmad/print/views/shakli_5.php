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
		
		
		<?php foreach($_SESSION['superarr'] as $f_item):?>
			<?php $id_faculty = $f_item['id'];?>
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
									/*
									$students = query("SELECT `students`.*, `users`.* FROM `users`
									INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
									
									`students`.`id_student` = `users`.`id`
									AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
									AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
									AND `students`.`id_s_v` = '$id_s_v' 
									AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
									ORDER BY `users`.`fullname`
									");
									*/
									
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
									
									WHERE 
										`students`.`status` = 1 AND 
										`students`.`id_faculty` = '$id_faculty' AND
										`students`.`id_s_l` = '$id_s_l' AND
										`students`.`id_s_v` = '$id_s_v' AND
										`students`.`id_course` = '$id_course' AND
										`students`.`id_spec` = '$id_spec' AND
										`students`.`id_group` = '$id_group' AND
										`students`.`s_y` = '$s_y' AND 
										`students`.`h_y` = '$h_y'");
									
									//$students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);
								?>
								
								<div class="floatleft">
									<p>Факулта - <?=getFaculty($f_item['id'])?>. Курс - <?=getCourse2($c_item['id'])?>.  Ихтисос - <?=getSpecialtyCode($s_item['id'])?>.  Рамзи гурух - <?=getGroup2($g_item['id'])?></p>
									
									<table class="table transcript" style="width:100%; font-size:15px">
										<thead>
											<tr>
												<th>№ т/р</th>
												<th>Ному насаб</th>
												<th>Cоли<br>таваллуд</th>
												<th>Чинс</th>
												<th>Намуди таҳсил</th>
												<th>Шарти кабул</th>
												<th>Квота</th>
												<th>Маъюб</th>
												<th>Ятим</th>
												<th>Тахсилот</th>
												<th>Стипендия</th>
												<th>Рамзи нохия (шахр)</th>
											</tr>
											<tr>
												<th>1</th>
												<th>2</th>
												<th>3</th>
												<th>4</th>
												<th>5</th>
												<th>6</th>
												<th>7</th>
												<th>8</th>
												<th>9</th>
												<th>10</th>
												<th>11</th>
												<th>12</th>
											</tr>
											
										</thead>
										
										<tbody>
											<?php $counter = 0;?>
											<?php foreach($students as $item):?>
												<tr>
													<td class="center" style="width: 20px"><?=++$counter?></td>
													<td style="width: 250px"><?=$item['fullname_tj']?></td>
													<td class="center">
														<?php if(!empty($item['birthday'])):?>
															<?=substr($item['birthday'], 0, 4)?>
														
														<?php endif;?>
													</td>
													<td class="center">
														<?=getJins($item['jins'])?>
													</td>
													<td class="center">
														<?=$item['study_type_title']?>
													</td>
													<td class="center">
														<?php if($item['id_course'] == 1):?>
															қабули нав
														<?php else:?>
															аз курси поён ба боло
														<?php endif;?>
													</td>
													<td class="center">
														<?php if($item['id_s_t'] == 3):?>
															Ҳа
														<?php else:?>
															Не
														<?php endif;?>
													</td>
													<td class="center">
														не
													</td>
													<td class="center">
														<?=$item['vazi_oilavi_title']?>
													</td>
													<td class="center">
														<?php if($item['id_s_l'] == 1):?>
															миёна
														<?php else:?>
															олӣ
														<?php endif;?>
													</td>
													<td class="center">намегирад</td>
													<td class="center">
														<?php if(!empty($item['district_title'])):?>
															<?=$item['district_title']?>
														<?php endif;?>
													</td>
												</tr>
											<?php endforeach;?>
										</tbody>
									</table>
									
								</div>
								<br>
							<?php endforeach;?>
							
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endforeach;?>
		<?php endforeach;?>
		
		
		
		
		
		<br>
		<br>
		<br>
		<br>
		
		
	</body>
	
</html>