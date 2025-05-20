<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5>Иловакунии савол <?=$i?></h5>
		</div>
		<div class="card-block">
			
			<div class="mb-3">
				<label class="bold">Манти савол:</label>
				<textarea id="editor_<?=$i?>" name="savol_<?=$i?>"></textarea>
				<script type="text/javascript">
					CKEDITOR.replace( 'editor_<?=$i?>', {
						filebrowserBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html',
						filebrowserImageBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html?type=Images',
						filebrowserUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
						filebrowserImageUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
					});
				</script>
			</div>
			
			<div class="mb-3">
				<?php for($j = 1; $j <= 4; $j++): ?>
					<div class="input-group" style="margin: 0">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input type="checkbox" name="variant_<?=$i?>_<?=$j?>" value="<?=$j?>">
							</div>
						</div>
						<textarea id="variant_<?=$i?>_<?=$j?>" name="answer_<?=$i?>_<?=$j?>"></textarea>
						<script type="text/javascript">
							CKEDITOR.replace( 'variant_<?=$i?>_<?=$j?>', {
								filebrowserBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html',
								filebrowserImageBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html?type=Images',
								filebrowserUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
								filebrowserImageUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
							});
						</script>
					</div>
					<br>
				<?php endfor;?>
			</div>
			
			
			
		</div>
	</div>
</div>