<form action="<?=MY_URL?>?option=joikor&action=update_joikor" method="post" enctype="multipart/form-data">
	
	<table class="addform" style="width:100%">
		
		
		
		<tr>
			<td>
				<label for="joikor">Ҷои кор ва вазифа:</label><br>
				<textarea rows="2" name="joikor" id="joikor" class="form-control"><?=@$user[0]['joi_kor']?></textarea>
			</td>
		</tr>
		
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_student" value="<?=$id_student?>">	
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>
