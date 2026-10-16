<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// defined('SENDINBLUE_API_KEY')  OR define('SENDINBLUE_API_KEY', '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');

//defined('SENDINBLUE_API_KEY')  OR define('SENDINBLUE_API_KEY', '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');

// define('SENDINBLUE_API_KEY','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');

//New anant.thaver@gmail.com
// define('SENDINBLUE_API_KEY','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');
define('SENDINBLUE_API_KEY','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');

// define('SENDINBLUE_API_KEY','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');

//Nidhi 25
// define('SENDINBLUE_API_KEY','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');

// dev@thavertech.com
// define('SENDINBLUE_API_KEY','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');

defined('LOCATIONS')  OR define('LOCATIONS', 
							['kazakhstan'=>['FKZ','GKZ','IKZ'],
							'azerbaijan'=>['FAZ','GAZ','IAZ'],
							'belarus'=>['FBZ','GBZ','IBZ'],
							'georgia'=>['FGE','GGE','IGE'],
							'armenia' => ['FAR','GAR','IAR'],
							'uzbekistan' => ['FUZ','GUZ','IUZ'],
							'all'=>['FKZ','GKZ','IKZ','FAZ','GAZ','IAZ','FBZ','GBZ','IBZ','FGE','GGE','IGE','FAR','GAR','IAR', 'FUZ','GUZ','IUZ']]
						);

defined('COUNTRY_ABBR')  OR define('COUNTRY_ABBR', 
							['AZ' => 'azerbaijan', 'BZ' => 'belarus', 'GE' => 'georgia', 'KZ' => 'kazakhstan','AR'=>'armenia', 'UZ'=> 'uzbekistan']
						);






