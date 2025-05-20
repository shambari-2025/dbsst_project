<form action="<?=MY_URL?>?option=commission&action=insert_davr" method="post" enctype="multipart/form-data">
	<table class="addform">
		<tr>
			<td colspan="2">
				<label for="title">Номи пурраи даврро нависед:</label>
				<input required type="text" name="title" id="title" class="form-control">
			</td>
		</tr>
		
		<tr>
			<td style="width: 50%">
				<label for="short">Номи кутоҳ (барои меню):</label>
				<input required type="text" name="short" id="short" class="form-control">
			</td>
			
			<td>
				<label for="file">Файл аз ММТ (.xlsx):</label>
				<input type="file" name="file" id="file" class="form-control">
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="start_date">Оғози давр:</label>
				<input required type="date" name="start_date" id="start_date" class="form-control">
			</td>
			
			<td>
				<label for="finish_date">Анҷоми давр:</label>
				<input required type="date" name="finish_date" id="finish_date" class="form-control">
			</td>
		</tr>
		
		
		<tr>
			<td>
				<button type="submit" class="btn btn-inverse waves-effect waves-light">
					<i class="fa fa-save"></i> Сабт кардан
				</button>
			</td>
		</tr>
	</table>
	
</form>



<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.modal').on('shown.bs.modal', function () {
			$('.check_money').trigger('focus')
		})
		
		
	});
</script>