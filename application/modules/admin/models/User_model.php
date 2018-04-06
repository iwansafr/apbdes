<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_user($id = 0)
	{
		if(!empty($id))
		{
			$query = $this->db->get_where('user', array('id'=>$id));
			return $query->row_array();
		}
	}

	public function get_user_list($page = 0, $keyword = NULL)
	{
		$data = array();
    $url_get = base_url('admin/user_list').'';
		$limit = 2;

    if(!empty($_GET))
    {
    	if(!empty($_GET['keyword']))
    	{
	      $keyword = @$_GET['keyword'];
	      $url_get = base_url('admin/user_list').'?keyword='.$keyword;
    	}
      if(!empty($_GET['page']))
      {
      	$page = @intval($_GET['page']);
      }
    }
    if($keyword==NULL)
    {
      $total_rows = $this->db->count_all('user');
    }else{
      $query = $this->db->query('SELECT id FROM `user` WHERE id = "'.$keyword.'" OR username LIKE "'.$keyword.'%"');
      $total_rows = $query->num_rows();
    }

    $config = pagination($total_rows,$limit,$url_get);
    $this->pagination->initialize($config);
  	$data['pagination'] = $this->pagination->create_links();

		if($page>0)
		{
			$page = $page-1;
		}

		$page = @intval($page)*$limit;
		$this->db->limit($limit,$page);

		if($keyword != NULL)
		{
			$sql = ' WHERE id = "'.$keyword.'" OR username LIKE "'.$keyword.'%"';
		}
		$query = $this->db->query('SELECT * FROM `user` '.@$sql.' ORDER BY id DESC LIMIT '.$page.','.$limit);
		$data['data'] = $query->result_array();

		return $data;
	}
	public function get_siswa_list($page = 0, $keyword = NULL)
	{
		$data = array();
    $url_get = base_url('admin/siswa_list').'';
		$limit = 10;

    if(!empty($_GET))
    {
    	if(!empty($_GET['keyword']))
    	{
	      $keyword = @$_GET['keyword'];
	      $url_get = base_url('admin/siswa_list').'?keyword='.$keyword;
    	}
      if(!empty($_GET['page']))
      {
      	$page = @intval($_GET['page']);
      }
    }
    if($keyword==NULL)
    {
      $total_rows = $this->db->count_all('siswa');
    }else{
      $query = $this->db->query('SELECT nama_siswa FROM `siswa` WHERE nama_siswa LIKE "'.$keyword.'%"');
      $total_rows = $query->num_rows();
    }

    $config = pagination($total_rows,$limit,$url_get);
    $this->pagination->initialize($config);
  	$data['pagination'] = $this->pagination->create_links();

		if($page>0)
		{
			$page = $page-1;
		}

		$page = @intval($page)*$limit;
		$this->db->limit($limit,$page);

		if($keyword != NULL)
		{
			$sql = ' WHERE nama_siswa LIKE "'.$keyword.'%"';
		}
		$query = $this->db->query('SELECT * FROM `siswa` '.@$sql.' ORDER BY nama_siswa DESC LIMIT '.$page.','.$limit);
		$data['data'] = $query->result_array();

		return $data;
	}

	/*set*/

	public function set_user($id = 0)
	{
		$this->load->helper('url');
		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
	    'password' => $this->input->post('password'),
	    'role' => $this->input->post('role'),
			);
		if($id > 0)
		{
			$this->db->update('user', $data, 'id = '.$id);
		}else{
			$this->db->insert('user', $data);
		}
	}

	/*del*/

	public function is_exist($username = NULL, $id = 0)
	{
		if($id == NULL)
		{
			$query = $this->db->get_where('user', array('username' => $username));
		}else{
			$query = $this->db->get_where('user', array('username' => $username, 'id'=>$id));
		}
		return $query->row_array();
	}
}