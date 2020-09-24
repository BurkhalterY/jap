<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mode_model extends MY_Model
{
	/* SET MY_Model VARIABLES */
	protected $_table = 'modes';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

}