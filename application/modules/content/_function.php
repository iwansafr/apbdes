<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('content_link'))
{
  function content_link($id = '', $title = '')
  {
    $output = base_url($id);
    if(!empty($id) && is_numeric($id))
    {
      $output = base_url('content/'.$id.'/').url_title($title).'.html';
    }else if(!empty($id) && !is_numeric($id))
    {
      $output = base_url($id).'.html';
    }
    return $output;
  }
}
if(!function_exists('content_cat_link'))
{
  function content_cat_link($id = '', $title = '')
  {
  	$output = base_url();
    if(!empty($id) && is_numeric($id))
    {
      $output = base_url('content/category/'.$id.'/').url_title($title).'.html';
    }else if(!empty($id) && !is_numeric($id)){
      $output = base_url('category/'.$id).'.html';
    }
    return $output;
  }
}

if(!function_exists('content_tag_link'))
{
  function content_tag_link($id = '', $title = '')
  {
    $output = base_url();
    if(!empty($id) && is_numeric($id))
    {
      $output = base_url('content/tag/'.$id.'/').url_title($title).'.html';
    }else if(!empty($id) && !is_numeric($id)){
      $output = base_url('tag/'.$id).'.html';
    }
    return $output;
  }
}