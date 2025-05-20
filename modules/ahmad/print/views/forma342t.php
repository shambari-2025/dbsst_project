<?php 
	function forma34($id_faculty, $S_Y, $H_Y, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group, $S_T = false){
		if($S_T == 1){
			$s_t = '(1)';
		}if($S_T == 2){
			$s_t = '(2,3)';
		}if(empty($S_T)){
			$s_t = '(1,2,3)';
		}
		
		$query = query("SELECT DISTINCT(`id_student`), `id_faculty`, `id_course`, `id_spec`, `id_group`, 
						IFNULL(MIN(CASE WHEN COALESCE(`total_score`, 0) < 50 THEN COALESCE(`trimestr_score`, 0) ELSE COALESCE(`total_score`, 0) END), 0) AS `min`,
						IFNULL(MAX(CASE WHEN COALESCE(`total_score`, 0) < 50 THEN COALESCE(`trimestr_score`, 0) ELSE COALESCE(`total_score`, 0) END), 0) AS `max` 
						FROM `results`
						WHERE `id_faculty` = '$id_faculty' AND 
							`id_s_l` = '$id_s_l' AND
							`id_s_v` = '$id_s_v' AND
							`id_course` = '$id_course' AND
							`id_spec` = '$id_spec' AND 
							`id_group` = '$id_group' AND 
							`s_y` = '$S_Y' AND 
							`h_y` = '$H_Y' AND 
							`id_student` IN 
								(SELECT DISTINCT `id_student` FROM `students` 
									WHERE `status` = '1' AND 
										`id_faculty`='$id_faculty' AND 
										`id_s_l` = '$id_s_l' AND 
										`id_s_v` = '$id_s_v' AND 
										`id_s_t` IN $s_t AND 
										`id_course` = '$id_course' AND 
										`id_spec` = '$id_spec' AND 
										`id_group` = '$id_group' AND 
										`s_y` = '$S_Y' AND 
										`h_y` = '$H_Y'
								) 
						GROUP BY `id_student`, `id_faculty`, `id_course`, `id_spec`, `id_group`
						");

	
		if(empty($query)) return false;
		
		$res['5'] = $res['45'] = $res['4'] = $res['3'] = $res['345'] = $res['fx'] = $res['f']  = 0;
		foreach($query as $item){
			
			//echo $item['min']. ' '.$item['max'];
			
			if($item['min'] >= 90 && $item['max'] < 120){
				//echo "alo";
				$res['5']++;
				$res['students']['5'][$item['id_student']]['student'] = getUserName($item['id_student']);
				$res['students']['5'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
				$res['students']['5'][$item['id_student']]['id_course'] = $item['id_course'];
				$res['students']['5'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
				
			}
			elseif($item['min'] >= 75 && $item['max'] < 90){
				//echo "xub";
				$res['4']++;
				$res['students']['4'][$item['id_student']]['student'] = getUserName($item['id_student']);
				$res['students']['4'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
				$res['students']['4'][$item['id_student']]['id_course'] = $item['id_course'];
				$res['students']['4'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
			}
			
			elseif($item['min'] >= 75 && $item['max'] < 120){
				//echo "xub/alo";
				$res['45']++;
				$res['students']['45'][$item['id_student']]['student'] = getUserName($item['id_student']);
				$res['students']['45'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
				$res['students']['45'][$item['id_student']]['id_course'] = $item['id_course'];
				$res['students']['45'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
			}elseif($item['min'] >= 50 && $item['max'] < 75){
				//echo "qanoatbaxsh";
				$res['3']++;
				$res['students']['3'][$item['id_student']]['student'] = getUserName($item['id_student']);
				$res['students']['3'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
				$res['students']['3'][$item['id_student']]['id_course'] = $item['id_course'];
				$res['students']['3'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
			}
			elseif($item['min'] >= 50 && $item['max'] < 120){
				$res['345']++;
				$res['students']['345'][$item['id_student']]['student'] = getUserName($item['id_student']);
				$res['students']['345'][$item['id_student']]['id_faculty'] = getFacultyShort($item['id_faculty']);
				$res['students']['345'][$item['id_student']]['id_course'] = $item['id_course'];
				$res['students']['345'][$item['id_student']]['id_spec'] = getspecialtyCode($item['id_spec']);
			}
			elseif($item['min'] >= 45 && $item['min'] < 50){
				$res['fx']++;
			}
			elseif($item['min'] < 45){
				$res['f']++;
			}
		}
//											   COUNT(CASE WHEN `total_score` < 50 THEN 1 ELSE NULL END) as `count_total_score_lt_50`
		
		$qarzdorho = query("SELECT `id_student`, 
								   `id_faculty`, 
								   `id_course`, 
								   `id_spec`, 
								   `id_group`, 
								   COUNT(CASE WHEN COALESCE(`total_score`, 0) < 50 AND COALESCE(`trimestr_score`, 0) < 50 THEN 1 ELSE NULL END) as `count_total_score_lt_50`
							FROM `results`
							WHERE `id_faculty` = '$id_faculty'  AND 
									`id_course` = '$id_course' AND
									`id_spec`  = '$id_spec' AND
									`id_group` = '$id_group' AND
									`s_y` = '$S_Y'  AND 
									`h_y` = '$H_Y'
							  AND `id_student` IN (
									  SELECT DISTINCT `id_student`
									  FROM `students`
									  WHERE `status` = '1'
										AND `id_faculty` = '$id_faculty' 
										AND `id_s_l` = '$id_s_l' 
										AND `id_s_v` = '$id_s_v'
										AND `id_s_t` IN $s_t
										AND `id_course` = '$id_course'
										AND `id_spec` = '$id_spec'
										AND `id_group` = '$id_group'
										AND `s_y` = '$S_Y'
										AND `h_y` = '$H_Y'
								  )
							GROUP BY `id_student`, `id_faculty`, `id_course`, `id_spec`, `id_group`;
							");
		$res['qarz1fan'] = $res['qarz2fan'] = $res['qarz3fan'] = 0;
		foreach($qarzdorho as $q){
			if($q['count_total_score_lt_50'] == 1){
				$res['qarz1fan']++; 
			}if($q['count_total_score_lt_50'] == 2){
				$res['qarz2fan']++;
			}if($q['count_total_score_lt_50'] >= 3){
				$res['qarz3fan']++;
			}
		}

			
		//print_arr($res);
		//exit;
		return $res;
	}
								
?>
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
		<style>
			@media print {
				.newpage {
					page-break-after: always;
				} 
			}
		</style>
		<?php $umar=0;?>
		<?php if(isset($_SESSION['user']['admin'])):?>
			<?php $S_R = $_SESSION['superarr'];?>
		<?php else:?>
			<?php $S_R = $_SESSION['students'];?>
		<?php endif;?>
		<?php foreach($S_R as $fac):?>
			<?php $id_faculty = $fac['id'];//echo getFaculty($id_faculty);?>
			<?php if($id_faculty != 7):?>
				<?php foreach($fac['level'] as $studylevel):?>
					<?php $id_s_l = $studylevel['id'];?>
					<?php foreach($studylevel['view'] as $studyview):?>
						<?php $id_s_v = $studyview['id'];?>
						<?php //echo getFaculty($id_faculty).">".getStudyLevel($id_s_l).">".getStudyView($id_s_v)."<br>";?>
						<p><?=UNI_NAME?></p>
						<p>Маълумот дар бораи натиҷаи сессияи имтиҳонотии соли таҳсили <?=getStudyYear($S_Y)?></p>
						<p>Факултети <?=getFaculty($id_faculty)?></p>
						<p>Зинаи таҳсили <?=getStudyLevel($id_s_l)?>, шуъбаи <?=getStudyView($id_s_v)?></p>
						<p>Нимсолаи <?=$H_Y.". Курсҳои 1,2,3,4 аз ".date('d.m.Y')?></p>
						
						<table class="table transcript" style="width:100%;">
							<thead class="bold">
								<tr>
									<td rowspan="3"><div class="vertical">Ихтисос</div></td>
									<td rowspan="3"><div class="vertical">Буҷавӣ</div></td>
									<td rowspan="3"><div class="vertical">Шартномавӣ</div></td>
									<td rowspan="4"><div class="vertical">Квота</div></td>
									<td rowspan="3"><div class="vertical">Ҳамаги<br>донишҷуён</div></td>
									<td colspan="19" class="center">Супориданд</td>
									<td rowspan="3"><div class="vertical">Азхудкунии <br>мутлақ %</div></td>
									<td colspan="9" class="center">Баҳои ғайриқаноатбахш гирифтанд</td>
									<td rowspan="3"><div class="vertical">Абсолютная<br>успеваемость</div></td>
								</tr>
								<tr>
									<td colspan="3" class="center">Аъло</td>
									<td colspan="3" class="center">Хубу аъло</td>
									<td colspan="3" class="center">Хуб</td>
									<td rowspan="2"><div class="vertical">Сифат %</div></td>
									<td colspan="3" class="center">Омехта</td>
									<td colspan="3" class="center">Қаноатбаш</td>
									<td rowspan="2"><div class="vertical">Буҷавӣ</div></td>
									<td rowspan="2"><div class="vertical">Шартномавӣ</div></td>
									<td rowspan="2"><div class="vertical">Ҳамагӣ</div></td>
									<td colspan="2" class="center">Аз як <br>фанн</td>
									<td colspan="2" class="center">Аз ду <br>фанн</td>
									<td colspan="2" class="center">Аз се ва <br>зиёда фанн</td>
									<td rowspan="2"><div class="vertical">Ҳамагӣ</div></td>
									<td rowspan="2"><div class="vertical">Буҷавӣ</div></td>
									<td rowspan="2"><div class="vertical">Шартномавӣ</div></td>
								</tr>
								<tr>
									<td><div class="vertical">Ҳамагӣ</div></td>
									<td><div class="vertical">Буҷавӣ</div></td>
									<td><div class="vertical">Шартномавӣ</div></td>
									<td><div class="vertical">Ҳамагӣ</div></td>
									<td><div class="vertical">Буҷавӣ</div></td>
									<td><div class="vertical">Шартномавӣ</div></td>
									<td><div class="vertical">Ҳамагӣ</div></td>
									<td><div class="vertical">Буҷавӣ</div></td>
									<td><div class="vertical">Шартномавӣ</div></td>
									<td><div class="vertical">Ҳамагӣ</div></td>
									<td><div class="vertical">Буҷавӣ</div></td>
									<td><div class="vertical">Шартномавӣ</div></td>
									<td><div class="vertical">Ҳамагӣ</div></td>
									<td><div class="vertical">Буҷавӣ</div></td>
									<td><div class="vertical">Шартномавӣ</div></td>
									<td><div class="vertical">Буҷавӣ</div></td>
									<td><div class="vertical">Шартномавӣ</div></td>
									<td><div class="vertical">Буҷавӣ</div></td>
									<td><div class="vertical">Шартномавӣ</div></td>
									<td><div class="vertical">Буҷавӣ</div></td>
									<td><div class="vertical">Шартномавӣ</div></td>
								</tr>
							</thead>
							<tbody>
							<?php $fac_buj = $fac_sh = $fac_kv = $fac_all = $fac5 = $fac_buj5 = $fac_sh5 = $fac45 = $fac_buj45 = $fac_sh45 = $fac4 = $fac_buj4 = $fac_sh4 = $fac345 = $fac_buj345 = $fac_sh345 = $fac3 = $fac_buj3 = $fac_sh3 = $facsup = $facsup_b = $facsup_sh = $fac1_b = $fac1_sh = $fac2_b = $fac2_sh = $fac3_b = $fac3_sh = $facnas = $facnas_b = $facnas_sh = 0;?>
								<?php $courses = query("SELECT DISTINCT (`id_course`) FROM `state_groups` 
														WHERE `id_faculty` = '$id_faculty' AND
															`id_s_l` = '$id_s_l' AND
															`id_s_v` = '$id_s_v' AND
															`s_y` = '$S_Y' AND
															`h_y` = '$H_Y' 
														ORDER BY `id_course` ASC
														");
								?>
								<?php foreach ($courses as $course):?>
									<?php $kurs_buj = $kurs_sh = $kurs_kv = $kurs_all = $kurs5 = $kurs_buj5 = $kurs_sh5 = $kurs45 = $kurs_buj45 = $kurs_sh45 = $kurs4 = $kurs_buj4 = $kurs_sh4 = $kurs345 = $kurs_buj345 = $kurs_sh345 = $kurs3 = $kurs_buj3 = $kurs_sh3 = $kurssup = $kurssup_b = $kurssup_sh = $kurs1_b = $kurs1_sh = $kurs2_b = $kurs2_sh = $kurs3_b = $kurs3_sh = $kursnas = $kursnas_b = $kursnas_sh = 0;?>
									<?php $id_course = $course['id_course'];?>
										<tr class="center bold">
											<td colspan="35">Курси <?=$id_course?></td>
										</tr>
									<?php $specs = query("SELECT DISTINCT (`id_spec`) FROM `state_groups` 
														WHERE `id_faculty` = '$id_faculty' AND
															`id_s_l` = '$id_s_l' AND
															`id_s_v` = '$id_s_v' AND
															`id_course` = '$id_course' AND
															`s_y` = '$S_Y' AND
															`h_y` = '$H_Y' 
														ORDER BY `id_spec` ASC
														");
									?>
									<?php foreach($specs as $spec):?>
										<?php 
											$id_spec = $spec['id_spec'];
											$groups = query("SELECT DISTINCT (`id_group`) FROM `state_groups` 
														WHERE `id_faculty` = '$id_faculty' AND
															`id_s_l` = '$id_s_l' AND
															`id_s_v` = '$id_s_v' AND
															`id_course` = '$id_course' AND
															`id_spec` = '$id_spec' AND
															`s_y` = '$S_Y' AND
															`h_y` = '$H_Y' 
														ORDER BY `id_group` ASC
														");
														//print_arr($groups);// exit;
										?>
										<?php foreach($groups as $group):?>
											<?php $umar++;?>
											<?php $id_group = $group['id_group']?>
											<?php $res_all = forma34($id_faculty, $S_Y, $H_Y, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group)?>
											<?php $res_bujavi = forma34($id_faculty, $S_Y, $H_Y, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group, 2)?>
											<?php $res_shartnomavi = forma34($id_faculty, $S_Y, $H_Y, $id_s_l, $id_s_v, $id_course, $id_spec, $id_group, 1)?>
											<tr class="center">
												<td class="left"><?=getSpecialtyCode($id_spec)." ".getGroup($id_group)?></td>
												<td>
													<?php
														echo $buj = count_table_where("students", "`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_s_t` = '2' AND `id_course`= '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
														$kurs_buj += $buj;
													?>
												</td>
												<td>
													<?php
														echo $shart = count_table_where("students", "`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_s_t` = '1' AND `id_course`= '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
														$kurs_sh += $shart;
													?>
												</td>
												<td>
													<?php
														echo $kv = count_table_where("students", "`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_s_t` = '3' AND `id_course`= '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
														$kurs_kv += $kv;
													?>
												</td>
												<td>
													<?php
														echo @$all_stds = count_table_where("students", "`status` = '1' AND `id_faculty` = '$id_faculty' AND `id_s_l` = '$id_s_l' AND `id_s_v` = '$id_s_v' AND `id_course`= '$id_course' AND `id_spec` = '$id_spec' AND `id_group` = '$id_group' AND `s_y` = '$S_Y' AND `h_y` = '$H_Y'");
														$kurs_all += @$all_stds;								
													?>
												</td>
												<td>
													<?php
														echo @$res_all['5'];
														$kurs5 += @$res_all['5'];
													?>					
												</td>
												<td>
													<?php
														echo @$res_bujavi['5'];
														$kurs_buj5 +=@$res_bujavi['5'];
													?>
												</td>	
												<td>
													<?php
														echo @$res_shartnomavi['5'];
														$kurs_sh5 +=@$res_shartnomavi['5'];
													?>
												</td>
												<td>
													<?php
														echo @$res_all['45'];
													//	print_arr($res_all['students']['45']);
														$kurs45 += @$res_all['45'];	
													?>
												</td>	
												<td>
													<?php
														echo @$res_bujavi['45'];
														$kurs_buj45 +=@$res_bujavi['45'];
													?>
												</td>	
												<td>
													<?php 
														echo @$res_shartnomavi['45'];
														$kurs_sh45 += @$res_shartnomavi['45'];
													?>
												</td>								
												<td>
													<?php
														echo @$res_all['4'];
													//	print_arr($res_all['students']['4']);
														$kurs4 += @$res_all['4'];
													?>
												</td>	
												<td>
													<?php
														echo @$res_bujavi['4'];
														$kurs_buj4 += @$res_bujavi['4'];
													?>
												</td>	
												<td>
													<?php
														echo @$res_shartnomavi['4'];
														$kurs_sh4 += @$res_shartnomavi['4'];
													?>
												</td>	
												<td>
													<?php
														echo round(($sifat = (@$res_all['5'] + @$res_all['45'] + @$res_all['4']) / @$all_stds * 100),1);
													?>
												</td>
												<td>
													<?php
														echo @$res_all['345'];
														$kurs345 += @$res_all['345'];
														//print_arr($res_all['students']['345']);
													?>
												</td>	
												<td>
													<?php 
														echo @$res_bujavi['345'];
														$kurs_buj345 += @$res_bujavi['345'];
													?>
												</td>	
												<td>
													<?php
														echo @$res_shartnomavi['345'];
														$kurs_sh345 += @$res_shartnomavi['345'];
													?>
												</td>	
												<td>
													<?php
														echo @$res_all['3'];
														//print_arr($res_all['students']['3']);
														$kurs3 += @$res_all['3'];
													?>
												</td>	
												<td>
													<?php
														echo @$res_bujavi['3'];
														$kurs_buj3 += @$res_bujavi['3'];	
													?>
												</td>	
												<td>
													<?php
														echo @$res_shartnomavi['3'];
														$kurs_sh3 += @$res_shartnomavi['3'];
													?>
												</td>
												<td>
													<?php
														echo @($res_bujavi['5'] + $res_bujavi['45'] + $res_bujavi['4'] + $res_bujavi['345'] + $res_bujavi['3']);
														$kurssup_b += @($res_bujavi['5'] + $res_bujavi['45'] + $res_bujavi['4'] + $res_bujavi['345'] + $res_bujavi['3']);
													?>
												</td>	
												<td>
													<?php
														echo @($res_shartnomavi['5'] + $res_shartnomavi['45'] + $res_shartnomavi['4'] + $res_shartnomavi['345'] + $res_shartnomavi['3']) ;
														$kurssup_sh += @($res_shartnomavi['5'] + $res_shartnomavi['45'] + $res_shartnomavi['4'] + $res_shartnomavi['345'] + $res_shartnomavi['3']);
													?>
												</td>	
												<td>
													<?php
														echo @($res_all['5'] + $res_all['45'] + $res_all['4'] + $res_all['345'] + $res_all['3']) ;
														$kurssup += @($res_all['5'] + $res_all['45'] + $res_all['4'] + $res_all['345'] + $res_all['3']) ;
													?>
												</td>
												<td>
													<?php
														echo round(($az_mutlaq = (@$res_all['5'] + @$res_all['45'] + @$res_all['4'] + @$res_all['345'] + @$res_all['3']) / $all_stds * 100),1) ;
													?>
												</td>
												<td>
													<?php
														echo @$res_bujavi['qarz1fan'];
														$kurs1_b += @$res_bujavi['qarz1fan'];
													?>
												</td>
												<td>
													<?php
														echo @$res_shartnomavi['qarz1fan'];
														$kurs1_sh += @$res_shartnomavi['qarz1fan'];
													?>
												</td>
												<td>
													<?php
														echo @$res_bujavi['qarz2fan'];
														$kurs2_b += @$res_bujavi['qarz2fan'];
													?>
												</td>
												<td>
													<?php
														echo @$res_shartnomavi['qarz2fan'];
														$kurs2_sh += @$res_shartnomavi['qarz2fan'];
													?>
												</td>			
												<td>
													<?php
														echo @$res_bujavi['qarz3fan'];
														$kurs3_b += @$res_bujavi['qarz3fan'];
													?>
												</td>
												<td>
													<?php 
														echo @$res_shartnomavi['qarz3fan'];
														$kurs3_sh += @$res_shartnomavi['qarz3fan'];
													?>
												</td>
												<td>
													<?php
														echo @$res_all['f']+@$res_all['fx'];
														$kursnas += @$res_all['f']+@$res_all['fx'];
													?>
												</td>	
												<td>
													<?php
														echo @$res_bujavi['f']+@$res_bujavi['fx'];
														$kursnas_b += @$res_bujavi['f']+@$res_bujavi['fx'];
													?>
												</td>	
												<td>
													<?php 
														echo @$res_shartnomavi['f']+@$res_shartnomavi['fx'];
														$kursnas_sh += @$res_shartnomavi['f']+@$res_shartnomavi['fx'];
													?>
												</td>	
												<td>
													<?php /*
														if($id_spec == 54){
																echo $qarzdorho = "SELECT `id_student`, 
																   `id_faculty`, 
																   `id_course`, 
																   `id_spec`, 
																   `id_group`, 
																   COUNT(CASE WHEN COALESCE(`total_score`, 0) < 50 AND COALESCE(`trimestr_score`, 0) < 50 THEN 1 ELSE NULL END) as `count_total_score_lt_50`
															FROM `results`
															WHERE `id_faculty` = '$id_faculty'
															  AND `s_y` = '$S_Y'
															  AND `h_y` = '$H_Y'
															  AND `id_student` IN (
																	  SELECT DISTINCT `id_student`
																	  FROM `students`
																	  WHERE `status` = '1'
																		AND `id_faculty` = '$id_faculty' 
																		AND `id_s_l` = '$id_s_l' 
																		AND `id_s_v` = '$id_s_v'
																		AND `id_s_t` IN (1,2,3)
																		AND `id_course` = '$id_course'
																		AND `id_spec` = '$id_spec'
																		AND `id_group` = '$id_group'
																		AND `s_y` = '$S_Y'
																		AND `h_y` = '$H_Y'
																  )
															GROUP BY `id_student`, `id_faculty`, `id_course`, `id_spec`, `id_group`;
															";
														}*/
													?>
												</td>								
											<tr>
											<?php //exit;?>
										<?php endforeach;?>
									<?php endforeach;?>
									<tr class="center bold">
										<td>Ҳамагӣ:</td>
										<td><?php echo $kurs_buj; $fac_buj += $kurs_buj;?></td>
										<td><?php echo $kurs_sh; $fac_sh += $kurs_sh;?></td>
										<td><?php echo $kurs_kv; $fac_kv += $kurs_kv;?></td>
										<td><?php echo $kurs_all; $fac_all += $kurs_all;?></td>
										<td><?php echo $kurs5; $fac5 += $kurs5;?></td>
										<td><?php echo $kurs_buj5; $fac_buj5 += $kurs_buj5;?></td>
										<td><?php echo $kurs_sh5; $fac_sh5 += $kurs_sh5;?></td>
										<td><?php echo $kurs45; $fac45 += $kurs45;?></td>
										<td><?php echo $kurs_buj45; $fac_buj45 += $kurs_buj45?></td>
										<td><?php echo $kurs_sh45; $fac_sh45 += $kurs_sh45;?></td>
										<td><?php echo $kurs4; $fac4 += $kurs4;?></td>
										<td><?php echo $kurs_buj4; $fac_buj4 += $kurs_buj4?></td>
										<td><?php echo $kurs_sh4; $fac_sh4 += $kurs_sh4;?></td>
										<td><?=round(($kurs5+$kurs45+$kurs4)/$kurs_all*100,1)?></td>
										<td><?php echo $kurs345; $fac345 += $kurs345;?></td>
										<td><?php echo $kurs_buj345; $fac_buj345 += $kurs_buj345?></td>
										<td><?php echo $kurs_sh345; $fac_sh345 +=$kurs_buj345?></td>
										<td><?php echo $kurs3; $fac3 += $kurs3?></td>
										<td><?php echo $kurs_buj3; $fac_buj3 += $kurs_buj3;?></td>
										<td><?php echo $kurs_sh3; $fac_sh3 += $kurs_sh3?></td>
										<td><?php echo $kurssup_b; $facsup_b += $kurssup_b?></td>
										<td><?php echo $kurssup_sh; $facsup_sh += $kurssup_sh?></td>
										<td><?php echo $kurssup; $facsup += $kurssup?></td>
										<td><?=round(($kurssup / $kurs_all * 100), 1)?></td>
										<td><?php echo $kurs1_b; $fac2_b += $kurs1_b?></td>
										<td><?php echo $kurs1_sh; $fac1_sh += $kurs1_sh?></td>
										<td><?php echo $kurs2_b; $fac2_b += $kurs2_b?></td>
										<td><?php echo $kurs2_sh; $fac2_sh += $kurs2_sh?></td>
										<td><?php echo $kurs3_b; $fac3_b += $kurs3_b?></td>
										<td><?php echo $kurs3_sh; $fac3_sh += $kurs3_sh?></td>
										<td><?php echo $kursnas; $facnas +=$kursnas?></td>
										<td><?php echo $kursnas_b; $facnas_b += $kursnas_b?></td>
										<td><?php echo $kursnas_sh; $facnas_sh += $kursnas_sh;?></td>
										<td></td>
									</tr>
								<?php endforeach;?>
								<tr class="center bold">
									<td>Дар факулет:</td>
									<td><?=$fac_buj?></td>
									<td><?=$fac_sh?></td>
									<td><?=$fac_kv?></td>
									<td><?=$fac_all?></td>
									<td><?=$fac5?></td>
									<td><?=$fac_buj5?></td>
									<td><?=$fac_sh5?></td>
									<td><?=$fac45?></td>
									<td><?=$fac_buj45?></td>
									<td><?=$fac_sh45?></td>
									<td><?=$fac4?></td>
									<td><?=$fac_buj4?></td>
									<td><?=$fac_sh4?></td>
									<td><?php echo ($fac_all != 0) ? round(($fac5 + $fac45 + $fac4) / $fac_all * 100, 1) : 0;?><?//=@round(($fac5+$fac45+$fac4)/$fac_all*100,1)?></td>
									<td><?=$fac345?></td>
									<td><?=$fac_buj345?></td>
									<td><?=$fac_sh345?></td>
									<td><?=$fac3?></td>
									<td><?=$fac_buj3?></td>
									<td><?=$fac_sh3?></td>
									<td><?=$facsup_b?></td>
									<td><?=$facsup_sh?></td>
									<td><?=$facsup?></td>
									<td><?php echo ($fac_all != 0) ? round(($facsup / $fac_all * 100), 1) : 0;?><?//=round(($facsup / $fac_all * 100), 1)?></td>
									<td><?=$fac1_b?></td>
									<td><?=$fac1_sh?></td>
									<td><?=$fac2_b?></td>
									<td><?=$fac2_sh?></td>
									<td><?=$fac3_b?></td>
									<td><?=$fac3_sh?></td>
									<td><?=$facnas?></td>
									<td><?=$facnas_b?></td>
									<td><?=$facnas_sh?></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					<p class="newpage"></p>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endif;?>
		<?php endforeach;?>
		<?php echo $umar;?>
	</body>
</html>