<form action="<?=MY_URL?>?option=nt&action=updateContent" method="post" enctype="multipart/form-data">
	
	<table class="addform testcase" style="width: 100%">	
		<tr>
			<td colspan="2" style="width:40%">
				<label for="fan">Фанро интихоб кунед:</label>
				<select name="fan" id="fan" class="form-control">
					<?php foreach($fanho as $fan_item): ?>
						<option <?php if($nt_content[0]['id_fan'] == $fan_item['id']):?>selected<?php endif;?> value="<?=$fan_item['id'];?>"><?=$fan_item['title_tj']; ?></option>
					<?php endforeach; ?>
				</select>
			</td>
			
			<td style="width:20%">
				<label for="semestr">Семестр:</label>
				<select name="semestr" id="semestr" class="form-control">
					<?php for($i = 1; $i <= 10; $i++):?>
						<option <?php if($nt_content[0]['semestr'] == $i):?>selected<?php endif;?> value="<?=$i;?>">Семестри <?=$i;?></option>
					<?php endfor; ?>
				</select>
			</td>
			
			
			
			<td style="width:20%">
				<div class="checkbox-zoom zoom-success" style="margin: 0px">
					<label class="semestr" for="intixobi" style="display: inline; margin:0px">
						Интихобист <br>
						<input <?php if(isset($nt_content[0]['intixobi'])):?>checked<?php endif;?> type="checkbox" name="intixobi" id="intixobi" class="checkall form-control">
						<span class="cr" style="margin: 0px">
							<i class="cr-icon icofont icofont-ui-check txt-success"></i>
						</span>
					</label>
				</div>
			</td>
			
			<td style="width:20%">
				<label for="kori_c">Кори курси:</label>
				<select name="kori_c" id="kori_c" class="form-control">
					<option value="0">Надорад</option>
					<option <?php if($nt_content[0]['k_k'] == 1):?>selected<?php endif;?> value="1">Дорад</option>
				</select>
			</td>
			
		</tr>
		
		
		<tr>
			<td colspan="1" style="width:18%">
				<label for="c_umumi">Кредити умумӣ:</label>
				<select name="c_umumi" id="c_umumi" class="form-control">
					<?php for($i = 1; $i <= 10; $i+=0.5):?>
						<option <?php if($nt_content[0]['c_u'] == $i):?>selected<?php endif;?> value="<?=$i?>"><?=$i?> - кредит</option>
					<?php endfor;?>
				</select>
			</td>
			
			<td colspan="1" style="width:18%">
				<label for="c_f_umumi">КФУ:</label>
				<select name="c_f_umumi" id="c_f_umumi" class="form-control">
					<?php for($i = 1; $i <= 10; $i+=0.5):?>
						<option <?php if($nt_content[0]['c_f_u'] == $i):?>selected<?php endif;?> value="<?=$i?>"><?=$i?> - кредит</option>
					<?php endfor;?>
				</select>
			</td>
			
			<td colspan="1" style="width:18%">
				<label for="c_aud">КА:</label>
				<select name="c_aud" id="c_aud" class="form-control">
					<?php for($i = 0; $i <= 10; $i+=0.5):?>
						<option <?php if($nt_content[0]['c_a'] == $i):?>selected<?php endif;?> value="<?=$i?>"><?=$i?> - кредит</option>
					<?php endfor;?>
				</select>
			</td>
			
			<td colspan="1" style="width:18%">
				<label for="cmro">КМРО:</label>
				<select name="cmro" id="cmro" class="form-control">
					<?php for($i = 0; $i <= 10; $i+=0.5):?>
						<option <?php if($nt_content[0]['cmro'] == $i):?>selected<?php endif;?> value="<?=$i?>"><?=$i?> - кредит</option>
					<?php endfor;?>
				</select>
			</td>
			
			<td colspan="1" style="width:18%">
				<label for="cmd">КМД:</label>
				<select name="cmd" id="cmd" class="form-control">
					<?php for($i = 0; $i <= 10; $i+=0.5):?>
						<option <?php if($nt_content[0]['cmd'] == $i):?>selected<?php endif;?> value="<?=$i?>"><?=$i?> - кредит</option>
					<?php endfor;?>
				</select>
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
