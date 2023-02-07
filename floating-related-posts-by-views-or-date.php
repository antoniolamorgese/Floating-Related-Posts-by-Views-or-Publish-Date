<?php
ob_start();
/**
 * Floating Related Posts by Views or Publish Date
 *
 * @author    Antonio Lamorgese <antonio.lamorgese@gmail.com>
 * @copyright 2023 Antonio Lamorgese
 * @license   GNU General Public License v3.0
 * @link      https://github.com/antoniolamorgese/Floating-Related-Posts-by-Views-or-Publish-Date
 * @see       https://jeremyhixon.com/tool/wordpress-option-page-generator/
 */

/**
 * Plugin Name:        Floating Related Posts by Views or Publish Date
 * Plugin URI:         https://github.com/antoniolamorgese/Floating-Related-Posts-by-Views-or-Publish-Date
 * Description:        Increase website traffic free using "Floating Related Posts by Views or Publish Date". Show Floating Related Posts at the bottom or top of your visitor screen. Start <a href="options-general.php?page=floating-related-posts-by-views-or-date">Floating Related Posts Views or Date settings</a>.
 * Author:             Antonio Lamorgese
 * Author URI:         http://www.phpcodewizard.it/antoniolamorgese/
 * Version:            1.0.4
 * License:            GNU General Public License v3.0
 * License URI:        https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:        floating-related-posts-by-views-or-publish-date
 * Domain Path:        /languages
 * GitHub Plugin URI:  https://github.com/antoniolamorgese/Floating-Related-Posts-by-Views-or-Publish-Date
 * Requires at least:  5.6
 * Tested up to:       6.1.1
 * Requires PHP:       5.6 or later
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 3, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Exit if called directly.
 */
if ( ! defined( 'WPINC' ) ) die;

/**
 * Load Localisation files.
 *
 * Locales found in:
 * 	 - /wp-content/plugins/floating-related-posts-by-views-or-publish-date/languages/floating-related-posts-by-views-or-publish-date-LOCALE.mo
 */
function floating_related_posts_by_views_or_publish_date_textdomain() {
	load_plugin_textdomain( 'floating-related-posts-by-views-or-publish-date', FALSE, dirname(plugin_basename(__FILE__)) . '/languages' );
}
add_action('init', 'floating_related_posts_by_views_or_publish_date_textdomain');

/** 
 * Add link "Settings" in Wordpress administration Plugin
 */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'floating_related_posts_status_link' );
function floating_related_posts_status_link ( $links ) {
	$mylinks1 = array('<a href="' . admin_url( 'options-general.php?page=floating-related-posts-by-views-or-date' ) . '">Settings</a>');
	$mylinks2 = array('<a target="_blank" href="https://www.phpcodewizard.it/antoniolamorgese/">Website</a>');
	return array_merge( $links, $mylinks1, $mylinks2 );
}

/** 
 * Add Code in Wordpress Settings for get option settings Plugin
 * Code Generated with "WordPress Option Page Generator" <https://jeremyhixon.com/tool/wordpress-option-page-generator/>
 */
include_once(plugin_dir_path( __FILE__ ) . 'admin/floating-related-posts-by-views-or-date-admin.php');
$floating_related_posts_by_views_or_date_options = get_option( 'floating_related_posts_by_views_or_date_option_name' );
global $wpdb;
$total_rows = $wpdb->get_var("select count(option_value) from wp_options where option_name  = 'floating_related_posts_by_views_or_date_option_name'");

/**
 * Set the global variables and constants.
 */
$Url_picked_post;
$Title_picked_post;
$Excerpt_picked_post;

/**
 *	------------------------------------
 * 	Settings option: "Vertical Position"
 *	------------------------------------
 *
 *   Valid options:
 *   
 *	top
 *	bottom
 */	
$Vertical_Position = 'top';
if ($total_rows > 0) {
	if(strlen($floating_related_posts_by_views_or_date_options['vertical_position_5'])>=3) {
		$Vertical_Position = $floating_related_posts_by_views_or_date_options['vertical_position_5'];
	} else {
		$Vertical_Position = 'top';
	}
}

