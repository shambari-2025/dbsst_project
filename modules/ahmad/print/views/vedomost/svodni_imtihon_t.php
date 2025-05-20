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
				size: landscape;  /*Изменяем ориентацию страницы на ландшафтную */
				/*size: portrait;  /*Изменяем ориентацию страницы на ландшафтную */
			}
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
		
		<table style="width:100%;">
			<tr class="bold">
				<td style="vertical-align: top; text-align: center;">
					<p style="text-transform: uppercase"><?=UNI_NAME?><br>
					МАРКАЗИ БАҚАЙДГИРӢ, МАШВАРАТ ВА ТЕСТӢ<br></p>
					<p>Варақаи ҷамбастӣ, семестри <?=$semestr?>, соли таҳсили <?=getStudyYear($S_Y)?><br>
						Курси <?=$id_course?>, Гуруҳи <?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group)?><br>
						(Дараҷаи азхудкунӣ)																																			
					</p>
					
				</td>
			</tr>
		</table>
		<br>

		
		<table class="table transcript" style="width:100%; font-size:14px">
			<thead>
				<tr>
					<th class="center" rowspan="2">№</th>
					<th class="center" rowspan="2">ID</th>
					<th class="center" rowspan="2">Ному насаби донишҷӯ</th>
					<?php foreach($fanlist as $f_item):?>
						<th class="center" colspan="4">
							<p class="vertical"><?=getFanTest($f_item['id_fan'])?>[<?=$f_item['credits']?> кр]</p>
						</th>
						
						<?php if($f_item['k_k']):?>
							<th class="center" colspan="4">
								<p class="vertical">
									<?=getFanTest($f_item['id_fan'])?> (кори курсӣ)
								</p>
							</th>
						<?php endif;?>
					<?php endforeach;?>
					<th class="center" rowspan="2">GPA</th>
				</tr>
				<tr>
					<?php foreach($fanlist as $f_item):?>
						<th class="center">
							<p class="vertical">Ҳам.</p>
						</th>
						<th class="center">
							<p class="vertical">Рақ.</p>
						</th>
						<th class="center">
							<p class="vertical">Ҳар.</p>
						</th>
						<th class="center">
							<p class="vertical">Трад.</p>
						</th>
						
						<?php if($f_item['k_k']):?>
						<th class="center">
							<p class="vertical">Ҳам.</p>
						</th>
						<th class="center">
							<p class="vertical">Рақ.</p>
						</th>
						<th class="center">
							<p class="vertical">Ҳар.</p>
						</th>
						<th class="center">
							<p class="vertical">Трад.</p>
						</th>
						<?php endif;?>
						
					<?php endforeach;?>
				</tr>
			</thead>

			<tbody>
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					<?php $all_credit = $all_summ = 0; ?>
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td class="center"><?=$item['id']?></td>
						<td><?=$item['fullname_tj']?></td>
						<?php foreach($fanlist as $f_item):?>
							<?php 
								$score = getTotalScore($item['id'], $f_item['id_fan'], $S_Y, $H_Y);
								if($score < 50){
									$trimestr = getTrimestrScore($item['id'], $f_item['id_fan'], $S_Y, $H_Y);
									if($trimestr >= 50){
										$score = $trimestr;
									}
								}
							?>
							
							<td class="center bold">
								<?php if($score <= 50):?>
									<span style="color: red"><?=$score?></span>
								<?php elseif($score >= 90):?>
									<span style="color: #2ad005"><?=$score?></span>
								<?php else:?>
									<?=$score?>
								<?php endif;?>
							</td>
							<td class="center bold">
								<?php if($score <= 50):?>
									<span style="color: red"><?=getAdad($score)?></span>
								<?php elseif($score >= 90):?>
									<span style="color: #2ad005"><?=getAdad($score)?></span>
								<?php else:?>
									<?=getAdad($score)?><br>
									<?//=$creditifan;?>
								<?php endif;?>
							</td>
							<td class="center bold">
								<?php if($score <= 50):?>
									<span style="color: red"><?=getLatter($score)?></span>
								<?php elseif($score >= 90):?>
									<span style="color: #2ad005"><?=getLatter($score)?></span>
								<?php else:?>
									<?=getLatter($score)?>
								<?php endif;?>
							</td>
							<td class="center bold">
								<?php if($score <= 50):?>
									<span style="color: red"><?=getAnanavi($score)?></span>
								<?php elseif($score >= 90):?>
									<span style="color: #2ad005"><?=getAnanavi($score)?></span>
								<?php else:?>
									<?=getAnanavi($score)?>
								<?php endif;?>
							</td>
							<?php 
								$all_credit += $f_item['credits'];
								$all_summ += $f_item['credits'] * getAdad($score);
 							?>
						
							
							<?php if($f_item['k_k']):?>
								<?php $score_kk =getKK($item['id'], $f_item['id_fan'], $S_Y, $H_Y)?>
								<td class="center bold">
									<?php if($score_kk <= 50):?>
										<span style="color: red"><?=$score_kk?></span>
									<?php elseif($score_kk >= 90):?>
										<span style="color: #2ad005"><?=$score_kk?></span>
									<?php else:?>
										<?=$score_kk?>
									<?php endif;?>
								</td>
								<td class="center bold">
									<?php if($score_kk <= 50):?>
										<span style="color: red"><?=getAdad($score_kk)?></span>
									<?php elseif($score_kk >= 90):?>
										<span style="color: #2ad005"><?=getAdad($score_kk)?></span>
									<?php else:?>
										<?=getAdad($score_kk)?>
									<?php endif;?>
								</td>
								<td class="center bold">
									<?php if($score_kk <= 50):?>
										<span style="color: red"><?=getLatter($score_kk)?></span>
									<?php elseif($score_kk >= 90):?>
										<span style="color: #2ad005"><?=getLatter($score_kk)?></span>
									<?php else:?>
										<?=getLatter($score_kk)?>
									<?php endif;?>
								</td>
								<td class="center bold">
									<?php if($score_kk <= 50):?>
										<span style="color: red"><?=getAnanavi($score_kk)?></span>
									<?php elseif($score_kk >= 90):?>
										<span style="color: #2ad005"><?=getAnanavi($score_kk)?></span>
									<?php else:?>
										<?=getAnanavi($score_kk)?>
									<?php endif;?>
								</td>
							<?php endif;?>
						<?php endforeach;?>
						<td class="center">
							<?=round($gpa = $all_summ / $all_credit, 2)?>
						</td>
					</tr>
				<?php endforeach;?>
				<tr>
					<td colspan="3"></td>
					<?php foreach($fanlist as $f_item):?>
						<th colspan="4">
							<p class="center" >
							<?php
								$id_iqtibos = $f_item['id'];
								$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
								foreach($teachers as $teacher){
									echo getShortName($teacher['id_teacher'])."<br>";
								}
							?>
							</p>
						</th>
						
						<?php if($f_item['k_k']):?>
							<th class="center" colspan="4">
								<p class="center">
								<?php
									$id_iqtibos = $f_item['id'];
									$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos' AND `type` = 'kori_kursi'");
									foreach($teachers as $teacher){
										echo getShortName($teacher['id_teacher'])."<br>";
									}
								?>
								</p>
							</th>
						<?php endif;?>
					<?php endforeach;?>
				</tr>
			</tbody>
		</table>
		<br>
		<br>
		
		
	</body>
	
</html>