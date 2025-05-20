<div class="col-xl-12 col-md-12">
	
	<div class="card">
		<div class="card-header">
			<h5>Ҷадвали даври фаъол</h5>
		</div>
		<div class="card-block">
			
			<div class="table-responsive davrifaol">
				<table class="table">
					<thead class="center">
						<tr>
							<th rowspan="3"><div class="vertical">Миқдори донишҷӯён</div></th>
							<th rowspan="3"><div class="vertical">Иштирок карданд</div></th>
							<th rowspan="3"><div class="vertical">Иштирок накарданд</div></th>
							<!--
							<th rowspan="3"><div class="vertical">Роҳ наёфтанд</div></th>
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
						<tr>
							<td class="bold"><?=$students?></td>
							<td class="bold"><?=$ishtirok_kardand?></td>
							<td class="bold text-c-red"><?=$students - $ishtirok_kardand?></td>
							
							<!--
							<td><?=count($nepodusk)?></td>
							-->
							<td class="bold">
								<a href="<?=URL.substr($_SERVER['REQUEST_URI'], 1)?>#alo">
									<?=$result['5']?>
								</a>
							</td>
							<td><?=round(($result['5'] * 100)/$students, 1)?></td>
							
							<td class="bold">
								<a href="<?=URL.substr($_SERVER['REQUEST_URI'], 1)?>#xubualo">
									<?=$result['45']?>
								</a>
							</td>
							
							<td><?=round(($result['45'] * 100)/$students, 1)?></td>
							
							<td class="bold">
								<a href="<?=URL.substr($_SERVER['REQUEST_URI'], 1)?>#xub">
									<?=$result['4']?>
								</a>
							</td>
							<td><?=round(($result['4'] * 100)/$students, 1)?></td>
							
							<td class="bold">
								<a href="<?=URL.substr($_SERVER['REQUEST_URI'], 1)?>#qanoatbaxsh">
									<?=$result['3']?>
								</a>
							</td>
							<td><?=round(($result['3'] * 100)/$students, 1)?></td>
							
							<td class="bold">
								<a href="<?=URL.substr($_SERVER['REQUEST_URI'], 1)?>#omexta">
									<?=$result['345']?>
								</a>
							</td>
							<td><?=round(($result['345'] *100)/$students, 1)?></td>
							
							<td><?=$result['fx']?></td>
							<td><?=$result['f']?></td>
							<td><?=round((($result['fx'] + $result['f']) *100)/$students, 1)?></td>
						</tr>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>

<!-- Аъло -->
<div class="col-xl-12 col-md-12" id="alo">
	<div class="card">
		<div class="card-header">
			<h5>Аъло</h5>
		</div>
		<div class="card-block">
			<div class="table-responsive davrifaol">
				<table class="table">
					<thead class="center">
						<tr><th colspan="5">Аъло (A, A-)</th></tr>
						<tr>
							<th>№</th>
							<th>Ному насаби донишҷӯ</th>
							<th>Факултет</th>
							<th>Курс</th>
							<th>Ихтисос</th>
						</tr>
					</thead>
					<tbody>
						<?php $counter = 0;?>
						<?php foreach($result['students']['5'] as $item):?>
							<tr>
								<td class="center" style="width:50px"><?=++$counter?>.</td>
								<td><?=$item['student']?></td>
								<td class="center"><?=$item['id_faculty']?></td>
								<td class="center"><?=$item['id_course']?></td>
								<td class="center"><?=$item['id_spec']?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Аъло -->

<!-- Хубу Аъло -->
<div class="col-xl-12 col-md-12" id="xubualo">
	<div class="card">
		<div class="card-header">
			<h5>Хубу аъло</h5>
		</div>
		<div class="card-block">
			<div class="table-responsive davrifaol">
				<table class="table">
					<thead class="center">
						<tr><th colspan="5">Хубу аъло (B-, B, B+, A-, A)</th></tr>
						<tr>
							<th>№</th>
							<th>Ному насаби донишҷӯ</th>
							<th>Факултет</th>
							<th>Курс</th>
							<th>Ихтисос</th>
						</tr>
					</thead>
					<tbody>
						<?php $counter = 0;?>
						<?php foreach($result['students']['45'] as $item):?>
							<tr>
								<td class="center" style="width:50px"><?=++$counter?>.</td>
								<td><?=$item['student']?></td>
								<td class="center"><?=$item['id_faculty']?></td>
								<td class="center"><?=$item['id_course']?></td>
								<td class="center"><?=$item['id_spec']?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Хубу Аъло -->

<!-- Хуб -->
<div class="col-xl-12 col-md-12" id="xub">
	<div class="card">
		<div class="card-header">
			<h5>Хуб</h5>
		</div>
		<div class="card-block">
			<div class="table-responsive davrifaol">
				<table class="table">
					<thead class="center">
						<tr><th colspan="5">Хуб (B-, B, B+)</th></tr>
						<tr>
							<th>№</th>
							<th>Ному насаби донишҷӯ</th>
							<th>Факултет</th>
							<th>Курс</th>
							<th>Ихтисос</th>
						</tr>
					</thead>
					<tbody>
						<?php $counter = 0;?>
						<?php foreach($result['students']['4'] as $item):?>
							<tr>
								<td class="center" style="width:50px"><?=++$counter?>.</td>
								<td><?=$item['student']?></td>
								<td class="center"><?=$item['id_faculty']?></td>
								<td class="center"><?=$item['id_course']?></td>
								<td class="center"><?=$item['id_spec']?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Хуб -->

<!-- Қаноатбахш -->
<div class="col-xl-12 col-md-12" id="qanoatbaxsh">
	<div class="card">
		<div class="card-header">
			<h5>Қаноатбахш</h5>
		</div>
		<div class="card-block">
			<div class="table-responsive davrifaol">
				<table class="table">
					<thead class="center">
						<tr><th colspan="5">Қаноатбахш (D, D+, C-, C, C+)</th></tr>
						<tr>
							<th>№</th>
							<th>Ному насаби донишҷӯ</th>
							<th>Факултет</th>
							<th>Курс</th>
							<th>Ихтисос</th>
						</tr>
					</thead>
					<tbody>
						<?php $counter = 0;?>
						<?php foreach($result['students']['3'] as $item):?>
							<tr>
								<td class="center" style="width:50px"><?=++$counter?>.</td>
								<td><?=$item['student']?></td>
								<td class="center"><?=$item['id_faculty']?></td>
								<td class="center"><?=$item['id_course']?></td>
								<td class="center"><?=$item['id_spec']?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Қаноатбахш -->

<!-- Омехта -->
<div class="col-xl-12 col-md-12" id="omexta">
	<div class="card">
		<div class="card-header">
			<h5>Омехта</h5>
		</div>
		<div class="card-block">
			<div class="table-responsive davrifaol">
				<table class="table">
					<thead class="center">
						<tr><th colspan="5">Омехта (D, D+, C-, C, C+, B-, B, B+, A-, A)</th></tr>
						<tr>
							<th>№</th>
							<th>Ному насаби донишҷӯ</th>
							<th>Факултет</th>
							<th>Курс</th>
							<th>Ихтисос</th>
						</tr>
					</thead>
					<tbody>
						<?php $counter = 0;?>
						<?php foreach($result['students']['345'] as $item):?>
							<tr>
								<td class="center" style="width:50px"><?=++$counter?>.</td>
								<td><?=$item['student']?></td>
								<td class="center"><?=$item['id_faculty']?></td>
								<td class="center"><?=$item['id_course']?></td>
								<td class="center"><?=$item['id_spec']?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Омехта -->