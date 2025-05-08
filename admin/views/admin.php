<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$page_info['title']?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="author" content="Ahmadjon Boboev" />
		<meta name="theme-color" content="#263544" />
		
		<link rel="icon" type="image/png" href="<?=URL?>userfiles/logo.ico"/>
		
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/waves.min.css"  media="all">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/themify-icons.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/font-awesome-n.min.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/icofont.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/morris.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/simple-line-icons.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/feather.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/widget.css">
		<link rel="stylesheet" type="text/css" href="<?=TMPL_URL?>css/my_style.css">
		
		<script type="text/javascript" src="<?=TMPL_URL?>js/jquery.min.js"></script>
		<script src="<?=TMPL_URL?>js/jquery.snow.js"></script>
		
		<script>
			// jQuery(function() {
				// jQuery("body").snow({
					// intensity: 10,
					// sizeRange: [6, 20],
					// opacityRange: [0.4, 1],
					// driftRange: [10, 20],
					// speedRange: [55, 120]
				// });
			// });
		</script>
		
		<style type="text/css">
			.snowflake {
			-webkit-animation: spin 4s linear infinite;
			-moz-animation: spin 4s linear infinite;
			animation: spin 4s linear infinite;
			}
			@-moz-keyframes 
			spin { 100% {
			-moz-transform: rotate(360deg);
			}
			}
			@-webkit-keyframes 
			spin { 100% {
			-webkit-transform: rotate(360deg);
			}
			}
			@keyframes 
			spin { 100% 
				{
				-webkit-transform: rotate(360deg);
				transform:rotate(360deg);
				}
			}
		</style>
		
		<script src="<?=TMPL_URL?>js/raphael.min.js" type="d8424a08d31b5b8b406fded2-text/javascript"></script>
		<script src="<?=TMPL_URL?>js/morris.js" type="d8424a08d31b5b8b406fded2-text/javascript"></script>
		
	</head>
	<body>
		
		<!--
		<div class="loader-bg">
			<div class="loader-bar"></div>
		</div>
		-->
		<div id="pcoded" class="pcoded">
			<div class="pcoded-overlay-box"></div>
			<div class="pcoded-container navbar-wrapper">

				<?php include("includes/header-navbar.php");?>
				<?php //include("includes/chat-bar.php");?>
				<?php //include("includes/chat-content.php");?>

				<div class="pcoded-main-container">
					<div class="pcoded-wrapper">
						<nav class="pcoded-navbar">
							<?php include("includes/menu.php")?>
						</nav>
						<?php include("pages/{$file}.php")?>
						<div id="styleSelector"></div>
					</div>
				</div>
			</div>
		</div>
		
		<script type="d8424a08d31b5b8b406fded2-text/javascript" src="<?=TMPL_URL?>js/jquery-ui.min.js"></script>
		
		<script type="ce266f6df96e47b4bc9ad205-text/javascript" src="<?=TMPL_URL?>js/accordion.js"></script>
		
		<script type="d8424a08d31b5b8b406fded2-text/javascript" src="<?=TMPL_URL?>js/popper.min.js"></script>
		<script type="d8424a08d31b5b8b406fded2-text/javascript" src="<?=TMPL_URL?>js/bootstrap.min.js"></script>

		<script src="<?=TMPL_URL?>js/waves.min.js" type="d8424a08d31b5b8b406fded2-text/javascript"></script>

		<script type="d8424a08d31b5b8b406fded2-text/javascript" src="<?=TMPL_URL?>js/jquery.slimscroll.js"></script>
		
		<script src="<?=TMPL_URL?>js/pcoded.min.js" type="d8424a08d31b5b8b406fded2-text/javascript"></script>
		
		<script src="<?=TMPL_URL?>js/vertical-layout.min.js" type="d8424a08d31b5b8b406fded2-text/javascript"></script>
		
		<script type="6a728206c8ede063a939d6d6-text/javascript" src="<?=TMPL_URL?>js/widget-statistic.js"></script>
		
		<script type="d8424a08d31b5b8b406fded2-text/javascript" src="<?=TMPL_URL?>js/script.min.js"></script>

		<script src="<?=TMPL_URL?>js/rocket-loader.min.js" data-cf-settings="d8424a08d31b5b8b406fded2-|49" defer=""></script>
		
		<script>
			function confirmDel() {
				if (confirm("Шумо ин сабтро нест кардан мехоҳед?")) {
					return true;
				} else {
					return false;
				}
			}
		</script>
		
	</body>
</html>