<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loader
{
    private $_module;

    public function __construct()
    {
        $this->_module = get_segment(0);
        if(!isset($module)) {
            require SYSPATH . 'config/config.php';
            $this->_module = $config['default_controller'];
        } else {
            $this->_module = get_segment(0);
        }
    }

    public function helper($helper)
    {
        if(is_array($helper))
        {
            foreach($helper as $file) {
                $filename = BASEPATH . $this->_module . '/helpers/' . $file . '_helper.php';
                if(file_exists($filename)) {
                    require_once $filename;
                } else {
                    $filename = SYSPATH . 'helpers/' . $file . '_helper.php';
                    if(file_exists($filename)) {
                        require_once $filename;
                    }
                }
            }
        } else {
            $filename = BASEPATH . $this->_module . '/helpers/' . $file . '_helper.php';
            if(file_exists($filename)) {
                require_once $filename;
            } else {
                $filename = SYSPATH . 'helpers/' . $file . '_helper.php';
                if(file_exists($filename)) {
                    require_once $filename;
                }
            }
        }
    }

    public function view($view, $var = '')
    {
        @ob_start();
        if (is_array($var))
        {
            $the_vars = extract($var);
        }
        include BASEPATH . 'modules/' . $this->_module . '/views/' . $view . '.php';
        @ob_end_flush();
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
            show_error('Error - model name "' . $name . '" is already defined');
        }
        else
        {
            $filename = BASEPATH . $this->_module . '/models/' . strtolower($model) . '.php';
            if (file_exists($filename))
            {
                require_once SYSPATH . 'core/model.php';
                require_once $filename;
                $model = ucfirst(strtolower($model));
                $CI->$name = new $model();
            }
            else
            {
                show_error('Error - Model file "' . $name . '" could not be found');
            }
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
            show_error('Error - library name "' . $name . '" is already defined');
        }
        else
        {
            $lib = ucfirst(strtolower($lib));
            $filename = BASEPATH . $this->_module . '/libraries/' . $lib . '.php';
            if (file_exists($filename))
            {
                require_once $filename;
                $CI->$name = new $lib();
            }
            else
            {
                $filename = SYSPATH . 'libraries/' . $lib . '.php';
                if (file_exists($filename))
                {
                    require_once $filename;
                    $CI->$name = new $lib();
                }
                else
                {
                    show_error('Error - Model file "' . $name . '" could not be found');
                }
            }
        }
    }
}
