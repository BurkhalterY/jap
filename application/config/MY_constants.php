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
define('REVISION_KANA_TO_ROMAJI_MULTIPLE_CHOICE', 1);
define('REVISION_ROMAJI_TO_KANA_MULTIPLE_CHOICE', 2);
define('REVISION_KANA_TO_ROMAJI_WRITE', 3);
define('REVISION_ROMAJI_TO_KANA_TRACE', 4);
//Table Kanji
define('REVISION_KANJI_TO_MEANING_MULTIPLE_CHOICE', 5);
define('REVISION_MEANING_TO_KANJI_MULTIPLE_CHOICE', 6);
define('REVISION_KANJI_TO_MEANING_WRITE', 7);
define('REVISION_MEANING_TO_KANJI_TRACE', 8);
//Table Vocabulary
define('REVISION_TRANSLATION_TO_JAPANESE_MULTIPLE_CHOICE', 9);
define('REVISION_JAPANESE_TO_TRANSLATION_MULTIPLE_CHOICE', 10);
define('REVISION_TRANSLATION_TO_JAPANESE_ROMAJI_WRITE', 11);
define('REVISION_TRANSLATION_TO_JAPANESE_TRACE', 12);
define('REVISION_JAPANESE_TO_TRANSLATION_WRITE', 13);
