<?php
if (!defined('ABSPATH')) exit;
function get_item_translations($item_id=0) {
  if (!$item_id) return array();
  $item_id = (int) $item_id;
  if (term_exists($item_id)) return (array) get_term_meta($item_id,'translations',true);
  return (array) get_post_meta($item_id,'translations',true);
}