<?php
/**
 * 
 * This file is responsible for flipbox layout design rendering
 */
if( !defined('ABSPATH') ){
	return;
}

class fsdp_render_design{
	
	function __construct(){
		add_action( 'wp_enqueue_scripts', [$this, 'include_all_script'] );
		add_shortcode('fsdp-flipboxes', [$this, 'render_html'] );
	}
	
	/**
	 * render shortcode for flipbox
	 */
	function render_html( $atts, $content = null ){
		$attribute = shortcode_atts( array(
			'id'=>'',
			'order'=>'DESC',
			'limit'=>'10',
			'layout'=>''
		), $atts, 'fsdp-flipbox' );

		$order = isset( $attribute['order'] ) && !empty( $attribute['order'] ) ? $attribute['order'] : 'DESC';
		$post_id = isset( $attribute['id'] ) && !empty( $attribute['id'] ) && is_numeric( $attribute['id'] ) ? $attribute['id'] : '' ;
		$post_limit = isset( $attribute['limit'] ) && !empty( $attribute['limit'] ) ? $attribute['limit'] : '10';
		$post_limit = isset( $post_id ) && is_numeric( $post_id ) ? '1' : $post_limit;
		static $state = 0;
		$post_status = !empty( $post_id) ? get_post_status( $post_id ) : true;

		if( $post_status != 'publish' || $post_status !=true ){
			return 'Flipbox Error: Post Not Available';
		}

		$options = array(
					 'p' => $post_id,
					 'order' => $order,
					 'post_type'=>'post',
					 'posts_per_page'=>$post_limit
					);

		$post = new WP_Query( $options );
		
		if( $post->have_posts() ){
			$html = fsdp_flip_render::get_container_head();
			$post_count = 1;
			while( $post->have_posts() ):$post->the_post();
				
				$id = get_the_ID();
			
				$title_override = get_post_meta( $id , 'fsdp-flipbox-title', true);
				$title = isset( $title_override ) && !empty( $title_override)? $title_override : get_the_title();
				$back_title = get_post_meta( $id, 'fsdp-flipbox-back-title', true );
				$back_title = isset( $back_title ) && !empty( $back_title ) ? $back_title : $title;
				$feature_image = $this->get_other_featured_image_url( 'post', 'fsdp-flip-front-image' );
				$feature_image = !isset($feature_image) || empty( $feature_image ) ? get_the_post_thumbnail_url()  : $feature_image;
				$feature_image2 = $this->get_other_featured_image_url( 'post', 'fsdp-flip-back-image' );
				$front_subheading = get_post_meta( $id, 'fsdp-flipbox-front-subheading' , true );
				$excerpt = get_post_meta( $id, 'fsdp-flipbox-description' , true );
				$excerpt = isset( $excerpt ) && !empty( $excerpt ) ? $excerpt : get_the_excerpt();
				$width = get_post_meta( $id , 'fsdp-flipbox-width', true);
				$height = get_post_meta( $id , 'fsdp-flipbox-height', true);
				$link_text = get_post_meta( $id , 'fsdp-flipbox-link-label', true);
				$link_text = isset( $link_text ) && !empty( $link_text )? $link_text : 'Learn More';
				$link_href = get_post_meta( $id, 'fsdp-flipbox-link-href', true );
				$link_href = isset( $link_href ) && !empty($link_href)? $link_href : get_the_permalink();
				$fa_icon = get_post_meta( $id, 'fsdp-flipbox-fa-icon', true);
				$fa_icon = isset( $fa_icon ) && !empty( $fa_icon ) ? $fa_icon : 'fab fa-jira';
				$front_bgColor = get_post_meta( $id, 'fsdp-flipbox-front-bgColor', true);
				$front_bgColor = isset( $front_bgColor ) && !empty( $front_bgColor ) ? $front_bgColor : 'orange';
				$front_textColor = get_post_meta( $id, 'fsdp-flipbox-front-textColor', true);
				$back_bgColor = get_post_meta( $id, 'fsdp-flipbox-back-bgColor', true );
				$back_bgColor = isset( $back_bgColor ) && !empty( $back_bgColor ) ? $back_bgColor : 'green';
				$back_textColor = get_post_meta( $id, 'fsdp-flipbox-back-textColor', true );
				$heading_size = get_post_meta( $id, 'fsdp-flipbox-heading-size', true );
				$heading_size = isset( $heading_size ) && !empty( $heading_size ) ? $heading_size : 'h4';
				$flip_class = get_post_meta( $id, 'fsdp-flipbox-direction', true);
				$flip_class = isset( $flip_class ) && !empty( $flip_class ) ? $flip_class : 'flip-vertical-right';
				
				$bgImage_enable = get_post_meta( $id, 'fsdp-flipbox-bgImage-enable', true);
				$bgImage_enable = !empty( $bgImage_enable ) ? $bgImage_enable : 'true' ;
				$bgImage2_enable = get_post_meta( $id, 'fsdp-flipbox-bgImage2-enable', true);
				$bgImage2_enable = !empty( $bgImage2_enable ) ? $bgImage2_enable : 'true' ;
				
				$layout_type = strtolower( get_post_meta( $id, 'fsdp-flipbox-layout-type', true ) );
				$layout_type = isset( $attribute['layout'] ) && !empty( $attribute['layout'] ) ? 'fsdp-flipbox-' . $attribute['layout'] : $layout_type;  

				switch( $layout_type ){
					case 'fsdp-flipbox-layout-20':
						require FSDP_DIR . 'layouts/design-25.php';
					break;
					case 'fsdp-flipbox-layout-19':
						require FSDP_DIR . 'layouts/design-24.php';
					break;
					case 'fsdp-flipbox-layout-18':
						require FSDP_DIR . 'layouts/design-23.php';
					break;
					case 'fsdp-flipbox-layout-17':
						require FSDP_DIR . 'layouts/design-21.php';
					break;
					case 'fsdp-flipbox-layout-16':
						require FSDP_DIR . 'layouts/design-19.php';
					break;
					case 'fsdp-flipbox-layout-15':
						require FSDP_DIR . 'layouts/design-18.php';
					break;
					case 'fsdp-flipbox-layout-14':
						require FSDP_DIR . 'layouts/design-17.php';
					break;
					case 'fsdp-flipbox-layout-13':
						require FSDP_DIR . 'layouts/design-15.php';
					break;
					case 'fsdp-flipbox-layout-12':
						require FSDP_DIR . 'layouts/design-14.php';
					break;
					case 'fsdp-flipbox-layout-11':
						require FSDP_DIR . 'layouts/design-13.php';
					break;
					case 'fsdp-flipbox-layout-10':
						require FSDP_DIR . 'layouts/design-12.php';
					break;
					case 'fsdp-flipbox-layout-9':
						require FSDP_DIR . 'layouts/design-11.php';
					break;
					case 'fsdp-flipbox-layout-8':
						require FSDP_DIR . 'layouts/design-10.php';
					break;
					case 'fsdp-flipbox-layout-7':
						require FSDP_DIR . 'layouts/design-9.php';
					break;
					case 'fsdp-flipbox-layout-6':
						require FSDP_DIR . 'layouts/design-7.php';
					break;
					case 'fsdp-flipbox-layout-5':
						require FSDP_DIR . 'layouts/design-5.php';
					break;
					case 'fsdp-flipbox-layout-4':
						require FSDP_DIR . 'layouts/design-4.php';
					break;
					case 'fsdp-flipbox-layout-3':
						require FSDP_DIR . 'layouts/design-3.php';
					break;
					case 'fsdp-flipbox-layout-2':
						require FSDP_DIR . 'layouts/design-2.php';
					break;
					case 'fsdp-flipbox-layout-1':
					default:
						require FSDP_DIR . 'layouts/design-1.php';
					break;
				}

				$post_count++;
			endwhile;

			$html .= fsdp_flip_render::get_container_foot();
			return $html;
		}

		wp_reset_postdata();

	}
	
	/**
	 * enqueue all required files in the front-end
	 */
	function include_all_script(){
		wp_enqueue_style('fsdp_fontawesome_style', FSDP_URL . 'assets/css/fontawesome.css',null,FSDP_VERSION, false);
		wp_enqueue_style('my_bootstrap_style', FSDP_URL . 'assets/css/bootstrap.min.css',null,FSDP_VERSION, false);
		wp_enqueue_style('fsdp_custom_style', FSDP_URL . 'assets/css/style.css',null,FSDP_VERSION, false);
		wp_enqueue_script('fsdp_bootstrap', FSDP_URL . 'assets/js/bootstrap.min.js', array('jquery'), FSDP_VERSION, true );
		wp_enqueue_script('jquery-flip', FSDP_URL . 'assets/js/jquery-flip.js', array('jquery'), FSDP_VERSION, true );
		wp_enqueue_script('my_script', FSDP_URL . 'assets/js/fsdp-flipbox-script.js', array('jquery','jquery-flip'), FSDP_VERSION, true );
	}

	function get_other_featured_image_url( $post_type, $meta_name ){
		return MultiPostThumbnails::get_post_thumbnail_url( $post_type, $meta_name );
	}

}	// end of fsdp_render_design class;
new fsdp_render_design();