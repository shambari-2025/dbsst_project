<?php if($specs):?>
	<option value="" selected disabled> - Интихоб кунед - </option>
	<?php foreach($specs as $item): ?>
		<option value="<?=$item['id']?>"><?=getSpecialtyCode($item['id'])?> - <?=$item['title']?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="0" selected disabled>-Дар ин факултет ихтисос нест-</option>
<?php endif;?>
