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
							Омори минтақавӣ
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
								Омори донишҷуён вобаста ба минтақаҳо
							</h5>
						</div>
						<div class="card-block">
							
							<div class="table-responsive davrifaol">
								
								<table class="table" style="font-size:14px">
									<tbody>
										<?php foreach($regions as $r_item):?>
											<tr>
												<td colspan="5" class="bold center"><?=$r_item['name']?></td>
											</tr>
											
											<tr class="bold center">
												<td>№</td>
												<td>
													Ноҳия/Шаҳр
												</td>
												<td>
													Ҳамагӣ
												</td>
												<td>
													Духтар
												</td>
												<td>
													Писар
												</td>
											</tr>
											
											
											<?php $districts = select("districts", "*", "`id_region` = '".$r_item['id']."'", "name", false, "");?>
											<?php $counter = 0;?>	
											<?php foreach($districts as $d_item):?>
												
												<?php $query = query("SELECT * FROM `users` WHERE `access_type` = 3 AND `id_district` = '".$d_item['id']."' AND `archive` IS NULL");?>
												
												<?php if(!empty($query)):?>
													<tr>
														<td class="center" style="width:40px"><?=++$counter?>.</td>
														<td>
															<?=$d_item['name']?>
														</td>
														<td class="center bold">
															<a href="<?=MY_URL?>?option=students&action=district&id_district=<?=$d_item['id']?>">
																<?=count_table_where("users", "`access_type` = 3 AND `id_region` = '".$r_item['id']."' AND `id_district` = '".$d_item['id']."' AND `archive` IS NULL")?>
															</a>
														</td>
														<td class="center">
															<a href="<?=MY_URL?>?option=students&action=district&id_district=<?=$d_item['id']?>&jins=0">
																<?=count_table_where("users", "`access_type` = 3 AND `id_region` = '".$r_item['id']."' AND `id_district` = '".$d_item['id']."' AND `jins` = '0' AND `archive` IS NULL")?>
															</a>
														</td>
														<td class="center">
															<a href="<?=MY_URL?>?option=students&action=district&id_district=<?=$d_item['id']?>&jins=1">
																<?=count_table_where("users", "`access_type` = 3 AND `id_region` = '".$r_item['id']."' AND `id_district` = '".$d_item['id']."' AND `jins` = '1' AND `archive` IS NULL")?>
															</a>
														</td>
													</tr>
												<?php endif;?>
											<?php endforeach;?>
											
											<tr class="center bold">
												<td colspan="2" >
													Ҳамагӣ дар <?=$r_item['name']?>
												</td>
												<td>
													<?=count_table_where("users", "`access_type` = 3 AND `id_region` = '".$r_item['id']."' AND `archive` IS NULL")?>
												</td>
												<td><?=count_table_where("users", "`access_type` = 3 AND `id_region` = '".$r_item['id']."' AND `jins` = '0' AND `archive` IS NULL")?></td>
												<td><?=count_table_where("users", "`access_type` = 3 AND `id_region` = '".$r_item['id']."' AND `jins` = '1' AND `archive` IS NULL")?></td>
											</tr>
											
											<tr>
												<td colspan="5"></td>
											</tr>
										<?php endforeach;?>
										
										<tr class="center bold">
											<td colspan="2" >
												<?php if(isset($id_faculty)):?>
													Ҳамагӣ дар факултети <?=getFaculty($id_faculty)?> то санаи <?=date("d.m.Y")?>
												<?php else:?>
													Ҳамагӣ дар ТТУ то санаи <?=date("d.m.Y")?>
												<?php endif;?>
											</td>
											<td>
												<?=count_table_where("users", "`access_type` = 3 AND `id_region` IS NOT NULL AND `archive` IS NULL")?>
											</td>
											<td><?=count_table_where("users", "`access_type` = 3 AND `id_region` IS NOT NULL AND `jins` = '0' AND `archive` IS NULL")?></td>
											<td><?=count_table_where("users", "`access_type` = 3 AND `id_region` IS NOT NULL AND `jins` = '1' AND `archive` IS NULL")?></td>
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