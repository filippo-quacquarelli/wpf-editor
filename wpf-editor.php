<?php

/*
Plugin Name: Wp Frontend Editor
Version: 1.0.0
Description: Modify Post in front-end
Author: Filippo Quacquarelli
Author URI: http://filippoquacquarelli.it/
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;


define( "WPF_EDITOR_PATH", plugin_dir_path( __FILE__ ) );

define( "WPF_EDITOR_URL", plugin_dir_url( __FILE__ ) );


require_once( WPF_EDITOR_PATH . "class/inc/class-wpf-editor-utils.php" );

require_once( WPF_EDITOR_PATH . "class/class-wpf-editor-init.php" );

require_once( WPF_EDITOR_PATH . "class/class-wpf-editor-ajax.php" );


$wpf_editor = new Wpf_Editor();
$wpf_editor_ajax = new Wpf_Editor_Ajax();