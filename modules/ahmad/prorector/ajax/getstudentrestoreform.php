<h3 style="color: red; text-align:center">Муҳтарам <?=getUserName($_SESSION['user']['id'])?>! Шумо барои барқарор намудани донишҷӯ ва дуруст нишон додани маълумот масъул мебошед. Лутфан бодиққат бошед. Дурустии маълумот ба уҳдаи Шумо аст!</h3>
<form action="<?=MY_URL?>?option=students&action=restore_student" method="post" enctype="multipart/form-data">
	<table class="addform">
		
		<tr>
			<td style="width:50%">
				<label for="farmon_number">Рақами фармон:</label>
				<input autocomplete="off" type="text" name="farmon_number" id="farmon_number" class="form-control" required>
			</td>
			
			<td>
				<label for="farmon_date">Санаи фармон:</label>
				<input type="date" name="farmon_date" id="farmon_date" class="form-control" required>
			</td>			
		</tr>
		<tr>
			<td colspan="2">
				<label for="farmon_text">Матни фармон:</label>
				<input type="text" name="farmon_text" id="farmon_text" class="form-control" required>
			</td>
		</tr>
		
		
		<tr>
			<td style="width:50%">
				<label for="id_faculty">Факултет:</label>
				<select name="id_faculty" id="id_faculty" class="form-control" required>
					<?php foreach($faculties as $item):?>
						<option value="<?=$item['id'];?>"<?php if($item['id']==$infostd_status0[0]['id_faculty']){echo "selected";}?>><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>
			<td>
				<label for="id_course">Курс:</label>
				<select name="id_course" id="id_course" class="form-control" required>
					<?php foreach($courses as $item):?>
						<option value="<?=$item['id'];?>"<?php if($item['id']==$infostd_status0[0]['id_course']){echo "selected";}?>><?=$item['title']?></option>
					<?php endforeach;?>
				</select>
			</td>			
		</tr>
		<tr>
			<td>
				<label for="id_spec">Ихтисос:</label>
				<select name="id_spec" id="id_spec" class="form-control" required>
					<?php foreach($specialties as $item):?>
						<option value="<?=$item['id'];?>"<?php if($item['id']==$infostd_status0[0]['id_spec']){echo "selected";}?>><?=$item['title_tj']?></option>
					<?php endforeach;?>
				</select>
			</td>
			<td>
				<label for="id_group">Гуруҳ:</label>
				<select name="id_group" id="id_group" class="form-control" required>
					<?php foreach($groups as $item):?>
						<option value="<?=$item['id'];?>"<?php if($item['id']==$infostd_status0[0]['id_group']){echo "selected";}?>><?=$item['title']?></option>
					<?php endforeach;?>
				</select>	
			</td>
		</tr>
		
		<tr>
			<td>
				<br>
				<input type="hidden" name="id_status0" value="<?=$id_status0?>">
				<button type="submit" class="updatebtn btn btn-inverse waves-effect waves-light">
					<i class="fa fa-trash"></i> Барқароркунӣ
				</button>
			</td>
		</tr>
		
	</table>
</form>


<script type="text/javascript">
jQuery(document).ready(function($){
	
	
});
</script>