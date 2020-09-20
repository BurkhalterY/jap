<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| CUSTOM CONSTANTS
|--------------------------------------------------------------------------
|
| These are constants defined specially for this application.
|
| Add line "include'MY_constants.php';" in constants.php to load these
*/

/*
|--------------------------------------------------------------------------
| Access levels
|--------------------------------------------------------------------------
*/
define('ACCESS_LVL_GUEST', 1);
define('ACCESS_LVL_USER', 2);
define('ACCESS_LVL_MODO', 4);
define('ACCESS_LVL_ADMIN', 8);

/*
|--------------------------------------------------------------------------
| Word types
|--------------------------------------------------------------------------
*/
define('TYPE_KANA', 1);
define('TYPE_KANJI', 2);
define('TYPE_VOC', 3);
define('TYPE_KDLT', 4);
define('TYPE_ALPHABET', 5);


/*
|--------------------------------------------------------------------------
| Revision modes
|--------------------------------------------------------------------------
*/
//Table Kana
define('REVISION_KANA_TO_ROMAJI', 0);
define('REVISION_ROMAJI_TO_KANA', 1);
//Table Kanji
define('REVISION_KANJI_TO_MEANING', 2);
define('REVISION_MEANING_TO_KANJI', 3);
//Table Vocabulary
define('REVISION_TRANSLATION_TO_JAPANESE', 4);
define('REVISION_JAPANESE_TO_TRANSLATION', 5);
