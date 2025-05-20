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
							<?=getFaculty($id_faculty)?>
						</li>
						<li class="breadcrumb-item">
							<?=getStudyLevel($id_s_l)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getStudyView($id_s_v)?>
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
						
						<div class="col-xl-12 col-md-12">
							
							<div class="card">
								<div class="card-header">
									<h5>Руйхати нақшаҳои таълими</h5>
								</div>
								<div class="card-block">
									
									
									<div class="card-header p-b-0" style="padding: 0px">
										<ul class="nav nav-tabs md-tabs" role="tablist">
											
											<?php $counter = 0;?>
											<?php foreach($S_Y_FOR_NT as $item):?>
												<li class="nav-item">
													<a class="nav-link <?php if($counter == 0){ echo "active";}?>" data-toggle="tab" href="#s_y_<?=$item['soli_tasdiq']?>" role="tab"><?=$item['soli_tasdiq']?></a>
													<div class="slide"></div>
												</li>
												<?php $counter++;?>
											<?php endforeach;?>
										</ul>
									</div>
									
									<div class="card-block tab-content p-t-20" style="padding: 20px 0">
										
										<?php $counter = 0;?>
										<?php foreach($S_Y_FOR_NT as $item):?>
											
											<div class="tab-pane fade <?php if($counter == 0){ echo "show active";}?>" id="s_y_<?=$item['soli_tasdiq']?>" role="tabpanel">
												<div class="generic-card-body">
													
													<?php $content = query("SELECT * FROM `nt_list` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `soli_tasdiq` = '".$item['soli_tasdiq']."'");?>
													
													
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
																	<th>Амалҳо</th>
																</tr>
															</thead>
															<tbody class="center">
																<?php $counter = 0;?>
																<?php foreach($content as $item):?>
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
																		<td>
																			<!--Cохтани иқтибос-->
																			<a href="<?=MY_URL;?>?option=nt&action=deletent&id_nt=<?=$item['id'];?>" title="Нест кардани нақшаи таълимӣ"><i class="fa fa-trash"></i> </a>	
																		</td>
																	</tr>
																<?php endforeach;?>
															</tbody>
														</table>
													</div>
													
												</div>
											</div>
											<?php $counter++;?>
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
</div>



<script type="text/javascript">
	
	jQuery(document).ready(function($){
		
		/* ШАРТОНОМА */
		$('.student_shartnoma').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var id_spec = <?=$id_spec?>;
			var id_s_l = <?=$id_s_l?>;
			var id_s_v = <?=$id_s_v?>;
			var name = $(this).attr("data-name");
			var foreign = $(this).attr("data-foreign");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getShartnomaForm";?>';
			
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
	

</script>