<hr class="h">

<table class="addform testcase" style="width: 100%">	
	<tr>
		<td style="width: 50%">
			<label for="id_spec">Ихтисосро интихоб кунед:</label>
			<select name="id_spec[]" id="id_spec" class="form-control">
				<?php foreach($specialties as $item): ?>
					<option value="<?=$item['id'];?>"><?=$item['code']?> - <?=$item['title_tj']; ?> (<?=getFaculty($item['id_faculty'])?>)</option>
				<?php endforeach; ?>
			</select>
		</td>
		
		<td>
			<label for="id_s_l">Зинаи таҳсилро интихоб кунед:</label>
			<select name="id_s_l[]" id="id_s_l" class="form-control">
				<?php foreach($studylevel as $item): ?>
					<option value="<?=$item['id'];?>"><?=$item['title']; ?></option>
				<?php endforeach; ?>
			</select>
		</td>
		
		<td>
			<label for="id_s_v">Шакли таҳсилро интихоб кунед:</label>
			<select name="id_s_v[]" id="id_s_v" class="form-control">
				<?php foreach($studyviews as $item): ?>
					<option value="<?=$item['id'];?>"><?=$item['title']; ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>	
	<tr>	
		
		<td >
			<label for="id_s_t">Намуди таҳсилро интихоб кунед:</label>
			<select name="id_s_t[]" id="id_s_t" class="form-control">
				<?php foreach($studytype as $item): ?>
					<option value="<?=$item['id'];?>"><?=$item['title']?></option>
				<?php endforeach; ?>
			</select>
		</td>
		
		<td>
			<label for="money">Маблағи таҳсил:</label>
			<input type="text" name="money[]" id="money" class="form-control">
		</td>
		
		<td>
			<label for="money_other">Барои шаҳрвандони хориҷӣ:</label>
			<input type="text" name="money_other[]" id="money_other" class="form-control">
		</td>
	</tr>	
	<tr>	
		
		<td >
			<label for="lang">Забони таҳсилро интихоб кунед:</label>
			<select name="lang[]" id="lang" class="form-control">
				<?php foreach($langs as $v => $k): ?>
					<option value="<?=$v;?>"><?=$k?></option>
				<?php endforeach; ?>
			</select>
		</td>
		
		<td colspan="2">
			<label for="plan">Миқдори довталаб:</label>
			<input type="text" name="plan[]" id="plan" class="form-control">
		</td>
	</tr>
</table>