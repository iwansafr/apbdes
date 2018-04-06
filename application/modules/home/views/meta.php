<?php
$site_value      = $this->esg->get_config('site');
$template_config = $this->esg->get_config($active_template.'_config');
if(!empty($template_config))
{
	$site_value['title']       = !empty($template_config['site_title']) ? $template_config['site_title'] : $site_value['title'];
	$site_value['link']        = !empty($template_config['site_link']) ? $template_config['site_link'] : $site_value['link'];
	$site_value['image']       = !empty($template_config['site_image']) ? $template_config['site_image'] : $site_value['image'];
	$site_value['keyword']     = !empty($template_config['site_keyword']) ? $template_config['site_keyword'] : $site_value['keyword'];
	$site_value['description'] = !empty($template_config['site_description']) ? $template_config['site_description'] : $site_value['description'];
}
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo @$site_value['title'] ?></title>
<meta name="description" content="<?php echo $site_value['description'] ?>">
<meta name="keywords" content="<?php echo $site_value['keyword'] ?>">
<meta name="developer" content="esoftgreat.com">
<meta name="author" content="esoftgreat">
<meta name="ROBOTS" content="all, index, follow">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo image_module('config', 'site/'.@$site_value['image']) ?>">
<link href="<?php echo base_url().'templates/admin/'; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url().'templates/admin/'; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url().'templates/'.$active_template.'/'; ?>css/style.css" rel="stylesheet">
<!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css"> -->
<script src="<?php echo base_url().'templates/admin/'; ?>js/plugins/ckeditor/ckeditor.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<?php
if(!empty($site_value))
{
	$data['site_value'] = $site_value;
	$this->load->view('home/'.$active_template.'/meta', $data);
}