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
		
		
		table {
			
			border-collapse: collapse;
			font-size:14px;
		}
		
		th, td {
			padding:8px; 
		}
		
		.hujjatho td {
			padding: 2px;
		}
		
		.hujjatho tr td:nth-child(1) {
			text-align: center
		}
		
		.box {
			height: 700px;
			page-break-inside: avoid;
			border: 1px solid #fff;
		}
		
		@page {
			
		}
		
		u {
			font-weight: bold;
		}
	</style>
	
	<body>
		
		
		<table border="1">
			<tbody>
				<tr>
					<td class="center" style="height: 4cm;width: 3cm;">
						<?php $photo = getUserImg($student[0]['id'], $student[0]['jins'], $student[0]['photo']);?>
						<img style="height: 4cm;width: 3cm;" src="<?=$photo;?>">
					</td>
					<td class="right">
						Ба фармони Вазири маориф ва илми Ҷуҳурии Тоҷикистон аз 5-июли соли 2000 №392 тасдиқ карда шудааст
						<p class="center"><?=UNI_NAME?></p>
					</td>
					<td rowspan="3" style="width: 10px; padding: 0;">
						<div class="vertical">Хати бурриш</div>
					</td>
					
					<td class="center" style="height: 4cm;width: 3cm;">
						<?php $photo = getUserImg($student[0]['id'], $student[0]['jins'], $student[0]['photo']);?>
						<img style="height: 4cm;width: 3cm;" src="<?=$photo;?>">
					</td>
					<td class="right">
						Ба фармони Вазири маориф ва илми Ҷуҳурии Тоҷикистон аз 5-июли соли 2000 №392 тасдиқ карда шудааст
						<p class="center"><?=UNI_NAME?></p>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Забонхати № <?=getShartnomaNumber($student[0]['id'])?> шуъбаи <?=getStudyLevel($student[0]['id_s_l'])?> <?=getStudyType($student[0]['id_s_t'])?>, <br>
						Ман довталаб <b><?=$student[0]['fullname_'.LANG]?></b> <br>
						ҳуҷҷатҳои зеринро ба факултети <b><?=getFaculty($student[0]['id_faculty'])?></b> <br>
						ба ихтисос (равия)-и
						<b><?=getSpecialtyCode($student[0]['id_spec'])?> - <?=getSpecialtyTitle($student[0]['id_spec'])?> </b><br>
						супоридам.
						
						<table border="1" class="hujjatho">
							<tr>
								<th>№</th>
								<th><p align="center">Номгуи ҳуҷҷатҳо</p></th>
								<th style="width: 60px">Қайди қабули ҳуҷҷатҳо</th>
							</tr>
							<tr>
								<td>1.</td>
								<td>Ариза</td>
								<td class="center">+</td>
							</tr>
							<tr>
								<td>2.</td>
								<td>6 дона расми андозаи 3х4</td>
								<td class="center">+</td>
							</tr>
							<tr>
								<td>3.</td>
								<td>Маълумотномаи тиббии намуди №038</td>
								<td class="center">+</td>
							</tr>
							<tr>
								<td>4.</td>
								<td>Нусхаи шиноснома</td>
								<td class="center">+</td>
							</tr>
							<tr>
								<td>5.</td>
								<td>Нусхаи маълумотномаи ҳарби</td>
								<td class="center">+</td>
							</tr>
							<tr>
								<td>6.</td>
								<td><p>Нусхаи дафтарчаи меҳнати</p></td>
								<td class="center"></td>
							</tr>
							<tr>
								<td>7.</td>
								<td>Тавсифнома </td>
								<td class="center"></td>
							</tr>
							<tr>
								<td>8.</td>
								<td colspan="2">
									<?php //print_arr($student);?>
									<?=$hujjati_xatm[$student[0]['id_hujjat']]?>
									№ <?=$student[0]['silsila']?>-<?=$student[0]['number_hujjat']?> аз <?=formatDate($student[0]['date_hujjat'])?> с. 
									
									<?php if(!empty($student[0]['number_scholl'])):?>
										МТМУ №<?=$student[0]['number_scholl']?>
									<?php endif;?>
									
									<?php if(!empty($student[0]['muasisa_name'])):?>
										<?=$student[0]['muasisa_name']?>
									<?php endif;?>
									
									
									
									
									<!--
									Дипломи № ДМБ-0149633 аз  с. Донишгоҳи техникии Тоҷикистон ба номи акад. М.С. Осимӣ
									-->
								</td>
							</tr>
							
							<?php if($student[0]['id_s_t'] == 3):?>
								<tr>
									<td>9.</td>
									<td><p><strong>Квота:</strong> - роххати хукумати нохия</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td>10.</td>
									<td>- тавсияи шуъбаи маорифи нохия ва қарори Шӯрои педагогии мактаб</td>
									<td class="center"></td>
								</tr>
							<?php endif;?>
							
							<tr class="center">
								<td colspan="3">Ҳуҷҷатҳои дигар:</td>
							</tr>
							<tr>
								<td>1.</td>
								<td>Шартномаи № <?=getShartnomaNumber($student[0]['id'])?> аз <?=substr($student[0]['added_time'], 0, -10)?></td>
								<td></td>
							</tr>
							
							<?php if($student[0]['id_s_t'] == 1):?>
								<tr>
									<td>2.</td>
									<td>Ҳуҷҷатҳои пардохти МТ №<?=$checks[0]['id']?> аз <?=formatDateNoTime($checks[0]['payed_date'])?> (<?=$checks[0]['check_money']?> сомони)</td>
									<td></td>
								</tr>
							<?php endif;?>
							
							<tr>
								<td>!</td>
								<td colspan="2" style="font-size: 10px;">Забонхати мазкур ҳуҷҷати тасдиқкунандаи қабули ҳуҷҷатҳои Шумо ба донишгоҳ мебошад. 
								Бинобар ин, ҳуҷҷатҳои супоридаи шумо бе пешниҳоди забонхати мазкур бозпас гардонида намешавад. 
								Ҳангоми гум шудани забонхат дарҳол ба Комиссияи қабули 
								<?=UNI_NAME?> муроҷиат намоед!
								</td>
							</tr>
						</table>
					</td>
					
					
					
					
					
					<td colspan="2">
						Забонхати № <?=getShartnomaNumber($student[0]['id'])?>  шуъбаи <?=getStudyLevel($student[0]['id_s_l'])?> <?=getStudyType($student[0]['id_s_t'])?>, <br>
						Ман довталаб <b><?=$student[0]['fullname_'.LANG]?></b> <br>
						ҳуҷҷатҳои зеринро ба факултети <b><?=getFaculty($student[0]['id_faculty'])?></b> <br>
						ба ихтисос (равия)-и
						<b><?=getSpecialtyCode($student[0]['id_spec'])?> - <?=getSpecialtyTitle($student[0]['id_spec'])?> </b><br>
						супоридам.
						
						<table border="1" class="hujjatho">
							<tr>
								<th>№</th>
								<th><p align="center">Номгуи ҳуҷҷатҳо</p></th>
								<th style="width: 60px">Қайди қабули ҳуҷҷатҳо</th>
							</tr>
							<tr>
								<td>1.</td>
								<td>Ариза</td>
								<td class="center">+</td>
							</tr>
							<tr>
								<td>2.</td>
								<td>6 дона расми андозаи 3х4</td>
								<td class="center">+</td>
							</tr>
							<tr>
								<td>3.</td>
								<td>Маълумотномаи тиббии намуди №038</td>
								<td class="center">+</td>
							</tr>
							<tr>
								<td>4.</td>
								<td>Нусхаи шиноснома</td>
								<td class="center">+</td>
							</tr>
							<tr>
								<td>5.</td>
								<td>Нусхаи маълумотномаи ҳарби</td>
								<td class="center">+</td>
							</tr>
							<tr>
								<td>6.</td>
								<td><p>Нусхаи дафтарчаи меҳнати</p></td>
								<td class="center"></td>
							</tr>
							<tr>
								<td>7.</td>
								<td>Тавсифнома </td>
								<td class="center"></td>
							</tr>
							<tr>
								<td>8.</td>
								<td colspan="2">
									
									<?=$hujjati_xatm[$student[0]['id_hujjat']]?>
									№ <?=$student[0]['silsila']?>-<?=$student[0]['number_hujjat']?> аз <?=formatDate($student[0]['date_hujjat'])?> с. 
									
									<?php if(!empty($student[0]['number_scholl'])):?>
										МТМУ №<?=$student[0]['number_scholl']?>
									<?php endif;?>
									
									<?php if(!empty($student[0]['muasisa_name'])):?>
										<?=$student[0]['muasisa_name']?>
									<?php endif;?>
									
									
									<!--
									Дипломи № ДМБ-0149633 аз 15-09-2020 с. Донишгоҳи техникии Тоҷикистон ба номи акад. М.С. Осимӣ
									-->
								</td>
							</tr>
							
							<?php if($student[0]['id_s_t'] == 3):?>
								<tr>
									<td>9.</td>
									<td><p><strong>Квота:</strong> - роххати хукумати нохия</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td>10.</td>
									<td>- тавсияи шуъбаи маорифи нохия ва қарори Шӯрои педагогии мактаб</td>
									<td class="center"></td>
								</tr>
							<?php endif;?>
							
							<tr class="center">
								<td colspan="3">Ҳуҷҷатҳои дигар:</td>
							</tr>
							<tr>
								<td>1.</td>
								<td>Шартномаи № <?=getShartnomaNumber($student[0]['id'])?> аз <?=substr($student[0]['added_time'], 0, -10)?></td>
								<td></td>
							</tr>
							<?php if($student[0]['id_s_t'] == 1):?>
								<tr>
									<td>2.</td>
									<td>Ҳуҷҷатҳои пардохти МТ №<?=$checks[0]['id']?> аз <?=formatDateNoTime($checks[0]['payed_date'])?> (<?=$checks[0]['check_money']?> сомони)</td>
									<td></td>
								</tr>
							<?php endif;?>
							<tr>
								<td>!</td>
								<td colspan="2" style="font-size: 10px;">Забонхати мазкур ҳуҷҷати тасдиқкунандаи қабули ҳуҷҷатҳои Шумо ба донишгоҳ мебошад. 
								Бинобар ин, ҳуҷҷатҳои супоридаи шумо бе пешниҳоди забонхати мазкур бозпас гардонида намешавад. 
								Ҳангоми гум шудани забонхат дарҳол ба Комиссияи қабули 
								<?=UNI_NAME?> муроҷиат намоед!
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				
				
				
				<tr>
					<td colspan="2">
						<p>Довталаб: <b><?=$student[0]['fullname_'.LANG]?></b> _________________ </p>
						<p>
						Чоп кард: <?=getShortName($student[0]['added_by'])?>
						<span style="float: right">Санаи пур кардан <?=formatdate(substr($student[0]['added_time'], 0, -9))?> с.</span>
						</p>
					</td>
					
					<td colspan="2">
						<p>Мутахассис: <b><?=getUserName($student[0]['added_by'])?></b> _________________ 
						<span style="float: right"><?=URL?></span>
						<br>
						<span style="float: right">Логин: <b><?=$student[0]['login']?></b> Парол: <b><?=$student[0]['password']?></b></span>
						
						</p>
						<p>
						Чоп кард: <?=getShortName($student[0]['added_by'])?>
						<span style="float: right">Санаи пур кардан <?=formatdate(substr($student[0]['added_time'], 0, -9))?> с.</span>
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		
	</body>
	
</html>