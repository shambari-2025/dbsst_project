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
			<table class="table transcript" style="width:80%; font-size:15px; margin: 0 auto;">
				<thead>
					<tr>
						<th>№</th>
						<th>Ному насаб</th>
						<th>Курс, гурӯҳ</th>
						<th>Эзоҳ</th>
						<th>Телефон</th>
						
					</tr>
				</thead>
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($datas as $item):?>
						<tr>
							<td class="center" style="width: 20px"><?=++$counter?>.</td>
							<td class="left"><?=$item['fullname_tj']?></td>
							<td class="center"><?=$item['id_course']?>к, <?=getSpecialtyCode($item['id_spec'])?></td>
							<td class="center"><?=getVaziOilavi($item['vazi_oilavi'])?></td>
							<td class="center"><?=$item['phone']?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			<br><br><br>
		</div>
	</body>
	
</html>