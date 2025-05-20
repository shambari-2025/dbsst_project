<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			
			<div class="col-lg-12">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?=MY_URL?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							Иқтибосҳо 
						</li>
						<li class="breadcrumb-item">
							<?=getFaculty($id_faculty)?>
						</li>
						<li class="breadcrumb-item">
							<?=getStudyView($id_s_v)?>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<!--
	<?php if(!isset($id_nt)):?>
		<div class="alert alert-danger alert-dismissable growl-animated animated fadeInDown myalert"><i class="fa fa-warning"></i> Ин гурӯҳ нақшаи таълимӣ надорад. Лутфан нақшаи таълимии гурӯҳро муайян кунед.</div>
	<?php endif;?>
	
	-->
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						
						<div class="col-xl-12 col-md-12">
							
							<div class="card">
								<div class="card-header">
									<h5>Иқтибосҳо</h5>
								</div>
								<div class="card-block">
									
									
									<div class="card-header p-b-0" style="padding: 0px">
										<ul class="nav nav-tabs md-tabs" role="tablist">
											
											<?php $counter = 0;?>
											<?php foreach($S_Y_FOR_NT as $item):?>
												<li class="nav-item">
													<a class="nav-link <?php if($counter == 0){ echo "active";}?>" data-toggle="tab" href="#s_y_<?=$item['soli_tasdiq']?>" role="tab"><?=$item['soli_tasdiq']?></a>
													<div class="slide"></div>
												</li>
												<?php $counter++;?>
											<?php endforeach;?>
										</ul>
									</div>
									
									<div class="card-block tab-content p-t-20" style="padding: 20px 0">
										
										<?php $counter = 0;?>
										<?php foreach($S_Y_FOR_NT as $item):?>
											
											<div class="tab-pane fade <?php if($counter == 0){ echo "show active";}?>" id="s_y_<?=$item['soli_tasdiq']?>" role="tabpanel">
												<div class="generic-card-body">
													
													<?php $content = query("SELECT * FROM `nt_list` WHERE `id_faculty` = '$id_faculty' AND `id_s_v` = '$id_s_v' AND `soli_tasdiq` = '".$item['soli_tasdiq']."'");?>
													
													
													<div class="table-responsive davrifaol">
														<table class="table" style="font-size:14px">
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
																	<th rowspan="2"><div class="vertical">Имзои мудири кафедраи дахлдор</div></th>
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
																	<th>29</th>
																</tr>
															</thead>
															<tbody class="center">
																<tr class="center bold">
																	<td colspan="29">НИМСОЛАИ 1 (СЕМЕСТРИ 3)</td>
																</tr>
																<tr>
																	<td>1</td>
																	<td class="left">Асосҳои назарияи электротехника</td>
																	<td>6</td>
																	<td>2.65</td>
																	<td>2</td>
																	<td>64</td>
																	<td>1.35</td>
																	<td>32</td>
																	<td>3</td>
																	<td></td> 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>32</td>
																	<td></td>
																	<td>16</td>
																	<td></td>
																	<td>16</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>  
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>96</td>
																	<td>АНРваЭ</td>
																	<td></td> 
																</tr>
																<tr>
																	<td>2</td>
																	<td class="left">Географияи иқтисодии Тоҷикистон бо асосҳои демография</td>
																	<td>3</td>
																	<td>1.35</td>
																	<td>1</td>
																	<td>32</td>
																	<td>0.65</td>
																	<td>16</td>
																	
																	<td>3</td> 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>16</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>16</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>48</td>
																	<td>МИ</td>
																	<td></td>
																</tr>
																
																<tr>
																	<td colspan="2" class="left">Ҳамагӣ</td>
																	<td>31</td>
																	<td>14.1</td>
																	<td></td>
																	<td>336</td>
																	<td>6.55</td>
																	<td>160</td>
																	<td></td>
																	<td></td> 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>160</td>
																	<td></td>
																	<td>48</td>
																	<td></td>
																	<td>96</td>
																	<td></td>
																	<td>32</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>496</td>
																	<td></td>
																	<td></td>
																</tr>
																<tr class="center bold">
																	<td colspan="29">НИМСОЛАИ 2 (СЕМЕСТРИ 4)</td>
																</tr> 

																<tr>
																	<td colspan="2" class="left">Ҳамагӣ</td>
																	<td>31</td>
																	<td>16.05</td>
																	<td></td>
																	<td>384</td>
																	<td>6.6</td>
																	<td>160</td>
																	<td></td>
																	<td></td> 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>160</td>
																	<td></td>
																	<td>48</td>
																	<td></td>
																	<td>96</td>
																	<td></td>
																	<td>32</td>
																	<td></td>
																	<td>48</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>544</td>
																	<td></td>
																	<td></td>
																</tr>

																<tr>
																	<td colspan="2" class="left">Ҷамъ</td>
																	<td>62</td>
																	<td>30.15</td>
																	<td></td>
																	<td>720</td>
																	<td></td> 
																	<td></td> 
																	<td></td> 
																	<td></td> 
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>320</td>
																	<td></td>
																	<td>96</td>
																	<td></td>
																	<td>192</td>
																	<td></td>
																	<td>64</td>
																	<td></td>
																	<td>48</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td>1040</td>
																	<td></td>
																	<td></td>
																</tr>
															</tbody>
														</table>
													</div>
													
												</div>
											</div>
											<?php $counter++;?>
										<?php endforeach;?>
										
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	jQuery(document).ready(function($){
		
	});
</script>
