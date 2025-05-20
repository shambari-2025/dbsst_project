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
		<p class="center" style="font-weight: bold;">Факултети <?=getFaculty($id_faculty)?></p>
		<?php $study_level = query("SELECT DISTINCT(`id_s_l`) FROM `students` WHERE `id_faculty`= '$id_faculty'");?>
		<?php foreach($study_level as $s_l):?>
			<?php $id_s_l = $s_l['id_s_l'];?>
			<?php $study_view = query("SELECT DISTINCT(`id_s_v`) FROM `students` WHERE `id_faculty` ='$id_faculty' AND `id_s_l` = '$id_s_l'");?>
			<?php foreach($study_view  as $s_v):?>
				<?php $id_s_v = $s_v['id_s_v'];?>
				<?php $courses = query("SELECT DISTINCT(`id_course`) FROM `students` WHERE `id_faculty` ='$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v'");?>
				<?php foreach($courses  as $course):?>
					<?php $id_course = $course['id_course'];?>
					<?php $specs  = query("SELECT DISTINCT(`id_spec`) FROM `students` WHERE `id_faculty` ='$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course'");?>
					<?php foreach($specs as $spec):?>
						<?php $id_spec = $spec['id_spec'];?>
						<?php $groups = query("SELECT DISTINCT(`id_group`) FROM `students` WHERE `id_faculty` ='$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course` = '$id_course' AND `id_spec` = '$id_spec'");?>
						<?php foreach($groups as $group):?>
							<?php $id_group = $group['id_group'];?>
							<?php $students = getContingent(1, $id_faculty, $id_s_l, $id_course, $id_spec, $id_group, $id_s_v, S_Y, H_Y);?>
								<?php //print_arr($students);?>
							<?php $counter = 0;?>
							<?php if($students):?>
								<p class="center">
									<?=getCourse($id_course);?>,
									зинаи таҳсили <?=getStudyLevel($id_s_l)?>,
									шакли таҳсили <?=getStudyView($id_s_v)?>,
									<?=getSpecialtyCode($id_spec)?>-<?=getSpecialtyTitle($id_spec)?>, гуруҳи <?=getGroup($id_group)?>
								</p>
								<table class="table transcript" style="width:100%;">
									<thead class="center">
										<tr>
											<th class="counter">№</th>
											<th style="width: 70%">Ному насаб</th>											
											<th>Шакли<br>таҳсил</th>
											<th>Фармон</th>																				
										</tr>
									</thead>
									<tbody>
										<?php foreach($students as $student):?>
											<tr>
												<td class="counter"><?=++$counter?></td>
												<td><?=$student['fullname_tj']?></td>											
												<td><?=getStudyType($student['id_s_t'])?></td>											
												<td></td>																				
											</tr>
										<?php endforeach;?>
									</tbody>
								</table>
							<?php endif;?>
						<?php endforeach;?>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endforeach;?>
		<?php endforeach;?>
	</body>
</html>