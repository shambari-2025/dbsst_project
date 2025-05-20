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
							Иловакунӣ
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
							<div class="card">
								<div class="card-header">
									<h5>Иловакунӣ</h5>
								</div>
								<div class="card-block">
									<form action="<?=MY_URL?>?option=students&action=insert" method="post" enctype="multipart/form-data">
										<table class="addform">
											<tr>
												<td colspan="2">
													<label for="id_faculty">Факултет:</label>
													<select name="id_faculty" id="id_faculty" class="form-control" required>
														<option value="0">-Интихоб кунед-</option>
														<?php foreach($faculties as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>											
												</td>
												
												<td>
													<label for="id_s_l">Зинаи таҳсил:</label>
													<select name="id_s_l" id="id_s_l" class="form-control" required>
														<?php foreach($studylevels as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>											
												</td>
											</tr>
											
											<tr>
												<td colspan="2">
													<label for="id_spec">Ихтисос:</label>
													<select name="id_spec" id="id_spec" class="form-control" required>
														<option value="0">-Факултетро интихоб кунед-</option>
													</select>	
												</td>
												
												<td>
													<label for="id_s_v">Намуди таҳсил:</label>
													<select name="id_s_v" id="id_s_v" class="form-control" required>
														<?php foreach($studyviews as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>	
												</td>
											</tr>
											
											<tr>
												<td class="w33">
													<label for="id_course">Курс:</label>
													<select name="id_course" id="id_course" class="form-control" required>
														<?php foreach($courses as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>	
												</td>
												
												<td class="w33">
													<label for="id_group">Гуруҳ:</label>
													<select name="id_group" id="id_group" class="form-control" required>
														<?php foreach($groups as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>	
												</td>
												
												<td class="w33">
													<label for="id_s_t">Шакли таҳсил:</label>
													<select name="id_s_t" id="id_s_t" class="form-control" required>
														<?php foreach($studytypes as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>	
												</td>
											</tr>
											
											<tr>
												<td id="loadsemetrs" colspan="3">
													<label>Семестҳоро интихоб кунед:</label><br>
													<?php for($nimsola = 1; $nimsola <= 2; $nimsola++):?>
														<div style="float: left; margin: 10px">
															
															<div class="checkbox-zoom zoom-success">
																<label class="semestr" for="semestr_<?=getSemestr(1, $nimsola)?>">
																	<input <?php if(H_Y == $nimsola){ echo "checked";}?> type="checkbox" name="semestr[<?=S_Y?>_<?=$nimsola?>]" id="semestr_<?=getSemestr(1, $nimsola)?>" value="<?=S_Y?>_<?=$nimsola?>">
																	<span class="cr">
																		<i class="cr-icon icofont icofont-ui-check txt-success"></i>
																	</span>
																	<span>Семестри <?=getSemestr(1, $nimsola)?> (Соли таҳсили <?=getStudyYear(S_Y)?>, Нимсолаи <?=$nimsola?>)</span>
																</label>
															</div>
														
														</div>
														<?php if($nimsola == H_Y) break; ?>
													<?php endfor;?>
												</td>
											</tr>
											
											<tr>
												<td colspan="2">
													<label for="fullname">Ном, насаб, номи падар:</label>
													<input type="text" name="fullname" id="fullname" class="form-control" required>	
												</td>
												<td>
													<label for="jins">Ҷинс:</label>
													<select name="jins" id="jins" class="form-control" required>
														<option value="">Интихоб кунед!!!</option>
														<option value="1">Мард</option>
														<option value="0">Зан</option>
													</select>
												</td>
											</tr>
											
											<tr>
												<td>
													<label for="login">Логин:</label>
													<input autocomplete="off" required type="text" name="login" id="login" class="form-control">
												</td>
												
												<td>
													<label for="password">Парол:</label>
													<input autocomplete="off" required type="text" name="password" id="password" class="form-control">
												</td>
												
												<td>
													<label for="photo">Расмро интихоб кунед:</label><br>
													<input type="file" name="photo" id="photo" >
												</td>
											</tr>
											
											<tr>
												<td>
													<label for="birthday">Рузи таввалуд:</label>
													<input type="date" name="birthday" id="birthday" class="form-control">
												</td>
												
												<td>
													<label for="number_passport">Рақами шиноснома:</label>
													<input autocomplete="off" type="text" name="number_passport" id="number_passport" placeholder="A02319960" class="form-control">
												</td>
												
												<td>
													<label for="phone">Телефон:</label>
													<input autocomplete="off" type="text" name="phone" id="phone" placeholder="+992987654321" class="form-control">
												</td>
											</tr>
											
											<tr>
												<td>
													<label for="id_country">Кишвар:</label>
													<select name="id_country" id="id_country" class="form-control">
														<?php foreach($countries as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>	
												</td>
												
												<td>
													<label for="id_region">Вилоят/Минтақа:</label>
													<select name="id_region" id="id_region" class="form-control">
														<option value="">-Интихоб кунед-</option>
														<?php foreach($regions as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['name']?></option>
														<?php endforeach;?>
													</select>	
												</td>
												
												<td>
													<label for="id_district">Ноҳия/Шаҳр:</label>
													<select name="id_district" id="id_district" class="form-control">
														<option value="">-Вилоятро интихоб кунед-</option>
														<?php foreach($districts as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['name']?></option>
														<?php endforeach;?>
													</select>	
												</td>
											</tr>
											
											<tr>
												<td>
													<label for="id_nation">Миллат:</label>
													<select name="id_nation" id="id_nation" class="form-control">
														<?php foreach($nations as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>	
												</td>
												
												<td colspan="2">
													<label for="current_address">Ҷойи зист:</label>
													<input autocomplete="off" type="text" name="current_address" id="current_address" class="form-control">
												</td>
											</tr>
											
											<tr>
												<td>
													<label>Дохилшавӣ ё интиқол:</label>
													<div class="form-radio">
														<div class="radio radio-inline">
														<label>
														<input type="radio" name="farmon_type" value="1" checked="checked">
														<i class="helper"></i>Дохилшавӣ аз ММТ
														</label>
														</div>
														
														<div class="radio radio-inline">
														<label>
														<input type="radio" name="farmon_type" value="2">
														<i class="helper"></i>Интиқол аз дигар МТОК
														</label>
														</div>
													</div>
												</td>
												
												<td>
													<label for="farmon_number">Рақами фармон:</label>
													<input autocomplete="off" type="text" name="farmon_number" id="farmon_number" class="form-control">
												</td>
												
												<td>
													<label for="farmon_date">Санаи фармон:</label>
													<input type="date" name="farmon_date" id="farmon_date" class="form-control">
												</td>
												
											</tr>
											
											<tr>
												<td>
													<br>
													<button type="submit" class="btn btn-inverse waves-effect waves-light">
														<i class="fa fa-save"></i> Сабткунӣ
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
		
		$('.addform').on("change", "#id_faculty, #id_s_l", function () {
			var id_faculty = $('.addform #id_faculty').val();
			var id_s_l = $('.addform #id_s_l').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getSpecs";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_l": id_s_l},
				success: function(data){
					$('#id_spec').html(data);
				}
			});
			
		});
		
		$('.addform').on("change", "#id_course", function () {
			var id_course = $('.addform #id_course').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getSemestr";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_course": id_course},
				success: function(data){
					$('#loadsemetrs').html(data);
				}
			});
			
		});
		
		$("#fullname").blur(function() {
			var fullname = $(this).val();
			$.trim(fullname);
			if(fullname == ''){
				return false;
			}
			
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=makeLogin";?>';
			
			$.ajax({
				type: 'post',
				url: url,
				data: {"fullname": fullname},
				success: function(data){
					$("#login").val(data);
					$("#password").val(data);
				}
			});
		});
		
		
		$('.addform').on("change", "#id_region", function () {
			var id_region = $('.addform #id_region').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getDistricts";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_region": id_region},
				success: function(data){
					$('#id_district').html(data);
				}
			});
			
		});
		
		
		
	});
</script>