<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Input {

    public function post($name, $xss_clean = false)
    {
        if(isset($_POST) && !empty($_POST)) {
            if($xss_clean === true)
            {
                htmlentities($_POST[$name], ENT_QUOTES, 'UTF-8');
            } else {
                return $_POST[$name];
            }
        }
    }

    public function get($name, $xss_clean = false)
    {
        if(isset($_GET) && !empty($_GET))
        {
            if (!preg_match('/^[a-z0-9:_\/|-]+$/i', $_GET[$name])) {
                die('Input Disallowed!');
            } else if($xss_clean == true) {
                htmlentities($_GET[$name], ENT_QUOTES, 'UTF-8');
            } else {
                return $_GET[$name];
            }
        } 
    }
}