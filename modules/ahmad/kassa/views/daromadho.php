<div class="table-responsive davrifaol">
	<p><?=UNI_NAME?></p>
	<table class="table" style="font-size:14px; width: 45%">
		<tr class="center" style="background-color: #263544; color: #fff">
			<th>Даромад</th>
			<th>Маблағ</th>
		</tr>
		<tr class="bold">
			<td>Барои қабули ҳуҷҷатҳо</td>
			<td class="center"><?=makeBeauty($hujjat);?></td>
		</tr>
		
		<tr class="bold">
			<td>Шартномаи таҳсил дар касса</td>
			<td class="center"><?=makeBeauty($shartnoma_inkassa);?></td>
		</tr>
		
		<tr class="bold">
			<td>Пардохт барои трисместр</td>
			<td class="center"><?=makeBeauty($trimestr);?></td>
		</tr>
		
		<tr class="bold">
			<td>Пардохт барои фарқият</td>
			<td class="center"><?=makeBeauty($farqiyat);?></td>
		</tr>
		
		<tr class="bold">
			<td>Пардохт барои хобгоҳ</td>
			<td class="center"><?=makeBeauty($xobgoh);?></td>
		</tr>
		
		
		<tr class="bold">
			<td class="right">Ҳамагӣ 
			<?php if(isset($from_date)):?>
				аз <?=$date_from?>
			<?php endif;?>
			то <?=$date?></td>
			<td class="center">
				<?=makeBeauty($total)?>
			</td>
		</tr>
	</table>
	<script>
	hiddenShowTrs();

	function hiddenShowTrs(){
		var trs = document.querySelectorAll('.tr_khobgoh');
		trs.forEach((tr) => {
			tr.classList.toggle('d-none');
		});
			
		
	}
	hiddenShowTrsDip();

	function hiddenShowTrsDip(){
		var trs_diplom = document.querySelectorAll('.tr_diplom');
		trs_diplom.forEach((tr) => {
			tr.classList.toggle('d-none');
		});
			
		
	}
	</script>
</div>