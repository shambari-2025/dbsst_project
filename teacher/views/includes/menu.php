<div class="nav-list">
	<div class="pcoded-inner-navbar main-menu">
		
		<?php if(!empty($test_center_module)):?>
			<!-- тестҳо -->
			<div class="pcoded-navigation-label">Тестҳо</div>
			<ul class="pcoded-item pcoded-left-item">
				<li class="<?php if($option == 'students' && $action == 'tasdiqi_farqiyat'){ echo "active";}?>">
					<a href="<?=MY_URL?>?option=students&action=tasdiqi_farqiyat" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="ffa fa-сheck"></i>
						</span>
						<span class="pcoded-mtext">Тасдиқи фарқият</span>
					</a>
				</li>
				<li class="pcoded-hasmenu <?php if($option == 'tests' && $action == 'list'){ echo "active pcoded-trigger";}?>">
					<a href="javascript:" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Руйхат</span>
					</a>
					<ul class="pcoded-submenu">
						<?php foreach($_SESSION['tests'] as $f_item):?>
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
																<li class="pcoded-hasmenu <?php if($option == 'tests' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
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
				
			</ul>
			<!-- Тестҳо -->
		
		
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
						<?php foreach($_SESSION['tests'] as $f_item):?>
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
		
		<?php endif;?>
		
		<?php if(!empty($contingent_module)):?>
			<div class="pcoded-navigation-label">Донишҷӯён</div>
			<ul class="pcoded-item pcoded-left-item">
				<?php if(!empty($test_center_module)):?>
					<li class="<?php if($option == 'students' && $action == 'add'){ echo "active";}?>">
						<a href="<?=MY_URL?>?option=students&action=add" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="feather icon-plus"></i>
							</span>
							<span class="pcoded-mtext">Иловакунӣ</span>
						</a>
					</li>
				<?php endif;?>
				
				<li class="pcoded-hasmenu <?php if($option == 'students' && $action == 'list'){ echo "active pcoded-trigger";}?>">
					<a href="javascript:" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Руйхат</span>
					</a>
					<ul class="pcoded-submenu">
						<?php foreach($_SESSION['students'] as $f_item):?>
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
																								<span class="pcoded-mtext"><?=$g_item['short']?></span>
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
					</ul>
				</li>
				<!--
				<li class="<?php if($option == 'imtihon' && $action == 'qarzdorho'){ echo "active";}?>">
					<a target="_blank" href="<?=MY_URL?>?option=print&action=suporidand&id_s_l=1&id_s_v=1&s_y=23&h_y=1" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="fa fa-line-chart"></i>
						</span>
						<span class="pcoded-mtext">Формаи 34 (даври фаъол)</span>
					</a>
				</li>
				<li class="<?php if($option == 'imtihon' && $action == 'qarzdorho'){ echo "active";}?>">
					<a target="_blank" href="<?=MY_URL?>?option=print&action=suporidand2&id_s_l=1&id_s_v=1&s_y=23&h_y=1" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="fa fa-line-chart"></i>
						</span>
						<span class="pcoded-mtext">Формаи 34 (триместр)</span>
					</a>
				</li>
				<li class="<?php if($option == 'imtihon' && $action == 'qarzdorho'){ echo "active";}?>">
					<a target="_blank" href="<?=MY_URL?>?option=print&action=suporidand&id_s_l=1&id_s_v=2&s_y=23&h_y=1" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="fa fa-line-chart"></i>
						</span>
						<span class="pcoded-mtext">Формаи 34 (БФ)</span>
					</a>
				</li>
				
				<li class="<?php if($option == 'imtihon' && $action == 'qarzdorho'){ echo "active";}?>">
					<a target="_blank" href="<?=MY_URL?>?option=print&action=qarzdorho2&s_y=23&h_y=1" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="fa fa-list"></i>
						</span>
						<span class="pcoded-mtext">Қарздорҳо</span>
					</a>
				</li>
				
				<?php foreach($_SESSION['students'] as $f_item):?>
					<li class="<?php if($option == 'imtihon' && $action == 'qarzdorho'){ echo "active";}?>">
						<a target="_blank" href="<?=MY_URL?>?option=print&action=forma342&s_y=<?=S_Y?>&h_y=<?=H_Y?>" class="waves-effect waves-dark" title="<?=getStudyLevel($l_item['id'])."-".getStudyView($v_item['id'])?>">
							<span class="pcoded-micon">
								<i class="fa fa-list"></i>
							</span>
							<span class="pcoded-mtext">Формаи 34-2</span>
						</a>
					</li>
				<?php endforeach;?>
				<?php //print_arr($S_R)?>
				
				<li class="<?php if($option == 'students' && $action == 'problems'){ echo "active";}?>">
					<a href="<?=MY_URL?>?option=students&action=problems" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="ffa fa-question"></i>
						</span>
						<span class="pcoded-mtext">Камбудиҳо</span>
					</a>
				</li>
				-->

				
				<?php if($_SESSION['user']['id'] == 52):?>
					<li class="<?php if($option == 'students' && $action == 'tasdiq_trimestr'){ echo "active";}?>">
						<a href="<?=MY_URL?>?option=students&action=tasdiq_trimestr" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-сheckbox"></i>
							</span>
							<span class="pcoded-mtext">Тасдиқи триместр</span>
						</a>
					</li>
				<?php endif;?>
				
			<?php endif;?>
			</ul>
			

		<!-- МОДУЛИ ПРОРЕКТОР-->
		<?php if($_SESSION['user']['id'] == 16 ):?>
			<div class="pcoded-navigation-label">Донишҷӯён</div>
			<ul class="pcoded-item pcoded-left-item">				
				<li class="pcoded-hasmenu <?php if($option == 'prorector' && $action == 'list'){ echo "active pcoded-trigger";}?>">
					<a href="javascript:" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Руйхат</span>
					</a>
					<ul class="pcoded-submenu">
						<?php foreach($_SESSION['students'] as $f_item):?>
							<li class="pcoded-hasmenu <?php if($option == 'prorector' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
								<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
									<span class="pcoded-mtext"><?=$f_item['short']?></span>
								</a>
								
								<ul class="pcoded-submenu " style="margin-left: 0px">
									
									<?php foreach($f_item['level'] as $l_item):?>
										<li class="pcoded-hasmenu <?php if($option == 'prorector' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
											<a href="javascript:" class="waves-effect waves-dark">
												<span class="pcoded-mtext"><?=$l_item['title']?></span>
											</a>
											<ul class="pcoded-submenu" style="margin-left: 10px">
												<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
												<?php foreach($l_item['view'] as $v_item):?>
													<li class="pcoded-hasmenu <?php if($option == 'prorector' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
														<a href="javascript:" class="waves-effect waves-dark">
															<span class="pcoded-mtext"><?=$v_item['title']?></span>
														</a>
														
														<ul class="pcoded-submenu" style="margin-left: 10px">
															<!-- Аввали ҷудокунии курсҳо-->
															<?php foreach($v_item['course'] as $c_item):?>
																<li class="pcoded-hasmenu <?php if($option == 'prorector' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
																	<a href="javascript:" class="waves-effect waves-dark">
																		<span class="pcoded-mtext"><?=$c_item['title']?></span>
																	</a>
																	
																	<ul class="pcoded-submenu" style="margin-left: 15px">
																		<!-- Аввали ҷудокунии ихтисосҳо-->
																		<?php foreach($c_item['spec'] as $s_item):?>
																			<li class="pcoded-hasmenu <?php if($option == 'prorector' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
																				<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
																					<span class="pcoded-mtext"><?=$s_item['code']?></span>
																				</a>
																				<ul class="pcoded-submenu" style="margin-left: 20px">
																					<!-- Аввали ҷудокунии гуруҳҳо-->
																					<?php foreach($s_item['groups'] as $g_item):?>
																						<li class="<?php if($option == 'prorector' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
																							<a href="<?=MY_URL?>?option=prorector&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>&id_course=<?=$c_item['id']?>&id_spec=<?=$s_item['id']?>&id_group=<?=$g_item['id']?>" class="waves-effect waves-dark">
																								<span class="pcoded-mtext"><?=$g_item['short']?></span>
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
				<!--НАТИҶАҲОИ РЕЙТИНГ-->
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
					</ul>
				</li>

				<!--НАТИҶАҲОИ РЕЙТИНГ-->
			</ul>
		<?php endif;?>
		<!-- МОДУЛИ ПРОРЕКТОР-->
		
		
		<!-- Шуъбаи кадр -->
		<?php if(!empty($teacher_module)):?>
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
		<?php endif;?>
		
		<!-- Шуъбаи кадр -->
		<!-- Кафедрахо -->
		<?php if(!empty($departaments_module)):?>
			<div class="pcoded-navigation-label">Кафедраҳо</div>
			<ul class="pcoded-item pcoded-left-item">
				
				<li class="<?php if($option == 'soxtor' && $action == 'member_list'){ echo "active";}?>">
					<a href="<?=MY_URL?>?option=soxtor&action=member_list" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Руйхати омӯзгорон</span>
					</a>
				</li>
				<li class="<?php if($option == 'soxtor' && $action == 'sarbori'){ echo "active";}?>">
					<a href="<?=MY_URL?>?option=soxtor&action=sarbori" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Сарбории кафедра</span>
					</a>
				</li>
					
								
			</ul>
		<?php endif;?>
		<!-- Кафедрахо -->
				
		<?php if(!empty($commission)):?>
			<!-- COMMISSION -->
			<div class="pcoded-navigation-label">Коммиссияи қабул</div>
			<ul class="pcoded-item pcoded-left-item">
				
				
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
									<?php if(isset($f_item['level'])):?>
										<?php foreach($f_item['level'] as $l_item):?>
											<li class="pcoded-hasmenu <?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
												<a href="javascript:" class="waves-effect waves-dark">
													<span class="pcoded-mtext"><?=$l_item['title']?></span>
												</a>
												<ul class="pcoded-submenu" style="margin-left: 10px">
													<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
													<?php foreach($l_item['view'] as $v_item):?>
														<li class="pcoded-hasmenu <?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
															<a href="javascript:" class="waves-effect waves-dark">
																<span class="pcoded-mtext"><?=$v_item['title']?></span>
															</a>
															
															<ul class="pcoded-submenu" style="margin-left: 10px">
																<!-- Аввали ҷудокунии курсҳо-->
																<?php foreach($v_item['course'] as $c_item):?>
																	<li class="pcoded-hasmenu <?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
																		<a href="javascript:" class="waves-effect waves-dark">
																			<span class="pcoded-mtext"><?=$c_item['title']?></span>
																		</a>
																		
																		<ul class="pcoded-submenu" style="margin-left: 15px">
																			<!-- Аввали ҷудокунии ихтисосҳо-->
																			<?php foreach($c_item['spec'] as $s_item):?>
																				<li class="pcoded-hasmenu <?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
																					<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
																						<span class="pcoded-mtext"><?=$s_item['code']?></span>
																					</a>
																					<ul class="pcoded-submenu" style="margin-left: 20px">
																						<!-- Аввали ҷудокунии гуруҳҳо-->
																						<?php foreach($s_item['groups'] as $g_item):?>
																							<li class="<?php if($option == 'commission' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
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
									<?php endif;?>
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
				
				
				<li class="<?php if($option == 'commission' && $action == 'statistic'){ echo "active";}?>">
					<a href="<?=MY_URL?>?option=commission&action=statistic" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="fa fa-signal"></i>
						</span>
						<span class="pcoded-mtext">Омор</span>
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
				
				<?php if($_SESSION['user']['id'] == 52):?>
					<li class="<?php if($option == 'commission' && $action == 'shartnoma'){ echo "active";}?>">
						<a href="<?=MY_URL?>?option=commission&action=shartnoma" class="waves-effect waves-dark">
							<span class="pcoded-micon">
								<i class="fa fa-signal"></i>
							</span>
							<span class="pcoded-mtext">Шартномасупорӣ</span>
						</a>
					</li>
				<?php endif;?>
				
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
				
				
			</ul>
			<!-- COMMISSION -->
		<?php endif;?>
		
		
		
		<?php if(!empty($rasid_query)):?>
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
				
				<!--
				<li class="<?php if($option == 'kassa' && $action == 'list_xatmkunandagon'){ echo "active";}?>">
					<a href="<?=MY_URL?>?option=kassa&action=list_xatmkunandagon" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="fa fa-graduation-cap"></i>
						</span>
						<span class="pcoded-mtext">Руйхати хатмкунандагон</span>
					</a>
				</li>
				-->
				
				<li class="<?php if($option == 'kassa' && $action == 'hissobot_kassa'){ echo "active";}?>">
					<a href="<?=MY_URL?>?option=kassa&action=hissobot_kassa" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Ҳисоботи хазина</span>
					</a>
				</li>
				<!--
				<li>
					<a target="_blank" href="<?=MY_URL?>?option=print&action=balance" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Баланс</span>
					</a>
				</li>
				
				<li>
					<a target="_blank" href="<?=MY_URL?>?option=print&action=balance_f" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Қарздории факултетҳо</span>
					</a>
				</li>
				-->
				<!-- Танҳо дар рафти кори коммиссияи қабул -->
				
			</ul>
		<?php endif;?>
		
		
		<?php if(!empty($biometric_module)):?>
			<!-- COMMISSION -->
			<div class="pcoded-navigation-label">Биометрик</div>
			<ul class="pcoded-item pcoded-left-item">
				
				<li class="pcoded-hasmenu <?php if($option == 'biometric' && $action == 'list'){ echo "active pcoded-trigger";}?>">
					<a href="javascript:" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Руйхат</span>
					</a>
					<ul class="pcoded-submenu">
						
						<?php foreach($_SESSION['biometric'] as $f_item):?>
							<li class="pcoded-hasmenu <?php if($option == 'biometric' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
								<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
									<span class="pcoded-mtext"><?=$f_item['short']?></span>
								</a>
								
								<ul class="pcoded-submenu " style="margin-left: 0px">
									
									<?php foreach($f_item['level'] as $l_item):?>
										<li class="pcoded-hasmenu <?php if($option == 'biometric' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
											<a href="javascript:" class="waves-effect waves-dark">
												<span class="pcoded-mtext"><?=$l_item['title']?></span>
											</a>
											<ul class="pcoded-submenu" style="margin-left: 10px">
												<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
												<?php foreach($l_item['view'] as $v_item):?>
													<li class="pcoded-hasmenu <?php if($option == 'biometric' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
														<a href="javascript:" class="waves-effect waves-dark">
															<span class="pcoded-mtext"><?=$v_item['title']?></span>
														</a>
														
														<ul class="pcoded-submenu" style="margin-left: 10px">
															<!-- Аввали ҷудокунии курсҳо-->
															<?php foreach($v_item['course'] as $c_item):?>
																<li class="pcoded-hasmenu <?php if($option == 'biometric' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
																	<a href="javascript:" class="waves-effect waves-dark">
																		<span class="pcoded-mtext"><?=$c_item['title']?></span>
																	</a>
																	
																	<ul class="pcoded-submenu" style="margin-left: 15px">
																		<!-- Аввали ҷудокунии ихтисосҳо-->
																		<?php foreach($c_item['spec'] as $s_item):?>
																			<li class="pcoded-hasmenu <?php if($option == 'biometric' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
																				<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
																					<span class="pcoded-mtext"><?=$s_item['code']?></span>
																				</a>
																				<ul class="pcoded-submenu" style="margin-left: 20px">
																					<!-- Аввали ҷудокунии гуруҳҳо-->
																					<?php foreach($s_item['groups'] as $g_item):?>
																						<li class="<?php if($option == 'biometric' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
																							<a href="<?=MY_URL?>?option=biometric&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>&id_course=<?=$c_item['id']?>&id_spec=<?=$s_item['id']?>&id_group=<?=$g_item['id']?>" class="waves-effect waves-dark">
																								<span class="pcoded-mtext"><?=$g_item['short']?></span>
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
		<?php endif;?>
		<!-- COMMISSION -->
		
		<?php if(!empty($bugaltaria_module)):?>
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
						
						<?php foreach($_SESSION['bugaltaria'] as $f_item):?>
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
																								<span class="pcoded-mtext"><?=$g_item['short']?></span>
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
				
			</ul>
			
			
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
			<ul class="pcoded-item pcoded-left-item">
				<li class="<?php if($option == 'bugalteria' && $action == 'list_bugalteria'){ echo "active";}?>">
					<a href="<?=MY_URL?>?option=bugalteria&action=list_bugalteria" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Руйхати хатмкунандагон</span>
					</a>
				</li>
				<li class="<?php if($option == 'bugalteria' && $action == 'list_khobgoh'){ echo "active";}?>">
					<a href="<?=MY_URL?>?option=bugalteria&action=list_khobgoh" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Истиқоматкунандагон</span>
					</a>
				</li>
				<!-- нақшаи қабул -->
				<li class="<?php if($option == 'naqsha' && $action == 'qabul'){ echo "active";}?>">
					<a href="<?=MY_URL?>?option=naqsha&action=qabul" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Нақшаи қабул</span>
					</a>
				</li>
				<!-- нақшаи қабул -->
				
				<!-- Чопи ҳисобаварақа-->
				<?php if($_SESSION['user']['id'] == 9862):?>
				<li class="<?php if($option == 'naqsha' && $action == 'qabul'){ echo "active";}?>">
					<a target="_blank" href="<?=MY_URL?>?option=print&action=hissob_varaqa" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="feather icon-list"></i>
						</span>
						<span class="pcoded-mtext">Чопи ҳисобварақа</span>
					</a>
				</li>
				<?php endif;?>
				<!-- Чопи ҳисобаварақа-->
			
			</ul>
			
		<?php endif;?>
		
		<!-- Литсей -->
		<?php if(!empty($litsey_module)):?>
			<?php include("../modules/litsey/litsey_menu.php");?>
			<br>
		<?php endif;?>
		<!-- Литсей -->
		
		
		<!-- Литсей -->
		<?php if(!empty($khobgoh_module)):?>
			<?php include("../modules/khobgoh/khobgoh_menu.php");?>
			<br>
		<?php endif;?>
		<!-- Литсей -->
		
		<?php if(!empty($department_education)):?>
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
					
					<?php foreach($_SESSION['superarr_education'] as $f_item):?>
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
		<?php endif;?>
		<!-- охир меню нақшаҳои таълим-->
		<?php if($_SESSION['user']['id'] == 3203 || $_SESSION['user']['id'] == 13):?>
		<!-- Шуъбаи 2 - юм -->
		<div class="pcoded-navigation-label">Қайди ҷои кор</div>
		<ul class="pcoded-item pcoded-left-item">
			
			<li class="pcoded-hasmenu <?php if($option == 'joikor' && $action == 'list'){ echo "active pcoded-trigger";}?>">
				<a href="javascript:" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхат</span>
				</a>
				<ul class="pcoded-submenu">
					
					<?php foreach($_SESSION['superarr'] as $f_item):?>
						<li class="pcoded-hasmenu <?php if($option == 'joikor' && @$_REQUEST['id_faculty'] == $f_item['id']){ echo "active pcoded-trigger";}?>">
							<a href="javascript:" class="waves-effect waves-dark" title="<?=$f_item['title']?>">
								<span class="pcoded-mtext"><?=$f_item['short']?></span>
							</a>
							
							<ul class="pcoded-submenu " style="margin-left: 0px">
								
								<?php foreach($f_item['level'] as $l_item):?>
									<li class="pcoded-hasmenu <?php if($option == 'joikor' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id']){ echo "active pcoded-trigger";}?>">
										<a href="javascript:" class="waves-effect waves-dark">
											<span class="pcoded-mtext"><?=$l_item['title']?></span>
										</a>
										<ul class="pcoded-submenu" style="margin-left: 10px">
											<!-- Аввали ҷудокуни ба рузона ва фиславӣ -->
											<?php foreach($l_item['view'] as $v_item):?>
												<li class="pcoded-hasmenu <?php if($option == 'joikor' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id']){ echo "active pcoded-trigger";}?>">
													<a href="javascript:" class="waves-effect waves-dark">
														<span class="pcoded-mtext"><?=$v_item['title']?></span>
													</a>
													
													<ul class="pcoded-submenu" style="margin-left: 10px">
														<!-- Аввали ҷудокунии курсҳо-->
														<?php foreach($v_item['course'] as $c_item):?>
															<li class="pcoded-hasmenu <?php if($option == 'joikor' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id']){ echo "active pcoded-trigger";}?>">
																<a href="javascript:" class="waves-effect waves-dark">
																	<span class="pcoded-mtext"><?=$c_item['title']?></span>
																</a>
																
																<ul class="pcoded-submenu" style="margin-left: 15px">
																	<!-- Аввали ҷудокунии ихтисосҳо-->
																	<?php foreach($c_item['spec'] as $s_item):?>
																		<li class="pcoded-hasmenu <?php if($option == 'joikor' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id']){ echo "active pcoded-trigger";}?>">
																			<a href="javascript:" class="waves-effect waves-dark" title="<?=$s_item['title']?>">
																				<span class="pcoded-mtext"><?=$s_item['code']?></span>
																			</a>
																			<ul class="pcoded-submenu" style="margin-left: 20px">
																				<!-- Аввали ҷудокунии гуруҳҳо-->
																				<?php foreach($s_item['groups'] as $g_item):?>
																					<li class="<?php if($option == 'joikor' && @$_REQUEST['id_faculty'] == $f_item['id'] && @$_REQUEST['id_s_l'] == $l_item['id'] && @$_REQUEST['id_s_v'] == $v_item['id'] && @$_REQUEST['id_course'] == $c_item['id'] && @$_REQUEST['id_spec'] == $s_item['id'] && @$_REQUEST['id_group'] == $g_item['id']){ echo "active pcoded-trigger";}?>">
																						<a href="<?=MY_URL?>?option=joikor&action=list&id_faculty=<?=$f_item['id']?>&id_s_l=<?=$l_item['id']?>&id_s_v=<?=$v_item['id']?>&id_course=<?=$c_item['id']?>&id_spec=<?=$s_item['id']?>&id_group=<?=$g_item['id']?>" class="waves-effect waves-dark">
																							<span class="pcoded-mtext"><?=$g_item['short']?></span>
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
				<li>
					<a target="_blank" href="<?=MY_URL?>?option=print&action=joi_kor" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="fa fa-print"></i>
						</span>
						<span class="pcoded-mtext">Омор</span>
					</a>
				</li>
			</li>
			
		</ul>
		<!-- Шуъбаи 2 - юм -->
		<?php endif;?>
		
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
			<?php
				$id_user = $_SESSION['user']['id'];
				$id_fac = query("SELECT `id_faculty` FROM `faculties_settings` WHERE `id_decan` = '$id_user'");
			?>
			<?php if(!empty($id_fac)):?>
					<?php $id_fac = $id_fac[0]['id_faculty'];?>
			
				<li class="pcoded-hasmenu">
					<a href="javascript:" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="fa fa-file"></i>
						</span>
						<span class="pcoded-mtext">Факултет</span>
					</a>
					<ul class="pcoded-submenu">
						<li class="">
							<a target="_blank" href="<?=MY_URL?>?option=print&action=rating_results&id_faculty=<?=$id_fac?>" class="waves-effect waves-dark">
								<span class="feather icon-printer">Натиҷаҳо Р1+Р2+Имт</span>
							</a>
						</li>
						<li class="">
							<a href="<?=MY_URL?>?option=commission&action=studentstatistic&id_faculty=<?=$id_fac?>" class="waves-effect waves-dark">
								<span class="pcoded-mtext">Омор</span>
							</a>
						</li>
						<li class="">
							<a target="_blank" href="<?=MY_URL?>?option=print&action=cont_fac&id_faculty=<?=$id_fac?>" class="waves-effect waves-dark">
								<span class="feather icon-printer">Чопи контингент</span>
							</a>
						</li>
					</ul>
				</li>
			<?php endif;?>
			<?php if($_SESSION['user']['id']==3081):?>
				<li>
					<a target="_blank" href="<?=MY_URL?>?option=print&action=todayexamresults&date=<?=date('Y-m-d')?>" class="waves-effect waves-dark">
						<span class="pcoded-micon">
							<i class="fa fa-print"></i>
						</span>
						<span class="pcoded-mtext">Натиҷаи имтиҳонҳои имрӯза</span>
					</a>
				</li>
			<?php endif?>
			
			
			<li class="<?php if($option == 'mylessons' && $action == 'list'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=mylessons&action=list" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Руйхати дарсҳо</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'mylessons' && $action == 'zhurnal'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=mylessons&action=zhurnal" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="feather icon-list"></i>
					</span>
					<span class="pcoded-mtext">Журнали электронӣ</span>
				</a>
			</li>
			
			<li class="<?php if($option == 'teachers' && $action == 'score_farqiyat'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=teachers&action=score_farqiyat" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-pencil-square-o"></i>
					</span>
					<span class="pcoded-mtext">Баҳогузорӣ ба фарқият</span>
				</a>
			</li>

			<?php //if($_SESSION['user']['id'] == 9390):?>
			<li class="<?php if($option == 'teachers' && $action == 'score_trimestr'){ echo "active";}?>">
				<a href="<?=MY_URL?>?option=teachers&action=score_trimestr" class="waves-effect waves-dark">
					<span class="pcoded-micon">
						<i class="fa fa-pencil-square-o"></i>
					</span>
					<span class="pcoded-mtext">Баҳогузорӣ ба триместр</span>
				</a>
			</li>
			<?php //endif;?>
			
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