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
				/*size: landscape;  Изменяем ориентацию страницы на ландшафтную */
				size: portrait; /* Изменяем ориентацию страницы на ландшафтную */
			}
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
		
		<table style="width:100%;">
			<tr class="bold">
				<td>
					<p class="center">
						<img style="width:160px" src="<?=URL?>userfiles/logo.png" alt="<?=UNI_NAME?>">
					</p>
				</td>
				<td style="vertical-align: top; text-align: center">
					<?=UNI_NAME?><br>
					<?=UNI_NAME_RU?><br>
					<br>
					<br>
					Варақаи ҷамбастии имтиҳонотӣ-рейтингӣ № <br>
					Общая экзаменационно-рейтинговая ведомость № <br>
					
				</td>
			</tr>
		</table>
		<br>
		<div class="floatleft">
			<p><span class="bold underline">Факултет(Факультет):</span> <?=getFaculty($id_faculty);?></p>
			<p>
				<span class="bold underline">Гурӯҳ(Группа):</span> <?=getSpecialtyCode($id_spec);?><?=getGroup2($id_group);?>; 
				<span class="bold underline">Курс:</span> <?=$id_course?>; 
				<span class="bold underline">Семестр:</span> <?=$semestr?>; 
				<span class="bold underline">Соли таҳсил(Учебный год):</span> 20<?=$S_Y?>-20<?=($S_Y+1)?>;
			</p>
		</div>
		
		
		
		<table class="table transcript" style="width:100%; font-size:14px">
			<thead>
				<tr>
					<th class="center">№<br>р/т</th>
					<th class="center">Ному насаби донишҷӯ</th>
					<th><p class="vertical">Шакли таҳсил</p></th>
					<?php foreach($fanlist as $f_item):?>
						<th class="center">
							<p class="vertical"><?=getFanTest($f_item['id_fan'])?> [<?=$f_item['c_u']?>-кр.]</p>
						</th>
						
						<?php if($f_item['k_k']):?>
							<th class="center">
								<p class="vertical">
									<?=getFanTest($f_item['id_fan'])?> (кори курсӣ)
								</p>
							</th>
						<?php endif;?>
						
					<?php endforeach;?>
				</tr>
			</thead>

			<tbody>
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td><?=$item['fullname_tj']?></td>
						<td class="center"><?=mb_strcut(getStudyType($item['id_s_t']), 1, 2)?></td>
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
							<?php endif;?>
						<?php endforeach;?>
					</tr>
				<?php endforeach;?>
				<tr>
					<td colspan="3"></td>
					<?php foreach($fanlist as $f_item):?>
						<th>
							<p class="vertical">
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
							<th class="center">
								<p class="vertical">
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