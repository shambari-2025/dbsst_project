<!-- LITSEY -->
<div class="pcoded-navigation-label">Литсей</div>
<ul class="pcoded-item pcoded-left-item">
	
	<li class="<?php if($option == 'litsey' && $action == 'add'){ echo "active";}?>">
		<a href="<?=MY_URL?>?option=litsey&action=add" class="waves-effect waves-dark">
			<span class="pcoded-micon">
				<i class="feather icon-plus"></i>
			</span>
			<span class="pcoded-mtext">Иловакунӣ</span>
		</a>
	</li>
	
	
	<li class="pcoded-hasmenu <?php if($option == 'litsey' && $action == 'list'){ echo "active pcoded-trigger";}?>">
		<a href="javascript:" class="waves-effect waves-dark">
			<span class="pcoded-micon">
				<i class="feather icon-list"></i>
			</span>
			<span class="pcoded-mtext">Руйхат</span>
		</a>
		<ul class="pcoded-submenu">
			
			<?php foreach($_SESSION['litsey'] as $s_item):?>
				<li class="pcoded-hasmenu <?php if($option == 'litsey' && @$_REQUEST['id_sinf'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
					<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
						<span class="pcoded-mtext"><?=$s_item['title']?></span>
					</a>
					
					<ul class="pcoded-submenu " style="margin-left: 0px">
						<?php foreach($s_item['groups'] as $g_item):?>
							<li class="<?php if($option == 'litsey' && @$_REQUEST['id_sinf'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
								<a href="<?=MY_URL?>?option=litsey&action=list&id_sinf=<?=$s_item['id']?>&id_group=<?=$g_item['id']?>" class="waves-effect waves-dark">
									<span class="pcoded-mtext"><?=$g_item['title']?></span>
								</a>
							</li>
						<?php endforeach;?>
					</ul>
				</li>
			<?php endforeach;?>
			
		</ul>
	</li>
	
	
	<li class="<?php if($option == 'litsey' && $action == 'statistic'){ echo "active";}?>">
		<a href="<?=MY_URL?>?option=litsey&action=statistic" class="waves-effect waves-dark">
			<span class="pcoded-micon">
				<i class="fa fa-signal"></i>
			</span>
			<span class="pcoded-mtext">Омор</span>
		</a>
	</li>
	<li class="<?php if($option == 'litsey' && $action == 'statistic'){ echo "active";}?>">
		<a target="_blank" href="<?=MY_URL?>?option=print&action=balancelit" class="waves-effect waves-dark">
			<span class="pcoded-micon">
				<i class="fa fa-dollar"></i>
			</span>
			<span class="pcoded-mtext">Баланс</span>
		</a>
	</li>
	
</ul>
<!-- LITSEY -->
