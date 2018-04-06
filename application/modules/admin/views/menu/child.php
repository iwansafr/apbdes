<?php $id = @intval($_GET['id']);?>
<div class="col-md-12">
	<form action="<?php echo base_url('admin/menu_edit') ?>" method="get" class="pull-right">
		<button class="btn btn-success" name="parent_id" value="<?php echo $id; ?>"> Add Menu</button>
	</form>
	<?php
	if(!empty($id))
	{
		$title = $this->data_model->get_one('menu', 'title', ' WHERE id ='.$id);
		$form = new ecrud();
		$form->setView('admin/menu_child?id='.$id);
		$form->setTable('menu', 'sort_order', 'ASC');

		// $form->setUrl(base_url('admin/menu_position'));

		$form->setWhere(" par_id = {$id}");

		$form->init('roll');

		$form->setHeading('Menu List of '.$title.' ');

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
	back_button();
	?>
</div>