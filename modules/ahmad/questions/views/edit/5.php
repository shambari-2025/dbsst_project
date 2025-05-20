<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5>Таҳриркунии савол</h5>
		</div>
		<div class="card-block">
			
			<div class="mb-3">
				<label class="bold">Манти савол:</label>
				<textarea id="editor" name="savol"><?=$text?></textarea>
				<script type="text/javascript">
					CKEDITOR.replace( 'editor', {
						filebrowserBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html',
						filebrowserImageBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html?type=Images',
						filebrowserUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
						filebrowserImageUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
					});
				</script>
			</div>
			
			<div class="mb-3">
				<?php foreach($answers as $answer): ?>
					<div class="input-group" style="margin: 0">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input <?php if($answer['right_answer']){ echo "checked";}?> type="radio" name="variant_<?=$id?>" value="<?=$answer['id']?>">
							</div>
						</div>
						<input autocomplete="off" value="<?=$answer['text']?>" type="text" name="answer[<?=$answer['id']?>]" class="form-control">
					</div>
					<br>
				<?php endforeach;?>
			</div>
			
			
			
		</div>
	</div>
</div>