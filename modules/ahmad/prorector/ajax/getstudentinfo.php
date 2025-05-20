<div class="col-md-12 col-sm-12">
	
	<?php //print_arr($student);?>
	
	<?php if($_SESSION['user']['access_type'] != 3):?>
	<button type="button" class="btn btn-inverse waves-effect waves-light" id="loaddata" style="padding: 7px 14px;">
		<a class="davrifaol" target="_blank" href="<?=MY_URL?>?option=print&action=studentinfo&id_student=<?=$id_student?>">
			<i class="fa fa-print"></i> Чопи маълумотнома
		</a>
	</button>
	<?php endif;?>
	<?php if(isset($_SESSION['admin'])):?>
	<button type="button" class="btn btn-inverse waves-effect waves-light" id="loaddata" style="padding: 7px 14px;">
		<a class="davrifaol" target="_blank" href="<?=MY_URL?>?option=print&action=pardoxthoi_donishju&id=<?=$id_student?>">
			<i class="fa fa-dollar"></i> ПАРДОХТҲО
		</a>
	</button>
	
	<hr>
	<?php endif;?>
	
	<table border="1" class="infotable" style="width: 100%; font-size: 14px">
		<tbody>
			<tr>
				<td colspan="2" class="bold" rowspan="7" style="width:25%">
					<?php $photo = getUserImg($student[0]['id'], $student[0]['jins'], $student[0]['photo']);?>
					<img class="" src="<?=$photo;?>" style="width:100%; margin: 4px auto; display: block; background: #000; padding: 4px;">
				</td>
				<td>Ному насаб:</td>
				<td colspan="3" class="bold"><?=$student[0]['fullname_tj']?></td>
			</tr>
			<tr>
				<td>Ятим:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($student[0]['vazi_oilavi'])):?>
						<?=$student[0]['vazi_oilavi_title']?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>	
				</td>
			</tr>
			
			<tr>
				<td>Кишвар:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($student[0]['id_country'])):?>
						<?=$student[0]['country_title']?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>	
				</td>
			</tr>
			<tr>
				<td>Вилоят / Минтақа:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($student[0]['id_region'])):?>
						<?=$student[0]['region_title']?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
			</tr>
			<tr>
				<td>Ноҳия / Шаҳр:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($student[0]['id_district'])):?>
						<?=$student[0]['district_title']?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
			</tr>
			<tr>
				<td>Ҷойи зист:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($student[0]['address'])):?>
						<?=$student[0]['address']?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
			</tr>
			<tr>
				<td>Миллат:</td>
				<td colspan="3" class="bold">
					<?php if(!empty($student[0]['id_nation'])):?>
						<?=getNation($student[0]['id_nation'])?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
			</tr>
			<tr>
				<td>Логин:</td>
				<td class="bold"><?=$student[0]['login']?></td>
				<td>Ҷинс:</td>
				<td colspan="3" class="bold"><?=getJins($student[0]['jins'])?></td>
			</tr>
			<tr>
				<td>Парол:</td>
				<td class="bold"><?=$student[0]['password']?></td>
				<td>Рузи таввалӯд:</td>
				<td class="bold">
					<?php if(!empty($student[0]['birthday'])):?>
						<?=makeDay($student[0]['birthday'])?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
				
				<td>Сину сол:</td>
				<td class="bold"><?=getSinuSol($student[0]['birthday'])?></td>
			</tr>
			<tr>
				<td colspan="2">Телефон:</td>
				<td class="bold">
					<?php if(!empty($student[0]['phone'])):?>
						<?=$student[0]['phone']?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
				<td>Бори охир:</td>
				<td colspan="2" class="bold">
					<?php if(!empty($student[0]['last_login'])):?>
						<?=formatDate($student[0]['last_login'])?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
			</tr>
			<tr>
				<td colspan="2">№ Шинонома:</td>
				<td  class="bold">
					<?php if(!empty($student[0]['number_passport'])):?>
						<?=$student[0]['number_passport']?>
					<?php else:?>
						<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
					<?php endif;?>
				</td>
				<td>Даромадааст:</td>
				<td colspan="2" class="bold"><?=$student[0]['counter']?></td>
			</tr>
		</tbody>
	</table>
	
	<br>
	<br>
	<h6 class="bold">Маълумотнома дар бораи таҳсилоти донишҷӯ</h6>
	<hr>
	<table border="1" class="infotable"  style="width: 100%; font-size: 14px">
		<tbody>
			<tr>
				<td>Факултет:</td>
				<td class="bold"><?=$student[0]['faculty_title']?></td>
			</tr>
			
			<tr>
				<td>Курс:</td>
				<td class="bold"><?=$student[0]['id_course']?></td>
			</tr>
			
			<tr>
				<td>Ихтисос:</td>
				<td class="bold"><?=$student[0]['spec_code']?> - <?=$student[0]['spec_title_tj']?></td>
			</tr>
			
			<tr>
				<td>Гуруҳ:</td>
				<td class="bold"><?=$student[0]['group_title']?></td>
			</tr>
			
			<tr>
				<td>Зинаи таҳсил:</td>
				<td class="bold"><?=$student[0]['study_level_title']?></td>
			</tr>
			
			<tr>
				<td>Шакли таҳсил:</td>
				<td class="bold"><?=$student[0]['study_type_title']?></td>
			</tr>
			
			<tr>
				<td>Намуди таҳсил:</td>
				<td class="bold"><?=$student[0]['study_view_title']?></td>
			</tr>
		</tbody>
	</table>
	
	
	<br>
	<br>
	<h6 class="bold">Маълумотнома дар бораи таҳсилоти донишҷӯ</h6>
	<hr>
	<table border="1" class="infotable"  style="width: 100%; font-size: 14px">
		<thead class="center">
			<tr style="background-color: #263544;color: #fff;">
				<th>Соли<br>таҳсил</th>
				<th><div class="vertical">Семестр</div></th>
				<th><div class="vertical">Факултет</div></th>
				<th>Шуъба</th>
				<th><div class="vertical">Курс</div></th>
				<th>Ихтисос</th>
				<th><div class="vertical">Гуруҳ</div></th>
				<th>Шакли<br>таҳсил</th>
				<th style="width:80px;">Намуди<br>фармон</th>
				<th style="width:80px;">Рақами<br>Фармон</th>
			</tr>
		</thead>
		
		<tbody>
			<?php $counter = 1;?>
			<?php foreach($history as $h_item):?>
				
				
				<tr class="center" <?php if(getSemestr($h_item['id_course'], $h_item['h_y']) % 2 == 0) { echo 'style="border-bottom: 2px solid #c5c5c5"';}?>>
					<td><?=getStudyYear($h_item['s_y'])?></td>
					<td><?=getSemestr($h_item['id_course'], $h_item['h_y'])?></td>
					<td title="<?=getFaculty($h_item['id_faculty'])?>"><?=getFacultyShort($h_item['id_faculty'])?></td>
					<td><?=getStudyView($h_item['id_s_v'])?></td>
					<td><?=getCourse2($h_item['id_course'])?></td>
					<td title="<?=getSpecialtyTitle($h_item['id_spec'])?>"><?=getSpecialtyCode($h_item['id_spec'])?></td>
					<td><?=getGroup2($h_item['id_group'])?></td>
					<td><?=getStudyType($h_item['id_s_t'])?></td>
					
					<td></td>
					<td></td>
				</tr>
				<?php $counter++;?>
			<?php endforeach;?>
		</tbody>
	</table>
	
	
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		
		
	});
</script>