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
	
	<body>
		
		<div class="table-responsive davrifaol">
			
			<h3 class="center">
				Ҷадвали омории донишҷӯён 
				<?php if(isset($id_faculty)):?>
					дар факултети <?=getFaculty($id_faculty)?>,
				<?php else:?>
					дар ДТМИК
				<?php endif;?>
				<br>Дар соли таҳсили <?=getStudyYear($S_Y)?> нимсолаи <?=$H_Y?>
			</h3>
			
			
			<table class="table" style="font-size:14px">
				<thead class="center">
					<tr>
						<th rowspan="2" style="width: 140px"></th>
						
						<th colspan="4">Шумораи умумии донишҷӯён</th>
						<th colspan="4">Дар шуъбаи рӯзона</th>
						<th colspan="4">Дар шуъбаи фосилавӣ</th>
					</tr>
					<tr>
						<th><div class="vertical">Миқдори<br>гурӯҳҳо</div></th>
						<th><div class="vertical">Ҳамагӣ</div></th>
						<th><div class="vertical">Писар</div></th>
						<th><div class="vertical">Духтар</div></th>
						
						<th><div class="vertical">Миқдори<br>гурӯҳҳо</div></th>
						<th><div class="vertical">Ҳамагӣ</div></th>
						<th><div class="vertical">Писар</div></th>
						<th><div class="vertical">Духтар</div></th>
						
						<th><div class="vertical">Миқдори<br>гурӯҳҳо</div></th>
						<th><div class="vertical">Ҳамагӣ</div></th>
						<th><div class="vertical">Писар</div></th>
						<th><div class="vertical">Духтар</div></th>
						
						
					</tr>
				</thead>
				<tbody>
					<?php $all = $mans = $womans = $all_ruz = $ruz_mans = $ruz_womans = $all_fos = $fos_mans = $fos_womans = 0;?>
					<?php foreach($statistic as $item):?>
					<tr class="center">
						<td class="left">Курси <?=$item['id_course']?></td>
						
						<td>
							<?=count_table_where("state_groups", "$all_stds_where `id_course` = '".$item['id_course']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
						</td>
						<td class="bold">
							<?php $all += $item['all']?>
							<?=$item['all']?>
						</td>
						<td>
							<?php $mans += $item['mans']?>
							<?=$item['mans']?>
						</td>
						<td>
							<?php $womans += $item['woman']?>
							<?=$item['woman']?>
						</td>
						
						
						<td>
							<?=count_table_where("state_groups", "$all_stds_where `id_course` = '".$item['id_course']."' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
						</td>
						<td class="bold">
							<?php $all_ruz += $item['all_ruz']?>
							<?=$item['all_ruz']?>
						</td>
						<td>
							<?php $ruz_mans += $item['ruz_mans']?>
							<?=$item['ruz_mans']?>
						</td>
						<td>
							<?php $ruz_womans += $item['ruz_womans']?>
							<?=$item['ruz_womans']?>
						</td>
						
						
						<td>
							<?=count_table_where("state_groups", "$all_stds_where `id_course` = '".$item['id_course']."' AND `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
						</td>
						<td class="bold">
							<?php $all_fos += $item['all_fos']?>
							<?=$item['all_fos']?>
						</td>
						<td>
							<?php $fos_mans += $item['fos_mans']?>
							<?=$item['fos_mans']?>
						</td>
						<td>
							<?php $fos_womans += $item['fos_womans']?>
							<?=$item['fos_womans']?>
						</td>
						
					</tr>
					<?php endforeach;?>
					
					<tr class="center bold">
						<td>Ҳамагӣ:</td>
						<td>
							<?=count_table_where("state_groups", "$all_stds_where `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
						</td>
						
						<td><?=$all?></td>
						<td><?=$mans?></td>
						<td><?=$womans?></td>
						
						<td>
							<?=count_table_where("state_groups", "$all_stds_where `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
						</td>
						<td><?=$all_ruz?></td>
						<td><?=$ruz_mans?></td>
						<td><?=$ruz_womans?></td>
						
						<td>
							<?=count_table_where("state_groups", "$all_stds_where `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
						</td>
						<td><?=$all_fos?></td>
						<td><?=$fos_mans?></td>
						<td><?=$fos_womans?></td>
						
					</tr>
					
				</tbody>
			</table>
		</div>
	
	</body>
	
</html>