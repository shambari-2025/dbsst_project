<table class="table" style="font-size: 14px !important">
	<thead class="center">
		<tr style="background-color: #263544; color: #fff">
			<th class="counter">№</th>
			<th class="image">Расм</th>
			<th class="counter">ID</th>
			<th class="left">Ному насаб</th>
			<th>Шакли таҳсил</th>
			<th>Амалҳо</th>
		</tr>
	</thead>
	<tbody class="center">
		<?php $counter = $mans = $shartmona = $buja = $kvota = 0;?>
		<?php foreach($students as $item):?>
			<?php if($item['jins'] == 1):?>
				<?php $mans++?>
			<?php endif;?>
			
			<?php if($item['id_s_t'] == 1):?>
				<?php $shartmona++?>
			<?php elseif($item['id_s_t'] == 2):?>
				<?php $buja++?>
			<?php elseif($item['id_s_t'] == 3):?>
				<?php $kvota++?>
			<?php endif;?>
			
			<tr>
				<th scope="row"><?=++$counter?>.</th>
				<td>
					<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo']);?>
					<img class="img-circle profile_img imguser" src="<?=$photo;?>">
				</td>
				<th scope="row"><?=$item['id']?></th>
				<td class="left">
					<?=$item['fullname_tj']?>
				</td>
				<td>
					<?=getStudyType($item['id_s_t'])?>
				</td>
				<td>
					
					<div class="dropdown-inverse dropdown open">
						<button class="btn btn-inverse dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<i class="fa fa-cogs"></i> Амалҳо
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
							
							<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname']?>"
								class="dropdown-item waves-light waves-effect sessions_results" href="javascript:">
								<i class="fa fa-line-chart"></i> Натиҷаи сессияҳо
							</a>
							
							<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=print&action=transcript&id_student=<?=$item['id']?>&s_y=<?=$S_Y?>&h_y=<?=$H_Y?>"><i class="fa fa-print"></i> Чопи транскрипсия</a>
							<!--
							<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-print"></i> Чопи варақаи қарздорӣ</a>
							-->
							
							<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname']?>"
								class="dropdown-item waves-light waves-effect student_info" href="javascript:">
								<i class="fa fa-info"></i> Маълумотнома
							</a>
							
							<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname']?>"
								class="dropdown-item waves-light waves-effect student_edit" href="javascript:">
								<i class="fa fa-edit"></i> Таҳриркунӣ
							</a>
							<!--
							<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-lock"></i> Кушодан</a>
							-->
							<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-unlock"></i> Маҳкамкунӣ</a>
							
							<div class="dropdown-divider"></div>
							<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-trash"></i> Хориҷкунӣ</a>
						</div>
					</div>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>