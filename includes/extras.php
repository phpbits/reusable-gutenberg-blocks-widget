<?php
/*
 * Create globals for Reusable Blocks
 */
if( !function_exists( 'gutenrbw_global_blocks' ) ){
	function gutenrbw_global_blocks() {
        global $wpdb;

        $blocks  = $wpdb->get_results("SELECT ID, post_title, post_parent FROM $wpdb->posts WHERE post_type = 'wp_block' AND post_status = 'publish' ORDER BY post_title ASC ");

        // Let's let devs alter that value coming in
        $blocks = apply_filters( 'gutenberg_reusable_blocks_widget_before', $blocks );
        update_option( 'gutenberg_reusable_blocks_widgetopts', $blocks );

		return apply_filters( 'gutenberg_reusable_blocks_widget_get', $blocks );
	}
}
?>