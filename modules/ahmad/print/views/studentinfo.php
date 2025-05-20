<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$page_info['title']?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="author" content="colorlib" />
		
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/davrifaol.css">
	</head>
	
	<body style="width:94%; margin: 15px auto 0 auto">
		
		<div class="col-md-12 col-sm-12">
			<p>Сомонаи мо: &nbsp;&nbsp;&nbsp; <b><?=URL?></b></p>
			<table class="infotable" style="width: 100%; font-size: 14px">
				<tbody>
					<tr>
						<td colspan="2" class="bold" rowspan="7" style="width:25%">
							<?php $photo = getUserImg($student[0]['id'], $student[0]['jins'], $student[0]['photo']);?>
							<img class="" src="<?=$photo;?>" style="width:100%; margin: 10px auto; display: block">
						</td>
						<td>Ному насаб:</td>
						<td colspan="3" class="bold"><?=$student[0]['fullname_tj']?></td>
					</tr>
					
					<tr>
						<td>Ятим:</td>
						<td colspan="3" class="bold"><?=getVaziOilavi($student[0]['vazi_oilavi'])?></td>
					</tr>
					
					<tr>
						<td>Кишвар:</td>
						<td colspan="3" class="bold"><?=getCountry($student[0]['id_country'])?></td>
					</tr>
					<tr>
						<td>Вилоят / Минтақа:</td>
						<td colspan="3" class="bold">
							<?php if(!empty($student[0]['id_region'])):?>
								<?=getRegion($student[0]['id_region'])?>
							<?php else:?>
								<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
							<?php endif;?>
						</td>
					</tr>
					<tr>
						<td>Ноҳия / Шаҳр:</td>
						<td colspan="3" class="bold">
							<?php if(!empty($student[0]['id_district'])):?>
								<?=getDistrict($student[0]['id_district'])?>
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
						<td colspan="3" class="bold"><?=getNation($student[0]['id_nation'])?></td>
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
			<h4 class="bold">Маълумотнома дар бораи таҳсилоти донишҷӯ</h4>
			
			<table class="infotable"  style="width: 100%; font-size: 14px">
				<tbody>
					<tr>
						<td>Факултет:</td>
						<td class="bold"><?=getFaculty($student[0]['id_faculty'])?></td>
					</tr>
					
					<tr>
						<td>Курс:</td>
						<td class="bold"><?=getCourse2($student[0]['id_course'])?></td>
					</tr>
					
					<tr>
						<td>Ихтисос:</td>
						<td class="bold"><?=getSpecialtyCode($student[0]['id_spec'])?> - <?=getSpecialtyTitle($student[0]['id_spec'])?></td>
					</tr>
					
					<tr>
						<td>Гуруҳ:</td>
						<td class="bold"><?=getGroup2($student[0]['id_group'])?></td>
					</tr>
					
					<tr>
						<td>Зинаи таҳсил:</td>
						<td class="bold"><?=getStudyLevel($student[0]['id_s_l'])?></td>
					</tr>
					
					<tr>
						<td>Шакли таҳсил:</td>
						<td class="bold"><?=getStudyType($student[0]['id_s_t'])?></td>
					</tr>
					
					<tr>
						<td>Намуди таҳсил:</td>
						<td class="bold"><?=getStudyView($student[0]['id_s_v'])?></td>
					</tr>
				</tbody>
			</table>
			
			<br>
			<h4 class="bold">Маълумотнома дар бораи таҳсилоти донишҷӯ</h4>
			
			<table class="infotable"  style="width: 100%; font-size: 14px">
				<thead class="center">
					<tr>
						<th>Соли таҳсил</th>
						<th><div class="vertical">Семестр</div></th>
						<th>Факултет</th>
						<th>Шуъба</th>
						<th><div class="vertical">Курс</div></th>
						<th>Ихтисос</th>
						<th>Гуруҳ</th>
						<th>Шакли таҳсил</th>
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
						</tr>
						<?php $counter++;?>
					<?php endforeach;?>
				</tbody>
			</table>
			<br>
			<br>
		</div>
		
	</body>
	
</html>