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
		.table td {
			padding: 4px 10px !important;
		}
		
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:14px">
		<h3 class="center">
			Руйхати саволномаҳо
		</h3>
		
		
		<table class="table transcript" style="font-size:14px; margin: 0 auto">
			<thead>
				<tr>
					<th rowspan="2">№</th>
					<th rowspan="2" class="vertical">Факултет</th>
					<th rowspan="2" class="vertical">Кафедра</th>
					<th rowspan="2" class="vertical">ID FAN</th>
					<th rowspan="2">Номи фан</th>
					<th rowspan="2" class="vertical">Курс</th>
					<th rowspan="2" class="vertical">Гурӯҳ</th>
					<th rowspan="2" class="vertical">Шуъба</th>
					<th rowspan="2" class="vertical">Нимсола</th>
					<th rowspan="2">Ному насаби<br>омӯзгор</th>
					<th colspan="7">Тоҷикӣ</th>
					<th colspan="7">Руссӣ</th>
					
				</tr>
				<tr>
					<th class="vertical">Оддӣ</th>
					<th class="vertical">Интихоби бисёр</th>
					<th class="vertical">Мувофиқат</th>
					<th class="vertical">Пуркунии ҷойи холӣ</th>
					<th class="vertical">Дохилкунии матн</th>
					<th class="vertical">Дохилкунии рақам</th>
					<th class="vertical">Ҳамагӣ</th>
					
					<th class="vertical">Оддӣ</th>
					<th class="vertical">Интихоби бисёр</th>
					<th class="vertical">Мувофиқат</th>
					<th class="vertical">Пуркунии ҷойи холӣ</th>
					<th class="vertical">Дохилкунии матн</th>
					<th class="vertical">Дохилкунии рақам</th>
					<th class="vertical">Ҳамагӣ</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = 0;?>
				<?php foreach($fanho as $item):?>
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td class="center"><?=getFacultyShort($item['id_faculty'])?></td>
						
						<td class="center bold">
							<?php
								$iq_data = query("SELECT `id_departament` FROM `iqtibosho` WHERE 
								`id_departament` IS NOT NULL AND 
								`id_faculty` = '{$item['id_faculty']}' AND
								`id_s_l` = '{$item['id_s_l']}' AND
								`id_s_v` = '{$item['id_s_v']}' AND
								`id_course` = '{$item['id_course']}' AND
								`id_spec` = '{$item['id_spec']}' AND
								`id_group` = '{$item['id_group']}' AND
								`id_fan` = '{$item['id_fan']}'");
							?>
							<?php foreach($iq_data as $iqt):?>
								<?=getDepartamentShort($iqt['id_departament'])?><br>
							<?php endforeach;?>
						</td>
						
						<td class="center"><?=$item['id_fan']?></td>
						<td style="width: 300px"><?=getFanTest($item['id_fan'])?></td>
						
						<td class="center"><?=$item['id_course']?></td>
						<td class="center"><?=getSpecialtyCode($item['id_spec'])?><?=getGroup($item['id_group'])?></td>
						
						<td class="center"><?=getStudyView($item['id_s_v'])?></td>
						<td class="center"><?=$item['h_y']?></td>
						
						<td class="center">
							<?php
								$id_iqtibos = $item['id_iqtibos'];
								$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
								foreach($teachers as $teacher){
									echo getShortName($teacher['id_teacher'])."<br>";
								}
							?>
						</td>
						
						<?php $type1 = count_table_where("questions", "`type` = '1' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'tj'")?>
						<td class="center" <?php if($type1 < $LIMITS[1]):?>style="background: red"<?php endif;?>>
							<?=$type1?>
						</td>
						
						<?php $type2 = count_table_where("questions", "`type` = '2' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'tj'")?>
						<td class="center" <?php if($type2 < $LIMITS[2]):?>style="background: red"<?php endif;?>>
							<?=$type2?>
						</td>
						
						<?php $type3 = count_table_where("questions", "`type` = '3' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'tj'")?>
						<td class="center" <?php if($type3 < $LIMITS[3]):?>style="background: red"<?php endif;?>>
							<?=$type3?>
						</td>
						
						<?php $type4 = count_table_where("questions", "`type` = '4' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'tj'")?>
						<td class="center" <?php if($type4 < $LIMITS[4]):?>style="background: red"<?php endif;?>>
							<?=$type4?>
						</td>
						
						<?php $type5 = count_table_where("questions", "`type` = '5' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'tj'")?>
						<td class="center" <?php if($type5 < $LIMITS[5]):?>style="background: red"<?php endif;?>>
							<?=$type5?>
						</td>
						
						<?php $type6 = count_table_where("questions", "`type` = '6' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'tj'")?>
						<td class="center" <?php if($type6 < $LIMITS[6]):?>style="background: red"<?php endif;?>>
							<?=$type6?>
						</td>
						
						<td class="center bold">
							<?=count_table_where("questions", "`id_fan` = '{$item['id_fan']}' AND `lang` = 'tj'")?>
						</td>
						
						
						<!-- -->
						<?php $type1 = count_table_where("questions", "`type` = '1' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'ru'")?>
						<td class="center" <?php if($type1 < $LIMITS[1]):?>style="background: red"<?php endif;?>>
							<?=$type1?>
						</td>
						
						<?php $type2 = count_table_where("questions", "`type` = '2' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'ru'")?>
						<td class="center" <?php if($type2 < $LIMITS[2]):?>style="background: red"<?php endif;?>>
							<?=$type2?>
						</td>
						
						<?php $type3 = count_table_where("questions", "`type` = '3' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'ru'")?>
						<td class="center" <?php if($type3 < $LIMITS[3]):?>style="background: red"<?php endif;?>>
							<?=$type3?>
						</td>
						
						<?php $type4 = count_table_where("questions", "`type` = '4' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'ru'")?>
						<td class="center" <?php if($type4 < $LIMITS[4]):?>style="background: red"<?php endif;?>>
							<?=$type4?>
						</td>
						
						<?php $type5 = count_table_where("questions", "`type` = '5' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'ru'")?>
						<td class="center" <?php if($type5 < $LIMITS[5]):?>style="background: red"<?php endif;?>>
							<?=$type5?>
						</td>
						
						<?php $type6 = count_table_where("questions", "`type` = '6' AND `id_fan` = '{$item['id_fan']}' AND `lang` = 'ru'")?>
						<td class="center" <?php if($type6 < $LIMITS[6]):?>style="background: red"<?php endif;?>>
							<?=$type6?>
						</td>
						
						<td class="center bold">
							<?=count_table_where("questions", "`id_fan` = '{$item['id_fan']}' AND `lang` = 'ru'")?>
						</td>
						
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>

		
		
		
		<!--
		<table class="table transcript" style="width:800px; font-size:14px; margin: 0 auto">
			<thead>
				<tr>
					<th class="center" style="width: 30px">№<br>р/т</th>
					<th class="center" style="width: 30px">ID FAN</th>
					<th class="center" style="width: 400px">Номи фан</th>
					<th class="center" style="width: 100px">Тоҷики</th>
					<th class="center" style="width: 100px">Руссӣ</th>
					
				</tr>
			</thead>

			<tbody>
				<?php $counter = 0;?>
				<?php foreach($fanho as $item):?>
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td class="center"><?=$item['id_fan']?></td>
						<td style="width: 300px"><?=getFanTest($item['id_fan'])?></td>
						<td class="center">
							<?=count_table_where("questions", "`id_fan` = '{$item['id_fan']}' AND `lang` = 'tj'")?>
						</td>
						<td class="center">
							<?=count_table_where("questions", "`id_fan` = '{$item['id_fan']}' AND `lang` = 'ru'")?>
						</td>
						
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		-->
		<br>
		<br>
		<br>
		<br>
		
		
	</body>
	
</html>