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
							Маводи дарсӣ
						</li>
						
						<li class="breadcrumb-item">
							Иловакунӣ
						</li>
						
						<li class="breadcrumb-item">
							<?=getFan($info[0]['id_fan'])?>
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
									<h5><?=getFan($info[0]['id_fan'])?></h5>
								</div>
								<div class="card-block">
									
									<table class="table" style="font-size: 14px !important">
										<tbody>
											<?php foreach($weeks as $item):?>
												
												<?php
												$mavzu = query("SELECT * FROM `mavodho` WHERE `id_week` = '".$item['id']."' AND `id_fan` = '".$info[0]['id_fan']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
												$suporish = query("SELECT * FROM `suporishho` WHERE `id_week` = '".$item['id']."' AND `id_fan` = '".$info[0]['id_fan']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'");
												
												?>
												<tr>
													<th class="center" colspan="4" style="text-transform: uppercase; background: #eae9e9;">
														<h5><?=$item['title']?></h5>
													</th>
												</tr>
												
												<tr>
													<th style="width: 150px">Мавзуи <?=$item['id']?></th>
													<td class="left bold">
														
														<?php if(!empty($mavzu)):?>
															<?=$mavzu[0]['title']?>
														<?php else:?>
															<p class="center red"><i class="fa fa-warning"></i> Маълумот нест</p>
														<?php endif;?>
														
													</td>
													
													<td style="width: 80px">
														<i class="fa fa-eye"></i> 
														<?php if(empty($mavzu)):?>
															0
														<?php else:?>
															<?=$mavzu[0]['views']?>
														<?php endif;?>
													</td>
													
													<td class="center elements" style="width: 175px">
														
														<?php if(empty($mavzu)):?>
															<a href="<?=MY_URL?>?option=mylessons&action=addlesson&id_jd=<?=$id?>&id_fan=<?=$info[0]['id_fan']?>&id_week=<?=$item['id']?>"><i class="fa fa-plus"></i> </a>
														<?php else:?>
															<a href="<?=MY_URL?>?option=mylessons&action=editlesson&id=<?=$mavzu[0]['id']?>"><i class="fa fa-edit"></i> </a>
														<?php endif;?>
														
														<!--<a href="#"><i class="fa fa-trash"></i> </a>-->
													</td>
												</tr>
												<tr>
													<th style="width: 150px">Супориши <?=$item['id']?></th>
													<td class="left">
														
														<?php if(!empty($suporish)):?>
															<?=$suporish[0]['title']?>
														<?php else:?>
															<p class="center red bold"><i class="fa fa-warning"></i> Маълумот нест</p>
														<?php endif;?>
														
													</td>
													
													<td>
														<i class="fa fa-eye"></i> 
														<?php if(empty($suporish)):?>
															0
														<?php else:?>
															<?=$suporish[0]['views']?>
														<?php endif;?>
													</td>
													<td class="center elements" style="width: 175px">
														
														<?php if(empty($suporish)):?>
															<a href="<?=MY_URL?>?option=mylessons&action=addsuporish&id_jd=<?=$id?>&id_fan=<?=$info[0]['id_fan']?>&id_week=<?=$item['id']?>"><i class="fa fa-plus"></i> </a>
														<?php else:?>
															<a href="<?=MY_URL?>?option=mylessons&action=editsuporish&id=<?=$suporish[0]['id']?>"><i class="fa fa-edit"></i> </a>
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