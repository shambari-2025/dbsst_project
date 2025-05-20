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
							  <?=$page_info['title'];?>
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
										<?php $study_years = query("SELECT DISTINCT(`s_y`) FROM `farqiyatho` ORDER BY `s_y` DESC");?>
										<?php foreach($study_years as $sy):?>
											<?php $id_sy  = $sy['s_y'];?>
											<?php $half_years = query("SELECT DISTINCT(`h_y`) FROM `farqiyatho` WHERE `s_y`='$id_sy' ORDER BY `h_y` DESC");?>
											<?php foreach($half_years as $hy):?>
												<?php $id_hy = $hy['h_y'];?>
												<?php $students = query("SELECT * FROM `farqiyatho` WHERE `s_y`='$id_sy' AND `h_y`='$id_hy' ORDER BY status ASC");?>
												<h3 class="center">Руйхати фарқиятҳо аз нимсолаи <?=$id_hy?>, соли таҳсили <?=getStudyYear($id_sy)?></p>

												<?php $i=1;?>
												<?php if($students):?>
														<table class="table">
															<thead class="center">
																<tr style="background-color: #263544; color: #fff">
																	<td>№</td>
																	<td>Ному насаби донишҷӯ</td>
																	<td style="width: 30px">Маблағ</td>
																	<td style="width: 20%">Амалҳо</td>
																</tr>
															</thead>
															<tbody class="center">
															<?php foreach($students as $item):?>
																<tr>
																	<td><?=$i;?>.</td>
																	<td style="text-align: left;"><?=getUserName($item['id_student'])?><!--[<?=$item['id_student']?>]--></td>
																	<td>
																		<?php
																			$id_student = $item['id_student'];
																			$money = query("SELECT SUM(`money`) as `moneys` FROM `farqiyatho_content` WHERE `id_farqiyat`='{$item['id']}'");
																			echo round($money[0]['moneys'],2);
																		?>
																	</td>
																	<td class="elements">
																			<a target="_blank" href="<?=MY_URL?>?option=print&action=farqiyat_ariza&id_farqiyat=<?=$item['id']?>" title="Чопи аризаи фарқият">
																			<i class="fa fa-print"></i>
																			</a>
																		<?php if($item['status'] == 0):?>
																			Иҷозат надорад!
																			<a href="<?=MY_URL?>?option=students&action=ijozati_farqiyat&id_farqiyat=<?=$item['id']?>" title="Барои супоридани фарқиятҳо иҷозат дода шавад">
																				<i class="fa fa-check"></i>
																			</a>
																			
																		<?php else:?>
																			Иҷозат дорад!
																			<a href="<?=MY_URL?>?option=students&action=ijozati_farqiyat&id_farqiyat=<?=$item['id']?>" title="Барои супоридани фарқиятҳо иҷозат дода нашавад">
																				<i class="fa fa-times"></i>
																			</a>
																			
																		<?php endif;?>
																	</td>
																</tr>
																<?php $i++;?>
															<?php endforeach;?>
															</tbody>
														</table>
												<?php endif;?>
											
											<?php endforeach;?>
										<?php endforeach;?>
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
