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
		
		.box {
			height: auto;
			page-break-inside: avoid;
		}
	
		p {
			margin: 0;
			padding: 3px;
		}
		
		table.transcript td {
			padding: 4.5px;
			vertical-align: middle;
		}
		
		.small {
			font-size: 12px
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
		<?php $counter = $id_davr == 2 || $id_davr == 5?($id_davr == 5?1240:1071):1;?>
		<?php foreach ($students as $item):?>
			<?php if($counter % 2 != 0):?>
			<div class="box">
			<?php endif;?>
			<p class="small right">Шакли №08</p>
			<p class="center"> <img src="<?=URL?>userfiles/ttu-logo.png" style="width:128px; margin-bottom: -10px"></p>
			<h3 class="center">Донишгоҳи техникии Тоҷикистон ба номи академик М. С. Осимӣ</h3>
			<h3 class="center">ш.Душанбе, хиёбони академикҳо Раҷабовҳо, 10, тел: 2217662</h3> 
			<table style="margin: 5px auto">
				<tbody>
					<tr>
						<td>
							
							№ <?php echo $counter;?>
						</td>
						<td style="vertical-align: top">
							<p align="justify">Ба (шаҳри, ноҳияи) <b><?=getDistrict($item['id_district'])?></b> </p>
														
							<p>Дода шуд ба <b><?=$item['fullname_tj']?></b></p>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h3 align="center">ХАБАРНОМА<br></h3>
							
							
							<p align="justify">
								&nbsp; &nbsp; &nbsp;Комиссияи қабул иттилоъ медиҳад, ки номбурда тибқи фармоиши ректор <?php if($id_davr == 1):?>
									аз «10» августи соли 2023, №332-3/5
									<?php elseif($id_davr == 2):?>
										аз «25» августи соли 2023, №336-3/5
									<?php elseif($id_davr == 5):?>
										аз «2» сентябри соли 2023, №338-3/5	
								<?php endif;?> 
							
								ба сафи донишҷӯёни курси якуми шуъбаи <?=mb_strtolower(getStudyView($item['id_s_v']))?>и факултети
								<?=mb_strtolower(getFaculty($item['id_faculty']))?>
								ихтисоси <?=getSpecialtyCode($item['id_spec'])?><?=getGroup2($item['id_group'])?> - <?=getSpecialtyTitle($item['id_spec'])?> дохил шудааст.</p>
							<p align="justify">
								&nbsp; &nbsp; &nbsp; Дарсҳо аз рӯзи 1 сентябри соли 2023, соати 8-00 дар бинои таълимии факултети зикргардида оғоз мегарданд.</p>
							<p>&nbsp;</p>
						</td>
					</tr>
					
					<tr >
						<td align="center">
							Сардори шуъбаи кадрҳо<br>ва корҳои махсус
						</td>
						<td align="center">
							<?=str_repeat("&nbsp;", 10)?> ______________ <?=str_repeat("&nbsp;", 20)?>Қодирзода Н.Ҳ.
						</td>
					</tr>
				</tbody>
			</table>
			
			<?php if($counter % 2 == 0):?>
			</div>
			<?php else:?>
			<hr style="border: 1px dashed;">
			<?php endif;?>

			<?php $counter++;?>
		<?php endforeach;?>
		
	</body>
	
</html>