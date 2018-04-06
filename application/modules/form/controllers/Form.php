<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/config_model');
		$this->load->model('admin/data_model');
		$this->load->model('content/content_model');
		$this->load->helper('html');
		$this->load->library('esg');

	}
	public function index()
	{
		$this->load->view('home/index');
	}
}