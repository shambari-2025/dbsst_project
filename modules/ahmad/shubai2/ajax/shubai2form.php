<form action="<?=MY_URL?>?option=biometric&action=updatebiometric" method="post" enctype="multipart/form-data">
	
	<table class="addform" style="width:100%">
		
		
		
		<tr>
			<td>
				<label for="id_scan1_finger1">Гуруҳи баҳисобгирӣ:</label><br>
				<textarea rows="2" name="scan1_finger1" id="id_scan1_finger1" class="form-control"><?=@$users_shubai2[0]['scan1_finger1']?></textarea>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="id_scan1_finger2">Қисми баҳисобгирӣ:</label><br>
				<textarea rows="2" name="scan1_finger2" id="id_scan1_finger2" class="form-control"><?=@$users_shubai2[0]['scan1_finger2']?></textarea>
			</td>
		</tr>
		
		
		
		<tr>
			<td>
				<label for="id_scan2_finger1">Ҳайат:</label><br>
				<textarea rows="2" name="scan2_finger1" id="id_scan1_finger1" class="form-control"><?=@$users_shubai2[0]['scan2_finger1']?></textarea>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="id_scan2_finger2">Унвони ҳарбӣ:</label><br>
				<textarea rows="2" name="scan2_finger2" id="id_scan2_finger2" class="form-control"><?=@$users_shubai2[0]['scan2_finger2']?></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<label for="id_scan2_finger2">Ихт. ҳарбӣ- баҳисобгирии №:</label><br>
				<textarea rows="2" name="scan2_finger2" id="id_scan2_finger2" class="form-control"><?=@$users_shubai2[0]['scan2_finger2']?></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<label for="id_scan2_finger2">Коршоямӣ ба хизмати ҳарбӣ:</label><br>
				<textarea  name="scan2_finger2" id="id_scan2_finger2" class="form-control"><?=@$users_shubai2[0]['scan2_finger2']?></textarea>
			</td>
		</tr>
		
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_student" value="<?=$id_student?>">
				<?php if(!empty($users_shubai2)):?>
					<input type="hidden" name="id" value="<?=$users_shubai2[0]['id']?>">
				<?php endif;?>
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>
