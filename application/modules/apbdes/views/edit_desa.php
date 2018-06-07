<?php
if(is_admin())
{
	$id = @intval($_GET['id']);

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
	$this->db->select('id,username');
	$data = $this->db->get_where('user', 'active = 1 AND role = 4')->result_array();
	$data = assoc($data, 'id','username');
	$this->ecrud->setOptions('child_id', $data);
	$this->ecrud->addInput('expired','text');
	$this->ecrud->setType('expired','date');
	$this->ecrud->form();
}else{
	echo msg('you dont have permission to access this site','danger');
}