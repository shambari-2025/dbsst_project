<form action="<?=MY_URL?>?option=tests&action=update" method="post" enctype="multipart/form-data">
	<table class="addform" >
		<tr class="w33">
			<td colspan="1">
				<label for="imt_type">Намуди имтиҳон:</label>
				<select name="imt_type" id="imt_type" class="form-control">
					<?php foreach($imt_types as $v => $k):?>
						<option <?php if($test[0]['imt_type'] == $v) {echo "selected"; }?> value="<?=$v?>"><?=$k?></option>
					<?php endforeach;?>
				</select>
			</td>
			
			<td colspan="1">
				<label for="datetime">Сана ва вақти имтиҳон:</label>
				<input value="<?=$test[0]['datetime']?>" type="datetime-local" name="datetime" id="datetime" class="form-control">
			</td>
		</tr>
	
		<tr>
			<td colspan="1">
				<br>
				<input type="hidden" name="id" value="<?=$id?>">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>