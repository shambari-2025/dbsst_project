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
									<h5><?=$page_info['title']?></h5>
								</div>
								
								<div class="card-block">
									<button data-toggle="modal" data-target=".bs-example-modal-lg"
										class="btn waves-effect waves-light btn-inverse add_detail" type="button">
										<i class="fa fa-plus"></i> Иловакунии маълумот
									</button>
									<p>&nbsp;</p>
									
									
									<table class="table" style="font-size: 14px !important; width: 100%">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th style="width: 50px" class="counter">№</th>
												<th>Рамзи<br>ихтисос</th>
												<th class="left">Номи ихтисос</th>
												<th>Зинаи<br>таҳсил</th>
												<th>Шакли<br>таҳсил</th>
												<th>Намуди<br>таҳсил</th>
												<th>Маблағи<br>таҳсил</th>
												<th>Барои<br>шаҳрвандони<br>хориҷӣ</th>
												<th>Забони<br>таҳсил</th>
												<th>Нақша</th>
												<th style="width:100px">Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center">
											<?php $counter = 0;?>
											<?php foreach($naqsha_details as $item):?>
												<tr>
													<td class="center"><?=++$counter?>.</td>
													<td><?=getSpecialtyCode($item['id_spec'])?></td>
													<td class="left"><?=getSpecialtyTitle($item['id_spec'])?></td>
													<td><?=getStudyLevel($item['id_s_l'])?></td>
													<td><?=getStudyView($item['id_s_v'])?></td>
													<td><?=getStudyType($item['id_s_t'])?></td>
													<td>
														<?php if(!empty($item['money'])):?>
															<?=$item['money']?>
														<?php endif;?>
													</td>
													
													<td>
														<?php if(!empty($item['money_other'])):?>
															<?=$item['money_other']?>
														<?php endif;?>
													</td>
													<td><?=getLang($item['lang'])?></td>
													<td><?=$item['plan']?></td>
													<td class="elements">
														<a title="Таҳриркунӣ" class="edit_item" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$item['id']?>">
															<i class="fa fa-edit"></i>
														</a>
														
														<a href="<?=MY_URL?>?option=naqsha&action=deleteitem&id=<?=$item['id']?>" title="Несткунӣ" onclick="return confirmDel()">
															<i class="fa fa-trash"></i>
														</a>
														
													</td>
												</tr>
											<?php endforeach;?>
											<tr class="bold">
												<td colspan="9"></td>
												<td><?=count_summa_where('qabul_plan_detail', "plan", "`id_qabul_plan` = '$id'")?></td>
											</tr>
											
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
		
		
		$('.add_detail').on('click', function(){
			
			var id = <?=$id?>;
			
			$('.modal-dialog').css("max-width", "70%");
			$('.modal-title').text("Иловакунии ихтисос ба нақша");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=addForm";?>';
			
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
