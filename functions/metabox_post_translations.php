<?php
if (!defined('ABSPATH')) exit;
add_action('add_meta_boxes','metabox_post_translations');
function metabox_post_translations() {
  add_meta_box('metabox_post_translations','Translations','metabox_post_translations_callback',get_post_types());
}
function metabox_post_translations_callback($post) {
  wp_nonce_field( 'metabox_post_translations_nonce_name', 'metabox_post_translations_nonce' );
  $post_id = (int) $post->ID;
  if (get_post_status($post_id)==='auto-draft') return;
  $translations = (array) get_post_meta($post_id,'translations',true);
  $languages = (array) get_languages();
  $items = (array) get_posts(array(
    'post_type' => get_post_type($post),
    'post_status' => array('publish','private','draft'),
    'posts_per_page' => -1,
  ));
  ?>
  <style type="text/css">
    #metabox_post_translations table {
      width: 100%!important;
    }
    #metabox_post_translations .select2-container {
      width: 100%!important;
    }
  </style>
  <?php
  echo '<table style="text-align:left">';
    echo '<tbody>';
    foreach ($languages as $code => $name) {
      $translation = isset($translations[$code]) ? (int) $translations[$code] : 0;
      echo '<tr>';
        echo '<th>'.$name.'</th>';
        echo '<th>';
        echo '<select class="supaselect" name="translations['.$code.']" autocomplete="off">';
        echo '<option></option>';
        foreach ($items as $item) {
          $selected = $item->ID===$translation ? 'selected' : '';
          echo '<option value="'.$item->ID.'" '.$selected.'>'.$item->post_title.' - ID'.$item->ID.'</option>';
        }
        echo '</select>';
        echo '</th>';
        echo '<th>';
        if ($translation===$post_id) echo '<a href="javascript:void(0)" class="button" disabled>CURRENT</a>';
        elseif ($translation) echo '<a href="'.get_item_edit_link($translation).'" class="button">EDIT</a>';
        echo '</th>';
      echo '</tr>';
    }
    echo '</tbody>';
  echo '</table>';
}
function metabox_post_translations_save_function($post_id) {
  if (!isset($_POST['metabox_post_translations_nonce'])) return;
  if (!wp_verify_nonce($_POST['metabox_post_translations_nonce'],'metabox_post_translations_nonce_name')) return;
  if (defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE) return;
  if (!current_user_can('edit_post',$post_id)) return;
  if (is_multisite()&&ms_is_switched()) return;
  if (!isset($_POST['translations'])) return;
  $translations = (array) $_POST['translations'];
  $translations = array_map('intval',$translations);
  $language = '';
  foreach ($translations as $key => $value) if ($value===$post_id) $language = (string) $key;
  update_post_meta($post_id,'translations',$translations);
  update_post_meta($post_id,'language',$language);
}
add_action('save_post','metabox_post_translations_save_function');