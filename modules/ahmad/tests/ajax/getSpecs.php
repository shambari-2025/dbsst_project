<?php if($specs):?>
	<option value="0" selected disabled>-Интихоб кунед-</option>
	<?php foreach($specs as $item): ?>
		<option value="<?=$item['id_spec']?>"><?=getSpecialtyCode($item['id_spec'])?>-<?=getSpecialtyTitle($item['id_spec'])?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="0" selected disabled>-Факултетро интихоб кунед-</option>
<?php endif;?>