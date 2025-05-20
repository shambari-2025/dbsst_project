<?php $j = 1;?>
<?php foreach($fanho as $item):?>

	<hr class="h">
	<p class="center" style="font-size:30px"><?=$j?>.</p>
	<table class="addform addtest testcase" style="width: 100%">		
		<tr class="w33">
			<td colspan="2">
				<label for="fan">Фанро интихоб кунед:</label>
				<select name="fan[]" id="fan" class="form-control">
					<?php foreach($fanho as $fan_item): ?>
						<option <?php if($item['id'] == $fan_item['id']){ echo "selected";}?> value="<?=$fan_item['id'];?>"><?=$fan_item['title']; ?></option>
					<?php endforeach; ?>
				</select>
			</td>
			
			<td colspan="1">
				
				<label for="teacher">Фанро интихоб кунед:</label>
				<select name="teacher[]" id="teacher" class="form-control">
					<?php foreach($teachers as $teacher): ?>
						<option value="<?=$teacher['id'];?>"><?=$teacher['fullname']; ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
	</table>

	<?php $j++;?>
<?php endforeach;?>