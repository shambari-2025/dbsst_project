<hr class="h">

<table class="addform testcase" style="width: 50%">	
	<tr>
		<td style="width:40%">
			<label for="kormandon">Омӯзгорро интихоб кунед:</label>
			<select name="kormandon[]" id="kormandon" class="form-control">
				<?php foreach($kormandon as $kormand): ?>
					<option value="<?=$kormand['id'];?>"><?=getUserName($kormand['id']);?></option>
				<?php endforeach; ?>
			</select>
		</td>	
		<td style="width:40%">
			<label for="vazifaho">Вазифаро интихоб кунед:</label>
			<select name="vazifaho[]" id="vazifaho" class="form-control">
				<?php foreach($vazifaho as $vazifa): ?>
					<option value="<?=$vazifa['id'];?>"><?=($vazifa['name_tj']);?></option>
				<?php endforeach; ?>
			</select>
		</td>		
	</tr>
</table>