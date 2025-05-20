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
			
			<?php foreach($f_item['view'] as $v_item):?>
				<?php $id_s_v = $v_item['id'];?>
				
				<?php foreach($v_item['course'] as $c_item):?>
					<?php $id_course = $c_item['id'];?>
					
					<?php foreach($c_item['spec'] as $s_item):?>	
						<?php $id_spec = $s_item['id'];?>
						
						<?php foreach($s_item['groups'] as $g_item):?>
							<?php $id_group = $g_item['id'];?>
							
							<?php
								$students = query("SELECT `students`.*, `users`.* FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE `students`.`id_student` = `users`.`id`
								AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_course` = '$id_course'
								AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
								AND `students`.`id_s_v` = '$id_s_v' 
								AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								ORDER BY `users`.`fullname`
								");
							?>
							
							<div class="floatleft">
								<p>Факулта - <?=getFaculty($f_item['id'])?>. Курс - <?=getCourse2($c_item['id'])?>.  Ихтисос - <?=getSpecialtyCode($s_item['id'])?>.  Рамзи гурух - <?=getGroup2($g_item['id'])?></p>
								
								<table class="table transcript" style="width:100%; font-size:15px">
									<thead>
										<tr>
											<th>№ т/р</th>
											<th>Ному насаб</th>
											<th>Шакли таҳсил</th>
											<!--<th>Санаи таваллуд</th>-->
											<th>Телефон</th>
											<th>Эзоҳ</th>
											<!--<th>Суроға</th>-->
										</tr>
									</thead>
									
									<tbody>
										<?php $counter = 0;?>
										<?php foreach($students as $item):?>
											<tr>
												<td class="center" style="width: 20px"><?=++$counter?></td>
												<td style="width: 250px"><?=$item['fullname']?></td>
												<td class="center">
													<?=getStudyType($item['id_s_t'])?>
												</td>
												<!--<td><?=formatDate($item['birthday'])?></td>-->
												
												<td class="center">
													<?=$item['phone']?>
												</td>
												<td style="width: 250px"></td>
												<!--<td><?=$item['current_address']?></td>-->
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
		<br>
		<br>
		<br>
		<br>
		
		
	</body>
	
</html>