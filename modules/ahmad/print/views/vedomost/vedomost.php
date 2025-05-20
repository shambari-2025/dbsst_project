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
			padding: 2px;
		}
		
		.v_th th {
			width: 45px
		}
		
		.vertical {
			writing-mode: vertical-rl;
			text-orientation: inherit;
			transform: rotate(180deg);
			margin: 10px;
			margin-block: auto;
			max-height: 133px;
		}
		
		table.transcript td {
			padding: 3px;
		}
		
		@media print {
			@page {
				/*size: landscape;  Изменяем ориентацию страницы на ландшафтную */
				size: portrait; /* Изменяем ориентацию страницы на ландшафтную */
			}
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
		
		<table style="width:100%;">
			<tr class="bold">
				<td>
					<p class="center">
						<img style="width:160px" src="<?=URL?>userfiles/logo.png" alt="<?=UNI_NAME?>">
					</p>
				</td>
				<td style="vertical-align: top; text-align: center; text-transform: uppercase">
					<?=UNI_NAME?><br>
					<br>
					МАРКАЗИ БАҚАЙДГИРӢ, МАШВАРАТ ВА ТЕСТӢ				
					<br>
					<br>
					ВАРАҚАИ ҶАМЪБАСТИИ ИМТИҲОНӢ №<?=$id_iqtibos;?>/<?=$S_Y;?><br>					
				</td>
			</tr>
		</table>
		<br>
		<table style="width:100%; font-size:14px">
			<tbody>
				<tr>
					<td class="left">Факултет: <?=getFaculty($id_faculty)?></td>
					<td class="right bold">Тасдиқ менамоям:</td>
				</tr>
				<tr>
					<td class="left">Ихтисос: <?=getSpecialtyCode($id_spec)?> - <?=getSpecialtyTitle($id_spec);?></td>
					<td class="right">Сардори идораи таълимию методӣ</td>
				</tr>
				<tr>
					<td class="left">Гуруҳ: <?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group);?>, Курс: <?=$id_course?>, Семестр: <?=$semestr?>, Соли таҳсил: 20<?=$S_Y?>-20<?=($S_Y+1)?></td>
					<td class="right">_____________ н.и.ф-м., дотсент Зарифбеков М.Ш.</td>
				</tr>
				<tr>
					<td class="left">Шакли таҳсил: <?=getStudyView($id_s_v)?>, Забони таҳсил: <?=$lang?>, Зинаи таҳсил: <?=getStudyLevel($id_s_l)?></td>
					<td class="right">"___"________________<?=date('Y')?></td>
				</tr>
				<tr>
					<td class="left">Фан: <?=getFanTest($id_fan)?>, Кредит: <?=$credits?></td>
					<td class="right"></td>
				</tr>
				<tr>
					<td class="left">Санаи  имтиҳони ниҳоӣ: <?php echo @date('d.m.Y', strtotime($date_imt))?> </td>
					<td class="right"></td>
				</tr>
			</tbody>
		</table>
		<br>
		<!--
		<div class="floatleft">
			<p>Факултет: <?=getFaculty($id_faculty);?></p>
			<p>Ихтисос: <?=getSpecialtyCode($id_spec)?> - <?=getSpecialtyTitle($id_spec);?></p>
			<p>Гуруҳ: <?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group);?>, Курс: <?=$id_course?>, Семестр: <?=$semestr?>, Соли таҳсил: 20<?=$S_Y?>-20<?=($S_Y+1)?></p>
			<p>Шакли таҳсил: <?=getStudyView($id_s_v)?>, Забони таҳсил: <?=$lang?>, Зинаи таҳсил: <?=getStudyLevel($id_s_l)?></p>
			<p>Фан: <?=getFanTest($id_fan)?>, Кредит: <?=$credits?></p>
			<p>Санаи  имтиҳони ниҳоӣ: <?php echo @date('d.m.Y', strtotime($date_imt))?> </p>
		</div>
		-->
		
		
		<table class="table transcript" style="width:100%; font-size:14px">
			<thead>
				<tr>
					<th class="center">№</th>
					<th class="center">ID</th>
					<th class="center">Ному насаби донишҷӯ</th>
					<th class="center">Р1</th>
					<th class="center">Р2</th>
					<th class="center">Имтиҳон</th>
					<th class="center">Ҳамагӣ</th>
					<th class="center">Рақамӣ</th>
					<th class="center">Ададӣ</th>
					<th class="center">Анъанавӣ</th>
				</tr>
			</thead>

			<tbody>
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td class="center"><?=$item['id']?></td>
						<td><?=$item['fullname_tj']?></td>
						<td class="center">
							<?=$score1 = getNF2(1, $item['id'], $id_fan, $S_Y, $H_Y);?>
						</td>
						<td class="center">
							<?=$score2 = getNF2(2, $item['id'], $id_fan, $S_Y, $H_Y);?>
						</td>
						<td class="center">
							<?=$imt = getIMT($item['id'], $id_fan, $S_Y, $H_Y)?>
						</td>
						
						<td class="center">
							<?=$total = round(getTotalScore($item['id'], $id_fan, $S_Y, $H_Y),2)?>
						</td>
						<td class="center">
							<?=getAdad($total);?>
						</td>
						<td class="center">
							<?=getLatter($total);?>
						</td>
						<td class="center">
							<?=getAnanavi($total)?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		
		<br>
		<br>
		<br>
		<br>
		<!--<table style="width: 850px; float: center;">
			<tbody>
				<tr>
					<td>Сардори идораи таълимию методӣ:<br><br></td>
					<td>______________<br><br></td>
					<td>Зарифбеков Мародбек Ширинбекович<br><br></td>
				</tr>
				<tr>
					<td>Декани факултети <?=getFaculty($id_faculty)?><br><br></td>
					<td>______________<br><br></td>
					<td><?=@getUserName(getDecan($id_faculty, $S_Y, $H_Y))?><br><br></td>
				</tr>
				<tr>
					<td>Омӯзгори имтиҳонгиранда<br><br></td>
					<td>______________<br><br></td>
					<td><?=@getUserName($teachers[0]['id_teacher'])?><br><br></td>
				</tr>
			</tbody>
		</table>-->
		<table style="width: 650px; float: center;">
			<tbody>
				<tr>
					<td>Омузгори дарсдиҳанда:<br><br></td>
					<td>______________<br><br></td>
					<td><?=@getUserName($teachers[0]['id_teacher'])?><br><br></td>
				</tr>
				<tr>
					<td>Сардори маркази БМ ва тестӣ:<br><br></td>
					<td>______________<br><br></td>
					<td><?=ANT?><br><br></td>
				</tr>
				<tr>
					<td>Декани факултети <?=getFaculty($id_faculty)?><br><br></td>
					<td>______________<br><br></td>
					<td><?=@getUserName(getDecan($id_faculty, $S_Y, $H_Y))?><br><br></td>
				</tr>
			</tbody>
		</table>

		<div class="clear"></div>
		<br>
		<br>
		<br>
		
		
	</body>
	
</html>