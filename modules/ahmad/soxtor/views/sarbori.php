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
							Сарборӣ
						</li>
						<li class="breadcrumb-item">
							<?=getDepartament($id_departament)?>
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
									<h5>Руйхати фанҳо</h5>
								</div>
								<div class="card-block">
									<!--<button data-toggle="modal" data-target=".bs-example-modal-lg" class="add btn btn-inverse waves-effect waves-light" type="button" style="float: right">
										<a data-toggle="modal" data-target=".bs-example-modal-lg" class="add davrifaol" href="javascript:">
											<i class="fa fa-plus"></i> Иловакунӣ
										</a>
									</button>
									<div style="clear:both"></div>
									<hr>
									-->
									<h4 class="center">Тақсимкунии соатҳо барои кафедраи "<?=getDepartament($id_departament)?>"</h4>
									
									<p>Миқдори умумии кредитҳо: <span class="bold"><?=$all_credits?></span></p>
									<p>Кредитҳои тақсимшуда: <span class="bold"><?=$taqsimshuda?></span></p>
									<p>Кредитҳои тақсимношуда: <span class="bold"><?=$all_credits - $taqsimshuda?></span></p>
									<br>
									
									<div class="table-responsive davrifaol">
										
										<?php 
											function getTypes($array){
												
												$new_arr = [];
												
												if($array['loihai_kursi']){
													$new_arr['loihai_kursi'] = $array['loihai_kursi'];
												}
												if($array['kori_kursi']){
													$new_arr['kori_kursi'] = $array['kori_kursi'];
												}
												if($array['lk_plan']){
													$new_arr['lk_plan'] = $array['lk_plan'];
												}
												
												/*
												if($array['am_plan']){
													$new_arr['am_plan'] = $array['am_plan'];
												}
												*/
												
												if($array['tajrib_pesh_a_d']){
													$new_arr['tajrib_pesh_a_d'] = $array['tajrib_pesh_a_d'];
												}
												
												if($array['zerguruhho'] == 2){
													if($array['ozm_plan']){
														$new_arr['ozm_plan_2'] = $array['ozm_plan'];
													}else{
														$new_arr['am_plan_2'] = $array['am_plan'];
													}
													
												}
												
												//$keys = array_keys(array_filter($item,function($value) { return !is_null($value) && $value !== ''; }));
												return $new_arr;
											}
										?>
										
										<style>
											.table1 tbody tr:nth-of-type(odd) {
												background-color: rgba(0,0,0,.05);
											}
										</style>
										
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th style="width:70px">№</th>
													<th style="width:220px">Номгӯи фанн</th>
													<th><div class="vertical">Курс</div></th>
													<th><div class="vertical">Семестр</div></th>
													<th>Дараҷаи<br>таҳсил</th>
													<th>Шакли<br>таҳсил</th>
													<th><div class="vertical">Факулта</div></th>
													<th style="width: 150px">Гурӯҳ</th>
													<th>ШД</th>
													<!--<th style="width:100px">Намуд</th>-->
													<th><div class="vertical">Кредит</div></th>
													<th><div class="vertical">Соатбайъ</div></th>
													<th>Омӯзгор</th>
												</tr>
											</thead>
											<tbody class="center">
												<?php if(!empty($fan_list)):?>
												
													<?php $counter = 1; ?>
													<?php foreach($fan_list as $item):?>
														<?php $spec_list = $group_list = [];?>
														
														<tr <?php if($counter % 2 == 0):?> style="background-color: rgba(0,0,0,.05);" <?php endif;?>>
															<th scope="row"><?=$counter?>. <?=$item['id']?></th>
															<td ><?=($item['title_tj'])?></td>
															<td ><?=$item['id_course']?></td>
															<td ><?=$item['semestr']?></td>
															<td ><?=($item['s_l_title'])?></td>
															<td ><?=($item['s_v_title'])?></td>
															<td ><?=($item['faculty_short'])?></td>
															<td >
															<?=($item['spec_code'])?> <?=($item['group_title'])?>
															<?php $spec_list[] = $item['id_spec']?>
															<?php $group_list[] = $item['id_group']?>
															
															<?php $childs = query("SELECT * FROM `iqtibosho` WHERE `parent_group` = '{$item['id']}'");?>
															<?php foreach($childs as $child):?>
																<?php $spec_list[] = $child['id_spec']?>
																<?php $group_list[] = $child['id_group']?>
																<br><?=getSpecialtyCode($child['id_spec'])?> <?=getGroup($child['id_group'])?>
															<?php endforeach;?>
															</td>
															<td >
																<?php $id_specs = implode(",", $spec_list);?>
																<?php $id_groups = implode(",", $group_list);?>
																
																<?=$stds = count_table_where("students", "
																`status` = '1' AND 
																`id_faculty` = '{$item['id_faculty']}' AND 
																`id_s_l` = '{$item['id_s_l']}' AND 
																`id_s_v` = '{$item['id_s_v']}' AND 
																`id_course` = '{$item['id_course']}' AND 
																`id_spec` IN ($id_specs) AND 
																`id_group` IN ($id_groups) AND 
																`s_y` = '".S_Y."'");?>
																
																
															</td>
															
															<td><?=$item['credits']?></td>
															<td>
																<input <?php if($item['soatbay'] == 1):?>checked<?php endif;?> type="checkbox" name="soatbay" id="soatbay" class="soatbay" value="<?=$item['id']?>">
															</td>
															<td class="elements">
																
																<?php if($item['semestr'] % 2 != 0):?>
																	<?=$item['fullname_tj']?>
																<?php else:?>
																	<select name="teacher" id="teacher"
																		data-id-iqtibos="<?=$item['id']?>" 
																		data-lesson-type="lk_plan"
																		data-lesson-soat="<?=$item['lk_soat']?>"
																		
																		class="sarbori form-control">
																		<option value="">-Омӯзгорро интихоб кунед-</option>
																		<?php foreach($teachers as $teacher): ?>
																			<option <?php if(getTeacherByIq($item['id'], 'lk_plan') == $teacher['id']):?>selected<?php endif;?> value="<?=$teacher['id'];?>"><?=$teacher['fullname_tj']; ?></option>
																		<?php endforeach; ?>
																	</select>
																<?php endif;?>
																
																<?php if(!empty($item['kori_kursi']) || !empty($item['loihai_kursi'])):?>
																	<br>
																	<a href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																	data-id-iqtibos="<?=$item['id']?>" 
																	data-id-departament="<?=$id_departament?>" 
																	data-soat="<?=$item['kori_kursi']?>" 
																	data-nomi-fan="<?=$item['title_tj']?>" 
																	data-text="Кори курсӣ"
																	data-students="<?=$stds?>"
																	data-type-kk="kori_kursi"
																		class="kori_kursi" title="Тақсимоти соатҳои кори курсӣ">
																		<i class="fa fa-bars"></i>
																	</a>
																	<?php
																		$soat_kk = query("SELECT `kori_kursi` FROM `iqtibosho` WHERE `id` = '{$item['id']}'");																		
																		$kk_taqsimshuda = query("SELECT SUM(`soat`) as `soat_kk`  FROM `sarboriho` WHERE `id_iqtibos` = '{$item['id']}' AND `type` = 'kori_kursi'");
																	?>
																	<?php if($soat_kk[0]['kori_kursi'] - $kk_taqsimshuda[0]['soat_kk'] > 0):?>
																		<i class="fa fa-minus" title="Тақсим нашудааст"></i>
																	<?php else:?>
																		<i class="fa fa-check" title="Тақсим шудаанд"></i>
																		<a href="<?=MY_URL;?>?option=soxtor&action=clean_kk&id_iqtibos=<?=$item['id']?>&type_kk=<?=$value;?>">Несткунӣ</a>
																	<?php endif?>
																	
																<?php endif;?>
																
															</td>
																
														</tr>
														
														<?php $counter++;?>
													<?php endforeach;?>
												<?php else: ?>
													<tr class="center bold">
														<td colspan="4">
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
		
		$('.table').on("change", ".sarbori", function () {
			var id_teacher = $(this).val();
			//var id_fan = $(this).attr("data-id-fan");
			var id_iqtibos = $(this).attr("data-id-iqtibos");
			var lesson_type = $(this).attr("data-lesson-type");
			var lesson_soat = $(this).attr("data-lesson-soat");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/soxtor/soxtor_ajax.php?option=insertSarbori";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				//data: {"id_fan": id_fan, "id_departament": id_departament},
				data: {"id_teacher": id_teacher, "id_iqtibos": id_iqtibos, "lesson_type": lesson_type, "lesson_soat": lesson_soat},
				success: function(data){
					console.log(data);
				}
			});
			
		});
		
		$('.soatbay').on('click', function (){
			var id = $(this).val();
			
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=setSoatbay";?>';
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id},
				
				success: function(data){
					console.log(data);
					console.log("success");
				}
			});
		});
		
		$('.kori_kursi').on('click', function(){
			var id_iqtibos = $(this).attr("data-id-iqtibos");
			var id_departament = $(this).attr("data-id-departament");
			var soatho = $(this).attr("data-soat");
			var nomifan = $(this).attr("data-nomi-fan");
			var text = $(this).attr("data-text");
			var type_kk = $(this).attr("data-type-kk");
			var students = $(this).attr("data-students");
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=gettaqsimotikkform";?>';
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Тақсимоти соатҳои "+ text +" барои фанни " + nomifan);
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_iqtibos": id_iqtibos, "id_departament": id_departament, "soatho": soatho, "text": text, "type_kk": type_kk, "students": students, "my_url": my_url},
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
