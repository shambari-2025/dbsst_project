<ul class="nav nav-tabs md-tabs" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Иловакунии дастӣ</a>
		<div class="slide"></div>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Импорткунии файл</a>
		<div class="slide"></div>
	</li>
	
</ul>

<div class="tab-content card-block">
	<div class="tab-pane active" id="home3" role="tabpanel">
		<form action="<?=MY_URL?>?option=questions&action=add" method="post" enctype="multipart/form-data" onkeypress="if(event.keyCode == 13) return false;">
			<table class="addform" >
				<tr>
					<td>
						<label for="type">Намуди савол:</label>
						
						<select name="type" id="type" class="form-control" required>
							<?php foreach($questions_type as $v => $k):?>
								<option value="<?=$v;?>"><?=$k?></option>
							<?php endforeach;?>
						</select>		
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="count">Миқдори савол:</label>
						
						<select name="count" id="count" class="form-control" required>
							<?php for($i = 1; $i <= 20; $i++):?>
								<option value="<?=$i?>"><?=$i?> савол</option>
							<?php endfor;?>
						</select>		
					</td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="id_iqtibos" value="<?=$id_iqtibos?>">
						<button type="submit" class="btn btn-success">Сабт кардан</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div class="tab-pane" id="profile3" role="tabpanel">
		<form action="<?=MY_URL?>?option=questions&action=insert" method="post" enctype="multipart/form-data" onkeypress="if(event.keyCode == 13) return false;">
			<table class="addform" >
				<tr>
					<td>
						<label for="type">Намуди савол:</label>
						
						<select name="type" id="type" class="form-control" required>
							<?php foreach($questions_type as $v => $k):?>
								<option value="<?=$v;?>"><?=$k?></option>
							<?php endforeach;?>
						</select>		
					</td>
				</tr>
				<tr>
					<td>
						<label for="file">Файлро саволномаро интихоб кунед(.docx):</label>
						<input type="file" name="savolnoma" id="savolnoma">
					</td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="lang" id="lang" value="<?=$lang?>">
						<input type="hidden" name="id_iqtibos" value="<?=$id_iqtibos?>">
						<button type="submit" class="btn btn-success">Сабт кардан</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
</div>




<script type="text/javascript">
	$(document).ready(function () {
		
	});
</script>