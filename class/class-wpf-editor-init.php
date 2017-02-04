<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;


class Wpf_Editor
{
    protected $plugin_name;
    
    protected $version;

    public function __construct()
    {
		$this->plugin_name = 'Wp Frontend Editor';

		$this->version = '1.0.0';
		
        $this->define_hooks();
	}

    public function get_plugin_name()
    {
		return $this->plugin_name;
	}
    
	public function get_version()
    {
		return $this->version;
	}

    private function define_hooks()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'load_css' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'load_js' ) );

        add_filter( 'the_content', array( $this, 'content_wrapper' ) );

        add_action( 'wp_footer', array( $this, 'add_notify' ) );
    }

    public function load_css()
    {
        if ( ! Utils::permissions() ) return;
        
        wp_enqueue_style( 'medium-editor',       WPF_EDITOR_URL . 'assets/css/medium-editor.min.css' );
        
        wp_enqueue_style( 'medium-editor-theme', WPF_EDITOR_URL . 'assets/css/themes/beagle.min.css' );

        wp_enqueue_style( 'wpf-editor', WPF_EDITOR_URL . 'assets/css/wpf-editor.css' );
    }

    public function load_js()
    {
        if ( ! Utils::permissions() ) return;

        if( ! wp_script_is( 'jquery' ) ) wp_enqueue_script( 'jquery' );

        wp_enqueue_script( 'medium-editor', WPF_EDITOR_URL . 'assets/js/medium-editor.min.js', array('jquery'), '1.0', true );

        wp_enqueue_script( 'wpf-editor',    WPF_EDITOR_URL . 'assets/js/wpf-editor.js', array('jquery'), '1.0', true );
    }

    public function content_wrapper( $content )
    {
        if ( ! Utils::permissions() ) return $content;
        
        return '<div class="wpf-editor-content">' . $content . '</div>';
    }

    public function add_notify()
    {
        if ( ! Utils::permissions() ) return;

        echo '<div class="wpf-editor-notify"></div>';
    }
}

