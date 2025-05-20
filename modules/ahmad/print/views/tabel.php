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
		.davrifaol table td, .davrifaol table th {
			padding: 6px 6px;
		}
	</style>
	
	<body>
		
		<div class="table-responsive davrifaol">
			
			<table class="table" style="font-size:14px">
				<tbody>
					<tr class="center">
						<td rowspan="2">
							№
						</td>
						<td rowspan="2" style="width: 150px">
							Ному Насаб
						</td>
						<td rowspan="2">
							Вазифа
						</td>
						<td rowspan="2">
							<div class="vertical">Дараҷаи корӣ</div>
						</td>
						<td colspan="<?=$days?>">
							<?=$months[$month]?>
						</td>
						<td rowspan="2">
							<div class="vertical">Рузҳои корӣ</div>
						</td>
						<td rowspan="2">
							<div class="vertical">Соатҳои корӣ</div>
						</td>
					</tr>
					
					<tr class="center">
						<?php for($i = 1; $i <= $days; $i++):?>
							<td>
								<?=$i?><br>
							</td>
						<?php endfor;?>
					</tr>
					
					<?php $counter = $jam_soat_kori = 0; ?>
					<?php foreach($users as $item):?>
						<tr class="center">
							<td>
								<?=++$counter?>.
							</td>
							<td class="left">
								<?=getShortName($item)?>
							</td>
							<td>
								<?=$vazifa[$counter]?>
							</td>
							<td>1</td>
							<?php $hamagi_soati_kori = $ruzhoi_kori = 0 ?>
							<?php for($i = 1; $i <= $days; $i++):?>
								<?php $n = date("w", mktime(0,0,0, $month, $i, $year));?>
								<td <?php if($n == 0):?>style="background: #313140"<?php endif;?>>
									
									<?php if($n == 6):?>
										<?php $soat_kori = 5 ?>
										<?php $ruzhoi_kori++?>
										<?php $hamagi_soati_kori += $soat_kori?>
										
										
										<?=$soat_kori?>
									<?php elseif($n == 0):?>
									
									<?php else:?>
										<?php $soat_kori = 6 ?>
										<?php $ruzhoi_kori++?>
										<?php $hamagi_soati_kori += $soat_kori?>
										
										
										<?=$soat_kori?>
									<?php endif;?>
								</td>
							<?php endfor;?>
							
							
							<td><?=$ruzhoi_kori?></td>
							<td>
								<?php $jam_soat_kori += $hamagi_soati_kori?>
								<?=$hamagi_soati_kori?>
							</td>
						</tr>
					<?php endforeach;?>
					
					<tr>
						<td>
							<?=++$counter?>.
						</td>
						<td class="center bold" colspan="3">
							Ҷамъ:
						</td>
						
						<td colspan="<?=$days+1?>"></td>
						<td>
							<?=$jam_soat_kori?>
						</td>
						
					</tr>
				</tbody>
			</table>
		</div>
	
	</body>
	
</html>