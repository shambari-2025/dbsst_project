<style>
	.card-block label {
		cursor: pointer;
		display: block;
		margin: 5px 0;
	}
</style>


<script type="text/javascript">
	$.cookie('select_time', null);
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
							Натиҷаи санҷиши рейтингӣ
						</li>
						
						<li class="breadcrumb-item">
							<?=getFanTest($id_fan)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getStudyYear($S_Y)?>
						</li>
						
						<li class="breadcrumb-item">
							Нимсолаи <?=($H_Y)?>
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
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>Натиҷа</h5>
								</div>
								<div class="card-block">
									
									<table style="width: 100%;">
										<tr class="center" style="background-color: #263544; color: #fff;">
											<th style="padding: 10px">Миқдори ҷавобҳо дуруст</th>
											<th style="padding: 10px">Холи максималӣ</th>
										</tr>
										<tr class="center" style="font-size: 100px; \">
											<th>
												<?=$javob_durust_total?>
											</th>
											<th>
												<?=SCORE_IMT?>
											</th>
										</tr>
										
										<tr></tr>
										
										<tr class="center" style="background-color: #09af1b; color: #fff;">
											<th style="padding: 10px">Ҷавобҳои дуруст</th>
											<th style="padding: 10px">Холи Шумо</th>
										</tr>
										<tr class="center" style="font-size: 100px;">
											<th>
												<span class="spincrement"><?=$javob_durust_student?></span>
											</th>
											<th>
												<span class="spincrement"><?=$score?></span>
											</th>
										</tr>
										
									</table>
									<br>
									<br>
									<script type="text/javascript">
										if($.cookie("select_time")){
											var seconds = $.cookie("select_time");
										}else{
											var seconds = 10;
											$.cookie("select_time", seconds);
										}
										
										function timer(){
											var obj = document.getElementById('timer');
											seconds--;
											if(seconds < 10){
												seconds = "0"+seconds;
											}
											$.cookie("select_time", seconds);
											if(obj){
												obj.innerHTML = seconds;
											}
											if(seconds < 1){
												document.location = '<?=MY_URL?>';
											}else{
												setTimeout(timer,1000);
											}
										}
										setTimeout(timer,1000);
									</script>
									<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown myalert">
										Шуморо баъди <span id="timer">10</span> сония ба саҳифаи интихоб мефиристем!
									</div>
									
									<br>
									<a href="<?=MY_URL?>" class="btn waves-effect waves-light btn-inverse">
										Ба саҳифаи асосӣ
									</a>
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
	$(document).ready(function (){
		$('.spincrement').spincrement({
			from: 0,
			decimalPlaces: 0,
			duration: 3000,
		});
	});
</script>