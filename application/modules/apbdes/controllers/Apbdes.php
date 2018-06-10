<?php
Class Apbdes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/data_model');
		$this->load->model('admin/config_model');
		$this->load->model('apbdes_model');
		$this->load->library('ECRUD/ecrud');
		$this->load->library('esg');
	}

	public function index()
	{
		$this->load->view('home/index');
	}

	public function desa_list()
	{
		$this->load->view('home/index');
	}

	public function apbdes_list()
	{
		$this->load->view('home/index');
	}

	public function bidang()
	{
		$this->load->view('home/index');
	}

	public function apbdes_delete()
	{
		$this->load->view('apbdes/apbdes_delete');
	}

	public function edit_desa()
	{
		$this->load->view('home/index');
	}

	public function param()
	{
		$this->load->view('home/index');
	}

	public function report()
	{
		$this->load->view('home/index');
	}

	public function excel()
	{
		$this->load->view('apbdes/excel');
	}

	public function config()
	{
		$this->load->view('home/index');
	}

	public function village()
	{
		$data['main_data']['tahun'] = $this->apbdes_model->get_tahun();
		$data['main_data']['desa'] = $this->apbdes_model->get_desa();
		$this->load->view('home/index', $data);
	}

}