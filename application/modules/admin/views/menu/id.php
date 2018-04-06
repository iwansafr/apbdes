<?php
$id     = @intval($_POST['id']);

$this->db->select('id,title');
if(!empty($id))
{
	$parent = $this->db->get_where('menu','position_id = '.$id)->result_array();
}

ob_start();
if(!empty($parent))
{
	echo '<option value="0">None</option>';
	foreach($parent as $key => $value)
	{
		echo '<option value="'.$value['id'].'">'.$value['title'].'</option>';
	}
}else{
		echo '<option value="0">None</option>';
}
$dropdown = ob_get_contents();
ob_end_clean();

if(!empty($dropdown))
{
	echo $dropdown;
}
