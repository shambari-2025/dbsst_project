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
	</head>
	
	<style>
		* {
			font-family: "Palatino Linotype";
		}
		p {
			margin: 0;
			padding: 4px;
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:15px">
		<div class="col-xl-12 col-md-12">
			<div class="card-block">

			</div>
		</div>
		
		
		<h2 class="center">Натиҷаҳои имтиҳонӣ аз фанни "<?=getFanTest($id_fan)?>" дар курси <?=$id_course?>, ихтисоси <?=getSpecialtyCode($id_spec)?><?=getGroup2($id_group)?> дар соли таҳсили 20<?=$S_Y?>-20<?=$S_Y+1?>, нимсолаи <?=$H_Y?></h2>
		
		<div class="floatleft">
			<table class="table transcript" style="width:100%; font-size:15px">
				<thead>
					<tr>
						<th>№</th>
						<th>ID</th>
						<th>Ному насаби донишҷӯ</th>
						<th>Холи имтиҳонӣ</th>
					</tr>
				</thead>
				<tbody>
					<?php $counter = 0;?>
					<?php foreach($students as $student):?>
						<?php $id_student = $student['id']?>
						<tr>
							<td class="center" style="width: 20px"><?=++$counter?></td>
							<td class="center"><?=$id_student?></td>
							<td><?=$student['fullname_tj']?></td>
							<td class="center"><?=getImt($id_student, $id_fan, $S_Y, $H_Y)?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</body>
	
</html>