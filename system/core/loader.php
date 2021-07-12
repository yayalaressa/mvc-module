<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loader
{
    private $_module;

    public function __construct()
    {
        $this->_module = get_segment(0);
        if (!isset($module))
        {
            require SYSPATH . 'config/config.php';
            $this->_module = $config['default_controller'];
        }
        else
        {
            $this->_module = get_segment(0);
        }
    }
    
    public function helper($helper)
    {
        $filename = BASEPATH . $this->_module . '/helpers/' . $helper . '.php';
        if (!file_exists($filename))
        {
            $filename = SYSPATH . 'helpers/' . $helper . '.php';
        }
        if (file_exists($filename))
        {
            require_once $filename;
        }
    }

    public function view($view, $var = array() , $return = false)
    {
        if (is_array($var))
        {
            $the_vars = extract($var);
        }

        $filename = BASEPATH . 'modules/' . $this->_module . '/views/' . $view . '.php';
        if (!file_exists($filename))
        {
            $filename = SYSPATH . 'views/' . $view . '.php';
        }
        if (!file_exists($filename))
        {
            show_error('View file not found!');
        }
        
        if (is_bool($return) && $return === true)
        {
        	ob_start();
            include $filename;
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }
        else
        {
        	ob_start();
            include $filename;
            ob_end_flush();
        }
    }

    public function model($model, $name = '')
    {
        $CI = & get_instance();

        /* Cek apakah name kosong, menggunakan name model */
        if ($name == '')
        {
            $name = strtolower($model);
        }
        /* Jika name ada, tampilkan pesan error */
        if (isset($CI->$name))
        {
            show_error('Error - model name "' . $model . '" is already defined');
        }

        $filename = BASEPATH . $this->_module . '/models/' . strtolower($model) . '.php';
        if (!file_exists($filename))
        {
            show_error('Error - Model file "' . $model . '" could not be found');
        }
        else
        {
            require_once SYSPATH . 'core/model.php';
            require_once $filename;
            $model = ucfirst(strtolower($model));
        }
        if (!class_exists($model))
        {
            show_error('Error - Class model ' . $model);
        }
        else
        {
            $CI->$name = new $model();
        }
    }

    public function library($lib, $name = '')
    {
        $CI = & get_instance();

        /* Cek apakah name kosong, menggunakan name model */
        if ($name == '')
        {
            $name = strtolower($lib);
        }
        /* Jika name ada, tampilkan pesan error */
        if (isset($CI->$name))
        {
            show_error('Error - library name "' . $lib . '" is already defined');
        }

        $filename = BASEPATH . $this->_module . '/libraries/' . $lib . '.php';
        if (!file_exists($filename))
        {
            $filename = SYSPATH . 'libraries/' . $lib . '.php';
        }
        if (!file_exists($filename))
        {
            show_error('Error - Model file "' . $lib . '" could not be found');
        }
        else
        {
            require_once $filename;
            $lib = ucfirst(strtolower($lib));
        }
        if (!class_exists($lib))
        {
            show_error('Error - Class library ' . $lib);
        }
        else
        {
            $CI->$name = new $lib();
        }
    }
}
