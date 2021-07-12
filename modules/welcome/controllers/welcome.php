<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class WelcomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        print_r($this->input->get('test'));
        $this
            ->theme
            ->render('welcome_message');
    }
}

