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
							Ҷадвали дарсҳо
						</li>
						
						<li class="breadcrumb-item">
							<?=getStudyYear($S_Y)?>
						</li>
						
						<li class="breadcrumb-item">
							Нимсолаи <?=($H_Y)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getFacultyShort($id_faculty)?>
						</li>
						<li class="breadcrumb-item">
							<?=getStudyView($id_s_v)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getCourse($id_course)?>
						</li>
						<li class="breadcrumb-item">
							<?=getSpecialtyCode($id_spec)?>
						</li>
						<li class="breadcrumb-item">
							<?=getGroup($id_group)?>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<!--
	<?php if(!isset($id_nt)):?>
		<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown myalert"><i class="fa fa-warning"></i> Ин гурӯҳ нақшаи таълимӣ надорад. Лутфан нақшаи таълимии гурӯҳро муайян кунед.</div>
	<?php endif;?>
	
	-->
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						
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
						
						
						<?php foreach($daysOfWeek as $v => $k):?>
							<div class="col-xl-6 col-md-6">
								<div class="card">
									<div class="card-header" <?php if(date("w") == $v):?> style="background: #263544" <?php endif;?>>
										<h5 <?php if(date("w") == $v):?> style="color: #fff" <?php endif;?>><?=$k?></h5>
									</div>
									<div class="card-block" >
										<?php $datas = query("SELECT * FROM `jd` WHERE `ruz` = '$v' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `soat`");?>
										<table style="width: 100%">
											<thead>
												<tr style="background-color: #263544; color: #fff">
													<td>Соат</td>
													<td>Номи фан</td>
													<td>Намуди дарс</td>
													<td>Омӯзгор</td>
												</tr>
											</thead>
											<tbody>
												<?php foreach($datas as $item):?>
												<tr <?php if(7+$item['soat'] == date("H") AND date("w") == $v):?> style="background: yellow" <?php endif;?>>
													<td><?=7+$item['soat']?><sup>00</sup></td>
													<td><?=getFanTest($item['id_fan'])?></td>
													<td><?=getLessonsType($item['lessons_type'])?></td>
													<td><?=shortName(getUserName($item['id_teacher']))?></td>
												</tr>
												<?php endforeach;?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	jQuery(document).ready(function($){
		
		// Иловакунии саволнома
		$('.add_questions').on('click', function(){
			var id_fan = $(this).attr("data-id-fan");
			var title = $(this).attr("data-title");
			
			var s_y = '<?=$S_Y?>';
			var h_y = '<?=$H_Y?>';
			
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Иловакунии саволнома: " + title);
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/questions/questions_ajax.php?option=add_form";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_fan": id_fan, "s_y": s_y, "h_y": h_y, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					//$('#bigmodal').append(data);
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		// Иловакунии саволнома
		
		
		
		$('.add_nf_score').on('click', function(){
			var id = $(this).attr("data-id");
			var title = $(this).attr("data-title");
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Гузаронидани холҳои НФ: " + title);
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=nf_form";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					//$('#bigmodal').append(data);
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		
		$('.active').on('click', function(){
			var id = $(this).attr("data-id");
			var status = $(this).attr("data-status");
			
			console.log(id);
			console.log(status);
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=active";?>';
			
			
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
		
		
		$('.edit_jd').on('click', function(){
			var id = $(this).attr("data-id");
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Таҳриркунӣ");
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=editForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					//$('#bigmodal').append(data);
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
	});
</script>
