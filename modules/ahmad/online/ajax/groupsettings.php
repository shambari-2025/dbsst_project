<div class="col-md-12 col-sm-12">
	<form action="<?=URL_TO_MODULES?>students/students_module.php?do=groupsettings_update" method="post" enctype="multipart/form-data">
		<table id="par" style="font-size:15px; width: 100%;">
			<tr>
				<td>
					<label for="id_naqsha" class="f-14">Нақшаи таълимӣ:</label>
					<select name="id_nt" id="id_naqsha" class="form-control f-16" required>
						<?php foreach($nts as $item):?>
							<option <?php if($id_nt == $item['id']){ echo "selected";}?> value="<?=$item['id'];?>"><?=$item['title']?> - <?=$item['soli_tasdiq']?></option>
						<?php endforeach;?>
					</select>
				</td>
				
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				
				<td>
					<label for="lang" class="f-14">Забони таҳсили гурӯҳ:</label>
					<select name="lang" id="lang" class="form-control f-16">
						<option value="tj" <?php if($lang == 'tj'){echo "selected";}?>>Тоҷикӣ</option>
						<option value="ru" <?php if($lang == 'ru'){echo "selected";}?>>Руссӣ</option>
						<option value="en" <?php if($lang == 'en'){echo "selected";}?>>Англисӣ</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			
			<tr>
				<td>
					<input type="hidden" name="id" value="<?=$id;?>">
					<button type="submit" class="btn btn-inverse waves-effect waves-light">Сабт кардан</button>
				</td>
			</tr>
		</table>
	</form>

</div>