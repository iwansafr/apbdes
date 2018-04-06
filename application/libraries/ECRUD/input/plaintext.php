<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($field))
{
	if($this->init == 'edit' || $this->init == 'param')
	{
		if(!empty($this->id))
		{
			$data_value =  $data[$field];
			echo form_label(ucfirst($label), $label);
		}else{
			echo form_label(ucfirst($label), $label);
			$data_value = $this->value[$field];
		}
		echo '<br>';
	}else{
		$data_value = $dvalue[$ikey];
	}
	echo form_label($data_value, $data_value);
	echo '<br>';
}