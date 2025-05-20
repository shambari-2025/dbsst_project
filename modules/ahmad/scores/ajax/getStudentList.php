<div class="col-md-12 col-sm-12">
	<!--
	<p class="center"><i>Эзоҳ: Холҳои ҳамон донишҷӯёне иваз мешаванд, ки пештар <b>0</b> доштанд ва ҳамонҳам дар майдони Рейтинги 1</i></p>
	-->
	
	<table class="table" style="font-size:14px">
		<thead class="center">
			<tr style="background-color: #263544; color: #fff">
				<th style="width:40px">№</th>
				<th>Ному насаб</th>
				<th style="width:70px">Хол</th>
			</tr>
		</thead>
		<tbody class="center">
			
			<?php if(!empty($students)):?>
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					<tr>
						<th scope="row"><?=++$counter?>.</th>
						<td class="left">
							<?=$item['fullname_tj']?> <?=$item['id']?>
						</td>
						<?php $data = query("SELECT `id`, `imt_status` FROM `results` WHERE `id_student` = '".$item['id']."' AND `id_fan` = '$id_fan' AND `id_course` = '$id_course' AND `id_s_v` = '$id_s_v' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");?>
						
						<td class="center">
							<?php if(!empty($data)):?>
								<?php if(!is_null($data[0]['imt_status'])):?>
									<?php if($data[0]['imt_status'] == '1'):?>
										<a class="status" href="javascript:" data-id="<?=$data[0]['id']?>" data-status="<?=$data[0]['imt_status']?>"><i class="fa fa-unlock"></i></a>
									<?php else:?>
										<a class="status" href="javascript:" data-id="<?=$data[0]['id']?>" data-status="<?=$data[0]['imt_status']?>"><i class="fa fa-lock"></i></a>
									<?php endif?>
								<?php endif?>
							<?php endif;?>
						</td>
						
					</tr>
				<?php endforeach;?>
				
			<?php else: ?>
				<tr class="center bold">
					<td colspan="5">
						<i class="fa fa-warning"></i> Маълумот нест.
					</td>
				</tr>
			<?php endif;?>
		</tbody>
	</table>
	
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){

		$('.status').on('click', function(){
			var id = $(this).attr("data-id");
			var status = $(this).attr("data-status");
			
			console.log(id);
			console.log(status);
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/scores/scores_ajax.php?option=IMTstatus";?>';
			
			
			if(status == 1) {
				set = 0;
				addclass_name = 'fa-lock';
				remclass_name = 'fa-unlock';
			}else{
				set = 1;
				addclass_name = 'fa-unlock';
				remclass_name = 'fa-lock';
			}
			
			$.ajax({
				type: 'post',
				url: url,
				data: {"id": id, "set": set},
				success: function(data){
					console.log(data);
				}
			});
			
			if(status == 1) {
				$(this).attr('data-status', set);
			}else{
				$(this).attr('data-status', set);
			}
			
			$(this).find("i").removeClass(remclass_name);
			$(this).find("i").addClass(addclass_name);
			
		});
	});
</script>