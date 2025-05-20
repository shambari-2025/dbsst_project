<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-12">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?=MY_URL?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							Онлайн
						</li>
						<li class="breadcrumb-item">
							Истифодабарандаҳо
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						<div class="col-sm-12">
							
							<!-- Large modal -->
							<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg" style="max-width: 80%;">
									<div class="modal-content">
										<div class="modal-header">
											<h6 class="modal-title" id="myModalLabel"></h6>
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
										</div>
										<div class="modal-body" id="bigmodal">
											
										</div>
									</div>
								</div>
							</div>
							<!-- Large modal -->
							
							<div class="card">
								<div class="card-header">
									<h5>Онлайн 10 дақиқа</h5>
								</div>
								<div class="card-block">
									
									<table class="table" style="font-size: 14px !important; width: 100%">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th class="image">Расм</th>
												<th class="counter">ID</th>
												<th class="left">Ному насаб</th>
												<th style="width: 250px">Саҳифа</th>
												<th>Вақт</th>
												<th>Маълумотнома</th>
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
													
													<td class="left">
														<?php $info = getLastOnlinePage($item['id'])?>
														<?=$info['title']?><br>
														<?//=urldecode($info['url'])?>
													</td>
													
													
													<td><?=formatDate($item['last_login'])?></td>
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
													
												</tr>
											<?php endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	jQuery(document).ready(function($){
		
		
		$('.sessions_results').on('click', function(){
			
			var id_student = $(this).attr("data-id-student");
			var id_nt = $(this).attr("data-id-nt");
			var id_course = $(this).attr("data-id-course");
			var id_s_v = $(this).attr("data-id-s-v");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getimtinfo";?>';
			
			$('.modal-dialog').css("max-width", "90%");
			$('.modal-title').text("Натиҷаи имтиҳонҳо: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_nt": id_nt, "id_student": id_student, "id_course": id_course, "id_s_v": id_s_v, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		$('.student_info').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getstudentinfo";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Маълумотнома: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		$('.student_edit').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getstudenteditform";?>';
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Таҳриркунӣ: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		
		
		/*
		
		$('.groupsettings').on('click', function(){
			var id_faculty = <?=$id_faculty?>;
			var id_s_v = <?=$id_s_v?>;
			var id_course = <?=$id_course?>;
			var id_spec = <?=$id_spec?>;
			var id_group = <?=$id_group?>;
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=groupsettings";?>';
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Ҷурсозиҳои гурӯҳ");
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_v": id_s_v, "id_course": id_course, "id_spec": id_spec, "id_group": id_group},
				success: function(data){
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		*/
	});
</script>
