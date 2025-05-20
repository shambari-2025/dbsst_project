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
							<?=$page_info['title']?>
						</li>
						<li class="breadcrumb-item" title="<?=$group_options[0]['faculty_title']?>">
							<?=getUserName($id_student);?>
						</li>						
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						<div class="col-sm-12">
							
							<!-- Large modal -->
							<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-lg" style="max-width: 80%;">
									<div class="modal-content">
										<div class="modal-header">
											<h6 class="modal-title" id="myModalLabel"></h6>
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
										</div>
										<div class="modal-body" id="bigmodal">
											
										</div>
									</div>
								</div>
							</div>
							<!-- Large modal -->
							
							
							
							<!-- FANHO -->
							
							<div class="card">
								<div class="card-header">
									<h5>ЭЗОҲ: Шумо ҳамчун мутасаддӣ барои дурустии маълумотҳои пуркардаатон масъул мебошед!!! </h5>
								</div>
								<div class="card-block">
									<div class="table-responsive">
										<form action="<?=MY_URL?>?option=students&action=insert_farmon" method="post" enctype="multipart/form-data">
											<table class="addform">
												<tr>
													<td colspan="2">
														<label for="type">Намуди фармон</label>
														<select name="type" id="type" class="form-control" required>
															<?php foreach($ftypes as $f):?>
																<option value="<?=$f['id']?>"><?=$f['title_tj']?></option>
															<?php endforeach;?>
														</select>
													</td>
												</tr>
												
												<tr>
													<td>
														<label for="farmon_number">Рақами фармон:</label>
														<input autocomplete="off" type="text" name="farmon_number" id="farmon_number" class="form-control">
													</td>
													
													<td>
														<label for="farmon_date">Санаи фармон:</label>
														<input type="date" name="farmon_date" id="farmon_date" class="form-control">
													</td>
												</tr>
												
												<tr>
													<td colspan="2">
														<label for="farmon_text">Матни фармон:</label>
														<input autocomplete="off" type="text" name="farmon_text" id="farmon_text" class="form-control">
													</td>												
												</tr>
												<tr>
													<td colspan="2">
														<label for="asos_text">Асос:</label>
														<input autocomplete="off" type="text" name="asos_text" id="asos_text" class="form-control">
													</td>												
												</tr>
												
												
												<tr>
													<td>
														<input type="hidden" name="id_student" value="<?=$id_student?>">
														<br>
														<button type="submit" class="btn btn-inverse waves-effect waves-light">
															<i class="fa fa-save"></i> Сабт кардан
														</button>
													</td>
												</tr>
											</table>
										<form>
									</div>
								</div>
							</div>
							
							<!-- FANHO -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	jQuery(document).ready(function($){
		
	});
</script>
