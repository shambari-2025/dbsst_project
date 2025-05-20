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
		
		<div class="floatleft">
			
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th>№</th>
						<th>ФИО</th>
						<th>Курс</th>
						<th>Гуруҳ</th>
						<th>Шартномаи солона</th>
						<th>Пардохт</th>
						<th>Қарз</th>
					</tr>
				</thead>
				<?php $total_students = 0;?>
				<?php $total_summa = $total_suporidand = 0;?>
				<?php foreach($datas as $item):?>
					<?php $id_faculty = $item['id_faculty']?>
					<?php $id_s_l = $item['id_s_l']?>
					<?php $id_s_v = $item['id_s_v']?>
					<?php $id_course = $item['id_course']?>
					<?php $id_spec = $item['id_spec']?>
					<?php $id_group = $item['id_group']?>
					
					<?php
						/* Баровардани контингенти гурух */
						$students = query("SELECT `student_mmt_information`.*, `students`.*, `users`.* FROM `users`
						INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
						LEFT JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
						WHERE `students`.`status` = '1'
						AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_s_l` = '$id_s_l'
						AND `students`.`id_s_v` = '$id_s_v' 
						AND `students`.`id_course` = '$id_course'
						AND `students`.`id_spec` = '$id_spec' 
						AND `students`.`id_group` = '$id_group'
						AND `students`.`id_s_t` = '1'
						AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
						ORDER BY `users`.`fullname_tj`");
						/* Баровардани контингенти гурух */
					?>
					
					<?php if($students):?>
						
							<tbody>
								<?php $counter = 0;?>
								<?php $sh_solona = $money_s = $money_q = 0;?>
								<?php foreach($students as $item):?>
									<tr>
										<td class="center" style="width: 20px"><?=++$counter?>.</td>
										<td><?=$item['fullname_tj']?></td>
										<td class="center">
											<?=$id_course?>
										</td>
										
										<td class="center">
											<?=getStudyLevel($id_s_l)?> - <?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group)?> - <?=getStudyView($id_s_v)?>
										</td>
										
										<td class="center">
											<?php $sh_solona += $sh_money = getSharnomaMoneyBySY($item['id_course'], $item['id_spec'], $item['id_s_l'], $item['id_s_v'], S_Y, $item['foreign']);?>
											<?=$sh_money?>
										</td>
										<td class="center">
											<?php $money_s += $money = getMoneyShartnoma($item['id'], S_Y);?>
											<?=$money?>
										</td>
										<td class="center">
											<?php $money_q += $sh_money - $money?>
											<?=$sh_money - $money?>
										</td>
										
										
									</tr>
									<?php $total_students++;?>
								<?php endforeach;?>
								<tr class="center bold" style="background: yellow">
									<td colspan="4"><p></p></td>
									<td>
										<?php $total_summa += $sh_solona;?>
										<?=$sh_solona?>
									</td>
									<td>
										<?=$money_s?>
										<?php $total_suporidand += $money_s;?>
									</td>
									<td><?=$money_q?></td>
								</tr>
							</tbody>
						
					<?php endif;?>
				<?php endforeach;?>
				<tr class="center bold" style="background: yellow">
						<td colspan="4">Дар умум</td>
						<td>
							
							<?=$total_summa?>
						</td>
						<td>
							<?=$total_suporidand?>
							
						</td>
						<td><?=$total_summa-$total_suporidand?></td>
					</tr>
			</table>
			<br>
			<?php echo $total_students;?>
			<br>
			<br>
		</div>
	</body>
	
</html>