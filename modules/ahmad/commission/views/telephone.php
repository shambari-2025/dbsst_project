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
							Коммиссияи қабул
						</li>
						
						<li class="breadcrumb-item">
							Телефон
						</li>
						<li class="breadcrumb-item">
							<?=$davr[0]['short']?>
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
												<th class="left">Ному насаб</th>
												<th>Телефон</th>
												<th>Шуъба/Шакли таҳсил</th>
												<th>Ихтисос</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = 0;?>
											
											<?php $ruzona = $fosilavi = 0; ?>
											<?php $ruz_pulaki = $ru_roygon = 0; ?>
											<?php $pulaki = $roygon = 0; ?>
											<?php foreach($datas as $item):?>
												
												<?php $query = query("SELECT * FROM `users` WHERE `fullname_tj` = '".$item['name']."'");?>
												
												<?php if(empty($query)):?>
												
													<?php if($item['id_s_v'] == '1'){
														$ruzona++;
													}else{
														$fosilavi++;
													}
													?>
													<tr>
														
														<th scope="row"><?=++$counter?>.</th>
														<td class="left">
															<?=$item['name']?>
														</td>
														
														<td>
															<?=$item['phone']?><br>
															<?=$item['parent_phone']?>
														</td>
														<td>
															<?=getStudyView($item['id_s_v'])?><br>
															<?=getStudyType($item['id_s_t'])?>
														</td>
														<td>
															<?=$item['spec']?>
														</td>
													</tr>
												<?php endif;?>
											<?php endforeach;?>
										</tbody>
									</table>
									
									<p>Рузона <?=$ruzona?></p>
									<p>Фосилавӣ <?=$fosilavi?></p>
									
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
		
		/* ШАРТОНОМА */
		$('.student_shartnoma').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var id_spec = <?=$id_spec?>;
			var id_s_l = <?=$id_s_l?>;
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getShartnomaForm";?>';
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Сохтани расид: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {
					"id_student": id_student,
					"id_spec": id_spec,
					"id_s_l": id_s_l,
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
		
	});
</script>
