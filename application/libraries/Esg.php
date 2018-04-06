
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Esg extends CI_Model
{
	public function __construct()
  {
  	parent::__construct();
    $this->load->model('admin/data_model');
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->helper('email');
    $this->load->model('admin/admin_model');
    $this->load->library('pagination');
  }

  var $comment_module    = 'content';
  var $comment_module_id = 0;
  var $user              = array();

  public function get_comment()
  {
    $data = $this->data_model->get_data_list();
  }

  public function set_comment_module($title = '')
  {
    if(!empty($title))
    {
      $this->comment_module = $title;
    }
  }

  private function get_comment_module()
  {
    $module = $this->comment_module;
    $id     = 1;
    switch ($module)
    {
      case 'content':
        $id = 1;
        break;
      case 'product':
        $id = 2;
      default:
        $id = 1;
        break;
    }
    return $id;
  }

  public function set_comment_module_id($id = 0)
  {
    if(!empty($id) && is_numeric($id))
    {
      $this->comment_module_id = $id;
    }
  }

  public function comment_form()
  {
    if(!empty($module) && is_array($module))
    {
      if(!empty($module));
    }
    if(!empty($this->session->userdata('logged_in')))
    {
      $this->user = $this->session->userdata('logged_in');
    }
    if(!empty($_POST))
    {
      $this->comment_action();
    }
    ?>
    <form action="" method="post" name="comment">
      <?php
      if(empty($user))
      {
        ?>
        <input type="text" name="username" placeholder="username" class="form-control">
        <?php
      }?>
      <textarea class="form-control" name="content" placeholder="comment"></textarea>
      <button class="btn btn-success"><i class="fa fa-paper-plane"></i> SEND</button>
    </form>
    <?php
  }

  private function comment_action()
  {
    $data = array();
    $user = $this->session->userdata('logged_in');
    foreach ($_POST as $key => $value)
    {
      $data[$key] = $value;
    }
    if(!empty($user))
    {
      $data['user'] = $user['username'];
    }
    $data['module'] = $this->get_comment_module();
    $data['module_id'] = $this->comment_module_id;
    $this->data_model->set_data('comment', 0, $data);
  }

  function set_tag()
  {
    $post['tag_ids'] = $_POST['tag_ids'];
    $post['tag_ids'] = explode(',', $post['tag_ids']);
    $tag_ids = array();
    foreach ($post['tag_ids'] as $key => $value)
    {
      $tag_exist = $this->data_model->get_one('content_tag', 'title', " WHERE title = '$value'");
      if(empty($tag_exist))
      {
        $this->db->insert('content_tag', array('title'=>$value));
      }
      $tag_id = $this->data_model->get_one('content_tag', 'id', " WHERE title = '$value'");
      if(!empty($tag_id))
      {
        $tag_ids[] = $tag_id;
      }
    }
    $post['tag_ids'] = ','.implode($tag_ids,',').',';
    return $post['tag_ids'];
  }

  public function js()
  {
		$link_js = @$this->session->userdata('link_js');
		if(!empty($link_js))
		{
			echo '<script src="'.$link_js.'"></script>';
		}

    echo $this->session->userdata('js_meta');
	  echo $this->session->userdata('js_extra');
  }

  public function get_menu($data = array(), $id = 0)
  {
    $menu = array();
    if(is_array($data) && !empty($data))
    {
      $p_id = str_replace('menu_','',$data['content']);
      $menu = $this->db->get_where('menu', 'publish = 1 AND par_id = '.$id.' AND position_id = '.$p_id)->result_array();
      if(!empty($menu))
      {
        $i= 0;
        foreach ($menu as $key => $value)
        {
          $menu[$i]['child'] = call_user_func(array('esg',__FUNCTION__), $data, $value['id']);
          $i++;
        }
      }
    }
    return $menu;
  }

  public function get_content_data($data = array())
  {
    $content = array();
    if(!empty($data) && is_array($data))
    {
      $this->db->get_where('content');
    }
    return $content;
  }

  public function parent_menu($table = '', $id = 0)
  {
    $data_menu = array();
    if(!empty($table))
    {
      $this->db->order_by('sort_order','ASC');
      $data_menu = $this->db->get_where($table, 'publish = 1 AND par_id = 0 AND position_id = '.$id)->result_array();
    }
    return $data_menu;
  }
  public function child_menu($table = '', $par_id = 0)
  {
    $data_menu = array();
    if(!empty($table))
    {
      $this->db->order_by('sort_order','ASC');
      $data_menu = $this->db->get_where($table, 'publish = 1 AND par_id = '.$par_id)->result_array();
    }
    return $data_menu;
  }
  public function get_config($name = '')
  {
    $data = array();
    if(!empty($name))
    {
      $this->db->select('value');
      $value = $this->db->get_where('config',"name = '{$name}'")->row_array();
      if(!empty($value))
      {
        $data = json_decode($value['value'], 1);
      }
    }
    return $data;
  }

  public function get_content($where = '', $limit = 7)
  {
    $this->db->order_by('id', 'desc');
    $content = $this->db->get_where('content', $where, $limit)->result_array();
    return $content;
  }

  public function get_cat($id = 0)
  {
    if(!empty($id))
    {
      if(is_numeric($id))
      {
        $data = $this->data_model->get_one_data('content_cat', ' WHERE id = '.$id);
        return $data;
      }else{
        $id = explode('_', $id);
        $id = end($id);
        if(is_numeric($id))
        {
          $content = $this->data_model->get_one_data('content_cat', ' WHERE id = '.$id);
          return $content;
        }
      }
    }
  }

  public function get_cat_list($where = '', $limit = 7)
  {
    $this->db->order_by('id', 'desc');
    if(preg_match('~=~', $where))
    {
      $content = $this->db->get_where('content_cat', $where, $limit)->result_array();
      return $content;
    }else{
      $where = explode('_', $where);
      $where = end($where);
      if(is_numeric($where))
      {
        $content = $this->db->get_where('content_cat', 'par_id = '.$where, $limit)->result_array();
        return $content;
      }
    }
  }
}