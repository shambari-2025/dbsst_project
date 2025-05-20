<?php
//define->wwwroot   = 'http://asu.tut.tj';
define('URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
##define('URL', 'http://'.$_SERVER['HTTP_HOST'].'/');

define('TMPL_URL', URL.'views/');

define('ADMIN_URL', URL.'admin/');
define('TEACHER_URL', URL.'teacher/');


define('URL_TO_MODULES', URL.'modules/');

define('LOGIN_URL', URL."?option=login");
define('LOGOUT_URL', URL."?option=logout");

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'Edudbsst##2025');
define('DB_NAME', 'dbsst_db_asu');

?>