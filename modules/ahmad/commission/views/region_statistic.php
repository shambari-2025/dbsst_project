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
							Комиссияи қабул
						</li>
						<li class="breadcrumb-item">
							Омори минтақавӣ
						</li>
						
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
								
								<table class="table" style="font-size:15px">
									<tbody>
										<?php $total_total = 0 ?>
										<?php foreach($regions as $r_item):?>
											<tr>
												<td colspan="5" class="bold center"><?=$r_item['name']?></td>
											</tr>
											
											<tr class="bold center">
												<td style="width:40px">№</td>
												<td>
													Ноҳия/Шаҳр
												</td>
												<td style="width:100px">
													Ҳамагӣ
												</td>
												
											</tr>
											
											
											<?php $districts = select("districts", "*", "`id_region` = '".$r_item['id']."'", "id", false, "");?>
											<?php $counter = 0;?>	
											<?php $total = 0;?>
											<?php foreach($districts as $d_item):?>
												
												<?php 
												$query = query("SELECT 
												COUNT(`users`.`id`) as `total`
												FROM `users`
												INNER JOIN `students` ON `students`.`id_student` = `users`.`id`
												INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
												INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
												LEFT JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
												WHERE
												`students`.`status` = '-1' AND
												`users`.`access_type` = '3' AND 
												`user_passports`.`id_district` = '{$d_item['id']}' AND
												
												`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
												");
												
												
												//$query = query("SELECT * FROM `users` WHERE `access_type` = 3 AND `id_district` = '".$d_item['id']."' AND `archive` IS NULL");
												
												?>
												
												<?php if($query[0]['total'] != 0):?>
													<tr>
														<td class="center"><?=++$counter?>.</td>
														<td>
															<?=$d_item['name']?>
														</td>
														<td class="center bold">
															<?=$t = $query[0]['total']?>
															<?php $total += $t;?>
														</td>
														
													</tr>
												<?php endif;?>
											<?php endforeach;?>
											
											<tr class="center bold">
												<td colspan="2" >
													Ҳамагӣ дар <?=$r_item['name']?>
												</td>
												<td>
													<?=$total?>
													<?php $total_total += $total?>
												</td>
											</tr>
											
											<tr>
												<td colspan="3"></td>
											</tr>
										<?php endforeach;?>
										<tr class="bold center">
											<td colspan="2">
												Ҳамаги дар <?=UNI_NAME?>
											</td>
											<td>
												<?=$total_total?>
											</td>
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