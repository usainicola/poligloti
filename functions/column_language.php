<?php
if (!defined('ABSPATH')) exit;

add_action('admin_init',function(){
  foreach (get_post_types() as $post_type) {
    add_filter('manage_'.$post_type.'_posts_columns','column_language');
    add_action('manage_'.$post_type.'_posts_custom_column','column_language_data',10,2); 
    add_filter('manage_edit-'.$post_type.'_sortable_columns','column_language_sortable');
  }

  function column_language($columns) {
    $columns['language'] = 'language';
    return $columns;
  }


  function column_language_data( $column, $post_id ) {
    if ($column==='language') echo get_item_language($post_id);
  }


  function column_language_sortable($columns) {
    $columns['language'] = 'language';
    return $columns;
  }


  add_action('pre_get_posts','column_language_orderby');
  function column_language_orderby($query) {
    if(!is_admin()) return;
    $orderby = $query->get('orderby');
    if($orderby==='language') {
      $query->set('meta_key','language');
      $query->set('orderby','meta_value');
    }
  }
});