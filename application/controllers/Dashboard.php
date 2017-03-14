<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends SB_Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->display('dashboard');
    }
}