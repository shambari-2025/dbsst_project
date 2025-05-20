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
							Ҳисоботи хазина
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
									<h5>Ҳисоботи хазина</h5>
								</div>
								<div class="card-block">
									<table border="0" style="width:50%">
										<tr>
											<td>
												<label class="bold">аз</label>
												<input value="<?=date("Y-m-d", time())?>" class="form-control fill" type="date" name="from_date" id="from_date">
											</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<label class="bold">то</label>
												<input value="<?=date("Y-m-d", time())?>" class="form-control fill" type="date" name="to_date" id="to_date">
											</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<button class="btn waves-effect waves-light btn-inverse loaddata" type="button" style="padding: 6px 10px; margin-top: 31px">
													<i class="fa fa-search"></i> Ҷустуҷу
												</button>
											</td>
										</tr>
									</table>
									<br>
									
									<div id="fordatas">
										<?php include("daromadho.php")?>
									</div>
									<br>
									<!--
									<div id="fordatas_texnopark">
										<?php include("daromadho_tp.php")?>
									</div>
									-->
									<br>
									<div class="table-responsive davrifaol">
									<table class="table" style="width: 50%; font-size: 14px !important">
										<?php foreach($faculties as $item):?>
											<tr>
												<td>
													<a target="_blank" href="<?=MY_URL?>?option=print&action=hissobot_kassa&id_faculty=<?=$item['id']?>"><?=$item['title']?></a>
												</td>
											</tr>
										<?php endforeach;?>
										
										<tr>
											<td>
												<a target="_blank" href="<?=MY_URL?>?option=print&action=hissobot_kassa_trimestr">Чекҳои триместр</a>
											</td>
										</tr>
										
									</table>
									</div>
									<br>
									
									<div class="table-responsive davrifaol">
										
										
										
										<table class="table" style="font-size: 14px !important">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th class="counter">№</th>
													<th class="counter">№ расид</th>
													
													<th class="left">Ному насаб</th>
													<th>Санаи таҳвил</th>
													<th>Асос</th>
													<th>Маблағ</th>
													<th>Макон</th>
													<th>Амалҳо</th>
												</tr>
											</thead>
											<tbody class="center" id="tbody">
												<?php $counter = $summa = 0;?>
												<?php foreach($dovtalabs as $item):?>
													<tr id="student_<?=$item['id']?>">
														<th scope="row"><?=++$counter?>.</th>
														<th scope="row"><?=$item['id_check']?></th>
														<td class="left"><?=$item['fullname_tj']?></td>
														<td><?=$item['check_date']?></td>
														<td><?=$pardoxt_types[$item['type_check']]?></td>
														<td><?=($item['money_check'])?></td>
														<td>
															<?php if($item['bank']):?>
																Дар бонк
															<?php else:?>
																Касса
															<?php endif;?>
														</td>
														<td>
															<!--
															<a target="_blank" href="<?=MY_URL?>?option=print&action=print_check1&id=<?=$item['id_check']?>" class="btn btn-inverse waves-effect waves-light">
																<i class="fa fa-print"></i> Чопи расид
															</a>
															-->
														</td>
													</tr>
												<?php endforeach;?>
											</tbody>
										</table>
									</div>
									
									<div class="text-center">
										<?php $url = MY_URL."?option=kassa&action=hissobot_kassa";?>
										<?php pagination($url, $page, $count_all, $perpage, 10, '&');?>
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
		
		$('.loaddata').on('click', function(){
			
			var from_date = $("#from_date").val();
			var to_date = $("#to_date").val();
			
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getDatas";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"from_date": from_date, "to_date": to_date},
				beforeSend: function(){
					$('#fordatas').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#fordatas img').hide();
					$('#fordatas').html(data);
				}
			});
		});
		
		
	});
</script>
