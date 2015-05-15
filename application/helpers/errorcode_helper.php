<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!defined('ERROR_OK')) {
	define('ERROR_OK',				200);
	define('ERROR_MISS_PRM',		432);
	define('ERROR_WRONG_PRM',		433);
	define('ERROR_LOGIN_FAIL',		434);
	define('ERROR_TOOMANY_REQ',		435);
	define('ERROR_UNKNOWN_PRINTER',	436);
	// ...
	define('ERROR_AUTHOR_USER',		442);
	// ...
	define('ERROR_TOOBIG_FILE',		450);
	
	define('ERROR_UNDER_CONSTRUCT',	499);
	define('ERROR_INTERNAL',		500);
}