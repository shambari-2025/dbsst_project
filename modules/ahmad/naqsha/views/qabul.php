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
							Нақшаҳои қабул
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
									<h5>Нақшаҳои қабул</h5>
								</div>
								
								<div class="card-block">
									<button data-toggle="modal" data-target=".bs-example-modal-lg"
										class="btn waves-effect waves-light btn-inverse add" type="button">
										<i class="fa fa-plus"></i> Иловакунӣ
									</button>
									<p>&nbsp;</p>
									
									<table class="table" style="font-size: 14px !important; width: 100%">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th style="width: 50px" class="counter">№</th>
												<th class="left">Номгуйи нақшаҳо</th>
												<th>Амалҳо</th>
											</tr>
										</thead>
										<tbody >
											<?php $counter = 0;?>
											<?php foreach($list as $item):?>
												<tr>
													<td class="center"><?=++$counter?>.</td>
													<td>
														<a href="<?=MY_URL?>?option=naqsha&action=detail&id=<?=$item['id']?>">
															<?=$item['title']?> <?=getStudyYear($item['s_y'])?>
														</a>
													</td>
													<td></td>
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
		
		
		$('.add').on('click', function(){
			
			$('.modal-dialog').css("max-width", "50%");
			$('.modal-title').text("Иловакунии нақшаи қабул");
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=add";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					//$('#bigmodal').append(data);
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		
		$('.edit_detail').on('click', function(){
			var id = $(this).attr("data-id");
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Таҳриркунӣ");
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=editForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					//$('#bigmodal').append(data);
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
	});
</script>