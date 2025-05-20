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
							<?=getFan($id_fan)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getWeek($id_week)?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="<?=URL;?>/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?=URL;?>/ckeditor/translations/ru.js"></script>
	<script type="text/javascript" src="<?=URL;?>/ckfinder/ckfinder.js"></script>
	
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
															<script>
																// This sample still does not showcase all CKEditor 5 features (!)
																// Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
																CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
																	// https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
																	ckfinder: {
																		uploadUrl: '<?=URL?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
																	},
																	
																	toolbar: {
																		items: [
																			'ckfinder', '|',
																			'Mathtype', '|',
																			'exportPDF','exportWord', '|',
																			'findAndReplace', 'selectAll', '|',
																			'heading', '|',
																			'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
																			'bulletedList', 'numberedList', 'todoList', '|',
																			'outdent', 'indent', '|',
																			'undo', 'redo',
																			'-',
																			'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
																			'alignment', '|',
																			'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
																			'specialCharacters', 'horizontalLine', 'pageBreak', '|',
																			'textPartLanguage', '|',
																			'sourceEditing'
																		],
																		shouldNotGroupWhenFull: true
																	},
																	// Changing the language of the interface requires loading the language file using the <script> tag.
																	language: 'ru',
																	list: {
																		properties: {
																			styles: true,
																			startIndex: true,
																			reversed: true
																		}
																	},
																	// https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
																	heading: {
																		options: [
																			{ model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
																			{ model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
																			{ model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
																			{ model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
																			{ model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
																			{ model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
																			{ model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
																		]
																	},
																	// https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
																	placeholder: 'Матнтро инҷо нависед!',
																	// https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
																	fontFamily: {
																		options: [
																			'default',
																			'Palatino Linotype',
																			'Arial, Helvetica, sans-serif',
																			'Tahoma, Geneva, sans-serif',
																			'Times New Roman, Times, serif',
																			'Verdana, Geneva, sans-serif'
																		],
																		supportAllValues: true
																	},
																	// https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
																	fontSize: {
																		options: [ 10, 12, 14, 'default', 18, 20, 22 ],
																		supportAllValues: true
																	},
																	// Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
																	// https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
																	htmlSupport: {
																		allow: [
																			{
																				name: /.*/,
																				attributes: true,
																				classes: true,
																				styles: true
																			}
																		]
																	},
																	// Be careful with enabling previews
																	// https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
																	htmlEmbed: {
																		showPreviews: true
																	},
																	// https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
																	link: {
																		decorators: {
																			addTargetToExternalLinks: true,
																			defaultProtocol: 'http://',
																			toggleDownloadable: {
																				mode: 'manual',
																				label: 'Downloadable',
																				attributes: {
																					download: 'file'
																				}
																			}
																		}
																	},
																	// https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
																	mention: {
																		feeds: [
																			{
																				marker: '@',
																				feed: [
																					'@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
																					'@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
																					'@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
																					'@sugar', '@sweet', '@topping', '@wafer'
																				],
																				minimumCharacters: 1
																			}
																		]
																	},
																	// The "super-build" contains more premium features that require additional configuration, disable them below.
																	// Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
																	removePlugins: [
																		// These two are commercial, but you can try them out without registering to a trial.
																		// 'ExportPdf',
																		// 'ExportWord',
																		//'CKBox',
																		//'CKFinder',
																		//'EasyImage',
																		// This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
																		// https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
																		// Storing images as Base64 is usually a very bad idea.
																		// Replace it on production website with other solutions:
																		// https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
																		// 'Base64UploadAdapter',
																		'RealTimeCollaborativeComments',
																		'RealTimeCollaborativeTrackChanges',
																		'RealTimeCollaborativeRevisionHistory',
																		'PresenceList',
																		'Comments',
																		'TrackChanges',
																		'TrackChangesData',
																		'RevisionHistory',
																		'Pagination',
																		'WProofreader',
																		// Careful, with the Mathtype plugin CKEditor will not load when loading this sample
																		// from a local file system (file://) - load this site via HTTP server if you enable MathType
																		//'MathType'
																	]
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
													<input type="hidden" name="id_jd" value="<?=$lesson[0]['id_jd']?>">
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