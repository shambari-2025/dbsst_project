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
							Истиқоматкунандагон
						</li>
						<li class="breadcrumb-item">
							Руйхат
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
									<h5>Истиқоматкунандагон</h5>
								</div>
								<div class="card-block">
									<style>
										.letters {
											font-size: 18px;
											float: left;
											border: 1px solid;
											margin: 6px;
											text-align: center;
											padding: 4px 12px;
										}
										
										
									</style>
									<div style="text-align: center">
										<a href="<?=MY_URL?>?option=bugalteria&action=list_omuzgor">
											<div class="letters">Ҳама</div>
										</a>
										<?php foreach($alphabet as $item):?>
											<a href="<?=MY_URL?>?option=bugalteria&action=list_omuzgor&letter=<?=$item?>">
											<div class="letters">
												<?=$item?>
											</div>
											</a>
										<?php endforeach;?>
										<div style="clear: both"></div>
									</div>
									
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">
													<div class="checkbox-zoom zoom-success" style="margin: 0px">
														<label class="semestr" for="all" style="display: inline; margin:0px">
															<input type="checkbox" name="all" id="all" class="checkall form-control">
															<span class="cr" style="margin: 0px">
																<i class="cr-icon icofont icofont-ui-check txt-success"></i>
															</span>
														</label>
													</div>
												</th>
												<th class="counter">№</th>
												<th class="image">Расм</th>
												<th class="counter">ID</th>
												<th class="left">Ному насаб</th>
												<th>Дар кадом хобгоҳ</th>
												<th>Рақами хона</th>
												<th>Маблағи хона супорид</th>
												<th>Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = 0;?>
											
											<?php foreach($teachers as $item):?>
												
												<tr>
													<td>
														<div class="checkbox-zoom zoom-success" style="margin: 0px">
															<label class="semestr" for="student_<?=$item['id']?>" style="display: inline; margin:0px">
																<input class="checkbox" type="checkbox" name="student_<?=$item['id']?>" id="student_<?=$item['id']?>">
																<span class="cr" style="margin: 0px">
																	<i class="cr-icon icofont icofont-ui-check txt-success"></i>
																</span>
															</label>
														</div>
													</td>
													<th scope="row"><?=++$counter?>.</th>
													
													<td>
														<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo'], true);?>
														<img class="img-circle profile_img imguser" src="<?=$photo;?>">
													</td>
													
													<th scope="row"><?=$item['id']?></th>
													
													<td class="left">
														<?=$item['fullname_tj']?>
													</td>
													
													<td>
														<?=$khobgoh_dtt[$item['id_khobgoh']]?>
													</td>
													<td>
														<?=$item['number_home']?>
													</td>
													<td>
														
													</td>
													<td>
														<div class="dropdown-inverse dropdown open">
															
															<?php if($item['access_type'] != 1 || $item['id'] == $_SESSION['user']['id']):?>
																<button class="btn btn-inverse dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
																	<i class="fa fa-cogs"></i> Амалҳо
																</button>
																<div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
																	<!--
																	<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-user="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																		class="dropdown-item waves-light waves-effect student_shartnoma" href="javascript:">
																		<i class="fa fa-edit"></i> Сохтани расид
																	</a>
																	-->
																</div>
															<?php endif;?>
														</div>
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
		
		$('.ticher_khobgoh').on('click', function(){
			var id_user = $(this).attr("data-id-users");
			
			var name = $(this).attr("data-name");
			var foreign = $(this).attr("data-foreign");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getShartnomaForm";?>';
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Бақайдгири дар хобгоҳ: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {
					"id_user": id_users,
					
					"foreign": foreign,
					"my_url": my_url
				},
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
		
		
		/* ШАРТОНОМА */
		$('.student_shartnoma').on('click', function(){
			var id_student = $(this).attr("data-id-user");
			var name = $(this).attr("data-name");
			var foreign = $(this).attr("data-foreign");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getShartnomaForm";?>';
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Сохтани расид: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {
					"id_student": id_student,
					"my_url": my_url
				},
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
		/* ШАРТОНМА */
		
		
		
		$('.teacher_info').on('click', function(){
			var id_teacher = $(this).attr("data-id-teacher");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getteacherinfo";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Маълумотнома: " + name);
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_teacher": id_teacher, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		$('.teacher_lessons').on('click', function(){
			var id_teacher = $(this).attr("data-id-teacher");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getteacherlessons";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Дарсҳои омӯзгор: " + name);
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_teacher": id_teacher, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		$('.teacher_edit').on('click', function(){
			var id_teacher = $(this).attr("data-id-teacher");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getteachereditform";?>';
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Иловакунии омӯзгор ба хобгоҳ: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_teacher": id_teacher, "my_url": my_url},
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
		
		
		
		$('.delete_student').on('click', function(){
			var id_teacher = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentdeleteform";?>';
			
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Хориҷкунӣ: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_teacher": id_teacher, "my_url": my_url},
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
		
		
	});
</script>
