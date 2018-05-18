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

	public function set_keterangan($id = 0)
	{
		if(!empty($id))
		{
			$data = $this->db->get_where('apbdes','id = '.$id)->row_array();
			if(!empty($data))
			{
				$parent     = $this->db->get_where('apbdes','id = '.$data['par_id'])->row_array();
				$keterangan = '';
				if(!empty($parent))
				{
					$tmp_keterangan = $parent['apbdes_ids'];
					$keterangan     = @$_SESSION['add_keterangan'];
					if(!empty($tmp_keterangan))
					{
						$data_keterangan = array();
						$data_keterangan = explode(',', $keterangan);
						$data_keterangan = array_filter($data_keterangan);

						$data_tmp_keterangan = array();
						$data_tmp_keterangan = explode(',',$tmp_keterangan);
						$data_tmp_keterangan = array_filter($data_tmp_keterangan);

						$data_tmp_keterangan = array_merge($data_tmp_keterangan,$data_keterangan);
						$data_tmp_keterangan = array_unique($data_tmp_keterangan);
						$keterangan          = ','.implode($data_tmp_keterangan,',').',';
					}
					if(!empty($data['par_id']))
					{
						$this->data_model->set_data('apbdes',$data['par_id'], array('apbdes_ids'=>$keterangan));
						call_user_func(array('apbdes_model',__FUNCTION__), $data['par_id']);
					}
				}
			}
			unset($_SESSION['add_keterangan']);
		}
	}
}