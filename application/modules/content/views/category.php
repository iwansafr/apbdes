<?php
$type = @($_GET['type']);
$slug = $this->uri->segment(1);
if($slug != 'content')
{
	$slug       = $this->uri->segment(2);
	$cat_id     = $this->data_model->get_one('content_cat', 'id', "WHERE slug = '{$slug}'");
	$cat_title  = $this->data_model->get_one('content_cat', 'title', "WHERE slug = '{$slug}'");
	$title      = @$slug;
	$page       = @intval($_GET['page']);
	$limit      = 6;
	$data       = $this->db->get_where('content', "cat_ids LIKE  '%,{$cat_id},%' AND publish = 1",$limit)->result_array();
	$total_rows = $this->db->get_where('content',"cat_ids LIKE  '%,{$cat_id},%' AND publish = 1")->num_rows();
}else{
	$id           = @intval($this->uri->segment(3));
	$title        = @($this->uri->segment(4));
	$page         = @intval($_GET['page']);
	$limit        = 6;
}
if(!empty($id))
{
	$url_get = base_url('content/category/'.$id.'/'.$title.'.html');
	$header_title = 'Category of '.$title;
	$table = 'content';
}else if(!empty($cat_title)){
	$url_get = base_url('category/'.$slug.'.html?type=grid');
	$header_title = 'Category of '.$cat_title;
	$table = 'content';
}
else{
	$url_get = base_url('content/category/');
	$header_title = 'All Category';
	$table = 'content_cat';
}

if(!empty($id))
{
	$this->db->like('cat_ids', $id, 'both');
}
if(empty($data) && empty($cat_title))
{
	$data = $this->db->get_where($table,'publish = 1',$limit,$page)->result_array();
}

if(!empty($id))
{
	$this->db->like('cat_ids', $id, 'both');
}
if(empty($total_rows) && empty($cat_title))
{
	$total_rows = $this->db->get_where($table,'publish = 1')->num_rows();
}

$config = pagination($total_rows,$limit,$url_get);
$this->pagination->initialize($config);
$page_nation = $this->pagination->create_links();

$view_data                    = array();
$view_data['header_title']    = $header_title;
$view_data['data']            = $data;
$view_data['page_nation']     = $page_nation;
$view_data['config_template'] = $config_template;

if($type=='grid')
{
	$header_title = $cat_title;
	include 'grid.html.php';
}else{
	if(file_exists(APPPATH.'modules/home/views/'.$active_template.'/'.'content/list.html.php'))
	{
		$this->load->view('home/'.$active_template.'/'.'content/list.html.php', $view_data);
	}else{
		include 'list.html.php';
	}
}