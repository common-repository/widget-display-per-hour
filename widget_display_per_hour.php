<?php
/*
Plugin Name: Tuto CMS Display Widget per hour
Plugin URI: http://tutocms.com/blog/wordpress
Description: This is a description
Version: 1.0
Author: Julio Cesar Llavilla Ccama
Author Email: llavillaccama@gmail.com
License:

  Copyright 2011 Julio Cesar Llavilla Ccama (llavillaccama@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

  class TutoCMSDisplayimagesperhour {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'Tuto CMS Display widgetper hour';
	const slug = 'tuto_cms_display_widget_per_hour';
	
	/**
	 * Constructor
	 */
	function __construct() {
		//register an activation hook for the plugin
		register_activation_hook( __FILE__, array( &$this, 'install_tuto_cms_display_widget_per_hour' ) );

		//Hook up to the init action
		add_action( 'init', array( &$this, 'init_tuto_cms_display_widget_per_hour' ) );
		require plugin_dir_path( __FILE__ ) . 'inc/widget_generate.php';
	}
	
	/**
	 * Runs when the plugin is activated
	 */  
	function install_tuto_cms_display_widget_per_hour() {
		// do not generate any output here
	}
	
	/**
	 * Runs when the plugin is initialized
	 */
	function init_tuto_cms_display_widget_per_hour() {
		// Setup localization
		load_plugin_textdomain( self::slug, false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
		// Load JavaScript and stylesheets
		$this->register_scripts_and_styles();

		// Register the shortcode [tutocms_images_per_hour]
		add_shortcode( 'tutocms_images_per_hour', array( &$this, 'render_shortcode' ) );
		
		if ( is_admin() ) {
			//this will run when in the WordPress admin
		} else {
			//this will run when on the frontend
		}

		/*
		 * TODO: Define custom functionality for your plugin here
		 *
		 * For more information: 
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		add_action( 'your_action_here', array( &$this, 'action_callback_method_name' ) );
		add_filter( 'your_filter_here', array( &$this, 'filter_callback_method_name' ) );    
	}

	function action_callback_method_name() {
		// TODO define your action method here
	}

	function filter_callback_method_name() {
		// TODO define your filter method here
	}

	function render_shortcode($atts) {
		// Extract the attributes
		extract(shortcode_atts(array(
			'attr1' => 'foo', //foo is a default value
			'attr2' => 'bar'
			), $atts));
		// you can now access the attribute values using $attr1 and $attr2
	}
	
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if ( is_admin() ) {
			$this->load_file( self::slug . '-admin-script-te', '/js/jquery-te-1.4.0.min.js', true );
			$this->load_file( self::slug . '-admin-script', '/js/admin.js', true );
			$this->load_file( self::slug . '-admin-style', '/css/admin.css' );
			$this->load_file( self::slug . '-admin-style-te', '/css/jquery-te-1.4.0.css' );
		} else {
			$this->load_file( self::slug . '-script', '/js/widget.js', true );
			$this->load_file( self::slug . '-style', '/css/widget.css' );
		} // end if/else
	} // end register_scripts_and_styles
	
	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url($file_path, __FILE__);
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {
				wp_register_script( $name, $url, array('jquery') ); //depends on jquery
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			} // end if
		} // end if

	} // end load_file
	
} // end class
new TutoCMSDisplayimagesperhour();

?>