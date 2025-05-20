<h3 style="color: red; text-align:center">Муҳтарам <?=getUserName($_SESSION['user']['id'])?>! Шумо барои дуруст нишон додани маълумотҳо масъул мебошед. Лутфан бодиққат бошед. Дурустии маълумот ба уҳдаи Шумо аст!</h3>
<form action="<?=MY_URL?>?option=students&action=insert_diplominfo" method="post" enctype="multipart/form-data">
	<table class="addform">
		
		<tr>
			<td style="width:50%">
				<label for="soli_xatm">Соли хатм:</label>
				<input autocomplete="off" type="text" name="soli_xatm" id="soli_xatm" placeholder="2024" class="form-control" required>
			</td>
			
			<td>
				<label for="diplom_number">Рақами диплом:</label>
				<input type="text" name="diplom_number" id="diplom_number" placeholder="ДБМ №0000000" class="form-control" required>
			</td>			
		</tr>
		<tr>
			<td style="width:50%">
				<label for="diplom_reg_number">Рақами бақайдгирии диплом:</label>
				<input autocomplete="off" type="text" name="diplom_reg_number" id="diplom_reg_number" placeholder="000000" class="form-control" required>
			</td>
			
			<td>
				<label for="date_gek">Санаи қарори КДА:</label>
				<input type="date" name="date_gek" id="date_gek" class="form-control" required>
			</td>			
		</tr>
		<tr>
			<td colspan="2">
				<label for="kasb">Касб(дараҷаи тахассус):</label>
				<input type="text" name="kasb" id="kasb" class="form-control" required>
			</td>
		</tr>
		
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_student" value="<?=$id_student?>">
				<input type="hidden" name="id_s_l" value="<?=$id_s_l?>">
				<button type="submit" class="updatebtn btn btn-inverse waves-effect waves-light">
					Сабткунӣ
				</button>
			</td>
		</tr>
		
	</table>
</form>


<script type="text/javascript">
jQuery(document).ready(function($){
	
	
});
</script>