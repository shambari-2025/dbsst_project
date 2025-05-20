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
							Нақшаҳои таълимӣ
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
									<form action="<?=MY_URL?>?option=nt&action=insert" method="post" enctype="multipart/form-data">
										<table class="addform">
											<tr>
												<td colspan="2">
													<label for="id_faculty">Факултет:</label>
													<select name="id_faculty" id="id_faculty" class="form-control" required>
														<option value="">-Интихоб кунед-</option>
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
												<td style="width:55%">
													<label for="id_spec">Ихтисос:</label>
													<select name="id_spec" id="id_spec" class="form-control" required>
														<option value="">-Факултетро интихоб кунед-</option>
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
												<td>
													<label for="soli_tasdiq"><span class="text-c-red">*</span>  Соли тасдиқи нақша:</label>
													<select name="soli_tasdiq" id="soli_tasdiq" class="form-control" required>
														<option value="">Интихоб кунед!!!</option>
														<?php for($i = 2016; $i <= date('Y'); $i++): ?>
															<option value="<?=$i?>">Соли <?=$i?></option>
														<?php endfor; ?>
													</select>
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
			var url = '<?=URL."modules/students/students_ajax.php?option=getSpecs";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_l": id_s_l},
				success: function(data){
					$('#id_spec').html(data);
				}
			});
		});
		
		
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