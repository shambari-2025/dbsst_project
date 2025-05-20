<table id="par" style="font-size:16px; width: 75%; margin: 0 auto;">
	<tr>
		<td style="width:20%; padding: 10px">
			<label for="s_y" class="f-16">Соли таҳсил:</label>
			<select name="s_y" id="s_y" class="form-control" style="font-size:16px">
				<?php foreach($STUDY_YEARS as $item): ?>
					<option <?php if($item['id'] == S_Y){ echo "selected";}?> value="<?=$item['id'];?>"><?=$item['title']?></option>
				<?php endforeach;?>
			</select>
		</td>
		
		<td style="width:20%; padding: 10px">
			<label for="id_course" class="f-16">Курс:</label>
			<select name="id_course" id="id_course" class="form-control" style="font-size:16px">
				<?php foreach($courses as $item):?>
					<option <?php if($item['id'] == $id_course){ echo "selected";}?> value="<?=$item['id'];?>"><?=$item['title']?></option>
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
				<i class="fa fa-search"></i> Ҷустуҷу
			</button>
		</td>
	</tr>
</table>
<br>

<div class="table-responsive" id="ajaxresult"></div>


<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#loaddata').on('click', function(){
			var id_faculty = <?=$id_faculty?>;
			var id_s_v = <?=$id_s_v?>;
			var id_course = $('#id_course').val();
			var id_spec = <?=$id_spec?>;
			var id_group = <?=$id_group?>;
			
			var s_y = $('#s_y').val();
			var h_y = $('#h_y').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getArchiveList";?>';
			
			$('#ajaxresult').html("");
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_v": id_s_v, "id_course": id_course, "id_spec": id_spec, "id_group": id_group, "s_y": s_y, "h_y": h_y, "my_url": my_url},
				beforeSend: function(){
					$('#ajaxresult').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#ajaxresult img').hide();
					$('#ajaxresult').html(data);
				}
			});
			
		});
		
		
	});
</script>
