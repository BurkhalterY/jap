<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class word_type_model extends MY_Model
{
	/* SET MY_Model VARIABLES */
	protected $_table = 'words_types';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $has_many = ['words' => ['primary_key' => 'fk_word_type',
									   'model' => 'word_model']];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

}