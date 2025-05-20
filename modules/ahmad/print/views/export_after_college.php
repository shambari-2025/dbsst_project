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
			padding: 4px;
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
		
		<div class="floatleft">
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th>№</th>
						<th>edu_KodFaculty</th>
						<th>edu_KodGroup</th>
						<th>FioTj</th>
						<th>DateBorn</th>
						<th>Ҷойи истиқомат</th>
						<th>cnt_Phone</th>
						<th>cnt_PhoneParent</th>
						<th>EndSch</th>
						<th>UchZaved</th>
						<th>fStudentID</th>
						<th>SerialDoc</th>
						<th>DataDoc</th>
						<th>Kvalif</th>
						<th>Аз рӯи ихтисос</th>
						<th>DataDog</th>
						<th>NDog</th>
						<th>NKit</th>
						<th>Date</th>
						<th>Summa</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($students as $item):?>
						<tr>
							<td class="center" style="width: 20px"><?=++$counter?>.</td>
							
							<td class="center"><?=getFacultyShort($item['id_faculty'])?></td>
							<td class="center"><?=getSpecialtyCode($item['id_spec'])?></td>
							<td class="left"><?=$item['fullname_tj']?></td>
							<td class="center"><?=$item['birthday']?></td>
							<td class="center"><?=$item['address']?></td>
							<td class="center"><?=$item['phone']?></td>
							<td class="center"><?=$item['phone_parents']?></td>
							<td class="center"><?=$item['soli_xatm']?></td>
							<td class="center"><?=$item['muasisa_name']?></td>
							<td class="center"><?=$item['id_student']?>/23</td>
							<td class="center"><?=$item['silsila']?><?=$item['number_hujjat']?></td>
							<td class="center"><?=$item['date_hujjat']?></td>
							<td class="center"><?=$item['spec']?></td>
							<td class="center"></td>
							<td class="center"><?=substr($item['added_time'], 0, -10)?></td>
							<td class="center"><?=getShartnomaNumber($item['id_student'])?></td>
							<td class="center"></td>
							<td class="center"></td>
							<td class="center">
								<?php if($item['id_s_t'] == 1):?>
									<?=getMoneyShartnoma($item['id_student'], S_Y)?>
								<?php elseif($item['id_s_t'] == 2):?>
									Ройгон
								<?php else:?>
									Квота
								<?php endif;?>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			<br><br><br>
		</div>
	</body>
	
</html>