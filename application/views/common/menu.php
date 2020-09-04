<?php defined('BASEPATH') OR exit('No direct script access allowed');

function is_active($pattern)
{
	$subject = $_SERVER['REQUEST_URI'];
	return preg_match($pattern, $subject);
}
?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?=is_active('/\/exploration/i') ? 'active' : ''?>">
				<a class="nav-link" href="<?=base_url('exploration')?>"><?=$this->lang->line('title_list')?></a>
			</li>
			<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
				<li class="nav-item <?=is_active('/\/revision/i') ? 'active' : ''?>">
					<a class="nav-link" href="<?=base_url('revision')?>"><?=$this->lang->line('title_revision')?></a>
				</li>
				<?php if($_SESSION['user_access'] >= ACCESS_LVL_ADMIN) { ?>
					<!--<li class="nav-item <?=is_active('/\/admin/i') ? 'active' : ''?> dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$this->lang->line('title_admin_zone')?></a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="<?=base_url('admin/kanji')?>"><?=$this->lang->line('title_admin_kanji')?></a>
							<a class="dropdown-item" href="<?=base_url('admin/serie')?>"><?=$this->lang->line('title_admin_serie')?></a>
						</div>
					</li>-->
				<?php } ?>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('user/logout')?>"><?=$this->lang->line('title_logout')?></a>
				</li>
			<?php } else { ?>
				<li class="nav-item <?=is_active('/\/user\/login/i') ? 'active' : ''?>">
					<a class="nav-link" href="<?=base_url('user/login')?>"><?=$this->lang->line('title_login')?></a>
				</li>
				<li class="nav-item <?=is_active('/\/user\/register/i') ? 'active' : ''?>">
					<a class="nav-link" href="<?=base_url('user/register')?>"><?=$this->lang->line('title_register')?></a>
				</li>
			<?php } ?>
			<li class="nav-item <?=is_active('/\/misc\/about/i') ? 'active' : ''?>">
				<a class="nav-link" href="<?=base_url('misc/about')?>"><?=$this->lang->line('title_about')?></a>
			</li>
		</ul>
	</div>
</nav>
<div class="container">