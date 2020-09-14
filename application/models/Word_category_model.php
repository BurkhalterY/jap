<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class word_category_model extends MY_Model
{
	/* SET MY_Model VARIABLES */
	protected $_table = 'words_categories';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $belongs_to = ['category' => ['primary_key' => 'fk_category',
											'model' => 'category_model'],
							 'word' => ['primary_key' => 'fk_word',
										'model' => 'word_model']];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

}