<?php

// this contains the application database configure
$_config = array();

// ---------------------  CONFIG CONNECTIONSTRING  ---------------------- //
$_config['connectionString'] = 'mysql:host=localhost;dbname=operation';

// ----------------------  CONFIG EMULATEPREPARE  ----------------------- //
$_config['emulatePrepare'] = 1;

// -------------------------  CONFIG USERNAME  -------------------------- //
$_config['username'] = 'root';

// -------------------------  CONFIG PASSWORD  -------------------------- //
$_config['password'] = '123456';

// --------------------------  CONFIG CHARSET  -------------------------- //
$_config['charset'] = 'utf8';

// ------------------------  CONFIG TABLEPREFIX  ------------------------ //
$_config['tablePrefix'] = 'woc_';

return $_config;

// -------------------  THE END  -------------------- //

?>