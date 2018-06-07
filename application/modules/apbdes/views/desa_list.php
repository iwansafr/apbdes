<?php
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
}