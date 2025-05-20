<h6 class="center">Нишондоди гурӯҳҳо дар факултети «<?=getFaculty($id_faculty)?>», дар шуъбаи «<?=getStudyView($id_s_v)?>»</h6>

<div class="card-header p-b-0" style="padding: 20px 0">
	<ul class="nav nav-tabs md-tabs" role="tablist">
		<?php $counter = 0;?>
		<?php foreach($_SESSION['superarr'][$id_faculty]['view'][$id_s_v]['course'] as $course):?>
			<li class="nav-item">
				<a class="nav-link <?php if($counter == 0){ echo "active";}?>" data-toggle="tab" href="#course_<?=$course['id']?>" role="tab"><?=$course['title']?></a>
				<div class="slide"></div>
			</li>
			<?php $counter++;?>
		<?php endforeach;?>
	</ul>
</div>
<div class="card-block tab-content p-t-20" style="padding: 0">
	
	<?php $counter = 0;?>
	<?php foreach($_SESSION['superarr'][$id_faculty]['view'][$id_s_v]['course'] as $course):?>
		
		<div class="tab-pane fade <?php if($counter == 0){ echo "show active";}?>" id="course_<?=$course['id']?>" role="tabpanel">
			<div class="generic-card-body">
				<div class="table-responsive davrifaol">
					<table class="table" style="font-size:14px">
						<thead class="center">
							<tr>
								<th rowspan="2">№</th>
								<th rowspan="2">ID<br>SPEC</th>
								<th rowspan="2">Рамзи ихтисос</th>
								<th rowspan="2">Гурӯҳ</th>
								<th rowspan="2">Забони<br>таҳсил</th>
								<th colspan="3">Шумораи донишҷӯён</th>
							</tr>
							<tr>
								<th>Ҳамагӣ</th>
								<th>Писар</th>
								<th>Духтар</th>
							</tr>
						</thead>
						
						<tbody class="center">
							<?php $i = 0;?>
							<?php foreach($course['spec'] as $spec):?>
								<?php foreach($spec['groups'] as $group):?>
									<tr>
										<th scope="row"><?=++$i?>.</th>
										<th scope="row"><?=$spec['id']?></th>
										<td class="left"><?=$spec['code']?> - <?=$spec['title']?></td>
										<td><?=$group['short']?></td>
										<td><?=getLang(getFromStudyGroups($id_faculty, $id_s_v, $course['id'], $spec['id'], $group['id'], 'lang', S_Y, H_Y))?></td>
										<td>
											<?php $res = count_table_where("students", "`id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v' AND `id_course` = '".$course['id']."' AND `id_spec` = '".$spec['id']."' AND `id_group` = '".$group['id']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
											<?=$res?>
										</td>
										<td><?=getJinsInGroup($id_faculty, $id_s_v, $course['id'], $spec['id'], $group['id'], 1, S_Y, H_Y);?></td>
										<td><?=getJinsInGroup($id_faculty, $id_s_v, $course['id'], $spec['id'], $group['id'], 0, S_Y, H_Y);?></td>
									</tr>
								<?php endforeach;?>
								
							<?php endforeach;?>
							<tr style="background: #f5f5f5;">
								<td></td>
								<td></td>
								<td>Ҷамъ дар курсҳои <?=$course['id']?></td>
								<td></td>
								<td></td>
								<td><?=count_table_where("students", "`id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v' AND `id_course` = '".$course['id']."'  AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
								<td><?=getJinsInGroup($id_faculty, $id_s_v, $course['id'], false, false, 1, S_Y, H_Y);?></td>
								<td><?=getJinsInGroup($id_faculty, $id_s_v, $course['id'], false, false, 0, S_Y, H_Y);?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php $counter++;?>
	<?php endforeach;?>
	
</div>






<?php exit;?>

<div class="table-responsive davrifaol">
	<br>
	<table class="table" style="font-size:14px">
		<?php $counter = 0;?>
		<?php foreach($_SESSION['superarr'][$id_faculty]['view'][$id_s_v]['course'] as $course):?>
		<thead class="center">
			<tr>
				<th colspan="6" style="background: lightgoldenrodyellow;">Курсҳои <?=$course['id']?></th>
			</tr>
			<tr>
				<th rowspan="2">№</th>
				<th rowspan="2">Рамзи ихтисос</th>
				<th rowspan="2">Гурӯҳ</th>
				<th colspan="3">Шумораи донишҷӯён</th>
			</tr>
			<tr>
				<th>Ҳамагӣ</th>
				<th>Писар</th>
				<th>Духтар</th>
			</tr>
		</thead>
		
		<tbody class="center">
			<?php foreach($course['spec'] as $spec):?>
				<?php foreach($spec['groups'] as $group):?>
					<tr>
						<th scope="row"><?=++$counter?>.</th>
						<td class="left"><?=$spec['code']?></td>
						<td><?=$group['short']?></td>
						<td>
							<?php $res = count_table_where("students", "`id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v' AND `id_course` = '".$course['id']."' AND `id_spec` = '".$spec['id']."' AND `id_group` = '".$group['id']."' AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?>
							<?=$res?>
						</td>
					</tr>
				<?php endforeach;?>
				
			<?php endforeach;?>
			<tr style="background: #f5f5f5;">
				<td></td>
				<td>Ҷамъ дар курсҳои <?=$course['id']?></td>
				<td></td>
				<td><?=count_table_where("students", "`id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v' AND `id_course` = '".$course['id']."'  AND `s_y` = '".S_Y."' AND `h_y` = '".H_Y."'")?></td>
			</tr>
		</tbody>
		
		
		<?php endforeach;?>
	</table>
</div>