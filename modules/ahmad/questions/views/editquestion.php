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
							Таҳиркунии савол
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
					<form action="<?=MY_URL?>?option=questions&action=update_question" method="post" enctype="multipart/form-data">
						<div class="row">
							<?php include("edit/{$type}.php");?>
							
							<div class="mb-3" style="padding-left: 15px;">
								<input type="hidden" name="id" id="id" value="<?=$id?>">
								<input type="hidden" name="type" id="type" value="<?=$type?>">
								<input type="hidden" name="url" value="<?=@$_SERVER['HTTP_REFERER'];?>">
								<button type="submit" class="btn btn-success">Сабткунии тағйирот</button>
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