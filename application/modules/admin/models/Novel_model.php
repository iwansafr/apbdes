<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Novel_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	/*get*/
	public function get_cat($id = 0)
	{
		$query = $this->db->get_where('novel_cat', array('id' => $id));
		return $query->row_array();
	}

	public function get_cat_All($field = '*', $where = '')
	{
		$sql = !empty($where) ? $where : '';
		$query = $this->db->query('SELECT '.$field.' FROM novel_cat '.$sql);
		return $query->result_array();
	}

	public function get_cat_data($where = '')
	{
		$sql = !empty($where) ? $where : '';
		$query = $this->db->query('SELECT * FROM novel_cat '.$sql);
		return $query->row_array();
	}
	public function get_cat_ids()
	{
		$query = $this->db->query('SELECT `id`,`title` FROM `novel_cat` WHERE 1 AND `publish` = 1');
		return $query->result_array();
	}
	public function get_cat_list($page = 0, $keyword = NULL)
	{
		$data = array();
    $url_get = base_url('admin/novel_category').'';
		$limit = 3;

    if(!empty($_GET))
    {
    	if(!empty($_GET['keyword']))
    	{
	      $keyword = @$_GET['keyword'];
	      $url_get = base_url('admin/novel_category').'?keyword='.$keyword;
    	}
      if(!empty($_GET['page']))
      {
      	$page = @intval($_GET['page']);
      }
    }
    if($keyword==NULL)
    {
      $total_rows = $this->db->count_all('novel_cat');
    }else{
      $query = $this->db->query('SELECT id FROM `novel_cat` WHERE id = "'.$keyword.'" OR title LIKE "'.$keyword.'%"');
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
		if($keyword != NULL)
		{
			$sql = ' WHERE id = "'.$keyword.'" OR title LIKE "'.$keyword.'%"';
		}
		$query = $this->db->query('SELECT *,CASE WHEN par_id = 0 THEN id ELSE par_id END AS Sort FROM `novel_cat` '.@$sql.' ORDER BY sort,id LIMIT '.$page.','.$limit);
		$data['data_list'] = $query->result_array();
		return $data;
	}

	public function get_novel($id = 0)
	{
		$query = $this->db->get_where('novel', array('id' => $id));
		return $query->row_array();
	}

	public function get_novel_All($field = '*', $where = '')
	{
		$sql = !empty($where) ? $where : '';
		$query = $this->db->query('SELECT '.$field.' FROM novel '.$sql);
		return $query->result_array();
	}
	public function get_novel_data($where = '')
	{
		$sql = !empty($where) ? $where : '';
		$query = $this->db->query('SELECT * FROM novel '.$sql);
		return $query->row_array();
	}

	public function get_novel_ids()
	{
		$query = $this->db->query('SELECT `id`,`title` FROM `novel` WHERE 1 AND `publish` = 1');
		return $query->result_array();
	}
	public function get_novel_list($page = 0, $keyword = NULL)
	{
		$data = array();
    $url_get = base_url('admin/novel_novel').'';
		$limit = 5;

    if(!empty($_GET))
    {
    	if(!empty($_GET['keyword']))
    	{
	      $keyword = @$_GET['keyword'];
	      $url_get = base_url('admin/novel_novel').'?keyword='.$keyword;
    	}
      if(!empty($_GET['page']))
      {
      	$page = @intval($_GET['page']);
      }
    }
    if($keyword==NULL)
    {
      $total_rows = $this->db->count_all('novel');
    }else{
      $query = $this->db->query('SELECT id FROM `novel` WHERE id = "'.$keyword.'" OR title LIKE "'.$keyword.'%"');
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
		if($keyword != NULL)
		{
			$sql = ' WHERE id = "'.$keyword.'" OR title LIKE "'.$keyword.'%"';
		}
		$query = $this->db->query('SELECT * FROM `novel` '.@$sql.' ORDER BY id DESC LIMIT '.$page.','.$limit);
		$data['data_list'] = $query->result_array();
		return $data;
	}

	public function get_chapter($id = 0)
	{
		if(!empty($id))
		{
			$query = $this->db->get_where('novel_chapter', array('id'=>$id));
			return $query->row_array();
		}
	}

	public function get_chapter_list($page = 0, $keyword = NULL)
	{
		$data = array();
    $url_get = base_url('admin/novel_list').'';
		$limit = 3;

    if(!empty($_GET))
    {
    	if(!empty($_GET['keyword']))
    	{
	      $keyword = @$_GET['keyword'];
	      $url_get = base_url('admin/novel_list').'?keyword='.$keyword;
    	}
      if(!empty($_GET['page']))
      {
      	$page = @intval($_GET['page']);
      }
    }
    if($keyword==NULL)
    {
      $total_rows = $this->db->count_all('novel_chapter');
    }else{
      $query = $this->db->query('SELECT id FROM `novel_chapter` WHERE id = "'.$keyword.'" OR title LIKE "'.$keyword.'%"');
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
			$sql = ' WHERE id = "'.$keyword.'" OR title LIKE "'.$keyword.'%"';
		}
		$query = $this->db->query('SELECT * FROM `novel_chapter` '.@$sql.' ORDER BY id DESC LIMIT '.$page.','.$limit);
		$data['data'] = $query->result_array();

		return $data;
}

	/*set*/
	public function set_cat($id = 0)
	{
		$this->load->helper('url');

		$publish = !empty($this->input->post('publish')) ? 1:0;
		$data = array(
			'title' => $this->input->post('title'),
			'par_id' => $this->input->post('par_id'),
			'description' => $this->input->post('description'),
			'publish' => $publish
		);
		if($id > 0)
		{
			return $this->db->update('novel_cat', $data, 'id = '.$id);
		}else{
			return $this->db->insert('novel_cat', $data);
		}
	}

	public function publish_data($table = '', $ids = array(''))
	{
		if(!empty($table))
		{
			$data_id = $this->input->post('id');
			if(!empty($data_id))
			{
				foreach ($data_id as $key => $id)
				{
					if(!empty($ids))
					{
						if(in_array($id, $ids))
						{
							$this->db->update($table, array('publish'=>1), 'id = '.$id);
						}else{
							$this->db->update($table, array('publish'=>0), 'id = '.$id);
						}
					}else{
						$this->db->update($table, array('publish'=>0), 'id = '.$id);
					}
				}
			}
		}
	}

	public function set_novel($id = 0)
	{
		$this->load->helper('url');

		$publish = !empty($this->input->post('publish')) ? 1:0;
		$editable = !empty($this->input->post('editable')) ? 1:0;
		$cat_ids = $this->input->post('cat_ids');
		if(!empty($cat_ids))
		{
			$cat_ids = implode(',', $cat_ids);
			$cat_ids = ','.$cat_ids.',';
		}else{
			$cat_ids = '';
		}
		$data = array(
			'title' => $this->input->post('title'),
			'cat_ids' => $cat_ids,
			'author' => $this->input->post('author'),
			'status' => $this->input->post('status'),
			'country' => $this->input->post('country'),
			'description' => $this->input->post('description'),
			'publish' => $publish,
			'editable' => $editable
		);
		if($id > 0)
		{
			if($this->db->update('novel', $data, 'id = '.$id))
			{
				if(!empty($_FILES['image']['name']))
				{
					$image = $this->input->post('title').'_'.$id.'.jpg';
					if($this->db->update('novel', array('image'=>$image), 'id = '.$id))
					{
						$dir = FCPATH.'images/modules/novel/'.$id.'/';
						if(!is_dir($dir))
						{
							mkdir($dir, 0755,1);
						}
						copy($_FILES['image']['tmp_name'], $dir.$image);
					}
				}
			}
		}else{
			$this->db->insert('novel', $data);
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
					$image = $this->input->post('title').'_'.$last_id.'.jpg';
					$this->db->update('novel', array('image'=>$image), 'id = '.$last_id);
					if($this->db->affected_rows())
					{
						$dir = FCPATH.'images/modules/novel/'.$last_id.'/';
						if(!is_dir($dir))
						{
							mkdir($dir, 0755,1);
						}
						copy($_FILES['image']['tmp_name'], $dir.$image);
					}
				}

			}
		}
		// die();
	}

	public function set_chapter($id = 0)
	{
		$this->load->helper('url');
		$publish = !empty($this->input->post('publish')) ? 1:0;
		$editable = !empty($this->input->post('editable')) ? 1:0;
		$data = array(
			'title' => $this->input->post('title'),
			'novel_id' => $this->input->post('novel_id'),
	    'content' => $this->input->post('content'),
	    'publish' => $publish,
	    'editable' => $editable
			);
		if($id > 0)
		{
			$this->db->update('novel_chapter', $data, 'id = '.$id);
		}else{
			$this->db->insert('novel_chapter', $data);
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