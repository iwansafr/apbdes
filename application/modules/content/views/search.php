<?php
$keyword      = @$_GET['keyword'];
if(!empty($keyword))
{
	$page         = @intval($_GET['page']);
	$limit        = 6;
	$url_get      = base_url('content/search?keyword='.$keyword);
	$header_title = 'search for '.$keyword;

	$this->data_model->orderBy('id', 'desc');
	$this->data_model->setView('search');
	$this->data_model->setWhere('publish = 1');

	$data        = $this->data_model->get_data_list('content', array('id','title','description','created'), 0, $limit);
	$page_nation = $data['pagination'];
	$data        = $data['data'];

	include 'list.html.php';
}else{
	echo msg('ups, it seems you are search nothing','warning');
}
