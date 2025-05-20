<div class="card-block">
	
	
	
	<?php $id_question = $item['id']; ?>
	
	<?php $answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_question' AND `text` != '' ORDER BY RAND()");?>
	<?php //$answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_question' AND `text` != '' ORDER BY `id`");?>

	<?php $tagselect = '<select name="type4_'.$id_question.'[]">';?>
	<?php $tagselect .= "<option value='0' selected></option>";?>
	<?php $array_list = array();?>
	<?php foreach($answers as $answer){
		$tagselect .= "<option value='".$answer['text']."'>".$answer['text']."</option>";
		$array_list[] = $answer['text'].' ';
	}?>
	<?php $tagselect .= "</select>";?>

	<?php if($item['text'][mb_strlen($item['text'])-1] != '.'):?>
		<?php $item['text'] .= '.';?>
	<?php endif;?>

	<?php $s = array('.', ',', ':', '-', '');?>
	<?php $r = array(' .', ' ,', ' :', ' -', ' ');?>

	<?php $item['text'] = str_replace($s, $r, $item['text']);?>

	<?php $item['text'] = str_replace($array_list, "\/", $item['text']);?>
	<?php $item['text'] = str_replace("\/", $tagselect, $item['text']);?>

	<label><i>Ҷойхои холиро пур кунед:</i><br>
	<p style="margin-top: 10px;"><?=$item['text'];?></p>

</div>