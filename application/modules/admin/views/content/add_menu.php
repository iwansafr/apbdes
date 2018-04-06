<?php
$this->db->select('id,title,slug');
$data = $this->db->get_where('content', 'id = '.$id, 1)->row_array();

$form = new ecrud();

$form->init('edit');
$form->setTable('menu');

$form->setHeading('Create Menu');

// $form->setField(array('id','par_id','title'));
$form->addInput('position_id','dropdown');
$form->setLabel('position_id', 'Menu Position');
$form->tableOptions('position_id', 'menu_position','id','title');

$form->addInput('par_id','dropdown');
$form->setLabel('par_id', 'Parent');
$form->setOptions('par_id', array('none'));

$form->addInput('title','text');

$form->addInput('link','text');
$form->setValue('link', $data['slug'].'.html');
$form->setAttribute('link', array('readonly'=>'readonly'));


$form->addInput('publish', 'checkbox');

$form->form();

$ext = array();
ob_start();
?>
<script type="text/javascript">
	$('select[name="position_id"]').on('change', function(){
		var a = $(this).val();
		var b = $(this);
		$.ajax({
      type:"POST",
      url:"<?php echo base_url('admin/menu_id') ?>",
      data:{id:a},
      success:function(result){
      	$('select[name="par_id"]').html(result);
      }
    });
	});
</script>
<?php
$ext = ob_get_contents();
ob_end_clean();
$this->session->set_userdata('js_extra', $ext);