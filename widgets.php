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
				
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $lang_amenities_table = $wpdb->prefix . "lodgix_lang_amenities";
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

        $areas = $wpdb->get_results('SELECT DISTINCT area FROM ' . $properties_table . ' WHERE area <> \'\' AND area IS NOT NULL');  
        
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
						if (response == "") {						
							response = "0";
						}
                        jQueryLodgix(\'#search_results\').html(response + \' ' .  __('Properties Found',$localizationDomain) . '.\');
                        jQueryLodgix("#lodgix_search_spinner").hide();
                      },
                      failure: function(response){
                        jQueryLodgix("#lodgix_search_spinner").hide();
                      }
                   });                 	
                    
                 }
				 
	
				 function lodgix_search_before_submit() {
				    var real_date = jQueryLodgix("#lodgix-custom-search-arrival").datepicker("getDate");
					real_date = jQueryLodgix.datepicker.formatDate("yy-mm-dd", real_date);
					jQueryLodgix("#lodgix-custom-search-arrival-real").val(real_date);
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
        echo '<form name="lodgix_search_form" method="POST" action="' . $post_url .'" onsubmit="javascript:lodgix_search_before_submit();">
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
                    <div><select id="lodgix-custom-search-area" style="width:95%" name="lodgix-custom-search-area" onchange="javascript:p_lodgix_search_properties();">
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
                    <div><select id="lodgix-custom-search-bedrooms" name="lodgix-custom-search-bedrooms" onchange="javascript:p_lodgix_search_properties();">
                    <option value="ANY">Any</option>';
		$min_rooms = (int)$wpdb->get_var("SELECT MIN(bedrooms) FROM " . $properties_table);
		if ($min_rooms == 0)					
            echo '<option value="0">Studio</option>';
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

                echo '<div><input type="checkbox" class="lodgix-custom-search-amenities" name="lodgix-custom-search-amenities[' . $a . ']" value="' . $amenity->description . '" onclick="javascript:p_lodgix_search_properties();"/> ';
                echo __($aux,$localizationDomain) . '</div>';
                $a++;
            }
            echo '</div>';
        }

        echo '<div>'.__('Search by Property Name or ID',$localizationDomain) .':</div> 
                    <div><input id="lodgix-custom-search-id" name="lodgix-custom-search-id" style="width:95%" onkeyup="javascript:p_lodgix_search_properties();" value="' . $id_post .  '"></div>
                    <div id="lodgix-custom-search-results" align="center">
                    <div id="lodgix_search_spinner" style="display:none;"><img src="/wp-admin/images/wpspin_light.gif"></div>
                    <div id="search_results">
                    </div>
					<input type="hidden" id="lodgix-custom-search-arrival-real" name="lodgix-custom-search-arrival-real" value="">
                    <input type="submit" value="'.__('Display Results',$localizationDomain) .'" id="lodgix-custom-search-button">
                    </div>
              </div>';               
        echo '</div></form>';
		
		echo $after_widget;
	}
}


class Lodgix_Featured_Rentals_Widget extends WP_Widget {

	function __construct() {
				
		parent::__construct(
			'lodgix_featured',
			__( 'Featured Rentals' ),
			array( 'description' => __( 'Lodgix Featured Rentals Widget' ) )
		);		
		
	}


	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance['title'] );
		}
		else {
			$title = __( 'Featured Rentals' );
		}
	
		?>		
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /><br>
			</p>
		
		<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		global $wpdb;				
 
		extract($args);
		
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";
		$pages_table = $wpdb->prefix . "lodgix_pages";
		

		// Each widget can store its own options. We keep strings here.
		$loptions = get_option('p_lodgix_options');
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Featured Rentals') : esc_html($instance['title']));


		echo $before_widget . $before_title . $title . $after_title;
		echo '<div class="lodgix-featured-properties" align="center">';

        if ($loptions['p_lodgix_featured_rotate']) {
            $sql = 'SELECT ' . $properties_table . '.id,property_id,description,enabled,featured,main_image_thumb,
                    bedrooms,bathrooms,proptype,city,post_id,area FROM ' . $properties_table . '
                    LEFT JOIN ' . $pages_table .  ' ON ' . $properties_table . '.id = ' . $pages_table .  '.property_id
                    order by rand() LIMIT 3';
        }
        else {
            $sql = 'SELECT ' . $properties_table . '.id,property_id,description,enabled,featured,main_image_thumb,
                    bedrooms,bathrooms,proptype,city,post_id,area FROM ' . $properties_table . '
                    LEFT JOIN ' . $pages_table .  ' ON ' . $properties_table . '.id = ' . $pages_table .  '.property_id
                    WHERE featured=1 order by rand()';
        }
       
		$properties = $wpdb->get_results($sql);
		foreach($properties as $property)
		{
			
			$permalink = get_permalink($property->post_id);
			$location = $property->city;
			if ($property->city != "")
				$location = '<span class="price"> in <strong>' . $location . '</strong></span>';
			else
				$location = '<span class="price"><strong>' . $location . '</strong></span>';
			if (($loptions['p_lodgix_display_featured'] == 'area') && ($property->area != ""))
				$location = $property->area;
			$location = '<span class="price"><strong>' . $location . '</strong></span>';
			if ($_REQUEST['lang'] == "de")
			{
				$page_id = $wpdb->get_var("SELECT page_id FROM " . $lang_pages_table . " WHERE property_id=" . $property->id);
				$permalink = get_permalink($page_id);
			}
	  
		
			$proptype = ', ' . $property->proptype;
			if ($proptype == ', Room type')
				$proptype = '';
			
			$position = '';
			if ($loptions['p_lodgix_display_featured_horizontally'] == 1)
				$position = "float:left; margin-left:5px;";
			else if ($loptions['p_lodgix_display_featured_horizontally'] == 2)
				$position = "float:right; margin-right:5px;";
			  
			$bedrooms = $property->bedrooms . ' Bedrm, ';
			if ($property->bedrooms == 0)
			{
				$bedrooms = 'Studio, ';
			}
			
			
			echo '<div class="lodgix-featured-listing" style="-moz-border-radius: 5px 5px 5px 5px;' . $position . '">
				  <div class="imgset">
					  <a href="' . $permalink . '">
						  <img alt="View listing" src="' . $property->main_image_thumb . '">
						  <span class="featured-flag"></span>
					  </a>
				  </div>
				  <a class="address-link" href="' . $permalink . '">' . $property->description . '</a>
				  <div class="featured-details">' . $bedrooms . $property->bathrooms . ' Bath' . $proptype . ''
					. $location . '
				  </div>    
				</div>'; 
		}
		
		echo '</div>';
		echo $after_widget;
	}
}




function lodgix_register_widgets() {
	register_widget( 'Lodgix_Rental_Search_Widget' );
	register_widget( 'Lodgix_Featured_Rentals_Widget' );
}

add_action( 'widgets_init', 'lodgix_register_widgets' );



?>