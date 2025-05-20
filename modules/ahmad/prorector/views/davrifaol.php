<!-- ДАВРИ ФАЪОЛ-->
<div class="col-xl-12 col-md-12">
	<!-- FANHO -->
	<div class="card">
		<div class="card-header">
			<h5>Ҷадвали даври фаъоли гурӯҳ</h5>
		</div>
		<div class="card-block">
			<button class="btn btn-primary waves-effect waves-light" type="button">
				<a class="davrifaol" target="_blank" href="<?=MY_URL?>?option=print&action=davrifaol&id_faculty=<?=$id_faculty?>&id_s_v=<?=$id_s_v?>&id_course=<?=$id_course?>&id_spec=<?=$id_spec?>&id_group=<?=$id_group?>&s_y=<?=S_Y?>&h_y=<?=H_Y?>">
					<i class="fa fa-print"></i> Чопи ҷадвал
				</a>
			</button>
			<hr>
			<div class="table-responsive davrifaol">
				<table class="table">
					<thead class="center">
						<tr>
							<!--
							<th rowspan="3"><div class="vertical">Миқдори<br>донишҷӯён</div></th>
							<th rowspan="3"><div class="vertical">Роҳ наёфтанд</div></th>
							<th rowspan="3"><div class="vertical">Иштирок<br>карданд</div></th>
							<th rowspan="3"><div class="vertical">Иштирок<br>накарданд</div></th>
							-->
							<th colspan="14">Натиҷаи баҳоҳо</th>
						</tr>
						<tr>
							<th rowspan="2"><div class="vertical">Аъло</div></th>
							<th rowspan="2">%</th>
							
							<th rowspan="2"><div class="vertical">Хубу аъло</div></th>
							<th rowspan="2">%</th>
							
							<th rowspan="2"><div class="vertical">Хуб</div></th>
							<th rowspan="2">%</th>
							
							<th rowspan="2"><div class="vertical">Қаноатбахш</div></th>
							<th rowspan="2">%</th>
							
							<th rowspan="2"><div class="vertical">Омехта</div></th>
							<th rowspan="2">%</th>
							
							<th colspan="2"><div class="vertical">Қарздор</div></th>
							<th rowspan="2">%</th>
							
						</tr>
						<tr>
							<th>Fx</th>
							<th>F</th>
						</tr>
					</thead>
					<tbody class="center">
						<?php $result = getDavriFaol(S_Y, H_Y, $id_faculty, $id_course, $id_spec, $id_group);?>
						<tr>
							<!--
							<td><?=count($students)?></td>
							<td><?=count($nepodusk)?></td>
							<td><?=count($ishtirok_kardand)?></td>
							
							<td><?=count($students) - count($ishtirok_kardand)?></td>
							-->
							<td>
								<?=$result['5']?>
							</td>
							<td><?=round(($result['5'] * 100)/count($students), 1)?></td>
							
							<td><?=$result['45']?></td>
							<td><?=round(($result['45'] * 100)/count($students), 1)?></td>
							
							<td><?=$result['4']?></td>
							<td><?=round(($result['4'] * 100)/count($students), 1)?></td>
							
							<td><?=$result['3']?></td>
							<td><?=round(($result['3'] * 100)/count($students), 1)?></td>
							
							<td><?=$result['345']?></td>
							<td><?=round(($result['345'] *100)/count($students), 1)?></td>
							
							<td><?=$result['fx']?></td>
							<td><?=$result['f']?></td>
							<td><?=round((($result['fx'] + $result['f']) *100)/count($students), 1)?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- FANHO -->
</div>
<!-- ДАВРИ ФАЪОЛ-->