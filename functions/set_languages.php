<?php
if (!defined('ABSPATH')) exit;
add_action('admin_init','set_languages');
function set_languages() {
  $languages = array();
  $languages['IT'] = 'Italiano';
  $languages['EN'] = 'English';
  $languages['FR'] = 'François';
  $languages['DE'] = 'Deutsch';
  $languages['ES'] = 'Español';
  update_option('languages',$languages);
}