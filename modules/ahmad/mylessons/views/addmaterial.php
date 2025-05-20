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
							Маводи дарсӣ
						</li>
						
						<li class="breadcrumb-item">
							Иловакунӣ
						</li>
						
						<li class="breadcrumb-item">
							<?=getFacultyShort($id_faculty)?>
						</li>
						<li class="breadcrumb-item">
							<?=getCourse($id_course)?>
						</li>
						<li class="breadcrumb-item">
							<?=getSpecialtyCode($id_spec)?>
							<?=getGroup($id_group)?>
						</li>
						<li class="breadcrumb-item">
							<?=getFanTest($info[0]['id_fan'])?>
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
							<div class="card">
								<div class="card-header">
									<h5><?=getFanTest($info[0]['id_fan'])?></h5>
								</div>
								<div class="card-block">
									
									<table class="table" style="font-size: 14px !important">
										<tbody>
											<?php foreach($weeks as $item):?>
												
												<?php
												$mavzu = query("SELECT * FROM `mavodho` WHERE `id_iqtibos`= '$id_iqtibos' AND `id_week` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
												$suporish = query("SELECT * FROM `suporishho` WHERE `id_iqtibos`= '$id_iqtibos' AND `id_week` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
												
												?>
												<tr>
													<th class="center" colspan="4" style="text-transform: uppercase; background: #eae9e9;">
														<h5><?=$item['title']?></h5>
													</th>
												</tr>
												
												<tr>
													<th style="width: 150px">Мавзуи <?=$item['id']?></th>
													<td class="left bold">
														
														<?php if(!empty($mavzu)):?>
															<?=$mavzu[0]['title']?>
														<?php else:?>
															<p class="center red"><i class="fa fa-warning"></i> Маълумот нест</p>
														<?php endif;?>
														
													</td>
													
													<td style="width: 80px">
														<i class="fa fa-eye"></i> 
														<?php if(empty($mavzu)):?>
															0
														<?php else:?>
															<?=$mavzu[0]['views']?>
														<?php endif;?>
													</td>
													
													<td class="center elements" style="width: 175px">
														
														<?php if(empty($mavzu)):?>
															<a href="<?=MY_URL?>?option=mylessons&action=addlesson&id_iqtibos=<?=$id_iqtibos?>&id_fan=<?=$info[0]['id_fan']?>&id_week=<?=$item['id']?>"><i class="fa fa-plus"></i> </a>
														<?php else:?>
															<a href="<?=MY_URL?>?option=mylessons&action=editlesson&id=<?=$mavzu[0]['id']?>"><i class="fa fa-edit"></i> </a>
															<a href="<?=MY_URL?>?option=mylessons&action=deletelesson&id=<?=$mavzu[0]['id']?>" onclick="return confirm('Шумо ин мавзуро нест кардан мехоҳед?');"><i class="fa fa-trash"></i> </a>
														<?php endif;?>
														
														<!--<a href="#"><i class="fa fa-trash"></i> </a>-->
													</td>
												</tr>
												<tr>
													<th style="width: 150px">Супориши <?=$item['id']?></th>
													<td class="left">
														
														<?php if(!empty($suporish)):?>
															<?=$suporish[0]['title']?>
														<?php else:?>
															<p class="center red bold"><i class="fa fa-warning"></i> Маълумот нест</p>
														<?php endif;?>
														
													</td>
													
													<td>
														<i class="fa fa-eye"></i> 
														<?php if(empty($suporish)):?>
															0
														<?php else:?>
															<?=$suporish[0]['views']?>
														<?php endif;?>
													</td>
													<td class="center elements" style="width: 175px">
														
														<?php if(empty($suporish)):?>
															<a href="<?=MY_URL?>?option=mylessons&action=addsuporish&id_iqtibos=<?=$id_iqtibos?>&id_fan=<?=$info[0]['id_fan']?>&id_week=<?=$item['id']?>"><i class="fa fa-plus"></i> </a>
														<?php else:?>
															<a href="<?=MY_URL?>?option=mylessons&action=editsuporish&id=<?=$suporish[0]['id']?>"><i class="fa fa-edit"></i> </a>
															<a href="<?=MY_URL?>?option=mylessons&action=deletesuporish&id=<?=$suporish[0]['id']?>" onclick="return confirm('Шумо ин супоришро нест кардан мехоҳед?');"><i class="fa fa-trash"></i> </a>
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
</div>