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
							Ҷадвали имтиҳон
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
									<h5><?=$page_info['title']?></h5>
								</div>
								<div class="card-block">
									
									<div class="table-responsive davrifaol">
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th style="width:40px">№</th>
													<th style="width:40px">
														<div class="vertical">ID ФАН</div>
													</th>
													<th style="width:250px">Номгӯи фанҳо</th>
													<th style="width:160px">Шакли<br>имтиҳон</th>
													<th style="width:160px">Санаи<br>имтиҳон</th>
													
													<th style="width:160px">Омӯзгор(он)</th>
													<th style="width:60px"><div class="vertical">Савол</div></th>
													<th style="width:60px"><div class="vertical">Баҳо</div></th>
													
												</tr>
											</thead>
											<tbody class="center">
												<?php if($datas):?>
													<?php $counter = 0;?>
													<?php //print_arr($datas);?>
													<?php foreach ($datas as $list):?>
														<?php @$exp = explode(" ", @$list['datetime'])?>
														<tr <?php if($exp[0] == date("Y-m-d")):?> style="background: green; color: #fff" class="bold" <?php endif;?>>
															<th scope="row"><?=++$counter?>.</th>
															<th scope="row"><?=$list['id_fan']?></th>
															<td class="left"><?=getFanTest($list['id_fan'])?></td>
															<td class="center">
																<?=$imt_types[$list['imt_type']]?>
															</td>
															
															<td class="center">
																<?=formatdate($list['datetime'])?>
															</td>
															
															
															<td>
																<?php
																	$id_iqtibos = $list['id_iqtibos'];
																	$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
																	foreach($teachers as $teacher){
																		echo getShortName($teacher['id_teacher'])."<br>";
																	}
																?>
															</td>
															
															
															
															<td class="center">
																<?php if($list['test_type'] == 1):?>
																	<?php $w = "";?>
																<?php elseif($list['test_type'] == 2):?>
																	<?php $w = "`id_faculty` = '$id_faculty' AND ";?>
																<?php elseif($list['test_type'] == 3):?>
																	<?php $w = "`id_spec` = '{$item['id']}' AND ";?>
																<?php endif;?>
																
																<?=count_table_where("questions", "$w `id_fan` = '{$list['id_fan']}' AND `lang` = '$lang'")?>
															</td>
															<td>
																<?=getLatter(getTotalScore($_SESSION['user']['id'], $list['id_fan'], $list['s_y'], $list['h_y']))?>
															</td>
															
														</tr>
													<?php endforeach;?>
												<?php else:?>
													<tr>
														<td colspan="8" class="bold">
															<i class="fa fa-warning"></i> Маълумот нест!
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




