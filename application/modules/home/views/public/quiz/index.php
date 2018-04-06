<?php
if(!empty($_POST))
{
	if($_POST['option'] == $this->session->userdata('answer'))
	{
		$this->session->set_userdata('score', @intval($this->session->userdata('score'))+1);
	}else{
		$this->session->set_userdata('score', @intval($this->session->userdata('score'))-1);
	}
}

$id = random_int(1,2);

$data = $this->data_model->get_one_data('question', ' WHERE id = '.$id);
$this->session->set_userdata('score', @intval($this->session->userdata('score')));

if(!empty($data))
{
	$this->session->set_userdata('answer', $data['answer']);
	?>
	<hr>
	<div class="panel panel-success">
		<div class="panel-heading">
			<form action="" method="post">
				Score anda <?php echo $this->session->userdata('score').' '; ?> <input type="submit" name="" class="btn btn-danger btn-xs pull-right" value="simpan ?">
			</form>
		</div>
		<div class="panel-body">
			<?php echo '<h1>'.$data['question'].'</h1>'; ?>
			<form action="" method="post">
				<button class="btn btn-info" name="option" value="1"><?php echo $data['option1'] ?></button>
				<button class="btn btn-warning" name="option" value="2"><?php echo $data['option2'] ?></button>
			</form>
		</div>
		<div class="panel-footer">
			footer
		</div>
	</div>
	<?php
}else{
	echo msg('sepertinya sistem belum menemukan pertanyaan untuk kamu, silahkan coba reload lagi', 'warning');
}