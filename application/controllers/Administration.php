<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Administration extends MY_Controller {

	protected $access_level = ACCESS_LVL_ADMIN;
	
	public function __construct() {
		parent::__construct();
		$this->load->model(array('word_model', 'kana_model', 'kanji_model', 'vocabulary_model', 'kdlt_model', 'alphabet_model', 'category_model', 'word_category_model'));
		$this->load->library('grocery_CRUD');
	}

	public function index() {
		redirect('administration/kana');
	}

	public function kana() {
		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid_custom')
			 ->set_table('kana')
			 ->set_subject($this->lang->line('kana'))
			 ->columns('romaji', 'kana')
			 ->display_as('romaji', $this->lang->line('romaji'))
			 ->display_as('kana', $this->lang->line('kana'))
			 ->callback_after_insert(array($this, 'kana_after_insert'));

		$crud->fields('romaji', 'kana');
		$crud->required_fields('romaji', 'kana');

		$data['crud'] = $crud->render();
		$data['categories'] = $this->category_model->get_all();
		$this->display_view('administration/crud', $data);
	}

	function kana_after_insert($post_array, $primary_key) {
		$id = $this->word_model->insert(['fk_word_type' => TYPE_KANA]);
		$this->kana_model->update($primary_key, ['fk_word' => $id]);
	}

	public function kanji() {
		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid_custom')
			 ->set_table('kanji')
			 ->set_subject($this->lang->line('kanji'))
			 ->columns('kanji', 'onyomi', 'kunyomi', 'meaning', 'strokes', 'jouyou', 'jlpt')
			 ->display_as('kanji', $this->lang->line('kanji'))
			 ->display_as('onyomi', $this->lang->line('onyomi'))
			 ->display_as('kunyomi', $this->lang->line('kunyomi'))
			 ->display_as('meaning', $this->lang->line('meaning'))
			 ->display_as('strokes', $this->lang->line('strokes'))
			 ->display_as('jouyou', $this->lang->line('jouyou'))
			 ->display_as('jlpt', $this->lang->line('jlpt'))
			 ->callback_after_insert(array($this, 'kanji_after_insert'));

		$crud->fields('kanji', 'onyomi', 'kunyomi', 'meaning', 'strokes', 'jouyou', 'jlpt');
		$crud->required_fields('kanji', 'meaning');

		$data['crud'] = $crud->render();
		$data['categories'] = $this->category_model->get_all();
		$this->display_view('administration/crud', $data);
	}

	function kanji_after_insert($post_array, $primary_key) {
		$id = $this->word_model->insert(['fk_word_type' => TYPE_kanji]);
		$this->kanji_model->update($primary_key, ['fk_word' => $id]);
	}

	public function vocabulary() {
		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid_custom')
			 ->set_table('vocabulary')
			 ->set_subject($this->lang->line('voc'))
			 ->columns('kana', 'kanji', 'translation', 'jlpt')
			 ->display_as('kana', $this->lang->line('kana'))
			 ->display_as('kanji', $this->lang->line('kanji'))
			 ->display_as('translation', $this->lang->line('translation'))
			 ->display_as('jlpt', $this->lang->line('jlpt'))
			 ->callback_after_insert(array($this, 'vocabulary_after_insert'));

		$crud->fields('kana', 'kanji', 'translation', 'jlpt');
		$crud->required_fields('kana', 'translation');

		$data['crud'] = $crud->render();
		$data['categories'] = $this->category_model->get_all();
		$this->display_view('administration/crud', $data);
	}

	function vocabulary_after_insert($post_array, $primary_key) {
		$id = $this->word_model->insert(['fk_word_type' => TYPE_vocabulary]);
		$this->vocabulary_model->update($primary_key, ['fk_word' => $id]);
	}

	public function kdlt() {
		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid_custom')
			 ->set_table('kdlt')
			 ->set_subject($this->lang->line('kdlt'))
			 ->columns('kdlt', 'chapter', 'kanji', 'keyword', 'story', 'note', 'component', 'strokes', 'jouyou', 'jlpt')
			 ->display_as('kdlt', $this->lang->line('numero'))
			 ->display_as('chapter', $this->lang->line('chapter'))
			 ->display_as('kanji', $this->lang->line('kanji'))
			 ->display_as('keyword', $this->lang->line('keyword'))
			 ->display_as('story', $this->lang->line('story'))
			 ->display_as('note', $this->lang->line('note'))
			 ->display_as('component', $this->lang->line('component'))
			 ->display_as('strokes', $this->lang->line('strokes'))
			 ->display_as('jouyou', $this->lang->line('jouyou'))
			 ->display_as('jlpt', $this->lang->line('jlpt'))
			 ->callback_after_insert(array($this, 'kdlt_after_insert'));

		$crud->fields('kdlt', 'chapter', 'kanji', 'keyword', 'story', 'note', 'component', 'strokes', 'jouyou', 'jlpt');
		$crud->required_fields('kdlt', 'chapter', 'kanji', 'keyword', 'story');

		$data['crud'] = $crud->render();
		$data['categories'] = $this->category_model->get_all();
		$this->display_view('administration/crud', $data);
	}

	function kdlt_after_insert($post_array, $primary_key) {
		$id = $this->word_model->insert(['fk_word_type' => TYPE_kdlt]);
		$this->kdlt_model->update($primary_key, ['fk_word' => $id]);
	}

	public function alphabet() {
		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid_custom')
			 ->set_table('alphabet')
			 ->set_subject($this->lang->line('alphabet'))
			 ->columns('letter', 'kana', 'language')
			 ->display_as('letter', $this->lang->line('letter'))
			 ->display_as('kana', $this->lang->line('kana'))
			 ->display_as('language', $this->lang->line('language'))
			 ->callback_after_insert(array($this, 'alphabet_after_insert'));

		$crud->fields('letter', 'kana', 'language');
		$crud->required_fields('letter', 'kana', 'language');

		$data['crud'] = $crud->render();
		$data['categories'] = $this->category_model->get_all();
		$this->display_view('administration/crud', $data);
	}

	function alphabet_after_insert($post_array, $primary_key) {
		$id = $this->word_model->insert(['fk_word_type' => TYPE_alphabet]);
		$this->alphabet_model->update($primary_key, ['fk_word' => $id]);
	}

	public function categories() {
		$crud = new grocery_CRUD();

		$crud->set_table('categories')
			 ->set_subject($this->lang->line('categories'))
			 ->columns('cat_name', 'fk_parent_cat')
			 ->display_as('cat_name', $this->lang->line('cat_name'))
			 ->display_as('fk_parent_cat', $this->lang->line('fk_parent_cat'))
			 ->set_relation('fk_parent_cat', 'categories', 'cat_name')
			 ->add_action('Mots', '', 'administration/order_words', 'fas fa-external-link-alt');

		$crud->fields('cat_name', 'fk_parent_cat');
		$crud->required_fields('cat_name');

		$data['crud'] = $crud->render();
		$this->display_view('administration/crud', $data);
	}

	public function set_category() {
		foreach ($_POST['check'] as $key => $value) {
			$this->word_category_model->insert([
				'fk_word' => $key,
				'fk_category' => $_POST['category'],
				'order_by' => -1
			]);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function order_categories($parent = NULL) {
		if(isset($_POST['submit'])){
			for ($i = 0; $i < count($_POST['order']); $i++) {
				$this->category_model->update($_POST['order'][$i], ['order_by' => $i]);
			}
		}
		$data['category'] = $this->category_model->get($parent);
		$data['categories'] = $this->category_model->order_by('order_by')->get_many_by('fk_parent_cat', $parent);
		$this->display_view('administration/order_categories', $data);
	}

	public function order_words($category = NULL) {
		if(isset($_POST['submit'])){
			for ($i = 0; $i < count($_POST['order']); $i++) {
				$this->word_category_model->update($_POST['order'][$i], ['order_by' => $i]);
			}
		}
		$data['category'] = $this->category_model->get($category);
		$data['wordcat'] = $this->word_category_model->with('word')->order_by('order_by')->get_many_by('fk_category', $category);
		foreach ($data['wordcat'] as $wordcat) {
			switch ($wordcat->word->fk_word_type) {
				case TYPE_KANA:
					$query = $this->kana_model->get_by('fk_word', $wordcat->word->id);
					$wordcat->denomination = $query->kana.' | '.$query->romaji;
					break;
				case TYPE_KANJI:
					$query = $this->kanji_model->get_by('fk_word', $wordcat->word->id);
					$wordcat->denomination = $query->kanji.' | '.$query->meaning;
					break;
				case TYPE_VOC:
					$query = $this->vocabulary_model->get_by('fk_word', $wordcat->word->id);
					$wordcat->denomination = (empty($query->kanji) ? $query->kana : $query->kanji).' | '.$query->translation;
					break;
				case TYPE_KDLT:
					$query = $this->kdlt_model->get_by('fk_word', $wordcat->word->id);
					$wordcat->denomination = $query->kanji.' | '.$query->keyword;
					break;
				case TYPE_ALPHABET:
					$query = $this->alphabet->get_by('fk_word', $wordcat->word->id);
					$wordcat->denomination = $query->letter.' | '.$query->kana;
					break;
				default:
					$wordcat->denomination = '?';
					break;
			}
		}
		$this->display_view('administration/order_words', $data);
	}

	public function import() {
		if (isset($_POST['submit'])) {
			if(isset($_FILES['excel']['name']) && $_FILES['excel']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {

				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				$spreadsheet = $reader->load($_FILES['excel']['tmp_name']);
				

				$sheetData = $spreadsheet->getSheetByName('Kana')->toArray();
				if (!empty($sheetData)) {
					for ($i = 1; $i < count($sheetData); $i++) {
						$id = $sheetData[$i][0];
						$row = [
							'romaji' => $sheetData[$i][1] ?? '',
							'kana' => $sheetData[$i][2] ?? ''
						];

						if(empty($id)) {
							$word = $this->word_model->insert(['fk_word_type' => TYPE_KANA]);
							$row['fk_word'] = $word;
							$this->kana_model->insert($row);
						} else {
							$this->kana_model->update($id, $row);
						}
					}
				}


				$sheetData = $spreadsheet->getSheetByName('Kanji')->toArray();
				if (!empty($sheetData)) {
					for ($i = 1; $i < count($sheetData); $i++) {
						$id = $sheetData[$i][0];
						$row = [
							'kanji' => $sheetData[$i][1] ?? '',
							'onyomi' => $sheetData[$i][2] ?? '',
							'kunyomi' => $sheetData[$i][3] ?? '',
							'meaning' => $sheetData[$i][4] ?? '',
							'strokes' => $sheetData[$i][5] ?? '',
							'jouyou' => $sheetData[$i][6] ?? '',
							'jlpt' => $sheetData[$i][7] ?? ''
						];

						if(empty($id)) {
							$word = $this->word_model->insert(['fk_word_type' => TYPE_KANJI]);
							$row['fk_word'] = $word;
							$this->kanji_model->insert($row);
						} else {
							$this->kanji_model->update($id, $row);
						}
					}
				}


				$sheetData = $spreadsheet->getSheetByName('Voc')->toArray();
				if (!empty($sheetData)) {
					for ($i = 1; $i < count($sheetData); $i++) {
						$id = $sheetData[$i][0];
						$row = [
							'kana' => $sheetData[$i][1] ?? '',
							'kanji' => $sheetData[$i][2] ?? '',
							'translation' => $sheetData[$i][3] ?? '',
							'jlpt' => $sheetData[$i][4] ?? ''
						];

						if(empty($id)) {
							$word = $this->word_model->insert(['fk_word_type' => TYPE_VOC]);
							$row['fk_word'] = $word;
							$this->vocabulary_model->insert($row);
						} else {
							$this->vocabulary_model->update($id, $row);
						}
					}
				}


				$sheetData = $spreadsheet->getSheetByName('KDLT')->toArray();
				if (!empty($sheetData)) {
					for ($i = 1; $i < count($sheetData); $i++) {
						$id = $sheetData[$i][0];
						$row = [
							'kdlt' => $sheetData[$i][1] ?? '',
							'chapter' => $sheetData[$i][2] ?? '',
							'kanji' => $sheetData[$i][3] ?? '',
							'keyword' => $sheetData[$i][4] ?? '',
							'story' => $sheetData[$i][5] ?? '',
							'note' => $sheetData[$i][6] ?? '',
							'component' => $sheetData[$i][7] ?? '',
							'strokes' => $sheetData[$i][8] ?? '',
							'jouyou' => $sheetData[$i][9] ?? '',
							'jlpt' => $sheetData[$i][10 ?? '']
						];

						if(empty($id)) {
							$word = $this->word_model->insert(['fk_word_type' => TYPE_KDLT]);
							$row['fk_word'] = $word;
							$this->kdlt_model->insert($row);
						} else {
							$this->kdlt_model->update($id, $row);
						}
					}
				}


				$sheetData = $spreadsheet->getSheetByName('Alphabet')->toArray();
				if (!empty($sheetData)) {
					for ($i = 1; $i < count($sheetData); $i++) {
						$id = $sheetData[$i][0];
						$row = [
							'letter' => $sheetData[$i][1] ?? '',
							'kana' => $sheetData[$i][2] ?? '',
							'language' => $sheetData[$i][3] ?? ''
						];

						if(empty($id)) {
							$word = $this->word_model->insert(['fk_word_type' => TYPE_ALPHABET]);
							$row['fk_word'] = $word;
							$this->alphabet_model->insert($row);
						} else {
							$this->alphabet_model->update($id, $row);
						}
					}
				}
			}
			redirect('administration');
		} else {
			$this->display_view('administration/import');
		}
	}

	public function export() {
		$spreadsheet = new Spreadsheet();
		$Excel_writer = new Xlsx($spreadsheet);


		/* --- kana --- */
		$spreadsheet->setActiveSheetIndex(TYPE_KANA - 1);
		$activeSheet = $spreadsheet->getActiveSheet();
		$activeSheet->setTitle("Kana");

		$activeSheet->setCellValue('A1', 'ID');
		$activeSheet->setCellValue('B1', 'Rōmaji');
		$activeSheet->setCellValue('C1', 'Kana');

		$query = $this->kana_model->get_all();
		$i = 2;
		foreach ($query as $row) {
			$activeSheet->setCellValue('A'.$i , $row->id);
			$activeSheet->setCellValue('B'.$i , $row->romaji);
			$activeSheet->setCellValue('C'.$i , $row->kana);
			$i++;
		}
		$activeSheet->getColumnDimension('A')->setVisible(false);
		

		/* --- kanji --- */
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(TYPE_KANJI - 1);
		$activeSheet = $spreadsheet->getActiveSheet();
		$activeSheet->setTitle("Kanji");

		$activeSheet->setCellValue('A1', 'ID');
		$activeSheet->setCellValue('B1', 'Kanji');
		$activeSheet->setCellValue('C1', 'On');
		$activeSheet->setCellValue('D1', 'Kun');
		$activeSheet->setCellValue('E1', 'Meaning');
		$activeSheet->setCellValue('F1', 'Strokes');
		$activeSheet->setCellValue('G1', 'Jōyō');
		$activeSheet->setCellValue('H1', 'JLPT');

		$query = $this->kanji_model->get_all();
		$i = 2;
		foreach ($query as $row) {
			$activeSheet->setCellValue('A'.$i , $row->id);
			$activeSheet->setCellValue('B'.$i , $row->kanji);
			$activeSheet->setCellValue('C'.$i , $row->onyomi);
			$activeSheet->setCellValue('D'.$i , $row->kunyomi);
			$activeSheet->setCellValue('E'.$i , $row->meaning);
			$activeSheet->setCellValue('F'.$i , $row->strokes);
			$activeSheet->setCellValue('G'.$i , $row->jouyou);
			$activeSheet->setCellValue('H'.$i , $row->jlpt);
			$i++;
		}
		$activeSheet->getColumnDimension('A')->setVisible(false);


		/* --- vocabulary --- */
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(TYPE_VOC - 1);
		$activeSheet = $spreadsheet->getActiveSheet();
		$activeSheet->setTitle("Voc");

		$activeSheet->setCellValue('A1', 'ID');
		$activeSheet->setCellValue('B1', 'Kana');
		$activeSheet->setCellValue('C1', 'Kanji');
		$activeSheet->setCellValue('D1', 'Français');
		$activeSheet->setCellValue('E1', 'JLPT');

		$query = $this->vocabulary_model->get_all();
		$i = 2;
		foreach ($query as $row) {
			$activeSheet->setCellValue('A'.$i , $row->id);
			$activeSheet->setCellValue('B'.$i , $row->kana);
			$activeSheet->setCellValue('C'.$i , $row->kanji);
			$activeSheet->setCellValue('D'.$i , $row->translation);
			$activeSheet->setCellValue('E'.$i , $row->jlpt);
			$i++;
		}
		$activeSheet->getColumnDimension('A')->setVisible(false);


		/* --- KDLT --- */
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(TYPE_KDLT - 1);
		$activeSheet = $spreadsheet->getActiveSheet();
		$activeSheet->setTitle("KDLT");

		$activeSheet->setCellValue('A1', 'ID');
		$activeSheet->setCellValue('B1', 'KDLT');
		$activeSheet->setCellValue('C1', 'Chapter');
		$activeSheet->setCellValue('D1', 'Kanji');
		$activeSheet->setCellValue('E1', 'Keyword');
		$activeSheet->setCellValue('F1', 'Story');
		$activeSheet->setCellValue('G1', 'Note');
		$activeSheet->setCellValue('H1', 'Component');
		$activeSheet->setCellValue('I1', 'Strokes');
		$activeSheet->setCellValue('J1', 'Jōyō');
		$activeSheet->setCellValue('K1', 'JLPT');

		$query = $this->kdlt_model->get_all();
		$i = 2;
		foreach ($query as $row) {
			$activeSheet->setCellValue('A'.$i , $row->id);
			$activeSheet->setCellValue('B'.$i , $row->kdlt);
			$activeSheet->setCellValue('C'.$i , $row->chapter);
			$activeSheet->setCellValue('D'.$i , $row->kanji);
			$activeSheet->setCellValue('E'.$i , $row->keyword);
			$activeSheet->setCellValue('F'.$i , $row->story);
			$activeSheet->setCellValue('G'.$i , $row->note);
			$activeSheet->setCellValue('H'.$i , $row->component);
			$activeSheet->setCellValue('I'.$i , $row->strokes);
			$activeSheet->setCellValue('J'.$i , $row->jouyou);
			$activeSheet->setCellValue('K'.$i , $row->jlpt);
			$i++;
		}
		$activeSheet->getColumnDimension('A')->setVisible(false);


		/* --- alphabet --- */
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(TYPE_ALPHABET - 1);
		$activeSheet = $spreadsheet->getActiveSheet();
		$activeSheet->setTitle("Alphabet");

		$activeSheet->setCellValue('A1', 'ID');
		$activeSheet->setCellValue('B1', 'Lettre');
		$activeSheet->setCellValue('C1', 'Kana');
		$activeSheet->setCellValue('D1', 'Langue');

		$query = $this->alphabet_model->get_all();
		$i = 2;
		foreach ($query as $row) {
			$activeSheet->setCellValue('A'.$i , $row->id);
			$activeSheet->setCellValue('B'.$i , $row->letter);
			$activeSheet->setCellValue('C'.$i , $row->kana);
			$activeSheet->setCellValue('D'.$i , $row->language);
			$i++;
		}
		$activeSheet->getColumnDimension('A')->setVisible(false);


		/* --- export --- */
		$filename = 'voc-full.xlsx';

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename='. $filename);
		header('Cache-Control: max-age=0');
		$Excel_writer->save('php://output');
	}
}
