<?php
$page         = @intval($_GET['page']);
$limit        = 6;
$url_get      = base_url('content/');
$header_title = 'Berita Terbaru';

$this->db->order_by('id', 'desc');
$data       = $this->db->get_where('content', 'publish = 1', $limit, $page)->result_array();
$total_rows = $this->db->get_where('content', 'publish = 1')->num_rows();

$config = pagination($total_rows,$limit,$url_get);
$this->pagination->initialize($config);
$page_nation = $this->pagination->create_links();

// ‟ or ‟‟ = ‟
// pr($data);
// include 'list.html.php';
