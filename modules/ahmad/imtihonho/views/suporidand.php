<style>
	td, th {
		padding: 6px
	}
</style>
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
							<?=$page_info['title']?>
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
						
						
						
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>
										<?=$page_info['title']?>
									</h5>
								</div>
								<div class="card-block" >
									
									<table style="width: 100%">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th style="width: 50px">№</th>
												<th>Факултет</th>
												<th>Зинаи<br>таҳсил</th>
												<th>Намуди<br>таҳсил</th>
												<th>Курс</th>
												<th>Ихтисос</th>
												<th>Донишҷӯ</th>
												<th>Фан</th>
												<th>Шакли<br>имтиҳон</th>
												<th>Сана</th>
											</tr>
										</thead>
										<tbody class="center">
											<?php $counter = 0;?>
											<?php foreach($datas as $item):?>
												<tr>
													<td><?=++$counter?>.</td>
													<td><?=$item['faculty_short']?></td>
													<td><?=$item['study_level_title']?></td>
													<td><?=$item['study_view_title']?></td>
													<td><?=$item['id_course']?></td>
													<td><?=$item['spec_code']?> <?=$item['group_title']?></td>
													<td><?=$item['fullname_tj']?></td>
													<td><?=$item['fan_title']?></td>
													<td><?=$imt_types[$item['imt_type']]?></td>
													<td><?=$item['imt_add_date']?></td>
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
		
		// Иловакунии саволнома
		$('.add_questions').on('click', function(){
			var id_fan = $(this).attr("data-id-fan");
			var title = $(this).attr("data-title");
			
			
			
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Иловакунии саволнома: " + title);
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/questions/questions_ajax.php?option=add_form";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_fan": id_fan, "s_y": s_y, "h_y": h_y, "my_url": my_url},
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
