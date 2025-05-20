<div class="col-md-12 col-sm-12">
	<table id="par" style="font-size:16px; width: 75%; margin: 0 auto;">
		<tr>
			<td style="width:25%; padding: 10px">
				<label for="s_y" class="f-16">Соли таҳсил:</label>
				<select name="s_y" id="s_y" class="form-control" style="font-size:16px">
					<?php foreach($STUDY_YEARS as $item): ?>
						<option <?php if($item['id'] == S_Y){ echo "selected";}?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
			<td style="width:25%; padding: 10px">
				<label for="h_y" class="f-16">Нимсолаи таҳсил:</label>
				<select name="h_y" id="h_y" class="form-control" style="font-size:16px">
					<option <?php if(H_Y == 1){echo "selected";}?> value="1">Нимсолаи 1-ум</option>
					<option <?php if(H_Y == 2){echo "selected";}?> value="2">Нимсолаи 2-юм</option>
				</select>
			</td>
			<td style="vertical-align: bottom; width:25%; padding: 10px">
				<input type="hidden" id="id_student" value="<?=$id_student?>">
				<button type="submit" class="btn btn-inverse waves-effect waves-light" id="loaddata" style="padding: 7px 14px;">
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
			var s_y = $('#s_y').val();
			var h_y = $('#h_y').val();
			
			var id_nt = <?=$id_nt?>;
			var id_student = <?=$id_student?>;
			var id_s_v = <?=$id_s_v?>;
			
			var my_url = '<?=MY_URL;?>';
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
			
		});
		
	});
</script>