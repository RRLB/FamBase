<?php

// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'b17_34915335');
define('DB_PASS', 'As532_blS6');
define('DB_NAME', 'b17_34915335_spdbb');

//APP ROOT
//MAGIC FILE gives us path to config.php
///Applications/XAMPP/xamppfiles/htdocs/onomvc/app/config/config.php
//dirname() => gives parent folder name
//to define a constant we need the key word define, and it needs to be written in all capps
define('APPROOT', dirname(dirname(__FILE__)));

//URL ROOT
define('URLROOT', 'http://hoisted.bytehost17.com');

//site name
define('SITENAME', 'Hoisted');

//App Version
define('APPVERSION', ' 1.0.1');

