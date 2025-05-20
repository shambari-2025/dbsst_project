
<thead>
	<tr>
		<td style="text-align: left;">Ҷавоби донишҷӯ</td>
	</tr>
</thead>
<tr>
	<td style="text-align: left; width: 50%;">		
		<?php $answers = select("answers", "*", "`id_question` = '".$id_question."'", "id", false, ""); ?>
		
		<?php $counter = 0;
		$tmp = $question[0]['text'];
		foreach($answers as $answer){
			$tmp = str_replace($answer['text'], "\\$counter/", $tmp);
			$counter++;
		}?>

		<?php $search = array();?>
		<?php $replace = array();?>
			
		
		<?php $z = 0;?>
		<?php foreach($answers as $answer){
			$tagselect = '<select name="type4_'.$id_question.'[]">';
			$tagselect .= "<option value='".gettextbyid($answer['id'])."'>".gettextbyid($answer['id'])."</option>"; 
			$search[] = "\\$z/";
			foreach($answers as $answer){
				$tagselect .= "<option value='".$answer['text']."'>".$answer['text']."</option>";
			}
			$tagselect .= "</select>";
			$replace[] = $tagselect;
			$z++;
		}
		$question['text'] = str_replace($search, $replace, $tmp);
		?>
		<p style="margin: 10px;"><?=$question['text'];?></p>
	</td>
</tr>
<thead>
	<tr>
		<td style="text-align: left;">Ҷавоби дуруст</td>
	</tr>
</thead>
<tr>
	<td style="text-align: left; width: 50%;">
		<?php $answers = select("answers", "*", "`id_question` = '".$id_question."'", "id", false, ""); ?>
		<?php $counter = 0;
		$tmp = $question[0]['text'];
		foreach($answers as $answer){
			$tmp = str_replace($answer['text'], "\\$counter/", $tmp);
			$counter++;
		}?>

		<?php $search = array();?>
		<?php $replace = array();?>

		<?php $z = 0;?>
		<?php foreach($answers as $answer){
			$tagselect = '<select disabled>';
			$tagselect .= "<option value='".$answer['text']."'>".$answer['text']."</option>"; 
			$search[] = "\\$z/";
			foreach($answers as $answer){
				$tagselect .= "<option value='".$answer['text']."'>".$answer['text']."</option>";
			}
			$tagselect .= "</select>";
			$replace[] = $tagselect;
			$z++;
		}
		$question['text'] = str_replace($search, $replace, $tmp);
		?>
		<p style="margin: 10px;"><?=$question['text'];?></p>
	</td>
</tr>
