<?php
$get_id = $this->input->get('id');

if(!empty($get_id))
{
	$data = $this->data_model->get_one_data('apbdes','WHERE id = '.$get_id);
	if(!empty($data['name']))
	{
		$params = new ecrud();
		$params->init('param');
		$params->setHeading('RULES');
		$params->setTable('apbdes');
		$params->setParamName($data['name']);
		$params->addInput('kondisi','dropdown');
		$params->setOptions('kondisi', array('>'=>'>','<'=>'<','='=>'=','!='=>'!='));
		$params->addInput('percent','text');
		$params->setType('percent','number');
		$tahun = $this->apbdes_model->get_tahun();
		$this->db->select('id,uraian');
		$apbdes_list = $this->db->get_where('apbdes',"created LIKE '$tahun%'")->result_array();
		$apbdes_data = array();
		if(!empty($apbdes_list))
		{
			foreach ($apbdes_list as $key => $value)
			{
				$apbdes_data[$value['id']] = $value['uraian'];
			}
		}
		if(!empty($apbdes_data))
		{
			$params->addInput('uraian','dropdown');
			$params->setOptions('uraian',$apbdes_data);
		}
		$params->form();
	}
	echo back_form('btn btn-default');
}