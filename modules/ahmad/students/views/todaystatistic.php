<div class="col-xl-4 col-md-6">
	<div class="card prod-p-card card-green">
		<div class="card-body">
			<div class="row align-items-center">
				<div class="col">
					<h6 class="m-b-5 text-white">Истифодабарандаҳо</h6>
					<h3 class="m-b-0 f-w-700 text-white"><?=$count_users[0]['users']?></h3>
				</div>
				<div class="col-auto">
					<i class="fas fa-users text-c-blue f-18"></i>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-xl-4 col-md-6">
	<div class="card prod-p-card card-green">
		<div class="card-body">
			<div class="row align-items-center">
				<div class="col">
					<h6 class="m-b-5 text-white">Омӯзгорҳо</h6>
					<h3 class="m-b-0 f-w-700 text-white"><?=($count_teachers[0]['teachers'])?></h3>
				</div>
				<div class="col-auto">
					<i class="fas fa-users text-c-blue f-18"></i>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-xl-4 col-md-6">
	<div class="card prod-p-card card-green">
		<div class="card-body">
			<div class="row align-items-center">
				<div class="col">
					<h6 class="m-b-5 text-white">Донишҷӯҳо</h6>
					<h3 class="m-b-0 f-w-700 text-white"><?=($count_students[0]['students'])?></h3>
				</div>
				<div class="col-auto">
					<i class="fas fa-users text-c-blue f-18"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<table class="table" style="font-size: 14px !important; width: 100%">
	<thead class="center">
		<tr style="background-color: #263544; color: #fff">
			<th class="counter">№</th>
			<th class="image">Расм</th>
			<th class="counter">ID</th>
			<th class="left">Ному насаб</th>
			<th>Вақт</th>
			<th>Маълумотнома</th>
			<th>Миқдори<br>назаркунӣ</th>
			<th>Амал</th>
		</tr>
	</thead>
	<tbody class="center">
		<?php $counter = 0;?>
		<?php foreach($users as $item):?>
			
			<tr>
				<th scope="row"><?=++$counter?>.</th>
				<td>
					<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo'], $item['access_type']);?>
					<img class="img-circle profile_img imguser" src="<?=$photo;?>">
				</td>
				<th scope="row"><?=$item['id']?></th>
				<td class="left">
					<?=$item['fullname_tj']?>
				</td>
				
				
				<td><?=substr($item['last_login'], 11)?></td>
				<td>
					<?php if($item['access_type'] == 1):?>
						Администратор
					<?php elseif($item['access_type'] == 2):?>
						Омӯзгор
					<?php else:?>
						<?php $std_info = query("SELECT * FROM `students` WHERE `id_student` = '".$item['id']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");?>
						<?=getFacultyShort($std_info[0]['id_faculty'])?><br>
						<span class="bold <?php if($std_info[0]['id_s_v'] == 1):?>text-c-red<?php else: ?> text-c-green<?php endif;?>"><?=getStudyView($std_info[0]['id_s_v'])?></span><br>
						<?=getCourse($std_info[0]['id_course'])?><br>
						<?=getSpecialtyCode($std_info[0]['id_spec'])?> <?=getGroup2($std_info[0]['id_group'])?><br>
					<?php endif;?>
				</td>
				
				<td><?=getSeenPages($item['id'], $date)?></td>
				
				<td class="elements">
					<a title="Дидани амалҳо" class="view_actions" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id-user="<?=$item['id']?>" data-username="<?=$item['fullname_tj']?>" data-date="<?=$date?>">
						<i class="fa fa-eye"></i>
					</a>
				</td>
				
			</tr>
		<?php endforeach;?>
	</tbody>
</table>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('.view_actions').on('click', function(){
			var id_user = $(this).attr("data-id-user");
			var username = $(this).attr("data-username");
			var date = $(this).attr("data-date");
			
			console.log(id_user);
			console.log(username);
			console.log(date);
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Амалиётҳои истифодабаранда: " + username + " дар санаи " + date);
			$('#bigmodal').html('<div class="load"></div>');
			
			var url = '<?=URL."modules/students/students_ajax.php?option=showuseractions";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_user": id_user, "date": date},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
		});
		
		
		
	});
</script>