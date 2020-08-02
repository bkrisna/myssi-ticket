<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomError extends MY_Controller 
{

	public function __construct()
    {
        parent::__construct();
		$this->data['module_key'] = 'customerror';
    }
	
	public function index()
	{
        redirect('/', 'refresh');
	}

    public function pagenotfound()
    {
        $this->set_pagename('pagenotfound');
        $this->data['pagetitle'] = "Page Not Found";
        $this->template->render('new_errors/error_404', $this->data);
    }

}
