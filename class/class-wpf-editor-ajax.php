<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;


class Wpf_Editor_Ajax
{
    public function __construct()
    {
        $this->define_hooks();
	}

    private function define_hooks()
    {
        add_action( 'wp_ajax_post_content', array( $this, 'post_content' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'load_object_js' ) );
    }

    public function load_object_js()
    {
        wp_localize_script( 'wpf-editor', 'wpfEditorData', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'post_id' => get_the_ID(),
        ));
    }

    public function post_content()
    {
        if ( (is_single() || is_page()) && (current_user_can( 'edit_posts' ) && ! is_admin()) ) die;

        $post_data = array();

        if ( isset($_POST['id']) && ctype_digit($_POST['id']) && isset($_POST['content']) )
        {
            $post_data["ID"] = $_POST['id'];

            $post_data["post_content"] = wp_filter_post_kses($_POST['content']);

            wp_update_post( $post_data );

        } else {

            die("error");
        }

        $response = array(
            'status' => '200',
            'message' => 'OK',
            'post_ID' => $post_data["ID"]
        );
        
        header( 'Content-Type: application/json; charset=utf-8' );

        echo json_encode( $response );

        die;
    }
}