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
		
		@page:left{
			@bottom-left {
				content: "Page " counter(page) " of " counter(pages);
			}
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:14px">
		
		
		<table class="table transcript" style="width:96%; margin: 0 auto;">
			<tbody class="center">
				
				<tr>
					<td >
						Ихтисосхо
					</td>
					<td>
						Буҷави
					</td>
					<td>
						Шартномави
					</td>
					<td>
						Духтарон
					</td>
					<td>
						Квота
					</td>
					
				</tr>
				
				<?php foreach($groups as $item):?>
					<tr>
						<td>
							Курси <?=$item['id_course']?>, <?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?> - <?=getStudyView($item['id_s_v'])?>
						</td>
						<td>
							<?=count_table_where("students", "`status` = '1' AND `id_faculty` = '{$item['id_faculty']}' AND `id_s_l` = '{$item['id_s_l']}' AND `id_s_v` = '{$item['id_s_v']}' AND `id_course` = '{$item['id_course']}' AND `id_spec` = '{$item['id_spec']}' AND `id_group` = '{$item['id_group']}' AND `id_s_t` = '2'")?>
						</td>
						<td>
							<?=count_table_where("students", "`status` = '1' AND `id_faculty` = '{$item['id_faculty']}' AND `id_s_l` = '{$item['id_s_l']}' AND `id_s_v` = '{$item['id_s_v']}' AND `id_course` = '{$item['id_course']}' AND `id_spec` = '{$item['id_spec']}' AND `id_group` = '{$item['id_group']}' AND `id_s_t` = '1'")?>
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
								`students`.`status` = '1' AND
								`students`.`id_faculty` = '{$item['id_faculty']}' AND 
								`students`.`id_s_l` = '{$item['id_s_l']}' AND 
								`students`.`id_s_v` = '{$item['id_s_v']}' AND 
								`students`.`id_course` = '{$item['id_course']}' AND 
								`students`.`id_spec` = '{$item['id_spec']}' AND 
								`students`.`id_group` = '{$item['id_group']}' AND
								`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								");
							?>
							<?=$student[0]['total'];?>
						</td>
						<td>
							<?=count_table_where("students", "`status` = '1' AND `id_faculty` = '{$item['id_faculty']}' AND `id_s_l` = '{$item['id_s_l']}' AND `id_s_v` = '{$item['id_s_v']}' AND `id_course` = '{$item['id_course']}' AND `id_spec` = '{$item['id_spec']}' AND `id_group` = '{$item['id_group']}' AND `id_s_t` = '3'")?>
						</td>
						
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>

		<br>
		<br>
		<br>
	</body>
	
</html>