<style>
	.card-block label {
		cursor: pointer;
		display: block;
		margin: 5px 0;
	}
</style>

<script src="<?=TMPL_URL?>js/timer.js" type="text/javascript"></script>
<script type="text/javascript">
	var myDate = new Date();

	function returnEndDate(m){
		myDate.setMinutes(myDate.getMinutes()+m);
		return myDate;
	}
	
	if($.cookie("timer")){
		var dateEnd = $.cookie("timer");
	}else{
		var dateEnd = returnEndDate(<?=MINUTES;?>);
		$.cookie("timer", dateEnd);
	}
</script>

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
							Супоридани триместр
						</li>
						<li class="breadcrumb-item">
							<?=getStudyYear(S_Y)?>
						</li>
						
						<li class="breadcrumb-item">
							Нимсолаи <?=(H_Y)?>
						</li>
						
						<li class="breadcrumb-item">
							<?=getFanTest($id_fan)?>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<style>
		.muvofiqat {
			width: 100%;
		}

		.muvofiqat td {
			vertical-align: top;
		}

		.muvofiqat td p.p_type2 {
			margin-right: 10px;
		}

		.muvofiqat td.table {
		}
		.muvofiqat td table {
			margin: 5px auto;
			width: 90%;
			text-align: center;
			border: 1px solid #ccc;
			border-collapse: collapse;
		}

		.muvofiqat td table td {
			padding: 2px 4px;
			border: 1px solid #ccc;
			vertical-align: middle;
			font-size: 18px;
		}

		.muvofiqat td table td label {
			padding: 0px !important;
			height: 29px;
			width: 29px;
			margin: 2px auto;
		}
		
		.p_type2 {
			border: 1px solid #c5c5c5;
			background: #fff;
			font-weight: normal;
			border-radius: 3px;
			padding: .4em 1em;
			padding-left: 35px;
			position: relative;
			vertical-align: middle;
			overflow: visible;
			margin: 5px auto;
		}
		
		.jqhover {
			background: #007fff !important;
			color: #fff;
		}
	</style>
	
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="row">
						<form action="<?=MY_URL?>?option=sessions&action=result_trimestr" method="post" name="forma" enctype="multipart/form-data" style="width: 100%" onkeypress="if(event.keyCode == 13) return false;">
							<?php $counter = 0;?>
							<?php foreach($_SESSION['questions'] as $item):?>
								<?php $id_question = $item['id'];?>
								
								<?php $answers = query("SELECT * FROM `answers` WHERE `id_question` = '$id_question' AND `text` != '' ORDER BY RAND()"); ?>
								
								<div class="col-xl-12 col-md-12">
									<div class="card">
										<div class="card-header">
											<p class="bold"><?=++$counter?>.</p>
											<?php if($item['type'] != 4):?>
												<?=$item['text']?>
											<?php endif;?>
										</div>
										<?php include("types/{$item['type']}.php");?>
									</div>
									
								</div>
							<?php endforeach;?>
							<input type="hidden" name="id_fan" value="<?=$id_fan?>">
							<button type="submit" class="btn btn-inverse">Натиҷаи санҷиш</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	jQuery(document).ready(function($){
		$(".check").hover(function() {
			var letter = $(this).attr('letter');
			var number = $(this).attr('number');
			var L = $(this).parent().parent().parent().parent().parent().parent();
			var N = $(this).parent().parent().parent().parent().parent().parent();
			L.find("p[class^='" +letter+ "']").addClass("jqhover");
			L.find("p[number^='" +number+ "']").addClass("jqhover");
		}, function() {
			var letter = $(this).attr('letter');
			var number = $(this).attr('number');
			
			var L = $(this).parent().parent().parent().parent().parent().parent();
			var N = $(this).parent().parent().parent().parent().parent().parent();
			L.find("p[class^='" +letter+ "']").removeClass("jqhover");
			L.find("p[number^='" +number+ "']").removeClass("jqhover");
		});
	});
</script>
