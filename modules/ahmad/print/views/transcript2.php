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
		<style>
			.vertical{
				transform-origin: center;
				transform: rotate(180deg);
				writing-mode: vertical-rl;
				height: 90px;
			}
			@media print {
				body {
					-webkit-print-color-adjust: exact; /* Для корректной печати цвета в WebKit-браузерах (Chrome, Safari) */
					print-color-adjust: exact; /* Для других браузеров */
				}
			}
		</style>
	</head>
	
	<body style="width:94%; margin: 15px auto 0 auto">
		
		<table style="width:100%; margin: 0 auto;">
			<tbody class="center">
				<tr>
					<td><img src="<?=URL?>userfiles/mblogo.jpg" style="width:128px; margin-bottom: -10px"></td>
					<td style="vertical-align: top">
						<h3 style="margin:0"><?=mb_strtoupper(UNI_NAME)?></h3>
						<h3 style="margin:0">ТРАНСКРИПТ (маълумотномаи академӣ)</h3>
						<p><hr style="border-width:3px;"></p>
						<h4 style="margin:0">734061, Ҷумҳурии Тоҷикистон, шаҳри Душанбе –  кӯчаи Н. Қарабоев 63/3</h4>
						<h4 style="margin:0">№ ______ аз "____"____________________<?=date('Y')?>c.</h4>
					
					</td>
				</tr>
			</tbody>
		</table>
		<br>
		<br>
		<table style="width:100%; font-size:14px">
			<tbody>
				<tr>
					<td rowspan="5">. </td>
					<td class="bold right"> Ному насаб</td>
					<td><em><?=getUserName($id_student)?></em></td>
					<td class="bold right">ID донишҷӯ</td>
					<td><em><?=$id_student?></em></td>
				</tr>
				<tr>
					<td class="bold right">Ихтисос</td>
					<td><em><?=getSpecialtyCode($id_spec)?> - <?=getSpecialtyTitle($id_spec)?></em></td>
					<td class="bold right">Бахш - Гуруҳ</td>
					<td><em><?=$id_course?> - <?=getSpecialtyCode($id_spec).getGroup($id_group)?></em></td>
				</tr>
				<tr>
					<td class="bold right">Факулта</td>
					<td><em>"<?=getFaculty($id_faculty)?>"</em></td>
					<td class="bold right">Шӯъба</td>
					<td><em> <?=getStudyView($id_s_v)?></em></td>
				</tr>
				<tr>
					<td colspan="4" class="bold">Бо фармоиши&nbsp; №____ аз "__" ____.20<?=$info_std[0]['minsy']?>&nbsp; ба курси 1-ум қабул шудааст.</td>
				</tr>
				<tr>
					<td colspan="4">Аз соли 20<?=$info_std[0]['minsy']?> то соли <?=date('Y')?> таҳсил намуда, ба чунин натиҷа сазовор гаштааст:</td>
				</tr>
			</tbody>
		</table>
		
		
		<?php /*<table style="width:100%; font-size:14px">
			<tbody>
				<tr class="bold">
					<td colspan="2">Ному насаб: <?=getUserName($id_student)?></td>
				</tr>
				
				<tr>
					<td style="width: 30%; text-align: right;">
						<img style="width: 120px" src="<?=URL?>userfiles/qr-transcripts/<?=$id_student?>.png">
					</td>
					<td style="width: 70%" class="left">
						Барнома: <?=getStudyLevel($id_s_l)?><br>
						Шуъба: <?=getStudyView($id_s_v)?><br>
						Шакли таҳсил: <?=getStudyType($id_s_t)?><br>
						Ихтисос: <?=getSpecialtyCode($id_spec)?> - <?=getSpecialtyTitle($id_spec)?><br>
						Факултет: <?=getFaculty($id_faculty)?>
					</td>
					
				</tr>
			</tbody>
		</table>*/?>
		<br>
		<br>
		<br>
		<table class="table transcript" style="width:100%; font-size:13px;">
			<thead class="center" style="background: darkgrey">
				<tr>
					<th style="width: 50px;">Бахш</th>
					<th style="width: 50px;">Сем.</th>
					<th>Фан</th>
					<th class="vertical" style="width: 45px;">Ҳамагӣ</th>
					<th class="vertical" style="width: 25px;">Баҳо</th>
					<th class="vertical" style="width: 20px;">Баҳо(анъ)</th>
					<th class="vertical" style="width: 30px;">Балл</th>
					<th class="vertical" style="width: 20px;">Кредит</th>
					<th class="vertical" style="width: 20px;">Кред.азхуд.</th>
					<th class="vertical" style="width: 20px;">Компонент</th>
				</tr>
			</thead>
		
			<tbody class="center">
				<?php 
					$credits = 0;
					$cr_hatmi = 0;
					$data = array();
				?>
				<?php for ($i = 1; $i <= $semestr; $i++):?>
					<tr>
						<?php $id_sy = getStudyYearStudentBySemestr($id_student, $i)?>
						<th colspan="8">Нимсолаи <?=$i?> <?php if($id_sy):?>(Соли таҳсили <?=getStudyYear($id_sy)?>)<?php endif;?>
					</tr>
					<?php $id_hy=getNimsolaBySemestr($i);?>
					<?php $fanlist = query("SELECT * FROM `nt_content` WHERE `id_nt`='$id_nt' AND `semestr`='$i' AND `id_fan` != '1748' ORDER BY `id_fan`");?>
					<?php $sem_summa = $sem_credit = 0;?>
					<?php foreach($fanlist as $item):?>
						<tr>
							<td><?=getCourseBySemestr($i)?></td>
							<td><?=$i?></td>
							<td class="left"><?=getFanTest($item['id_fan'])?></td>
							<td>
								<?php $fan_result = query("SELECT * FROM `results` 
															WHERE `id_student`='$id_student' AND
																	`id_fan` = '{$item['id_fan']}' AND
																	`semestr` = '$i'
									");
								?>
							
								<?php if(@$fan_result[0]['total_score'] >= 50):?>
									<?php $total_score = @$fan_result[0]['total_score']?>
								<?php else:?>
									<?php $total_score = @$fan_result[0]['trimestr_score']?>
								<?php endif;?>
								<?=$total_score;?>
							</td>
							<td><?=getLatter($total_score)?></td>
							<td><?=getAnanavi($total_score)?></td>
							<td><?=getAdad($total_score)?></td>
							<td>
								<?=$item['c_u']?>
								<?php $credits += $item['c_u']?>
							</td>
							<td><?=$item['c_u']?></td>
							<?php $sem_summa += $item['c_u'] * getAdad($total_score)?>
							<?php $sem_credit += $item['c_u'] ?>
							<td>
								<?php if($item['intixobi']):?>
									Интихобӣ
								<?php else:?>
									<?php $cr_hatmi += $item['c_u'];?>
									Ҳатмӣ
								<?php endif;?>
							</td>
						</tr>
						<!-- Кори курси -->
						<?php if($item['k_k']):?>
							<tr>
								<td><?=getCourseBySemestr($i)?></td>
								<td><?=$i?></td>
								<td class="left"><?=getFanTest($item['id_fan'])?> (кори курсӣ)</td>
								<td><?=$total_score=@$fan_result[0]['kori_kursi']?></td>
								<td><?=getLatter($total_score)?></td>
								<td><?=getAnanavi($total_score)?></td>
								<td><?=getAdad($total_score)?></td>
								<td>0</td>
								<td>0</td>
								<td>
									<?php if($item['intixobi']):?>
										Интихобӣ
									<?php else:?>
										Ҳатмӣ
									<?php endif;?>
								</td>
							</tr
						<?php endif;?>
						<!-- Кори курси -->
					<?php endforeach;?>
					<?php
						$datas[$i]['semestr'] = $i;
						$datas[$i]['summa'] = $sem_summa;
						$datas[$i]['credit'] = $sem_credit;
					?>
				<?php endfor;?>
			</tbody>
		</table>
		<br><br>
		<?php //print_arr($datas)?>
		<table class="table transcript" style="width:100%; font-size:13px; float:right;">
			<tbody class="center bold;">
				<tr>
					<th rowspan="<?=count($datas)+2?>" style="width: 50%;border-top: solid white;border-left: solid white;border-bottom: solid white;">	Ҷ.М.</td>
					<th style="background: darkgrey">Сем.</td>
					<th style="background: darkgrey">Балл</td>
					<th style="background: darkgrey">Кредит</td>
					<th style="background: darkgrey">Кред. азхуд.</td>
					<th style="background: darkgrey">GPA</td>
				</tr>
				<?php $all_c=$all_s=0;?>
				<?php foreach($datas as $data):?>
					<tr>
						<td><?=$data['semestr']?></td>
						<td><?=$data['summa']?></td>
						<td><?=$data['credit']?></td>
						<td><?=$data['credit']?></td>
						<td><?=round($data['summa'] / $data['credit'], 2)?></td>
						<?php $all_c+=$data['credit'];$all_s+=$data['summa'];?>
					</tr>
				<?php endforeach;?>
				<tr>
					<td colspan="4"></td>
					<td class="bold"><?=round($all_s/$all_c,2)?></td>
				</tr>
			</tbody>
		</table>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<p style="font-weight: bold; text-align:right">
			Ҳамагӣ кредитҳо азхуд карда шуданд: <?=$credits?><br>		
			Аз он ҷумла: Ҳатмӣ <?=$cr_hatmi?><br>		
			<em>1 кредит = 24 соати анъанавӣ</em>	
		</p>
		<br>
		<br>
		<br>
		<br>
		<footer style="margin: 30px auto; width: 90%">
			<table style="width:100%;">
				<tr style="height: 50px;vertical-align: top;">
					<td class="bold">Ректор</td>
					<td>
						________________________
						<div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(имзо ва таърихи рӯз)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
					</td>
					<td class="bold">Раҳмонзода З. Ф.</td>
				</tr>
				<tr style="height: 50px;vertical-align: top;">
					<td class="bold">Муовини  ректор оид ба таълим <br>ва идораи сифати таҳсилот</td>
					<td>
						________________________
						<div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(имзо ва таърихи рӯз)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
					</td>
					<td class="bold">Насридинзода М.Ш.</td>
				</tr>
				<tr style="height: 50px;vertical-align: top;">
					<td class="bold">Сардори маркази БМ ва Т</td>
					<td>
						________________________
						<div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(имзо ва таърихи рӯз)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
					</td>
					<td class="bold">Абдулозода Б.Н.</td>
				</tr>
			</table>
		</footer>
	</body>
</html>