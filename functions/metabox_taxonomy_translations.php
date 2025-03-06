<?php
if (!defined('ABSPATH')) exit;

foreach (get_taxonomies() as $key => $value) {
  add_action($key.'_edit_form_fields','metabox_taxonomy_translations');
  add_action('edited_'.$key,'metabox_taxonomy_translations_save');
}

function metabox_taxonomy_translations($term) {
  wp_nonce_field( 'metabox_taxonomy_translations_nonce_name', 'metabox_taxonomy_translations_nonce' );
  $term_id = (int) $term->term_id;
  $translations = (array) get_term_meta($term_id,'translations',true);
  $languages = (array) get_languages();

  $item_type = get_item_type($term_id);

  $terms = (array) get_terms(array(
    'taxonomy' => $item_type,
    'hide_empty' => false,
  ));

  echo '<table class="form-table">';
    echo '<thead><h3>Translations</h3></thead>';
    echo '<tbody>';
    foreach ($languages as $code => $name) {
      $translation = isset($translations[$code]) ? (int) $translations[$code] : 0;
      echo '<tr>';
        echo '<th>'.$name.'</th>';
        echo '<td>';
        echo '<select class="supaselect" name="translations['.$code.']" autocomplete="off" style="display:block;width:100%;">';
        echo '<option value="0">Select translation</option>';
        foreach ($terms as $term) {
          $selected = $term->term_id===$translation ? 'selected' : '';
          echo '<option value="'.$term->term_id.'" '.$selected.'>'.$term->name.' - ID'.$term->term_id.'</option>';
        }
        echo '</select>';
        echo '</td>';
        echo '<th>';
        if ($translation===$term_id) echo '<a href="javascript:void(0)" class="button" disabled>CURRENT</a>';
        elseif ($translation) echo '<a href="'.get_item_edit_link($translation).'" class="button">EDIT</a>';
        echo '</th>';
      echo '</tr>';
    }
    echo '</tbody>';
  echo '</table>';
}



function metabox_taxonomy_translations_save($term_id) {
  if (!isset($_POST['metabox_taxonomy_translations_nonce'])) return;
  if (!wp_verify_nonce($_POST['metabox_taxonomy_translations_nonce'],'metabox_taxonomy_translations_nonce_name')) return;
  if (!isset($_POST['translations'])) return;
  $translations = (array) $_POST['translations'];
  $translations = array_map('intval',$translations);
  $language = '';
  foreach ($translations as $key => $value) if ($value===$term_id) $language = (string) $key;
  update_term_meta($term_id,'translations',$translations);
  update_term_meta($term_id,'language',$language);
}