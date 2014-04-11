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
		global $wpdb;
				
		echo $args['before_widget'];
		
        $this->properties_table = $wpdb->prefix . "lodgix_properties";
        $this->lang_amenities_table = $wpdb->prefix . "lodgix_lang_amenities";
		$locale = get_locale();        
		$sufix = substr($locale,0,2);
		$p_plugin_path = plugin_dir_url(plugin_basename(__FILE__));
		$localizationDomain = "p_lodgix";
		
		extract($args);
	
		$loptions = get_option('p_lodgix_options'); 
                    
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Rentals Search') : esc_html($instance['title']));
 
        $area_post = $_POST['lodgix-custom-search-area'];
        $bedrooms_post = $_POST['lodgix-custom-search-bedrooms'];
        $id_post = $_POST['lodgix-custom-search-id'];	

        echo $before_widget . $before_title . $title . $after_title;
        echo '<div class="lodgix-search-properties" align="center">';

        $areas = $wpdb->get_results('SELECT DISTINCT area FROM ' . $this->properties_table . ' WHERE area <> \'\' AND area IS NOT NULL');  
        
        $date_format = $loptions['p_lodgix_date_format'];
        
        if ($date_format == '%m/%d/%Y')
           $date_format = 'mm/dd/yy';
        else if ($date_format == '%d/%m/%Y')
           $date_format = 'dd/mm/yy';
        else if ($date_format == '%m-%d-%Y')
                $date_format = 'mm-dd-yy';
        else if ($date_format == '%d-%m-%Y')
                $date_format = 'dd-mm-yy';                
        else if ($date_format == '%d %b %Y')
                $date_format = 'dd M yy';
    
        if ($sufix!= 'en')
            echo '<script type="text/javascript" src="' . $p_plugin_path . 'js/i18n/datepicker-' . $sufix. '.js"></script>';
        
        echo '<script type="text/javascript">
                         var P_LODGIX_SEARCH_RESULTS = 0;
                 function p_lodgix_search_properties() {
                    var amenities = [];
                    var checked = jQueryLodgix(".lodgix-custom-search-amenities:checked");
                    var len = checked.length;
                    if (len) {
                        for (var i = 0; i < len; i++) {
                            amenities.push(checked[i].value);
                        }
                        amenities = "&amenity[]=" + amenities.join("&amenity[]=");
                    }
                    jQueryLodgix(\'#search_results\').html(\'\');
                        jQueryLodgix("#lodgix_search_spinner").show();
                                        jQueryLodgix.ajax({
                      type: "POST",
                      url: "' .  get_bloginfo('wpurl') . '/wp-admin/admin-ajax.php",
                      data: "action=p_lodgix_custom_search&area=" + jQueryLodgix(\'#lodgix-custom-search-area\').val() + "&bedrooms=" + jQueryLodgix(\'#lodgix-custom-search-bedrooms\').val() + "&id=" + jQueryLodgix(\'#lodgix-custom-search-id\').val() + "&arrival=" + jQueryLodgix.datepicker.formatDate("yy-mm-dd",jQueryLodgix(\'#lodgix-custom-search-arrival\').datepicker("getDate")) + "&nights=" + jQueryLodgix(\'#lodgix-custom-search-nights\').val() + amenities,
                      success: function(response){
                        //response_array = response.split(" ");
                        //P_LODGIX_SEARCH_RESULTS = parseInt(response_array[0]);
                        jQueryLodgix(\'#search_results\').html(response);
                        jQueryLodgix("#lodgix_search_spinner").hide();
                      },
                      failure: function(response){
                        jQueryLodgix("#lodgix_search_spinner").hide();
                      }
                   });                 	
                    
                 }
                 
                                 

                               jQueryLodgix(document).ready(function() {
                                    jQueryLodgix( "#lodgix-custom-search-arrival" ).datepicker({
                                            showOn: "both",
                                            buttonImage: "' . $p_plugin_path . 'images/calendar.png",
                                            buttonImageOnly: true,
                                            dateFormat: "' . $date_format . '",
                                            minDate: 0,
                                            beforeShow: function() {
                                                setTimeout(function(){
                                                    jQueryLodgix("#lodgix-datepicker-div").css("z-index", 99999999999999);
                                                }, 0);
                                            }
                                                    
                                    }';
                                    
        if ($sufix!= 'en')
            echo ', jQueryLodgix.datepicker.regional["' . $sufix. '"]';
                                    
		echo ');});</script>';
        
		
        $post_id = (int)$loptions['p_lodgix_search_rentals_page_' . $sufix];
            
        $post_url = get_permalink($post_id);
        echo '<form name="lodgix_search_form" method="POST" action="' . $post_url .'">
                    <div class="lodgix-custom-search-listing" align="left" style="-moz-border-radius: 5px 5px 5px 5px;line-height:20px;">    
                    <table>
                      <tr>
                      <td>
                            <div>'.__('Arriving',$localizationDomain).':</div> 			
                            <div style="vertical-align:bottom;"><input id="lodgix-custom-search-arrival" name="lodgix-custom-search-arrival" style="width:117px;" onchange="javascript:p_lodgix_search_properties();" readonly></div>
                        </td>
                        <td>&nbsp;
                        </td>
                        <td>
                        <div>'.__('Nights',$localizationDomain).':</div>
                        <div><select id="lodgix-custom-search-nights" name="lodgix-custom-search-nights" style="width:54px;" onchange="javascript:p_lodgix_search_properties();">';
                        
        for ($i = 1 ; $i < 100 ; $i++)				
        {
            echo "<option value='" . $i . "'>" . $i . "</option>";
        }
        
        echo '</select>
                        </div>
                        </td>
                        </tr>
                    </table>
                    <div>'.__('Location',$localizationDomain).':</div> 
                    <div><select id="lodgix-custom-search-area" style="width:95%" name="lodgix-custom-search-area" onchange="p_lodgix_search_properties()">
                    <option value="ALL_AREAS">'.__('All Areas',$localizationDomain).'</option>';       	

        foreach($areas as $area)       				
        {
            if ($area->area == $area_post)
                echo '<option selected value="'.$area->area.'">'.$area->area.'</option>';
            else
                echo '<option value="'.$area->area.'">'.$area->area.'</option>';

        }
            
        echo	'</select></div>
                    <div>'.__('Bedrooms',$localizationDomain) .':</div> 
                    <div><select id="lodgix-custom-search-bedrooms" name="lodgix-custom-search-bedrooms" onchange="p_lodgix_search_properties()">
                    <option value="ANY">Any</option> 
                    <option value="0">Studio</option>';
        $max_rooms = (int)$wpdb->get_var("SELECT MAX(bedrooms) FROM " . $properties_table);
        for($i = 1 ; $i < ($max_rooms+1) ; $i++)
        {
            
            if ($i == $bedrooms_post)
                echo '<option selected value="'.$i.'">'.__($i,$localizationDomain).'</option>';
            else
                echo '<option value="'.$i.'">'.$i.'</option>';
        }
        echo '</select></div>';
        

        if ($instance['amenities']) {
            echo '<div class="lodgix-custom-search-amenities-list">'.__('Amenities',$localizationDomain) .':';
            $amenities = $wpdb->get_results("SELECT DISTINCT * FROM " . $wpdb->prefix . "lodgix_searchable_amenities");
            $a = 0;
            foreach($amenities as $amenity) {
                $aux = __(trim($amenity->description),$localizationDomain);
                $amenity_name = $wpdb->get_var("select description_translated from " . $lang_amenities_table . " WHERE description='" . $amenity->description . "' AND language_code='" . $sufix. "';"); 
				if ($amenity_name != "")
					$aux = $amenity_name;

                echo '<div><input type="checkbox" class="lodgix-custom-search-amenities" name="lodgix-custom-search-amenities[' . $a . ']" value="' . $amenity->description . '" onclick="p_lodgix_search_properties()"/> ';
                echo __($aux,$localizationDomain) . '</div>';
                $a++;
            }
            echo '</div>';
        }

        echo '<div>'.__('Search by Property Name or ID',$localizationDomain) .':</div> 
                    <div><input id="lodgix-custom-search-id" name="lodgix-custom-search-id" style="width:95%" onkeyup="p_lodgix_search_properties()" value="' . $id_post .  '"></div>
                    <div id="lodgix-custom-search-results" align="center">
                    <div id="lodgix_search_spinner" style="display:none;"><img src="/wp-admin/images/wpspin_light.gif"></div>
                    <div id="search_results">
                    </div>
                    <input type="submit" value="'.__('Display Results',$localizationDomain) .'" id="lodgix-custom-search-button">
                    </div>
              </div>';               
        echo '</div></form>';
		
		echo $args['after_widget'];
	}
}

function lodgix_register_widgets() {
	register_widget( 'Lodgix_Rental_Search_Widget' );
}

add_action( 'widgets_init', 'lodgix_register_widgets' );

?>