/**
 *	--------------------------------------
 * 	Settings option: "Horizontal Position"
 *	--------------------------------------
 *
 *   Valid options:
 *   
 *	right
 *	left
 */	
$Horizontal_Position = 'right';
if ($total_rows > 0) {
	if(strlen($floating_related_posts_by_views_or_date_options['horizontal_position_6'])>=4) {
		$Horizontal_Position = $floating_related_posts_by_views_or_date_options['horizontal_position_6'];
	} else {
		$Horizontal_Position = 'right';
	}
}

/**
 *	-----------------------------------
 * 	Settings option: "Background Color"
 *	-----------------------------------
 *
 *   Valid options:
 *   
 *	primary		=	#cce5ff
 *	secondary	=	#e2e3e5
 *	success		=	#d4edda
 *	danger		=	#f8d7da
 *	warning		=	#fff3cd
 *	info		=	#d1ecf1
 *	light		=	#fefefe
 *	dark		=	#d6d8d9
 */	
$Background_Color = '#F8D7DA'; 
if ($total_rows > 0) {
	if (
			(isset($floating_related_posts_by_views_or_date_options['background_color_4'])) && 
			(strlen($floating_related_posts_by_views_or_date_options['background_color_4'])>=7) 
	) {
		$Background_Color = $floating_related_posts_by_views_or_date_options['background_color_4']; 
	} else {
		$Background_Color = '#F8D7DA'; 
	}
}

/**
 *	--------------------------------
 * 	Settings option: "EXCERPT COLOR"
 *	--------------------------------
 *
 *   Valid options:
 *   
 *	primary		=	#cce5ff
 *	secondary	=	#e2e3e5
 *	success		=	#d4edda
 *	danger		=	#f8d7da
 *	warning		=	#fff3cd
 *	info		=	#d1ecf1
 *	light		=	#fefefe
 *	dark		=	#d6d8d9
 */	
if(strtolower($Background_Color) === '#cce5ff') {
	// primary
	$Excerpt_Color = 'RoyalBlue'; 
} else if(strtolower($Background_Color) === '#e2e3e5') {
	// secondary
	$Excerpt_Color = 'DimGray'; 
} else if(strtolower($Background_Color) === '#d4edda') {
	// success
	$Excerpt_Color = 'LightSeaGreen'; 
} else if(strtolower($Background_Color) === '#f8d7da') {
	// danger
	$Excerpt_Color = 'brown'; 
} else if(strtolower($Background_Color) === '#fff3cd') {
	// warning
	$Excerpt_Color = 'DimGray'; 
} else if(strtolower($Background_Color) === '#d1ecf1') {
	// info
	$Excerpt_Color = 'RoyalBlue'; 
} else if(strtolower($Background_Color) === '#fefefe') {
	// light
	$Excerpt_Color = 'DimGray'; 
} else if(strtolower($Background_Color) === '#d6d8d9') {
	// dark
	$Excerpt_Color = 'black';
} else {	
	$Background_Color = '#f8d7da'; 
	$Excerpt_Color = 'brown'; 
}

/**
 *	------------------------------
 * 	Settings option: "ADD_EXCERPT"
 *	------------------------------
 *
 *   Valid options:
 *   
 *   Yes/No
 */	
$Add_Excerpt = 'YES';
if ($total_rows > 0) {
	if($floating_related_posts_by_views_or_date_options['excerpt_3']==='excerpt_3') {
		$Add_Excerpt = 'YES'; 
	} else {
		$Add_Excerpt = 'NO'; 
	}
}

/**
 *	--------------------------
 * 	Settings option: "OPACITY"
 *	--------------------------
 *
 *   Valid options:
 *   
 *	High	
 *	Medium
 *	Low	
 */	
$Opacity = 1;
if ($total_rows > 0) {
	if(strlen($floating_related_posts_by_views_or_date_options['opacity_7'])>=3) {
		$Opacity = strtoupper($floating_related_posts_by_views_or_date_options['opacity_7']);
		if($Opacity === 'HIGH') {
			// High
			$Opacity = 0.70;
		} else if($Opacity === 'MEDIUM') {
			// Medium
			$Opacity = 0.80;
		} else if($Opacity === 'LOW') {
			// Low
			$Opacity = 0.90;
		} else if($Opacity === 'NONE') {
			// Low
			$Opacity = 1;
		} else {
			$Opacity = 1;
		}
	}
}

