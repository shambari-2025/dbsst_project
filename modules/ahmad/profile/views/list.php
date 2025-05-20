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
							Дарсҳои ман
						</li>
						
						<li class="breadcrumb-item">
							<?=getStudyYear(S_Y)?>
						</li>
						
						<li class="breadcrumb-item">
							Нимсолаи <?=(H_Y)?>
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
						<!-- Large modal -->
						
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>Дарсҳои ман</h5>
								</div>
								<div class="card-block">
									
									<div class="table-responsive davrifaol">
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th style="width:40px">№</th>
													<th style="width:50px">ID<br>ФАН</th>
													<th style="width:300px">Номгӯи фанҳо</th>
													<th style="width:70px">Мавзуъ</th>
													<th style="width:70px">Факултет</th>
													<th style="width:70px">Курс</th>
													<th style="width:70px">Ихтисос</th>
												</tr>
											</thead>
											<tbody class="center">
												
												<?php if(!empty($lessons)):?>
													<?php $counter = 0;?>
													<?php foreach($lessons as $item):?>
														<tr>
															<th scope="row"><?=++$counter?>.</th>
															<th scope="row"><?=$item['id_fan']?></th>
															<td class="left">
																<a href="<?=MY_URL?>?option=mylessons&action=addmaterial&id=<?=$item['id']?>">
																<?=getFan($item['id_fan'])?>
																</a>
															</td>
															
															<td><?=countMavzu($item['id_fan'], S_Y, H_Y)?></td>
															<td>
																<span title="<?=getFaculty($item['id_faculty'])?>">
																	<?=getFacultyShort($item['id_faculty'])?>
																</span>
															</td>
															
															<td><?=$item['id_course']?></td>
															
															<td>
																<span title="<?=getSpecialtyTitle($item['id_spec'])?>">
																	<?=getSpecialtyCode($item['id_spec'])?>
																</span>
																<?=getGroup2($item['id_group'])?>
															</td>
														</tr>
													<?php endforeach;?>
												<?php else: ?>
													<tr class="center bold">
														<td colspan="7">
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
		
	});
</script>
