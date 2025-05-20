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
							Сохтор
						</li>
						
						<li class="breadcrumb-item">
							Кафедраҳо
						</li>
						
						<li class="breadcrumb-item">
							<?=getDepartament($id_departament)?>
						</li>
						
						<li class="breadcrumb-item">
							Руйхати фанҳо
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
						
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>Руйхати фанҳо</h5>
								</div>
								<div class="card-block">
									<!--
									<button data-toggle="modal" data-target=".bs-example-modal-lg" class="add btn btn-inverse waves-effect waves-light" type="button" style="float: right">
										<a data-toggle="modal" data-target=".bs-example-modal-lg" class="add davrifaol" href="javascript:">
											<i class="fa fa-plus"></i> Иловакунӣ
										</a>
									</button>
									-->
									<div style="clear:both"></div>
									<hr>
									<?php //print_arr($fanho);?>
									<div class="table-responsive davrifaol">
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th style="width:70px">№</th>
													<th style="width:70px">ID</th>
													<th style="width:700px">Номгӯи фанҳо</th>
													<th>Амалҳо</th>
												</tr>
											</thead>
											<tbody class="center">
												<?php if(!empty($fanho)):?>
												
													<?php $counter = 0;?>
													<?php foreach($fanho as $item):?>
														<tr>
															<th scope="row"><?=++$counter?>.</th>
															<th scope="row"><?=$item['id']?></th>
															<td class="left">
																<?=$item['title_tj']?>
															</td>
															
															<td class="elements">
																
																<a class="info" href="javascript" 
																data-toggle="modal" 
																data-target=".bs-example-modal-lg" 
																data-id="<?=$item['id']?>"
																data-fan="<?=$item['title_tj']?>"
																>
																	<i class="fa fa-info"></i>
																</a>
																<!--
																<a class="edit" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$item['id']?>"><i class="fa fa-edit"></i> </a>
																-->
															</td>
														</tr>
													<?php endforeach;?>
												<?php else: ?>
													<tr class="center bold">
														<td colspan="4">
															<i class="fa fa-warning"></i> Маълумот нест.
														</td>
													</tr>
												<?php endif;?>
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
</div>



<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.info').on('click', function(){
			
			var fan = $(this).attr('data-fan');
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Маълумотномаи фани " + fan);
			
			var id_fan = $(this).attr("data-id");
			var id_departament = <?=$id_departament?>;
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=infoFan";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"file": "fan_info", "id_fan": id_fan, "id_departament": id_departament, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		
		$('.add').on('click', function(){
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Иловакунии фан");
			
			var id_departament = <?=$id_departament?>;
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=addForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"file": "fan_add", "id_departament": id_departament, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		
		
		$('.edit').on('click', function(){
			var id = $(this).attr("data-id");
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Таҳриркунӣ");
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=editForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"file": "fan_edit", "id": id, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
	});
</script>
