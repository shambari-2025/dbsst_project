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
							Фанҳои тақсимношуда
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
									
									<div class="table-responsive davrifaol">
										<!--
										<table class="table" style="font-size:14px">
											<tbody>
												<tr>
													<td rowspan="4">1.</td>
													<td rowspan="4">Технологияҳои информатсионӣ</td>
													<td rowspan="4">1</td>
													<td rowspan="4">1</td>
													<td rowspan="4">Бакалавр</td>
													<td rowspan="4">Рӯзона</td>
													<td rowspan="4">ТИваК</td>
													<td rowspan="4">1-530102А</td>
													<td rowspan="4">26</td>
													<td>Кори курсӣ</td>
													<td>1</td>
													<td>сб</td>
													<td>2597</td>
												</tr>
												<tr>
													<td>Лексия</td>
													<td>2</td>
													<td>сб</td>
													<td></td>
												</tr>
												<tr>
													<td>Кори озмоишӣ</td>
													<td>3</td>
													<td>Сб</td>
													<td></td>
												</tr>
												<tr>
													<td>Кори амалӣ</td>
													<td>4</td>
													<td>сб</td>
													<td></td>
												</tr>
											</tbody>
										</table>-->
										
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
												if($array['ozm_plan']){
													$new_arr['ozm_plan'] = $array['ozm_plan'];
												}
												if($array['am_plan']){
													$new_arr['am_plan'] = $array['am_plan'];
												}
												if($array['sm_plan']){
													$new_arr['sm_plan'] = $array['sm_plan'];
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
													<th>Факулта</th>
													<th>Гурӯҳ</th>
													<th>ШД</th>
													<th>Намуд</th>
													<th>Соат</th>
													<th>Соатбайъ</th>
													<th>Омӯзгор</th>
												</tr>
											</thead>
											<tbody class="center">
												<?php if(!empty($fan_list)):?>
												
													<?php $counter = 1; ?>
													<?php foreach($fan_list as $item):?>
														<?php $id_departament = $item['id_departament'];?>
														
														<?php $teachers = query("SELECT * FROM `users` WHERE `id` IN 
														(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` = '$id_departament' AND `s_y` = '".S_Y."')
														ORDER BY `fullname_tj`");
														?>
														<?php $DaTa = getTypes($item);?>
														
														<tr <?php if($counter % 2 == 0):?> style="background-color: rgba(0,0,0,.05);" <?php endif;?>>
															<th rowspan="<?=count($DaTa)?>" scope="row"><?=$counter?>. <?=$item['id']?></th>
															<td rowspan="<?=count($DaTa)?>"><?=getFanTest($item['id_fan'])?></td>
															<td rowspan="<?=count($DaTa)?>"><?=$item['id_course']?></td>
															<td rowspan="<?=count($DaTa)?>"><?=$item['semestr']?></td>
															<td rowspan="<?=count($DaTa)?>"><?=getStudyLevel($item['id_s_l'])?></td>
															<td rowspan="<?=count($DaTa)?>"><?=getStudyView($item['id_s_v'])?></td>
															<td rowspan="<?=count($DaTa)?>"><?=getFacultyShort($item['id_faculty'])?></td>
															<td rowspan="<?=count($DaTa)?>"><?=getSpecialtyCode($item['id_spec'])?><?=getGroup2($item['id_group'])?></td>
															<td rowspan="<?=count($DaTa)?>">
																<?=count_table_where("students", "`status` = '1' AND `id_faculty` = '{$item['id_faculty']}' AND `id_s_l` = '{$item['id_s_l']}' AND `id_s_v` = '{$item['id_s_v']}' AND `id_course` = '{$item['id_course']}' AND `id_spec` = '{$item['id_spec']}' AND `id_group` = '{$item['id_group']}'");?>
															</td>
															
															<?php $l = 0;?>
															<?php foreach($DaTa as $value => $key):?>
																<?php if($l == 1):?> <?php break;?><?php endif;?>
																<td>
																	<?=$dars_namud[$value]?>
																</td>
																<td><?=$item[$value]?></td>
																<td>сб</td>
																<td>
																	
																	<?php if($value == 'kori_kursi' || $value == 'loihai_kursi'):?>
																		кори курси
																	<?php else:?>
																		<select name="teacher" id="teacher"
																			data-id-iqtibos="<?=$item['id']?>" 
																			data-lesson-type="<?=$value?>"
																			data-lesson-soat="<?=$item[$value]?>"
																			class="sarbori form-control">
																			<option value="">-Омӯзгорро интихоб кунед-</option>
																			<?php foreach($teachers as $teacher): ?>
																				<option <?php if(getTeacherByIq($item['id'], $value) == $teacher['id']):?>selected<?php endif;?> value="<?=$teacher['id'];?>"><?=$teacher['fullname_tj']; ?></option>
																			<?php endforeach; ?>
																		</select>
																	<?php endif;?>
																</td>
																<?php $l++?>
															<?php endforeach;?>
														</tr>
														<?php $l = 0;?>
														
														<?php array_shift($DaTa);?>
														<?php foreach($DaTa as $value => $key):?>
															<tr <?php if($counter % 2 == 0):?> style="background-color: rgba(0,0,0,.05);" <?php endif;?>>
																<td><?=$dars_namud[$value]?></td>
																<td><?=$item[$value]?></td>
																<td>сб</td>
																<td>
																	<?php if($value != 'kori_kursi' || $value != 'loihai_kursi'):?>
																		<select name="teacher" id="teacher"
																			data-id-iqtibos="<?=$item['id']?>" 
																			data-lesson-type="<?=$value?>"
																			data-lesson-soat="<?=$item[$value]?>"
																			class="sarbori form-control">
																			<option value="">-Омӯзгорро интихоб кунед-</option>
																			<?php foreach($teachers as $teacher): ?>
																				<option <?php if(getTeacherByIq($item['id'], $value) == $teacher['id']):?>selected<?php endif;?> value="<?=$teacher['id'];?>"><?=$teacher['fullname_tj']; ?></option>
																			<?php endforeach; ?>
																		</select>
																	<?php endif;?>
																</td>
															</tr>
														<?php endforeach;?>
														
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
	});
</script>
