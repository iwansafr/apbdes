<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-md-4">
	<?php include 'position_edit.html.php'; ?>
</div>
<div class="col-md-8">
	<?php include 'position_list.html.php'; ?>
</div>

<div class="col-md-12">
	<?php
	$id = @intval($_GET['id']);
	if(!empty($id))
	{
		$title = $this->data_model->get_one('menu_position', 'title', ' WHERE id ='.$id);
		$form = new ecrud();
		$form->setView(base_url('admin/menu_position?id='.$id));

		$form->setTable('menu');

		// $form->setUrl(base_url('admin/menu_position'));

		$form->setWhere("position_id = {$id} ");

		$form->init('roll');

		$form->setHeading('Content List of '.$title.' Category');

		$form->setField(array('id','title'));

		$form->addInput('id','plaintext');
		$form->addInput('title','link');
		$form->setLink('title',base_url('admin/menu_edit'), 'id');
		// $form->addInput('image','thumbnail');
		// $form->setImage('image','content');

		// $form->addInput('created','plaintext');

		$form->addInput('publish','checkbox');

		$form->setDelete(true);

		$form->form();
	}
	?>
</div>