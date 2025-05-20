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
							Қарздорҳо
						</li>
						<li class="breadcrumb-item" title="<?=$group_options[0]['faculty_title']?>">
							<?=$group_options[0]['faculty_short']?>
						</li>
						
						<li class="breadcrumb-item">
							<?=$group_options[0]['s_l_title']?>
						</li>
						
						<li class="breadcrumb-item">
							<?=$group_options[0]['s_v_title']?>
						</li>
						<li class="breadcrumb-item">
							<?=$group_options[0]['course_title']?>
						</li>
						<li class="breadcrumb-item" title="<?=$group_options[0]['spec_title_tj']?>">
							<?=$group_options[0]['spec_code']?>
						</li>
						<li class="breadcrumb-item">
							<?=$group_options[0]['group_title']?>
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
					<div class="row">
						<div class="col-sm-12">
							
							<!-- Large modal -->
							<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg" style="max-width: 80%;">
									<div class="modal-content">
										<div class="modal-header">
											<h6 class="modal-title" id="myModalLabel"></h6>
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
										</div>
										<div class="modal-body" id="bigmodal">
											
										</div>
									</div>
								</div>
							</div>
							<!-- Large modal -->
							
							
							
							<div class="card">
								<div class="card-header">
									<h5><?=$page_info['title']?></h5>
								</div>
								<div class="card-block">
									
									
									<table class="table" style="width: 100%; font-size: 14px !important">
										<thead class="center">
											<tr style="background-color: #263544; color: #fff">
												<th class="counter">№</th>
												<th class="left">Ному насаб</th>
												<th>Факултет</th>
												<th>Зинаи<br>таҳсил</th>
												<th>Шакли<br>таҳсил</th>
												<th>Намуди<br>таҳсил</th>
												<th>Курс</th>
												<th>Ихтисос</th>
												<th>Гуруҳ </th>
												<th>Фан</th>
												<th>Шакли<br>имтиҳон</th>
												<th>Хол</th>
												<th>Маблағ</th>												
											</tr>
										</thead>
										<tbody class="center" id="tbody">
											<?php $counter = $summa = 0;?>
											<?php foreach($qarzdorho as $item):?>
												<tr class="center">
													<td><?=++$counter;?></td>
													<td class="left"><?=$item['fullname_tj']?></td>
													<td>Ф-<?=$item['faculty_short']?></td>
													<td><?=$item['study_level_title']?></td>
													<td><?=$item['study_type_title']?></td>
													<td><?=$item['study_view_title']?></td>
													<td><?=$item['id_course']?></td>
													<td><?=$item['spec_code']?></td>
													<td><?=$item['group_title']?></td>
													<td class="left"><?=$item['fan_title']?></td>
													<td><?=$imt_types[$item['imt_type']]?></td>
													<td><?=$item['total_score']?></td>
													<td class="center">
														<?php if($item['total_score'] < 45):?>
															<?php 
																$semestr = getSemestr($item['id_course'], H_Y);
																$c_f_u = getCreditiFaol($item['id_nt'], $semestr, $item['id_fan']);
																$shartnoma = getSharnomaMoneyBySY($item['id_course'], $item['id_spec'], $item['id_s_l'], $item['id_s_v'], S_Y, $item['foreign']);
															?>
															<?=$money = round($shartnoma / 60 * $c_f_u)?>
															<?php $summa += $money;?>
														<?php else:?>
															0
														<?php endif;?>
													</td>
												</tr>
											<?php endforeach;?>
											<tr class="bold center">
												<td colspan="12" style="text-align:right">Ҳамаги маблағ:</td>
												<td><?=makeBeauty($summa)?></td>
											</tr>
										</tbody>
									</table>
									<br>
									<br>
									
									
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

</script>
