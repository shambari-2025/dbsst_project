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
							Сохтани аризаи фарқият ва фанҳои он
						</li>
						<li class="breadcrumb-item">
							<?=getUserName($id_student);?>
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
							
							
							
							<!-- FANHO -->
							
							<div class="card">
								<div class="card-header">
									<!--<h5>Барои сохтани ариза ва фанҳои фарқият аз руйхат ихтисоси пешинаи донишҷӯро интихоб намоед!</h5>
									<h5>Агар донишҷӯ аз дигар МТОК интиқол шуда бошад, аз рӯйхат "Бе ихтисос" интихоб намоед.</h5>-->
									<h5>Барои сохтани фарқият тугмаи "Сохтан"-пахш намоед</h5>
								</div>
								<div class="card-block">
									<div class="table-responsive davrifaol">
										<!--<label>Ихтисосро интихоб кунед:</label>
										<select name="specialty" id="specialty" required class="form-control">
											<option value="" selected disabled> - Интихоб кунед - </option>
											<option value="-1">Бе ихтисос</option>
											<?php foreach($specs as $item): ?>
												<option value="<?=$item['id_nt']?>"><?=getSpecialtyCode($item['id_spec'])?>-<?=getSpecialtyTitle($item['id_spec'])?>(<?=getStudyView($item['id_s_v'])?>)</option>
											<?php endforeach; ?>
										</select>-->
										<br>
										<button data-toggle="modal" data-target=".bs-example-modal-lg"
										data-id-student="<?=$id_student?>" data-name="<?=getUserName($id_student)?>"
										class="btn waves-effect waves-light btn-inverse create_raznitsa" type="button">
										Сохтан
										</button>
										
										<br>
										<?php $i=1;?>
										<?php if($ariza):?>
												<table class="table">
													<thead class="center">
														<tr style="background-color: #263544; color: #fff">
															<td>№</td>
															<td>Соли таҳсил</td>
															<td>Нимсола</td>
															<td>Амалҳо</td>
														</tr>
													</thead>
													<tbody class="center">
													<?php foreach($ariza as $a):?>
														<tr>
															<td><?=$i;?>.</td>
															<td><?=getStudyYear($a['s_y'])?></td>
															<td><?=$a['h_y']?></td>
															<td class="elements">
																<a target="_blank" href="<?=MY_URL?>?option=print&action=farqiyat_ariza&id_farqiyat=<?=$a['id']?>" title="Чопи аризаи фарқият">
																	<i class="fa fa-print"></i>
																</a>
																<a target="_blank" href="<?=MY_URL?>?option=print&action=farqiyat_vedomost&id_student=<?=$id_student?>&id_farqiyat=<?=$a['id']?>" title="Чопи варақаи фарқият">
																	<i class="fa fa-print"></i>
																</a>
																<a target="_blank" href="<?=MY_URL?>?option=print&action=farqiyat_vedomosti_pur&id_student=<?=$id_student?>&id_farqiyat=<?=$a['id']?>" title="Чоп ведомости баҳои фарқият">
																	<i class="fa fa-print"></i>
																</a>
																<!--<?php if($a['status'] == 0):?>
																	<a href="<?=MY_URL?>?option=students&action=ijozati_farqiyat&id_farqiyat=<?=$a['id']?>" title="Барои супоридани фарқиятҳо иҷозат дода шавад">
																		<i class="fa fa-check"></i>
																	</a>
																<?php else:?>
																	<a href="<?=MY_URL?>?option=students&action=ijozati_farqiyat&id_farqiyat=<?=$a['id']?>" title="Барои супоридани фарқиятҳо иҷозат дода нашавад">
																		<i class="fa fa-times"></i>
																	</a>
																<?php endif;?>-->
																<a href="<?=MY_URL?>?option=students&action=delete_farqiyat&id_farqiyat=<?=$a['id']?>" title="Несткунӣ">
																	<i class="fa fa-trash"></i>
																</a>
															</td>
														</tr>
													<?php endforeach;?>
													</tbody>
												</table>
										<?php endif;?>
									</div>
								</div>
							</div>
							
							<!-- FANHO -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	jQuery(document).ready(function($){
		$('.create_raznitsa').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			//var id_spec = $(this).attr("data-spec");
			var id_spec = $("#specialty").val();
			var name = $(this).attr("data-name");
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentraznitsaform";?>';
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Сохтани фарқият: " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "id_spec": id_spec,  "my_url": my_url},
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
