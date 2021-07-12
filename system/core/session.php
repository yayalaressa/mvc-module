<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Session
{
    private $items = array();
    
    public function __construct()
    {
        $samesite = 'strict';
        if(PHP_VERSION_ID < 70300) {
            session_set_cookie_params('samesite='.$samesite);	
        } else {
            session_set_cookie_params(['samesite' => $samesite]);
        }
        if (isset($_COOKIE['PHPSESSID']))
            session_start();
    }

    public function userdata($item)
    {
        if (session_status() == PHP_SESSION_NONE) return false;
        if (isset($this->items[$item]))
        {
            return $this->items[$item];
        }
        else
        {
            return false;
        }
    }

    public function set_userdata($item, $value = '')
    {
        if (session_status() == PHP_SESSION_NONE) session_start();
        $this->items[$item] = $value;
    }

    public function unset_userdata($item)
    {
        unset($this->items[$item]);
    }
}
