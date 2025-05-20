<script type="text/javascript">
	$.cookie('timer', null);
	$.cookie('exit_time', null);
</script>
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
	<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown"
		style="text-align: center;background: #a02727;color: #fff;font-weight: bold;">
			<i class="fa fa-warning"></i> 
			Ба диқати донишҷӯёне, ки изи ангушт ва сурат дар СИИД надоранд расонида мешавад, ки қабули изи ангушт ва сурат(3/4 электронӣ) дар “Маркази тестӣ ва бақайдгирӣ”-и бинои асосӣ рузҳои 16.05.2024, 17.05.2024 ва 18.05.2024 аз соати 8:00 то 17:00 қабул карда мешавад:
			<br>Раёсати таълим.
	</div>
	-->
	<?php if($id_s_l == 1 && $id_s_v == 1):?>
		<!--
		<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown"
		style="text-align: center;background: #a02727;color: #fff;font-weight: bold;">
			
			<i class="fa fa-warning"></i> 
			<h3>Донишҷӯёне, ки шартномаи таҳсил ва имтиҳонҳои нимсолаи якумро пура <br> насупоридаанд ба имтиҳони нимсолаи дуюм роҳ дода намешаванд!!</h3>
			<h2>
			Донишҷӯёне курсҳои якум, ки   таҷрибаомӯзиҳои таълимӣ (геодезӣ ва меъморӣ) ва курсҳои сеюм ва чоруми (ихтисосҳои меъморӣ ва дизайн) таҷрибаомӯзиҳои истеҳсолиро то саршавии имтиҳонҳои нимсолаи дуюми соли таҳсили 2023-2024 насупоранд ба имтиҳони ҷамбастӣ иҷозат дода намешаванд.
			</h2>
			Ба диқати донишҷӯёни шӯъбаи рузона расонида мешавад, ки аз санаи 16.05.2024 то 19.05.2024 равзанаи «ХУДРО БИСАНҶ» фаъол аст, шумо метавонед имтиҳон супоред. Аз Шумо хоҳиш карда мешавад, ки ин имкониятро барои шинос шудан бо саволномаҳои тестӣ фаъолона истифода баред чун, ки саволномаҳо ба таври хаттӣ ва электронӣ аз тарафи омӯзгорон ба шумо пешниҳод намегардад.
			<br>Маркази тестӣ ва бақайдгирӣ.
		</div>
		-->
	<?php endif;?>
	
	<!--
	<?php if($id_s_v == 2):?>
		<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown"
		style="text-align: center;background: #a02727;color: #fff;font-weight: bold;">
			<i class="fa fa-warning"></i> 
			Ба диқати донишҷӯёни шӯъбаи фосилавӣ расонида мешавад, ки аз санаи 20.05.2024 дарсҳо оғоз мешаванд.
		</div>
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
									
									<h2 class="center bold text-c-red">ID-и Шумо: <?=$id_student?></h2>
									<div class="table-responsive davrifaol">
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th style="width:40px" rowspan="2">№</th>
													<th style="width:40%" rowspan="2">Номгӯи фанҳо</th>
													<th style="width:10%" rowspan="2">Миқдори<br>кредитҳо</th>
													
													<?php if($id_s_v == 2 && in_array($item['id_course'], [1,2,3])):?>
														<th rowspan="2">
															Рейтинг
														</th>
													<?php endif;?>
													
													
													
													<th colspan="4">Холи<br>Р1</th>
													<th colspan="4">Холи<br>Р2</th>
													<th rowspan="2">Холи<br>имтиҳон</th>
													<th rowspan="2">Холи<br>Триместр</th>
													<th rowspan="2">Холи<br>умумӣ</th>
													<th rowspan="2">Баҳо</th>
													<th rowspan="2" style="width:15%">Омӯзгор(он)</th>
													<!--<th style="width:170px">Амалҳо</th>-->
													
												</tr>
												
												<tr style="background-color: #263544; color: #fff">
													<th>КМД</th>
													<th>ДАВ.</th>
													<th>Р1</th>
													<th>Ҷамъ</th>
													<th>КМД</th>
													<th>ДАВ.</th>
													<th>Р1</th>
													<th>Ҷамъ</th>
												</tr>
											</thead>
											<tbody class="center">
												<?php //print_arr($fanho);?>
												<?php if(!empty($fanho)):?>
													<?php $counter = 0;?>
													<?php foreach($fanho as $item):?>
														<?php $id_fan=$item['id_fan'];?>
														<tr>
															<th scope="row"><?=++$counter?>.</th>
															<td class="left">
																<!--<a href="<?=MY_URL?>?option=study&action=fan&id_fan=<?=$item['id_fan']?>">
																</a>-->
																<?=getFanTest($item['id_fan'])?>
															</td>
															<td><?=$item['credits'];?></td>
															
															<?php if($id_s_v == 2 && in_array($item['id_course'], [1,2,3])):?>
																<td>
																	
																</td>
															<?php endif;?>
															
															<td>
																<?php
																	$id_student=$_SESSION['user']['id'];
																	$kmd1 = round(getNF('nf_1_score', $id_student, $id_fan, S_Y, H_Y),2);
																?>
																<?=$kmd1;?>
															</td>
															
															<td>
																<?php
																	$id_student=$_SESSION['user']['id'];
																	$dav1 = round(getNF('nf_1_absent', $id_student, $id_fan, S_Y, H_Y),2);
																?>
																<?=$dav1;?>
															</td>
															
															<td>
																<?php
																	$id_student=$_SESSION['user']['id'];
																	$rating1 = round(getNF('nf_1_score_r', $id_student, $id_fan, S_Y, H_Y),2);
																?>
																<?=$rating1;?>
															</td>
															
															<td class="bold">
																<?=$r1 = $kmd1 + $dav1 + $rating1?>
															</td>
															
															<!-- R2-->
															<td>
																<?php
																	$id_student=$_SESSION['user']['id'];
																	$kmd2 = round(getNF('nf_2_score', $id_student, $id_fan, S_Y, H_Y),2);
																?>
																<?=$kmd2;?>
															</td>
															
															<td>
																<?php
																	$id_student=$_SESSION['user']['id'];
																	$dav2 = round(getNF('nf_2_absent', $id_student, $id_fan, S_Y, H_Y),2);
																?>
																<?=$dav2;?>
															</td>
															
															<td>
																<?php
																	$id_student=$_SESSION['user']['id'];
																	$rating2 = round(getNF('nf_2_score_r', $id_student, $id_fan, S_Y, H_Y),2);
																?>
																<?=$rating2;?>
															</td>
															
															<td class="bold">
																<?=$r2 = $kmd2 + $dav2 + $rating2?>
															</td>
															<!-- R2-->
															
															<td>
																<?php 
																	echo getIMT($id_student, $id_fan, S_Y, H_Y);
																?>
															</td>
															
															<td>
																<?php 
																	echo $trimestr = getTrimestrScore($id_student, $id_fan, S_Y, H_Y);
																?>
															</td>
															<td>
																<?php 
																	if($trimestr != 0){
																		echo $all = $trimestr;
																	}else
																		echo $all=getTotalScore($id_student, $id_fan, S_Y, H_Y);
																?>
															</td>
															<td>
																<?php
																	echo getLatter($all)." (".getAdad($all).")";
																?>
															</td>
															<td>
																<?php
																	$id_iqtibos=$item['id'];
																	$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos`='$id_iqtibos'");
																	foreach($teachers as $teacher){
																		echo getShortName($teacher['id_teacher'])."<br>";
																	}
																?>
															</td>
														</tr>
													<?php endforeach;?>
												<?php else: ?>
													<tr class="center bold">
														<td colspan="9">
															<i class="fa fa-warning"></i> Донишҷӯи азиз ҳоло фанҳои Шумо илова нашудаанд. Дертар такроран даромада тафтиш кунед.
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




