<?php
$q = 'ALTER TABLE `content` ADD `image_link` VARCHAR(255) NOT NULL AFTER `image`';

if($this->db->query($q))
{
	msg('Update Succed', 'success');
}else{
	msg('Update Failed', 'danger');
}
