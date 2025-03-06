<?php
if (!defined('ABSPATH')) exit;
function get_item_edit_link($item_id=0) {
  if (!$item_id) return;
  if (term_exists($item_id)) return get_edit_term_link($item_id);
  return get_edit_post_link($item_id);
}
