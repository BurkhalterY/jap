<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class vocabulary_model extends MY_Model
{
	/* SET MY_Model VARIABLES */
	protected $_table = 'vocabulary';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $belongs_to = ['word' => ['primary_key' => 'fk_word',
										'model' => 'word_model']];
	protected $after_get = ['after_get'];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}


	function after_get($row)
	{
		$row->kanji_or_kana = empty($row->kanji) ? $row->kana : $row->kanji;
		return $row;
	}
}