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
							Натиҷаи донишҷӯ
						</li>
						<li class="breadcrumb-item">
							<?=getFanTest($id_fan);?>
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
								Натиҷаи донишҷӯ
							</h5>
						</div>
						<div class="card-block">
							
							<div class="table-responsive davrifaol">
								
								<?php $q_counter = 0;?>
								
								<?php //print_arr($id_questions)?>
								<?php //print_arr($id_answers)?>
								
								<?php $DURUSTS = 0;?>
								<?php for($A = 0; $A < count($id_questions); $A++):?>
									<?php $id_aftq = explode(",", $id_answers[$A]);?>
									<?php $id_question = $id_questions[$A];?>
									<?php $question = query("SELECT * FROM `questions` WHERE `id`='$id_question'"); ?>
									
									<?//=$id_question?>
									<div class="number center" style="font-size: 24px"><?=++$q_counter?>.</div>
									<div class="q_container bold">
										<h5><?=$question[0]['text'];?></h5>
										<table class="table jambo_table bulk_action">
											<thead>	
												<?php if($question[0]['type'] != 4):?>
													<tr>
														<td>Ҷавоби донишҷӯ</td>
														<td>Ҷавоби дуруст</td>
													</tr>
												<?php endif;?>
											</thead>
											<tbody>
												<?php include("types/".$question[0]['type'].".php");?>
											</tbody>
										</table>
										
										<?php if(!empty($test_center_module)):?>
											<br>
											<label>Холи апелятсионӣ:</label>
											<select class="appellation form-control" style="width: 200px">
												<option value="0">Интихоб кунед</option>
												<?php for($i = 1; $i <= 5; $i++):?>
													<option value="<?=$i?>"><?=$i?> хол</option>
												<?php endfor;?>
											</select>
										<?php endif;?>
									</div>
									<br>
									<hr>
									<br>
								<?php endfor;?>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.q_container').on("change", ".appellation", function () {
			
			var score = $(this).val();
			
			var id_student = <?=$id_student?>;
			var id_fan = <?=$id_fan?>;
			var s_y = <?=$s_y?>;
			var h_y = <?=$h_y?>;
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=setAppellation";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"score": score, "id_student": id_student, "id_fan": id_fan, "s_y": s_y, "h_y": h_y},
				success: function(data){
					console.log(data);
				}
			});
			
		});
		
		
		
	});
</script>