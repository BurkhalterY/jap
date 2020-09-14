<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item <?=is_active('/\/administration\/kana/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/kana')?>"><?=$this->lang->line('kana')?></a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/kanji/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/kanji')?>"><?=$this->lang->line('kanji')?></a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/vocabulary/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/vocabulary')?>"><?=$this->lang->line('vocabulary')?></a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/kdlt/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/kdlt')?>"><?=$this->lang->line('kdlt')?></a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/alphabet/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/alphabet')?>"><?=$this->lang->line('alphabet')?></a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/categories/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/categories')?>"><?=$this->lang->line('categories')?></a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/order_categories/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/order_categories')?>"><?=$this->lang->line('categories_order')?></a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/import/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/import')?>"><?=$this->lang->line('import')?></a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/export/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/export')?>"><?=$this->lang->line('export')?></a>
		</li>
	</ul>
</nav>