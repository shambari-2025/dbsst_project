<?php if($regions):?>
	<option value="">-Вилоятро интихоб кунед-</option>
	<?php foreach($regions as $item): ?>
		<option value="<?=$item['id']?>"><?=$item['name']?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="" selected>-Дар ин мамлакат вилоят/шаҳр ёфт нашуд-</option>
<?php endif;?>
