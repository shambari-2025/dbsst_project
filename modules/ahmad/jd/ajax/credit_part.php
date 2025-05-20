<hr class="h">

<table class="addform testcase" style="width: 100%">	
	<tr>
		<td colspan = "4" style="width:80%">
			<label for="fan">Фанро интихоб кунед:</label>
			<select name="fan[]" id="fan" class="form-control">
				<?php foreach($fanho as $fan_item): ?>
					<option value="<?=$fan_item['id'];?>"><?=$fan_item['title_tj']; ?></option>
				<?php endforeach; ?>
			</select>
		</td>
		
		<td style="width:20%">
			<label for="kori_c">Кори курси:</label>
			<select name="kori_c[]" id="kori_c" class="form-control">
				<option value="0">Надорад</option>
				<option value="1">Дорад</option>
			</select>
		</td>
		
	</tr>
	
	
	<tr>
		<td colspan="1" style="width:18%">
			<label for="c_umumi">Кредити умумӣ:</label>
			<select name="c_umumi[]" id="c_umumi" class="form-control">
				<?php for($i = 1; $i <= 10; $i+=0.5):?>
					<option value="<?=$i?>"><?=$i?> - кредит</option>
				<?php endfor;?>
			</select>
		</td>
		
		<td colspan="1" style="width:18%">
			<label for="c_f_umumi">КФУ:</label>
			<select name="c_f_umumi[]" id="c_f_umumi" class="form-control">
				<?php for($i = 1; $i <= 10; $i+=0.5):?>
					<option value="<?=$i?>"><?=$i?> - кредит</option>
				<?php endfor;?>
			</select>
		</td>
		
		<td colspan="1" style="width:18%">
			<label for="c_aud">КА:</label>
			<select name="c_aud[]" id="c_aud" class="form-control">
				<?php for($i = 0; $i <= 10; $i+=0.5):?>
					<option value="<?=$i?>"><?=$i?> - кредит</option>
				<?php endfor;?>
			</select>
		</td>
		
		<td colspan="1" style="width:18%">
			<label for="cmro">КМРО:</label>
			<select name="cmro[]" id="cmro" class="form-control">
				<?php for($i = 0; $i <= 10; $i+=0.5):?>
					<option value="<?=$i?>"><?=$i?> - кредит</option>
				<?php endfor;?>
			</select>
		</td>
		
		<td colspan="1" style="width:18%">
			<label for="cmd">КМД:</label>
			<select name="cmd[]" id="cmd" class="form-control">
				<?php for($i = 0; $i <= 10; $i+=0.5):?>
					<option value="<?=$i?>"><?=$i?> - кредит</option>
				<?php endfor;?>
			</select>
		</td>
		
	</tr>
</table>