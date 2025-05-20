	<h6 class="center">Маълумотҳои гурӯҳии донишҷӯ</h6>
	<hr style="margin: 0 0 20px 0;">
	<form action="<?=MY_URL?>?option=students&action=update_student" method="post" enctype="multipart/form-data">
		<table class="addform">
			<tr>
				<td colspan="2">
					<label for="id_faculty">Факултет:</label>
					<select name="id_faculty" id="id_faculty" class="form-control" required>
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
							<option <?php if($student[0]['id_spec'] == $item['id']) {echo "selected"; }?> value="<?=$item['id']?>"><?=$item['code']?> - <?=$item['title']?></option>
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
				<td class="farmon_number" style="display: none;">
					<label for="farmon_number"><span class="text-c-red">*</span> Рақами фармон:</label>
					<input autocomplete="off" type="text" name="farmon_number" id="farmon_number" class="form-control" required>
				</td>
				
				<td class="farmon_date"  style="display: none;">
					<label for="farmon_date"><span class="text-c-red">*</span> Санаи фармон:</label>
					<input type="date" name="farmon_date" id="farmon_date" class="form-control" required>
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
	
	
	<br>
	<br>
	<br>
	
	<h6 class="center">Маълумотҳои шахсии донишҷӯ</h6>
	<hr style="margin: 0 0 20px 0;">
	<form action="<?=MY_URL?>?option=students&action=update_user" method="post" enctype="multipart/form-data">
		<table class="addform">
			<tr>
				<td colspan="2">
					<label for="fullname">Ном, насаб, номи падар:</label>
					<input value="<?=$student[0]['fullname']?>" type="text" name="fullname" id="fullname" class="form-control">	
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
				<td colspan="3">
					<div style="display: none" class="alert alert-danger alert-dismissable growl-animated animated fadeInDown myalertred"><i class="fa fa-warning"></i> Логин банд аст!</div>
					<div style="display: none" class="alert alert-success alert-dismissable growl-animated animated fadeInDown myalertgreen"><i class="fa fa-check-circle"></i> Логин банд нест! Давом диҳед</div>
				</td>
			</tr>
			
			<tr>
				<td class="w33">
					<label for="login">Логин:</label>
					<input value="<?=$student[0]['login']?>" autocomplete="off" required type="text" name="login" id="login" class="form-control">
				</td>
				
				<td class="w33">
					<label for="password">Парол:</label>
					<input value="<?=$student[0]['password']?>" autocomplete="off" required type="text" name="password" id="password" class="form-control">
				</td>
				
				<td class="w33">
					<label for="photo">Расмро интихоб кунед:</label><br>
					<input type="file" name="photo" id="photo" style="width: 160px">
				</td>
			</tr>
			
			<tr>
				<td>
					<label for="birthday">Рузи таввалуд:</label>
					<input value="<?=$student[0]['birthday']?>" type="date" name="birthday" id="birthday" class="form-control">
				</td>
				
				<td>
					<label for="number_passport">Рақами шиноснома:</label>
					<input value="<?=$student[0]['number_passport']?>" autocomplete="off" type="text" name="number_passport" id="number_passport" placeholder="A02319960" class="form-control">
				</td>
				
				<td>
					<label for="phone">Телефон:</label>
					<input value="<?=$student[0]['phone']?>" autocomplete="off" type="text" name="phone" class="form-control" placeholder="+992987654321">
				</td>
			</tr>
			
			<tr>
				<td>
					<label for="id_country">Кишвар:</label>
					<select name="id_country" id="id_country" class="form-control">
						<?php foreach($countries as $item):?>
							<option <?php if($student[0]['id_country'] == $item['id']){ echo "selected"; } ?> value="<?=$item['id'];?>"><?=$item['title']?></option>
						<?php endforeach;?>
					</select>	
				</td>
				
				<td>
					<label for="id_region">Вилоят/Минтақа:</label>
					<select name="id_region" id="id_region" class="form-control">
						<option value="">-Интихоб кунед-</option>
						<?php foreach($regions as $item):?>
							<option <?php if($student[0]['id_region'] == $item['id']){ echo "selected"; } ?> value="<?=$item['id'];?>"><?=$item['name']?></option>
						<?php endforeach;?>
					</select>	
				</td>
				
				<td>
					<label for="id_district">Ноҳия/Шаҳр:</label>
					<select name="id_district" id="id_district" class="form-control">
						<option value="">-Вилоятро интихоб кунед-</option>
						<?php foreach($districts as $item):?>
							<option <?php if($student[0]['id_district'] == $item['id']){ echo "selected"; } ?> value="<?=$item['id'];?>"><?=$item['name']?></option>
						<?php endforeach;?>
					</select>	
				</td>
			</tr>
			
			<tr>
				<td>
					<label for="id_nation">Миллат:</label>
					<select name="id_nation" id="id_nation" class="form-control">
						<?php foreach($nations as $item):?>
							<option <?php if($student[0]['id_nation'] == $item['id']){ echo "selected"; } ?> value="<?=$item['id'];?>"><?=$item['title']?></option>
						<?php endforeach;?>
					</select>	
				</td>
				
				<td colspan="2">
					<label for="current_address">Ҷойи зист:</label>
					<input value="<?=$student[0]['current_address']?>" autocomplete="off" type="text" name="current_address" id="current_address" class="form-control">
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