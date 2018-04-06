<?php

?>
<link href="<?php echo base_url().'templates/admin/'; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url().'templates/admin/'; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url().'templates/admin/'; ?>css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style type="text/css">
	.folder-image{
		font-size: 40px;
	}
	.folder-title{
		font-size: 24px;
	}
	.img_select{
		object-fit: cover;
		width: 200px;
		height: 140px;
		border: solid blue 1px;
		margin: 1px;
		margin-bottom: 1px;
		margin-top: 1px;
	}
	.selected{
		border: solid blue 5px;
	}
</style>
<?php
$get_dir = @$_GET['dir'];
if(is_admin())
{
	$directory = array();
	foreach(glob(FCPATH.'images/modules/content') as $dir)
	{
		$directory = explode('/', $dir);
		$directory = end($directory);
		if(empty($get_dir))
		{
			?>
			<a href="<?php echo base_url('admin/media_gallery/gallery/?dir='.$directory) ?>" class="folder-image">
				<i class="fa fa-folder" style=""></i>
				<?php echo $directory;?>
			</a><br>
			<?php
		}
	}
	if(!empty($get_dir))
	{
		$images = array();
		$i = 0;
		foreach (glob(FCPATH.'images/modules/'.$get_dir.'/'.'*'.'/*') as $file)
		{
			$file = explode('/', $file);
			$file = end($file);
			if(!is_numeric($file))
			{
				$images[$i]['image'] = $file;
			}
			$i++;
		}
		$i = 0;
		foreach (glob(FCPATH.'images/modules/'.$get_dir.'/'.'*') as $file)
		{
			$file = explode('/', $file);
			$file = end($file);
			if(is_numeric($file))
			{
				$images[$i]['id'] = $file;
			}
			$i++;
		}
		foreach ($images as $key => $value)
		{
			$image = $value['id'].'/'.$value['image'];
			?>
				<a href="#" class="select" >
					<img src="<?php echo image_module($get_dir, $image) ?>" class="img_select" style="" >
				</a>
			<?php
		}
		echo '<hr>';
		echo '<button class="btn btn-default hidden" id="select_image">Select</button>';
	}
}else{
	msg('you dont have permission to access this section', 'danger');
}


?>
<script src="<?php echo base_url().'templates/admin/'; ?>js/jquery.js"></script>
<script src="<?php echo base_url().'templates/admin/'; ?>js/bootstrap.min.js"></script>
<script type="text/javascript">
	$('.img_select').on('click', function(){
		$(this).closest('a').siblings('a').find('.img_select').removeClass('selected');
		$(this).toggleClass('selected');
		if($(this).hasClass('selected')){
			$('#select_image').removeClass('hidden');
		}else{
			$('#select_image').addClass('hidden');
		}
	});
</script>