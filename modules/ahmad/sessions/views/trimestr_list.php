<script type="text/javascript">
	$.cookie('timer', null);
	$.cookie('exit_time', null);
</script>

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
							Триместр
						</li>
						
						<li class="breadcrumb-item">
							<?=getStudyYear(S_Y)?>
						</li>
						
						<li class="breadcrumb-item">
							Нимсолаи <?=(H_Y)?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<?php if(isset($_SESSION['kori_kursi'])):?>
		<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
			<i class="fa fa-warning"></i> <?=$_SESSION['kori_kursi']?>
		</div>
		<?php unset($_SESSION['kori_kursi']);?>
	<?php endif;?>
	
	<?php if(isset($_SESSION['not_imt_status'])):?>
		<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
			<i class="fa fa-warning"></i> <?=$_SESSION['not_imt_status']?>
		</div>
		<?php unset($_SESSION['not_imt_status']);?>
	<?php endif;?>
	
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						
						<?php// if(IMT_STATUS):?>
						<?php if(1):?>
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5><?=$page_info['title']?></h5>
								</div>
								<div class="card-block">
									
									<?php if($id_s_t == 1):?>
										<?php if(($mablagi_shartnoma / 2) > $mablag_suporid):?>
											<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
												<i class="fa fa-warning"></i> Шумо барои насупоридани маблағи шартномаи таҳсил, ба имтиҳонҳо ворид шуда наметавонед!
											</div>
											<?php $flag = false;?>
										<?php endif;?>
									<?php endif;?>
									
									
									<?php if(($summa_suporid < $summa_trimestr)):?>
										<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
											<i class="fa fa-warning"></i> Шумо маблағи триместрро насупоридаед! Маблағи триместр <u><?=$summa_trimestr?></u>-сомониро ташкил медиҳад.<br>
											Маблағи супоридагии Шумо <u><?=$summa_suporid?></u>-сомониро ташкил медиҳад. <br>Бақияи маблағро супоред ва баъдан ба ин саҳифа даромада метавонед!
										</div>
										<?php $flag = false;?>
									<?php endif;?>
									
									<!-- Дар ҳолати шартномаро супоридаги бошад! --> 
									<?php if($flag):?>
									
										<?php if($fanho):?>
											<form action="<?=MY_URL?>?option=sessions&action=suporidan_trimsetr" method="post" enctype="multipart/form-data">
												<select name="id_fan" id="id_fan" size="8" multiple="desibled" class="form-control">
													<?php $counter = 1;?>
													<?php foreach($fanho as $item): ?>
														<option <?php if($counter == 1){echo "selected";} ?> value="<?=$item['id_fan']?>" title="<?=getFanTest($item['id_fan']);?>"><?=getFanTest($item['id_fan']);?></option>
													<?php $counter++;?>
													<?php endforeach; ?>
												</select>
												<br>
												<button type="submit" class="btn btn-inverse">Супоридан</button>
											</form>
										<?php else:?>
											<p class="center">Ягон фан фаъол нест</p>
											<!--
											<script type="text/javascript">
												if($.cookie("exit_time")){
													var seconds = $.cookie("exit_time");
												}else{
													var seconds = 15;
													$.cookie("exit_time", seconds);
												}
												
												function timer(){
													var obj = document.getElementById('timer');
													seconds--;
													if(seconds < 10){
														seconds = "0"+seconds;
													}
													$.cookie("exit_time", seconds);
													if(obj){
														obj.innerHTML = seconds;
													}
													if(seconds < 1){
														document.location = '<?=URL."?option=logout"?>';
													}else{
														setTimeout(timer,1000);
													}
												}
												//setTimeout(timer,1000);
											</script>
											<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown myalert">
												Шумо ҳамаи тестҳоро супоридаед. Мо Шуморо баъди <span id="timer">15</span> сония аз система мебарорем!
											</div>
											-->
										<?php endif;?>
									<?php endif;?>
									<!-- Дар ҳолати шартномаро супоридаги бошад! --> 
								</div>
							</div>
						</div>
						
						<?php endif;?>
						
						<!--
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>Натиҷаи имтиҳонҳо</h5>
								</div>
								<div class="card-block">
									<div class="table-responsive">
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th style="width:40px">№</th>
													<th style="width:200px">Номгӯи фанҳо</th>
													<th style="width:150px">Омӯзгор</th>
													<th style="width:70px"><div class="vertical">НФ 1</div></th>
													<th style="width:70px"><div class="vertical">НФ 2</div></th>
													<th style="width:50px"><div class="vertical">Маъмури</div></th>
													<th style="width:50px"><div class="vertical">Имтиҳон</div></th>
													<th style="width:50px"><div class="vertical">Ҷамъ</div></th>
													<th style="width:50px">Бо ҳарф</th>
													<th style="width:50px">Бо адад</th>
												</tr>
											</thead>
											<tbody class="center">
												
												<?php if(!empty($results)):?>
													<?php $counter = 0;?>
													<?php foreach($results as $item):?>
														<tr>
															<th scope="row"><?=++$counter?>.</th>
															<td class="left"><?=getFan($item['id_fan'])?></td>
															<td><?=getTeacher($id_faculty, $id_course, $id_spec, $id_group, $item['id_fan'], $S_Y, $H_Y);?></td>
															<td><?=$item['r_1']?></td>
															<td><?=$item['r_2']?></td>
															<td><?=$item['admin_score']?></td>
															<td>
																<?php if($item['imt_score']):?>
																	<?=$item['imt_score']?>
																<?php else:?>
																	0
																<?php endif;?>
															</td>
															<td class="bold ">
																<?php if($item['allscore']):?>
																	<?=$all_score = $item['allscore']?>
																<?php else:?>
																	<?=$all_score = 0?>
																<?php endif;?>
															</td>
															<td class="bold <?php if($item['allscore'] < 50){ echo "grey";}?>"><?=getLatter($all_score)?></td>
															<td class="bold <?php if($item['allscore'] < 50){ echo "grey";}?>"><?=getAdad($all_score)?></td>
														</tr>
													<?php endforeach;?>
												<?php else: ?>
													<tr class="center bold">
														<td colspan="10">
															<i class="fa fa-warning"></i> 
															Маълумот нест!
														</td>
													</tr>
												<?php endif;?>
											</tbody>
										</table>
									</div>
								
								</div>
							</div>
						</div>
						-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
