<h6 class="center">Маълумотҳои гурӯҳии донишҷӯ</h6>
<hr style="margin: 0 0 20px 0;">
<form action="<?=MY_URL?>?option=bugalteria&action=update_student" method="post" enctype="multipart/form-data">
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