<div class="nav-list">
	<div class="pcoded-inner-navbar main-menu">
		
		<div class="pcoded-navigation-label">Онлайн</div>
		<table class="addform" style="color:#fff;font-size: 13px;margin-left: 23px;width: 86%;">
			<tr>
				<td style="padding:2px">Ҳамагӣ</td>
				<td style="padding:2px"><a href="<?=MY_URL?>?option=online&action=list" style="color:#fff"><?=count(getOnline())?></a></td>
			</tr>
			<tr>
				<td style="padding:2px">Омӯзгор</td>
				<td style="padding:2px"><?=count(getOnline(2))?></td>
			</tr>
			
			<tr>
				<td style="padding:2px">Донишҷӯ</td>
				<td style="padding:2px"><?=count(getOnline(3))?></td>
			</tr>
		</table>
		
		<hr style="margin: 25px 0px 5px 0;border: 1px solid #fff;">
		
		<div class="pcoded-navigation-label">Эълонҳо</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="<?php if($option == 'elonho' && $action == 'add'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=elonho&action=add" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="pcoded-mtext">Иловакунӣ</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'elonho' && $action == 'list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=elonho&action=list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-bullhorn"></i>
					</span>
					<span class="pcoded-mtext">Руйхати эълонҳо</span>
				</a>
			</li>
		</ul>
		<br>
		
		<!-- тестҳо -->
		<div class="pcoded-navigation-label">Тестҳо</div>
		<ul class="pcoded-item pcoded-left-item">
			
			<li class="pcoded-hasmenu <?php if($option == 'tests' && $action == 'list'){ echo "active pcoded-trigger";}?>">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхат</span>
				</a>
				<ul class="pcoded-submenu">
					
					<?php foreach($_SESSION['superarr'] as $f_item):?>
						<li class="pcoded-hasmenu <?php if($option == 'tests' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
							<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
								<span class="pcoded-mtext"><?=$f_item['short']?></span>
							</a>
							
							<ul class="pcoded-submenu " style="margin-left: 0px">
								
								<?php foreach($f_item['level'] as $l_item):?>
									<li class="pcoded-hasmenu <?php if($option == 'tests' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
										<a href="javascript:" class="waves-effect waves-dark">
											<span class="pcoded-mtext"><?=$l_item['title']?></span>
										</a>
										<ul class="pcoded-submenu" style="margin-left: 10px">
											<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
											<?php foreach($l_item['view'] as $v_item):?>
												<li class="pcoded-hasmenu <?php if($option == 'tests' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
													<a href="javascript:" class="waves-effect waves-dark">
														<span class="pcoded-mtext"><?=$v_item['title']?></span>
													</a>
													
													<ul class="pcoded-submenu" style="margin-left: 10px">
														<!-- Аввали ҷудокунии курсҳо-->
														<?php foreach($v_item['course'] as $c_item):?>
															<li class="<?php if($option == 'tests' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
																<a href="<?=MY_URL?>?option=tests&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>&id_course=<?=$c_item['id']?>" class="waves-effect waves-dark">
																	<span class="pcoded-mtext"><?=$c_item['title']?></span>
																</a>
															</li>
														<?php endforeach;?>
														<!-- Аввали ҷудокунии курсҳо-->
													</ul>
												</li>
											<?php endforeach;?>
										</ul>
									</li>
								<?php endforeach;?>
								
							</ul>
						</li>
					<?php endforeach;?>
					
				</ul>
			</li>
			
			<li>
				<a href="<?=MY_URL?>?option=tests&action=transfer" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-arrows-h"></i>
					</span>
					<span class="pcoded-mtext">Трансфери саволномаҳо</span>
				</a>
			</li>
			
			<li>
				<a href="<?=MY_URL?>?option=tests&action=fanlist" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати фанҳо</span>
				</a>
			</li>
			
			<li>
				<a target="_blank" href="<?=MY_URL?>?option=print&action=tests_statistic" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Статистикаи саволҳо</span>
				</a>
			</li>
			<li>
				<a href="<?=MY_URL?>?option=tests&action=transfer2" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-refresh"></i>
					</span>
					<span class="pcoded-mtext">Трансфер 2</span>
				</a>
			</li>
			<li>
				<a target="_blank" href="<?=MY_URL?>?option=print&action=todayexamresults&date=<?=date('Y-m-d')?>" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-print"></i>
					</span>
					<span class="pcoded-mtext">Натиҷаи имтиҳонҳои имрӯза</span>
				</a>
			</li>
			<!--
			<li>
				<a href="<?=MY_URL?>?option=tests&action=imt_statistic" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Статистикаи ведомостҳо</span>
				</a>
			</li>
			-->
			
		</ul>
		<!-- Тестҳо -->
		
		
		<br>
		<div class="pcoded-navigation-label">Имтиҳонҳо</div>
		<ul class="pcoded-item pcoded-left-item">
			<li>
				<a href="<?=MY_URL?>?option=imtihonho&action=suporidand" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-list"></i>
					</span>
					<span class="pcoded-mtext">Имтиҳон супориданд</span>
				</a>
			</li>
			
			<li>
				<a href="<?=MY_URL?>?option=imtihonho&action=nasuporidand" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-list"></i>
					</span>
					<span class="pcoded-mtext">Иштирок накарданд</span>
				</a>
			</li>
			
			<li>
				<a href="<?=MY_URL?>?option=imtihonho&action=qarzdorho" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-list"></i>
					</span>
					<span class="pcoded-mtext">Қарздорҳо</span>
				</a>
			</li>
			
			<li>
				<a href="<?=MY_URL?>?option=imtihonho&action=bartaraf_kardand" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-list"></i>
					</span>
					<span class="pcoded-mtext">Бартараф карданд</span>
				</a>
			</li>
		</ul>
		
		
		<br>
		<!-- COMMISSION -->
		<div class="pcoded-navigation-label">Коммиссияи қабул</div>
		<ul class="pcoded-item pcoded-left-item">
			
			<li class="<?php if($option == 'helper' && $action == 'mmt'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=helper&action=mmt&code=107" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Интихоб дар ММТ</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'commission' && $action == 'add'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=add" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-plus"></i>
					</span>
					<span class="pcoded-mtext">Иловакунӣ</span>
				</a>
			</li>
			
			
			<li class="pcoded-hasmenu <?php if($option == 'commission' && $action == 'list'){ echo "active pcoded-trigger";}?>">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхат</span>
				</a>
				<ul class="pcoded-submenu">
					
					<?php foreach($_SESSION['commission'] as $f_item):?>
						<li class="pcoded-hasmenu <?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
							<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
								<span class="pcoded-mtext"><?=$f_item['short']?></span>
							</a>
							
							<ul class="pcoded-submenu " style="margin-left: 0px">
								
								<?php foreach($f_item['level'] as $l_item):?>
									<li class="pcoded-hasmenu <?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
										<a href="javascript:" class="waves-effect waves-dark">
											<span class="pcoded-mtext"><?=$l_item['title']?></span>
										</a>
										<ul class="pcoded-submenu" style="margin-left: 10px">
											<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
											<?php foreach($l_item['view'] as $v_item):?>
												<li class="pcoded-hasmenu <?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
													<a href="javascript:" class="waves-effect waves-dark">
														<span class="pcoded-mtext"><?=$v_item['title']?></span>
													</a>
													
													<ul class="pcoded-submenu" style="margin-left: 10px">
														<!-- Аввали ҷудокунии курсҳо-->
														<?php foreach($v_item['course'] as $c_item):?>
															<li class="pcoded-hasmenu <?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
																<a href="javascript:" class="waves-effect waves-dark">
																	<span class="pcoded-mtext"><?=$c_item['title']?></span>
																</a>
																
																<ul class="pcoded-submenu" style="margin-left: 15px">
																	<!-- Аввали ҷудокунии ихтисосҳо-->
																	<?php foreach($c_item['spec'] as $s_item):?>
																		<li class="pcoded-hasmenu <?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
																			<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
																				<span class="pcoded-mtext"><?=$s_item['code']?></span>
																			</a>
																			<ul class="pcoded-submenu" style="margin-left: 20px">
																				<!-- Аввали ҷудокунии гуруҳҳо-->
																				<?php foreach($s_item['groups'] as $g_item):?>
																					<li class="<?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
																						<a href="<?=MY_URL?>?option=commission&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>&id_course=<?=$c_item['id']?>&id_spec=<?=$s_item['id']?>&id_group=<?=$g_item['id']?>" class="waves-effect waves-dark">
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
								<!--
								<li class="">
									<a href="<?=MY_URL?>?option=commission&action=studentstatistic&id_faculty=<?=$f_item['id']?>" class="waves-effect waves-dark">
										<span class="pcoded-mtext">Омор</span>
									</a>
								</li>
								-->
								<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
							</ul>
						</li>
					<?php endforeach;?>
					
					<li>
						<a target="_blank" href="<?=MY_URL?>?option=print&action=export" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-file"></i>
							</span>
							<span class="pcoded-mtext">Экспорт</span>
						</a>
					</li>
					
				</ul>
			</li>
			
			
			<li class="pcoded-hasmenu">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-print"></i>
					</span>
					<span class="pcoded-mtext">Пешниҳодҳо</span>
				</a>
				<ul class="pcoded-submenu">
					<?php foreach($menu_davrho as $m_item):?>
						<li>
							<a target="_blank" href="<?=MY_URL?>?option=print&action=peshnihod_commission&id_davr=<?=$m_item['id']?>" class="waves-effect waves-dark">
								<span class="pcoded-micon">
									<i class="fa fa-print"></i>
								</span>
								<span class="pcoded-mtext"><?=$m_item['short']?></span>
							</a>
						</li>
					<?php endforeach;?>
					
					<li class="<?php if($option == 'print' && $action == 'peshnihod_it_m2'){ echo "active";}?>">
						<a target="_blank" href="<?=MY_URL?>?option=print&action=peshnihod_it_m2" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="feather icon-list"></i>
							</span>
							<span class="pcoded-mtext">Идомаи таҳ. ва 2 юм маъ.</span>
						</a>
					</li>
					
					<li class="<?php if($option == 'print' && $action == 'peshnihod_magistratura'){ echo "active";}?>">
						<a target="_blank" href="<?=MY_URL?>?option=print&action=peshnihod_magistratura" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="feather icon-list"></i>
							</span>
							<span class="pcoded-mtext">Магистратура</span>
						</a>
					</li>
				</ul>
			</li>
			
			<li class="<?php if($option == 'commission' && $action == 'd2s'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=d2s&s_y=<?=S_Y?>&h_y=1" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-file"></i>
					</span>
					<span class="pcoded-mtext">Ба фармоиш</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'commission' && $action == 'group_list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=group_list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати гуруҳҳо</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'commission' && $action == 'statistic'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=statistic" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-signal"></i>
					</span>
					<span class="pcoded-mtext">Омор</span>
				</a>
			</li>
			
			
			<li class="<?php if($option == 'commission' && $action == 'region_statistic'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=region_statistic" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-signal"></i>
					</span>
					<span class="pcoded-mtext">Омори минтақавӣ</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'commission' && $action == 'shartnoma'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=shartnoma" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-signal"></i>
					</span>
					<span class="pcoded-mtext">Шартномасупорӣ</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'commission' && $action == 'freeplaces'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=freeplaces" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-file"></i>
					</span>
					<span class="pcoded-mtext">Ҷойҳои холӣ</span>
					<span class="pcoded-badge label label-warning">NEW</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'commission' && $action == 'myitems'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=myitems" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-database"></i>
					</span>
					<span class="pcoded-mtext">Сабтҳои ман</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'commission' && $action == 'telephone'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=telephone&id_davr=1" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-phone"></i>
					</span>
					<span class="pcoded-mtext">Телефон</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'commission' && $action == 'income'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=income" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-toggle-down"></i>
					</span>
					<span class="pcoded-mtext">Ҳозиршудагон</span>
				</a>
			</li>
			
			
			<!-- 
			<li class="pcoded-hasmenu <?php if($option == 'commission' && ($action == 'mintaqa' || $action == 'studentstatistic' || $action == 'groupstatistic')){ echo "active pcoded-trigger";}?>">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-signal"></i>
					</span>
					<span class="pcoded-mtext">Омор</span>
				</a>
				<ul class="pcoded-submenu">
			
					<li class="<?php if($option == 'commission' && $action == 'mintaqa'){ echo "active";}?>">
						<a href="<?=MY_URL?>?option=commission&action=mintaqa" class="waves-effect waves-dark">
							
							<span class="pcoded-mtext">Омори минтақавӣ</span>
						</a>
					</li>
					
					<li class="<?php if($option == 'commission' && $action == 'studentstatistic'){ echo "active";}?>">
						<a href="<?=MY_URL?>?option=commission&action=studentstatistic" class="waves-effect waves-dark">
							
							<span class="pcoded-mtext">Омори донишҷӯён</span>
						</a>
					</li>
				
					<li class="<?php if($option == 'commission' && $action == 'groupstatistic'){ echo "active";}?>">
						<a href="<?=MY_URL?>?option=commission&action=groupstatistic" class="waves-effect waves-dark">
							
							<span class="pcoded-mtext">Омори гурӯҳҳо</span>
						</a>
					</li>
				</ul>
			</li>
			-->
			
			<li class="<?php if($option == 'commission' && $action == 'settings'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=commission&action=settings" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-cog"></i>
					</span>
					<span class="pcoded-mtext">Ҷурсозиҳо</span>
				</a>
			</li>
		</ul>
		<!-- COMMISSION -->
		
		<br>
		
		
		<!-- Шуъбаи 2 - юм -->
		
		<div class="pcoded-navigation-label">Шуъбаи 2-юм</div>
		<ul class="pcoded-item pcoded-left-item">
			
			<li class="pcoded-hasmenu <?php if($option == 'shubai2' && $action == 'list'){ echo "active pcoded-trigger";}?>">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхат</span>
				</a>
				<ul class="pcoded-submenu">
					
					<?php foreach($_SESSION['superarr'] as $f_item):?>
						<li class="pcoded-hasmenu <?php if($option == 'shubai2' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
							<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
								<span class="pcoded-mtext"><?=$f_item['short']?></span>
							</a>
							
							<ul class="pcoded-submenu " style="margin-left: 0px">
								
								<?php foreach($f_item['level'] as $l_item):?>
									<li class="pcoded-hasmenu <?php if($option == 'shubai2' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
										<a href="javascript:" class="waves-effect waves-dark">
											<span class="pcoded-mtext"><?=$l_item['title']?></span>
										</a>
										<ul class="pcoded-submenu" style="margin-left: 10px">
											<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
											<?php foreach($l_item['view'] as $v_item):?>
												<li class="pcoded-hasmenu <?php if($option == 'shubai2' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
													<a href="javascript:" class="waves-effect waves-dark">
														<span class="pcoded-mtext"><?=$v_item['title']?></span>
													</a>
													
													<ul class="pcoded-submenu" style="margin-left: 10px">
														<!-- Аввали ҷудокунии курсҳо-->
														<?php foreach($v_item['course'] as $c_item):?>
															<li class="pcoded-hasmenu <?php if($option == 'shubai2' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
																<a href="javascript:" class="waves-effect waves-dark">
																	<span class="pcoded-mtext"><?=$c_item['title']?></span>
																</a>
																
																<ul class="pcoded-submenu" style="margin-left: 15px">
																	<!-- Аввали ҷудокунии ихтисосҳо-->
																	<?php foreach($c_item['spec'] as $s_item):?>
																		<li class="pcoded-hasmenu <?php if($option == 'shubai2' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
																			<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
																				<span class="pcoded-mtext"><?=$s_item['code']?></span>
																			</a>
																			<ul class="pcoded-submenu" style="margin-left: 20px">
																				<!-- Аввали ҷудокунии гуруҳҳо-->
																				<?php foreach($s_item['groups'] as $g_item):?>
																					<li class="<?php if($option == 'shubai2' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
																						<a href="<?=MY_URL?>?option=shubai2&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>&id_course=<?=$c_item['id']?>&id_spec=<?=$s_item['id']?>&id_group=<?=$g_item['id']?>" class="waves-effect waves-dark">
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
								
							</ul>
						</li>
					<?php endforeach;?>
					
				</ul>
			</li>
			
		</ul>
		
		<!-- Шуъбаи 2 - юм -->
		
		
		<br>
			
		<div class="pcoded-navigation-label">Муҳосибот</div>
		<ul class="pcoded-item pcoded-left-item">
			
				<li class="pcoded-hasmenu <?php if($option == 'bugalteria' && $action == 'list'){ echo "active pcoded-trigger";}?>">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхат</span>
				</a>
				<ul class="pcoded-submenu">
					
					<?php foreach($_SESSION['superarr'] as $f_item):?>
						<li class="pcoded-hasmenu <?php if($option == 'bugalteria' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
							<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
								<span class="pcoded-mtext"><?=$f_item['short']?></span>
							</a>
							
							<ul class="pcoded-submenu " style="margin-left: 0px">
								
								<?php foreach($f_item['level'] as $l_item):?>
									<li class="pcoded-hasmenu <?php if($option == 'bugalteria' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
										<a href="javascript:" class="waves-effect waves-dark">
											<span class="pcoded-mtext"><?=$l_item['title']?></span>
										</a>
										<ul class="pcoded-submenu" style="margin-left: 10px">
											<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
											<?php foreach($l_item['view'] as $v_item):?>
												<li class="pcoded-hasmenu <?php if($option == 'bugalteria' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
													<a href="javascript:" class="waves-effect waves-dark">
														<span class="pcoded-mtext"><?=$v_item['title']?></span>
													</a>
													
													<ul class="pcoded-submenu" style="margin-left: 10px">
														<!-- Аввали ҷудокунии курсҳо-->
														<?php foreach($v_item['course'] as $c_item):?>
															<li class="pcoded-hasmenu <?php if($option == 'bugalteria' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
																<a href="javascript:" class="waves-effect waves-dark">
																	<span class="pcoded-mtext"><?=$c_item['title']?></span>
																</a>
																
																<ul class="pcoded-submenu" style="margin-left: 15px">
																	<!-- Аввали ҷудокунии ихтисосҳо-->
																	<?php foreach($c_item['spec'] as $s_item):?>
																		<li class="pcoded-hasmenu <?php if($option == 'bugalteria' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
																			<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
																				<span class="pcoded-mtext"><?=$s_item['code']?></span>
																			</a>
																			<ul class="pcoded-submenu" style="margin-left: 20px">
																				<!-- Аввали ҷудокунии гуруҳҳо-->
																				<?php foreach($s_item['groups'] as $g_item):?>
																					<li class="<?php if($option == 'bugalteria' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
																						<a href="<?=MY_URL?>?option=bugalteria&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>&id_course=<?=$c_item['id']?>&id_spec=<?=$s_item['id']?>&id_group=<?=$g_item['id']?>" class="waves-effect waves-dark">
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
								<!--
								<li class="">
									<a href="<?=MY_URL?>?option=commission&action=studentstatistic&id_faculty=<?=$f_item['id']?>" class="waves-effect waves-dark">
										<span class="pcoded-mtext">Омор</span>
									</a>
								</li>
								-->
								<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
							</ul>
						</li>
					<?php endforeach;?>
					
				</ul>
			</li>
			<li class="<?php if($option == 'bugalteria' && $action == 'add_student'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=bugalteria&action=add_student" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-plus"></i>
					</span>
					<span class="pcoded-mtext">Барқарор. донишҷӯён</span>
				</a>
			</li>
			<li class="<?php if($option == 'bugalteria' && $action == 'add'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=bugalteria&action=add" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-plus"></i>
					</span>
					<span class="pcoded-mtext">Иловакунии хатмкунанда</span>
				</a>
			</li>
		
			<li class="<?php if($option == 'bugalteria' && $action == 'list_bugalteria'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=bugalteria&action=list_bugalteria" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати хатмкунандагон</span>
				</a>
			</li>
		</ul>	
		
		
		<!-- KASSA -->
		
		<div class="pcoded-navigation-label">Хазина</div>
		<ul class="pcoded-item pcoded-left-item">
			<!-- Танҳо дар рафти кори коммиссияи қабул -->
			<li class="<?php if($option == 'kassa' && $action == 'commission'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=kassa&action=commission" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати довталабон</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'kassa' && $action == 'list_xatmkunandagon'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=kassa&action=list_xatmkunandagon" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-graduation-cap"></i>
					</span>
					<span class="pcoded-mtext">Руйхати хатмкунандагон</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'kassa' && $action == 'hissobot_kassa'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=kassa&action=hissobot_kassa" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Ҳисоботи хазина</span>
				</a>
			</li>
			
		</ul>
	
		
		<br>
		<?php include("../modules/khobgoh/khobgoh_menu.php");?>
		<br>
		
		
		<div class="pcoded-navigation-label">Нақшаи қабул</div>
		<ul class="pcoded-item pcoded-left-item">
			<li class="<?php if($option == 'naqsha' && $action == 'qabul'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=naqsha&action=qabul" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Нақшаи қабул</span>
				</a>
			</li>
		</ul>
		
		<div class="pcoded-navigation-label">Сохтор</div>
		<ul class="pcoded-item pcoded-left-item">
			
			<li class="<?php if($option == 'soxtor' && $action == 'faculties_list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=soxtor&action=faculties_list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати факултетҳо</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'soxtor' && $action == 'departaments_list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=soxtor&action=departaments_list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати кафедраҳо</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'soxtor' && $action == 'soxtor_list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=soxtor&action=soxtor_list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати сохтор</span>
				</a>
			</li>
			
			
		</ul>
		
		<div class="pcoded-navigation-label">Дарсҳои ман</div>
		<ul class="pcoded-item pcoded-left-item">
			
			<li class="<?php if($option == 'mylessons' && $action == 'list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=mylessons&action=list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати дарсҳо</span>
				</a>
			</li>
		</ul>
		
		<!-- LEVEL MENU -->
		<div class="pcoded-navigation-label">Донишҷӯён</div>
		<ul class="pcoded-item pcoded-left-item">
			
			
			<li class="<?php if($option == 'students' && $action == 'add'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=students&action=add" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-plus"></i>
					</span>
					<span class="pcoded-mtext">Иловакунӣ</span>
				</a>
			</li>
			
			
			<li class="pcoded-hasmenu <?php if($option == 'students' && $action == 'list'){ echo "active pcoded-trigger";}?>">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхат</span>
				</a>
				<ul class="pcoded-submenu">
					<?php foreach($_SESSION['superarr'] as $f_item):?>
						<li class="pcoded-hasmenu <?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
							<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
								<span class="pcoded-mtext"><?=$f_item['short']?></span>
							</a>
							
							<ul class="pcoded-submenu " style="margin-left: 0px">
								
								<?php foreach($f_item['level'] as $l_item):?>
									<li class="pcoded-hasmenu <?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
										<a href="javascript:" class="waves-effect waves-dark">
											<span class="pcoded-mtext"><?=$l_item['title']?></span>
										</a>
										<ul class="pcoded-submenu" style="margin-left: 10px">
											<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
											<?php foreach($l_item['view'] as $v_item):?>
												<li class="pcoded-hasmenu <?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
													<a href="javascript:" class="waves-effect waves-dark">
														<span class="pcoded-mtext"><?=$v_item['title']?></span>
													</a>
													
													<ul class="pcoded-submenu" style="margin-left: 10px">
														<!-- Аввали ҷудокунии курсҳо-->
														<?php foreach($v_item['course'] as $c_item):?>
															<li class="pcoded-hasmenu <?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
																<a href="javascript:" class="waves-effect waves-dark">
																	<span class="pcoded-mtext"><?=$c_item['title']?></span>
																</a>
																
																<ul class="pcoded-submenu" style="margin-left: 15px">
																	<!-- Аввали ҷудокунии ихтисосҳо-->
																	<?php foreach($c_item['spec'] as $s_item):?>
																		<li class="pcoded-hasmenu <?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
																			<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
																				<span class="pcoded-mtext"><?=$s_item['code']?></span>
																			</a>
																			<ul class="pcoded-submenu" style="margin-left: 20px">
																				<!-- Аввали ҷудокунии гуруҳҳо-->
																				<?php foreach($s_item['groups'] as $g_item):?>
																					<li class="<?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
																						<a href="<?=MY_URL?>?option=students&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>&id_course=<?=$c_item['id']?>&id_spec=<?=$s_item['id']?>&id_group=<?=$g_item['id']?>" class="waves-effect waves-dark">
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
														<li>
															<a href="<?=MY_URL?>?option=print&action=bejik&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>" class="waves-effect waves-dark">
																<span class="pcoded-micon">
																	<i class="fa fa-list"></i>
																</span>
																<span class="pcoded-mtext">Бейҷик</span>
															</a>
														</li>
													</ul>
												</li>
											<?php endforeach;?>
										</ul>
									</li>
								<?php endforeach;?>
								<li class="">
									<a target="_blank" href="<?=MY_URL?>?option=print&action=rating_results&id_faculty=<?=$f_item['id']?>" class="waves-effect waves-dark">
										<span class="feather icon-printer">Натиҷаҳо Р1+Р2+Имт</span>
									</a>
								</li>
								<li class="">
									<a href="<?=MY_URL?>?option=commission&action=studentstatistic&id_faculty=<?=$f_item['id']?>" class="waves-effect waves-dark">
										<span class="pcoded-mtext">Омор</span>
									</a>
								</li>
								<li class="">
									<a target="_blank" href="<?=MY_URL?>?option=print&action=cont_fac&id_faculty=<?=$f_item['id']?>" class="waves-effect waves-dark">
										<span class="feather icon-printer">Чопи контингент</span>
									</a>
								</li>
								
								<li class="">
									<a href="<?=MY_URL?>?option=students&action=khorijshudaho&id_faculty=<?=$f_item['id']?>" class="waves-effect waves-dark">
										<span class="pcoded-mtext">Хориҷшудаҳо</span>
									</a>
								</li>
								<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
							</ul>
						</li>
					<?php endforeach;?>
					
					<li>
						<a target="_blank" href="<?=MY_URL?>?option=print&action=contingent" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-print"></i>
							</span>
							<span class="pcoded-mtext">Контингент</span>
						</a>
					</li>
					
					
				</ul>
			</li>
			
			<li>
				<a target="_blank" href="<?=MY_URL?>?option=print&action=shakli_5" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-file"></i>
					</span>
					<span class="pcoded-mtext">Шакли 5</span>
				</a>
			</li>
			
			<!-- ДАВОМОТ -->
			<li class="pcoded-hasmenu">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-file"></i>
					</span>
					<span class="pcoded-mtext">Давомот</span>
				</a>
				<ul class="pcoded-submenu">
			
					<li>
						<a href="<?=MY_URL?>?option=print&action=davomot_1" class="waves-effect waves-dark">
							
							<span class="pcoded-mtext">Танҳо</span>
						</a>
					</li>
					
					<li>
						<a href="<?=MY_URL?>?option=print&action=davomot_2" class="waves-effect waves-dark">
							
							<span class="pcoded-mtext">Умумӣ</span>
						</a>
					</li>
				</ul>
			</li>
			<!-- ДАВОМОТ -->
			<li class="pcoded-hasmenu">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-file"></i>
					</span>
					<span class="pcoded-mtext">Рейтинг</span>
				</a>
				<ul class="pcoded-submenu">
					<li>
						<a target="_blank" href="<?=MY_URL?>?option=print&action=rating_kmd&rating=1" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-print"></i>
							</span>
							<span class="pcoded-mtext">КМД Р1</span>
						</a>
					</li>
					<li>
						<a target="_blank" href="<?=MY_URL?>?option=print&action=rating_kmd&rating=2" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-print"></i>
							</span>
							<span class="pcoded-mtext">КМД Р2</span>
						</a>
					</li>
					<li>
						<a target="_blank" href="<?=MY_URL?>?option=print&action=results_nf&rating=1" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-print"></i>
							</span>
							<span class="pcoded-mtext">Натиҷаи Р1</span>
						</a>
					</li>
					<li>
						<a target="_blank" href="<?=MY_URL?>?option=print&action=results_nf&rating=2" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-print"></i>
							</span>
							<span class="pcoded-mtext">Натиҷаи Р2</span>
						</a>
					</li>
					<li>
						<a target="_blank" href="<?=MY_URL?>?option=print&action=results_imt" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-print"></i>
							</span>
							<span class="pcoded-mtext">Натиҷаи имтиҳонҳо</span>
						</a>
					</li>
				</ul>
			</li>
			
			
			
			
			<li>
				<a target="_blank" href="<?=MY_URL?>?option=print&action=khorijshudagon" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-list"></i>
					</span>
					<span class="pcoded-mtext">Хориҷшудагон</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'students' && $action == 'structure'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=students&action=structure" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-sitemap"></i>
					</span>
					<span class="pcoded-mtext">Сохтор</span>
				</a>
			</li>
			
			<!-- ОМОР -->
			<li class="pcoded-hasmenu <?php if($option == 'students' && ($action == 'mintaqa' || $action == 'studentstatistic' || $action == 'groupstatistic')){ echo "active pcoded-trigger";}?>">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-signal"></i>
					</span>
					<span class="pcoded-mtext">Омор</span>
				</a>
				<ul class="pcoded-submenu">
			
					<li class="<?php if($option == 'students' && $action == 'mintaqa'){ echo "active";}?>">
						<a href="<?=MY_URL?>?option=students&action=mintaqa" class="waves-effect waves-dark">
							
							<span class="pcoded-mtext">Омори минтақавӣ</span>
						</a>
					</li>
					
					<li class="<?php if($option == 'students' && $action == 'studentstatistic'){ echo "active";}?>">
						<a href="<?=MY_URL?>?option=students&action=studentstatistic" class="waves-effect waves-dark">
							
							<span class="pcoded-mtext">Омори донишҷӯён</span>
						</a>
					</li>
				
					<li class="<?php if($option == 'students' && $action == 'groupstatistic'){ echo "active";}?>">
						<a href="<?=MY_URL?>?option=students&action=groupstatistic" class="waves-effect waves-dark">
							
							<span class="pcoded-mtext">Омори гурӯҳҳо</span>
						</a>
					</li>
				</ul>
			</li>
			<!-- ОМОР -->
			
			
			<li class="<?php if($option == 'students' && $action == 'harakat'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=students&action=harakat" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-line-chart"></i>
					</span>
					<span class="pcoded-mtext">Ҳаракат</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'students' && $action == 'problems'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=students&action=problems" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="ffa fa-question"></i>
					</span>
					<span class="pcoded-mtext">Камбудиҳо</span>
				</a>
			</li>
		</ul>
		<!-- LEVEL MENU -->
		
		<div class="pcoded-navigation-label">Имтиҳонҳо</div>
		<ul class="pcoded-item pcoded-left-item">
			
			<li class="<?php if($option == 'imtihon' && $action == 'qarzdorho'){ echo "active";}?>">
				<a target="_blank" href="<?=MY_URL?>?option=print&action=stipendia&s_y=<?=S_Y?>&h_y=<?=H_Y?>" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-line-chart"></i>
					</span>
					<span class="pcoded-mtext">Стипендия</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'imtihon' && $action == 'qarzdorho'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=imtihon&action=qarzdorho" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-line-chart"></i>
					</span>
					<span class="pcoded-mtext">Қарздорҳо</span>
				</a>
			</li>
			<li>
				<a target="_blank" href="<?=MY_URL?>?option=print&action=qarzdorho_allfan&s_y=<?=S_Y?>&h_y=<?=H_Y?>" class="waves-effect waves-dark" title="Қарздорҳо аз ҳамаи фанҳо">
						<span class="pcoded-micon">
							<i class="fa fa-line-chart"></i>
						</span>
						<span class="pcoded-mtext">Қарздорҳо(ҲФ)</span>
				</a>
			</li>
			<li class="<?php if($option == 'imtihon' && $action == 'qarzdorho'){ echo "active";}?>">
				<a target="_blank" href="<?=MY_URL?>?option=print&action=suporidand&id_s_l=1&id_s_v=1&s_y=<?=S_Y?>&h_y=<?=H_Y?>" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-line-chart"></i>
					</span>
					<span class="pcoded-mtext">Формаи 34 (БР)</span>
				</a>
			</li>
			<li class="<?php if($option == 'imtihon' && $action == 'qarzdorho'){ echo "active";}?>">
				<a target="_blank" href="<?=MY_URL?>?option=print&action=suporidand&id_s_l=1&id_s_v=2&s_y=<?=S_Y?>&h_y=<?=H_Y?>" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-line-chart"></i>
					</span>
					<span class="pcoded-mtext">Формаи 34 (БФ)</span>
				</a>
			</li>			
		</ul>
		
		
		<div class="pcoded-navigation-label">Омӯзгорҳо</div>
		<ul class="pcoded-item pcoded-left-item">
			
			<li class="<?php if($option == 'teachers' && $action == 'add'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=teachers&action=add" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-plus"></i>
					</span>
					<span class="pcoded-mtext">Иловакунӣ</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'teachers' && $action == 'list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=teachers&action=list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати омӯзгорҳо</span>
				</a>
			</li>
		</ul>
		
		<div class="pcoded-navigation-label">Ҷадвали дарсҳо</div>
		<ul class="pcoded-item pcoded-left-item">
			
			
			<li class="<?php if($option == 'jd' && $action == 'add'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=jd&action=add" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-plus"></i>
					</span>
					<span class="pcoded-mtext">Иловакунӣ</span>
				</a>
			</li>
			
			
			<li class="pcoded-hasmenu <?php if($option == 'jd' && $action == 'list'){ echo "active pcoded-trigger";}?>">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхат</span>
				</a>
				<ul class="pcoded-submenu">
					<?php foreach($_SESSION['superarr'] as $f_item):?>
						<li class="pcoded-hasmenu <?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
							<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
								<span class="pcoded-mtext"><?=$f_item['short']?></span>
							</a>
							
							<ul class="pcoded-submenu " style="margin-left: 0px">
								
								<?php foreach($f_item['level'] as $l_item):?>
									<li class="pcoded-hasmenu <?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
										<a href="javascript:" class="waves-effect waves-dark">
											<span class="pcoded-mtext"><?=$l_item['title']?></span>
										</a>
										<ul class="pcoded-submenu" style="margin-left: 10px">
											<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
											<?php foreach($l_item['view'] as $v_item):?>
												<li class="pcoded-hasmenu <?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
													<a href="javascript:" class="waves-effect waves-dark">
														<span class="pcoded-mtext"><?=$v_item['title']?></span>
													</a>
													
													<ul class="pcoded-submenu" style="margin-left: 10px">
														<!-- Аввали ҷудокунии курсҳо-->
														<?php foreach($v_item['course'] as $c_item):?>
															<li class="pcoded-hasmenu <?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
																<a href="javascript:" class="waves-effect waves-dark">
																	<span class="pcoded-mtext"><?=$c_item['title']?></span>
																</a>
																
																<ul class="pcoded-submenu" style="margin-left: 15px">
																	<!-- Аввали ҷудокунии ихтисосҳо-->
																	<?php foreach($c_item['spec'] as $s_item):?>
																		<li class="pcoded-hasmenu <?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
																			<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
																				<span class="pcoded-mtext"><?=$s_item['code']?></span>
																			</a>
																			<ul class="pcoded-submenu" style="margin-left: 20px">
																				<!-- Аввали ҷудокунии гуруҳҳо-->
																				<?php foreach($s_item['groups'] as $g_item):?>
																					<li class="<?php if($option == 'students' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
																						<a href="<?=MY_URL?>?option=jd&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>&id_course=<?=$c_item['id']?>&id_spec=<?=$s_item['id']?>&id_group=<?=$g_item['id']?>" class="waves-effect waves-dark">
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
			
			<li>
				<a href="<?=MY_URL?>?option=print&action=vedomost" class="waves-effect waves-dark" target="_blank">
					<span class="pcoded-micon">
						<i class="feather icon-printer"></i>
					</span>
					<span class="pcoded-mtext">Назорати ведомост</span>
				</a>
			</li>
		</ul>
		
		
		
		<div class="pcoded-navigation-label">Нақшаҳои таълимӣ</div>
		<ul class="pcoded-item pcoded-left-item">
			
			
			<li class="<?php if($option == 'nt' && $action == 'add'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=nt&action=add" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-plus"></i>
					</span>
					<span class="pcoded-mtext">Иловакунӣ</span>
				</a>
			</li>
			
			
			<li class="pcoded-hasmenu <?php if($option == 'nt' && $action == 'list'){ echo "active pcoded-trigger";}?>">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати нақшаҳо</span>
				</a>
				<ul class="pcoded-submenu">
					
					<?php foreach($_SESSION['superarr'] as $f_item):?>
						<li class="pcoded-hasmenu <?php if($option == 'nt' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
							<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
								<span class="pcoded-mtext"><?=$f_item['short']?></span>
							</a>
							
							<ul class="pcoded-submenu " style="margin-left: 0px">
								
								<?php foreach($f_item['level'] as $l_item):?>
									<li class="pcoded-hasmenu <?php if($option == 'nt' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
										<a href="javascript:" class="waves-effect waves-dark">
											<span class="pcoded-mtext"><?=$l_item['title']?></span>
										</a>
										<ul class="pcoded-submenu" style="margin-left: 10px">
											<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
											<?php foreach($l_item['view'] as $v_item):?>
												<li class="<?php if($option == 'nt' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
													<a href="<?=MY_URL?>?option=nt&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>" class="waves-effect waves-dark">
														<span class="pcoded-mtext"><?=$v_item['title']?></span>
													</a>
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
		
		<br>
		<br>
		<br>
		<br>
		<br>
		
		
		
		
	</div>
</div>