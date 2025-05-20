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
									<!--<h3 style="font-weight: bold;color: red;">Пеш аз истифодаи трансфери саволҳо лутфан нимсолаи таҳсилро ба 1 ва соли таҳсилро ба 2024-2025 	<i style="font-size: 85px;">&uarr;</i> иваз намоед</h3>
									--><h5>Трансфери саволномаҳо</h5>
								</div>
								<div class="card-block">
									<i>Барои кучонидани саволномаи як фан ба фанни дигар нимсола, фан, омӯзгор, намуди саволҳо ва забони саволҳоро интихоб кунед.</i>
									<form action="<?=MY_URL?>?option=tests&action=transfer2_quests" method="post" enctype="multipart/form-data">
										<table class="addform">
											<tr>
												<td>
													<label for="hy_from">Аз нимсолаи:</label>
													<select name="hy_from" id="hy_from" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<option value="1">Нимсолаи 1</option>
														<option value="2">Нимсолаи 2</option>
													</select>											
												</td>
												
												<td colspan="2">
													<label for="id_fan_from">Аз ин фан:</label>
													<select name="id_fan_from" id="id_fan_from" class="form-control" required>
														<option value="">-Нимсоларо интихоб кунед-</option>
													</select>											
												</td>
												
												
											</tr>	
											<tr>	
												<td>
													<label for="author_from">Автори саволнома:</label>
													<select name="author_from" id="author_from" class="form-control" required>
														<option value="">-Фанро интихоб кунед-</option>
													</select>											
												</td>
												
												<td>
													<label for="lang_from">Аз забони:</label>
													<select name="lang_from" id="lang_from" class="form-control" required>
														<option value="">-Муаллифи саволро интихоб кунед-</option>
													</select>											
												</td>
												<td>
													<label for="rating_from">Аз рейтинги:</label>
													<select name="rating_from" id="rating_from" class="form-control" required>
														<option value="">-Забонро интихоб кунед-</option>
													</select>	
												</td>
											</tr>
										</table>
										
										<div id="quests"></div>
										
										<i class="fa fa-arrow-down" style="display: block;margin: 20px auto;text-align: center;font-size: 60px;"></i>
										
										<table class="addform">
											
											<tr>
												<td>
													<label for="id_faculty_to">Факултет:</label>
													<select name="id_faculty_to" id="id_faculty_to" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
														<?php foreach($faculties as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>											
												</td>
												<td  colspan="2">
													<label for="id_s_l_to">Зинаи таҳсил:</label>
													<select name="id_s_l_to" id="id_s_l_to" class="form-control" required>
														<?php foreach($studylevels as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
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
												<td  colspan="2">
													<label for="id_spec_to">Ихтисос:</label>
													<select name="id_spec_to" id="id_spec_to" class="form-control" required>
														<option value="">-Факултетро интихоб кунед-</option>
													</select>	
												</td>
												<td class="w33">
													<label for="id_group_to">Гуруҳ:</label>
													<select name="id_group_to" id="id_group_to" class="form-control" required>
														<option value="">-Ихтисосро интихоб кунед-</option>
													</select>	
												</td>												
											</tr>
											
											<tr>										
												<td>
													<label for="id_fan_to">Ба ин фан:</label>
													<select name="id_fan_to" id="id_fan_to" class="form-control" required>
														<option value="">-Гуруҳро интихоб кунед-</option>
													</select>											
												</td>
												<td>
													<label for="author_to">Омӯзгор:</label>
													<select name="author_to" id="author_to" class="form-control" required>
														<option value="">-Фанро интихоб кунед-</option>
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
												
												<td>
													<label for="rating_to">Ба рейтинги:</label>
													<select name="rating_to" id="rating_to" class="form-control" required>
														<option value="1">Рейтинги 1</option>
														<option value="2">Рейтинги 2</option>
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
		/*IIIIIIIIIIIIIIII*/
		$('.addform').on("change", "#hy_from", function () {
			var h_y = $('.addform #hy_from').val();			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=getFans";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"h_y": h_y},
				success: function(data){
					$('#id_fan_from').html(data);
				}
			});
			
		});
		
		$('.addform').on("change", "#id_fan_from", function () {
			var h_y = $('.addform #hy_from').val();			
			var id_fan = $('.addform #id_fan_from').val();			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=getAuthors";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"h_y": h_y, "id_fan": id_fan},
				success: function(data){
					$('#author_from').html(data);
				}
			});
			
		});
		
		$('.addform').on("change", "#author_from", function () {
			var h_y = $('.addform #hy_from').val();			
			var id_fan = $('.addform #id_fan_from').val();			
			var author = $('.addform #author_from').val();			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=getLang";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"h_y": h_y, "id_fan": id_fan, "author": author},
				success: function(data){
					$('#lang_from').html(data);
				}
			});
			
		});
		
		$('.addform').on("change", "#lang_from", function () {
			var h_y = $('.addform #hy_from').val();			
			var id_fan = $('.addform #id_fan_from').val();			
			var author = $('.addform #author_from').val();			
			var zabon = $('.addform #lang_from').val();			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=getRating";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"h_y": h_y, "id_fan": id_fan, "author": author, "zabon": zabon},
				success: function(data){
					$('#rating_from').html(data);
				}
			});
			
		});
		
		$('.addform').on("change", "#rating_from", function () {
			var h_y = $('.addform #hy_from').val();			
			var id_fan = $('.addform #id_fan_from').val();			
			var author = $('.addform #author_from').val();			
			var lang = $('.addform #lang_from').val();			
			var rating = $('.addform #rating_from').val();			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=getQuests";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"h_y": h_y, "id_fan": id_fan, "author": author, "h_y": h_y, "lang": lang, "rating": rating},
				success: function(data){
					$('#quests').html(data);
				}
			});
			
		});
		
		
		$('.addform').on("change", "#id_faculty_to, #id_s_l_to, #id_s_v_to, #id_course_to", function () {
			var id_faculty = $('.addform #id_faculty_to').val();
			var id_s_l = $('.addform #id_s_l_to').val();
			var id_s_v = $('.addform #id_s_v_to').val();
			var id_course = $('.addform #id_course_to').val();
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=getSpecs";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_l": id_s_l, "id_s_v": id_s_v, "id_course":id_course},
				success: function(data){
					$('#id_spec_to').html(data);
				}
			});
			
		});
		
		$('.addform').on("change", "#id_faculty_to, #id_s_l_to, #id_s_v_to, #id_course_to, #id_spec_to", function () {
			var id_faculty = $('.addform #id_faculty_to').val();
			var id_s_l = $('.addform #id_s_l_to').val();
			var id_s_v = $('.addform #id_s_v_to').val();
			var id_course = $('.addform #id_course_to').val();
			var id_spec = $('.addform #id_spec_to').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=getGroups";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_l": id_s_l, "id_s_v": id_s_v, "id_course":id_course, "id_spec": id_spec},
				success: function(data){
					$('#id_group_to').html(data);
				}
			});
			
		});
		
		$('.addform').on("change", "#id_group_to", function () {
			var id_faculty = $('.addform #id_faculty_to').val();
			var id_s_l = $('.addform #id_s_l_to').val();
			var id_s_v = $('.addform #id_s_v_to').val();
			var id_course = $('.addform #id_course_to').val();
			var id_spec = $('.addform #id_spec_to').val();
			var id_group = $('.addform #id_group_to').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=getFan";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_l": id_s_l, "id_s_v": id_s_v, "id_course":id_course, "id_spec": id_spec, "id_group":id_group},
				success: function(data){
					$('#id_fan_to').html(data);
				}
			});
			
		});
		
		$('.addform').on("change", "#id_fan_to", function () {
			var id_faculty = $('.addform #id_faculty_to').val();
			var id_s_l = $('.addform #id_s_l_to').val();
			var id_s_v = $('.addform #id_s_v_to').val();
			var id_course = $('.addform #id_course_to').val();
			var id_spec = $('.addform #id_spec_to').val();
			var id_group = $('.addform #id_group_to').val();
			var id_fan = $('.addform #id_fan_to').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/tests/tests_ajax.php?option=getTeachers";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_l": id_s_l, "id_s_v": id_s_v, "id_course":id_course, "id_spec": id_spec, "id_group":id_group, "id_fan":id_fan},
				success: function(data){
					$('#author_to').html(data);
				}
			});
			
		});
		/*IIIIIIIIIIIIIIII*/
		
	});
</script>