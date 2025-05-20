<?php
	
	$from_date = $trimestr[0]['date'];
	$dateTime = new DateTime($from_date);
	$dateTime->add(new DateInterval('P30D'));
	$to_date = $dateTime->format('Y-m-d');
	$summa_suporid = count_summa_where("rasidho", "check_money", "`id_student` = '$id_student' AND `type` = '3' AND `payed` = '1' AND `check_date` >= '$from_date' AND `check_date` <= '$to_date'");
	
	$summa_trimestr = $trimestr[0]['all_money'];
?>

<?php if($id_s_t == 1):?>
		<?php 
			$mablagi_shartnoma = getSharnomaMoneyBySY($id_course, $id_spec, $id_s_l, $id_s_v, $S_Y, $foreign);
			$mablag_suporid = getMoneyShartnoma($id_student, $S_Y);
		?>	
		<?php if(($mablagi_shartnoma / 2) > $mablag_suporid):?>
			<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
				<i class="fa fa-warning"></i> <?=getUserName($id_student)?> бинобар насупоридани маблағи шартномаи таҳсил ҳуқуқи супоридани триместрро надорад!
			</div>
		<?php $flag = false;?>
		<?php endif;?>
<?php endif;?>


<?php if(($summa_suporid < $summa_trimestr)):?>
	<div class="alert alert-warning alert-dismissable growl-animated animated fadeInDown myalert">
		<i class="fa fa-warning"></i> Донишҷӯ маблағи триместрро пардохт накардааст!<br>
		Пас аз пардохти маблағи тримест ба андозаи <u><?=$summa_trimestr?></u>-сомонӣ ба донишҷӯ баҳо гузошта метавонед!
	</div>
	<?php $flag = false;?>
<?php endif;?>





<?php if($flag):?>
	<?php// print_arr($trimestr);?>
	<p class="center" style="color:red; font-size: 15px;">Холҳо дар фосилаи аз 50 то 100 гузошта шаванд. <br>Дар дигар ҳолатҳо маълумоти воридкардаи Шумо сабт карда намешавад!!!</p>
	<hr style="margin: 0 0 20px 0;">
	<form action="<?=MY_URL?>?option=teachers&action=insert_score_trimestr" method="post" enctype="multipart/form-data">
		<table class="table" style="font-size: 14px !important">
			<tr style="background-color: #263544; color: #fff">
				<th style="width: 5%;">№</th>
				<th style="width: 5%;">ID</th>
				<th>Фан</th>
				<th style="width: 5%;">Хол</th>
			</tr>
			<?php $i=1;?>
			<?php foreach($trimestr as $item):?>
				<tr class="center">
					<td><?=$i;?>.</td>
					<td><?=$item['id']?><input type="hidden" name="trimestr[<?=$i?>]" value="<?=$item['id']?>"></td>
					<td class="left"><?=getFanTest($item['id_fan'])?></td>
					<td><input type="number" name="score[]" required min="50" max="100"></td>
				</tr>
				<?php $i++;?>
			<?php endforeach;?>
		</table>
		<table class="addform">		
			<tr>
				<td>
					<br>
					<input type="hidden" name="id_student" value="<?=$id_student?>">
					<input type="hidden" name="s_y" value="<?=$S_Y?>">
					<input type="hidden" name="h_y" value="<?=$H_Y?>">
					<button type="submit" class="updatebtn btn btn-inverse waves-effect waves-light">
						<i class="fa fa-save"></i> Сабти маълумотҳо
					</button>
				</td>
			</tr>
		</table>
	</form>
<?php endif;?>
	


<script type="text/javascript">
	jQuery(document).ready(function($){
		
	});
</script>