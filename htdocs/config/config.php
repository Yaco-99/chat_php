<?php

# define = define a case-sensitive ~constant~

// Database parameters
new PDO('mysql:host=;dbname=', '', '');
define('DB_HOST', 'sql7.freemysqlhosting.net'); // add db host
define('DB_USER', 'sql7382863'); // add db root
define('DB_PASS', 'mrn39KIPpx'); // add db pass
define('DB_NAME', 'sql7382863'); // add db name

// APPROOT
define('APPROOT', dirname(dirname(__FILE__)));

//URLROOT (Dynamic links)
define('URLROOT', 'http://localhost'); // path to url

//Sitename
define('SITENAME', 'Chat PHP');
