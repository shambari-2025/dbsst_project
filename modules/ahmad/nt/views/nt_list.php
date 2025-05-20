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
							Нақшаҳои таълимӣ
						</li>
						<li class="breadcrumb-item">
							<?=getFacultyShort($id_faculty)?>
						</li>
						<li class="breadcrumb-item">
							<?=getStudyView($id_s_v)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=($soli_tasdiq)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getStudyLevel($id_s_l)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getSpecialtyCode($id_spec)?>
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
						
						
						<div class="col-xl-6 col-md-6">
							<div class="card">
								<div class="card-header">
									<h5>Маълумотнома</h5>
								</div>
								<div class="card-block">
									
									<button data-toggle="modal" data-target=".bs-example-modal-lg"
										class="btn waves-effect waves-light btn-inverse nt_content" type="button">
										<i class="fa fa-plus"></i> Иловакунии фанҳо ба нақша
									</button>
									
									<button data-toggle="modal" data-target=".bs-example-modal-lg"
										class="btn waves-effect waves-light btn-inverse upload_content" style="float: right" type="button">
										<i class="fa fa-upload"></i> Боркунии нақша (.xlsx)
									</button>
									<br>
									<br>
									<button data-toggle="modal" data-target=".bs-example-modal-lg" 
										class="add_fan btn btn-inverse waves-effect waves-light" type="button">
											<i class="fa fa-plus"></i> Иловакунии фанни нав
										</a>
									</button>
									
									<p>&nbsp;</p>
									<div class="table-responsive davrifaol">
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th style="width:50px">№</th>
													<th>Курс</th>
													<th>Ҳолат</th>
													<th>Иқтибос</th>
													<th>Ним. 1</th>
													<th>Ним. 2</th>
													<th>Амал</th>
												</tr>
											</thead>
											
											<tbody class="center">
												<?php if(!empty($groups)):?>
													<?php $counter = 0;?>
													<?php foreach($groups as $item):?>
														<tr>
															<th scope="row"><?=++$counter?>.</th>
															<td class="left"><?=getCourse($item['id_course'])?></td>
															
															<td>
																<?php $iq_isset = query("SELECT `id` FROM `iqtibosho` WHERE `id_nt` = '$id_nt'AND `id_course` = '{$item['id_course']}'");?>
																
																<?php if(!empty($iq_isset)):?>
																	<?php $status = query("SELECT * FROM `iqtibosho` WHERE `id_nt` = '$id_nt'
																	AND `id_course` = '{$item['id_course']}' AND `id_departament` IS NULL AND `s_y` = '".S_Y."'");
																	?>
																	<?php if(empty($status)):?>
																		<span class="bold text-c-green">Пурра</span>
																	<?php else:?>
																		<span class="bold text-c-red">Но пурра</span>
																	<?php endif;?>
																<?php else:?>
																	<span class="bold text-c-red">надорад!</span>
																<?php endif;?>
															</td>
															
															<td class="elements">
																<a class="edit_iqtibos" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id-course="<?=$item['id_course']?>" title="Таҳриркунӣ">
																	<i class="fa fa-edit"></i>
																</a>
															</td>
															
															<td>
																<?php $semestr = getSemestr($item['id_course'], 1);?>
																<?=count_summa_where('iqtibosho', 'credits', "`id_nt` = '$id_nt' AND `semestr` = '$semestr'")?>
															</td>
															<td>
																<?php $semestr = getSemestr($item['id_course'], 2);?>
																<?=count_summa_where('iqtibosho', 'credits', "`id_nt` = '$id_nt' AND `semestr` = '$semestr'")?>
															</td>
															
															<td class="elements">
																
																<a href="<?=MY_URL?>?option=nt&action=update_iqtibos&id_nt=<?=$id_nt?>&id_course=<?=$item['id_course']?>" title="Синхронкунии нақша ба фанҳо">
																	<i class="fa fa-refresh"></i>
																</a>
																
															</td>
														</tr>
													<?php endforeach;?>
												<?php else:?>
													<tr>
														<td colspan="3"><i class="fa fa-warning"></i> Маълумот нест.</td>
													</tr>
												<?php endif;?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-6 col-md-6">
							<div class="card">
								<div class="card-header">
									<h5>Дигар нақшаҳои таълимии соли <?=$soli_tasdiq?></h5>
								</div>
								<div class="card-block">
									
									<div class="table-responsive davrifaol">
									<table class="table" style="font-size:14px">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th>№</th>
												<th>ID<br>NT</th>
												<th>Нақшаи таълимӣ</th>
												<th><div class="vertical">Кредитҳо</div></th>
												<th>Рамзи<br>ихтисос</th>
												<th><div class="vertical">Миқдори<br>гурӯҳ</div></th>
												<th>Зинаи<br>таҳсил</th>
												
											</tr>
										</thead>
										<tbody class="center">
											<?php $counter = 0;?>
											<?php foreach($other_nts as $item):?>
												<tr>
													<th scope="row"><?=++$counter?>.</th>
													<th scope="row"><?=$item['id']?></th>
													<td class="left">
														<a href="<?=MY_URL?>?option=nt&action=nt_list&id_nt=<?=$item['id']?>">Соли тасдиқ <?=$item['soli_tasdiq']?></a>
													</td>
													<td>
														<?=getCredits($item['id'])?>
													</td>
													<td><span title="<?=getSpecialtyTitle($item['id_spec'])?>"><?=getSpecialtyCode($item['id_spec'])?></span></td>
													<td>
														<?php $res = query("SELECT COUNT(DISTINCT(`id_course`)) as `groups` FROM `std_study_groups` WHERE `id_nt` = '".$item['id']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");?>
														<?=$res[0]['groups']?>
													</td>
													<td><?=getStudyLevel($item['id_s_l'])?></td>
													
												</tr>
											<?php endforeach;?>
										</tbody>
									</table>
								</div>
								</div>
							</div>
						</div>
						
						<?php foreach($semestrs as $item):?>
							<?php $semestr = $item['semestr']?>
							<div class="col-xl-12 col-md-12">
								<div class="card">
									<div class="card-header">
										<h5>Cеместри <?=$semestr?> (Курси <?=getCourseBySemestr($semestr)?>)</h5>
									</div>
									<div class="card-block">
										
										
										<div class="table-responsive davrifaol">
											<table class="table" style="font-size:14px">
												<thead class="center">
													<tr style="background-color: #263544; color: #fff">
														<th style="width:70px">№</th>
														<th style="width:70px">ID<br>ФАН</th>
														<th style="width:450px">Номгӯи фанҳо</th>
														<th style="width:70px">КУ</th>
														<th style="width:70px">КФУ</th>
														<th style="width:70px">КА</th>
														<th style="width:70px">КМРО</th>
														<th style="width:70px">КМД</th>
														<th style="width:150px">Амалҳо</th>
													</tr>
												</thead>
												<tbody class="center">
													<?php $content = query("SELECT * FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$semestr' ORDER BY `intixobi`, `id_fan`");?>
													<?php //print_arr($content);?>
													<?php if(!empty($content)):?>
													
														<?php $counter = 0;?>
														<?php foreach($content as $item):?>
															<tr>
																<th scope="row"><?=++$counter?>.</th>
																<th scope="row"><?=$item['id_fan']?></th>
																<td class="left <?php if($item['k_k']){ echo "bold";}?>">
																	
																	<?php if($item['intixobi']):?>
																		<span class="red">(Интихобӣ)</span>
																	<?php endif;?>
																	
																	<?=getFanTest($item['id_fan'])?>
																	
																	<?php if($item['k_k']):?>
																		<br><i>(кори курсӣ)</i>
																	<?php endif;?>
																</td>
																<td><?=$item['c_u']?></td>
																<td><?=$item['c_f_u']?></td>
																<td><?=$item['c_a']?></td>
																<td><?=$item['cmro']?></td>
																<td><?=$item['cmd']?></td>
																
																<td class="elements">
																	<?=$item['id']?>
																	<a class="edit_nt_content" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$item['id']?>" title="Таҳриркунӣ">
																		<i class="fa fa-edit"></i>
																	</a>
																	<a href="<?=MY_URL;?>?option=nt&action=deletefan&id_ntcontent=<?=$item['id'];?>"><i class="fa fa-trash"></i> </a>
																</td>
															</tr>
														<?php endforeach;?>
														
														<tr class="bold">
															<td></td>
															<td></td>
															<td>Ҷамъ дар семестри <?=$semestr?></td>
															<td>
																<?php $res = query("SELECT SUM(`c_u`) as `c_u` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$semestr' ");?>
																<?=$res[0]['c_u']?>
															</td>
															
															<td>
																<?php $res = query("SELECT SUM(`c_f_u`) as `c_f_u` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$semestr' ");?>
																<?=$res[0]['c_f_u']?>
															</td>
															
															<td>
																<?php $res = query("SELECT SUM(`c_a`) as `c_a` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$semestr' ");?>
																<?=$res[0]['c_a']?>
															</td>
															
															<td>
																<?php $res = query("SELECT SUM(`cmro`) as `cmro` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$semestr' ");?>
																<?=$res[0]['cmro']?>
															</td>
															
															<td>
																<?php $res = query("SELECT SUM(`cmd`) as `cmd` FROM `nt_content` WHERE `id_nt` = '$id_nt' AND `semestr` = '$semestr' ");?>
																<?=$res[0]['cmd']?>
															</td>
														</tr>
													<?php else: ?>
														<tr class="center bold">
															<td colspan="9">
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
							
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.edit_iqtibos').on('click', function(){
			var id_course = $(this).attr("data-id-course");
			var id_nt = '<?=$id_nt?>';
			
			$('.modal-dialog').css("max-width", "95%");
			$('.modal-title').text("Иқтибос");
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=editIqtibosForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_nt": id_nt, "id_course": id_course, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					//$('#bigmodal').append(data);
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		
		$('.edit_nt_content').on('click', function(){
			var id = $(this).attr("data-id");
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Таҳриркунӣ");
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=editContentForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					//$('#bigmodal').append(data);
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		
		$('.nt_content').on('click', function(){
			
			var id_nt = <?=$id_nt?>;
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Иловакунии фанҳо");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=addForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_nt": id_nt, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					//$('#bigmodal').append(data);
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		$('.upload_content').on('click', function(){
			
			var id_nt = <?=$id_nt?>;
			
			var spec = '<?=getSpecialtyCode($id_spec)?>';
			
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Боркунии нақшаи таълимӣ: " + spec);
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=uploadForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_nt": id_nt, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					//$('#bigmodal').append(data);
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		$('.add_fan').on('click', function(){
			
			
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Иловакунии фани нав");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=addFan";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					//$('#bigmodal').append(data);
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
	});
</script>
