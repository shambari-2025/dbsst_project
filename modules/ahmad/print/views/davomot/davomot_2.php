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
			font-family: "Palatino Linotype";
		}
		p {
			margin: 0;
			padding: 4px;
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
		
		<div class="floatleft">
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th>#</th>
						<th>Омӯзгор</th>
						<th>Фан</th>
						<th>Ному насаби донишҷӯ</th>
						<th>Курс</th>
						<th>Ихтисос</th>
						<th>Дарсшиканӣ</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($datas as $item):?>
						<?php $std_info = query("SELECT * FROM `students` WHERE `id_student` = '{$item['id_student']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");?>
						
						<?php $teacher = query("SELECT `id_teacher` FROM `jd` 
						WHERE 
						`id_faculty` = '{$std_info[0]['id_faculty']}' AND 
						`id_s_l` = '{$std_info[0]['id_s_l']}' AND 
						`id_s_v` = '{$std_info[0]['id_s_v']}' AND 
						`id_course` = '{$std_info[0]['id_course']}' AND 
						`id_spec` = '{$std_info[0]['id_spec']}' AND 
						`id_group` = '{$std_info[0]['id_group']}' AND 
						`s_y` = '$S_Y' AND 
						`h_y` = '$H_Y' 
						");?>
						
						<?php if($std_info[0]['status'] == 1):?>
						<tr>
							<td class="center" style="width: 20px"><?=++$counter?>.</td>
							<td>
								<?php if($teacher[0]['id_teacher']):?>
								<?=getUserName($teacher[0]['id_teacher'])?>
								<?php endif;?>
							</td>
							<td><?=getFanTest($item['id_fan'])?></td>
							<td><?=getUserName($item['id_student'])?></td>
							<td><?=$std_info[0]['id_course']?></td>
							<td><?=getSpecialtyCode($std_info[0]['id_spec'])?> <?=getGroup2($std_info[0]['id_group'])?></td>
							<td style="<?php if($item['absents'] < 48):?>background: green<?php else:?>background: red<?php endif;?>" ><?=$item['absents']?></td>
						</tr>
						<?php endif;?>
					<?php endforeach;?>
				</tbody>
			</table>
			<br>
			<br>
		</div>
	</body>
	
</html>