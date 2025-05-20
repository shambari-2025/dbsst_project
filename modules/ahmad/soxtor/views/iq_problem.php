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
							Фанҳои бе Кафедра
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
						
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>Фанҳои бе Кафедра</h5>
								</div>
								<div class="card-block">
									
									<div class="table-responsive davrifaol">
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th style="width:70px">№</th>
													<th style="width:70px">ID_IQ</th>
													<th>Номгӯи фанҳо</th>
													<th>Семестр</th>
													<th>Факултет</th>
													<th>Зинаи таҳсил</th>
													<th>Намуди таҳсил</th>
													<th>Курс</th>
													<th>Ихтисос</th>
													<th>Кафедра</th>
												</tr>
											</thead>
											<tbody class="center">
												<?php if(!empty($iqtibosho)):?>
												
													<?php $counter = 0;?>
													<?php foreach($iqtibosho as $item):?>
														<tr>
															<th scope="row"><?=++$counter?>.</th>
															<th scope="row"><?=$item['id']?></th>
															<td class="left"><?=getFanTest($item['id_fan'])?></td>
															<td scope="row" <?php if($item['semestr'] % 2 != 0):?>class="bold text-c-green"<?php endif;?>>
															
																<?=$item['semestr']?>
															
															</td>
															<td><?=getFacultyShort($item['id_faculty'])?></td>
															<td><?=getStudyLevel($item['id_s_l'])?></td>
															<td><?=getStudyView($item['id_s_v'])?></td>
															<td class="center"><?=$item['id_course']?></td>
															<td><?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?></td>
															<td class="elements">
																<select name="id_departament" id="id_departament" class="id_departament form-control" data-id-fan="<?=$item['id_fan']?>" data-id="<?=$item['id']?>">
																	<option value="">Интихоб кунед!</option>
																	<?php foreach($departaments as $d_item):?>
																		<option <?php if($d_item['id'] == $item['id_departament']):?> selected <?php endif;?> value="<?=$d_item['id'];?>" title="<?=$d_item['title']?>"><?=$d_item['short']?></option>
																	<?php endforeach;?>
																</select>
																
																<!--
																<a class="info" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$item['id']?>"><i class="fa fa-info"></i> </a>
																<a class="edit" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$item['id']?>"><i class="fa fa-edit"></i> </a>
																<a href="#"><i class="fa fa-trash"></i> </a>
																-->
															</td>
														</tr>
													<?php endforeach;?>
												<?php else: ?>
													<tr class="center bold">
														<td colspan="10">
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
		
		$('.davrifaol').on("change", ".id_departament", function () {
			var id_departament = $(this).val();
			//var id_fan = $(this).attr("data-id-fan");
			var id = $(this).attr("data-id");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/nt/nt_ajax.php?option=updateIqtibos";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				//data: {"id_fan": id_fan, "id_departament": id_departament},
				data: {"id": id, "id_departament": id_departament},
				success: function(data){
					console.log("success");
				}
			});
			
		});
	});
</script>
