<table class="table" style="font-size:13px">
	<thead class="center">
		<tr style="background-color: #263544; color: #fff">
			<th class="counter">№</th>
			<th class="left" style="width:450px !important">Номӯйи саҳифаҳо</th>
			<th>Бори аввал</th>
			<th>Бори охир</th>
			<th>Миқдори<br>назаркунӣ</th>
		</tr>
	</thead>
	<tbody class="center">
		<?php $counter = 0 ?>
		<?php foreach($datas as $item):?>
			<tr>
				<td><?=++$counter?>.</td>
				<td class="left">
					<?=$item['page_title']?><br>
					 <?=urldecode($item['url'])?><br>
					 <?=$item['ip']?><br>
				</td>
				<td><?=$item['first_time']?></td>
				<td><?=$item['last_time']?></td>
				<td><?=$item['counter']?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>