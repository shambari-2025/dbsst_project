<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-12">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?=MY_URL?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							Иловакунии савол
						</li>
						<li class="breadcrumb-item" title="<?=$group_options[0]['faculty_title']?>">
							<?=$group_options[0]['faculty_short']?>
						</li>
						
						<li class="breadcrumb-item">
							<?=$group_options[0]['s_l_title']?>
						</li>
						
						<li class="breadcrumb-item">
							<?=$group_options[0]['s_v_title']?>
						</li>
						<li class="breadcrumb-item">
							<?=$group_options[0]['course_title']?>
						</li>
						<li class="breadcrumb-item" title="<?=$group_options[0]['spec_title_tj']?>">
							<?=$group_options[0]['spec_code']?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getFanTest($id_fan)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getLang($lang)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=$questions_type[$type]?>
						</li>
						
						<li class="breadcrumb-item">
							<?=$count?> адад
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<!--
	<script type="text/javascript" src="<?=URL;?>/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?=URL;?>/ckeditor/translations/ru.js"></script>
	<script type="text/javascript" src="<?=URL;?>/ckfinder/ckfinder.js"></script>
	-->
	
	<script type="text/javascript" src="<?=URL;?>test/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?=URL;?>test/ckfinder/ckfinder.js"></script>
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<form action="<?=MY_URL?>?option=questions&action=insert_question" method="post" enctype="multipart/form-data">
						<div class="row">
							<?php for($i = 1; $i <= $count; $i++):?>
								<?php include("type/{$type}.php");?>
							<?php endfor;?>
						
							<div class="mb-3" style="padding-left: 15px;">
								<input type="hidden" name="id_iqtibos" id="id_iqtibos" value="<?=$id_iqtibos?>">
								<input type="hidden" name="type" id="type" value="<?=$type?>">
								<input type="hidden" name="count" id="count" value="<?=$count?>">
								<input type="hidden" name="lang" id="lang" value="<?=$lang?>">
								<button type="submit" class="btn btn-success">Сабткунӣ</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		
	});
</script>