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
							Донишҷӯён
						</li>
						<li class="breadcrumb-item">
							Омор
						</li>
						<?php if(isset($id_faculty)):?>
							<li class="breadcrumb-item">
								<?=getFaculty($id_faculty)?>
							</li>
						<?php endif;?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					
					
					<div class="card proj-progress-card">
						<div class="card-header">
							<h5>
								Нишондоди курсҳо
								<?php if(!isset($id_faculty)):?>
									дар донишгоҳ
								<?php else:?>
									дар факултети «<?=getFaculty($id_faculty)?>»
								<?php endif;?>
							</h5>
						</div>
						<div class="card-block">
							
							<table border="0" style="width:50%">
								<tr>
									<td>аз</td>
									<td>
										<input value="<?=date("Y-m-d", time())?>" class="form-control fill" type="date" name="date_start" id="date_start">
									</td>
									<td>&nbsp;&nbsp;</td>
									<td>то</td>
									<td>
										<input value="<?=date("Y-m-d", time())?>" class="form-control fill" type="date" name="date_finish" id="date_finish">
									</td>
									
									<td>&nbsp;&nbsp;</td>
									<td>
										<button class="btn waves-effect waves-light btn-inverse loaddata" type="button" style="padding: 6px 10px;">
											<i class="fa fa-search"></i> Ҷустуҷу
										</button>
									</td>
								</tr>
							</table>
							<br>
							<br>
							
							
							<div id="fordatas">
								<?php include("statistic_data.php");?>
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
			
			var date_start = $("#date_start").val();
			var date_finish = $("#date_finish").val();
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getDatas";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"date_start": date_start, "date_finish":date_finish, "my_url": my_url},
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