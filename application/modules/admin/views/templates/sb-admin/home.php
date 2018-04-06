<!DOCTYPE html>
<html>
	<head>
	 <?php $this->load->view('admin/header'); ?>
	 <style type="text/css">
		.modal_loading {
		    display:    none;
		    position:   fixed;
		    z-index:    1000;
		    top:        0;
		    left:       0;
		    height:     100%;
		    width:      100%;
		    background: rgba( 255, 255, 255, .8 )
		                url('<?php echo image_upload('ajax-loader.gif')?>')
		                50% 50%
		                no-repeat;
		}
		body.loading {
		    overflow: hidden;
		}
		body.loading .modal_loading {
		    display: block;
		}
	 </style>
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					<?php $this->load->view('admin/logo'); ?>
				</div>
				<ul class="nav navbar-right top-nav">
					<?php $this->load->view('admin/top_menu'); ?>
				</ul>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<?php $this->load->view('admin/sidebar_menu'); ?>
				</div>
			</nav>
			<div id="page-wrapper">
				<div class="container-fluid">
					<?php $this->load->view('admin/heading');
					if(!empty($config_alert))
					{
						echo msg($config_alert, 'danger');
					}
						$data['msg']    = @$msg;
						$data['alert']  = @$alert;
						$data['module'] = @$module;
						$data['task']   = @$task;
						$this->load->view($content, $data);
						// pr(@($this->session));
					?>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer');
		$esg = new esg();
		$esg->js();
		?>
		<div class="modal_loading"></div>
		<script type="text/javascript">
			$body = $("body");
			$(document).on({
		    ajaxStart: function() { $body.addClass("loading"); },
	     	ajaxStop: function() { $body.removeClass("loading"); }
			});
		</script>
	</body>
</html>