<?php
if (!defined('ABSPATH')) exit;
function get_item_type($item_id=0) {
  if (!$item_id) return;
  if (term_exists($item_id)) return get_term($item_id)->taxonomy;
  return get_post_type($item_id);
}