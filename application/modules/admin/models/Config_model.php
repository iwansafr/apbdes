<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Config_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function set_config($name = '')
	{
		if(!empty($name))
		{
	    if(!empty($_FILES['image']['name']) && empty($_POST['image']))
		  {
		    $_POST['image'] = $_FILES['image']['name'];
		    $image = $_POST['image'];
		  }
			$params = $this->input->post();
    	$params = json_encode($params);
    	$is_exist = $this->db->get_where('config', 'name = "'.$name.'"', '1');
    	$is_exist = $is_exist->row_array();
    	if(empty($is_exist))
    	{
    		$this->db->insert('config', array('name'=>$name, 'value'=>$params));
    		if($this->db->affected_rows())
				{
					$query = $this->db->query('SELECT LAST_INSERT_ID() AS id');
					$data = $query->row_array();
					$last_id = 0;
					if(!empty($data))
					{
						$last_id = $data['id'];
					}
					if(!empty($_FILES['image']['name']))
					{
						$dir = FCPATH.'images/modules/config/'.$name.'/'.$last_id.'/';
						if(!is_dir($dir))
						{
							mkdir($dir, 0755,1);
						}
						copy($_FILES['image']['tmp_name'], $dir.$image);
					}

				}
    	}else{
    		$id = $is_exist['id'];
				if(!empty($_FILES['image']['name']))
				{
					recursive_rmdir(FCPATH.'images/modules/config/'.$name);
					$dir = FCPATH.'images/modules/config/'.$name.'/'.$id.'/';
					if(!is_dir($dir))
					{
						mkdir($dir, 0755,1);
					}
					copy($_FILES['image']['tmp_name'], $dir.$image);
				}
    		$this->db->update('config', array('name'=>$name, 'value'=>$params), 'id = '.$id);
    	}
		}
	}

	public function get_config($name = '')
	{
		if(!empty($name))
		{
			$query  = $this->db->get_where('config', 'name = "'.$name.'"', '1');
			$config = $query->row_array();
			return $config;
		}
	}
}