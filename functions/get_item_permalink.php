<?php
if (!defined('ABSPATH')) exit;
function get_item_permalink($item_id=0) {
  if (!$item_id) return;
  if (term_exists($item_id)) return get_term_link($item_id);
  return get_the_permalink($item_id);
}
