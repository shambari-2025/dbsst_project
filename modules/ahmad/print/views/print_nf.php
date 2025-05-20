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
			<p><span class="bold underline">Гуруҳ:</span> &nbsp; <?=getSpecialtyCode($id_spec);?> "<?=getGroup($id_group);?>", <span class="bold underline">курс:</span> <?=getCourse2($id_course);?>, <span class="bold underline">нимсола:</span> <?=$H_Y; ?>, <span class="bold underline">соли таҳсили</span> <?=getStudyYear($S_Y);?>.</p>
			<p><span class="bold underline">Кафедра:</span> &nbsp; "<?=getDepartamentByIdFan($id_fan);?>".</p>
			<p><span class="bold underline">Фан:</span> &nbsp; <?=getFan($id_fan);?>. &nbsp;&nbsp;&nbsp;&nbsp; <span class="bold underline">Микдори кредит:</span> &nbsp;&nbsp; <?=getCredit($id_fan, $id_nt, $H_Y)?>.</p>
			<p><span class="bold underline">Ном ва насаби омузгор:</span> &nbsp; <?=getUserName($id_teacher);?></p>
			<p>
			<span class="bold underline">Муҳлати НФ1</span> аз ________________ то ________________ 
			<span class="bold underline">НФ2</span> аз ________________ то ________________ 
			
			</p>
		</div>
		
		
		
		
		
		<div class="clear"></div>
		<br>
		
		<table class="table transcript" style="width:100%; font-size:14px">
			<thead>
				<tr>
					<th rowspan="2" class="center">№<br>р/т</th>
					<th rowspan="2" class="center">Ному насаби донишҷӯ</th>
					<th rowspan="2">
						<p class="vertical">Шакли таҳсил</p>
					</th>
					<th colspan="2" class="center">Рейтинг <br>(холи баҳодиҳи)</th>
					<th rowspan="2" class="center">
						Ҷамъи <br> НФ-1 <br> НФ-2
					</th>
					
					<th rowspan="2" class="center">Имзои<br>омӯзгор</th>
				</tr>
				<tr>
					<th colspan="1" class="center">НФ-1</th>
					<th colspan="1" class="center">НФ-2</th>
				</tr>
				
				<!--
				<tr>
					<th><div class="vertical">Семестр</div></th>
					<th style="vertical-align: middle; width: 55%">Номгӯи фанҳо</th>
					<th><div class="vertical">Кредит</div></th>
					<th><div class="vertical">Балли ниҳоӣ</div></th>
					<th><div class="vertical">Бо ҳуруф</div></th>
					<th><div class="vertical">Бо адад</div></th>
					<th><div class="vertical">Баҳо</div></th>
					<th><div class="vertical">Компонент</div></th>
				</tr>
				-->
			</thead>

			<tbody>
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td><?=$item['fullname']?></td>
						<td class="center"><?=mb_strcut(getStudyType($item['id_s_t']), 1, 2)?></td>
						<td></td>
						<td></td>
						<td></td>
						
						<td></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<br>
		<br>
		<br>
		<br>
		
		
	</body>
	
</html>