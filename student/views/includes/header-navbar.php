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
			<?php if($action == 'suporidan' || $action == 'suporidan_rating' || $action == 'suporidan_trimsetr'):?>
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
			
			<ul class="nav-right">
			<h5 style="float:left; margin-top: 30px">Соли таҳсили <?=getStudyYear(S_Y)?>, Нимсолаи <?=H_Y?>,
			IP-и Шумо: <?=$_SERVER["REMOTE_ADDR"]?>
			</h5>
				<!-- USER PROFILE -->
				<li class="user-profile header-notification">
					<div class="dropdown-primary dropdown">
						<div class="dropdown-toggle" >
							<?php $photo = getUserImg($_SESSION['user']['id'], $_SESSION['user']['jins'], $_SESSION['user']['photo']);?>
							
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