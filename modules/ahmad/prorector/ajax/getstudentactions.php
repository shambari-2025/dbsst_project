<div class="col-md-12 col-sm-12">
	
	<table id="par" style="font-size:16px; width: 75%; margin: 0 auto;">
		<tr>
			<td style="width:25%; padding: 10px">
				<label for="s_y" class="f-16">Соли таҳсил:</label>
				<select name="s_y" id="s_y" class="form-control" style="font-size:16px">
					<?php for($i = 2022; $i <= date('Y'); $i++):?>
						<option value="<?=$i;?>"><?=$i?></option>
					<?php endfor;?>
				</select>
			</td>
			<td style="width:25%; padding: 10px">
				<label for="month" class="f-16">Моҳ:</label>
				<select name="month" id="month" class="form-control" style="font-size:16px">
					<?php $i = 1;?>
					<?php foreach($months as $item):?>
						<option <?php if(date('m') == $i):?>selected<?php endif;?> value="<?=$i?>"><?=$item?></option>
						<?php $i++;?>
					<?php endforeach;?>
				</select>
			</td>
			<td style="vertical-align: bottom; width:25%; padding: 10px">
				<button class="btn btn-inverse waves-effect waves-light" id="loaddata" style="padding: 7px 14px;">
					<i class="fa fa-search"></i> Ҷустуҷу
				</button>
			</td>
		</tr>
	</table>
	
	<br>
	
	<div id="ajaxresult">
		<?php include("actions_info.php");?>
	</div>
	
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#loaddata').on('click', function(){
			var s_y = $('#s_y').val();
			var month = $('#month').val();
			
			var id_student = <?=$id_student?>;
			
			console.log(s_y);
			console.log(month);
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getstudentactions2";?>';
			
			$('#ajaxresult').html("");
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url, "s_y": s_y, "month": month},
				beforeSend: function(){
					$('#ajaxresult').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#ajaxresult img').hide();
					$('#ajaxresult').append(data);
				}
			});
			
		});
		
		
	});
</script>