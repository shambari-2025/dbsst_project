<div id="sidebar" class="users p-chat-user showChat">
	<div class="had-container">
		<div class="p-fixed users-main">
			<div class="user-box">
			
				<div class="chat-search-box">
					<a class="back_friendlist">
						<i class="feather icon-x"></i>
					</a>
					<div class="right-icon-control">
						<div class="input-group input-group-button">
							<input type="text" id="search-friends" name="footer-email" class="form-control" placeholder="Search Friend">
							<div class="input-group-append">
								<button class="btn btn-primary waves-effect waves-light" type="button">
									<i class="feather icon-search"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
				
				<div class="main-friend-list">
					<?php $counter = 0;?>
					<?php foreach($users as $item):?>
						<div class="media userlist-box waves-effect waves-light" data-id="<?=++$counter?>" data-status="<?php if(getUserOnline($item['id'])):?>online<?php else:?>offline<?php endif;?>" data-username="<?=$item['fullname_tj']?>">
							<a class="media-left" href="#!">
								<?php $photo = getUserImg($item['id'], $item['jins'], $item['photo'], true);?>
								<img class="media-object img-radius img-radius" src="<?=$photo?>" alt="<?=$item['fullname_tj']?>">
								<div class="live-status bg-<?php if(getUserOnline($item['id'])):?>success<?php else:?>default<?php endif;?>"></div>
							</a>
							<div class="media-body">
								<div class="<?php if(!getUserOnline($item['id'])):?>f-13<?php endif;?> chat-header">
								<?=getShortName($item['id'])?>
									<?php if(!getUserOnline($item['id'])):?>
										<small class="d-block text-muted"><?=@formatDate($item['last_login']);?></small>
									<?php endif;?>
								</div>
							</div>
						</div>
						
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
</div>