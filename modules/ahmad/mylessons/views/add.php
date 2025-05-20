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
							Ҷадвали дарсҳо
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
									<form action="<?=MY_URL?>?option=jd&action=insert" method="post" enctype="multipart/form-data">
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
											</tr>
										</table>
										
										<div id="nextdatas">
											<?php //include("newform.php");?>
										</div>
										
										<table style="width:100%">
											<tr>
												<td colspan="2">
													<br>
													<button type="submit" class="btn btn-success">Сабт кардан</button>
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
		
		/* Барои баровардани Фанҳо аз  нақшаҳои таълимӣ*/
		$('.addform').on("change", "#faculty, #course, #specialty, #s_y, #h_y", function () {
			var id_faculty = $('.addform #faculty').val();
			var id_course = $('.addform #course').val();
			var id_spec = $('.addform #specialty').val();
			var s_y = $('.addform #s_y').val();
			var h_y = $('.addform #h_y').val();
			
			if(id_faculty){
				$('p.error').hide();
			}else{
				$('p.error').show();
			}
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/jd/jd_ajax.php?option=getFanFromNT";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"my_url": my_url, "id_faculty":id_faculty, "id_course": id_course, "id_spec": id_spec, "s_y": s_y, "h_y": h_y},
				success: function(data){
					$('#nextdatas').html(data);
				}
			});
		});
		/* Барои баровардани Фанҳо аз  нақшаҳои таълимӣ*/
		
		
		
		$('.addform').on("change", "#id_faculty, #id_s_l, #id_spec, #id_s_v, #soli_tasdiq", function () {
			var id_faculty = $('.addform #id_faculty').val();
			var id_s_l = $('.addform #id_s_l').val();
			var id_spec = $('.addform #id_spec').val();
			var id_s_v = $('.addform #id_s_v').val();
			var soli_tasdiq = $('.addform #soli_tasdiq').val();
			
			console.log(id_faculty);
			console.log(id_s_l);
			console.log(id_spec);
			console.log(id_s_v);
			console.log(soli_tasdiq);
			
			if(id_faculty !== null && id_s_l !== null && id_spec !== '' && id_s_v !== null && soli_tasdiq !== ''){
				console.log("dfsdf");
			}
			
			
		});
	});
</script>