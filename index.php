<?php

error_reporting(E_ALL);
define('BASEPATH', str_replace("\\", "/", realpath(dirname(__FILE__))) . '/');
define('SYSPATH', BASEPATH . 'system' . DIRECTORY_SEPARATOR);
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

ob_start();
session_start();
require SYSPATH . 'core/router.php';
$router = new Router();
$router->do_request();
ob_end_flush();

function show_error($message = '')
{
    ob_end_clean();
    if ($message == '')
    {
        $message = '<b>404 - Page not found!</b>';
    }
    exit($message);
}
