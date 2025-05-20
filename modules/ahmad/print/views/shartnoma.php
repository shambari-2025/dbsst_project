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
		
		
		
		<?php $groups = query("SELECT * FROM `std_study_groups` WHERE `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_course` ASC, `id_faculty` ASC, `id_spec` ASC");?>
		
		
		<?php $total_shartnoma = 0;?>
		<?php $total_suporidand = 0;?>
		<?php $total_qarz = 0;?>
		
		<?php $total_counter = 0;?>
		<?php foreach ($groups as $item):?>
			<?php $id_course = $item['id_course'];?>
			<?php $id_spec = $item['id_spec'];?>
			<?php $id_group = $item['id_group'];?>
			<?php $id_s_v = $item['id_s_v'];?>
			
			<p class="bold"><?=getCourse($item['id_course'])?>, Ихтисоси <?=getSpecialtyCode($item['id_spec'])?> - «<?=getSpecialtyTitle($item['id_spec'])?>»</p>
			
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
					<tr style="background-color: #263544; color: #fff">
						<th style="width: 50px">№ т/р</th>
						<th style="width: 20px">ID</th>
						<th style="width: 380px">Ному насаб</th>
						<th style="width: 150px">Телефон</th>
						<th style="width: 150px">Шакли<br>таҳсил</th>
						<th style="width: 200px">Маблағи<br>таҳсил</th>
						<th style="width: 100px">Маблағ<br>супорид</th>
						<th style="width: 100px">Қарздорӣ</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($students as $item):?>
						<tr>
							<td class="center"><?=++$total_counter?>. <?=++$counter?>.</td>
							<td class="center"><?=$item['id']?></td>
							<td><?=$item['fullname']?></td>
							<td><?=$item['phone']?></td>
							<td class="center">
								<?php $persent = getMyPersent($item['id'], $S_Y)?>
								<?=getStudyType($item['id_s_t'])?> 
								<?php if($persent):?>
									<?=$persent?>%
								<?php endif;?>
							</td>
							
							<?php if(($item['id_s_t']) == 1):?>
								<td class="center">
									<?php $shartnoma = getSpecialtyMoney($item['id_spec'])?>
									<?php if(checkStudentIn2Semestr($item['id'], $S_Y)):?>
										<?php if($persent):?>
											<?php $shartnoma = ($shartnoma * $persent) / 100;?>
											<?=$shartnoma?>
										<?php else:?>
											<?=$shartnoma?>
										<?php endif;?>
									<?php else:?>
										<?=$shartnoma /= 2;?>
										<br>аз 2-юм нимсола<br>
										<?php $info = select("students_farmonho", "*", "`id_student` = '".$item['id']."' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'", "id", false, "");?>
										<?=getFarmonType(@$info[0]['farmon_type'])?>
									<?php endif;?>
								</td>
								
								<?php $total_shartnoma += $shartnoma?>
								
								<td class="center">
									<?php $suporid = getMoneyShartnoma($item['id'], $S_Y)?>
									<?php $total_suporidand += $suporid?>
									<?=$suporid?>
								</td>
								<td class="center">
									<?php $qarz = $shartnoma - $suporid?>
									<?php $total_qarz += $qarz?>
									<?=$qarz?>
								</td>
							<?php else:?>
								<td colspan="3" class="center">
									Аз шартнома озод аст.
								</td>
							<?php endif;?>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			<br>
		<?php endforeach;?>
		
		<br><br><br>
		<p>Дар умум бояд ҷамъ шавад: <b><?=makeBeauty($total_shartnoma)?></b></p>
		<p>Дар умум ҷамъ шуд: <b><?=makeBeauty($total_suporidand)?></b></p>
		<hr>
		<p>Дар умум қарздори: <b><?=makeBeauty($total_qarz)?></b></p>
		<br><br><br>
		
		
		
		<p class="center">Сардори маркази ТФ ва ТИТ: <?=str_repeat("&nbsp;", 45);?> Бобоев А.С.</p>
		
	</body>
	
</html>