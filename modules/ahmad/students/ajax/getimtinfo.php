<style>
	#editbox {
		width: 50px;
		margin: auto;
		text-align: center;
		padding: 2px;
	}
</style>

<div class="col-md-12 col-sm-12">
	
	<table id="par" style="font-size:16px; width: 75%; margin: 0 auto;">
		<tr>
			<td style="width:25%; padding: 4px">
				<label for="semestr" class="f-16">Семестр:</label>
				<select name="semestr" id="semestr" class="form-control" style="font-size:16px">
					<?php for($i = 1; $i <= $semestr; $i++): ?>
						<option <?php if($i == $semestr){ echo "selected";}?> value="<?=$i?>">Семестри <?=$i?></option>
					<?php endfor;?>
				</select>
			</td>
			
			<td style="vertical-align: bottom; width:25%; padding: 4px">
				<input type="hidden" id="id_student" value="<?=$id_student?>">
				<button type="button" class="btn btn-inverse waves-effect waves-light" id="loaddata" style="padding: 7px 14px;">
					<i class="fa fa-search"></i> Ҷустуҷуи маълумотҳо
				</button>
			</td>
		</tr>
	</table>
	<br>
	
	<?php //print_arr($fanlist);?>
	<div class="table-responsive davrifaol" id="ajaxresult">
		<?php include("imtresfile.php");?>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#loaddata').on('click', function(){
			var semestr = $('#semestr').val();
			
			var id_nt = <?=$id_nt?>;
			var id_student = <?=$id_student?>;
			var id_s_v = <?=$id_s_v?>;
			var c_semestr = <?=$semestr?>;
			var s_y = <?=S_Y?>;
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getimtinfo_SY_HY";?>';
			
			$('#ajaxresult').html("");
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_nt": id_nt, "id_student": id_student, "id_s_v": id_s_v, 
				"my_url": my_url, "semestr": semestr, "c_semestr": c_semestr, "s_y": s_y},
				beforeSend: function(){
					$('#ajaxresult').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#ajaxresult img').hide();
					$('#ajaxresult').append(data);
				}
			});
		});
		
		
		<?php if(in_array($_SESSION['user']['id'], [1, 2, 3, 10])):?>
			
			$('.delete_res').on('click', function(){
				var id = $(this).attr('data-id');
				var url = '<?=URL."modules/scores/scores_ajax.php?option=delete_result";?>';
				
				$.ajax({
					type: 'post',
					url: url, //Путь к обработчику
					data: {"id": id},
					
					success: function(data){
						
					}
				});
			});
		<?php endif;?>
		
		
		<?php if(in_array($_SESSION['user']['id'], [1, 2, 3, 10])):?>	
			$('#ajaxresult').on('click', 'td.edit', function(){
				//находим input внутри элемента с классом ajax и вставляем вместо input его значение
				var value = $('.ajax input').val();
				$('.ajax').html(value);
				//удаляем все классы ajax
				$('.ajax').removeClass('ajax');
				//Нажатой ячейке присваиваем класс ajax
				$(this).addClass('ajax');
				//внутри ячейки создаём input и вставляем текст из ячейки в него
				
				var val = $(this).text().trim();
				$(this).html('<input autocomplete="off" id="editbox" class="form-control" value="' + val + '" type="text">');
				//устанавливаем фокус на созданном элементе
				$('#editbox').focus().select();
				
				/*
				$('.form-control').on('propertychange input',function(){
					val = this.value;
					console.log(val);
					this.value = val;
					if(val > 25){
						this.value = 20;
					}
					if(val < 0){
						this.value = 0;
					}
				});
				*/
			});
			
			
			
			$('#ajaxresult').on('keydown', 'td.edit', function(event){
				var id_student = <?=$id_student?>;
				var id_fan = $(this).attr('data-id-fan');
				var value = $('.ajax input').val();
				var field = $(this).attr('field');
				var id = $(this).attr('data-id');
				var table = $(this).attr('data-table');
				
				var c_semestr = $('#semestr').val();
				
				if(event.which == 13){
					
					var my_url = '<?=MY_URL;?>';
					var url = '<?=URL."modules/scores/scores_ajax.php?option=update_results";?>';
				
					$.ajax({
						type: 'post',
						url: url,
						data: {
							"table": table,
							"id_student": id_student,
							"id_fan": id_fan,
							"value":value,
							"field": field,
							"id":id,
							"c_semestr":c_semestr
						},
						
						success: function(res){
							$('.ajax').html(value);
							
							/*
							var id_nt = <?=$id_nt?>;
							var id_s_v = <?=$id_s_v?>;
							var url = '<?=URL."modules/students/students_ajax.php?option=getimtinfo_SY_HY";?>';
							
							$('#ajaxresult').html("");
			
							$.ajax({
								type: 'post',
								url: url, //Путь к обработчику
								data: {"id_nt": id_nt, "id_student": id_student, "id_s_v": id_s_v, "my_url": my_url, "s_y": s_y, "h_y": h_y},
								beforeSend: function(){
									$('#ajaxresult').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
								},
								success: function(data){
									$('#ajaxresult img').hide();
									$('#ajaxresult').append(data);
								}
							});
							*/
						}
					});
				}
				
			});
		<?php endif;?>
	});
</script>