<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class category_model extends MY_Model
{
	/* SET MY_Model VARIABLES */
	protected $_table = 'categories';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $belongs_to = ['parent_category' => ['primary_key' => 'fk_parent_cat',
												   'model' => 'category_model']];
	protected $has_many = ['children_categories' => ['primary_key' => 'fk_parent_cat',
													 'model' => 'category_model'],
						   'words_categories' => ['primary_key' => 'fk_category',
									   'model' => 'word_category_model']];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

}