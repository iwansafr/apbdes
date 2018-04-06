<?php
$extra = !empty($logo_value['width']) || !empty($logo_value['height']) ? ' width="'.$logo_value['width'].'" height="'.$logo_value['height'].'"' : '';
?>
<img src="<?php echo image_module('config', 'logo/'.@$logo_value['image']) ?>" <?php echo $extra; ?>>