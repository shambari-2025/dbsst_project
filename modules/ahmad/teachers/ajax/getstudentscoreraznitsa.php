		<?php //print_arr($fans);?>
<h6 class="center">Холҳо дар фосилаи аз 50 то 100 гузошта шаванд. Дар дигар ҳолатҳо маълумоти воридкардаи Шумо сабт карда намешавад!!!</h6>
<hr style="margin: 0 0 20px 0;">
<form action="<?=MY_URL?>?option=teachers&action=insert_score_raznitsa" method="post" enctype="multipart/form-data">
	<table style="border-collapse: collapse; width: 100%;" border="1">
		<tr>
			<td style="width: 5%;">№</td>
			<td style="width: 5%;">ID</td>
			<td>Фан</td>
			<td style="width: 5%;">Хол</td>
		</tr>
		<?php $i=1;?>
		<?php foreach($fans as $item):?>
			<tr>
				<td><?=$i;?>.</td>
				<td><?=$item['id']?><input type="hidden" name="farqiyat[<?=$i?>]" value="<?=$item['id']?>"></td>
				<td><?=getFanTest($item['id_fan'])?><?php if($item['type'] ==2) {echo "(Кори курсӣ)";}?></td>
				<!--<input type="hidden" name="type[<?=$i?>]" <?php if($item['type']==1):?>value="1"<?php else:?>value="2"<?php endif;?>>-->
				<td><input type="text" name="score[]" required></td>
			</tr>
			<?php $i++;?>
		<?php endforeach;?>
	</table>
	<table class="addform">		
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_student" value="<?=$id_student?>">
				<button type="submit" class="updatebtn btn btn-inverse waves-effect waves-light">
					<i class="fa fa-save"></i> Сабти маълумотҳо
				</button>
			</td>
		</tr>
	</table>
</form>
	


<script type="text/javascript">
	jQuery(document).ready(function($){
		
	});
</script>