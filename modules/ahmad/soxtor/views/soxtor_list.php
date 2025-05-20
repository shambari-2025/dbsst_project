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
							Сохтор
						</li>
						<li class="breadcrumb-item">
							Иерархияи сохтори донишгоҳ 
						</li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						
						<!-- Large modal -->
						<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-lg" style="max-width: 80%;">
								<div class="modal-content">
									<div class="modal-header">
										<h6 class="modal-title" id="myModalLabel"></h6>
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
									</div>
									<div class="modal-body" id="bigmodal">
										
									</div>
								</div>
							</div>
						</div>
						<!-- Large modal -->
						
						<div class="col-xl-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5>Иэрархияи сохтори донишгоҳ</h5>
								</div>
								<div class="card-block">
									<!--<button data-toggle="modal" data-target=".bs-example-modal-lg" class="add btn btn-inverse waves-effect waves-light" type="button" style="float: right">
										<a data-toggle="modal" data-target=".bs-example-modal-lg" class="add davrifaol" href="javascript:">
											<i class="fa fa-plus"></i> Иловакунӣ
										</a>
									</button>-->
									<div style="clear:both"></div>
									<hr>
									<div class="table-responsive davrifaol">
										<!--PHP Script-->
										<?php
											// Ваш массив категорий
											$category_arr = query("SELECT * FROM `structure` WHERE `deleted`=0 ORDER BY `pos`");
											//print_arr($category_arr);

											// Функция формирует массив, где ключи - это родительские идентификаторы
											function groupByParentId($array) {
												$result = array();
												foreach ($array as $item) {
													$result[$item['pid']][] = $item;
												}
												return $result;
											}

											// Группируем категории по родительским идентификаторам
											$grouped_categories = groupByParentId($category_arr);

											/**
											 * Функция для вывода древовидной структуры в виде таблицы HTML
											 * @param Integer $parent_id - id-родителя
											 * @param Integer $level - уровень вложености
											 * @param Array $category_arr - массив категорий
											 */
											function printTable($parent_id, $level, $category_arr) {
												if (isset($category_arr[$parent_id])) {
													foreach ($category_arr[$parent_id] as $value) {
														echo "<tr>";
														echo "<td>".$value['id']."</td>";
														echo "<td class=\"left\" style='padding-left:" . ($level * 25) . "px;'>" . $value["name"] . "</td>";
														echo "<td class=\"elements\">";
															echo "<a class=\"edit_test\" href=".MY_URL."?option=soxtor&action=soxtor_edit&id=".$value['id'].''. "\title=\"Таҳриркунии ҳамин сохтор\"><i class=\"fa fa-edit\"></i> </a>";
															echo "<a class=\"edit_test\" href=".MY_URL."?option=soxtor&action=soxtor_add&id=".$value['id'].''. "\title=\"Иловакунӣ ба ҳамин сохтор\"><i class=\"fa fa-plus\"></i> </a>";
															echo "<a class=\"edit_test\" href=".MY_URL."?option=soxtor&action=soxtor_delete&id=".$value['id'].''. "\title=\"Несткунӣ\"><i class=\"fa fa-trash\"></i> </a>";
														echo "</td>";
														echo "</tr>";
														printTable($value["id"], $level + 1, $category_arr);
													}
												}
											}

											// Выводим начало таблицы
											echo "<table class=\"table\" style=\"font-size: 14px !important\">";
												echo "<thead class=\"center\">";
													echo "<tr style=\"background-color: #263544; color: #fff\">";
														echo "<th class=\"counter\">ID</th>";
														echo "<th class=\"center\">Номи сохтор</th>";
														echo "<th>Амалҳо</th>";											
													echo "</tr>";
												echo "</thead>";
												echo "<tbody class=\"center\" id=\"tbody\">";

											// Начинаем вывод с родительского элемента
												printTable(0, 0, $grouped_categories);

											// Завершаем таблицу
												echo "</tbody>";
											echo "</table>";


											
												
											
											//print_arr($datas);
											/*
											$data=query("SELECT * FROM `structure` WHERE `deleted`=0 ORDER BY `pos`");
											//теперь создаем массив в виде дерева
											$tree = array();
											foreach ($data as $row) {
												$tree[(int) $row['pid']][] = $row;
											}

											//ну и рекурсивная функция для вывода дерева
											function treePrint($tree, $pid=0) {
												if (empty($tree[$pid]))
													return;
												echo '<ul>';
												foreach ($tree[$pid] as $k => $row) {
													echo '<li>';
													echo $row['name'];
													if (isset($tree[$row['id']]))
														treePrint($tree, $row['id']);
													echo '</li>';
												}
												echo '</ul>';
											}

											//вызов функции
											treePrint($tree);
											*/
										?>
										<!--PHP Script-->
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
		
		$('.add').on('click', function(){
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Иловакунии факултет");
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=addForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"file": "facultet_add", "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
		
		$('.edit').on('click', function(){
			var id = $(this).attr("data-id");
			
			$('.modal-dialog').css("max-width", "60%");
			$('.modal-title').text("Таҳриркунӣ");
			$('#bigmodal').html('<div class="load"></div>');
			
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/{$option}/{$option}_ajax.php?option=editForm";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"file": "facultet_edit", "id": id, "my_url": my_url},
				beforeSend: function(){
					$('#bigmodal').html('<center><img class="loading" style="width:64px" src="<?=TMPL_URL?>gif/loading-6.gif" alt="Loading"></center>');
				},
				success: function(data){
					$('#bigmodal img').hide();
					$('#bigmodal').html(data);
				}
			});
			$('#bigmodal').html("");
			
		});
	});
</script>
