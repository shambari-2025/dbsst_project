<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бейджики</title>
    <style>
        .badge {
            width: 91mm;
            height: 65mm;
            border: 1px solid black;
            margin-right: 10px;
			margin-top: 10px;
            margin-bottom: 10px;
            display: inline-block; /* Определяет, как элемент будет выравниваться */
            background-size: cover;
            background-position: center;
			position: relative;
			text-align: center;
        }
		
		.badge .badge-text {
			position: absolute;
			top: 5mm; /* Высота от верхнего края */
			left: 0;
			right: 0;
			font-size: 11px; /* Размер текста */
			font-weight: bold; /* Жирный шрифт */
			color: blue;
		}
		.badge .badge-text::after {
			content: "";
			display: block;
			width: 80%;
			height: 2px;
			background-color: blue;
			margin-top: 5px; /* Расстояние между текстом и линией */
			transform: translateX(10%);
		}
		.badge .badge-photo {
			position: absolute;
			bottom: 2mm; /* Расстояние от нижнего края */
			left: 2mm; /* Расстояние от левого края */
			width: 33mm; /* Ширина изображения */
			height: 44mm; /*  высота */
		}
		
		.badge .badge-text-right {
			position: absolute;
			top: 20mm; /* Расстояние от верхнего края бейджика */
			left: calc(5mm + 30mm + 5mm); /* Расстояние от левого края изображения */
			text-align: center;
			font-size: 11px;
			font-weight: bold;
			color: blue;
			width: calc(100% - (5mm + 40mm + 5mm)); /* Ширина текста справа от изображения */
		}
		.badge .badge-text-bottom {
			position: absolute;
			top: 30mm; /* Расстояние от верхнего края бейджика */
			left: calc(5mm + 30mm + 5mm); /* Расстояние от левого края изображения */
			text-align: center;
			font-size: 11px;
			font-weight: bold;
			color: red;
			width: calc(100% - (5mm + 40mm + 5mm)); /* Ширина текста справа от изображения */
		}
		.badge .badge-text-bottom1 {
			position: absolute;
			top: 35mm; /* Расстояние от верхнего края бейджика */
			left: calc(1mm + 30mm + 5mm); /* Расстояние от левого края изображения */
			text-align: center;
			font-size: 9px;
			font-weight: bold;
			color: black;
			width: calc(100% - (5mm + 30mm + 5mm)); /* Ширина текста справа от изображения */
		}
		.badge .badge-text-bottom2 {
			position: absolute;
			bottom: 5mm; /* Расстояние от нижнего края бейджика */
			right: 5mm; /* Расстояние от правого края бейджика */
			text-align: right;
			font-size: 20px;
			color: red;
			font-weight: bold;
		}
        .row::after {
            content: "";
            display: table;
            clear: both;
        }

        /* Добавьте дополнительные правила для других бейджиков при необходимости */
       
		@media print {
			table, td, tr {
				-webkit-print-color-adjust: exact; /* Для Chrome и Safari */
				background-color: transparent !important;
			}
		}
		
		table {
			page-break-after: always; /* Разрыв страницы после каждой таблицы */
		}

		/* Убираем пустую последнюю страницу */
		table:last-of-type {
			page-break-after: auto;
		}
		
		
		.bold {
			font-weight: bold;
		}
		.center {
			text-align: center;
		}
    </style>
