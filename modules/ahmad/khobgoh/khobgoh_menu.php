<div class="pcoded-navigation-label">Хобгоҳ</div>
<ul class="pcoded-item pcoded-left-item">
	
	<li class="<?php if($option == 'khobgoh' && $action == 'add'){ echo "active";}?>">
		<a href="<?=MY_URL?>?option=khobgoh&action=add" class="waves-effect waves-dark">
			<span class="pcoded-micon">
				<i class="feather icon-plus"></i>
			</span>
			<span class="pcoded-mtext">Иловакунии истиқ.да</span>
		</a>
	</li>
	
	<li class="<?php if($option == 'khobgoh' && $action == 'list_omuzgor'){ echo "active";}?>">
		<a href="<?=MY_URL?>?option=khobgoh&action=list_omuzgor" class="waves-effect waves-dark">
			<span class="pcoded-micon">
				<i class="feather icon-list"></i>
			</span>
			<span class="pcoded-mtext">Руйхати омӯзгорҳо</span>
		</a>
	</li>
	<li class="<?php if($option == 'khobgoh' && $action == 'list_khobgoh'){ echo "active";}?>">
		<a href="<?=MY_URL?>?option=khobgoh&action=list_khobgoh" class="waves-effect waves-dark">
			<span class="pcoded-micon">
				<i class="feather icon-list"></i>
			</span>
			<span class="pcoded-mtext">Истиқоматкунандагон</span>
		</a>
	</li>


	<li class="pcoded-hasmenu <?php if($option == 'khobgoh' && $action == 'list'){ echo "active pcoded-trigger";}?>">
		<a href="javascript:" class="waves-effect waves-dark">
			<span class="pcoded-micon">
				<i class="feather icon-list"></i>
			</span>
			<span class="pcoded-mtext">Руйхати донишҷӯён</span>
		</a>
		<ul class="pcoded-submenu">
			
			<?php foreach($_SESSION['superarr'] as $f_item):?>
				<li class="pcoded-hasmenu <?php if($option == 'khobgoh' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
					<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
						<span class="pcoded-mtext"><?=$f_item['short']?></span>
					</a>
					
					<ul class="pcoded-submenu " style="margin-left: 0px">
						
						<?php foreach($f_item['level'] as $l_item):?>
							<li class="pcoded-hasmenu <?php if($option == 'khobgoh' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
								<a href="javascript:" class="waves-effect waves-dark">
									<span class="pcoded-mtext"><?=$l_item['title']?></span>
								</a>
								<ul class="pcoded-submenu" style="margin-left: 10px">
									<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
									<?php foreach($l_item['view'] as $v_item):?>
										<li class="pcoded-hasmenu <?php if($option == 'khobgoh' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
											<a href="javascript:" class="waves-effect waves-dark">
												<span class="pcoded-mtext"><?=$v_item['title']?></span>
											</a>
											
											<ul class="pcoded-submenu" style="margin-left: 10px">
												<!-- Аввали ҷудокунии курсҳо-->
												<?php foreach($v_item['course'] as $c_item):?>
													<li class="pcoded-hasmenu <?php if($option == 'khobgoh' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
														<a href="javascript:" class="waves-effect waves-dark">
															<span class="pcoded-mtext"><?=$c_item['title']?></span>
														</a>
														
														<ul class="pcoded-submenu" style="margin-left: 15px">
															<!-- Аввали ҷудокунии ихтисосҳо-->
															<?php foreach($c_item['spec'] as $s_item):?>
																<li class="pcoded-hasmenu <?php if($option == 'khobgoh' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
																	<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
																		<span class="pcoded-mtext"><?=$s_item['code']?></span>
																	</a>
																	<ul class="pcoded-submenu" style="margin-left: 20px">
																		<!-- Аввали ҷудокунии гуруҳҳо-->
																		<?php foreach($s_item['groups'] as $g_item):?>
																			<li class="<?php if($option == 'khobgoh' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
																				<a href="<?=MY_URL?>?option=khobgoh&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>&id_course=<?=$c_item['id']?>&id_spec=<?=$s_item['id']?>&id_group=<?=$g_item['id']?>" class="waves-effect waves-dark">
																					<span class="pcoded-mtext"><?=$g_item['title']?></span>
																				</a>
																			</li>
																		<?php endforeach;?>
																		<!-- Аввали ҷудокунии гуруҳҳо-->
																	</ul>
																</li>
															<?php endforeach;?>
															<!-- Аввали ҷудокунии ихтисосҳо-->
														</ul>
													</li>
												<?php endforeach;?>
												<!-- Аввали ҷудокунии курсҳо-->
											</ul>
										</li>
									<?php endforeach;?>
								</ul>
							</li>
						<?php endforeach;?>
						<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
					</ul>
				</li>
			<?php endforeach;?>
		</ul>
	</li>
</ul>

