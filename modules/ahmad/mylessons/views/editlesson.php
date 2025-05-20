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
							Таҳриркунӣ
						</li>
						
						<li class="breadcrumb-item">
							Мавзуъ
						</li>
						
						<li class="breadcrumb-item">
							<?=getFacultyShort($id_faculty)?>
						</li>
						<li class="breadcrumb-item">
							<?=getCourse($id_course)?>
						</li>
						<li class="breadcrumb-item">
							<?=getSpecialtyCode($id_spec)?>
							<?=getGroup($id_group)?>
						</li>						
						<li class="breadcrumb-item">
							<?=getFanTest($id_fan)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getWeek($id_week)?>
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
									<h5>Таҳриркунии мавзуъ</h5>
								</div>
								<div class="card-block">
									
									<form action="<?=MY_URL?>?option=mylessons&action=update_lesson" method="post" enctype="multipart/form-data">
										<table class="addform">
											<tr>
												<td>
													<label for="title">Номи мавзуъ:</label>
													<input value="<?=$lesson[0]['title']?>" type="text" name="title" id="title" class="form-control" required>	
												</td>
											</tr>
											
											<tr>
												<td>
													<label>Матн:</label>
													<div class="pad">
														<div class="mb-3">
															<textarea id="editor" name="text"><?=$lesson[0]['text']?></textarea>
															<script type="text/javascript">
																CKEDITOR.replace( 'editor', {
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
													<br>
													<input type="hidden" name="id_iqtibos" value="<?=$id_iqtibos?>">
													<input type="hidden" name="id" value="<?=$id?>">
													<button type="submit" class="btn btn-success">Сабт кардан</button>
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