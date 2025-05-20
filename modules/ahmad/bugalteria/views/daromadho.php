<table class="table" style="font-size:14px; width: 50%">
	<tr class="center" style="background-color: #263544; color: #fff">
		<th>Даромад</th>
		<th>Маблағ</th>
	</tr>
	
	<tr class="bold">
		<td>Шартномаи таҳсил дар касса</td>
		<td class="center"><?=makeBeauty($shartnoma_inkassa);?></td>
	</tr>
	
	<tr class="bold">
		<td>Шартномаи таҳсил дар бонк</td>
		<td class="center"><?=makeBeauty($shartnoma_inbank);?></td>
	</tr>
	
	<tr class="bold">
		<td>Барои қабули ҳуҷҷатҳо</td>
		<td class="center"><?=makeBeauty($hujjat);?></td>
	</tr>
	
	<tr class="bold">
		<td class="right">Ҳамагӣ 
		<?php if(isset($from_date)):?>
			аз <?=$date_from?>
		<?php endif;?>
		то <?=$date?></td>
		<td class="center">
			<?=makeBeauty($shartnoma_inkassa + $shartnoma_inbank + $hujjat)?>
		</td>
	</tr>
</table>