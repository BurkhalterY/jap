<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Exploration extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('category_model', 'word_category_model', 'kana_model', 'kanji_model', 'vocabulary_model', 'kdlt_model', 'alphabet_model', 'note_model'));
	}

	public function index($category = NULL) {
		$data = ['title' => $this->lang->line('title_list')];
		$data['categories'] = $this->category_model->order_by('order_by')->get_many_by('fk_parent_cat', $category);
		
		$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;

		$wordscat = $this->word_category_model->with('word')->order_by('order_by')->get_many_by('fk_category', $category);
		foreach ($wordscat as $wordcat) {

			if($logged_in){
				$note = $this->note_model->get_by(['fk_user' => $_SESSION['user_id'], 'fk_word' => $wordcat->word->id]);
			}

			switch ($wordcat->word->fk_word_type) {
				case TYPE_KANA:
					$kana = $this->kana_model->get_by('fk_word', $wordcat->word->id);
					$kana->note = $note->note ?? '';
					$data['kana'][] = $kana;
					break;
				case TYPE_KANJI:
					$kanji = $this->kanji_model->get_by('fk_word', $wordcat->word->id);
					$kanji->note = $note->note ?? '';
					$data['kanji'][] = $kanji;
					break;
				case TYPE_VOC:
					$vocabulary = $this->vocabulary_model->get_by('fk_word', $wordcat->word->id);
					$vocabulary->note = $note->note ?? '';
					$data['vocabulary'][] = $vocabulary;
					break;
				case TYPE_KDLT:
					$kdlt = $this->kdlt_model->get_by('fk_word', $wordcat->word->id);
					$kdlt->note = $note->note ?? '';
					$data['kdlt'][] = $kdlt;
					break;
				case TYPE_ALPHABET:
					$alphabet = $this->alphabet_model->get_by('fk_word', $wordcat->word->id);
					$alphabet->note = $note->note ?? '';
					$data['alphabet'][] = $alphabet;
					break;
			}
		}

		$this->display_view('exploration/index', $data);
	}
}
