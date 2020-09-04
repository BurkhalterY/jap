<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class kanji_model extends MY_Model
{
	/* SET MY_Model VARIABLES */
	protected $_table = 'kanjis';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $belongs_to = ['serie' => ['primary_key' => 'fk_serie',
										'model' => 'serie_model']];
	protected $has_many = ['notes' => ['primary_key' => 'fk_kanji',
									   'model' => 'note_model'],
						   'tracings' => ['primary_key' => 'fk_kanji',
										  'model' => 'tracing_model']];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

}