<?php
$template_names = array();

_func('content');
if(is_admin())
{
	$template_names = array();
	$template_admin = array();
	foreach(glob(FCPATH.'application/modules/home/views/*/index.esg') as $file)
	{
		$template_dir = explode('/', $file);
		array_pop($template_dir);
		$template_name = end($template_dir);
		$template_names[$template_name] = $template_name;
	}
	foreach(glob(FCPATH.'application/modules/admin/views/templates/*/index.esg') as $file)
	{
		$template_dir = explode('/', $file);
		array_pop($template_dir);
		$template_admin = end($template_dir);
		$template_admin_names[$template_admin] = $template_admin;
	}

	$form = new Ecrud();
	$form->init('param');
	$form->setView('admin/config_templates/templates');
	$form->setTable('config');
	$form->setId(1);
	$form->setHeading('templates');
	// $form->setParam($config);
	$form->setParamName('templates');
	$form->addInput('templates', 'dropdown');
	$form->setOptions('templates', $template_names);
	$form->addInput('admin_templates', 'dropdown');
	$form->setLabel('admin_templates', 'Admin Templates');
	$form->setOptions('admin_templates', $template_admin_names);
	$form->form();

	if(!empty($_POST))
	{
		header('Location: '.base_url('admin/config_widget/widget'));
	}
	?>
	<a href="<?php echo base_url().'admin/config_widget/widget' ?>" class="btn btn-danger">Manage Widget</a>
	<?php
}else{
	msg('you dont have permission to access this section', 'danger');
}