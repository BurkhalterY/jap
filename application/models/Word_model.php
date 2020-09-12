<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class word_model extends MY_Model
{
	/* SET MY_Model VARIABLES */
	protected $_table = 'words';
	protected $primary_key = 'id';
	protected $protected_attributes = ['id'];
	protected $belongs_to = ['word_type' => ['primary_key' => 'fk_word_type',
											 'model' => 'word_type_model']];
	protected $has_many = ['kana' => ['primary_key' => 'fk_word',
									  'model' => 'kana_model'],
						   'kanji' => ['primary_key' => 'fk_word',
									   'model' => 'kanji_model'],
						   'vocabulary' => ['primary_key' => 'fk_word',
											'model' => 'vocabulary_model'],
						   'kdlt' => ['primary_key' => 'fk_word',
									  'model' => 'kdlt_model'],
						   'alphabet' => ['primary_key' => 'fk_word',
										  'model' => 'alphabet_model'],
						   'categories' => ['primary_key' => 'fk_word',
											'model' => 'word_category_model'],
						   'notes' => ['primary_key' => 'fk_word',
											'model' => 'note_model']];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

}