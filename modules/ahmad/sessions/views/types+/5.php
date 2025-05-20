<div class="card-block">
	<i>Дохилкунии матн:</i><br>
	
	
	<?php $c = 1;?>
	<?php foreach($answers as $answer): ?>
		<label for='id_<?=$answer['id']?>'>
			<?=chr(64+$c)?> )
			<input id='id_<?=$answer['id'];?>' value='<?=$answer['id'];?>' type="radio" name="quest_<?=$id_question;?>">
			<?=$answer['text']?>
		</label>
	<?php $c++; ?>
	<?php endforeach; ?>
	
	<label class="l_type2"><i>Ҷавоби дурустро дохил кунед:</i><br>
		<input type="text" placeholder="Ҷавоби дуруст" name="input_<?=$id_question;?>" class="form-control">
	</label>
</div>
