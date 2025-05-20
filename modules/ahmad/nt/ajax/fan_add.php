<form action="<?=MY_URL?>?option=nt&action=fan_insert" method="post" enctype="multipart/form-data">
	<table class="addform" >
		<tr>
			<td>
				<label for="title_tj">Номи фан ба тоҷикӣ:</label>
				<input autocomplete="off" type="text" name="title_tj" id="title_tj" class="form-control">
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="title_ru">Номи фан ба руссӣ:</label>
				<input autocomplete="off" type="text" name="title_ru" id="title_ru" class="form-control">
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="title_en">Номи фан ба англисӣ:</label>
				<input autocomplete="off" type="text" name="title_en" id="title_en" class="form-control">
			</td>
		</tr>
		
		
		<tr>
			<td colspan="1">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function () {
		
	});
</script>