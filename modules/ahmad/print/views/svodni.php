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
	
	<style>
		* {
			//font-family: "Palatino Linotype";
		}
		p {
			margin: 0;
			padding: 3px;
		}
		
		@media print {
			@page {
				size: landscape; /* Изменяем ориентацию страницы на ландшафтную */
			}
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:14px">
		<div class="floatleft">
			<p class="center"><img style="width:90px" src="<?=URL?>modules/login/views/images/logo-dtmik.png" alt="<?=UNI_NAME?>"></p>
			<p><?=mb_strtoupper(UNI_NAME);?></p>
			<p>Варақаи ҷамъбастии имтиҳонот</p>
			<p class="bold"><span class="underline">Факултети:</span> &nbsp; <?=getFaculty($id_faculty);?></p>
			<p><span class="bold underline">Ихтисос:</span> &nbsp; <?=getSpecialtyCode($id_spec);?> "<?=getGroup2($id_group);?>" <?=getSpecialtyTitle($id_spec);?>, <span class="bold underline">курс:</span> <?=getCourse2($id_course);?>, <span class="bold underline">нимсола:</span> <?=$H_Y; ?>, <span class="bold underline">соли таҳсили</span> <?=getStudyYear($S_Y);?>.</p>
			
		</div>
		
		<div class="clear"></div>
		<br>
		
		<table class="table transcript" style="width:100%; font-size:14px">
			<thead>
				<tr style="height: 100px;">
					<th rowspan="2" class="center">№<br>р/т</th>
					<th rowspan="2" class="center" style="width: 210px">Ному насаби донишҷӯ</th>
					<th rowspan="2" class="center" style="border-right:2px solid #000">
						<pre class="vertical">Шакли таҳсил</pre>
					</th>
					
					<?php foreach($fanlist as $list):?>
						<th colspan="4" style="border-right: 2px solid #000; width: 80px; vertical-align: top">
							
							<?=getShortName($list['id_teacher'])?>
							<hr>
							[<?=$list['c_u']?>-кр.]<br>
							<hr>
							<?=getFan($list['id_fan'])?><br>
							
						</th>
					<?php endforeach;?>
					<th rowspan="2" class="center"><p class="vertical">GPA</p></th>
				</tr>
				
				<tr>
					<?php foreach($fanlist as $list):?>
						<th class="center">НФ</th>
						<th class="center">М</th>
						<th class="center">И</th>
						<th class="center" style="border-right:2px solid #000">Т</th>
					<?php endforeach;?>
				</tr>
			</thead>

			<tbody>
				<?php $counter = 0;?>
				<?php //$students = [];?>
				<?php foreach($students as $item):?>
					<?php $sum_zarbi_cred = 0;?>
					<tr>
						<td rowspan="2" class="center"><?=++$counter?>.</td>
						<td rowspan="2"><?=$item['fullname']?></td>
						<td rowspan="2" class="center" style="border-right: 2px solid #000">
							<?=mb_strcut(getStudyType($item['id_s_t']), 1, 2)?>
						</td>
						
						<?php foreach($fanlist as $list):?>
							<?php $all_score = getAllScore($item['id'], $list['id_fan'], $S_Y, $H_Y);?>
							
							<td class="center"><?=getNF12($item['id'], $list['id_fan'], $S_Y, $H_Y)?></td>
							<td class="center"><?=getAdministrationScore($item['id'], $S_Y, $H_Y)?></td>
							<td class="center">0</td>
							<td class="center" style="border-right:2px solid #000">
							<?=getIMT($item['id'], $list['id_fan'], $S_Y, $H_Y)?>
							</td>	
							<?php $sum_zarbi_cred += $list['c_u'] * getAdad($all_score);?>
							
						<?php endforeach;?>
						
						<td rowspan="2" class="center">
							<?=round($sum_zarbi_cred / $sum_credit, 2)?>
						</td>
					</tr>
					
					<tr>
						<?php foreach($fanlist as $list):?>
							<td colspan="2" class="center" style="border-bottom: 2px solid #000;">
								<?php $all_score = getAllScore($item['id'], $list['id_fan'], $S_Y, $H_Y);?>
								<?=$all_score += getAdministrationScore($item['id'], $S_Y, $H_Y)?>
							</td>
							<td colspan="2" class="center bold" style="border-bottom: 2px solid #000; border-right:2px solid #000;">
								<?=getAdad($all_score)?> <?=getLatter($all_score)?>
							</td>
						<?php endforeach;?>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<br>
		<br>
		
		
		<table class="table" style="width:40%; font-size:14px; margin: 10px auto;">
			
			<tr style="height: 36px" class="center">
				<td>Сардори маркази ТФ ва ТИТ:</td>
				<td>____________</td>
				<td><?=getShortName($id_leader_mbd)?></td>
			</tr>
		</table>
		
		<br>
		<br>
		<br>
		<br>
		
	</body>
	
</html>