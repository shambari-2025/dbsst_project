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
							Омӯзгорҳо
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
									<h5>Омӯзгорҳо</h5>
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
										<a href="<?=MY_URL?>?option=teachers&action=list">
											<div class="letters">Ҳама</div>
										</a>
										<?php foreach($alphabet as $item):?>
											<a href="<?=MY_URL?>?option=teachers&action=list&letter=<?=$item?>">
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
												<th>Бори охир</th>
												<th>Иҷозати рейтингмонӣ</th>
												<th>Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = ($page*$perpage)-$perpage;?>
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
														<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo'], 1);?>
														<img class="img-circle profile_img imguser" src="<?=$photo;?>">
													</td>
													
													<th scope="row"><?=$item['id']?></th>
													
													<td class="left">
														<?=$item['fullname_tj']?>
													</td>
													
													<td>
														<?php if($item['last_login']):?>
															<?=formatDate($item['last_login'])?><br>
															<?=getLastOnline($item['last_login'])?>
														<?php else:?>
															<i class="fa fa-warning"></i> Маълумот нест</span>
														<?php endif;?>
													</td>
													
													<td class="elements">
													
														<?php if($item['rating_access'] == '1'):?>
															<a class="rating_access" href="javascript:" data-id="<?=$item['id']?>" data-status="<?=$rating_access['status']?>">
																<i class="fa fa-unlock"></i>
															</a>
														<?php else:?>
															<a class="rating_access" href="javascript:" data-id="<?=$item['id']?>" data-status="<?=$rating_access['status']?>">
																<i class="fa fa-lock"></i>
															</a>
														<?php endif?>
													</td>
													
													<td>
														<div class="dropdown-inverse dropdown open">
															
															<?php if($item['access_type'] != 1 || $item['id'] == $_SESSION['user']['id']):?>
																<button class="btn btn-inverse dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
																	<i class="fa fa-cogs"></i> Амалҳо
																</button>
																<div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
																	
																	<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-teacher="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																		class="dropdown-item waves-light waves-effect teacher_info" href="javascript:">
																		<i class="fa fa-info"></i> Маълумотнома
																	</a>
																	
																	<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-teacher="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																		class="dropdown-item waves-light waves-effect teacher_lessons" href="javascript:">
																		<i class="fa fa-list"></i> Дарсҳои омӯзгор
																	</a>
																	
																	<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-teacher="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																		class="dropdown-item waves-light waves-effect teacher_edit" href="javascript:">
																		<i class="fa fa-edit"></i> Таҳриркунӣ
																	</a>
																	
																	
																	<!--
																	<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-lock"></i> Кушодан</a>
																	-->
																	<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-unlock"></i> Маҳкамкунӣ</a>
																	
																	<div class="dropdown-divider"></div>
																	<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-teacher="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																		class="dropdown-item waves-light waves-effect delete_teacher" href="javascript:">
																		<i class="fa fa-trash"></i> Несткунӣ
																	</a>
																</div>
															<?php endif;?>
														</div>
													</td>
												</tr>
											<?php endforeach;?>
										</tbody>
									</table>
									
									<div class="text-center">
										<?php $url = MY_URL."?option=teachers&action=list";?>
										<?php pagination($url, $page, $count_all, $perpage, 10, '&');?>
									</div>
								</div>
							</div>
						</div>
						
						
						
						<?php //include("imtres.php");?>
						<?php //include("davrifaol.php");?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.rating_access').on('click', function(){
			var id = $(this).attr("data-id");
			var status = $(this).attr("data-status");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=rating_access";?>';
			
			
			if(status == 1) {
				set = 0;
				addclass_name = 'fa-lock';
				remclass_name = 'fa-unlock';
			}else{
				set = 1;
				addclass_name = 'fa-unlock';
				remclass_name = 'fa-lock';
			}
			
			$.ajax({
				type: 'post',
				url: url,
				data: {"id": id, "set": set},
				success: function(data){
					
				}
			});
			
			if(status == 1) {
				$(this).attr('data-status', set);
			}else{
				$(this).attr('data-status', set);
			}
			
			$(this).find("i").removeClass(remclass_name);
			$(this).find("i").addClass(addclass_name);
			
		});
		
		
		var all = $("#tbody input[type=checkbox]").length;
		
		$('.checkall').click(function () {
			if($(this).is(":checked")){
				$(".xorijbtn").attr("disabled", false);
				$(".intiqolbtn").attr("disabled", false);
				
				$("input[type=checkbox]").prop("checked", true);
				$('.count_checked').html($('#tbody input:checkbox:checked').length);
			}else{
				$(".xorijbtn").attr("disabled", true);
				$(".intiqolbtn").attr("disabled", true);
				
				$("input[type=checkbox]").prop("checked", false);
				$('.count_checked').html($('#tbody input:checkbox:checked').length);
			}
		});
		
		$('.checkbox').click(function (){
			var selected = $('#tbody input:checkbox:checked').length;
			
			if(selected == all){
				$('.checkall').prop("checked", true);
			}else{
				$('.checkall').prop("checked", false);
			}
			
			if(selected == 0){
				$(".xorijbtn").attr("disabled", true);
				$(".intiqolbtn").attr("disabled", true);
			}else{
				$(".xorijbtn").attr("disabled", false);
				$(".intiqolbtn").attr("disabled", false);
			}
			
			$('.count_checked').html(selected);
		});
		
		
		
		
		
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
			$('.modal-title').text("Таҳриркунӣ: " + name);
			
			
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
