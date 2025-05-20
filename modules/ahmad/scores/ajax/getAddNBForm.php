<div class="col-md-12 col-sm-12">
	<!--
	<p class="center"><i>Эзоҳ: Холҳои ҳамон донишҷӯёне иваз мешаванд, ки пештар <b>0</b> доштанд ва ҳамонҳам дар майдони Рейтинги 1</i></p>
	-->
	<form action="<?=MY_URL?>?option=scores&action=insert_nb" method="post" enctype="multipart/form-data">
		<table class="table" style="font-size:14px">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th style="width:40px">№</th>
					<th>Ному насаб</th>
					<th>Миқдори нестҳо</th>
					<?php if($rating == 1):?>
						<th style="width:120px">Миқдори НБ<br>Р1</th>
					<?php elseif($rating == 2):?>
						<th style="width:120px">Миқдори НБ<br>Р2</th>
					<?php endif;?>
				</tr>
			</thead>
			<tbody class="center">
				
				<?php if(!empty($students)):?>
					<?php $counter = 0;?>
					<?php foreach($students as $item):?>
						<tr>
							<th scope="row"><?=++$counter?>.</th>
							<td class="left">
								<?=$item['fullname_tj']?>
							</td>
							<?php $data = query("SELECT `absents` FROM `students_absents` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `rating` = '$rating' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");?>
							<td>
								<?php if(!empty($data)):?>
									<?=$data[0]['absents']?>
								<?php endif;?>
							</td>
							<?php if($rating == 1):?>
								<td class="center">
									<input autocomplete="off" min="0" type="number" name="absents_r_1[]" class="center form-control">
								</td>
								
							<?php elseif($rating == 2):?>
								<td class="center">
									<input autocomplete="off" min="0" type="number" name="absents_r_2[]" class="center form-control">
								</td>
							<?php endif;?>
							
						</tr>
					<?php endforeach;?>
					<tr>
						<td colspan="3">
						</td>
						<td colspan="1">
							<input type="hidden" name="id_iqtibos" value="<?=$id_iqtibos?>">
							<input type="hidden" name="rating" value="<?=$rating?>">
							
							<button type="submit" class="btn btn-success">Сабт кардан</button>
						</td>
					</tr>
				<?php else: ?>
					<tr class="center bold">
						<td colspan="5">
							<i class="fa fa-warning"></i> Маълумот нест.
						</td>
					</tr>
				<?php endif;?>
			</tbody>
		</table>
	</form>
</div>
