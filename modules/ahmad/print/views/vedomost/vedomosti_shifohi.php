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
					ВАРАҚАИИ САНҶИШӢ				
				</td>
			</tr>
		</table>
		<br>
		<table style="width:100%; font-size:14px">
			<tbody>
				<tr>
					<td class="left">Факултет: <?=getFaculty($id_faculty)?></td>
					<td class="right">Соли таҳсил: <?=getStudyYear($S_Y)?></td>
				</tr>
				<tr>
					<td class="left">Шакли таҳсил: <?=getStudyView($id_s_v)?></td>
					<td class="right">Семестр: <?=$semestr?></td>
				</tr>
				<tr>
					<td class="left">Ихтисос: <?=getSpecialtyCode($id_spec)?> <?=getSpecialtyTitle($id_spec)?> </td>
					<td class="right">Курс: <?=$id_course?></td>
				</tr>
				<tr>
					<td class="left"><?=getDepartament($id_cafedra)?> </td>
					<td class="right">Гуруҳ: <?=getGroup2($id_group)?></td>
				</tr>
				<tr>
					<td class="left">Фан: <?=getFanTest($id_fan)?> </td>
					<td class="right">Кредит: <?=$credits?></td>
				</tr>
				<tr>
					<td class="left">Ному насаби омӯзгор: <?=getUserName($teachers[0]['id_teacher'])?> </td>
					<td class="right"></td>
				</tr>
				<tr>
					<td class="left">Ному насаби ёвар: __________________________________________ </td>
					<td class="right"></td>
				</tr>
				<tr>
					<td class="left">Санаи қабули имтиҳон: "___"_________20__ </td>
					<td class="right"></td>
				</tr>
				
			</tbody>
		</table>
		<br>
		
		
		<table class="table transcript" style="width:100%; font-size:14px">
			<thead>
				<tr>
					<th class="center" rowspan="2">№</th>
					<th class="center" rowspan="2">Ному насаби донишҷӯ</th>
					<th class="center" rowspan="2">Шакли<br>таҳсил</th>
					<th class="center">Рейтинги 1</th>
					<th class="center">Рейтинги 2</th>
					<th class="center" rowspan="2">Холи миёнаи<br>рейтинг <br`>(Р1+Р2)/2*0,6</th>
					<th class="center" colspan="2">Имтиҳони ниҳоӣ</th>
				</tr>
				<tr>
					<th class="center">Хол</th>
					<th class="center">Хол</th>
					<th class="center">Хол</th>
					<th class="center">Имзо</th>
				</tr>
			</thead>

			<tbody>
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td><?=$item['fullname_tj']?></td>
						<td class="center"><?=mb_substr($item['study_type_title'], 0, 1)?></td>
						<td class="center">
							<?=$score1 = getNF2(1, $item['id'], $id_fan, $S_Y, $H_Y);?>
						</td>
						<td class="center">
							<?=$score2 = getNF2(2, $item['id'], $id_fan, $S_Y, $H_Y);?>
						</td>
						<td class="center">
							<?=$imt = round((($score1 + $score2)/ 2 * 0.6) , 2)?>
						</td>
						
						<td class="center">
							
						</td>
						<td class="center">
							
						</td>
					</tr>
				<?php endforeach;?>
					<tr>
						<td colspan="8">Теъдоди умумии донишҷӯён: <?=count($students)?></td>
					</tr>
			</tbody>
		</table>
		
		<br>
		<br>
		
		<table style="width: 850px; float: center;">
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
		</table>

		<div class="clear"></div>
		<br>
		<br>
		<br>
		
		
	</body>
	
</html>