<label>Семестҳоро интихоб кунед:</label><br>
<?php for($course = 1; $course <= $id_course; ): ?>
	<?php for($S_Y = $end_s_y; $S_Y <= S_Y; $S_Y++): ?>
		<?php for($H_Y = 1; $H_Y <= 2; $H_Y++):?>
			
			
			<div style="float: left; margin: 10px">
				
				<div class="checkbox-zoom zoom-success">
					<label class="semestr" class="semestr" for="semestr_<?=$S_Y?>_<?=$H_Y?>">
						<input <?php if(S_Y == $S_Y && H_Y == $H_Y){ echo "checked";}?> type="checkbox" 
						name="semestr[<?=$S_Y?>_<?=$H_Y?>]" id="semestr_<?=$S_Y?>_<?=$H_Y?>" value="<?=$S_Y?>_<?=$H_Y?>_<?=$course?>">
						<span class="cr">
							<i class="cr-icon icofont icofont-ui-check txt-success"></i>
						</span>
						<span>Курси <?=$course?> (Соли таҳсили <?=getStudyYear($S_Y)?>, Нимсолаи <?=$H_Y?>)</span>
					</label>
				</div>
			
			</div>
			<?php if($S_Y == S_Y && $H_Y == H_Y) break; ?>
		<?php endfor;?>
		<?php $course++;?>
	<?php endfor;?>
<?php endfor;?>