<form action="<?=MY_URL?>?option=jd&action=update" method="post" enctype="multipart/form-data">
	<table class="addform" >
		<tr class="w33">
			<td colspan="1">
				<label for="fan">Фанро интихоб кунед:</label>
				<select name="fan" id="fan" class="form-control">
					<?php foreach($fanho as $fan_item): ?>
						<option <?php if($query[0]['id_fan'] == $fan_item['id']){ echo "selected";}?> value="<?=$fan_item['id'];?>"><?=$fan_item['title']; ?></option>
					<?php endforeach; ?>
				</select>
			</td>
			
			<td colspan="1">
				<label for="teacher">Омӯзгорро интихоб кунед:</label>
				<select name="teacher" id="teacher" class="form-control">
					<option value="">-Омӯзгорро интихоб кунед-</option>
					<?php foreach($teachers as $teacher): ?>
						<option <?php if($query[0]['id_teacher'] == $teacher['id']){ echo "selected";}?> value="<?=$teacher['id'];?>"><?=$teacher['fullname']; ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
	
		<tr>
			<td colspan="1">
				<br>
				<input type="hidden" name="id" value="<?=$id?>">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function () {
		
		var max = 12;
		var min = 1;
		
		$('#deleterow').attr("disabled", true);
		
		$('#addrow').on('click', function(){
			
			
			
			var total = $('.testcase').length;
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/nt/nt_ajax.php?option=getNewRow";?>';
			
			
			if(total < max){
				$.ajax({
					type: 'post',
					url: url, //Путь к обработчику
					data: {"data":true},
					success: function(data){
						$("#nextdatas").append(data);
					}
				});
				if(max == total+1){
					$('#addrow').attr("disabled", true);
				}
				$('#deleterow').attr("disabled", false);
			}
		});
		
		$('#deleterow').on('click', function(){
			var total = $('.testcase').length;
			console.log(total);
			console.log(min);
			if(total > min){
				console.log("do something");
				$('script:last-child').remove();
				$('table.testcase:last-child').remove();
				$('hr.h:last-child').remove();
				if(min == total - 1){
					$('#deleterow').attr("disabled", true);
				}
				$('#addrow').attr("disabled", false);
			}
			
		});
	});
</script>