<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class serie_model extends MY_Model
{
	/* SET MY_Model VARIABLES */
	protected $_table = 'series';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $belongs_to = ['category' => ['primary_key' => 'fk_category',
											'model' => 'category_model']];
	protected $has_many = ['kanjis' => ['primary_key' => 'fk_serie',
										'model' => 'kanji_model']];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

}