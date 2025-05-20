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
							Сохтани аризаи триместр ва фанҳои он
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
								</div>
								<div class="card-block">
									<div class="table-responsive davrifaol">
										<?php if($qarzho):?>
												<h5>Барои сохтани триместри донишҷӯ тугмаи "Сохтан"-ро пахш намоед</h5><br>
												<button data-toggle="modal" data-target=".bs-example-modal-lg"
												data-id-student="<?=$id_student?>" data-name="<?=getUserName($id_student)?>"
												data-sy="<?=$S_Y?>" data-hy="<?=$H_Y?>"
												class="btn waves-effect waves-light btn-inverse create_trimestr" type="button">
												Сохтан
												</button>
												
												
										<?php else:?>
											<h5>Донишҷӯ қарзи академӣ надорад ё аллакай қарзҳоро супоридааст!!!</h5>
										<?php endif;?>
											<Br>
											<Br>
											<Br>
											<table class="table">
												<thead class="center">
													<tr style="background-color: #263544; color: #fff">
														<td>№</td>
														<td>Санаи сохтани ариза</td>
														<td>Аризаро сохт</td>
														<td>Соли таҳсил</td>
														<td>Нимсола</td>
														<td>Маблағ</td>
														<td>Пардохт</td>
														<td>Амалҳо</td>
													</tr>
												</thead>
												<tbody class="center">
												<?php $i=1;?>
												<?php foreach($ariza as $a):?>
													<tr>
														<td><?=$i;?>.</td>
														<td><?=formatDate($a['date'])?></td>
														<td><?=getUserName($a['author'])?></td>
														<td><?=getStudyYear($a['s_y'])?></td>
														<td><?=$a['h_y']?></td>
														<td><?=$a['money']?></td>
														<td>
															<?php
																$from_date = $a['date'];
																$dateTime = new DateTime($from_date);
																$dateTime->add(new DateInterval('P30D'));
																$to_date = $dateTime->format('Y-m-d H:i:s');
																$summa_suporid = count_summa_where("rasidho", "check_money", "id_student = '$id_student' AND type = '3' AND payed = '1' ");
																if($summa_suporid >= $a['money']){
																	echo "<p style='color: green;'> ПАРДОХТШУДА</p>";
																	echo $summa_suporid;
																}else{
																	echo "<p style='color: red;'> ПАРДОХТНАШУДА</p>";
																}
															?>
														</td>
														<td class="elements">
															<a target="_blank" href="<?=MY_URL?>?option=print&action=trimestr_ariza&id_trimestr=<?=$a['id']?>&s_y=<?=$a['s_y']?>&h_y=<?=$a['h_y']?>" title="Чопи аризаи триместр">
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
															<a href="<?=MY_URL?>?option=students&action=delete_trimestr&id_trimestr=<?=$a['id']?>" title="Несткунӣ">
																<i class="fa fa-trash"></i>
															</a>
														</td>
													</tr>
													<?php $i++;?>
												<?php endforeach;?>
												</tbody>
											</table>
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
		$('.create_trimestr').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var s_y = $(this).attr("data-sy");
			var h_y = $(this).attr("data-hy");
			var name = $(this).attr("data-name");
			
			// console.log(name);
			// console.log(id_student);
			// console.log(s_y);
			// console.log(h_y);
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudenttrimestrform";?>';
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Сохтани аризаи триместр барои " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "s_y": s_y,  "h_y": h_y, "my_url": my_url},
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
