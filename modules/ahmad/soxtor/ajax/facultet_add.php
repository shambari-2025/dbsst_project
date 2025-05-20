<form action="<?=MY_URL?>?option=soxtor&action=facultet_insert" method="post" enctype="multipart/form-data">
	<table class="addform" >
		<tr>
			<td colspan="2">
				<label for="title">Номи пурраи факулет:</label>
				<input type="text" name="title" id="title" class="form-control">
			</td>
		</tr>	
		<tr>	
			<td>
				<label for="short_title">Номи кутоҳи факулет:</label>
				<input type="text" name="short_title" id="short_title" class="form-control">
			</td>
			
			<td>
				<label for="id_decan">Декани факултет:</label>
				<select name="id_decan" id="id_decan" class="form-control">
					<option value="">-- Интихоб кунед! --</option>
					<?php foreach($teachers as $item):?>
						<option value="<?=$item['id']?>"><?=$item['fullname_tj']?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="1">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function () {
		
	});
</script>