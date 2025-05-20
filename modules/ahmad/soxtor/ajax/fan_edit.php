<form action="<?=MY_URL?>?option=soxtor&action=fan_update" method="post" enctype="multipart/form-data">
	<table class="addform" >
		<tr>
			<td>
				<label for="title_tj">Номи фан ба тоҷикӣ:</label>
				<input autocomplete="off" value="<?=$fan[0]['title_tj']?>" type="text" name="title_tj" id="title_tj" class="form-control">
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="title_ru">Номи фан ба руссӣ:</label>
				<input autocomplete="off" value="<?=$fan[0]['title_ru']?>" type="text" name="title_ru" id="title_ru" class="form-control">
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="title_en">Номи фан ба англисӣ:</label>
				<input autocomplete="off" value="<?=$fan[0]['title_en']?>" type="text" name="title_en" id="title_en" class="form-control">
			</td>
		</tr>
		<tr>	
			<td>
				<label for="id_departament">Кафедра:</label>
				<select name="id_departament" id="id_departament" class="form-control">
					<option value="">-- Интихоб кунед! --</option>
					<?php foreach($departaments as $item):?>
						<option <?php if($fan[0]['id_departament'] == $item['id']):?> selected <?php endif;?> value="<?=$item['id']?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
			
		</tr>
		<tr>
			<td colspan="1">
				<input type="hidden" name="id" value="<?=$id?>">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function () {
		
	});
</script>