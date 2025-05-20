<br><br>
<table class="table" style="font-size: 14px !important">
	<thead class="center">
		<tr style="background-color: #263544; color: #fff">
			<th class="counter">№</th>
			<th class="image">Расм</th>
			<th class="counter">ID</th>
			<th class="left">Ному насаб</th>
			
			<th>Шакли таҳсил</th>
			<th>Амалҳо</th>
		</tr>
	</thead>
	<tbody class="center" id="tbody">
		<?php $counter = 0;?>
		
		<?php foreach($students as $item):?>
			
			<tr>
				<th scope="row"><?=++$counter?>.</th>
				<td>
					<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo']);?>
					<img class="img-circle profile_img imguser" src="<?=$photo;?>">
				</td>
				
				<th scope="row"><?=$item['id']?></th>
				
				<td class="left">
					<?=$item['fullname']?>
				</td>
				
				<td>
					<?=getStudyType($item['id_s_t'])?>
				</td>
				
				<td class="elements elem_<?=$item['id']?>">
					<?php if(inVIP($item['id'], $s_y, $h_y)):?>
						<button class="btn btn-danger waves-effect waves-light delete_from_vip_list" data-id-student="<?=$item['id']?>"><i class="fa fa-trash"></i> Несткунӣ</button>
					<?php else:?>
						<input type="text" class="form-control text_<?=$item['id']?>"><br>
						<button class="btn btn-inverse waves-effect waves-light add_to_vip_list" data-id-student="<?=$item['id']?>"><i class="fa fa-plus"></i> Иловакунӣ</button>
					<?php endif;?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>


<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$(".add_to_vip_list").on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var text = $(".text_" + id_student).val();
			
			var s_y = <?=$s_y?>;
			var h_y = <?=$h_y?>;
			
			$(this).remove();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/vip/vip_ajax.php?option=addVIP";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"my_url": my_url, "id_student":id_student, "text": text, "s_y": s_y, "h_y": h_y},
				success: function(data){
					if(data == 'ok'){
						$(".elem_" + id_student).html("<span class='bold text-c-green'>ADDED</span>");
					}
				}
			});
			
			
		});
		
		$(".delete_from_vip_list").on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var s_y = <?=$s_y?>;
			var h_y = <?=$h_y?>;
			
			$(this).remove();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/vip/vip_ajax.php?option=deleteVIP";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"my_url": my_url, "id_student":id_student, "s_y": s_y, "h_y": h_y},
				success: function(data){
					if(data == 'ok'){
						$(".elem_" + id_student).html("<span class='bold text-c-red'>DELETED</span>");
					}
				}
			});
			
			
		});
		
	});
</script>