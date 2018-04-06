<div class="col-md-12">
	<?php $id = @intval($_GET['id']);?>
	<form action="<?php echo base_url('admin/prodcut_category_edit') ?>" method="get" class="pull-right">
		<button class="btn btn-success" name="cat_id" value="<?php echo $id ?>"> Add Category</button>
	</form>
	<?php
	if(!empty($id))
	{
		$category = $this->data_model->get_one_data('product_cat', ' WHERE id ='.$id);
		if(!empty($category['par_id']))
		{
			?>
			<a href="<?php echo base_url('admin/prodcut_cat_list').'?id='.$category['par_id'] ?>"><button class="btn btn-sm btn-default">< Back to List</button></a>
			<hr>
			<?php
		}

		$form = new ecrud();
		$form->setView('admin/prodcut_cat_list?id='.$id);
		$form->setTable('product_cat', 'id', 'DESC');

		// $form->setUrl(base_url('admin/menu_position'));

		$form->setWhere("par_id = $id");

		$form->init('roll');

		$form->setHeading('Content List of '.$category['title'].' Category');

		$form->setField(array('id','title'));

		// $form->addInput('id','plaintext');
		$form->addInput('title','link');
		$form->setLink('title',base_url('admin/prodcut_category_edit'), 'id');
		$form->addInput('image','thumbnail');
		$form->setImage('image','content');

		$form->addInput('created','plaintext');

		$form->addInput('id','link');
		$form->setLink('id',base_url('admin/prodcut_cat_list'),'id');
		$form->setPlaintext('id','child');
		$form->setLabel('id','child');

		$form->addInput('publish','checkbox');

		$form->setDelete(true);

		$form->form();
	}
	?>
</div>