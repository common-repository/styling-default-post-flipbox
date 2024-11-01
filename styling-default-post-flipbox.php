<?php
/**
Plugin Name: Styling Default Post Like Flipbox
Description: <strong>Styling Default Post Like Flipbox</strong>: An easy and quick way to showcase your default post like flipbox. Just activate and use the shortcode generater in classic editor.
Version: 2.0.0
Author: Dragon16
**/

if( !defined('ABSPATH') ){
	return;
}

define('FSDP_VERSION', '2.0.0');
define('FSDP_FILE', __FILE__);
define('FSDP_DIR', plugin_dir_path(FSDP_FILE));
define('FSDP_URL', plugin_dir_url(FSDP_FILE));

if( !class_exists( 'FSDP_post_design' ) ):
	class FSDP_post_design
	{

		function __construct()
		{
			$this->include_files();
			add_action('after_setup_theme', array($this, 'fsdp_add_ce_button'));
			foreach (array('post.php','post-new.php') as $hook) {
				add_action("admin_head-$hook", array( $this,'get_all_post_ids'));
			}
		}

		/*** Integrate shortcode generator in tinymce editor */
		public function fsdp_add_ce_button() {
			global $typenow;
			/*** check user permissions */
			if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
				return;
			} 
				
			/*** check if WYSIWYG is enabled */
			if ( get_user_option('rich_editing') == 'true') {
				add_filter("mce_external_plugins",array($this,"fsdp_tinymce_plugin"));
				add_filter('mce_buttons',array($this,'fsdp_register_ce_button'));
			}
		}

		public function fsdp_tinymce_plugin($plugin_array) 
		{
			$plugin_array['fsdp_ec_button'] = plugins_url( 'assets/js/shortcode-generator.js', __FILE__ ); 
			return $plugin_array;
		}

		public function fsdp_register_ce_button($buttons) {
		array_push($buttons, "fsdp_ec_button");
		return $buttons;
		}

		/**
		 * include required files
		 */
		function include_files()
		{
			require_once FSDP_DIR . 'includes/multi-post-thumbnails.php';
			require_once FSDP_DIR . 'includes/fsdp-classic-metabox.php';
			require_once FSDP_DIR . 'includes/fsdp-flip-head.php';
			require_once FSDP_DIR . 'includes/fsdp-render-design.php';
		}

		/**
		 * get all post ids to create a option panel
		 */
		function get_all_post_ids(){
			GLOBAL $post;
			$current_post = $post;

			$data = new WP_Query( array( 
					'post_type'=>'post',
					)
				);

				$post_id = [];
				$post_title = [];
				if( $data->have_posts() ){
					while( $data->have_posts() ){
						$data->the_post();
						$post_id[] = get_the_ID();
						$post_title[] = get_the_title();
					}
				}
				wp_reset_postdata();

				$post_id = json_encode( $post_id );
				$post_title = json_encode( $post_title );
			?>
			<!-- TinyMCE Shortcode Plugin -->
			<script type='text/javascript'>
				var fsdp_obj = {
					'post_id':'<?php echo $post_id; ?>',
					'post_title':'<?php echo $post_title ?>'
				};
			</script>
			<!-- TinyMCE Shortcode Plugin -->
			<?php
			$post = $current_post;
		}
	}
	
	new FSDP_post_design();

endif;