<?php
 // defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($admin_templates))
{
	$data = array();
	$menu = array(
	  array(
	    'title' => 'Dashboard',
	    'icon' => 'fa-dashboard',
	    'link' => base_url('admin')
	  ),
	  array(
	    'title' => 'User',
	    'icon' => 'fa-user',
	    'link' => base_url('admin/user_list'),
	    'list' => array(
	      array(
	        'title' => 'User List',
	        'icon' => 'fa-user',
	        'link' => base_url('admin/user_list')
	      ),
	      array(
	        'title' => 'User Add',
	        'icon' => 'fa-user',
	        'link' => base_url('admin/user_edit')
	      ),
	    )
	  ),
	  array(
	    'title' => 'Content',
	    'icon' => 'fa-file-text',
	    'link' => base_url('admin/content_list'),
	    'list' => array(
	    	array(
	        'title' => 'Category',
	        'icon' => 'fa-list',
	        'link' => base_url('admin/content_category')
	      ),
	      array(
	        'title' => 'Add Content',
	        'icon' => 'fa-pencil',
	        'link' => base_url('admin/content_edit')
	      ),
	      array(
	        'title' => 'Content List',
	        'icon' => 'fa-list',
	        'link' => base_url('admin/content_list')
	      ),
	      array(
	        'title' => 'Content Config',
	        'icon' => 'fa-cog',
	        'link' => base_url('admin/content_config')
	      ),
	    )
	  ),
	  array(
	    'title' => 'Menu',
	    'icon' => 'fa-list',
	    'link' => base_url('admin/menu_list'),
	    'list' => array(
	    	array(
	        'title' => 'Add Menu',
	        'icon' => 'fa-pencil',
	        'link' => base_url('admin/menu_edit')
	      ),
	      array(
	        'title' => 'Menu List',
	        'icon' => 'fa-list',
	        'link' => base_url('admin/menu_list')
	      ),
	      array(
	        'title' => 'Menu Position',
	        'icon' => 'fa-list',
	        'link' => base_url('admin/menu_position')
	      ),
	    )
	  ),
	  array(
	  	'title' => 'Visitor',
	  	'icon' => 'fa-line-chart',
	  	'link' => base_url('admin/visitor_list'),
	  	'list' => array(
	  		array(
	  			'title' => 'All Visited',
	  			'icon' => 'fa-line-chart',
	  			'link' => base_url('admin/visitor_list'),
	  		),
	  		array(
	  			'title' => 'Vistor',
	  			'icon' => 'fa-line-chart',
	  			'link' => base_url('admin/visitor_ip'),
	  		)
	  	)
	  ),
	  array(
	  	'title' => 'Media',
	  	'icon' => 'fa-picture-o',
	  	'link' => base_url('admin/media_gallery/gallery')
	  ),
	  array(
	    'title' => 'Configuration',
	    'icon' => 'fa-cog',
	    'link' => base_url('admin/config/'),
	    'list' => array(
	    	array(
	        'title' => 'Header',
	        'icon' => 'fa-cog',
	        'link' => base_url('admin/config_header/header')
	      ),
				array(
	        'title' => 'header_bottom',
	        'icon' => 'fa-cog',
	        'link' => base_url('admin/config_header_bottom/header_bottom')
	      ),
	      array(
	        'title' => 'logo',
	        'icon' => 'fa-cog',
	        'link' => base_url('admin/config_logo/logo')
	      ),
	      array(
	        'title' => 'site',
	        'icon' => 'fa-cog',
	        'link' => base_url('admin/config_site/site')
	      ),
	      array(
	      	'title' => 'Add Js',
	      	'icon' => 'fa-cog',
	      	'link' => base_url('admin/config_js_extra/js_extra')
	      ),
	      array(
	        'title' => 'templates',
	        'icon' => 'fa-cog',
	        'link' => base_url('admin/config_templates/templates')
	      ),
	      array(
	        'title' => 'template_config',
	        'icon' => 'fa-cog',
	        'link' => base_url('admin/config_template_config/template_config')
	      ),
	      array(
	        'title' => 'alert',
	        'icon' => 'fa-cog',
	        'link' => base_url('admin/config_alert/alert')
	      ),
	      array(
	        'title' => 'web type',
	        'icon' => 'fa-cog',
	        'link' => base_url('admin/config_web_type/web_type')
	      ),
	    )
	  ),
	);
	$web_type = $this->esg->get_config('web_type');
	if(!empty($web_type['type']))
	{
		$menu[] = array(
	    'title' => 'Product',
	    'icon' => 'fa-file-text',
	    'link' => base_url('admin/product_list'),
	    'list' => array(
	    	array(
	        'title' => 'Category',
	        'icon' => 'fa-list',
	        'link' => base_url('admin/product_category')
	      ),
	      array(
	        'title' => 'Add Product',
	        'icon' => 'fa-pencil',
	        'link' => base_url('admin/product_edit')
	      ),
	      array(
	        'title' => 'Product List',
	        'icon' => 'fa-list',
	        'link' => base_url('admin/product_list')
	      ),
	    )
	  );
	}
	$data['menu'] = $menu;
	$this->load->view('admin/templates/'.$admin_templates.'/sidebar_menu', $data);
}