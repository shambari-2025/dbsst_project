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
	
		<style>
			.border {
				border-right: 3px solid #000 !important;
			}
		</style>
	</head>
	
	<body style="margin: 15px auto 0 15">
		<?//=$page_info['title'];?>
		<p>
			<?=UNI_NAME?><br>
			Варақаи ҷамбастии имтиҳонотӣ-рейтингӣ<br>
			Факултет: <?=getFaculty($id_faculty)?><br>
			Гурӯҳ: <?=getSpecialtyCode($id_spec).' '.getGroup($id_group)?>; Курс: <?=$id_course?>; Соли таҳсил: <?=getStudyYear($S_Y)?>;
		</p>
		
		<?php //print_arr($students);?>
		
		<table class="table transcript" style="font-size: 14px !important">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th class="counter" rowspan="3">№</th>
					<th rowspan="3">Ному насаби донишҷӯ<br>Ф. И. О студента</th>
					<th rowspan="3" style="transform-origin: center; transform: rotate(180deg);writing-mode: vertical-rl;">шакли таҳсил</th>
					<?php for ($i = 1; $i <= $semestr; $i++):?>
						<?php $fans = query("SELECT `id`,`k_k` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$i'");?>
						<?php $colspan = 0;?>
						<?php foreach($fans as $item):?>
							<?php 
								$colspan++;
								if(!empty($item['k_k'])){
									$colspan++;
								}
							?>
						<?php endforeach;?>
						<th colspan="<?=$colspan?>" style="background-color: red; border-right: 3px solid #000 !important">Семестри <?=$i?></th>
					<?php endfor;?>
					<th rowspan="3" style="transform-origin: center; transform: rotate(180deg);writing-mode: vertical-rl;">GPA</th>
				</tr>
				
				<tr style="background-color: #263544; color: #fff">
					<?php for ($i = 1; $i <= $semestr; $i++):?>
						<?php $fans = query("SELECT `nt_content`.*, `fan_test`.`title_tj` FROM `nt_content`
						INNER JOIN `fan_test` ON `fan_test`.`id` = `nt_content`.`id_fan`
						WHERE `nt_content`.`id_nt` = '$id_nt' AND `nt_content`.`semestr` = '$i' ORDER BY `nt_content`.`id_fan`");?>
						<?php $s = 0;?>
						<?php foreach($fans as $item):?>
							<th <?php if(count($fans) - 1 == $s):?>class="border"<?php endif;?> style="width: 120px; transform-origin: center; transform: rotate(180deg);writing-mode: vertical-rl; height: 150px;">
								<?=$item['title_tj']?>
								
							</th>
							<?php if(!empty($item['k_k'])):?>
								<th style="background-color: blue; color: #fff; transform-origin: center; transform: rotate(180deg);writing-mode: vertical-rl;  height: 50px;">
									<?=$item['title_tj']?> &nbsp;(кори курсӣ)
								</th>
							<?php endif;?>
							<?php $s++;?>
						<?php endforeach;?>
					<?php endfor;?>
				</tr>
				
				<tr style="background-color: #263544; color: #fff">
					<?php for ($i = 1; $i <= $semestr; $i++):?>
					<?php $fans = query("SELECT `c_u`,`k_k` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$i' ORDER BY `id_fan`");?>
						<?php foreach($fans as $item):?>
							<th>
								<?=$item['c_u']?> кр.
							</th>
							<?php if(!empty($item['k_k'])):?>
								<th>0 кр.</th>
							<?php endif;?>
						<?php endforeach;?>
					<?php endfor;?>
				</tr>
			</thead>
			
			<tbody class="center" id="tbody">
				<?php $c=0;?>
				<?php foreach ($students as $student):?>
					<tr>
						<td><?=++$c;?>.</td>
						<td style="text-align:left;">
							<?=$student['fullname_tj'];?>
						</td>
						<td>
							<?=mb_substr($student['study_type_title'], 0, 1)?>
						</td>
						<?php $allcredits = $allscores = $GPA = 0;?>
						<?php for ($i = 1; $i <= $semestr; $i++):?>
							<?php $fans = getResultsBySemestr($student['id'], $id_group, $id_nt, $i);?>
							
							<?php $s = 0;?>
							<?php foreach($fans as $fan):?>
								<?php if(!in_array($fan['fan_id'], NOT_RATING)):?>
									<?php 
										if($fan['total_score']>=50){
											$total = $fan['total_score'];
										}else{
											$total = $fan['trimestr_score'];
										}
									?>
									<td <?php if(count($fans) - 1 == $s):?>class="border"<?php endif;?> <?php if($total < 50):?>style="background-color: red;"<?php endif;?>>
										<?=$total?><br><?=getLatter($total)?><br><?=getAdad($total)?>
										<?php
											$allcredits += $fan['c_u'];
											$allscores += $fan['c_u'] * getAdad($total);
										?>
									</td>
								<?php else:?>
									<!--Таҷрибаомӯзи-->
									<td <?php if($fan['total_score'] < 50):?>style="background-color: red;"<?php endif;?>>
										<?php if(!empty($fan['total_score'])):?>
											<?=$fan['total_score']?><br><?=getLatter($fan['total_score'])?><br><?=getAdad($fan['total_score'])?>
										<?php else:?>
											0
										<?php endif;?>
									</td>
								<?php endif;?>
								
								<?php if(!empty($fan['k_k'])):?>
									<?php if($fan['kori_kursi'] >= 50):?>
										<td><?=$fan['kori_kursi']?><br><?=getLatter($fan['kori_kursi'])?><br><?=getAdad($fan['kori_kursi'])?></td>
									<?php else:?>
										<td style="background-color:red;">0</td>
									<?php endif;?>
								<?php endif;?>
									<?php $s++;?>
							<?php endforeach;?>
						<?php endfor;?>
						<td class="border"><?=$gpa=round($allscores/$allcredits,2)?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<br>
	
	</body>
</html>