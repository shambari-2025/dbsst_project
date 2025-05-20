<?php if($groups):?>
	<option value="0" selected disabled>-Интихоб кунед-</option>
	<?php foreach($groups as $item): ?>
		<option value="<?=$item['id_group']?>"><?=getGroup($item['id_group'])?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="0" selected disabled>-Ихтисосро интихоб кунед-</option>
<?php endif;?>