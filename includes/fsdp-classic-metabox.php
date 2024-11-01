<?php
/**
 * Create and save post meta for classic editor
 * 
 */
if( !defined('ABSPATH') ){
	return;
}
    if( !class_exists( 'fsdp_init_metabox' )){
        return;
    }

 class fsdp_init_metabox{

    function __construct(){

        add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_script') );
        add_action( 'add_meta_boxes', array($this, 'create_metabox') );
        add_action( 'save_post', array($this, 'fsdp_flipboxes_save_meta_box' ) );

        new MultiPostThumbnails(array(
            'label' => 'Flipbox Front Image (Override)',
            'id' => 'fsdp-flip-front-image',
            'post_type' => 'post'
            )
        );

        new MultiPostThumbnails(array(
            'label' => 'Flipbox Back Image',
            'id' => 'fsdp-flip-back-image',
            'post_type' => 'post'
            )
        );


    }

    function create_metabox(){
        add_meta_box( 'fsdp-flipbox-settings', 'Flipbox Settings', array( $this, 'pd_flipbox_metabox'), 'post', 'normal', 'high' );
    }

    /**
     * create back-end flipbox settings for posts
     */
    function pd_flipbox_metabox( $post ) {
         // We'll use this nonce field later on when saving.
        wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
        $flipbox_layout = get_post_meta( $post->ID, 'fsdp-flipbox-layout-type', true);
        $flipbox_fa_icon = get_post_meta( $post->ID, 'fsdp-flipbox-fa-icon', true );
        $flipbox_fa_icon = isset( $flipbox_fa_icon ) && !empty( $flipbox_fa_icon )? $flipbox_fa_icon : 'fab fa-jira';
        $flipbox_title = get_post_meta( $post->ID, 'fsdp-flipbox-title', true );
        $flipbox_title = isset( $flipbox_title ) && !empty( $flipbox_title )? $flipbox_title : get_the_title();
        $flipbox_front_subheading = get_post_meta( $post->ID, 'fsdp-flipbox-front-subheading', true );
        $flipbox_front_subheading = isset( $flipbox_front_subheading ) && !empty( $flipbox_front_subheading ) ? $flipbox_front_subheading : get_the_excerpt();
        $flipbox_desc = get_post_meta( $post->ID, 'fsdp-flipbox-description', true );
        $flipbox_desc = isset( $flipbox_desc ) && !empty( $flipbox_desc )? $flipbox_desc: get_the_excerpt();
        $flipbox_frontbg = get_post_meta( $post->ID, 'fsdp-flipbox-front-bgColor', true );
        $flipbox_frontbg = isset( $flipbox_frontbg ) && !empty( $flipbox_frontbg )? $flipbox_frontbg: '#3498db' ;
        $flipbox_fronttext = get_post_meta( $post->ID, 'fsdp-flipbox-front-textColor', true );
        $flipbox_fronttext = isset( $flipbox_fronttext ) && !empty( $flipbox_fronttext )? $flipbox_fronttext: '#fff' ;
        $flipbox_back_title = get_post_meta( $post->ID, 'fsdp-flipbox-back-title', true );
        $flipbox_back_title = isset( $flipbox_back_title ) && !empty( $flipbox_back_title ) ? $flipbox_back_title : get_the_title() ;
        $flipbox_backbg = get_post_meta( $post->ID, 'fsdp-flipbox-back-bgColor', true );
        $flipbox_backbg = isset( $flipbox_backbg ) && !empty( $flipbox_backbg )? $flipbox_backbg: '#ff0000' ;
        $flipbox_backtext = get_post_meta( $post->ID, 'fsdp-flipbox-back-textColor', true );
        $flipbox_backtext = isset( $flipbox_backtext ) && !empty( $flipbox_backtext )? $flipbox_backtext: '#fff' ;
        $flipbox_width = get_post_meta( $post->ID, 'fsdp-flipbox-width', true );
        $flipbox_height = get_post_meta( $post->ID, 'fsdp-flipbox-height', true );
        $flipbox_link_label = get_post_meta( $post->ID, 'fsdp-flipbox-link-label', true );
        $flipbox_link_label = isset( $flipbox_link_label ) && !empty( $flipbox_link_label ) ? $flipbox_link_label : 'Learn More';
        $flipbox_link_href = get_post_meta( $post->ID, 'fsdp-flipbox-link-href', true );
        $flipbox_link_href = isset( $flipbox_link_href ) && !empty( $flipbox_link_href ) ? $flipbox_link_href : get_the_permalink();
        $flipbox_head_size = get_post_meta( $post->ID, 'fsdp-flipbox-heading-size', true);
        $flipbox_direction = get_post_meta( $post->ID, 'fsdp-flipbox-direction', true );
        $is_bgImage_enable = get_post_meta( $post->ID, 'fsdp-flipbox-bgImage-enable', true);
        $is_bgImage2_enable = get_post_meta( $post->ID, 'fsdp-flipbox-bgImage2-enable', true);

        $HTML  = "<table class='fsdp-flipbox-settings-btn'><tr>
        <td class='fsdp-button' fsdp-id='general-settings'> General </td>
        <td class='fsdp-button' fsdp-id='front-flip'> Front </td>
        <td class='fsdp-button' fsdp-id='back-flip'> Back </td></tr>
        </table>";

        $HTML .= "<table class='fsdp-value-settings general-settings'>";

        $HTML .= "<tr><td><label for='fsdp-flipbox-layout-type'>Layout Type: </label></td>
        <td><select name='fsdp-flipbox-layout-type' id='fsdp-flipbox-layout-type'>";
        $layouts = array(
                    "fsdp-flipbox-layout-1"=>"Layout 1",
                    "fsdp-flipbox-layout-2"=>"Layout 2",
                    "fsdp-flipbox-layout-3"=>"Layout 3",
                    "fsdp-flipbox-layout-4"=>"Layout 4",
                    "fsdp-flipbox-layout-5"=>"Layout 5",
                    "fsdp-flipbox-layout-6"=>"Layout 6",
                    "fsdp-flipbox-layout-7"=>"Layout 7",
                    "fsdp-flipbox-layout-8"=>"Layout 8",
                    "fsdp-flipbox-layout-9"=>"Layout 9",
                    "fsdp-flipbox-layout-10"=>"Layout 10",
                    "fsdp-flipbox-layout-11"=>"Layout 11",
                    "fsdp-flipbox-layout-12"=>"Layout 12",
                    "fsdp-flipbox-layout-13"=>"Layout 13",
                    "fsdp-flipbox-layout-14"=>"Layout 14",
                    "fsdp-flipbox-layout-15"=>"Layout 15",
                    "fsdp-flipbox-layout-16"=>"Layout 16",
                    "fsdp-flipbox-layout-17"=>"Layout 17",
                    "fsdp-flipbox-layout-18"=>"Layout 18",
                    "fsdp-flipbox-layout-19"=>"Layout 19",
                    "fsdp-flipbox-layout-20"=>"Layout 20",
                );
            foreach($layouts as $class=>$layout){
                $selected = '';
                if(  $flipbox_layout == $class){
                    $selected = "selected";
                }
                $HTML .= "<option ".$selected." value='".$class."'>".$layout."</option>";
            }
        $HTML .= "</select</td></tr>";
        $HTML .= "<tr>
        <td><label for='fsdp-flipbox-fa-icon'>Icon: </label></td>
        <td><input id='fsdp-flipbox-fa-icon' name='fsdp-flipbox-fa-icon' type='text' value='".$flipbox_fa_icon."' ></td></tr>";
        $HTML .= "<tr><td><label for='fsdp-flipbox-height'>Height: </label></td>
        <td><input id='fsdp-flipbox-height' name='fsdp-flipbox-height' type='text' value='".$flipbox_height."' ></td></tr>";                
        $HTML .= "<tr><td><label for='fsdp-flipbox-width'>Width: </label></td>
        <td><input id='fsdp-flipbox-width' name='fsdp-flipbox-width' type='text' value='".$flipbox_width."' ></td></tr>";
        $HTML .= "<tr><td></td></tr>";

        $HTML .= "<tr><td><label for='fsdp-flipbox-direction'>Flip Direction: </label></td>
        <td><select name='fsdp-flipbox-direction' id='fsdp-flipbox-direction'>";
        $directions = array(
                    "flip-vertical-right"=>"Left-To-Right",
                    "flip-vertical-right-reverse"=>"Right-To-Left",
                    "flip-horizontal-top"=>"Bottom-To-Top",
                    "flip-horizontal-top-reverse"=>"Top-To-Bottom"
                );
            foreach($directions as $class=>$direction){
                $selected = '';
                if(  $flipbox_direction == $class){
                    $selected = "selected";
                }
                $HTML .= "<option ".$selected." value='".$class."'>".$direction."</option>";
            }
        $HTML .= "</select</td></tr>";

        $HTML .= "</table>";

        $HTML .= "<table fsdp-layouts-not='fsdp-flipbox-layout-5,fsdp-flipbox-layout-16' class='fsdp-value-settings front-flip'>";
        $HTML .= "<tr><td><label for='fsdp-flipbox-title'>Title: </label></td>
        <td><input id='fsdp-flipbox-title' name='fsdp-flipbox-title' type='text' value='".$flipbox_title."' ></td></tr>";
        $HTML .= "<tr fsdp-layouts-only='fsdp-flipbox-layout-2,fsdp-flipbox-layout-3,fsdp-flipbox-layout-4,fsdp-flipbox-layout-6,fsdp-flipbox-layout-10,fsdp-flipbox-layout-11,fsdp-flipbox-layout-12,fsdp-flipbox-layout-13,fsdp-flipbox-layout-18,fsdp-flipbox-layout-19'>
        <td><label for='fsdp-flipbox-front-subheading'>Sub Heading: </label></td>
        <td><textarea cols='40' rows='5' style='width:200px; height:50px;' id='fsdp-flipbox-front-subheading' name='fsdp-flipbox-front-subheading'>".$flipbox_front_subheading."</textarea></td></tr>";

        $HTML .= "<tr><td><label for='fsdp-flipbox-title'>Heading Size: </label></td>
        <td><select name='fsdp-flipbox-heading-size' id='fsdp-flipbox-heading-size'>";
        $size = array("h1","h2","h3","h4","h5","h6");
            foreach($size as $head){
                $selected = '';
                if(  $flipbox_head_size == $head){
                    $selected = "selected";
                }
                $HTML .= "<option ".$selected." value='".$head."'>".$head."</option>";
            }
        $HTML .= "</select</td></tr>";
        $HTML .= "<tr><td><label for='fsdp-flipbox-bgImage-enable'>Background Image: </label></td>
        <td><select name='fsdp-flipbox-bgImage-enable' id='fsdp-flipbox-bgImage-enable'>";
        $options = array("true"=>"Enable","false"=>"Disable");
            foreach($options as $option=>$value){
                $selected = '';
                if(  $is_bgImage_enable == $option){
                    $selected = "selected";
                }
                $HTML .= "<option ".$selected." value='".$option."'>".$value."</option>";
            }
        $HTML .= "</select</td></tr>";
        $HTML .= "<tr><td><label for='fsdp-flipbox-front-bgColor'>Front Background Color: </label></td>
        <td><input id='fsdp-flipbox-front-bgColor' class='color-field' name='fsdp-flipbox-front-bgColor' type='text' value='".$flipbox_frontbg."' ></td></tr>";
        $HTML .= "<tr><td><label for='fsdp-flipbox-front-textColor'>Front Text Color: </label></td>
        <td><input id='fsdp-flipbox-front-textColor' class='color-field' name='fsdp-flipbox-front-textColor' type='text' value='".$flipbox_fronttext."' ></td></tr>";
        $HTML .= "</table>";

        $HTML .= "<table class='fsdp-value-settings back-flip'>";
        $HTML .= "<tr fsdp-layouts-only='fsdp-flipbox-layout-4,fsdp-flipbox-layout-5,fsdp-flipbox-layout-7,fsdp-flipbox-layout-9,fsdp-flipbox-layout-10,fsdp-flipbox-layout-11,fsdp-flipbox-layout-12,fsdp-flipbox-layout-15,fsdp-flipbox-layout-16,fsdp-flipbox-layout-18,fsdp-flipbox-layout-19,fsdp-flipbox-layout-20'>
        <td><label for='fsdp-flipbox-back-title'>Title: </label></td>
        <td><input id='fsdp-flipbox-back-title' name='fsdp-flipbox-back-title' type='text' value='".$flipbox_back_title."' ></td></tr>";
        $HTML .= "<tr fsdp-layouts-only='fsdp-flipbox-layout-1,fsdp-flipbox-layout-2,fsdp-flipbox-layout-3,fsdp-flipbox-layout-4,fsdp-flipbox-layout-5,fsdp-flipbox-layout-6,fsdp-flipbox-layout-7,fsdp-flipbox-layout-8,fsdp-flipbox-layout-9,fsdp-flipbox-layout-10,fsdp-flipbox-layout-11,fsdp-flipbox-layout-12,fsdp-flipbox-layout-14,fsdp-flipbox-layout-15,fsdp-flipbox-layout-16,fsdp-flipbox-layout-17,fsdp-flipbox-layout-18,fsdp-flipbox-layout-19,fsdp-flipbox-layout-20'>
        <td><label for='fsdp-flipbox-description'>Description: </label></td>
        <td><textarea cols='40' rows='5' style='width:200px; height:50px;' id='fsdp-flipbox-description' name='fsdp-flipbox-description'>".$flipbox_desc."</textarea></td></tr>";
        $HTML .= "<tr fsdp-layouts-only='fsdp-flipbox-layout-1,fsdp-flipbox-layout-2,fsdp-flipbox-layout-4,fsdp-flipbox-layout-5,fsdp-flipbox-layout-7,fsdp-flipbox-layout-9,fsdp-flipbox-layout-13,fsdp-flipbox-layout-14,fsdp-flipbox-layout-15,fsdp-flipbox-layout-17,fsdp-flipbox-layout-20'>
        <td><label for='fsdp-flipbox-link-label'>Learn More Text:</label> </td>
        <td><input type='text' value='".$flipbox_link_label."' id='fsdp-flipbox-link-label' name='fsdp-flipbox-link-label'></td></tr>";
        $HTML .= "<tr fsdp-layouts-only='fsdp-flipbox-layout-1,fsdp-flipbox-layout-2,fsdp-flipbox-layout-4,fsdp-flipbox-layout-5,fsdp-flipbox-layout-7,fsdp-flipbox-layout-13,fsdp-flipbox-layout-14,fsdp-flipbox-layout-15,fsdp-flipbox-layout-16,fsdp-flipbox-layout-17,fsdp-flipbox-layout-20'>
        <td><label for='fsdp-flipbox-link-href'>Learn More Link: </label> </td>
        <td><input type='text' value='".$flipbox_link_href."' id='fsdp-flipbox-link-href' name='fsdp-flipbox-link-href'></td></tr>";
        $HTML .= "<tr><td><label for='fsdp-flipbox-bgImage2-enable'>Background Image: </label></td>
        <td><select name='fsdp-flipbox-bgImage2-enable' id='fsdp-flipbox-bgImage2-enable'>";
        $options = array("true"=>"Enable","false"=>"Disable");
            foreach($options as $option=>$value){
                $selected = '';
                if(  $is_bgImage2_enable == $option){
                    $selected = "selected";
                }
                $HTML .= "<option ".$selected." value='".$option."'>".$value."</option>";
            }
        $HTML .= "</select</td></tr>";
        $HTML .= "<tr><td><label for='fsdp-flipbox-back-bgColor'>Back Background Color: </label></td>
        <td><input id='fsdp-flipbox-back-bgColor' class='color-field' name='fsdp-flipbox-back-bgColor' type='text' value='".$flipbox_backbg."' ></td></tr>";    
        $HTML .= "<tr><td><label for='fsdp-flipbox-back-textColor'>Back Text Color: </label></td>
        <td><input id='fsdp-flipbox-back-textColor' class='color-field' name='fsdp-flipbox-back-textColor' type='text' value='".$flipbox_backtext."' ></td></tr>";
        $HTML .= "</table>";

        $HTML .= "</table>";

        $HTML .= "<table>
                    <tr><td id='fsdp-flipbox-shortcode-preview'>".do_shortcode( '[fsdp-flipboxes id='.$post->ID.']' )."</td></tr>
                </table>";
            echo $HTML;
    }

    /**
     * save all available metadata values for the current post
     */
    function fsdp_flipboxes_save_meta_box( $post_id ){

        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
            return;
        }

          // if our nonce isn't there, or we can't verify it, bail
        if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ){
            return;
        }

        // if our current user can't edit this post, bail
        if( !current_user_can( 'edit_post' ) ){
             return;
        }
        if( isset( $_POST['fsdp-flipbox-layout-type'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-layout-type', sanitize_text_field( $_POST['fsdp-flipbox-layout-type'] ) );
        }
        if( isset( $_POST['fsdp-flipbox-fa-icon'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-fa-icon', sanitize_text_field( $_POST['fsdp-flipbox-fa-icon'] ) );
        }
        if( isset( $_POST['fsdp-flipbox-title'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-title', sanitize_text_field( $_POST['fsdp-flipbox-title'] ));
        }
        if( isset( $_POST['fsdp-flipbox-front-subheading'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-front-subheading', sanitize_text_field( $_POST['fsdp-flipbox-front-subheading'] ));
        }
        if( isset( $_POST['fsdp-flipbox-back-title'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-back-title', sanitize_text_field( $_POST['fsdp-flipbox-back-title'] ));
        }
        if( isset( $_POST['fsdp-flipbox-description'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-description', sanitize_text_field( $_POST['fsdp-flipbox-description'] ));
        }
        if( isset( $_POST['fsdp-flipbox-bgImage-enable'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-bgImage-enable', sanitize_text_field($_POST['fsdp-flipbox-bgImage-enable']) );
        }
        if( isset( $_POST['fsdp-flipbox-bgImage2-enable'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-bgImage2-enable', sanitize_text_field($_POST['fsdp-flipbox-bgImage2-enable']) );
        }
        if( isset( $_POST['fsdp-flipbox-front-bgColor'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-front-bgColor', sanitize_hex_color($_POST['fsdp-flipbox-front-bgColor']) );
        }
        if( isset( $_POST['fsdp-flipbox-front-textColor'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-front-textColor', sanitize_hex_color($_POST['fsdp-flipbox-front-textColor']) );
        }
        if( isset( $_POST['fsdp-flipbox-back-bgColor'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-back-bgColor', sanitize_hex_color($_POST['fsdp-flipbox-back-bgColor']) );
        }
        if( isset( $_POST['fsdp-flipbox-back-textColor'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-back-textColor', sanitize_hex_color($_POST['fsdp-flipbox-back-textColor']) );
        }
        if( isset( $_POST['fsdp-flipbox-width'] ) && is_numeric( $_POST['fsdp-flipbox-width'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-width', sanitize_text_field($_POST['fsdp-flipbox-width']) );
        }
        if( isset( $_POST['fsdp-flipbox-height'] ) && is_numeric( $_POST['fsdp-flipbox-height'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-height', sanitize_text_field($_POST['fsdp-flipbox-height']) );
        }
        if( isset( $_POST['fsdp-flipbox-link-label'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-link-label', sanitize_text_field( $_POST['fsdp-flipbox-link-label'] ) );
        }
        if( isset( $_POST['fsdp-flipbox-link-href'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-link-href', esc_url_raw( $_POST['fsdp-flipbox-link-href'] ) );
        }
        if( isset( $_POST['fsdp-flipbox-heading-size'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-heading-size', sanitize_text_field($_POST['fsdp-flipbox-heading-size']) );
        }
        if( isset( $_POST['fsdp-flipbox-direction'] ) ){
            update_post_meta( $post_id, 'fsdp-flipbox-direction', sanitize_text_field($_POST['fsdp-flipbox-direction']) );
        }
      
    }

    function admin_enqueue_script(){
        GLOBAL $post;
        // make sure these file only enqueue in required post only
        if( isset( $post->post_type ) && $post->post_type == 'post' ){
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style('fsdp_fontawesome_style', FSDP_URL . 'assets/css/fontawesome.css',null,FSDP_VERSION, false);
            wp_enqueue_style( 'fsdp_admin_fontawesome_css', FSDP_URL . 'assets/css/fontawesome-iconpicker.css', null, FSDP_VERSION );
            wp_enqueue_style( 'fsdp_admin_styles', FSDP_URL . 'assets/css/admin-style.css', null, FSDP_VERSION );
            wp_enqueue_script('fsdp_admin_fontawesome', FSDP_URL . 'assets/js/fontawesome-iconpicker.js', array('jquery','wp-color-picker'), FSDP_VERSION, true );
            wp_enqueue_script('fsdp_admin_flipbox_post', FSDP_URL .'assets/js/admin-script.js', array('jquery','wp-color-picker'), FSDP_VERSION, true );
            wp_enqueue_style('fsdp_custom_style', FSDP_URL . 'assets/css/style.css',null,FSDP_VERSION, false);
            wp_enqueue_script('fsdp_bootstrap', FSDP_URL . 'assets/js/bootstrap.min.js', array('jquery'), FSDP_VERSION, true );
            wp_enqueue_script('jquery-flip', FSDP_URL . 'assets/js/jquery.flip.min.js', array('jquery'), FSDP_VERSION, true );
            wp_enqueue_script('fsdp_custom_script', FSDP_URL . 'assets/js/fsdp-flipbox-script.js', array('jquery','jquery-flip'), FSDP_VERSION, true );
        }
        $custom_css = "
				i.flipbox-post-icon{
					background-image:url('".FSDP_URL."assets/js/icon.png');
                }
                .mce-container .mce-stack-layout{
                    max-height: 250px;
                }
			";
			echo "<style>". $custom_css ."</style>";
    }

 }
    new fsdp_init_metabox();