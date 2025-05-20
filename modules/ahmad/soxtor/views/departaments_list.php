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
							Руйхати кафедраҳо
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
									<h5>Руйхати кафедраҳо</h5>
								</div>
								<div class="card-block">
									<button data-toggle="modal" data-target=".bs-example-modal-lg" class="add btn btn-inverse waves-effect waves-light" type="button" style="float: right">
										<a data-toggle="modal" data-target=".bs-example-modal-lg" class="add davrifaol" href="javascript:">
											<i class="fa fa-plus"></i> Иловакунӣ
										</a>
									</button>
									<div style="clear:both"></div>
									<hr>
									<div class="table-responsive davrifaol">
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th style="width:70px">№</th>
													<th style="width:70px">ID</th>
													<th style="width:400px">Номгӯи кафедраҳо</th>
													<th style="width:90px">Миқдори<br>кредитҳо</th>
													<th style="width:90px">Воҳиди корӣ</th>
													<th style="width:90px">Миқдори<br>аъзоён</th>
													<th>Мудири кафедра</th>
													<th>Амалҳо</th>
												</tr>
											</thead>
											<tbody class="center">
												<?php if(!empty($departaments)):?>
												
													<?php $counter = 0;?>
													<?php $all_members = $all_credits = $all_VK = 0;?>
													<?php foreach($departaments as $item):?>
														<tr>
															<th scope="row"><?=++$counter?>.</th>
															<th scope="row"><?=$item['id']?></th>
															<td class="left">
																<a href="<?=MY_URL?>?option=soxtor&action=fan_list&id=<?=$item['id']?>">
																	<?=$item['title']?>
																</a>
															</td>
															
															<th scope="row">
																<?=$credits = count_summa_where("iqtibosho", "credits", "`id_departament` = '{$item['id']}' AND `s_y` = '".S_Y."'");?>
																<?php $all_credits += $credits;?>
															</th>
															<th scope="row">
																<?=$vk= round(($credits / 24), 2)?>
																<?php $all_VK += $vk?>
															</th>
															<th scope="row">
																<?=$item['members']?>
																<?php $all_members += $item['members'];?>
															</th>
															<td class="left">
																<?php if($item['id_mudir']):?>
																	<?=getShortName($item['id_mudir'])?>
																<?php endif;?>
															</td>
															
															<td class="elements">
																<a href="<?=MY_URL?>?option=soxtor&action=sarbori&id=<?=$item['id']?>" title="Сарбории кафедра"><i class="fa fa-graduation-cap"></i> </a>
																<a href="<?=MY_URL?>?option=soxtor&action=member_list&id=<?=$item['id']?>" title="Руйхати аъзоёни кафедра"><i class="fa fa-list"></i> </a>
																<a class="edit" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$item['id']?>" title="Таҳриркунӣ"><i class="fa fa-edit"></i> </a>
																<a target="_blank" href="<?=MY_URL?>?option=print&action=res_sessia&id_departament=<?=$item['id']?>&s_y=<?=S_Y?>&h_y=<?=H_Y?>" title="Ҳисоботи сессия"><i class="fa fa-print"></i> </a>
															</td>
														</tr>
													<?php endforeach;?>
													<tr class="bold">
														<td colspan="3">Ҳамагӣ:</td>
														<td><?=$all_credits?></td>
														<td><?=$all_VK?></td>
														<td><?=$all_members?></td>
													</tr>
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
		
		$('.add').on('click', function(){
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Иловакунии кафедра");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=addForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"file": "departament_add", "my_url": my_url},
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
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Таҳриркунӣ");
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=editForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"file": "departament_edit", "id": id, "my_url": my_url},
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
