<form action="<?=MY_URL?>?option=khobgoh&action=order_khobgoh" method="post" enctype="multipart/form-data">
<table class="addform">
	<tr>
		
		<td>
			<label for="number_home">Рақами хона:</label>
			<input autocomplete="off" type="text" name="number_home" id="number_home" class="number_home form-control">
		</td>
		
		<td>
			<label >Кадом хобгоҳ:</label>
			<select name="type" id="type" class="form-control" required>
				<?php foreach($khobgoh_dtt as $v => $k):?>
					<option value="<?=$v;?>"><?=$k?></option>
				<?php endforeach;?>
			</select>
		</td>
		
	</tr>
	
	
	<tr>
		<td>
			<input type="hidden" name="id_student" value="<?=$id_student?>">
			<br>
			<button type="submit" class="btn btn-inverse waves-effect waves-light">
				<i class="fa fa-save"></i> Сабт кардан
			</button>
		</td>
	</tr>
</table>
	
</form>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.modal').on('shown.bs.modal', function () {
			$('.number_home').trigger('focus')
		})
		
	});
</script>