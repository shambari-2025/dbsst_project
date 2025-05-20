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
		<h4 class="bold">Маълумотнома дар бораи пардохтҳои <?=getUserName($id_student)?></h4>
		<?php// print_arr($rasidho);?>
		<table class="table transcript"  style="font-size: 14px !important">
			<thead>
				<tr>
					<th>№</th>
					<th>Таъиноти пардохт</th>
					<th>Сана</th>
					<th>Маблағ</th>
					<th>Рақами<br>расид</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;?>
				<?php foreach($rasidho as $rasid):?>
					<tr>
						<td><?=$i?>.</td>
						<td><?=$pardoxt_types[$rasid['type']]?></td>
						<td class="center"><?=date('d.m.Y H:m:i', strtotime($rasid['payed_date']))?></td>
						<td class="center"><?=$rasid['check_money']?></td>
						<td class="center"><?=$rasid['tranid']?></td>
					</tr>
					<?php $i++;?>
				<?php endforeach;?>
			</tbody>
		</table>		
	</body>
	
</html>