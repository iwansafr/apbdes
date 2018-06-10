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

		$data = $this->esg->get_config('config_user_'.user('id'));

		if(!empty($data))
		{
			if(!empty($data['tahun']))
			{
				$tahun = $data['tahun'];
			}
		}
		return $tahun;
	}

	public function del_anggaran($id = 0)
	{
		if(!empty($id))
		{
			$data = $this->db->get_where('apbdes','id = '.$id)->row_array();
			if(!empty($data))
			{
				$parent   = $this->db->get_where('apbdes','id = '.$data['par_id'])->row_array();
				if(!empty($parent))
				{
					if(!empty($data['par_id']))
					{
						$anggaran = $parent['anggaran']-@intval($_SESSION['delete_anggaran']);
						$this->data_model->set_data('apbdes',$data['par_id'],array('anggaran'=>$anggaran));
						call_user_func(array('apbdes_model',__FUNCTION__), $data['par_id']);
					}
				}
			}
		}
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

	public function get_apbdes_ids($id = 0)
  {
    $apbdes = array();
    if(!empty($id))
    {
    	$this->db->select('id,par_id');
      $apbdes = $this->db->get_where('apbdes', 'par_id = '.$id)->result_array();
      if(!empty($apbdes))
      {
        $i= 0;
        foreach ($apbdes as $key => $value)
        {
          $apbdes[$i]['child'] = call_user_func(array('apbdes_model',__FUNCTION__),$value['id']);
          $i++;
        }
      }
    }
    return $apbdes;
  }

  public function delete($data = array())
  {
  	if(!empty($data) && is_array($data))
  	{
  		foreach ($data as $key => $value)
  		{
  			$this->data_model->del_data('apbdes',array($value['id']));
  			if(!empty($value['child']))
  			{
  				call_user_func(array('apbdes_model',__FUNCTION__),$value['child']);
  			}
  		}
  	}
  }

  public function set_bidang($data = array() , $bidang_id = 0)
  {
  	if(!empty($bidang_id) && !empty($data) && is_array($data))
  	{
  		$post['bidang_id'] = $bidang_id;
  		foreach ($data as $key => $value)
  		{
  			$this->data_model->set_data('apbdes',$value['id'],$post);
  			if(!empty($value['child']))
  			{
  				call_user_func(array('apbdes_model',__FUNCTION__),$value['child'], $bidang_id);
  			}
  		}
  	}
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

	public function get_desa()
	{
		$data = array();
		if(!empty(user()))
		{
			$user_id = user('id');
			$sql = "SELECT u.id,u.username FROM user AS u LEFT JOIN desa AS d ON(d.child_id=u.id) WHERE d.parent_id = {$user_id}";
			$desa = $this->db->query($sql)->result_array();
			$data = $desa;
		}
		return $data;
	}
}