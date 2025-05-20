<?php if($fans):?>
	<option value="0" selected disabled>-Интихоб кунед-</option>
	<?php foreach($fans as $item): ?>
		<option value="<?=$item['id_fan']?>"><?=getFanTest($item['id_fan'])?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="0" selected disabled>-Гуруҳро интихоб кунед-</option>
<?php endif;?>