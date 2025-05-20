<form action="<?=MY_URL?>?option=biometric&action=updatebiometric" method="post" enctype="multipart/form-data">
	
	<table class="addform" style="width:100%">
		
		<tr>
			<td>
				<label for="id_photo">Расмро интихоб кунед:</label><br>
				<input type="file" name="photo" id="id_photo">
			
				<?php $photo = getUserImg($user[0]['id'], $user[0]['jins'], $user[0]['photo']);?>
				<img style="width: 3cm; height: 4cm; float: right" src="<?=$photo;?>">
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="id_scan1_finger1">Сканер 1 / Изи ангушт 1:</label><br>
				<textarea rows="5" name="scan1_finger1" id="id_scan1_finger1" class="form-control"><?=@$users_biometric[0]['scan1_finger1']?></textarea>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="id_scan1_finger2">Сканер 1 / Изи ангушт 2:</label><br>
				<textarea rows="5" name="scan1_finger2" id="id_scan1_finger2" class="form-control"><?=@$users_biometric[0]['scan1_finger2']?></textarea>
			</td>
		</tr>
		
		
		
		<tr>
			<td>
				<label for="id_scan2_finger1">Сканер 2 / Изи ангушт 1:</label><br>
				<textarea rows="5" name="scan2_finger1" id="id_scan1_finger1" class="form-control"><?=@$users_biometric[0]['scan2_finger1']?></textarea>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="id_scan2_finger2">Сканер 2 / Изи ангушт 2:</label><br>
				<textarea rows="5" name="scan2_finger2" id="id_scan2_finger2" class="form-control"><?=@$users_biometric[0]['scan2_finger2']?></textarea>
			</td>
		</tr>
		
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_student" value="<?=$id_student?>">
				<?php if(!empty($users_biometric)):?>
					<input type="hidden" name="id" value="<?=$users_biometric[0]['id']?>">
				<?php endif;?>
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>
