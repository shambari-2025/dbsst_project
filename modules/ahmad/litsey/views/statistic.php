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
							Омор
						</li>
						<li class="breadcrumb-item">
							Хонандагони литсей
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
								Нишондоди оморӣ
							</h5>
						</div>
						<div class="card-block">
							<div class="table-responsive davrifaol">
								<table class="table" style="font-size:14px">
									<thead class="center">
										<tr>
											<th style="width: 550px"></th>
											<th>Ҳамагӣ</th>
											<th>Писар</th>
											<th>Духтар</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($_SESSION['litsey'] as $s_item):?>
										<tr class="center">
											<td class="left">Миқдори умумии хонандагони синфи <?=$s_item['id']?></td>
											<td>
												<?php
													$total_students = query("SELECT COUNT(`users`.`id`) as `total` FROM `users`
													INNER JOIN `student_litsey` ON `student_litsey`.`id_xonanda` = `users`.`id` 
													WHERE `student_litsey`.`id_sinf` = '{$s_item['id']}' 
													AND `student_litsey`.`s_y` = '".S_Y."' AND `student_litsey`.`h_y` = '".H_Y."'
													");
												?>
												
												<?=$total_students[0]['total']?>
											</td>
											<td>
												<?php
													$mans_students = query("SELECT COUNT(`users`.`id`) as `total` FROM `users`
													INNER JOIN `student_litsey` ON `student_litsey`.`id_xonanda` = `users`.`id` 
													WHERE `users`.`jins` = '1' AND `student_litsey`.`id_sinf` = '{$s_item['id']}' 
													AND `student_litsey`.`s_y` = '".S_Y."' AND `student_litsey`.`h_y` = '".H_Y."'
													");
												?>
												<?=$mans_students[0]['total']?>
											</td>
											<td><?=$total_students[0]['total'] - $mans_students[0]['total']?></td>
										</tr>
										<?php endforeach;?>
										
										<tr class="bold center">
											<td>
												Ҳамаги дар литсей мехонанд:
											</td>
											<td>
												<?php
													$total_students = query("SELECT COUNT(`users`.`id`) as `total` FROM `users`
													INNER JOIN `student_litsey` ON `student_litsey`.`id_xonanda` = `users`.`id` 
													WHERE `student_litsey`.`s_y` = '".S_Y."' AND `student_litsey`.`h_y` = '".H_Y."'
													");
												?>
												<?=$total_students[0]['total']?>
											</td>
											
											<td>
												<?php
													$mans_students = query("SELECT COUNT(`users`.`id`) as `total` FROM `users`
													INNER JOIN `student_litsey` ON `student_litsey`.`id_xonanda` = `users`.`id` 
													WHERE `users`.`jins` = '1'
													AND `student_litsey`.`s_y` = '".S_Y."' AND `student_litsey`.`h_y` = '".H_Y."'
													");
												?>
												<?=$mans_students[0]['total']?>
											</td>
											
											<td><?=$total_students[0]['total'] - $mans_students[0]['total']?></td>
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