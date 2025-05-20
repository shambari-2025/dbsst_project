	
	<form action="<?=MY_URL?>?option=teachers&action=update_user" method="post" enctype="multipart/form-data">
		<table class="addform">
			<tr>
				<td colspan="2">
					<label for="fullname">Ном, насаб, номи падар:</label>
					<input value="<?=$teacher[0]['fullname_tj']?>" type="text" name="fullname" id="fullname" class="form-control">	
				</td>
				<td>
					<label for="jins">Ҷинс:</label>
					<select name="jins" id="jins" class="form-control" required>
						<option <?php if($teacher[0]['jins'] == 1){ echo "selected";}?> value="1">Мард</option>
						<option <?php if($teacher[0]['jins'] == 0){ echo "selected";}?> value="0">Зан</option>
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
					<input value="<?=$teacher[0]['login']?>" autocomplete="off" required type="text" name="login" id="login" class="form-control">
				</td>
				
				<td class="w33">
					<label for="password">Парол:</label>
					<input value="<?=$teacher[0]['password']?>" autocomplete="off" required type="text" name="password" id="password" class="form-control">
				</td>
				
				<td class="w33">
					<label for="photo">Расмро интихоб кунед:</label><br>
					<input type="file" name="photo" id="photo" style="width: 160px">
				</td>
			</tr>
			
			<tr>
				<td>
					<label for="birthday">Рузи таввалуд:</label>
					<input value="<?=$teacher[0]['birthday']?>" type="date" name="birthday" id="birthday" class="form-control">
				</td>
				
				<td>
					<label for="number_passport">Рақами шиноснома:</label>
					<input value="<?=$teacher[0]['number']?>" autocomplete="off" type="text" name="number_passport" id="number_passport" placeholder="A02319960" class="form-control">
				</td>
				
				<td>
					<label for="phone">Телефон:</label>
					<input value="<?=$teacher[0]['phone']?>" autocomplete="off" type="text" name="phone" class="form-control" placeholder="+992987654321">
				</td>
			</tr>
			
			<tr>
				<td>
					<label for="id_country">Кишвар:</label>
					<select name="id_country" id="id_country" class="form-control">
						<?php foreach($countries as $item):?>
							<option <?php if($teacher[0]['id_country'] == $item['id']){ echo "selected"; } ?> value="<?=$item['id'];?>"><?=$item['title']?></option>
						<?php endforeach;?>
					</select>	
				</td>
				
				<td>
					<label for="id_region">Вилоят/Минтақа:</label>
					<select name="id_region" id="id_region" class="form-control">
						<option value="">-Интихоб кунед-</option>
						<?php foreach($regions as $item):?>
							<option <?php if($teacher[0]['id_region'] == $item['id']){ echo "selected"; } ?> value="<?=$item['id'];?>"><?=$item['name']?></option>
						<?php endforeach;?>
					</select>	
				</td>
				
				<td>
					<label for="id_district">Ноҳия/Шаҳр:</label>
					<select name="id_district" id="id_district" class="form-control">
						<option value="">-Вилоятро интихоб кунед-</option>
						<?php foreach($districts as $item):?>
							<option <?php if($teacher[0]['id_district'] == $item['id']){ echo "selected"; } ?> value="<?=$item['id'];?>"><?=$item['name']?></option>
						<?php endforeach;?>
					</select>	
				</td>
			</tr>
			
			<tr>
				<td>
					<label for="id_nation">Миллат:</label>
					<select name="id_nation" id="id_nation" class="form-control">
						<?php foreach($nations as $item):?>
							<option <?php if($teacher[0]['id_nation'] == $item['id']){ echo "selected"; } ?> value="<?=$item['id'];?>"><?=$item['title']?></option>
						<?php endforeach;?>
					</select>	
				</td>
				
				<td colspan="2">
					<label for="current_address">Ҷойи зист:</label>
					<input value="<?=$teacher[0]['address']?>" autocomplete="off" type="text" name="current_address" id="current_address" class="form-control">
				</td>
			</tr>
			
			<tr>
				<td>
					<br>
					<input type="hidden" name="id_teacher" value="<?=$id_teacher?>">
					<button type="submit" class="updatebtn btn btn-inverse waves-effect waves-light">
						<i class="fa fa-save"></i> Сабти тағйиротҳо
					</button>
				</td>
			</tr>
		</table>
	</form>


<script type="text/javascript">
	jQuery(document).ready(function($){
		
		
		
		$('#login').on('propertychange input',function(){
			var login = $(this).val();
			var id_teacher = <?=$id_teacher?>;
			
			$.trim(login);
			if(login == ''){
				return false;
			}
			
			console.log(login);
			var url = '<?=URL."modules/teachers/teachers_ajax.php?option=isBusylogin";?>';
			
			$.ajax({
				type: 'post',
				url: url,
				data: {"login": login, "id_teacher": id_teacher},
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
			var url = '<?=URL."modules/teachers/teachers_ajax.php?option=getDistricts";?>';
			
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