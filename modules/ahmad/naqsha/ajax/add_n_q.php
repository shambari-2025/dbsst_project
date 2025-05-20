<form action="<?=MY_URL?>?option=naqsha&action=insert" method="post" enctype="multipart/form-data">
	
	<table style="width:100%">
		<tr>
			<td>
				<label for="title">Нақшаи қабул:</label>
				<input type="text" name="title" id="title" value="Нақшаи қабул" class="form-control">
			</td>
			<td>&nbsp;</td>
			<td>
				<label for="s_y">Соли таҳсил:</label>
				<select name="s_y" id="s_y" class="form-control" required>
					<?php foreach($studyyears as $item):?>
						<option value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<br>
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
			
		</tr>
	</table>
</form>