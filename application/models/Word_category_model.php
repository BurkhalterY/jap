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

	public function getWordsWithType($category, $logged_in)
	{
		$this->load->model(['note_model', 'kana_model', 'kanji_model', 'vocabulary_model', 'kdlt_model', 'alphabet_model']);

		$wordscat = $this->with('word')->order_by('order_by')->get_many_by('fk_category', $category);
		$data = [];
		foreach ($wordscat as $wordcat) {

			if($logged_in){
				$note = $this->note_model->get_by(['fk_user' => $_SESSION['user_id'], 'fk_word' => $wordcat->word->id]);
				$srs = !boolval($this->note_model->count_by("fk_user = ".$_SESSION['user_id']." AND fk_word = ".$wordcat->word->id." AND next_revision > NOW()"));
			}

			switch ($wordcat->word->fk_word_type) {
				case TYPE_KANA:
					$kana = $this->kana_model->get_by('fk_word', $wordcat->word->id);
					$kana->note = $note->note ?? '';
					$kana->srs = $srs ?? true;
					$data['kana'][] = $kana;
					break;
				case TYPE_KANJI:
					$kanji = $this->kanji_model->get_by('fk_word', $wordcat->word->id);
					$kanji->note = $note->note ?? '';
					$kanji->srs = $srs ?? true;
					$data['kanji'][] = $kanji;
					break;
				case TYPE_VOC:
					$vocabulary = $this->vocabulary_model->get_by('fk_word', $wordcat->word->id);
					$vocabulary->note = $note->note ?? '';
					$vocabulary->srs = $srs ?? true;
					$data['vocabulary'][] = $vocabulary;
					break;
				case TYPE_KDLT:
					$kdlt = $this->kdlt_model->get_by('fk_word', $wordcat->word->id);
					$kdlt->note = $note->note ?? '';
					$kdlt->srs = $srs ?? true;
					$data['kdlt'][] = $kdlt;
					break;
				case TYPE_ALPHABET:
					$alphabet = $this->alphabet_model->get_by('fk_word', $wordcat->word->id);
					$alphabet->note = $note->note ?? '';
					$alphabet->srs = $srs ?? true;
					$data['alphabet'][] = $alphabet;
					break;
			}
		}
		return $data;
	}
}