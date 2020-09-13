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