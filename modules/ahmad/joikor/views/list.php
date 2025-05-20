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
							Шуъбаи дуюм
						</li>
						<li class="breadcrumb-item">
							<?=getFaculty($id_faculty)?>
						</li>
						<li class="breadcrumb-item">
							<?=getStudyView($id_s_v)?>
						</li>
						<li class="breadcrumb-item">
							<?=getCourse($id_course)?>
						</li>
						<li class="breadcrumb-item">
							<?=getSpecialtyCode($id_spec)?>
						</li>
						<li class="breadcrumb-item">
							<?=getGroup2($id_group)?>
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
									<h5>Донишҷӯён</h5>
								</div>
								<div class="card-block">
									
									
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th class="image">Расм</th>
												<th class="left">Ному насаб</th>
												<th>Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = $mans = $shartmona = $buja = $kvota = 0;?>
											
											<?php $std_array = [];?>
											<?php foreach($students as $item):?>
											
												<tr id="student_<?=$item['id']?>">
													
													<th scope="row"><?=++$counter?>.</th>
													
													<td>
														<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo']);?>
														<img class="img-circle profile_img imguser" src="<?=$photo;?>">
													</td>
													
													<td class="left">
														<?=$item['fullname_tj']?> > <?=$item['id']?>
														
														<?php if($item['vazi_oilavi'] > 1):?>
															<br>
															<span class="text-c-red bold">
																<i><?=getVaziOilavi($item['vazi_oilavi'])?></i>
															</span>
														<?php endif;?>
													</td>											
													<td>
														<div class="dropdown-inverse dropdown open">
															<button class="btn btn-inverse dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
																<i class="fa fa-cogs"></i> Амалҳо
															</button>
															<div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
															
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																	class="dropdown-item waves-light waves-effect student_edit" href="javascript:">
																	<i class="fa fa-plus"></i> Иловакунии ҷои кор
																</a>
		
															</div>
														</div>
													</td>
												</tr>
											<?php endforeach;?>
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


<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.student_edit').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudenteditform";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Иловакунии ҷои кор " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
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
