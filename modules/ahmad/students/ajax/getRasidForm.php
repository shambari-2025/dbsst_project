<table class="addform">
	<tr>
		<td style="width: 32%">
			<label for="check_type">Асос:</label>
			<select name="check_type" id="check_type" class="form-control" required>
				<option value="1">Пардохт барои қабули ҳуҷҷатҳои довталаб</option>
				<option value="2">Пардохт барои шартномаи таҳсил</option>
			</select>
			
			
		</td>
		
		<td style="width: 32%">
			<label for="check_date">Санаи супоридан:</label>
			<input value="<?=date("Y-m-d")?>" type="date" name="check_date" id="check_date" class="form-control">
		</td>
		
		<td style="width: 32%">
			<label for="check_money">Маблағ:</label>
			<input autocomplete="off" type="text" name="check_money" id="check_money" class="money form-control">
		</td>
	</tr>
	
	
	<tr>
		<td>
			<br>
			<button type="submit" class="insert btn btn-inverse waves-effect waves-light">
				<i class="fa fa-save"></i> Сабти тағйиротҳо
			</button>
		</td>
	</tr>
</table>

<hr>
<h6>Расидҳои донишҷӯ: <?=getUserName($id_student)?></h6>

<div class="table-responsive davrifaol">
	<table class="table" style="font-size: 14px !important">
		<thead class="center">
			<tr style="background-color: #263544; color: #fff">
				<th class="counter">№</th>
				<th style="width:50px">Рақами расид</th>
				<th style="width:50px">Санаи<br>супоридан</th>
				<th style="width:50px">Маблағ</th>
				<th style="width:50px">Амалиётро<br>гузаронид</th>
				<th style="width:50px">Амалҳо</th>
			</tr>
		</thead>
		<tbody class="fordata">
			<?php include("_check_list.php")?>
		</tbody>
	</table>
</div>



<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.modal').on('shown.bs.modal', function () {
			$('.money').trigger('focus')
		})
		
		
		$('.fordata.delete').on('click', function(){
			if (confirm("Шумо ин сабтро нест кардан мехоҳед?")) {
				var id_student = <?=$id_student?>;
				var id_check = $(this).attr("data-id");
				
				var my_url = '<?=MY_URL;?>';
				var url = '<?=URL."modules/students/students_ajax.php?option=CheckDelete";?>';
				
				$.ajax({
					type: 'post',
					url: url, //Путь к обработчику
					data: {"id_student": id_student, "id_check": id_check, "my_url": my_url},
					success: function(data){
						$('.fordata').html(data);
					}
				});
				
			}else return false;
		});
		
		
		$('.insert').on('click', function(){
			var id_student = <?=$id_student?>;
			var check_number = $('.addform #check_number').val();
			var check_date = $('.addform #check_date').val();
			var check_money = $('.addform #check_money').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=CheckInsert";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "check_number": check_number, "check_date": check_date, "check_money": check_money, "my_url": my_url},
				success: function(data){
					$('.fordata').html(data);
				}
			});
			$('.addform #check_number').val("");
			$('.addform #check_date').val("");
			$('.addform #check_money').val("");
		});
		
		
	});
</script>