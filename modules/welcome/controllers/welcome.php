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
        $this
            ->load
            ->view('welcome_message');
    }
}

