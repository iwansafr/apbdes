<div class="col-md-12">
	<?php $id = @intval($_GET['id']);?>
	<form action="<?php echo base_url('admin/menu_edit') ?>" method="get" class="pull-right">
		<button class="btn btn-success" name="position_id" value="<?php echo $id ?>"> Add Menu</button>
	</form>
	<?php
	if(!empty($id))
	{
		$title = $this->data_model->get_one('menu_position', 'title', ' WHERE id ='.$id);
		$form = new ecrud();
		$form->setView('admin/menu_position_menu?id='.$id);
		$form->setTable('menu', 'sort_order', 'ASC');

		// $form->setUrl(base_url('admin/menu_position'));

		$form->setWhere("position_id = {$id} AND par_id = 0");

		$form->init('roll');

		$form->setHeading('Content List of '.$title.' Category');

		$form->setField(array('id','title'));

		// $form->addInput('id','plaintext');
		$form->addInput('title','link');
		$form->setLink('title',base_url('admin/menu_edit'), 'id');
		// $form->addInput('image','thumbnail');
		// $form->setImage('image','content');

		// $form->addInput('created','plaintext');

		$form->addInput('sort_order','text');

		$form->addInput('id','link');
		$form->setLink('id',base_url('admin/menu_child'),'id');
		$form->setPlaintext('id','child');
		$form->setLabel('id','child');

		$form->addInput('publish','checkbox');

		$form->setDelete(true);

		$form->form();
	}
	?>
</div>