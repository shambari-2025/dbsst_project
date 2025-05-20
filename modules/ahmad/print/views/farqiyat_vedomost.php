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
					<td><img src="<?=URL?>userfiles/logo.png" style="width:128px; margin-bottom: -10px"></td>
					<td style="vertical-align: top"><h3 style="margin:0;text-transform: uppercase;">ВАЗОРАТИ МАОРИФ ВА ИЛМИ ҶУМҲУРИИ ТОҶИКИСТОН<br><?=UNI_NAME?></h3></td>
				</tr>
				<tr>
					<td colspan="2"><b>Варақаи имтиҳонотӣ барои супоридани фарқиятҳо № ____<b></td>
				</tr>
			</tbody>
		</table>
		<br>	
		<table style="width:100%; font-size:14px; margin-left: 40px;">
			<tbody>	
				<tr>
					<td><b>Факултети:</b> <?=getFaculty($info_std[0]['id_faculty'])?></td>
				</tr>
				<tr>
					<td><b>Шакли таҳсил: </b><?=getStudyView($info_std[0]['id_s_v'])?></td>
				</tr>
				
				<tr>
					<td><b>Курси:</b> <?=$info_std[0]['id_course']?>, <b>гуруҳи </b><?=getSpecialtyCode($info_std[0]['id_spec'])?><?=getGroup2($info_std[0]['id_group'])?>, <b>соли таҳсили </b><?=getStudyYear(S_Y)?></td>
				</tr>
				
				<tr>
					<td><b>Ному насаби донишҷӯ: </b><?=getUserName($id_student)?></td>
				</tr>
			</tbody>
		</table>
		<br>
		<!-- Баровардани таблитсаи асосӣ -->
		<table class="table transcript" style="width:100%; font-size:13px;">
			<thead>
				<tr>
					<th style="vertical-align: middle;">№</th>
					<th style="vertical-align: middle; width: 30%">Номгӯи фанҳо</th>
					<th><div class="vertical">Кредит</div></th>
					<th style="vertical-align: middle; width: 13%">Соли<br>таҳсил</th>
					<th><div class="vertical">Нимсола</div></th>
					<th><div class="vertical">Хол</div></th>
					<th><div class="vertical">Баҳои ҳарфӣ</div></th>
					<th><div class="vertical">Баҳои ададӣ</div></th>
					<th style="vertical-align: middle; width: 20%">Омӯзгор</th>
					<th style="vertical-align: middle;">Имзои<br>омӯзгор</th>
				</tr>
			</thead>
			<?php //print_arr($raznitsa);?>
			<tbody>
				<?php $i=1;?>
				<?php foreach($raznitsa as $item):?>		
				<tr class="center">
					<td><?=$i;?>.</td>
					<td class="left"><?=getFanTest($item['id_fan'])?><?php if($item['type'] == 2) {echo "<b> (Кори курсӣ)</b>";}?></td>
					<td><?php if($item['credit'] != 0) {echo $item['credit'];}else{echo "-";}?></td>
					<td><?=getStudyYear($item['s_y'])?></td>
					<td><?=$item['h_y'];?></td>
					<td></td>
					<td></td>
					<td></td>  
					<td style="text-align:left;"><?=getShortName($item['id_teacher'])?></td>  
					<td></td>  
				</tr>
				<?php $i++;?>
				<?php endforeach;?>
			</tbody>
		</table>
		<br>
		<br>
		<table style="width:70%; margin: 0 auto;">
			<thead class="center">
				<tr>
					<td><b>Декани факултети <?=getFacultyShort($info_std[0]['id_faculty'])?>       ___________<b></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><br><br></td>
				</tr>
				<tr>
					<td style="text-align:left;"><b>Эзоҳ:<b></td>
				</tr>
				<tr>
					<td><b>Примичание:<b></td>
				</tr>
			</tbody>
		</table>
		
		<footer style="margin: 30px auto; width: 90%">
			<table class="transcript" style="margin: 0 auto 0 60px">
				<thead class="center">
					<tr>
						<td><b>Холҳо (Баллы)</b></td>
						<td><b>Баҳо (Оценка)</b></td>
						<td><b>Ададӣ(Цифры)</b></td>
					</tr>
					<tr>
						<td>95-100</td>
						<td>A</td>
						<td rowspan="2">5</td>
					</tr>
					<tr>
						<td>90-94</td>
						<td>A-</td>
					</tr>
					<tr>
						<td>85-89</td>
						<td>B+</td>
						<td rowspan="3">4</td>
					</tr>
					<tr>
						<td>80-84</td>
						<td>B</td>
					</tr>
					<tr>
						<td>75-79</td>
						<td>B-</td>
					</tr>
					<tr>
						<td>70-74</td>
						<td>C+</td>
						<td rowspan="5">3</td>
					</tr>
					<tr>
						<td>65-69</td>
						<td>C</td>
					</tr>
					<tr>
						<td>61-64</td>
						<td>C-</td>
					</tr>
					<tr>
						<td>55-59</td>
						<td>D+</td>
					</tr>
					<tr>
						<td>50-54</td>
						<td>D</td>
					</tr>
				</thead>
			</table>
		</footer>
		
	</body>
	
</html>