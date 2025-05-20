<h3>Тугмаи "Иловакунӣ"-ро барои илова кардани кормандон пахш намоед</h3>
<form action="<?=MY_URL?>?option=soxtor&action=insert_kormand" method="post" enctype="multipart/form-data">
	<div id="nextdatas">
		<?php include("addRowKormand.php");?>
	</div>
	<table style="width:100%">
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_sokhtor" value="<?=$id_sokhtor;?>">
				<button type="submit" class="btn btn-success">Сабт кардан</button>
			</td>
			
			<td style="text-align:right">
				<br>
				<button id="addrow" type="button" class="btn btn-primary"><i class="fa fa-plus-square"></i> Иловакунӣ</button>
				<button id="deleterow" disabled type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Несткуни</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		var max = 10;
		var min = 1;
		
		$('#deleterow').attr("disabled", true);
		
		$('#addrow').on('click', function(){
			
			var id_sokhtor = <?=$id_sokhtor;?>;			
			
			var total = $('.testcase').length;
			
			
			var url = '<?=URL."modules/soxtor/soxtor_ajax.php?option=getRowKormand";?>';
			
			
			if(total < max){
				$.ajax({
					type: 'post',
					url: url, //Путь к обработчику
					data: {"data":true, "id_sokhtor": id_sokhtor},
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