/**
 *	----------------------------------------------
 * 	TIME FOR ACTIVATION (min 15 secs max 120 secs)
 *	----------------------------------------------
 *
 *   Valid options:
 *   
 *   Enter values between 15 and 120
 */	
$Min_Activation = 15;
$Max_Activation  = 120;
$Seconds_For_Activation = 30;
if($total_rows>0){
   if(isset($floating_related_posts_by_views_or_date_options['seconds_to_activation_8'])) {
		if(intval($floating_related_posts_by_views_or_date_options['seconds_to_activation_8'])>0) {
			$Seconds_For_Activation = intval($floating_related_posts_by_views_or_date_options['seconds_to_activation_8']);
		}
   }
}
if($Seconds_For_Activation<$Min_Activation ) $Seconds_For_Activation = $Min_Activation;
if($Seconds_For_Activation>$Max_Activation ) $Seconds_For_Activation = $Max_Activation;
$Seconds_For_Activation = $Seconds_For_Activation*1000;

/**
 *	------------------------------------------------
 * 	TIME FOR DEACTIVATION (min 15 secs max 120 secs)
 *	------------------------------------------------
 *
 *   Valid options:
 *   
 *   Enter values between 15 and 120
 */	
$Min_Deactivation = 15;
$Max_Deactivation  = 120;
$Seconds_For_Deactivation = 15;
if($total_rows>0){
	if(isset($floating_related_posts_by_views_or_date_options['seconds_to_deactivation_9'])) {
		 if(intval($floating_related_posts_by_views_or_date_options['seconds_to_deactivation_9'])>0) {
			 $Seconds_For_Deactivation = intval($floating_related_posts_by_views_or_date_options['seconds_to_deactivation_9']);
		 }
	}
}
if($Seconds_For_Deactivation<$Min_Deactivation) $Seconds_For_Deactivation = $Min_Deactivation;
if($Seconds_For_Deactivation>$Max_Deactivation) $Seconds_For_Deactivation = $Max_Deactivation;
$Seconds_For_Deactivation = $Seconds_For_Deactivation*1000;

/**
 * Enqueue styles "font-awesome" icons & code Javascript
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'styles-fontawesome-floating-related-posts', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	// Disable Floating Related Posts plugin onClose event
	wp_register_script( 'disable-onclose-floating-related-posts', '' );
	wp_enqueue_script( 'disable-onclose-floating-related-posts' );
	wp_add_inline_script( 'disable-onclose-floating-related-posts', 'var disable_onClose = false;' );
});

/**
 * Get random popular post by current language if Polylang is installed.
 */
