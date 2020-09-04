<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends MY_Model
{
	/* SET MY_Model VARIABLES */
	protected $_table = 'users';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $belongs_to = ['user_type' => ['primary_key' => 'fk_user_type',
											 'model' => 'user_type_model']];
	protected $has_many = ['tracings' => ['primary_key' => 'fk_user',
										  'model' => 'tracing_model'],
						   'notes' => ['primary_key' => 'fk_user',
									   'model' => 'note_model']];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

}