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
		
		<p class="center bold" style="font-size: 20px">Рӯйхати довталабон</p>
		
		<?php $total_counter = 0;?>
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
									`students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
									AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
									AND `students`.`id_s_v` = '$id_s_v' 
									AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
									ORDER BY `users`.`fullname_tj`
									");
									*/
									
									$students = query("SELECT 
									`users`.*, `students`.*, `user_passports`.*, `user_udecation`.*
									FROM `users`
									INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
									INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
									INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
									WHERE
									
									`students`.`id_faculty` = '$id_faculty' AND
									`students`.`id_s_l` = '$id_s_l' AND
									`students`.`id_s_v` = '$id_s_v' AND
									`students`.`id_course` = '$id_course' AND
									`students`.`id_spec` = '$id_spec' AND
									`students`.`id_group` = '$id_group' AND
									`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
									
									ORDER BY `users`.`fullname_tj`
									");
									
								?>
								
								<div class="floatleft">
									<?php if($students):?>
									
										<p>Факулта - <?=getFaculty($f_item['id'])?>.</p>
										
										<table class="table transcript" style="width:100%; font-size:16px">
											<thead>
												<tr>
													<th style="width: 50px">№ т/р</th>
													<th style="width: 350px">Ному насаб</th>
													<th style="width: 100px">Курс</th>
													<th style="width: 100px">Ихтисос</th>
													<th style="width: 100px">Зинаи таҳсил</th>
													<th style="width: 100px">Шартнома супорид</th>
												</tr>
											</thead>
											
											<tbody>
												<?php $counter = 0;?>
												<?php foreach($students as $item):?>
													<tr>
														<td class="center" ><?=++$counter?>.</td>
														<td><?=$item['fullname_tj']?></td>
														<td class="center"><?=$item['id_course']?></td>
														<td class="center"><?=getSpecialtyCode($item['id_spec'])?></td>
														<td class="center"><?=getStudyLevel($item['id_s_l'])?></td>
														<td class="center">
															<?php if($item['id_s_t'] == 1):?>
																<?=getMoneyShartnoma($item['id_student'], S_Y)?>
															<?php elseif($item['id_s_t'] == 2):?>
																Ройгон
															<?php else:?>
																Квота
															<?php endif;?>
														</td>
													</tr>
													<?php $total_counter++;?>
												<?php endforeach;?>
											</tbody>
										</table>
									<?php endif;?>
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
		<?=$total_counter?>
		<br>
		<br>
		
		
	</body>
	
</html>
