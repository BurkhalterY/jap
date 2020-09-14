<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item <?=is_active('/\/administration\/kana/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/kana')?>">Kana</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/kanji/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/kanji')?>">Kanji</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/vocabulary/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/vocabulary')?>">Vocabulaire</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/kdlt/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/kdlt')?>">KDLT</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/alphabet/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/alphabet')?>">Alphabet</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/categories/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/categories')?>">Catégories</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/order_categories/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/order_categories')?>">Ordre des catégories</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/import/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/import')?>">Import</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/export/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/export')?>">Export</a>
		</li>
	</ul>
</nav>