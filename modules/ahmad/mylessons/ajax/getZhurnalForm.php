<div class="col-md-12 col-sm-12">
	<!--
	<p class="center"><i>Эзоҳ: Холҳои ҳамон донишҷӯёне иваз мешаванд, ки пештар <b>0</b> доштанд ва ҳамонҳам дар майдони Рейтинги 1</i></p>
	-->
	<form action="<?=MY_URL?>?option=mylessons&action=insert_absent" method="post" enctype="multipart/form-data">
		<table class="table" style="font-size:14px">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<td rowspan="2">№</td>
					<td rowspan="2">Ному насаб</td>
					<td rowspan="2">Соатҳои<br>дарсшикани</td>
					<td colspan="3">Соатҳои дарси</td>
					<!--<td colspan="<?=count($datas)?>">Соатҳои дарси</td>-->
				</tr>
				<tr style="background-color: #263544; color: #fff">
					<?php //foreach($datas as $soat):?>
						<!--<td><?=$soat['soat']?></td>-->
					<?php //endforeach;?>
					<?php for($i = 1; $i <= 3; $i++):?>
						<td><?=$i?></td>
					<?php endfor;?>
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
							
							<td class="bold">
								<?php $query = query("SELECT `absents` FROM `students_absents` 
								WHERE `id_fan` = '$id_fan' AND `id_student` = '".$item['id']."'
								AND `semestr` = '$semestr'");?>
								
								<?php if(!empty($query)):?>
									<?=$query[0]['absents']?>
								<?php else:?>
									0
								<?php endif;?>
							</td>
							
							<?php //foreach($datas as $soat):?>
								<!--<td>
									<input type="checkbox" name="soat_<?=$item['id']?>[]">
								</td>-->
							<?php //endforeach;?>
							
							<?php for($i = 1; $i <= 3; $i++):?>
								<td>
									<input type="checkbox" name="soat_<?=$item['id']?>[]">
								</td>
							<?php endfor;?>
							
						</tr>
					<?php endforeach;?>
					<tr>
						<td colspan="3"></td>
						<td colspan="3">
							<input type="hidden" name="id_iqtibos" value="<?=$id_iqtibos?>">
							<input type="hidden" name="rating" value="<?=$rating?>">
							<button type="submit" class="btn btn-success">Сабт кардан</button>
						</td>
					</tr>
				<?php else: ?>
					<tr class="center bold">
						<td colspan="3">
							<i class="fa fa-warning"></i> Маълумот нест.
						</td>
					</tr>
				<?php endif;?>
			</tbody>
		</table>
	</form>
</div>
