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
		
		<?php foreach($_SESSION['superarr'] as $f_item):?>
			<?php $id_faculty = $f_item['id'];?>
			
			<?php foreach($f_item['view'] as $v_item):?>
				<?php $id_s_v = $v_item['id'];?>
				
				<?php foreach($v_item['course'] as $c_item):?>
					<?php $id_course = $c_item['id'];?>
					
					<?php foreach($c_item['spec'] as $s_item):?>	
						<?php $id_spec = $s_item['id'];?>
						
						<?php foreach($s_item['groups'] as $g_item):?>
							<?php $id_group = $g_item['id'];?>
							<?php
							$group_options = select("std_study_groups", array("id_nt", "lang"), "`id_faculty` = '$id_faculty' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `id_s_v` = '$id_s_v' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'", "id", false, "");
							$id_nt = @$group_options[0]['id_nt'];
							
							$fanlist = query("SELECT * FROM `nt_content`  
							WHERE `id_nt` = '$id_nt' AND `id_course` = '$id_course' AND `h_y` = '1' ORDER BY `id_fan`");
							?>
							<p>Факулта - <?=getFaculty($f_item['id'])?>. Курс - <?=getCourse2($c_item['id'])?>.  Ихтисос - <?=getSpecialtyCode($s_item['id'])?>.  Рамзи гурух - <?=getGroup2($g_item['id'])?></p>
							
							<table class="table transcript" style="width:100%; font-size:15px">
								<thead>
									<tr>
										<th>№ т/р</th>
										<th>Номи фан</th>
										<th>Кредит</th>
										<th>Омузгор</th>
									</tr>
								</thead>
								<tbody>
									<?php $counter = 0;?>
									<?php foreach($fanlist as $item):?>
										<tr>
											<td class="center" style="width: 20px"><?=++$counter?></td>
											<td style="width: 350px"><?=getFan($item['id_fan'])?></td>
											<td style="width: 50px" class="center">
												<?=$item['c_u']?>
											</td>
											<td style="width: 150px">
												<?=getTeacher($id_faculty, $id_course, $id_spec, $id_group, $item['id_fan'], S_Y, 1);?>
											</td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
							<br>
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endforeach;?>
		<?php endforeach;?>
		
		
		
		
		
		
		
		<div style="width: 260px; float: right">
			<p>
				Ба директори ДТМИК<br>
				н.и.т., дотсент <?=ShortName(RECTOR)?>
			</p>
			
		</div>
		
		<br><br><br>
		<br><br><br>
		
		<p class="bold center">П Е Ш Н И Ҳ О Д</p>
		
		
		<p style="text-align: justify">
			&nbsp;&nbsp;&nbsp;&nbsp; Садорати маркази таҳсилоти фосилавӣ ва технологияҳои инноватсионии таълимӣ мутобиқи бандҳои 12, 45, 51-и 
			Низомномаи низоми кредитии таҳсилот дар муассисаҳои таҳсилоти олии касбии Ҷумҳурии Тоҷикистон 
			(қарори мушовараи Вазорати маориф ва илми Ҷумҳурии Тоҷикистон №19/24 аз 30 декабри соли 2016 
			(тағйиру иловаҳо ба қарори мушовараи Вазорати маориф ва илми Ҷумҳурии Тоҷикистон №4120 аз 
			07 сентябри соли 2018 )), рӯйхати донишҷӯёни зеринро, ки рейтингҳои 1 ва 2-ро дар даври академӣ 
			аз худ намудаанд, барои супоридани имтиҳонҳои нимсолаи <?php if($H_Y == 1):?> якуми <?php else:?> дуюми <?php endif?> соли таҳсили <?=getStudyYear($S_Y)?> пешниҳод менамояд.
		</p>
		<br>
		<?php $groups = query("SELECT * FROM `std_study_groups` WHERE `s_y` = '$S_Y' AND `h_y` = '$H_Y' ORDER BY `id_course` ASC, `id_spec` ASC");?>
		
		
		<?php foreach ($groups as $item):?>
			<?php $id_course = $item['id_course'];?>
			<?php $id_spec = $item['id_spec'];?>
			<?php $id_group = $item['id_group'];?>
			<?php $id_s_v = $item['id_s_v'];?>
			
			<p class="bold"><?=getCourse($item['id_course'])?>, Ихтисоси <?=getSpecialtyCode($item['id_spec'])?> - «<?=getSpecialtyTitle($item['id_spec'])?>»</p>
			
			<?php 
			
				/* Баровардани контингенти гурух */
				$students = query("SELECT `students`.*, `users`.* FROM `users`
				INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
				WHERE `students`.`status` = '1'
				AND `students`.`id_course` = '$id_course'
				AND `students`.`id_spec` = '$id_spec' AND `students`.`id_group` = '$id_group'
				AND `students`.`id_s_v` = '$id_s_v' 
				AND `students`.`s_y` = '$S_Y' AND `students`.`h_y` = '$H_Y'
				ORDER BY `users`.`fullname`
				");
				/* Баровардани контингенти гурух */
			?>
			
			<?php $counter = 1;?>
			<?php foreach($students as $student):?>
				<p><?=$counter++?>. <?=$student['fullname']?></p>
			<?php endforeach;?>
			<br>
		<?php endforeach;?>
		
		<br><br><br>
		
		<p class="center">Сардори маркази ТФ ва ТИТ: <?=str_repeat("&nbsp;", 45);?> Бобоев А.С.</p>
		
	</body>
	
</html>