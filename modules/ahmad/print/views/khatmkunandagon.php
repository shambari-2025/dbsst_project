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
		<p>Маълумотнома оид ба хатмкунандагони <?=UNI_NAME?> тибқи <?=getStudyType($id_s_t)?> ки дар соли <?=getStudyYear($S_Y)?> таҳсил менамоянд</p>
		<table class="table" style="font-size: 14px !important">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th class="counter">№</th>
					<th>Ному насаби донишҷӯ</th>
					<th>Номи факултет</th>
					<th>Курс</th>
					<th>Намуди таҳсил</th>
					<th>Телефони<br>донишҷӯ</th>
					<th>Телефони<br>волидайн</th>
					<th>Суроғаи<br>донишҷӯ</th>
					<th>Суроғаи<br>падару модар</th>												
				</tr>
			</thead>
			
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php foreach($students as $s):?>
						<tr>
							<td><?=$i;?>.</td>
							<td class="left"><?=getUserName($s['id_student'])?></td>
							<td><?=getFacultyShort($s['id_faculty'])?></td>
							<td><?=$s['id_course']?></td>
							<td><?=getStudyView($s['id_s_v'])?></td>
							<td><?=$s['phone']?></td>
							<td><?=$s['phone_parents']?></td>
							<td class="counter"><?=$s['address']?></td>
							<td></td>
						</tr>
						<?php $i++;?>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>