<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#get query
$config['get_by_parentid'] 					= 'SELECT menu.*, menu_module.module_name, menu_access.access_name, child_tbl.child_count FROM menu LEFT JOIN menu_module ON menu_module.id = menu.module_id LEFT JOIN menu_access on menu_access.id = menu.access_type LEFT JOIN (SELECT menu.parent_id as child_parent, COUNT(menu.id) as child_count FROM menu GROUP BY menu.parent_id) AS  child_tbl on child_tbl.child_parent = menu.id WHERE menu.parent_id = ? ORDER BY menu.parent_id,menu.sort ASC';
$config['get_child_count']					= 'SELECT COUNT(menu.id) as child_count FROM menu WHERE menu.parent_id = ?';
$config['get_parent'] 						= 'SELECT menu.id, menu.name FROM menu WHERE menu.parent_id = ? ORDER BY menu.parent_id,menu.sort ASC';
$config['get_menu_by_id'] 					= 'SELECT menu.* FROM menu WHERE menu.id = ?';
$config['get_child_by_pid'] 				= 'SELECT menu.id FROM menu WHERE menu.parent_id= ?';



#update query
$config['update_menu_tree_parameter'] 		= 'UPDATE menu SET lft = ?, rgt = ? WHERE menu.id = ?';