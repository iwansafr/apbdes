<style type="text/css">
	.folder-image{
		font-size: 40px;
	}
	.folder-title{
		font-size: 24px;
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
		$images  = array();
		$gallery = array();
		$i       = 0;
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
			<img src="<?php echo image_module($get_dir, $image) ?>" class="" style="object-fit: cover;width: 200px;height: 140px;" data-toggle="modal" data-target="#img_<?php echo $value['id']?>">
			<div class="modal fade" id="img_<?php echo $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="img_<?php echo $value['id']?>">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="img_title_<?php echo $value['id']?>"><?php echo $value['id'];?></h4>
			      </div>
			      <div class="modal-body" style="text-align: center;">
			        <img src="<?php echo image_module($get_dir, $image); ?>" class="img-thumbnail img-responsive">
			      </div>
			      <div class="modal-footer">
			      </div>
			    </div>
			  </div>
			</div>
			<?php
		}
		echo '<hr>';
		back_button();
	}
}else{
	msg('you dont have permission to access this section', 'danger');
}