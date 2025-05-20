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
					<th>Зинаи<br>таҳсил</th>
					<th>Шакли<br>таҳсил</th>
					<th>Ихтисос</th>
					<th>Гуруҳ </th>
					<th>Ному насаб</th>																																
					<th>Баҳои 4 (%)</th>																																
					<th>Баҳои 5 (%)</th>																																
				</tr>
			</thead>
			<tbody class="center" id="tbody">
				<?php $i = 1;?>
				<?php foreach($students as $student):?>
					<?php 
						$id_student = $student['id_student'];
						$results  = query("SELECT MIN(COALESCE(`results`.`total_score`, 0)) as `min`, 
												MAX(COALESCE(`results`.`total_score`, 0)) as `max`
											FROM `results`
											WHERE `id_student` = '$id_student'  
										");
					?>
					<?php if($results[0]['min'] >= 75):?>
						<?php
							$baho4 = query("SELECT * 
											FROM `results` 
											WHERE `id_student` = '$id_student' AND
												`total_score` >= 75 AND 
												`total_score` < 90
											");
							$foiz4 = 100 * count($baho4) / count($results);
							$bahogos = query("SELECT `total_score`
												FROM `results` 
												WHERE `id_student` = '$id_student' AND 
													`id_fan` IN (37, 1740, 2548)
											");
							$bahogos = $bahogos[0]['total_score'];
							
							// $bahorisola = query("SELECT `total_score`
												// FROM `results` 
												// WHERE `id_student` = '$id_student' AND 
													// `id_fan` IN (2590, 2425)
											// ");
							// $bahorisola = $bahorisola[0]['total_score'];
							//  Дар условияи поёни $bahorisola>=90 илова  ва коменти бологира тоза кардан даркор
						?>
						<?php if($foiz4 <=25 && $bahogos >= 90):?>
							<?php $info_std = query("SELECT * FROM `students` WHERE `id_student` = '$id_student' AND `s_y`='$S_Y' AND `h_y` = '$H_Y'");?>
							<tr>
								<td><?=$i;?></td>
								<td><?=getFacultyShort($info_std[0]['id_faculty']);?></td>
								<td><?=getStudyLevel($info_std[0]['id_s_l']);?></td>
								<td><?=getStudyView($info_std[0]['id_s_v']);?></td>
								<td><?=getSpecialtyCode($info_std[0]['id_spec']);?></td>
								<td><?=getGroup($info_std[0]['id_group']);?></td>
								<td><?=getUserName($id_student)."[".$id_student."]";?></td>
								<td><?=$foiz4?></td>
								<td><?=100 - $foiz4?></td>
								<?php $i++;?>
							</tr>
						<?php endif;?>
					<?php endif;?>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>