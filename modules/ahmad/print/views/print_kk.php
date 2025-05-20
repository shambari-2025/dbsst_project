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
			<p>ВАРАКАИ СУПОРИДАНИ КОРИ КУРСӢ № ____</p>
			<p class="bold"><span class="underline">Факултети:</span> &nbsp; <?=getFaculty($id_faculty);?></p>
			<p><span class="bold underline">Ихтисос:</span> &nbsp; <?=getSpecialtyTitle($id_spec);?></p>
			<p><span class="bold underline">Гуруҳ:</span> &nbsp; <?=getSpecialtyCode($id_spec);?> "<?=getGroup($id_group);?>", <span class="bold underline">курс:</span> <?=getCourse2($id_course);?>, <span class="bold underline">нимсола:</span> <?=$H_Y; ?>, <span class="bold underline">соли таҳсили</span> <?=getStudyYear($S_Y);?>.</p>
			<p><span class="bold underline">Кафедра:</span> &nbsp; "<?=getDepartamentByIdFan($id_fan);?>".</p>
			<p><span class="bold underline">Фан:</span> &nbsp; <?=getFan($id_fan);?>.</p>
			<p><span class="bold underline">Ном ва насаби омузгор:</span> &nbsp; <?=getUserName($id_teacher);?></p>
			<p>
				<span class="bold underline">Таърихи супоридани кори курсӣ:</span> «____» ____________ «______»
			</p>
		</div>
		
		
		
		
		
		<div class="clear"></div>
		<br>
		
		<table class="table transcript" style="width:100%; font-size:14px">
			<thead>
				<tr>
					<th rowspan="2">№ р/т</th>
					<th style="width: 550px" rowspan="2">Ному насаби донишҷӯ</th>
					<th colspan="3">Тақсимоти умумии холҳо</th>
					<th style="width: 60px" rowspan="2">Ҷамъи холҳо</th>
					<th colspan="2">Баҳо</th>
					<th  style="width: 150px" rowspan="2">Имзо</th>
				</tr>
				<tr>
					<th style="width: 60px"><div class="vertical">Иҷрои корҳо дар муҳлати муқараргардида</div></th>
					<th style="width: 60px"><div class="vertical">Мундариҷаи кори курсӣ</div></th>
					<th style="width: 60px"><div class="vertical">Ҳимояи кори курсӣ</div></th>
					<th style="width: 60px"><div class="vertical">Бо ҳарф</div></th>
					<th style="width: 60px"><div class="vertical">Бо рақам</div></th>
				</tr>
			</thead>
			
			<tbody>	
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td><?=$item['fullname']?></td>
						<td></td>
						<td></td>
						<td></td>
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