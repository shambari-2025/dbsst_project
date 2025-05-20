<table class="table" style="font-size:14px">
	<thead class="center">
		<tr style="background-color: #263544; color: #fff">
			<td colspan="1" rowspan="2">#</td>
			<td colspan="1" rowspan="2">Намуди савол</td>
			<td colspan="2" rowspan="1">Тоҷики</td>
			<td colspan="2" rowspan="1">Руссӣ</td>
			<td colspan="2" rowspan="1">Аглисӣ</td>
		</tr>
		<tr style="background-color: #263544; color: #fff">
			<td>Рейтинг 1</td>
			<td>Рейтинг 2</td>
			<td>Рейтинг 1</td>
			<td>Рейтинг 2</td>
			<td>Рейтинг 1</td>
			<td>Рейтинг 2</td>
		</tr>
	</thead>
	<tbody class="center">
		<?php $counter = 0;?>
		<?php foreach($questions_type as $k => $value):?>
			<?php $type = $k;?>
			<tr class="center">
				<th scope="row"><?=++$counter?>.</th>
				<td><?=$value?></td>
				<td><?=count_table_where("questions", "`lang` = 'tj' AND `id_fan` = '$id_fan' AND `type` = '$type' AND `rating` = '1'")?></td>
				<td><?=count_table_where("questions", "`lang` = 'tj' AND `id_fan` = '$id_fan' AND `type` = '$type' AND `rating` = '2'")?></td>
				<td><?=count_table_where("questions", "`lang` = 'ru' AND `id_fan` = '$id_fan' AND `type` = '$type' AND `rating` = '1'")?></td>
				<td><?=count_table_where("questions", "`lang` = 'ru' AND `id_fan` = '$id_fan' AND `type` = '$type' AND `rating` = '2'")?></td>
				<td><?=count_table_where("questions", "`lang` = 'en' AND `id_fan` = '$id_fan' AND `type` = '$type' AND `rating` = '1'")?></td>
				<td><?=count_table_where("questions", "`lang` = 'en' AND `id_fan` = '$id_fan' AND `type` = '$type' AND `rating` = '2'")?></td>
			</tr>
		<?php endforeach;?>
		<tr class="bold center">
			<td></td>
			<td>Ҳамаги саволҳо</td>
			<td><?=count_table_where("questions", "`lang` = 'tj' AND `id_fan` = '$id_fan' AND `rating` = '1'")?></td>
			<td><?=count_table_where("questions", "`lang` = 'tj' AND `id_fan` = '$id_fan' AND `rating` = '2'")?></td>
			<td><?=count_table_where("questions", "`lang` = 'ru' AND `id_fan` = '$id_fan' AND `rating` = '1'")?></td>
			<td><?=count_table_where("questions", "`lang` = 'ru' AND `id_fan` = '$id_fan' AND `rating` = '2'")?></td>
			<td><?=count_table_where("questions", "`lang` = 'en' AND `id_fan` = '$id_fan' AND `rating` = '1'")?></td>
			<td><?=count_table_where("questions", "`lang` = 'en' AND `id_fan` = '$id_fan' AND `rating` = '2'")?></td>
		</tr>
	</tbody>
</table>