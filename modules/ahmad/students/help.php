<table class="table" style="width:46%; float: left" border="1">
	<thead class="center">
		<tr>
			<td colspan="4">Нақшаи таълимии КУҲНА</td>
		</tr>
		<tr style="background-color: #263544; color: #fff">
			<th class="counter">№</th>
			<th class="left">Фан</th>
			<th class="left">Кредит</th>
			<th class="left">Семестр</th>
		</tr>
	</thead>
	<tbody class="center">
		<?php $counter = 0;?>
		<?php foreach($old_nt_content as $item):?>
			<tr>
				<td><?=++$counter?></td>
				<td><?=getFan($item['id_fan'])?></td>
				<td><?=($item['c_u'])?></td>
				<td><?=getSemestr($item['id_course'], $item['h_y'])?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>


<table class="table" style="width:46%; float: right" border="1">
	<thead class="center">
		<tr>
			<td colspan="4">Нақшаи таълимии НАВ</td>
		</tr>
		<tr style="background-color: #263544; color: #fff">
			<th class="counter">№</th>
			<th class="left">Фан</th>
			<th class="left">Кредит</th>
			<th class="left">Семестр</th>
		</tr>
	</thead>
	<tbody class="center">
		<?php $counter = 0;?>
		<?php foreach($new_nt_content as $item):?>
			<tr>
				<td><?=++$counter?></td>
				<td><?=getFan($item['id_fan'])?></td>
				<td><?=($item['c_u'])?></td>
				<td><?=getSemestr($item['id_course'], $item['h_y'])?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>

<div style="clear: both;"></div>

<table class="table" style="width:46%; margin: 20px auto" border="1">
	<thead class="center">
		<tr>
			<td colspan="4">Разница</td>
		</tr>
		<tr style="background-color: #263544; color: #fff">
			<th class="counter">№</th>
			<th class="left">Фан</th>
			<th class="left">Кредит</th>
			<th class="left">Семестр</th>
		</tr>
	</thead>
	<tbody class="center">
		<?php $counter = 0;?>
		<?php $credits = 0;?>
		<?php foreach($raznitsa as $item):?>
			<tr>
				<td><?=++$counter?></td>
				<td><?=getFan($item['id_fan'])?></td>
				<td>
					<?=($item['c_u'])?>
					<?php $credits += $item['c_u']?>
				</td>
				<td><?=getSemestr($item['id_course'], $item['h_y'])?></td>
			</tr>
		<?php endforeach;?>
		<tr style="font-weight: bold">
			<td></td>
			<td>Суммаи кредитҳо</td>
			<td><?=$credits?></td>
			<td></td>
		</tr>
	</tbody>
</table>

<?php exit;?>

<table border="1" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td colspan="5">Нақшаи куҳна</td>
			<td colspan="5">Нақшаи нав</td>
		</tr>
		<tr>
			<td>№</td>
			<td>Фан</td>
			<td>Кредит</td>
			<td>Курс</td>
			<td>Нисмола</td>
			
			<td>№</td>
			<td>Фан</td>
			<td>Кредит</td>
			<td>Курс</td>
			<td style="width:97px;">
				<p>
					Нисмола</p>
			</td>
		</tr>
		<tr>
			<td style="width:30px;">
				<p>
					&nbsp;</p>
			</td>
			<td style="width:166px;">
				<p>
					&nbsp;</p>
			</td>
			<td style="width:97px;">
				<p>
					&nbsp;</p>
			</td>
			<td style="width:97px;">
				<p>
					&nbsp;</p>
			</td>
			<td style="width:97px;">
				<p>
					&nbsp;</p>
			</td>
			<td style="width:33px;">
				<p>
					&nbsp;</p>
			</td>
			<td style="width:161px;">
				<p>
					&nbsp;</p>
			</td>
			<td style="width:97px;">
				<p>
					&nbsp;</p>
			</td>
			<td style="width:97px;">
				<p>
					&nbsp;</p>
			</td>
			<td style="width:97px;">
				<p>
					&nbsp;</p>
			</td>
		</tr>
	</tbody>
</table>
<p>
	&nbsp;</p>
