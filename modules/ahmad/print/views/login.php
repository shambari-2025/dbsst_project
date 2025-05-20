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
		
		<style>
			th, td {
				padding: 6px !important;
			}
		</style>
		
	</head>
	
	<body>
		
		<div class="table-responsive davrifaol">
			
			<h3 class="center">
			Маълумотномаи донишҷӯёни
			факултети <?=getFaculty($id_faculty)?>,<br>
			шакли таҳсил <?=getStudyView($id_s_v)?>,
			<?=getCourse($id_course)?>,
			<?=getSpecialtyCode($id_spec)?>,
			<?=getGroup($id_group)?>
			</h3>
			
			<table class="table" style="font-size:14px">
				<thead class="center">
					<tr>
						<th>№</th>
						<th>Ному насаби донишҷӯ</th>
						<th>Логин</th>
						<th>Рамз</th>
					</tr>
					
				</thead>
				<tbody class="center">
					<?php $counter = 0;?>
					<?php foreach($students as $item):?>
						<tr>
							<th scope="row"><?=++$counter?>.</th>
							<td class="left"><?=$item['fullname_tj']?></td>
							<td><?=$item['login']?></td>
							<td><?=$item['password']?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	
	</body>
	
</html>