<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(is_admin()){
	$this->load->view('admin/user/list');

	if(!empty($_POST['del_row']))
	{
		foreach ($_POST['del_row'] as $key => $value)
		{
			$name = 'config_user_'.$value;
			$this->db->query("DELETE FROM config WHERE name = '{$name}'");
		}
	}
}else{
	echo msg('you dont have permission to access this site','danger');
}