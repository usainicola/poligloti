<?php
if (!defined('ABSPATH')) exit;
function get_item_language($item_id=0) {
  if (!$item_id) return;
  if (term_exists($item_id)) return get_term_meta($item_id,'language',true);
  return get_post_meta($item_id,'language',true);
}
