<?php
/**
 * Floating Related Posts by Views or Publish Date Admin Page
 *
 * @author    Antonio Lamorgese <antonio.lamorgese@gmail.com>
 * @copyright 2023 Antonio Lamorgese
 * @license   GNU General Public License v3.0
 * @link      https://github.com/antoniolamorgese/Floating-Related-Posts-by-Views-or-Publish-Date
 * @see https://jeremyhixon.com/tool/wordpress-option-page-generator/
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if(! class_exists('FloatingRelatedPostsByViewsOrDate')){
	class FloatingRelatedPostsByViewsOrDate {
		private $floating_related_posts_by_views_or_date_options;
		private $addDefaultValues;
		public function __construct() {
			global $wpdb;
			$this->$addDefaultValues=0;
			$this->$dirPathPlugin=$DirPlugin;
			$total_rows = $wpdb->get_var("select count(option_value) from wp_options where option_name  = 'floating_related_posts_by_views_or_date_option_name'");
			if ($total_rows <= 0) {
				$this->$addDefaultValues=1;
			}

			add_action( 'admin_menu', array( $this, 'floating_related_posts_by_views_or_date_add_plugin_page' ) );
			add_action( 'admin_init', array( $this, 'floating_related_posts_by_views_or_date_page_init' ) );
		}

		public function floating_related_posts_by_views_or_date_add_plugin_page() {
			add_options_page(
				'Floating Related Posts by Views or Date', // page_title
				'Floating Related Posts by Views or Date', // menu_title
				'manage_options', // capability
				'floating-related-posts-by-views-or-date', // menu_slug
				array( $this, 'floating_related_posts_by_views_or_date_create_admin_page' ) // function
			);
		}

		public function floating_related_posts_by_views_or_date_create_admin_page() {
			$this->floating_related_posts_by_views_or_date_options = get_option( 'floating_related_posts_by_views_or_date_option_name' ); ?>

			<div class="wrap">
				<h2>Floating Related Posts by Views or Publish Date</h2>
				<p><?php _e("Increase website traffic free using Floating Related Posts by Views or Publish Date. Show Floating Related Posts at the bottom or top of your visitor screen. If the <a target='_blank' href='https://wordpress.org/plugins/polylang/' alt='Polylang Plugin Page'>Polylang</a> and <a target='_blank' href='https://wordpress.org/plugins/wp-postviews/' alt='Wp PostViews Plugin Page'>WP PostViews</a> plugins are installed <b>Floating Related Posts by Views or Publish Date</b> will randomly fetch all the most visited posts in the current language. Otherwise, the most recent posts will be shown randomly.","floating-related-posts-by-views-or-publish-date"); ?></p>
				<?php settings_errors(); ?>
				<table>
					<tr>
						<td>
							<form method="post" action="options.php">
								<?php
									settings_fields( 'floating_related_posts_by_views_or_date_option_group' );
									do_settings_sections( 'floating-related-posts-by-views-or-date-admin' );
									submit_button();
								?>
							</form>
						</td>
						<td>
							<?php if(!wp_is_mobile()) { ?>
								<img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . 'assets/desktop-and-mobile-device.png'); ?>" alt="screenshot desktop and mobile device" />
							<?php } else { ?>
								<img src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . 'assets/mobile-device.png'); ?>" alt="screenshot only mobile device" />
							<?php } ?>
						</td>
					</tr>	
				</table>	
			</div>
		<?php }

		public function floating_related_posts_by_views_or_date_page_init() {
			register_setting(
				'floating_related_posts_by_views_or_date_option_group', // option_group
				'floating_related_posts_by_views_or_date_option_name', // option_name
				array( $this, 'floating_related_posts_by_views_or_date_sanitize' ) // sanitize_callback
			);

			add_settings_section(
				'floating_related_posts_by_views_or_date_setting_section', // id
				esc_html__('Settings', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'floating_related_posts_by_views_or_date_section_info' ), // callback
				'floating-related-posts-by-views-or-date-admin' // page
			);
            
			add_settings_field(
				'active_status_0', // id
				esc_html__('Active Status:', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'active_status_0_callback' ), // callback
				'floating-related-posts-by-views-or-date-admin', // page
				'floating_related_posts_by_views_or_date_setting_section' // section
			);

			add_settings_field(
				'desktop_visibility_1', // id
				esc_html__('Desktop Visibility:', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'desktop_visibility_1_callback' ), // callback
				'floating-related-posts-by-views-or-date-admin', // page
				'floating_related_posts_by_views_or_date_setting_section' // section
			);

			add_settings_field(
				'mobile_visibility_2', // id
				esc_html__('Mobile Visibility:', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'mobile_visibility_2_callback' ), // callback
				'floating-related-posts-by-views-or-date-admin', // page
				'floating_related_posts_by_views_or_date_setting_section' // section
			);

			add_settings_field(
				'excerpt_3', // id
				esc_html__('Excerpt:', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'excerpt_3_callback' ), // callback
				'floating-related-posts-by-views-or-date-admin', // page
				'floating_related_posts_by_views_or_date_setting_section' // section
			);

			add_settings_field(
				'background_color_4', // id
				esc_html__('Background Color:', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'background_color_4_callback' ), // callback
				'floating-related-posts-by-views-or-date-admin', // page
				'floating_related_posts_by_views_or_date_setting_section' // section
			);

			add_settings_field(
				'vertical_position_5', // id
				esc_html__('Vertical Position:', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'vertical_position_5_callback' ), // callback
				'floating-related-posts-by-views-or-date-admin', // page
				'floating_related_posts_by_views_or_date_setting_section' // section
			);

			add_settings_field(
				'horizontal_position_6', // id
				esc_html__('Horizontal Position:', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'horizontal_position_6_callback' ), // callback
				'floating-related-posts-by-views-or-date-admin', // page
				'floating_related_posts_by_views_or_date_setting_section' // section
			);

			add_settings_field(
				'opacity_7', // id
				esc_html__('Opacity:', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'opacity_7_callback' ), // callback
				'floating-related-posts-by-views-or-date-admin', // page
				'floating_related_posts_by_views_or_date_setting_section' // section
			);

			add_settings_field(
				'seconds_to_activation_8', // id
				esc_html__('Seconds To Activation:', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'seconds_to_activation_8_callback' ), // callback
				'floating-related-posts-by-views-or-date-admin', // page
				'floating_related_posts_by_views_or_date_setting_section' // section
			);

			add_settings_field(
				'seconds_to_deactivation_9', // id
				esc_html__('Seconds To Deactivation:', 'floating-related-posts-by-views-or-publish-date'), // title
				array( $this, 'seconds_to_deactivation_9_callback' ), // callback
				'floating-related-posts-by-views-or-date-admin', // page
				'floating_related_posts_by_views_or_date_setting_section' // section
			);
		}

		public function floating_related_posts_by_views_or_date_sanitize($input) {
			$sanitary_values = array();
			if ( isset( $input['active_status_0'] ) ) {
				$sanitary_values['active_status_0'] = $input['active_status_0'];
			}

			if ( isset( $input['desktop_visibility_1'] ) ) {
				$sanitary_values['desktop_visibility_1'] = $input['desktop_visibility_1'];
			}

			if ( isset( $input['mobile_visibility_2'] ) ) {
				$sanitary_values['mobile_visibility_2'] = $input['mobile_visibility_2'];
			}

			if ( isset( $input['excerpt_3'] ) ) {
				$sanitary_values['excerpt_3'] = $input['excerpt_3'];
			}

			if ( isset( $input['background_color_4'] ) ) {
				$sanitary_values['background_color_4'] = $input['background_color_4'];
			}

			if ( isset( $input['vertical_position_5'] ) ) {
				$sanitary_values['vertical_position_5'] = $input['vertical_position_5'];
			}

			if ( isset( $input['horizontal_position_6'] ) ) {
				$sanitary_values['horizontal_position_6'] = $input['horizontal_position_6'];
			}

			if ( isset( $input['opacity_7'] ) ) {
				$sanitary_values['opacity_7'] = $input['opacity_7'];
			}

			if ( isset( $input['seconds_to_activation_8'] ) ) {
				$sanitary_values['seconds_to_activation_8'] = $input['seconds_to_activation_8'];
			}

			if ( isset( $input['seconds_to_deactivation_9'] ) ) {
				$sanitary_values['seconds_to_deactivation_9'] = $input['seconds_to_deactivation_9'];
			}

			return $sanitary_values;
		}

		public function floating_related_posts_by_views_or_date_section_info() {
			
		}

		public function active_status_0_callback() {
			printf(
				'<input type="checkbox" name="floating_related_posts_by_views_or_date_option_name[active_status_0]" id="active_status_0" value="active_status_0" %s> <label for="active_status_0">'.esc_html__('Enable Plugin', 'floating-related-posts-by-views-or-publish-date').'</label>',
				(($this->$addDefaultValues==1) || ( isset( $this->floating_related_posts_by_views_or_date_options['active_status_0'] ) && $this->floating_related_posts_by_views_or_date_options['active_status_0'] === 'active_status_0' )) ? 'checked' : ''
			);
		}

		public function desktop_visibility_1_callback() {
			printf(
				'<input type="checkbox" name="floating_related_posts_by_views_or_date_option_name[desktop_visibility_1]" id="desktop_visibility_1" value="desktop_visibility_1" %s> <label for="desktop_visibility_1">'.esc_html__('Enable Desktop Visibility', 'floating-related-posts-by-views-or-publish-date').'</label>',
				(($this->$addDefaultValues==1) || ( isset( $this->floating_related_posts_by_views_or_date_options['desktop_visibility_1'] ) && $this->floating_related_posts_by_views_or_date_options['desktop_visibility_1'] === 'desktop_visibility_1' )) ? 'checked' : ''
			);
		}

		public function mobile_visibility_2_callback() {
			printf(
				'<input type="checkbox" name="floating_related_posts_by_views_or_date_option_name[mobile_visibility_2]" id="mobile_visibility_2" value="mobile_visibility_2" %s> <label for="mobile_visibility_2">'.esc_html__('Enable Mobile Visibility', 'floating-related-posts-by-views-or-publish-date').'</label>',
				(($this->$addDefaultValues==1) || ( isset( $this->floating_related_posts_by_views_or_date_options['mobile_visibility_2'] ) && $this->floating_related_posts_by_views_or_date_options['mobile_visibility_2'] === 'mobile_visibility_2' )) ? 'checked' : ''
			);
		}

		public function excerpt_3_callback() {
			printf(
				'<input type="checkbox" name="floating_related_posts_by_views_or_date_option_name[excerpt_3]" id="excerpt_3" value="excerpt_3" %s> <label for="excerpt_3">'.esc_html__('Excerpt include into banner', 'floating-related-posts-by-views-or-publish-date').'</label>',
				(($this->$addDefaultValues==1) || ( isset( $this->floating_related_posts_by_views_or_date_options['excerpt_3'] ) && $this->floating_related_posts_by_views_or_date_options['excerpt_3'] === 'excerpt_3' )) ? 'checked' : ''
			);
		}

		public function background_color_4_callback() {
			?> <select name="floating_related_posts_by_views_or_date_option_name[background_color_4]" id="background_color_4">
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['background_color_4'] ) && 
				$this->floating_related_posts_by_views_or_date_options['background_color_4'] === '#f8d7da') ? 'selected' : '' ; ?>
				<option value="#f8d7da" <?php echo $selected; ?>>Danger</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['background_color_4'] ) && $this->floating_related_posts_by_views_or_date_options['background_color_4'] === '#e2e3e5') ? 'selected' : '' ; ?>
				<option value="#e2e3e5" <?php echo $selected; ?>>Secondary</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['background_color_4'] ) && $this->floating_related_posts_by_views_or_date_options['background_color_4'] === '#d4edda') ? 'selected' : '' ; ?>
				<option value="#d4edda" <?php echo $selected; ?>>Success</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['background_color_4'] ) && 
				$this->floating_related_posts_by_views_or_date_options['background_color_4'] === '#cce5ff') ? 'selected' : '' ; ?>
				<option value="#cce5ff" <?php echo $selected; ?>>Primary</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['background_color_4'] ) && $this->floating_related_posts_by_views_or_date_options['background_color_4'] === '#fff3cd') ? 'selected' : '' ; ?>
				<option value="#fff3cd" <?php echo $selected; ?>>Warning</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['background_color_4'] ) && $this->floating_related_posts_by_views_or_date_options['background_color_4'] === '#d1ecf1') ? 'selected' : '' ; ?>
				<option value="#d1ecf1" <?php echo $selected; ?>>Info</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['background_color_4'] ) && $this->floating_related_posts_by_views_or_date_options['background_color_4'] === '#fefefe') ? 'selected' : '' ; ?>
				<option value="#fefefe" <?php echo $selected; ?>>Light</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['background_color_4'] ) && $this->floating_related_posts_by_views_or_date_options['background_color_4'] === '#d6d8d9') ? 'selected' : '' ; ?>
				<option value="#d6d8d9" <?php echo $selected; ?>>Dark</option>
			</select>&nbsp;<a href="https://getbootstrap.com/docs/4.0/components/alerts/" alt="Go to Bootstrap Alerts Color" target="_blank"><?php esc_html_e('Go to Bootstrap 4 Alerts Color Code...', 'floating-related-posts-by-views-or-publish-date'); ?></a>
			<?php
		}

		public function vertical_position_5_callback() {
			?> <select name="floating_related_posts_by_views_or_date_option_name[vertical_position_5]" id="vertical_position_5">
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['vertical_position_5'] ) && $this->floating_related_posts_by_views_or_date_options['vertical_position_5'] === 'top') ? 'selected' : '' ; ?>
				<option value="top" <?php echo $selected; ?>>Top</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['vertical_position_5'] ) && $this->floating_related_posts_by_views_or_date_options['vertical_position_5'] === 'bottom') ? 'selected' : '' ; ?>
				<option value="bottom" <?php echo esc_attr($selected); ?>>Bottom</option>
			</select> <?php
		}

		public function horizontal_position_6_callback() {
			?> <select name="floating_related_posts_by_views_or_date_option_name[horizontal_position_6]" id="horizontal_position_6">
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['horizontal_position_6'] ) && $this->floating_related_posts_by_views_or_date_options['horizontal_position_6'] === 'right') ? 'selected' : '' ; ?>
				<option value="right" <?php echo $selected; ?>>Right</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['horizontal_position_6'] ) && $this->floating_related_posts_by_views_or_date_options['horizontal_position_6'] === 'left') ? 'selected' : '' ; ?>
				<option value="left" <?php echo $selected; ?>>Left</option>
			</select> <?php
		}

		public function opacity_7_callback() {
			?> <select name="floating_related_posts_by_views_or_date_option_name[opacity_7]" id="opacity_7">
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['opacity_7'] ) && $this->floating_related_posts_by_views_or_date_options['opacity_7'] === 'None') ? 'selected' : '' ; ?>
				<option value="None" <?php echo $selected; ?>>None</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['opacity_7'] ) && $this->floating_related_posts_by_views_or_date_options['opacity_7'] === 'Low') ? 'selected' : '' ; ?>
				<option value="Low" <?php echo $selected; ?>>Low</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['opacity_7'] ) && $this->floating_related_posts_by_views_or_date_options['opacity_7'] === 'Medium') ? 'selected' : '' ; ?>
				<option value="Medium" <?php echo $selected; ?>>Medium</option>
				<?php $selected = (isset( $this->floating_related_posts_by_views_or_date_options['opacity_7'] ) && $this->floating_related_posts_by_views_or_date_options['opacity_7'] === 'High') ? 'selected' : '' ; ?>
				<option value="High" <?php echo $selected; ?>>High</option>
			</select>&nbsp;<label for="opacity_7"><br /><?php esc_html_e('(Transparency level)', 'floating-related-posts-by-views-or-publish-date'); ?></label><?php
		}

		public function seconds_to_activation_8_callback() {
			printf(
				'<input min="15" max="120" maxlength="4" size="4" class="regular-text" type="text" name="floating_related_posts_by_views_or_date_option_name[seconds_to_activation_8]" id="seconds_to_activation_8" value="%s"><label for="seconds_to_activation_8"><br />'.esc_html__('Enter a value between 15 and 120.', 'floating-related-posts-by-views-or-publish-date').'</label>',
				isset( $this->floating_related_posts_by_views_or_date_options['seconds_to_activation_8'] ) ? esc_attr( $this->floating_related_posts_by_views_or_date_options['seconds_to_activation_8']) : '30'
			);
		}
		
		public function seconds_to_deactivation_9_callback() {
			printf(
				'<input min="15" max="120" maxlength="4" size="4" class="regular-text" type="text" name="floating_related_posts_by_views_or_date_option_name[seconds_to_deactivation_9]" id="seconds_to_deactivation_9" value="%s"><label for="seconds_to_deactivation_9"><br />'.esc_html__('Enter a value between 15 and 120.', 'floating-related-posts-by-views-or-publish-date').'</label>',
				isset( $this->floating_related_posts_by_views_or_date_options['seconds_to_deactivation_9'] ) ? esc_attr( $this->floating_related_posts_by_views_or_date_options['seconds_to_deactivation_9']) : '15'
			);
		}	
	}
}

if ( is_admin() ) {
	if(class_exists('FloatingRelatedPostsByViewsOrDate')) {
		$floating_related_posts_by_views_or_date = new FloatingRelatedPostsByViewsOrDate();
	}
}

/* 
 * Retrieve this value with:
 * $floating_related_posts_by_views_or_date_options = get_option( 'floating_related_posts_by_views_or_date_option_name' ); // Array of All Options
 * $active_status_0 = $floating_related_posts_by_views_or_date_options['active_status_0']; // Active Status:
 * $desktop_visibility_1 = $floating_related_posts_by_views_or_date_options['desktop_visibility_1']; // Desktop Visibility:
 * $mobile_visibility_2 = $floating_related_posts_by_views_or_date_options['mobile_visibility_2']; // Mobile Visibility:
 * $excerpt_3 = $floating_related_posts_by_views_or_date_options['excerpt_3']; // Excerpt:
 * $Background_Color_4 = $floating_related_posts_by_views_or_date_options['background_color_4']; // Background Color:
 * $Vertical_Position_5 = $floating_related_posts_by_views_or_date_options['vertical_position_5']; // Vertical Position:
 * $Horizontal_Position_6 = $floating_related_posts_by_views_or_date_options['horizontal_position_6']; // Horizontal Position:
 * $opacity_7 = $floating_related_posts_by_views_or_date_options['opacity_7']; // Opacity Position:
 * $seconds_to_activation_8 = $floating_related_posts_by_views_or_date_options['seconds_to_activation_8']; // seconds to activation:
 * $seconds_to_deactivation_9 = $floating_related_posts_by_views_or_date_options['seconds_to_deactivation_9']; // seconds to deactivation:
 */
