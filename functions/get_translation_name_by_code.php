<?php
if (!defined('ABSPATH')) exit;
function get_translation_name_by_code($code='') {
  $code = (string) $code;
  $name = '';
  $languages = (array) get_languages();
  if (isset($languages[$code])) $name = (string) $languages[$code];
  return (string) $name;
}