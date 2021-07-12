<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Router
{
    private static $_segment = array();
    private $_controller;
    private $_method;
    private $_var = array();
    
    public function __construct()
    {
        $this->_set_uri();
        $this->_set_controller();
        $this->_set_method();
        $this->_set_vars();
    }

    private function _set_uri()
    {

        $uri_string = str_replace($_SERVER['REQUEST_URI'], '', $_SERVER['SCRIPT_NAME']);

        if ($uri_string == 'index.php')
        {
            $uri_string = '';
        }
        else
        {
            $uri_string = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['REQUEST_URI']);

            $uri_string = preg_replace("|/*(.+?)/*$|", "\\1", str_replace("\\", "/", $uri_string));
            $uri_string = trim($uri_string, '/');
        }
        if(!preg_match('/index\.php/', $_SERVER['REQUEST_URI'], $matches))
        {
            $ex = explode('/', $uri_string);
            $uri_string = str_replace($ex[0] . '/', '', $uri_string);
        }
        self::$_segment = preg_split('[\\/]', $uri_string, 0, PREG_SPLIT_NO_EMPTY);
    }

    private function _set_controller()
    {
        if (!isset(self::$_segment[0]))
        {
            require SYSPATH . 'config/config.php';
            self::$_segment[0] = $config['default_controller'];
        }
        if (!isset(self::$_segment[1]))
        {
            require SYSPATH . 'config/config.php';
            self::$_segment[1] = $config['default_controller'];
        }
        $controller_path = BASEPATH . 'modules/' . self::$_segment[0] . '/controllers/' . self::$_segment[1] . '.php';
        if (!file_exists($controller_path))
        {
        	show_error('file kontroller tidak ada');
        }
        else
        {
            require SYSPATH . 'core/controller.php';
            require $controller_path;
            $class = ucfirst(self::$_segment[1]) . 'Controller';
            if (!class_exists($class))
            {
                show_error('kelas kontroller tidak ada');
            }
            if(get_parent_class($class) !== 'Controller')
            {
            	show_error('parent kontroller tidak sesuai');
            } else {
                $this->_controller = new $class();
            }
        }
    }
    
    private function _set_method()
    {
        if (!isset(self::$_segment[2]))
        {
            self::$_segment[2] = 'index';
        }

        if (!method_exists($this->_controller, self::$_segment[2]))
        {
        	show_error('method tidak ada');
        }
        else
        {
            $this->_method = self::$_segment[2];
            if (substr($this->_method, 0, 1) == '_')
            {
                show_error('private method');
            }
        }
    }

    private function _set_vars()
    {
        if (isset(self::$_segment[3]))
        {
            $this->_var = array_slice(self::$_segment, 3);
        }
    }
    public function do_request()
    {
        call_user_func_array(array(&$this->_controller,
            $this->_method
        ) , $this->_var);
    }
    public static function get_segment($segment)
    {
        return self::$_segment[$segment];
    }
}

function get_segment($segment) {
    return Router::get_segment($segment);
}