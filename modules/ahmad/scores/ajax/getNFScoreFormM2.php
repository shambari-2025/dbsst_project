<div class="col-md-12 col-sm-12">
	<!--
	<p class="center"><i>Эзоҳ: Холҳои ҳамон донишҷӯёне иваз мешаванд, ки пештар <b>0</b> доштанд ва ҳамонҳам дар майдони Рейтинги 1</i></p>
	-->
	<form action="<?=MY_URL?>?option=scores&action=insert_score_m2" method="post" enctype="multipart/form-data">
		<table class="table" style="font-size:14px">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th style="width:40px">№</th>
					<th>Ному насаб</th>
					<th style="width:130px">Рейтинги 1</th>
					<th style="width:130px">Рейтинги 2</th>
					<?php if($imt_type != 1):?>
						<th style="width:130px">Имтиҳон</th>
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
							<?php $data = query("SELECT `nf_1_score`, `nf_2_score`, `imt_score` FROM `results` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `id_course` = '$id_course' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");?>
							
							<td class="center">
								<input autocomplete="off" min="0" max="100" type="number" name="nf_1_score[]" 
								value="<?php if(isset($data[0]['nf_1_score'])): echo $data[0]['nf_1_score']; else: echo 0; endif;?>" class="center form-control">
							</td>
							
							<td class="center">
								<input autocomplete="off" min="0" max="100" type="number" name="nf_2_score[]" 
								value="<?php if(isset($data[0]['nf_2_score'])): echo $data[0]['nf_2_score']; else: echo 0; endif;?>" class="center form-control">
							</td>
							
							<?php if($imt_type != 1):?>
								<td class="center">
									<input autocomplete="off" min="0" max="100" type="number" name="imt_score[]" 
									value="<?php if(isset($data[0]['imt_score'])): echo $data[0]['imt_score']; else: echo 0; endif;?>" class="center form-control">
								</td>
							<?php endif;?>
							
						</tr>
					<?php endforeach;?>
					<tr>
						<td colspan="2"></td>
						<td colspan="2">
							<input type="hidden" name="imt_type" value="<?=$imt_type?>">
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
