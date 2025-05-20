<?php
	$fans = query("SELECT `nt_content`.`id_fan`, `fan_test`.`title_tj` FROM `nt_content` 
					INNER JOIN `fan_test` ON `nt_content`.`id_fan` = `fan_test`.`id`
					WHERE `nt_content`.`id_nt`='$id_nt' 
					GROUP BY `nt_content`.`id_fan`, `fan_test`.`id`, `fan_test`.`title_tj`
					ORDER BY `fan_test`.`title_tj`;

				");
	$credits = $summa = 0;			
	foreach($fans as $fan){
		$fan_credit = getFanCreditsByNT($id_nt, $fan['id_fan']);
		$fan_results = getImtForZamima($fan['id_fan'], $id_student);
		if($fan_results['total_score']>=50)
			$res = $fan_results['total_score'];
		else
			$res = $fan_results['total_score'];
		
		$res = getAdad($res);
		$summa += $fan_credit * $res;
		$credits += $fan_credit;
		
		//echo $fan['title_tj']."|".$res."|".$fan_credit."|".$fan_credit*$res."<br>";
	}
	$gpa = round($summa / $credits , 2);
	//exit;
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=Utf-8" />
    <title><?=$page_info['title'];?></title>
    <style type="text/css" media="print">
		@import url("../css/pd_css.css");

		.commons {
			visibility: hidden;
			display: none;
			left: -500px;
		}

		.break {
			page-break-before: always;
		}
    </style>
    <style type="text/css" media="all">
      @import url("../css/pd_css.css");

	  body * {
		font-family: "Times New Roman", Times, serif;
	  }

      .break {
        page-break-before: always;
      }

      .tbl_ank th {
        border-bottom: #333 solid 1px;
      }

      .vdtab {
        border-bottom: #333 solid 1px;
        border-left: #333 solid 1px;
        border-top: #333 solid 1px;
        word-wrap: break-word;
      }

      .vdtab th {
        border-bottom: #333 solid 1px;
        border-right: #333 solid 1px;
        word-wrap: break-word;
        font-size: 11px;
      }

      .vdtab td {
        border-right: #333 solid 1px;
        word-wrap: break-word;
      }

      .res_vk {
        font-size: 13px;
        font-weight: bold;
        font-family: Palatino Linotype;
        font-style: italic;
        padding-top: 5px;
        padding-bottom: 5px;
      }

      #vk_tj {
        font-size: 11px;
        font-weight: bold;
        font-family: Palatino Linotype;
        font-style: italic;
      }

      #vk_ru {
        font-size: 11px;
        font-family: Palatino Linotype;
        font-style: italic;
      }

      #born_date {
        font-size: 13px;
        font-family: Palatino Linotype;
        font-style: italic;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <br>
    <br>
    <br>
    <br>
    <table border="0" width="635" align="center" class="tbl_ank1" cellspacing="0" cellpadding="0">
      <tr>
        <th width=380 style="border-right:#333 solid 1px;">
          <table border="0" width=100% cellspacing="0" cellpadding="0">
            <tr>
              <td align=left>
                <span id="vk_tj">Насаб, ном, номи падар</span>
                <br>
                <span id="vk_ru">Фамилия, имя, отчество </span>
              </td>
            </tr>
            <tr>
              <td align=center>
                <span style="font-family:Palatino Linotype;font-size:16px;font-style:italic;font-weight:bold;"><?=getUserName($id_student)?></span>
                <p>
              </td>
            </tr>
            <tr>
              <td align=left>
                <span id="vk_tj">Санаи таваллуд</span>
                <br>
                <span id="vk_ru">Дата рождения </span>&nbsp;&nbsp;&nbsp;&nbsp; <span id="born_date"><?=date('d.m.Y', strtotime($birthday))?></span>
                <br>
                <br>
              </td>
            </tr>
          </table>
        </th>
        <th width=290>
          <table border="0" width=100% cellspacing="0" cellpadding="0">
            <tr>
              <td align=center>
                <div style="font-size:14px;font-weight:bold;">ҶУМҲУРИИ ТОҶИКИСТОН <br>РЕСПУБЛИКА ТАДЖИКИСТАН </div>
              </td>
            </tr>
            <tr>
              <td align=center>
                <div style="padding-top:5px;">
                  <img src="<?=URL?>userfiles/gerb.jpg">
                </div>
              </td>
            </tr>
          </table>
        </th>
      </tr>
      <tr>
        <td width=380 style="border-right:#333 solid 1px;" align=left>
          <span id="vk_tj">Ҳуҷҷат дар бораи таҳсилоти пешина</span>
          <br>
          <span id="vk_ru">Предыдущий документ об образовании</span>
          <br>
          <div class="res_vk"><?=@$hujjati_xatm[$id_khatm]?></div>
          <span id="vk_tj">Санҷишҳои дохилшавӣ</span>
          <br>
          <span id="vk_ru">Вступительные испытания </span>
          <br>
          <div class="res_vk">Гузашт</div>
          <span id="vk_tj">Дохил шуд ба</span>
          <br>
          <span id="vk_ru">Поступил (а) в &nbsp;</span>
          <span id="vk_tj"> соли 20<?=$dokhilshavi?></span>
          <br>
          <div class="res_vk"><?=UNI_NAME?></div>
          <span id="vk_tj">Таҳсилро хатм кард дар </span>
          <br>
          <span id="vk_ru">Завершил (а) обучение в &nbsp;</span>
          <span id="vk_tj"> &nbsp;&nbsp;соли <?=$soli_xatm?> </span>
          <br>
          <div class="res_vk"><?=UNI_NAME?></div>
          <span id="vk_tj">Мӯҳлати меъёрии таҳсил </span>
          <br>
          <span id="vk_ru">Нормативный период обучения</span>
          <br>
          <div class="res_vk">&nbsp;&nbsp;&nbsp;&nbsp;<?=$muhlati_tahsil?> сол</div>
          <span id="vk_tj">Самт/ихтисос </span>
          <br>
          <span id="vk_ru">Направление/специальность</span>
          <br>
          <div class="res_vk"><?=getSpecialtyCode($id_spec)?>-<?=getSpecialtyTitle($id_spec)?></div>
          <span id="vk_tj">Корҳои курсӣ</span>
          <br>
          <span id="vk_ru">Курсовые работы</span>
          <br>
          <div class="res_vk">Дар варақаи №2 оварда шудааст.</div>
          <span id="vk_tj">Таҷрибаомӯзӣ</span>
          <br>
          <span id="vk_ru">Практики</span>
          <br>
          <div class="res_vk">Таҷрибаомӯзии пеш аз дипломӣ (3-ҳафта) &nbsp; </div>
          <span id="vk_tj">Натиҷаи аттестатсияи хатм</span>
          <br>
          <span id="vk_ru">Выполнение и защита выпускной квалификационной работы&nbsp;</span>
          <br>
          <div class="res_vk">Баҳои ҳимояи кори хатми бакалаврӣ&nbsp;&nbsp;</div>
          <div class="res_vk" style='border:0px solid red; text-align:right;'>GPA-<?=$gpa?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</div>
          <span id="vk_tj">Дипломи мазкур ба фаъолияти касбӣ мутобиқи сатҳи таҳсилот ва тахассус ҳуқуқ медиҳад</span>
          <br>
          <span id="vk_ru">Данный документ дает право профессиональной деятельности в соответствии с уровнем образования и квалификацией</span>
          <p>
            <span id="vk_tj">Давомаш дар варақаи №2</span>
            <br>
            <span id="vk_ru">Продолжение см. на обороте</span>
          <p>
            <span id="vk_tj">Ҳуҷҷат шумораи варақаҳоро дар бар мегирад:</span>
            <br>
            <span id="vk_ru">Документ содержит количество листов:</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="res_vk">ду</span>
          <p>
        </td>
        <td width=290 valign=top align=center>
          <div style="padding-left:5px;">
            <p>
              <span style="font-size:16px;font-weight:regylar;">ИЛОВА БА</span>
              <br>
              <span style="font-size:16px;font-weight:bold;">ДИПЛОМИ</span>
              <br>
              <span style="font-size:16px;font-weight:regylar;">ПРИЛОЖЕНИЕ К</span>
              <br>
              <span style="font-size:16px;font-weight:bold;">ДИПЛОМУ</span>
            <p>
            <div style="border-bottom:1px solid black; width:80%;"></div>
            <p>
            <div style="border-bottom:1px solid black; width:80%;"><?=$diplom_number?></div>
            <span style="font-size:11px;">(рақами қайд/регистрационный номер)</span>
            <p>
            <div style="border-bottom:1px solid black; width:80%;"><?=$diplom_reg_number?></div>
            <p> Бо қарори комиссияи давлатии <br>аттестатсионӣ
            <p>Решением Государственной <br>аттестационной комиссии
            <p>
            <div style="width:80%;">аз/от&nbsp;&nbsp; <span style="text-decoration:underline;"><?=date('d.m.Y', strtotime($date_gek))?></span>&nbsp;&nbsp; </div>
            <p>
              <br>Дода шуд/присуждена: дараҷаи касбии <br>
            <div style="border-bottom:1px solid black; width:80%;">
              <span style="text-decoration:none;"><?=$kasb?></span>
            </div>
            <br>____________________________ <p>____________________________
            <p>
              <br> Ректор_______________________
            <p>Декан_______________________
            <p>
            <div style="border:0px solid red;display:table;width:100%;">
				<div style="width: 65px;
							float: left;
							padding-left: 23px;
							text-align: left;">Котиб Секретарь</div>
									  <div style="width: 184px;
							text-align: left;
							float: right;
							padding-top: 19px;">____________________
				</div>
            </div>
            <p>
              <br> Ҷ. М. <br> М. П. <br>
              <br>
              <br>Варақи №1/ Лист №1
          </div>
        </td>
      </tr>
    </table>
    <p class=break>
    <br>
    <div style="font-size:10px;padding-left:65px;padding-top:6px;">Дар давраи таҳсил, имтиҳонҳои ҷорӣ ва ҷамъбастиро аз фанҳои зерин супорид: <br>За время обучения сдал, промежуточные и итоговые экзамены по следующим дисциплинам: </div>
    <br>
	<table border="0" class=vdtab align="center" width="635" height="360" cellspacing="0" cellpadding="0">
      <tr>
        <th valign=top width=30>№</th>
        <th align=center>Номгӯи фанҳо <br>Наименование дисциплин </th>
        <th align=center width=60>Кредит/ <br>Соат(Час) </th>
        <th align=center width=60>Холҳо <br>Баллы </th>
        <th align=center width=90>Баҳои ҷамъбастӣ <br>Итоговая оценка </th>
      </tr>
	 <?php //$fans = query2("SELECT DISTINCT(`nt_content`.`id_fan`), `nt_content`.`k_k`, `fan_test`.* FROM `nt_content` INNER JOIN `fan_test` 
							// ON `nt_content`.`id_fan` = `fan_test`.`id`
							// WHERE `nt_content`.`id_nt`='$id_nt'
							// ORDER BY `fan_test`.`title_tj`
						// ");
		$fans = query("SELECT `nt_content`.`id_fan`, MAX(`nt_content`.`k_k`) AS `k_k`, `fan_test`.`id`, `fan_test`.`title_tj`
						FROM `nt_content` 
						INNER JOIN `fan_test` ON `nt_content`.`id_fan` = `fan_test`.`id`
						WHERE `nt_content`.`id_nt`='$id_nt' 
						GROUP BY `nt_content`.`id_fan`, `fan_test`.`id`, `fan_test`.`title_tj`
						ORDER BY `fan_test`.`title_tj`;

						");
		$counter = 1;
	?>
	<?php foreach($fans as $item):?>
	 <tr>
        <td align="center">
          <span style="font-size:10px;"><?=$counter?></span>
        </td>
        <td>
          <span style="font-size:10px; padding-left:5px;"><?=$item['title_tj'];//.">".$item['id']?></span>
        </td>
        <td align="center">
			<?php 
				$fan_credits = getFanCreditsByNT($id_nt, $item['id_fan']);
				$fan_results = getImtForZamima($item['id_fan'], $id_student);
			?>
          <span style="font-size:10px;"><?=$fan_credits?>/<?=$fan_credits*24?></span>
        </td>
        <td align="center">
          <span style="font-size:10px;">
			<?php
				if($fan_results['total_score'] >= 50){
					echo $total_score = $fan_results['total_score'];
				}else{
					echo $total_score = $fan_results['trimestr_score'];
				}
			?>
		  </span>
        </td>
        <td align="center">
          <span style="font-size:10px;"><?=getAnanaviMatn($total_score)?></span>
        </td>
      </tr>
	  <?php if($item['k_k']):?>
		<?php $counter++;?>
		  <tr>
			<td align="center">
			  <span style="font-size:10px;"><?=$counter?></span>
			</td>
			<td>
			  <span style="font-size:10px; padding-left:5px;"><?=$item['title_tj']?></span>
			</td>
			<td align="center">
				<?php
					$fan_results = @getKKForZamima($item['id_fan'], $id_student);
				?>
			  <span style="font-size:10px;">к/к</span>
			</td>
			<td align="center">
			  <span style="font-size:10px;">
				<?=$fan_results;?>
			  </span>
			</td>
			<td align="center">
			  <span style="font-size:10px;"><?=getAnanaviMatn($fan_results)?></span>
			</td>
		  </tr>
	  <?php endif;?>
		<?php $counter++;?>
	<?php endforeach;?>
    </table>
    </p>
    <table border="0" align="center" width="635" cellspacing="0" cellpadding="0">
      <tr>
        <td style="font-size:10px;"></td>
        <td style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Варақи №2/ Лист 2</td>
      </tr>
    </table>