<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller 
{

	public function __construct()
    {
        parent::__construct();
        $this->set_pagename('dashboard');
        $this->data['pagetitle'] = "Dashboard";
    }
	
	public function index()
	{
		if ( ! $this->auth_lib->logged_in() )
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Load Template */
            //$this->menu->set_active_module('dashboard');
            //$data['sidebar'] = $this->menu->build_menu();
			$this->data['module_key'] = 'dashboard';
            $this->template->render('dashboard', $this->data);
        }
	}

}
