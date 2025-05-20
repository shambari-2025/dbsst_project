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
						<th>Синф</th>
						<th>Шартномаи солона</th>
						<th>Пардохт</th>
						<th>Қарз</th>
					</tr>
				</thead>
				<?php $total_students = 0;?>
				<?php foreach($_SESSION['litsey'] as $s_item):?>
					<?php $id_sinf = $s_item['id']?>
					<?php foreach($s_item['groups'] as $g_item):?>
						<?php $id_group = $g_item['id']?>
						
						<?php
							/* Баровардани контингенти гурух */
							$students = query("SELECT `student_litsey`.*, `user_passports`.*, `users`.*  FROM `users`
							INNER JOIN `student_litsey` ON `student_litsey`.`id_xonanda` = `users`.`id` 
							INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
							WHERE `student_litsey`.`id_sinf` = '$id_sinf' AND `student_litsey`.`id_group` = '$id_group'
							AND `student_litsey`.`s_y` = '".S_Y."' AND `student_litsey`.`h_y` = '".H_Y."'
							ORDER BY `users`.`fullname_tj`
							");
							/* Баровардани контингенти гурух */
						?>
						
						<tbody>
							<?php $counter = 0;?>
							<?php $sh_solona = $money_s = $money_q = 0;?>
							<?php foreach($students as $item):?>
								<tr >
									<td class="center" style="width: 20px"><?=++$counter?>.</td>
									<td><?=$item['fullname_tj']?></td>
									<td class="center">
										<?=$id_sinf.' '.getGroup2($id_group)?>
									</td>
									
									
									<td class="center">
										<?php $sh_solona += $sh_money = 4900?>
										<?=$sh_money?>
									</td>
									<td class="center">
										<?php $money_s += $money = getMoneyShartnomaLitsey($item['id'], S_Y);?>
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
								<td colspan="3"><p></p></td>
								<td><?=$sh_solona?></td>
								<td><?=$money_s?></td>
								<td><?=$money_q?></td>
							</tr>
							
						</tbody>
						
					<?php endforeach;?>
				<?php endforeach;?>
			</table>
			<br>
			<?php echo $total_students;?>
			<br>
			<br>
		</div>
	</body>
	
</html>