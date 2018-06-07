<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('admin/config_model');
    $this->load->model('admin/data_model');
    $this->load->model('content/content_model');
    $this->load->helper('html');
    $this->load->library('ECRUD/ecrud');
    $this->load->library('esg');
  }
  function get_home()
  {
    $data['header']        = $this->config_model->get_config('header');
    $data['header_bottom'] = $this->config_model->get_config('header_bottom');
    $data['logo']          = $this->config_model->get_config('logo');
    $data['site']          = $this->config_model->get_config('site');
    $data['contact']       = $this->config_model->get_config('contact');

    return $data;
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
      $this->load->view('home/index', $data);
    }else{
      $data_post = $this->input->post();
      if(!empty($data_post))
      {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $sql              = 'SELECT password FROM user WHERE username = ? AND active = 1 LIMIT 1';
        $current_password = $this->db->query($sql, array($username))->row_array();
        $current_password = $current_password['password'];
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
          // redirect('home');
          header('Location: '.base_url());
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
          $this->load->view('home/index', $data);
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
            $this->load->view('home/index', $data);
          }
        }
        $this->load->view('home/index');
      }
    }
  }
  public function index()
  {
		// $data = $this->get_home();
		$this->load->view('home/index');
	}
}
