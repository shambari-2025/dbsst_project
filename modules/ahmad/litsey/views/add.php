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
							Литсей
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
									<h5>Иловакунии хонандаи литсей</h5>
								</div>
								<div class="card-block">
									<form action="<?=MY_URL?>?option=litsey&action=insert" method="post" enctype="multipart/form-data">
										<table class="addform">
											
											<tr>
												<td>
													<label for="id_sinf">Синфро интихоб кунед:</label>
													<select name="id_sinf" id="id_sinf" class="form-control">
														<?php foreach($id_sinf as $v => $k): ?>
															<option value="<?=$v;?>"><?=$k?></option>
														<?php endforeach; ?>
													</select>
												</td>
												
												<td>
													<label for="id_group">Гуруҳро интихоб кунед:</label>
													<select name="id_group" id="id_group" class="form-control">
														<?php foreach($groups as $item): ?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach; ?>
													</select>
												</td>
												
											</tr>
											
											
											<tr>
												<td colspan="2">
													<label for="fullname">Ном, насаб, номи падар:</label>
													<input autocomplete="off" type="text" name="fullname" id="fullname" class="form-control" required>	
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
												<td colspan="2">
													<label for="fullname_ru">Ном, насаб, номи падар (Русӣ):</label>
													<input autocomplete="off" type="text" name="fullname_ru" id="fullname_ru" class="form-control" required>	
												</td>
												
												<td>
													<label for="email">E-mail:</label>
													<input autocomplete="off" type="text" name="email" id="email" class="form-control">
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
													<label for="phone">Телефон:</label>
													<input autocomplete="off" type="text" name="phone" id="phone" placeholder="+992987654321" class="form-control">
												</td>
												
												<td>
													<label for="parent_phone">Телефони волидайн:</label>
													<input autocomplete="off" type="text" name="parent_phone" id="parent_phone" placeholder="+992987654321" class="form-control">
												</td>
											</tr>
											
											<tr>
												<td>
													<label for="id_country">Мамлакат:</label>
													<select name="id_country" id="id_country" class="form-control">
														<option value="">-Интихоб кунед-</option>
														<?php foreach($countries as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>	
												</td>
												
												<td>
													<label for="id_region">Вилоят/Минтақа:</label>
													<select name="id_region" id="id_region" class="form-control">
														<option value="">-Мамлакатро интихоб кунед-</option>
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
													<textarea cols="40" rows="2" name="current_address" id="current_address" class="form-control"></textarea>
												</td>
											</tr>
											
											
											
											<tr>
												<td>
													<label for="vazi_ijtimoi">Вазъи иҷтимоӣ:</label>
													<select name="vazi_ijtimoi" id="vazi_ijtimoi" class="form-control">
														<?php foreach($vazi_ijtimoi as $v => $k): ?>
															<option value="<?=$v;?>"><?=$k?></option>
														<?php endforeach; ?>
													</select>
												</td>
												
												<td>
													<label for="az_oilai_ki">Аз оилаи кӣ:</label>
													<select name="az_oilai_ki" id="az_oilai_ki" class="form-control">
														<?php foreach($az_oilai_ki as $v => $k): ?>
															<option value="<?=$v;?>"><?=$k?></option>
														<?php endforeach; ?>
													</select>
												</td>
												
												<td>
													<label for="vazi_oilavi">Ятим:</label>
													<select name="vazi_oilavi" id="vazi_oilavi" class="form-control">
														<?php foreach($vazi_oilavi as $item):?>
															<option value="<?=$item['id'];?>"><?=$item['title']?></option>
														<?php endforeach;?>
													</select>
												</td>
												
											</tr>
											
											
											
											
											<tr>
												<td colspan="3">
													<label for="family_info">Маълумот дар бораи аҳли оила:</label>
													<textarea rows="5" style="width:100%" name="family_info" id="family_info" class="form-control">Падар - Модар -</textarea>
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
		
		
		
		$('.addform').on("change", "#id_country", function () {
			var id_country = $('.addform #id_country').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getRegions";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_country": id_country},
				success: function(data){
					$('#id_region').html(data);
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