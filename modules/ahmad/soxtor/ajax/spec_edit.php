<form action="<?=MY_URL?>?option=soxtor&action=spec_update" method="post" enctype="multipart/form-data">
	<table class="addform" >
		<tr>
			<td>
				<label for="code">Коди ихтисос:</label>
				<input value="<?=$spec[0]['code']?>" type="text" name="code" id="code" class="form-control">
			</td>
			
			<td>
				<label for="id_s_l">Зинаи таҳсил:</label>
				<select name="id_s_l" id="id_s_l" class="form-control" required>
					<?php foreach($studylevels as $item):?>
						<option <?php if($item['id'] == $spec[0]['id_s_l']):?>selected<?php endif;?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>	
		<tr>	
			<td colspan="2">
				<label for="title_tj">Номи ихтисос ба тоҷикӣ:</label>
				<input autocomplete="off" value="<?=$spec[0]['title_tj']?>" type="text" name="title_tj" id="title_tj" class="form-control">
			</td>
		</tr>	
		<tr>
			<td colspan="2">
				<label for="title_ru">Номи ихтисос ба руссӣ:</label>
				<input autocomplete="off" value="<?=$spec[0]['title_ru']?>" type="text" name="title_ru" id="title_ru" class="form-control">
			</td>
		</tr>
		<tr>	
			<td colspan="2">
				<label for="title_en">Номи ихтисос ба англисӣ:</label>
				<input autocomplete="off" value="<?=$spec[0]['title_en']?>" type="text" name="title_en" id="title_en" class="form-control">
			</td>
		</tr>
		<tr>
			<td colspan="2">
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