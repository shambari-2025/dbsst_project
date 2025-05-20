<div class="card-block">
	
	
	<table class="muvofiqat">
		<tr>
			<td style = "width: 40%;">
				<?php $answers_pos_1 = query("SELECT * FROM `answers` WHERE `id_question` = '$id_question' AND `position` = '1' ORDER BY RAND()");?>
				
				<?php $c = 1;?>
				<?php foreach($answers_pos_1 as $answer):?>
					<p class="<?=chr(64+$c)?> p_type2"><?=chr(64+$c)?>) [<?=$answer['id']?>] <?=($answer['text']);?></p>
					<?php $c++;;?>
				<?php endforeach; ?>
			</td>
			
			<td style = "width: 35%;">
				<?php $answers_pos_2 = query("SELECT * FROM `answers` WHERE `id_question` = '$id_question' AND `position` = '2' ORDER BY RAND()");?>
				
				<?php $c = 1;?>
				<?php foreach($answers_pos_2 as $answer):?>
					<p class="p_type2" number="<?=$c?>"><?=$c?>) [<?=$answer['id']?>] <?=($answer['text']);?></p>
					<?=$answer['right_answer']?>
					<?php $c++;;?>
				<?php endforeach; ?>
			</td>
			<td class="table">
				<table>
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
										<label class="check" letter="<?=chr(64+$j);?>" number="<?=$k;?>">
										<input 
										<?php if($pos_1['id'].'-'.$pos_2['id'] == $pos_2['right_answer']):?>
											checked
										<?php endif;?>
										
										name="check_<?=$id_question."-".$pos_1['id'];?>" value="<?=$pos_1['id']."-".$pos_2['id'];?>" type="radio">
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
		<tr>
	</table>
</div>