<div class="card-block">
	
	
	<?php $c = 1;?>
	<?php foreach($answers as $answer): ?>
		<label for='id_<?=$answer['id']?>'>
			<?=chr(64+$c)?> )
			<input id='id_<?=$answer['id'];?>' value='<?=$answer['id'];?>' type="radio" name="quest_<?=$id_question;?>">
			<?=$answer['text']?>
		</label>
	<?php $c++; ?>
	<?php endforeach; ?>
</div>