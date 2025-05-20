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
							Гузоштани баҳо ба қарздории академии донишҷӯён (ТРИМЕСТР)
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
									<h5>Руйхати донишҷӯёни дорои қарздории академӣ</h5>
								</div>
								<div class="card-block">
									<?php $study_years = query("SELECT DISTINCT(`s_y`) FROM `trimestr_content`
																	WHERE `id_teacher`='{$_SESSION['user']['id']}' AND
																		`trimestr_content`.`status` = '0' AND `imt_type`!='1'
																");
									?>
									<?php foreach($study_years as $sy):?>
										<?php 
											$sy = $sy['s_y'];
											$half_years = query("SELECT DISTINCT(`h_y`) FROM `trimestr_content`
																	WHERE `id_teacher`='{$_SESSION['user']['id']}' AND
																		`trimestr_content`.`status` = '0' AND 
																		`imt_type`!='1' AND
																		`trimestr_content`.`s_y` = '$sy'
																	ORDER BY `h_y` DESC
																");
										?>
										<?php foreach($half_years as $hy):?>
											<?php
												$hy = $hy['h_y'];
												$students = query("SELECT DISTINCT(`trimestr`.`id_student`), `trimestr`.`s_y`, `trimestr`.`h_y` FROM `trimestr` INNER JOIN `trimestr_content`
																		ON `trimestr`.`id`=`trimestr_content`.`id_trimestr`
																	INNER JOIN `students` 
																		ON `trimestr`.`id_student` = `students`.`id_student` AND
																			`trimestr`.`s_y` = `students`.`s_y` AND
																			`trimestr`.`h_y` = `students`.`h_y`
																	WHERE `id_teacher`='{$_SESSION['user']['id']}' AND 
																		`trimestr_content`.`status`='0' AND 
																		`imt_type` != '1'  AND 
																		`trimestr`.`s_y` = '$sy' AND 
																		`trimestr`.`h_y` = '$hy' AND
																		`students`.`status` = '1'
																 ");
											?>
											<?php if($students):?>
												<h3 class="center">Соли таҳсили <?=getStudyYear($sy)?>, Нимсолаи <?=$hy?></h3>
												<table class="table">
													<thead class="center">
														<tr style="background-color: #263544; color: #fff">
															<td>№</td>
															<td>Ному насаб</td>
															<td>Факултет</td>
															<td>Курс</td>
															<td>Ихтисос<br>Гуруҳ</td>
															<td>Амалҳо</td>
														</tr>
													</thead>
													<tbody class="center">
													<?php $i=1;?>
													<?php// print_arr($students);?>
													<?php foreach($students as $s):?>
															<?php// print_arr($students);?>
															<?php
																$info_std=query("SELECT * FROM `students` WHERE `status` = '1' AND `id_student` = '{$s['id_student']}' AND `s_y` = '{$s['s_y']}' AND `h_y` = '{$s['h_y']}'");
																$id_faculty=$info_std[0]['id_faculty'];
																$id_s_l=$info_std[0]['id_s_l'];
																$id_s_v=$info_std[0]['id_s_v'];
																$id_course=$info_std[0]['id_course'];
																$id_spec=$info_std[0]['id_spec'];
																$id_group=$info_std[0]['id_group'];
															?>
														<tr>
															<td><?=$i;?>.</td>
															<td style="text-align: left;"><?=getUserName($s['id_student'])?></td>
															<td><?=getFaculty($id_faculty)?></td>
															<td><?=getCourse($id_course)?></td>
															<td><?=getSpecialtyCode($id_spec).getGroup($id_group)?></td>
															<td class="elements">													
																<button data-toggle="modal" data-target=".bs-example-modal-lg"
																	data-id-student="<?=$s['id_student']?>" data-id-teacher="<?=$_SESSION['user']['id']?>"  data-name="<?=getUserName($s['id_student'])?>"
																	data-sy="<?=$s['s_y']?>" data-hy="<?=$s['h_y']?>"
																	class="btn waves-effect waves-light btn-inverse trimestr_score" type="button">
																	Гузоштани баҳо
																</button>													
															</td>
														</tr>
														<?php $i++;?>
													<?php endforeach;?>
													</tbody>
												</table>
												<br><br>
											<?php endif;?>
										<?php endforeach;?>
									<?php endforeach;?>
									
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
		$('.trimestr_score').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var id_teacher = $(this).attr("data-id-teacher");
			var name = $(this).attr("data-name");
			var s_y = $(this).attr("data-sy");
			var h_y = $(this).attr("data-hy");
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentscoretrimestr";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Гузоштани баҳо ба қарздории академии " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "id_teacher": id_teacher, "s_y": s_y, "h_y": h_y,  "my_url": my_url},
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