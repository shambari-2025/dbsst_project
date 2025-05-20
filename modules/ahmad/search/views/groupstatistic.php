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
							Омори гурӯҳҳо
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
					
					
					<div class="card proj-progress-card">
						<div class="card-header">
							<h5>
								Нишондоди гурӯҳҳо дар донишгоҳ
							</h5>
						</div>
						<div class="card-block">
							<button class="btn btn-primary waves-effect waves-light" type="button">
								<a class="davrifaol" target="_blank" href="<?=MY_URL?>?option=print&action=statisticingroups<?php if(isset($id_faculty)){ echo "&id_faculty=$id_faculty";}?>&s_y=<?=S_Y?>&h_y=<?=H_Y?>">
									<i class="fa fa-print"></i> Чопи ҷадвал
								</a>
							</button>
							<hr>
							
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
							
							
							
							<div class="table-responsive davrifaol">
								
								<table class="table" style="font-size:14px">
									<thead class="center">
										<tr>
											<th rowspan="2" scope="row" style="width:20px">№</th>
											<th rowspan="2" class="left">Номгуи факултетҳо</th>
											<th rowspan="2"><div class="vertical">Шумораи донишҷӯ</div></th>
											<th rowspan="2"><div class="vertical">Миқдори гурӯҳҳо</div></th>
											<th colspan="2">Шуъбаи <br> Рузона</th>
											<th colspan="2">Шуъбаи <br> Фосилавӣ</th>
										</tr>
										<tr>
											<th><div class="vertical">Шумораи <br> донишҷӯ</div></th>
											<th><div class="vertical">Миқдори <br> гурӯҳ</div></th>
											
											<th><div class="vertical">Шумораи <br> донишҷӯ</div></th>
											<th><div class="vertical">Миқдори <br> гурӯҳ</div></th>
										</tr>
										
									</thead>
									<tbody>
										<?php $counter = 0;?>
										<?php $all_students = $all_groups = $ruz_all_students = $ruz_all_groups = $fos_all_students = $fos_all_groups = 0;?>
										<?php foreach($statistic as $item):?>
											<tr class="center">
												<th scope="row"><?=++$counter?>.</th>
												<td class="left"><?=$item['title']?></td>
												<td class="bold">
													<?php $res = count_table_where("students", "`id_faculty` = '".$item['id_faculty']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
													<?php $all_students += $res;?>
													<?=$res?>
												</td>
												<td>
													<?php $all_groups += $item['allgroups'];?>
													<?=$item['allgroups']?>
												</td>
												<td class="bold">
													<?php $res = count_table_where("students", "`id_faculty` = '".$item['id_faculty']."' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
													<?php $ruz_all_students += $res;?>
													<?=$res?>
												</td>
												<td>
													<?php $ruz_all_groups += $item['ruzona'];?>
													<a href="#" 
													data-id-faculty="<?=$item['id_faculty']?>" 
													data-id-s-v="1" 
													data-toggle="modal" data-target=".bs-example-modal-lg" class="showstatistic">
														<?=$item['ruzona']?>
													</a>
												</td>
												<td class="bold">
													<?php $res = count_table_where("students", "`id_faculty` = '".$item['id_faculty']."' AND `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
													<?php $fos_all_students += $res;?>
													<?=$res?>
												</td>
												<td>
													<?php $fos_all_groups += $item['fosilavi'];?>
													<a href="#" 
													data-id-faculty="<?=$item['id_faculty']?>" 
													data-id-s-v="2" 
													data-toggle="modal" data-target=".bs-example-modal-lg" class="showstatistic">
														<?=$item['fosilavi']?>
													</a>
												</td>
											</tr>
										<?php endforeach;?>
										<tr class="bold center">
											<td></td>
											<td class="left">Ҳамагӣ:</td>
											<td><?=$all_students?></td>
											<td><?=$all_groups?></td>
											<td><?=$ruz_all_students?></td>
											<td><?=$ruz_all_groups?></td>
											<td><?=$fos_all_students?></td>
											<td><?=$fos_all_groups?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
					
					
					
					
					
					
					<div class="card proj-progress-card">
						<div class="card-header">
							<h5>
								Нишондоди гурӯҳҳо дар донишгоҳ дар солҳои таҳсил
							</h5>
						</div>
						<div class="card-block">
							
							<div class="table-responsive davrifaol">
								<table class="table" style="font-size:14px">
									<thead class="center">
										<tr>
											<th rowspan="2" scope="row">№</th>
											<th rowspan="2">Соли таҳсил</th>
											<th rowspan="2">Нимсола</th>
											<th colspan="4">Шумораи донишҷӯён</th>
											<th colspan="3">Миқдори гурӯҳҳо</th>
										</tr>
										<tr>
											<th>Ҳамагӣ</th>
											<th>Рузона</th>
											<th>Фосилавӣ</th>
											<th>Нисбати <br>нимсолаи<br>гузашта</th>
											
											<th>Ҳамагӣ</th>
											<th>Рузона</th>
											<th>Фосилавӣ</th>
										</tr>
									</thead>
									<tbody>
										<?php $counter = 0;?>
										<?php $i = 0;?>
										<?php $datas = []; ?>
										<?php foreach($STUDY_YEARS as $item):?>
											<?php for($nimsola = 1; $nimsola <= 2; $nimsola++):?>
												
												<tr class="center">
													<th scope="row"><?=++$counter?>.</th>
													<td class="left">Соли таҳсилӣ <?=$item['title']?></td>
													<td><?=$nimsola?></td>
													
													<td class="bold">
														<?php $res = count_table_where("students", "`s_y` = '".$item['id']."' AND `h_y` = '$nimsola'")?>
														<?php $datas[] = $res;?>
														<?=$res;?>
													</td>
													<td><?=count_table_where("students", "`id_s_v` = '1' AND `s_y` = '".$item['id']."' AND `h_y` = '$nimsola'")?></td>
													<td><?=count_table_where("students", "`id_s_v` = '2' AND `s_y` = '".$item['id']."' AND `h_y` = '$nimsola'")?></td>
													<td class="bold">
														<?php if($counter > 1):?>
															<?php $val1 = $datas[$i]?>
															
															<?php @$p = (($res - $val1)/ $res) * 100?>
															<?php $n = round($p, 2)?>
															
															<?php if($n < 0):?>
																<span class="text-c-red"> <?=$n?>%</span>
															<?php else:?>
																<span class="text-c-green"> +<?=$n?>%</span>
															<?php endif;?>
															<?php $i++;?>
														<?php endif;?>
													</td>
													
													<td class="bold"><?=count_table_where("state_groups", "`s_y` = '".$item['id']."' AND `h_y` = '$nimsola'")?></td>
													<td><?=count_table_where("state_groups", "`id_s_v` = '1' AND `s_y` = '".$item['id']."' AND `h_y` = '$nimsola'")?></td>
													<td><?=count_table_where("state_groups", "`id_s_v` = '2' AND `s_y` = '".$item['id']."' AND `h_y` = '$nimsola'")?></td>
												</tr>
											<?php endfor;?>
											
										<?php endforeach;?>
									</tbody>
								</table>
								<?php //print_arr($datas);?>
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
		
		$('table.table').on("click", ".showstatistic", function () {
			var id_faculty = $(this).attr("data-id-faculty");
			var id_s_v = $(this).attr("data-id-s-v");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=showstatistic";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_v": id_s_v},
				success: function(data){
					$('.modal-title').text("Нишондод");
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
		});
	});
</script>