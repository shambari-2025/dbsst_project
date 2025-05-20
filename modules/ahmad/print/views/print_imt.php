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
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:14px">
		
		<div class="floatleft">
			<p class="center"><img style="width:90px" src="<?=URL?>modules/login/views/images/logo-dtmik.png" alt="<?=UNI_NAME?>"></p>
			<p><?=mb_strtoupper(UNI_NAME);?></p>
			<p>ВАРАКАИ КАЙДИ НАЗОРАТИ ФОСИЛАВИИ № ____</p>
			<p class="bold"><span class="underline">Факултети:</span> &nbsp; <?=getFaculty($id_faculty);?></p>
			<p><span class="bold underline">Ихтисос:</span> &nbsp; <?=getSpecialtyTitle($id_spec);?></p>
			<p><span class="bold underline">Гуруҳ:</span> &nbsp; <?=getSpecialtyCode($id_spec);?> "<?=getGroup2($id_group);?>", <span class="bold underline">курс:</span> <?=getCourse2($id_course);?>, <span class="bold underline">нимсола:</span> <?=$H_Y; ?>, <span class="bold underline">соли таҳсили</span> <?=getStudyYear($S_Y);?>.</p>
			<p><span class="bold underline">Кафедра:</span> &nbsp; "<?=getDepartamentByIdFan($id_fan);?>".</p>
			<p><span class="bold underline">Фан:</span> &nbsp; <?=getFan($id_fan);?>. &nbsp;&nbsp;&nbsp;&nbsp; <span class="bold underline">Микдори кредит:</span> &nbsp;&nbsp; <?=getCredit($id_fan, $id_nt, $H_Y)?>.</p>
			<p><span class="bold underline">Ном ва насаби омузгор:</span> &nbsp; <?=getUserName($id_teacher);?></p>
			<p>
				<span class="bold underline">Рӯзи имтиҳон</span> ________________ 
			</p>
		</div>
		
		
		
		
		
		<div class="clear"></div>
		<br>
		
		<table class="table transcript" style="width:100%; font-size:14px">
			<thead>
				<tr>
					<th class="center">№<br>р/т</th>
					<th class="center" style="width: 350px">Ному насаби донишҷӯ</th>
					<th class="center"><p class="vertical">Шакли<br>таҳсил</p></th>
					<th class="center">Ҷамъи <br> НФ-1 <br> НФ-2</th>
					<th class="center"><p class="vertical">Маъмурӣ</p></th>
					<th class="center"><p class="vertical">Имтиҳон</p></th>
					<th class="center"><p class="vertical">Ҷамъ</p></th>
					<th class="center"><p class="vertical">Бо<br>адад</p></th>
					<th class="center"><p class="vertical">Бо<br>ҳарф</p></th>
					
				</tr>
				
				
			
			</thead>

			<tbody>
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td><?=$item['fullname']?></td>
						<td class="center"><?=mb_strcut(getStudyType($item['id_s_t']), 1, 2)?></td>
						<td class="center">
							<?=getNF12($item['id'], $id_fan, $S_Y, $H_Y)?>
						</td>
						<td class="center"><?=$mamur_score = getAdministrationScore($item['id'], $S_Y, $H_Y)?></td>
						<td class="center">
							<?=$imt_res = getIMT($item['id'], $id_fan, $S_Y, $H_Y)?>
						</td>
						<td class="center">
							<?php if($imt_res):?>
								<?php $all_score = $mamur_score + getAllScore($item['id'], $id_fan, $S_Y, $H_Y);?>
								<?=$all_score?>
							<?php else:?>
								<?php $all_score = 0;?>
								наомад
							<?php endif;?>
						</td>
						<td class="center"><?=getAdad($all_score)?></td>
						<td class="center"><?=getLatter($all_score)?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<br>
		
		
		<table class="table" style="width:60%; font-size:14px; margin: 10px auto;">
			<tr style="height: 36px">
				<td>Омӯзгор</td>
				<td class="center">____________</td>
				<td><?=getShortName($id_teacher)?></td>
			</tr>
			<tr style="height: 36px">
				
				<td>Сардори маркази бақайдгирӣ</td>
				<td class="center">____________</td>
				<td>Каримов Б. Ҳ.</td>
			</tr>
			<tr style="height: 36px">
				<td>Сардори маркази ТФ ва ТИТ</td>
				<td class="center">____________</td>
				<td><?=getShortName($id_leader_mbd)?></td>
			</tr>
		</table>
		
		<br>
		<br>
		<br>
		<br>
		
	</body>
	
</html>