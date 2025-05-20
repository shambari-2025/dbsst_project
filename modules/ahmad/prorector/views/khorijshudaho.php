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
							
							
							<div class="card">
								<div class="card-header">
									<h5>Донишҷӯёни хориҷшуда</h5>
								</div>
								<div class="card-block">
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th class="image">Расм</th>
												<th class="counter">ID</th>
												<th class="center">Ному насаб</th>
												<th class="left">Шакли<br>таҳсил</th>
												<th class="left">Намуди<br>таҳсил</th>
												<th>Курс</th>
												<th>Ихтисос</th>
												<th>Гуруҳ</th>
												<th>Соли<br>хориҷшавӣ</th>
												<th>Нимсолаи<br>хориҷшавӣ</th>
												<th>Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = 0;?>												
											<?php foreach($students as $item):?>
												<tr id="student_<?=$item['id']?>">
													<th scope="row"><?=++$counter?>.</th>
													
													<td>
														<?php $photo = getUserImg($item['id_student'], $item['jins'], $item['photo']);?>
														<a target="_blank" href="<?=$photo?>"><img class="img-circle profile_img imguser" src="<?=$photo;?>"></a>
													</td>
													<th scope="row"><?=$item['id_student']?></th>
													<td class="left" title=" аз <?=date('d.m.Y', strtotime($item['farmon_date']))."\n".$item['farmon_text']."\n Масъул: ".getUserName($item['author'])?>">
														<?=$item['fullname_tj']?>
													</td>
													<td><?=getStudyLevel($item['id_s_l'])?></td>
													<td><?=getStudyView($item['id_s_v'])?></td>
													<td><?=$item['id_course']?></td>
													<td><?=getSpecialtyCode($item['id_spec'])?></td>
													<td><?=getGroup($item['id_group'])?></td>
													<td><?=getStudyYear($item['s_y'])?></td>
													<td><?=$item['h_y']?></td>
													
													
													<td>
														<div class="dropdown-inverse dropdown open">
															<button class="btn btn-inverse dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
																<i class="fa fa-cogs"></i> Амалҳо
															</button>
															<div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
											
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id_student']?>" data-name="<?=$item['fullname_tj']?>"
																	class="dropdown-item waves-light waves-effect student_info" href="javascript:">
																	<i class="fa fa-info"></i> Маълумотнома
																</a>
																<?php if(isset($_SESSION['user']['admin'])):?>
																	<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fullname_tj']?>"
																		class="dropdown-item waves-light waves-effect student_edit" href="javascript:">
																		<i class="fa fa-edit"></i> Таҳриркунӣ
																	</a>
																<?php endif;?>
																<div class="dropdown-divider"></div>
																<a data-toggle="modal" data-target=".bs-example-modal-lg" 
																	data-id-student="<?=$item['id_student']?>" 
																	data-name="<?=$item['fullname_tj']?>" 
																	data-sy-xorij="<?=$item['s_y']?>" 
																	data-hy-xorij="<?=$item['h_y']?>"
																	class="dropdown-item waves-light waves-effect restore_student" href="javascript:">
																	<i class="fa fa-undo"></i> Барқароркунӣ
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
		
		$('.student_info').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentinfo";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Маълумотнома: " + name);
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		$('.student_edit').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudenteditform";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Таҳриркунӣ: " + name);
			
			
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
		
		$('.restore_student').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var name = $(this).attr("data-name");
			var sy_xorij = $(this).attr("data-sy-xorij");
			var hy_xorij = $(this).attr("data-hy-xorij");
			console.log(name);
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentrestoreform";?>';
			
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Барқароркунии " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "sy_xorij":sy_xorij, "hy_xorij":hy_xorij, "my_url": my_url},
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
