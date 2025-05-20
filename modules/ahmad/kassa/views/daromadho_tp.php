<div class="table-responsive davrifaol">
<p>Муассисаи технопарки Донишгоҳи техникии Тоҷикистон</p>
<table class="table" style="font-size:14px; width: 45%">
	<tr class="center" style="background-color: #263544; color: #fff">
		<th>Даромад</th>
		<th>Маблағ</th>
	</tr>
	
	
	
	<tr class="bold">
		<td>Пардохт барои диплом</td>
		<td class="center"><?=makeBeauty($diplom_tp);?></td>
	</tr>
	<tr class="bold">
		<td>Пардохт барои маълумотномаи академикӣ ва замима</td>
		<td class="center"><?=makeBeauty($zamima_tp);?></td>
	</tr>
	<tr class="bold">
		<td>Пардохт барои маълумотномаи таҳсил</td>
		<td class="center"><?=makeBeauty($malumot_tahsil_tp);?></td>
	</tr>
	<tr class="bold">
		<td>Пардохт барои хизматрасонии бойгони</td>
		<td class="center"><?=makeBeauty($boygoni_tp);?></td>
	</tr>
	
	
	
	
	<tr class="bold">
		<td>Пардохт барои мақола</td>
		<td class="center"><?=makeBeauty($maqola_tp);?></td>
	</tr>
	<tr class="bold">
		<td>Пардохт барои антиплагиат</td>
		<td class="center"><?=makeBeauty($anti_plagiat_tp);?></td>
	</tr>
	<tr class="bold">
			<td>Пардохт барои бандубаст ва чопи маводҳо</td>
			<td class="center"><?=makeBeauty($tipagrafiya);?></td>
		</tr>
	
	<tr class="bold">
		<td class="right">Ҳамагӣ 
		<?php if(isset($from_date)):?>
			аз <?=$date_from?>
		<?php endif;?>
		то <?=$date?></td>
		<td class="center">
			<?=makeBeauty($total_tp)?>
		</td>
	</tr>
</table>
</div>