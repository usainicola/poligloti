<?php
if (!defined('ABSPATH')) exit;
function get_item_translation($item_id=0,$lang='') {
  if (!$item_id) $item_id = (int) get_queried_object_id();
  if (!$lang) return;
  $translations = (array) get_item_translations($item_id);
  if (isset($translations[$lang])) return (int) $translations[$lang];
}