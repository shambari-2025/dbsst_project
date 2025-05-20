<div class="col-md-12 col-sm-12">
	<!--
	<p class="center"><i>Эзоҳ: Холҳои ҳамон донишҷӯёне иваз мешаванд, ки пештар <b>0</b> доштанд ва ҳамонҳам дар майдони Рейтинги 1</i></p>
	-->
	<form action="<?=MY_URL?>?option=scores&action=insert_score_nf" method="post" enctype="multipart/form-data">
		<table class="table" style="font-size:14px">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th style="width:40px">№</th>
					<th>Ному насаб</th>
					<?php if($rating == 1):?>
						<th style="width:120px">КМД Р1</th>
						<?php if(isset($_SESSION['user']['admin'])):?>
							<th style="width:120px">Рейтинг 1</th>
						<?php endif;?>
						<!--<th style="width:120px">Давомоти Р1</th>-->
					<?php elseif($rating == 2):?>
						<th style="width:120px">КМД Р2</th>
						<?php if(isset($_SESSION['user']['admin'])):?>
							<th style="width:120px">Рейтинг 2</th>
						<?php endif;?>
						<!--<th style="width:70px">Давомоти Р2</th>-->
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
							<?php $data = query("SELECT `nf_1_score`, `nf_1_score_r`, `nf_2_score`, `nf_2_score_r` FROM `results` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `id_course` = '$id_course' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");?>
							
							<?php if($rating == 1):?>
								<td class="center">
									<input autocomplete="off" min="0" max="<?=$max?>" type="number" name="nf_1_score[]" value="<?php if(isset($data[0]['nf_1_score'])): echo $data[0]['nf_1_score']; else: echo 0; endif;?>" class="center form-control">
								</td>
								<?php if(isset($_SESSION['user']['admin'])):?>
									<td class="center">
										<input autocomplete="off" min="0" max="50" type="number" name="nf_1_score_r[]" value="<?php if(isset($data[0]['nf_1_score_r'])): echo $data[0]['nf_1_score_r']; else: echo 0; endif;?>" class="center form-control">
									</td>
								<?php endif;?>
								
							<?php elseif($rating == 2):?>
								<td class="center">
									<input autocomplete="off" min="0" max="<?=$max?>" type="number" name="nf_2_score[]" value="<?php if(isset($data[0]['nf_2_score'])): echo $data[0]['nf_2_score']; else: echo 0; endif;?>" class="center form-control">
								</td>
								<?php if(isset($_SESSION['user']['admin'])):?>
									<td class="center">
										<input autocomplete="off" min="0" max="50" type="number" name="nf_2_score_r[]" value="<?php if(isset($data[0]['nf_2_score_r'])): echo $data[0]['nf_2_score_r']; else: echo 0; endif;?>" class="center form-control">
									</td>
								<?php endif;?>
								
							<?php endif;?>
							
						</tr>
					<?php endforeach;?>
					<tr>
						<td colspan="2"></td>
						<td colspan="2">
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
