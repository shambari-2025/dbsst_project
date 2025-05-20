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
							Донишҷӯён
						</li>
						<li class="breadcrumb-item" title="<?=$group_options[0]['faculty_title']?>">
							<?=$group_options[0]['faculty_short']?>
						</li>
						
						<li class="breadcrumb-item">
							<?=$group_options[0]['s_l_title']?>
						</li>
						
						<li class="breadcrumb-item">
							<?=$group_options[0]['s_v_title']?>
						</li>
						<li class="breadcrumb-item">
							<?=$group_options[0]['course_title']?>
						</li>
						<li class="breadcrumb-item" title="<?=$group_options[0]['spec_title_tj']?>">
							<?=$group_options[0]['spec_code']?>
						</li>
						<li class="breadcrumb-item">
							<?=$group_options[0]['group_title']?>
						</li>
						<li class="breadcrumb-item">
							<?=$group_options[0]['id']?>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	
	<?php if(!isset($id_nt)):?>
		<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown myalert"><i class="fa fa-warning"></i> Ин гурӯҳ нақшаи таълимӣ надорад. Лутфан нақшаи таълимии гурӯҳро муайян кунед.</div>
	<?php endif;?>
	
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
									<h5>Фанҳо</h5>
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
											<?php $datas = $fanlist_1;?>
											<?php $counter_student = $students_r2;?>
										<?php else:?>
											<?php $datas = $fanlist_2;?>
											<?php $counter_student = $students_r2;?>
										<?php endif;?>
										
										<div class="tab-pane <?php if(H_Y == $i):?>active<?php endif;?>" id="nf_<?=$i?>" role="tabpanel">
											<div class="table-responsive davrifaol">
												<table class="table" style="font-size: 14px !important">
													<thead class="center">
														<tr style="background-color: #263544; color: #fff">
															<th class="counter">№</th>
															<th style="width:50px">ID<br>FAN</th>
															<th class="left" style="width:400px !important">Номӯйи фанҳо</th>
															<th>Кр.</th>
															<th>Омӯзгор(он)</th>
															<th>ШД</th>
															<th>
																<div class="vertical">Супорид Р1</div>
															</th>
															<th>
																<div class="vertical">Супорид Р2</div>
															</th>
															<th>Супорид <br>имтиҳон</th>
															<th>Амалҳо</th>
														</tr>
													</thead>
													<tbody class="center">
														<?php if($datas):?>
															<?php $counter = $credits = 0;?>
															<?php foreach($datas as $item):?>
																<tr>
																	<th scope="row"><?=++$counter?>.</th>
																	<th scope="row"><?=$item['id_fan']?></th>
																	<td class="left <?php if($item['k_k']):?>bold <?php endif;?> ">
																		<?php if($item['intixobi']):?>
																			<span class="red">интихобӣ</span>
																		<?php endif;?>
																		
																		<?=getFanTest($item['id_fan'])?>
																		
																		<?php if($item['k_k']):?>
																			<br><i>(кори курсӣ)</i>
																		<?php endif;?>
																	</td>
																	
																	<td>
																		<?php $credits += $item['c_u']?>
																		<?=$item['c_u']?>
																	</td>
																	
																	<td>
																		<?php if($item['teacher']):?>
																			<?=ShortName($item['teacher'])?>
																		<?php endif;?>
																	</td>
																	<td class="center">
																		<?=$counter_student?>
																	</td>
																	<!-- Р1 -->
																	<td class="center">
																		<?php
																			//Супориданд
																			$res_count = count_table_where("results", 
																			"
																			IFNULL(`nf_1_score`, 0) + IFNULL(`nf_1_absent`,0) + IFNULL(`nf_1_score_r`,0) > 0 AND
																			`id_faculty` = '$id_faculty' AND 
																			`id_s_l` = '$id_s_l' AND 
																			`id_s_v` = '$id_s_v' AND 
																			`id_spec` = '$id_spec' AND 
																			`id_course` = '$id_course' AND 
																			`id_group` = '$id_group' AND 
																			`id_fan` = '{$item['id_fan']}' AND 
																			`s_y` = '".S_Y."' AND 
																			`h_y` = '$i'
																			");
																		?>
																		<a target="_blank" href="<?=MY_URL?>?option=print&action=res_rating&id_iqtibos=<?=$item['id']?>&rating=1"><?=$res_count?></a>
																	</td>
																	<!-- Р1 -->
																	
																	<!-- Р2 -->
																	<td class="center">
																		<?php
																			//Супориданд
																			$res_count = count_table_where("results", 
																			"
																			IFNULL(`nf_2_score`, 0) + IFNULL(`nf_2_absent`,0) + IFNULL(`nf_2_score_r`,0) > 0 AND
																			`id_faculty` = '$id_faculty' AND 
																			`id_s_l` = '$id_s_l' AND 
																			`id_s_v` = '$id_s_v' AND 
																			`id_spec` = '$id_spec' AND 
																			`id_course` = '$id_course' AND 
																			`id_group` = '$id_group' AND 
																			`id_fan` = '{$item['id_fan']}' AND 
																			`s_y` = '".S_Y."' AND 
																			`h_y` = '$i'
																			");
																		?>
																		<a target="_blank" href="<?=MY_URL?>?option=print&action=res_rating&id_iqtibos=<?=$item['id']?>&rating=2"><?=$res_count?></a>
																	</td>
																	<!-- Р2 -->
																	
																	<!-- ИМТИҲОН -->
																	<td class="center">
																		<?php
																			//Супориданд
																			$res_count = count_table_where("results", 
																			"
																			`imt_score` IS NOT NULL AND
																			`id_faculty` = '$id_faculty' AND 
																			`id_s_l` = '$id_s_l' AND 
																			`id_s_v` = '$id_s_v' AND 
																			`id_spec` = '$id_spec' AND 
																			`id_course` = '$id_course' AND 
																			`id_group` = '$id_group' AND 
																			`id_fan` = '{$item['id_fan']}' AND 
																			`s_y` = '".S_Y."' AND 
																			`h_y` = '$i'
																			");
																		?>
																		<?=$res_count?>
																		<a target="_blank" href="<?=MY_URL?>?option=print&action=examlist&id_iqtibos=<?=$item['id']?>" title="Чопи варақаи ҷавобдиҳии донишҷӯ">
																			<i class="fa fa-print"></i>
																		</a>
																		<a target="_blank" href="<?=MY_URL?>?option=print&action=vedomosti_shifohi&id_iqtibos=<?=$item['id']?>" title="Ведомости имтиҳон">
																			<i class="fa fa-print"></i>
																		</a>
																	</td>
																	<!-- ИМТИҲОН -->
																	
																	<td class="elements">
																		<?php if(isset($_SESSION['user']['admin'])):?>
																			<a class="add_scores" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																				data-id="<?=$item['id']?>" 
																				data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																				data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																				data-view="<?=getStudyView($item['id_s_v'])?>" 
																				data-course="<?=getCourse($item['id_course'])?>" 
																				data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																				data-rating="1"
																				data-fan="<?=getFanTest($item['id_fan'])?>"
																				title="Иловакунии холҳои НФ 1">
																				<i class="fa fa-plus"></i>
																			</a>
																			
																			<a class="add_scores" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																				data-id="<?=$item['id']?>" 
																				data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																				data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																				data-view="<?=getStudyView($item['id_s_v'])?>" 
																				data-course="<?=getCourse($item['id_course'])?>" 
																				data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																				data-rating="2"
																				data-fan="<?=getFanTest($item['id_fan'])?>"
																				title="Иловакунии холҳои НФ 2">
																				<i class="fa fa-plus"></i>
																			</a>
																		<?php endif;?>
																		
																		
																
																		<a target="_blank" href="<?=MY_URL?>?option=questions&action=list&id_iqtibos=<?=$item['id']?>" title="Руйхати саволнома">
																			<i class="fa fa-list"></i>
																		</a>
																		
																		<a target="_blank" href="<?=MY_URL?>?option=print&action=vedomost&id_iqtibos=<?=$item['id']?>" title="Чопи ведомост">
																			<i class="fa fa-print"></i>
																		</a>
																		<a target="_blank" href="<?=MY_URL?>?option=print&action=vedomost_trimestr&id_iqtibos=<?=$item['id']?>" title="Чопи ведомости триместр">
																			<i class="fa fa-print"></i>
																		</a>
																		<?php if($item['k_k']):?>
																			<a target="_blank" href="<?=MY_URL?>?option=print&action=vedomost_kk&id_iqtibos=<?=$item['id']?>" title="Чопи ведомости кори(лоиҳаи) курсӣ">
																				<i class="fa fa-print"></i>
																			</a>
																		<?php endif;?>
																		
																		<?php if(isset($_SESSION['user']['admin'])):?>
																			<a class="add_nb" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																				data-id="<?=$item['id']?>" 
																				data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																				data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																				data-view="<?=getStudyView($item['id_s_v'])?>" 
																				data-course="<?=getCourse($item['id_course'])?>" 
																				data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																				data-rating="2"
																				data-fan="<?=getFanTest($item['id_fan'])?>"
																				title="Иловакунии холҳои НФ 2">НБ</a>
																		<?php endif;?>
																	</td>
																</tr>
															<?php endforeach;?>
															
															<tr>
																<td colspan="3"></td>
																<td><?=$credits?></td>
																<td colspan="2"></td>
																<td>
																	<a class="davrifaol btn waves-effect waves-light btn-inverse" target="_blank" 
																		href="<?=MY_URL?>?option=print&action=svodni_rating&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&rating=1" title="Чопи сводни барои рейтинги 1">
																			<i class="fa fa-print"></i> Чоп Р1
																	</a>
																</td>
																
																<td>
																	<a class="davrifaol btn waves-effect waves-light btn-inverse" target="_blank" 
																		href="<?=MY_URL?>?option=print&action=svodni_rating&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&rating=2" title="Чопи сводни барои рейтинги 2">
																			<i class="fa fa-print"></i> Чоп Р2
																	</a>
																</td>
																
																<td>
																	<a class="davrifaol btn waves-effect waves-light btn-inverse" target="_blank" 
																		href="<?=MY_URL?>?option=print&action=svodni_imtihon&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&s_y=<?=S_Y?>&h_y=<?=$i?>" title="Чопи сводни барои имтиҳон">
																			<i class="fa fa-print"></i>
																	</a>
																	<a class="davrifaol btn waves-effect waves-light btn-inverse" target="_blank" 
																		href="<?=MY_URL?>?option=print&action=svodni_imtihon_t&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&s_y=<?=S_Y?>&h_y=<?=$i?>" title="Чопи сводни баъди триместр">
																			<i class="fa fa-print"></i>
																	</a>
																</td>
															</tr>
														<?php else:?>
															<tr>
																<td colspan="10" class="bold">
																	<span class="red"><i class="fa fa-warning"></i> Маълумот нест!</span>
																</td>
															</tr>
														<?php endif;?>
													</tbody>
												</table>
											</div>
										</div>
									<?php endfor;?>
								</div>
								
								
							</div>
							
							<!-- FANHO -->
							
							<div class="card">
								<div class="card-header">
									<h5>Донишҷӯён</h5>
								</div>
								<div class="card-block">
									<?php if(isset($_SESSION['user']['admin']) && empty($students)):?>
										<a class="center btn btn-danger waves-effect waves-light" onclick="return confirmDel()"
										href="<?=MY_URL?>?option=students&action=del_group&id=<?=$id_study_group?>">Несткунии гуруҳ</a>
									<?php endif;?>
									
									
									
									<button data-toggle="modal" data-target=".bs-example-modal-lg"
										class="btn waves-effect waves-light btn-inverse groupsettings" type="button">
										<i class="fa fa-cog"></i> Ҷурсозиҳои гурӯҳ
									</button>
									
									<button class="btn waves-effect waves-light btn-inverse" type="button">
										<a class="davrifaol" style="font-size:15px" target="_blank" 
										href="<?=MY_URL?>?option=print&action=login&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>">
											<i class="fa fa-users"></i> Логин ва паролҳо
										</a>
									</button>
									
									<?php //if($id_course > 1 || S_Y == 2):?>
										<button data-toggle="modal" data-target=".bs-example-modal-lg"
											class="btn waves-effect waves-light btn-inverse archive" type="button">
											<i class="fa fa-archive"></i> Архив
										</button>
									<?php //endif;?>
									
									<button class="btn waves-effect waves-light btn-inverse" type="button">
										<a class="davrifaol" style="font-size:15px" target="_blank" 
										href="<?=MY_URL?>?option=print&action=studentlist&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>">
											<i class="fa fa-list"></i> Руйхати донишҷӯён
										</a>
									</button>
									
									<button class="btn waves-effect waves-light btn-inverse" type="button">
										<a class="davrifaol" style="font-size:15px" target="_blank" 
										href="<?=MY_URL?>?option=print&action=tabel_student&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>">
											<i class="fa fa-print"></i> Чопи табелҳо
										</a>
									</button>
									
									
									<button class="btn waves-effect waves-light btn-inverse" type="button">
										<a class="davrifaol" style="font-size:15px" target="_blank" 
										href="<?=MY_URL?>?option=students&action=qarzdorho&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&s_y=<?=S_Y?>&h_y=1">
											<i class="fa fa-print"></i> Қарздорҳо
										</a>
									</button>
							
									<button class="btn waves-effect waves-light btn-inverse" type="button">
										<a class="davrifaol" style="font-size:15px" target="_blank" 
										href="<?=MY_URL?>?option=print&action=prostin&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&s_y=<?=S_Y?>&h_y=<?=H_Y?>">
											<i class="fa fa-file-pdf-o"></i> Простин
										</a>
									</button>
									<button class="btn waves-effect waves-light btn-inverse" type="button">
										<a class="davrifaol" style="font-size:15px"  
											href="<?=MY_URL?>?option=students&action=syncstdsresults&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>" title="Синхронизатсия донишҷӯён бо натиҷаҳо">
											<i class="fa fa-refresh"></i>
										</a>
									</button>
									
									<hr>
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<!--
												<th class="counter">
													<div class="checkbox-zoom zoom-success" style="margin: 0px">
														<label class="semestr" for="all" style="display: inline; margin:0px">
															<input type="checkbox" name="all" id="all" class="checkall form-control">
															<span class="cr" style="margin: 0px">
																<i class="cr-icon icofont icofont-ui-check txt-success"></i>
															</span>
														</label>
													</div>
												</th>
												-->
												<th class="counter">№</th>
												<th class="image">Расм</th>
												<th class="counter">ID</th>
												<th class="left">Ному насаб</th>
												<th>Шакли таҳсил</th>
												<th>Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = $mans = $shartmona = $buja = $kvota = 0;?>
											
											<?php $std_array = [];?>
											<?php foreach($students as $item):?>
												
												<?php $std_array[] = $item['id'];?>
												<?php if($item['jins'] == 1):?>
													<?php $mans++?>
												<?php endif;?>
												
												
												
												<?php if($item['id_s_t'] == 1):?>
													<?php $shartmona++?>
												<?php elseif($item['id_s_t'] == 2):?>
													<?php $buja++?>
												<?php elseif($item['id_s_t'] == 3):?>
													<?php $kvota++?>
												<?php endif;?>
												
												<tr id="student_<?=$item['id']?>">
													<!--
													<td>
														<div class="checkbox-zoom zoom-success" style="margin: 0px">
															<label class="semestr" for="student_<?=$item['id']?>" style="display: inline; margin:0px">
																<input class="checkbox" type="checkbox" name="student_<?=$item['id']?>" id="student_<?=$item['id']?>">
																<span class="cr" style="margin: 0px">
																	<i class="cr-icon icofont icofont-ui-check txt-success"></i>
																</span>
															</label>
														</div>
													</td>
													-->
													<th scope="row"><?=++$counter?>.</th>
													
													<td>
														<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo']);?>
														<?php// echo $item['photo'];?>
														<img class="img-circle profile_img imguser" src="<?=$photo;?>">
													</td>
													
													<th scope="row"><?=$item['id']?></th>
													
													<td class="left">
														<?=$item['fullname_tj']?>
														
														<?php if($item['vazi_oilavi'] > 1):?>
															<br>
															<span class="text-c-red bold">
																<i><?=getVaziOilavi($item['vazi_oilavi'])?></i>
															</span>
														<?php endif;?>
													</td>
													
													<td>
														<?=getStudyType($item['id_s_t'])?>
														<br>
														<?php if($item['id_s_t'] == 1):?>
															<?php $money = getMoneyShartnoma($item['id'], S_Y);?>
															
															<?php if(isset($money)):?>
																<span class="bold <?php if($money < 1500):?>text-c-red<?php endif;?>"><?=$money?> сомонӣ<br>супорид</span>
															<?php else:?>
																<span class="bold text-c-red"><?=$money?>Шартномаро<br>насупоридааст!</span>
															<?php endif;?>
														<?php endif;?>	
													</td>
													
													
													<td>
														<div class="dropdown-inverse dropdown open">
															<button class="btn btn-inverse dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
																<i class="fa fa-cogs"></i> Амалҳо
															</button>
															<div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
																
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																	class="dropdown-item waves-light waves-effect sessions_results" href="javascript:">
																	<i class="fa fa-line-chart"></i> Натиҷаи сессияҳо
																</a>
																
																<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=print&action=transcript2&id_student=<?=$item['id']?>&s_y=<?=S_Y?>&h_y=<?=H_Y?>"><i class="fa fa-print"></i> Чопи транскрипт</a>
																<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=print&action=listok&id_student=<?=$item['id']?>"><i class="fa fa-file"></i> Варақаи шахсӣ</a>
																<!--
																<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=print&action=tabel_student&id_student=<?=$item['id']?>&s_y=<?=S_Y?>&h_y=<?=H_Y?>"><i class="fa fa-print"></i> Чопи табел</a>
																-->
																<!--
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-print"></i> Чопи варақаи қарздорӣ</a>
																-->
																
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																	class="dropdown-item waves-light waves-effect student_info" href="javascript:">
																	<i class="fa fa-info"></i> Маълумотнома
																</a>
																
																<a target = "_blank" href="<?=MY_URL?>?option=print&action=farmonhoi_student&id_student=<?=$item['id']?>"
																		class="dropdown-item waves-light waves-effect">
																		<i class="fa fa-info"></i> Фармонҳо
																	</a>
																
																<a class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=students&action=addfarmon&id_student=<?=$item['id']?>" title="Иловакунии фармонҳо"><i class="fa fa-plus"></i>Иловакунии фармонҳо</a>
																<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=students&action=addoldresults&id_student=<?=$item['id']?>" title="Иловакунии натиҷаҳо аз транскрипт"><i class="fa fa-plus"></i>Иловакунии натиҷаҳо</a>
																
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>" data-foreign="<?=$item['foreign']?>"
																	class="dropdown-item waves-light waves-effect student_shartnoma" href="javascript:">
																	<i class="fa fa-bank"></i> Иловакунии расид
																</a>
																

																<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=students&action=create_raznitsa&id_student=<?=$item['id']?>" title="Сохтани фарқият"><i class="fa fa-file-archive-o"></i>Сохтани фарқият</a>
																
																<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=students&action=create_trimestr&id_student=<?=$item['id']?>&s_y=<?=S_Y;?>&h_y=<?php if($id_course >= 4):?>2<?php else:?>1<?php endif;?>" title="Сохтани триместр"><i class="fa fa-file-archive-o"></i>Сохтани триместр</a>
																<!--
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																	class="dropdown-item waves-light waves-effect student_actions" href="javascript:">
																	<i class="fa fa-info"></i> Фаъолият дар система
																</a>
																-->
																
																<?php if(isset($_SESSION['user']['admin'])):?>
																	<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																		class="dropdown-item waves-light waves-effect student_edit" href="javascript:">
																		<i class="fa fa-edit"></i> Таҳриркунӣ
																	</a>
																<?php endif;?>
																<!--
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-lock"></i> Кушодан</a>
																
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-unlock"></i> Маҳкамкунӣ</a>
																-->
																<div class="dropdown-divider"></div>
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																	class="dropdown-item waves-light waves-effect delete_student" href="javascript:">
																	<i class="fa fa-trash"></i> Хориҷкунӣ
																</a>
															</div>
														</div>
													</td>
												</tr>
											<?php endforeach;?>
										</tbody>
									</table>
								
									<hr>
									<!--
									<button data-toggle="modal" data-target=".bs-example-modal-lg" disabled
										class="btn waves-effect waves-light btn-danger xorijbtn" type="button">
										<i class="fa fa-trash"></i> Хориҷкунӣ <span class="count_checked">0</span> донишҷӯ
									</button>
									
									<button data-toggle="modal" data-target=".bs-example-modal-lg" disabled
										class="btn waves-effect waves-light btn-primary intiqolbtn" type="button">
										<i class="fa fa-random"></i> Интиқолкунӣ <span class="count_checked">0</span> донишҷӯ
									</button>
									-->
									<?php $id_student = implode(",", $std_array);?>
									<?//=$id_student?>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-md-6">
							<div class="card prod-p-card card-green">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Миқдори<br>мардҳо</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?=$mans?></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-male text-c-blue f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="col-xl-3 col-md-6">
							<div class="card prod-p-card card-green">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Миқдори<br>занҳо</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?=count($students) - $mans?></h3>
										</div>
										<div class="col-auto">
										<i class="fas fa-female text-c-red f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-md-6">
							<div class="card prod-p-card card-green">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Нақшаи<br>таълимӣ</h6>
												<?php if($id_nt && isset($_SESSION['user']['admin'])):?>
													<a href="<?=MY_URL?>?option=nt&action=nt_list&id_nt=<?=$id_nt?>" target="_blank">
														<h3 class="m-b-0 f-w-700 text-white">
															<?=getNTSOL($id_nt)?>
														</h3>
													</a>
												<?php else:?>
													<span class="text-c-red bold">Маълумот нест!</span>
												<?php endif;?>
										</div>
										<div class="col-auto">
											<i class="fas fa-folder-open text-c-green f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-md-6">
							<div class="card prod-p-card card-green">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Забони<br>таҳсил</h6>
											<?php if($lang):?>
												<h3 class="m-b-0 f-w-700 text-white"><?=getLang($lang)?></h3>
											<?php else:?>
												<span class="text-c-red bold">Маълумот нест!</span>
											<?php endif;?>
										</div>
										<div class="col-auto">
											<i class="fas fa-language text-c-green f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-4 col-md-6">
							<div class="card prod-p-card card-red">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Донишҷӯёни Шартномавӣ</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?=$shartmona?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-4 col-md-6">
							<div class="card prod-p-card card-red">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Донишҷӯёни Буҷавӣ</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?=$buja?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-4 col-md-6">
							<div class="card prod-p-card card-red">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Донишҷӯёни Квота</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?=$kvota?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<?php //include("imtres.php");?>
						<?php //include("davrifaol.php");?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	jQuery(document).ready(function($){
		
		var all = $("#tbody input[type=checkbox]").length;
		
		$('.checkall').click(function () {
			if($(this).is(":checked")){
				$(".xorijbtn").attr("disabled", false);
				$(".intiqolbtn").attr("disabled", false);
				
				$("input[type=checkbox]").prop("checked", true);
				$('.count_checked').html($('#tbody input:checkbox:checked').length);
			}else{
				$(".xorijbtn").attr("disabled", true);
				$(".intiqolbtn").attr("disabled", true);
				
				$("input[type=checkbox]").prop("checked", false);
				$('.count_checked').html($('#tbody input:checkbox:checked').length);
			}
		});
		
		$('.checkbox').click(function (){
			var selected = $('#tbody input:checkbox:checked').length;
			
			if(selected == all){
				$('.checkall').prop("checked", true);
			}else{
				$('.checkall').prop("checked", false);
			}
			
			if(selected == 0){
				$(".xorijbtn").attr("disabled", true);
				$(".intiqolbtn").attr("disabled", true);
			}else{
				$(".xorijbtn").attr("disabled", false);
				$(".intiqolbtn").attr("disabled", false);
			}
			
			$('.count_checked').html(selected);
		});
		
		
		
		
		
		
		
		/* ШАРТОНОМА */
		$('.student_shartnoma').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var id_spec = <?=$id_spec?>;
			var id_s_l = <?=$id_s_l?>;
			var id_s_v = <?=$id_s_v?>;
			var name = $(this).attr("data-name");
			var foreign = $(this).attr("data-foreign");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/commission/commission_ajax.php?option=getShartnomaForm";?>';
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Сохтани расид: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {
					"id_student": id_student,
					"id_spec": id_spec,
					"id_s_l": id_s_l,
					"id_s_v": id_s_v,
					"foreign": foreign,
					"my_url": my_url
				},
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
		/* ШАРТОНМА */
		
		
		
		
		$('.sessions_results').on('click', function(){
			<?php if($id_nt):?>
				var id_nt = <?=$id_nt?>;
			<?php endif;?>
			
			var id_student = $(this).attr("data-id-student");
			var id_course = <?=$id_course?>;
			var id_s_v = <?=$id_s_v?>;
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getimtinfo";?>';
			
			$('.modal-dialog').css("max-width", "90%");
			$('.modal-title').text("Натиҷаи имтиҳонҳо: " + name + " [" + id_student + "]");
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_nt": id_nt, "id_student": id_student, "id_course": id_course, "id_s_v": id_s_v, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
		});
		
		
		
		$('.archive').on('click', function(){
			
			var id_faculty = <?=$id_faculty?>;
			var id_s_v = <?=$id_s_v?>;
			var id_course = <?=$id_course?>;
			var id_spec = <?=$id_spec?>;
			var id_group = <?=$id_group?>;
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getArchiveForm";?>';
			
			$('.modal-dialog').css("max-width", "80%");
			$('.modal-title').text("Контингенти гурӯҳ");
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_v": id_s_v, "id_course": id_course, "id_spec": id_spec, "id_group": id_group, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		
		$('.student_info').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var s_y = <?=S_Y;?>;
			var h_y = <?=H_Y;?>;
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentinfo";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Маълумотнома: " + name);
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url, "s_y": s_y, "h_y": h_y},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		
		//student_actions
		$('.student_actions').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentactions";?>';
			
			$('.modal-dialog').css("max-width", "98%");
			$('.modal-title').text("Фаъолият дар система: " + name);
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
			
		});
		
		
		$('.student_edit').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudenteditform";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Таҳриркунӣ: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
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
		
		
		
		/* ШАРТОНМА */
		$('.student_rasid').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getRasidForm";?>';
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Иловакунии расид: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
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
		/* ШАРТОНМА */
		
		
		
		$('.delete_student').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentdeleteform";?>';
			
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Хориҷкунӣ: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
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
		
		
		$('.groupsettings').on('click', function(){
			var id_faculty = <?=$id_faculty?>;
			var id_s_v = <?=$id_s_v?>;
			var id_course = <?=$id_course?>;
			var id_spec = <?=$id_spec?>;
			var id_group = <?=$id_group?>;
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=groupsettings";?>';
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Ҷурсозиҳои гурӯҳ");
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_v": id_s_v, "id_course": id_course, "id_spec": id_spec, "id_group": id_group},
				success: function(data){
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		
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
			
			
			title = "Холгузорӣ " + " / " + faculty + " / "  + level + " / "  + view + " / "  + course + " / "  + spec + " / "  + fan;
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text(title);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"title": title, "id_iqtibos": id_iqtibos, "rating": rating, "my_url": my_url},
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
		
		$('.add_nb').on('click', function(){
			var id_iqtibos = $(this).attr("data-id");
			var faculty = $(this).attr("data-faculty");
			var level = $(this).attr("data-level");
			var view = $(this).attr("data-view");
			var course = $(this).attr("data-course");
			var spec = $(this).attr("data-spec");
			var fan = $(this).attr("data-fan");
			var rating = $(this).attr("data-rating");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=getAddNBForm";?>';
			
			
			title = "Иловакунии НБ " + " / " + faculty + " / "  + level + " / "  + view + " / "  + course + " / "  + spec + " / "  + fan;
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text(title);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"title": title, "id_iqtibos": id_iqtibos, "rating": rating, "my_url": my_url},
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
