<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Model
{

	public function content_list($id = 0, $title = '')
	{
		return base_url('content/'.@intval($id).'/').url_title(@$title).'.html';
	}

	public function content_link($id = 0, $title = '')
	{
		$output = base_url();
		if(!empty(@intval($id)))
		{
			$output = base_url('content/'.$id.'/').url_title($title).'.html';
		}
		return $output;
	}
}