</head>
<body style="margin: 0px; padding: 0px">
    
	<!-- Повторите этот блок для каждой строки -->
	<?php foreach($_SESSION['superarr'][$id_faculty]['level'][$id_s_l]['view'][$id_s_v]['course'] as $c_item):?>
		<?php $id_course = $c_item['id'];?>
		
		
		<?php foreach($c_item['spec'] as $s_item):?>
			<?php $id_spec = $s_item['id'];?>
			
			<?php foreach($s_item['groups'] as $g_item):?>
				<?php $id_group = $g_item['id'];?>
				
				<?php
				/* Баровардани контингенти гурух */
				$students = query("SELECT `students`.*, `users`.* FROM `users`
				INNER JOIN `students` ON `students`.`id_student` = `users`.`id` 
				WHERE `students`.`status` = '1'
				AND `students`.`id_faculty` = '$id_faculty' 
				AND `students`.`id_s_l` = '$id_s_l' 
				AND `students`.`id_s_v` = '$id_s_v' 
				AND `students`.`id_spec` = '$id_spec' 
				AND `students`.`id_course` = '$id_course'
				AND `students`.`id_group` = '$id_group'
				AND `students`.`s_y` = '$S_Y' AND 
				`students`.`h_y` = '$H_Y'
				ORDER BY `users`.`fullname_tj`
				");
				/* Баровардани контингенти гурух */
				?>
			   <?php foreach($students as $std):?>
				   <?php $id_student = $std['id'];?>
				   
				   <?php $first = query("SELECT `s_y` FROM `students` WHERE `id_student` = '$id_student' ORDER BY `s_y` ASC");?>
				   
					<table style="width: 86mm; height: 55mm; font-size: 12px; margin-bottom: 14px; color: #000;">
						<tbody>
							<tr>
								<td colspan="4" class="center bold" style="
								vertical-align: middle; height: 42px;
								font-size: 13px;text-shadow: 2px 1px #ffffff;
								background-image: url('../modules/print/views/bejik/header_bj.png');-webkit-print-color-adjust: exact;print-color-adjust: exact;background-size: cover;background-position: bottom;">
									<?=UNI_NAME?> <br /> <?=getFacultyShort($std['id_faculty'])?>
								</td>
							</tr>
							<tr>
								<td rowspan="6" style="vertical-align: bottom; width: 2cm; height: 2.5cm;">
									<?php $photo = getUserImg($std['id'], $std['jins'], $std['photo']);?>
									<?php if($std['photo']):?>
										<img style="width: 2cm; height: 2.5cm;" src="/userfiles/students/<?=$std['photo'];?>">
									<?php endif;?>
								</td>
								<td>Ному насаб:</td>
								<td class="bold" colspan="2" style="height: 32px"><?=$std['fullname_tj']?></td>
							</tr>
							<tr>
								<td style="width: 25%; height: 18px;">ID донишҷӯ:</td>
								<td class="bold" style="width: 25%; height: 18px;"><?=$id_student?></td>
								<td rowspan="5" style="vertical-align: bottom">
									<?php
										// Путь и имя файла, в который нужно сохранить QR-код
										$file = $_SERVER['DOCUMENT_ROOT']."/userfiles/qr-bejik/$id_student.png";
										if(!file_exists($file)){
											$link = "http://asu.tut.tj/info.php?id_student=$id_student";
											// Размер QR-кода в пикселях
											$size = 4;
											// Генерируем QR-код и сохраняем его в файл
											QRcode::png($link, $file, QR_ECLEVEL_Q, $size);
										}
									?>
									<img style="width: 2cm" src="<?=URL?>userfiles/qr-bejik/<?=$id_student?>.png">
								</td>
							</tr>
							
							<tr>
								<td>Гурӯҳ:</td>
								<td class="bold" style="font-size: 11px;"><?=getSpecialtyCode($std['id_spec'])?><?=getGroup2($std['id_group'])?></td>
							</tr>
							<tr>
								<td>Шакли таҳсил:</td>
								<td class="bold"><?=getStudyView($std['id_s_v'])?></td>
							</tr>
							<tr>
								<td>Дохилшавӣ:</td>
								<td class="bold">20<?=$first[0]['s_y']?></td>
							</tr>
							<tr>
								<td>Рақами корт:</td>
								<td class="bold"><?=$std['login']?></td>
							</tr>
							<tr style="font-size: 10px; height: 20px">
								<td class="center" colspan="4"
								style="background-image: url('../modules/print/views/bejik/line.jpg');-webkit-print-color-adjust: exact;print-color-adjust: exact;background-size: cover;background-position: revert;"
								>
								Санаи чопи корт: 01/09/20<?=$first[0]['s_y']?> Муҳлати эътибори корт то: 01/09/20<?=($first[0]['s_y']+4)?>
								</td>
							</tr>
						</tbody>
					</table>
				<?php endforeach;?>
				
			<?php endforeach;?>
		<?php endforeach;?>
		
		
		
	<?php endforeach;?>
	
    <!-- Повторите этот блок для остальных строк -->
</body>
</html>
