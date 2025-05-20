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
							Модули ёрирасон
						</li>
						<li class="breadcrumb-item">
							Интихоб
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
									<h5>Интихоб аз ММТ</h5>
								</div>
								<div class="card-block">
									
									
									<div class="table-responsive davrifaol">
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th rowspan="2" style="width:20px">№</th>
													<th rowspan="2">Номгӯи ихтисосҳо</th>
													<th rowspan="2"><div class="vertical">Шакли таҳсил</div></th>
													<th rowspan="2"><div class="vertical">Намуди таҳсил</div></th>
													<th rowspan="2"><div class="vertical">Нақша</div></th>
													<th rowspan="2"><div class="vertical">Интихоб</div></th>
													<th colspan="12">аз ҷумла аз рӯи интихоби:</th>
												</tr>
												<tr style="background-color: #263544; color: #fff">
													<?php for($i = 1; $i <= 12; $i++):?>
														<?php $intixob_[$i] = 0;?>
														<td><?=$i?></td>
													<?php endfor;?>
												</tr>
											</thead>
											<tbody class="center">
												<?php if(!empty($myData)):?>
												
													<?php $counter = 0;?>
													<?php $real_naqsha = $real_intixob = 0;?>
													<?php foreach($myData as $item):?>
														<tr>
															<th scope="row"><?=++$counter?>.</th>
															<td class="left">
																<?=$item['spec']?>
															</td>
															
															<td scope="row">
																<?=$item['ruzona_fosilavi']?>
															</td>
															
															<td scope="row">
																<?=$item['mablagh_guzori']?>
															</td>
															
															<td scope="row">
																<?php $real_naqsha += $item['naqsha']?>
																<?=$item['naqsha']?>
															</td>
															
															<td scope="row" <?php if($item['intixob'] == 0):?>style="background: red; color: #fff"<?php endif;?>>
																<?php $real_intixob += $item['intixob']?>
																<?=$item['intixob']?>
															</td>
															
															<?php for($i = 1; $i <= 12; $i++):?>
																<?php $intixob_[$i] += $item['intixob_'.$i]?>
																<td><?=$item['intixob_'.$i]?></td>
															<?php endfor;?>
															
														</tr>
													<?php endforeach;?>
													
													<tr class="bold center">
														<td colspan="4"></td>
														<td><?=$real_naqsha?></td>
														<td><?=$real_intixob?></td>
														
														<?php for($i = 1; $i <= 12; $i++):?>
															<td>
																<?=$intixob_[$i]?>
															</td>
														<?php endfor;?>
													</tr>
													
												<?php else: ?>
													<tr class="center bold">
														<td colspan="6">
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
