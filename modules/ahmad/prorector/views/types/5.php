Дохилкунии матн
<?php $answers = select("answers", "*", "`id_question` = '".$id_question."'", "id", false, ""); ?>
<?php foreach($answers as $answer): ?>
	<?php $answer_text = $answer['text']; ?>
	<?php $answer_text = str_replace("<p>","",$answer_text);?>
	<?php $answer_text = str_replace("</p>","",$answer_text);?>
<tr>
	<td style="text-align: left; width: 50%;">
		<label for='id_<?=$answer['id']?>'>
			<input id='id_<?=$answer['id'];?>' <?php if(array_search($answer['id'], $id_aftq) !== false ){echo "checked";}?> value='<?=$answer['id'];?>' type='radio' name="<?=$id_question;?>">
			<?=$answer_text;?>
		</label>
	</td>
	<td style="text-align: left; width: 50%;">
		<label>
			<input disabled id='id_<?=$answer['id'];?>' <?php if($answer['right_answer']){echo "checked";}?> value='<?=$answer['id'];?>' type='radio'>
			<?=$answer_text;?>
		</label>
	</td>
</tr>
<?php endforeach; ?>
<?php if($id_aftq[0] == 0): ?>
	<tr>
		<td class="noanswer bold" colspan="2">Донишҷу ҷавоб надодааст!</td>
	</tr>
<?php endif;?>