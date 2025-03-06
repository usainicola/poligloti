<?php
if (!defined('ABSPATH')) exit;
add_action('admin_init','create_menus');
function create_menus() {
  $languages = get_languages();
  foreach ($languages as $key => $value) {
    $menu_exists = wp_get_nav_menu_object($key);
    if ($menu_exists) continue;
    wp_create_nav_menu($key);
  }
}