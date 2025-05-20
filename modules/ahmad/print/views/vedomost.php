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
			//font-family: "Palatino Linotype";
		}
		p {
			margin: 0;
			padding: 3px;
		}
		
		@page {
			
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:14px">
		<table class="table transcript" style="width:100%; font-size:14px; margin: 0 auto">
			<tbody>
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
									<tr>
										<td class="center bold" colspan="5">
											<?=getFaculty($id_faculty)?>, 
											<?=getCourse($id_course)?>,
											<?=getSpecialtyCode($id_spec)?>
											"<?=getGroup2($id_group)?>"
										</td>
									</tr>
									<tr>
										<td class="center bold">#</td>
										<td class="bold" style="width: 850px">Номгуйи фанҳо</td>
										<td class="bold" style="width: 150px">Омӯзгор</td>
										<td class="center bold" style="width: 120px">Ведомостро гирифт</td>
										<td class="center bold" style="width: 120px">Ведомостро супорид</td>
									</tr>
									<?php $content = query("SELECT * FROM `jd` WHERE `id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' ORDER BY `id_fan`");?>
									<?php if(!empty($content)):?>
										<?php $counter = 0;?>
										<?php foreach($content as $item):?>
											<tr>
												<th scope="row"><?=++$counter?>.</th>
												<td class="left"><?=getFan($item['id_fan'])?></td>
												<td><?=getShortName($item['id_teacher'])?></td>
												<td></td>
												<td></td>
											</tr>
										<?php endforeach;?>
									<?php else: ?>
										<tr class="center bold">
											<td colspan="8">
												<i class="fa fa-warning"></i> Маълумот нест.
											</td>
										</tr>
									<?php endif;?>
								<?php endforeach;?>
							<?php endforeach;?>
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
	
</html>