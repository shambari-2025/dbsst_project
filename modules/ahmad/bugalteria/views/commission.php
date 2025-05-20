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
							Муҳосибот
						</li>
						<li class="breadcrumb-item">
							Пардохт барои коммисияи қабул
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
									<h5>Донишҷӯён</h5>
								</div>
								<div class="card-block">
									
									
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th class="image">Расм</th>
												<th class="left">Ному насаб</th>
												<th>Санаи таҳвил</th>
												<th>Асос</th>
												<th>Маблағ</th>
												<th style="width: 450px">Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = 0;?>
											<?php foreach($dovtalabs as $item):?>
												<tr id="student_<?=$item['id']?>">
													<th scope="row"><?=++$counter?>.</th>
													
													<td>
														<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo']);?>
														<img class="img-circle profile_img imguser" src="<?=$photo;?>">
													</td>
													
													<td class="left"><?=$item['fullname_tj']?></td>
													
													<td><?=$item['check_date']?></td>
													<td><?=$pardoxt_types[$item['type_check']]?></td>
													<td><?=($item['money_check'])?></td>
													
													
													<td>
														<!--<a href="<?=MY_URL?>?option=kassa&action=op_checkinbank&id=<?=$item['id_check']?>" 
														class="btn btn-info waves-effect waves-light">
															<i class="fa fa-bank"></i> Дар бонк
														</a>
														
														<a href="<?=MY_URL?>?option=kassa&action=op_check&id=<?=$item['id_check']?>" class="btn btn-inverse waves-effect waves-light">
															Пардохт!
														</a>
														-->
														<a href="<?=MY_URL?>?option=kassa&action=delete_check&id=<?=$item['id_check']?>" onclick="return confirmDel()" class="btn btn-danger waves-effect waves-light">
															<i class="fa fa-trash"></i> Несткунӣ
														</a>
														
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
		
		
		
		
		
		
		
		
		
		
		
		
		$('.sessions_results').on('click', function(){
			<?php if($id_nt):?>
				var id_nt = <?=$id_nt?>;
			<?php endif;?>
			
			var id_student = $(this).attr("data-id-student");
			var id_course = <?=$id_course?>;
			var id_s_v = <?=$id_s_v?>;
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getimtinfo";?>';
			
			$('.modal-dialog').css("max-width", "90%");
			$('.modal-title').text("Натиҷаи имтиҳонҳо: " + name + " [" + id_student + "]");
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_nt": id_nt, "id_student": id_student, "id_course": id_course, "id_s_v": id_s_v, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
		});
		
		
		
		$('.archive').on('click', function(){
			
			var id_faculty = <?=$id_faculty?>;
			var id_s_v = <?=$id_s_v?>;
			var id_course = <?=$id_course?>;
			var id_spec = <?=$id_spec?>;
			var id_group = <?=$id_group?>;
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getArchiveForm";?>';
			
			$('.modal-dialog').css("max-width", "80%");
			$('.modal-title').text("Контингенти гурӯҳ");
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_v": id_s_v, "id_course": id_course, "id_spec": id_spec, "id_group": id_group, "my_url": my_url},
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
		
		
		
		$('.student_info').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentinfo";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Маълумотнома: " + name);
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
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
		
		
		
		//student_actions
		$('.student_actions').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentactions";?>';
			
			$('.modal-dialog').css("max-width", "98%");
			$('.modal-title').text("Фаъолият дар система: " + name);
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
			
		});
		
		
		$('.student_edit').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudenteditform";?>';
			
			$('.modal-dialog').css("max-width", "70%");
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
		
		
		
		/* ШАРТОНМА */
		$('.student_rasid').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getRasidForm";?>';
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Иловакунии расид: " + name);
			
			
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
		/* ШАРТОНМА */
		
		
		
		$('.delete_student').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentdeleteform";?>';
			
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Хориҷкунӣ: " + name);
			
			
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
	});
</script>
