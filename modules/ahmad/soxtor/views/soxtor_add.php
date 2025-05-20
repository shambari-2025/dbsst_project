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
							Сохтор
						</li>
						<li class="breadcrumb-item">
							Иловакунии сохтор 
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
						<!-- Large modal -->
						
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>Иэрархияи сохтори донишгоҳ</h5>
								</div>
								<div class="card-block">
									<!--<button data-toggle="modal" data-target=".bs-example-modal-lg" class="add btn btn-inverse waves-effect waves-light" type="button" style="float: right">
										<a data-toggle="modal" data-target=".bs-example-modal-lg" class="add davrifaol" href="javascript:">
											<i class="fa fa-plus"></i> Иловакунӣ
										</a>
									</button>-->
									<div style="clear:both"></div>
									<hr>
									<div class="table-responsive davrifaol">
										<!--PHP Script-->
										<form action="<?=MY_URL?>?option=soxtor&action=soxtor_insert" method="POST">
											<?php// print_arr($info);?>
											<table>
												<tr>
													<td><label name="name">Ном: </label></td>
													<td><input type="text" name="name"></td>
												</tr>
												<tr>
													<td><label name="name_short_tj">Номи кутоҳ(тоҷикӣ): </label></td>
													<td><input type="text" name="name_short_tj"></td>
												</tr>
												<tr>
													<td><label name="name_short_ru">Номи кутоҳ(русӣ): </label></td>
													<td><input type="text" name="name_short_ru"></td>
												</tr>
												<tr>
													<td><label name="name_full_tj">Номи пурра(тоҷикӣ): </label></td>
													<td><input type="text" name="name_full_tj"></td>
												</tr>
												<tr>
													<td><label name="name_full_ru">Номи пурра(русӣ): </label></td>
													<td><input type="text" name="name_full_ru"></td>
												</tr>
												<tr>
													<td><label name="detail_tj">Detail(тоҷикӣ): </label></td>
													<td><input type="text" name="detail_tj"></td>
												</tr>
												<tr>
													<td><label name="detail_ru">Detail(русӣ): </label></td>
													<td><input type="text" name="detail_ru"></td>
												</tr>
												<tr>
													<td colspan="2">
														<input type="hidden" name="id" value="<?=$id?>">
														<input type="submit" value="Сабткунӣ">
													</td>
												</tr>
											</table>
										</form>
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
		
		$('.add').on('click', function(){
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Иловакунии факултет");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=addForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"file": "facultet_add", "my_url": my_url},
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
		
		$('.edit').on('click', function(){
			var id = $(this).attr("data-id");
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Таҳриркунӣ");
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=editForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"file": "facultet_edit", "id": id, "my_url": my_url},
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
