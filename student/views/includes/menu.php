<div class="nav-list">
	<div class="pcoded-inner-navbar main-menu">
		
		<div class="pcoded-navigation-label">Меню</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="<?php if($option == 'elonho' && $action == 'list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=elonho&action=list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-bullhorn"></i>
					</span>
					<span class="pcoded-mtext">Руйхати эълонҳо</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'study' && $action == 'list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=study&action=list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати дарсҳо</span>
				</a>
			</li>
			
			<?php if(in_array($_SERVER["REMOTE_ADDR"], $IPS)):?>
				<li class="<?php if($option == 'sessions' && $action == 'rating_list' && @$_REQUEST['rating'] == 1){ echo "active";}?>"> 
					<a href="<?=MY_URL?>?option=sessions&action=rating_list&rating=1" class="waves-effect waves-dark"> 
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Руйхати рейтинги 1</span>
					</a>
				</li>
				
				<li class="<?php if($option == 'sessions' && $action == 'rating_list' && @$_REQUEST['rating'] == 2){ echo "active";}?>"> 
					<a href="<?=MY_URL?>?option=sessions&action=rating_list&rating=2" class="waves-effect waves-dark"> 
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Руйхати рейтинги 2</span>
					</a>
				</li>	
			<?php endif;?>
			
			<?php if(in_array($_SERVER["REMOTE_ADDR"], $IPS)):?>
				<li class="<?php if($option == 'sessions' && $action == 'list'){ echo "active";}?>"> 
					<a href="<?=MY_URL?>?option=sessions&action=list" class="waves-effect waves-dark"> 
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Руйхати имтиҳонҳо</span>
					</a>
				</li>	
			<?php endif;?>
			
			<?php if(in_array($_SERVER["REMOTE_ADDR"], $IPS) && !empty($trimestr)):?>
				<li class="<?php if($option == 'sessions' && $action == 'trimestr_list'){ echo "active";}?>"> 
					<a href="<?=MY_URL?>?option=sessions&action=trimestr_list" class="waves-effect waves-dark"> 
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Супоридани триместр</span>
					</a>
				</li>
			<?php endif;?>
			
			
			
			
			
			<li class="<?php if($option == 'sessions' && $action == 'sessions_list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=sessions&action=sessions_list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Ҷадвали имтиҳонҳо</span>
				</a>
			</li>
			
			
			<li class="<?php if($option == 'study' && $action == 'myinfo'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=study&action=myinfo" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-user"></i>
					</span>
					<span class="pcoded-mtext">Маълумотномаи ман</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'profile' && $action == 'myprofile'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=profile&action=myprofile" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-user"></i>
					</span>
					<span class="pcoded-mtext">Профил</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'study' && $action == 'contact'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=study&action=contact" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-phone"></i>
					</span>
					<span class="pcoded-mtext">Тамос</span>
				</a>
			</li>
			
			
			<li>
				<a href="<?=URL?>?option=logout" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-log-out"></i>
					</span>
					<span class="pcoded-mtext">Баромад</span>
				</a>
			</li>
			
		</ul>
		
	</div>
</div>