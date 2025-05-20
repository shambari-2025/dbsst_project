<form action="<?=MY_URL?>?option=students&action=delete_student" method="post" enctype="multipart/form-data">
	<table class="addform">
		
		<tr>
			<td colspan="2">
				<label for="id_sabab_khorij">Сабаби хориҷ:</label>
				<select name="id_sabab_khorij" id="id_sabab_khorij" class="form-control" required>
					<?php foreach($sabab_khorij as $v => $k): ?>
						<option value="<?=$v;?>"><?=$k?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td style="width:50%">
				<label for="farmon_number">Рақами фармон:</label>
				<input autocomplete="off" type="text" name="farmon_number" id="farmon_number" class="form-control">
			</td>
			
			<td>
				<label for="farmon_date">Санаи фармон:</label>
				<input type="date" name="farmon_date" id="farmon_date" class="form-control">
			</td>			
		</tr>
		
		
		<tr>
			<td style="width:50%">
				<label for="s_y" class="f-16">Соли таҳсил:</label>
				<select name="S_Y" id="s_y" class="form-control" style="font-size:16px">
					<?php foreach($STUDY_YEARS as $item): ?>
						<option <?php if($item['id'] == S_Y){ echo "selected";}?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
			
			<td>
				<label for="h_y" class="f-16">Нимсолаи таҳсил:</label>
				<select name="H_Y" id="h_y" class="form-control" style="font-size:16px">
					<option <?php if(H_Y == 1){echo "selected";}?> value="1">Нимсолаи 1-ум</option>
					<option <?php if(H_Y == 2){echo "selected";}?> value="2">Нимсолаи 2-юм</option>
				</select>
			</td>			
		</tr>
		
		
		
		<tr>
			<td colspan="2">
				<label for="farmon_text">Матни фармон:</label>
				<input type="text" name="farmon_text" id="farmon_text" class="form-control">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label for="asos_text">Асос:</label>
				<input type="text" name="asos_text" id="asos_text" class="form-control">
			</td>
		</tr>
		
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_student" value="<?=$id_student?>">
				<button type="submit" class="updatebtn btn btn-inverse waves-effect waves-light">
					<i class="fa fa-trash"></i> Хориҷкунӣ
				</button>
			</td>
		</tr>
	</table>
</form>


<script type="text/javascript">
jQuery(document).ready(function($){
	
	
});
</script>