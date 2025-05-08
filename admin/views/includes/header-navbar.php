<nav class="navbar header-navbar pcoded-header">
	<div class="navbar-wrapper">
		<!-- LOGO -->
		<div class="navbar-logo">
			<a href="<?=MY_URL?>">
				<img class="img-fluid" src="<?=TMPL_URL?>png/logo2.png" alt="Theme-Logo" />
			</a>
			<a class="mobile-menu" id="mobile-collapse" href="#!">
				<i class="feather icon-menu icon-toggle-right"></i>
			</a>
			<a class="mobile-options waves-effect waves-light">
				<i class="feather icon-more-horizontal"></i>
			</a>
		</div>
		<!-- LOGO -->
		
		<div class="navbar-container container-fluid">
			<ul class="nav-left">
				<li class="header-search">
					<div class="main-search morphsearch-search">
						<div class="input-group">
							<form action="<?=MY_URL?>?option=search&action=tmp" method="post" style="display: -webkit-box;">
								<span class="input-group-prepend search-close">
									<i class="feather icon-x input-group-text"></i>
								</span>
								<input autocomplete="off" type="text" name="search" class="input-search form-control" placeholder="Номи донишҷӯ">
								<span class="input-group-append search-btn">
									<i class="feather icon-search input-group-text"></i>
								</span>
							</form>
						</div>
					</div>
				</li>
				<li>
					<a href="#!" onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" class="waves-effect waves-light" data-cf-modified-d8424a08d31b5b8b406fded2-="">
						<i class="full-screen feather icon-maximize"></i>
					</a>
				</li>
				<li>
				<?php $study_years  = query("SELECT * FROM `study_years` WHERE `id` >= '23' ORDER BY `id`");?>
				<form method="post" action="<?=MY_URL?>?option=change_syhy">
					<select name="study_year">
						<?php foreach($study_years as $sy):?>
							<option <?php if(S_Y == $sy['id']){echo "selected ";}?>value="<?=$sy['id']?>"><?=$sy['title']?></option>
						<?php endforeach;?>
					</select>/ 
					<select name="half_year">
						<option <?php if(H_Y == 1){echo "selected ";}?> value="1">1</option>
						<option <?php if(H_Y == 2){echo "selected ";}?>value="2">2</option>
					</select>
					<input type="submit" value=">>">
				</form>
				</li>
			</ul>
			
			
			<ul class="nav-right">
				
				<h5 style="font-size: 16px; float:left; margin-top: 28px">
					<?=getStudyYear(S_Y)?>, <?=getHalfYear(H_Y)?>, ҳафтаи <?=WEEK?>
				</h5>
				
				<li class="header-notification">
					<div class="dropdown-primary dropdown">
						<div class="dropdown-toggle" data-toggle="dropdown">
							<i class="feather icon-bell"></i>
							<span class="badge bg-c-red"><?=count($birthdays)?></span>
						</div>
						<ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
							<li>
								<h6>Имрӯз зодрӯз доранд</h6>
							</li>
							<?php foreach($birthdays as $bday):?>
								<?php if($bday['access_type'] != 3):?>
									<?php $photo = getUserImg($bday['id'], $bday['jins'], $bday['photo'], $bday['access_type']);?>
								<?php else:?>	
									<?php $photo = getUserImg($bday['id'], $bday['jins'], $bday['photo']);?>
								<?php endif;?>
								
								<?php if($bday['access_type'] == 1){
									$vaz = '[админ]';
								}elseif($bday['access_type'] == 2){
									$vaz = '[омӯзгор]';
								}elseif($bday['access_type'] == 3){
									$vaz = '[донишҷӯ]';
								}?>
								<li>
									<div class="media">
										<img class="img-radius" src="<?=$photo?>" alt="Generic placeholder image">
										<div class="media-body">
											<h5 class="notification-user"><?=$bday['fullname_tj']?></h5>
											<p class="notification-msg"><?=$vaz?>, <?=getSinuSol($bday['birthday'])?> сола мешавад!</p>
										</div>
									</div>
								</li>
							<?php endforeach;?>
							
							<li style="padding: 10px 20px;margin-bottom: 0;">
								<h6 style="font-size: 14px;margin-bottom: 0;">Пагоҳ зодрӯз доранд: [<?="$nextDay.$m";?>]</h6>
							</li>
							<?php foreach($birthdays_next_day as $bday):?>
								<?php if($bday['access_type'] != 3):?>
									<?php $photo = getUserImg($bday['id'], $bday['jins'], $bday['photo'], $bday['access_type']);?>
								<?php else:?>	
									<?php $photo = getUserImg($bday['id'], $bday['jins'], $bday['photo']);?>
								<?php endif;?>
								
								<?php if($bday['access_type'] == 1){
									$vaz = '[админ]';
								}elseif($bday['access_type'] == 2){
									$vaz = '[омӯзгор]';
								}elseif($bday['access_type'] == 3){
									$vaz = '[донишҷӯ]';
								}?>
								<li>
									<div class="media">
										<img class="img-radius" src="<?=$photo?>" alt="Generic placeholder image">
										<div class="media-body">
											<h5 class="notification-user"><?=$bday['fullname_tj']?></h5>
											<p class="notification-msg"><?=$vaz?>, <?=getSinuSol($bday['birthday'])+1?> сола мешавад!</p>
										</div>
									</div>
								</li>
							<?php endforeach;?>
						</ul>
					</div>
				</li>
				
				<!-- USER PROFILE -->
				<li class="user-profile header-notification">
					<div class="dropdown-primary dropdown">
						<div class="dropdown-toggle" data-toggle="dropdown">
							<?php $photo = getUserImg($_SESSION['user']['id'], $_SESSION['user']['jins'], $_SESSION['user']['photo'], true);?>
							
							<img style="height:40px" src="<?=$photo?>" class="img-radius" alt="<?=getUserName($_SESSION['user']['id'])?>">
							<span><?=getShortName($_SESSION['user']['id'])?></span>
							<i class="feather icon-chevron-down"></i>
						</div>
						<ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
							<li>
								<a href="<?=URL?>?option=logout">
									<i class="feather icon-log-out"></i> Баромадан
								</a>
							</li>
						</ul>
					</div>
				</li>
				<!-- USER PROFILE -->
				
			</ul>
		</div>
	</div>
</nav>