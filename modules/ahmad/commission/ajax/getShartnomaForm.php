<form action="<?=MY_URL?>?option=commission&action=create_check" method="post" enctype="multipart/form-data">
<table class="addform">
	
	<tr>
		<td colspan="2">
			<label for="type">Намуди пардохт:</label>
			<select name="type" id="type" class="form-control" required>
				<?php foreach($pardoxt_types as $v => $k):?>
					<option value="<?=$v?>"><?=$k?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>
	
	<tr>
		<td>
			<label for="check_number">Рақами расид:</label>
			<input autocomplete="off" type="text" name="check_number" id="check_number" class="form-control">
		</td>
		
		<td>
			<label for="check_date">Санаи амалиёт:</label>
			<input type="date" name="check_date" id="check_date" class="form-control">
		</td>
	</tr>
	
	<tr>
		
		<td>
			<label for="check_money">Маблағ:</label>
			<input autocomplete="off" type="text" name="check_money" id="check_money" class="form-control">
		</td>
		
		<td>
			<label for="shartnoma">Маблағи шартнома:</label>
			<input value="<?=$money?>" autocomplete="off" disabled type="text" name="shartnoma" id="shartnoma" class="form-control">
		</td>
		
	</tr>
	
	
	<tr>
		<td>
			<input type="hidden" name="id_student" value="<?=$id_student?>">
			<br>
			<button type="submit" class="btn btn-inverse waves-effect waves-light">
				<i class="fa fa-save"></i> Сабт кардан
			</button>
		</td>
	</tr>
</table>
	
</form>


<hr>
<h6>Расидҳои донишҷӯ: <?=getUserName($id_student)?></h6>

<div class="table-responsive davrifaol">
	<table class="table" style="font-size: 14px !important">
		<thead class="center">
			<tr style="background-color: #263544; color: #fff">
				<th class="counter">№</th>
				<th style="width:150px">Асос</th>
				<th style="width:50px">Санаи<br>таҳвил</th>
				<th style="width:50px">Маблағ</th>
				<th style="width:50px">Амалиётро<br>гузаронид</th>
				<th style="width:50px">Амалҳо</th>
			</tr>
		</thead>
		<tbody class="fordata">
			<?php $counter = 0;?>
			<?php $sum = 0;?>
			<?php foreach($checks as $item):?>
				<tr class="center">
					<td><?=++$counter?>.</td>
					<td><?=$pardoxt_types[$item['type']]?></td>
					<td><?=formatDate($item['check_date'])?></td>
					<td class="bold">
						<?php $sum += $item['check_money']?>
						<?=$item['check_money']?>
					</td>
					<td><?=getShortName($item['author'])?></td>
					<td class="elements">
						<!--
						<a class="delete" href="javascript:" data-id="<?=$item['id']?>">
							<i class="fa fa-trash"></i>
						</a>
						
						
						<a class="dropdown-item waves-light waves-effect" 
							target="_blank" href="<?=MY_URL?>?option=print&action=print_check1&id=<?=$item['id']?>">
							<i class="fa fa-print"></i> Расид барои шартнома
						</a>
						-->
					</td>
				</tr>
			<?php endforeach;?>

			<tr class="center">
				<td colspan="3" class="bold">Ҳамагӣ маблағ супорид</td>
				<td class="bold"><?=$sum?></td>
			</tr>
		</tbody>
	</table>
</div>


<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.modal').on('shown.bs.modal', function () {
			$('.check_money').trigger('focus')
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