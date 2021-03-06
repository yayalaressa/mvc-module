<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Controller
{
    private static $instance;
    public $session;
    public $input;
    public $load;
    public $config;
    
    public function __construct()
    {
        self::$instance = $this;
        require_once SYSPATH . 'core/session.php';
        require_once SYSPATH . 'core/input.php';
        require_once SYSPATH . 'core/loader.php';
        require_once SYSPATH . 'core/config.php';
        $this->session = new Session();
        $this->input = new Input();
        $this->load = new Loader();
        $this->config = new Config();

        if (!$this
            ->config
            ->item('site_open'))
        {
            show_error('Sedang dalam perbaikan!');
        }
        if ($this
            ->config
            ->item('use_database'))
        {
            spl_autoload_register('load_db');
        }
        $this->load->helper('dispatch');
        $this->load->library('flash_message');
        $this->load->library('theme');
    }

    public static function &get_instance()
    {
        return self::$instance;
    }
}

function &get_instance()
{
    return Controller::get_instance();
}

function base_url($clear = false)
{
    $CI = & Controller::get_instance();
    if ($clear)
    {
        return $CI
            ->config
            ->item('base_url');
    }
    return $CI
        ->config
        ->item('base_url') . 'index.php/';
}

function load_db()
{
    include SYSPATH . 'core/database.php';
}

function redirect($uri = '', $method = 'location', $http_response_code = 302)
{
    if (!preg_match('#^https?://#i', $uri))
    {
        $uri = site_url($uri);
    }
    switch ($method)
    {
        case 'refresh':
            header("Refresh:0;url=" . $uri);
        break;
        default:
            header("Location: " . $uri, true, $http_response_code);
        break;
    }
    exit;
}
