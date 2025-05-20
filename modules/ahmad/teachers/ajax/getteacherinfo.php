<div class="col-md-12 col-sm-12">
	
	<?php //print_arr($teacher);?>
	
	<!--<?php if($_SESSION['user']['access_type'] != 3):?>
	
	<button type="button" class="btn btn-inverse waves-effect waves-light" id="loaddata" style="padding: 7px 14px;">
		<a class="davrifaol" target="_blank" href="<?=MY_URL?>?option=print&action=teacherinfo&id_teacher=<?=$id_teacher?>">
			<i class="fa fa-print"></i> Чопи маълумотнома
		</a>
	</button>
	<hr>
	
	<?php endif;?>
	-->
	
	<table border="1" class="infotable" style="width: 100%; font-size: 14px">
		<tbody>
			<tr>
				<td colspan="2" class="bold" rowspan="6" style="width:25%">
					<?php $photo = getUserImg($teacher[0]['id'], $teacher[0]['jins'], $teacher[0]['photo'], 1);?>
					<img class="" src="<?=$photo;?>" style="width:100%; margin: 4px auto; display: block; background: #000; padding: 4px;">
				</td>
				<td>Ному насаб:</td>
				<td colspan="3" class="bold"><?=$teacher[0]['fullname_tj']?></td>
			</tr>
			<tr>
				<td>Кишвар:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($teacher[0]['id_country'])):?>
						<?=getCountry($teacher[0]['id_country'])?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>	
				</td>
			</tr>
			<tr>
				<td>Вилоят / Минтақа:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($teacher[0]['id_region'])):?>
						<?=getRegion($teacher[0]['id_region'])?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
			</tr>
			<tr>
				<td>Ноҳия / Шаҳр:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($teacher[0]['id_district'])):?>
						<?=getDistrict($teacher[0]['id_district'])?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
			</tr>
			<tr>
				<td>Ҷойи зист:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($teacher[0]['address'])):?>
						<?=$teacher[0]['address']?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
			</tr>
			<tr>
				<td>Миллат:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($teacher[0]['id_nation'])):?>
						<?=getNation($teacher[0]['id_nation'])?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
			</tr>
			<tr>
				<td>Логин:</td>
				<td class="bold"><?=$teacher[0]['login']?></td>
				<td>Ҷинс:</td>
				<td colspan="3" class="bold"><?=getJins($teacher[0]['jins'])?></td>
			</tr>
			<tr>
				<td>Парол:</td>
				<td class="bold"><?=$teacher[0]['password']?></td>
				<td>Рузи таввалӯд:</td>
				<td class="bold">
					<?php if(!empty($teacher[0]['birthday'])):?>
						<?=makeDay($teacher[0]['birthday'])?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
				
				<td>Сину сол:</td>
				<td class="bold"><?=getSinuSol($teacher[0]['birthday'])?></td>
			</tr>
			<tr>
				<td colspan="2">Телефон:</td>
				<td class="bold">
					<?php if(!empty($teacher[0]['phone'])):?>
						<?php $phones = explode(" ", $teacher[0]['phone']);?>
						<?php foreach($phones as $ph):?>
							<?=$ph?><br>
						<?php endforeach;?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
				<td>Бори охир:</td>
				<td colspan="2" class="bold">
					<?php if(!empty($teacher[0]['last_login'])):?>
						<?=formatDate($teacher[0]['last_login'])?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
			</tr>
			<tr>
				<td colspan="2">№ Шинонома:</td>
				<td  class="bold">
					<?php if(!empty($teacher[0]['number_passport'])):?>
						<?=$teacher[0]['number_passport']?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
				<td>Даромадааст:</td>
				<td colspan="2" class="bold"><?=$teacher[0]['counter']?></td>
			</tr>
		</tbody>
	</table>
	
</div>
