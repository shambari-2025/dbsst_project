<?php if($districts):?>
	
	<?php foreach($districts as $item): ?>
		<option value="<?=$item['id']?>"><?=$item['name']?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="" selected>-Дар ин минтақа ноҳия/шаҳр ёфт нашуд-</option>
<?php endif;?>
