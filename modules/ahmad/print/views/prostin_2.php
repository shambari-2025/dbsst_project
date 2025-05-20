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
	
	<body style="margin: 15px auto 0 15">
		<?//=$page_info['title'];?>
		<p><?=UNI_NAME?></p>
		<p><?=UNI_NAME_RU?></p>
		<p>Варақаи ҷамбастии имтиҳонотӣ-рейтингӣ<br>Общая экзаменационно-рейтинговая ведомость</p>
		<p>Факултети(Факультет): <?=getFaculty($id_faculty)?></p>
		<p>Гурӯҳ(Группа):<?=getSpecialtyCode($id_spec).getGroup($id_group)?>; Курс: <?=$id_course?>; Соли таҳсил(Учебный год): <?=getStudyYear($S_Y)?>;</p>
		<table class="table transcript" style="font-size: 14px !important">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th class="counter" rowspan="3">№</th>
					<th rowspan="3">Ному насаби донишҷӯ<br>Ф. И. О студента</th>
					<th rowspan="3" style="transform-origin: center; transform: rotate(180deg);writing-mode: vertical-rl;">шакли таҳсил</th>
					<?php for ($i = 1; $i <= $semestr; $i++):?>
						<?php $fans = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$i' AND `id_fan` != '1748' ORDER BY `id_fan`");?>
						<?php $colspan=0;?>
						<?php foreach($fans as $item):?>
							<?php 
								$colspan++;
								if(!empty($item['k_k'])){
									$colspan++;
								}
							?>
						<?php endforeach;?>
						<th colspan="<?=$colspan?>">Соли таҳсили <?=getStudyYearBySemestr($id_course, $i, false)?>, нимсолаи <?=getNimsolaBySemestr($i);?></th>
					<?php endfor;?>
				</tr>
				<tr style="background-color: #263544; color: #fff">
					<?php for ($i = 1; $i <= $semestr; $i++):?>
					<?php $fans = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$i' AND `id_fan` != '1748' ORDER BY `id_fan`");?>
						<?php foreach($fans as $item):?>
							<th style="transform-origin: center; transform: rotate(180deg);writing-mode: vertical-rl; height: 150px;">
								<?=getFanTest($item['id_fan'])?>
								<?php $taj_fans = array(34,35,36,1921,1922,2153,2546,2154);?>
								<?php if(!in_array($item['id_fan'], $taj_fans)):?>
									 &nbsp;(имтиҳон)
								<?php else:?>
									&nbsp;(таҷрибаомӯзӣ)
								<?php endif?>
							</th>
							<?php if(!empty($item['k_k'])):?>
							<th style="transform-origin: center; transform: rotate(180deg);writing-mode: vertical-rl;  height: 50px;"><?=getFanTest($item['id_fan'])?> &nbsp;(кори курсӣ)</th>
							<?php endif;?>
						<?php endforeach;?>
					<?php endfor;?>
				</tr>
				<tr style="background-color: #263544; color: #fff">
					<?php for ($i = 1; $i <= $semestr; $i++):?>
					<?php $fans = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$i' AND `id_fan` != '1748' ORDER BY `id_fan`");?>
						<?php foreach($fans as $item):?>
							<th>
								<?=($item['c_u'])?>
							</th>
							<?php if(!empty($item['k_k'])):?>
							<th>0</th>
							<?php endif;?>
						<?php endforeach;?>
					<?php endfor;?>
				</tr>
			</thead>
			<tbody class="center" id="tbody">
				<?php $c=0;?>
				<?php foreach ($students as $student):?>
				<?php
					$id_student = $student['id_student'];
					//$id_student = 11106;//for comment
					$id_s_t = $student['id_s_t'];
				?>
				<tr>
					<td><?=++$c;?>.</td>
					<td style="text-align:left;"><?=getUserName($id_student);//$student['fullname_tj'];?></td>
					<td>
						<?php if($id_s_t == 1):?>
							ш
						<?php elseif($id_s_t == 2):?>
							р
						<?php else:?>
							к
						<?php endif;?>
					</td>
					<?php for ($i = 1; $i <= $semestr; $i++):?>
						<?php
							$id_course = getCourseBySemestr($i);
							$H_Y = getNimsolaBySemestr($i);
						?>
						<?php $fans = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$i' AND `id_fan` != '1748' ORDER BY `id_fan`");?>
						<?php foreach($fans as $fan):?>
							<?php 
								$id_fan = $fan['id_fan'];
								//
								$count_fan = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `id_fan` = '$id_fan'");
								if(count($count_fan) == 1){
									$res_fan = query("SELECT COALESCE(`results`.`total_score`, 0) AS `total_score`,
													   COALESCE(`results`.`trimestr_score`, 0) AS `trimestr_score`,
													   COALESCE(`results`.`kori_kursi`, 0) AS `kori_kursi`
													FROM `results` 
													WHERE `results`.`id_student` = '$id_student'
														AND `results`.`id_fan` = '$id_fan'
												");
								}else{
								//
									$res_fan = query("SELECT COALESCE(`results`.`total_score`, 0) AS `total_score`,
														   COALESCE(`results`.`trimestr_score`, 0) AS `trimestr_score`,
														   COALESCE(`results`.`kori_kursi`, 0) AS `kori_kursi`
														FROM `results` 
														WHERE `results`.`id_student` = '$id_student'
															AND `results`.`id_fan` = '$id_fan'
															AND `results`.`id_course` = '$id_course' 
															AND `results`.`h_y` = '$H_Y'
													");
								}
								//print_arr($res_fan);
							?>
							<?php
								if($res_fan){
									if($res_fan[0]['total_score'] >=50){
										$total_score = $res_fan[0]['total_score'];
									}else{
										$total_score = $res_fan[0]['trimestr_score'];
									}									
								}else{
									$total_score = 0;
								}
								?>
								<?php if($total_score>=50):?>
									<td><?=getAnanavi($total_score)?></td>
								<?php else:?>
									<td style="background-color: red;"><?=$total_score?></td>
								<?php endif;?>
								<?php if(!empty($fan['k_k'])):?>
									<?php if(@$res_fan[0]['kori_kursi'] >= 50):?>
										<td><?=getAnanavi($res_fan[0]['kori_kursi'])?></td>
									<?php else:?>
										<td style="background-color:red;">0</td>
									<?php endif;?>
								<?php endif;?>
						<?php endforeach;?>
						
						
						
					<?php endfor;?>
						<?php// exit;?>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	<!--<meta http-equiv="refresh" content="10">-->
	</body>
</html>