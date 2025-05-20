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
							Руйхати хатмкунандагон
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
									<h5>Хатмкунандагон</h5>
								</div>
								<div class="card-block">
									<style>
										.letters {
											font-size: 18px;
											float: left;
											border: 1px solid;
											margin: 6px;
											text-align: center;
											padding: 4px 12px;
										}
										
										
									</style>
									<div style="text-align: center">
										<a href="<?=MY_URL?>?option=bugalteria&action=list_bugalteria">
											<div class="letters">Ҳама</div>
										</a>
										<?php foreach($alphabet as $item):?>
											<a href="<?=MY_URL?>?option=bugalteria&action=list_bugalteria&letter=<?=$item?>">
											<div class="letters">
												<?=$item?>
											</div>
											</a>
										<?php endforeach;?>
										<div style="clear: both"></div>
									</div>
									
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th class="counter">ID - донишҷӯ</th>
												<th class="left">Ному насаб</th>
												<th>Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $std_counter = 0;?>
											<?php foreach($students as $item):?>
												<tr>
													<th scope="row"><?=++$std_counter?>.</th>
													<th scope="row"><?=$item['id']?>.</th>
													<td class="left">
														<?=$item['fio']?>
													</td>
													
													<td>
														<div class="dropdown-inverse dropdown open">
															<button class="btn btn-inverse dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
																<i class="fa fa-cogs"></i> Амалҳо
															</button>
															<div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
																<!--
																<a data-toggle="modal" data-target=".bs-example-modal-lg" data-id-student="<?=$item['id']?>" data-name="<?=$item['fio']?>" 
																	class="dropdown-item waves-light waves-effect student_shartnoma" href="javascript:">
																	<i class="fa fa-bank"></i> Сохтани расид
																</a>
																-->
															</div>
														</div>
													</td>
												</tr>
											<?php endforeach;?>
										</tbody>
									</table>
									
									<?php if(!isset($_REQUEST['letter'])):?>
										<div class="text-center">
											<?php $url = MY_URL."?option=bugalteria&action=list_bugalteria";?>
											<?php pagination($url, $page, $count_all, $perpage, 10, '&');?>
										</div>
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
		/* ШАРТОНОМА */
		$('.student_shartnoma').on('click', function(){
			var id_student = $(this).attr("data-id-student");
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
	});
</script>

