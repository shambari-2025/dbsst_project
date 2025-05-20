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
						<img style="width:160px" src="<?=URL?>modules/login/views/images/ttu-logo.png" alt="<?=UNI_NAME?>">
					</p>
				</td>
				<td style="vertical-align: top; text-align: center">
					Донишгоҳи техникии Тоҷикистон ба номи академик М.С.Осимӣ<br>
					Таджикский технический университет имени академика М.С.Осими<br>
					<br>
					<br>
					Варақаи имтиҳонӣ №02-1001/22<br>
					Экзаменационная ведомость №02-1001/22<br>
					
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
				<span class="bold underline">Соли таҳсил(Учебный год):</span> 20<?=$S_Y?>-20<?=($S_Y+1)?>;
			</p>
			<p><span class="bold underline">Кафедра(Кафедра):</span> <?=getDepartament($id_departament)?></p>
			<p><span class="bold underline">Фанн(Дисциплина):</span> <?=getFanTest($id_fan)?></p>
			<p><span class="bold underline">Ному насаби устод(ФИО преподавателя):</span> <?=@getUserName($teachers[0]['id_teacher'])?></p>
			<p style="text-align:right"><span class="bold underline">Сана:</span> _______________</p>
		
		</div>
		
		<table class="table transcript" style="width:100%; font-size:14px">
			<thead class="center">
				<tr>
					<th rowspan="4">№ р/т</th>
					<th rowspan="4">Ному насаби донишҷӯ</th>
					<th rowspan="4"><p class="vertical">Шакли таҳсил</p></th>
					<th colspan="6">Давраҳо ва рузҳои имтиҳон</th>
				</tr>
				<tr>
					<th colspan="2">Якум</th>
					<th colspan="2">Дуввум</th>
					<th colspan="2">Севвум</th>
				</tr>
				<tr>
					<th colspan="2">Сана(<?=str_repeat("_", 15)?>)</th>
					<th colspan="2">Сана(<?=str_repeat("_", 15)?>)</th>
					<th colspan="2">Сана(<?=str_repeat("_", 15)?>)</th>
				</tr>
				<tr>
					<th>Натиҷаи<br>санҷиш</th>
					<th>Имзо</th>
					<th>Натиҷаи<br>санҷиш</th>
					<th>Имзо</th>
					<th>Натиҷаи<br>санҷиш</th>
					<th>Имзо</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td><?=$item['fullname_tj']?></td>
						<td class="center"><?=mb_strcut(getStudyType($item['id_s_t']), 1, 2)?></td>
						<td></td>
						<td></td>
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
		<br>
		
		<p>Давраи аввал:    беиҷозат __________  ғоиб __________  ноком  __________  комёб __________ имзо  __________</p>
		<p>Давраи дуввум:    беиҷозат __________  ғоиб __________  ноком  __________  комёб __________ имзо  __________</p>
		<p>Давраи саввум:    беиҷозат __________  ғоиб __________  ноком  __________  комёб __________ имзо  __________</p>
		
		<br><br>
		
		<table style="margin: 0 auto">
			<tbody>
				
				<tr>
					<td>Декани факултет</td>
					<td rowspan="2">______________</td>
				</tr>
				<tr><td>Декан факультета</td></tr>
			</tbody>
		</table>
		<br>
		<p>
		Эзоҳ:<br>
		1. Санҷиши гирифтаи донишҷуён бояд ба шакли «ғоиб» «комёб» ва «ноком» гузошта шавад.<br>
        2. Дар нусхаи асл тағйир додани баҳои гирифтаи донишҷӯ иҷозат дода намешавад.<br>
        3. Варақа новобаста аз забони таҳсил танҳо ба забони давлатӣ пур карда мешавад.<br>
        4. Аз донишҷуе, ки ному насабаш дар варақаи санҷиши нест, санҷиш қабул кардан қатьиян мань аст.<br>
        5. То саршавии имтиҳонҳо варақаи санҷиширо омузгори санҷишгиранда шахсан бояд ба деканат супорад.<br>
        6. Санҷиш аз руи ҷадвали аз тарафи декани факултет, тасдиқшуда, гузаронида мешавад.
		</p>
		
		<br>
		<br>
		<br>
		
		
	</body>
	
</html>