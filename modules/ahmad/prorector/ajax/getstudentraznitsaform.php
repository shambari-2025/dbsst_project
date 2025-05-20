<h6 class="center"><!--Маълумотҳои гурӯҳии донишҷӯ--><?=$shartnoma?></h6>
<hr style="margin: 0 0 20px 0;">
<form action="<?=MY_URL?>?option=students&action=save_raznitsa" method="post" enctype="multipart/form-data">
	<table class="table" style="font-size: 14px !important">
		<tr style="background-color: #263544; color: #fff">
			<th style="width: 5%;">№</th>
			<th>Номи фан</th>
			<th style="width: 5%;">Миқдори<br>кредитҳо</th>
			<th style="width: 5%;">Маблағ</th>
			<th style="width: 2%;">Курс</th>
			<th style="width: 10%;">Соли<br>таҳсил</th>
			<th style="width: 5%;">Нимсола</th>
			<th>Омӯзгор</th>
		</tr>
		<?php $i=1;?>
		<?php //print_arr($raznitsa);?>
		<?php foreach($raznitsa as $item):?>
			<tr class="center">
				<td style="width: 5%;"><?=$i;?>.</td>
				<td class="left">
					<?=getFanTest($item['id_fan'])?>[<?=$item['id_fan']?>]
					<input type="hidden" name="fan[<?=$i?>]" value="<?=$item['id_fan']?>">
				</td>
				<input type="hidden" name="type[<?=$i?>]" value="1">
				<td style="width: 5%;"><?=$item['c_f_u']?><input type="hidden" name="credit[<?=$i?>]" value="<?=$item['c_f_u']?>"></td>
				<td style="width: 5%;"><?=$money = round($shartnoma / 60 * $item['c_f_u'], 2)?><input type="hidden" name="money[<?=$i?>]" value="<?=$money?>"></td>
				<td style="width: 2%;"><?=$course=getCourseBySemestr($item['semestr'])?><input type="hidden" name="course[<?=$i?>]" value="<?=$course?>"></td>
				<td style="width: 10%;"><?=getStudyYearBySemestr($id_course, $item['semestr'])?><input type="hidden" name="s_y[<?=$i?>]" value="<?=$id_sy=getStudyYearBySemestr($id_course, $item['semestr'], true)?>"></td>
				<td style="width: 5%;"><?=$id_hy=getNimsolaBySemestr($item['semestr'])?><input type="hidden" name="h_y[<?=$i?>]" value="<?=$id_hy?>"></td>
				<td class="left">
					<?php
						//$id_fan = $item['id_fan'];
						$teachers = query("SELECT * FROM `users` WHERE `id` IN
											(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` IN
												(SELECT DISTINCT `id_departament` FROM `iqtibosho` INNER JOIN `departaments` ON `iqtibosho`.`id_departament`=`departaments`.`id`
												WHERE `iqtibosho`.`id_fan`='{$item['id_fan']}')
											)
										ORDER BY `fullname_tj`");
										
						//print_arr($teachers);
						if(empty($teachers)){
							$teachers = query("SELECT * FROM `users` WHERE `access_type` = '2' ORDER BY `fullname_tj`");
						}
					?>
					<select name="teacher_<?=$i?>" id="teachers" class="form-control">
						<option value="0" selected disabled> - Интихоб кунед - </option>
						<?php foreach($teachers as $teacher): ?>
							<?php $zap=query("SELECT * FROM `farqiyatho` INNER JOIN `farqiyatho_content` ON `farqiyatho`.`id`=`farqiyatho_content`.`id_farqiyat` WHERE `farqiyatho`.`id_student`='$id_student' AND `farqiyatho_content`.`id_fan`='{$item['id_fan']}' AND `type` = '1' AND `farqiyatho`.`s_y`='".S_Y."' AND `farqiyatho`.`h_y`='".H_Y."'");?>	
							<?php $id_teacher=$zap[0]['id_teacher'];?>
							<?php $h_y=$zap[0]['h_y'];?>
							<option <?php if($id_teacher == $teacher['id'] && $h_y == $id_hy){ echo "selected";}?> value="<?=$teacher['id']?>"><?=($teacher['fullname_tj'])?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<?php $i++;?>
			<?php if($item['k_k'] != ''):?>
				<tr class="center">
					<td style="width: 5%;"><?=$i;?>.</td>
					<td class="left">
						<?=getFanTest($item['id_fan'])?>[Кори курсӣ]
						<input type="hidden" name="fan[<?=$i?>]" value="<?=$item['id_fan']?>">
					</td>
					<input type="hidden" name="type[<?=$i?>]" value="2">
					<td style="width: 5%;"><input type="hidden" name="credit[<?=$i?>]" value="0"></td>
					<td style="width: 5%;"><input type="hidden" name="money[<?=$i?>]" value="0"></td>
					<td style="width: 2%;"><?=$course=getCourseBySemestr($item['semestr'])?><input type="hidden" name="course[<?=$i?>]" value="<?=$course?>"></td>
					<td style="width: 10%;"><?=getStudyYearBySemestr($id_course, $item['semestr'])?><input type="hidden" name="s_y[<?=$i?>]" value="<?=$id_sy=getStudyYearBySemestr($id_course, $item['semestr'], true)?>"></td>
					<td style="width: 5%;"><?=$id_hy=getNimsolaBySemestr($item['semestr'])?><input type="hidden" name="h_y[<?=$i?>]" value="<?=$id_hy?>"></td>
					<td class="left">
						<?php
							//$id_fan = $item['id_fan'];
							$teachers = query("SELECT * FROM `users` WHERE `id` IN
												(SELECT `id_teacher` FROM `departaments_member` WHERE `id_departament` IN
													(SELECT DISTINCT `id_departament` FROM `iqtibosho` INNER JOIN `departaments` ON `iqtibosho`.`id_departament`=`departaments`.`id`
													WHERE `iqtibosho`.`id_fan`='{$item['id_fan']}')
												)
											ORDER BY `fullname_tj`");
											
							//print_arr($teachers);
							if(empty($teachers)){
								$teachers = query("SELECT * FROM `users` WHERE `access_type` = '2' ORDER BY `fullname_tj`");
							}
						?>
						<select name="teacher_<?=$i?>" id="teachers" class="form-control">
							<option value="0" selected disabled> - Интихоб кунед - </option>
							<?php foreach($teachers as $teacher): ?>
								<?php $zap=query("SELECT * FROM `farqiyatho` INNER JOIN `farqiyatho_content` ON `farqiyatho`.`id`=`farqiyatho_content`.`id_farqiyat` WHERE `farqiyatho`.`id_student`='$id_student' AND `farqiyatho_content`.`id_fan`='{$item['id_fan']}' AND `type` = '2' AND `farqiyatho`.`s_y`='".S_Y."' AND `farqiyatho`.`h_y`='".H_Y."'");?>	
								<?php $id_teacher=$zap[0]['id_teacher'];?>
								<?php $h_y=$zap[0]['h_y'];?>
								<option <?php if($id_teacher == $teacher['id'] && $h_y == $id_hy){ echo "selected";}?> value="<?=$teacher['id']?>"><?=($teacher['fullname_tj'])?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
			<?php $i++;?>
			<?php endif;?>
		<?php endforeach;?>
	</table>
	<table class="addform">		
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_student" value="<?=$id_student?>">
				<button type="submit" class="updatebtn btn btn-inverse waves-effect waves-light">
					<i class="fa fa-save"></i> Сабти маълумотҳо
				</button>
			</td>
		</tr>
	</table>
</form>
	


<script type="text/javascript">
	jQuery(document).ready(function($){
		
	});
</script>