if(!function_exists('floating_related_posts_get_random_post_by_language')) {
	function floating_related_posts_get_random_post_by_language() {
		global $Url_picked_post;
		global $Title_picked_post;
		global $Excerpt_picked_post;
		global $Add_Excerpt;
		global $Excerpt_Color;
		global $floating_related_posts_by_views_or_date_options;
		$nr_picked_posts = 15;
		$nr_post_random = rand(1,$nr_picked_posts);
		$picked_post = 1;
		if (function_exists('pll_current_language')) {
			// Get random popular post if Polylang installed.
			$current_language = pll_current_language();
			if(!empty($current_language)) {
				if(pll_count_posts($current_language)>0) {
					if(function_exists('the_views')) {
						// if WP Post Views plugin is installed
						query_posts('posts_per_page='.$nr_picked_posts.'&lang='.$current_language.'&orderby=views&order=DESC');
					} else {
						// if WP Post Views plugin NOT installed
						query_posts('posts_per_page='.$nr_picked_posts.'&lang='.$current_language.'&orderby=date&order=DESC');
					}	
					if (have_posts()) {
						while (have_posts()) { 
							the_post();
							$Url_picked_post = get_the_permalink();
							$Title_picked_post = get_the_title();
							$Excerpt_picked_post = '';
							if($Add_Excerpt==='YES') {
								if(has_excerpt()) {
									$Excerpt_picked_post = '&nbsp;<p style="color: '.$Excerpt_Color.'; line-height: 90%;">&nbsp;<i>"'.get_the_excerpt().'"</i></p>';
								}
							}
							if($picked_post>=$nr_post_random) break;
							$picked_post++;
						}
					}
					wp_reset_query();
				}
			}
		} else {
			// Get random popular post if Polylang NOT installed.
			if(function_exists('the_views')) {
				// if WP Post Views plugin is installed
				query_posts('posts_per_page='.$nr_picked_posts.'&orderby=views&order=DESC');
			} else {
				// if WP Post Views plugin NOT installed
				query_posts('posts_per_page='.$nr_picked_posts.'&orderby=date&order=DESC');
			}	
			if (have_posts()) {
				while (have_posts()) { 
					the_post();
					$Url_picked_post = get_the_permalink();
					$Title_picked_post = get_the_title();
					$Excerpt_picked_post = '';
					if($Add_Excerpt==='YES') {
						if(has_excerpt()) {
							$Excerpt_picked_post = '<p style="color: '.$Excerpt_Color.'; line-height: 90%;">&nbsp;<i>"'.get_the_excerpt().'"</i></p>';
						}
					}
					if($picked_post>=$nr_post_random) break;
					$picked_post++;
				}
			}	
			wp_reset_query();
		}
	}
}

/**
 * Create Javascript code to include in the HEAD tag.
 */
