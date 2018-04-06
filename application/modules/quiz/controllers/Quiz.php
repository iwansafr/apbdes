<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->library('session');
    $this->load->model('admin/data_model');
    $this->load->model('admin/config_model');
    // $this->load->model('content/content');
    $this->load->library('pagination');
    $this->load->library('ECRUD/ecrud');

  }

  public function index()
  {
    $this->load->view('home/index');
  }

  public function edit()
  {
    $this->load->view('home/index');
  }
}