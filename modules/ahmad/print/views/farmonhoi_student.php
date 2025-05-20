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
		<table class="table transcript" style="width:100%;">
			<thead>	
				<tr class="center bold;" style="font-weight: bold;">
					<td>№</td>
					<td>Рақами<br>фармоиш</td>
					<td>Санаи <br>интишори <br>фармоиш</td>
					<td>Матни фармоиш</td>
					<td>Асос</td>
				</tr>
			</thead>
			<tbody>
			<?php //print_arr($farmonho);
				$counter = 0;
			?>
				<?php foreach($farmonho as $f):?>
					<tr>
						<td><?=++$counter;?></td>
						<td><?=$f['farmon_number']?></td>
						<td><?=$f['farmon_date']?></td>
						<td><?=$f['farmon_text']?></td>
						<td><?=$f['asos_text']?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>