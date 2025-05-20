<?php if($teachers):?>
	<option value="0" selected disabled>-Интихоб кунед-</option>
	<?php foreach($teachers as $item): ?>
		<option value="<?=$item['id_teacher']?>"><?=getUserName($item['id_teacher'])?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="0" selected disabled>-Фанро интихоб кунед-</option>
<?php endif;?>