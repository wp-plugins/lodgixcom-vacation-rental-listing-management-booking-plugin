<?php
/**
 * @package Lodgix
 */
class Lodgix_Rental_Search_Widget extends WP_Widget {

	function __construct() {
				
		parent::__construct(
			'lodgix_custom_search',
			__( 'Lodgix Rental Search' ),
			array( 'description' => __( 'Lodgix Rental Search Widget' ) )
		);		


		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_head', array( $this, 'css' ) );
		}
	}

	function css() {
		?>
		
		
		<?php
	}

	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance['title'] );
		}
		else {
			$title = __( 'Lodgix Rental Search' );
		}
		?>		
				<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
				</p>
		
		<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function widget( $args, $instance ) {

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'];
			echo esc_html( $instance['title'] );
			echo $args['after_title'];
		}
		?>
		
		
		<?php
		
		echo $args['after_widget'];
	}
}

function lodgix_register_widgets() {
	register_widget( 'Lodgix_Rental_Search_Widget' );
}

add_action( 'widgets_init', 'lodgix_register_widgets' );

?>

