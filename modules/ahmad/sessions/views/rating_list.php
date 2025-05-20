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
							Имтиҳонҳо <?=date("d.m.Y H:i:s")?>
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
	
	
	<?php if(isset($_SESSION['late'])):?>
		<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
			<i class="fa fa-warning"></i> <?=$_SESSION['late']?>
		</div>
		<?php unset($_SESSION['late']);?>
	<?php endif;?>
	
	<?php if(isset($_SESSION['guzarish_score'])):?>
		<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
			<i class="fa fa-warning"></i> <?=$_SESSION['guzarish_score']?>
		</div>
		<?php unset($_SESSION['guzarish_score']);?>
	<?php endif;?>
	
	<?php if(isset($_SESSION['kori_kursi'])):?>
		<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
			<i class="fa fa-warning"></i> <?=$_SESSION['kori_kursi']?>
		</div>
		<?php unset($_SESSION['kori_kursi']);?>
	<?php endif;?>
	
	<?php if(isset($_SESSION['score_not_found'])):?>
		<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
			<i class="fa fa-warning"></i> <?=$_SESSION['score_not_found']?>
		</div>
		<?php unset($_SESSION['score_not_found']);?>
	<?php endif;?>
	
	<?php if(isset($_SESSION['not_imt_status'])):?>
		<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
			<i class="fa fa-warning"></i> <?=$_SESSION['not_imt_status']?>
		</div>
		<?php unset($_SESSION['not_imt_status']);?>
	<?php endif;?>
	
	<!-- Қарздори фанни -->
	<?php /*<?php if(isset($_SESSION['qarzdorii_peshina'])):?>
		<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
			<i class="fa fa-warning"></i> <?=$_SESSION['qarzdorii_peshina']?>
		</div>
		<?php unset($_SESSION['qarzdorii_peshina']);?>
	<?php endif;?>
	<!-- Қарздори фанни -->
	
	<!-- Қарздори кори курсӣ -->
	<?php if(isset($_SESSION['qarzdorii_kk'])):?>
		<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
			<i class="fa fa-warning"></i> <?=$_SESSION['qarzdorii_kk']?>
		</div>
		<?php unset($_SESSION['qarzdorii_kk']);?>
	<?php endif;?>
	<!-- Қарздори кори курсӣ -->
	
	<!-- Қарздори фарқият -->
	<?php if(isset($_SESSION['qarzdorii_farqiyat'])):?>
		<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
			<i class="fa fa-warning"></i> <?=$_SESSION['qarzdorii_farqiyat']?>
		</div>
		<?php unset($_SESSION['qarzdorii_farqiyat']);?>
	<?php endif;?>
	<!-- Қарздори фарқият -->
	*/?>
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
										
										<!-- Дар ҳолати шартномаро супоридаги бошад! --> 
										<?php if($flag):?>
										
											<?php if($fanho):?>
												<form action="<?=MY_URL?>?option=sessions&action=suporidan_rating" method="post" enctype="multipart/form-data">
													<select name="id_test" id="id_test" size="8" multiple="desibled" class="form-control">
														<?php $counter = 1;?>
														<?php foreach($fanho as $item): ?>
															<option <?php if($counter == 1){echo "selected";} ?> value="<?=$item['id']?>" title="<?=getFanTest($item['id_fan']);?>"><?=getFanTest($item['id_fan']);?></option>
														<?php $counter++;?>
														<?php endforeach; ?>
													</select>
													<br>
													<input type="hidden" name="rating" id="rating" value="<?=$rating?>">
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
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
