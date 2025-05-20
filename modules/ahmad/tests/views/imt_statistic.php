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
							Статистикаи ведомостҳо
						</li>
						
						<li class="breadcrumb-item">
							<?=getStudyYear(S_Y)?>
						</li>
						
						<li class="breadcrumb-item">
							Нимсолаи <?=(H_Y)?>
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
						<?php if(isset($_SESSION['user']['admin'])):?>
							<?php $S_R = $_SESSION['superarr'];?>
						<?php else:?>
							<?php $S_R = $_SESSION['tests'];?>
						<?php endif;?>
						
						
						<?php print_arr($S_R)?>
						
						<?php foreach($S_R[$id_faculty]['level'][$id_s_l]['view'][$id_s_v]['course'][$id_course]['spec'] as $item):?>
							
							<?php foreach($item['groups'] as $g_item):?>
								<?php $datas = query("SELECT * FROM `tests` WHERE `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '{$item['id']}' AND `id_group` = '{$g_item['id']}'");?>
								
								<div class="col-xl-12 col-md-12">
									<div class="card">
										<div class="card-header">
											<h5>[<?=$item['id']?>] <?=$item['code']?> <?=$g_item['short']?> - <?=$item['title']?></h5>
										</div>
										<div class="card-block">
											<div class="table-responsive davrifaol">
												<table class="table" style="font-size:14px">
													<thead class="center">
														<tr style="background-color: #263544; color: #fff">
															<th style="width:40px">№</th>
															<th style="width:40px">
																<div class="vertical">ID ФАН</div>
															</th>
															<th style="width:250px">Номгӯи фанҳо</th>
															<th style="width:160px">Шакли<br>имтиҳон</th>
															<th style="width:160px">Санаи<br>имтиҳон</th>
															<th style="width:160px">Намуди<br>саволнома</th>
															<th style="width:160px">Омӯзгор(он)</th>
															<th style="width:60px"><div class="vertical">Савол</div></th>
															<th>Амалҳо</th>
														</tr>
													</thead>
													<tbody class="center">
														<?php $counter = 0;?>
														<?php foreach ($datas as $list):?>
															<tr>
																<th scope="row"><?=++$counter?>.</th>
																<th scope="row"><?=$list['id_fan']?></th>
																<td class="left"><?=getFanTest($list['id_fan'])?></td>
																<td class="center">
																	<select class="test_edit form-control" data-id-test="<?=$list['id']?>" >
																		<?php foreach($imt_types as $v => $k):?>
																			<option <?php if($list['imt_type'] == $v) {echo "selected"; }?> value="<?=$v?>"><?=$k?></option>
																		<?php endforeach;?>
																	</select>
																</td>
																
																<td class="center"><input value="<?=$list['datetime']?>" type="datetime-local" data-id-test="<?=$list['id']?>" class="test_edit_date form-control"></td>
																
																<td class="center">
																	<select class="test_type_edit form-control" data-id-test="<?=$list['id']?>" >
																		<?php foreach($test_types as $v => $k):?>
																			<option <?php if($list['test_type'] == $v) {echo "selected"; }?> value="<?=$v?>"><?=$k?></option>
																		<?php endforeach;?>
																	</select>
																</td>
																
																
																<td>
																	<?php
																		$id_iqtibos = $list['id_iqtibos'];
																		$teachers=query("SELECT DISTINCT `id_teacher` FROM `sarboriho` WHERE `id_iqtibos` = '$id_iqtibos'");
																		foreach($teachers as $teacher){
																			echo getShortName($teacher['id_teacher'])."<br>";
																		}
																	?>
																</td>
																
																
																
																<td class="center">
																	<?php if($list['test_type'] == 1):?>
																		<?php $w = "";?>
																	<?php elseif($list['test_type'] == 2):?>
																		<?php $w = "`id_faculty` = '$id_faculty' AND ";?>
																	<?php elseif($list['test_type'] == 3):?>
																		<?php $w = "`id_spec` = '{$item['id']}' AND ";?>
																	<?php endif;?>
																	
																	<?=count_table_where("questions", "$w `id_fan` = '{$list['id_fan']}' AND `lang` = '{$g_item['lang']}'")?>
																</td>
																
																<td class="elements">
																	<?php if($list['status'] == '1'):?>
																		<a class="status" href="javascript:" data-id="<?=$list['id']?>" data-status="<?=$list['status']?>"><i class="fa fa-unlock"></i></a>
																	<?php else:?>
																		<a class="status" href="javascript:" data-id="<?=$list['id']?>" data-status="<?=$list['status']?>"><i class="fa fa-lock"></i></a>
																	<?php endif?>
																	
																	
																	<a class="statistic_test" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$list['id_fan']?>" title="Нишондод"><i class="fa fa-bar-chart"></i> </a>
																	
																	<a href="<?=MY_URL?>?option=questions&action=list&id_iqtibos=<?=$list['id_iqtibos']?>" title="Руйхати саволнома">
																		<i class="fa fa-list"></i>
																	</a>
																	<a class="edit_test" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$list['id']?>" title="Таҳриркунӣ"><i class="fa fa-edit"></i> </a>
																	<a target="_blank" href="<?=MY_URL?>?option=print&action=vedomost&id_iqtibos=<?=$list['id_iqtibos']?>" title="Чопи ведомост"><i class="fa fa-print"></i></a>
																	<a href="<?=MY_URL?>?option=jd&action=delete&id=<?=$list['id']?>" title="Несткунӣ" onclick="return confirmDel()"><i class="fa fa-trash"></i> </a>
																	
																</td>
															</tr>
														<?php endforeach;?>
													</tbody>
												</table>
											</div>
											
										</div>
									</div>
								</div>
							<?php endforeach;?>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	jQuery(document).ready(function($){
		
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
			
			console.log(datetime);
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=UpdateDate";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "datetime": datetime},
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
</script>
