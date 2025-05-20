<form action="<?=MY_URL?>?option=soxtor&action=facultet_updated" method="post" enctype="multipart/form-data">
	<table class="addform" >
		<tr>
			<td colspan="2">
				<label for="title">Номи пурраи факулет:</label>
				<input value="<?=$faculty[0]['title']?>" type="text" name="title" id="title" class="form-control">
			</td>
		</tr>	
		<tr>	
			<td>
				<label for="short_title">Номи кутоҳи факулет:</label>
				<input value="<?=$faculty[0]['short_title']?>" type="text" name="short_title" id="short_title" class="form-control">
			</td>
			
			<td>
				<label for="id_decan">Декани факултет:</label>
				<select name="id_decan" id="id_decan" class="form-control">
					<option value="">-- Интихоб кунед! --</option>
					<?php foreach($teachers as $item):?>
						<option <?php if($faculty[0]['id_decan'] == $item['id']):?> selected <?php endif?> value="<?=$item['id']?>"><?=$item['fullname_tj']?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="1">
				<input type="hidden" name="id" value="<?=$id?>">
				<input type="hidden" name="id_faculty" value="<?=$faculty[0]['id']?>">
				<input type="hidden" name="s_y" value="<?=$faculty[0]['s_y']?>">
				<input type="hidden" name="h_y" value="<?=$faculty[0]['h_y']?>">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function () {
		
	});
</script>