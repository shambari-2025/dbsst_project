<?php if($zabon):?>
	<option value="0" selected disabled>-Интихоб кунед-</option>
	<?php foreach($zabon as $item): ?>
		<?php echo $zab = $item['lang'];?>
		<option value="<?=$item['lang']?>"><?=$langs[$zab]?></option>
	<?php endforeach; ?>
<?php else: ?>
	<option value="0" selected disabled>-Муаллифи саволро интихоб кунед-</option>
<?php endif;?>