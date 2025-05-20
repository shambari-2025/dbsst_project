<?php $counter = 0;?>
<?php $all_stds = $sh_stds = $b_stds = $k_stds = 0;?>
<?php foreach($groups as $item):?>
	<?php $all_students = count_table_where("students", "`status` = '-1' AND `id_faculty` = '{$item['id_faculty']}' 
		AND `id_s_l` = '{$item['id_s_l']}' 
		AND `id_s_v` = '{$item['id_s_v']}'
		AND `id_course` = '{$item['id_course']}' 
		AND `id_spec` = '{$item['id_spec']}'
		AND `id_group` = '{$item['id_group']}'
		AND `s_y` = '".S_Y."'
		");?>
	<tr <?php if($all_students < 8):?>style="background: #26354442;"<?php endif;?>>
		<td><?=++$counter?>.</td>
		<td><?=$item['faculty_short']?></td>
		<td><?=$item['s_l_title']?></td>
		<td><?=$item['s_v_title']?></td>
		<td class="bold">
			<a href="<?=MY_URL?>?option=commission&action=list&id_faculty=<?=$item['id_faculty']?>&id_s_l=<?=$item['id_s_l']?>&id_s_v=<?=$item['id_s_v']?>&id_course=<?=$item['id_course']?>&id_spec=<?=$item['id_spec']?>&id_group=<?=$item['id_group']?>">
				<?=$item['id_spec']?> <?=$item['spec_code']?> <?=$item['group_title']?>
			</a>
		</td>
		<td class="left"><?=$item['spec_title_tj']?></td>
		<td class="bold">
			<?=$all_students;?>
			<?php $all_stds += $all_students;?>
		</td>
		<td>
			<?php $sh = count_table_where("students", "`status` = '-1' AND `id_faculty` = '{$item['id_faculty']}' 
			AND `id_s_l` = '{$item['id_s_l']}' 
			AND `id_s_v` = '{$item['id_s_v']}'
			AND `id_course` = '{$item['id_course']}' 
			AND `id_spec` = '{$item['id_spec']}'
			AND `id_group` = '{$item['id_group']}'
			AND `id_s_t` = '1'
			AND `s_y` = '".S_Y."'");?>
			<?=$sh;?>
			<?php $sh_stds += $sh;?>
			
		</td>
		<td>
			<?php $b = count_table_where("students", "`status` = '-1' AND `id_faculty` = '{$item['id_faculty']}' 
			AND `id_s_l` = '{$item['id_s_l']}' 
			AND `id_s_v` = '{$item['id_s_v']}'
			AND `id_course` = '{$item['id_course']}' 
			AND `id_spec` = '{$item['id_spec']}'
			AND `id_group` = '{$item['id_group']}'
			AND `id_s_t` = '2'
			AND `s_y` = '".S_Y."'");?>
			
			<?=$b;?>
			<?php $b_stds += $b;?>
		</td>
		<td>
			<?php $k = count_table_where("students", "`status` = '-1' AND `id_faculty` = '{$item['id_faculty']}' 
			AND `id_s_l` = '{$item['id_s_l']}' 
			AND `id_s_v` = '{$item['id_s_v']}'
			AND `id_course` = '{$item['id_course']}' 
			AND `id_spec` = '{$item['id_spec']}'
			AND `id_group` = '{$item['id_group']}'
			AND `id_s_t` = '3'
			AND `s_y` = '".S_Y."'");?>
			
			<?=$k;?>
			<?php $k_stds += $k;?>
		</td>
	</tr>
<?php endforeach;?>

<tr class="bold">
	<td colspan="6">
	</td>
	<td><?=$all_stds?></td>
	<td><?=$sh_stds;?></td>
	<td><?=$b_stds;?></td>
	<td><?=$k_stds;?></td>
</tr>