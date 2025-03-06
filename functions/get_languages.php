<?php
if (!defined('ABSPATH')) exit;
function get_languages() {
  return (array) get_option('languages');
}