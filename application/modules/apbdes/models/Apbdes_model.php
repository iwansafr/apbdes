<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Apbdes_model extends CI_Model
{
	public function __construct()
	{
		// $this->load->database();
		$this->load->model('admin/admin_model');
		$this->load->model('admin/config_model');
		$this->load->model('admin/data_model');
		$this->load->library('esg');
	}

	public function get_tahun()
	{
		$tahun = date('Y');

		$data = $this->esg->get_config('pemdes');

		if(!empty($data))
		{
			if(!empty($data['tahun']))
			{
				$tahun = $data['tahun'];
			}
		}
		return $tahun;
	}
}