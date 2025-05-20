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
							Комбудиҳои гуруҳҳо
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
							<h5>Комбудиҳои гуруҳҳо</h5>
						</div>
						<div class="card-block">
							
							<div class="table-responsive davrifaol">
								<table class="table transcript" style="width:100%; font-size:15px">
									<thead>
										<tr style="background-color: #263544; color: #fff">
											<th>№</th>
											<th>ID GROUP</th>
											<th>Факултет</th>
											<th style="width: 200px">Зинаи таҳсил</th>
											<th>Намуди таҳсил</th>
											<th>Курс</th>
											<th>Гуруҳ</th>
											<th>Миқдори донишҷӯ</th>
											<th>Нақшаи таълими</th>
										</tr>
									</thead>
									<tbody>
										<?php $counter = 0;?>
										<?php foreach($groups as $item):?>
											<tr>
												<td class="center" style="width: 20px"><?=++$counter?></td>
												<td class="center" style="width: 20px"><?=$item['id']?></td>
												<td><?=getFacultyShort($item['id_faculty'])?></td>
												<td><?=getStudyLevel($item['id_s_l'])?></td>
												<td><?=getStudyView($item['id_s_v'])?></td>
												<td class="center"><?=$item['id_course']?></td>
												<td>
													<a target="_blank" href="<?=MY_URL?>?option=students&action=list&id_faculty=<?=$item['id_faculty']?>&id_s_l=<?=$item['id_s_l']?>&id_s_v=<?=$item['id_s_v']?>&id_course=<?=$item['id_course']?>&id_spec=<?=$item['id_spec']?>&id_group=<?=$item['id_group']?>">
														<?=getSpecialtyCode($item['id_spec'])?> <?=getGroup2($item['id_group'])?>
													</a>
												</td>
												<td>
													<?=count_table_where("students", "`status` = 1 AND `id_faculty` = {$item['id_faculty']} AND 
													`id_s_l` = {$item['id_s_l']} AND `id_s_v` = {$item['id_s_v']} AND `id_course` = {$item['id_course']} AND 
													`id_spec` = {$item['id_spec']} AND `id_group` = {$item['id_group']}")?>
												</td>
												<td>
													<?php if(isset($item['id_nt'])):?>
														<span class="bold text-c-green">
															<?=getNTSOL($item['id_nt']);?>
														</span>
													<?php else:?>
														<span class="bold text-c-red">Нақшаи таълими надорад</span>
													<?php endif;?>
												</td>
											</tr>
										<?php endforeach;?>
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