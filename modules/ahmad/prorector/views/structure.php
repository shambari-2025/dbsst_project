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
							Сохтор
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
								Сохтор
							</h5>
						</div>
						<div class="card-block">
							
							<div class="table-responsive davrifaol">
								
								<?php foreach($_SESSION['superarr'] as $f_item):?>
								<table class="table" style="font-size:14px">
									
									<thead class="center">
										<tr>
											<th colspan="7">
												<?=$f_item['title']?>
											</th>
										</tr>
										<tr>
											<th>#</th>
											<th style="width: 550px">Ихтисос</th>
											
											<?php for($i = 1; $i <= 4; $i++):?>
												<th style="width: 80px;">
													<div class="vertical">Курси <?=$i?></div>
												</th>
											<?php endfor;?>
											<th>Ҳамагӣ</th>
										</tr>
									</thead>	
									
									<tbody>
										<?php $specs = query("SELECT * FROM `specialties` WHERE `id_faculty` = '".$f_item['id']."'");?>
										
										<?php $counter = 0;?>
										<?php foreach($specs as $s_item):?>
											<tr>
												<td><?=++$counter?>.</td>
												<td><?=$s_item['code']?> - <?=$s_item['title_tj']?></td>
												
												
												<?php for($i = 1; $i <= 4; $i++):?>
													<td class="center">
														<?=count_table_where("students", "`status` = '1' AND `id_faculty` = '".$f_item['id']."' AND `id_course` = '$i' AND `id_spec` = '".$s_item['id']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
													</td>
												<?php endfor;?>
												
												<td class="bold center">
													<?=count_table_where("students", "`status` = '1' AND `id_faculty` = '".$f_item['id']."' AND `id_spec` = '".$s_item['id']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
												</td>
											</tr>
										<?php endforeach;?>
										
										
										<tr class="bold center">
											
											<td colspan="2">
												Ҳамаги дар факултаи «<?=$f_item['short']?>»
											</td>
											
											<?php for($i = 1; $i <= 4; $i++):?>
												<td>
													<?=count_table_where("students", "`status` = '1' AND `id_faculty` = '".$f_item['id']."' AND `id_course` = '$i' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
												</td>
											<?php endfor;?>
											
											<td>
											<?=count_table_where("students", "`status` = '1' AND `id_faculty` = '".$f_item['id']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
											</td>
										</tr>
									</tbody>
									
								</table>
								
								<br>
								<?php endforeach;?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>