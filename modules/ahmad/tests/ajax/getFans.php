<?php if($fans):?>
	<option value="0" selected disabled>-Интихоб кунед-</option>
	<?php foreach($fans as $item): ?>
		<option value="<?=$item['id']?>"><?=getFanTest($item['id'])?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="0" selected disabled>-Нимсоларо интихоб кунед-</option>
<?php endif;?>