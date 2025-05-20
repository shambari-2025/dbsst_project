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
							Эълонҳо
						</li>
						<li class="breadcrumb-item">
							Таҳриркунӣ
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="<?=URL;?>test/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?=URL;?>test/ckfinder/ckfinder.js"></script>
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h5>Таҳриркунӣ</h5>
								</div>
								<div class="card-block">
									
									<form action="<?=MY_URL?>?option=elonho&action=update" method="post" enctype="multipart/form-data">
										<table class="addform">
											<tr>
												<td>
													<label for="type">Ба ки:</label>
													<select name="type" id="type" class="form-control" required>
														<option <?php if($elon[0]['type'] == 3):?>selected<?php endif;?> value="3">Ба ҳама</option>
														<option <?php if($elon[0]['type'] == 2):?>selected<?php endif;?> value="2">Ба омӯзгорон</option>
														<option <?php if($elon[0]['type'] == 1):?>selected<?php endif;?> value="1">Ба донишҷӯён</option>
													</select>
												</td>
											</tr>
											
											<tr>
												<td>
													<label for="title">Мавзуъ:</label>
													<input value="<?=$elon[0]['title']?>" type="text" name="title" id="title" class="form-control" required>	
												</td>
											</tr>
											
											<tr>
												<td>
													<label>Матн:</label>
													<div class="pad">
														<div class="mb-3">
															<textarea id="editor" name="text"><?=$elon[0]['text']?></textarea>
															<script type="text/javascript">
																CKEDITOR.replace( 'editor', {
																	height: 300,
																	filebrowserBrowseUrl: 'http://sdo.techuni.tj/test/ckfinder/ckfinder.html',
																	filebrowserImageBrowseUrl: 'http://sdo.techuni.tj/test/ckfinder/ckfinder.html?type=Images',
																	filebrowserUploadUrl: 'http://sdo.techuni.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
																	filebrowserImageUploadUrl: 'http://sdo.techuni.tj/test/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
																});
															</script>
														</div>
													</div>
												</td>
											</tr>
										</table>
										
										<table style="width:100%">
											<tr>
												<td colspan="2">
													<input type="hidden" value="<?=$id?>" name="id">
													<button type="submit" class="btn btn-success">Сабти тағйирот</button>
												</td>
												
											</tr>
										</table>
									</form>
									
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>