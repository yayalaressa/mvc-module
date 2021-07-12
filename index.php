<?php

error_reporting(E_ALL);
define('BASEPATH', str_replace("\\", "/", realpath(dirname(__FILE__))) . '/');
define('SYSPATH', BASEPATH . 'system' . DIRECTORY_SEPARATOR);
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

ob_start();
require SYSPATH . 'core/router.php';
$router = new Router();
$router->do_request();
ob_end_flush();

function show_error($message = '')
{
    ob_end_clean();
    if ($message == '')
    {
        $message = '404 - Page not found!';
    }
    require SYSPATH . 'config/config.php';
    if(!empty($config['404_override'])) {
        $message = '';
        include SYSPATH . 'views/' . $config['404_override'] .'.php';
    } else {
        $heading = 'Your app error!';
        include SYSPATH . 'views/errors/error_404.php';
    }
    exit();
}
