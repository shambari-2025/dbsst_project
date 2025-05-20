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
							Руйхати VIP
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
									<table class="addform">
										<tr>
											<p class="error" style="display: none">Аввал факултетро интихоб кунед!</p>
											<td colspan="2">
												<label for="faculty">Факултетро интихоб кунед:</label>
												<select name="faculty" id="faculty" class="form-control">
													<option value="0" selected disabled>-Факултетро интихоб кунед-</option>
													<?php foreach($faculties as $faculty): ?>
														<option value="<?=$faculty['id'];?>"><?=getFaculty($faculty['id']); ?></option>
													<?php endforeach; ?>
												</select>
											</td>
											
											<td>
												<label for="course">Курсро интихоб кунед:</label>
												<select name="course" id="course" class="form-control">
													<?php foreach($courses as $course_item): ?>
														<option value="<?=$course_item['id'];?>"><?=$course_item['title']; ?></option>
													<?php endforeach; ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td colspan = "2" id="specialtyblock">
												<label for="specialty" >Ихтисосро интихоб кунед:</label>
												<select name="specialty" id="specialty" class="form-control">
													<option value="0" selected disabled>-Факултетро интихоб кунед-</option>
												</select>
											</td>
											<td>
												<label for="group">Гуруҳро интихоб кунед:</label>
												<select name="group" id="group" class="form-control">
													<?php foreach($groups as $group_item): ?>
														<option value="<?=$group_item['id'];?>"><?=$group_item['title']; ?></option>
													<?php endforeach; ?>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan = "1">
												<label for="s_y">Соли таҳсилро интихоб кунед:</label>
												<select name="s_y" id="s_y" class="form-control">
													<?php foreach($study_years as $s_y): ?>
														<option <?php if($s_y['id'] == S_Y) {echo "selected";}?> value="<?=$s_y['id'];?>"><?=$s_y['title']; ?></option>
													<?php endforeach; ?>
												</select>
											</td>
											
											<td colspan = "1">
												<label for="h_y">Нимсолаи таҳсилро интихоб кунед:</label>
												<select name="h_y" id="h_y" class="form-control">
													<?php if(H_Y == 1): ?>
														<option value="1">Нимсолаи 1-ум</option>
														<option value="2">Нимсолаи 2-юм</option>
													<?php else:?>
														<option value="2">Нимсолаи 2-юм</option>
														<option value="1">Нимсолаи 1-ум</option>
													<?php endif;?>
												</select>
											</td>
											
											<td colspan="1">
												<br>
												<button type="button" class="load_btn btn btn-success" style="padding: 7px; margin-top:6px">
													<i class="fa fa-search"></i> Ҷустуҷуи маълумотҳо
												</button>
											</td>
										</tr>
									</table>
									
									<div id="nextdatas">
										
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
		
		/* Барои баровардани ихтисосҳои амалкунанда*/
		$('.addform').on("change", "#faculty, #course, #s_y, #h_y", function () {
			var id_faculty = $('.addform #faculty').val();
			var id_course = $('.addform #course').val();
			var s_y = $('.addform #s_y').val();
			var h_y = $('.addform #h_y').val();
			
			if(id_faculty){
				$('p.error').hide();
			}else{
				$('p.error').show();
			}
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/jd/jd_ajax.php?option=getSpecs";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"my_url": my_url, "id_faculty":id_faculty, "id_course": id_course, "s_y": s_y, "h_y": h_y},
				success: function(data){
					$('#specialty').html(data);
				}
			});
		});
		/* Барои баровардани ихтисосҳои амалкунанда*/
		
		/* Барои баровардани Контингент*/
		
		$('.load_btn').on('click', function(){
			var id_faculty = $('.addform #faculty').val();
			var id_course = $('.addform #course').val();
			var id_spec = $('.addform #specialty').val();
			var id_group = $('.addform #group').val();
			var s_y = $('.addform #s_y').val();
			var h_y = $('.addform #h_y').val();
			
			if(id_faculty){
				$('p.error').hide();
			}else{
				$('p.error').show();
			}
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=getStudenList";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"my_url": my_url, "id_faculty":id_faculty, "id_course": id_course, "id_spec": id_spec, "id_group": id_group, "s_y": s_y, "h_y": h_y},
				success: function(data){
					$('#nextdatas').html(data);
				}
			});
		});
		/* Барои баровардани Контингент*/
		
	});
</script>