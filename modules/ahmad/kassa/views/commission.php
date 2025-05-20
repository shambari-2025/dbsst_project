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
												
												<th class="left">Ному насаб</th>
												<th>Санаи таҳвил</th>
												<th>Ихтисосӣ</th>
												<th>Асос</th>
												<th>Маблағ</th>
												<th style="width: 450px">Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = 0;?>
											<?php $summa = 0;?>
											<?php foreach($dovtalabs as $item):?>
												<tr id="student_<?=$item['id']?>">
													<th scope="row"><?=++$counter?>.</th>
													
													
													<td class="left"><?=$item['fullname_tj']?></td>
													
													<td><?=$item['check_date']?></td>
													<td>
														
													</td>
													
													
													<td><?=$pardoxt_types[$item['type_check']]?></td>
													<td>
														<?php $summa += $item['money_check']?>
														<?=$item['money_check']?>
													</td>
													
													
													<td>
														<!--<a href="<?=MY_URL?>?option=kassa&action=op_checkinbank&id=<?=$item['id_check']?>" 
														class="btn btn-info waves-effect waves-light">
															<i class="fa fa-bank"></i> Дар бонк
														</a>
														
														<a href="<?=MY_URL?>?option=kassa&action=op_check&id=<?=$item['id_check']?>" class="btn btn-inverse waves-effect waves-light">
															Пардохт!
														</a>-->
														
														<a href="<?=MY_URL?>?option=kassa&action=delete_check&id=<?=$item['id_check']?>" onclick="return confirmDel()" class="btn btn-danger waves-effect waves-light">
															<i class="fa fa-trash"></i> Несткунӣ
														</a>
														
													</td>
												</tr>
											<?php endforeach;?>
											<tr class="bold center">
												<td colspan="4"></td>
												<td><?=makeBeauty($summa)?></td>
												<td></td>
											</tr>
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
		
	});
</script>
