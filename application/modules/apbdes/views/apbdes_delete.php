<?php defined('BASEPATH') OR exit('No direct script access allowed');

$data = @$_POST['data'];
if(!empty($data))
{
	foreach ($data as $key => $value)
	{
		$_SESSION['delete_anggaran'] = $this->data_model->get_one('apbdes','anggaran','WHERE id = '.$value['value']);
		$this->apbdes_model->del_anggaran($value['value']);
	}
	unset($_SESSION['delete_anggaran']);
}
output_json($data);