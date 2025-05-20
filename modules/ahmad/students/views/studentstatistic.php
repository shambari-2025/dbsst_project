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
							Омор
						</li>
						<?php if(isset($id_faculty)):?>
							<li class="breadcrumb-item">
								<?=getFaculty($id_faculty)?>
							</li>
						<?php endif;?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					
					<div class="card proj-progress-card">
						<div class="card-header">
							<h5>
								Нишондоди оморӣ
								<?php if(!isset($id_faculty)):?>
									дар донишгоҳ
								<?php else:?>
									дар факултети «<?=getFaculty($id_faculty)?>»
								<?php endif;?>
							</h5>
						</div>
						<div class="card-block">
							
							<div class="row">
								
								<div class="col-xl-4 col-md-4">
									<div class="card comp-card proj-t-card">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-auto">
														<i class="fas fa-users bg-c-green"></i>
													</div>
												<div class="col">
													
													<h6 class="m-b-25">Ҳамагӣ</h6>
													<h3 class="f-w-700 text-c-green"><?=makeBeauty($all_students)?></h3>
												</div>
												
											</div>
											<h6 class="pt-badge bg-c-green">100%</h6>
										</div>
									</div>
								</div>
								
								<div class="col-xl-4 col-md-4">
									<div class="card comp-card proj-t-card">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-auto">
														<i class="fas fa-users bg-c-blue"></i>
													</div>
												<div class="col">
													
													<h6 class="m-b-25">Рӯзона</h6>
													<h3 class="f-w-700 text-c-blue"><?=makeBeauty($ruzona)?></h3>
												</div>
												
											</div>
											<h6 class="pt-badge bg-c-blue"><?=$ruzona_persent = round(($ruzona*100)/$all_students, 2)?>%</h6>
										</div>
									</div>
								</div>
								
								
								<div class="col-xl-4 col-md-4">
									<div class="card comp-card proj-t-card">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-auto">
														<i class="fas fa-users bg-c-yellow"></i>
													</div>
												<div class="col">
													
													<h6 class="m-b-25">Фосилавӣ</h6>
													<h3 class="f-w-700 text-c-yellow"><?=makeBeauty($fosilavi)?></h3>
												</div>
												
											</div>
											<h6 class="pt-badge bg-c-yellow"><?=$fosilavi_persent = round(($fosilavi*100)/$all_students, 2)?>%</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					<div class="card proj-progress-card">
						<div class="card-header">
							<h5>
								Ҳамагӣ писар
								<?php if(!isset($id_faculty)):?>
									дар донишгоҳ
								<?php else:?>
									дар факултети «<?=getFaculty($id_faculty)?>»
								<?php endif;?>
							</h5>
						</div>
						<div class="card-block">
							
							<div class="row">
								
								<div class="col-xl-4 col-md-4">
									<div class="card comp-card proj-t-card">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-auto">
														<i class="fas fa-male bg-c-green"></i>
													</div>
												<div class="col">
													
													<h6 class="m-b-25">Ҳамагӣ</h6>
													<h3 class="f-w-700 text-c-green"><?=makeBeauty($query[0]['mans'])?></h3>
												</div>
												
											</div>
											<h6 class="pt-badge bg-c-green"><?=round(($query[0]['mans']*100)/$all_students, 2)?>%</h6>
										</div>
									</div>
								</div>
								
								<div class="col-xl-4 col-md-4">
									<div class="card comp-card proj-t-card">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-auto">
														<i class="fas fa-male bg-c-blue"></i>
													</div>
												<div class="col">
													
													<h6 class="m-b-25">Рӯзона</h6>
													<h3 class="f-w-700 text-c-blue"><?=makeBeauty($query[0]['m_ruzona'])?></h3>
												</div>
												
											</div>
											<h6 class="pt-badge bg-c-blue"><?=round(($query[0]['m_ruzona'] * $ruzona_persent)/ $ruzona ,2)?>%</h6>
										</div>
									</div>
								</div>
								
								
								<div class="col-xl-4 col-md-4">
									<div class="card comp-card proj-t-card">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-auto">
														<i class="fas fa-male bg-c-yellow"></i>
													</div>
												<div class="col">
													
													<h6 class="m-b-25">Фосилавӣ</h6>
													<h3 class="f-w-700 text-c-yellow"><?=makeBeauty($query[0]['m_fosilavi'])?></h3>
												</div>
												
											</div>
											<h6 class="pt-badge bg-c-yellow"><?=round(($query[0]['m_fosilavi'] * $fosilavi_persent)/ $fosilavi ,2)?>%</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					
					<div class="card proj-progress-card">
						<div class="card-header">
							<h5>
								Ҳамагӣ духтар
								<?php if(!isset($id_faculty)):?>
									дар донишгоҳ
								<?php else:?>
									дар факултети «<?=getFaculty($id_faculty)?>»
								<?php endif;?>
							</h5>
						</div>
						<div class="card-block">
							
							<div class="row">
								
								<div class="col-xl-4 col-md-4">
									<div class="card comp-card proj-t-card">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-auto">
														<i class="fas fa-female bg-c-green"></i>
													</div>
												<div class="col">
													
													<h6 class="m-b-25">Ҳамагӣ</h6>
													<h3 class="f-w-700 text-c-green"><?=makeBeauty($query[0]['womans'])?></h3>
												</div>
												
											</div>
											<h6 class="pt-badge bg-c-green"><?=round(($query[0]['womans']*100)/$all_students, 2)?>%</h6>
										</div>
									</div>
								</div>
								
								<div class="col-xl-4 col-md-4">
									<div class="card comp-card proj-t-card">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-auto">
														<i class="fas fa-female bg-c-blue"></i>
													</div>
												<div class="col">
													
													<h6 class="m-b-25">Рӯзона</h6>
													<h3 class="f-w-700 text-c-blue"><?=makeBeauty($query[0]['w_ruzona'])?></h3>
												</div>
												
											</div>
											<h6 class="pt-badge bg-c-blue"><?=round(($query[0]['w_ruzona'] * $ruzona_persent)/ $ruzona ,2)?>%</h6>
										</div>
									</div>
								</div>
								
								
								<div class="col-xl-4 col-md-4">
									<div class="card comp-card proj-t-card">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-auto">
														<i class="fas fa-female bg-c-yellow"></i>
													</div>
												<div class="col">
													
													<h6 class="m-b-25">Фосилавӣ</h6>
													<h3 class="f-w-700 text-c-yellow"><?=makeBeauty($query[0]['w_fosilavi'])?></h3>
												</div>
												
											</div>
											<h6 class="pt-badge bg-c-yellow"><?=round(($query[0]['w_fosilavi'] * $fosilavi_persent)/ $fosilavi ,2)?>%</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="card proj-progress-card">
						<div class="card-header">
							<h5>
								Нишондоди курсҳо
								<?php if(!isset($id_faculty)):?>
									дар донишгоҳ
								<?php else:?>
									дар факултети «<?=getFaculty($id_faculty)?>»
								<?php endif;?>
							</h5>
						</div>
						<div class="card-block">
							<button class="btn btn-primary waves-effect waves-light" type="button">
								<a class="davrifaol" target="_blank" href="<?=MY_URL?>?option=print&action=statisticincourse<?php if(isset($id_faculty)){ echo "&id_faculty=$id_faculty";}?>&s_y=<?=S_Y?>&h_y=<?=H_Y?>">
									<i class="fa fa-print"></i> Чопи ҷадвал
								</a>
							</button>
							<hr>

							
							<div class="table-responsive davrifaol">
								<table class="table" style="font-size:14px">
									<thead class="center">
										<tr>
											<th rowspan="2" style="width: 140px"></th>
											
											<th colspan="4">Шумораи умумии донишҷӯён</th>
											<th colspan="4">Дар шуъбаи рӯзона</th>
											<th colspan="4">Дар шуъбаи фосилавӣ</th>
										</tr>
										<tr>
											<th><div class="vertical">Миқдори<br>гурӯҳҳо</div></th>
											<th><div class="vertical">Ҳамагӣ</div></th>
											<th><div class="vertical">Писар</div></th>
											<th><div class="vertical">Духтар</div></th>
											
											<th><div class="vertical">Миқдори<br>гурӯҳҳо</div></th>
											<th><div class="vertical">Ҳамагӣ</div></th>
											<th><div class="vertical">Писар</div></th>
											<th><div class="vertical">Духтар</div></th>
											
											<th><div class="vertical">Миқдори<br>гурӯҳҳо</div></th>
											<th><div class="vertical">Ҳамагӣ</div></th>
											<th><div class="vertical">Писар</div></th>
											<th><div class="vertical">Духтар</div></th>
											
											
										</tr>
									</thead>
									<tbody>
										<?php $all = $mans = $womans = $all_ruz = $ruz_mans = $ruz_womans = $all_fos = $fos_mans = $fos_womans = 0;?>
										<?php foreach($statistic as $item):?>
										<tr class="center">
											<td class="left">Курси <?=$item['id_course']?></td>
											
											<td>
												<?=count_table_where("state_groups", "$all_stds_where `id_course` = '".$item['id_course']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
											</td>
											<td class="bold">
												<?php $all += $item['all']?>
												<?=$item['all']?>
											</td>
											<td>
												<?php $mans += $item['mans']?>
												<?=$item['mans']?>
											</td>
											<td>
												<?php $womans += $item['woman']?>
												<?=$item['woman']?>
											</td>
											
											
											<td>
												<?=count_table_where("state_groups", "$all_stds_where `id_course` = '".$item['id_course']."' AND `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
											</td>
											<td class="bold">
												<?php $all_ruz += $item['all_ruz']?>
												<?=$item['all_ruz']?>
											</td>
											<td>
												<?php $ruz_mans += $item['ruz_mans']?>
												<?=$item['ruz_mans']?>
											</td>
											<td>
												<?php $ruz_womans += $item['ruz_womans']?>
												<?=$item['ruz_womans']?>
											</td>
											
											
											<td>
												<?=count_table_where("state_groups", "$all_stds_where `id_course` = '".$item['id_course']."' AND `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
											</td>
											<td class="bold">
												<?php $all_fos += $item['all_fos']?>
												<?=$item['all_fos']?>
											</td>
											<td>
												<?php $fos_mans += $item['fos_mans']?>
												<?=$item['fos_mans']?>
											</td>
											<td>
												<?php $fos_womans += $item['fos_womans']?>
												<?=$item['fos_womans']?>
											</td>
											
										</tr>
										<?php endforeach;?>
										
										<tr class="center bold">
											<td>Ҳамагӣ:</td>
											<td>
												<?=count_table_where("state_groups", "$all_stds_where `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
											</td>
											
											<td><?=$all?></td>
											<td><?=$mans?></td>
											<td><?=$womans?></td>
											
											<td>
												<?=count_table_where("state_groups", "$all_stds_where `id_s_v` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
											</td>
											<td><?=$all_ruz?></td>
											<td><?=$ruz_mans?></td>
											<td><?=$ruz_womans?></td>
											
											<td>
												<?=count_table_where("state_groups", "$all_stds_where `id_s_v` = '2' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
											</td>
											<td><?=$all_fos?></td>
											<td><?=$fos_mans?></td>
											<td><?=$fos_womans?></td>
										</tr>	
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>