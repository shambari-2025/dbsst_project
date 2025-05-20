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
							<?=$page_info['title']?>
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
								Расидҳо
							</h5>
						</div>
						<div class="card-block">
							
							<div class="table-responsive davrifaol">
								
								<table class="table" style="font-size:14px; width: 50%">
									<tr class="bold">
										<td>Миқдори донишҷӯёни шартномавӣ</td>
										<td class="center"><?=count_table_where("students", "`status` = '1' AND `id_s_t` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
									</tr>
									
									<tr class="bold">
										<td>Шартномаро супориданд</td>
										<td class="center">
											<?php $query = query("SELECT COUNT(DISTINCT(`id_student`)) as `students` FROM `rasidho` WHERE `s_y` = '".S_Y."'")?>
											<?=$query[0]['students']?>
										</td>
									</tr>
									
									<tr class="bold">
										<td>Маблағи супоридашуда</td>
										<td class="center">
											<?php $query = query("SELECT SUM(`check_money`) as `money` FROM `rasidho` WHERE `s_y` = '".S_Y."'")?>
											<?=($query[0]['money'])?>
										</td>
									</tr>
								
								</table>
								
								<br>
								<br>
								
								<h5>Руйхати расидҳо</h5>
								
								<div class="table-responsive davrifaol">
									<table class="table" style="font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th>Ному насаби донишҷӯ</th>
												<th style="width:50px">Рақами расид</th>
												<th style="width:50px">Санаи<br>супоридан</th>
												<th style="width:50px">Маблағ</th>
												<th style="width:150px">Амалиётро<br>гузаронид</th>
												<th style="width:190px">Санаи<br>амалиёт</th>
											</tr>
										</thead>
										<tbody class="fordata">
											<?php $counter = ($page*$perpage)-$perpage;?>
											<?php foreach($checks as $item):?>
												<tr class="center">
													<td><?=++$counter?>.</td>
													<td class="left"><?=getUserName($item['id_student'])?></td>
													<td><?=$item['check_number']?></td>
													<td><?=formatDate($item['check_date'])?></td>
													<td class="bold">
														<?=$item['check_money']?>
													</td>
													<td>
														<?=getShortName($item['author'])?>
													</td>
													<td>
														<?=$item['op_date']?>
													</td>
												</tr>
											<?php endforeach;?>
										</tbody>
									</table>
								</div>
								</table>
								
							</div>
							<div class="text-center">
								<?php $url = MY_URL."?option=students&action=checks";?>
								<?php pagination($url, $page, $count_all, $perpage, 10, '&');?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>