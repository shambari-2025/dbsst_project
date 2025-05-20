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
							Ҷурсозиҳо
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
									<h5>Ҷурсозиҳо</h5>
								</div>
								<div class="card-block">
									<button data-toggle="modal" data-target=".bs-example-modal-lg"
										class="btn waves-effect waves-light btn-inverse add" type="button">
										<i class="fa fa-plus"></i> Иловакунӣ
									</button>
									
									
									<hr>
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th class="image">Расм</th>
												<th class="counter">ID</th>
												<th class="left">Ному насаб</th>
												<th>Факултет(ҳо)</th>
												<th>Зинаи таҳсил</th>
												<th>Мамлакат(ҳо)</th>
												<th>Миқдори сабтҳо</th>
												<th style="width: 150px">Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = 0;?>
											<?php foreach($datas as $item):?>
												<tr>
													<th scope="row"><?=++$counter?>.</th>
													<td>
														<?php $photo = getUserImg($item['id_user'], $item['jins'], $item['photo'], 1);?>
														<img class="img-circle profile_img imguser" src="<?=$photo;?>">
													</td>
													<th scope="row"><?=$item['id']?></th>
													<td class="left">
														<?=$item['fullname_tj']?>
													</td>
													
													<td>
														<?php if($item['id_faculties'] == 'ALL'):?>
															<span class="bold">Ҳамаи факултетҳо</span>
														<?php else:?>
															<?php $facs = query("SELECT * FROM `faculties` WHERE `id` IN (".$item['id_faculties'].")");?>
															<?php foreach($facs as $f_item):?>
																<?=$f_item['title']?><br>
															<?php endforeach;?>
														<?php endif;?>
													</td>
													<td>
														<?php if($item['id_s_l'] == 'ALL'):?>
															<span class="bold">Ҳамаи зинаҳои таҳсил</span>
														<?php else:?>
															<?php $levels = query("SELECT * FROM `study_level` WHERE `id` IN (".$item['id_s_l'].")");?>
															<?php foreach($levels as $l_item):?>
																<?=$l_item['title']?><br>
															<?php endforeach;?>
														<?php endif;?>
													</td>
													<td>
														<?php if($item['id_countries'] == 'ALL'):?>
															<span class="bold">Ҳамаи мамлакатҳо</span>
														<?php else:?>
															<?php $countries = query("SELECT * FROM `countries` WHERE `id` IN (".$item['id_countries'].")");?>
															<?php foreach($countries as $c_item):?>
																<?=$c_item['title']?><br>
															<?php endforeach;?>
														<?php endif;?>
													</td>
													
													<td>
														<?php $query = query("SELECT  COUNT(*) AS `total_count`
														FROM `users`
														INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
														WHERE `students`.`status` = '-1' AND `users`.`added_by` = '{$item['id_user']}'
														AND `students`.`s_y` = '{$item['s_y']}'
														");?>
														
														<?=$query[0]['total_count']?>
													</td>
													
													<td class="elements">
														<a class="edit" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$item['id']?>" title="Таҳриркунӣ">
															<i class="fa fa-edit"></i>
														</a>
														
														<a href="<?=MY_URL;?>?option=commission&action=delete_member&id=<?=$item['id'];?>" onclick="return confirmDel()">
															<i class="fa fa-trash"></i>
														</a>
													</td>
													
												</tr>
											<?php endforeach;?>
										</tbody>
									</table>
									
								</div>
							</div>
							
							
							
							<div class="card">
								<div class="card-header">
									<h5>Даврҳои қабулкунӣ</h5>
								</div>
								<div class="card-block">
									<button data-toggle="modal" data-target=".bs-example-modal-lg"
										class="btn waves-effect waves-light btn-inverse add_davr" type="button">
										<i class="fa fa-plus"></i> Иловакунии давр
									</button>
									
									
									<hr>
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th class="left">Номгузории давр</th>
												<th>Номи кутоҳ<br><i>(барои меню)</i></th>
												<th>Оғози давр</th>
												<th>Анҷоми давр</th>
												<th>Файл</th>
												<th>Шумораи<br>довталаб</th>
												<th>Ҳуҷҷат<br>супориданд</th>
												<th style="width: 120px">Амалҳо</th>
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = 0;?>
											<?php foreach($davr_datas as $item):?>
												<tr>
													<th scope="row"><?=++$counter?>.</th>
													<td class="left">
														<?=$item['title']?>
													</td>
													<td><?=$item['short']?></td>
													
													<td><?=formatDate($item['start_date']);?></td>
													<td><?=formatDate($item['finish_date']);?></td>
													<td>
														<?php if($item['file']):?>
															<?=$item['file']?>
														<?php endif;?>
													</td>
													
													<td class="bold">
														<?php if($item['students']):?>
															<?=$item['students']?>
														<?php endif;?>
													</td>
													
													<td class="bold">
														<?php if($item['students']):?>
															<?=$omad = getStudentMMTbyDavr($item['id'])?><br>
															
															<i><?=round(($omad * 100) / $item['students'], 2)?>%</i>
														<?php endif;?>
													</td>
													
													<td class="elements">
														<a class="editDavr" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$item['id']?>" title="Таҳриркунӣ">
															<i class="fa fa-edit"></i>
														</a>
														<!--
														<a href="<?=MY_URL;?>?option=commission&action=delete_davr&id=<?=$item['id'];?>" onclick="return confirmDel()">
															<i class="fa fa-trash"></i>
														</a>
														-->
													</td>
													
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
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getAddForm";?>';
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Иловакунии аъзои комиссия");
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
		});
		
		$('.edit').on('click', function(){
			
			var id = $(this).attr("data-id");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getEditForm";?>';
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Таҳриркунӣ");
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
		});
		
		
		$('.add_davr').on('click', function(){
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getAddDavrForm";?>';
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Иловакунии даврҳои қабул");
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"my_url": my_url},
				beforeSend: function(){
					$('#bigmodal .load').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal .load').remove();
					$('#bigmodal').append(data);
				}
			});
		});
		
		$('.editDavr').on('click', function(){
			
			var id = $(this).attr("data-id");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getEditDavrForm";?>';
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Таҳриркунии давр");
			$('#bigmodal').html('<div class="load"></div>');
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id": id, "my_url": my_url},
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
