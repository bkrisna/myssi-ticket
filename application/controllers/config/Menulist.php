<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menulist extends MY_Controller 
{

	public function __construct()
    {
        parent::__construct();
        $this->load->model('config/menulist_model');
		$this->data['module_key'] = 'config/menulist/lists';
    }
	
    public function index()
    {
        if ($this->auth_lib->logged_in() )
        {
            redirect('config/menulist/lists', 'refresh');
        }
        else 
        {
            redirect('auth/login', 'refresh');
        }
    }
	
	public function rebuild_tree()
	{
		$this->menulist_model->rebuilt_tree(0,1);
	}

	public function lists($id = null)
	{
		if ($this->auth_lib->logged_in() )
        {
			$id = ($id != null) ? $id : 0;
            $this->set_pagename('menulist');
            $this->load_bsplugin('dataTables'); 
            $this->data['pagetitle'] = "Menu Manager";
			$this->data['menus'] = $this->menulist_model->getList($id);
			$this->data['menu_breadcrumb'] = ($id > 0 ) ? $this->menulist_model->build_breadcrumb($id) : null;
            $this->template->render('config/menulist/lists', $this->data);
        }
        else 
        {
            redirect('auth/login', 'refresh');
        }
	} 
	
	public function create()
	{
        if ($this->auth_lib->logged_in() )
        {
            $this->set_pagename('menuitemdetail');
            $this->data['pagetitle'] = "Add New Menu Item";
            $this->data['form_url'] = "config/menulist/create";
			$this->data['mode'] = 'add';
            $this->menuview();
        }
        else 
        {
            redirect('auth/login', 'refresh');
        }
	}
	
	public function update()
	{
		return null;
	}
	
	public function delete()
	{
		return null;
	}
	
	
    private function menuview($menuitem = false) 
    {
        if ($this->form_validation->run() == TRUE)
        {
            $data['name']               = $this->input->post('name');
            $data['url']        		= $this->input->post('url');
            $data['menu_icon']          = $this->input->post('menu_icon');

            /*if ($group !== false) {
                $data['id'] = $group->id;
                if ($this->usergroup_model->updateGroup($data, $group->id))
                {
                    $this->session->set_flashdata('message', $this->notification->messages());
                    redirect('usergroups/lists', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', $this->notification->errors());
                    redirect('usergroups/edit/'.$group->id, 'refresh');
                }

            } else {
                if ($this->usergroup_model->addGroup($data))
                {
                    $this->session->set_flashdata('message', $this->notification->messages());
                }
                else
                {
                    $this->session->set_flashdata('error', $this->notification->errors());
                }
                redirect('usergroups/lists', 'refresh');
            }*/
        }
        else
        {
            $this->data['message'] = $this->session->flashdata('message');
            $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

            $this->data['name'] = array(
                'name'        => 'name',
                'id'          => 'name',
                'type'        => 'text',
                'value'       => $this->form_validation->set_value('name', ($menuitem !== FALSE) ? $menuitem->name : ''),
                'class'       => 'form-control',
                'placeholder' => 'Name'
            );

            $this->data['url'] = array(
                'name'        => 'description',
                'id'          => 'description',
                'value'       => $this->form_validation->set_value('description', ($menuitem !== FALSE) ? $menuitem->url : ''),
                'class'       => 'form-control',
                'rows'        => '3',
                'placeholder' => 'URL'
            );
			
            $this->data['parent'] = array(
                'name'        => 'description',
                'id'          => 'description',
                'value'       => $this->form_validation->set_value('description', ($menuitem !== FALSE) ? $menuitem->url : ''),
                'class'       => 'form-control',
                'rows'        => '3',
                'placeholder' => 'URL'
            );
			
            $this->data['status'] = array(
                'name'        => 'description',
                'id'          => 'description',
                'value'       => $this->form_validation->set_value('description', ($menuitem !== FALSE) ? $menuitem->url : ''),
                'class'       => 'form-control',
                'rows'        => '3',
                'placeholder' => 'URL'
            );
			
            $this->data['access'] = array(
                'name'        => 'description',
                'id'          => 'description',
                'value'       => $this->form_validation->set_value('description', ($menuitem !== FALSE) ? $menuitem->url : ''),
                'class'       => 'form-control',
                'rows'        => '3',
                'placeholder' => 'URL'
            );
			
            $this->data['note'] = array(
                'name'        => 'description',
                'id'          => 'description',
                'value'       => $this->form_validation->set_value('description', ($menuitem !== FALSE) ? $menuitem->url : ''),
                'class'       => 'form-control',
                'rows'        => '3',
                'placeholder' => 'URL'
            );
			
            $this->data['desc'] = array(
                'name'        => 'description',
                'id'          => 'description',
                'value'       => $this->form_validation->set_value('description', ($menuitem !== FALSE) ? $menuitem->url : ''),
                'class'       => 'form-control',
                'rows'        => '3',
                'placeholder' => 'URL'
            );

            $this->data['menu_icon'] = array(
                'id'        => 'color',
                'class'     => 'form-control',
                'options'   => array(
                    'red' =>  'Red',
                    'blue' =>  'Blue',
                    'black' =>  'Black',
                    'purple' =>  'Purple',
                    'yellow' =>  'Yellow',
                    'green' =>  'Green'
                ),
                'selected'  => ''
            );

            /*$this->data['projects'] = array(
                'id'        => 'projects_priv',
                'class'     => 'form-control',
                'options'   => array(
                    '0' =>  'None',
                    '1' =>  'Full Access',
                    '2' =>  'View Only',
                    '3' =>  'View Own Only',
                    '4' =>  'Manage Own Only'
                ),
                'selected'  => ($group !== FALSE) ? $group->projects_priv : ''
            );

            $this->data['tasks'] = array(
                'id'        => 'tasks_priv',
                'class'     => 'form-control',
                'options'   => array(
                    '0' =>  'None',
                    '1' =>  'Full Access',
                    '2' =>  'View Only',
                    '3' =>  'View Own Only',
                    '4' =>  'Manage Own Only'
                ),
                'selected'  => ($group !== FALSE) ? $group->tasks_priv : ''
            );

            $this->data['tickets'] = array(
                'id'        => 'tickets_priv',
                'class'     => 'form-control',
                'options'   => array(
                    '0' =>  'None',
                    '1' =>  'Full Access',
                    '2' =>  'View Only',
                    '3' =>  'View Own Only',
                    '4' =>  'Manage Own Only'
                ),
                'selected'  => ($group !== FALSE) ? $group->tickets_priv : ''
            );

            $this->data['discussions'] = array(
                'id'        => 'discussions_priv',
                'class'     => 'form-control',
                'options'   => array(
                    '0' =>  'None',
                    '1' =>  'Full Access',
                    '2' =>  'View Only',
                    '3' =>  'View Own Only',
                    '4' =>  'Manage Own Only'
                ),
                'selected'  => ($group !== FALSE) ? $group->discussions_priv : ''
            );

            $this->data['configs'] = array(
                    'name'          => 'config_priv',
                    'id'            => 'config_priv',
                    'value'         => '1',
                    'checked'       => ($group !== FALSE) ? $group->config_priv : 0,
                    'style'         => 'margin:10px'
            );

            $this->data['users'] = array(
                    'name'          => 'users_priv',
                    'id'            => 'users_priv',
                    'value'         => '1',
                    'checked'       => ($group !== FALSE) ? $group->users_priv : 0,
                    'style'         => 'margin:10px'
            );*/
            
            /* Load Template */
            $this->template->render('config/menulist/detail', $this->data);
        }
    }
	
}
?>