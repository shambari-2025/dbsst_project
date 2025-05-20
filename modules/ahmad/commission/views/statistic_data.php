<?php if($action == 'commission_statistic'):?>

<style>
	* {
		font-family: "Palatino Linotype";
	}
	
	.bold {
		font-weight: bold
	}
	
	.vertical {
		writing-mode: vertical-rl;
		text-orientation: inherit;
		transform: rotate(180deg);
		margin: 10px;
		margin-block: auto;
		max-height: 200px;
	}
	
	table {
		width: 100%;
		border-collapse: collapse;
		font-size:14px;
	}
	
	th, td {
		padding: 4px;
		border: 1px solid #000;
	}
	
	.hujjatho td {
		padding: 2px;
	}
	
	.center {
		text-align: center
	}
	
	
	@page {
		size: landscape;
	}
</style>

<?php endif;?>

<p class="center">Қабули ҳуҷҷатҳои довталабон аз ММТНПҶТ дар <?=UNI_NAME?><br> барои соли таҳсили 20<?=S_Y?>-20<?=(S_Y+1)?> 
<?php if($date_start && $date_finish):?>
	(аз саннаи <?=formatdate($date_start)?> то <?=formatdate($date_finish)?>)
<?php endif?>
</p>

<div class="table-responsive davrifaol">
	<table class="table" >
		<tbody>
			<tr class="center">
				<td rowspan="2">№</td>
				<td rowspan="2">Факултетҳо</td>
				<td colspan="4">Аз ММТНПҶТ</td>
				<td rowspan="2"><div class="vertical">Квотаҳо</div></td>
				<td rowspan="2"><div class="vertical">Хориҷӣ</div></td>
				<td colspan="3">Баъди коллеҷ</td>
				<td rowspan="2"><div class="vertical">МДОК</div></td>
				<td colspan="2">Магистр</td>
				<td colspan="2">Доктор PhD</td>
				<td colspan="3">Қабули дохили</td>
				<td rowspan="2">Ҳамагӣ</td>
			</tr>
			<tr class="center">
				<td>Буҷ<br>Руз</td>
				<td>Ш-вӣ<br>Руз</td>
				<td>Ш-вӣ<br>Фос</td>
				<td style="width: 90px">Ҳамагӣ<br>(аз ММТ)</td>
				<td>Ш-вӣ</td>
				<td>Буҷ</td>
				<td>Фос</td>
				<td>Ш-вӣ</td>
				<td>Буҷ</td>
				<td>Ш-вӣ</td>
				<td>Буҷ</td>
				<td>Ш-вӣ<br>Руз</td>
				<td>Ш-вӣ<br>Фос</td>
				<td>Буҷ<br>(руз)</td>
			</tr>
			<?php $counter = 0;?>
			<?php $b_r_t = $sh_r_t = $sh_f_t = 0;?>
			
			<?php $h_kvota = $h_xoriji = $h_mdok = 0;?>
			<?php $h_a_k_sh = $h_a_k_b = $h_a_k_f = 0;?>
			
			
			<?php $h_mag_sh = $h_mag_b = 0;?>
			<?php $h_Phd_sh = $h_Phd_b = 0;?>
			
			<?php $h_q_d_sh_r = $h_q_d_sh_f = $h_q_d_b_r_f = 0;?>
			
			<?php $total = 0;?>
			<?php foreach($_SESSION['commission'] as $f_item):?>
			<tr class="center">
				<td><?=++$counter?>.</td>
				<td class="left"><?=$f_item['short']?></td>
				<td>
					<?=$b_r = getStatisticMMT($f_item['id'], 1, 1, 2, $date_start, $date_finish)?>
					<?php $b_r_t += $b_r?>
				</td>
				<td>
					<?=$sh_r = getStatisticMMT($f_item['id'], 1, 1, 1, $date_start, $date_finish)?>
					<?php $sh_r_t += $sh_r?>
				</td>
				<td>
					<?=$sh_f = getStatisticMMT($f_item['id'], 1, 2, 1, $date_start, $date_finish)?>
					<?php $sh_f_t += $sh_f?>
				</td>
				<td>
					<?=($b_r + $sh_r + $sh_f)?><br>
					(<?=getStatisticMMTJins($f_item['id'], 1, false, 1, $date_start, $date_finish)?>-мард<br>
					<?=getStatisticMMTJins($f_item['id'], 1, 1, 0, $date_start, $date_finish)?>-зан Р<br>
					<?=getStatisticMMTJins($f_item['id'], 1, 2, 0, $date_start, $date_finish)?>-зан Ф)
					
					<!--25 (10-мард <br> 8-зан Р<br>
					12-зан Ф
					)-->
				</td>
				
				<!-- Квота -->
				<td>
					<?=$kvota = getStatisticKvota($f_item['id'], 1, $date_start, $date_finish)?>
					<?php $h_kvota += $kvota;?>
				</td>
				<!-- Квота -->
				
				<!-- Хориҷӣ-->
				<td>
					<?=$xoriji = getStatisticXoriji($f_item['id'], $date_start, $date_finish)?>
					<?php $h_xoriji += $xoriji;?>
				</td>
				<!-- Хориҷӣ-->
				
				<td>
					<?=$a_k_sh = getStatisticAfterCollege($f_item['id'], 1, 1, $date_start, $date_finish)?>
					<?php $h_a_k_sh += $a_k_sh?>
				</td>
				<td>
					<?=$a_k_b = getStatisticAfterCollege($f_item['id'], 1, 2, $date_start, $date_finish)?>
					<?php $h_a_k_b += $a_k_b?>
				</td>
				<td>
					<?=$a_k_f = getStatisticAfterCollege($f_item['id'], 2, false, $date_start, $date_finish)?>
					<?php $h_a_k_f += $a_k_f?>
				</td>
				
				<!-- МДОК-->
				<td>
					<?=$mdok = getStatisticMDOK($f_item['id'], $date_start, $date_finish)?>
					<?php $h_mdok += $mdok?>
				</td>
				<!-- МДОК-->
				
				
				<!-- Магистр шартномавӣ-->
				<td>
					<?=$mag_sh = getStatisticMagistr($f_item['id'], 1, $date_start, $date_finish)?>
					<?php $h_mag_sh += $mag_sh?>
				</td>
				<!-- Магистр шартномавӣ-->
				
				<!-- Магистр Буҷавӣ-->
				<td>
					<?=$mag_b = getStatisticMagistr($f_item['id'], 2, $date_start, $date_finish)?>
					<?php $h_mag_b += $mag_b?>
				</td>
				<!-- Магистр Буҷавӣ-->
				
				<!-- Phd Шартномавӣ-->
				<td>
					<?=$phd_sh = getStatisticPhd($f_item['id'], 1, $date_start, $date_finish)?>
					<?php $h_Phd_sh += $phd_sh?>
				</td>
				<!-- Phd Шартномавӣ-->
				
				<!-- Phd буҷавӣ-->
				<td>
					<?=$phd_b = getStatisticPhd($f_item['id'], 2, $date_start, $date_finish)?>
					<?php $h_Phd_b += $phd_b?>
				</td>
				<!-- Phd буҷавӣ-->
				
				<td>
					<?=$q_d_sh_r = getStatisticDoxili($f_item['id'], 1, 1, $date_start, $date_finish)?>
					<?php $h_q_d_sh_r += $q_d_sh_r?>
				</td>
				<td>
					<?=$q_d_sh_f = getStatisticDoxili($f_item['id'], 2, 1, $date_start, $date_finish)?>
					<?php $h_q_d_sh_f += $q_d_sh_f?>
				</td>

				<td>
					<?=$q_d_b_r_f = getStatisticDoxiliBujRuzFos($f_item['id'], 2, $date_start, $date_finish)?>
					<?php $h_q_d_b_r_f += $q_d_b_r_f?>
				</td>
				
				<td>
					<?=$t_in_fac = getStatistic($f_item['id'], $date_start, $date_finish)?>
					<?php $total += $t_in_fac;?>
				</td>
			</tr>
			
			<?php endforeach;?>
			
			
			<tr class="center bold">
				<td colspan="2" rowspan="3" style="vertical-align: bottom">
					<p>Ҷамъ дар <?=SHORT_UNI_NAME?></p>
				</td>
				<td rowspan="2" style="vertical-align: bottom"><?=$b_r_t?></td>
				<td style="vertical-align: bottom"><?=$sh_r_t?></td>
				<td style="vertical-align: bottom"><?=$sh_f_t?></td>
				<td rowspan="2" style="vertical-align: bottom">
					<?=($b_r_t + $sh_r_t + $sh_f_t)?>
				</td>
				
				<td rowspan="3" style="vertical-align: bottom">
					<?=$h_kvota?>
				</td>
				<td rowspan="3" style="vertical-align: bottom">
					<?=$h_xoriji?>
				</td>
				<td style="vertical-align: bottom">
					<?=$h_a_k_sh?>
				</td>
				<td style="vertical-align: bottom">
					<?=$h_a_k_b?>
				</td>
				<td style="vertical-align: bottom">
					<?=$h_a_k_f?>
				</td>
				
				<td rowspan="2" style="vertical-align: bottom">
					<?=$h_mdok?>
				</td>
				
				<td>
					<?=$h_mag_sh?>
				</td>
				<td>
					<?=$h_mag_b?>
				</td>
				<td>
					<?=$h_Phd_sh?>
				</td>
				<td>
					<?=$h_Phd_b?>
				</td>
				
				<td><?=$h_q_d_sh_r?></td>
				<td><?=$h_q_d_sh_f?></td>
				<td><?=$h_q_d_b_r_f?></td>
				
				<td rowspan="3" style="vertical-align: bottom">
					<?=$total?>
				</td>
			</tr>
			
			
			<tr class="center bold">
				<td colspan="2" style="vertical-align: bottom">
					<?=($sh_r_t + $sh_f_t)?>
				</td>
				<td colspan="3" style="vertical-align: bottom">
					<?=$after_colleg = ($h_a_k_sh + $h_a_k_b + $h_a_k_f)?>
				</td>
				<td colspan="2" style="vertical-align: bottom">
					<?=$mags = $h_mag_sh + $h_mag_b?>
				</td>
				<td colspan="2" style="vertical-align: bottom">
					<?=$phds = $h_Phd_sh + $h_Phd_b?> 
				</td>
				<td colspan="3" style="vertical-align: bottom">
					<?=$doxili = $h_q_d_sh_r + $h_q_d_sh_f + $h_q_d_b_r_f?>
				</td>
			</tr>
			<tr class="center bold">
				<td colspan="4" >
					<?=($b_r_t + $sh_r_t + $sh_f_t)?>
				</td>
				<td colspan="11">
					<?=($after_colleg + $h_mdok + $mags + $phds + $doxili)?>
				</td>
			</tr>
		</tbody>
	</table>
	
	<?php if($action != 'commission_statistic'):?>
		<a target="_blank" href="<?=MY_URL?>?option=print&action=commission_statistic<?php if($date_start && $date_finish):?>&date_start=<?=$date_start?>&date_finish=<?=$date_finish?><?php endif;?>" class="btn btn-inverse waves-effect waves-light">
			<i class="fa fa-print"></i> Чоп кардан
		</a>
	<?php endif;?>
</div>

