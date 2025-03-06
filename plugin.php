<?php
/*
* Plugin Name: Poligloti
* Author: Nicola Usai
*/
if (!defined('ABSPATH')) exit;
require(plugin_dir_path(__FILE__).'functions/select2.php');
require(plugin_dir_path(__FILE__).'functions/set_languages.php');
require(plugin_dir_path(__FILE__).'functions/get_languages.php');
require(plugin_dir_path(__FILE__).'functions/create_menus.php');
require(plugin_dir_path(__FILE__).'functions/get_item_type.php');
require(plugin_dir_path(__FILE__).'functions/get_item_edit_link.php');
require(plugin_dir_path(__FILE__).'functions/get_item_translations.php');
require(plugin_dir_path(__FILE__).'functions/get_item_translation.php');
require(plugin_dir_path(__FILE__).'functions/metabox_post_translations.php');
require(plugin_dir_path(__FILE__).'functions/metabox_taxonomy_translations.php');
require(plugin_dir_path(__FILE__).'functions/column_language.php');
require(plugin_dir_path(__FILE__).'functions/get_item_permalink.php');
require(plugin_dir_path(__FILE__).'functions/get_item_language.php');
require(plugin_dir_path(__FILE__).'functions/get_translation_name_by_code.php');