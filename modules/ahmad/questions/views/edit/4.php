<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5>Таҳриркунии савол</h5>
		</div>
		<div class="card-block">
			
			<div class="mb-3">
				<label class="bold">Манти савол:</label>
				<textarea id="editor" name="savol" class="form-control" style='width: 100%; height: 95px;'><?=$text?></textarea>
				
			</div>
			<i>Якчанд калимаро аз савол дохил кунед.</i>
			<div class="mb-3">
				<?php foreach($answers as $answer):?>
					<div class="input-group" style="margin: 0">
						
						<input autocomplete="off" value="<?=$answer['text']?>" type="text" name="answer[<?=$answer['id']?>]" class="form-control">
					</div>
					<br>
				<?php endforeach;?>
			</div>
			
			
			
		</div>
	</div>
</div>