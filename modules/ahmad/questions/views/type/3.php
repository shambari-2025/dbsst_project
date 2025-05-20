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
			<i>Саволҳо ва ҷавобҳоро дар паҳлуи якдигар нависед.</i>
			
			<table style="width: 100%">
				<tr style="vertical-align: top;">
					<td class="inputsavol letter" style="padding: 10px">
						<?php for($j = 1; $j <= 4; $j++): ?>
							<div class="input-group" style="margin: 0">
								
								<?=chr(64+$j)?>) 
								<!--
								<input autocomplete="off" type="text" name="letter_<?=$i?>_<?=$j?>" class="form-control">
								-->
								<textarea id="letter_<?=$i?>_<?=$j?>" name="letter_<?=$i?>_<?=$j?>"></textarea>
								<script type="text/javascript">
									CKEDITOR.replace( 'letter_<?=$i?>_<?=$j?>', {
										filebrowserBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html',
										filebrowserImageBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html?type=Images',
										filebrowserUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
										filebrowserImageUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
									});
								</script>
							</div>
							<br>
						<?php endfor;?>
					</td>
				
					<td class="inputsavol letter" style="padding: 10px">
						<?php for($j = 1; $j <= 5; $j++): ?>
							<div class="input-group" style="margin: 0">
								<?=$j?>) 
								<!--
								<input autocomplete="off" type="text" name="number_<?=$i?>_<?=$j?>" class="form-control">
								-->
								<textarea id="number_<?=$i?>_<?=$j?>" name="number_<?=$i?>_<?=$j?>"></textarea>
								<script type="text/javascript">
									CKEDITOR.replace( 'number_<?=$i?>_<?=$j?>', {
										filebrowserBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html',
										filebrowserImageBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html?type=Images',
										filebrowserUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
										filebrowserImageUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
									});
								</script>
							</div>
							<br>
						<?php endfor;?>
					</td>
				</tr>
			</table>
			
			
			
		</div>
	</div>
</div>