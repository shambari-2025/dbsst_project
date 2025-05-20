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
			font-size: 14px;
		}
		p {
			margin: 0;
			padding: 3px;
		}
		
		@page:left{
			@bottom-left {
				content: "Page " counter(page) " of " counter(pages);
			}
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:14px">
		
		
		
		
		<div style="width: 260px; float: right">
			<p>
				Ба ректори ДТТ<br>
				д.и.т., дотсент <?=ShortName(RECTOR)?>
			</p>
			
		</div>
		
		<br><br><br>
		<br><br><br>
		
		<p class="bold center">ПЕШНИҲОД</p>
		
		
		<p style="text-align: justify">
			&nbsp;&nbsp;&nbsp;&nbsp; Пешниҳоди котиби масъули комиссияи қабули Донишгоҳ Насриддинзода М.Ш., 
			бо мувофиқаи муовини ректор оид ба таълим ва идораи сифати таҳсилот Насриддинзода М.Ш., 
			муовини ректор оид ба иноватсия ва технологияҳои таълимӣ Ғафоров Ф.М., 
			мудири шуъбаи таъминоти ҳуқуқӣ Бобоев М.Н., 
			рӯйхатҳои Маркази миллии тестии назди Президенти Ҷумҳурии Тоҷикистон №22-0336 то 22-4598 
			аз санаи 25.07.2024 ва раводиди ректор.
			
		</p>
		<br>
		<!--
		<p class="center">§1. <br>Ба курси 1- уми зинаи бакалавр қабул карда шаванд: <br>ТАВАССУТИ КВОТАИ ПРЕЗИДЕНТИ ҶУМҲУРИИ ТОҶИКИСТОН</p>
		
		<?php $groups = query("SELECT DISTINCT(`id_spec`), `id_faculty`, `id_course`, `id_s_v`, `id_group`, `id_s_l` FROM `students` WHERE `status` = '-1' AND `id_s_t` = 3 ORDER BY `id_faculty` ASC, `id_spec` ASC");?>
		<?php foreach ($groups as $item):?>
			<?php $id_faculty = $item['id_faculty'];?>
			<?php $id_s_l = $item['id_s_l'];?>
			<?php $id_s_v = $item['id_s_v'];?>
			<?php $id_course = $item['id_course'];?>
			<?php $id_spec = $item['id_spec'];?>
			<?php $id_group = $item['id_group'];?>
			
			<p class="center">Ихтисоси <?=getSpecialtyCode($item['id_spec'])?> - «<?=getSpecialtyTitle($item['id_spec'])?>» - <?=getStudyView($id_s_v)?></p>
			
			<?php
			
				/* Баровардани контингенти гурух */
				$students = query("SELECT `student_mmt_information`.*, `students`.*, `users`.* FROM `users`
				INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
				INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id`
				WHERE `students`.`status` = '-1'
				AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_s_l` = '$id_s_l'
				AND `students`.`id_s_v` = '$id_s_v' 
				AND `students`.`id_course` = '$id_course'
				AND `students`.`id_spec` = '$id_spec' 
				AND `students`.`id_group` = '$id_group'
				AND `students`.`id_s_t` = '3'
				
				AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
				ORDER BY `users`.`fullname_tj`");
				/* Баровардани контингенти гурух */
			?>
			
			
			<table class="table transcript" style="width:96%; margin: 0 auto;">
				<thead>
					<tr>
						<th style="width:50px">т/р</th>
						<th>Ному насаб</th>
						<th style="width: 150px">Шакли таҳсил</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($students as $student):?>
						<tr>
							<td class="center"><?=++$counter?>.</td>
							<td><?=$student['fullname_tj']?></td>
							<td class="center"><?=getStudyType($student['id_s_t'])?></td>
						</tr>
						
					<?php endforeach;?>
				</tbody>
			</table>
			
			<br>
			
		<?php endforeach;?>
		
		
		
		
		
		
		
		<p class="center">§1. <br>ДАР АСОСИ ТАҚСИМОТИ АСОСИИ ММТ-И НАЗДИ ПРЕЗИДЕНТИ ҶУМҲУРИИ ТОҶИКИСТОН</p>
		-->
		
		<?php $counter_f = 0;?>
		<?php foreach($_SESSION['commission'] as $comission):?>
			
			<?php if(isset($comission['level'][1]['view'])):?>
			<?php $id_faculty = $comission['id'];?>
			<p class="center">Б.<?=++$counter_f?></p>
			<p class="center" style="text-transform: uppercase">ФАКУЛТЕТИ <?=$comission['title']?></p>
			<?php foreach($comission['level'][1]['view'] as $views):?>
			<?php $id_s_v = $views['id'];?>
			<?php //print_arr($views);?>
				<?php foreach($views['course'] as $course):?>
					<?php $id_course = $course['id'];?>
					<?php foreach($course['spec'] as $spec):?>
						<?php $id_spec = $spec['id'];?>
						<?php foreach($spec['groups'] as $group):?>
							<?php $id_group = $group['id'];?>
							
							<?php
								/* Баровардани контингенти гурух */
								$students = query("SELECT `student_mmt_information`.*, `students`.*, `user_passports`.*, `users`.* FROM `users`
								INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
								INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
								INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id` AND `student_mmt_information`.`davri_qabul_mmt` = '$id_davr'
								WHERE `students`.`status` = '-1'
								AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_s_l` = '1'
								AND `students`.`id_s_v` = '$id_s_v' 
								AND `students`.`id_course` = '$id_course'
								AND `students`.`id_spec` = '$id_spec' 
								AND `students`.`id_group` = '$id_group'
								AND `students`.`id_s_t` != '3'
								
								AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
								ORDER BY `users`.`fullname_tj`");
								/* Баровардани контингенти гурух */
							?>
							
							<?php if(!empty($students)):?>
								<p class="center">ихтисоси <?=$spec['code']?> - <?=$spec['title']?></p>
								
								<table class="table transcript" style="width:96%; margin: 0 auto;">
									<thead>
										<tr>
											<th style="width:50px">т/р</th>
											<th>Ному насаб</th>
											<th>Ҷинс</th>
											<th style="width: 150px">Шакли таҳсил</th>
										</tr>
									</thead>
									<tbody>
										<?php $counter = 0;?>
										<?php foreach($students as $student):?>
											<tr>
												<td class="center"><?=++$counter?>.</td>
												<td><?=$student['fullname_tj']?></td>
												<td><?=getJins($student['jins'])?></td>
												<td class="center"><?=getStudyType($student['id_s_t'])?></td>
											</tr>
											
										<?php endforeach;?>
									</tbody>
								</table>
							<?php endif;?>
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endforeach;?>
			<?php endif;?>
		<?php endforeach;?>
		<br><br><br>
		<?php exit;?>
		
		<?php $groups = query("SELECT * FROM `std_study_groups` WHERE `status` = '-1' AND `id_s_l` = '1' AND `id_course` = '1' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."' 
		ORDER BY `id_faculty` ASC, `id_s_v` ASC, `id_course` ASC, `id_faculty` ASC, `id_spec` ASC");?>
		
		<?php foreach ($groups as $item):?>
			<?php $id_faculty = $item['id_faculty'];?>
			<?php $id_s_l = $item['id_s_l'];?>
			<?php $id_s_v = $item['id_s_v'];?>
			<?php $id_course = $item['id_course'];?>
			<?php $id_spec = $item['id_spec'];?>
			<?php $id_group = $item['id_group'];?>
			
			
			<?php
			
				/* Баровардани контингенти гурух */
				$students = query("SELECT `student_mmt_information`.*, `students`.*, `user_passports`.*, `users`.* FROM `users`
				INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
				INNER JOIN `user_passports` ON `user_passports`.`id_user` = `users`.`id`
				INNER JOIN `student_mmt_information` ON `student_mmt_information`.`id_student` = `users`.`id` AND `student_mmt_information`.`davri_qabul_mmt` = '$id_davr'
				WHERE `students`.`status` = '-1'
				AND `students`.`id_faculty` = '$id_faculty' AND `students`.`id_s_l` = '$id_s_l'
				AND `students`.`id_s_v` = '$id_s_v' 
				AND `students`.`id_course` = '$id_course'
				AND `students`.`id_spec` = '$id_spec' 
				AND `students`.`id_group` = '$id_group'
				AND `students`.`id_s_t` != '3'
				
				AND `students`.`s_y` = '".S_Y."' AND `students`.`h_y` = '".H_Y."'
				ORDER BY `users`.`fullname_tj`");
				/* Баровардани контингенти гурух */
			?>
			
			<?php if($students):?>
			<p class="center">Ихтисоси <?=getSpecialtyCode($item['id_spec'])?> - «<?=getSpecialtyTitle($item['id_spec'])?>» <?=getGroup2($id_group)?> - <?=getStudyView($id_s_v)?></p>
			
			<table class="table transcript" style="width:96%; margin: 0 auto;">
				<thead>
					<tr>
						<th style="width:50px">т/р</th>
						<th>Ному насаб</th>
						<th style="width: 150px">Шакли таҳсил</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($students as $student):?>
						<tr>
							<td class="center"><?=++$counter?>.</td>
							<td><?=$student['fullname_tj']?></td>
							<td class="center"><?=getStudyType($student['id_s_t'])?></td>
						</tr>
						
					<?php endforeach;?>
				</tbody>
			</table>
			<br><br>
			
			<?php endif;?>
		<?php endforeach;?>
		
		<br><br><br>
		<!--
		<table style="width: 70%;margin: 0 auto;">
			<tr>
				<td>Котиби  масъули комиссияи қабул:</td>
				<td></td>
				<td>Ҳакимов И. Б.</td>
			</tr>
			
			<tr>
				<td style="vertical-align: top; padding-top: 20px">Котибони техникии комиссияи қабул:</td>
				<td></td>
				<td style="vertical-align: top; padding-top: 20px">
					<p>Бобоев А. С. </p><br>
					<p>Шеравганзода З. </p><br>
					<p>Раҳимова Ф. М. </p><br>
					<p>Боронова М. </p>
				</td>
			</tr>
		</table>
		-->
	</body>
	
</html>