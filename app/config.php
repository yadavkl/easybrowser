<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
define('HTTP_SERVER', $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . '/');
define('HTTP_INDEX', $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '/');
define('HTTP_IBROWSER', $protocol . $_SERVER['HTTP_HOST'] . rtrim(rtrim(dirname($_SERVER['SCRIPT_NAME']), 'app'), '/.\\') . '/');
define('DIR_APPLICATION', str_replace('\\', '/', realpath(dirname(__FILE__))) . '/');
define('DIR_SYSTEM', str_replace('\\', '/', realpath(dirname(__FILE__) . '/../')) . '/system/');
define('DIR_CACHE', str_replace('\\', '/', realpath(dirname(__FILE__) . '/../')) . '/upload/cache/');
define('DIR_IBROWSER', str_replace('\\', '/', realpath(DIR_APPLICATION . '../')) . '/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/template/');

define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'password');
define('DB_DATABASE', 'dbname'); 
define('DB_PREFIX', 'ind_');
define('CACHE_PREFIX','cache.');
