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
					<style>
						td {
							padding: 2px !important;
						}
					</style>
					<div class="card proj-progress-card">
						<div class="card-header">
							<h5>
								Ҳаракат
							</h5>
						</div>
						<div class="card-block">
							<?php //print_arr($_SESSION['superarr'][1]['level'])?>
							
							
							<div class="table-responsive davrifaol">
								
								<table class="table" style="font-size:14px">
									
									<tbody>
										<?php $all_in_ddmit = $all_mens_in_ddmit = $all_womens_in_ddmit = 0?>
										<?php $a_i_ddmit_sh = $a_i_ddmit_b = $a_i_ddmit_k = 0?>
										<?php $a_i_ddmit_sh_m = $a_i_ddmit_b_m = $a_i_ddmit_k_m = 0?>
										<?php $a_i_ddmit_sh_w = $a_i_ddmit_b_w = $a_i_ddmit_k_w = 0?>
										<?php foreach($_SESSION['superarr'] as $f_item):?>
											<?php $all_in_facs = $all_mens_in_facs = $all_womens_in_facs = 0?>
											<?php $a_i_f_sh = $a_i_f_b = $a_i_f_k = 0?>
											<?php $a_i_f_sh_m = $a_i_f_b_m = $a_i_f_k_m = 0?>
											<?php $a_i_f_sh_w = $a_i_f_b_w = $a_i_f_k_w = 0?>
											
											<tr class="center bold">
												<td colspan="15">
													Факултети «<?=$f_item['title']?>»
												</td>
											</tr>
											
											<tr class="center bold">
												<td rowspan="2">№</td>
												<td rowspan="2"><div class="vertical">Курс</div></td>
												<td rowspan="2">Рамзи ихтисос</td>
												<td colspan="3" style="width: 120px">
													Шумораи<br>донишҷӯён
												</td>
												<td colspan="3" style="width: 120px">
													Шартномавӣ
												</td>
												<td colspan="3" style="width: 120px">
													Буҷавӣ
												</td>
												<td colspan="3" style="width: 120px">
													Квота
												</td>
											</tr>
											<tr class="center bold">
												<td><div class="vertical">Ҳамагӣ</div></td>
												<td><div class="vertical">Духтар</div></td>
												<td><div class="vertical">Писар</div></td>
												
												<td><div class="vertical">Ҳамагӣ</div></td>
												<td><div class="vertical">Духтар</div></td>
												<td><div class="vertical">Писар</div></td>
												
												<td><div class="vertical">Ҳамагӣ</div></td>
												<td><div class="vertical">Духтар</div></td>
												<td><div class="vertical">Писар</div></td>
												
												<td><div class="vertical">Ҳамагӣ</div></td>
												<td><div class="vertical">Духтар</div></td>
												<td><div class="vertical">Писар</div></td>
											</tr>
											<tr class="center bold">
												<td>1</td>
												<td>2</td>
												<td>3</td>
												<td>4</td>
												<td>5</td>
												<td>6</td>
												<td>7</td>
												<td>8</td>
												<td>9</td>
												<td>10</td>
												<td>11</td>
												<td>12</td>
												<td>13</td>
												<td>14</td>
												<td>15</td>
											</tr>
											<?php if($f_item['id'] != 9):?>
												<?php $l = 1;?>
											<?php else:?>
												<?php $l = 3;?>
											<?php endif;?>
											
											<?php foreach($f_item['level'][$l]['view'] as $v_item):?>
												<?php $all_in_view = $all_mens_in_view = $all_womens_in_view = 0?>
												<?php $a_i_v_sh = $a_i_v_b = $a_i_v_k = 0?>
												<?php $a_i_v_sh_w  = $a_i_v_b_w  = $a_i_v_k_w  = 0?>
												<?php $a_i_v_sh_m  = $a_i_v_b_m  = $a_i_v_k_m  = 0?>
												
												<tr class="center bold">
													<td colspan="15">
														Шуъбаи «<?=$v_item['title']?>»
													</td>
												</tr>
												<?php foreach($v_item['course'] as $c_item):?>
													<?php $counter = 0?>
													<?php $all_in_course = $all_mens_in_course = $all_womens_in_course = 0?>
													<?php $a_i_c_sh = $a_i_c_b = $a_i_c_k = 0?>
													<?php $a_i_c_sh_w = $a_i_c_b_w = $a_i_c_k_w = 0?>
													<?php $a_i_c_sh_m = $a_i_c_b_m = $a_i_c_k_m = 0?>
													
													<?php foreach($c_item['spec'] as $s_item):?>
														
														<?php foreach($s_item['groups'] as $g_item):?>
															<tr class="center">
																<?php
																	
																	$mens = query("SELECT `students`.*, `users`.* FROM `users`
																	INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
																	`students`.`status` = '1' AND
																	`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
																	AND `students`.`id_faculty` = '".$f_item['id']."' 
																	AND `students`.`id_s_l` = '$l'
																	AND `students`.`id_course` = '".$c_item['id']."' 
																	AND `students`.`id_spec` = '".$s_item['id']."' 
																	AND `students`.`id_group` = '".$g_item['id']."'
																	AND `students`.`id_s_v` = '".$v_item['id']."'
																	AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
																	ORDER BY `users`.`id`
																	");
																	
																	$womans = query("SELECT `students`.*, `users`.* FROM `users`
																	INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
																	`students`.`status` = '1' AND
																	`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
																	AND `students`.`id_faculty` = '".$f_item['id']."' 
																	AND `students`.`id_s_l` = '$l'
																	AND `students`.`id_course` = '".$c_item['id']."' 
																	AND `students`.`id_spec` = '".$s_item['id']."' 
																	AND `students`.`id_group` = '".$g_item['id']."'
																	AND `students`.`id_s_v` = '".$v_item['id']."'
																	AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
																	ORDER BY `users`.`id`
																	");
																	
																	/* шартномави писар */
																	$shartmona_mens = query("SELECT `students`.*, `users`.* FROM `users`
																	INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
																	`students`.`status` = '1' AND
																	`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
																	AND `students`.`id_faculty` = '".$f_item['id']."' 
																	AND `students`.`id_s_l` = '$l'
																	AND `students`.`id_course` = '".$c_item['id']."' 
																	AND `students`.`id_spec` = '".$s_item['id']."' 
																	AND `students`.`id_group` = '".$g_item['id']."'
																	AND `students`.`id_s_v` = '".$v_item['id']."' 
																	AND `students`.`id_s_t` = '1'
																	AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
																	ORDER BY `users`.`id`
																	");
																	/* шартномави писар */
																	
																	
																	/* шартномави духтар */
																	$shartmona_womens = query("SELECT `students`.*, `users`.* FROM `users`
																	INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
																	`students`.`status` = '1' AND
																	`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
																	AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
																	AND `students`.`id_course` = '".$c_item['id']."' 
																	AND `students`.`id_spec` = '".$s_item['id']."' AND `students`.`id_group` = '".$g_item['id']."'
																	AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '1'
																	AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
																	ORDER BY `users`.`id`
																	");
																	/* шартномави духтар */
																	
																	
																	/* Буҷавӣ писар */
																	$bujavi_mens = query("SELECT `students`.*, `users`.* FROM `users`
																	INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
																	`students`.`status` = '1' AND
																	`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
																	AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
																	AND `students`.`id_course` = '".$c_item['id']."' 
																	AND `students`.`id_spec` = '".$s_item['id']."' AND `students`.`id_group` = '".$g_item['id']."'
																	AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '2'
																	AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
																	ORDER BY `users`.`id`
																	");
																	/* Буҷавӣ писар */
																	
																	/* Буҷавӣ духтар */
																	$bujavi_womens = query("SELECT `students`.*, `users`.* FROM `users`
																	INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
																	`students`.`status` = '1' AND
																	`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
																	AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
																	AND `students`.`id_course` = '".$c_item['id']."' 
																	AND `students`.`id_spec` = '".$s_item['id']."' AND `students`.`id_group` = '".$g_item['id']."'
																	AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '2'
																	AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
																	ORDER BY `users`.`id`
																	");
																	/* Буҷавӣ духтар */
																	
																	
																	
																	/* Квота писар */
																	$kvota_mens = query("SELECT `students`.*, `users`.* FROM `users`
																	INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
																	`students`.`status` = '1' AND
																	`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
																	AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
																	AND `students`.`id_course` = '".$c_item['id']."' 
																	AND `students`.`id_spec` = '".$s_item['id']."' AND `students`.`id_group` = '".$g_item['id']."'
																	AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '3'
																	AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
																	ORDER BY `users`.`id`
																	");
																	/* Квота писар */
																	
																	/* Квота духтар */
																	$kvota_womens = query("SELECT `students`.*, `users`.* FROM `users`
																	INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
																	`students`.`status` = '1' AND
																	`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
																	AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
																	AND `students`.`id_course` = '".$c_item['id']."' 
																	AND `students`.`id_spec` = '".$s_item['id']."' AND `students`.`id_group` = '".$g_item['id']."'
																	AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '3'
																	AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
																	ORDER BY `users`.`id`
																	");
																	/* Квота духтар */
																?>
																
																
																<td><?=++$counter;?>.</td>
																<td><?=$c_item['id']?></td>
																<td><?=$s_item['code']?> <?=$g_item['title']?> - <?=$s_item['title']?></td>
																
																
																<!-- Шумораи донишҷӯён-->
																
																<td class="bold">
																	<?=$all = (count($mens) + count($womans));?>
																	<?php $all_in_course += $all;?>
																	
																</td>
																<td>
																	<?=$all_w = count($womans)?>
																	<?php $all_womens_in_course += $all_w;?> 
																</td>
																<td>
																	<?=$all_m = count($mens)?>
																	<?php $all_mens_in_course += $all_m;?> 
																</td>
																<!-- Шумораи донишҷӯён-->
																
																<!-- Шартномавӣ-->
																<?php if(isset($shartmona_mens)):?>
																	<?php $a_sh = count($shartmona_mens)?>
																	<?php $a_i_c_sh += $a_sh?>
																<?php else:?>
																	<?php $a_sh = 0?>
																<?php endif;?>
																
																<?php if(isset($shartmona_womens)):?>
																	<?php $a_sh_w = count($shartmona_womens)?>
																	<?php $a_i_c_sh_w += $a_sh_w?>
																<?php else:?>
																	<?php $a_sh_w = 0?>
																<?php endif;?>
																
																<td class="bold">
																	<?=$a_sh + $a_sh_w?>
																</td>
																
																<td>
																	<?=$a_sh_w?>
																</td>
																
																<td>
																	<?=$a_sh?>
																</td>
																
																
																<!-- Шартномавӣ-->
																
																<!-- Буҷавӣ-->
																
																<?php if(isset($bujavi_mens)):?>
																	<?php $a_b = count($bujavi_mens)?>
																	<?php $a_i_c_b += $a_b?>
																<?php else:?>
																	<?php $a_b = 0?>
																<?php endif;?>
																
																<?php if(isset($bujavi_womens)):?>
																	<?php $a_b_w = count($bujavi_womens)?>
																	<?php $a_i_c_b_w += $a_b_w?>
																<?php else:?>
																	<?php $a_b_w = 0?>
																<?php endif;?>
																
																<td class="bold">
																	<?=$a_b + $a_b_w?>
																</td>
																<td>
																	<?=$a_b_w?>
																</td>
																<td>
																	<?=$a_b?>
																</td>
																<!-- Буҷавӣ-->
																
																<!-- Квота-->
																<?php if(isset($kvota_mens)):?>
																	<?php $a_k = count($kvota_mens)?>
																	<?php $a_i_c_k += $a_k?>
																<?php else:?>
																	<?php $a_k = 0?>
																<?php endif;?>
																
																<?php if(isset($kvota_womens)):?>
																	<?php $a_k_w = count($kvota_womens)?>
																	<?php $a_i_c_k_w += $a_k_w?>
																<?php else:?>
																	<?php $a_k_w = 0?>
																<?php endif;?>
																
																<td class="bold">
																	<?=$a_k + $a_k_w?>
																</td>
																<td>
																	<?=$a_k_w?>
																</td>
																<td>
																	<?=$a_k?>
																</td>
																<!-- Квота-->
															</tr>
															
														<?php endforeach;?>
														
													<?php endforeach;?>
													
													<tr class="center bold" style="border-bottom: 2px solid #000 !important; background: #f7f6f6;">
														<td colspan="3">
															Ҷамъ дар курси <?=$c_item['id']?>
														</td>
														
														<?php 
															$mens = query("SELECT `students`.*, `users`.* FROM `users`
															INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
															`students`.`status` = '1' AND
															`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
															AND `students`.`id_faculty` = '".$f_item['id']."' 
															AND `students`.`id_s_l` = '$l'
															AND `students`.`id_course` = '".$c_item['id']."' 
															
															AND `students`.`id_s_v` = '".$v_item['id']."'
															AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
															ORDER BY `users`.`id`
															");
															
															$womans = query("SELECT `students`.*, `users`.* FROM `users`
															INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
															`students`.`status` = '1' AND
															`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
															AND `students`.`id_faculty` = '".$f_item['id']."' 
															AND `students`.`id_s_l` = '$l'
															AND `students`.`id_course` = '".$c_item['id']."' 
															
															AND `students`.`id_s_v` = '".$v_item['id']."'
															AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
															ORDER BY `users`.`id`
															");
															
															/* шартномави писар */
															$shartmona_mens = query("SELECT `students`.*, `users`.* FROM `users`
															INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
															`students`.`status` = '1' AND
															`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
															AND `students`.`id_faculty` = '".$f_item['id']."' 
															AND `students`.`id_s_l` = '$l'
															AND `students`.`id_course` = '".$c_item['id']."' 
															AND `students`.`id_s_v` = '".$v_item['id']."' 
															AND `students`.`id_s_t` = '1'
															AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
															ORDER BY `users`.`id`
															");
															/* шартномави писар */
															
															
															/* шартномави духтар */
															$shartmona_womens = query("SELECT `students`.*, `users`.* FROM `users`
															INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
															`students`.`status` = '1' AND
															`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
															AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
															AND `students`.`id_course` = '".$c_item['id']."' 
															AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '1'
															AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
															ORDER BY `users`.`id`
															");
															/* шартномави духтар */
															
															
															/* Буҷавӣ писар */
															$bujavi_mens = query("SELECT `students`.*, `users`.* FROM `users`
															INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
															`students`.`status` = '1' AND
															`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
															AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
															AND `students`.`id_course` = '".$c_item['id']."' 
															AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '2'
															AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
															ORDER BY `users`.`id`
															");
															/* Буҷавӣ писар */
															
															/* Буҷавӣ духтар */
															$bujavi_womens = query("SELECT `students`.*, `users`.* FROM `users`
															INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
															`students`.`status` = '1' AND
															`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
															AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
															AND `students`.`id_course` = '".$c_item['id']."' 
															AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '2'
															AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
															ORDER BY `users`.`id`
															");
															/* Буҷавӣ духтар */
															
															
															
															/* Квота писар */
															$kvota_mens = query("SELECT `students`.*, `users`.* FROM `users`
															INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
															`students`.`status` = '1' AND
															`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
															AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
															AND `students`.`id_course` = '".$c_item['id']."' 
															AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '3'
															AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
															ORDER BY `users`.`id`
															");
															/* Квота писар */
															
															/* Квота духтар */
															$kvota_womens = query("SELECT `students`.*, `users`.* FROM `users`
															INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
															`students`.`status` = '1' AND
															`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
															AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
															AND `students`.`id_course` = '".$c_item['id']."' 
															AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '3'
															AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
															ORDER BY `users`.`id`
															");
															/* Квота духтар */
														
														?>
														
														<!-- Шумораи донишҷӯён-->
														<td>
															<?=count($mens)+count($womans)?>
														</td>
														<td>
															<?=count($womans)?>
														</td>
														<td>
															<?=count($mens)?>
														</td>
														<!-- Шумораи донишҷӯён-->
														
														<!-- Шартномавӣ-->
														
														<td>
															<?=count($shartmona_mens)+count($shartmona_womens)?>
														</td>
														
														<td>
															<?=count($shartmona_womens)?>
														</td>
														
														<td>
															<?=count($shartmona_mens)?>
														</td>
														
														
														<!-- Шартномавӣ-->
														
														<!-- Буҷавӣ-->
														<td>
															<?=count($bujavi_mens)+count($bujavi_womens)?>
														</td>
														
														<td>
															<?=count($bujavi_womens)?>
														</td>
														
														<td>
															<?=count($bujavi_mens)?>
														</td>
														<!-- Буҷавӣ-->
														
														<!-- Квота-->
														<td>
															<?=count($kvota_mens)+count($kvota_womens)?>
														</td>
														
														<td>
															<?=count($kvota_womens)?>
														</td>
														
														<td>
															<?=count($kvota_mens)?>
														</td>
														<!-- Квота-->
													</tr>
												
												<?php endforeach;?>
												
												<tr class="center bold" style="border-bottom: 2px solid #000 !important;">
													<td colspan="3">
														Ҷамъ дар шуъбаи «<?=$v_item['title']?>»
													</td>
													
													<?php 
														$mens = query("SELECT `students`.*, `users`.* FROM `users`
														INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
														`students`.`status` = '1' AND
														`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
														AND `students`.`id_faculty` = '".$f_item['id']."' 
														AND `students`.`id_s_l` = '$l'
														AND `students`.`id_s_v` = '".$v_item['id']."'
														AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
														ORDER BY `users`.`id`
														");
														
														$womans = query("SELECT `students`.*, `users`.* FROM `users`
														INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
														`students`.`status` = '1' AND
														`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
														AND `students`.`id_faculty` = '".$f_item['id']."' 
														AND `students`.`id_s_l` = '$l'
														AND `students`.`id_s_v` = '".$v_item['id']."'
														AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
														ORDER BY `users`.`id`
														");
														
														/* шартномави писар */
														$shartmona_mens = query("SELECT `students`.*, `users`.* FROM `users`
														INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
														`students`.`status` = '1' AND
														`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
														AND `students`.`id_faculty` = '".$f_item['id']."' 
														AND `students`.`id_s_l` = '$l'
														AND `students`.`id_s_v` = '".$v_item['id']."' 
														AND `students`.`id_s_t` = '1'
														AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
														ORDER BY `users`.`id`
														");
														/* шартномави писар */
														
														
														/* шартномави духтар */
														$shartmona_womens = query("SELECT `students`.*, `users`.* FROM `users`
														INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
														`students`.`status` = '1' AND
														`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
														AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
														AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '1'
														AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
														ORDER BY `users`.`id`
														");
														/* шартномави духтар */
														
														
														/* Буҷавӣ писар */
														$bujavi_mens = query("SELECT `students`.*, `users`.* FROM `users`
														INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
														`students`.`status` = '1' AND
														`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
														AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
														AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '2'
														AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
														ORDER BY `users`.`id`
														");
														/* Буҷавӣ писар */
														
														/* Буҷавӣ духтар */
														$bujavi_womens = query("SELECT `students`.*, `users`.* FROM `users`
														INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
														`students`.`status` = '1' AND
														`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
														AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
														AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '2'
														AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
														ORDER BY `users`.`id`
														");
														/* Буҷавӣ духтар */
														
														
														
														/* Квота писар */
														$kvota_mens = query("SELECT `students`.*, `users`.* FROM `users`
														INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
														`students`.`status` = '1' AND
														`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
														AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
														AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '3'
														AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
														ORDER BY `users`.`id`
														");
														/* Квота писар */
														
														/* Квота духтар */
														$kvota_womens = query("SELECT `students`.*, `users`.* FROM `users`
														INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
														`students`.`status` = '1' AND
														`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
														AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
														AND `students`.`id_s_v` = '".$v_item['id']."' AND `students`.`id_s_t` = '3'
														AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
														ORDER BY `users`.`id`
														");
														/* Квота духтар */
													
													?>
													
													<!-- Шумораи донишҷӯён-->
													<td>
														<?=count($mens)+count($womans)?>
													</td>
													<td>
														<?=count($womans)?>
													</td>
													<td>
														<?=count($mens)?>
													</td>
													<!-- Шумораи донишҷӯён-->
													
													<!-- Шартномавӣ-->
													
													<td>
														<?=count($shartmona_mens)+count($shartmona_womens)?>
													</td>
													
													<td>
														<?=count($shartmona_womens)?>
													</td>
													
													<td>
														<?=count($shartmona_mens)?>
													</td>
													
													
													<!-- Шартномавӣ-->
													
													<!-- Буҷавӣ-->
													<td>
														<?=count($bujavi_mens)+count($bujavi_womens)?>
													</td>
													
													<td>
														<?=count($bujavi_womens)?>
													</td>
													
													<td>
														<?=count($bujavi_mens)?>
													</td>
													<!-- Буҷавӣ-->
													
													<!-- Квота-->
													<td>
														<?=count($kvota_mens)+count($kvota_womens)?>
													</td>
													
													<td>
														<?=count($kvota_womens)?>
													</td>
													
													<td>
														<?=count($kvota_mens)?>
													</td>
													<!-- Квота-->
												</tr>
											
											<?php endforeach;?>
											
											<tr class="center bold" style="border-bottom: 2px solid #000 !important;">
												<td colspan="3">
													Ҳамагӣ дар факултети «<?=$f_item['short']?>»
												</td>
												
												<?php 
													$mens = query("SELECT `students`.*, `users`.* FROM `users`
													INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
													`students`.`status` = '1' AND
													`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
													AND `students`.`id_faculty` = '".$f_item['id']."' 
													AND `students`.`id_s_l` = '$l'
													
													AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
													ORDER BY `users`.`id`
													");
													
													$womans = query("SELECT `students`.*, `users`.* FROM `users`
													INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
													`students`.`status` = '1' AND
													`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
													AND `students`.`id_faculty` = '".$f_item['id']."' 
													AND `students`.`id_s_l` = '$l'
													
													AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
													ORDER BY `users`.`id`
													");
													
													/* шартномави писар */
													$shartmona_mens = query("SELECT `students`.*, `users`.* FROM `users`
													INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
													`students`.`status` = '1' AND
													`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
													AND `students`.`id_faculty` = '".$f_item['id']."' 
													AND `students`.`id_s_l` = '$l'
													
													AND `students`.`id_s_t` = '1'
													AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
													ORDER BY `users`.`id`
													");
													/* шартномави писар */
													
													
													/* шартномави духтар */
													$shartmona_womens = query("SELECT `students`.*, `users`.* FROM `users`
													INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
													`students`.`status` = '1' AND
													`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
													AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
													AND `students`.`id_s_t` = '1'
													AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
													ORDER BY `users`.`id`
													");
													/* шартномави духтар */
													
													
													/* Буҷавӣ писар */
													$bujavi_mens = query("SELECT `students`.*, `users`.* FROM `users`
													INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
													`students`.`status` = '1' AND
													`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
													AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
													AND `students`.`id_s_t` = '2'
													AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
													ORDER BY `users`.`id`
													");
													/* Буҷавӣ писар */
													
													/* Буҷавӣ духтар */
													$bujavi_womens = query("SELECT `students`.*, `users`.* FROM `users`
													INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
													`students`.`status` = '1' AND
													`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
													AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
													AND `students`.`id_s_t` = '2'
													AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
													ORDER BY `users`.`id`
													");
													/* Буҷавӣ духтар */
													
													
													
													/* Квота писар */
													$kvota_mens = query("SELECT `students`.*, `users`.* FROM `users`
													INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
													`students`.`status` = '1' AND
													`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
													AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
													AND `students`.`id_s_t` = '3'
													AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
													ORDER BY `users`.`id`
													");
													/* Квота писар */
													
													/* Квота духтар */
													$kvota_womens = query("SELECT `students`.*, `users`.* FROM `users`
													INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
													`students`.`status` = '1' AND
													`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
													AND `students`.`id_faculty` = '".$f_item['id']."' AND `students`.`id_s_l` = '$l'
													AND `students`.`id_s_t` = '3'
													AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
													ORDER BY `users`.`id`
													");
													/* Квота духтар */
												
												?>
												
												<!-- Шумораи донишҷӯён-->
												<td>
													<?=count($mens)+count($womans)?>
												</td>
												<td>
													<?=count($womans)?>
												</td>
												<td>
													<?=count($mens)?>
												</td>
												<!-- Шумораи донишҷӯён-->
												
												<!-- Шартномавӣ-->
												
												<td>
													<?=count($shartmona_mens)+count($shartmona_womens)?>
												</td>
												
												<td>
													<?=count($shartmona_womens)?>
												</td>
												
												<td>
													<?=count($shartmona_mens)?>
												</td>
												
												
												<!-- Шартномавӣ-->
												
												<!-- Буҷавӣ-->
												<td>
													<?=count($bujavi_mens)+count($bujavi_womens)?>
												</td>
												
												<td>
													<?=count($bujavi_womens)?>
												</td>
												
												<td>
													<?=count($bujavi_mens)?>
												</td>
												<!-- Буҷавӣ-->
												
												<!-- Квота-->
												<td>
													<?=count($kvota_mens)+count($kvota_womens)?>
												</td>
												
												<td>
													<?=count($kvota_womens)?>
												</td>
												
												<td>
													<?=count($kvota_mens)?>
												</td>
												<!-- Квота-->
											</tr>
											</tr>
											<tr>
												<td colspan="15">&nbsp; </td>
											</tr>
										
										<?php endforeach;?>
										
										<tr class="center bold" style="border-bottom: 2px solid #000 !important;">
											<td colspan="3">
												Ҳамагӣ дар «<?=SHORT_UNI_NAME?>»
											</td>
											
											<?php 
												$mens = query("SELECT `students`.*, `users`.* FROM `users`
												INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
												`students`.`status` = '1' AND
												`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
												AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
												ORDER BY `users`.`id`
												");
												
												$womans = query("SELECT `students`.*, `users`.* FROM `users`
												INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
												`students`.`status` = '1' AND
												`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
												AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
												ORDER BY `users`.`id`
												");
												
												/* шартномави писар */
												$shartmona_mens = query("SELECT `students`.*, `users`.* FROM `users`
												INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
												`students`.`status` = '1' AND
												`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
												AND `students`.`id_s_t` = '1'
												AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
												ORDER BY `users`.`id`
												");
												/* шартномави писар */
												
												
												/* шартномави духтар */
												$shartmona_womens = query("SELECT `students`.*, `users`.* FROM `users`
												INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
												`students`.`status` = '1' AND
												`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
												AND `students`.`id_s_t` = '1'
												AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
												ORDER BY `users`.`id`
												");
												/* шартномави духтар */
												
												
												/* Буҷавӣ писар */
												$bujavi_mens = query("SELECT `students`.*, `users`.* FROM `users`
												INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
												`students`.`status` = '1' AND
												`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
												AND `students`.`id_s_t` = '2'
												AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
												ORDER BY `users`.`id`
												");
												/* Буҷавӣ писар */
												
												/* Буҷавӣ духтар */
												$bujavi_womens = query("SELECT `students`.*, `users`.* FROM `users`
												INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
												`students`.`status` = '1' AND
												`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
												AND `students`.`id_s_t` = '2'
												AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
												ORDER BY `users`.`id`
												");
												/* Буҷавӣ духтар */
												
												
												
												/* Квота писар */
												$kvota_mens = query("SELECT `students`.*, `users`.* FROM `users`
												INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
												`students`.`status` = '1' AND
												`students`.`id_student` = `users`.`id` AND `users`.`jins` = '1'
												AND `students`.`id_s_t` = '3'
												AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
												ORDER BY `users`.`id`
												");
												/* Квота писар */
												
												/* Квота духтар */
												$kvota_womens = query("SELECT `students`.*, `users`.* FROM `users`
												INNER JOIN `students` ON `students`.`id_student` = `users`.`id` WHERE
												`students`.`status` = '1' AND
												`students`.`id_student` = `users`.`id` AND `users`.`jins` = '0'
												AND `students`.`id_s_t` = '3'
												AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
												ORDER BY `users`.`id`
												");
												/* Квота духтар */
											
											?>
											
											<!-- Шумораи донишҷӯён-->
											<td>
												<?=count($mens)+count($womans)?>
											</td>
											<td>
												<?=count($womans)?>
											</td>
											<td>
												<?=count($mens)?>
											</td>
											<!-- Шумораи донишҷӯён-->
											
											<!-- Шартномавӣ-->
											
											<td>
												<?=count($shartmona_mens)+count($shartmona_womens)?>
											</td>
											
											<td>
												<?=count($shartmona_womens)?>
											</td>
											
											<td>
												<?=count($shartmona_mens)?>
											</td>
											
											
											<!-- Шартномавӣ-->
											
											<!-- Буҷавӣ-->
											<td>
												<?=count($bujavi_mens)+count($bujavi_womens)?>
											</td>
											
											<td>
												<?=count($bujavi_womens)?>
											</td>
											
											<td>
												<?=count($bujavi_mens)?>
											</td>
											<!-- Буҷавӣ-->
											
											<!-- Квота-->
											<td>
												<?=count($kvota_mens)+count($kvota_womens)?>
											</td>
											
											<td>
												<?=count($kvota_womens)?>
											</td>
											
											<td>
												<?=count($kvota_mens)?>
											</td>
											<!-- Квота-->
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