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
		
		<style>
			th, td {
				padding: 6px !important;
			}
		</style>
		
	</head>
	
	<body>
		
		
		
<h3 class="center">Донишгоҳи техналогии Тоҷикистон </h3>
<center>банақшагирии миқдори соатҳои таълимӣ барои соли таҳсили <?=getStudyYear(S_Y)?>	</center>
 <br>
<b>Миқдори соатҳои тақсимшудаи солона: 	<center><b>	Кафедра: </center>
<b>Басти корӣ:								<center><b>Ному насаби омӯзгор:  </center>
											<center><b>Вазифа ва унвон: </center>


<div class="table-responsive davrifaol">
	<table class="table iqtibos" style="font-size:14px">
		<thead>
			<tr class="center">
				<th rowspan="2">№</th>
				<th rowspan="2" >
					<h4>Номгӯи фанҳо</h4>
				</th>
				<th  rowspan="2">
					<div class="vertical">Ҳаҷми умумии кредитҳо аз рӯи стандарт</div>
				</th>
				<th  rowspan="2">
					<div class="vertical">Кредитҳои аудиторӣ</div>
				</th>
				<th rowspan="2">
					<div class="vertical">Зергуруҳҳои лабораторӣ</div>
				</th>
				<th rowspan="2">
					<div class="vertical">Соатҳои дарсӣ</div>
				</th>
				<th rowspan="2">
					<div class="vertical">КМРО(ҳузурии ғ/фаъол), кредит</div>
				</th>
				<th rowspan="2">
					<div class="vertical">КМРО(ҳузурии ғ/фаъол), соат</div>
				</th>
				<th rowspan="2">
					<div class="vertical">Имтиҳон</div>
				</th>
				<th rowspan="2">
					<div class="vertical">КМД</div>
				</th>
				<th  rowspan="2">
					<div class="vertical">Лоиҳаи курсӣ</div>
				</th>
				<th  rowspan="2">
					<div class="vertical">Кори курсӣ</div>
				</th>
				<th  rowspan="2">
					<div class="vertical">Кори контролӣ</div>
				</th>
				<th colspan="2">ЛК</th>
				<th colspan="2">ОЗМ</th>
				<th colspan="2">АМ</th>
				<th colspan="2">СМ</th>
				<th rowspan="2">
					<div class="vertical">Таҷрибаомӯзии таълимӣ</div>
				</th>
				<th rowspan="2">
					<div class="vertical">Таҷрибаомӯзии истеҳсолӣ</div>
				</th>
				<th rowspan="2">
					<div class="vertical">Таҷрибаомӯзии пешаздипломӣ</div>
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
				<th rowspan="2"><div class="vertical">Номгӯи кафедраи муттасадии фани таълимӣ</div></th>
				<!--
				<th rowspan="2"><div class="vertical">Имзои мудири кафедраи дахлдор</div></th>
				-->
			</tr>
			<tr>
				<th><div class="vertical">Аз рӯи нақша</div></th>
				<th><div class="vertical">Ҳамагӣ</div></th>
				<th><div class="vertical">Аз рӯи нақша</div></th>
				<th><div class="vertical">Ҳамагӣ</div></th>
				<th><div class="vertical">Аз рӯи нақша</div></th>
				<th><div class="vertical">Ҳамагӣ</div></th>
				<th><div class="vertical">Аз рӯи нақша</div></th>
				<th><div class="vertical">Ҳамагӣ</div></th>
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
				<th>16</th>
				<th>17</th>
				<th>18</th>
				<th>19</th>
				<th>20</th>
				<th>21</th>
				<th>22</th>
				<th>23</th>
				<th>24</th>
				<th>25</th>
				<th>26</th>
				<th>27</th>
				<th>28</th>
				<!--<th>29</th>-->
			</tr>
		</thead>
		<tbody class="center">
			
			<?php if(!empty($check_datas)):?>
			
				<?php $credits = $credits_audtrs = $soathoi_darsi = $cmro_credits = $cmro_soats = $lk_plans = $ozm_plans = $am_plans = $hamagis = 0; ?>
				<?php $nimsola = 1;?>
				<?php foreach($semestrs as $s):?>
					<tr class="center bold">
						<td colspan="29">НИМСОЛАИ <?=$nimsola++?> (СЕМЕСТРИ <?=$s?>)</td>
					</tr>
					
					<?php $datas = query("SELECT * FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s'  ORDER BY `semestr`, `id_fan`");?>
					
					
					<?php $counter  = 0;?>
					<?php foreach($datas as $item):?>
					
						<tr>
							<td><?=++$counter?></td>
							<td class="left"><?=getFanTest($item['id_fan'])?></td>
							<td><?=$item['credits']?></td>
							<td><?=$item['credits_audtr']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="zerguruhho"><?=$item['zerguruhho']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="soathoi_darsi"><?=$item['soathoi_darsi']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="cmro_credit"><?=$item['cmro_credit']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="cmro_soat"><?=$item['cmro_soat']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="imtihon"><?=$item['imtihon']?></td>
							<td></td> 
							<td class="edit" data-id="<?=$item['id']?>" data-field="loihai_kursi"><?=$item['loihai_kursi']?></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="kori_kursi"><?=$item['kori_kursi']?></td>
							<td></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="lk_plan"><?=$item['lk_plan']?></td>
							<td></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="ozm_plan"><?=$item['ozm_plan']?></td>
							<td></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="am_plan"><?=$item['am_plan']?></td>
							<td></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="sm_plan"><?=$item['sm_plan']?></td>
							<td></td>
							<td></td>
							<td></td>  
							<td></td>
							<td></td>
							<td></td>
							<td class="edit" data-id="<?=$item['id']?>" data-field="hamagi"><?=$item['hamagi']?></td>
							<td>
								<select name="id_departament" id="id_departament" class="id_departament form-control" data-id-fan="<?=$item['id_fan']?>" data-id="<?=$item['id']?>">
									<option value="">Интихоб кунед!</option>
									<?php foreach($departaments as $d_item):?>
										<option <?php if($d_item['id'] == $item['id_departament']):?> selected <?php endif;?> value="<?=$d_item['id'];?>" title="<?=$d_item['title']?>"><?=$d_item['short']?></option>
									<?php endforeach;?>
								</select>
							</td>
							<!--<td></td>--> 
						</tr>
					<?php endforeach;?>
					<tr class="bold">
						<td colspan="2" class="left">Ҳамагӣ</td>
						<td>
							<?php $res = query("SELECT SUM(`credits`) as `credits` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=$res[0]['credits']?>
							
							<?php $credits += $res[0]['credits']?>
						</td>
						<td>
							<?php $res = query("SELECT SUM(`credits_audtr`) as `credits_audtr` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=round($res[0]['credits_audtr'], 2)?>
							
							<?php $credits_audtrs += $res[0]['credits_audtr']?>
						</td>
						<td></td>
						<td>
							<?php $res = query("SELECT SUM(`soathoi_darsi`) as `soathoi_darsi` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=$res[0]['soathoi_darsi']?>
							
							<?php $soathoi_darsi += $res[0]['soathoi_darsi'];?>
						</td>
						<td>
							<?php $res = query("SELECT SUM(`cmro_credit`) as `cmro_credit` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=round($res[0]['cmro_credit'], 2)?>
							
							<?php $cmro_credits += $res[0]['cmro_credit']?>
						</td>
						<td>
							<?php $res = query("SELECT SUM(`cmro_soat`) as `cmro_soat` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=$res[0]['cmro_soat']?>
							
							<?php $cmro_soats += $res[0]['cmro_soat']?>
						</td>
						<td></td>
						<td></td> 
						<td></td>
						<td></td>
						<td></td>
						<td>
							<?php $res = query("SELECT SUM(`lk_plan`) as `lk_plan` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=$res[0]['lk_plan']?>
							
							<?php $lk_plans += $res[0]['lk_plan']?>
						</td>
						<td></td>
						<td>
							<?php $res = query("SELECT SUM(`ozm_plan`) as `ozm_plan` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=$res[0]['ozm_plan']?>
							
							<?php $ozm_plans += $res[0]['ozm_plan']?>
						</td>
						<td></td>
						<td>
							<?php $res = query("SELECT SUM(`am_plan`) as `am_plan` FROM `iqtibosho` WHERE `id_nt` = '$id_nt' AND `semestr` = '$s' ");?>
							<?=$res[0]['am_plan']?>
							
							<?php $am_plans += $res[0]['am_plan']?>
						</td>
						<td></td>
						<td></td>
						<td></td>
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
						<!--<td></td>-->
					</tr>
				
				<?php endforeach;?>
				
				<tr class="bold">
					<td colspan="2" class="left">Ҷамъ</td>
					<td><?=$credits?></td>
					<td><?=round($credits_audtrs, 2)?></td>
					<td></td>
					<td><?=$soathoi_darsi?></td>
					<td><?=round($cmro_credits, 2)?></td> 
					<td><?=$cmro_soats?></td> 
					<td></td> 
					<td></td> 
					<td></td>
					<td></td>
					<td></td>
					<td><?=$lk_plans?></td>
					<td></td>
					<td><?=$ozm_plans?></td>
					<td></td>
					<td><?=$am_plans?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><?=$hamagis?></td>
					<td></td>
					<!--<td></td>-->
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

		
		
		<center>Декани ФТИваК  _________________  .          Мудири кафедраи   _________________ </center>
		
		
		
		
		<div class="table-responsive davrifaol">
			
			<h3 class="center">
				<?=$page_info['title']?>
			</h3>
			
			<div class="col-xl-12 col-md-12">
				<div class="card">
					
					<div class="card-block">
						<?php //print_arr($lessons)?>
						<div class="table-responsive davrifaol">
							<table class="table" style="font-size:14px">
								<thead class="center">
									<tr >
										<th style="width:40px">№</th>
										<th style="width:50px"><div class="vertical">ID ФАН</div></th>
										<th style="width:50px"><div class="vertical">Семестр</div></th>
										<th>Номгӯи фанҳо</th>
										<th style="width:70px">Факултет</th>
										<th style="width:70px">Зинаи таҳсил</th>
										<th style="width:70px">Намуди таҳсил</th>
										<th style="width:70px">Курс</th>
										<th style="width:200px">Ихтисос</th>
										<th style="width:200px">Амалҳо</th>
									</tr>
								</thead>
								<tbody class="center">
									
									<?php if(!empty($lessons)):?>
										<?php $counter = 0;?>
										<?php foreach($lessons as $item):?>
											<tr>
												<th scope="row"><?=++$counter?>.</th>
												<th scope="row"><?=$item['id_fan']?></th>
												<th scope="row"><?=$item['semestr']?></th>
												<td class="left">
													<?=getFanTest($item['id_fan'])?>
												</td>
												<td>
													<span title="<?=getFaculty($item['id_faculty'])?>">
														<?=getFacultyShort($item['id_faculty'])?>
													</span>
												</td>
												
												<td><?=getStudyLevel($item['id_s_l'])?></td>
												<td><?=getStudyView($item['id_s_v'])?></td>
												<td><?=$item['id_course']?></td>
												
												<td>
													<span title="<?=getSpecialtyTitle($item['id_spec'])?>">
														<?=getSpecialtyCode($item['id_spec'])?>
													</span>
													<?=getGroup2($item['id_group'])?>
												</td>
												
												<td class="elements">
													
													
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
						
					</div>
				</div>
		</div>
	
	</body>
	
</html>