if(!function_exists('floating_related_posts_add_Code_Javascript_in_tag_head')) {
	function floating_related_posts_add_Code_Javascript_in_tag_head() {
		global $Url_picked_post;
		global $Title_picked_post;
		global $Excerpt_picked_post;
		global $Horizontal_Position;
		global $Vertical_Position;
		global $Add_Excerpt;
		global $Background_Color;
		global $Seconds_For_Activation;
		global $Seconds_For_Deactivation;
		global $floating_related_posts_by_views_or_date_options;
		global $total_rows;
		?>
			<script>
				jQuery(document).ready(function(){
					jQuery('#personecheleggonoadesso').hide('slow');
					<?php if(($floating_related_posts_by_views_or_date_options['active_status_0']==='active_status_0') || ($total_rows<=0)) { ?>
						setInterval(function() {
							if(!disable_onClose) {
								<?php floating_related_posts_get_random_post_by_language(); ?>
								let nrPersone = (Math.floor(Math.random() * 11) + 2);
								<?php if (!wp_is_mobile()) { ?>
									// Desktop device
									<?php if(($floating_related_posts_by_views_or_date_options['desktop_visibility_1']==='desktop_visibility_1') || ($total_rows<=0)) { ?>
										jQuery('#a0001').attr('href','<?php echo esc_url($Url_picked_post); ?>');
										jQuery('#a0001').attr('alt',"<?php echo esc_html(str_replace("'","`",$Title_picked_post)); ?>");
										jQuery('#s0001').replaceWith('<span id="s0001"><?php echo esc_html(trim(str_replace("'","`",$Title_picked_post))); ?></span>');
										jQuery('#Persone').html(nrPersone+'&nbsp;<i style="font-size:16px; color:black;" class="fa fa-user"></i>&nbsp;Online');
										jQuery('#e0001').replaceWith('<span id="e0001"><?php echo trim(str_replace("'","`",$Excerpt_picked_post)); ?></span>');
									<?php } ?>
								<?php } else {?>
									// Mobile device
									<?php if(($floating_related_posts_by_views_or_date_options['mobile_visibility_2']==='mobile_visibility_2') || ($total_rows<=0)) { ?>
										jQuery('#a0001').attr('href','<?php echo esc_url($Url_picked_post); ?>');
										jQuery('#a0001').attr('alt',"<?php echo esc_html(str_replace("'","`",$Title_picked_post)); ?>");
										jQuery('#s0001').replaceWith('<span id="s0001"><?php echo esc_html(trim(str_replace("'","`",$Title_picked_post))); ?></span>');
										jQuery('#Persone').html(nrPersone+'&nbsp;<i style="font-size:16px; color:black;" class="fa fa-user"></i>&nbsp;Online');
										jQuery('#e0001').replaceWith('<span id="e0001"><?php echo trim(str_replace("'","`",$Excerpt_picked_post)); ?></span>');
									<?php } ?>
								<?php } ?>
								jQuery('#personecheleggonoadesso').show('slow');
								setTimeout(() => { 
													jQuery('#personecheleggonoadesso').hide('slow'); 
												 }, <?php echo esc_attr($Seconds_For_Deactivation); ?>);
							}
						}, <?php echo esc_attr($Seconds_For_Activation); ?>);
					<?php } ?>
				});
			</script>
		<?php
	}
	add_action('wp_head', 'floating_related_posts_add_Code_Javascript_in_tag_head');
}

/**
 * Create HTML code to include in the BODY tag.
 */
if(!function_exists('floating_related_posts_add_Code_html_in_tag_body')) {
	function floating_related_posts_add_Code_html_in_tag_body() {
		global $Horizontal_Position;
		global $Vertical_Position;
		global $Background_Color;
		global $Excerpt_Color;
		global $MAX_WIDTH;
		global $floating_related_posts_by_views_or_date_options;
		global $Opacity;
		global $total_rows;
		
		/**
		 * Create the link to read the plugin help
		 */
		$locale = get_locale();
		if ( function_exists( 'pll_current_language' ) || isset($_COOKIE[ 'pll_language' ]) ) {
			$locale = isset($_COOKIE['pll_language']) ? $_COOKIE['pll_language'] : pll_current_language();	
			if(isset($locale)) $locale = $locale . '_';		
		}	
		$urlPluginGuide='https://www.phpcodewizard.it/antoniolamorgese';
		try {
			if(isset($locale)) {
				if (strpos($locale, 'it_') !== false) {
					$post_title='come-aumentare-il-traffico-di-un-sito-web-con-un-plugin-wordpress';
					$urlPluginGuide=$urlPluginGuide . '/come-aumentare-il-traffico-di-un-sito-web-con-un-plugin-wordpress';
				} else if (strpos($locale, 'en_') !== false) {
					$post_title='how-to-increase-website-traffic-with-an-plugin-wordPress';
					$urlPluginGuide=$urlPluginGuide . '/en/how-to-increase-website-traffic-with-an-plugin-wordPress';
				} else if (strpos($locale, 'es_') !== false) {
					$post_title='como-aumentar-trafico-web-con-un-plugin-wordpress';
					$urlPluginGuide=$urlPluginGuide . '/es/como-aumentar-trafico-web-con-un-plugin-wordpress';
				} else if (strpos($locale, 'de_') !== false) {
					$post_title='so-steigern-sie-den-website-traffic-mit-einem-wordpress-plugin';
					$urlPluginGuide=$urlPluginGuide . '/de/so-steigern-sie-den-website-traffic-mit-einem-wordpress-plugin';
				} else if (strpos($locale, 'pt_') !== false) {
					$post_title='como-aumentar-o-trafego-do-site-com-um-plugin-wordpress';
					$urlPluginGuide=$urlPluginGuide . '/pt/como-aumentar-o-trafego-do-site-com-um-plugin-wordpress';
				} else if (strpos($locale, 'fr_') !== false) {
					$post_title='comment-augmenter-le-trafic-web-avec-un-plugin-wordPress';
					$urlPluginGuide=$urlPluginGuide . '/fr/comment-augmenter-le-trafic-web-avec-un-plugin-wordPress';
				} else {
					$post_title='how-to-increase-website-traffic-with-an-plugin-wordPress';
					$urlPluginGuide=$urlPluginGuide . '/en/how-to-increase-website-traffic-with-an-plugin-wordPress';
				}
			} else {
				$post_title='how-to-increase-website-traffic-with-an-plugin-wordPress';
				$urlPluginGuide=$urlPluginGuide . '/en/how-to-increase-website-traffic-with-an-plugin-wordPress';
			}
		} catch(Exception $e) {
			$urlPluginGuide='https://wordpress.org/plugins/floating-related-posts-by-views-or-publish-date/';
		}
		if (!wp_is_mobile()) { ?>
			<!-- Desktop device -->
			<?php if(($floating_related_posts_by_views_or_date_options['desktop_visibility_1']==='desktop_visibility_1') || ($total_rows<=0)) { ?>
				<div id="personecheleggonoadesso" style="z-index: 9999; opacity: <?php echo esc_html($Opacity); ?>; max-width: 450px; border: 1px solid <?php echo esc_html($Background_Color); ?>; border-radius: 8px; background-color: <?php echo esc_html($Background_Color); ?>; position: fixed; <?php echo esc_attr($Vertical_Position); ?>: 10px; <?php echo esc_attr($Horizontal_Position); ?>: 0px;">
					<p>
						<a  onclick="window.location.replace('<?php echo esc_url($urlPluginGuide); ?>');" 
							href="#" class="close" data-dismiss="alert" aria-label="close"><i style="font-size:16px; color:black;" class="fa fa-link" aria-hidden="true"></i>&nbsp;
						</a>
						<a  onclick="jQuery('#personecheleggonoadesso').hide('slow'); disable_onClose = true;" 
							href="#" class="close" data-dismiss="alert" aria-label="close"><i style="font-size:16px; color:black;" class="fa fa-times" aria-hidden="true"></i>&nbsp;<br 
							style="margin-bottom:2px; line-height:3px; font-size: 2px;">
						</a>
						&nbsp;<strong style="color: <?php echo esc_html($Excerpt_Color); ?>;" id="Persone"></strong>
						&nbsp;<span style="color: <?php echo esc_html($Excerpt_Color); ?>;" id="p0001"></span>&nbsp;
						<br>&nbsp;<b style="color: <?php echo esc_html($Excerpt_Color); ?>;" id="b0001"></b>
						<i style="font-size:16px; color:black;" class="fa fa-share"></i>&nbsp;
						<a id="a0001" target="_blank" href="#" alt=""><span id="s0001"></span></a>&nbsp;
						<span id="e0001"></span>
					</p>
				</div>
			<?php } ?>
		<?php } else { ?>
			<!-- Mobile device -->
			<?php if(($floating_related_posts_by_views_or_date_options['mobile_visibility_2']==='mobile_visibility_2') || ($total_rows<=0)) { ?>
				<div id="personecheleggonoadesso" style="z-index: 9999; opacity: <?php echo esc_html($Opacity); ?>; max-width: 450px; border: 1px solid <?php echo esc_html($Background_Color); ?>; border-radius: 8px; background-color: <?php echo esc_html($Background_Color); ?>; position: fixed; <?php echo esc_html($Vertical_Position); ?>: 10px; <?php echo esc_html($Horizontal_Position); ?>: 0px;">
					<p>
						<a style="float:right;" onclick="window.location.replace('<?php echo esc_url($urlPluginGuide); ?>');" 
							href="#" class="close" data-dismiss="alert" aria-label="close"><i style="font-size:16px; color:black;" class="fa fa-link" aria-hidden="true"></i>&nbsp;
						</a>
						<a style="float:right;" onclick="jQuery('#personecheleggonoadesso').hide('slow'); disable_onClose = true;" 
							href="#" class="close" data-dismiss="alert" aria-label="close"><i style="style="font-size:16px; color:black;" class="fa fa-times" aria-hidden="true"></i>&nbsp;<br 
							style="margin-bottom:2px; line-height:3px; font-size: 2px;">
						</a>
						&nbsp;<strong style="color: <?php echo esc_html($Excerpt_Color); ?>;" id="Persone"></strong>
						&nbsp;<span style="color: <?php echo esc_html($Excerpt_Color); ?>;" id="p0001"></span>&nbsp;
						<br>&nbsp;<b style="color: <?php echo esc_html($Excerpt_Color); ?>;" id="b0001"></b>
						<i style="font-size:16px; color:black;" class="fa fa-share"></i>&nbsp;
						<a id="a0001" target="_blank" href="#" alt=""><span id="s0001"></span></a>
						<span id="e0001"></span>
					</p>
				</div>
			<?php } ?>
		<?php } 
	}	
	add_action('wp_footer', 'floating_related_posts_add_Code_html_in_tag_body');
}	

