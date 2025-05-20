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
			padding:10px; 
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
		tdd {
			padding:1px;
		}
	</style>
	
	<body>
		
		<?php //print_arr($student);?>
		
		<table style="width: 90%; margin: 10px auto; font-size: 14px">
			<tr class="left">
				<td style="width: 55%"></td>
				<td>
					Ба ректори <?=UNI_NAME?><br>
					<b><?=RECTOR?></b><br>
					аз номи донишҷӯи курси <?=$student[0]['id_course']?>, ихтисоси 
					<?=getSpecialtyCode($student[0]['id_spec']).(getGroup($student[0]['id_group']))?><br> 
					факултети <?=getFaculty($student[0]['id_faculty'])?><br>
					<?=getUserName($student[0]['id_student'])?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: justify;">
					<p class="center bold">АРИЗА</p>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Дар баробари аризаи худ аз Шумо эҳтиромона хоҳиш менамоям, 
					ки барои иштирок намудан дар триместр (сессияи иловагӣ) иҷозат диҳед.
					Ман аз <?=getHalfYear($query[0]['h_y'])?>и соли таҳсили <?=getStudyYear($query[0]['s_y'])?> 
					аз фанҳои зерин қарзи академӣ дорам:<br>
					
					<table style="border-collapse: collapse; width: 100%;" border="1">
						<thead class="center bold">
							<tr>
								<td style="width:1%; text-align:center;">р/т</td>
								<td>Номи фан</td>
								<td style="width:10%;">Баҳои <br>пешина</td>
								<td style="width:5%;">Миқдори<br>кредитҳо</td>
								<td style="width:5%;">Нархаш</td>
								<td style="width:20%;">Номи омӯзгор</td>  
								<td style="width:5%;">Имзо</td>  
							</tr>
						</thead>
						<tbody>
						<?php $i=1;?>
							<?php foreach($fans as $fan):?>
							<tr>
								<td style="padding: 1px; width:5%; text-align:center;"><?=$i;?>.</td>
								<td style="padding: 1px;"><?=getFanTest($fan['id_fan'])?></td>
								<td style="padding: 1px; text-align:center;"><?=$fan['old_score']?> <?=getLatter($fan['old_score'])?></td>
								<td style="padding: 1px; text-align:center;"><?=$fan['c_u']?>=<?=$fan['c_f_u']?></td>
								<td style="padding: 1px; text-align:center;"><?php if($fan['money'] != 0) {echo $fan['money'];}else{echo "-";}?></td>
								<td style="padding: 1px;"></td>
								<td style="padding: 1px;"></td>
							</tr>
							<?php $i++;?>
							<?php endforeach;?>
							<tr>
								<td colspan="3" style="text-align:right;"><b>Ҳамагӣ</b></td>
								<td style="text-align:center;"><?=$all_faol_credits[0]['faol_credits']?></td>
								<td colspan="2" class="center"><?=round($all_money[0]['moneys'],2)?> сомонӣ</td>
							</tr>
						</tbody>
					</table>
					<br>
					
					<p style="text-align: justify;">Маблағи иловагиро барои азхудкунии фанҳои мазкур, 
					ки дар ҷадвал овардашудааст (бо гурӯҳ) ё (ба тафри инфиродӣ ва машварат бо омӯзгор) 
					вобаста ба кредитҳо пардохт менамоям.</p>
					
					<br><br>
					<p style="text-align: right;">Имзои донишҷӯ:________________</p>
					<p style="text-align: right;">Сана: <?=date("d.m.Y");?></p>
				</td>
			</tr>
			<tr>
				<td>
					Мувофиқа карда шуд:
					<br>
					<br>
				</td>
			</tr>
		</table>
		
		<table style="width: 70%; margin: 10px auto; font-size: 14px">
			<tr>
				<td>Сардори ИТ М</td>
				<td>________________</td>
				<td>Зарифбеков М. Ш.</td>
			</tr>
			<tr>
				<td>Декани <?=getFaculty($student[0]['id_faculty'])?></td>
				<td>________________</td>
				<td>________________</td>
			</tr>
			<tr>
				<td>Сардори МБМ ва Т</td>
				<td>________________</td>
				<td>Абдулозода Б. Н.</td>
			</tr>
		</table>
	</body>
</html>