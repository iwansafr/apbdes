<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Apbdes_model extends CI_Model
{
	public function __construct()
	{
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

	public function set_anggaran($id = 0)
	{
		if(!empty($id))
		{
			$data = $this->db->get_where('apbdes','id = '.$id)->row_array();
			if(!empty($data))
			{
				$parent   = $this->db->get_where('apbdes','id = '.$data['par_id'])->row_array();
				if(!empty($parent))
				{
					$anggaran = $parent['anggaran']+@intval($_SESSION['div_anggaran']);
					if(!empty($data['par_id']))
					{
						$this->data_model->set_data('apbdes',$data['par_id'],array('anggaran'=>$anggaran));
						call_user_func(array('apbdes_model',__FUNCTION__), $data['par_id']);
					}
				}
			}
		}
		unset($_SESSION['div_anggaran']);
		unset($_SESSION['tmp_anggaran']);
	}
}