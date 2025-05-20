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
					<th rowspan="2" class="counter">№</th>
					<th rowspan="2">Cинф</th>
					<th rowspan="2">Гуруҳ </th>
					<th rowspan="2">Ному насаб</th>											
					<th colspan="2">Соли таҳсили <br> <?=getStudyYear($S_Y)?></th>											
					<th rowspan="2">Қарздорӣ</th>											
				</tr>
				<tr style="background-color: #263544; color: #fff">
					<th>Ним. 1</th>											
					<th>Ним. 2</th>
				</tr>
			</thead>
			
			<tbody class="center" id="tbody">
				<?php $i=1;?>
				<?php foreach($students as $s):?>
						<tr>
							<td><?=$i;?>.</td>
							<td><?=$s['id_sinf']?></td>
							<td><?=getGroup($s['id_group'])?></td>
							<td class="left">
								<?=$s['fullname_tj']?>
							</td>
							<td><?=$N1 = getBalanceLitStudent($s['id_xonanda'], $S_Y, 1)?></td>
							<td><?=$N2 = getBalanceLitStudent($s['id_xonanda'], $S_Y, 2)?></td>
							<td>
								<?php
									//$mablagi_shartnoma = getSharnomaMoneyBySY($s['id_course'], $s['id_spec'], $s['id_s_l'], $s['id_s_v'], $S_Y, $s['foreign']);
									$mablagi_suporida = getMoneyShartnomaLitsey($s['id_xonanda'], $S_Y);
									$qarzdori = (float)$mablagi_suporida - (float)$N1 - (float)$N2;
									//echo "sup>".$mablagi_suporida."N1>".$N1."N2>".$N2;
								?>
								<?php if($qarzdori >= 0):?>
									надорад
								<?php else:?>
									<?=$qarzdori?> сомонӣ
								<?php endif;?>
							</td>
						</tr>
						<?php $i++;?>
						<?php// if($i==100) exit;?>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>