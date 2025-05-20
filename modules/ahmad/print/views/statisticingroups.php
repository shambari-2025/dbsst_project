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
				Ҷадвали нишондоди гурӯҳҳои академӣ 
				<?php if(isset($id_faculty)):?>
					дар факултети <?=getFaculty($id_faculty)?>,
				<?php else:?>
					дар ДТМИК
				<?php endif;?>
				<br>Дар соли таҳсили <?=getStudyYear($S_Y)?> нимсолаи <?=$H_Y?><br>
				ба ҳолати <?=date("d.m.Y")?>
			</h3>
			
			
			<table class="table" style="font-size:16px">
				<thead class="center">
					<tr>
						<th rowspan="2" scope="row" style="width:20px">№</th>
						<th rowspan="2" class="left">Номгуи факултетҳо</th>
						<th rowspan="2"><div class="vertical">Шумораи донишҷӯ</div></th>
						<th rowspan="2"><div class="vertical">Миқдори гурӯҳҳо</div></th>
						<th colspan="2">Шуъбаи <br> Рузона</th>
						<th colspan="2">Шуъбаи <br> Фосилавӣ</th>
					</tr>
					<tr>
						<th><div class="vertical">Шумораи <br> донишҷӯ</div></th>
						<th><div class="vertical">Миқдори <br> гурӯҳ</div></th>
						
						<th><div class="vertical">Шумораи <br> донишҷӯ</div></th>
						<th><div class="vertical">Миқдори <br> гурӯҳ</div></th>
					</tr>
					
				</thead>
				<tbody>
					<?php $counter = 0;?>
					<?php $all_students = $all_groups = $ruz_all_students = $ruz_all_groups = $fos_all_students = $fos_all_groups = 0;?>
					<?php foreach($statistic as $item):?>
						<tr class="center">
							<th scope="row"><?=++$counter?>.</th>
							<td class="left"><?=$item['title']?></td>
							<td class="bold">
								<?php $res = count_table_where("students", "`id_faculty` = '".$item['id_faculty']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
								<?php $all_students += $res;?>
								<?=$res?>
							</td>
							<td>
								<?php $all_groups += $item['allgroups'];?>
								<?=$item['allgroups']?>
							</td>
							<td class="bold">
								<?php $res = count_table_where("students", "`id_faculty` = '".$item['id_faculty']."' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
								<?php $ruz_all_students += $res;?>
								<?=$res?>
							</td>
							<td>
								<?php $ruz_all_groups += $item['ruzona'];?>
								<?=$item['ruzona']?>
							</td>
							<td class="bold">
								<?php $res = count_table_where("students", "`id_faculty` = '".$item['id_faculty']."' AND `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
								<?php $fos_all_students += $res;?>
								<?=$res?>
							</td>
							<td>
								<?php $fos_all_groups += $item['fosilavi'];?>
								<?=$item['fosilavi']?>
							</td>
						</tr>
					<?php endforeach;?>
					<tr class="bold center">
						<td></td>
						<td class="left">Ҳамагӣ:</td>
						<td><?=$all_students?></td>
						<td><?=$all_groups?></td>
						<td><?=$ruz_all_students?></td>
						<td><?=$ruz_all_groups?></td>
						<td><?=$fos_all_students?></td>
						<td><?=$fos_all_groups?></td>
					</tr>
				</tbody>
			</table>
		</div>
	
	</body>
	
</html>