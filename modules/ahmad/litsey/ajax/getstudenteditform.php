<h6 class="center">Маълумотҳои гурӯҳии донишҷӯ</h6>
<hr style="margin: 0 0 20px 0;">
<form action="<?=MY_URL?>?option=commission&action=update_student" method="post" enctype="multipart/form-data">
	<table class="addform">
		<tr>
			<td colspan="2">
				<label for="id_faculty">Факултет:</label>
				<select name="id_faculty" id="id_faculty" class="form-control" required>
					<option value="">-Интихоб кунед-</option>
					<?php foreach($faculties as $item):?>
						<option <?php if($student[0]['id_faculty'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>											
			</td>
			
			<td>
				<label for="id_s_l">Зинаи таҳсил:</label>
				<select name="id_s_l" id="id_s_l" class="form-control" required>
					<?php foreach($studylevels as $item):?>
						<option <?php if($student[0]['id_s_l'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>											
			</td>
		</tr>
		
		<tr>
			<td colspan="2">
				<label for="id_spec">Ихтисос:</label>
				<select name="id_spec" id="id_spec" class="form-control" required>
					<?php foreach($specs as $item): ?>
						<option <?php if($student[0]['id_spec'] == $item['id']) {echo "selected"; }?> value="<?=$item['id']?>"><?=$item['code']?> - <?=$item['title_'.LANG]?></option>
					<?php endforeach; ?>
				</select>
			</td>
			
			<td>
				<label for="id_s_v">Намуди таҳсил:</label>
				<select name="id_s_v" id="id_s_v" class="form-control" required>
					<?php foreach($studyviews as $item):?>
						<option <?php if($student[0]['id_s_v'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		
		
		<tr>
			<td class="w33">
				<label for="id_course">Курс:</label>
				<select name="id_course" id="id_course" class="form-control" required>
					<?php foreach($courses as $item):?>
						<option <?php if($student[0]['id_course'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
			
			<td class="w33">
				<label for="id_group">Гуруҳ:</label>
				<select name="id_group" id="id_group" class="form-control" required>
					<?php foreach($groups as $item):?>
						<option <?php if($student[0]['id_group'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
			
			<td class="w33">
				<label for="id_s_t">Шакли таҳсил:</label>
				<select name="id_s_t" id="id_s_t" class="form-control" required>
					<?php foreach($studytypes as $item):?>
						<option <?php if($student[0]['id_s_t'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="number_mmt">№ - ММТНПҶТ:</label>
				<input value="<?=$student[0]['number_mmt']?>" type="text" name="number_mmt" id="number_mmt" class="form-control">
			</td>
			
			
			<td>
				<label for="score_mmt">Бали умумӣ аз ММТ:</label>
				<input value="<?=$student[0]['total_score_mmt']?>" type="text" name="score_mmt" id="score_mmt" class="form-control">
			</td>
			
			<td>
				<label for="mmt_davr">Қабул:</label>
				<select name="mmt_davr" id="mmt_davr" class="form-control" required>
					<option <?php if($student[0]['davri_qabul_mmt'] == 1) {echo "selected"; }?> value="1">Даври якум</option>
					<option <?php if($student[0]['davri_qabul_mmt'] == 2) {echo "selected"; }?> value="2">Даври дуюм</option>
					<option <?php if($student[0]['davri_qabul_mmt'] == 3) {echo "selected"; }?> value="3">Қабули анъанавӣ</option>
				</select>
			</td>
		</tr>
		
		
		<tr>
			<td colspan="2">
				<label for="fullname_tj">Ном, насаб, номи падар:</label>
				<input value="<?=$student[0]['fullname_tj']?>" type="text" name="fullname_tj" id="fullname_tj" class="form-control" required>	
			</td>
			<td>
				<label for="jins">Ҷинс:</label>
				<select name="jins" id="jins" class="form-control" required>
					<option <?php if($student[0]['jins'] == 1){ echo "selected";}?> value="1">Мард</option>
					<option <?php if($student[0]['jins'] == 0){ echo "selected";}?> value="0">Зан</option>
				</select>
			</td>
		</tr>
		
		
		<tr>
			<td colspan="2">
				<label for="fullname_ru">Ном, насаб, номи падар (Русӣ):</label>
				<input value="<?=$student[0]['fullname_ru']?>" type="text" name="fullname_ru" id="fullname_ru" class="form-control" required>	
			</td>
			<td style="vertical-align: bottom">
				
				<div class="checkbox-zoom zoom-success">
					<label class="semestr" for="foreign">
						<input type="checkbox" name="foreign" id="foreign">
						<span class="cr">
							<i class="cr-icon icofont icofont-ui-check txt-success"></i>
						</span>
						<span>Қабули хориҷӣ</span>
					</label>
				</div>
				
			</td>
		</tr>
		
		<tr>
			<td colspan="3">
				<div style="display: none" class="alert alert-danger alert-dismissable growl-animated animated fadeInDown myalertred"><i class="fa fa-warning"></i> Логин банд аст!</div>
				<div style="display: none" class="alert alert-success alert-dismissable growl-animated animated fadeInDown myalertgreen"><i class="fa fa-check-circle"></i> Логин банд нест! Давом диҳед</div>
			</td>
		</tr>
		
		
		<tr>
			<td>
				<label for="login">Логин:</label>
				<input value="<?=$student[0]['login']?>" autocomplete="off" required type="text" name="login" id="login" class="form-control">
			</td>
			
			<td>
				<label for="password">Парол:</label>
				<input value="<?=$student[0]['password']?>" autocomplete="off" required type="text" name="password" id="password" class="form-control">
			</td>
			
			<td>
				<label for="photo">Расмро интихоб кунед:</label><br>
				<input type="file" name="photo" id="photo" >
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="number_passport">Рақами шиноснома:</label>
				<input value="<?=$student[0]['number']?>" autocomplete="off" type="text" name="number_passport" id="number_passport" placeholder="A02319960" class="form-control">
			</td>
			
			<td>
				<label for="sanai_dodani_passport">Санаи додани шиноснома:</label>
				<input value="<?=$student[0]['date']?>" type="date" name="sanai_dodani_passport" id="sanai_dodani_passport" class="form-control">
			</td>
			
			<td>
				<label for="maqomot">Мақоми шиносномадиҳанда:</label>
				<input value="<?=$student[0]['maqomot']?>" autocomplete="off" type="text" name="maqomot" id="maqomot" class="form-control">
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="birthday">Рузи таввалуд:</label>
				<input value="<?=$student[0]['birthday']?>" type="date" name="birthday" id="birthday" class="form-control">
			</td>
			
			
			<td>
				<label for="phone">Телефон:</label>
				<input value="<?=$student[0]['phone']?>" autocomplete="off" type="text" name="phone" id="phone" placeholder="+992987654321" class="form-control">
			</td>
			
			<td>
				<label for="parent_phone">Телефони волидайн:</label>
				<input value="<?=$student[0]['phone_parents']?>" autocomplete="off" type="text" name="parent_phone" id="parent_phone" placeholder="+992987654321" class="form-control">
			</td>
		</tr>
		
		
		<tr>
			<td>
				<label for="id_country">Мамлакат:</label>
				<select name="id_country" id="id_country" class="form-control">
					<option value="">-Интихоб кунед-</option>
					<?php foreach($countries as $item):?>
						<option <?php if($student[0]['id_country'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>	
			</td>
			
			<td>
				<label for="id_region">Вилоят/Минтақа:</label>
				<select name="id_region" id="id_region" class="form-control">
					<option value="">-Мамлакатро интихоб кунед-</option>
					<?php foreach($regions as $item):?>
						<option <?php if($student[0]['id_region'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['name']?></option>
					<?php endforeach;?>
				</select>	
			</td>
			
			<td>
				<label for="id_district">Ноҳия/Шаҳр:</label>
				<select name="id_district" id="id_district" class="form-control">
					<?php foreach($districts as $item):?>
						<option <?php if($student[0]['id_district'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['name']?></option>
					<?php endforeach;?>
				</select>	
			</td>
		</tr>
		
		
		<tr>
			<td>
				<label for="id_nation">Миллат:</label>
				<select name="id_nation" id="id_nation" class="form-control">
					<?php foreach($nations as $item):?>
						<option <?php if($student[0]['id_nation'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
			
			<td>
				<label for="vazi_oilavi">Ятим:</label>
				<select name="vazi_oilavi" id="vazi_oilavi" class="form-control">
					<?php foreach($vazi_oilavi as $item):?>
						<option <?php if($student[0]['vazi_oilavi'] == $item['id']) {echo "selected"; }?> value="<?=$item['id'];?>"><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
			
			<td>
				<label for="current_address">Ҷойи зист:</label>
				<textarea cols="40" rows="3" name="current_address" id="current_address" class="form-control"><?=$student[0]['address']?></textarea>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="xatm_namud">Хатм намуд:</label>
				<select name="xatm_namud" id="xatm_namud" class="form-control">
					<?php foreach($xatmnamud as $v => $k):?>
						<option <?php if($student[0]['id_khatm_namud'] == $v) {echo "selected"; }?> value="<?=$v?>"><?=$k?></option>
					<?php endforeach;?>
				</select>
			</td>
			
			<td>
				<label for="hujjati_xatm">Ҳуҷҷат:</label>
				<select name="hujjati_xatm" id="hujjati_xatm" class="form-control">
					<?php foreach($hujjati_xatm as $v => $k):?>
						<option <?php if($student[0]['id_hujjat'] == $v) {echo "selected"; }?> value="<?=$v?>"><?=$k?></option>
					<?php endforeach;?>
				</select>
			</td>
			
			<td>
				<label for="soli_xatm">Соли хатм:</label>
				<input value="<?=$student[0]['soli_xatm']?>" type="text" name="soli_xatm" id="soli_xatm" class="form-control">
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="silsila">Силсила:</label>
				<input value="<?=$student[0]['silsila']?>" type="text" name="silsila" id="silsila" class="form-control">
			</td>
			
			<td>
				<label for="number_hujjat">№:</label>
				<input value="<?=$student[0]['number_hujjat']?>" type="text" name="number_hujjat" id="number_hujjat" class="form-control">
			</td>
			
			<td>
				<label for="date_hujjat">Санаи додани ҳуҷҷат:</label>
				<input value="<?=$student[0]['date_hujjat']?>" type="date" name="date_hujjat" id="date_hujjat" class="form-control">
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="number_scholl">№ мактаб:</label>
				<input value="<?=$student[0]['number_scholl']?>" type="text" name="number_scholl" id="number_scholl" class="form-control">
			</td>
			
			<td>
				<label for="muasisa_name">Муасиссаи хатмкарда:</label>
				<input value="<?=$student[0]['muasisa_name']?>" type="text" name="muasisa_name" id="muasisa_name" class="form-control">
			</td>
			
			<td>
				<label for="muasisa_lang">Забони таҳсил дар муасисса:</label>
				<select name="muasisa_lang" id="muasisa_lang" class="form-control">
					<?php foreach($langs as $v => $k): ?>
						<option <?php if($student[0]['muasisa_lang'] == $v) {echo "selected"; }?> value="<?=$v;?>"><?=$k?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="vazi_ijtimoi">Вазъи иҷтимоӣ:</label>
				<select name="vazi_ijtimoi" id="vazi_ijtimoi" class="form-control">
					<?php foreach($vazi_ijtimoi as $v => $k): ?>
						<option <?php if($student[0]['v_ijtimoi'] == $v) {echo "selected"; }?> value="<?=$v;?>"><?=$k?></option>
					<?php endforeach; ?>
				</select>
			</td>
			
			<td>
				<label for="az_oilai_ki">Аз оилаи кӣ:</label>
				<select name="az_oilai_ki" id="az_oilai_ki" class="form-control">
					<?php foreach($az_oilai_ki as $v => $k): ?>
						<option <?php if($student[0]['from_family'] == $v) {echo "selected"; }?> value="<?=$v;?>"><?=$k?></option>
					<?php endforeach; ?>
				</select>
			</td>
			
			
			<td>
				<label for="vazi_oilavi_form">Вазъи оилавӣ:</label>
				<select name="vazi_oilavi_form" id="vazi_oilavi_form" class="form-control">
					<?php foreach($vazi_oilavi_form as $v => $k): ?>
						<option <?php if($student[0]['v_oilavi'] == $v) {echo "selected"; }?> value="<?=$v?>"><?=$k?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="unvoni_harbi">Унвони ҳарбӣ:</label>
				<select name="unvoni_harbi" id="unvoni_harbi" class="form-control">
					<?php foreach($unvonho as $v => $k): ?>
						<option <?php if($student[0]['unvoni_harbi'] == $v) {echo "selected"; }?> value="<?=$v?>"><?=$k?></option>
					<?php endforeach; ?>
				</select>
			</td>
			
			
			<td>
				<label for="lashkar">Қавм, лашкар:</label>
				<select name="lashkar" id="lashkar" class="form-control">
					<?php foreach($lashkar as $v => $k): ?>
						<option <?php if($student[0]['lashkar'] == $v) {echo "selected"; }?> value="<?=$v?>"><?=$k?></option>
					<?php endforeach; ?>
				</select>
			</td>
			
			<td>
				<label for="spec">Классификатсия:</label>
				<input value="<?=$student[0]['spec']?>" type="text" name="spec" id="spec" class="form-control">
			</td>
		</tr>
		
		
		<tr>
			<td colspan="3">
				<label for="family_info">Маълумот дар бораи аҳли оила:</label>
				<textarea rows="5" style="width:100%" name="family_info" id="family_info" class="form-control"><?=$student[0]['family_info']?></textarea>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="email">E-mail:</label>
				<input value="<?=$student[0]['email']?>" autocomplete="off" type="text" name="email" id="email" class="form-control">
			</td>
			
			<td style="vertical-align: bottom">
				
				<div class="checkbox-zoom zoom-success">
					<label class="semestr" for="xobgoh">
						<input <?php if(isset($student[0]['xobgoh'])):?> checked <?php endif;?> type="checkbox" name="xobgoh" id="xobgoh">
						<span class="cr">
							<i class="cr-icon icofont icofont-ui-check txt-success"></i>
						</span>
						<span>Ба хобгоҳ ниёз дорад</span>
					</label>
				</div>
			</td>
		</tr>
		
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_student" value="<?=$id_student?>">
				<button type="submit" class="updatebtn btn btn-inverse waves-effect waves-light">
					<i class="fa fa-save"></i> Сабти тағйиротҳо
				</button>
			</td>
		</tr>
		
	</table>
	
	
</form>
	


<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.addform').on("change", "#id_faculty, #id_s_l", function () {
			var id_faculty = $('.addform #id_faculty').val();
			var id_s_l = $('.addform #id_s_l').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getSpecs";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_faculty": id_faculty, "id_s_l": id_s_l},
				success: function(data){
					$('#id_spec').html(data);
				}
			});
		});
		
		/* Барои муайян кардани интиқол */
		$('.addform').on("change", "#id_faculty, #id_s_l, #id_spec, #id_s_v", function () {
			var id_student = <?=$id_student?>;
			var id_faculty = $('.addform #id_faculty').val();
			var id_s_l = $('.addform #id_s_l').val();
			var id_spec = $('.addform #id_spec').val();
			var id_s_v = $('.addform #id_s_v').val();
			
		
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=forIntiqol";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student": id_student, "id_faculty": id_faculty, "id_s_l": id_s_l, "id_spec": id_spec, "id_s_v": id_s_v},
				success: function(data){
					console.log(data);
					
					if(data == "dontshow"){
						$(".farmon_number").hide();
						$(".farmon_date").hide();
					}else if(data == "showit") {
						$(".farmon_number").show();
						$(".farmon_date").show();
					}
				}
			});
		});
		/* Барои муайян кардани интиқол */
		
		
		$('#login').on('propertychange input',function(){
			var login = $(this).val();
			var id_student = <?=$id_student?>;
			
			$.trim(login);
			if(login == ''){
				return false;
			}
			
			console.log(login);
			var url = '<?=URL."modules/students/students_ajax.php?option=isBusylogin";?>';
			
			$.ajax({
				type: 'post',
				url: url,
				data: {"login": login, "id_student": id_student},
				success: function(data){
					if(data == 1){
						$(".myalertgreen").hide();
						$(".myalertred").show();
						$(".updatebtn").attr("disabled", true);
					}else{
						$(".myalertred").hide();
						$(".myalertgreen").show();
						$(".updatebtn").attr("disabled", false);
					}
				}
			});
			
		});
		
		$('.addform').on("change", "#id_region", function () {
			var id_region = $('.addform #id_region').val();
			
			var my_url = '<?=MY_URL;?>';
			var url = '<?=URL."modules/students/students_ajax.php?option=getDistricts";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_region": id_region},
				success: function(data){
					$('#id_district').html(data);
				}
			});
			
		});
		
		
	});
</script>