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
							Коммиссияи қабул
						</li>
						
						<li class="breadcrumb-item">
							Руйхати гуруҳҳо
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
									<h5>Руйхати гуруҳҳо</h5>
								</div>
								<div class="card-block">
									
									
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr class="left">
												<td colspan="2">
													<label for="id_faculty">Факултет:</label>
													<select name="id_faculty" id="id_faculty" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<?php foreach($faculties as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['short_title']?></option>
														<?php endforeach;?>
													</select>
												</td>
												<td>
													<label for="id_s_l">Зинаи таҳсил:</label>
													<select name="id_s_l" id="id_s_l" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<?php foreach($studylevels as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>
												</td>
												<td style="width: 140px">
													<label for="id_s_v">Намуди таҳсил:</label>
													<select name="id_s_v" id="id_s_v" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<?php foreach($studyviews as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>
												</td>
												<td>
													<p>&nbsp;</p>
													<button type="submit" id="search" class="btn btn-inverse waves-effect waves-light" style="padding: 6px 10px;">
														<i class="fa fa-search"></i> Ҷӯстуҷӯ
													</button>
												</td>
											</tr>
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th>Факултет</th>
												<th>Зинаи таҳсил</th>
												<th>Намуди таҳсил</th>
												<th>Рамз</th>
												<th class="left">Номи ихтисос</th>
												<th title="Миқдори донишҷӯ">М.Д.</th>
												<th title="Шартномавӣ">Ш</th>
												<th title="Буҷавӣ">Б</th>
												<th title="Квота">К</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php include("group_list_data.php");?>
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
		$('#search').on('click', function(){
			var id_faculty = $('#id_faculty').val();
			var id_s_l = $('#id_s_l').val();
			var id_s_v = $('#id_s_v').val();
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/commission/commission_ajax.php?option=getGroups";?>';
			
			$('#tbody').html("");
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_l": id_s_l, "id_s_v": id_s_v, "my_url": my_url},
				beforeSend: function(){
					$('#tbody').html('<tr class="img"><td colspan=10><center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center></td></tr>');
				},
				success: function(data){
					$('#tbody tr.img').hide();
					$('#tbody img').hide();
					$('#tbody').append(data);
				}
			});
		});
	});
</script>
