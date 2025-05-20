<?php if(!empty($fanho)):?>
	<?php for($i=1;$i<=6;$i++):?>
		<hr class="h">
		<p class="center" style="font-size:30px"><?=getDay($i)?>.</p>
		<table class="addform addtest testcase" style="width: 100%">
			<tr>
				<td style="text-align:center; font-weight: bold;">Соат</td>
				<td style="text-align:center; font-weight: bold;">Фан</td>
				<td style="text-align:center; font-weight: bold;">Намуди дарс</td>
				<td style="text-align:center; font-weight: bold;">Омузгор</td>
			</tr>
		<?php for($j=1;$j<=7;$j++):?>
			<tr>
				<td><?=$j;?></td>
				<td>
					<label for="fan">Фанро интихоб кунед:</label>
					<select name="fan[<?=$i;?>][<?=$j;?>][]" id="fan" class="form-control">
						<?php $zap=query("SELECT * FROM `jd` WHERE `id_faculty`='$id_faculty' AND `id_course`='$id_course' AND `id_spec`='$id_spec' AND `id_group`='$id_group' AND `ruz`='$i' AND `soat`='$j' AND `s_y`='".S_Y."' AND `h_y`='".H_Y."'");?>
						<?php foreach($fanho as $fan_item): ?>
								<?php $id_fan=$zap[0]['id_fan'];?>
								<option <?php if($id_fan == $fan_item['id']){ echo "selected";}?> value="<?=$fan_item['id'];?>"><?=$fan_item['title_tj']; ?></option>
								<!--<option value="<?=$fan_item['id'];?>"><?=$fan_item['title_tj']; ?></option>-->
						<?php endforeach; ?>
					</select>
				</td>
				<td>
					<label for="l_type">Намуди дарс</label>
					<select name="l_type[<?=$i;?>][<?=$j;?>][]" id="l_type" class="form-control">
						<?php foreach($l_type as $item): ?>
							<?php $less_type=$zap[0]['lessons_type'];?>
							<option <?php if($less_type == $item['id']){ echo "selected";}?> value="<?=$item['id'];?>"><?=$item['title_tj']; ?></option>
						<?php endforeach; ?>
					</select>				
				</td>
				<td><label for="teacher">Омӯзгорро интихоб кунед:</label>
					<select name="teacher[<?=$i;?>][<?=$j;?>][]" id="teacher" class="form-control">
						<option value="">-Омӯзгорро интихоб кунед-</option>
						<?php foreach($teachers as $teacher): ?>
							<?php $id_teacher=$zap[0]['id_teacher'];?>
							<option <?php if($id_teacher == $teacher['id']){ echo "selected";}?> value="<?=$teacher['id'];?>"><?=$teacher['fullname_tj']; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
		<?php endfor;?>
		</table>
	<?php endfor;?>
	<?php /*
	<?php foreach($fanho as $item):?>
		<hr class="h">
		<p class="center" style="font-size:30px"><?=$j?>.</p>
		<table class="addform addtest testcase" style="width: 100%">		
			<tr class="w33">
				<td colspan="2">
					<label for="fan">Фанро интихоб кунед:</label>
					<select name="fan[]" id="fan" class="form-control">
						<?php foreach($fanho as $fan_item): ?>
							<option <?php if($item['id'] == $fan_item['id']){ echo "selected";}?> value="<?=$fan_item['id'];?>"><?=$fan_item['title_tj']; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
				<td colspan="1">
					<label for="teacher">Омӯзгорро интихоб кунед:</label>
					<select name="teacher[]" id="teacher" class="form-control">
						<option value="">-Омӯзгорро интихоб кунед-</option>
						<?php foreach($teachers as $teacher): ?>
							<option value="<?=$teacher['id'];?>"><?=$teacher['fullname_tj']; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
		</table>
		<?php $j++;?>
	<?php endforeach;?> */
	?>
<?php else:?>
	<br>
	<br>
	<p class="center bold"><?=getSpecialtyCode($id_spec)?> <?=getGroup2($id_group)?><br>Ҳамаи фанҳо бо омӯзгорҳо таъмин аст</p>
	<!--<a href="?option=jd&action=jd_for_group&id_faculty=<?=$id_faculty;?>&id_course=<?=$id_course;?>&id_spec=<?=$id_spec;?>&id_group=<?=$id_group;?>&s_y=<?=$s_y;?>&h_y=<?=$h_y?>"><p class="center bold">Сохтани ҷадвали дарсҳо</p></a>-->
<?php endif;?>