<form action="<?=MY_URL?>?option=soxtor&action=dep_member_insert" method="post" enctype="multipart/form-data">
	<table class="addform">
		<tr>
			<td>
				<label for="id_teacher">Омӯзгорро интихоб кунед:</label>
				<select name="id_teacher" id="id_teacher" required class="form-control">
					<option value="">-- Интихоб кунед! --</option>
					<?php foreach($all_teachers as $item):?>
						<option value="<?=$item['id']?>"><?=$item['fullname_tj']?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="id_credits_table">Вазифа, дараҷа ва унвони илмӣ:</label>
				<select name="id_credits_table" id="id_credits_table" required class="form-control">
					<option value="0">-- Интихоб кунед! --</option>
					<?php foreach($vazifaho as $item):?>
						<option value="<?=$item['id']?>"><?=$item['vazifa']?></option>
					<?php endforeach;?>
				</select>
				<span class="bold details" style="display: block; margin: 10px"></span>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="id_worker_type">Ҳамкор:</label>
				<select name="id_worker_type" id="id_worker_type" required class="form-control">
					<option value="">-- Интихоб кунед! --</option>
					<?php foreach($worker_type as $item => $value):?>
						<option value="<?=$item?>"><?=$value?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td >
				<input type="hidden" name="id_departament" value="<?=$id_departament?>">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function () {
		$('.addform').on("change", "#id_credits_table", function () {
			var id = $(this).val();
			
			if(id == 0) return false;
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/soxtor/soxtor_ajax.php?option=getVazifaDetails";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id},
				success: function(data){
					$('.details').html(data);
				}
			});
		});
	});
</script>