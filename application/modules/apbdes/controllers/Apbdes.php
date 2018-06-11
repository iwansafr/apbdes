<?php defined('BASEPATH') OR exit('No direct script access allowed');
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

	public function apbdes_limit()
	{
		$user_id =  $this->input->get('id');
		$data['main_data']['msg'] = array();
		if(!empty($user_id))
		{
			$q = 'SELECT child_id FROM desa WHERE child_id = ? AND parent_id = ? LIMIT 1';
			$allow = $this->db->query($q, array($user_id,user('id')))->row_array();
			if(empty($allow))
			{
				$data['main_data']['msg'] = array('msg'=>'you dont have permission to access this site','alert'=>'danger');
			}else{
				$this->db->select('id,tahun');
				$this->db->group_by('tahun');
				$data['main_data']['tahun'] = $this->db->get_where('apbdes','user_id = '.$user_id)->result_array();
				if(!empty($data['main_data']['tahun']))
				{
					$data['main_data']['tahun'] = assoc($data['main_data']['tahun'],'id','tahun');
				}
			}
		}else{
			$data['main_data']['msg'] = array('msg'=>'you dont have permission to access this site','alert'=>'danger');
		}
		$this->load->view('home/index', $data);
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
		$this->load->view('home/index');
	}

}