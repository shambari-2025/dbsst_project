<?php $counter = 0;?>
<?php $sum = 0;?>
<?php foreach($checks as $item):?>
	<tr class="center">
		<td><?=++$counter?>.</td>
		<td><?=$item['check_number']?></td>
		<td><?=formatDate($item['check_date'])?></td>
		<td class="bold">
			<?php $sum += $item['check_money']?>
			<?=$item['check_money']?>
		</td>
		<td><?=getShortName($item['author'])?></td>
		<td class="elements">
			<a class="delete" href="javascript:" data-id="<?=$item['id']?>">
				<i class="fa fa-trash"></i>
			</a>
		</td>
	</tr>
<?php endforeach;?>

<tr class="center">
	<td colspan="3" class="bold">Ҳамагӣ маблағ супорид</td>
	<td class="bold"><?=$sum?></td>
</tr>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('.delete').on('click', function(){
			if (confirm("Шумо ин сабтро нест кардан мехоҳед?")) {
				var id_student = <?=$id_student?>;
				var id_check = $(this).attr("data-id");
				
				var my_url = '<?=MY_URL;?>';
				var url = '<?=URL."modules/students/students_ajax.php?option=CheckDelete";?>';
				
				$.ajax({
					type: 'post',
					url: url, //Путь к обработчику
					data: {"id_student": id_student, "id_check": id_check, "my_url": my_url},
					success: function(data){
						$('.fordata').html(data);
					}
				});
				
			}else return false;
		});
		
	});
</script>