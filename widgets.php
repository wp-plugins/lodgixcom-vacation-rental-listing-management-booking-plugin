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
			$amenities = esc_attr( $instance['amenities'] );
		}
		else {
			$title = __( 'Lodgix Rental Search' );
			$amenities = false;
			
		}
	
		?>		
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /><br>
			<label for="<?php echo $this->get_field_id( 'amenites' ); ?>"><?php _e( 'Amenities:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'amenities' ); ?>" name="<?php echo $this->get_field_name( 'amenities' ); ?>" type="checkbox" <?php checked(true, $amenities ); ?> />
			</p>
		
		<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ($new_instance['amenities'] == 'on')
			$instance['amenities'] = true;
		else {
			$instance['amenities'] = false;
		}
		return $instance;
	}

	function widget( $args, $instance ) {

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'];
			echo esc_html( $instance['title'] );
			echo $args['after_title'];
		}
		$options = get_option('widget_lodgix_custom_search');
		
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

