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
					<th>Курс</th>
					<th>Ихтисос</th>
					<th>Гуруҳ </th>
					<th>Ному насаб</th>
					<th>Шакли таҳсил</th>
					<th>Намуди стипендия</th>												
				</tr>
			</thead>
			
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php foreach($students as $s):?>
					<?php
						$results = query("SELECT
											`id_student`,
										MIN(COALESCE(`results`.`total_score`, 0)) as `min`, 
										MAX(COALESCE(`results`.`total_score`, 0)) as `max`, 
											COALESCE(COUNT(CASE WHEN `total_score` < 75 THEN 1 END), 0) as `count_below_75`
										FROM
											`results`
										WHERE
											`id_student` = '{$s['id_student']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'
										GROUP BY
											`id_student`;
						");
					?>
					<?php if($results[0]['count_below_75'] <=2 &&$results[0]['min'] >= 50 ):?>
						<tr>
							<td><?=$i;?>.</td>
							<td><?=getFacultyShort($s['id_faculty'])?></td>
							<td><?=$s['id_course']?></td>
							<td><?=getSpecialtyCode($s['id_spec'])?></td>
							<td><?=getGroup($s['id_group'])?></td>
							<td class="left"><?=getUserName($s['id_student'])?></td>
							<td><?=getStudyType($s['id_s_t'])?></td>
							<td>
								<?php if($results[0]['min'] >=90):?>
									Аъло
								<?php elseif($results[0]['min'] >= 75 && $results[0]['max']>=90):?>
									Хубу аъло
								<?php elseif($results[0]['min'] >= 75 && $results[0]['max']<90):?>
									Хуб
								<?php else:?>
									Омехта
								<?php endif;?>
							</td>
						</tr>
						<?php $i++;?>
					<?php endif;?>
				<?php endforeach;?>
			</tbody>
		</table>
		<meta http-equiv="refresh" content="600">
	</body>
</html>