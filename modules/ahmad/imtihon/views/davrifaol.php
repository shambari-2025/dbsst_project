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
							Даври фаъол
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<!--
	<?php if(!isset($id_nt)):?>
		<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown myalert"><i class="fa fa-warning"></i> Ин гурӯҳ нақшаи таълимӣ надорад. Лутфан нақшаи таълимии гурӯҳро муайян кунед.</div>
	<?php endif;?>
	
	-->
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						
						
						<div class="col-xl-12 col-md-12">
							
							<div class="card">
								<div class="card-header">
									<h5>Интихоби сол ва нимсолаи таҳсил</h5>
								</div>
								<div class="card-block">
									
									
									<table id="par" style="font-size:16px; width: 75%; margin: 0 auto;">
										<tr>
											<td style="width:25%; padding: 10px">
												<label for="s_y" class="f-16">Соли таҳсил:</label>
												<select name="s_y" id="s_y" class="form-control" style="font-size:16px">
													<?php foreach($STUDY_YEARS as $item): ?>
														<option <?php if($item['id'] == S_Y){ echo "selected";}?> value="<?=$item['id'];?>"><?=$item['title']?></option>
													<?php endforeach;?>
												</select>
											</td>
											<td style="width:25%; padding: 10px">
												<label for="h_y" class="f-16">Нимсолаи таҳсил:</label>
												<select name="h_y" id="h_y" class="form-control" style="font-size:16px">
													<option <?php if(H_Y == 1){echo "selected";}?> value="1">Нимсолаи 1-ум</option>
													<option <?php if(H_Y == 2){echo "selected";}?> value="2">Нимсолаи 2-юм</option>
												</select>
											</td>
											<td style="vertical-align: bottom; width:25%; padding: 10px">
												<input type="hidden" id="id_student" value="<?=$id_student?>">
												<button type="submit" class="btn btn-inverse waves-effect waves-light" id="loaddata" style="padding: 7px 14px;">
													<i class="fa fa-search"></i> Ҷустуҷуи маълумотҳо
												</button>
											</td>
										</tr>
									</table>
									
								</div>
							</div>
						</div>
						
						<div id="ajaxresult" style="width: 100%">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#loaddata').on('click', function(){
			var s_y = $('#s_y').val();
			var h_y = $('#h_y').val();
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/imtihon/imtihon_ajax.php?option=getDavriFaol";?>';
			
			$('#ajaxresult').html("");
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"my_url": my_url, "s_y": s_y, "h_y": h_y},
				beforeSend: function(){
					$('#ajaxresult').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#ajaxresult img').hide();
					$('#ajaxresult').append(data);
				}
			});
		});
	});
</script>
