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
							Гузоштани баҳо ба фарқияти донишҷӯён
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
									<h5>Руйхати донишҷӯёни дорои фарқияти академӣ</h5>
								</div>
								<div class="card-block">
									<?php if($students):?>
										<table class="table">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<td>№</td>
													<td>Ному насаби донишҷӯ</td>
													<td>Амалҳо</td>
												</tr>
											</thead>
											<tbody class="center">
											<?php $i=1;?>
											<?php foreach($students as $s):?>
												<tr>
													<td><?=$i;?>.</td>
													<td style="text-align: left;"><?=getUserName($s['id_student'])?>.</td>
													<td class="elements">													
														<button data-toggle="modal" data-target=".bs-example-modal-lg"
															data-id-student="<?=$s['id_student']?>" data-id-teacher="<?=$_SESSION['user']['id']?>"  data-name="<?=getUserName($s['id_student'])?>"
															class="btn waves-effect waves-light btn-inverse student_score" type="button">
															Гузоштани баҳо
														</button>													
													</td>
												</tr>
												<?php $i++;?>
											<?php endforeach;?>
											</tbody>
										</table>
									<?php endif;?>
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
		$('.student_score').on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var id_teacher = $(this).attr("data-id-teacher");
			var name = $(this).attr("data-name");
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getstudentscoreraznitsa";?>';
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Гузоштани баҳо ба фарқиятҳои " + name);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "id_teacher": id_teacher,  "my_url": my_url},
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