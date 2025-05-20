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
							Қомиссияи қабул
						</li>
						<li class="breadcrumb-item">
							Шартномасупорӣ
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
									<h5>Шартномасупорӣ</h5>
								</div>
								<div class="card-block">
									
									<div class="table-responsive davrifaol">
										<table class="table" style="font-size: 14px !important">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th>№</th>
													<th>Номи факултет</th>
													<th>Шартномасупор</th>
													<th>Маблағи шартнома</th>
													<th>Маблағи ҷамъоварда</th>
													<th>Қарздорӣ</th>
												</tr>
											</thead>
											<tbody class="center" id="tbody">
												<?php $h_sharnomasupor = $h_m_sh = $h_jamshud = $h_qarz = $counter = 0;?>
												<?php foreach($faculties as $item):?>
													<tr class="center">
														<th><?=++$counter?>.</th>
														<td class="left">
															<?=$item['title']?>
														</td>
														<td>
															<?php $h_sharnomasupor+= $sharnomasupor =count_table_where("students", "`status` = '-1' AND `id_faculty` = '{$item['id']}' AND `id_s_t` = '1' AND `s_y` = '".S_Y."'");?>
															<?=$sharnomasupor;?>
														</td>
														<td>
															<?php $h_m_sh += $hamagi_mablagh = MablaghCQ($item['id'], S_Y);?>
															<?=$hamagi_mablagh;?>
														</td>
														<td>
															<?php $h_jamshud += $jamshud_mablagh = MablaghCQJamovarda($item['id'], S_Y);?>
															<?=$jamshud_mablagh;?>
														</td>
														<td>
															<?php $h_qarz += $h_q = $hamagi_mablagh - $jamshud_mablagh;?>
															<?=$h_q;?>
														</td>
													</tr>
												<?php endforeach;?>
												
												<tr class="center bold">
													<td colspan="2">Ҳамагӣ:</td>
													<td><?=$h_sharnomasupor?></td>
													<td><?=$h_m_sh?></td>
													<td><?=$h_jamshud?></td>
													<td><?=$h_qarz?></td>
												
												</tr>
											</tbody>
										</table>
									</div>
									<?php 
										function MablaghCQ($id_faculty, $S_Y){
											$datas = query("SELECT * FROM `students` WHERE `status` = '-1' AND `id_faculty` = '$id_faculty' AND `id_s_t` = '1' AND `s_y` = '$S_Y'");
											$sum = 0;
											foreach($datas as $item){
												$sum += getSharnomaMoneyBySY($item['id_course'], $item['id_spec'], $item['id_s_l'], $item['id_s_v'], $S_Y, $item['foreign']);
											}
											
											return $sum;
										}
										
										function MablaghCQJamovarda($id_faculty, $S_Y){
											$datas = query("SELECT * FROM `students` WHERE `status` = '-1' AND `id_faculty` = '$id_faculty' AND `id_s_t` = '1' AND `s_y` = '$S_Y'");
											$sum = 0;
											foreach($datas as $item){
												$id_student = $item['id_student'];
												$sum += getMoneyShartnoma($id_student, $S_Y);
											}
											
											return $sum;
										}
									
									?>
									
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
		
		$('.loaddata').on('click', function(){
			
			var from_date = $("#from_date").val();
			var to_date = $("#to_date").val();
			
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getDatas";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"from_date": from_date, "to_date": to_date},
				beforeSend: function(){
					$('#fordatas').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#fordatas img').hide();
					$('#fordatas').html(data);
				}
			});
		});
		
		
	});
</script>
