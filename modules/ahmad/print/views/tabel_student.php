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
		
		
		table {
			width: 100%;
			border: none;
			border-collapse: collapse;
			font-size:14px;
		}
		
		th, td {
			border: 0px solid;
			padding:4px 6px 4px; 
			//text-align:center; 
		}
		
		.box {
			height: 700px;
			page-break-inside: avoid;
			border: 1px solid #fff;
		}
		
		@page {
			size: landscape;
		}
	</style>
	
	<body>
		
		<?php if(isset($_REQUEST['id_student'])):?>
		
		<table>
			<tr>
				<td style="width: 50%">
					
					<table border="1">
						<tr>
							<td style="width: 3cm; height:4cm; border: 1px solid" class="center">
								Расми 3х4
								
							</td>
							<td>
								<p class="bold" style="text-align: center;">
									Факултети <?=getFaculty($student[0]['id_faculty'])?>
								</p>
								
								<p>
									<em>Курси <?=$student[0]['id_course']?> ихтисоси 
									<?=getSpecialtyCode($student[0]['id_spec'])?> "<?=getGroup2($student[0]['id_group'])?>" </em>
								</p>
								
								<?php $name = explode(" ", $student[0]['fullname_tj']);?>
						
								<?php if(count($name) == 3):?>
									Насаб: <?=str_repeat("&nbsp;", 14)?> <span class="bold"><?=$name[0]?></span><br>
									Ном: <?=str_repeat("&nbsp;", 18)?> <span class="bold"><?=$name[1]?></span><br>
									Номи падар: <?=str_repeat("&nbsp;", 2)?> <span class="bold"><?=$name[2]?></span><br>
								<?php else:?>
									Насаб: <?=str_repeat("&nbsp;", 14)?> <span class="bold"><?=$name[0]?></span><br>
									Ном: <?=str_repeat("&nbsp;", 18)?> <span class="bold"><?=$name[1]?></span><br>
								<?php endif;?>
							</td>
						</tr>	
						<tr>	
							<td colspan="2">
								<p>Суроға: 
								<?php if(!empty($student[0]['current_address'])):?>
									<span style="text-decoration: underline"><?=$student[0]['current_address']?></span>
								<?php else:?>
									________________________________________________
								<?php endif;?>
								</p>
								Рақами телефон: 
								<?php if(!empty($student[0]['phone'])):?>
									<span style="text-decoration: underline"><?=$student[0]['phone']?></span>
								<?php else:?>
								______________________________________
								<?php endif;?>
								
								
								<p style="text-align:center">ШАКЛИ ТАҲСИЛ:  
									<?php if($student[0]['id_s_t'] == "1"):?>
										Шартномавӣ
									<?php elseif($student[0]['id_s_t'] == "2"):?>
										Буҷавӣ
									<?php elseif($student[0]['id_s_t'] == "3"):?>
										Квота
									<?php endif;?>
								</p>
							</td>
						</tr>
					</table>
					
					
				</td>
				
				<td style="width: 50%; vertical-align: top">
					<table border="1">
						<tr>
							<td colspan="3">
								<p class="center">Сессияи <b>зимистонаи</b> соли тахсили 2022-2023</p>
								<p align="center"><em><b>Барои ба сессияи-имтиҳонӣ рухсат гирифтан, имзоҳои зеринро гирифтан лозим аст:</b></em></p>
							</td>
						</tr>
						
						<tr>
							<?php if($student[0]['id_s_t'] == "1"):?>
								<td>Муҳосибот</td>
								<td class="center">_________________</td>
								<td>Маҳмадов М.</td>
							<?php endif;?>
						</tr>
						
					</table>
				</td>
			</tr>
		</table>
		<?php else:?>
		
			<?php $counter = 1;?>	
			<?php foreach($students as $item):?>

				<?php if($counter % 2 != 0):?>
				<div class="box">
				<?php endif;?>
				
					<table>
						<tr>
							<td style="width: 50%">
								
								<table border="1">
									<tr>
										<td style="width: 3cm; height:4cm; border: 1px solid" class="center">
											<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo']);?>
											<img src="<?=$photo;?>" style="width: 3cm; height:4cm;">
										</td>
										<td>
											<p class="bold" style="text-align: center;">
												Факултети <?=getFaculty($item['id_faculty'])?>
											</p>
											
											<p>
												<em>Курси <?=$item['id_course']?> ихтисоси 
												<?=getSpecialtyCode($item['id_spec'])?> "<?=getGroup2($item['id_group'])?>" </em>
											</p>
											
											<?php $name = explode(" ", $item['fullname_tj']);?>
									
											<?php if(count($name) == 3):?>
												Насаб: <?=str_repeat("&nbsp;", 14)?> <span class="bold"><?=$name[0]?></span><br>
												Ном: <?=str_repeat("&nbsp;", 18)?> <span class="bold"><?=$name[1]?></span><br>
												Номи падар: <?=str_repeat("&nbsp;", 2)?> <span class="bold"><?=$name[2]?></span><br>
											<?php else:?>
												Насаб: <?=str_repeat("&nbsp;", 14)?> <span class="bold"><?=$name[0]?></span><br>
												Ном: <?=str_repeat("&nbsp;", 18)?> <span class="bold"><?=$name[1]?></span><br>
											<?php endif;?>
										</td>
									</tr>	
									<tr>	
										<td colspan="2">
											<p>Суроға: 
											<?php if(!empty($item['current_address'])):?>
												<span style="text-decoration: underline"><?=$item['current_address']?></span>
											<?php else:?>
												________________________________________________
											<?php endif;?>
											</p>
											Рақами телефон: 
											<?php if(!empty($item['phone'])):?>
												<span style="text-decoration: underline"><?=$item['phone']?></span>
											<?php else:?>
											______________________________________
											<?php endif;?>
											
											
											<p style="text-align:center">ШАКЛИ ТАҲСИЛ:  
												<?php if($item['id_s_t'] == "1"):?>
													Шартномавӣ
												<?php elseif($item['id_s_t'] == "2"):?>
													Буҷавӣ
												<?php elseif($item['id_s_t'] == "3"):?>
													Квота
												<?php endif;?>
											</p>
										</td>
									</tr>
								</table>
								
								
							</td>
							
							<td style="width: 50%; vertical-align: top">
								<table border="1">
									<tr>
										<td colspan="3">
											<p class="center">Сессияи <b>зимистонаи</b> соли тахсили 2022-2023</p>
											<p align="center"><em><b>Барои ба сессияи-имтиҳонӣ рухсат гирифтан, имзоҳои зеринро гирифтан лозим аст:</b></em></p>
										</td>
									</tr>
									
									<tr>
										<?php if($item['id_s_t'] == "1"):?>
											<td>Муҳосибот</td>
											<td class="center">_________________</td>
											<td>Маҳмадов М.</td>
										<?php endif;?>
									</tr>
									
								</table>
							</td>
						</tr>
					</table>
					<br>
					<?php if($counter % 2 != 0):?><hr><?php endif;?>
					<br>
				<?php if($counter % 2 == 0):?>
				</div>
				<?php endif;?>

				<?php $counter++;?>
			<?php endforeach;?>
			
		
		<?php endif;?>
	
	</body>
	
</html>