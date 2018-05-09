<div class="row">
	<div class="col-md-4">
		<?php
		$edit = new ecrud();

		$get_id = $this->input->get('id');
		$edit->init('edit');
		$edit->setTable('bidang');

		$edit->setId($get_id);

		$edit->addInput('title','text');
		$edit->form();
		?>
	</div>
	<div class="col-md-8">
		<?php
		$list = new ecrud();

		$list->init('roll');
		$list->setTable('bidang');

		$list->addInput('id','plaintext');
		$list->addInput('title','plaintext');

		$list->setEditLink(base_url('apbdes/bidang?id='));

		$list->setEdit(true);
		$list->setDelete(true);

		$list->form();

		?>
	</div>
</div>