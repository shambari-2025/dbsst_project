<div class="col-md-12 col-sm-12">
	
	<?php //print_arr($teacher);?>
	
	
	<button type="button" class="btn btn-inverse waves-effect waves-light" id="loaddata" style="padding: 7px 14px;">
		<a class="davrifaol" target="_blank" href="<?=MY_URL?>?option=print&action=teacherinfo&id_teacher=<?=$id_teacher?>">
			<i class="fa fa-print"></i> Чопи маълумотнома
		</a>
	</button>
	<hr>
	
	
	<table class="table" style="font-size:14px">
		<thead class="center">
			<tr style="background-color: #263544; color: #fff">
				<th style="width:40px">№</th>
				<th style="width:50px">ID<br>ФАН</th>
				<th style="width:280px">Номгӯи фанҳо</th>
				
				<th style="width:70px">Факултет</th>
				<th style="width:70px">Курс</th>
				<th style="width:100px">Ихтисос</th>
				
			</tr>
		</thead>
		<tbody class="center">
			
			<?php if(!empty($lessons)):?>
				<?php $counter = 0;?>
				<?php foreach($lessons as $item):?>
					<tr>
						<th scope="row"><?=++$counter?>.</th>
						<th scope="row"><?=$item['id_fan']?></th>
						<td class="left">
							<?=getFanTest($item['id_fan'])?>
						</td>
						
						<td>
							<span title="<?=getFaculty($item['id_faculty'])?>">
								<?=getFacultyShort($item['id_faculty'])?>
							</span>
						</td>
						
						<td><?=$item['id_course']?></td>
						
						<td>
							<span title="<?=getSpecialtyTitle($item['id_spec'])?>">
								<?=getSpecialtyCode($item['id_spec'])?>
							</span>
							<?=getGroup2($item['id_group'])?>
						</td>
					</tr>
				<?php endforeach;?>
			<?php else: ?>
				<tr class="center bold">
					<td colspan="6">
						<i class="fa fa-warning"></i> Маълумот нест.
					</td>
				</tr>
			<?php endif;?>
		</tbody>
		</table>
</div>
