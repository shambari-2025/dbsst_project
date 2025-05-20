<table border="1" class="infotable"  style="width: 100%; font-size: 13px">
	<tbody>
		<tr class="center">
			<?php for($i = 1; $i <= $days; $i++):?>
				<?php $date = "$year-$month-$i";?>
				<td style="<?php if(date("w", strtotime($date)) == 0):?>background: #ff0000; color: #fff<?php endif;?>">
					<div class="vertical" <?php if($date == date("Y-n-j", time())):?>style="color: blue; font-weight: bold"<?php endif;?> ><?="$i.$month.$year";?></div>
				</td>
			<?php endfor;?>
		</tr>
		<tr class="center">
			<?php for($i = 1; $i <= $days; $i++):?>
				<?php $date = "$year-$month-$i";?>
				<?php $data = getSeenPages($id_student, $date)?>
				<td <?php if(!$data):?>style="background: red; color: #fff"<?php endif;?>>
					<?php if(isset($data)):?>
						<?=$data?>
					<?php else:?>
						Н
					<?php endif;?>
					
				</td>
			<?php endfor;?>
		</tr>
	</tbody>
</table>