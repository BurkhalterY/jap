<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class category_model extends MY_Model
{
	/* SET MY_Model VARIABLES */
	protected $_table = 'categories';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $has_many = ['series' => ['primary_key' => 'fk_category',
										'model' => 'serie_model']];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

}