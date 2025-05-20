<div class="card-block">
	
	
	<?php $c = 1;?>
	<?php foreach($answers as $answer): ?>
		<label for='id_<?=$answer['id']?>'>
			<?=chr(64+$c)?> )
			<input id="id_<?=$answer['id'];?>" value="<?=$answer['id'];?>" type="checkbox" name="check_<?=$id_question;?>[]">
			<?=$answer['text']?>
			
			<?php if($answer['right_answer']):?>
			+
			<?php endif;?>
		</label>
	<?php $c++; ?>
	<?php endforeach; ?>
</div>