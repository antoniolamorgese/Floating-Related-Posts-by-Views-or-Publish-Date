<?php
ob_start();
/**
* Floating Related Posts by Views or Publish Date
* 
* @author    Antonio Lamorgese <antonio.lamorgese@gmail.com>
* @copyright 2023 Antonio Lamorgese
* @license   GNU General Public License v3.0
* @link      https://github.com/antoniolamorgese/display-popup-popular-post-by-views
*/ 

/**
* Plugin Name:        Floating Related Posts by Views or Publish Date
* Plugin URI:         https://github.com/antoniolamorgese/display-popup-popular-post-by-views
* Description:        Increase website traffic free using "Floating Related Posts by Views or Publish Date". Show Floating Related Posts at the bottom or top of your visitor screen. Start <a href="options-general.php?page=floating-related-posts-by-views-or-date">Floating Related Posts Views or Publish Date settings</a>.
* Author:             Antonio Lamorgese
* Author URI:         http://www.phpcodewizard.it/antoniolamorgese/en/
* Version:            1.3.1
* License:            GNU General Public License v3.0
* License URI:        https://www.gnu.org/licenses/gpl-3.0.html
* Text Domain:        display-popup-popular-post-by-views-or-date
* GitHub Plugin URI:  https://github.com/antoniolamorgese/display-popup-popular-post-by-views
* Requires at least:  5.6
* Tested up to:       6.1
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
* Add link "Settings" in Wordpress administration Plugin
*/
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'floating_related_posts_status_link' );
function floating_related_posts_status_link ( $links ) {
	$mylinks1 = array('<a href="' . admin_url( 'options-general.php?page=floating-related-posts-by-views-or-date' ) . '">Settings</a>');
	return array_merge( $links, $mylinks1 );
}

/** 
* Add Code in Wordpress Settings for get option settings Plugin
* Code Generated with "WordPress Option Page Generator" <https://jeremyhixon.com/tool/wordpress-option-page-generator/>
*/
include_once(plugin_dir_path( __FILE__ ) . 'admin/floating-related-posts-by-views-or-date-admin.php');
$floating_related_posts_by_views_or_date_options = get_option( 'floating_related_posts_by_views_or_date_option_name' );

/** 
* Verify that the plugin setup has already been done. 
*/
global $wpdb;
$total_rows = $wpdb->get_var("select count(option_value) from wp_options where option_name  = 'floating_related_posts_by_views_or_date_option_name'");

