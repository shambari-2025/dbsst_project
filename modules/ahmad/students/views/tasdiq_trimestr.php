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
							Руйхати триместр
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
							
							
							
							<!-- FANHO -->
							
							<div class="card">
								<div class="card-header">
								</div>
								<div class="card-block">
									<div class="table-responsive davrifaol">
										
										<table class="table">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<td>№</td>
													<td>Ному насаби донишҷӯ</td>
													<td>Санаи сохтани ариза</td>
													<td>Аризаро сохт</td>
													<td>Соли таҳсил</td>
													<td>Нимсола</td>
													<td>Миқдори фанҳо</td>
													<td>Маблағ</td>
													<td>Пардохт</td>
													<td>Амалҳо</td>
												</tr>
											</thead>
											<tbody class="center">
											<?php $i=1;?>
											<?php foreach($datas as $a):?>
												<tr>
													<td><?=$i;?>.</td>
													<td><?=getUserName($a['id_student'])?></td>
													<td><?=formatDate($a['date'])?></td>
													<td><?=getUserName($a['author'])?></td>
													<td><?=getStudyYear($a['s_y'])?></td>
													<td><?=$a['h_y']?></td>
													<td><?=count_table_where("trimestr_content", "`id_trimestr` = '{$a['id']}'")?></td>
													<td><?=$a['money']?></td>
													<td>
														<?php
															$from_date = $a['date'];
															$dateTime = new DateTime($from_date);
															$dateTime->add(new DateInterval('P30D'));
															$to_date = $dateTime->format('Y-m-d H:i:s');
															$summa_suporid = count_summa_where("rasidho", "check_money", "id_student = '{$a['id_student']}' AND type = '3' AND payed = '1'");
															if($summa_suporid >= $a['money']){
																echo "<span style='color: green;'> ПАРДОХТШУДА</span>";
															}else{
																echo "<span style='color: red;'> ПАРДОХТНАШУДА</span>";
															}
														?>
													</td>
													<td >
														<a href="<?=MY_URL?>?option=students&action=tasdiq&id=<?=$a['id']?>">Тасдиқ</a>
													</td>
												</tr>
												<?php $i++;?>
											<?php endforeach;?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
							<!-- FANHO -->
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
