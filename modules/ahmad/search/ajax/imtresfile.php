<?php if($fanlist):?>
	<p class="center bold f-16">Натиҷаҳои донишҷӯ дар курси <?=$id_course?>, нимсолаи <?=$h_y?> (семестри <?=getSemestr($id_course, $h_y)?>)</p>
	<table class="table" style="font-size:13px">
		<thead class="center">
			<tr style="background-color: #263544; color: #fff">
				<th class="counter">№</th>
				<th><div class="vertical">ID FAN</div></th>
				<th class="left" style="width:350px !important">Номӯйи фанҳо</th>
				<th><div class="vertical">Кредит</div></th>
				<?php if($id_s_v == 1):?>
					<th>Сана</th>
					<th>IP</th>
				<?php endif;?>
				<th><div class="vertical">Рейтинг 1</div></th>
				<th><div class="vertical">Рейтинг 2</div></th>
				<th><div class="vertical">Имтиҳон</div></th>
				<th><div class="vertical">Ҷамъ</div></th>
				<th><div class="vertical">Бо ҳуруф</div></th>
				<th><div class="vertical">Бо адад</div></th>
				<th>Амал</th>
			</tr>
		</thead>
		<tbody class="center">
			
			<?php $counter = $credits = $my_summa = 0;?>
			<?php foreach($fanlist as $item):?>
				<?php if(!in_array($item['id_fan'], array(596, 597, 598))):?>	
				<tr>
					<th scope="row"><?=++$counter?>.</th>
					<th scope="row"><?=$item['id_fan']?></th>
					<td class="left">
						<?=getFan($item['id_fan'])?>
					</td>
					
					<td>
						<?php if($item['id_fan'] != 141):?>
							<?=$credit = getCredit($item['id_fan'], $id_nt, $h_y)?>
							<?php $credits += $credit?>
						<?php endif;?>
					</td>
					<?php if($id_s_v == 1):?>
						<td><?=$item['date']?></td>
						<td><?=$item['ip']?></td>
					<?php endif;?>
					<td><?=$item['r_1']?></td>
					<td><?=$item['r_2']?></td>
					<td><?=$item['imt_score']?></td>
					<td><?=$item['allscore']?></td>
					<td class="bold <?php if($item['allscore'] < 50){ echo "grey";}?>">
						<?=getLatter($item['allscore'])?>
					</td>
					<td class="bold <?php if($item['allscore'] < 50){ echo "grey";}?>">
						<?=getAdad($item['allscore'])?>
						
						<?php if($item['id_fan'] != 141):?>
							<?php $my_summa += $credit * getAdad($item['allscore']);?>
						<?php endif;?>
					</td>
					<td></td>
				</tr>
				<?php endif;?>
				
				<!-- Барои баровардани корҳои курсӣ -->
				<?php if($item['k_k']):?>
					<tr>
						<th scope="row"><?=++$counter?>.</th>
						<th scope="row"><?=$item['id_fan']?></th>
						<td class="left bold">
							<?=getFan($item['id_fan'])?>
							<?php if($item['k_k']):?>
								(кори курсӣ)
							<?php endif;?>
						</td>
						<td></td>
						
						<td colspan="<?php if($id_s_v == 1):?>5<?php else: ?>3<?php endif;?>"></td>
						<td><?=$item['dop_score']?></td>
						<td class="bold <?php if($item['dop_score'] < 50){ echo "grey";}?>"><?=getLatter($item['dop_score'])?></td>
						<td class="bold <?php if($item['dop_score'] < 50){ echo "grey";}?>"><?=getAdad($item['dop_score'])?></td>
						<td></td>
					</tr>
				<?php endif;?>
				<!-- Барои баровардани корҳои курсӣ -->
				
				<!-- Барои баровардани таҷрибаомӯзиҳо -->
				<?php if(in_array($item['id_fan'], array(596, 597, 598))):?>
					<tr>
						<th scope="row"><?=++$counter?>.</th>
						<th scope="row"><?=$item['id_fan']?></th>
						<td class="left bold">
							<?=getFan($item['id_fan'])?>
							<?php if($item['k_k']):?>
								(кори курсӣ)
							<?php endif;?>
						</td>
						<td>
							<?=$credit = getCredit($item['id_fan'], $id_nt, $h_y)?>
							<?php $credits += $credit?>
						</td>
						<td colspan="5"></td>
						<td><?=$item['dop_score']?></td>
						<td class="bold <?php if($item['dop_score'] < 50){ echo "grey";}?>">
							<?=getLatter($item['dop_score'])?>
						</td>
						<td class="bold <?php if($item['dop_score'] < 50){ echo "grey";}?>">
							<?=getAdad($item['dop_score'])?>
							<?php $my_summa += $credit * getAdad($item['dop_score']);?>
						</td>
						<td></td>
					</tr>
				<?php endif;?>
				<!-- Барои баровардани таҷрибаомӯзиҳо -->
				
			<?php endforeach;?>
			
			<tr class="bold">
				<td colspan="3">Миқдори кредитҳо</td>
				<td><?=$credits?></td>
				<td colspan="<?php if($id_s_v == 1):?>8<?php else: ?>6<?php endif;?>" class="right">
					Дар нимсолаи <?=$h_y?> GPA: <?=number_format(round($my_summa / $credits, 2), 2)?>
				</td>
				<td></td>
			</tr>
		</tbody>
	</table>
<?php else: ?>
	<h3 class="center">Аз дигар муассисаҳои таълими интиқол шудааст.</h3>
<?php endif;?>