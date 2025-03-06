<?php
if (!defined('ABSPATH')) exit;
add_action('admin_enqueue_scripts','select2');
function select2() {
  wp_register_style('select2css','https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css',false,'1.0','all');
  wp_register_script('select2','https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js',array('jquery'),'1.0',true);
  wp_enqueue_style('select2css');
  wp_enqueue_script('select2');
}
add_action('admin_head','run_select2');
function run_select2() {
  echo '<script>jQuery(document).ready(function() {jQuery(".supaselect").select2();});</script>';
}