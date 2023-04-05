<?php

// display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/_functions.php';

use Application\App;

require_once 'autoload.php';

// router & run
App::run();
