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
		*{
			font-size: 20px;
			font-family: "Palatino Linotype";
		}
		
		table {
			
			border-collapse: collapse;
			font-size:14px;
		}
		
		th, td {
			padding:10px; 
		}
		
		.box {
			height: 700px;
			page-break-inside: avoid;
			border: 1px solid #fff;
		}
		
		@media print {
			@page {
				/*size: landscape;  Изменяем ориентацию страницы на ландшафтную */
				size: portrait; /* Изменяем ориентацию страницы на ландшафтную */
			}
		}
		
		u {
			font-weight: bold;
		}
		
		.info_text {
			font-size: 14px;
			margin-top: -10px;
			display: block;
		}
		
	</style>
	
	<body>
		
		
		<!--
		<table style="width: 90%; margin: 10px auto; font-size: 14px">
			<tr class="left">
				<td style="width: 40%"></td>
				<td>
					Ба ректори ДТТ ба номи академик М.С. Осимӣ
					<b><?=RECTOR?></b>
					аз номи шаҳрванд <b><?=$student[0]['fullname_'.LANG]?></b>
					истиқоматкунандаи <b><?=getRegion($student[0]['id_region'])?>, <?=getDistrict($student[0]['id_district'])?>,
					<?=$student[0]['address']?></b>. хатмкардаи 
					<b>
					<?php if(!empty($student[0]['number_scholl'])):?>
						мактаби миёнаи №<?=$student[0]['number_scholl']?> дар соли <?=$student[0]['soli_xatm']?>
					<?php else:?>
						<?=$student[0]['muasisa_name']?> дар соли <?=$student[0]['soli_xatm']?>
					<?php endif;?>
					</b>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: justify; line-height: 25px;">
					<p class="center bold">АРИЗА</p>
					Аз Шумо эҳтиромона хоҳиш менамоям, ки барои қабули ҳуҷҷатҳои ман ба ихтисос (равия)-и
					<b><?=getSpecialtyCode($student[0]['id_spec'])?> - <?=getSpecialtyTitle($student[0]['id_spec'])?>
					(забони таҳсил - <?=getGroup2($student[0]['id_group'])?>)</b>

					шуъбаи <?=getStudyLevel($student[0]['id_s_l'])?> <?=getStudyType($student[0]['id_s_t'])?>, 
					факултети <b><?=getFaculty($student[0]['id_faculty'])?></b> донишгоҳ иҷозат диҳед. 
					Тавсияи ММТ назди Президенти Ҷумҳурии Тоҷикистон [  ] Рамзи ММТ 
					<?php if(!empty($student[0]['number_mmt'])):?>
						<?=$student[0]['number_mmt']?>
					<?php else:?>
						______________
					<?php endif;?>
					
					<p class="center">Маълумотҳои шахсӣ:</p>
					Санаи таваллуд <b><?=formatDate($student[0]['birthday'])?></b>,
					Ҷинс <b><?=getJins($student[0]['jins'])?></b>,
					Миллат <b><?=getNation($student[0]['id_nation'])?></b>,
					Вазъи иҷтимои <b><?=$vazi_ijtimoi[$student[0]['v_ijtimoi']]?></b>,
					Вазъи оилавӣ <b><?=$vazi_oilavi_form[$student[0]['v_oilavi']]?></b>,
					Ҳуҷҷати хатм <b><?=$hujjati_xatm[$student[0]['id_hujjat']]?>, № <?=$student[0]['silsila']?>-<?=$student[0]['number_hujjat']?></b>,
					санаи додан <b><?=formatDate($student[0]['date_hujjat'])?> с.</b>,
					Шиноснома <?=$student[0]['number']?>, аз <?=formatDate($student[0]['date'])?>,  <?=$student[0]['maqomot']?>,
					Телефон  <b><?=$student[0]['phone']?></b>,
					Телефони волидайн  <b><?=$student[0]['phone_parents']?></b>,
					E-mail
					<b>
					<?php if(!empty($student[0]['email'])):?>
						<?=$student[0]['email']?>
					<?php else:?>
						надорам
					<?php endif;?>
					</b>
					Ба хобгоҳ ниёз 
					<b>
					<?php if(!empty($student[0]['xobgoh'])):?>
						дорам
					<?php else:?>
						надорам
					<?php endif;?>
					</b>
					
					Вазифа, ҷойи кор ва собиқаи корӣ 
					<b>
					<?php if(!empty($student[0]['spec'])):?>
						<?=$student[0]['spec']?>,
					<?php else:?>
						надорам,
					<?php endif;?>
					</b>
					
					<?php if(!empty($student[0]['unvoni_harbi'])):?>
						Уҳдадории ҳарбӣ <?=$unvonho[$student[0]['unvoni_harbi']]?>, <?=$lashkar[$student[0]['lashkar']]?>
					<?php endif;?>

					<p class="center">Маълумоти иловагӣ:</p>
					Маълумот дар бораи аҳли оила: <b><?=$student[0]['family_info']?></b>
					<br>
					Бо иҷозатномаи пешбурди фаъолияти таълимӣ ва шаҳодатномаи аккредитатсияи давлатии ДТТ ба номи академик М.С. Осимӣ шинос шудам ва барои ҷамъоварӣ ва коркарди маълумоти шахсиам дар Системаи иттилотии идоракунии донишгоҳ розигӣ медиҳам. ______________
				</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr>
				<td>Санаи пур кардан 
				<?php if($student[0]['id_s_l'] == 1):?>
					<?=date("d.m.Y");?>
				<?php else:?>
					20.09.2023 с.
				<?php endif;?>
				</td>
				<td class="right">Имзо______________________</td>
			</tr>
			
		</table>
		
		<br>
		<br>
		<br>
		<br>
		аз номи шаҳрванд <b><?=$student[0]['fullname_'.LANG]?></b>
					истиқоматкунандаи <b><?=getRegion($student[0]['id_region'])?>, <?=getDistrict($student[0]['id_district'])?>,
					<?=$student[0]['address']?></b>. хатмкардаи 
					<b>
					<?php if(!empty($student[0]['number_scholl'])):?>
						мактаби миёнаи №<?=$student[0]['number_scholl']?> дар соли <?=$student[0]['soli_xatm']?>
					<?php else:?>
						<?=$student[0]['muasisa_name']?> дар соли <?=$student[0]['soli_xatm']?>
					<?php endif;?>
					</b>
		-->
		
		
		
		<p class="center">ВАЗОРАТИ САНОАТ ВА ТЕХНОЛОГИЯҲОИ НАВИ ҶУМҲУРИИ ТОҶИКИСТОН<br>
		ДОНИШГОҲИ ТЕХНОЛОГИИ ТОҶИКИСТОН</p>
		<p>&nbsp;</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;Ба ректори Донишгоҳи технологии Тоҷикистон <u>муҳтарам <?=RECTOR?></u></p>
		<p>аз номи шаҳрванд <u><?=$student[0]['fullname_tj']?></u></p>
		<span class="info_text center">(Ному насаб)</span>
		<p>истиқоматкунандаи <u><?=$student[0]['address']?></u></p>
		<span class="info_text center">(Ҷойи истиқомат)</span>
		<p>хатмкардаи 
			<u>
				<?php if(!empty($student[0]['number_scholl'])):?>
					мактаби миёнаи №<?=$student[0]['number_scholl']?> дар соли <?=$student[0]['soli_xatm']?>
				<?php else:?>
					<?=$student[0]['muasisa_name']?> дар соли <?=$student[0]['soli_xatm']?>
				<?php endif;?>
			</u>
		</p>
		<span class="info_text center">(Соли хатм ва номи муассисаи таълимӣ нишон дода шавад)</span>
		
		<p>______________________________________________________________________________________________</p>
		<span class="info_text center">(Мавҷудияти медали тилло (нуқра) барои хатми мактаби миёна, гимназия ва литсейҳо, дипломи имтиёзноки коллеҷу техникумҳо ва омӯзишгоҳи касбӣ-техникӣ қайд карда шавад)</span>
		<p>Кадом забони хориҷиро омӯхтааст: ____________________________________________________________</p>
		<p>&nbsp;</p>
		<p class="center bold">А Р И З А</p>
		
		<p>Хоҳишмандам барои супоридани хуҷҷатҳо ба факултети <u><?=getFaculty($student[0]['id_faculty'])?></u></p>
		<span class="info_text center">(Номи факултет)</span>
		<p>аз рӯи ихтисоси <u><?=getSpecialtyCode($student[0]['id_spec'])?> - <?=getSpecialtyTitle($student[0]['id_spec'])?></u></p>
		<p>
		шакли таҳсили <u><?=getStudyView($student[0]['id_s_v'])?></u> тарзи таҳсили <u><?=getStudyType($student[0]['id_s_t'])?></u> 
		<?php if(isset($student[0]['number_mmt'])):?>
			аз рӯи натиҷаҳои имтиҳоноти Маркази миллии тестии назди Президенти Ҷумҳурии Тоҷикитон 
		<?php endif;?>	
		ба ман иҷозат диҳед.
		</p>
		
		<p>Ба хобгоҳ ниёз
			<?php if(!empty($student[0]['xobgoh'])):?>
				<u>дорам</u>
			<?php else:?>
				<u>надорам</u>
			<?php endif;?>
		</p>
		
		<p class="center bold">Маълумот дар бораи худам:</p>
		<p>Ҷинс <u><?=getJins($student[0]['jins'])?></u>, Сол ва ҷои таваллуд <u><?=formatDate($student[0]['birthday'])?>, <?=getRegion($student[0]['id_region'])?>, <?=getDistrict($student[0]['id_district'])?></u></p>
		<p>Миллат <u><?=getNation($student[0]['id_nation'])?></u> Телефон <u><?=$student[0]['phone']?></u></p>
		<p>ҷои кор ва собиқаи умумии мехнатӣ то супоридани ҳуҷҷатҳо: __________________________________________________________________________________________________________________________________</p>
		
		<p>Ному насаби волидайн, ҷои кор, истиқомат ва вазифаи онҳо:</p>
		
		<?php $parents = explode("\n", $student[0]['family_info']);?>
		
		<?php foreach($parents as $item):?>
			<p><u><?=$item;?></u></p>
		<?php endforeach;?>
		
		
		
		<p>Маълумоти иловагӣ дар бораи худ: ___________________________________________________________________________________________________________________________________________________________</p>
		<p>Бо қоидаи қабули МТОК дар соли <?=date("Y")?> шинос ҳастам.</p>
		<p>&laquo;______&raquo;&nbsp; ___________________с.2024.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Имзо______________________</p>
		
		
		
	
	</body>
	
</html>