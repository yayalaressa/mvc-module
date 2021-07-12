<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['site_open'] = true;
$config['use_database'] = true;

if (isset($_SERVER['HTTP_HOST']))
{
    $config['base_url'] = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ? 'https' : 'http';
    $config['base_url'] .= '://' . $_SERVER['HTTP_HOST'];
    $config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']) , '', $_SERVER['SCRIPT_NAME']);
}
else
{
    $config['base_url'] = '';
}

$config['default_controller'] = 'welcome';

