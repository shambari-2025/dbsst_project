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
								<div class="card-block accordion-block color-accordion-block">
									
									<div class="color-accordion" id="color-accordion">
										<?php if(H_Y == 2):?>
										
										<a class="accordion-msg b-none waves-effect waves-light">Нимсолаи 2</a>
										<div class="accordion-desc">
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
														<?php if($fanlist_2):?>
															<?php $counter = $credits = 0;?>
															<?php foreach($fanlist_2 as $item):?>
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
																		<?php
																			$id_iqtibos = $item['id'];
																			$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
																			foreach($teachers as $teacher){
																				echo getShortName($teacher['id_teacher'])."<br>";
																			}
																		?>
																	</td>
																	<td class="center">
																		<?=count($students)?>
																	</td>
																	<!-- Р1 -->
																	<td class="center">
																		<?php
																			//Супориданд
																			$res_count = count_table_where("results", 
																			"
																			(`nf_1_score` + `nf_1_absent`) > 49 AND
																			`id_faculty` = '$id_faculty' AND 
																			`id_s_l` = '$id_s_l' AND 
																			`id_s_v` = '$id_s_v' AND 
																			`id_spec` = '$id_spec' AND 
																			`id_course` = '$id_course' AND 
																			`id_group` = '$id_group' AND 
																			`id_fan` = '{$item['id_fan']}' AND 
																			`s_y` = '".S_Y."' AND 
																			`h_y` = '".H_Y."'
																			");
																		?>
																		<?=$res_count?>
																	</td>
																	<!-- Р1 -->
																	
																	<!-- Р2 -->
																	<td class="center">
																		<?php
																			//Супориданд
																			$res_count = count_table_where("results", 
																			"
																			(`nf_2_score` + `nf_2_absent`) > 49 AND
																			`id_faculty` = '$id_faculty' AND 
																			`id_s_l` = '$id_s_l' AND 
																			`id_s_v` = '$id_s_v' AND 
																			`id_spec` = '$id_spec' AND 
																			`id_course` = '$id_course' AND 
																			`id_group` = '$id_group' AND 
																			`id_fan` = '{$item['id_fan']}' AND 
																			`s_y` = '".S_Y."' AND 
																			`h_y` = '".H_Y."'
																			");
																		?>
																		<?=$res_count?>
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
																			`h_y` = '".H_Y."'
																			");
																		?>
																		<?=$res_count?>
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
																		href="<?=MY_URL?>?option=print&action=svodni_imtihon&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&s_y=<?=S_Y?>&h_y=2" title="Чопи сводни барои имтиҳон">
																			<i class="fa fa-print"></i>
																	</a>
																	<a class="davrifaol btn waves-effect waves-light btn-inverse" target="_blank" 
																		href="<?=MY_URL?>?option=print&action=svodni_imtihon_t&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&s_y=<?=S_Y?>&h_y=2" title="Чопи сводни баъди триместр">
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
										<?php endif;?>
										
										
										<a class="accordion-msg bg-dark-primary b-none waves-effect waves-light">Нимсолаи 1</a>
										<div class="accordion-desc">
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
														<?php if($fanlist_1):?>
															<?php $counter = $credits = 0;?>
															<?php foreach($fanlist_1 as $item):?>
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
																		<?php
																			$id_iqtibos = $item['id'];
																			$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
																			foreach($teachers as $teacher){
																				echo getShortName($teacher['id_teacher'])."<br>";
																			}
																		?>
																	</td>
																	<td class="center">
																		<?=count($students)?>
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
																			`h_y` = '1'
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
																			`h_y` = '1'
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
																			`h_y` = '1'
																			");
																		?>
																		<a target="_blank" href="<?=MY_URL?>?option=print&action=res_imt&id_iqtibos=<?=$item['id']?>"><?=$res_count?></a>
																	</td>
																	<!-- ИМТИҲОН -->
																	
																	<td class="elements">
																		<!--
																		<?php if(isset($_SESSION['user']['admin'])):?>
																			<a class="add_scores" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																				data-id="<?=$item['id']?>" 
																				data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																				data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																				data-view="<?=getStudyView($item['id_s_v'])?>" 
																				data-course="<?=getCourse($item['id_course'])?>" 
																				data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																				
																				data-fan="<?=getFanTest($item['id_fan'])?>"
																				title="Иловакунии холҳои НФ">
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
																	--></td>
																</tr>
															<?php endforeach;?>
															
															<!--<tr>
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
																		href="<?=MY_URL?>?option=print&action=svodni_imtihon&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&s_y=<?=S_Y?>&h_y=1" title="Чопи сводни барои имтиҳон">
																			<i class="fa fa-print"></i>
																	</a>
																	<a class="davrifaol btn waves-effect waves-light btn-inverse" target="_blank" 
																		href="<?=MY_URL?>?option=print&action=svodni_imtihon_t&id_faculty=<?=$id_faculty?>&id_s_l=<?=$id_s_l?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&s_y=<?=S_Y?>&h_y=1" title="Чопи сводни баъди триместр">
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
														<?php endif;?>-->
													</tbody>
												</table>
											</div>
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
	});
</script>
