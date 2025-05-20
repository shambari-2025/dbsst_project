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
				$students_bujavi = query("SELECT 
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
				`students`.`id_course` = '$id_course' AND 
				`students`.`id_spec` = '$id_spec' AND 
				`students`.`id_group` = '$id_group' AND 
				`students`.`id_s_t` = '2' AND 
				
				`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
				ORDER BY `student_mmt_information`.`total_score_mmt` DESC
				"); 
			?>
			
			<?php
				$students_shartnomavi = query("SELECT 
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
				`students`.`id_course` = '$id_course' AND 
				`students`.`id_spec` = '$id_spec' AND 
				`students`.`id_group` = '$id_group' AND 
				`students`.`id_s_t` = '1' AND 
				`students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
				ORDER BY `student_mmt_information`.`total_score_mmt` DESC
				"); 
			?>
			
			<?php if(!empty($students_bujavi) || !empty($students_shartnomavi)):?>
			<div class="box">
				<p class="center" id="logo_tjk">
					<img style="width: 82px" src="<?=URL?>userfiles/tj_bw.png">
				</p>
				<h3 class="center" style="margin: 0">ВАЗОРАТИ МАОРИФ ВА ИЛМИ ҶУМҲУРИИ ТОҶИКИСТОН</h3>
				<h3 class="center" style="margin: 0">ДОНИШГОҲИ ТЕХНИКИИ ТОҶИКИСТОН</h3>
				<h3 class="center" style="margin: 0">ба номи академик М. С. Осимӣ</h3>
				
				<hr style="border: 3px solid">
				<hr style="border: 1px solid; margin-top: -5px">
				
				<p class="center">ФАРМОИШ</p>
				<p>
				<?php if($id_davr == 1):?>
					аз «10» августи соли 2023, №332-3/5
				<?php elseif($id_davr == 2):?>
					аз «25» августи соли 2023, №336-3/5
				<?php elseif($id_davr == 5):?>
					аз «2» сентябри соли 2023, №338-3/5	
				<?php elseif($id_davr == 6):?>
					аз «29» сентябри соли 2023, №396-3/5
					<?php elseif($id_davr == 7):?>
					аз «29» декабри соли 2023, №________	
				<?php endif;?>
				<span style="float: right">шаҳри Душанбе</span></p>
				
				<p class="center">Дар бораи қабули донишҷӯён</p>
				
				<p style="text-align: justify">
				&nbsp;&nbsp;&nbsp;&nbsp;Мутобиқи Қоидаҳои қабули донишҷӯён ба муассисаҳои таҳсилоти олии касбии Ҷумҳурии Тоҷикистон 
				дар соли таҳсили 2023-2024 ва тибқи натиҷаи имтиҳонҳои қабул тариқи Маркази миллии тестии назди
				Президенти Ҷумҳурии Тоҷикистон тақсимот шудаанд,
				</p>
				
				<p class="center">ФАРМОИШ МЕДИҲАМ:</p>
				
				
				<p style="text-align: justify">
				1. Довталабони зерин ба сафи донишҷӯёни факултети <?=mb_strtolower(getFaculty($id_faculty))?>, 
				ихтисоси <?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group)?> - <?=getSpecialtyTitle($id_spec)?>, 
				шуъбаи <?=mb_strtolower(getStudyView($id_s_v))?>, гурӯҳи 
				<?php if($id_group == 2 or $id_group == 6  or $id_group == 7 or $id_group == 8 ):?> забони таҳсил руссӣ 
				
				<?php else: ?>
				
				<?=mb_strtolower(getLang($g_item['lang']))?>
				
				<?php endif;?>
				қабул карда шаванд:
				
				</p>
				
				<div class="floatleft">
					<table class="table transcript" style="width:100%; font-size:15px">
						<tbody>
							<tr>
								<td>№</td>
								<td>Ному насаб</td>
								<td class="center" style="width: 110px">Ҷамъи холҳо</td>
								<td style="width: 200px">Шаҳр, ноҳия</td>
							</tr>
						</tbody>
						
						<tbody>
							<?php if($students_bujavi):?>
								<tr><td colspan="4" class="center">Маблағгузории буҷавӣ</td></tr>
								<?php $counter = 0;?>
								<?php foreach($students_bujavi as $item):?>
									<tr>
										<td class="center" style="width: 20px"><?=++$counter?></td>
										
										<td class="left">
											<?=$item['fullname_tj']?>
										</td>
										
										<td class="center">
											<?=$item['total_score_mmt']?>
										</td>
										<td>
											<?=getDistrict($item['id_district'])?>
										</td>
									</tr>
								<?php endforeach;?>
							<?php endif;?>
							
							
							<!-- Шартномавӣ-->
							
							<?php if($students_shartnomavi):?>
								<tr><td colspan="4" class="center">Маблағгузории шартномавӣ</td></tr>
								<?php $counter = 0;?>
								<?php foreach($students_shartnomavi as $item):?>
									<tr>
										<td class="center" style="width: 20px"><?=++$counter?></td>
										
										<td class="left">
											<?=$item['fullname_tj']?>
										</td>
										
										<td class="center">
											<?=$item['total_score_mmt']?>
										</td>
										<td>
											<?=getDistrict($item['id_district'])?>
										</td>
									</tr>
								<?php endforeach;?>
							<?php endif;?>
							<!-- Шартномавӣ-->
							
							
						</tbody>
					</table>
					
					<br>
					<p style="text-align: justify">Асос: Рӯйхати довталабоне, ки аз рӯйи натиҷаҳои имтиҳонҳои марказонидашудаи дохилшавии ММТ-и назди Президенти Ҷумҳурии Тоҷикистон тақсимот шудаанд.</p>
					<br>
					<br>
					<p style="width: 90%" class="center">Ректор <span style="float: right">Давлатзода Қ.Қ.</span></p>
					
				</div>
			</div>
			<?php endif;?>
		<?php endforeach;?>
	</body>
	
</html>