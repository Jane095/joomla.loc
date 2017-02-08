<?php
/*
Plugin Name: Magic Liquidizer Responsive Navigationbar
Plugin URI: http://www.innovedesigns.com/wordpress/magic-liquidizer-responsive-navigationbar-rwd-you-must-have-wp-plugin/
Author: Elvin D.
Description: A Responsive Web Design (RWD) plugin that makes your existing Navigation Bar / Nav Menu become an instant responsive or mobile compatible. After activation, go to Dashboard > Magic Liquidizer Lite > Navigationbar.
Version: 1.0.2
Tags: responsive, navigationbar, fluid, mobile screens, mobile friendly, rwd, responsive web design
Author URI: http://innovedesigns.com/author/esstat17

/--------------------------------------------------------------------\
|                                                                    |
| License: GPL Version 3                                             |
|                                                                    |
| Magic Liquidizer Responsive Navigationbar - RWD for Nav Menu		 |
| Copyright (C) 2016, Elvin Deza,                                    |
| http://innovedesigns.com/                                          |
| All rights reserved.                                               |
|                                                                    |
| By using the software, you agree to be bound by the terms of		 | 		
| this license.														 |
| 																	 |
|                                                                    |
\--------------------------------------------------------------------/
*/

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

if (!class_exists('magic_liquidizer_wp_class_lite')) { // avoiding class duplication

class magic_liquidizer_wp_class_lite {
	// when object is created
	public function __construct() {
		add_action('admin_menu', array($this, 'magic_liquidizer_menu_lite')); // add item to menu
		add_action('plugins_loaded', array($this, 'ml_load_textdomain')); // internatinalizing
	}
	public function magic_liquidizer_menu_lite() {
		add_menu_page(__('Magic Liquidizer Lite', 'ml-txt'), __('Magic Liquidizer Lite', 'ml-txt'), 'manage_options', 'magic-liquidizer-page-lite', array($this, 'ml_settings_fn_lite'),'' );
		add_submenu_page('magic-liquidizer-page-lite', __('Setup Magic Liquidizer', 'ml-txt'), __('Setup Wizard', 'ml-txt'), 'manage_options', 'magic-liquidizer-page-lite', array($this, 'ml_settings_fn_lite'),29 );
		add_submenu_page('magic-liquidizer-page-lite', __('About Magic Liquidizer and More', 'ml-txt'), __('About', 'ml-txt'), 'manage_options', 'magic-liquidizer-about', array($this, 'magic_liquidizer_about'),30 );
	}

	public function ml_settings_fn_lite(){
	?>
		<div id="ml-lite" class="wrap ml-lite">
		<h2 class="title"><?php _e('Magic Liquidizer Lite for Wordpress', 'ml-txt'); ?></h2>
		<p><?php _e('Easily Converts Your Non-Responsive Theme to Become Flawlessly Responsive.', 'ml-txt'); ?></p>
	
	<?php

		if(isset($_POST['submit']) && check_admin_referer('liquidizer_lite_action','liquidizer_lite_ref') ) {
			
			$args = array();
			$ml_options = apply_filters( 'ml_hook_options', $args );
			/* Handling variable array */		
			foreach($ml_options as $x=>$x_value) {
				if ( get_option( $x ) !== false ) {
					if( get_option($x) !== $x_value) {
						update_option($x, $x_value);
					}
				} else {			
					add_option( $x, $x_value, '', 'yes' );
				}
			}
	   		
		   
		} // end of &_Post
	?>
		
		<form method="post" action="<?php echo esc_attr($_SERVER["REQUEST_URI"]); ?>">	
			<?php wp_nonce_field('liquidizer_lite_action','liquidizer_lite_ref'); ?>
		
		<table class="form-table" style="color: #bbb;">
	      
		    <tbody>
		    <tr>
			  <td>		  	  
		<?php echo do_action( 'ml_hook_body'); ?>
		<?php echo do_action( 'ml_hook_footer'); ?>  
		   
	<?php
	} 
	
	// Submenu
	public function magic_liquidizer_about(){
	?>
		<div id="liquidizer-wp-about" class="wrap">
	    
	    <h2 class="title"><?php _e('About Magic Liquidizer', 'ml-txt'); ?></h2><?php _e('Instruction. FAQ. Supports. and more..', 'ml-txt'); ?><br />
	    
	    <ul class="about-list">
	    	<li><a href="http://www.innovedesigns.com/" target="_blank"><?php _e('Plugin Home', 'ml-txt'); ?></a></li>
	    	<li><a href="http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-instant-responsive-web-design-plugin-for-wordpress/" target="_blank"><?php _e('Plugin Page', 'ml-txt'); ?></a></li>
	    	<li><a href="http://www.innovedesigns.com/responsive/magic-liquidizer/faq/" target="_blank"><?php _e('FAQ', 'ml-txt'); ?></a></li>
	    	<li><a href="http://demo.innovedesigns.com/wordpress/" target="_blank"><?php _e('Demo', 'ml-txt'); ?></a></li>
	    	<li><a href="http://www.innovedesigns.com/contact/" target="_blank"><?php _e('Contact Us', 'ml-txt'); ?></a></li>	    	
	    </ul>
	    
	<?php
	}
	public function ml_load_textdomain() {
    	// Set filter for language directory
	    $lang_dir = plugin_dir_path( __FILE__ ) . '/languages/';
	    $lang_dir = apply_filters( 'n4p_lang_dir', $lang_dir );
	   
	   // Traditional WordPress plugin locale filter
	    $locale = apply_filters( 'plugin_locale', get_locale(), 'ml-txt' );
	    $mofile = sprintf( '%1$s-%2$s.mo', 'ml-txt', $locale );
	   
	   // Setup paths to current locale file
	    $mofile_local   = $lang_dir . $mofile;
	    $mofile_global  = WP_LANG_DIR . '/ml-txt/' . $mofile;
	   
	   if( file_exists( $mofile_global ) ) {
	        
	        // Look in global /wp-content/languages/ml-txt/ folder
	        load_textdomain( 'ml-txt', $mofile_global );
	    } elseif( file_exists( $mofile_local ) ) {
	        
	        // Look in local /wp-content/plugins/ml-txt/languages/ folder
	        load_textdomain( 'ml-txt', $mofile_local );
	    } else {
	        
	        // Load the default language files
	        load_plugin_textdomain( 'ml-txt', false, $lang_dir );
	    }
	}
}
new magic_liquidizer_wp_class_lite();

} //endif; magic_liquidizer_wp_class_lite

