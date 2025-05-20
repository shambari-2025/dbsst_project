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
							Маълумотномаи ман
						</li>
						
						<li class="breadcrumb-item">
							<?=getStudyYear(S_Y)?>
						</li>
						
						<li class="breadcrumb-item">
							Нимсолаи <?=(H_Y)?>
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
						
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>Маълумотнома</h5>
								</div>
								<div class="card-block">
									
									
									
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
		
		function loadinfo(){
			var id_student = <?=$_SESSION['user']['id']?>;
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getstudentinfo";?>';
			
			$('.card-block').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "my_url": my_url},
				beforeSend: function(){
					$('.card-block .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('.card-block .load').remove();
					$('.card-block').append(data);
				}
			});
			//$('#bigmodal').html("");
		}
		
		loadinfo();
	});
</script>
