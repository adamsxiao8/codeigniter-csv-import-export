<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends SB_Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->display('reports/index');
    }

    public function search()
    {
        $this->display('reports/index');
    }
}