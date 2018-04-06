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

  public function index()
  {
		// $data = $this->get_home();
		$this->load->view('home/index');
	}
}
