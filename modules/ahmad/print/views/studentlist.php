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
			//font-family: "Palatino Linotype";
		}
		p {
			margin: 0;
			padding: 3px;
		}
		
		@page {
			
		}
	</style>
	
	<body style="width:94%; margin: 15px auto 0 auto; font-size:14px">
		<h3 class="center">
			Руйхати донишҷӯёни
			факултети <?=getFaculty($id_faculty)?>,<br>
			шакли таҳсил <?=getStudyView($id_s_v)?>,
			<?=getCourse($id_course)?>,
			<?=getSpecialtyCode($id_spec)?>,
			<?=getGroup($id_group)?>
		</h3>
		
		
		<table class="table transcript" style="width:800px; font-size:14px; margin: 0 auto">
			<thead>
				<tr>
					<th class="center" style="width: 30px">№<br>р/т</th>
					<th class="center" style="width: 50px">ID донишҷӯ</th>
					<th class="center" style="width: 300px">Ному насаби донишҷӯ</th>
					<th class="center" style="width: 150px">Курс</th>
					<th class="center" style="width: 150px">Гурӯҳ</th>
					<th class="center" style="width: 150px">Шакли<br>таҳсил</th>
					<th class="center" style="width: 150px">Ҷойи <br>таваллуд</th>
					<th class="center" style="width: 150px">Ҷойи <br>таистиқомат</th>
					<th class="center" style="width: 200px">Телефон</th>
					<th class="center" style="width: 200px">Телефони волидайн</th>
					<th class="center" style="width: 200px">Вазъи иҷтимоӣ</th>
					
					
					
				</tr>
			</thead>

			<tbody>
				<?php $counter = 0;?>
				<?php foreach($students as $item):?>
					<tr>
						<td class="center"><?=++$counter?>.</td>
						<td style="width: 50px"><?=$item['id']?></td>
						<td style="width: 300px"><?=$item['fullname_tj']?></td>
						<td class="center">1</td>
						<td class="center"><?=getSpecialtyCode($item['id_spec'])?><?=getGroup2($item['id_group'])?></td>
						<td class="center"><?=mb_strcut(getStudyType($item['id_s_t']), 1, 2)?></td>
						<td class="center"><?=mb_strcut(getStudyType($item['id_s_t']), 1, 2)?></td>
						<td class="center"><?=mb_strcut(getStudyType($item['id_s_t']), 1, 2)?></td>
						
						<td class="center">
							<?php if(!empty($item['phone'])):?>
								<?php $phones = explode(" ", $item['phone']);?>
								<?php foreach($phones as $ph):?>
									<?=$ph?><br>
								<?php endforeach;?>
							<?php else:?>
								<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
							<?php endif;?>
						</td>
						<td class="center">
							<?php if(!empty($item['phone_parents'])):?>
								<?php $phones = explode(" ", $item['phone_parents']);?>
								<?php foreach($phones as $ph):?>
									<?=$ph?><br>
								<?php endforeach;?>
							<?php else:?>
								<span class="red"><i class="fa fa-warning"></i> Маълумот нест</span>
							<?php endif;?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<br>
		<br>
		<br>
		<br>
		
		
	</body>
	
</html>