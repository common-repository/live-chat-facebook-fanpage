<?php

/**
 * @link              http://www.themeinthebox.com
 * @since             1.0.0
 * @package           Facebook_Live_Chat
 *
 * @wordpress-plugin
 * Plugin Name:       Live Chat for Fanpage
 * Plugin URI:        http://www.themeinthebox.it/
 * Description:       Generate a quick Live Chat with the Fanpage.
 * Version:           3.1.1
 * Author:            ThemeintheBox
 * Author URI:        http://www.themeinthebox.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       live-chat-facebook-fanpage
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action('init', 'titb_lcff_onwpinit');

function titb_lcff_onwpinit () {

	add_action('wp_enqueue_scripts', 'titb_lcff_enqueue');

	add_action('wp_footer', 'titb_lcff_front');
	
	add_action( 'wp_head', 'titb_lcff_stylehead' );	

}


// Add settings link on plugin page
function flc_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=fb-live-chat">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}


$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'flc_settings_link' );

/* enqueue */

function titb_lcff_enqueue() {

	wp_register_script( 'flc-js', plugins_url( 'assets/js/flc-main.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
	wp_register_style( 'flc-css', plugins_url( 'assets/css/flc-style.css', __FILE__ ), array(), '1.0.0', 'all' );


	/*	Fontello Icons	*/
	wp_register_style( 'flc-fontello', plugins_url( 'assets/css/flc.css', __FILE__ ), array(), '1.0.0', 'all' );
	
	/*	Animate.css + WOW	*/
	wp_register_style( 'flc-animate', plugins_url( 'assets/css/animate.css', __FILE__ ), array(), '3.7.0', 'all' );
	wp_register_script( 'flc-wow', plugins_url( 'assets/js/wow.min.js', __FILE__ ), array( 'jquery' ), '1.1.3', true );

	wp_enqueue_script( 'flc-js' );
	wp_enqueue_style( 'flc-css' );
	wp_enqueue_style( 'flc-fontello' );
	wp_enqueue_script( 'flc-wow' );
	wp_enqueue_style( 'flc-animate' );
}



/*------------------------------------*\
	MetaBox
\*------------------------------------*/

if( !class_exists( 'RWMB_Loader' ) ) {
	include plugin_dir_path( __FILE__ ) . '/admin/meta-box/meta-box.php';
}

if( !class_exists( 'MB_Settings_Page_Loader' ) ) {
	include plugin_dir_path( __FILE__ ) . '/admin/mb-settings-page/mb-settings-page.php';
}

//require plugin_dir_path( __FILE__ ) . 'wpdp-run.php';
//require plugin_dir_path( __FILE__ ) . 'cpt.php';
require plugin_dir_path( __FILE__ ) . '/admin/mb-settings.php';



/*------------------------------------*\
	Admin Style
\*------------------------------------*/

add_action('admin_head', 'flc_custom_fonts');

function flc_custom_fonts() {
  echo '<style>
	.select_size .rwmb-image-select {
		width: 250px;
		height: auto;
	}
	
	.select_size .rwmb-image-select img {
		height: auto;
	} 
	
	.select_icon .rwmb-image-select {
		width: 50px;
		height: auto;s	
	}

  </style>';
}



function titb_lcff_stylehead() {

	
	// load options
	$opzioni_old =  maybe_unserialize(get_option('titb_flc_options')); // can change maybe_unserialize() in: unserialize()

	$position_new = rwmb_meta( 'button_position', array( 'object_type' => 'setting' ), 'fb_live_chat' );
	
	$h_shift = rwmb_meta( 'titb_shit_h', array( 'object_type' => 'setting' ), 'fb_live_chat' );
	
	
	if( !$position_new ) {
		$button_position = $opzioni_old['button_position'];
	} else {
		$button_position = $position_new;
	}
	
	echo "<style>
		#btn-flc { ". $button_position .": 40px;}
		.popup-box  { ". $button_position .": 20px; }	
		#btn-flc button[data-tooltip]:before {". $button_position .": 0;}
		#btn-flc .btn-ico { left: ". $h_shift ."px; }
	</style>"; 
}


function titb_lcff_front(){
	
	// load MetaBox.io options
	$titb_flc_url_new = rwmb_meta( 'titb_flc_url', array( 'object_type' => 'setting' ), 'fb_live_chat' );
	$titb_flc_btnlabel_new = rwmb_meta( 'titb_flc_btnlabel', array( 'object_type' => 'setting' ), 'fb_live_chat' );
	$titb_flc_titlesize_new = rwmb_meta( 'titb_flc_titlesize', array( 'object_type' => 'setting' ), 'fb_live_chat' );
	$button_size_new = rwmb_meta( 'button_size', array( 'object_type' => 'setting' ), 'fb_live_chat' );
	$titb_flc_language_new = rwmb_meta( 'titb_flc_language', array( 'object_type' => 'setting' ), 'fb_live_chat' );
	$button_icon_new = rwmb_meta( 'button_icon', array( 'object_type' => 'setting' ), 'fb_live_chat' );
	$button_animate_new = rwmb_meta( 'button_animate', array( 'object_type' => 'setting' ), 'fb_live_chat' );
	
	
	// load options
	$opzioni_old =  maybe_unserialize(get_option('titb_flc_options'));
	
	if( !$titb_flc_url_new ) {
		$titb_flp = $opzioni_old['titb_flc_url']; //$titan->getOption( 'titb_flc_url' );
	} else {
		$titb_flp = $titb_flc_url_new;
	}
	
	if( !$titb_flc_btnlabel_new ) {
		$titb_btnlabel = $opzioni_old['titb_flc_btnlabel']; // $titan->getOption( 'titb_flc_btnlabel' );
	} else {
		$titb_btnlabel = $titb_flc_btnlabel_new;
	}
	
	if( !$titb_flc_titlesize_new ) {
		$titb_titlesize = $opzioni_old['titb_flc_titlesize']; // $titan->getOption( 'titb_flc_titlesize' );
	} else {
		$titb_titlesize = $titb_flc_titlesize_new;
	}
	
	if( !$button_size_new ) {
		$titb_btnsize = $opzioni_old['button_size']; // $titan->getOption( 'button_size' );
	} else {
		$titb_btnsize = $button_size_new;
	}
	
	if( !$titb_flc_language_new ) {
		$titb_lang = $opzioni_old['titb_flc_language']; // $titan->getOption( 'titb_flc_language' );
	} else {
		$titb_lang = $titb_flc_language_new;
	}
	
	if( !$button_icon_new ) {
		$titb_icon = $opzioni_old['button_icon']; // $titan->getOption( 'button_icon' );
	} else {
		$titb_icon = $button_icon_new;
	}
	
	if( !isset($button_animate_new) ) {
		$titb_animate = $opzioni_old['button_animate']; // $titan->getOption( 'button_animate' );
		// Check animate
		$titb_animate_class = ' ';
		if($titb_animate != false) {
	    	$titb_animate_class = 'animated infinite pulse delay-2000s';
		}
	} else {
		$titb_animate = $button_animate_new;
		// Check animate
		$titb_animate_class = ' ';
		if($titb_animate == 1) {
	    	$titb_animate_class = 'animated infinite pulse delay-2000s';
		}
	}
	
	
	// Check size
	if($titb_btnsize == 'flc_tiny') {
    	$titb_btnsize = '30';
	} elseif ($titb_btnsize == 'flc_medium') {
    	$titb_btnsize = '55';
	} elseif ($titb_btnsize == 'flc_large') {
    	$titb_btnsize = '70';
	} else {
    	$titb_btnsize = '55';
	}

	if(!empty($titb_flp)){
		
?>
	
	
	


		<div id="btn-flc" class="round hollow text-center <?php echo $titb_animate_class; ?>">
                <button id="addClass" class="btn-ico" data-tooltip="<?php echo $titb_btnlabel; ?>">
                    <img src="<?php echo plugins_url( 'assets/icons/svg/'. $titb_icon .'.svg', __FILE__ ); ?>" alt="001-messenger" width="<?php echo $titb_btnsize; ?>" height="auto" />
                </button>
		</div>

		<div class="popup-box chat-popup animated" id="qnimate">
			<div class="flc-close">
				<button data-widget="remove" id="removeClass" type="button"><i class="flc-cancel"></i></button>
			</div>

		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/<?php echo $titb_lang; ?>/sdk.js#xfbml=1&version=v2.8&appId=1548919625405563";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<div class="fb-page" data-href="<?php echo $titb_flp; ?>" data-tabs="messages" data-small-header="<?php echo $titb_titlesize; ?>" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"></div>
		</div>

	<?php
	}

}
