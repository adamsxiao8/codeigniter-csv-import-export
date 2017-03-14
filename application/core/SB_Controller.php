<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SB_Controller extends CI_Controller
{
    
    var $error;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function display($view, $vars = array(), $return = FALSE)
    {
        $this->load->view('page/header');
        if (!($this->router->class=="user" && ($this->router->method=="login" || $this->router->method=="do_login")))
        {
            $menu = $this->render_menu();
            $this->load->view('page/menu', array('menu'=>$menu));
        }
        $vars['error'] = $this->error;
        $this->load->view($view, $vars);
        $this->load->view('page/footer');
    }
    
    public function render_menu()
    {
        $session = $this->session->userdata('logged_in');
        $role = $session['role'];
        $html = '';
        $this->load->model('Menu_model');
        $menu = $this->Menu_model->get_menu($role);
        foreach ($menu as $m)
        {
            if (strtolower($m['controller'])==$this->router->class && $m['action']==$this->router->method)
            {
                $active = "active";
            }
            else
            {
                $active = "";
            }
            if (isset($m['children']) && count($m['children'])>0)
            {
                $html .= "<li class='dropdown $active'>";
                $html .= "<a data-toggle='dropdown' class='dropdown-toggle' href='#'>" . $m['title'] . " <b class='caret'></b></a>";
                $html .= "<ul role='menu' class='dropdown-menu'>";
                foreach ($m['children'] as $c)
                {
                    $url = base_url(strtolower($c['controller'].'/'.$c['action']));
                    $html .= "<li><a href='" . $url . "'>" . $c['title'] . "</a></li>";
                    $html .= "<li class='divider'></li>";
                }
                $html .= "</ul>";
                $html .= "</li>";
            }
            else
            {
                $url = base_url(strtolower($m['controller'].'/'.$m['action']));
                $html .= "<li class='$active'><a href='" . $url . "'>" . $m['title'] . "</a></li>";
            }
        }
        
        return $html;
    }
}