/**
* Set the global variables and constants.
*/
$URL_picked_post;
$TITLE_picked_post;
$EXCERPT_picked_post;

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
$VERTICAL_POSITION = 'top';
if ($total_rows > 0) {
	if(strlen($floating_related_posts_by_views_or_date_options['vertical_position_5'])>=3) {
		$VERTICAL_POSITION = $floating_related_posts_by_views_or_date_options['vertical_position_5'];
	} else {
		$VERTICAL_POSITION = 'top';
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
$HORIZONTAL_POSITION = 'right';
if ($total_rows > 0) {
	if(strlen($floating_related_posts_by_views_or_date_options['horizontal_position_6'])>=4) {
		$HORIZONTAL_POSITION = $floating_related_posts_by_views_or_date_options['horizontal_position_6'];
	} else {
		$HORIZONTAL_POSITION = 'right';
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
$BACKGROUND_COLOR = '#F8D7DA'; 
if ($total_rows > 0) {
	if (
			(isset($floating_related_posts_by_views_or_date_options['background_color_4'])) && 
			(strlen($floating_related_posts_by_views_or_date_options['background_color_4'])>=7) 
	) {
		$BACKGROUND_COLOR = $floating_related_posts_by_views_or_date_options['background_color_4']; 
	} else {
		$BACKGROUND_COLOR = '#F8D7DA'; 
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
if(strtolower($BACKGROUND_COLOR) == '#cce5ff') {
	// primary cyan
	$EXCERPT_COLOR = 'RoyalBlue'; 
} else if(strtolower($BACKGROUND_COLOR) == '#e2e3e5') {
	// secondary
	$EXCERPT_COLOR = 'DimGray'; 
} else if(strtolower($BACKGROUND_COLOR) == '#d4edda') {
	// success
	$EXCERPT_COLOR = 'LightSeaGreen'; 
} else if(strtolower($BACKGROUND_COLOR) == '#f8d7da') {
	// danger
	$EXCERPT_COLOR = 'brown'; 
} else if(strtolower($BACKGROUND_COLOR) == '#fff3cd') {
	// warning
	$EXCERPT_COLOR = 'DimGray'; 
} else if(strtolower($BACKGROUND_COLOR) == '#d1ecf1') {
	// info
	$EXCERPT_COLOR = 'RoyalBlue'; 
} else if(strtolower($BACKGROUND_COLOR) == '#fefefe') {
	// light
	$EXCERPT_COLOR = 'DimGray'; 
} else if(strtolower($BACKGROUND_COLOR) == '#d6d8d9') {
	// dark
	$EXCERPT_COLOR = 'black'; 
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
$ADD_EXCERPT = 'YES';
if ($total_rows > 0) {
	if($floating_related_posts_by_views_or_date_options['excerpt_3']=='excerpt_3') {
		$ADD_EXCERPT = 'YES'; 
	} else {
		$ADD_EXCERPT = 'NO'; 
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
$OPACITY = 1;
if ($total_rows > 0) {
	if(strlen($floating_related_posts_by_views_or_date_options['opacity_7'])>=3) {
		$OPACITY = strtoupper($floating_related_posts_by_views_or_date_options['opacity_7']);
		if($OPACITY == 'HIGH') {
			// High
			$OPACITY = 0.65;
		} else if($OPACITY == 'MEDIUM') {
			// Medium
			$OPACITY = 0.75;
		} else if($OPACITY == 'LOW') {
			// Low
			$OPACITY = 0.80;
		} else if($OPACITY == 'NONE') {
			// Low
			$OPACITY = 1;
		} else {
			$OPACITY = 1;
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
$MIN_ACTIVATION = 15;
$MAX_ACTIVATION  = 120;
$SECONDS_FOR_ACTIVATION = 30;
if($total_rows>0){
   if(isset($floating_related_posts_by_views_or_date_options['seconds_to_activation_8'])) {
		if(intval($floating_related_posts_by_views_or_date_options['seconds_to_activation_8'])>0) {
			$SECONDS_FOR_ACTIVATION = intval($floating_related_posts_by_views_or_date_options['seconds_to_activation_8']);
		}
   }
}
if($SECONDS_FOR_ACTIVATION<$MIN_ACTIVATION ) $SECONDS_FOR_ACTIVATION = $MIN_ACTIVATION;
if($SECONDS_FOR_ACTIVATION>$MAX_ACTIVATION ) $SECONDS_FOR_ACTIVATION = $MAX_ACTIVATION;
$SECONDS_FOR_ACTIVATION = $SECONDS_FOR_ACTIVATION*1000;

/**
*	------------------------------------------------
* 	TIME FOR DEACTIVATION (min 15 secs max 120 secs)
*	------------------------------------------------
*
*   Valid options:
*   
*   Enter values between 15 and 120
*/	
$MIN_DEACTIVATION = 15;
$MAX_DEACTIVATION  = 120;
$SECONDS_FOR_DEACTIVATION = 15;
if($total_rows>0){
	if(isset($floating_related_posts_by_views_or_date_options['seconds_to_deactivation_9'])) {
		 if(intval($floating_related_posts_by_views_or_date_options['seconds_to_deactivation_9'])>0) {
			 $SECONDS_FOR_DEACTIVATION = intval($floating_related_posts_by_views_or_date_options['seconds_to_deactivation_9']);
		 }
	}
}
if($SECONDS_FOR_DEACTIVATION<$MIN_DEACTIVATION) $SECONDS_FOR_DEACTIVATION = $MIN_DEACTIVATION;
if($SECONDS_FOR_DEACTIVATION>$MAX_DEACTIVATION) $SECONDS_FOR_DEACTIVATION = $MAX_DEACTIVATION;
$SECONDS_FOR_DEACTIVATION = $SECONDS_FOR_DEACTIVATION*1000;

/**
*	---------------------------------------------------
* 	Disable Floating Related Posts plugin onClose event
*	---------------------------------------------------
*/	
add_action('wp_head', function() {
	?>
		<script>var disable_onClose = false;</script>
	<?php
});

/**
* Get random popular post by current language if Polylang is installed.
*/
function get_random_post_by_language() {
	global $URL_picked_post;
	global $TITLE_picked_post;
	global $EXCERPT_picked_post;
	global $ADD_EXCERPT;
	global $EXCERPT_COLOR;
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
						$URL_picked_post = get_the_permalink();
						$TITLE_picked_post = get_the_title();
						$EXCERPT_picked_post = '';
						if($ADD_EXCERPT=='YES') {
							if(has_excerpt()) {
								$EXCERPT_picked_post = '&nbsp;<p style="color: '.$EXCERPT_COLOR.'; line-height: 90%;">&nbsp;<i>"'.get_the_excerpt().'"</i></p>';
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
				$URL_picked_post = get_the_permalink();
				$TITLE_picked_post = get_the_title();
				$EXCERPT_picked_post = '';
				if($ADD_EXCERPT=='YES') {
					if(has_excerpt()) {
						$EXCERPT_picked_post = '<p style="color: '.$EXCERPT_COLOR.'; line-height: 90%;">&nbsp;<i>"'.get_the_excerpt().'"</i></p>';
					}
				}
				if($picked_post>=$nr_post_random) break;
				$picked_post++;
			}
		}	
		wp_reset_query();
	}
}

/**
* Create Javascript code to include in the HEAD tag.
*/
function add_Code_Javascript_in_tag_head() {
	global $URL_picked_post;
	global $TITLE_picked_post;
	global $EXCERPT_picked_post;
	global $HORIZONTAL_POSITION;
	global $VERTICAL_POSITION;
	global $ADD_EXCERPT;
	global $BACKGROUND_COLOR;
	global $SECONDS_FOR_ACTIVATION;
	global $SECONDS_FOR_DEACTIVATION;
	global $floating_related_posts_by_views_or_date_options;
	global $total_rows;
	?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script>
			jQuery(document).ready(function(){
				jQuery('#personecheleggonoadesso').hide('slow');
				<?php if(($floating_related_posts_by_views_or_date_options['active_status_0']=='active_status_0') || ($total_rows<=0)) { ?>
					setInterval(function() {
						if(!disable_onClose) {
							<?php get_random_post_by_language(); ?>
							let nrPersone = (Math.floor(Math.random() * 11) + 2);
							<?php if (!wp_is_mobile()) { ?>
								// Desktop device
								<?php if(($floating_related_posts_by_views_or_date_options['desktop_visibility_1']=='desktop_visibility_1') || ($total_rows<=0)) { ?>
									jQuery('#a0001').attr('href','<?php echo $URL_picked_post; ?>');
									jQuery('#a0001').attr('alt',"<?php echo str_replace("'","`",$TITLE_picked_post); ?>");
									jQuery('#s0001').replaceWith('<span id="s0001"><?php echo trim(str_replace("'","`",$TITLE_picked_post)); ?></span>');
									jQuery('#Persone').html(nrPersone+'&nbsp;<i style="font-size:16px; color:black;" class="fa fa-user"></i>&nbsp;Online');
									jQuery('#e0001').replaceWith('<span id="e0001"><?php echo trim(str_replace("'","`",$EXCERPT_picked_post)); ?></span>');
								<?php } ?>
							<?php } else {?>
								// Mobile device
								<?php if(($floating_related_posts_by_views_or_date_options['mobile_visibility_2']=='mobile_visibility_2') || ($total_rows<=0)) { ?>
									jQuery('#a0001').attr('href','<?php echo $URL_picked_post; ?>');
									jQuery('#a0001').attr('alt',"<?php echo str_replace("'","`",$TITLE_picked_post); ?>");
									jQuery('#s0001').replaceWith('<span id="s0001"><?php echo trim(str_replace("'","`",$TITLE_picked_post)); ?></span>');
									jQuery('#Persone').html(nrPersone+'&nbsp;<i style="font-size:16px; color:black;" class="fa fa-user"></i>&nbsp;Online');
								<?php } ?>
							<?php } ?>
							jQuery('#personecheleggonoadesso').show('slow');
							setTimeout(() => { 
													jQuery('#personecheleggonoadesso').hide('slow'); 
												}, <?php echo $SECONDS_FOR_DEACTIVATION; ?>);
						}
					}, <?php echo $SECONDS_FOR_ACTIVATION; ?>);
				<?php } ?>
			});
		</script>
	<?php
}
add_action('wp_head', 'add_Code_Javascript_in_tag_head');

/**
* Create HTML code to include in the BODY tag.
*/
function add_Code_html_in_tag_body() {
	global $HORIZONTAL_POSITION;
	global $VERTICAL_POSITION;
	global $BACKGROUND_COLOR;
	global $EXCERPT_COLOR;
	global $MAX_WIDTH;
	global $floating_related_posts_by_views_or_date_options;
	global $OPACITY;
	global $total_rows;
	if (!wp_is_mobile()) { ?>
	    <!-- Desktop device -->
		<?php if(($floating_related_posts_by_views_or_date_options['desktop_visibility_1']=='desktop_visibility_1') || ($total_rows<=0)) { ?>
			<div id="personecheleggonoadesso" style="z-index: 9999; opacity: <?php echo $OPACITY; ?>; max-width: 450px; border: 1px solid <?php echo $BACKGROUND_COLOR; ?>; border-radius: 8px; background-color: <?php echo $BACKGROUND_COLOR; ?>; position: fixed; <?php echo $VERTICAL_POSITION; ?>: 10px; <?php echo $HORIZONTAL_POSITION; ?>: 0px;">
				<p>
					<a  onclick="jQuery('#personecheleggonoadesso').hide('slow'); disable_onClose = true;" 
						href="#" class="close" data-dismiss="alert" aria-label="close">&times;&nbsp;<br 
						style="margin-bottom:2px; line-height:3px; font-size: 2px;">
					</a>
					&nbsp;<strong style="color: <?php echo $EXCERPT_COLOR; ?>;" id="Persone"></strong>
					&nbsp;<span style="color: <?php echo $EXCERPT_COLOR; ?>;" id="p0001"></span>&nbsp;
					<br>&nbsp;<b style="color: <?php echo $EXCERPT_COLOR; ?>;" id="b0001"></b>
					<i style="font-size:16px; color:black;" class="fa fa-share"></i>&nbsp;
					<a id="a0001" target="_blank" href="#" alt=""><span id="s0001"></span></a>&nbsp;
					<span id="e0001"></span>
				</p>
			</div>
		<?php } ?>
	<?php } else { ?>
	    <!-- Mobile device -->
		<?php if(($floating_related_posts_by_views_or_date_options['mobile_visibility_2']=='mobile_visibility_2') || ($total_rows<=0)) { ?>
			<div id="personecheleggonoadesso" style="z-index: 9999; opacity: <?php echo $OPACITY; ?>; max-width: 100%; border: 1px solid <?php echo $BACKGROUND_COLOR; ?>; border-radius: 8px; background-color: <?php echo $BACKGROUND_COLOR; ?>; position: fixed; <?php echo $VERTICAL_POSITION; ?>: 10px; <?php echo $HORIZONTAL_POSITION; ?>: 0px;">
				<p>
					<a  onclick="jQuery('#personecheleggonoadesso').hide('slow'); disable_onClose = true;" 
						href="#" class="close" data-dismiss="alert" aria-label="close">&times;&nbsp;<br 
						style="margin-bottom:2px; line-height:3px; font-size: 2px;">
					</a>
					&nbsp;<strong style="color: <?php echo $EXCERPT_COLOR; ?>;" id="Persone"></strong>
					&nbsp;<span style="color: <?php echo $EXCERPT_COLOR; ?>;" id="p0001"></span>&nbsp;
					<br>&nbsp;<b style="color: <?php echo $EXCERPT_COLOR; ?>;" id="b0001"></b>
					<i style="font-size:16px; color:black;" class="fa fa-share"></i>&nbsp;
					<a id="a0001" target="_blank" href="#" alt=""><span id="s0001"></span></a>
				</p>
			</div>
		<?php } ?>
	<?php } 
}	
add_action('wp_footer', 'add_Code_html_in_tag_body');
