<h1>Form Penerimaan Peserta Didik Baru</h1>
<h4><a href="<?php echo base_url('ppdb/peserta'); ?>">lihat data peserta</a></h4>
<?php
msg('isilah data dengan benar dan valid agar bisa di validasi oleh admin dan data anda akan tampil di data peserta <a href='.base_url('ppdb/peserta').'>di sini</a>','warning');

$this->load->view('admin/ppdb/edit');