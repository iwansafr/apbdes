<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Iwan extends CI_Model
{
  public function __construct()
  {
    $this->load->model('data_model');
  }
	public function form()
	{
		$a = $this->data_model->get_all('SELECT * FROM user');

		pr($a);
	}
}