<?php $answers_pos_1 = select("answers", "*", "`id_question` = '".$id_question."' AND `position` = '1'", "id", false, ""); ?>
<?php $answers_pos_2 = select("answers", "*", "`id_question` = '".$id_question."' AND `position` = '2'", "id", false, ""); ?>


<td style = "width: 40%;">
	<?php $c = 1;?>
	<?php foreach($answers_pos_1 as $answer):?>
		<p class="<?=chr(64+$c)?> p_type2"><?=chr(64+$c)?>) <?=($answer['text']);?></p>
		<?php $c++;;?>
	<?php endforeach; ?>
</td>

<td style = "width: 35%;">
	
	<?php $c = 1;?>
	<?php foreach($answers_pos_2 as $answer):?>
		<p class="p_type2" number="<?=$c?>"><?=$c?>) <?=($answer['text']);?></p>
		<?php $c++;;?>
	<?php endforeach; ?>
</td>

<tr>
	<td style="width: 50%;">
		<table class="center" style="width: 70%;">
			<tbody>
				<tr>
					<td></td>
					<?php for($i=1; $i<=count($answers_pos_2); $i++):?>
						<td><?=$i;?></td>
					<?php endfor; ?>
				</tr>
				<?php $j=1;?>
				<?php foreach($answers_pos_1 as $pos_1):?>
					<tr>
					<td><?=chr(64+$j);?></td>
						<?php $k=1;?>
						<?php foreach($answers_pos_2 as $pos_2): ?>
							<td style="padding:0px;">
								<?php $r_a = $pos_1['id'].'-'.$pos_2['id']; ?>
								<label class="check" letter = "<?=chr(64+$j);?>" number = "<?=$k;?>">
								<input name="check_<?=$id_question."-".$pos_1['id'];?>" <?php if(array_search($r_a, $id_aftq) !== false ){echo "checked";}?> value="<?=$pos_1['id']."-".$pos_2['id'];?>" style="width:20px; height:20px;" type="radio">
								</label>
							</td>
							<?php $k++; ?>
						<?php endforeach; ?>
						<?php $j++; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</td>
	<td style="width: 50%; ">
		<table class="center" style="width: 70%;">
			<tbody>
				<tr>
					<td></td>
					<?php for($i=1; $i<=count($answers_pos_2); $i++):?>
						<td><?=$i;?></td>
					<?php endfor; ?>
				</tr>
				<?php $j=1;?>
				<?php foreach($answers_pos_1 as $pos_1):?>
					<tr>
					<td><?=chr(64+$j);?></td>
						<?php $k=1;?>
						<?php foreach($answers_pos_2 as $pos_2): ?>
							<td style="padding:0px;">
								<?php $r_a = $pos_1['id'].'-'.$pos_2['id']; ?>
								<label class="check" letter = "<?=chr(64+$j);?>" number = "<?=$k;?>">
								<input disabled <?php if($r_a == $pos_2['right_answer']){echo "checked";}?> value="<?=$pos_1['id']."-".$pos_2['id'];?>" style="width:20px; height:20px;" type="radio">
								</label>
							</td>
							<?php $k++; ?>
						<?php endforeach; ?>
						<?php $j++; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</td>
</tr>