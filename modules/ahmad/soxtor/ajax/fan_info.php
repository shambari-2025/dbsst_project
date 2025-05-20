<?php //print_arr($list);?>
<table class="table" style="font-size:14px">
	<thead class="center">
		<tr style="background-color: #263544; color: #fff">
			<th style="width:40px">№</th>
			<th style="width:50px">Факултет</th>
			<th style="width:50px">Курс</th>
			<th style="width:50px">Ихтисос</th>
			<th style="width:50px">Нақшаи таълимӣ</th>
			<th style="width:50px">Семестр</th>
		</tr>
	</thead>
	<tbody class="center">
		<?php $counter = 0;?>
		<?php foreach($list as $item):?>
			<tr>
				<th scope="row"><?=++$counter?>.</th>
				<td><?=getFacultyShort($item['id_faculty'])?></td>
				<td><?=$item['id_course']?></td>
				<td><?=getSpecialtyCode($item['id_spec'])?></td>
				<td class="bold">
					<a target="_blank" href="<?=MY_URL?>?option=nt&action=nt_list&id_nt=<?=$item['id_nt']?>">
						<?=$item['soli_tasdiq']?>
					</a>
				</td>
				<td><?=$item['semestr']?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
	


<script type="text/javascript">
	$(document).ready(function () {
		
	});
</script>