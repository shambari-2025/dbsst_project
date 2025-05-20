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
							Иловакунии натиҷаҳо
						</li>
						<li class="breadcrumb-item" title="<?=$group_options[0]['faculty_title']?>">
							<?=getUserName($id_student);?>
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
							
							
							
							<!-- FANHO -->
							
							<div class="card">
								<div class="card-header">
									<h5>Лутфан натиҷаҳоро тибқи меъёри 100 холӣ дар рӯйхати поёнӣ барои ҳар як фанни овардашуда ворид намоед.</h5>
									<h5>ЭЗОҲ: Шумо ҳамчун мутасаддӣ барои дурустии маълумотҳои пуркардаатон масъул мебошед!!! </h5>
								</div>
								<div class="card-block">
									<div class="table-responsive davrifaol">
										<form action="<?=MY_URL?>?option=students&action=insert_oldresults" method="post" enctype="multipart/form-data">
											<table class="addform">
												<thead class="center">
													<tr>
														<th>№</th>
														<th>Номи фан</th>
														<th>Курс</th>
														<th>Соли таҳсил</th>
														<th>Нимсола</th>
														<th style="width:5%">Холи<br>умумӣ</th>
														<th style="width:5%">Холи<br>умумӣ (КК)</th>
													</tr>
												</thead>
												<?php $i=1;?>
												<?php foreach($allfans as $fan):?>
													<tr>
														<td><?=$i;?>.</td>
														<td><?=getFanTest($fan['id_fan'])?><?php if($fan['k_k']):?>(Кори курсӣ)<?php endif;?><input type="hidden" name="fan[<?=$i?>]" value="<?=$fan['id_fan']?>"></td>
														<td><?=getCourseBySemestr($fan['semestr'])?><input type="hidden" name="course[<?=$i?>]" value="<?=getCourseBySemestr($fan['semestr'])?>"></td>
														<td><?=getStudyYearBySemestr($id_course, $fan['semestr'])?><input type="hidden" name="s_y[<?=$i?>]" value="<?=getStudyYearBySemestr($id_course, $fan['semestr'], true)?>"></td>
														<td><?=getNimsolaBySemestr($fan['semestr'])?><input type="hidden" name="h_y[<?=$i?>]" value="<?=getNimsolaBySemestr($fan['semestr'])?>"></td>
														<td><input type="text" name="total_score[<?=$i?>]" style="width: 50px;"></td>
														<td><?php if($fan['k_k']):?>
																<input type="text" name="kori_kursi[<?=$i?>]" style="width: 50px;">
															<?php else:?>
																<input type="text" name="kori_kursi[<?=$i?>]" style="width: 50px;" disabled>
															<?php endif;?>
															
														
														</td>
													</tr>
													<?php $i++;?>
												<?php endforeach;?>
												<tr>
													<td colspan="5">
														<input type="hidden" name="id_student" value="<?=$id_student;?>">
														<button type="submit" class="btn btn-success">Сабт кардан</button>
													</td>
													
												</tr>
											</table>
										<form>
										<!--<?php foreach($allfans as $fan):?>
											<?=getFanTest($fan['id_fan']);?><br>
										<?php endforeach;?>-->
									</div>
								</div>
							</div>
							
							<!-- FANHO -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	jQuery(document).ready(function($){
		
	});
</script>
