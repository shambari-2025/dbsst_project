<div class="col-md-12 col-sm-12">
	<!--
	<p class="center text-c-red bold"><i>Эзоҳ: Баҳои донишҷӯёне, ки маблағи шартномаи таҳсилро насупоридаанд сабт намешаванд!</i></p>
	-->
	<form action="<?=MY_URL?>?option=scores&action=insert_score_ilm" method="post" enctype="multipart/form-data">
		<table class="table" style="font-size:14px">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th style="width:40px">№</th>
					<th>Ному насаб</th>
					<th style="width:70px">Хол</th>
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
							<?php $data = query("SELECT `total_score` FROM `results` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `id_course` = '$id_course' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");?>
							
							
							<td class="center">
								<input autocomplete="off" min="0" max="100" type="number" name="total_score[]" value="<?php if(isset($data[0]['total_score'])): echo $data[0]['total_score']; else: echo 0; endif;?>" class="center form-control">
							</td>
							
						</tr>
					<?php endforeach;?>
					<tr>
						<td colspan="2"></td>
						<td colspan="1">
							<input type="hidden" name="id_iqtibos" value="<?=$id_iqtibos?>">
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