if (class_exists('magic_liquidizer_wp_class_lite') &&  !class_exists('MLPremiumClassFooter') ) { 

	Class MLPremiumClassFooter {

 		public function __construct() {
 			add_action('ml_hook_footer', array($this, 'mabuhay'),1); 
 		}
 		public function mabuhay(){
 			// checkboxes lists
	?>	
			  <br><br>
			  
			<h3 style="font-weight: bold;"><label for="liquidizer_lite_wp_selector" style="color: #333;"><?php _e('Magic Liquidizer Premium Settings', 'ml-txt'); ?>. <a href="http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-instant-responsive-web-design-plugin-for-wordpress/" target="_blank"><?php _e('Update now!', 'ml-txt'); ?></a></label></h3>
			<h5 style="color: #333;"><?php _e('A complete solution for Responsive Web Design (RWD). See', 'ml-txt'); ?> <a href="http://demo.innovedesigns.com/wordpress" target="_blank"><?php _e('DEMO', 'ml-txt'); ?></a></h5>
			<p><input id="liquidizer_lite_wp_video" class="disable" disabled="disabled" style="color: #bbb;" value="" name="liquidizer_lite_wp_video" type="text">
			<label><?php _e('Responsive Video (e.g. body, #wrapper, etc)', 'ml-txt'); ?></label>
			</p> 
			<p>
			<input id="liquidizer_lite_wp_table" class="disable" disabled style="color: #bbb;" value="1" name="liquidizer_lite_wp_table" type="checkbox">
			<label><?php _e('Make `table` responsive', 'ml-txt'); ?></label>
		    </p>  
			<p>
			<input id="liquidizer_lite_wp_image" class="disable" disabled style="color: #bbb;" value="1" name="liquidizer_lite_wp_image" type="checkbox">
			<label><?php _e('Make `image` responsive', 'ml-txt'); ?></label>
			</p>
			<p>
			<input id="liquidizer_lite_wp_form" class="disable" disabled style="color: #bbb;" value="1" name="liquidizer_lite_wp_form" type="checkbox">
			<label><?php _e('Make `form` responsive', 'ml-txt'); ?></label>
			</p>
			<p>
			<input id="liquidizer_lite_wp_addclasses" class="disable" disabled style="color: #bbb;" value="1" name="liquidizer_lite_wp_addclasses" type="checkbox">
			<label><?php _e('Add Classes (a dirty way to add classes on each div elements)?', 'ml-txt'); ?></label>
			</p>
			<p>
			<input id="liquidizer_lite_wp_htmloverflow" class="disable" disabled style="color: #bbb;" value="1" name="liquidizer_lite_wp_htmloverflow" type="checkbox">
			<label><?php _e('Disable Horizontal Scroll Bar (not recommended)?', 'ml-txt'); ?></label>
			</p>
			<br />
			<p>
			<h3><?php _e('Responsive Navigation Bar Settings.', 'ml-txt'); ?> <a href="http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-instant-responsive-web-design-plugin-for-wordpress/" target="_blank"><?php _e('Update now!', 'ml-txt'); ?></a></h3>
			</p>
			<p><input id="liquidizer_lite_navigationbar" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_navigationbar" type="text">
			<label><?php _e('Navigation #ID or .Class', 'ml-txt'); ?></label>
			</p>
			<p><input id="liquidizer_lite_navcolor" class="colorpick disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_navcolor" type="text">
			<label style="vertical-align: super;"><?php _e('Navigation bar background color (Leave it as empty as default)', 'ml-txt'); ?></label>
			
			</p>
			<p><input id="liquidizer_lite_navselect" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_navselect" type="text">
			<label><?php _e('Navigation Select (e.g .current, .current-menu-item, etc)', 'ml-txt'); ?></label>
			</p>
			<p><input id="liquidizer_lite_wp_home" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_home" type="url">
			<label><?php _e('Enter your Home URL', 'ml-txt'); ?></label>
			</p>
			<p><input id="liquidizer_lite_wp_info" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_info" type="url">
			<label><?php _e('Enter your About URL', 'ml-txt'); ?></label>
			</p>
			<p><input id="liquidizer_lite_wp_contact" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_contact" type="url">
			<label><?php _e('Enter your Contact URL', 'ml-txt'); ?></label>
			</p>
			
			<br />
			<h3 style="color: #333"><?php _e('Advanced Settings.', 'ml-txt'); ?> <a href="http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-instant-responsive-web-design-plugin-for-wordpress/" target="_blank"><?php _e('Update now!', 'ml-txt'); ?></a></h3>
			<p><input id="liquidizer_lite_wp_hidetonondesktop" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_hidetonondesktop" type="text">
			<label><?php _e('Enter an IDs or Classes to keep hidden on Iphone or Ipad Screens (optional).', 'ml-txt'); ?></label>
			</p>
			<p><input id="liquidizer_lite_wp_hidetodesktop" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_hidetodesktop" type="text">
			<label><?php _e('Enter an IDs or Classes to keep hidden on Desktop Screens (optional).', 'ml-txt'); ?></label>
			</p>
			<p><input id="liquidizer_lite_wp_transparent" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_transparent" type="text">
			<label><?php _e('Enter an IDs or Classes to keep background image transparent (optional).', 'ml-txt'); ?></label>
			</p>
			<br />
			<h3><?php _e('Customize Media Queries.', 'ml-txt'); ?> <a href="http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-instant-responsive-web-design-plugin-for-wordpress/" target="_blank"><?php _e('Update now!', 'ml-txt'); ?></a></h3>
			<p><textarea id="liquidizer_lite_wp_styles" class="disable" disabled style="color: #bbb;" name="liquidizer_lite_wp_styles" type="text" rows="10" cols="90"></textarea>
			<br />
			<label><?php _e('Customize Media Queries (optional).', 'ml-txt'); ?></label>
			</p>
			
			<p class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Save Changes', 'ml-txt'); ?>" /></p>

		  </td>
	    </tr>
	    </tbody>
      </table>
	    </form>
	    
	    </div>

	<?php    
 		}
	}
	new MLPremiumClassFooter();

} // endif;

 // This is a CLASS hook
