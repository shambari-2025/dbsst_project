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
							<h5>Нишондод 
								<span style="display:inline; color: #01C0C8">Истифодабарандаҳо</span>
								ва
								<span style="display:inline; color: #7E81CB">Тамошокарданд</span>
							</h5>
						</div>
						<div class="card-block">
							<div id="morris-extra-area"></div>
						</div>
					</div>
					
					
					<div class="card proj-progress-card">
						<div class="card-header">
							<h5>Истифодабарандаҳо</h5>
						</div>
						<div class="card-block">
							<table style="width:50%">
								<tr >
									<td>
										<input value="<?=date("Y-m-d", time())?>" class="form-control fill" type="date" name="date" id="date">
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
							<div id="fordatas">
								<?php include("todaystatistic.php");?>
							</div>
						</div>
					</div>
					
					
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
							<!--
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
													<?php $res = count_table_where("students", "`status` = '1' AND `id_faculty` = '".$item['id_faculty']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
													<?php $all_students += $res;?>
													<?=$res?>
												</td>
												<td>
													<?php $all_groups += $item['allgroups'];?>
													<?=$item['allgroups']?>
												</td>
												<td class="bold">
													<?php $res = count_table_where("students", "`status` = '1' AND `id_faculty` = '".$item['id_faculty']."' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
													<?php $ruz_all_students += $res;?>
													<?=$res?>
												</td>
												<td>
													<?php $ruz_all_groups += $item['bak_ruzona'];?>
													<a href="#" 
													data-id-faculty="<?=$item['id_faculty']?>" 
													data-id-s-v="1" 
													data-toggle="modal" data-target=".bs-example-modal-lg" class="showstatistic">
														<?=$item['bak_ruzona']?>
													</a>
												</td>
												<td class="bold">
													<?php $res = count_table_where("students", "`status` = '1' AND `id_faculty` = '".$item['id_faculty']."' AND `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
													<?php $fos_all_students += $res;?>
													<?=$res?>
												</td>
												<td>
													<?php $fos_all_groups += $item['bak_fosilavi'];?>
													<a href="#" 
													data-id-faculty="<?=$item['id_faculty']?>" 
													data-id-s-v="2" 
													data-toggle="modal" data-target=".bs-example-modal-lg" class="showstatistic">
														<?=$item['bak_fosilavi']?>
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
							-->
							<br>
							<div class="table-responsive davrifaol">
								<table class="table" style="font-size:14px">
									<thead class="center">
										<tr>
											<th rowspan="3">№</th>
											<th rowspan="3">Номгуи факултетҳо</th>
											<th rowspan="3"><div class="vertical">Шумораи донишҷӯ</div></th>
											<th rowspan="3"><div class="vertical">Миқдори гуруҳҳо</div></th>
											<th colspan="5">Бакалавр</th>
											<th colspan="2">Таҳсилоти дуюм</th>
											<th colspan="2">Магистратура</th>
											<th colspan="2">Докторантура</th>
										</tr>
										<tr>
											<th colspan="2">рузона</th>
											<th colspan="2">фосилавӣ</th>
											<th rowspan="2"><div class="vertical">Ҳамагӣ</div></th>
											<th colspan="2">фосилавӣ</th>
											<th colspan="2">рузона</th>
											<th colspan="2">рузона</th>
										</tr>
										<tr>
											<th><div class="vertical">Шумораи<br>донишҷӯ</div></th>
											<th><div class="vertical">Миқдори<br>гурӯҳ</div></th>
											<th><div class="vertical">Шумораи<br>донишҷӯ</div></th>
											<th><div class="vertical">Миқдори<br>гурӯҳ</div></th>
											<th><div class="vertical">Шумораи<br>донишҷӯ</div></th>
											<th><div class="vertical">Миқдори<br>гурӯҳ</div></th>
											<th><div class="vertical">Шумораи<br>донишҷӯ</div></th>
											<th><div class="vertical">Миқдори<br>гурӯҳ</div></th>
											<th><div class="vertical">Шумораи<br>донишҷӯ</div></th>
											<th><div class="vertical">Миқдори<br>гурӯҳ</div></th>
										</tr>
									</thead>
									
									<tbody>
										<?php $counter = 0;?>
										<?php $all_students = $all_groups = $ruz_all_students = $ruz_all_groups = $fos_all_students = $fos_all_groups = 0;?>
										<?php foreach($statistic as $item):?>
											<tr class="center">
												<td><?=++$counter?></td>
												<td class="left"><?=$item['title']?></td>
												
												<td class="bold">
													<?php $res_all = count_table_where("students", "`status` = '1' AND `id_faculty` = '".$item['id_faculty']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
													<?php $all_students += $res_all;?>
													<?=$res_all?>
												</td>
												<td>
													<?php $all_groups += $item['allgroups'];?>
													<?=$item['allgroups']?>
												</td>
												<td class="bold">
													<?php $res_bak_ruz = count_table_where("students", "`status` = '1' AND `id_faculty` = '".$item['id_faculty']."' AND `id_s_l` = '1' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
													<?php $ruz_all_students += $res_bak_ruz;?>
													<?=$res_bak_ruz?>
												</td>
												<td><?=$item['bak_ruzona']?></td>
												
												
												<td class="bold">
													<?php $res_bak_fos = count_table_where("students", "`status` = '1' AND `id_faculty` = '".$item['id_faculty']."' AND `id_s_l` = '1' AND `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
													<?php $fos_all_students += $res_bak_fos;?>
													<?=$res_bak_fos?>
												</td>
												<td><?=$item['bak_fosilavi']?></td>
												<td class="bold">
													<?=$res_bak_ruz + $res_bak_fos?>
												</td>
												
												<td class="bold"><?=count_table_where("students", "`status` = '1' AND `id_faculty` = '".$item['id_faculty']."' AND `id_s_l` = '2' AND `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
												<td><?=$item['t2_fosilavi']?></td>
												
												<td class="bold"><?=count_table_where("students", "`status` = '1' AND `id_faculty` = '".$item['id_faculty']."' AND `id_s_l` = '3' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
												<td><?=$item['mag_ruzona']?></td>
												
												<td class="bold"><?=count_table_where("students", "`status` = '1' AND `id_faculty` = '".$item['id_faculty']."' AND `id_s_l` = '4' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
												<td><?=$item['doc_ruzona']?></td>
											</tr>
										<?php endforeach;?>
										<tr class="bold center">
											<td></td>
											<td class="left">Ҳамагӣ:</td>
											<td><?=count_table_where("students", "`status` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
											<td>0</td>
											<td><?=count_table_where("students", "`status` = '1' AND `id_s_l` = '1' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
											<td>0</td>
											<td><?=count_table_where("students", "`status` = '1' AND `id_s_l` = '1' AND `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
											<td>0</td>
											<td><?=count_table_where("students", "`status` = '1' AND `id_s_l` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
											
											<td><?=count_table_where("students", "`status` = '1' AND `id_s_l` = '2' AND `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
											<td>0</td>
											<td><?=count_table_where("students", "`status` = '1' AND `id_s_l` = '3' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
											<td>0</td>
											<td><?=count_table_where("students", "`status` = '1' AND `id_s_l` = '4' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
											<td>0</td>
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
											<th rowspan="2"><div class="vertical">Нимсола</div></th>
											<th colspan="4">Шумораи донишҷӯён</th>
											<th colspan="3">Миқдори гурӯҳҳо</th>
										</tr>
										<tr>
											<th><div class="vertical">Ҳамагӣ</div></th>
											<th><div class="vertical">Рузона</div></th>
											<th><div class="vertical">Фосилавӣ</div></th>
											<th><div class="vertical">Нисбати <br>нимсолаи<br>гузашта</div></th>
											
											<th><div class="vertical">Ҳамагӣ</div></th>
											<th><div class="vertical">Рузона</div></th>
											<th><div class="vertical">Фосилавӣ</div></th>
										</tr>
									</thead>
									<tbody>
										<?php $counter = 0;?>
										<?php $i = 0;?>
										<?php $datas = []; ?>
										<?php foreach($STUDY_YEARS as $item):?>
											<?php if($item['id'] == S_Y && H_Y == 1){$stop = 1;}else{$stop = 2;} ?>
											<?php for($nimsola = 1; $nimsola <= $stop; $nimsola++):?>
												
												<tr class="center" <?php if($nimsola % 2 == 0){ echo 'style="border-bottom: 2px solid"';}?>>
													<th scope="row"><?=++$counter?>.</th>
													<td class="left">Соли таҳсили <?=$item['title']?></td>
													<td><?=$nimsola?></td>
													
													<td class="bold">
														<?php $res = count_table_where("students", "`status` = '1' AND `s_y` = '".$item['id']."' AND `h_y` = '$nimsola'")?>
														<?php $datas[] = $res;?>
														<?=$res;?>
													</td>
													<td><?=count_table_where("students", "`status` = '1' AND `id_s_v` = '1' AND `s_y` = '".$item['id']."' AND `h_y` = '$nimsola'")?></td>
													<td><?=count_table_where("students", "`status` = '1' AND  `id_s_v` = '2' AND `s_y` = '".$item['id']."' AND `h_y` = '$nimsola'")?></td>
													<td class="bold">
														<?php if($counter > 1):?>
															<?php $val1 = $datas[$i]?>
															<?php if($res > 0):?>
																<?php @$p = ((@$res - @$val1)/ @$res) * 100?>
																<?php $n = round($p, 2)?>
															<?php else:?>
																<?php $n = 0; ?>
															<?php endif;?>
															
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
	"use strict";setTimeout(function(){
		$(document).ready(function(){
			
			Morris.Area({
				element:'morris-extra-area',
				data: JSON.parse( '<?php echo json_encode(graph()); ?>' ),
				//data: [{"date":"2022-10-03","visitors":"3","views":"99"},{"date":"2022-10-02","visitors":"2","views":"18"}],
				lineColors:['#01C0C8','#7E81CB'],
				xkey:'date',
				ykeys:['visitors','views',],
				labels:['Истифодабарандаҳо','Тамошокарданд',],
				pointSize:4,
				lineWidth:1,
				resize:false,
				fillOpacity:0.8,
				behaveLikeLine:true,
				gridLineColor:'#5FBEAA',
				hideHover: false
			});
		});

	},350);
	
	
	
	$(document).ready(function(){
		
		$('.loaddata').on('click', function(){
			
			var date = $("#date").val();
			console.log(date);
			
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=todaystatistic";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"date": date},
				beforeSend: function(){
					$('#fordatas').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#fordatas img').hide();
					$('#fordatas').append(data);
				}
			});
			
			
		});
		
		
		
		$('table.table').on("click", ".showstatistic", function () {
			
			var id_faculty = $(this).attr("data-id-faculty");
			var id_s_v = $(this).attr("data-id-s-v");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=showstatistic";?>';
			
			$('.modal-title').text("Нишондод");
			
			
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_v": id_s_v},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
		});
		
	});
</script>