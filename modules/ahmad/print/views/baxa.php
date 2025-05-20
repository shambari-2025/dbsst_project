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
						<th>Факулта</th>
						<th>Курс</th>
						<th>Гуруҳ</th>
						<th>Ному насаб ба тоҷ</th>
						<th>Рузи таваллуд</th>
						<th>Ноҳия</th>
						<th>Суроғаи зист</th>
						<!--
						<th>Телефон</th>
						<th>Телефон 2</th>
						-->
						
						
						<!--
						<th>Миллат</th>
						<th>Квота</th>
						<th>Шартномавӣ</th>
						-->
						
						<th>Ҷинс</th>
						<th>Зинаи таҳсил</th>
						<th>Шуъба</th>
						
						
					</tr>
				</thead>
				
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($students as $item):?>
						<?php $id_faculty = $item['id_faculty']?>
						<?php $id_s_l = $item['id_s_l']?>
						<?php $id_s_v = $item['id_s_v']?>
						<?php $id_course = $item['id_course']?>
						<?php $id_spec = $item['id_spec']?>
						<?php $id_group = $item['id_group']?>
						<?php $std_count = count_table_where("students", "`id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_spec` = '$id_spec' AND `id_course` = '$id_course' AND `id_group` = '$id_group'");?>
						
						<?php if($std_count > 0):?>
							<tr>
								<td class="center" style="width: 20px"><?=++$counter?></td>
								<td class="center">
									<?=getFacultyShort($id_faculty)?>
								</td>
								<td class="center">
									<?=$id_course?>
								</td>
								<td class="center">
									<?=getSpecialtyCode($item['id_spec'])?><?=getGroup2($id_group)?>
								</td>
								<td><?=$item['fullname_tj']?></td>
								
								<td class="center">
									<?=formatDate($item['birthday'])?>
								</td>
								
								<td class="center">
									<?=getDistrict($item['id_district'])?>
								</td>
								
								<td>
									<?=($item['address'])?>
								</td>
								
								<!--
								<td><?=$item['phone']?></td>
								<td><?=$item['phone_parents']?></td>
								-->
								
								
								
								
								<!--
								<td class="center">
									<?=getNation($item['id_nation'])?>
								</td>
								
								<td class="center">
									<?php if($item['id_s_t'] == 3):?>
										Ⓚ
									<?php endif;?>
								</td>
								
								<td class="center">
									<?php if($item['id_s_t'] == 1):?>
										Ⓚ
									<?php endif;?>
								</td>
								-->
								
								
								<td class="center">
									<?=getJins($item['jins'])?>
								</td>
								<td class="center">
									<?=getStudyLevel($item['id_s_l'])?>
								</td>
								<td class="center">
									<?=getStudyView($item['id_s_v'])?>
								</td>
								
								
								
							</tr>
						<?php endif;?>
					<?php endforeach;?>
				</tbody>
			</table>
			<br>
			<br>
		</div>
	</body>
	
</html>