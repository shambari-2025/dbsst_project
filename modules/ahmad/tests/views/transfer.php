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
							Трансфери саволномаҳо
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<?php if(isset($_SESSION['transfer'])):?>
		<div class="alert alert-success alert-dismissable growl-animated animated fadeInDown" style="text-align: center"><i class="fa fa-warning"></i> 
			Трансфери саволҳо бо мувафақият иҷро шуд!
		</div>
		<?php unset($_SESSION['transfer']);?>
	<?php endif;?>
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h5>Трансфери саволномаҳо</h5>
								</div>
								<div class="card-block">
									<i>Барои кучонидани саволномаи як фан ба фанни дигар аввал фаннро интихоб карда, сипас забонро ва баъдан намуди саволҳоро интихоб кунед.</i>
									<form action="<?=MY_URL?>?option=tests&action=transfer_quests" method="post" enctype="multipart/form-data">
										<table class="addform">
											<tr>
												<td>
													<label for="id_fan_from">Аз ин фан:</label>
													<select name="id_fan_from" id="id_fan_from" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<?php foreach($fanho as $item):?>
															<option value="<?=$item['id_fan'];?>"><?=$item['title_tj']?></option>
														<?php endforeach;?>
													</select>											
												</td>
												
												
												<td>
													<label for="lang_from">Ба забони:</label>
													<select name="lang_from" id="lang_from" class="form-control" required>
														<?php foreach($langs as $k => $value):?>
															<option value="<?=$k;?>"><?=$value?></option>
														<?php endforeach;?>
													</select>											
												</td>
												
											</tr>	
											<tr>	
												<td>
													<label for="author_from">Автори саволнома:</label>
													<select name="author_from" id="author_from" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<?php foreach($teachers as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['fullname_tj']?></option>
														<?php endforeach;?>
													</select>											
												</td>
												
												
												<td>
													<label for="type">Намуди саволҳо:</label>
													<select name="type" id="type" class="form-control" required>
														<option value="all">Ҳама намуди саволҳо</option>
														<?php foreach($questions_type as $k => $value):?>
															<option value="<?=$k;?>"><?=$value?></option>
														<?php endforeach;?>
													</select>											
												</td>
											</tr>
										</table>
										
										<i class="fa fa-arrow-down" style="display: block;margin: 20px auto;text-align: center;font-size: 60px;"></i>
										
										<table class="addform">
											
											<tr>
												<td colspan="2">
													<label for="id_faculty_to">Факултет:</label>
													<select name="id_faculty_to" id="id_faculty_to" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<?php foreach($faculties as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>											
												</td>
												<td>
													<label for="id_s_l_to">Зинаи таҳсил:</label>
													<select name="id_s_l_to" id="id_s_l_to" class="form-control" required>
														<?php foreach($studylevels as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>											
												</td>
											</tr>
											
											
											<tr>
												<td colspan="2">
													<label for="id_spec_to">Ихтисос:</label>
													<select name="id_spec_to" id="id_spec_to" class="form-control" required>
														<option value="">-Факултетро интихоб кунед-</option>
													</select>	
												</td>
												
												<td>
													<label for="id_s_v_to">Намуди таҳсил:</label>
													<select name="id_s_v_to" id="id_s_v_to" class="form-control" required>
														<?php foreach($studyviews as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>	
												</td>
											</tr>
											
											<tr>
												<td class="w33">
													<label for="id_course_to">Курс:</label>
													<select name="id_course_to" id="id_course_to" class="form-control" required>
														<?php foreach($courses as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>	
												</td>
												
												<td class="w33">
													<label for="id_group_to">Гуруҳ:</label>
													<select name="id_group_to" id="id_group_to" class="form-control" required>
														<?php foreach($groups as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>	
												</td>
												
												<td>
													<label for="author_to">Автори саволнома:</label>
													<select name="author_to" id="author_to" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<?php foreach($teachers as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['fullname_tj']?></option>
														<?php endforeach;?>
													</select>											
												</td>
											</tr>
											
											<tr>
												<td colspan="1">
													<label for="id_fan_to">Ба ин фан:</label>
													<select name="id_fan_to" id="id_fan_to" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<?php foreach($fanho as $item):?>
															<option value="<?=$item['id_fan'];?>"><?=$item['title_tj']?></option>
														<?php endforeach;?>
													</select>											
												</td>
												
												<td>
													<label for="lang_to">Ба забони:</label>
													<select name="lang_to" id="lang_to" class="form-control" required>
														<?php foreach($langs as $k => $value):?>
															<option value="<?=$k;?>"><?=$value?></option>
														<?php endforeach;?>
													</select>											
												</td>
											</tr>
											
											<tr>
												<td>
													<br>
													<button type="submit" class="btn btn-inverse waves-effect waves-light">
														<i class="fa fa-exchange"></i> Гузаронидан
													</button>
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

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.addform').on("change", "#id_faculty_to, #id_s_l_to", function () {
			var id_faculty = $('.addform #id_faculty_to').val();
			var id_s_l = $('.addform #id_s_l_to').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/commission/commission_ajax.php?option=getSpecs";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_l": id_s_l},
				success: function(data){
					$('#id_spec_to').html(data);
				}
			});
			
		});
		
		/*
		$('.addform').on("change", "#id_fan, #lang, #type", function () {
			var id_fan = $('.addform #id_fan').val();
			var lang = $('.addform #lang').val();
			var type = $('.addform #type').val();
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=getStatisticFan";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_l": id_s_l},
				success: function(data){
					$('#id_spec').html(data);
				}
			});
		});
		*/
		
	});
</script>