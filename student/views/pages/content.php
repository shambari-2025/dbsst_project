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
							Донишҷӯён
						</li>
						<li class="breadcrumb-item">
							Иқтисод ва бизнес
						</li>
						<li class="breadcrumb-item">Рӯзона</li>
						<li class="breadcrumb-item">Курси 1</li>
						<li class="breadcrumb-item">1-26010101</li>
						<li class="breadcrumb-item">Гуруҳи А</li>
						<li class="breadcrumb-item">ID 1081</li>
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
						<div class="col-sm-12">
							<!-- FANHO -->
							<div class="card">
								<div class="card-header">
									<h5>Фанҳо</h5>
								</div>
								<div class="card-block">
									<div class="table-responsive">
										<table class="table">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th class="counter">№</th>
													<th class="left" style="width:450px !important">Номӯйи фанҳо</th>
													<th>Кр.</th>
													<th>Омӯзгор</th>
													<th>Амалҳо</th>
												</tr>
											</thead>
											<tbody class="center">
												<?php
													$fanlist = array(
														array(
															'title' => 'Математикаи олӣ',
															'credit' => 6,
															'teacher' => 'Кабиров А. Т.',
														),
														array(
															'title' => 'Географияи иқтисодии Тоҷикистон бо асосҳои демография',
															'credit' => 3,
															'teacher' => 'Шарипов Ф. Б.',
														),
														array(
															'title' => 'Экология',
															'credit' => 3,
															'teacher' => 'Партобов А. Ш.',
														),
													);
												
												?>
												
												<?php $counter = 0;?>
												<?php foreach($fanlist as $item):?>
												<tr>
													<th scope="row"><?=++$counter?>.</th>
													<td class="left">
														<?=$item['title']?>
													</td>
													
													<td><?=$item['credit']?></td>
													<td><?=$item['teacher']?></td>
													<td>
													
													</td>
												</tr>
												<?php endforeach;?>
												
												<tr>
													<td colspan="2"></td>
													<td>30</td>
													<td colspan="2"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- FANHO -->
							
							<div class="card">
								<div class="card-header">
									<h5>Донишҷӯён</h5>
								</div>
								<div class="card-block">
									
									<div class="table-responsive">
										<table class="table">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th class="counter">№</th>
													<th class="image">Расм</th>
													<th class="counter">ID</th>
													<th class="left">Ному насаб</th>
													
													<th>Шакли таҳсил</th>
													<th>Бори охир</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody class="center">
												<?php $counter = 0; ?>
												<?php foreach($users_table as $item):?>
												<tr>
													<th scope="row"><?=++$counter?>.</th>
													
													<td>
														<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo']);?>
														<img class="img-circle profile_img imguser" src="<?=$photo;?>">
													</td>
													
													<th scope="row"><?=$item['id']?></th>
													
													<td class="left">
														<?=$item['fullname_tj']?>
													</td>
													
													<td>Буҷавӣ</td>
													<td>
														
														<?php if(isset($item['last_login'])):?>
															<span class="status active">&nbsp;&nbsp;&nbsp;&nbsp;</span>
															<i class="fa fa-clock-o"></i> <span class="notification-time"><?=$i+2?> <br>дақиқа пеш</span>
														<?php else:?>
															<span class="status active">&nbsp;&nbsp;&nbsp;&nbsp;</span>
															<i>Маълумот нест</i>
														<?php endif;?>
														
													</td>
													<td>
														
														<div class="dropdown-inverse dropdown open">
															<button class="btn btn-inverse dropdown-toggle waves-effect waves-light " type="button" id="dropdown-7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
																<i class="fa fa-cogs"></i> Амалҳо
															</button>
															<div class="dropdown-menu" aria-labelledby="dropdown-7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-line-chart"></i> Натиҷаи сессия</a>
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-print"></i> Чопи транскрипсия</a>
																<!--
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-print"></i> Чопи варақаи қарздорӣ</a>
																-->
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-info"></i> Маълумотнома</a>
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-edit"></i> Таҳриркунӣ</a>
																<!--
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-lock"></i> Кушодан</a>
																-->
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-unlock"></i> Маҳкамкунӣ</a>
																
																<div class="dropdown-divider"></div>
																<a class="dropdown-item waves-light waves-effect" href="#"><i class="fa fa-trash"></i> Хориҷкунӣ</a>
															</div>
														</div>
													</td>
												</tr>
												
												<?php endforeach;?>
												
												
												
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div>
						
						
						
						<div class="col-xl-3 col-md-6">
							<div class="card prod-p-card card-green">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Миқдори мардҳо</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?=count($mans)?></h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-male text-c-blue f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-md-6">
							<div class="card prod-p-card card-green">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Миқдори занҳо</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?=count($users_table) - count($mans)?></h3>
										</div>
										<div class="col-auto">
										<i class="fas fa-female text-c-red f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-md-6">
							<div class="card prod-p-card card-green">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Нақшаи таълимӣ</h6>
											<h3 class="m-b-0 f-w-700 text-white">2017</h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-folder-open text-c-green f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-3 col-md-6">
							<div class="card prod-p-card card-green">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Забони таҳсил</h6>
											<h3 class="m-b-0 f-w-700 text-white">Тоҷикӣ</h3>
										</div>
										<div class="col-auto">
											<i class="fas fa-language text-c-green f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="col-xl-4 col-md-6">
							<div class="card prod-p-card card-red">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Донишҷӯёни Шартномавӣ</h6>
											<h3 class="m-b-0 f-w-700 text-white">11</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-4 col-md-6">
							<div class="card prod-p-card card-red">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Донишҷӯёни Буҷавӣ</h6>
											<h3 class="m-b-0 f-w-700 text-white">11</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-4 col-md-6">
							<div class="card prod-p-card card-red">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-b-5 text-white">Донишҷӯёни Квота</h6>
											<h3 class="m-b-0 f-w-700 text-white">11</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="col-xl-12 col-md-12">
							<!-- FANHO -->
							<div class="card">
								<div class="card-header">
									<h5>Натиҷаи имтиҳонҳо</h5>
								</div>
								<div class="card-block">
									<div class="table-responsive">
										<table class="table">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th class="counter">№</th>
													<th class="left" style="width: 250px !important">Номӯйи фанҳо</th>
													<th>Кр.</th>
													<th style="width: 160px !important">Омӯзгор</th>
													
													<th class="marks">A</th>
													<th class="marks">A-</th>
													
													<th class="marks">B+</th>
													<th class="marks">B</th>
													<th class="marks">B-</th>
													
													<th class="marks">C+</th>
													<th class="marks">C</th>
													<th class="marks">C-</th>
													
													<th class="marks">D+</th>
													<th class="marks">D</th>
													
													<th class="marks">Fx</th>
													<th class="marks">F</th>
													
													<th>Амалҳо</th>
												</tr>
											</thead>
											<tbody class="center">
												<?php
													$fanlist = array(
														array(
															'title' => 'Математикаи олӣ',
															'credit' => 6,
															'teacher' => 'Кабиров А. Т.',
														),
														array(
															'title' => 'Географияи иқтисодии Тоҷикистон ва асосҳои демография',
															'credit' => 3,
															'teacher' => 'Шарипов Ф. Б.',
														),
														array(
															'title' => 'Экология',
															'credit' => 3,
															'teacher' => 'Партобов А. Ш.',
														),
													);
												
												?>
												
												<?php $counter = 0;?>
												<?php foreach($fanlist as $item):?>
												<tr>
													<th scope="row"><?=++$counter?>.</th>
													<td class="left">
														<?=$item['title']?>
													</td>
													
													<td><?=$item['credit']?></td>
													<td><?=$item['teacher']?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td><?=rand(1, 10)?></td>
													<td>
													
													</td>
												</tr>
												<?php endforeach;?>
												
												<tr>
													<td></td>
													<td class="left">Сводни ведомост</td>
													<td>30</td>
													<td colspan="2"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- FANHO -->
						</div>
					
					
						<!-- ДАВРИ ФАЪОЛ-->
						<div class="col-xl-12 col-md-12">
							<!-- FANHO -->
							<div class="card">
								<div class="card-header">
									<h5>Ҷадвали даври фаъоли гуруҳ</h5>
								</div>
								<div class="card-block">
									<div class="table-responsive davrifaol">
										<table class="table">
											<thead class="center">
												
												<tr>
													<th rowspan="3"><div class="vertical">Миқдори донишҷу</div></th>
													<th rowspan="3"><div class="vertical">Иштирок карданд</div></th>
													<th rowspan="3"><div class="vertical">Иштирок накарданд</div></th>
													<th colspan="14">Натиҷаи баҳоҳо</th>
												</tr>
												<tr>
													<th rowspan="2"><div class="vertical">Аъло</div></th>
													<th rowspan="2">%</th>
													
													<th rowspan="2"><div class="vertical">Хубу аъло</div></th>
													<th rowspan="2">%</th>
													
													<th rowspan="2"><div class="vertical">Хуб</div></th>
													<th rowspan="2">%</th>
													
													<th rowspan="2"><div class="vertical">Қаноатбахш</div></th>
													<th rowspan="2">%</th>
													
													<th rowspan="2"><div class="vertical">Омехта</div></th>
													<th rowspan="2">%</th>
													
													<th colspan="2"><div class="vertical">Қарздор</div></th>
													<th rowspan="2">%</th>
													
												</tr>
												<tr>
													<th>Fx</th>
													<th>F</th>
												</tr>
											</thead>
											<tbody class="center">
												<tr>
													<td>10</td>
													<td>8</td>
													<td>2</td>
													
													<td>1</td>
													<td>10%</td>
													
													<td>2</td>
													<td>20%</td>
													
													<td>1</td>
													<td>10%</td>
													
													<td>2</td>
													<td>20%</td>
													
													<td>1</td>
													<td>10%</td>
													
													<td>1</td>
													<td>2</td>
													<td>30%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- FANHO -->
						</div>
						<!-- ДАВРИ ФАЪОЛ-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>