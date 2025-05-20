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
						<th>Факултет</th>
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
						
						<?php if($item['total_absents'] >= 48):?>
							<?php $check_shurbo = query("SELECT `id` FROM `shurbo` WHERE `id_student` = '{$item['id_student']}' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");?>
							
							<?php if(empty($check_shurbo)):?>
								
								<?php
								unset($data, $fields);
								$data['id_student'] = "'".clear_admin($item['id_student'])."'";	
								$data['text'] = "'Барои дарсшикани зиёда аз ".$item['total_absents']." соат.'";	
								$data['s_y'] = $S_Y;	
								$data['h_y'] = $H_Y;	
								$fields = array_keys($data);
								$data = implode(",", $data);
								insert("shurbo", $fields, $data);
								
								?>
							<?php endif;?>
						<?php endif;?>
						
						<tr>
							<td class="center" style="width: 20px"><?=++$counter?>.</td>
							<td><?=getFaculty($std_info[0]['id_faculty'])?></td>
							<td><?=getUserName($item['id_student'])?></td>
							<td><?=$std_info[0]['id_course']?></td>
							<td><?=getSpecialtyCode($std_info[0]['id_spec'])?> <?=getGroup2($std_info[0]['id_group'])?></td>
							<td style="<?php if($item['total_absents'] < 48):?>background: green<?php else:?>background: red<?php endif;?>" >
								<?=$item['total_absents']?>
							</td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			<br>
			<br>
		</div>
	</body>
	
</html>