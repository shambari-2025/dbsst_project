<form action="<?=MY_URL?>?option=nt&action=<?=$url_upload?>" method="post" enctype="multipart/form-data">
	<table class="addform" >
		<tr>
			<td>
				<label for="file">Файлро нақшаро интихоб кунед(.xlxs):</label><br>
				<input type="file" name="nt_file" id="nt_file" class="form-control">
			</td>
		</tr>
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_nt" value="<?=$id_nt?>">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>