<?php
//------------------------------------------------------------------------------
// Constantes
//------------------------------------------------------------------------------
define('APP_PATH', __DIR__ . "/../.." );

define('SYSTEM_PATH', __DIR__ . "/../../system");

define('LOG_PATH', __DIR__ . "/../storage/logs");

define('DS', DIRECTORY_SEPARATOR);
//------------------------------------------------------------------------------
// Includes
//------------------------------------------------------------------------------

require_once(APP_PATH . '/vendor/autoload.php');
require_once(SYSTEM_PATH . "/helpers.php" );

//pelo navegador , o mesmo é feito na classe init;
app_set_env();