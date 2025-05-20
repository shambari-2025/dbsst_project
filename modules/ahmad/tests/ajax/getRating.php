<?php if($rating):?>
	<option value="0" selected disabled>-Интихоб кунед-</option>
	<?php foreach($rating as $item): ?>
		<option value="<?=$item['rating']?>">Рейтинги <?=$item['rating']?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="0" selected disabled>-Забонро интихоб кунед-</option>
<?php endif;?>