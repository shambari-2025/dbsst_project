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
							Ҷустуҷу
						</li>
						<li class="breadcrumb-item">
							<?=$word?>
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
									<h5>Натиҷаи ҷустуҷу: <i><?=$word?></i></h5>
								</div>
								<div class="card-block">
									
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th class="image">Расм</th>
												<th class="counter">ID</th>
												<th class="left">Ному насаб</th>
												<th>
													Маълумотнома
												</th>
												<th>Шакли таҳсил</th>
												<th>Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center">
											<?php $counter = 0;?>
											
											<?php foreach($students as $item):?>
												<?php $group_info = query("SELECT * FROM `std_study_groups` WHERE `id_faculty` = '".$item['id_faculty']."' AND `id_s_v` = '".$item['id_s_v']."' AND `id_course` = '".$item['id_course']."' AND `id_spec` = '".$item['id_spec']."' AND `s_y` = '".$item['s_y']."' AND `h_y` = '".$item['h_y']."'");?>
												<?php $shurbo_info = query("SELECT * FROM `shurbo` WHERE `id_student` = '".$item['id_student']."' AND `s_y` = '".$item['s_y']."' AND `h_y` = '".$item['h_y']."'");?>
												<tr>
													<th scope="row"><?=++$counter?>.</th>
													<td>
														<?php $photo = getUserImg($item['id_student'], $item['jins'], $item['photo']);?>
														<img class="img-circle profile_img imguser" src="<?=$photo;?>">
													</td>
													<th scope="row"><?=$item['id_student']?></th>
													<td class="left">
														<?=$item['fullname_tj']?>
														<?php if(!empty($shurbo_info)):?>
															<i class="fa fa-lock"></i>
														<?php endif;?>
														
														<?php if($item['archive']):?>
															<br>
															<span class="text-c-green bold">
																<i>Донишҷӯ соли таҳсили <?=getStudyYear($item['archive'])?> хатм кардааст!</i>
															</span>
														<?php endif;?>
														
														<?php if($item['vazi_oilavi'] > 1):?>
															<br>
															<span class="text-c-red bold">
																<i><?=getVaziOilavi($item['vazi_oilavi'])?></i>
															</span>
														<?php endif;?>
													</td>
													
													<td>
														<?php if($item['status'] == '0'):?>
															<span class="bold text-c-red">Донишҷӯ соли <?=getStudyYear($item['s_y'])?>, нимсолаи <?=$item['h_y']?> хориҷ шудааст.</span><br>
															<?php $d = query("SELECT * FROM `stds_farmonho` WHERE `id_student` = '{$item['id_student']}' ORDER BY `id` DESC LIMIT 1");?>
															№<?=$d[0]['farmon_number']?><br>
															<span class="bold">Сабаб: </span><?=$d[0]['farmon_text']?><br>
															<?=formatDate($d[0]['farmon_date'])?><br>
														<?php endif;?>
														
														<?=getFacultyShort($item['id_faculty'])?><br>
														<?=getStudyLevel($item['id_s_l'])?><br>
														<span class="bold <?php if($item['id_s_v'] == 1):?>text-c-red<?php else: ?> text-c-green<?php endif;?>"><?=getStudyView($item['id_s_v'])?></span><br>
														<?=getCourse($item['id_course'])?><br>
														<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?><br>
														<?=@getNTSOL($group_info[0]['id_nt'])?>
													</td>
													
													<td>
														<?=getStudyType($item['id_s_t'])?>
														<br>
														<?php if($item['id_s_t'] == 1):?>
															<?php $money = getMoneyShartnoma($item['id_student'], S_Y);?>
															<?php $persent = getMyPersent($item['id_student'], S_Y)?>
															<?php if($persent):?>
																<?=$persent?>%<br>
															<?php endif;?>
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
																
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id_student']?>" data-name="<?=$item['fullname_tj']?>" 
																	data-id-nt="<?=$group_info[0]['id_nt']?>" data-id-course="<?=$group_info[0]['id_course']?>" data-id-s-v="<?=$group_info[0]['id_s_v']?>"
																	data-s_y="<?=$item['s_y']?>" data-h_y="<?=$item['h_y']?>"
																	class="dropdown-item waves-light waves-effect sessions_results" href="javascript:">
																	<i class="fa fa-line-chart"></i> Натиҷаи сессияҳо
																</a>
																
																<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=print&action=transcript2&id_student=<?=$item['id_student']?>&s_y=<?=$item['s_y']?>&h_y=<?=$item['h_y']?>"><i class="fa fa-print"></i> Чопи транскрипт</a>
																
																<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=print&action=vkladish&id_student=<?=$item['id_student']?>&id_s_l=<?=$item['id_s_l']?>"><i class="fa fa-print"></i> Чопи замимаи диплом</a>
																
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id_student']?>" data-name="<?=$item['fullname_tj']?>" 
																	data-id-nt="<?=$group_info[0]['id_nt']?>" data-id-s_l="<?=$group_info[0]['id_s_l']?>" 
																	class="dropdown-item waves-light waves-effect diplominfo" href="javascript:">
																	<i class="fa fa-plus"></i> Пуркунии маълумоти диплом
																</a>
																
																<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=print&action=listok&id_student=<?=$item['id_student']?>"><i class="fa fa-print"></i> Чопи варақаи шахсӣ</a>
																
																<!--
																<?php if(!$item['archive']):?>
																	<a target="_blank" class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=print&action=tabel_student&id_student=<?=$item['id_student']?>&s_y=<?=S_Y?>&h_y=<?=H_Y?>"><i class="fa fa-print"></i> Чопи табел</a>
																<?php endif;?>
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-print"></i> Чопи варақаи қарздорӣ</a>
																-->
																
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id_student']?>" data-name="<?=$item['fullname_tj']?>" data-s_y="<?=$item['s_y']?>" data-h_y="<?=$item['h_y']?>"
																	class="dropdown-item waves-light waves-effect student_info" href="javascript:">
																	<i class="fa fa-info"></i> Маълумотнома
																</a>
																
																<a target = "_blank" href="<?=MY_URL?>?option=print&action=farmonhoi_student&id_student=<?=$item['id_student']?>"
																	class="dropdown-item waves-light waves-effect">
																	<i class="fa fa-info"></i> Фармонҳо
																</a>
																
																<a data-toggle="modal" data-target=".bs-example-modal-lg" 
																data-id-student="<?=$item['id_student']?>" 
																data-id-spec="<?=$item['id_spec']?>" 
																data-id-s-l="<?=$item['id_s_l']?>" 
																data-id-s-v="<?=$item['id_s_v']?>" 
																data-name="<?=$item['fullname_tj']?>" data-foreign="<?=$item['foreign']?>"
																	class="dropdown-item waves-light waves-effect student_shartnoma" href="javascript:">
																	<i class="fa fa-bank"></i> Иловакунии расид
																</a>
																
																<?php if(isset($_SESSION['user']['admin'])):?>
																	<?php if(empty($shurbo_info)):?>
																		<a href="<?=MY_URL?>?option=students&action=set_ijozat&id_student=<?=$item['id_student']?>"
																			class="dropdown-item waves-light waves-effect">
																			<i class="fa fa-lock"></i> Иҷозат дода нашавад
																		</a>
																	<?php else:?>
																		<a href="<?=MY_URL?>?option=students&action=set_ijozat&id_student=<?=$item['id_student']?>"
																			class="dropdown-item waves-light waves-effect">
																			<i class="fa fa-unlock"></i> Иҷозат дода шавад
																		</a>
																	<?php endif;?>
																<?php endif;?>
																
																<!--
																<?php if($item['id_s_t'] == 1):?>
																	<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id_student']?>" data-name="<?=$item['fullname_tj']?>"
																		class="dropdown-item waves-light waves-effect student_shartnona" href="javascript:">
																		<i class="fa fa-bank"></i> Иловакунии расид
																	</a>
																<?php endif;?>
																-->
																
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id_student']?>" data-name="<?=$item['fullname_tj']?>"
																	class="dropdown-item waves-light waves-effect student_edit" href="javascript:">
																	<i class="fa fa-edit"></i> Таҳриркунӣ
																</a>
																
																<?php if(!$item['archive']):?>
																	<a class="dropdown-item waves-light waves-effect" href="<?=MY_URL?>?option=students&action=list&id_faculty=<?=$item['id_faculty']?>&id_s_l=<?=$item['id_s_l']?>&id_s_v=<?=$item['id_s_v']?>&id_course=<?=$item['id_course']?>&id_spec=<?=$item['id_spec']?>&id_group=<?=$item['id_group']?>#student_<?=$item['id_student']?>">
																		<i class="fa fa-mortar-board"></i> Гузариш ба гурӯҳ
																	</a>
																	<!--
																	<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-unlock"></i> Маҳкамкунӣ</a>
																	-->
																<?php endif;?>
																
																<div class="dropdown-divider"></div>
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-trash"></i> Хориҷкунӣ</a>
															</div>
														</div>
														
													</td>
												</tr>
											<?php endforeach;?>
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
		
		
		$('.sessions_results').on('click', function(){
			
			var id_student = $(this).attr("data-id-student");
			var id_nt = $(this).attr("data-id-nt");
			var id_course = $(this).attr("data-id-course");
			var id_s_v = $(this).attr("data-id-s-v");
			var name = $(this).attr("data-name");
			
			var s_y = $(this).attr("data-s_y");
			var h_y = $(this).attr("data-h_y");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getimtinfo";?>';
			
			$('.modal-dialog').css("max-width", "90%");
			$('.modal-title').text("Натиҷаи имтиҳонҳо: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_nt": id_nt, "id_student": id_student, "id_course": id_course, "id_s_v": id_s_v, "s_y": s_y, "h_y": h_y, "my_url": my_url},
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
		//Маълумотҳои диплом
		$('.diplominfo').on('click', function(){
			
			var id_student = $(this).attr("data-id-student");
			var id_s_l = $(this).attr("data-id-s_l");
			var name = $(this).attr("data-name");
						
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getAddDiplomInfo";?>';
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Иловакунии маълумотҳои дипломи " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "id_s_l": id_s_l, "my_url": my_url},
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
		
		//Маълумотҳои диплом
		
		$('.student_info').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			var s_y = $(this).attr("data-s_y");
			var h_y = $(this).attr("data-h_y");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getstudentinfo";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Маълумотнома: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "s_y": s_y, "h_y": h_y, "my_url": my_url},
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
		
		
		/* ШАРТОНОМА */
		$('.student_shartnoma').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var id_spec = $(this).attr("data-id-spec");
			var id_s_l = $(this).attr("data-id-s-l");
			var id_s_v = $(this).attr("data-id-s-v");
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
		
		
		$('.student_edit').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getstudenteditform";?>';
			
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
		
	});
</script>
