<?php

//Load config
require_once 'config/config.php';

//Load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';


//load librairies //can now get rid of these now that we have the autoloader
// require_once 'libraries/Core.php';
// require_once 'libraries/Controller.php';
// require_once 'libraries/Databse.php';

//Autoload Core Librairies
//For this to work Class Names and folder names must be the same
spl_autoload_register(function($className) {
    require_once 'libraries/' . $className . '.php';
});

