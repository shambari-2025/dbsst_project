<form action="<?=MY_URL?>?option=nt&action=update_selanamoi" method="post" enctype="multipart/form-data">
	<div class="table-responsive davrifaol">
	<p class="center bold">Якҷоякунии лексияи фанни «<?=getFanTest($id_fan)?>» - и <br>ихтисоси «<?=getSpecialtyCode($id_spec)?> <?=getGroup($id_group)?>»</p>
	<?php //print_arr($datas);?>
	<table class="table" style="font-size:14px">
		<thead>
			<tr class="center">
			<th style="width: 50px">#</th>
			<th style="width: 50px"></th>
			<th>Ихтисос</th>
			<th>М.Д.</th>
			</tr>
		</thead>
		<tbody>
			<?php $counter = 0;?>
			<?php foreach($datas as $item):?>
				<tr class="center">
					<?php $students = count_table_where("students", "
						`status` = '1' AND 
						`id_faculty` = '{$item['id_faculty']}' AND 
						`id_s_l` = '{$item['id_s_l']}' AND 
						`id_s_v` = '{$item['id_s_v']}' AND 
						`id_course` = '{$item['id_course']}' AND 
						`id_spec` = '{$item['id_spec']}' AND 
						`id_group` = '{$item['id_group']}' AND 
						`s_y` = '".S_Y."'");?>
					<td><?=++$counter?>.</td>
					<td>
						<input <?php if($id == $item['parent_group']):?> checked <?php endif;?> type="checkbox" name="checkbox[]" id="checkbox_<?=$item['id']?>" value="<?=$item['id']?>" data-students="<?=$students?>">
					</td>
					<td class="left">
						<label data-students="<?=$students?>" class="plus_group" for="checkbox_<?=$item['id']?>"><?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?></label>
					</td>
					<td>
						<?=$students?>
					</td>
				</tr>
			<?php endforeach;?>
			<tr>
				<td colspan="3" class="center">
					Миқдори умумии донишҷуён: <span class="students"><?=$in_group?></span>
				</td>
				
				<td colspan="1" style="text-align: right">
					<input type="hidden" name="id" value="<?=$id?>">
					<button type="submit" class="btn btn-success">Сабт кардан</button>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
</form>

<script type="text/javascript">
	
	jQuery(document).ready(function($){
		
		$('.plus_group').on('click', function(){
			
			
			var students = $(this).attr('data-students');
			var all_student = $('.students').text();
			sum = parseInt(all_student) + parseInt(students);
			
			$('.students').text(sum);
		});
	});
	
</script>