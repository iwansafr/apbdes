<?php
$site_value = $site['value'];
$site_value = json_decode($site_value,1);
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $site_value['description'] ?>">
<meta name="author" content="iwan@esoftgreat.com">
<title><?php echo $site_value['title'] ?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo image_module('config','site/'.@$site_value['image']) ?>">

<link rel="stylesheet" href="<?php echo base_url().'templates/admin_lte/';?>bootstrap/css/bootstrap.min.css">
<link href="<?php echo base_url().'templates/admin/'; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url().'templates/admin/'; ?>css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url().'templates/admin_lte/';?>dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="<?php echo base_url().'templates/admin_lte/';?>dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="<?php echo base_url().'templates/admin_lte/';?>plugins/iCheck/flat/blue.css">
<link rel="stylesheet" href="<?php echo base_url().'templates/admin_lte/';?>plugins/morris/morris.css">
<link rel="stylesheet" href="<?php echo base_url().'templates/admin_lte/';?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="<?php echo base_url().'templates/admin_lte/';?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?php echo base_url().'templates/admin_lte/';?>plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?php echo base_url().'templates/admin_lte/';?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<script src="<?php echo base_url().'templates/admin/'; ?>js/plugins/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url().'templates/admin/'; ?>css/bootstrap-tagsinput.css"></link>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->