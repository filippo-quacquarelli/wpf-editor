<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;


class Utils
{
    public function __construct()
    {
        $this->define_hooks();
    }

    public function define_hooks()
    {
        add_action( 'wp', array( $this, 'permissions' ) );
    }

    public static function permissions()
    {
        if ( (is_single() || is_page()) && (current_user_can( 'edit_posts' ) && ! is_admin()) ) return true;

        return false;
    }
}