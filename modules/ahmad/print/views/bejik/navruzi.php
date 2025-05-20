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
		<?=$page_info['title'];?>
		<table class="table" style="font-size: 14px !important">
			<thead class="center">
				<tr style="background-color: #263544; color: #fff">
					<th class="counter">№</th>
					<th>Ному насаб</th>
					<th>Рузи таваллуд</th>											
				</tr>
			</thead>
			<tbody class="center" id="tbody">
				<?php foreach($info as $item):?>
					<tr>
						<td><?=$item['id'];?>.</td>
						<td class="left"><?=$item['name']?></td>
						<td><?php echo date('d.m.Y', strtotime($item['birthday']))?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>