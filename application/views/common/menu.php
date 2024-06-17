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
			<li class="nav-item <?=is_active('/\/revision/i') ? 'active' : ''?>">
				<a class="nav-link" href="<?=base_url('revision')?>"><?=$this->lang->line('title_revision')?></a>
			</li>
			<li class="nav-item <?=is_active('/\/about/i') ? 'active' : ''?>">
				<a class="nav-link" href="<?=base_url('about')?>"><?=$this->lang->line('title_about')?></a>
			</li>
		</ul>
	</div>
</nav>
<div class="container">