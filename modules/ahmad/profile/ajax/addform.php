<form action="<?=MY_URL?>?option=nt&action=addData" method="post" enctype="multipart/form-data">
	<table class="addform" >
		<tr>
			<td>
				<label for="course">Курсро интихоб кунед:</label>
					<select name="course" id="course" class="form-control">
						<?php foreach($courses as $course_item): ?>
							<option value="<?=$course_item['id'];?>"><?=$course_item['title']; ?></option>
						<?php endforeach; ?>
					</select>
				
			</td>
			
			<td colspan = "1">
				<label for="h_y">Нимсолаи таҳсилро интихоб кунед:</label>
				<select name="h_y" id="h_y" class="form-control">
					<?php if(H_Y == 1): ?>
						<option value="1">Нимсолаи 1-ум</option>
						<option value="2">Нимсолаи 2-юм</option>
					<?php else:?>
						<option value="2">Нимсолаи 2-юм</option>
						<option value="1">Нимсолаи 1-ум</option>
					<?php endif;?>
				</select>
			</td>
		</tr>
	</table>
	
	<div id="nextdatas">
		<?php include("credit_part.php");?>
	</div>
	
	
	<table style="width:100%">
		<tr>
			<td colspan="2">
				<br>
				<input type="hidden" name="id_nt" value="<?=$id_nt?>">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
			
			<td style="text-align:right">
				<br>
				<button id="addrow" type="button" class="btn btn-primary"><i class="fa fa-plus-square"></i> Cатр</button>
				<button id="deleterow" disabled type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Несткуни</button>
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