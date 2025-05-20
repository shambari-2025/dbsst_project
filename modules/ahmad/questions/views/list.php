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
							Саволнома
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
							<?=getFanTest($id_fan)?>
						</li>
						<li class="breadcrumb-item">
							Соли таҳсили <?=getStudyYear($S_Y)?>
						</li>
						<li class="breadcrumb-item">
							Нимсолаи <?=$H_Y?>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--
	<style>
		
		.text_img img {
			width: 64px !important;
			height: 64px !important;
		}
	</style>
	-->
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						
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
						
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h5>Руйхати саволҳо</h5>
								</div>
								<div class="card-block">
									<!--
									<button data-toggle="modal" data-target=".bs-example-modal-lg" class="add btn btn-inverse waves-effect waves-light" type="button" style="float: right">
										<a data-toggle="modal" data-target=".bs-example-modal-lg" class="addwithfile davrifaol" href="javascript:">
											<i class="fa fa-plus"></i> Иловакунӣ бо файл (.docx)
										</a>
									</button>
									-->
									<button data-toggle="modal" data-target=".bs-example-modal-lg" class="add btn btn-inverse waves-effect waves-light" type="button" style="float: right">
										<a data-toggle="modal" data-target=".bs-example-modal-lg" class="add davrifaol" href="javascript:">
											<i class="fa fa-plus"></i> Иловакунӣ
										</a>
									</button>
									
									<div class="clear"></div>
									<hr>
									<br>
									<?php //print_arr($questions);?>
									
									<?php $counter = 0;?>
									<?php foreach($questions as $item):?>
										<?php $answers = query("SELECT * FROM `answers` WHERE `id_question` = '".$item['id']."'");?>
										@<?=++$counter?>. <?=$item['text']?><br>
										
										<?php $a = 1;?>
										<?php foreach($answers as $a_item):?>
											<?php if($a_item['right_answer'] == 1):?>
											<span style="font-weight: bold;"> $<?=chr(64+$a)?>) <?=$a_item['text']?></span><br>
											<?php else:?>
											$<?=chr(64+$a)?>) <?=$a_item['text']?><br>
											<?php endif;?>
											<?php $a++;?>
										<?php endforeach;?>
										<br>
									<?php endforeach;?>
									<div class="table-responsive davrifaol">
										<table class="table" style="font-size:14px">
											<thead class="center">
												<tr style="background-color: #263544; color: #fff">
													<th style="width:50px">№</th>
													<th style="width:100px">Рейтинг</th>
													<th style="width:70px">Намуди савол</th>
													<th style="width:450px">Матни савол</th>
													<th style="width:50px">Миқдори<br>ҷавобҳо</th>
													<th style="width:250px">Ҷавоби<br>дуруст</th>
													<th style="width:50px">Амалҳо</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($questions)):?>
													<?php $counter = 0;?>
													<?php foreach($questions as $item):?>
														<tr>
															<th class="center"><?=++$counter?>.</th>
															<th class="center">
																
																<select name="rating" id="rating" class="rating form-control" data-id="<?=$item['id']?>">
																	
																	<?php for($i = 1; $i <= 2; $i++):?>
																		<option <?php if($i == $item['rating']):?> selected <?php endif;?> value="<?=$i?>" title="Рейтинг <?=$i?>">Рейтинг <?=$i?></option>
																	<?php endfor;?>
																</select>
															</th>
															<th class="center"><?=$questions_type[$item['type']]?></th>
															<td class="text_img">
																<?=$item['id']?> <?=$item['text']?>
															</td>
															<th class="center">
																<?=count_table_where("answers", "`id_question` = '".$item['id']."'")?>
															</th>
															
															<th>
																<?php if($item['type'] != 3):?>
																	<?php $text = query("SELECT `text` FROM `answers` WHERE `id_question` = '".$item['id']."' AND `right_answer` = '1'")?>
																	<?php if(!empty($text)):?>
																		<?php foreach($text as $t):?>
																			<?=$t['text']?>
																			<br>
																		<?php endforeach;?>
																	<?php else:?>
																		<span class="text-c-red">
																			ҷавоб нест!
																		</span>
																	<?php endif;?>
																<?php endif;?>
															</th>
															
															<td class="elements center">
																<a href="<?=MY_URL?>?option=questions&action=editquestion&id=<?=$item['id']?>" title="Таёҳриркунӣ">
																	<i class="fa fa-edit"></i>
																</a>
																<a href="<?=MY_URL?>?option=questions&action=delete&id=<?=$item['id']?>" title="Несткунии савол" onclick="return confirmDel()">
																	<i class="fa fa-trash"></i>
																</a>
															</td>
														</tr>
													<?php endforeach;?>
												<?php else:?>
													<tr>
														<td colspan="7" class="center bold">Саволнома нест! Саволҳоро илова кунед!</td>
													</tr>
												<?php endif;?>
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
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.table').on("change", ".rating", function () {
			var rating = $(this).val();
			var id = $(this).attr("data-id");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/questions/questions_ajax.php?option=updateRating";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				//data: {"id_fan": id_fan, "id_departament": id_departament},
				data: {"id": id, "rating": rating},
				success: function(data){
					
				}
			});
			
		});
		
		
		$('.add').on('click', function(){
			var id_iqtibos = <?=$id_iqtibos?>;
			$('.modal-dialog').css("max-width", "40%");
			$('.modal-title').text("Иловакунии саволҳо");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=addForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_iqtibos": id_iqtibos, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
	});
</script>