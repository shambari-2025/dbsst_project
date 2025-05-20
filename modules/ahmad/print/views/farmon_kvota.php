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
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
		
		<?php foreach ($groups as $g_item):?>
			<?php $id_faculty = $g_item['id_faculty']?>
			<?php $id_s_l = $g_item['id_s_l']?>
			<?php $id_s_v = $g_item['id_s_v']?>
			
			<?php $id_course = $g_item['id_course']?>
			<?php $id_spec = $g_item['id_spec']?>
			<?php $id_group = $g_item['id_group']?>
			
			
			<?php 
				$students_kvota = query("SELECT 
				`student_mmt_information`.*, 
				`user_udecation`.*, 
				`user_passports`.*, 
				`students`.*, 
				`users`.* FROM `users`
				INNER JOIN `students` ON `students`.`id_student` = `users`.`id` AND `students`.`foreign` IS NULL
				INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
				INNER JOIN `user_udecation` ON `user_udecation`.`id_user` = `users`.`id`
				INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
				AND `student_mmt_information`.`davri_qabul_mmt` = '$id_davr'
				WHERE 
				`students`.`status` = '-1' AND 
				`students`.`id_faculty` = '$id_faculty' AND 
				`students`.`id_s_l` = '$id_s_l' AND 
				`students`.`id_s_v` = '$id_s_v' AND 
				`students`.`id_course` = '2' AND 
				`students`.`id_spec` = '$id_spec' AND 
				`students`.`id_group` = '$id_group' AND 
				`students`.`id_s_t` IN (1, 2) AND 
				`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
				ORDER BY `student_mmt_information`.`total_score_mmt` DESC
				"); 
			?>
			
			
			
			<?php if(!empty($students_kvota)):?>
			<div class="box">
				<p class="center" id="logo_tjk">
					<img style="width: 82px" src="<?=URL?>userfiles/tj.png">
				</p>
				<h3 class="center" style="margin: 0">ВАЗОРАТИ МАОРИФ ВА ИЛМИ ҶУМҲУРИИ ТОҶИКИСТОН</h3>
				<h3 class="center" style="margin: 0">ДОНИШГОҲИ ТЕХНИКИИ ТОҶИКИСТОН</h3>
				<h3 class="center" style="margin: 0">ба номи академик М. С. Осимӣ</h3>
				
				<hr style="border: 3px solid">
				<hr style="border: 1px solid; margin-top: -5px">
				
				<p class="center">ФАРМОИШ</p>
				<p>
				<?php if($id_davr == 4):?>
					<?php if($g_item['id_s_v'] == 1):?>
						аз «31» августи соли 2023, №336-3/5
					<?php else:?>
						аз «5» сентябри соли 2023, №339-3/5
					<?php endif;?>
					
				<?php endif;?>
				<span style="float: right">шаҳри Душанбе</span></p>
				
				<p class="center">Дар бораи қабули донишҷуён</p>
				
				<p style="text-align: justify">
				&nbsp;&nbsp;&nbsp;&nbsp;Мутобиқи Қоидаҳои қабули донишҷӯён ба муассисаҳои таҳсилоти олии касбӣ барои идомаи таҳсил баъд аз хатми 
				муассисаи таҳсилоти миёнаи касбии Ҷумҳурии Тоҷикистон дар соли таҳсили  2023-2024,
				</p>
				
				<p class="center">ФАРМОИШ МЕДИҲАМ:</p>
				
				
				<p style="text-align: justify">
							
				
				Довталабони зерин ба сафи донишҷӯёни факултети <?=mb_strtolower(getFaculty($id_faculty))?>, 
				ихтисоси <?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group)?> - <?=getSpecialtyTitle($id_spec)?>, 
				шуъбаи , гурӯҳи <?=mb_strtolower(getLang($g_item['lang']))?>
				қабул карда шаванд:
				
				</p>
				
				<div class="floatleft">
					<table class="table transcript" style="width:100%; font-size:15px">
						<tbody>
							<tr>
								<td>№</td>
								<td>Ному насаб</td>
								<td >Рамз ва номи ихтисос</td>
								<td >Шӯъба</td>
								<td >Маблағгузорӣ</td>
							</tr>
						</tbody>
						
						<tbody>
							<?php if($students_kvota):?>
								
								<?php $counter = 0;?>
								<?php foreach($students_kvota as $item):?>
									<tr>
										<td class="center" style="width: 20px"><?=++$counter?></td>
										
										<td class="left">
											<?=$item['fullname_tj']?>
										</td>
										
										<td>
											<?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group)?> - <?=getSpecialtyTitle($id_spec)?>
										</td>
										<td>
											<?=mb_strtolower(getStudyView($id_s_v))?>
										</td>
										<td>
											<?=getStudyType($item['id_s_t'])?>
										</td>
									</tr>
								<?php endforeach;?>
							<?php endif;?>
																										
							
						</tbody>
					</table>
					
					<br>
					<p style="text-align: justify">Асос: Қарори комиссияи қабул.</p>
					<br>
					<br>
					<p style="width: 90%" class="center">Ректор <span style="float: right">Давлатзода Қ.Қ.</span></p>
					
				</div>
			</div>
			<?php endif;?>
		<?php endforeach;?>
	</body>
	
</html>