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
			transform-origin: center;
			transform: rotate(180deg);
			writing-mode: vertical-rl;
			height: 150px;
		}
		
		table.transcript td {
			padding: 3px;
		}
		
		
		
		
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
		
		<table style="width:100%;">
			<tr class="bold">
				<td>
					<p class="center">
						<img style="width:160px" src="<?=URL?>modules/login/views/images/ttu-logo.png" alt="<?=UNI_NAME?>">
					</p>
				</td>
				<td style="vertical-align: top; text-align: center">
					<?=UNI_NAME?><br>
					<?=UNI_NAME_RU?><br>
					<br>
					<br>
					Варақаи имтиҳонӣ №Т<?=$id_iqtibos;?>/<?=$S_Y;?><br>
					Экзаменационная ведомость №Т<?=$id_iqtibos;?>/<?=$S_Y;?><br>
					
				</td>
			</tr>
		</table>
		<br>
		<div class="floatleft">
			<p><span class="bold underline">Факултет(Факультет):</span> <?=getFaculty($id_faculty);?></p>
			<p>
				<span class="bold underline">Гурӯҳ(Группа):</span> <?=getSpecialtyCode($id_spec);?><?=getGroup2($id_group);?>; 
				<span class="bold underline">Курс:</span> <?=$id_course?>; 
				<span class="bold underline">Семестр:</span> <?=$semestr?>; 
				<span class="bold underline">Соли таҳсил(Учебный год):</span> <?=getStudyYear($S_Y)?>;
			</p>
			<p><span class="bold underline">Кафедра(Кафедра):</span> <?=getDepartament($id_departament)?></p>
			<p><span class="bold underline">Фанн(Дисциплина):</span> <?=getFanTest($id_fan)?></p>
			<p><span class="bold underline">Ному насаби устод(ФИО преподавателя):</span> <?=@getUserName($teachers[0]['id_teacher'])?></p>
			<p><span class="bold underline">Санҷиши фосилавии(Рейтинг)1: __________Санҷиши фосилавии(Рейтинг)2: __________ Имтиҳони ҷамъбастӣ(Экзамен): __________</span>
				<?php //if(isset($date_imt)):?>
					<?php //echo date('d.m.Y', strtotime($date_imt))?>
				<?php //endif;?>
			</p>
		
		</div>
		
		
		
		<table class="table transcript" style="width:100%; font-size:14px">
			<thead>
				<tr>
					<th rowspan="2" class="center">№<br>р/т</th>
					<th rowspan="2" class="center">Ному насаби донишҷӯ</th>
					<th colspan="6" class="center">Рейтинг, хол</th>
					<th colspan="5" class="center">Баҳои ҷамъбастӣ<br>(Итоговая оценка)</th>
					<th rowspan="2" class="center vertical" style="width: 100px;">Имзои устод</th>
				</tr>
				<tr class="v_th">
					<th class="center vertical">
						Рейтинги 1 (Р1)
					</th>
					<th class="center">
						<div class="vertical">Рейтинги 2 (Р2)</div>
					</th>
					<th class="center vertical">
						Холи миёнаи рейтингӣ<br>Рм=(Р1+Р2)/2)*0,5
					</th>
					<th colspan="2" class="center vertical">
						Холи ҷамъбасти имтиҳонӣ<br> Хҷ=Иҷ*0,5
					</th>
					<th class="center vertical">
						Холи умумии имтиҳонӣ<br> Бу=Рм*Хҷ
					</th>
					<th class="center vertical">
						Эквиваленти ҳуруфӣ
					</th>
					<th class="center vertical">
						Эквиваленти ададӣ
					</th>		
					<th class="center vertical">
						Натиҷаи имтиҳон бо назардошти апелятсия
					</th>
					<th colspan="2" class="center vertical">
						Баҳои ҷамбастӣ бо назардошти апелятсия
					</th>
				</tr>
				<tr>
					<?php for($k=1; $k<=14;$k++):?>
					<th><?=$k;?></th>
					<?php endfor;?>
				</tr>
				
			</thead>

			<tbody>
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td><?=$item['fullname_tj']?></td>
						<td class="center">0</td>
						<td class="center">0</td>
						<td class="center">0</td>
						<td class="center">
							<?=$imt = $item['trimestr_score']?>
						</td>
						<td class="center">0</td>

						<td class="center">
							<?=getLatter($imt);?>
						</td>
						<td class="center">
							<?=getAdad($imt);?>
						</td>
						<td class="center">
							<?=getAnanavi($imt)?>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<p>Ворид намудани тағийрот ва иловаҳо дар варақаи имтиҳонӣ қатъиян манъ аст (Внесение изменений в экзаменационной ведомость не допускается)</p>
		<br>
		
		<table style="width: 350px; float: right;">
			<tbody>
				<tr>
					<td>Имзои Омӯзгор</td>
					<td rowspan="2">______________</td>
				</tr>
				<tr>
					<td>Подпись преподавателя</td>
				</tr>
				<tr>
					<td>Декани факултет</td>
					<td rowspan="2">______________</td>
				</tr>
				<tr><td>Декан факультета</td></tr>
			</tbody>
		</table>

		<div class="clear"></div>
		<br>
		<br>
		<br>
		
		
	</body>
	
</html>