<?php if($fanlist):?>
	<!--
	<p class="center bold f-16">Натиҷаҳои донишҷӯ дар ихтисоси <?=getSpecialtyCode($student_info[0]['id_spec'])?> <?=getStudyView($student_info[0]['id_s_v'])?>, дар курси <?=$id_course?>, нимсолаи <?=$h_y?> (семестри <?=getSemestr($id_course, $h_y)?>)</p>
	-->
	<p class="center bold f-16">Натиҷаҳои донишҷӯ дар семестри <?=$semestr?></p>
	
	<table class="table" style="font-size:14px">
		<thead class="center">
			<tr style="background-color: #263544; color: #fff">
				<th class="counter">№</th>
				<th style="width: 30px"><div class="vertical">ID FAN</div></th>
				<th class="left" style="width:350px !important">Номӯйи фанҳо</th>
				<th>Омӯзгор(он)</th>
				<th>Намуди<br>санҷиш</th>
				<th>Санаи<br>супоридани<br>имтиҳон</th>
				<th><div class="vertical">Кредит</div></th>
				<th><div class="vertical">Рейтинг 1</div></th>
				<th><div class="vertical">Рейтинг 2</div></th>
				
				<th><div class="vertical">Имтиҳон</div></th>
				<th><div class="vertical">Ҷамъ</div></th>
				<th><div class="vertical">Бо ҳуруф</div></th>
				<th><div class="vertical">Бо адад</div></th>
				<th>Амалҳо</th>
			</tr>
		</thead>
		<tbody class="center">
			<?php $data_test = query("SELECT `id_user` FROM `test_center_module`");?>
			
			<?php $l = [];?>
			<?php foreach($data_test as $d_item):?>
				<?php $l[] = $d_item['id_user']?>
			<?php endforeach;?>
			
			
			<?php $counter = $credits = $my_summa = 0;?>
			
			<?php //print_arr($fanlist)?>
			<?php foreach($fanlist as $item):?>
				<tr>
					<th scope="row"><?=++$counter?>.</th>
					<th scope="row"><?=$item['fan_id']?></th>
					<td class="left">
						<?php if($item['intixobi']):?>
							<span class="text-c-red">Ф.И. </span>
						<?php endif;?>
						<?=$item['title_tj']?>
						
					</td>
					<td class="left">
						<?php
							if(isset($item['id_iqtibos'])){
								$id_iqtibos = $item['id_iqtibos'];
								$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `type` = 'lk_plan' AND  `id_iqtibos` = '$id_iqtibos'");
								foreach($teachers as $teacher){
									echo getShortName($teacher['id_teacher'])."<br>";
								}
							}
						?>
					</td>
					
					<?php if(!in_array($item['fan_id'], NOT_RATING)):?>
						<td>
							<?php if(isset($item['id_iqtibos'])):?>
								<?php $query = query("SELECT `imt_type` FROM `tests` WHERE `id_iqtibos` = '{$item['id_iqtibos']}'");?>
								<?=@$imt_types[$query[0]['imt_type']]?>
							<?php endif;?>
						</td>
						<td>
							<?php if(!empty($item['imt_add_date'])):?>
								<?=$item['imt_add_date']?>
							<?php endif;?>
						</td>
					<?php else:?>
						<td colspan="2"></td>
					<?php endif;?>
					
					<td>
						<?=$credit = $item['c_u']?>
						<?php $credits += $item['c_u']?>
					</td>
					
					<?php if(!in_array($item['fan_id'], NOT_RATING)):?>
						<td class="edit <?php if($item['nf_1_score'] < 10){ echo "grey";}?>" data-table="results"
						data-id-fan="<?=$item['fan_id']?>" field="nf_1_score" data-id="<?=@$item['results_id']?>"><?=$item['nf_1_score']?></td>
						
						<td class="edit <?php if($item['nf_2_score'] < 10){ echo "grey";}?>" data-table="results"
						data-id-fan="<?=$item['fan_id']?>" field="nf_2_score" data-id="<?=@$item['results_id']?>"><?=$item['nf_2_score']?></td>
						
						<td class="edit" data-table="results"
						data-id-fan="<?=@$item['fan_id']?>" field="imt_score" data-id="<?=@$item['results_id']?>">
							<?=@$item['imt_score']?>
						</td>
						
						
						<td class="edit bold" data-table="results"
						data-id-fan="<?=@$item['fan_id']?>" field="total_score" data-id="<?=@$item['results_id']?>">
							<?=@$item['total_score']?>
						</td>
					
					<?php else:?>
						<!--Таҷрибаомӯзиҳо-->
						<td colspan="3"></td>
						<td class="edit bold" data-table="results"
							data-id-fan="<?=$item['fan_id']?>" field="total_score" data-id="<?=@$item['results_id']?>">
							<?php $item['allscore'] = $item['total_score']?>
							<?=$item['total_score']?>
						</td>
					<?php endif;?>
					
					<td class="bold" >
						<?=getLatter(@$item['total_score'])?>
						
					</td>
					<td class="bold">
						<?=getAdad(@$item['total_score'])?>
						<?php $my_summa += $credit * getAdad(@$item['total_score']);?>
					</td>
					
					<td class="elements">
						
						<?php if(isset($item['id_iqtibos'])):?>
							<?php if(in_array($_SESSION['user']['id'], [1])):?>
								<?php if(!is_null($item['imt_score'])):?>
									<a class="delete_res" href="javascript:" data-id="<?=$item['results_id']?>" title="Несткунии натиҷаи имтиҳон">
										<i class="fa fa-trash"></i>
									</a>
									
								<?php endif;?>
								
								
							<?php endif;?>
							
							
							<?php if(@$query[0]['imt_type'] == 1 && (in_array($_SESSION['user']['id'], [1, 2, 4, 8937]) || in_array($_SESSION['user']['id'], $l))) :?>
								<?php if(!is_null($item['imt_score'])):?>
									<a target="_blank" href="<?=MY_URL."?option=students&action=results&id_student=$id_student&id_fan={$item['fan_id']}&s_y=$s_y&h_y=$h_y";?>">
										<i class="fa fa-line-chart"></i>
									</a>
								<?php endif;?>
							<?php endif;?>
						<?php endif;?>
					</td>
					
				</tr>
				
				<?php if($item['k_k']):?>
					<tr>
						<th scope="row"><?=++$counter?>.</th>
						<th scope="row"><?=$item['fan_id']?></th>
						<td class="left">
							Кори курсӣ аз фанни «<?=$item['title_tj']?>»
							
						</td>
						<td class="left">
							<?php
								if(isset($item['id_iqtibos'])){
									$id_iqtibos = $item['id_iqtibos'];
									$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `type` = 'kori_kursi' AND `id_iqtibos` = '$id_iqtibos'");
									foreach($teachers as $teacher){
										echo getShortName($teacher['id_teacher'])."<br>";
									}
								}
							?>
						</td>
						
						<td colspan="2"></td>
						<td>*</td>
						<td colspan="3"></td>
						<td class="edit bold" data-table="results"
							data-id-fan="<?=$item['fan_id']?>" field="kori_kursi" data-id="<?=@$item['results_id']?>">
							<?=$item['kori_kursi']?>
						</td>
						<td class="bold"><?=getLatter($item['kori_kursi'])?></td>
						<td class="bold"><?=getAdad($item['kori_kursi'])?></td>
						<td></td>
						
					</tr>
				<?php endif;?>
				
			<?php endforeach;?>
			
			<tr class="bold">
				<td colspan="6">Миқдори кредитҳо</td>
				<td><?=$credits?></td>
				
				<td colspan="9" class="center">
					Дар семестри <?=$semestr?> | GPA: <?=number_format(round($my_summa / $credits, 2), 2)?>
				</td>
				
			</tr>
			
		</tbody>
	</table>
<?php else: ?>
	<h3 class="center"><i class="fa fa-warning"></i> Маълумот ёфт нашуд.</h3>
<?php endif;?>