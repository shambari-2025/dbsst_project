<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$page_info['title']?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="author" content="colorlib" />
		<!--<meta http-equiv="refresh" content="20">-->
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
			@media print {
			.more {
			 page-break-after: always;
			} 
		   } 
		</style>
	</head>
	
	<body style="width:94%; margin: 15px auto 0 auto">
		<?php foreach($students as $student):?>
			<?php 
				$id_student = $student['id'];
				$id_s_t = $student['id_s_t'];
				$jins = $student['jins'];
				$photo = $student['photo'];
			
			?>
			<table style="width:100%; margin: 0 auto;">
				<tbody class="center">
					<tr>
						<td>
							<table class="table transcript" style="width:100%; font-size:13px;">
								<tr>
									<td rowspan="2" style="width:40%">Муҳри<br>факултет</td>
									<td><b>БА ИМТИҲОН РОҲ<br> ДОДА ШУД</b></td>
								</tr>
								<tr>
									<td>
										<b>Декани факултет</b><br><br>
										___________________<br>
										(имзо)<br><br>
										<b><?=getUserName(getDecan($id_faculty, $S_Y, $H_Y))?></b>
									</td>
								</tr>
							</table>
						</td>
						<td style="vertical-align: center">
							<b>ВАРАҚАИ ҶАВОБИ ИМТИҲОНӢ</b>
						</td>
						<td>
							<?php $photo = getUserImg($id_student, $jins, $photo);?>
							<?php if($photo):?>
								<img style="width: 3cm; height: 4cm;" src="<?=$photo;?>">
							<?php endif;?>
						</td>
					</tr>
				</tbody>
			</table>
			<p class="bold">ФАКУЛТЕТИ <?=getFaculty($id_faculty)?><br>
			Фанни <?=getFanTest($id_fan)?><br>
			Донишҷӯи курс <?=$id_course?>, ихтисоси <?=getSpecialtyCode($id_spec)?><?=getGroup($id_group)?><br>
			<?=getUserName($id_student)?>(<?=mb_strcut(getStudyType($id_s_t), 1, 2)?>)<br>
			Омӯзгор:
				<?php foreach($teachers as $teacher):?>
					<?=getUserName($teacher['id_teacher'])?>,
				<?php endforeach;?>
			<br>
			<p class="bold">Билети №________</p>
			<p class="bold">Саволи 1. __________________________________________________________________</p>
			<p class="bold">Саволи 2. __________________________________________________________________</p>
			<p class="bold">Саволи 3. __________________________________________________________________</p>
			<p class="bold">Саволи 4. __________________________________________________________________</p>
			<p class="bold">Саволи 5. __________________________________________________________________</p>
			<br>
			<p class="bold">ҶАВОБ БА САВОЛҲОИ ИМТИҲОНӢ</p>
			<?php for($i=1; $i<=34; $i++):?>
				<p>__________________________________________________________________________</p>
			<?php endfor;?>
			<p class="bold">Эзоҳ: Вобаста ба миқдори саволҳо ва муҳимияти онҳо 100 холи имконпазири ниҳоӣ тақсим карда мешавад.</p>
			<table class="table transcript" style="width:100%; font-size:13px;">
				<tr class="bold center">
					<td rowspan="2">Натиҷагирӣ аз имтиҳони ниҳоӣ</td>
					<td>Саволи 1</td>
					<td>Саволи 2</td>
					<td>Саволи 3</td>
					<td>Саволи 4</td>
					<td>Саволи 5</td>
					<td>Ҳамагӣ холи ниҳоӣ</td>
				</tr>
				<tr class="bold center">
					<td>&nbsp;</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
			<br>
			<footer style="margin: 30px auto; width: 90%">
				<table style="width:100%;">
					<tr style="height: 50px;vertical-align: top;">
						<td class="bold center"rowspan="3" style="vertical-align: center">Аъзоёни комиссияи фаннӣ</td>
						<td>
							________________________
							<div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(имзо)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						</td>
						<td>
							________________________
							<div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ному насаби аъзои комиссия)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						</td>
					</tr>
					<tr style="height: 50px;vertical-align: top;">
						<td>
							________________________
							<div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(имзо)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						</td>
						<td>
							________________________
							<div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ному насаби аъзои комиссия)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						</td>
					</tr>
					<tr style="height: 50px;vertical-align: top;">
						<td>
							________________________
							<div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(имзо)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						</td>
						<td>
							________________________
							<div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ному насаби аъзои комиссия)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						
						</td>
					</tr>
				</table>
			</footer>
			<p class="more"></p>
			<?php //exit;?>
		<?php endforeach;?>
	</body>
</html>