<p class="center" style="color:red; font-size: 25px;">Барои сохтани ариза аз рӯйхат як ё якчанд фанро интихоб кунед!<?=$shartnoma?></p>
<hr style="margin: 0 0 20px 0;">
<form action="<?=MY_URL?>?option=students&action=save_trimestr" method="post" enctype="multipart/form-data">
	<table class="table" style="font-size: 14px !important">
		<tr style="background-color: #263544; color: #fff">
			<th style="width: 5%;">№</th>
			<th></th>
			<th>Номи фан</th>
			<th style="width: 5%;">Баҳои <br>пешина</th>
			<th style="width: 5%;">Миқдори<br>кредитҳо</th>
			<th style="width: 5%;">Маблағ</th>
		</tr>
		<?php $i=1;?>
		<?php //print_arr($raznitsa);?>
		<?php foreach($qarzho as $item):?>
			<tr class="center">
				<td style="width: 5%;"><?=$i;?>.</td>
				<td style="width: 5%;"><input type="checkbox" name="fans[]" value=<?=$item['id_fan']?>></td>
				<td class="left">
					<?=getFanTest($item['id_fan'])?>[<?=$item['id_fan']?>]
				</td>
				<td>
					<?php
						$old_score = $item['total_score'];
						echo getLatter($old_score);
					?>
				</td>
				<td><?=$c_f_u = getCreditiFaol($id_nt, $semestr, $item['id_fan'])?></td>
				<td>
					<?php if($old_score >=45):?>
					0
					<?php else:?>
						<?=round($shartnoma / 60 * $c_f_u)?>
					<?php endif;?>
				</td>
			</tr>
			<?php $i++;?>
		<?php endforeach;?>
	</table>
	<table class="addform">		
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_student" value="<?=$id_student?>">
				<input type="hidden" name="s_y" value="<?=$S_Y?>">
				<input type="hidden" name="h_y" value="<?=$H_Y?>">
				<button type="submit" class="updatebtn btn btn-inverse waves-effect waves-light">
					<i class="fa fa-save"></i> Сабти маълумотҳо
				</button>
			</td>
		</tr>
	</table>
</form>
	


<script type="text/javascript">
	jQuery(document).ready(function($){
		
	});
</script>