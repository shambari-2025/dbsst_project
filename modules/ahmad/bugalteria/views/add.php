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
									<p id="info_std" style="font-size: 16px;"></p>
									
									<form name="add_form" action="<?=MY_URL?>?option=bugalteria&action=insert" method="post" enctype="multipart/form-data">
										<table class="addform">
											<tr>
												<td>
													<label for="fullname">Ном, насаб, номи падар:</label>
													<input type="text" name="fullname" id="fullname" class="form-control" required>	
												</td>
												<td>
													<label for="type">Намуд:</label>
													<select name="type" id="type" class="form-control" required>
														<option value="1">Довталаб</option>
														<option value="2">Хатмкунанда</option>
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
																								
											</tr>
											
																						
											<tr>
												<td>
													<br>
													<button type="submit" id="buttonsave" class="btn btn-inverse waves-effect waves-light">
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
		$("#buttonsave").click(function () {
			//$("#buttonsave").attr("disabled", true);
			//document.add_form.submit();
		});
		
		
		
		$('.addform').on("change", "#id_spec, #id_s_l, #id_s_v, #foreign", function () {
			var id_spec = $('.addform #id_spec').val();
			var id_s_l = $('.addform #id_s_l').val();
			var id_s_v = $('.addform #id_s_v').val();
			var foreign = $('.addform #foreign');
			
			
			if (foreign.is(':checked')) {
			   // Хориҷи
			  var other = 'xoriji';
			} else {
			   // Тоҷик
			  var other = 'tojik';
			}
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getShartnomaMoney";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_spec": id_spec, "id_s_l": id_s_l, "id_s_v": id_s_v, "other": other},
				success: function(data){
					$('#money').val(data);
				}
			});
			
		});
		
		
		
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
			var id_faculty = $('.addform #id_faculty').val();
			var fullname = $(this).val();
			
			$.trim(fullname);
			if(fullname == ''){
				return false;
			}
			
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=makeLogin";?>';
			
			$.ajax({
				type: 'post',
				url: url,
				data: {"id_faculty": id_faculty, "fullname": fullname},
				success: function(data){
					$("#login").val(data);
					$("#password").val(data);
				}
			});
			
			
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getMMTNumber";?>';
			
			$.ajax({
				type: 'post',
				url: url,
				data: {"fullname": fullname},
				success: function(data){
					
					var data = JSON.parse(data);
					
					if(!data.error){
						$("#number_mmt").val(data.mmtNumber);
						$("#score_mmt").val(data.score);
						$("#phone").val(data.phone);
						$("#parent_phone").val(data.parent_phone);
						
						$("#info_std").html(data.info);
					}
				}
			});
			
		});
		
		
		$('.addform').on("change", "#id_country", function () {
			var id_country = $('.addform #id_country').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getRegions";?>';
			
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