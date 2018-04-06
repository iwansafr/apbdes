<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
  var $view = '';

  public function setView($text ='')
  {
    $this->view = $text;
  }

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->helper('email');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->model('admin_model');
    $this->load->model('data_model');
    $this->load->model('config_model');
    $this->load->model('user_model');
    $this->load->library('pagination');
    $this->load->library('ECRUD/ecrud');
    $this->load->library('esg');

  }

	public function index()
	{
		$this->load->view('admin/index');
	}

  public function login()
  {
    $failed_login = $this->session->userdata('failed_login');
    if($failed_login>=4)
    {
      $login_alert       = $this->config_model->get_config('alert');
      $login_alert_value = $login_alert['value'];
      $login_alert_value = json_decode($login_alert_value,1);
      $data['msg']       = $login_alert_value['login_max_failed'];
      $data['alert']     = 'danger';
      $this->load->view('admin/index', $data);
    }else{
      $data_post = $this->input->post();
      if(!empty($data_post))
      {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $current_password = $this->data_model->get_one('user', 'password', " WHERE username = '{$username}'");
        $allow = decrypt($password, $current_password);
        if(!empty($allow))
        {
          $data = $this->data_model->get_one_data('user', "WHERE username = '{$username}'");
          $this->session->set_userdata('logged_in', $data);
          if($_POST['remember_me'])
          {
            $year = time()+31536000;
            set_cookie('username', $username, $year);
            set_cookie('password', $password, $year);
          }else if(!$_POST['remember_me'])
          {
            if(isset($_COOKIE['username']))
            {
              $past = time() - 100;
              set_cookie('username', $username, $past);
              set_cookie('password', $password, $past);
            }
          }
          redirect('admin');
        }else{
          $login_alert       = $this->config_model->get_config('alert');
          $login_alert_value = $login_alert['value'];
          $login_alert_value = json_decode($login_alert_value,1);

          $data['msg'] = $login_alert_value['login_failed'];
          $data['alert'] = 'danger';
          if($failed_login)
          {
            if($failed_login <=3)
            {
              $failed_login++;
              $this->session->set_userdata(array('failed_login'=>$failed_login));
            }else{
              $data['msg']   = $login_alert_value['login_max_failed'];
              $data['alert'] = 'danger';
            }
          }else{
            $this->session->set_userdata(array('failed_login'=>1));
          }
          $this->load->view('admin/index', $data);
        }
      }else{
        if(isset($_COOKIE['username']))
        {
          $username = $_COOKIE['username'];
          $password = $_COOKIE['password'];
          $current_password = $this->data_model->get_one('user', 'password', " WHERE username = '{$username}'");
          $allow = decrypt($password, $current_password);
          if(!empty($allow))
          {
            $data = $this->data_model->get_one_data('user', "WHERE username = '{$username}'");
            $this->session->set_userdata('logged_in', $data);
            $this->load->view('admin/index', $data);
          }
        }
        $this->load->view('admin/index');
      }
    }
  }

	public function logout()
  {
    $this->session->sess_destroy();
    delete_cookie('username');
    delete_cookie('password');
    redirect(base_url('admin'));
  }


  private function do_upload($module = '', $task = '', $name = '', $title = '')
  {
    if(!empty($module) && !empty($task))
    {
      $view                    = 'admin/index';
      $dir                     = FCPATH.'images/modules/'.$module.'/'.$task.'/';
      $config['upload_path']   = $dir;
      $config['allowed_types'] = 'gif|jpg|png';
      $config['overwrite']     = true;
      $config['max_size']      = 10000;
      if(!empty($title))
      {
        $config['file_name'] = $title;
      }
      // $config['max_width']     = 1024;
      // $config['max_height']    = 768;

      if(!is_dir($dir))
      {
        mkdir($dir, 0777,1);
      }

      $this->load->library('upload', $config);
      if(!$this->upload->do_upload($name))
      {
        $data = array('error' => $this->upload->display_errors());

      }else{
        $data = array('upload_data' => $this->upload->data());

      }
      return $data;
    }
  }

  /*USER*/
  public function user_list()
  {
    $this->load->view('admin/index');
	}

  public function user_edit($id = 0)
  {
    $data['id'] = $id;
    $this->load->view('admin/index', $data);
  }
  /*USER*/

  /*CONTENT*/
  public function content_category($id = 0)
  {
    $data['id'] = $id;
    $this->load->view('admin/index',$data);
  }

  public function content_category_edit($id = 0)
  {
    $this->load->view('admin/index');
  }

  public function content_cat_list($id = 0)
  {
    $this->load->view('admin/index');
  }

  public function content_list()
  {
    $this->load->view('admin/index');
  }

  public function content_edit($id = 0)
  {
    $data['id'] = $id;
    $this->load->view('admin/index', $data);
  }
  public function content_add_menu($id = 0)
  {
    $data['id'] = $id;
    $this->load->view('admin/index', $data);
  }
  public function content_cat_add_menu($id = 0)
  {
    $data['id'] = $id;
    $this->load->view('admin/index', $data);
  }

  /*Product*/
  public function product_category($id = 0)
  {
    $data['id'] = $id;
    $this->load->view('admin/index',$data);
  }

  public function product_category_edit($id = 0)
  {
    $this->load->view('admin/index');
  }

  public function product_cat_list($id = 0)
  {
    $this->load->view('admin/index');
  }

  public function product_list()
  {
    $this->load->view('admin/index');
  }

  public function product_edit($id = 0)
  {
    $data['id'] = $id;
    $this->load->view('admin/index', $data);
  }
  public function product_add_menu($id = 0)
  {
    $data['id'] = $id;
    $this->load->view('admin/index', $data);
  }
  public function product_cat_add_menu($id = 0)
  {
    $data['id'] = $id;
    $this->load->view('admin/index', $data);
  }

  function config($name = '')
  {
    $data['config'] = $this->config_model->get_config($name);
    $this->load->view('admin/index',$data);
  }

  public function config_alert($name = '')
  {
    $this->load->view('admin/index');
  }

  public function config_header($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_header_bottom($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_logo($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_site($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_menu($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_contact($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_js_extra($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_gallery($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_templates($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_template_config($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_widget($name = '')
  {
    $this->load->view('admin/index');
  }
  public function config_update($name = '')
  {
    $this->load->view('admin/index');
  }
  public function menu_edit($id = 0)
  {
    $this->load->view('admin/index');
  }
  public function menu_list()
  {
    $this->load->view('admin/index');
  }
  public function menu_position()
  {
    $this->load->view('admin/index');
  }
  public function menu_position_menu()
  {
    $this->load->view('admin/index');
  }
  public function menu_id()
  {
    $this->load->view('admin/menu/id');
  }
  public function menu_child()
  {
    $this->load->view('admin/index');
  }
  public function ppdb_list()
  {
    $this->load->view('admin/index');
  }
  public function ppdb_edit()
  {
    $this->load->view('admin/index');
  }
  public function ppdb_excel()
  {
    $this->load->view('admin/ppdb/excel');
  }
  public function media_gallery()
  {
    $this->load->view('admin/index');
  }
  public function media_pick_gallery()
  {
    $this->load->view('admin/media/pick_gallery');
  }
  public function config_developing()
  {
    $this->load->view('admin/config/developing');
  }
  public function search()
  {
    $this->load->view('admin/index');
  }
  public function search_list()
  {
    $this->load->view('admin/index');
  }

  public function visitor_list()
  {
    $this->load->view('admin/index');
  }
  public function visitor_ip()
  {
    $this->load->view('admin/index');
  }
  public function config_web_type()
  {
    $this->load->view('admin/index');
  }
  public function content_config()
  {
    $this->load->view('admin/index');
  }
}

