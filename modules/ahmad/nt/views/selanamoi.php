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
							Шуъбаи таълим
						</li>
						
						<li class="breadcrumb-item">
							Селанамоӣ
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
						
						
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h5>Селанамоӣ</h5>
								</div>
								<div class="card-block">
									
									<table class="addform">
										<tr>
											<td style="width: 50%">
												<label for="id_faculty">Факултет:</label>
												<select name="id_faculty" id="id_faculty" class="form-control" required>
													<option value="">-Интихоб кунед-</option>
													<?php foreach($faculties as $item):?>
														<option <?php if(isset($id_faculty) && $id_faculty == $item['id']):?>selected<?php endif;?> value="<?=$item['id'];?>"><?=$item['title']?></option>
													<?php endforeach;?>
												</select>											
											</td>
											
											<td>
												<?php if(isset($_SESSION['user']['admin'])):?>
													<label for="id_departament">Кафедра:</label>
													<select name="id_departament" id="id_departament" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<?php foreach($departaments as $item):?>
															<option <?php if(isset($id_departament) && $id_departament == $item['id']):?>selected<?php endif;?> value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>
												<?php endif;?>
											</td>
										</tr>
										
										<tr>
											<td>
												<button class="load btn btn-inverse waves-effect waves-light">
													Боркунӣ
												</button>
											</td>
										</tr>
									</table>
									<br>
									<br>
									<div id="data">
										<div class="table-responsive davrifaol">
											<table class="table" style="font-size:14px">
												<thead class="center">
													<tr style="background-color: #263544; color: #fff">
														<th>№</th>
														<th>ID</th>
														<th>Номгуи фан</th>
														<th><div class="vertical">Курс</div></th>
														<th><div class="vertical">Нимсола</div></th>
														<th>Гуруҳ</th>
														<th>Факулта</th>
														<th>Дараҷаи таҳсилот</th>
														<th>Шакли таҳсил</th>
														<th>М.Д</th>
														<th>Намуд</th>
														<th>Соат</th>
														<th style="width: 170px;">Селанамоӣ</th>
													</tr>
												</thead>
												<tbody>
													<?php $counter_list = 0;?>
													<?php foreach($datas as $item):?>
														<?php $spec_list = $group_list = [];?>
														<tr class="center">
															<td><?=++$counter_list?>.</td>
															<td><?=$item['id']?></td>
															<td class="left"><?=$item['title_tj']?></td>
															<td><?=$item['id_course']?></td>
															<td><?=getNimsolaBySemestr($item['semestr'])?></td>
															<td>
																<?=($item['spec_code'])?>
																<?=($item['group_title'])?>
															</td>
															<td><?=($item['faculty_short'])?></td>
															<td><?=($item['s_l_title'])?></td>
															<td><?=($item['s_v_title'])?></td>
															<td>
																<?php $spec_list[] = $item['id_spec']?>
																<?php $group_list[] = $item['id_group']?>
																<?php $childs = query("SELECT `id`, `id_spec`, `id_group` FROM `iqtibosho`
																WHERE `parent_group` = '{$item['id']}' AND `s_y` = '$s_y'");?>
																
																<?php foreach($childs as $child):?>
																	<?php $spec_list[] = $child['id_spec']?>
																	<?php $group_list[] = $child['id_group']?>
																<?php endforeach;?>
																
																<?php $id_specs = implode(",", $spec_list);?>
																<?php $id_groups = implode(",", $group_list);?>
																
																<?=count_table_where("students", "
																`status` = '1' AND 
																`id_faculty` = '{$item['id_faculty']}' AND 
																`id_s_l` = '{$item['id_s_l']}' AND 
																`id_s_v` = '{$item['id_s_v']}' AND 
																`id_course` = '{$item['id_course']}' AND 
																`id_spec` IN ($id_specs) AND 
																`id_group` IN ($id_groups) AND 
																`s_y` = '".S_Y."'");?>
															</td>
															
															<td>Лексия</td>
															<td><?=$item['lk_soat']?></td>
															<td class="elements">
																
																
																
																<?php foreach($childs as $child):?>
																	<p><?=getSpecialtyCode($child['id_spec'])?> <?=getGroup($child['id_group'])?>
																	<a href="<?=MY_URL?>?option=nt&action=delete_selanamoi&id=<?=$child['id']?>">
																		<i class="fa fa-trash"></i>
																	</a>
																	</p>
																<?php endforeach;?>
																
																<?php
																	$counter = count_table_where("iqtibosho", 
																	" 
																	`parent_group` IS NULL AND
																	`id_faculty` = '$id_faculty' AND 
																	`id_course` = '{$item['id_course']}' AND 
																	`semestr` = '{$item['semestr']}' AND 
																	`id_departament` = '$id_departament' AND 
																	`id_fan` = '{$item['id_fan']}' AND 
																	`s_y` = '$s_y'");
																?>
																
																
																<?php if($counter > 1):?>
																	<a class="add_selanamoi" href="javascript" 
																	data-toggle="modal" data-target=".bs-example-modal-lg" 
																	data-id="<?=$item['id']?>" 
																	data-fan="<?=$item['title_tj']?>" 
																	title="Селанамоӣ">
																		<i class="fa fa-plus"></i>
																	</a>
																<?php endif;?>
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
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.load').on('click', function(){
			var id_faculty = $('#id_faculty').val();
			
			<?php if(isset($_SESSION['user']['admin'])):?>
				var id_departament = $('#id_departament').val();
				if(id_faculty && id_departament){
					window.location.href = '<?=MY_URL?>?option=nt&action=selanamoi&id_faculty='+id_faculty+'&id_departament='+id_departament;
				}
			<?php else:?>
				if(id_faculty){
					window.location.href = '<?=MY_URL?>?option=nt&action=selanamoi&id_faculty='+id_faculty;
				}
			<?php endif;?>
		
		});
		
		
		$('.add_selanamoi').on('click', function(){
			var id = $(this).attr("data-id");
			var fan = $(this).attr("data-fan");
			
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Селанамоии фан: " + fan);
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=selanamoi";?>';
			
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