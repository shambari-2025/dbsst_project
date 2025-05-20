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
			border: 1px solid;
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
	</style>
	
	<body>
		
		
		
		<table style="width: 500px">
			<tr class="center bold">
				<td colspan="2">ДЕЛОИ ШАХСИИ ДОНИШҶӮ</td>
			</tr>
			<tr>
				<td style="width: 150px">Делаи №</td>
				<td>
					<u><?=$number;?></u>
				</td>
			</tr>
			
			<tr>
				<td style="width: 150px">Н. Н</td>
				<td>
					<u><?=$student[0]['fullname_'.LANG]?></u>
				</td>
			</tr>
			
			<tr>
				<td>Соли дохилшавӣ</td>
				<td>
					<u>20<?=S_Y?> c.</u>
				</td>
			</tr>
			
			<tr>
				<td>Факултет</td>
				<td>
					<u><?=getFaculty($student[0]['id_faculty'])?></u>
				</td>
			</tr>
			
			<tr>
				<td>Ихтисос</td>
				<td>
					<u><?=getSpecialtyCode2($student[0]['id_spec'])?> - <?=getSpecialtyTitle($student[0]['id_spec'])?></u>
				</td>
			</tr>
			
			<tr>
				<td>Шуъба</td>
				<td>
					<u><?=getStudyView($student[0]['id_s_v'])?>, <?=getStudyType($student[0]['id_s_t'])?></u>
				</td>
			</tr>
			
			<tr>
				<td>Миқдори холҳо</td>
				<td>
					<u><?=$student[0]['total_score_mmt']?></u>
				</td>
			</tr>
			
			<tr>
				<td>Хатмкардаи</td>
				<td>
					<u>
					<?php if(!empty($student[0]['number_scholl'])):?>
						МТМУ №<?=$student[0]['number_scholl']?>
					<?php else:?>
						<?=$student[0]['muasisa_name']?> дар соли <?=$student[0]['soli_xatm']?>
					<?php endif;?>
					</u>
				</td>
			</tr>
			
			<tr>
				<td>Суроға</td>
				<td>
					<u><?=$student[0]['address']?></u>
				</td>
			</tr>
			
			<tr>
				<td colspan="2" style="text-align: right">
					<br>
					ИМЗО ____________
				</td>
			</tr>
		</table>
		
		<br>
		<br>
		<br>
		<br>
		
	
	</body>
	
</html>