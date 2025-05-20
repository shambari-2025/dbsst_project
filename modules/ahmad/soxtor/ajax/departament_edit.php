<form action="<?=MY_URL?>?option=soxtor&action=departament_update" method="post" enctype="multipart/form-data">
	<table class="addform" >
		<tr>
			<td style="width: 60%">
				<label for="title">Номи кафедра:</label>
				<input value="<?=$departament[0]['title']?>" type="text" name="title" id="title" class="form-control">
			</td>
			
			<td>
				<label for="id_mudir">Мудири кафедра:</label>
				<select name="id_mudir" id="id_mudir" class="form-control">
					<option value="">-- Интихоб кунед! --</option>
					<?php foreach($teachers as $item):?>
						<option <?php if($departament[0]['id_mudir'] == $item['id']):?> selected <?php endif;?> value="<?=$item['id']?>"><?=$item['fullname_tj']?></option>
					<?php endforeach;?>
				</select>
			</td>
			
		</tr>
		<tr>
			<td colspan="1">
				<input type="hidden" name="id" id="id" value="<?=$id?>">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function () {
		
	});
</script>