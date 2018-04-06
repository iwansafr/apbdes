<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

  var $view    = '';
  var $where   = '';
  var $url     = '';
  var $orderby = 'ORDER BY id DESC';

  public function setView($text ='')
  {
    $this->view = $text;
  }

  public function setWhere($sql = '')
  {
    if(!empty($sql))
    {
      $this->where = $sql;
    }
  }

  public function setUrl($url = '')
  {
    if(!empty($url))
    {
      $this->url = $url;
    }
  }

  public function orderBy($field = 'id', $sort = 'DESC')
  {
    if(!empty($field) && !empty($sort))
    {
      $this->orderby = " ORDER BY `{$field}` {$sort} ";
    }
  }

  public function get_all($sql = '')
  {
    if(!empty($sql))
    {
      return $this->db->query($sql)->result_array();
    }
  }

	public function get_data_list($table = '', $field = array(), $input = array(), $limit = 0,$page = 0, $keyword = NULL)
	{
    $data    = array();
    $url_get = base_url('admin/'.$table.'_list').'';
    $id = 0;
    if(!empty($this->view))
    {
      $url_get = base_url($this->view);
    }
    $add_sql = '';

    if(!empty($input) && is_array($input))
    {
    	$input = '`'.implode('`,`',$input).'`';
    }else{
    	$input = '*';
    }

    if(!empty($_GET))
    {
    	if(!empty($_GET['keyword']))
    	{
	      $keyword = $this->db->escape_str($_GET['keyword']);
	      $url_get = base_url('admin/'.$table.'_list').'?keyword='.$keyword;
        if(!empty($this->view))
        {
          $url_get = base_url($this->view).'?keyword='.$keyword;
        }
    	}
      if(!empty($_GET['page']))
      {
      	$page = @intval($_GET['page']);
      }

      if(!empty($_GET['id']))
      {
        $id = $_GET['id'];
      }
    }

    if(!empty($field) && is_array($field))
    {
    	foreach ($field as $fkey => $fvalue)
    	{
    		$add_sql .= " OR {$fvalue} LIKE '%{$keyword}%'";
    	}
    }

		if($page>0)
		{
			$page = $page-1;
		}

		$page = @intval($page)*$limit;
		$this->db->limit($limit,$page);

		$sql = '';
		if($keyword != NULL)
		{
			$sql = " WHERE `id` = ".@intval($keyword)." {$add_sql}";
		}

    if(!empty($this->where))
    {
      if(!empty($sql))
      {
        $sql = $sql.' AND '.$this->where;
      }else{
        $sql = ' WHERE '.$this->where;
      }
    }

		$query         = $this->db->query("SELECT {$input} FROM `{$table}` $sql {$this->orderby} LIMIT {$page},{$limit}");
		$data['query'] = $this->db->last_query();
		$data['data']  = $query->result_array();

    if($keyword==NULL && empty($id))
    {
      $total_rows = $this->db->count_all($table);
    }else{
      $query = $this->db->query("SELECT `id` FROM `{$table}`  WHERE `id` = '{$keyword}' {$add_sql}");
      $total_rows = $query->num_rows();
      if(!empty($this->where))
      {
        if(!empty($sql))
        {
          $sql = $sql.' AND '.$this->where;
        }else{
          $sql = ' WHERE '.$this->where;
        }
        $query = $this->db->query("SELECT `id` FROM `{$table}`  {$sql}");
        $total_rows = $query->num_rows();
      }
    }
    $config = pagination($total_rows,$limit,$url_get);
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();
		return $data;
	}

  public function get_one($table = '', $field = '', $where = '')
  {
    if(!empty($table))
    {
      $data = $this->db->query("SELECT {$field} FROM `{$table}` {$where} LIMIT 1")->row_array();
      return $data[$field];
    }
  }

  public function get_one_data($table = '', $where = '')
  {
    if(!empty($table))
    {
      $data = $this->db->query("SELECT * FROM `{$table}` {$where} LIMIT 1")->row_array();
      return $data;
    }
  }

  public function LAST_INSERT_ID()
  {
    $query   = $this->db->query('SELECT LAST_INSERT_ID() AS id');
    $data    = $query->row_array();
    $last_id = !empty($data) ? $data['id'] : 0;
    return $last_id;
  }

  public function set_param($table = '',$name = '', $post = array())
  {
    if(!empty($table))
    {
      $data = array();
      foreach ($post as $key => $value)
      {
        $data[$key] = $value;
      }
      if($this->get_one_data($table, "WHERE name = '{$name}'"))
      {
        return $this->db->update($table, $data, "`name` = '{$name}'");
      }else{
        return $this->db->insert($table, $data);
      }
    }
  }

  public function set_data($table = '',$id = 0, $post = array())
  {
    if(!empty($table))
    {
      $data = array();
      foreach ($post as $key => $value)
      {
        $data[$key] = $value;
      }
      if($id > 0)
      {
        return $this->db->update($table, $data, 'id = '.$id);
      }else{
        return $this->db->insert($table, $data);
      }
    }
  }

  public function del_data($table='',$ids = array())
  {
    if(!empty($ids)&&!empty($table))
    {
      foreach ($ids as $key => $id)
      {
        $this->db->delete($table, array('id'=>$id));
        $dir = FCPATH.'images/modules/'.$table.'/'.$id.'/';
        recursive_rmdir($dir);
        $dir = FCPATH.'images/modules/'.$table.'/gallery'.'/'.$id.'/';
        recursive_rmdir($dir);
      }
    }
  }
}