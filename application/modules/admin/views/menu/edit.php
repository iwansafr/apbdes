<?php defined('BASEPATH') OR exit('No direct script access allowed');

$get_id      = $this->input->get('id');
$parent_id   = $this->input->get('parent_id');
$position_id = $this->input->get('position_id');
$data_parent = array();
if(!empty($parent_id))
{
  $data_parent   = $this->data_model->get_one_data('menu',' WHERE id = '.$parent_id);
  $position_name = $this->data_model->get_one('menu_position','title','WHERE id = '.$data_parent['position_id']);
}

if(!empty($position_id))
{
  $position_menu = $this->data_model->get_one_data('menu_position',' WHERE id = '.$position_id);
}

$form = new ecrud();
$form->init('edit');
$form->setTable('menu');

$form->setId($get_id);

$form->setHeading('Menu');

// $form->setField(array('id','par_id','title'));
$form->addInput('position_id','dropdown');
$form->setLabel('position_id', 'Menu Position');
if(empty($data_parent))
{
  $form->tableOptions('position_id', 'menu_position','id','title');
  if(!empty($position_menu))
  {
    $form->setOptions('position_id', array($position_menu['id']=>$position_menu['title']));
  }
}else{
  $form->setOptions('position_id', array($data_parent['position_id']=>$position_name));
}

$form->addInput('par_id','dropdown');
$form->setLabel('par_id', 'Parent');
if(!empty($get_id))
{
  $form->tableOptions('par_id', 'menu','id','title',' WHERE id = 0');
}else{
  $form->setOptions('par_id', array('none'));
  if(!empty($data_parent))
  {
    $form->setOptions('par_id', array($data_parent['id']=>$data_parent['title']));
  }
}

$form->addInput('sort_order', 'text');
$form->setLabel('sort_order', 'Sort Order');
$form->setType('sort_order','number');
if(!empty($get_id))
{
  $form->tableOptions('sort_order','menu', 'id', 'title');
}else{
  $form->setOptions('sort_order', array('none'));
}

$form->addInput('title','text');

$form->addInput('link','text');

$form->addInput('publish', 'checkbox');

$form->form();

if(!empty($data_parent))
{
  back_button();
}

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

$last_id = $this->data_model->LAST_INSERT_ID();

if(!empty($last_id))
{
  if(!empty($_POST))
  {
    $post = array();
    $data = $this->data_model->get_one_data('menu', 'WHERE id = '.$last_id);
    if(!empty($data))
    {
      $get_sort = $this->data_model->get_one('menu', 'sort_order', 'WHERE id = '.$data['sort_order'].' AND position_id = '.$data['position_id'].' AND par_id = '.$data['par_id']);

      pr($get_sort);
      $get_sort = $get_sort+1;
      pr($get_sort);
      $this->data_model->set_data('menu', $last_id, array('sort_order'=>$get_sort));
      $this->db->query('UPDATE menu SET sort_order = sort_order+1 WHERE sort_order >= '.$get_sort.' AND position_id = '.$data['position_id'].' AND par_id = '.$data['par_id'].' AND id != '.$last_id);
    }
  }
}