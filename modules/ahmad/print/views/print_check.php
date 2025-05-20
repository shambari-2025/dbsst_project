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
			border-collapse: collapse;
			font-size:14px;
		}
		
		th, td {
			border: 1px solid;
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
		<br>
		<br>
		<table style="width: 100%">
			<tbody>
				<tr>
					<td class="bold" style="width:236px; vertical-align: top">
						<p><u><?=SHORT_UNI_NAME?></u></p>
					</td>
					<td style="width:293px;height:47px;">
						<p class="bold" align="right">Шакли № КО-1</p>
						<p>
							Тасдиқ шуд бо қарори Вазорати молияи Ҷ.Т. №228 аз 20.05.2010 сол
						</p>
						<p>
							Рамзи КУҲи (ОКУД) <span style="border: 1px solid;width: 55px;display: inline-block;">&nbsp;</span>
						</p>
					</td>
					<td rowspan="2" style="width:10px; padding:0">
						<div class="vertical">Хатти буриш</div>
					</td>
					
					<td rowspan="2" style="width:234px; vertical-align: top">
						<p class="bold"><u><?=SHORT_UNI_NAME?></u></p>
						
						
						<p class="bold" align="center">РАСИД<br>ба ордери даромадӣ</p>
						
						<br>
						<p>Хазина №<?=$id_check?></p>
						<p >
							Қабул шуд аз: <u><b><?=$student[0]['fullname_tj']?></b></u>
						</p>
						
						<br>
						
						<p style="border-bottom: 1px solid;">
							Асос: <?=$pardoxt_types[$type]?> соли 20<?=$check[0]['s_y']?>-20<?=$check[0]['s_y']+1?> <?=getStudyLevel($student[0]['id_s_l'])?>, <?=getStudyView($student[0]['id_s_v'])?>, <?=getFacultyShort($student[0]['id_faculty'])?>, <?=getSpecialtyCode($student[0]['id_spec'])?> <?=getGroup2($student[0]['id_group'])?>
						</p>
						<br>
						<p style="border-bottom: 1px solid;" class="bold"><span class="money" style=""></span> сомонию 00 дирам</p>
						
						<p style="border-bottom: 1px solid;">
							<b><?=$check[0]['check_money']?> сом. 00 дирам </b>
						</p>
						
						<p style="border-bottom: 1px solid;">
							«<?=date("d")?>» <?=date("m")?> <?=date("Y")?> с.
						</p>
						
						<p>Ҷ.М.</p>
						<br>
						<br>
						<br>
						<br>
						
						<p align="center">Сармуҳосиб</p>
						<p align="center">Қабул кард хазинадор</p>
					</td>
					
					
					<td rowspan="2" style="width:10px; padding:0">
						<div class="vertical">Хатти буриш</div>
					</td>
					
					
					<td rowspan="2" style="width:234px; vertical-align: top">
						<p class="bold"><u><?=SHORT_UNI_NAME?></u></p>
						
						
						<p class="bold" align="center">РАСИД<br>ба ордери даромадӣ</p>
						
						<br>
						<p>Хазина №<?=$id_check?></p>
						<p >
							Қабул шуд аз: <u><b><?=$student[0]['fullname_tj']?></b></u>
						</p>
						
						<br>
						
						<p style="border-bottom: 1px solid;">
							Асос: <?=$pardoxt_types[$type]?> соли 20<?=$check[0]['s_y']?>-20<?=$check[0]['s_y']+1?> <?=getStudyLevel($student[0]['id_s_l'])?>, <?=getStudyView($student[0]['id_s_v'])?>, <?=getFacultyShort($student[0]['id_faculty'])?>, <?=getSpecialtyCode($student[0]['id_spec'])?> <?=getGroup2($student[0]['id_group'])?>
						</p>
						<br>
						<p style="border-bottom: 1px solid;" class="bold"><span class="money" style=""></span> сомонию 00 дирам</p>
						
						<p style="border-bottom: 1px solid;">
							<b><?=$check[0]['check_money']?> сом. 00 дирам</b>
						</p>
						
						<p style="border-bottom: 1px solid;">
							«<?=date("d")?>» <?=date("m")?> <?=date("Y")?> с.
						</p>
						
						<p>Ҷ.М.</p>
						<br>
						<br>
						<br>
						<br>
						
						<p align="center">Сармуҳосиб</p>
						<p align="center">Қабул кард хазинадор</p>
					</td>
				</tr>
				
				<tr>
					<td colspan="2" style="width:529px;">
						<p class="center" ><b>ОРДЕРИ ДАРОМАДИ ХАЗИНА <?=$id_check?></b></p>
						<table class="center">
							<tbody>
								<tr>
									<td>Рақами ҳуҷҷат</td>
									<td>Санаи таҳвил</td>
									<td>Суратҳисоб кориспонти <br>ё суртҳисоби иловагӣ</td>
									<td>Рамзи ҳисобот</td>
									<td style="width: 70px;">Маблағ</td>
									<td>Рамзи ҷойгиркунӣ</td>
								</tr>
								<tr>
									<td></td>
									<td><?=formatDate($check[0]['check_date'])?></td>
									<td></td>
									<td></td>
									<td><?=$check[0]['check_money']?>-00</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						
						<p>
							Қабул шуд аз: <u><?=$student[0]['fullname_tj']?></u></p>
						<p style="border-bottom: 1px solid;">
							<b>Асос: </b><?=$pardoxt_types[$type]?> соли 20<?=$check[0]['s_y']?>-20<?=$check[0]['s_y']+1?> <?=getStudyLevel($student[0]['id_s_l'])?>, <?=getStudyView($student[0]['id_s_v'])?>, <?=getFacultyShort($student[0]['id_faculty'])?>, <?=getSpecialtyCode($student[0]['id_spec'])?> <?=getGroup2($student[0]['id_group'])?>
						</p>
						<br>
						<p style="border-bottom: 1px solid;"><b><span class="money" style=""></span> сомонию 00 дирам</b></p>
						
						<br>
						<p>Пешниҳод:</p>
						
						
						<br>
						<br>
						<br>
						<p>Сармуҳосиб</p>
						<p>Қабул кард хазинадор</p>
						<br>
						<br>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
	
	<script>
        var th = ['', 'ҳазору', 'миллиону', 'миллиарду', 'триллиону'];
        var dg = ['сифр', 'як', 'ду', 'се', 'чор', 'панҷ', 'шаш', 'ҳафт', 'ҳашт', 'нӯҳ'];
        var tn = ['даҳ', 'ёздаҳ', 'дувоздаҳ', 'сездаҳ', 'чордаҳ', 'понздаҳ', 'шонзда', 'ҳабдаҳ', 'ҳаждаҳ', 'нӯҳдаҳ'];
        var tw = ['бисту', 'сӣю', 'чилу', 'панҷоҳу', 'шасту', 'ҳафтоду', 'ҳаштоду', 'наваду'];

        function toWords(s) {
            s = s.toString();
            s = s.replace(/[\, ]/g, '');
            if (s != parseFloat(s)) return 'not a number';
            var x = s.indexOf('.');
            if (x == -1)
                x = s.length;
            if (x > 15)
                return 'too big';
            var n = s.split('');
            var str = '';
            var sk = 0;
            for (var i = 0; i < x; i++) {
                if ((x - i) % 3 == 2) {
                    if (n[i] == '1') {
                        str += tn[Number(n[i + 1])] + ' ';
                        i++;
                        sk = 1;
                    } else if (n[i] != 0) {
                        str += tw[n[i] - 2] + ' ';
                        sk = 1;
                    }
                } else if (n[i] != 0) { // 0235
                    str += dg[n[i]] + ' ';
                    if ((x - i) % 3 == 0) str += 'саду ';
                    sk = 1;
                }
                if ((x - i) % 3 == 1) {
                    if (sk)
                        str += th[(x - i - 1) / 3] + ' ';
                    sk = 0;
                }
            }
			
			
			if (x != s.length) {
                var y = s.length;
                str += 'point ';
                for (var i = x + 1; i < y; i++)
                    str += dg[n[i]] + ' ';
            }
            let rs = str.replace(/\s+/g, ' ').trimEnd();
           
            rs = (rs.slice(-1)=="у"||rs.slice(-1)=="ю")?rs.substring(0, rs.length - 0):rs;
			
            return rs;
        }
		
		
		var spans = document.getElementsByClassName('money'); // выбираем все элементы <span> внутри родительского элемента

		for (var i = 0; i < spans.length; i++) {
			spans[i].innerHTML = toWords(<?=$check[0]['check_money']?>);
		}
		
    </script>
	
</html>