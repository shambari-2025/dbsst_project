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
		
		<p class="center bold" style="font-size: 20px">Рӯйхати довталабон</p>
		
		<div class="floatleft">
			<table class="table transcript" style="width:100%; font-size:16px">
				<thead>
					<tr>
						<th style="width: 50px">№ т/р</th>
						<th style="width: 100px">ID донишҷӯ</th>
						<th style="width: 350px">Ному насаб</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($students as $item):?>
						<tr>
							<td class="center" ><?=++$counter?>.</td>
							<td class="center"><?=$item['id']?></td>
							<td><?=$item['fio']?></td>
						</tr>
						
					<?php endforeach;?>
				</tbody>
			</table>
			
		</div>
		<br>
		
	</body>
	
</html>
