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
							Руйхати омӯзгорон
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
									<h5>Руйхати омӯзгорон</h5>
								</div>
								<div class="card-block">
									<?php//print_arr($_SESSION);?>
									
									<button data-toggle="modal" data-target=".bs-example-modal-lg" class="add btn btn-inverse waves-effect waves-light" type="button" style="float: right">
										<a data-toggle="modal" data-target=".bs-example-modal-lg" class="add davrifaol" href="javascript:">
											<i class="fa fa-plus"></i> Иловакунӣ
										</a>
									</button>
									<?php if(isset($_SESSION['user']['admin'])):?>
									<button class="btn btn-primary waves-effect waves-light" type="button">
										<a class="davrifaol" target="_blank" href="<?=MY_URL?>?option=print&action=dep_member_list&id=<?=$id_departament?>">
											<i class="fa fa-print"></i> Чопкунӣ
										</a>
									</button>
									<?php endif;?>
									
									
									<div style="clear:both"></div>
									<hr>
									<?php //print_arr($members);?>
									<table class="table" style="font-size:14px">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th style="width:70px">№</th>
												<th class="image">Расм</th>
												<th style="width:70px">ID</th>
												<th class="left" style="width:300px">Ному насаб</th>
												<th>Сину сол</th>
												<th>Ҳамкорӣ</th>
												<th>Вазифа, дараҷа ва унвони имлӣ</th>
												<th>Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php if(!empty($members)):?>
											
												<?php $counter = 0;?>
												<?php foreach($members as $item):?>
													<tr>
														<th scope="row"><?=++$counter?>.</th>
														<td>
															<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo'], true);?>
															<img class="img-circle profile_img imguser" src="<?=$photo;?>">
														</td>
														<th scope="row"><?=$item['id']?></th>
														<td class="left">
															<?=$item['fullname_tj']?><br>
															тел: <?=$item['phone']?>
														</td>
														
														<td><?=getSinuSol($item['birthday'])?></td>
														<td>
															<?php if(!empty($item['id_worker_type'])):?>
																<?=$worker_type[$item['id_worker_type']]?>
															<?php endif;?>
														</td>
														<td>
															<?=$item['vazifa']?><br>
															Соат: <?=$item['soat']?><br>
															Кредит: <?=$item['credit']?>
															
														</td>
														
														
														<td class="elements">
															
															<a class="edit" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$item['member_id']?>" title="Таҳриркунӣ">
																<i class="fa fa-edit"></i>
															</a>
															<a class="delete" href="<?=MY_URL;?>?option=soxtor&action=delete_teacher&id_departament=<?=$id_departament?>&id_teacher=<?=$item['id'];?>" ><i class="fa fa-trash"></i> </a>
															<!--<a href="#"><i class="fa fa-trash"></i> </a>-->
															
															<a target="_blank" href="<?=MY_URL;?>?option=print&action=teacher_sarbori&id_departament=<?=$id_departament?>&id_teacher=<?=$item['id'];?>">
																<i class="fa fa-print"></i>
															</a>
															
															
														</td>
													</tr>
												<?php endforeach;?>
											<?php else: ?>
												<tr class="center bold">
													<td colspan="8">
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



<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.add').on('click', function(){
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Иловакунии аъзои кафедра");
			
			var id_departament = <?=$id_departament?>;
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=addForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"file": "dep_member_add", "id_departament": id_departament, "my_url": my_url},
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
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=editMemberForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "my_url": my_url},
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
