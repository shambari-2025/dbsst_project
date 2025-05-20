<hr class="h">

<table class="addform testcase" style="width: 100%">	
	<tr>
		<td style="width:20%">
			<label for="soat">Соат</label><br>
			<input type="number" id="soat" name="soat[]" min="1" max="<?=$soatho;?>" class="form-control">
		</td>
		
		<td>
			<label for="teacher">Омӯзгорро интихоб кунед:</label>
			<select name="teacher[]" id="teacher" class="form-control">
				<?php foreach($teachers as $teacher): ?>
					<option value="<?=$teacher['id'];?>"><?=getUserName($teacher['id']);?></option>
				<?php endforeach; ?>
			</select>
		</td>		
	</tr>
</table>