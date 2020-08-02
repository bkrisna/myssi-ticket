<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menulist_model extends CI_Model
{
	protected $messages;
	protected $errors;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('dbquery/menulist_query', TRUE);
		$this->sql = $this->config->item('dbquery/menulist_query');
	}

	public function getDetail($groupid) 
	{
		return false;
	}

	public function getList($id)
	{
		$id = ($this->db->query($this->sql['get_child_count'], array($id))->row()->child_count > 0) ? $id : 0;
		$query = $this->db->query($this->sql['get_by_parentid'], array($id));
		if ($query->num_rows() > 0) {
			$menus = array();
			foreach ($query->result() as $menu) {
				$g['id'] = $menu->id;
				$g['name'] = $menu->name;
				$g['sort'] = $menu->sort;
				$g['is_parent'] = $menu->is_parent;
				$g['url'] = $menu->url;
				$g['access_name'] = $menu->access_name;
				$g['menu_icon'] = $menu->menu_icon;
				$g['module_name'] = $menu->module_name;
				$g['child_count'] = ($menu->child_count > 0) ? $menu->child_count : 0 ;
				array_push($menus, $g);
			}
			return $menus;
		} else {
			return NULL;
		}
		return null;	
	}
	
 	public function build_breadcrumb($id) {
		$out = array();
		if ($id > 0) 
		{
			$out = $this->get_parents($id, $id);
		} 
		return $out;
 	}

    private function get_parents($id, $active_id)
    {
		$out = array();
		
		$query = $this->db->query($this->sql['get_menu_by_id'], array($id))->row();
		$res['id'] = $query->id;
		$res['name'] = $query->name;
		$res['menu_icon'] = $query->menu_icon;
		$res['is_active'] = ($query->id == $active_id) ? 1 : 0;
				
		if ($query->parent_id == 0) 
		{
			$main['id'] = '0';
			$main['name'] = 'Menu List';
			$main['menu_icon'] = 'fa-list';
			$main['is_active'] = 0;
			$out1 = array($main);
			array_push($out1, $res);
			return $out1;
		}
		else
		{	
			$out = $this->get_parents($query->parent_id, $active_id);
			array_push($out, $res);
			
		}
		
		return $out;
    }
	
	private function re_calculate_nodes()
	{
		return null;
	}
	
	public function rebuilt_tree($parent, $left)
	{
		$right = $left+1;   
		$result = $this->db->query($this->sql['get_child_by_pid'], array($parent));
		if ($result->num_rows() != 0) {
			foreach ($result->result() as $menu) 
			{
				$right = $this->rebuilt_tree($menu->id, $right); 
			}
		}
		
		$param = array ($left, $right, $parent);
		$this->db->query($this->sql['update_menu_tree_parameter'], $param);
		
		return $right+1;
	}
	
}

?>