<div class="col-xl-12 col-md-12">
	
	<div class="card">
		<div class="card-header">
			<h5>Натиҷаи имтиҳонҳо</h5>
		</div>
		<div class="card-block">
			<div class="table-responsive">
				<?php $marks = MarkFan($id_faculty, $id_course, $id_spec, $id_group);?>
				
				<table class="table">
					<thead class="center">
						<tr style="background-color: #263544; color: #fff">
							<th class="counter">№</th>
							<th class="counter">ID</th>
							<th class="left" style="width: 250px !important">Номӯйи фанҳо</th>
							<th>Кр.</th>
							<th style="width: 160px !important">Омӯзгор</th>
							
							<th class="marks">A</th>
							<th class="marks">A-</th>
							
							<th class="marks">B+</th>
							<th class="marks">B</th>
							<th class="marks">B-</th>
							
							<th class="marks">C+</th>
							<th class="marks">C</th>
							<th class="marks">C-</th>
							
							<th class="marks">D+</th>
							<th class="marks">D</th>
							
							<th class="marks">Fx</th>
							<th class="marks">F</th>
							
							<th>Амалҳо</th>
						</tr>
					</thead>
					<tbody class="center">
						<?php $counter = 0;?>
						<?php foreach($fanlist as $item):?>
						<tr>
							<th scope="row"><?=++$counter?>.</th>
							<th scope="row"><?=$item['id_fan']?></th>
							<td class="left">
								<?=getFan($item['id_fan'])?>
							</td>
							
							<td><?=$item['c_u']?></td>
							<td>БОБОЕВ А.С.</td>
							<td>
								<?=$marks[$item['id_fan']]['A']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['A-']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['B+']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['B']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['B-']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['C+']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['C']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['C-']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['D+']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['D']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['Fx']?>
							</td>
							<td>
								<?=$marks[$item['id_fan']]['F']?>
							</td>
							<td>
							
							</td>
						</tr>
						<?php endforeach;?>
						
						<tr>
							<td></td>
							<td colspan="2" class="left">Сводни ведомост</td>
							<td>30</td>
							<td colspan="14"></td>
						</tr>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>