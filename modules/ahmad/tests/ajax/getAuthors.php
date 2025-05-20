<?php if($authors):?>
	<option value="0" selected disabled>-Интихоб кунед-</option>
	<?php foreach($authors as $item): ?>
		<option value="<?=$item['id']?>"><?=$item['fullname_tj']?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="0" selected disabled>-Фанро интихоб кунед-</option>
<?php endif;?>