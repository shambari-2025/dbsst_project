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
	
	<body style="width:94%; margin: 15px auto 0 auto">
		
		<table class="table transcript" style="width:100%;">
			<?php 
				$i = 0;
				$cf = 1;
			?>
			<?php $facs = query("SELECT DISTINCT (`id_faculty`) FROM `students` WHERE `id_faculty` != '7' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' AND `id_s_v`='1' AND `id_s_l` = '1' AND `status`='1' ORDER BY `id_faculty`");?>
			
			<?php foreach($facs as $fac):?>
				<tr class="center">
					<td colspan="5"><?=getFaculty($fac['id_faculty']);?></td>
				</tr>
				<?php $course = query("SELECT DISTINCT (`id_course`) FROM `students` WHERE `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' AND `id_s_v`='1' AND `id_s_l` = '1' AND `status`='1' ORDER BY `id_course`");?>
				<?php foreach($course as $c):?>
					<?php $specs = query("SELECT DISTINCT (`id_spec`) FROM `students` WHERE `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' AND `id_s_v`='1' AND `id_s_l` = '1' AND `status`='1' ORDER BY `id_spec`");?>
					<?php foreach($specs as $s):?>
						<?php $groups = query("SELECT DISTINCT(`id_group`) FROM `students` WHERE `id_spec` = '{$s['id_spec']}' AND `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' AND `id_s_v`='1' AND `id_s_l` = '1' AND `status`='1' ORDER BY `id_group`");?>
						<?php foreach($groups as $g):?>
							<tr class="center">
								<td colspan="5">
									Курси <?=$c['id_course'].", ихтисоси ".getSpecialtyCode2($s['id_spec']).", гуруҳи ".getGroup($g['id_group']);?>
								</td>
							</tr>
							<?php $students = query("SELECT * FROM `users` WHERE `id` IN 
														(SELECT DISTINCT (`id_student`) FROM `students` WHERE `id_group` = '{$g['id_group']}' AND `id_spec` = '{$s['id_spec']}' AND `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' AND `id_s_v`='1' AND `status`='1')
													ORDER BY `fullname_tj`
													");
							?>
							<?php $j=0;?>
							<?php foreach($students as $std):?>

								<?php $results = query("SELECT id_fan, SUM(nf_1_score + nf_2_score + nf_1_absent + nf_2_absent) as `sum`
														FROM `results`
														WHERE `id_student` = '{$std['id']}' AND `id_group` = '{$g['id_group']}' AND `id_spec` = '{$s['id_spec']}' AND `id_course` = '{$c['id_course']}' AND `id_faculty` = '{$fac['id_faculty']}' AND s_y = '".S_Y."' AND h_y = '".H_Y."'
														GROUP BY `id_fan` HAVING sum < '".GUZARISH_SCORE."' ORDER BY `id_fan`");?>
								<?php if(count($results) > 0):?>
								<?php $j++; $i++;?>
									<tr>
										<td rowspan="<?=count($results)?>">
											<?=$i.".";?>
										</td>
										<td rowspan="<?=count($results)?>">
											<?=$j.".";?>
										</td>
										<td rowspan="<?=count($results)?>">
											<?=getUserName($std['id']);?>
										</td>
										<?php foreach($results as $item):?>
											<td>
												<?=getFanTest($item['id_fan'])?>
											</td>
											<td>
												<?=$item['sum']?>
											</td>
											</tr>
											<?php $cf++;?>
										<?php endforeach;?>
									</tr>
								<?php endif;?>
							<?php endforeach;?>
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endforeach;?>
		</table>
		<br><br><br>
		<?php echo $cf;?>
		  <meta http-equiv="refresh" content="60">
	</body>
</html>