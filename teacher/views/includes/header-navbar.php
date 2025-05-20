<nav class="navbar header-navbar pcoded-header">
	<div class="navbar-wrapper">
		<!-- LOGO -->
		<div class="navbar-logo">
			<a href="/">
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
			<?php if($action == 'bisanj'):?>
				<ul class="nav-left">
					<li class="bold" style="margin-left: 15px">
						<span id="min0">2</span>
						<span id="min1">0</span>
						<span id="razd">:</span>
						<span id="sec0">0</span>
						<span id="sec1">0</span>
					</li>
				</ul>
				<?php endif;?>
			
			<!-- ПОИСК -->
			<ul class="nav-left">
				<?php if(!empty($contingent_module) || !empty($bugaltaria_module)):?>
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
				<?php endif;?>
				<li>
					<?php $study_years  = query("SELECT * FROM `study_years` WHERE `id` >= '24' ORDER BY `id`");?>
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
			<!-- ПОИСК -->
			
			<ul class="nav-right">
			<h5 style="float:left; margin-top: 30px">Соли таҳсили <?=getStudyYear(S_Y)?>, Нимсолаи <?=H_Y?>
			IP-и Шумо: <?=$_SERVER["REMOTE_ADDR"]?>
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
							
						</ul>
					</div>
				</li>

				<!--
				<li class="header-notification">
					<div class="dropdown-primary dropdown">
						<div class="dropdown-toggle" data-toggle="dropdown">
							<i class="feather icon-bell"></i>
							<span class="badge bg-c-red">5</span>
						</div>
						<ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
							<li>
								<h6>Notifications</h6>
								<label class="label label-danger">New</label>
							</li>
							<li>
								<div class="media">
									<img class="img-radius" src="<?=TMPL_URL?>jpg/avatar-4.jpg" alt="Generic placeholder image">
									<div class="media-body">
										<h5 class="notification-user">John Doe</h5>
										<p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
										<span class="notification-time">30 minutes ago</span>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</li>
				-->
				<!-- CHAT -->
				<!--
				<li class="header-notification">
					<div class="dropdown-primary dropdown">
						<div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
							<i class="feather icon-message-square"></i>
							<span class="badge bg-c-green">3</span>
						</div>
					</div>
				</li>
				-->
				<!-- CHAT -->
				
				
				<!-- USER PROFILE -->
				<li class="user-profile header-notification">
					<div class="dropdown-primary dropdown">
						<div class="dropdown-toggle" >
							<?php $photo = getUserImg($_SESSION['user']['id'], $_SESSION['user']['jins'], $_SESSION['user']['photo'], true);?>
							
							<img src="<?=$photo?>" class="img-radius" alt="User-Profile-Image">
							<span><?=getShortName($_SESSION['user']['id'])?></span>
							
						</div>
						<ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
							<!--
							<li>
								<a href="#!">
									<i class="feather icon-settings"></i> Settings
								</a>
							</li>
							-->
							
							<li>
								<a href="#">
									<i class="feather icon-user"></i> Профили ман
								</a>
							</li>
							<!--
							<li>
								<a href="email-inbox.html">
									<i class="feather icon-mail"></i> Мактубҳои ман
								</a>
							</li>
							-->
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


<?php if(!empty($datas_jd)):?>
	<div class="bold" style="position: absolute;top: 72px;width: 100%;z-index: 1027;">
		<marquee>
			Дарсҳои имрӯзаи Шумо: 
			<?php foreach($datas_jd as $item):?>
				<?php if($item['bast'] == 1):?>
					<?php $start = 7;?>
				<?php else:?>
					<?php $start = 12;?>
				<?php endif;?>
				&nbsp; <?=$start + $item['soat']?><sup>00</sup>. 
				<?=getFanTest($item['id_fan'])?> 
				<i>
					<span style="font-size: 12px !important;">
					[<?=getFacultyShort($item['id_faculty'])?>, <?=getCourse($item['id_course'])?>, <?=getSpecialtyCode($item['id_spec'])?><?=getGroup($item['id_group'])?>]
					</span>
				</i>
				&nbsp;&nbsp; |
			<?php endforeach;?>
		</marquee>
	</div>
<?php endif;?>