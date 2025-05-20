<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5>Иловакунии савол <?=$i?></h5>
		</div>
		<div class="card-block">
			
			<div class="mb-3">
				<label class="bold">Манти савол:</label>
				<textarea id="editor<?=$i?>" name="savol_<?=$i?>" class="form-control" style='width: 100%; height: 95px;'></textarea>
				
			</div>
			<i>Якчанд калимаро аз савол дохил кунед.</i>
			<div class="mb-3">
				<?php for($j = 1; $j <= 4; $j++): ?>
					<div class="input-group" style="margin: 0">
						
						<input autocomplete="off" type="text" name="answer_<?=$i?>_<?=$j?>" class="form-control">
					</div>
					<br>
				<?php endfor;?>
			</div>
			
			
			
		</div>
	</div>
</div>