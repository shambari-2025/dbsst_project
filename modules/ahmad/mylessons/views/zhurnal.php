
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
							Журнали электронӣ
						</li>
						
						<li class="breadcrumb-item">
							<?=getStudyYear(S_Y)?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--
	<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown"
	style="text-align: center;background: #a02727;color: #fff;font-weight: bold;">
		<i class="fa fa-warning"></i> 
		<h3>Баҳои донишҷӯёне, ки шартномаи таҳсил ва имтиҳонҳои нимсолаи якумро пурра <br> насупоридаанд, дар давраи имтиҳонҳои нимсолаи дуюм сабт намешавад!!</h3>
	</div>
	-->
	
	
	<!--
	<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert"><i class="fa fa-warning"></i> 
		Барои бартараф намудани камбудиҳои ҷойдошта, гузоштани рейтинг санаи 28.10.2023 аз соати 8-00 то 16-00 кушода мешавад!
	</div>
	-->
	
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
						
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>Журнали электронӣ [<?=$_SESSION['user']['id']?>]</h5>
									
								</div>
								
								
								<div class="card-block accordion-block color-accordion-block">
									
									<div class="color-accordion" id="color-accordion">
										<?php if(H_Y == 2):?>
											<a class="accordion-msg bg-dark-primary b-none waves-effect waves-light">Нимсолаи 2</a>
											<div class="accordion-desc">
												<div class="table-responsive davrifaol">
													<table class="table" style="font-size:14px">
														<thead class="center">
															<tr style="background-color: #263544; color: #fff">
																<th style="width:40px">№</th>
																<th style="width:50px"><div class="vertical">ID ФАН</div></th>
																<th style="width:50px"><div class="vertical">Семестр</div></th>
																<th>Номгӯи фанҳо</th>
																<th style="width:70px">Факултет</th>
																<th style="width:70px">Зинаи таҳсил</th>
																<th style="width:70px">Намуди таҳсил</th>
																<th style="width:70px">Курс</th>
																<th style="width:200px">Ихтисос</th>
																<th style="width:200px">Амалҳо</th>
															</tr>
														</thead>
														<tbody class="center">
															
															<?php if(!empty($lessons_n_2)):?>
																<?php $counter = 0;?>
																<?php foreach($lessons_n_2 as $item):?>
																	<tr>
																		<th scope="row"><?=++$counter?>.</th>
																		<th scope="row"><?=$item['id_fan']?></th>
																		<th scope="row"><?=$item['semestr']?></th>
																		<td class="left">
																			<?=getFanTest($item['id_fan'])?>
																			<?php
																				if($item['type'] == 'kori_kursi'){
																					echo "(Кори курсӣ)";
																				}if($item['type'] == 'loihai_kursi'){
																					echo "(Лоиҳаи курсӣ)";
																				}
																			?>
																		</td>
																		
																		
																		<td>
																			<span title="<?=getFaculty($item['id_faculty'])?>">
																				<?=getFacultyShort($item['id_faculty'])?>
																			</span>
																		</td>
																		
																		<td><?=getStudyLevel($item['id_s_l'])?></td>
																		<td><?=getStudyView($item['id_s_v'])?></td>
																		<td><?=$item['id_course']?></td>
																		
																		<td>
																			<span title="<?=getSpecialtyTitle($item['id_spec'])?>">
																				<?=getSpecialtyCode($item['id_spec'])?>
																			</span>
																			<?=getGroup2($item['id_group'])?>
																		</td>
																		
																		<td class="elements">
																			<a class="add_zhurnal" href="javascript" data-toggle="modal" data-target=".bs-example-modal-lg" 
																				data-id="<?=$item['id_iqtibos']?>" 
																				data-faculty="<?=getFacultyShort($item['id_faculty'])?>" 
																				data-level="<?=getStudyLevel($item['id_s_l'])?>" 
																				data-view="<?=getStudyView($item['id_s_v'])?>" 
																				data-course="<?=getCourse($item['id_course'])?>" 
																				data-spec="<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>" 
																				data-rating="<?=RATING?>"
																				data-fan="<?=getFanTest($item['id_fan'])?>"
																				title="Кушодани журнал">
																				<i class="fa fa-plus"></i>
																			</a>
																		</td>
																	</tr>
																<?php endforeach;?>
															<?php else: ?>
																<tr class="center bold">
																	<td colspan="11">
																		<i class="fa fa-warning"></i> Маълумот нест.
																	</td>
																</tr>
															<?php endif;?>
														</tbody>
													</table>
												</div>
											
											</div>
										<?php endif;?>
										
										
										<hr>
										
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
		
		$('.add_zhurnal').on('click', function(){
			var id_iqtibos = $(this).attr("data-id");
			var faculty = $(this).attr("data-faculty");
			var level = $(this).attr("data-level");
			var view = $(this).attr("data-view");
			var course = $(this).attr("data-course");
			var spec = $(this).attr("data-spec");
			var fan = $(this).attr("data-fan");
			var rating = $(this).attr("data-rating");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/mylessons/mylessons_ajax.php?option=getZhurnalForm";?>';
			
			
			title = "Журнал " + " / Рейтинг: "  + rating + " / " + faculty + " / "  + level + " / "  + view + " / "  + course + " / "  + spec + " / "  + fan;
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text(title);
			
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"title": title, "id_iqtibos": id_iqtibos, "my_url": my_url, "rating": rating},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').append(data);
				}
			});
			$('#bigmodal').html("");
		});
		
		
		
		
	});
</script>
