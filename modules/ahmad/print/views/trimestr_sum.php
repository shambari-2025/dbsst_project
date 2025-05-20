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
	
	<body style="width:94%; margin: 15px auto 0 auto">
		<?=$page_info['title'];?>
		<table class="table" style="font-size: 14px !important">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th class="counter">№</th>
					<th>Факултет</th>
					<th>Шакли <br>таҳсил</th>
					<th>Намуди<br> таҳсил</th>
					<th>Курс</th>
					<th>Ихтисос</th>
					<th>Гуруҳ </th>
					<th>Ному насаб</th>
					<th>Маблағ</th>
					<th>Маблағи пардохтшуда</th>												
				</tr>
			</thead>
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php foreach($students as $student):?>
					<tr>
						<td><?=$i?>.</td>
						<td><?=getFacultyShort($student['id_faculty'])?></td>
						<td><?=getStudyLevel($student['id_s_l'])?></td>
						<td><?=getStudyView($student['id_s_v'])?></td>
						<td><?=$student['id_course']?></td>
						<td><?=getSpecialtyCode2($student['id_spec'])?></td>
						<td><?=getGroup($student['id_group'])?></td>
						<td class="left"><?=getUserName($student['id_student'])?></td>
						<td><?=$student['money']?></td>
						<td>
							<?php
								$from_date = $student['date'];
								$dateTime = new DateTime($from_date);
								$dateTime->add(new DateInterval('P30D'));
								$to_date = $dateTime->format('Y-m-d H:i:s');
								echo $summa_suporid = count_summa_where("rasidho", "check_money", "id_student = '{$student['id_student']}' AND type = '11' AND payed = '1' AND payed_date >= '$from_date' AND payed_date <= '$to_date'");
							?>									
						</td>
					</tr>
					<?php $i++;?>
				<?php endforeach;?>
			</tbody>
		</table>
		<meta http-equiv="refresh" content="600">
	</body>
</html>