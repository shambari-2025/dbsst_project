<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h5>Таҳриркунии савол</h5>
		</div>
		<div class="card-block">
			
			<div class="mb-3">
				<label class="bold">Манти савол:</label>
				<textarea required id="editor" name="savol"><?=$text?></textarea>
				<script type="text/javascript">
					var editor_text = CKEDITOR.replace( 'editor', {
						filebrowserBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html',
						filebrowserImageBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html?type=Images',
						filebrowserUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
						filebrowserImageUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
					});
					
					editor_text.on( 'required', function( evt ) {
						alert( 'Article content is required.' );
						evt.cancel();
					} );
				</script>
			</div>
			<i>Саволҳо ва ҷавобҳоро дар паҳлуи якдигар нависед.</i>
			
			<table style="width: 100%">
				<tr style="vertical-align: top;">
					<td class="inputsavol letter" style="padding: 10px">
						
						<?php $answers_letter = query("SELECT * FROM `answers` WHERE `id_question` = '$id' AND `position` = '1' ORDER BY `id`");?>
						<?php $j = 0;?>
						
						<?php foreach($answers_letter as $answer): ?>
							<div class="input-group" style="margin: 0">
								
								<?=chr(64 + (++$j))?>) 
								<textarea required id="letter_<?=$answer['id']?>" name="letter[<?=$answer['id'];?>]"><?=$answer['text']?></textarea>
								<script type="text/javascript">
									CKEDITOR.replace( 'letter_<?=$answer['id']?>', {
										filebrowserBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html',
										filebrowserImageBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html?type=Images',
										filebrowserUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
										filebrowserImageUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
									});
								</script>
							</div>
							<br>
						<?php endforeach;?>
					</td>
					
					<td class="inputsavol number" style="padding: 10px">
						<?php $answers_number = query("SELECT * FROM `answers` WHERE `id_question` = '$id' AND `position` = '2' ORDER BY `id`");?>
						<?php $j = 0;?>
						<?php foreach($answers_number as $answer): ?>
							<div class="input-group" style="margin: 0">
								<?=++$j?>) 
								<textarea required id="number_<?=$answer['id']?>" name="number[<?=$answer['id'];?>]"><?=$answer['text']?></textarea>
								<script type="text/javascript">
									CKEDITOR.replace( 'number_<?=$answer['id']?>', {
										filebrowserBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html',
										filebrowserImageBrowseUrl: 'http://asu.tut.tj/test/ckfinder/ckfinder.html?type=Images',
										filebrowserUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
										filebrowserImageUploadUrl: 'http://asu.tut.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
									});
								</script>
							</div>
							<br>
						<?php endforeach;?>
					</td>
				</tr>
			</table>
			
			
			
		</div>
	</div>
</div>