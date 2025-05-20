<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$page_info['title']?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="author" content="colorlib" />
		
		<!--<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/my_style.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/davrifaol.css">-->
	</head>
	<style>
		body *{
			font-family:"Times New Roman", Times, serif;
		}
		@media print {
			.more {
			 page-break-after: always;
			} 
		   } 

		.vdtab{
			border:none;
			border-bottom:#333 solid 1px;
			border-right:#333 solid 1px;
			word-wrap: break-word;
		}
		.vdtab th{
			border-left:#333 solid 1px;
			border-top:#333 solid 1px;
			word-wrap: break-word;
			
		}

		.joy {
			margin: -28px;
			width: 90px;
			height: 83px;
			padding-top: 50px;
		}

		.zagalovok{
			transform: rotate(-90deg);
			/*
			border:1px solid red;*/
			width:85px;
			text-align:center;
			font-size:13px;
		}
		.joy1 {
			margin: 0px;
			width: 74px;
			height: 42px;
			padding-top:0px;
		}

		.zagalovok1{
			transform: rotate(-90deg);
			/*
			border:1px solid red;*/
			width:74px;
			text-align:center;
			font-size:13px;
		}

		.joyk {
			margin: -28px;
			width: 80px;
			height: 80px;
			padding-top: 69px;
		}

		.zagalovokk{
			transform: rotate(-90deg);
			/*
			border:1px solid red;*/
			width:80px;
			text-align:center;
			font-size:13px;
		}
		.tblll{
			border-left:1px solid black;
			border-top:1px solid black;
		}
		.tblll th{
			border-bottom:1px solid black;
			border-right:1px solid black;
		}
		.tblll td{
			border-bottom:1px solid black;
			border-right:1px solid black;
		}
		.tabl{
			border:none;
			border-left:#333 solid 1px;
			border-right:#333 solid 1px;
			word-wrap: break-word;
		}
		.tabl1{
			border:none;
			border-left:#333 solid 0px;
			border-right:#333 solid 0px;
			border-top:#333 solid 0px;
			border-bottom:#333 dashed 0px;
			word-wrap: break-word;
		}

		.table{

		border-bottom:#000000 1px solid;
		border-top:#000000 1px solid;
		border-left:#000000 1px solid;
		}

		.vdtab td{
			border-left:#333 solid 1px;
			border-top:#333 solid 1px;
			word-wrap: break-word;
		}
		.bold{
			font-weight:bold;
			}
		.bgcol{
			background:#666;
			color:#FFF;
			}
		.field{
			font-size:14px;
			font-weight:bold;
			padding-left:10px;
			padding-right:4px;
			color:#333;
			}
		.value{
			font-size:13px;
			font-style:italic;
			padding-right:5px;
			}
		.h3{font-weight:bold; font-size:18px;}
		.h5{font-weight:bold; font-size:15px;}
		.commons{
		position:fixed;
		background:#CCC;
		margin:0 0 0 300px;
		/*border:1px solid black;*/
		}

		.text_uch_plan{
			border:0px solid black;
			text-align:center;
			width:100%;
			padding-bottom:5px;
		}
		.text_uchplan{
			font-family:"Palatino Linotype";
			font-weight:bold;
			font-size:18px;
			
		}

		#id_th{
		font-size:14px;
			font-weight:bold;
			padding-left:10px;
			padding-right:4px;
			color:#000000;
			font-family:"Palatino Linotype", Times, serif;
		}
		.danih{
		font-size:16px;
			padding-left:2px;
			color:#000000;
			font-family:Palatino Linotype;
			
			text-decoration:underline;
		}
		.danih4{
		font-size:17px;
			padding-left:2px;
			color:#000000;
			font-family:"Palatino Linotype", Times, serif;
			border:0px;
			text-decoration:underline;
		}
		#mablagg{
		font-size:16px;
			padding-left:2px;
			color:#000000;
			font-family:"Palatino Linotype", Times, serif;
			border:0px;
			text-decoration:underline;
		}

		#str_sum_conv{
		font-size:17px;
			padding-left:2px;
			color:#000000;
			font-family:"Palatino Linotype", Times, serif;
			border:0px;
			text-decoration:none;
		}

		.danih1{
		font-size:16px;
			color:#000000;
			font-family:"Palatino Linotype", Times, serif;
		}
		.gb{
		padding-left:90px;
		font-size:15px;
			font-weight:bold;
			color:#000000;
			font-family:"Times New Roman", Times, serif;
		}

		.zag{
		text-align:right;
		font-size:11px;
			font-weight:bold;
			color:#000000;
			font-family:"Times New Roman", Times, serif;
			text-decoration:underline;
		}
		.gb1{
		font-size:15px;
			font-weight:bold;
			color:#000000;
			font-family:"Times New Roman", Times, serif;
		}
		.tit{
		font-size:11px;
			
			color:#000000;
			font-family:"Palatino Linotype", Times, serif;
		}

		.tit26{
		font-size:14px;
			
			color:#000000;
			font-family:"Palatino Linotype", Times, serif;
		}
		.tit1{
		font-size:11px;
			border-right:#000000 1px solid;
			color:#000000;
			font-family:"Palatino Linotype", Times, serif;
		}
		.tit2{
		font-size:12px;
			border-right:#000000 1px solid;
			border-top:#000000 1px solid;
			color:#000000;
			font-family:"Palatino Linotype", Times, serif;
		}
		.osoish{
		font-size:17px;
			
			color:#000000;
			font-family:"Palatino Linotype", Times, serif;
		text-decoration:underline;
			}

		.textZag{
			font-size:16px;
			font-family:Palatino Linotype;
			font-weight:bold;
			/*border:1px solid red;*/
			width:660px;
			
		}
			
		.strok_td{
			height:35px;
			border-top:#000000 1px solid ;
			text-decoration:none;
		}

		.strok_td1{
			height:35px;
			border-bottom:#000000 1px solid ;
			text-decoration:none;
		}

		.prih{
		font-size:17px;
			font-weight:bold;
			color:#000000;
			font-family:"Times New Roman", Times, serif;
		}


		.Okud{
		font-family:"Times New Roman", Times, serif;
		font-size:18px;
		font-weight:bold;
		border:#000000 1px solid;
		width:80px;



		}




		.prih1{
		font-size:18px;
			font-weight:bold;
			color:#000000;
			font-family:"Times New Roman", Times, serif;
			text-align:center;
		}

		.burish{
			color:#000000;
		/*border:1px solid black;*/
		-moz-transform:rotate(-90deg); /* Firefox */
		  -webkit-transform:rotate(-90deg); /* Webkit */        
		  -ms-transform:rotate(-90deg); /* IE */
		  -o-transform:rotate(-90deg); /* Opera */
		  transform:rotate(-90deg); /* future */
		  position:absolute;
		  padding-top:10px;
		  margin-left:-112px;
		  width:220px;
		  height:7px;
		  font-size:13px;
		  font-family:Times New Roman;
		font-weight:bold;
		text-align:center;
		}

		#sum_conv{
			border:0px;
			
			
		}
	</style>
	
	<body>
		<table border="0" width="670" align="center" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
				  <th align="center">
					<span style="font-size:21px;"><?=UNI_NAME?></span>
				  </th>
				</tr>
				<tr>
				  <th align="center">
					<p><?=UNI_NAME_RU?></p>
				  </th>
				</tr>
				<tr>
				  <th align="center">
					<br>
					<p>&nbsp;</p>
				  </th>
				</tr>
				<tr>
				  <td align="center" style="border-bottom:1px solid black;font-size:18px;">Факултети <?=mb_strtolower(getFaculty($id_faculty))?></td>
				</tr>
				<tr>
				  <th align="center">
					<br>&nbsp;
				  </th>
				</tr>
				<tr>
				  <td align="center" style="border-bottom:1px solid black;">Факултети <?=mb_strtolower(getFaculty($id_faculty))?></td>
				</tr>
				<tr>
				  <td>
					<br>
					<p></p>
					<table border="0" align="right" width="100%">
					  <tbody>
						<tr>
						  <td align="right" valign="top">
							<span style="font-size:18px;">Варақаи шахсии</span>
							<br>Личное дело
						  </td>
						  <td align="left" valign="top" width="110">
							<div style="padding-top:6px;padding-left:6px;">
							  <span style="border-bottom:1px solid black;">№<?=$id_student;?></span>
							</div>
						  </td>
						  <td width="200" height="190" align="right">
							<div id="foto_diseb">
							  <img src="../userfiles/students/<?=$userinfo[0]['photo'];?>" style="width:200px; max-height:190px; height:auto; border-radius:6px; -moz-border-radius: 6px; -webkit-border-radius: 6px;">
							</div>
						  </td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr>
				  <td align="center">
					<br>
					<p>
					  <br>
					  <span style="font-size:18px; font-weight:bold;">ВАРАҚАИ ШАХСИИ ДОНИШҶӮ</span>
					  <br>
					  <span style="font-size:16px;font-weight:bold;">ЛИЧНОЕ ДЕЛО СТУДЕНТА</span>
					  <br>
					</p>
					<p>
					  <br>
					</p>
				  </td>
				</tr>
				<tr>
				  <td style="border-bottom:1px solid black; text-align:center;"><?=getUserName($id_student)?></td>
				</tr>
				<tr>
				  <td align="center" valign="top">(ному насаби донишҷӯ) <br>
					<span style="font-size:14px;">(ф.и.о. студента)</span>
				  </td>
				</tr>
				<tr>
				  <td align="right">
					<br>
					<p>
					  <br>
					</p>
					<table border="0" width="90%">
					  <tbody>
						<tr>
						  <td style="border-bottom:1px solid black; text-align:center;"><?=getSpecialtyCode($id_spec)?> - <?=getSpecialtyTitle($id_spec)?></td>
						</tr>
						<tr>
						  <td align="center" valign="top">(Ихтисос) <br>
							<span style="font-size:14px;">(Специальность)</span>
						  </td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr>
				  <td align="right">
					<br>
					<p></p>
					<table border="0" width="45%">
					  <tbody>
						<tr>
						  <td width="100">шакли таҳсил:</td>
						  <td style="border-bottom:1px solid black;"><?=getStudyView($id_s_v)?>-<?=getStudyType($id_s_t)?></td>
						</tr>
						<tr>
						  <td colspan="2" align="left">
							<span style="font-size:14px;">(вид обучение)</span>
						  </td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr>
				  <td align="center">
					<br>
					<p>
					  <br>
					</p>
					<p>Душанбе - 20<?=$year?></p>
				  </td>
				</tr>
				<tr height="35">
				  <td>
					<p class="more"></p>
					<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <th align="right" width="110">1.&nbsp;Ному насаб:</th>
						  <td style="border-bottom:1px solid black;">&nbsp;<?=getUserName($id_student)?></td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr>
				  <th align="left">
					<div style="margin:-3px;padding-left:24px;padding-bottom:2px;font-size:12px; border:0px solid black;">Ф.И.О.:</div>
				  </th>
				</tr>
				<tr height="35">
				  <td>
					<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <th align="right" width="185">2.&nbsp;Моҳ ва соли таваллуд:</th>
						  <td style="border-bottom:1px solid black;">&nbsp;<?=date('d.m.Y', strtotime($userinfo[0]['birthday']))?></td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr>
				  <th align="left">
					<div style="margin:-8px;padding-left:30px;padding-bottom:8px;font-size:12px; border:0px solid black;">Месяц и дата рождения:</div>
				  </th>
				</tr>
				<tr height="35">
				  <td>
					<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <th align="right" width="125">3.&nbsp;Ҷои таваллуд:</th>
						  <td style="border-bottom:1px solid black;">&nbsp;<?=getDistrict($userinfo[0]['id_district'])?></td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr>
				  <th align="left">
					<div style="margin:-8px;padding-left:30px;padding-bottom:8px;font-size:12px; border:0px solid black;">Место рождение:</div>
				  </th>
				</tr>
				<tr height="35">
				  <td>
					<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <th align="right" width="85">4.&nbsp;Миллат:</th>
						  <td style="border-bottom:1px solid black;">&nbsp;<?=getNation($userinfo[0]['id_nation'])?></td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr>
				  <th align="left">
					<div style="margin:-8px;padding-left:30px;padding-bottom:8px;font-size:12px; border:0px solid black;">Национальность:</div>
				  </th>
				</tr>
				<tr height="35">
				  <td>
					<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <th align="right" width="215">5.&nbsp;Кай ва куҷоро хатм намуд:</th>
						  <td style="border-bottom:1px solid black;font-size:14px;">&nbsp;<?=$userinfo[0]['soli_xatm'].", ".$userinfo[0]['muasisa_name']." ".$userinfo[0]['number_scholl']?></td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr>
				  <th align="left">
					<div style="margin:-8px;padding-left:30px;padding-bottom:8px;font-size:12px; border:0px solid black;">Когда и какой уч.заведение окончил:</div>
				  </th>
				</tr>
				<tr height="35">
				  <td>
					<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <th align="right" width="135">6.&nbsp;Ҷои истиқомат:</th>
						  <td style="border-bottom:1px solid black;">&nbsp; <?=$userinfo[0]['address']?></td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr>
				  <th align="left">
					<div style="margin:-8px;padding-left:30px;padding-bottom:8px;font-size:12px; border:0px solid black;">Место жительство:</div>
				  </th>
				</tr>
				<tr height="35">
				  <td>
					<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <th align="right" width="87">7.&nbsp;Телефон:</th>
						  <td style="border-bottom:1px solid black;width:280px;">&nbsp; <?=$userinfo[0]['phone']?></td>
						  <th align="right" width="100">E-mail.&nbsp;<?=$userinfo[0]['email']?></th>
						  <td style="border-bottom:1px solid black; width:200px;"></td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr height="35">
				  <td>
					<table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <th align="right" width="230">8.&nbsp;Ба Донишгоҳ бо фармони №:</th>
						  <td style="border-bottom:1px solid black;">&nbsp;</td>
						  <th align="right" width="20">&nbsp;аз&nbsp;</th>
						  <td width="200" style="border-bottom:1px solid black;">&nbsp;</td>
						  <th width="90" align="left">дохил шуд</th>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
				<tr>
				  <th align="left">
					<div style="margin:-8px;padding-left:28px;padding-bottom:8px;font-size:12px; border:0px solid black;">Зачислен в университет приказом от</div>
				  </th>
				</tr>
			</tbody>
		</table>
		<br>
		<table align="center" border="0" width="670" height="200">
			<tbody>
				<tr>
				  <td valign="top">
					<table border="0" width="670" class="tblll" align="center" cellspacing="0" cellpadding="0">
					  <tbody>
						<tr>
						  <th>Курс</th>
						  <th width="150">№ Фармон ва сана</th>
						  <th>Мазмуни фармон</th>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
					  </tbody>
					</table>
				  </td>
				</tr>
			</tbody>
			<br>
			<table border="0" align="center" width="670" cellspacing="0" cellpadding="0">
				<tbody>
					<tr>
					  <th colspan="3" align="left">Эзоҳ: <br>Примечание: <br>
					  </th>
					</tr>
					<tr>
					  <td width="400">
						<table border="0" width="100%" class="tblll" cellspacing="0" cellpadding="0">
						  <tbody>
							<tr>
							  <th colspan="4">Б А Ҳ О (О Ц Е Н К А)</th>
							</tr>
							<tr>
							  <th width="80">1(хол)</th>
							  <th width="70">2(ҳарфӣ)</th>
							  <th width="70">3(ададӣ)</th>
							  <th width="180">4(анъанавӣ)</th>
							</tr>
							<tr>
							  <td align="center">94,5-100</td>
							  <td align="center">А</td>
							  <td align="center">4,0</td>
							  <td rowspan="2" align="center">аъло (отлично)</td>
							</tr>
							<tr>
							  <td align="center">89,5-94,4</td>
							  <td align="center">А-</td>
							  <td align="center">3,67</td>
							</tr>
							<tr>
							  <td align="center">84,5-89,4</td>
							  <td align="center">В+</td>
							  <td align="center">3,33</td>
							  <td rowspan="3" align="center">хуб (хорошо)</td>
							</tr>
							<tr>
							  <td align="center">79,5-84,4</td>
							  <td align="center">В</td>
							  <td align="center">3,0</td>
							</tr>
							<tr>
							  <td align="center">74,5-79,4</td>
							  <td align="center">В-</td>
							  <td align="center">2,67</td>
							</tr>
							<tr>
							  <td align="center">69,5-74,4</td>
							  <td align="center">С+</td>
							  <td align="center">2,33</td>
							  <td rowspan="5" align="center">қаноатбахш (удовлетворительно)</td>
							</tr>
							<tr>
							  <td align="center">64,5-69,4</td>
							  <td align="center">С</td>
							  <td align="center">2,0</td>
							</tr>
							<tr>
							  <td align="center">59,5-64,4</td>
							  <td align="center">С-</td>
							  <td align="center">1,67</td>
							</tr>
							<tr>
							  <td align="center">54,5-59,4</td>
							  <td align="center">Д+</td>
							  <td align="center">1,33</td>
							</tr>
							<tr>
							  <td align="center">49,5-54,4</td>
							  <td align="center">Д</td>
							  <td align="center">1,0</td>
							</tr>
							<tr>
							  <td align="center">0-49,4</td>
							  <td align="center">F</td>
							  <td align="center">0</td>
							  <td align="center">ғайриқаноатбахш (неудовлетворительно)</td>
							</tr>
						  </tbody>
						</table>
					  </td>
					  <td width="10"></td>
					  <td valign="top" width="240">
						1. Сутуни 1- ифодаи баҳо бо холҳо <br>&nbsp;&nbsp;&nbsp;&nbsp;Столбец 1- значение оценки в баллах <br> 2. Сутуни 2- ифодаи баҳо бо ҳарф <br>&nbsp;&nbsp;&nbsp;&nbsp;Столбец 2- буквенное значение оценки <br>3. Сутуни 3- эквиваленти ададии баҳо <br>&nbsp;&nbsp;&nbsp;&nbsp;Столбец 3- значение оценки <br>4. Сутуни 4- баҳо дар намуди анъанавӣ
					  </td>
					</tr>
				</tbody>
			</table>
		</table>
		<p class="more"></p>
		<div class="text_uch_plan">
			<span class="text_uchplan">Иҷрои нақшаи таълимӣ<br>Выполнение учебного плана</span>
		</div>
		<?php $all_counter = $all_credits = $all_CrZarbiAdad = $alo = $khub = $qanoatbakhsh = 0;?>
		<?php for($course = 1; $course <= $id_course; $course++):?>
			<?php 
				$H_Y = 1;
				$S_Y = query("SELECT `s_y` FROM `students` 
								WHERE `status` = 1 
									AND `id_student` = '$id_student'
									AND `id_course` = '$course'
									AND `h_y` = '$H_Y'
							"); 
				$S_Y = $S_Y[0]['s_y'];
				$id_semestr = getSemestr($course, $H_Y);
				$fanresults = query("SELECT `nt_content`.*, `results`.* FROM `results` INNER JOIN `nt_content`
										ON `nt_content`.`id_fan` = `results`.`id_fan`
										WHERE `nt_content`.`id_nt` = '$id_nt' 
											AND `nt_content`.`semestr` = '$id_semestr'
											AND `results`.`id_student` = '$id_student'
											AND `results`.`id_course` = '$course'
											AND `results`.`s_y` = '$S_Y'
											AND `results`.`h_y` = '$H_Y'
								");
			?>
			<!-- Аз инҷо поён дар дохили сикл меояд-->
			<?php if(!empty($fanresults)):?>
				<table border="0" align="center" width="670" height="410" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
						  <td colspan="9" style="text-align: right;vertical-align: bottom;"><?=getUserName($id_student)?></td>
						</tr>
						<tr>
						  <td valign="top">
							<table class="tblll" border="0" align="center" width="670" cellspacing="0" cellpadding="0">
							  <tbody>
								<tr>
								  <th colspan="9">Соли хониши <?=getStudyYear($S_Y)?>, нимсолаи <?=$H_Y?></th>
								</tr>
								<tr>
								  <th rowspan="2" width="10">
									<div class="joyk">
									  <div class="zagalovokk">Курс</div>
									</div>
								  </th>
								  <th rowspan="2" style="font-size:13px;">№</th>
								  <th rowspan="2" width="100" style="font-size:13px;">Санҷиши натиҷавӣ</th>
								  <th rowspan="2" style="font-size:13px;">Номгӯи фанҳо <br>Наименование дисциплин </th>
								  <th rowspan="2" width="40">
									<div class="joy1">
									  <div class="zagalovok1">Миқдори кредитҳо <br>Кол-во кредитов </div>
									</div>
								  </th>
								  <th colspan="4" style="font-size:13px;">Баҳо (Оценка)</th>
								</tr>
								<tr>
								  <th width="30">
									<div class="joy">
									  <div class="zagalovok">1(хол) <br>(бал) </div>
									</div>
								  </th>
								  <th width="30">
									<div class="joy">
									  <div class="zagalovok">2(ҳарфӣ) (буквенной)</div>
									</div>
								  </th>
								  <th width="30">
									<div class="joy">
									  <div class="zagalovok">3(ададӣ) (шифровое)</div>
									</div>
								  </th>
								  <th width="30">
									<div class="joy">
									  <div class="zagalovok">4(анъанавӣ) (обичные)</div>
									</div>
								  </th>
								</tr>
								<?php 
									$counter = 0;
									$credits = 0;
									$CrZarbiAdad = 0;
								?>
								<?php foreach($fanresults as $item):?>
									<tr>
									  <td align="center">
										<span style="font-size:11px;"><?=$course;?></span>
									  </td>
									  <td align="center">
										<span style="font-size:11px;"><?=++$counter;?></span>
									  </td>
									  <?php $taj_fans = array(34,35,36,1921,1922,2153,2546,2154);?>
									  <?php if(!in_array($item['id_fan'], $taj_fans)):?>
										  <td align="center">
											<span style="font-size:11px;">Имтиҳон</span>
										  </td>
									  <?php else:?>
										  <td align="center">
											<span style="font-size:11px;">Таҷрибаомӯзӣ</span>
										  </td>
									  <?php endif;?>
									  <td>
										<span style="font-size:11px;"><?=getFanTest($item['id_fan'])?></span>
									  </td>
									  <td align="center">
										<span style="font-size:11px;"><?=$item['c_u']?></span>
										<?php $credits+=$item['c_u'];?>
									  </td>
									  <?php
										if($item['total_score'] >= 50){
											$total_score = $item['total_score'];
										}else{
											$total_score = $item['trimestr_score'];
										}
										if($total_score >= 90){
											$alo++;
										}elseif($total_score >=75 && $total_score < 90){
											$khub++;
										}else{
											$qanoatbakhsh++;
										}
									  ?>
									  <td align="center">
										<span style="font-size:11px;"><?=$total_score?></span>
									  </td>
									  <td align="center">
										<span style="font-size:11px;"><?=getLatter($total_score)?></span>
									  </td>
									  <td align="center">
										<span style="font-size:11px;"><?=getAdad($total_score)?></span>
										<?php $CrZarbiAdad += $item['c_u'] * getAdad($total_score);?>
									  </td>
									  <td align="center">
										<span style="font-size:11px;"><?=getAnanavi($total_score)?></span>
									  </td>
									</tr>
									<?php if(!empty($item['kori_kursi'])):?>
										<tr>
										  <td align="center">
											<span style="font-size:11px;"><?=$course;?></span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;"><?=++$counter;?></span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;">Кори курсӣ</span>
										  </td>
										  <td>
											<span style="font-size:11px;"><?=getFanTest($item['id_fan'])?></span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;">0</span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;"><?=$item['kori_kursi']?></span>
										  </td>
										  <?php
											if($item['kori_kursi'] >= 90){
											$alo++;
											}elseif($item['kori_kursi'] >=75 && $item['kori_kursi'] < 90){
												$khub++;
											}else{
												$qanoatbakhsh++;
											}
										  ?>
										  <td align="center">
											<span style="font-size:11px;"><?=getLatter($item['kori_kursi'])?></span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;"><?=getAdad($item['kori_kursi'])?></span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;"><?=getAnanavi($item['kori_kursi'])?></span>
										  </td>
										</tr>
									<?php endif;?>
								<?php endforeach;?>
								<?php 
									$all_counter += $counter;
									$all_credits += $credits;
									$all_CrZarbiAdad += $CrZarbiAdad;
								?>
								
								<tr>
								  <th colspan="3" style="font-size:13px;">Ҳамагӣ:&nbsp;<?=$counter?>&nbsp;-&nbsp;фан</th>
								  <th colspan="1" style="font-size:13px;"><?=$credits;?>&nbsp;-&nbsp;кредит</th>
								  <th colspan="7" style="font-size:13px;">GPA=&nbsp;<?=round($CrZarbiAdad/$credits, 2)?></th>
								</tr>
							  </tbody>
							</table>
						  </td>
						</tr>
					</tbody>
				</table>
				<div style="border:0px solid black; text-align:center;">
					<span style="font-weight:bold;">Декани факултет</span> ____________________________________ <div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.имзо, подпись)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ному насаб, Ф.И.О)</div>
				</div>
				<br>				
				<br>
			<?php endif;?>
			<?php 
			$H_Y = 2;
			$S_Y = query("SELECT `s_y` FROM `students` 
							WHERE `status` = 1 
								AND `id_student` = '$id_student'
								AND `id_course` = '$course'
								AND `h_y` = '$H_Y'
						"); 
			$S_Y = $S_Y[0]['s_y'];
			$id_semestr = getSemestr($course, $H_Y);
			$fanresults = query("SELECT `nt_content`.*, `results`.* FROM `results` INNER JOIN `nt_content`
									ON `nt_content`.`id_fan` = `results`.`id_fan`
									WHERE `nt_content`.`id_nt` = '$id_nt' 
										AND `nt_content`.`semestr` = '$id_semestr'
										AND `results`.`id_student` = '$id_student'
										AND `results`.`id_course` = '$course'
										AND `results`.`s_y` = '$S_Y'
										AND `results`.`h_y` = '$H_Y'
							");
			?>
		<!-- Аз инҷо поён дар дохили сикл меояд-->
			<?php if(!empty($fanresults)):?>
				<table border="0" align="center" width="670" height="410" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
						  <td colspan="9" style="text-align: right;vertical-align: bottom;"><?=getUserName($id_student)?></td>
						</tr>
						<tr>
						  <td valign="top">
							<table class="tblll" border="0" align="center" width="670" cellspacing="0" cellpadding="0">
							  <tbody>
								<tr>
								  <th colspan="9">Соли хониши <?=getStudyYear($S_Y)?>, нимсолаи <?=$H_Y?></th>
								</tr>
								<tr>
								  <th rowspan="2" width="10">
									<div class="joyk">
									  <div class="zagalovokk">Курс</div>
									</div>
								  </th>
								  <th rowspan="2" style="font-size:13px;">№</th>
								  <th rowspan="2" width="100" style="font-size:13px;">Санҷиши натиҷавӣ</th>
								  <th rowspan="2" style="font-size:13px;">Номгӯи фанҳо <br>Наименование дисциплин </th>
								  <th rowspan="2" width="40">
									<div class="joy1">
									  <div class="zagalovok1">Миқдори кредитҳо <br>Кол-во кредитов </div>
									</div>
								  </th>
								  <th colspan="4" style="font-size:13px;">Баҳо (Оценка)</th>
								</tr>
								<tr>
								  <th width="30">
									<div class="joy">
									  <div class="zagalovok">1(хол) <br>(бал) </div>
									</div>
								  </th>
								  <th width="30">
									<div class="joy">
									  <div class="zagalovok">2(ҳарфӣ) (буквенной)</div>
									</div>
								  </th>
								  <th width="30">
									<div class="joy">
									  <div class="zagalovok">3(ададӣ) (шифровое)</div>
									</div>
								  </th>
								  <th width="30">
									<div class="joy">
									  <div class="zagalovok">4(анъанавӣ) (обичные)</div>
									</div>
								  </th>
								</tr>
								<?php 
									$counter = 0;
									$credits = 0;
									$CrZarbiAdad = 0;
								?>
								<?php foreach($fanresults as $item):?>
									<tr>
									  <td align="center">
										<span style="font-size:11px;"><?=$course;?></span>
									  </td>
									  <td align="center">
										<span style="font-size:11px;"><?=++$counter;?></span>
									  </td>
									  <?php $taj_fans = array(34,35,36,1921,1922,2153,2546,2154);?>
									  <?php if(!in_array($item['id_fan'], $taj_fans)):?>
										  <td align="center">
											<span style="font-size:11px;">Имтиҳон</span>
										  </td>
									  <?php else:?>
										  <td align="center">
											<span style="font-size:11px;">Таҷрибаомӯзӣ</span>
										  </td>
									  <?php endif;?>
									  <td>
										<span style="font-size:11px;"><?=getFanTest($item['id_fan'])?></span>
									  </td>
									  <td align="center">
										<span style="font-size:11px;"><?=$item['c_u']?></span>
										<?php $credits+=$item['c_u'];?>
									  </td>
									  <?php
										if($item['total_score'] >= 50){
											$total_score = $item['total_score'];
										}else{
											$total_score = $item['trimestr_score'];
										}
										if($total_score >= 90){
											$alo++;
										}elseif($total_score >=75 && $total_score < 90){
											$khub++;
										}else{
											$qanoatbakhsh++;
										}
									  ?>
									  <td align="center">
										<span style="font-size:11px;"><?=$total_score?></span>
									  </td>
									  <td align="center">
										<span style="font-size:11px;"><?=getLatter($total_score)?></span>
									  </td>
									  <td align="center">
										<span style="font-size:11px;"><?=getAdad($total_score)?></span>
										<?php $CrZarbiAdad += $item['c_u'] * getAdad($total_score);?>
									  </td>
									  <td align="center">
										<span style="font-size:11px;"><?=getAnanavi($total_score)?></span>
									  </td>
									</tr>
									<?php if(!empty($item['kori_kursi'])):?>
										<tr>
										  <td align="center">
											<span style="font-size:11px;"><?=$course;?></span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;"><?=++$counter;?></span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;">Кори курсӣ</span>
										  </td>
										  <td>
											<span style="font-size:11px;"><?=getFanTest($item['id_fan'])?></span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;">0</span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;"><?=$item['kori_kursi']?></span>
										  </td>
										  <?php
											if($item['kori_kursi'] >= 90){
											$alo++;
											}elseif($item['kori_kursi'] >=75 && $item['kori_kursi'] < 90){
												$khub++;
											}else{
												$qanoatbakhsh++;
											}
										  ?>
										  <td align="center">
											<span style="font-size:11px;"><?=getLatter($item['kori_kursi'])?></span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;"><?=getAdad($item['kori_kursi'])?></span>
										  </td>
										  <td align="center">
											<span style="font-size:11px;"><?=getAnanavi($item['kori_kursi'])?></span>
										  </td>
										</tr>
									<?php endif;?>
								<?php endforeach;?>
								<?php 
									$all_counter += $counter;
									$all_credits += $credits;
									$all_CrZarbiAdad += $CrZarbiAdad;
								?>
								
								<tr>
								  <th colspan="3" style="font-size:13px;">Ҳамагӣ:&nbsp;<?=$counter?>&nbsp;-&nbsp;фан</th>
								  <th colspan="1" style="font-size:13px;"><?=$credits;?>&nbsp;-&nbsp;кредит</th>
								  <th colspan="7" style="font-size:13px;">GPA=&nbsp;<?=round($CrZarbiAdad/$credits, 2)?></th>
								</tr>
							  </tbody>
							</table>
						  </td>
						</tr>
					</tbody>
				</table>
				<br>
				<?php if($course < 4):?>
					<div style="border:0px solid black; text-align:center;">Бо фармони №_____ аз «____»________20___ ба курси <span style="text-decoration:underline;">&nbsp;&nbsp;&nbsp;<?=$course+1?>&nbsp;&nbsp;&nbsp;</span> гузаронида шуд <br>
					  <span style="font-size:12px;">Приказом №_____ от «____ »________20___переведён на <span style="text-decoration:underline;">&nbsp;&nbsp;&nbsp;<?=$course+1?>&nbsp;&nbsp;&nbsp;</span> курс </span>
					  <br>
					  <span style="font-weight:bold;">Декани факултет</span> ____________________________________ <div style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.имзо, подпись)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ному насаб, Ф.И.О)</div>
					</div>
				<?php endif;?>
			<?php endif;?>
			<?php// exit;?>
			<p class="more"></p>
		<?php endfor;?>
		<div style="text-align:center; font-weight:bold; font-family:Palatino Linotype; font-size:18px; padding-bottom:8px;">Таҷрибаомӯзии касбӣ (соҳавӣ) <br>Практика </div>
		<table border="0" align="center" class="tblll" width="670" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
				  <th width="155">Шакли таҷрибаомӯзӣ <br>Вид практики </th>
				  <th>Ҷои гузаронидани таҷрибаомӯзӣ <br>Место прохождение практики </th>
				  <th width="200">Вазифа <br>Должность </th>
				  <th width="100">Миқдори кредитҳо <br>Количество кредитов </th>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
			</tbody>
		</table>
		<br>
		<p></p>
		<div style="text-align:center; font-weight:bold; font-family:Palatino Linotype; font-size:18px; padding-bottom:8px;">Имтиҳонҳои давлатӣ <br>Государственненый экзамены </div>
		<table border="0" align="center" class="tblll" width="670" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
				  <th width="155" rowspan="2">Намгӯи Фанҳо <br>Наименование дисциплин </th>
				  <th rowspan="2">Сана ва № протоколи КАД <br>Дата и № протокола ГЭК </th>
				  <th colspan="4">Баҳо (Оценка)</th>
				</tr>
				<tr>
				  <th width="30">
					<div class="joy">
					  <div class="zagalovok">1(хол) <br>(бал) </div>
					</div>
				  </th>
				  <th width="30">
					<div class="joy">
					  <div class="zagalovok">2(ҳарфӣ) (буквенной)</div>
					</div>
				  </th>
				  <th width="30">
					<div class="joy">
					  <div class="zagalovok">3(ададӣ) (шифровое)</div>
					</div>
				  </th>
				  <th width="30">
					<div class="joy">
					  <div class="zagalovok">4(анъанавӣ) (обичные)</div>
					</div>
				  </th>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				</tr>
			</tbody>
		</table>
		<br>
		<p></p>
		<table border="0" align="center" width="670" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
				  <td>
					<div class="textZag">Дар давраи таҳсил дар Донишгоҳ имтиҳон супорид: <br>Во время учебы в Университете сдал(а) экзамены: </div>
				  </td>
				</tr>
				<tr>
				  <td>
					<br>Миқдори фанҳо&nbsp; 
					<span style="border-bottom:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$all_counter?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp; аз онҳо :&nbsp;&nbsp; 
					<span style="border-bottom:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;<?=$alo?>&nbsp;&nbsp;&nbsp;&nbsp;</span> &nbsp;аъло,&nbsp;&nbsp; 
					<span style="border-bottom:1px solid black;">&nbsp;&nbsp;&nbsp;<?=$khub?>&nbsp;&nbsp;&nbsp;</span> &nbsp;хуб,&nbsp;&nbsp; 
					<span style="border-bottom:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;<?=$qanoatbakhsh?>&nbsp;&nbsp;&nbsp;&nbsp;</span> &nbsp;қаноатбахш 
					<br> Количество предметов &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;из них &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;отлично &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;хорошо &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;удовлет-но
				  </td>
				</tr>
				<tr>
				  <td>
					<div class="textZag">
					  <br>GPA-и ҷамъбастӣ - <?=round($all_CrZarbiAdad / $all_credits, 2)?>
					</div>
				  </td>
				</tr>
				<tr>
				  <td>
					<div class="textZag">
					  <br>Дар давраи таҳсил дар Донишгоҳ аз ______ кредитҳои ҳатмӣ ______ кредитҳоро соҳиб гашт. <br> Во время учебы в Университете из _____ обязательных кредитов сдал _______
					</div>
				  </td>
				</tr>
				<tr>
				  <td align="center">
					<br>
					<span style="font-weight:bold; font-size:17px;">Декани факултет</span> ____________________________________ <div style="font-size:10px;">(.имзо, подпись)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ному насаб, Ф.И.О)</div>
				  </td>
				</tr>
				<tr>
				  <td>
					<p class="more"></p>
					<div class="textZag">
					  <br>Кори <?php if($id_s_l <= 2):?>бакалаври<?php elseif($id_s_l = 3):?>магистри<?php endif;?>ро дар мавзӯи:___________________________________________________ 
					  <br>Зашитил <?php if($id_s_l <= 2):?>бакалавр<?php elseif($id_s_l = 3):?>магистр<?php endif;?>скую работу на тему: <br>__________________________________________________________________________________ __________________________________________________________________________________ _______________________________________________________ ҳимоя намуд (защитил)
					</div>
				  </td>
				</tr>
				<tr>
				  <td>
					<br>
					<span style="font-weight:bold; font-size:16px;">Баҳо</span> ________________________( _____________%; _____________) <div style="font-size:12px;">Оценки &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ададӣ,цифровой)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Фоиз,процентами)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ҳуруфӣ, буквами)</div>
				  </td>
				</tr>
				<tr>
				  <td>
					<div class="textZag">
					  <br>
					  <br>Бо қарори Комиссияи аттестансионӣ Давлатӣ (протоколи №____ аз «____»_______ соли 20__) <br>Решением ГЭК (протокол №____ от «____ »_________ 20___г.) <br> тахасусси_____________________________________________________________дода шуд. <br>присвоен квалификации
					</div>
				  </td>
				</tr>
				<tr>
				  <td>
					<div class="textZag">
					  <br>бо ихтисоси_____________________________________________________________________ <br>по специальности
					</div>
					<br>
				  </td>
				</tr>
				<tr>
				  <td align="center">
					<br>
					<span style="font-weight:bold; font-size:17px;">Декани факултет</span> ____________________________________ <div style="font-size:8px;">(.имзо, подпись)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ному насаб, Ф.И.О)</div>
				  </td>
				</tr>
				<tr>
				  <td align="center">
					<div class="textZag">
					  <br>
					  <br>Фармон дар бораи хатми Донишгоҳ: <br>№______ аз «_____»______________ с 20____
					</div>
				  </td>
				</tr>
				<tr>
				  <td align="center">
					<div class="textZag">
					  <br>
					  <br>Приказ об окончании Университета: <br>№____ от «_____»______________ 20____г.
					</div>
				  </td>
				</tr>
			</tbody>
		</table>
	</body>
	<!--<meta http-equiv="refresh" content="10">-->
</html>