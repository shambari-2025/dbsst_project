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
				<td style="width: 40%"></td>
				<td>
					Ба ректори <?=UNI_NAME?>
					<b><?=RECTOR?></b><br>
					аз номи донишҷӯи курси <?=$student[0]['id_course']?>, ихтисоси 
					<?=getSpecialtyCode($student[0]['id_spec']).(getGroup($student[0]['id_group']))?><br> 
					факултети <?=getFaculty($student[0]['id_faculty'])?><br>
					<?=getUserName($student[0]['id_student'])?>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: justify; line-height: 25px;">
					<p class="center bold">АРИЗА</p>
					Дар баробари аризаи худ аз Шумо эҳтиромона хоҳиш менамоям, ки барои супоридани фарқиятҳои академӣ иҷозат диҳед.
					Ман дар <?=getHalfYear($query[0]['h_y'])?>и соли таҳсили <?=getStudyYear($query[0]['s_y'])?> аз фанҳои зерин фарқияти академӣ дорам:<br>
					
					<table style="border-collapse: collapse; width: 100%;" border="1">
						<thead class="center bold">
							<tr>
								<td style="width:10%;">р/т</td>
								<td>Номи фан</td>
								<td style="width:5%;">Миқдори<br>кредитҳо</td>
								<td style="width:5%;">Нархаш</td>
								<td style="width:10%;">Имзои<br>бақайдгиранда</td>
							</tr>
						</thead>
						<tbody>
						<?php $i=1;?>
							<?php foreach($fans as $fan):?>
							<tr>
								<td style="padding: 1px;"><?=$i;?>.</td>
								<td style="padding: 1px;"><?=getFanTest($fan['id_fan'])?><?php if($fan['type'] == 2){echo "<b> (Кори курсӣ)</b>";}?></td>
								<td style="padding: 1px; text-align:center;"><?php if($fan['credit'] != 0) {echo $fan['credit'];}else{echo "-";}?></td>
								<td style="padding: 1px; text-align:center;"><?php if($fan['money'] != 0) {echo $fan['money'];}else{echo "-";}?></td>
								<td style="padding: 1px;"></td>
							</tr>
							<?php $i++;?>
							<?php endforeach;?>
							<tr>
								<td colspan="2" style="text-align:right;"><b>Ҳамагӣ</b></td>
								<td style="text-align:center;"><?=$all_credits[0]['credits']?></td>
								<td colspan="2"><?=round($all_money[0]['moneys'],2)?></td>
							</tr>
						</tbody>
					</table>
					<br>
					
					<p style="text-align: center;">Маблағи иловагиро барои азхудкунии фанҳои мазкур ва супоридани фарқиятҳо вобаста ба кредитҳо пардохт менамоям</p>
					
					<br><br>
					<p style="text-align: right;">Имзо:________________</p>
					<p style="text-align: right;">Сана: <?=date("d.m.Y");?></p>		
		</table>
	</body>
</html>