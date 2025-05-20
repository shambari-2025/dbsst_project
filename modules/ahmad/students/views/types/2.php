<?php $answers = select("answers", "*", "`id_question` = '".$id_question."'", "id", false, ""); ?>
<?php foreach($answers as $answer): ?>
	<?php $answer_text = $answer['text']; ?>
	<?php $answer_text = str_replace("<p>","",$answer_text);?>
	<?php $answer_text = str_replace("</p>","",$answer_text);?>
<tr>
	<td style="text-align: left; width: 50%;">
		<label for='id_<?=$answer['id']?>'>
			<input name='check_<?=$id_question;?>[]' id='id_<?=$answer['id'];?>' <?php if(array_search($answer['id'], $id_aftq) !== false ){echo "checked";}?> value='<?=$answer['id'];?>' type='checkbox'>
			<?=$answer_text;?>
		</label>
	</td>
	<td style="text-align: left; width: 50%;">
		<label>
			<input disabled id='id_<?=$answer['id'];?>' <?php if($answer['right_answer']){echo "checked";}?> value='<?=$answer['id'];?>' type='checkbox'>
			<?=$answer_text;?>
		</label>
	</td>
</tr>
<?php endforeach; ?>