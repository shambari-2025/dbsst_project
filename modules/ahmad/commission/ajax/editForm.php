<form action="<?=MY_URL?>?option=commission&action=update_member" method="post" enctype="multipart/form-data">
	<table class="addform">
		<tr>
			<td>
				<label for="id_user">Омӯзгорро интихоб кунед:</label>
				<select name="id_user" id="id_teacher" class="form-control">
					<option value="">-- Интихоб кунед! --</option>
					<?php foreach($all_teachers as $item):?>
						<option <?php if($item['id'] == $commission[0]['id_user']):?>selected<?php endif;?> value="<?=$item['id']?>"><?=$item['fullname_tj']?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>	
		<tr>
			<td>
				<label for="">Факултетҳо:</label>
				<p>
				<div class="checkbox-zoom zoom-success">
					<label class="semestr" for="ALL_FACULTIES">
							<input <?php if($commission[0]['id_faculties'] == 'ALL'):?>checked<?php endif;?> type="checkbox" name="faculties[]" id="ALL_FACULTIES" value="ALL">
							<span class="cr">
								<i class="cr-icon icofont icofont-ui-check txt-success"></i>
							</span>
							<span>Ҳамаи факултетҳо</span>
						</label>
				</div>
				</p>
				<?php foreach($faculties as $f_item):?>
					<p>
					<div class="checkbox-zoom zoom-success">
						<label class="semestr" for="faculty_<?=$f_item['id']?>">
							<input <?php if(in_array($f_item['id'], explode(",", $commission[0]['id_faculties']))):?>checked<?php endif;?> type="checkbox" name="faculties[]" id="faculty_<?=$f_item['id']?>" value="<?=$f_item['id']?>">
							<span class="cr">
								<i class="cr-icon icofont icofont-ui-check txt-success"></i>
							</span>
							<span><?=$f_item['title']?></span>
						</label>
					</div>
					</p>
				<?php endforeach;?>
			</td>
		</tr>
		
		
		<tr>
			<td>
				<label for="">Зинаҳои таҳсил:</label>
				<p>
				<div class="checkbox-zoom zoom-success">
					<label class="semestr" for="ALL_STUDY_LEVELS">
						<input <?php if($commission[0]['id_s_l'] == 'ALL'):?>checked<?php endif;?> type="checkbox" name="study_level[]" id="ALL_STUDY_LEVELS" value="ALL">
						<span class="cr">
							<i class="cr-icon icofont icofont-ui-check txt-success"></i>
						</span>
						<span>Ҳамаи зинаҳои таҳсил</span>
					</label>
				</div>
				</p>
				<?php foreach($studylevels as $s_item):?>
					<p>
					<div class="checkbox-zoom zoom-success">
						<label class="semestr" for="study_level_<?=$s_item['id']?>">
							<input <?php if(in_array($s_item['id'], explode(",", $commission[0]['id_s_l']))):?>checked<?php endif;?> type="checkbox" name="study_level[]" id="study_level_<?=$s_item['id']?>" value="<?=$s_item['id']?>">
							<span class="cr">
								<i class="cr-icon icofont icofont-ui-check txt-success"></i>
							</span>
							<span><?=$s_item['title']?></span>
						</label>
					</div>
					</p>
				<?php endforeach;?>
			</td>
		</tr>
		
		
		<tr>
			<td>
				<label for="">Мамлакатҳо:</label>
				<p>
				<div class="checkbox-zoom zoom-success">
					<label class="semestr" for="ALL_COUNTRIES">
						<input <?php if($commission[0]['id_countries'] == 'ALL'):?>checked<?php endif;?> type="checkbox" name="countries[]" id="ALL_COUNTRIES" value="ALL">
						<span class="cr">
							<i class="cr-icon icofont icofont-ui-check txt-success"></i>
						</span>
						<span>Ҳамаи мамлакатҳо</span>
					</label>
				</div>
				</p>
				<?php foreach($countries as $c_item):?>
					<p>
					<div class="checkbox-zoom zoom-success">
						<label class="semestr" for="id_countries_<?=$c_item['id']?>">
							<input <?php if(in_array($c_item['id'], explode(",", $commission[0]['id_countries']))):?>checked<?php endif;?> type="checkbox" name="countries[]" id="id_countries_<?=$c_item['id']?>" value="<?=$c_item['id']?>">
							<span class="cr">
								<i class="cr-icon icofont icofont-ui-check txt-success"></i>
							</span>
							<span><?=$c_item['title']?></span>
						</label>
					</div>
					</p>
				<?php endforeach;?>
			</td>
		</tr>
		
		
		<tr>
			<td>
				<input type="hidden" name="id" value="<?=$id?>">
				<button type="submit" class="btn btn-inverse waves-effect waves-light">
					<i class="fa fa-save"></i> Сабт кардан
				</button>
			</td>
		</tr>
	</table>
	
</form>



<script type="text/javascript">
	jQuery(document).ready(function($){
		
	});
</script>