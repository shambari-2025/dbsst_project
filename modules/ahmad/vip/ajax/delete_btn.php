
<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$(".delete_from_vip_list").on('click', function(){
			var id_student = $(this).attr("data-id-student");
			var s_y = $('.addform #s_y').val();
			var h_y = $('.addform #h_y').val();
			$(this).remove();
			
			var url = '<?=URL."modules/vip/vip_ajax.php?option=deleteVIP";?>';
			
			$.ajax({
				type: 'post',
				url: url, //Путь к обработчику
				data: {"id_student":id_student, "s_y": s_y, "h_y": h_y},
				success: function(data){
					if(data == 'ok'){
						var url = '<?=URL."modules/vip/vip_ajax.php?option=getAddBtn";?>';
						$.ajax({
							type: 'post',
							url: url, //Путь к обработчику
							data: {"id_student":id_student},
							success: function(data){
								$(".elem_" + id_student).html(data);
							}
						});
					}
				}
			});
		});
		
	});
</script>