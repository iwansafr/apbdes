<?php
$q = @$_GET['q'];
?>
<hr>
<form style="max-width: 350px;margin: auto;">
	<input type="text" name="q" class="form-control" placeholder="cari apa aja" style="height: 50px;font-size: 24px;">
</form>

<?php
if(!empty($q))
{
	$data = curl('http://www.google.co.id/search?q='.$q);
	echo $data;
}


ob_start();
?>
<script type="text/javascript">
	$('#sbhost').closest('form').closest('tbody').remove();
	$('#leftnav').remove();
	$('#rhs_block').remove();
	$('#bfl').remove();
	$('#fll').remove();
</script>
<?php
$js_extra = ob_get_contents();
ob_clean();

$this->session->set_userdata('js_extra', $js_extra);
