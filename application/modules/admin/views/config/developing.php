<?php
// $this->load->view('admin/config/esoftgreat');
// $data = array(
// 	'title' => 'coba',
// 	'description' => 'teting'
// );
// output_json($data);
// pr($this->data_model->get_all('SELECT * FROM user'));

// $this->load->dbutil();
// $backup = $this->dbutil->backup();

// $this->load->helper('download');
// force_download('db_backup.gz', $backup);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo image_module('config','site/'.@$site_value['image']) ?>">

	<link rel="stylesheet" href="<?php echo base_url().'templates/admin_lte/';?>bootstrap/css/bootstrap.min.css">
	<link href="<?php echo base_url().'templates/admin/'; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url().'templates/admin/'; ?>css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url().'templates/admin/'; ?>css/bootstrap-tagsinput.css"></link>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
		<label>judul</label>
		<input type="text" name="judul" class="form-control">
		<label>gambar</label>
		<input type="file" name="image" class="form-control">
		<input type="submit" name="" value="ok" class="btn btn-success">
	</form>


<script src="<?php echo base_url().'templates/admin_lte/';?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url().'templates/admin_lte/';?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url().'templates/admin/'; ?>js/bootstrap-tagsinput.js"></script>
</body>
</html>
<?php


