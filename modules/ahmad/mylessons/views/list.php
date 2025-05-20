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
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--
	<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown"
	style="text-align: center;background: #a02727;color: #fff;font-weight: bold;">
		<i class="fa fa-warning"></i> 
		<h3>Баҳои донишҷӯёне, ки шартномаи таҳсил ва имтиҳонҳои нимсолаи якумро пурра <br> насупоридаанд, дар давраи имтиҳонҳои нимсолаи дуюм сабт намешавад!!</h3>
	</div>
	-->
	
	
	<!--
	<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert"><i class="fa fa-warning"></i> 
		Барои бартараф намудани камбудиҳои ҷойдошта, гузоштани рейтинг санаи 28.10.2023 аз соати 8-00 то 16-00 кушода мешавад!
	</div>
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
									<h5>Дарсҳои ман [<?=$_SESSION['user']['id']?>]</h5>
									
								</div>
								
								<ul class="nav nav-tabs md-tabs " role="tablist">
									<?php for($i = 1; $i <= 2; $i++):?>
										<li class="nav-item">
											<a class="nav-link <?php if(H_Y == $i):?>active<?php endif;?>" data-toggle="tab" href="#nf_<?=$i?>" role="tab">
												Нимсолаи <?=$i?>
											</a>
											<div class="slide"></div>
										</li>
									<?php endfor;?>
								</ul>
								
								<div class="tab-content card-block">
									
									<?php for($i = 1; $i <= 2; $i++):?>
										<?php if($i == 1):?>
											<?php $datas = $lessons_n_1;?>
										<?php else:?>
											<?php $datas = $lessons_n_2;?>
										<?php endif;?>
										
										<div class="tab-pane <?php if(H_Y == $i):?>active<?php endif;?>" id="nf_<?=$i?>" role="tabpanel">
											
											<div class="table-responsive davrifaol">
												<table class="table" style="font-size:14px">
													<thead class="center">
														<tr style="background-color: #263544; color: #fff">
															<th style="width:40px">№</th>
															<th style="width:50px"><div class="vertical">ID ФАН</div></th>
															<th style="width:50px"><div class="vertical">Семестр</div></th>
															<th>Номгӯи фанҳо</th>
															<th style="width:160px">Шакли<br>имтиҳон</th>
															<th style="width:70px">Факултет</th>
															<th style="width:70px">Зинаи таҳсил</th>
															<th style="width:70px">Намуди таҳсил</th>
															<th style="width:70px">Курс</th>
															<th style="width:200px">Ихтисос</th>
															<th style="width:200px">Амалҳо</th>
														</tr>
													</thead>
													<tbody class="center">
														
														<?php if(!empty($datas)):?>
															<?php $counter = 0;?>
															<?php foreach($datas as $item):?>
																<tr>
																	<th scope="row"><?=++$counter?>.</th>
																	<th scope="row"><?=$item['id_fan']?></th>
																	<th scope="row"><?=$item['semestr']?></th>
																	<td class="left">
																		<?php if($item['id_s_v'] == 1):?>
																			<?=getFanTest($item['id_fan'])?>
																		<?php else:?>
																			<a href="<?=MY_URL;?>?option=mylessons&action=addmaterial&id_iqtibos=<?=$item['id_iqtibos']?>" title="Иловакунии мавод барои донишҷӯёни фосилавӣ"><?=getFanTest($item['id_fan'])?></a>
																		<?php endif?>
																		<?php
																			if($item['type'] == 'kori_kursi'){
																				echo "(Кори курсӣ)";
																			}if($item['type'] == 'loihai_kursi'){
																				echo "(Лоиҳаи курсӣ)";
																			}
																		?>
																	</td>
																	
																	<td>
																		<?php $test_info = getImtType($item['id_fan'], $item['id_faculty'], $item['id_s_l'], $item['id_s_v'], $item['id_course'], $item['id_spec'], $item['id_group'], S_Y, $i)?>
																		<?=@$imt_types[$test_info[0]['imt_type']]?>
																		
																		<?php //print_arr($test_info);?>
																	</td>
																	
																	<td>
																		<span title="<?=getFaculty($item['id_faculty'])?>">
																			<?=getFacultyShort($item['id_faculty'])?>
																		</span>
																	</td>
																	
																	<td><?=getStudyLevel($item['id_s_l'])?></td>
																	<td><?=getStudyView($item['id_s_v'])?></td>
																	<td><?=$item['id_course']?></td>
																	
																	<td>
																		<span title="<?=getSpecialtyTitle($item['id_spec'])?>">
																			<?=getSpecialtyCode($item['id_spec'])?>
																		</span>
																		<?=getGroup2($item['id_group'])?>
																	</td>
																	
																	<td class="elements">
																		<?php if($item['type'] == 'kori_kursi' || $item['type'] == 'loihai_kursi'):?>
																		<!-- Кори курсӣ / Лоиҳаи курсӣ -->
																			<a class="add_scores_k_k" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																				data-id="<?=$item['id_iqtibos']?>" 
																				data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																				data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																				data-view="<?=getStudyView($item['id_s_v'])?>" 
																				data-course="<?=getCourse($item['id_course'])?>" 
																				data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																				
																				data-fan="<?=getFanTest($item['id_fan'])?>"
																				title="Иловакунии холи кори курсӣ">
																				<i class="fa fa-plus"></i>
																			</a>
																			
																			<a href="<?=MY_URL?>?option=print&action=vedomost_kk&id_iqtibos=<?=$item['id_iqtibos']?>" title="Чопи ведомости кори курсӣ">
																				<i class="fa fa-print"></i>
																			</a>
																		<!-- Кори курсӣ / Лоиҳаи курсӣ -->
																		<?php else:?>
																			
																			<?php if(!in_array($item['id_fan'], NOT_RATING)):?>
																			
																				<?php if($item['id_s_l'] == 2):?>
																					<a class="add_scores_m2" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																						data-id="<?=$item['id_iqtibos']?>" 
																						data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																						data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																						data-view="<?=getStudyView($item['id_s_v'])?>" 
																						data-course="<?=getCourse($item['id_course'])?>" 
																						data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																						
																						data-fan="<?=getFanTest($item['id_fan'])?>"
																						data-imt-type="<?=$test_info[0]['imt_type']?>"
																						title="Иловакунии холҳо">
																						<i class="fa fa-plus"></i>
																					</a>
																				<?php endif;?>
																				
																				<!-- Иҷозат додан ба донишҷӯёни фосилавӣ -->
																				<?php if($item['id_s_v'] == 2):?>
																					<a class="imt_dopusk" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																						data-id="<?=$item['id_iqtibos']?>" 
																						data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																						data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																						data-view="<?=getStudyView($item['id_s_v'])?>" 
																						data-course="<?=getCourse($item['id_course'])?>" 
																						data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																						
																						data-fan="<?=getFanTest($item['id_fan'])?>"
																						title="Иҷозатдиҳи барои супоридани имтиҳон">
																						<i class="fa fa-lock"></i>
																					</a>
																				<?php endif;?>
																				<!-- Иҷозат додан ба донишҷӯёни фосилавӣ -->
																				
																				
																				<?php if(!in_array($item['id_fan'], NOT_RATING) && $item['id_s_v'] == 1 && H_Y == $i):?>
																					
																					<?php if((WEEK == 8 || WEEK == 17) || @$teacher_info[0]['rating_access'] == 1 ):?>
																						
																						<a class="add_scores" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																							data-id="<?=$item['id_iqtibos']?>" 
																							data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																							data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																							data-view="<?=getStudyView($item['id_s_v'])?>" 
																							data-course="<?=getCourse($item['id_course'])?>" 
																							data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																							data-rating="<?=RATING?>"
																							data-fan="<?=getFanTest($item['id_fan'])?>"
																							title="Иловакунии холҳои КМД">
																							<i class="fa fa-plus"></i>
																						</a>
																						
																					<?php endif;?>
																					
																				<?php endif;?>
																				
																				<?php if(isset($test_info[0]['r_'.RATING.'_date'])):?>
																					<?php if($test_info[0]['imt_type'] == 3):?>
																						<?php $exp = explode(" ", $test_info[0]['r_'.RATING.'_date']);?>
																						<?php if($exp[0] == date("Y-m-d") && date("H") >= 8 && date("H") <= 23):?>
																							<a class="add_scores_rating" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																								data-id="<?=$item['id_iqtibos']?>" 
																								data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																								data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																								data-view="<?=getStudyView($item['id_s_v'])?>" 
																								data-course="<?=getCourse($item['id_course'])?>" 
																								data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																								data-rating="<?=RATING?>"
																								data-fan="<?=getFanTest($item['id_fan'])?>"
																								title="Иловакунии холҳои рейтингӣ">
																								<i class="fa fa-plus"></i>
																							</a>
																						<?php endif;?>
																					<?php endif;?>
																				<?php endif;?>
																					
																				<!-- Барои фанҳои Шифоҳи -->
																				<?php if(isset($test_info[0]['datetime'])):?>
																					<?php $exp = explode(" ", $test_info[0]['datetime'])?>
																					<?php if($exp[0] == date("Y-m-d") && date("H") >= 8 && date("H") <= 23):?>
																						<a class="add_scores_imt" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																						data-id="<?=$item['id_iqtibos']?>" 
																						data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																						data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																						data-view="<?=getStudyView($item['id_s_v'])?>" 
																						data-course="<?=getCourse($item['id_course'])?>" 
																						data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																						data-fan="<?=getFanTest($item['id_fan'])?>"
																						title="Иловакунии холҳои имтиҳонӣ">
																							<i class="fa fa-plus"></i>
																						</a>
																					<?php endif;?>
																				<?php endif;?>
																				<!-- Барои фанҳои Шифоҳи -->
																				
																				
																				
																				<a href="<?=MY_URL?>?option=sessions&action=bisanj&id_fan=<?=$item['id_fan']?>&id_group=<?=$item['id_group']?>" title="Худро бисанҷ">
																					<i class="fa fa-check-square"></i>
																				</a>
																			
																				<a href="<?=MY_URL?>?option=questions&action=list&id_iqtibos=<?=$item['id_iqtibos']?>" title="Руйхати саволнома">
																					<i class="fa fa-list"></i>
																				</a>
																				
																				
																				
																			<?php else:?>
																				
																				<!-- Корҳои илмӣ -->
																				<a class="add_scores_ilmi" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																					data-id="<?=$item['id_iqtibos']?>" 
																					data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																					data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																					data-view="<?=getStudyView($item['id_s_v'])?>" 
																					data-course="<?=getCourse($item['id_course'])?>" 
																					data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																					
																					data-fan="<?=getFanTest($item['id_fan'])?>"
																					title="Иловакунии хол">
																					<i class="fa fa-plus"></i>
																				</a>
																				
																			<!-- Корҳои илмӣ -->
																				
																			<?php endif;?>
																		<?php endif;?>
																		
																	</td>
																</tr>
															<?php endforeach;?>
														<?php else: ?>
															<tr class="center bold">
																<td colspan="11">
																	<i class="fa fa-warning"></i> Маълумот нест.
																</td>
															</tr>
														<?php endif;?>
													</tbody>
												</table>
											</div>
											
										</div>
									<?php endfor;?>
								</div>
								
								
								
								
								
								
								
								
								
								<!--
								<div class="card-block accordion-block color-accordion-block">
									
									<div class="color-accordion" id="color-accordion">
										<?php if(H_Y == 2):?>
											<a class="accordion-msg b-none waves-effect waves-light">Нимсолаи 2</a>
											<div class="accordion-desc">
												<div class="table-responsive davrifaol">
													<table class="table" style="font-size:14px">
														<thead class="center">
															<tr style="background-color: #263544; color: #fff">
																<th style="width:40px">№</th>
																<th style="width:50px"><div class="vertical">ID ФАН</div></th>
																<th style="width:50px"><div class="vertical">Семестр</div></th>
																<th>Номгӯи фанҳо</th>
																<th style="width:160px">Шакли<br>имтиҳон</th>
																<th style="width:70px">Факултет</th>
																<th style="width:70px">Зинаи таҳсил</th>
																<th style="width:70px">Намуди таҳсил</th>
																<th style="width:70px">Курс</th>
																<th style="width:200px">Ихтисос</th>
																<th style="width:200px">Амалҳо</th>
															</tr>
														</thead>
														<tbody class="center">
															<?php if(!empty($lessons_n_2)):?>
																<?php $counter = 0;?>
																<?php foreach($lessons_n_2 as $item):?>
																	<tr>
																		<th scope="row"><?=++$counter?>.</th>
																		<th scope="row"><?=$item['id_fan']?></th>
																		<th scope="row"><?=$item['semestr']?></th>
																		<td class="left">
																			
																			<?php if($item['id_s_v'] == 1):?>
																				<?=getFanTest($item['id_fan'])?>
																			<?php else:?>
																				<a href="<?=MY_URL;?>?option=mylessons&action=addmaterial&id_iqtibos=<?=$item['id_iqtibos']?>" title="Иловакунии мавод барои донишҷӯёни фосилавӣ"><?=getFanTest($item['id_fan'])?></a>
																			<?php endif?>
																			<?php
																				if($item['type'] == 'kori_kursi'){
																					echo "(Кори курсӣ)";
																				}if($item['type'] == 'loihai_kursi'){
																					echo "(Лоиҳаи курсӣ)";
																				}
																			?>
																		</td>
																		
																		<td>
																			<?php $test_info = getImtType($item['id_fan'], $item['id_faculty'], $item['id_s_l'], $item['id_s_v'], $item['id_course'], $item['id_spec'], $item['id_group'], S_Y, H_Y)?>
																			<?=@$imt_types[$test_info[0]['imt_type']]?>
																			
																			<?php //print_arr($test_info);?>
																		</td>
																		
																		<td>
																			<span title="<?=getFaculty($item['id_faculty'])?>">
																				<?=getFacultyShort($item['id_faculty'])?>
																			</span>
																		</td>
																		
																		<td><?=getStudyLevel($item['id_s_l'])?></td>
																		<td><?=getStudyView($item['id_s_v'])?></td>
																		<td><?=$item['id_course']?></td>
																		
																		<td>
																			<span title="<?=getSpecialtyTitle($item['id_spec'])?>">
																				<?=getSpecialtyCode($item['id_spec'])?>
																			</span>
																			<?=getGroup2($item['id_group'])?>
																		</td>
																		
																		<td class="elements">
																			<?php if($item['type'] == 'kori_kursi' || $item['type'] == 'loihai_kursi'):?>
																				
																				<a class="add_scores_k_k" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																					data-id="<?=$item['id_iqtibos']?>" 
																					data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																					data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																					data-view="<?=getStudyView($item['id_s_v'])?>" 
																					data-course="<?=getCourse($item['id_course'])?>" 
																					data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																					
																					data-fan="<?=getFanTest($item['id_fan'])?>"
																					title="Иловакунии холи кори курсӣ">
																					<i class="fa fa-plus"></i>
																				</a>
																				
																				<a href="<?=MY_URL?>?option=print&action=vedomost_kk&id_iqtibos=<?=$item['id_iqtibos']?>" title="Чопи ведомости кори курсӣ">
																					<i class="fa fa-print"></i>
																				</a>
																				
																			<?php else:?>
																			
																				<?php if(!in_array($item['id_fan'], NOT_RATING)):?>
																					<?php if($item['id_s_l'] == 2):?>
																						<a class="add_scores_m2" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																							data-id="<?=$item['id_iqtibos']?>" 
																							data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																							data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																							data-view="<?=getStudyView($item['id_s_v'])?>" 
																							data-course="<?=getCourse($item['id_course'])?>" 
																							data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																							
																							data-fan="<?=getFanTest($item['id_fan'])?>"
																							data-imt-type="<?=$test_info[0]['imt_type']?>"
																							title="Иловакунии холҳо">
																							<i class="fa fa-plus"></i>
																						</a>
																					<?php endif;?>
																					
																					<?php if($item['id_s_v'] == 2):?>
																						<a class="imt_dopusk" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																							data-id="<?=$item['id_iqtibos']?>" 
																							data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																							data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																							data-view="<?=getStudyView($item['id_s_v'])?>" 
																							data-course="<?=getCourse($item['id_course'])?>" 
																							data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																							
																							data-fan="<?=getFanTest($item['id_fan'])?>"
																							title="Иҷозатдиҳи барои супоридани имтиҳон">
																							<i class="fa fa-lock"></i>
																						</a>
																					<?php endif;?>
																					
																					<?php if(!in_array($item['id_fan'], NOT_RATING) && $item['id_s_v'] == 1):?>
																					
																						<?php if((WEEK == 8 || WEEK == 17) || @$teacher_info[0]['rating_access'] == 1):?>
																							
																							<a class="add_scores" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																								data-id="<?=$item['id_iqtibos']?>" 
																								data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																								data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																								data-view="<?=getStudyView($item['id_s_v'])?>" 
																								data-course="<?=getCourse($item['id_course'])?>" 
																								data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																								data-rating="<?=RATING?>"
																								data-fan="<?=getFanTest($item['id_fan'])?>"
																								title="Иловакунии холҳои КМД">
																								<i class="fa fa-plus"></i>
																							</a>
																							
																						<?php endif;?>
																						
																					<?php endif;?>
																					
																					<?php if(isset($test_info[0]['r_'.RATING.'_date'])):?>
																						<?php if($test_info[0]['imt_type'] == 3):?>
																							<?php $exp = explode(" ", $test_info[0]['r_'.RATING.'_date']);?>
																							<?php if($exp[0] == date("Y-m-d") && date("H") >= 8 && date("H") <= 23):?>
																								<a class="add_scores_rating" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																									data-id="<?=$item['id_iqtibos']?>" 
																									data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																									data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																									data-view="<?=getStudyView($item['id_s_v'])?>" 
																									data-course="<?=getCourse($item['id_course'])?>" 
																									data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																									data-rating="<?=RATING?>"
																									data-fan="<?=getFanTest($item['id_fan'])?>"
																									title="Иловакунии холҳои рейтингӣ">
																									<i class="fa fa-plus"></i>
																								</a>
																							<?php endif;?>
																						<?php endif;?>
																					<?php endif;?>
																						
																					
																					<?php if(isset($test_info[0]['datetime'])):?>
																						<?php $exp = explode(" ", $test_info[0]['datetime'])?>
																						<?php if($exp[0] == date("Y-m-d") && date("H") >= 8 && date("H") <= 23):?>
																							<a class="add_scores_imt" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																							data-id="<?=$item['id_iqtibos']?>" 
																							data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																							data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																							data-view="<?=getStudyView($item['id_s_v'])?>" 
																							data-course="<?=getCourse($item['id_course'])?>" 
																							data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																							data-fan="<?=getFanTest($item['id_fan'])?>"
																							title="Иловакунии холҳои имтиҳонӣ">
																								<i class="fa fa-plus"></i>
																							</a>
																						<?php endif;?>
																					<?php endif;?>
																					
																					
																					
																					
																					<a href="<?=MY_URL?>?option=sessions&action=bisanj&id_fan=<?=$item['id_fan']?>&id_group=<?=$item['id_group']?>" title="Худро бисанҷ">
																						<i class="fa fa-check-square"></i>
																					</a>
																				
																					<a href="<?=MY_URL?>?option=questions&action=list&id_iqtibos=<?=$item['id_iqtibos']?>" title="Руйхати саволнома">
																						<i class="fa fa-list"></i>
																					</a>
																					
																					
																					
																				<?php else:?>
																					
																					<a class="add_scores_ilmi" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																						data-id="<?=$item['id_iqtibos']?>" 
																						data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																						data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																						data-view="<?=getStudyView($item['id_s_v'])?>" 
																						data-course="<?=getCourse($item['id_course'])?>" 
																						data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																						
																						data-fan="<?=getFanTest($item['id_fan'])?>"
																						title="Иловакунии хол">
																						<i class="fa fa-plus"></i>
																					</a>
																					
																					
																				
																				<?php endif;?>
																			<?php endif;?>
																			
																		</td>
																	</tr>
																<?php endforeach;?>
															<?php else: ?>
																<tr class="center bold">
																	<td colspan="11">
																		<i class="fa fa-warning"></i> Маълумот нест.
																	</td>
																</tr>
															<?php endif;?>
														</tbody>
													</table>
												</div>
											</div>
										<?php endif;?>
										
										
										<hr>
										<a class="accordion-msg bg-dark-primary b-none waves-effect waves-light">Нимсолаи 1</a>
										<div class="accordion-desc">
											
										
										</div>
									</div>
									
								</div>
								-->
								
								
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
		
		$('.add_scores').on('click', function(){
			var id_iqtibos = $(this).attr("data-id");
			var faculty = $(this).attr("data-faculty");
			var level = $(this).attr("data-level");
			var view = $(this).attr("data-view");
			var course = $(this).attr("data-course");
			var spec = $(this).attr("data-spec");
			var fan = $(this).attr("data-fan");
			var rating = $(this).attr("data-rating");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=getNFScoreForm";?>';
			
			
			title = "Холгузории НФ " + rating + " / " + faculty + " / "  + level + " / "  + view + " / "  + course + " / "  + spec + " / "  + fan;
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text(title);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"title": title, "id_iqtibos": id_iqtibos, "my_url": my_url, "rating": rating},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		$('.add_scores_rating').on('click', function(){
			var id_iqtibos = $(this).attr("data-id");
			var faculty = $(this).attr("data-faculty");
			var level = $(this).attr("data-level");
			var view = $(this).attr("data-view");
			var course = $(this).attr("data-course");
			var spec = $(this).attr("data-spec");
			var fan = $(this).attr("data-fan");
			var rating = $(this).attr("data-rating");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=getRatingScoreForm";?>';
			
			
			title = "Холгузории Рейтинг " + rating + " / " + faculty + " / "  + level + " / "  + view + " / "  + course + " / "  + spec + " / "  + fan;
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text(title);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"title": title, "id_iqtibos": id_iqtibos, "my_url": my_url, "rating": rating},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		$('.add_scores_m2').on('click', function(){
			var id_iqtibos = $(this).attr("data-id");
			var faculty = $(this).attr("data-faculty");
			var level = $(this).attr("data-level");
			var view = $(this).attr("data-view");
			var course = $(this).attr("data-course");
			var spec = $(this).attr("data-spec");
			var fan = $(this).attr("data-fan");
			var imt_type = $(this).attr("data-imt-type");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=getNFScoreFormM2";?>';
			
			
			title = "Холгузори М2 " + " / " + faculty + " / "  + level + " / "  + view + " / "  + course + " / "  + spec + " / "  + fan;
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text(title);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"title": title, "id_iqtibos": id_iqtibos, "imt_type": imt_type, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		$('.add_scores_imt').on('click', function(){
			var id_iqtibos = $(this).attr("data-id");
			var faculty = $(this).attr("data-faculty");
			var level = $(this).attr("data-level");
			var view = $(this).attr("data-view");
			var course = $(this).attr("data-course");
			var spec = $(this).attr("data-spec");
			var fan = $(this).attr("data-fan");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=getIMTScoreForm";?>';
			
			
			title = "Холгузории имтиҳон" + " / " + faculty + " / "  + level + " / "  + view + " / "  + course + " / "  + spec + " / "  + fan;
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text(title);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"title": title, "id_iqtibos": id_iqtibos, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		$('.add_scores_k_k').on('click', function(){
			var id_iqtibos = $(this).attr("data-id");
			var faculty = $(this).attr("data-faculty");
			var level = $(this).attr("data-level");
			var view = $(this).attr("data-view");
			var course = $(this).attr("data-course");
			var spec = $(this).attr("data-spec");
			var fan = $(this).attr("data-fan");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=getKKScoreForm";?>';
			
			
			title = "Холгузории кори курсӣ " + " / " + faculty + " / "  + level + " / "  + view + " / "  + course + " / "  + spec + " / "  + fan;
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text(title);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"title": title, "id_iqtibos": id_iqtibos, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		$('.add_scores_ilmi').on('click', function(){
			var id_iqtibos = $(this).attr("data-id");
			var faculty = $(this).attr("data-faculty");
			var level = $(this).attr("data-level");
			var view = $(this).attr("data-view");
			var course = $(this).attr("data-course");
			var spec = $(this).attr("data-spec");
			var fan = $(this).attr("data-fan");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=getILMScoreForm";?>';
			
			
			title = "Холгузорӣ " + " / " + faculty + " / "  + level + " / "  + view + " / "  + course + " / "  + spec + " / "  + fan;
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text(title);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"title": title, "id_iqtibos": id_iqtibos, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		$('.imt_dopusk').on('click', function(){
			var id_iqtibos = $(this).attr("data-id");
			var faculty = $(this).attr("data-faculty");
			var level = $(this).attr("data-level");
			var view = $(this).attr("data-view");
			var course = $(this).attr("data-course");
			var spec = $(this).attr("data-spec");
			var fan = $(this).attr("data-fan");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=getStudentList";?>';
			
			
			title = "Руйхати донишҷӯён " + " / " + faculty + " / "  + level + " / "  + view + " / "  + course + " / "  + spec + " / "  + fan;
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text(title);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"title": title, "id_iqtibos": id_iqtibos, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
	});
</script>