if (class_exists('magic_liquidizer_wp_class_lite') && !class_exists('MagicLiquidizerResponsiveNavigationbarClass')) { 

	Class MagicLiquidizerResponsiveNavigationbarClass {
		
 		public function __construct() {
 			add_action('admin_menu', array($this, 'magic_liquidizer_navigationbar_menu')); // add item to menu
 			add_action( 'admin_enqueue_scripts', array( $this, 'ml_enqueue_color_picker' ), 2 );
 			add_action('ml_hook_body', array($this, 'navigationbar_hook_fn'),1); 
 			add_action('wp_enqueue_scripts', array($this, 'magic_liquidizer_navigationbar_scripts'));
 			add_action('wp_enqueue_scripts', array($this, 'magic_liquidizer_navigationbar_style'));
 			add_action('wp_footer', array($this, 'execute_jquery_navigationbar_lite'));
 			add_filter( 'ml_hook_options', array($this, 'ml_nav_options'));	
 		}
 		function magic_liquidizer_navigationbar_menu() {
			add_submenu_page('magic-liquidizer-page-lite', 'Magic Liquidizer Responsive Navigationbar', 'Navigationbar', 'manage_options', 'magic-liquidizer-navigationbar', array($this, 'navigationbar_hook_fna') );
		}
 		
 		function navigationbar_hook_fn(){
			?>
			<h3 style="font-weight: bold; color: #333;"><label for="liquidizer_lite_wp_selector"><?php _e('Responsive Navigationbar Settings', 'ml-txt'); ?></label></h3>
			<p style="color: #333;"><?php _e('These are default values that may or may not work.', 'ml-txt'); ?> <a href="http://www.innovedesigns.com/contact/" target="_blank"> Need help?</a></p>			
			<p>
			<input id="liquidizer_lite_wp_navigationbar" class="disable" style="color: #bbb;" value="1" name="liquidizer_lite_wp_navigationbar" type="checkbox" <?php checked(get_option('liquidizer_lite_wp_navigationbar'), 1); ?>>
			<label style="color: #333;"><?php _e('Make your existing navigation bar responsive?', 'ml-txt'); ?></label>
			</p>
			<p style="color: #333;"><input id="liquidizer_lite_wp_which_navigationbar_element" value="<?php echo get_option('liquidizer_lite_wp_which_navigationbar_element'); ?>" name="liquidizer_lite_wp_which_navigationbar_element" type="text">
			<label style="color: #333;"><?php _e('E.g. nav, #navID, .navClass. Specify your navigationbar\'s class or id.', 'ml-txt'); ?></label>
			</p>
			<p style="color: #333;"><input id="liquidizer_lite_wp_navigationbar_width" value="<?php echo get_option('liquidizer_lite_wp_navigationbar_width'); ?>" name="liquidizer_lite_wp_navigationbar_width" type="text">
			<label style="color: #333;"><?php _e('Initiate responsive menu at breakpoint e.g. 480px, 720px, 840px, or 960px', 'ml-txt'); ?></label>
			</p>
			<p style="color: #333;"><input id="liquidizer_lite_navcolor" class="colorpick" value="<?php echo get_option('liquidizer_lite_wp_navcolor'); ?>" name="liquidizer_lite_wp_navcolor" type="text">
			<label style="vertical-align: super;"><?php _e('Navigation bar background color (Leave it as empty as default)', 'ml-txt'); ?></label>
			</p>
			<p style="color: #333;"><input id="liquidizer_lite_navselect" value="<?php echo get_option('liquidizer_lite_wp_navselect'); ?>" name="liquidizer_lite_wp_navselect" type="text">
			<label><?php _e('Navigation Select (e.g .current, .current-menu-item, etc)', 'ml-txt'); ?></label>
			</p>
			<p style="color: #333;"><input id="liquidizer_lite_wp_home" value="<?php echo get_option('liquidizer_lite_wp_home'); ?>" name="liquidizer_lite_wp_home" type="url">
			<label><?php _e('Enter your home URL', 'ml-txt'); ?></label>
			</p>
			<p style="color: #333;"><input id="liquidizer_lite_wp_info" value="<?php echo get_option('liquidizer_lite_wp_info'); ?>" name="liquidizer_lite_wp_info" type="url">
			<label><?php _e('Enter your About URL', 'ml-txt'); ?></label>
			</p>
			<p style="color: #333;"><input id="liquidizer_lite_wp_contact" value="<?php echo get_option('liquidizer_lite_wp_contact'); ?>" name="liquidizer_lite_wp_contact" type="url">
			<label><?php _e('Enter your Contact URL', 'ml-txt'); ?></label>
			</p>
			<p class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Save Changes', 'ml-txt'); ?>"></p>
			
			<?php	
 		}

 		public function ml_nav_options($args){
 			$defaults = array(
				'liquidizer_lite_wp_which_navigationbar_element' => isset($_POST["liquidizer_lite_wp_which_navigationbar_element"]) ? esc_js(trim($_POST['liquidizer_lite_wp_which_navigationbar_element'])) : "",
				'liquidizer_lite_wp_navigationbar_width' => isset($_POST["liquidizer_lite_wp_navigationbar_width"]) ? esc_js(trim($_POST['liquidizer_lite_wp_navigationbar_width'])) : "",
				'liquidizer_lite_wp_navigationbar' => isset($_POST["liquidizer_lite_wp_navigationbar"]) ? esc_js(trim($_POST['liquidizer_lite_wp_navigationbar'])) : "",
				'liquidizer_lite_wp_navcolor' => isset($_POST["liquidizer_lite_wp_navcolor"]) ? $_POST['liquidizer_lite_wp_navcolor'] : "",
				'liquidizer_lite_wp_navselect' => isset($_POST["liquidizer_lite_wp_navselect"]) ? esc_js(trim($_POST['liquidizer_lite_wp_navselect'])) : "",
				'liquidizer_lite_wp_home' => isset($_POST["liquidizer_lite_wp_home"]) ? esc_js(trim($_POST['liquidizer_lite_wp_home'])) : "",
				'liquidizer_lite_wp_info' => isset($_POST["liquidizer_lite_wp_info"]) ? esc_js(trim($_POST['liquidizer_lite_wp_info'])) : "",
				'liquidizer_lite_wp_contact' => isset($_POST["liquidizer_lite_wp_contact"]) ? esc_js(trim($_POST['liquidizer_lite_wp_contact'])) : "",	
			);
			$args = array_merge($args, $defaults);
			return $args;
 		}
 		
 		public function navigationbar_hook_fna(){
 			?>
 			<div id="ml-lite" class="navigationbar wrap ml-lite">
			<h2 class="title"><?php _e('Magic Liquidizer Responsive Navigationbar for Wordpress', 'ml-txt'); ?></h2>
			<?php _e('Make your existing navigation menu responsive.', 'ml-txt'); ?>
			<?php
	 		if(isset($_POST['submit']) && check_admin_referer('liquidizer_lite_action','liquidizer_lite_ref') ) {
					/* Array DB _options */
				$args = array();
				$ml_options = apply_filters( 'ml_hook_options', $args );
				
				/* Handling variable array */		
				foreach($ml_options as $x=>$x_value) {
					if ( get_option($x) !== false ) {
						if( get_option($x) !== $x_value ){
							update_option($x, $x_value);
						} 
					} else {			
						add_option( $x, $x_value, '', 'yes' );
					}
				}
			} // end of &_Post
			
			echo '<form method="post" action="'. esc_attr($_SERVER["REQUEST_URI"]) .'">';
			
				wp_nonce_field('liquidizer_lite_action','liquidizer_lite_ref');
		
			echo '<table class="form-navigationbar" style="color: #bbb;">
	      
		    <tbody>
		    <tr>
			  <td>';
			  
	 		 self::navigationbar_hook_fn();	  	  
			//	do_action( 'ml_hook_body');
			//	do_action( 'ml_hook_footer');
			echo '</tbody>
	      	</table>
		    </form>
		    </div>';
 		}
 		
 		public function magic_liquidizer_navigationbar_style() {  	
			wp_register_style( 'magic-liquidizer-navigationbar-style', plugins_url('idcss/ml-responsive-navigationbar.css', __FILE__),array(), '1.0.0', 'all');
  			wp_enqueue_style( 'magic-liquidizer-navigationbar-style' );
		}
	
 		public function magic_liquidizer_navigationbar_scripts() {    	 	 
    		wp_register_script( 'magic-liquidizer-navigationbar', plugins_url('idjs/ml.responsive.nav.min.js', __FILE__), array('jquery'), '1.0.0', false);    	
    		wp_enqueue_script( 'magic-liquidizer-navigationbar');	
    	}
    	
		public function execute_jquery_navigationbar_lite() { 
	    	echo 
"
<script type='text/javascript'>
	//<![CDATA[
    jQuery(document).ready(function($) { 
    	$('html').MagicLiquidizerNavigationbar({ navigationbar: '".get_option('liquidizer_lite_wp_navigationbar')."', whichelement: '".str_replace(' ', '', get_option('liquidizer_lite_wp_which_navigationbar_element'))."', breakpoint: '".str_replace(array('px','PX','Px','pX','p x',' '), '', get_option('liquidizer_lite_wp_navigationbar_width'))."', navcolor : '".str_replace(' ', '', get_option('liquidizer_lite_wp_navcolor'))."',navselect : '".str_replace(' ', '', get_option('liquidizer_lite_wp_navselect'))."',home: '".get_option('liquidizer_lite_wp_home')."',info: '".get_option('liquidizer_lite_wp_info')."',contact: '".get_option('liquidizer_lite_wp_contact')."' })
    })
	//]]>
</script>   	
";  	
		}
	
	function ml_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    	wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_script( 'ml-script-handle', plugins_url('idjs/init.jquery.colorpicker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	}
 				
	}
	new MagicLiquidizerResponsiveNavigationbarClass();

}
 		

register_activation_hook(__FILE__, 'liquidizer_navigationbar_activation');
// register_deactivation_hook(__FILE__, 'liquidizer_navigationbar_deactivation');
register_uninstall_hook(__FILE__, 'liquidizer_navigationbar_uninstall');

require_once (dirname(__FILE__) . '/includes/activation.php');
// require_once (dirname(__FILE__) .'/includes/deactivation.php');
require_once (dirname(__FILE__) .'/includes/uninstall.php');	

