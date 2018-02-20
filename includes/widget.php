<?php
/**
 * Create Gutenberg Reusable Widgets
 */
if( !class_exists( 'GUTENRBW_WIDGET' ) ):
	add_action( 'widgets_init', function(){
		register_widget( 'GUTENRBW_WIDGET' );
	});

	class GUTENRBW_WIDGET extends WP_Widget {

		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			$widget_ops = array( 
				'classname' => 'gutenberg-reusable-widget',
				'description' => __( 'Display Gutenberg Reusable saved Blocks anywhere as widget.', 'gutenberg-reusable-widget' ),
			);
			parent::__construct( 'gutenrbw_widget', __( 'Reusable Block', 'gutenberg-reusable-widget' ), $widget_ops );
		}

		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			if( isset( $instance['block'] ) && !empty( $instance['block'] ) ){
				echo $args['before_widget'];
				if ( ! empty( $instance['title'] ) ) {
					echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
				}
				echo apply_filters('the_content', get_post_field( 'post_content', $instance['block'] ) );
				echo $args['after_widget'];
			}
		}

		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			$title 					= ! empty( $instance['title'] ) ? $instance['title'] : '';
			$block_selected 		= ! empty( $instance['block'] ) ? $instance['block'] : '';
			$blocks 				= gutenrbw_global_blocks(); ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'gutenberg-reusable-widget' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<?php if( !empty( $blocks ) ){ ?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'block' ) ); ?>"><?php esc_attr_e( 'Select from saved Reusable Blocks:', 'gutenberg-reusable-widget' ); ?></label> 
					<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'block' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'block' ) ); ?>">
						<option values=""><?php _e( 'Select Reusable Block', 'gutenberg-reusable-widget' ); ?></option>
						<?php foreach( $blocks as $block ){
							$selected = ( $block_selected == $block->ID ) ? 'selected="selected"' : ''; ?>
							<option value="<?php echo $block->ID; ?>" <?php echo $selected;?>><?php echo $block->post_title; ?></option>
						<?php } ?>
					</select>
				</p>
			<?php 
			}else{ ?>
				<p><?php esc_attr_e( 'No saved reusable blocks yet.', 'gutenberg-reusable-widget' ); ?></p>
			<?php } 

			if ( ! defined( 'WIDGETOPTS_PLUGIN_NAME' ) ) { ?>
				<p style="font-size: 11px; line-height: 13px;">
					<a href="http://widget-options.com?utm_source=gutenberg-reusable-widget" target="_blank" style="text-decoration: none; color:#72777c;" ><?php _e( 'Manage your widgets\' visibility, styling, alignment, columns, restrictions and more. Click here to learn more. ', 'gutenberg-reusable-widget' );?></a>
				</p>
		<?php }
	}

		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 *
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['block'] = ( ! empty( $new_instance['block'] ) ) ? strip_tags( $new_instance['block'] ) : '';

			return $instance;
		}
	}
endif;
?>