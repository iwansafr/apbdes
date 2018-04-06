<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_admin())
{
	$form = new ecrud();

	$form->setTable('visitor');
	$form->init('roll');
	$form->setView(base_url('admin/visitor_ip'));

	// $form->setWhere("1 GROUP BY ip");

	$form->search();

	$form->setField(array('ip','visited'));


	$form->addInput('ip', 'plaintext');

	$form->addInput('visited', 'plaintext');

	$form->addInput('created', 'plaintext');

	$form->form();
	$this->db->limit(12);
	$this->db->select('count(visited),ip');
	$this->db->group_by('ip');
	$data = $this->db->get_where('visitor')->result_array();
	// pr($this->db->last_query());
	// pr($data);

}else{
	msg('you dont have permission to access this section','danger');
}
