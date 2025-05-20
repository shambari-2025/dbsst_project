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
		
		<table style="width:100%; margin: 0 auto;">
			<tbody class="center">
				<tr>
					<td><img src="<?=URL?>userfiles/ttu-logo.png" style="width:128px; margin-bottom: -10px"></td>
					<td style="vertical-align: top"><h3 style="margin:0">ДОНИШГОҲИ ТЕХНИКИИ ТОҶИКИСТОН БА НОМИ АКАДЕМИК М.С. ОСИМӢ</h3></td>
				</tr>
			</tbody>
		</table>
		
		<table style="width:100%; margin-top: -30px;">
			<tbody class="center">
				<tr>
					<td style="font-size:15px">
						<h4>ТРАНСКРИПТ<br>
						(маълумотномаи академӣ)</h4>
					</td>
				</tr>
				<tr>
					<td align="right">№_____ соли таҳсили_________</td>
				</tr>
			</tbody>
		</table>
		<br>
		<br>
		
		
		<table style="width:100%; font-size:14px">
			<tbody>
				<tr class="bold">
					<td colspan="2">Ному насаб: <?=getUserName($id_student)?></td>
				</tr>
				
				<tr>
					<td style="width: 30%; text-align: right;">
						<img style="width: 120px" src="<?=URL?>userfiles/qr-transcripts/<?=$id_student?>.png">
					</td>
					<td style="width: 70%" class="left">
						Барнома: <?=getStudyLevel($id_s_l)?><br>
						Шуъба: <?=getStudyView($id_s_v)?><br>
						Шакли таҳсил: <?=getStudyType($id_s_t)?><br>
						Ихтисос: <?=getSpecialtyCode($id_spec)?> - <?=getSpecialtyTitle($id_spec)?><br>
						Факултет: <?=getFaculty($id_faculty)?>
					</td>
					
				</tr>
			</tbody>
		</table>
		
		<br>
		
		<?php //print_arr($fanlist);?>
		
		<table class="table transcript" style="width:100%; font-size:13px;">
			<thead class="center">
				<tr>
					<th colspan="8">Соли хониши 2023 - 2024, нимсолаи 1</th>
				</tr>
				<tr>
					<th rowspan="2">Курс</th>
					<th rowspan="2">№</th>
					<th rowspan="2">Номгӯи фанҳо</th>
					<th rowspan="2"><div class="vertical">Миқдори<br>кредитҳо</div></th>
					<th colspan="4">Баҳо</th>
				</tr>
				<tr>
					<th><div class="vertical">1 (хол)</div></th>
					<th><div class="vertical">2 (ҳарфӣ)</div></th>
					<th><div class="vertical">3 (ададӣ)</div></th>
					<th><div class="vertical">4 (анъанавӣ)</div></th>
				</tr>
			</thead>
			<tbody class="center">
				<?php $counter = $credits = $my_summa = 0;?>
				<?php foreach($fanlist as $item):?>
					<tr>
						<td><?=$item['id_course']?></td>
						<td><?=++$counter?>.</td>
						<td class="left"><?=getFanTest($item['id_fan'])?></td>
						<td>
							<?=$item['c_u']?>
							<?php $credits += $item['c_u']?>
						</td>
						<td>
							<?php if($item['total_score'] < 50 && !is_null($item['trimestr_score'])):?>
								<?=$item['total_score'] = $item['trimestr_score']?>
							<?php else:?>
								<?=$item['total_score']?>
							<?php endif;?>
						</td>
						<td><?=getLatter($item['total_score'])?></td>
						<td><?=getAdad($item['total_score'])?></td>
						<td><?=getAnanavi($item['total_score'])?></td>
						<?php $my_summa += $item['c_u'] * getAdad($item['total_score'])?>
					</tr>
					<!-- Кори курси -->
					<?php if($item['k_k']):?>
						<tr>
							<td><?=$item['id_course']?></td>
							<td><?=$counter?>.</td>
							<td class="left"><?=getFanTest($item['id_fan'])?> (кори курсӣ)</td>
							<td>0</td>
							<td><?=$item['kori_kursi']?></td>
							<td><?=getLatter($item['kori_kursi'])?></td>
							<td><?=getAdad($item['kori_kursi'])?></td>
							<td><?=getAnanavi($item['kori_kursi'])?></td>
						</tr
					<?php endif;?>
					<!-- Кори курси -->
					
				<?php endforeach;?>
				<tr class="bold center">
					<td colspan="3">
						Ҳамагӣ: <?=$counter?> - фан
					</td>
					<td><?=$credits?></td>
					<td colspan="4">GPA = <?=round($my_summa/$credits, 2)?></td>
				</tr>
			</tbody>
		</table>
		
		<br><br>
		
		<footer style="margin: 30px auto; width: 90%">
			<table style="width:100%;">
				<tr style="height: 50px;vertical-align: top;">
					<td>Декани  <?=getFacultyShort($id_faculty)?> </td>
					<td>________________________</td>
				</tr>
				
				<tr style="height: 50px;vertical-align: top;">
					<td>Муовини декан оид ба таълим	</td>
					<td>________________________</td>
				</tr>
			</table>
		</footer>
		
		<br><br>
		<!-- Баровардани таблитсаи асосӣ
		<table class="table transcript" style="width:100%; font-size:13px;">
			<thead>
				<tr>
					<th><div class="vertical">Семестр</div></th>
					<th style="vertical-align: middle; width: 55%">Номгӯи фанҳо</th>
					<th><div class="vertical">Кредит</div></th>
					<th><div class="vertical">Балли ниҳоӣ</div></th>
					<th><div class="vertical">Бо ҳуруф</div></th>
					<th><div class="vertical">Бо адад</div></th>
					<th><div class="vertical">Баҳо</div></th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($fanlist as $item):?>
					<tr class="center" >
						<td><?=$item['semestr']?></td>
						<td class="left"><?=getFanTest($item['id_fan'])?></td>
						<td><?=$item['c_u']?></td>
						<td><?=$item['total_score']?></td>
						<td><?=getLatter($item['total_score'])?></td>
						<td><?=getAdad($item['total_score'])?></td>
						<td><?=getAnanavi($item['total_score'])?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		Баровардани таблитсаи асосӣ -->
		
	</body>
	
</html>