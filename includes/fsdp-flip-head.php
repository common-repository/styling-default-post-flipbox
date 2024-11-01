<?php
/*
 * Generating header and footer for flipbox
*/

class fsdp_flip_render{

	public static function get_container_head( ){

		return '<div class="fsdp-flipbox py-5">
		<div class="fsdp-flipbox_in pt-3" id="flip_layout">
				<ul class="d-flex flex-wrap">';
	}
	
	public static function get_container_foot(){
		return '</ul></div></div>';
	}
	
}