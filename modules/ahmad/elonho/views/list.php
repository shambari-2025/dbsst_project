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
							Эълонҳо
						</li>
						
						<li class="breadcrumb-item">
							Руйхат
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
						
						<?php foreach($elonho as $elon):?>
							<div class="col-xl-12 col-md-12">
								<div class="card">
									<div class="card-header">
										<h5><?=$elon['title']?></h5>
									</div>
									<div class="card-block">
										<?=$elon['text']?>
										
										<hr>
										<table style="width: 100%">
											<tr>
												<td>
													Муаллиф: <b><?=getUserName($elon['author'])?></b>
												</td>
												<td>
													<p>&nbsp;</p>
												</td>
												<td>
													Илова шуд: <b><?=formatdate($elon['add_date'])?></b>
												</td>
												<td>
													<p>&nbsp;</p>
												</td>
												<td>
													Ба ки: <b><?=$elon_type[$elon['type']]?></b>
												</td>
												<?php if(isset($_SESSION['user']['admin'])):?>
													<td>
														<p>&nbsp;</p>
													</td>
													<td class="elements center" style="">
														<a href="<?=MY_URL?>?option=elonho&action=edit&id=<?=$elon['id']?>"><i class="fa fa-edit"></i></a>
														<a href="<?=MY_URL?>?option=elonho&action=delete&id=<?=$elon['id']?>" onclick="return confirmDel()"><i class="fa fa-trash"></i></a>
													</td>
												<?php endif;?>
											</tr>
										</table>
									</div>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	jQuery(document).ready(function($){
		$('.rating_access').on('click', function(){
			var id = $(this).attr("data-id");
			var status = $(this).attr("data-status");
			var field = $(this).attr("data-field");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=rating_access";?>';
			
			
			if(status == 1) {
				set = 0;
				addclass_name = 'fa-lock';
				remclass_name = 'fa-unlock';
			}else{
				set = 1;
				addclass_name = 'fa-unlock';
				remclass_name = 'fa-lock';
			}
			
			$.ajax({
				type: 'post',
				url: url,
				data: {"id": id, "field": field, "set": set},
				success: function(data){
					
				}
			});
			
			if(status == 1) {
				$(this).attr('data-status', set);
			}else{
				$(this).attr('data-status', set);
			}
			
			$(this).find("i").removeClass(remclass_name);
			$(this).find("i").addClass(addclass_name);
			
		});
		
		
		$('.table').on("change", ".test_edit", function () {
			var imt_type = $(this).val();
			var id = $(this).attr("data-id-test");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=UpdateType";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "imt_type": imt_type},
				success: function(data){
					
				}
			});
			
		});
		
		
		$('.table').on("change", ".test_edit_date", function () {
			var datetime = $(this).val();
			var id = $(this).attr("data-id-test");
			var field = $(this).attr("data-field");
			
			console.log(datetime);
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=UpdateDate";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "field": field, "datetime": datetime},
				success: function(data){
					
				}
			});
			
		});
		
		$('.table').on("change", ".test_type_edit", function () {
			var test_type = $(this).val();
			var id = $(this).attr("data-id-test");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=UpdateTestType";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "test_type": test_type},
				success: function(data){
					
				}
			});
			
		});
		
		$('.status').on('click', function(){
			var id = $(this).attr("data-id");
			var status = $(this).attr("data-status");
			
			console.log(id);
			console.log(status);
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=status";?>';
			
			
			if(status == 1) {
				set = 0;
				addclass_name = 'fa-lock';
				remclass_name = 'fa-unlock';
			}else{
				set = 1;
				addclass_name = 'fa-unlock';
				remclass_name = 'fa-lock';
			}
			
			$.ajax({
				type: 'post',
				url: url,
				data: {"id": id, "set": set},
				success: function(data){
					
				}
			});
			
			if(status == 1) {
				$(this).attr('data-status', set);
			}else{
				$(this).attr('data-status', set);
			}
			
			$(this).find("i").removeClass(remclass_name);
			$(this).find("i").addClass(addclass_name);
			
		});
	
	
	
		$('.edit_test').on('click', function(){
			var id = $(this).attr("data-id");
			
			$('.modal-dialog').css("max-width", "60%");
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
		
		$('.statistic_test').on('click', function(){
			var id_fan = $(this).attr("data-id");
			
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Нишондоди саволнома");
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=statisticTest";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_fan": id_fan, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
	});
</script>
