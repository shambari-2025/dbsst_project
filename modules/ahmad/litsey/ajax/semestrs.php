<label>Семестҳоро интихоб кунед:</label><br>
<?php for($course = $start_course, $S_Y = $start; $S_Y <= S_Y; $S_Y++, $course++):?>
	<?php for($nimsola = 1; $nimsola <= 2; $nimsola++):?>
		
		
		<div style="float: left; margin: 10px">
			
			<div class="checkbox-zoom zoom-success">
				<label class="semestr" class="semestr" for="semestr_<?=$S_Y?>_<?=$nimsola?>">
					<input <?php if(H_Y == $nimsola && S_Y == $S_Y){ echo "checked";}?> type="checkbox" name="semestr[<?=$S_Y?>_<?=$nimsola?>]" id="semestr_<?=$S_Y?>_<?=$nimsola?>" value="<?=$S_Y?>_<?=$nimsola?>">
					<span class="cr">
						<i class="cr-icon icofont icofont-ui-check txt-success"></i>
					</span>
					<span>Семестри <?=getSemestr($course, $nimsola)?> (Соли таҳсили <?=getStudyYear($S_Y)?>, Нимсолаи <?=$nimsola?>)</span>
				</label>
			</div>
		
		</div>
		<?php if($S_Y == S_Y && $nimsola == H_Y) break; ?>
	<?php endfor;?>
<?php endfor;?>