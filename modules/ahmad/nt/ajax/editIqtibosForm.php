<style>
	#editbox {
		text-align: center;
	}
</style>

<h4 class="center">Иқтибос<br>
аз нақшаи таълимии ихтисоси <?=getSpecialtyCode($id_spec)?> - "<?=getSpecialtyTitle($id_spec)?>" барои курси <?=$id_course?> (нимсолаи <?=$semestrs[0]?> 
ва <?=$semestrs[1]?>) шӯъбаи <?=getStudyView($id_s_v)?>, дараҷаи таҳсилоти <?=getStudyLevel($id_s_l)?> тибқи нақшаи таълимии тасдиқшудаи санаи  ___/_____/__________ (низоми таҳсилоти кредитӣ)</h4>
<br>
<div class="table-responsive davrifaol">
	<table class="table iqtibos" style="font-size:14px">
		<thead>
			<tr class="center">
				<th rowspan="2">№</th>
				<th rowspan="2" >
					<h4>Номгӯи фанҳо</h4>
				</th>
				<th  rowspan="2">
					<div class="vertical">Кредит</div>
				</th>
				
				<th rowspan="2">
					<div class="vertical">Имтиҳон</div>
				</th>
				
				<th  rowspan="2">
					<div class="vertical">Кори курсӣ</div>
				</th>
				
				<th colspan="3">Соатҳои дарсӣ</th>
				
				<th rowspan="2">
					<div class="vertical">Таҷрибаомӯзии<br>таълимӣ</div>
				</th>
				<th rowspan="2">
					<div class="vertical">Таҷрибаомӯзии<br>истеҳсолӣ</div>
				</th>
				<th rowspan="2">
					<div class="vertical">Таҷрибаомӯзии<br>пешаздипломӣ</div>
				</th>
				<th rowspan="2">
					<div class="vertical">Кори бакалаврӣ</div>
				</th>
				<th rowspan="2">
					<div class="vertical">Ком.имт.давлатӣ</div>
				</th>
				<th rowspan="2">
					<div class="vertical">Ҳамагӣ</div>
				</th>
				<th rowspan="2"><div class="vertical">Кафедраи<br>муттасадӣ</div></th>
				
			</tr>
			<tr>
				<th><div class="vertical">Лексионӣ</div></th>
				<th><div class="vertical">Амалӣ</div></th>
				<th><div class="vertical">КМРО</div></th>
				
			</tr> 
		
			<tr class="center"> 
				<th>1</th>
				<th>2</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>6</th>
				<th>7</th>
				<th>8</th>
				<th>9</th>
				<th>10</th>
				<th>11</th>
				<th>12</th>
				<th>13</th>
				<th>14</th>
				<th>15</th>
				
			</tr>
		</thead>
		<tbody class="center">
			
			<?php if(!empty($check_datas)):?>
			
				<?php $credits = $lk_soat = $am_soat = $cmro_soat = $hamagis = 0; ?>
				<?php $nimsola = 1;?>
				<?php foreach($semestrs as $s):?>
					<tr class="center bold" style="background: #e0e1e2;">
						<td colspan="29">НИМСОЛАИ <?=$nimsola++?> (СЕМЕСТРИ <?=$s?>)</td>
					</tr>
					
					<?php $datas = query("SELECT * FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s'  ORDER BY `semestr`, `id_fan`");?>
					
					
					<?php $counter  = 0;?>
					<?php foreach($datas as $item):?>
					
						<tr>
							<td><?=++$counter?>.</td>
							<td class="left"><?=$item['id_fan']?> <?=getFanTest($item['id_fan'])?></td>
							<td><?=$item['credits']?></td>
							
							<td><?=$item['imtihon']?></td>
							
							<td class="edit" data-id="<?=$item['id']?>" data-field="kori_kursi"><?=$item['kori_kursi']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="lk_soat"><?=$item['lk_soat']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="am_soat"><?=$item['am_soat']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="cmro_soat"><?=$item['cmro_soat']?></td>
							
							<td class="edit" data-id="<?=$item['id']?>" data-field="tajrib_talimi"><?=$item['tajrib_talimi']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="tajrib_istehsoli"><?=$item['tajrib_istehsoli']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="tajrib_pesh_a_d"><?=$item['tajrib_pesh_a_d']?></td>
							
							<td></td>
							<td></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="hamagi"><?=$item['hamagi']?></td>
							<td>
								<select name="id_departament" id="id_departament" class="id_departament form-control" data-id-fan="<?=$item['id_fan']?>" data-id="<?=$item['id']?>">
									<option value="">Интихоб кунед!</option>
									<?php foreach($departaments as $d_item):?>
										<option <?php if($d_item['id'] == $item['id_departament']):?> selected <?php endif;?> value="<?=$d_item['id'];?>" title="<?=$d_item['title']?>"><?=makeShort($d_item['title'])?></option>
									<?php endforeach;?>
								</select>
							</td>
							
						</tr>
					<?php endforeach;?>
					<tr class="bold">
						<td colspan="2" class="center">Ҳамагӣ дар нимсолаи <?=$nimsola?> (семестри <?=$s?>)</td>
						<td>
							<?php $res = query("SELECT SUM(`credits`) as `credits` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=$res[0]['credits']?>
							<?php $credits += $res[0]['credits']?>
						</td>
						<td></td>
						<td></td>
						<td>
							<?php $res = query("SELECT SUM(`lk_soat`) as `lk_soat` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=round($res[0]['lk_soat'], 2)?>
							
							<?php $lk_soat += $res[0]['lk_soat']?>
						</td>
						<td>
							<?php $res = query("SELECT SUM(`am_soat`) as `am_soat` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=round($res[0]['am_soat'], 2)?>
							
							<?php $am_soat += $res[0]['am_soat']?>
						</td>
						<td>
							<?php $res = query("SELECT SUM(`cmro_soat`) as `cmro_soat` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=round($res[0]['cmro_soat'], 2)?>
							
							<?php $cmro_soat += $res[0]['cmro_soat']?>
						</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
						<td>
							<?php $res = query("SELECT SUM(`hamagi`) as `hamagi` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=$res[0]['hamagi']?>
							
							<?php $hamagis += $res[0]['hamagi']?>
						</td>
						<td></td>
						
						
					</tr>
				
				<?php endforeach;?>
				
				<tr class="bold">
					<td colspan="2" class="center">Ҷамъ дар семестрҳои <?=implode(" ва ", $semestrs)?></td>
					<td><?=$credits?></td>
					<td></td>
					<td></td>
					<td><?=$lk_soat?></td>
					<td><?=$am_soat?></td>
					<td><?=$cmro_soat?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					
					<td><?=$hamagis?></td>
					<td></td>
					
				</tr>
			<?php else:?>
			
			<tr>
				<td class="center bold text-c-red" colspan="28">Маълумот нест</td>
			</tr>
			
			<?php endif;?>
		</tbody>
	</table>


	<!--
	<input type="hidden" name="id" value="<?=$id?>">
	<button type="submit" class="btn btn-success">Сабт кардан</button>
	-->
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.iqtibos').on('click', 'td.edit', function(){
			//находим input внутри элемента с классом ajax и вставляем вместо input его значение
			var value = $('.ajax input').val();
			$('.ajax').html(value);
			//удаляем все классы ajax
			$('.ajax').removeClass('ajax');
			//Нажатой ячейке присваиваем класс ajax
			$(this).addClass('ajax');
			//внутри ячейки создаём input и вставляем текст из ячейки в него
			
			var val = $(this).text().trim();
			$(this).html('<input style="width:65px;" autocomplete="off" id="editbox" class="form-control" value="' + val + '" type="text">');
			//устанавливаем фокус на созданном элементе
			$('#editbox').focus().select();
			
		});
		
		
		
		$('.iqtibos').on('keydown', 'td.edit', function(event){
			var id = $(this).attr('data-id');
			var field = $(this).attr('data-field');
			var value = $('.ajax input').val();
			
			
			if(event.which == 13){
				
				var my_url = '<?=MY_URL;?>';
				var url = '<?=URL."modules/nt/nt_ajax.php?option=update_iqtibos_id";?>';
				
				$.ajax({
					type: 'post',
					url: url,
					data: {
						"id": id,
						"field": field,
						"value":value
					},
					success: function(res){
						$('.ajax').html(value);
					}
				});
			}
			
			
		});
		
		$('.iqtibos').on("change", ".id_departament", function () {
			var id_departament = $(this).val();
			//var id_fan = $(this).attr("data-id-fan");
			var id = $(this).attr("data-id");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/nt/nt_ajax.php?option=updateIqtibos";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				//data: {"id_fan": id_fan, "id_departament": id_departament},
				data: {"id": id, "id_departament": id_departament},
				success: function(data){
					
				}
			});
			
		});
		
		
		
	});
</script>