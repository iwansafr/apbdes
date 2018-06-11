<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(is_admin())
{
	$this->db->select('id,child_id');
	$desa = $this->db->get_where('desa')->result_array();
	$desa = assoc($desa,'id','child_id');
	$id = @intval($_GET['id']);
	$this->db->select('id,username');
	$child_tmp = $this->db->get_where('user', 'active = 1 AND role = 4')->result_array();
	$child = array();
	foreach ($child_tmp as $key => $value)
	{
		if(!in_array($value['id'], $desa))
		{
			$child[$value['id']] = $value['username'];
		}
	}
	if(!empty($child))
	{
		$this->ecrud->init('edit');
		$this->ecrud->setTable('desa');
		$this->ecrud->setId($id);
		$this->ecrud->addInput('parent_id','dropdown');
		$this->ecrud->setLabel('parent_id','Kecamatan');
		$this->ecrud->setHeading('Pemetaan Desa');
		$this->db->select('id,username');
		$data = $this->db->get_where('user', 'active = 1 AND role = 3')->result_array();
		$data = assoc($data, 'id','username');
		$this->ecrud->setOptions('parent_id', $data);
		$this->ecrud->addInput('child_id','dropdown');
		$this->ecrud->setLabel('child_id','Desa');
		$this->ecrud->setOptions('child_id', $child);
		$this->ecrud->addInput('expired','text');
		$this->ecrud->setType('expired','date');
		$this->ecrud->form();
	}else{
		echo msg('tidak ada desa yang perlu di daftarkan', 'danger');
	}
}else{
	echo msg('you dont have permission to access this site','danger');
}