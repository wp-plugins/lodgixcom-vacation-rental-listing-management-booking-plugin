<?php
/*

Plugin Name: Lodgix.com Vacation Rental Listing, Management & Booking Plugin
Plugin URI: http://www.lodgix.com/vacation-rental-wordpress-plugin.html
Description: Build a sophisticated vacation rental website in seconds using the Lodgix.com vacation rental software. Vacation rental CMS for WordPress.
Version: 1.1.45
Author: Lodgix 
Author URI: http://www.lodgix.com

*/
/*

Changelog:
v1.1.45: Localization - part IV
v1.1.44: Localization - part III
v1.1.43: Localization - part II
v1.1.42: Localization - part I
v1.1.41: Changed datepicker z-index
v1.1.40: Fixed Widget header width
v1.1.39: Fixed Amenities UL
v1.1.38: Added Pets CSS class
v1.1.37: Added Thesis 2 support
v1.1.36: Fixed Merged Rates
v1.1.35: Added Merged Rates
v1.1.34: Added full size thumbnails option
v1.1.33: Added plugin rate button
v1.1.32: Fixed Book Now button II
v1.1.31: Fixed Custom Amenity Search
v1.1.30: Fixed Book Now button
v1.1.29: Added extra search rental widget
v1.1.28: Fixed search availability bug II
v1.1.27: Fixed search availability bug
v1.1.26: Fixed Policies formatting
v1.1.25: Added amenities to search widget
v1.1.24: Altered featured CSS
v1.1.23: Altered featured CSS
v1.1.22: Implemented text expander in property listings
v1.1.21: Fixed search widget
v1.1.20: Responsive header for the single property page
v1.1.19: Allow multiple websites
v1.1.18: Added AJAX search details
v1.1.17: Responsive features table 
v1.1.16: Fixed regressions on the vacation rental listings page
v1.1.15: Responsive Design
v1.1.14: Fix lodgix-custom.css path
v1.1.11: Fix German Description
v1.1.10: Fix German Details
v1.1.09: Add VR scrollbars
v1.1.08: Fix CSS width
v1.1.07: Responsive Design
v1.1.06: Fixed matching areas
v1.1.05: Fixed template CSS
v1.1.04: Fixed wpdb functions
v1.1.03: Fixed IE CSS
v1.1.02: Fixed jquery validate
v1.1.01: Fixed search widget
v1.1.00: Fixed CeeBox
v1.0.99: Tabbed CSS minor adjustments - 2
v1.0.98: Tabbed CSS minor adjustments
v1.0.97: Added option to load css/lodgix-custom.css
v1.0.96: Fixed Reviews Separator
v1.0.95: Fixed Single Unit Calendar
v1.0.94: Added Theme Support
v1.0.93: Added Link Rotation
v1.0.92: CSS Adjustment
v1.0.91: Search Widget CSS Adjustment
v1.0.90: Fixed Datepicker Current Date
v1.0.89: Fixed Search Widget
v1.0.88: Changed Nights Input
v1.0.87: Bug Fix
v1.0.86: Search Widget Enhancements, HTML5 Single Calendar
v1.0.85: German Language correction
v1.0.84: Fixed German Multi Unit Instructions
v1.0.83: Updated Google Maps API Sensor
v1.0.82: Updated Google Maps API Version Zoom
v1.0.81: Updated Google Maps API Version
v1.0.80: Fixed sidebar position
v1.0.79: Changed multi unit calendar to HTML5
v1.0.78: Added property Wordpress Status
v1.0.77: Fixed german language path
v1.0.76: Fixed video and virtual tour links
v1.0.75: Fixed page encoding
v1.0.74: Fixed plugin path 
v1.0.73: Fixed Include Bug
v1.0.72: Fixed Per Person Rates
v1.0.71: Added Per Person Rates
v1.0.70: Fixed Availability Links
v1.0.69: Added New Tabbed Design
v1.0.68: Added GetURLs AJAX
v1.0.67: Added Studio support
v1.0.66: CSS Adjusted
v1.0.65: Fixed shortcode issue
v1.0.64: Added property id feature
v1.0.62: Fixed gravity forms bug
v1.0.61: Added gravity forms properties
v1.0.60: Add single page content wrapper
v1.0.59: Fixed Area Page
v1.0.58: Fixed IE Calendar borders
v1.0.57: Addional calendar fix
v1.0.56: Addional calendar fix
v1.0.55: Added non flash single calendar
v1.0.54: Added user german amenities
v1.0.53: Altered Search Rentals Widget CSS
v1.0.52: Dynamic Rental Pages
v1.0.51: Altered Search Rentals Widget CSS
v1.0.50: Fixed Search Rentals Widget
v1.0.49: Added Search Rentals Widget
v1.0.48: Changed policies position
v1.0.47: Fixed featured rentals image path
v1.0.46: Added beds setup to property description
v1.0.45: Added video/virtual tour to property page
v1.0.44: Added new registration link.
v1.0.43: Added plugin installation check.
v1.0.42: Changed options text.
v1.0.41: Changed options text. Allow_url_fopen no longer required.
v1.0.40: Fixed version issue
v1.0.39: Increased Contact URL size
v1.0.38: Added property name to contact url querystring
v1.0.37: Fixed small css items
v1.0.36: Fixed featured properties IE8
v1.0.35: Added Lodgix.com links
v1.0.34: Fixed Wordpress 3.2.0 incompatibility
v1.0.33: Added float right option to widget
v1.0.32: Added option to display widget horizontally
v1.0.31: Fixed Featured Widget
v1.0.30: Fixed rate CSS
v1.0.29: Fixed extra draft post
v1.0.28: Fixed small CSS issues
v1.0.27: Fixed availability link
v1.0.26: Fixed Gravity Forms compatibility
v1.0.25: Added option for Custom Page Templates
v1.0.24: Added Purevision theme compatibility
v1.0.23: Replace check icon
v1.0.22: Added FlexSqueeze theme compatibility
v1.0.21: Changed guest reviews
v1.0.20: Fixed captions length
v1.0.19: Implemented new upgrade
v1.0.18: Fixed no pets allowed
v1.0.17: Fixed number of bathrooms
v1.0.16: Added German Contact URL
v1.0.15: New property page design
v1.0.14: Fixed area array
v1.0.10: Implemented areas
v1.0.9: Fixed multi-language update issue
v1.0.7: Fix single property availability
v1.0.4: Fixed directory
v1.0.0: Initial release

*/

define('LODGIX_LIKE_URL', 'http://www.lodgix.com');

global $p_lodgix_db_version;
$p_lodgix_db_version = "2.0";

require_once('functions.php');
require_once('translator.php');
require_once('request.php');


if (!class_exists('p_lodgix')) {
    class p_lodgix {
    /**
    * @var string The options string name for this plugin
    */
    var $optionsName = 'p_lodgix_options';

    /**
    * @var array $options Stores the options for this plugin
    */
    var $options = array();
    /**
    * @var string $localizationDomain Domain used for localization
    */
    var $localizationDomain = "p_lodgix";

    /**
    * @var string $url The url to this plugin
    */ 
    var $url = '';
    /**
    * @var string $urlpath The path to this plugin
    */
    var $urlpath = '';
    var $p_plugin_path = NULL;
    
    var $locale = 'en_US';
    var $sufix = 'en';
    
    var $page_titles = array();
    
    var $translator = NULL;
    
    var $properties_array = array(
            'id'=> NULL,
            'owner_id',
            'description'=> NULL,
            'description_long'=> NULL,
            'details'=> NULL,
            'main_image'=> NULL,
            'main_image_thumb'=> NULL,
            'address'=> NULL,
            'city'=> NULL,
            'zip'=> NULL,
            'state_code'=> NULL,
            'country_code'=> NULL,
            'bedrooms'=> NULL,
            'bathrooms'=> NULL,
            'minrate'=> NULL,
            'maxrate'=> NULL,
            'min_daily_rate' => NULL,
            'min_weekly_rate' => NULL,
            'min_monthly_rate' => NULL,
            'sleeps'=> NULL,
            'smoking'=> NULL,
            'pets'=> NULL,
            'children'=> NULL,
            'rates'=> NULL,
            'proptype'=> NULL,
            'latitude'=> NULL,
            'longitude'=> NULL,
            'contact'=> NULL,
            'phone_local'=> NULL,
            'phone_free_toll'=> NULL,
            'email'=> NULL,
            'serving_status'=> NULL,
            'deleted'=> NULL,
            'web_address'=> NULL,
            'arrival_times'=> NULL,
            'state'=> NULL,
            'currency_code'=> NULL,
            'currency_symbol'=> NULL,
            'display_calendar'=> NULL,
            'allow_booking'=> NULL,
            'check_in' => NULL,
            'check_out' => NULL,
            'post_id' => NULL
    );
    
    var $pictures_array = array (
            'property_id' => NULL,
            'position' => NULL,
            'caption' => NULL,
            'url' => NULL,
            'thumb_url' => NULL    
    );

    var $amenities_array = array(
        'property_id' => NULL,
        'description' => NULL
    );
    
    var $rates_array = array(    
        'property_id' => NULL,
        'from_date' => NULL,
        'to_date' => NULL,
        'sunday_rate' => NULL,
        'monday_rate' => NULL,
        'tuesday_rate' => NULL,
        'wednesday_rate' => NULL,
        'thursday_rate' => NULL,
        'friday_rate' => NULL,
        'saturday_rate' => NULL,
        'min_nights' => NULL,
        'default_rate' => NULL,
        'is_default' => NULL,
        'name' => NULL
    );
    
    var $merged_rates_array = array(
	'property_id' => NULL,
        'from_date' => NULL,
        'to_date' => NULL,
        'nightly' => NULL,
        'weekend_nightly' => NULL,
        'weekly' => NULL,
        'monthly' => NULL,
        'min_stay' => NULL,
        'rate_type' => NULL,
        'name' => NULL    
    );

    var $rules_array = array(    
        'property_id' => NULL,
        'from_date' => NULL,
        'min_nights' => NULL,
        'is_default' => NULL,
        'name' => NULL
    );
    
    var $pages_array = array(    
        'page_id' => NULL,
        'parent_page_id' => NULL,
        'enabled' => NULL
    );    
    
    
    //Class Functions
    /**
    * PHP 4 Compatible Constructor
    */
    function p_lodgix(){$this->__construct();}

    /**
    * PHP 5 Constructor
    */        
    function __construct()
    {                     

        $this->p_lodgix_set_tables();
        
        //"Constants" setup
        $this->url = plugins_url(basename(__FILE__), __FILE__);
        $this->urlpath = plugins_url('', __FILE__); 
        
        //Initialize the options
        $this->getOptions();
      
      
        //Admin menu
        add_action("admin_menu", array(&$this,"admin_menu_link"));
  
        //Actions
        add_action('wp_print_scripts', array(&$this,'p_lodgix_script'));
        add_action("init", array(&$this,"p_lodgix_init"));
        add_action('wp_head', array(&$this,"p_lodgix_header_code"));
        add_action('wp_ajax_p_lodgix_notify', array(&$this,"p_lodgix_notify"));
        add_action('wp_ajax_nopriv_p_lodgix_notify', array(&$this,"p_lodgix_notify"));
        add_action('wp_ajax_p_lodgix_geturls', array(&$this,"p_lodgix_geturls"));
        add_action('wp_ajax_nopriv_p_lodgix_geturls', array(&$this,"p_lodgix_geturls"));      
        add_action('wp_ajax_p_lodgix_check', array(&$this,"p_lodgix_check"));
        add_action('wp_ajax_nopriv_p_lodgix_check', array(&$this,"p_lodgix_check"));      
        add_action('wp_ajax_p_lodgix_sort_vr', array(&$this,"p_lodgix_sort_vr"));
        add_action('wp_ajax_nopriv_p_lodgix_sort_vr', array(&$this,"p_lodgix_sort_vr"));
        add_action('wp_ajax_p_lodgix_custom_search', array(&$this,"p_lodgix_custom_search"));
        add_action('wp_ajax_nopriv_p_lodgix_custom_search', array(&$this,"p_lodgix_custom_search"));
  
        add_action('wp_ajax_p_lodgix_custom_search_get_details', array(&$this,"p_lodgix_custom_search_get_details"));
        add_action('wp_ajax_nopriv_p_lodgix_custom_search_get_details', array(&$this,"p_lodgix_custom_search_get_details"));
        
        add_action('p_lodgix_download_images', array(&$this,"p_lodgix_download_images"));
        add_action("template_redirect", array(&$this,"p_lodgix_template_redirect"));
     
        register_activation_hook(__FILE__, array(&$this,'p_lodgix_activate'));
        register_deactivation_hook(__FILE__, array(&$this,'p_lodgix_deactivate'));
        add_filter( 'wp_list_pages_excludes', array(&$this,'p_lodgix_remove_pages_from_list'));
      
   

 
        // Featured widget
        add_action('widgets_init',  array(&$this,'widget_lodgix_featured_init'));
        add_action('widgets_init',  array(&$this,'widget_lodgix_custom_search_init'));
        //add_action('widgets_init',  array(&$this,'widget_lodgix_custom_search_init'));
        
        // Menus
        add_filter('wp_get_nav_menu_items',array(&$this,'p_lodgix_nav_menus'),10,3);
        
        // Content
        add_filter('the_content', array(&$this,'p_lodgix_filter_content'));
        add_shortcode('lodgix calendar', array(&$this,'p_get_lodgix_calendar'));
        add_shortcode('lodgix_calendar', array(&$this,'p_get_lodgix_calendar'));
        add_shortcode('lodgix_vacation_rentals', array(&$this,'p_lodgix_pcode_vacation_rentals'));
        add_shortcode('lodgix_vacation_rentals_de', array(&$this,'p_lodgix_pcode_vacation_rentals'));
        add_shortcode('lodgix_availability', array(&$this,'p_lodgix_pcode_availability'));
        add_shortcode('lodgix_availability_de', array(&$this,'p_lodgix_pcode_availability'));
        add_shortcode('lodgix_search_rentals', array(&$this,'p_lodgix_pcode_search_rentals'));
        add_shortcode('lodgix_search_rentals_de', array(&$this,'p_lodgix_pcode_search_rentals'));    
    	add_shortcode('lodgix_single_property', array(&$this,'p_lodgix_pcode_lodgix_single_property'));      
		add_shortcode('lodgix_single_property_de', array(&$this,'p_lodgix_pcode_lodgix_single_property'));    
        add_filter("gform_pre_render", array(&$this,'p_lodgix_pre_render_function'));
        add_filter("gform_admin_pre_render", array(&$this,'p_lodgix_pre_render_function'));
    }
    
    function p_lodgix_set_page_titles() {
        global $wpdb;
        
        $this->page_titles = array();
       
        $active_languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
        foreach ($active_languages as $l) {
            unload_textdomain($this->localizationDomain);
            $mo =  WP_CONTENT_DIR . '/'  . "languages/" .$this->localizationDomain .'-' .$l->locale.".mo";            
            if (!load_textdomain($this->localizationDomain, $mo))
            {
                $mo =  trailingslashit( plugin_dir_path( __FILE__ )) . "languages/" .$this->localizationDomain .'-' .$l->locale.".mo";
                load_textdomain($this->localizationDomain, $mo);
            }
            
            $vacation_rentals =  __('Vacation Rentals',$this->localizationDomain);
            //if ($vacation_rentals == 'Vacation Rentals' && $l->code != 'en')
            //    $vacation_rentals = $vacation_rentals . ' ' . $l->name;
            
            $availability =  __('Availability',$this->localizationDomain);
            //if ($availability == 'Availability' && $l->code != 'en')
            //    $availability = $availability . ' ' . $l->name;
            //
            $search = __('Search Rentals',$this->localizationDomain);
            //if ($search == 'Search Rentals' && $l->code != 'en')
            //    $search = $search . ' ' . $l->name;
                
            $this->page_titles[$l->code] = array(
                'vacation_rentals' => $vacation_rentals,
                'availability' => $availability,
                'search' => $search
            );
       }
        
       $this->p_lodgix_load_locale();
    }
    
    function p_lodgix_load_locale() {   
        global $sitepress;
                        
        $this->locale = get_locale();
        $this->sufix = substr($this->locale,0,2);                        
        
        $mo =  WP_CONTENT_DIR . '/'  . "languages/" .$this->localizationDomain .'-' .$this->locale.".mo";
        
        if (!load_textdomain($this->localizationDomain, $mo))
        {
            $mo =  trailingslashit( plugin_dir_path( __FILE__ )) . "languages/" .$this->localizationDomain .'-' .$this->locale.".mo";
            load_textdomain($this->localizationDomain, $mo);
        }
        return $lang;
    }
    
    function p_lodgix_set_tables() {
        global $wpdb;
    
        $this->properties_table = $wpdb->prefix . "lodgix_properties";
        $this->amenities_table = $wpdb->prefix . "lodgix_amenities";
        $this->rates_table = $wpdb->prefix . "lodgix_rates";      
        $this->merged_rates_table = $wpdb->prefix . "lodgix_merged_rates";              
        $this->rules_table = $wpdb->prefix . "lodgix_rules";           
        $this->pictures_table = $wpdb->prefix . "lodgix_pictures";   
        $this->pages_table = $wpdb->prefix . "lodgix_pages";
        $this->lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";
        $this->lang_properties_table = $wpdb->prefix . "lodgix_lang_properties";
        $this->lang_amenities_table = $wpdb->prefix . "lodgix_lang_amenities";
        $this->translation_table =  $wpdb->prefix . "icl_translations";
        $this->taxes_table = $wpdb->prefix . "lodgix_taxes";   
        $this->fees_table = $wpdb->prefix . "lodgix_fees";   
        $this->deposits_table = $wpdb->prefix . "lodgix_deposits";     
        $this->reviews_table = $wpdb->prefix . "lodgix_reviews";      
        $this->languages_table = $wpdb->prefix . "lodgix_languages";
        $this->link_rotators_table = $wpdb->prefix . "lodgix_link_rotators";
        $this->policies_table = $wpdb->prefix . "lodgix_policies";
    }

    
    function p_lodgix_pre_render_function($form) {
		global $wpdb;	  		  
			
		//TODO: SELECT FORM ID
	    //if($form["id"] != 5)
	    //   return $form;

    	//Creating drop down item array.
    	$items = array();

    	//Adding initial blank value.
    	//$items[] = array("text" => "Not Selected", "value" => "0");

    	//Adding post titles to the items array
   		$properties = $wpdb->get_results('SELECT * FROM ' . $this->properties_table . ' ORDER BY `order`'); 
        if ($properties)
        {
            foreach($properties as $property)    	
            {
        	  $items[] = array("value" => $property->id, "text" => $property->description);
        	}
        }
			
    	//Adding items to field id 8. Replace 8 with your actual field id. You can get the field id by looking at the input name in the markup.
    	foreach($form["fields"] as &$field)    		
        if(trim($field["inputName"]) == 'lodgix_property_id'){          
            $field["choices"] = $items;
        }

    	return $form;    	
    }
    
    
    function p_lodgix_pcode_vacation_rentals($atts) {
    	return $this->get_vacation_rentals_content();
    }
    
    function p_lodgix_pcode_availability($atts) {
    	return $this->get_availability_page_content();
    }
    
    function p_lodgix_pcode_search_rentals($atts) {
    	return $this->get_search_rentals_page_content();
    }
     
    function p_lodgix_pcode_lodgix_single_property($atts) {
    	$p_lodgix_property_id = $atts[0];
    	return $this->get_single_page_content($p_lodgix_property_id);
    }
    
    function p_lodgix_pcode_lodgix_single_property_de($atts) {
    	$p_lodgix_property_id = $atts[0];
    	return $this->get_single_page_content($p_lodgix_property_id);
    }         
     
    
    function p_get_lodgix_calendar($atts) {		  	
    	global $wpdb;	  		  
		$p_lodgix_property_id = $atts[0];
		$p_lodgix_owner_id = $atts[1];
		$p_lodgix_static = str_replace("'","",$atts[2]);
		$p_allow_booking = $atts[3];
		$p_lodgix_display_single_instructions = $atts[4];
		$p_lodgix_language = $atts[5];
     
		$policies = $wpdb->get_results("SELECT * FROM " . $this->policies_table . " WHERE language_code='" . $this->sufix . "'");
            
		$policy = $policies[0];
        $single_unit_helptext = '';
        if ($policy->multi_unit_helptext)
        {
            $single_unit_helptext = $policy->multi_unit_helptext;
        }  			  
	
        $content = '<div id="lodgix_property_booking"><h2 id="booking">' . __('Availability &amp; Booking Calendar',$this->localizationDomain) .'</h2><center><script type="text/javascript">var __lodgix_origin="http://www.lodgix.com";</script><script type="text/javascript" src="http://www.lodgix.com/static/scc/build/code.min.js"></script><script type="text/javascript">new LodgixUnitCalendar(' . $p_lodgix_owner_id . ',' . $p_lodgix_property_id . ');</script>';
		

		if (($single_unit_helptext != '') && ($p_allow_booking == 1) && ($p_lodgix_display_single_instructions == 1))
		{
  			$content .= '<div style="max-width:615px"><div style="padding:5px 20px 0px;text-align:center;"><div style="text-align:left;padding:5px 0px 0px 0px;"><h2 style="margin:0px;padding:0px;color:#0299FF;font-family:Arial,sans-serif;font-size:17px;">'. __('Online Booking Instructions',$this->localizationDomain) .'</h2><br><p style="font-family:Arial,sans-serif;font-size:12px;margin:0px;padding:0px;">' . str_replace(array("\r\n", "\n", "\r"),'<br>',$single_unit_helptext) . '</p></div></div></div></div>';
		}
		else
		{
  			$content .= '</center></div>';
		}			

    	return $content;
	}	

    
    function p_lodgix_download_images()
    {
        global $wpdb;
        set_time_limit(3600);
        
        $pictures_path = WP_CONTENT_DIR.'/lodgix_pictures'; 
        $pictures_url = WP_CONTENT_URL.'/lodgix_pictures'; 
        $plugin_url = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); 
        $sql = "SELECT * FROM " . $this->pictures_table . " WHERE url LIKE 'http://www.lodgix.com/photo/0/gallery/%'";
        $pictures = $wpdb->get_results($sql);
		$context = stream_context_create(array('http' => array('timeout' => 120)));                                       
                  
        if (!file_exists($pictures_path ))
           mkdir($folder, 0755,true);
        foreach($pictures as $pic)
        {
            $path = str_replace('http://www.lodgix.com/media/gallery/','',$pic->thumb_url);
            $file = basename($path);
            $folder = $pictures_path . '/' . str_replace('/' . $file,'',$path);
            if (!file_exists($folder . '/' . $file))
            {
                if (!file_exists($folder))
                mkdir($folder, 0755,true);
          
                $r = new LogidxHTTPRequest($pic->thumb_url);
				$contents = $r->DownloadToString();           
                file_put_contents($folder . '/' . $file, $contents);
            }
            if (file_exists($folder . '/' . $file))
            {
              $new_url = $pictures_url . '/' . str_replace('/' . $file,'',$path) . '/' . $file;
              $wpdb->query("UPDATE " . $this->pictures_table . " SET thumb_url='" . $new_url . "' WHERE id=" . $pic->id);
              if ($pic->position == 1)
                  $wpdb->query("UPDATE " . $this->properties_table . " SET main_image_thumb='" . $new_url . "' WHERE main_image_thumb='" . $pic->thumb_url . "'");
            }
            
            $path = str_replace('http://www.lodgix.com/photo/0/gallery/','',$pic->url);
            $file = basename($path);
            $folder = $pictures_path . '/' . str_replace('/' . $file,'',$path);
            if (!file_exists($folder . '/' . $file))
            {
              if (!file_exists($folder))
                mkdir($folder, 0755,true);
                $r = new LogidxHTTPRequest($pic->url);
                $contents = $r->DownloadToString();           
                file_put_contents($folder . '/' . $file, $contents);               
            }
            if (file_exists($folder . '/' . $file))
            {        
              $new_url = $pictures_url . '/' . str_replace('/' . $file,'',$path) . '/' . $file;
              $wpdb->query("UPDATE " . $this->pictures_table . " SET url='" . $new_url . "' WHERE id=" . $pic->id);
              if ($pic->position == 1)
                $wpdb->query("UPDATE " . $this->properties_table . " SET main_image='" . $new_url . "' WHERE main_image='" . $pic->url . "'");  
            }      
        }
        $this->build_individual_pages();
      
      //$this->build_areas_pages();
    }
    
    function p_lodgix_filter_content($content)
    {     	
        global $p_lodgix_db_version;
        
        
        if (get_option('p_lodgix_db_version'))
        {
            $old_db_version = ((float)get_option('p_lodgix_db_version'));
                    
            //$old_db_version = 1.9;
            if ($old_db_version < ((float)$p_lodgix_db_version))
            {              
                $this->update_db($old_db_version);
            }
        }
        update_option('p_lodgix_db_version',$p_lodgix_db_version);
                  
        if (strrpos($content,'[lodgix vacation_rentals]') > 0)
            $content = str_replace('[lodgix vacation_rentals]',$this->get_vacation_rentals_content(),$content);
        if (strrpos($content,'[lodgix availability]') > 0)
            $content = str_replace('[lodgix availability]',$this->get_availability_page_content(),$content);
        if (strrpos($content,'[lodgix search_rentals]') > 0)
            $content = str_replace('[lodgix search_rentals]',$this->get_search_rentals_page_content(),$content);        
  
        if (strrpos($content,'[lodgix area de ') !==  false)
            $content = str_replace($content,$this->get_area_page_content($content),$content);          
        else if (strrpos($content,'[lodgix area ') !==  false)
            $content = str_replace($content,$this->get_area_page_content($content),$content);        
          
        return $content;
    }
    
    function cmp_menu_order($a,$b)
    {
        if ($a->menu_order == $b->menu_order)
            return 0;
        else if ($a->menu_order > $b->menu_order)
            return 1;     
        else if ($a->menu_order < $b->menu_order)
            return -1;           
    }
    
    function p_lodgix_nav_menus($items, $menu, $args)
    { 
      global $wpdb;
      
      if (!strrpos($_SERVER['SCRIPT_NAME'],'nav-menus'))
      {
      
        $pos1 = $this->options['p_lodgix_vacation_rentals_page_pos'];
        $pos2 = $this->options['p_lodgix_availability_page_pos'];

        if ($pos1 != '-1')
        {
            foreach($items as $item)
            { 
                if ($item->menu_order >= $pos1)
                {
                    $item->menu_order++;
                }
            }
        }
        if ($pos2 != '-1')
        {
            foreach($items as $item)
            { 
                if ($item->menu_order >= $pos2)
                {
                    $item->menu_order++;
                }
            }      
        }
  
        if ($this->locale == 'en_US')
        {
            if ($pos1 != '-1')
            {
                $post = get_post($this->options['p_lodgix_vacation_rentals_page_en']);
                $item = wp_setup_nav_menu_item($post,'post_type');
                $item->menu_order = $pos1;
                $items[] = $item;
            }
            if ($pos2 != '-1')
            {         
                $post = get_post($this->options['p_lodgix_availability_page_en']);
                $item = wp_setup_nav_menu_item($post);
                $item->menu_order = $pos2;
                $items[] = $item;    
            } 
        }
        else
        {
   
            if ($pos1 != '-1')
            {
                $post_id = $wpdb->get_var("SELECT page_id FROM " . $this->lang_pages_table . " WHERE property_id=-1 AND language_code='" . $this->sufix. "'");
                $post = get_post($post_id);
                $item = wp_setup_nav_menu_item($post);
                $item->menu_order = $pos1;
                $items[] = $item;
            }
            if ($pos2 != '-1')
            {  
                $post_id = $wpdb->get_var("SELECT page_id FROM " . $this->lang_pages_table . " WHERE property_id=-2 AND language_code='" . $this->sufix. "'");
                $post = get_post($post_id);
                $item = wp_setup_nav_menu_item($post);
                $item->menu_order = $pos2;
                $items[] = $item;   
            }              
        }
        
        usort( $items, array(&$this,'cmp_menu_order'));
       }
       

       
       return $items;

    }
 
    function p_lodgix_remove_pages_from_list($excludes) {       
        global $wpdb;
        $posts = $wpdb->get_results('SELECT * FROM ' . $this->pages_table);   
        foreach($posts as $post)        
        {
            if (!$post->enabled)
            {
                array_push($excludes,$post->page_id);
            }
        }
        return $excludes;
    } 

    function p_lodgix_sort_vr()
    {
        global $wpdb;
        
        $this->p_lodgix_load_locale();
        
        $sort = $_POST['sort'];
        $language = $_POST['lang'];
        $area = $_POST['area'];
        $content = $this->get_vacation_rentals_html($sort,$area);      
        die($content);
    }
    

    function p_lodgix_init() {
        $this->p_plugin_path = plugin_dir_url(plugin_basename(__FILE__));	
        $this->p_lodgix_load_locale();
        //if ($this->options['p_lodgix_bing_translator_key']) {
        //    $this->translator = new LodgixTranslator($this->options['p_lodgix_bing_translator_key']);
        //}
    }
        
    function p_is_lodgix_page($id)
    {
    	global $wpdb;
    	
        $active_languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
 
        foreach ($active_languages as $l) {
            switch ($id)
            {
                case $this->options['p_lodgix_vacation_rentals_page_' . $l->code]:  return true;
                                                                            break;	
        
                case $this->options['p_lodgix_vacation_rentals_page_' . $l->code]:   return true;
                                                                                break;	
        
                case $this->options['p_lodgix_availability_page_' . $l->code]:  return true;
                                                                                break;	
            }            
        }
        
            	             	
    	$post_id = $wpdb->get_var("SELECT page_id FROM " . $this->pages_table . " WHERE page_id=" . $id);
    	if ($post_id == $id)
    	  return true;

    	$post_id = $wpdb->get_var("SELECT page_id FROM " . $this->lang_pages_table . " WHERE page_id=" . $id);    	    	
    	if ($post_id == $id)
    	  return true;
          
        foreach ($active_languages as $l) {
            $areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);
            if (is_array($areas_pages)) {
                foreach($areas_pages as $key => $page)
                {
                    if ($page->page_id == $id)
                      return true;
                }
            }
        }
    	
    	return false;
    }
      
    function p_lodgix_template_redirect()
    {
    	global $wp_query;
        wp_enqueue_script('p_lodgix_jquery',$this->p_plugin_path . 'js/jquery_lodgix.js');
        wp_enqueue_script('p_lodgix_jqueryui',$this->p_plugin_path . 'js/jquery-ui-lodgix.min.js');        	
        wp_enqueue_style('p_lodgix_jqueryui_css',$this->p_plugin_path . 'css/jquery-ui-1.8.17.custom.css');      
                
        wp_enqueue_script('jquery');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');      
        
        wp_enqueue_style('p_lodgix_royalslider',$this->p_plugin_path . 'gallery/css/lodgixroyalslider.css');
        wp_enqueue_style('p_lodgix_royalslider_skins_default',$this->p_plugin_path . 'gallery/royalslider-skins/default/default.css');      
        wp_enqueue_style('p_lodgix_royalslider_skins_iskin',$this->p_plugin_path . 'gallery/royalslider-skins/iskin/iskin.css');      
        wp_enqueue_script('p_lodgix_easing',$this->p_plugin_path . 'gallery/js/jquerylodgix.easing.min.js');
        wp_enqueue_script('p_lodgix_royal',$this->p_plugin_path . 'gallery/js/lodgixroyal-slider.min.js');
                    
        wp_enqueue_script('p_lodgix_fancybox',$this->p_plugin_path . 'gallery/jquery.fancybox-1.3.4.pack.js');
        wp_enqueue_script('p_lodgix_jquery_corner',$this->p_plugin_path . 'js/jquery.corner.js');          	  
        wp_enqueue_script('p_lodgix_jquery_swf_object',$this->p_plugin_path . 'js/jquery.swfobject.js');            	    
        wp_enqueue_script('p_lodgix_jquery_ceebox',$this->p_plugin_path . 'js/jquery.ceebox.js');        

        wp_enqueue_script('p_lodgix_jquery_responsive_table_js',$this->p_plugin_path . 'js/jquery.lodgix-responsive-table.js');
        wp_enqueue_script('p_lodgix_jquery_text_expander_js',$this->p_plugin_path . 'js/jquery.lodgix-text-expander.js');

    	if ($this->p_is_lodgix_page($wp_query->post->ID))
        {	        	
        	if ($this->options['p_lodgix_custom_page_template'] && $this->options['p_lodgix_custom_page_template'] != '') {
        		$template = WP_CONTENT_DIR . '/' . $this->options['p_lodgix_custom_page_template'];
        		if (file_exists($template)) {        		 	
 					include($template);       
 					die();           
                }       		
        	}
        	else
            {
                $current_theme = get_current_theme();
                if ($this->options['p_lodgix_thesis_compatibility'])
                {        	
                    include('thesis_no_sidebars.php');
                    die();
                }
                else if ($this->options['p_lodgix_thesis_2_compatibility'])
                {
            
                }
                else if ($current_theme  == "FlexSqueeze")
                {
                    
                }        
                else if ($current_theme  == "pureVISION")
                {        
                    include('purevision_page_template.php');
                    die();        	
                }        
                else
                {
                    include('lodgix_page_template.php');
                    die();
                }
            }
        }
    } 


    function p_lodgix_header_code() {            
        global $post;
        global $wpdb;
                        
        $post_id = $post->ID;
        echo "\n".'<!-- Start Lodgix -->'."\n";    
        if (!$this->options['p_lodgix_thesis_compatibility'] && !$this->options['p_lodgix_thesis_2_compatibility'])
        {
 
            if ($post_id == $this->options['p_lodgix_vacation_rentals_page_en'])
            {
                if ($this->options['p_lodgix_vr_title'])
  					      echo '<title>' . trim(wptexturize($this->options['p_lodgix_vr_title'])) . '"</title>';            
                if ($this->options['p_lodgix_vr_meta_description'])
  					      echo '<meta name="description" content="' . trim(wptexturize($this->options['p_lodgix_vr_meta_description'])) . '" />';
  				      if ($this->options['p_lodgix_vr_meta_keywords'])
  					      echo '<meta name="keywords" content="' . trim(wptexturize($this->options['p_lodgix_vr_meta_keywords'])) . '" />';
  					  }
  					  else
  					  {
  					  	$properties = $wpdb->get_results('SELECT description,description_long,city,area FROM ' . $this->properties_table . ' WHERE post_id=' . $post_id);  
  					  	if ($properties)
  					  	{
  					  		$property = $properties[0];
  					  		echo '<meta name="description" content="' . trim(wptexturize($this->truncate_text($property->description_long,150))) . '" />';
  					  		$keywords = $property->description . ', vacation rental, vacation home, vacation, homes, rentals, cottages, condos, holiday';
  					  		if ($property->city != "")
  					  			$keywords .= ', ' . $property->city;
  					  		echo '<meta name="keywords" content="' . trim(wptexturize($keywords)) . '" />';
  					  	}
  					  }
					}
    
            echo '<link type="text/css" rel="stylesheet" href="' . $this->p_plugin_path  . 'css/directory.php" />' . "\n";            
            $css_path = WP_CONTENT_DIR;
            if (file_exists($css_path  . '/lodgix-custom.css'))
        		{
            	echo '<link type="text/css" rel="stylesheet" href="' . WP_CONTENT_URL  . '/lodgix-custom.css" />' . "\n";                    			
        	  }
            ?><script type="text/javascript">
                 function p_lodgix_sort_vr(val,filter)                 
                 {
                 	if (!filter)
                 		filter = '';
                   jQueryLodgix.ajax({
                      type: "POST",
                      url: "<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",
                      data: "action=p_lodgix_sort_vr&sort=" + jQueryLodgix('#lodgix_sort').val() + "&lang=" + val + "&area=" + filter,
                      success: function(response){
                        jQueryLodgix('#content_lodgix').html(response);
                      }
                   });
                 }
              </script>
              <script language="javascript">
									<!--
										jQueryLodgix(document).ready(
											function (){
												var a = function(self){
												self.anchor.fancybox();
											};
											
											jQueryLodgix('#lodgix-image-gallery').royalSlider({
										    		captionShowEffects:["fade"],
													controlNavThumbs:true,																	
													directionNavEnabled: true,
													welcomeScreenEnabled:false,
													hideArrowOnLastSlide:true,
    												autoScaleSlider: true,
    												autoScaleSliderWidth: 640,
    												autoScaleSliderHeight: 480
										    });	 
											
											if (location.hash != '')
												location.hash = location.hash;
												
											jQueryLodgix(".ceebox").ceebox({videoGallery:'false'});
										});
				
							-->
							</script>

            <?php
            echo '<!-- End Of Lodgix -->'."\n";
    }

    function p_lodgix_deactivate() {  
	  	
	  } 
		
    function p_lodgix_activate() {
		global $wpdb;
		if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
            $this->p_lodgix_build();
        }     
    }
	

    function p_lodgix_clean() {    	 
        global $wpdb;
        $this->clean_all();
        
        $table_name = $wpdb->prefix . "lodgix_properties";
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);     
        }      
        $table_name = $wpdb->prefix . "lodgix_lang_properties";
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);     
        }            
        $table_name = $wpdb->prefix . "lodgix_amenities";
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);
        }
        $table_name = $wpdb->prefix . "lodgix_pictures";
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }            
        $table_name = $wpdb->prefix . "lodgix_rates";
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }
        $table_name = $wpdb->prefix . "lodgix_rules";
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }      
        $table_name = $wpdb->prefix . "lodgix_pages";
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }      
        $table_name = $wpdb->prefix . "lodgix_lang_pages";
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }                  
        $table_name = $wpdb->prefix . "lodgix_policies";    
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }                    
        $table_name = $wpdb->prefix . "lodgix_fees";
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }          
        $table_name = $wpdb->prefix . "lodgix_taxes";
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }          
        $table_name = $wpdb->prefix . "lodgix_deposits";   
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }    
        $table_name = $wpdb->prefix . "lodgix_reviews";   
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }                   
        $table_name = $wpdb->prefix . "lodgix_link_rotators";   
        if($wpdb->get_var("show tables like '$table_name'") == $table_name) {
         $sql = "DROP TABLE " . $table_name . ";"; 
         $wpdb->query($sql);      
        }                                    
        //$this->p_lodgix_build();
    }

    function p_lodgix_script() {
      if (is_admin()){ 
        wp_enqueue_script('p_lodgix_jquery',$this->p_plugin_path . 'js/jquery_lodgix.js');      	
        wp_enqueue_script('jquery'); 
       	wp_enqueue_script('jquery-validate',$this->p_plugin_path . 'js/jquery.validate.min.js');        
        wp_enqueue_script('p_lodgix_script', $this->url.'?p_lodgix_javascript'); 
        wp_localize_script( 'p_lodgix_script', 'p_lodgix_lang', array(
          'required' => __('Field is required.', $this->localizationDomain),
          'number'   => __('Please enter a number.', $this->localizationDomain),
          'min'      => __('Please enter a value greater than or equal to 1.', $this->localizationDomain),
        ));
      }
      
    }
      /**
      * @desc Retrieves the plugin options from the database.
      * @return array
      */
      function getOptions() {
          if (!$theOptions = get_option($this->optionsName)) {
                $theOptions = array('p_lodgix_owner_id'=> NULL,
                                    'p_lodgix_api_key'=> NULL,
                                    'p_lodgix_allow_comments' => false,
                                    'p_lodgix_allow_pingback' => false,
                                    'p_lodgix_display_daily_rates' => true,
                                    'p_lodgix_display_featured_horizontally' => 0,
                                    'p_lodgix_display_icons' => false,
                                    'p_lodgix_display_title' => 'name',
                                    'p_lodgix_display_featured' => 'city',
                                    'p_lodgix_display_multi_instructions' => 0,
                                    'p_lodgix_display_single_instructions' => 0,
                                    'p_lodgix_rates_display' => 0,                                  
                                    'p_lodgix_single_page_design' => 0,                                                                    
                                    'p_lodgix_vacation_rentals_page_pos' => '3',
                                    'p_lodgix_availability_page_pos' => '4',                                  
                                    'p_lodgix_thesis_compatibility' => false,
                                    'p_lodgix_thesis_2_compatibility' => false,
                                    'p_lodgix_date_format' => '%m/%d/%Y',
                                    'p_lodgix_time_format' => '12',
                                    'p_lodgix_root_width' => '699',
                                    'p_lodgix_root_height' => '400',                   
                                    'p_lodgix_show_header' => '0',
                                    'p_lodgix_block_corner_rad' => 'null',   
                                    'p_lodgix_days_number' => '30',
                                    'p_lodgix_row_number' => '7',                   
                                    'p_lodgix_cell_color_serv' => 'ff0000',
                                    'p_lodgix_cell_color' => '00ff00',                                        
                                    'p_lodgix_show_email' => '0',    
                                    'p_lodgix_show_site' => '0',
                                    'p_lodgix_name_col_width' => '150',                  
                                    'p_lodgix_labels_font_size' => '15',
                                    'p_lodgix_use_property_hyperlinks' => '1', 
                                    'p_lodgix_title_size' => '24',
                                    'p_lodgix_vr_title' => 'Vacation Rentals',                                    
                                    'p_lodgix_vr_meta_description' => NULL,
                                    'p_lodgix_vr_meta_keywords' => NULL,
                                    'p_lodgix_full_size_thumbnails' => false,
                                    'p_lodgix_custom_page_template' => '',
                                    'p_lodgix_thesis_2_template' => ''                                                                                                    
                                  );
              update_option($this->optionsName, $theOptions);
              
          }
          $this->options = $theOptions;
      }
      
      /**
      * Saves the admin options to the database.
      */
      function saveAdminOptions(){
          return update_option($this->optionsName, $this->options);
      }
      
      /**
      * Clears the admin options in the database.
      */
      function clearAdminOptions(){
          $theOptions = array('p_lodgix_owner_id'=> NULL,
                              'p_lodgix_api_key'=> NULL,
                              'p_lodgix_vacation_rentals_page_en' => NULL,
                              'p_lodgix_vacation_rentals_page_de' => NULL,
                              'p_lodgix_availability_page_en' => NULL,
                              'p_lodgix_availability_page_de' => NULL,
                              'p_lodgix_search_rentals_page' => NULL,
                              'p_lodgix_search_rentals_page_de' => NULL,                            
                              'p_lodgix_allow_comments' => false,
                              'p_lodgix_allow_pingback' => false,
                              'p_lodgix_display_daily_rates' => true,
                              'p_lodgix_display_featured_horizontally' => 0,
                              'p_lodgix_display_icons' => false,
                              'p_lodgix_display_title' => 'name',
                              'p_lodgix_display_featured' => 'city',
                              'p_lodgix_display_multi_instructions' => 0,
                              'p_lodgix_display_single_instructions' => 0,
                              'p_lodgix_rates_display' => 0,                              
                              'p_lodgix_single_page_design' => 0,
                              'p_lodgix_vacation_rentals_page_pos' => '3',                                                             
                              'p_lodgix_availability_page_pos' => '4',
                              'p_lodgix_thesis_compatibility' => false,
                              'p_lodgix_thesis_2_compatibility' => false,
                              'p_lodgix_date_format' => 'm/d/Y',
                              'p_lodgix_time_format' => '12',
                              'p_lodgix_root_width' => '699',
                              'p_lodgix_root_height' => '400',                   
                              'p_lodgix_show_header' => '0',
                              'p_lodgix_block_corner_rad' => 'null',   
                              'p_lodgix_days_number' => '30',
                              'p_lodgix_row_number' => '7',                   
                              'p_lodgix_cell_color_serv' => 'ff0000',
                              'p_lodgix_cell_color' => '00ff00',                                        
                              'p_lodgix_show_email' => '0',    
                              'p_lodgix_show_site' => '0',
                              'p_lodgix_name_col_width' => '150',                  
                              'p_lodgix_labels_font_size' => '15',
                              'p_lodgix_use_property_hyperlinks' => '1', 
                              'p_lodgix_title_size' => '24', 
                              'p_lodgix_vr_title' => 'Vacation Rentals',
                              'p_lodgix_vr_meta_description' => NULL,
                              'p_lodgix_vr_meta_keywords' => NULL,
                              'p_lodgix_custom_page_template' => '',
                              'p_lodgix_thesis_2_template' => '',                              
                              'p_lodgix_full_size_thumbnails' => false                                                              
                              );
          return update_option($this->optionsName, $theOptions);
      }      
      
      /*
       Constucts SQL insert statment from array
      */
      function get_insert_sql_from_array($table, $data) {
        foreach ($data as $field=>$value) {
          $fields[] = '`' . $field . '`';
          $values[] = "'" . @mysql_real_escape_string($value) . "'";
        }
        $field_list = join(',', $fields);
        $value_list = join(', ', $values);
        
        $query = "INSERT INTO `" . $table . "` (" . $field_list . ") VALUES (" . $value_list . ")";
        $query = str_replace("'None'","NULL",$query);
        return $query;
      }

      /*
       Constucts SQL update statment from array
      */
      function get_update_sql_from_array($table, $data, $pk) {
        foreach ($data as $field=>$value) {
          $fields_values[] = "`" . $field . "`='" . @mysql_real_escape_string($value) . "'";
        }
        $fields_values_list = join(',', $fields_values);
        
        $query = "UPDATE `" . $table . "` SET " . $fields_values_list . " WHERE id=" . $pk;
        
        return $query;
      }
      
      /*
       Converts XML document to Array
      */
      function domToArray($root) {
          $result = array();
      
          if ($root->hasAttributes())
          {
              $attrs = $root->attributes;
      
              foreach ($attrs as $i => $attr)
                  $result[$attr->name] = $attr->value;                 
          }
      
          $children = $root->childNodes;      
          if ($children->length == 1)
          {
              $child = $children->item(0);
      
              if ($child->nodeType == XML_TEXT_NODE)
              {
                  $result['_value'] = $child->nodeValue;
      
                  if (count($result) == 1)
                      return $result['_value'];
                  else
                      return $result;
              }
              else if ($child->nodeType == XML_CDATA_SECTION_NODE)
              {
                  $result['_value'] = $child->nodeValue;                           
              }
          }
      
        $group = array();      
        for($i = 0; $i < $children->length; $i++)
        {
            $child = $children->item($i);
      
            if (!isset($result[$child->nodeName]))
            {
                $result[$child->nodeName] = $this->domToArray($child);
            }
            else
            {
                if (!isset($group[$child->nodeName]))
                {
                    $tmp = $result[$child->nodeName];
                    $result[$child->nodeName] = array($tmp);
                        
                    $group[$child->nodeName] = 1;
                }
      
                $result[$child->nodeName][] = $this->domToArray($child);       
            }
        }
          
        return $result;
      }

      /**
      * @desc Adds the options subpanel
      */
      function admin_menu_link() {
          add_options_page('Lodgix Settings', 'Lodgix Settings', 10, basename(__FILE__), array(&$this,'admin_options_page'));
          add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'filter_plugin_actions'), 10, 2 );
      }

      /**
      * @desc Adds the Settings link to the plugin activate/deactivate page
      */
      function filter_plugin_actions($links, $file) {
         $settings_link = '<a href="options-general.php?page=' . basename(__FILE__) . '">' . __('Settings',$this->localizationDomain) . '</a>';
         array_unshift( $links, $settings_link ); // before other links

         return $links;
      }

      function clear_tables()
      {
        global $wpdb;     
        
        $sql = "DELETE FROM " . $this->properties_table;
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $this->amenities_table;
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $rates_table;
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $this->merged_rates_table;
        $wpdb->query($sql);        
        $sql = "DELETE FROM " . $this->rules_table;
        $wpdb->query($sql);          
        $sql = "DELETE FROM " . $this->pictures_table;
        $wpdb->query($sql);      
        $sql = "DELETE FROM " . $this->pages_table;
        $wpdb->query($sql); 
        $sql = "DELETE FROM " . $this->lang_pages_table;
        $wpdb->query($sql);         
        $sql = "DELETE FROM " . $this->properties_lang_table;
        $wpdb->query($sql);        
        $sql = "DELETE FROM " . $this->policies_table;
        $wpdb->query($sql);                     
        $sql = "DELETE FROM " . $this->taxes_table;
        $wpdb->query($sql);         
        $sql = "DELETE FROM " . $this->fees_table;
        $wpdb->query($sql);        
        $sql = "DELETE FROM " . $this->deposits_table;
        $wpdb->query($sql);    
        $sql = "DELETE FROM " . $this->reviews_table;
        $wpdb->query($sql);   
        $sql = "DELETE FROM " . $this->lang_amenities_table;
        $wpdb->query($sql);                             
      }

      function update_tables($property, $pos, $searchableAmenities) {
        global $wpdb;
           
                
        $sql = "DELETE FROM " . $this->amenities_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $this->rates_table . " WHERE property_id=" . $property['ID'];        
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $this->merged_rates_table . " WHERE property_id=" . $property['ID'];        
        $wpdb->query($sql);        
        $sql = "DELETE FROM " . $this->rules_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);          
        $sql = "DELETE FROM " . $this->pictures_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $this->lang_properties_table . " WHERE id=" . $property['ID'];
        $wpdb->query($sql);       
        $sql = "DELETE FROM " . $this->taxes_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);         
        $sql = "DELETE FROM " . $this->fees_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);        
        $sql = "DELETE FROM " . $this->deposits_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);   
        $sql = "DELETE FROM " . $this->reviews_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);                          
        
        if (($property['ServingStatus'] != "ACTIVE") || ($property['WordpressStatus'] != "ACTIVE"))
            return 0;
               
        $parray = $this->property_array;
        $parray['id'] = $property['ID'];
        $parray['owner_id'] = $property['OwnerID'];
        $parray['currency_symbol'] = $property['CurrencyCode']['symbol'];
        $parray['currency_code'] = $property['CurrencyCode']["_value"];
        
        $addr = $property['Address'];
        if ($addr['Country'])
        {
          $parray['country_code'] = $addr['Country']['code'];
        }          
        if ($addr['State'])
        {
          $parray['state'] = $addr['State']['_value'];
          $parray['state_code'] = $addr['State']['code'];
        }          
        $parray['address'] = '';
        if ($addr['Street1'])
        {
          $parray['address'] = $addr['Street1'];
        }          
        if ($addr['Street2'])
        {
          $parray['address'] .= '\n' . $addr['Street1'];
        }        
        $parray['city'] = $addr['City'];
        $parray['area'] = $addr['Area'];
        $parray['zip'] = $addr['PostalCode'];
        $parray['latitude'] = $addr['Latitude'];
        $parray['longitude'] = $addr['Longitude'];
        if (!$parray['latitude'])
          $parray['latitude'] = -1;
        if (!$parray['longitude'])
          $parray['longitude'] = -1;          
        
        $parray['smoking'] = 0;
        $parray['pets'] = 0;
        $parray['children'] = 0;
        $parray['order'] = $pos;
        $conditions = $property['Conditions']['Condition'];
        if (is_array($conditions))
        {
            foreach ($conditions as $condition)
            {
              $name = strtolower($condition['Name']);
              if ($condition['Value'] == 'Allowed')
              {
                $parray[$name] = 1;
              }
            }
        }
        $parray['serving_status'] = 1;
        $parray['display_calendar'] = 1;
        $parray['allow_booking'] = 1;             
        if (($property['ServingStatus'] == 'PAUSED') || ($property['WordpressStatus'] == 'PAUSED'))
        {
           $parray['serving_status'] = 0;
        }
        if ($property['DisplayCalendar'] != 'NO')
        {
           $parray['display_calendar'] == 0;
        }
        if ($property['AllowBooking'] == 'NO')
        {
           $parray['allow_booking'] = 0;
        }
        if ($this->options['p_lodgix_display_title'] == 'name')
          $parray['description'] = $property['Name'];
        else
          $parray['description'] = $property['MarketingTitle'];
        $parray['description_long'] = $property['MarketingTeaser']['_value'];
        $parray['details'] = $property['Description']['_value'];
        $parray['bedrooms'] = $property['Bedrooms'];
        $parray['bathrooms'] = $property['Baths'];
        $parray['sleeps'] = $property['MaxGuests'];
        $parray['web_address'] = $property['URL'];
        $parray['proptype'] = $property['PropertyType'];
        
        $parray['check_in'] = $property['CheckIn'];
        $parray['check_out'] = $property['CheckOut'];
        $parray['video_url'] = $property['VideoURL'];
        $parray['virtual_tour_url'] = $property['VirtualToursURL'];
        
        $beds = $property['Beds'];
        if ($property['Beds']['Bed'][0])
            $beds = $property['Beds']['Bed'];    
        $beds_text = '';      
        if ($beds)
        {
            foreach ($beds as $bed)
            { 
                $beds_text .= $bed['Quantity'] . ' ' . $bed['Type'] . '(s), ';             	
            }     
            if (strlen($beds_text) > 0)
            {
                $beds_text = substr($beds_text,0,strlen($beds_text)-2); 
            }
        }      
        $parray['beds_text'] = $beds_text;        
             
        $photos = $property['Photos'];
        if ($property['Photos']['Photo'][0])
            $photos = $property['Photos']['Photo'];             
        $pharray = $pictures_array;
        $pos = 1;
        foreach ($photos as $photo)
        { 
        	$photo['URL'] = str_replace('media/gallery','photo/0/gallery',$photo['URL']);
          if ($pos == 1)
          {
            $parray['main_image'] = $photo['URL'];
            $parray['main_image_thumb'] = $photo['ThumbnailURL'];
          }
          $pharray['property_id'] = $parray['id'];
          $pharray['url'] = $photo['URL'];
          $pharray['thumb_url'] = $photo['ThumbnailURL'];
          $pharray['caption'] = $photo['Title'];
          $pharray['position'] = $pos;
          $pos++;
          $sql = $this->get_insert_sql_from_array($this->pictures_table,$pharray);   
          $wpdb->query($sql);                    
        }

        $sql = $this->get_insert_sql_from_array($this->properties_table,$parray);
        $exists = (int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(id) FROM " . $this->properties_table . " WHERE id=" . $parray['id'] . ";",null));        
        if ($exists > 0)        
          $sql = $this->get_update_sql_from_array($this->properties_table,$parray,$parray['id']);      
        $wpdb->query($sql);   
        
        $amenities = $property['Amenities'];
        if ($property['Amenities']['Amenity'][0])
            $amenities = $property['Amenities']['Amenity'];          
        $amarray = $amenities_array;
        if ($amenities)
        {
            foreach ($amenities as $amenity)
            { 
                if ($amenity['Value'] == 'Available')
                {
                    $amarray['property_id'] = $parray['id'];
                    $amarray['description'] = $amenity['Name'];
                    $sql = $this->get_insert_sql_from_array($this->amenities_table,$amarray);
                    $wpdb->query($sql);
                    
                    $active_languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
                    foreach($active_languages as $l)
                    {                    
                        if ($amenity['Amenity' . strtoupper($l->code)])
                        {
                          $alrarray = array();
                          $alrarray['description'] = $amenity['Name'];
                          $alrarray['description_translated'] = $amenity['Amenity' . strtoupper($l->code)];
                          $alrarray['language_code'] = $l->code;
                          $alrarray['searchable'] = $searchableAmenities[$amenity['Name']] ? 1 : 0;
                          $sql = $this->get_insert_sql_from_array($this->lang_amenities_table,$alrarray);
                          $wpdb->query($sql);                    	
                        }
                    }
                }
            }     
        }               
        
        $rates = $property['Rates'];
        if ($property['Rates']['Rate'][0])
            $rates = $property['Rates']['Rate'];          
        $ratearray = $rates_array;
        foreach ($rates as $rate)
        {     
            $ratearray['property_id'] = $parray['id'];
            $ratearray['name'] = $rate['RateName'];
            $ratearray['from_date'] = $rate['StartDate'];
            $ratearray['to_date'] = $rate['EndDate'];
            if ($rate['SundayRate'] != 'None')
                $ratearray['sunday_rate'] = $rate['SundayRate'];
            else
                $ratearray['sunday_rate'] = 'NULL';
            if ($rate['MondayRate'] != 'None')
                $ratearray['monday_rate'] = $rate['MondayRate'];
            else
                $ratearray['monday_rate'] = 'NULL';
            if ($rate['TuesdayRate'] != 'None')
                $ratearray['tuesday_rate'] = $rate['TuesdayRate'];
            else
                $ratearray['tuesday_rate'] = 'NULL';              
            if ($rate['WednesdayRate'] != 'None')
              $ratearray['wednesday_rate'] = $rate['WednesdayRate'];
            else
              $ratearray['wednesday_rate'] = 'NULL';
              
            if ($rate['ThursdayRate'] != 'None')
              $ratearray['thursday_rate'] = $rate['ThursdayRate'];
            else
              $ratearray['thursday_rate'] = 'NULL';
            if ($rate['FridayRate'] != 'None')
              $ratearray['friday_rate'] = $rate['FridayRate'];
            else
              $ratearray['friday_rate'] = 'NULL';
            if ($rate['FridayRate'] != 'None')
              $ratearray['friday_rate'] = $rate['FridayRate'];
            else
              $ratearray['friday_rate'] = 'NULL';
            if ($rate['SaturdayRate'] != 'None')
              $ratearray['saturday_rate'] = $rate['SaturdayRate'];
            else
              $ratearray['saturday_rate'] = 'NULL';                
            $ratearray['min_nights'] = $rate['WeeklyRate'];              
            $ratearray['default_rate'] = $rate['DefaultRate'];              
            $ratearray['is_default'] = 0;
            if ($rate['IsThisDefaultRate'] == 'Yes')
                $ratearray['is_default'] = 1;          
            $sql = $this->get_insert_sql_from_array($rates_table,$ratearray);
            $sql = str_replace("'NULL'","NULL",$sql);
            $wpdb->query($sql);    
            $pprates = $rate['PerPersonRates'];
            if ($pprates)
            {
	        		if ($rate['PerPersonRates']['PerPersonRate'][0])
	            	$pprates = $rate['PerPersonRates']['PerPersonRate'];
			
		          foreach ($pprates as $ppr)            
		        	{        		
                                $ratearray['default_rate'] = $ppr['Amount'];
		           	$sql = $this->get_insert_sql_from_array($rates_table,$ratearray);
		            	$sql = str_replace("'NULL'","NULL",$sql);
		            	$wpdb->query($sql);            			
		        	}
	        	}
            
        }    
        
        
        $merged_rates = $property['MergedRates'];
        if ($property['MergedRates']['RatePeriod'][0])
            $merged_rates = $property['MergedRates']['RatePeriod'];          
        
        foreach ($merged_rates as $rate)
        {
            $mergedratesarray = $merged_rates_array;
            $mergedratesarray['property_id'] = $parray['id'];
            $mergedratesarray['name'] = $rate['RateName'];
            $mergedratesarray['from_date'] = $rate['StartDate'];
            $mergedratesarray['to_date'] = $rate['EndDate'];             
            $mergedratesarray['min_stay'] = $rate['MinimumStay'];              
            $mrates = $rate['Rates'];
            if ($mrates)
            {
                if ($rate['Rates']['Rate'][0])
                    $mrates = $rate['Rates']['Rate'];
			
                foreach ($mrates as $mr)            
                {
                    $mergedratesarray['rate_type'] = $mr['RateType'];
                    if ($mr['RateType'] == 'NIGHTLY_WEEKDAY')
                        $mergedratesarray['nightly'] = $mr['Amount'];
                    else if ($mr['RateType'] == 'NIGHTLY_WEEKEND')
                        $mergedratesarray['weekend_nightly'] = $mr['Amount'];
                    else if ($mr['RateType'] == 'WEEKLY')
                        $mergedratesarray['weekly'] = $mr['Amount'];		        				
                    else if ($mr['RateType'] == 'MONTHLY')
                    $mergedratesarray['monthly'] = $mr['Amount'];		        				

                }
	    }
   
            $sql = $this->get_insert_sql_from_array($this->merged_rates_table,$mergedratesarray);
            $sql = str_replace("'NULL'","NULL",$sql);
            $wpdb->query($sql);    
            
        }            
        
        $rules = $property['Rules'];
        if ($property['Rules']['Rule'][0])
            $rules = $property['Rules']['Rule'];
        $rulearray = $rules_array;
        foreach ($rules as $rule)
        {     
            $rulearray['property_id'] = $parray['id'];
            $rulearray['name'] = $rule['RuleName'];
            $rulearray['from_date'] = $rule['StartDate'];              
            $rulearray['to_date'] = $rule['EndDate'];            
            $rulearray['min_nights'] = $rule['MinimumNights'];                         
            $rulearray['is_default'] = 0;
            if ($rule['IsThisDefaultRule'] == 'Yes')
                $rulearray['is_default'] = 1;          
            $sql = $this->get_insert_sql_from_array($this->rules_table,$rulearray);
            $wpdb->query($sql);       
        }    
        
        $low_daily_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 1 AND property_id = " . $parray['id'] . ";",null));        
        $low_weekly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 7 AND property_id = " . $parray['id'] . ";",null));
        $low_monthly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 30 AND property_id = " . $parray['id'] . ";",null));
        $sql = 'UPDATE ' . $this->properties_table .' SET min_daily_rate=' . $low_daily_rate . ',min_weekly_rate=' . $low_weekly_rate . ',min_monthly_rate=' . $low_monthly_rate . ' WHERE id=' . $parray['id'];
        $wpdb->query($sql);        

        $remote_languages = $property['Languages'];
        if ($property['Languages']['Language'][0])
            $remote_languages = $property['Languages']['Language'];      

        if ($remote_languages)
        {
            foreach ($remote_languages as $rlanguage)
            {    

                $langarray = array();
                $langarray['id'] = $parray['id'];
                $langarray['language_code'] = strtolower($rlanguage['LanguageCode']); 
                if ($this->options['p_lodgix_display_title'] == 'name')
                  $langarray['description'] = $rlanguage['Name'];
                else
                  $langarray['description'] = $rlanguage['MarketingTitle'];             
                $langarray['description_long'] = $rlanguage['MarketingTeaser']['_value']; 
                $langarray['details'] = $rlanguage['Description']['_value']; 
                $sql = $this->get_insert_sql_from_array($this->lang_properties_table,$langarray);
                $wpdb->query($sql);     
            }
        }
        
        $active_languages = $wpdb->get_results("SELECT * FROM " . $this->languages_table . " WHERE enabled = 1 and code <> 'en'");
        //if ($active_languages && $this->options['p_lodgix_bing_translator_key']) {
        if ($active_languages) {
            //$this->translator = new LodgixTranslator($this->options['p_lodgix_bing_translator_key']);
            foreach($active_languages as $l) {
                
                $description_en = $wpdb->get_var("SELECT description FROM " . $this->properties_table . " WHERE id=" . $parray['id']);
                $description_long_en = $wpdb->get_var("SELECT description_long FROM " . $this->properties_table . " WHERE id=" . $parray['id']);
                $details_en = $wpdb->get_var("SELECT details FROM " . $this->properties_table . " WHERE id=" . $parray['id']);
                
                
                $langarray = array();
                $langarray['id'] = $parray['id'];
                $langarray['language_code'] = strtolower($l->code);            
                $langarray['description'] = $description_en;
                $langarray['description_long'] = $description_long_en;
                $langarray['details'] = $details_en;
                $sql = $this->get_insert_sql_from_array($this->lang_properties_table,$langarray);
                $wpdb->query($sql);     
                
                //$description = $wpdb->get_var("SELECT description FROM " . $this->lang_properties_table . " WHERE id=" . $parray['id'] . " AND language_code='" . $l->code. "'");
                //
                //if (!$description || $description == $description_en) {
                //    
                //    $translated = $this->translator->translate('en',$l->code,$description_en);                    
                //                        
                //    $sql = "UPDATE " . $this->lang_properties_table . " SET description = '" . $translated . "' WHERE id=" . $parray['id'] . " AND language_code='" . $l->code. "';";
                //    $wpdb->query($sql); 
                //}
                //
                //$description_long = $wpdb->get_var("SELECT description_long FROM " . $this->lang_properties_table . " WHERE id=" . $parray['id'] . " AND language_code='" . $l->code. "'");                    
                //
                //if (!$description_long || $description_long == $description_long_en) {                                        
                //    
                //    $translated = $this->translator->translate('en',$l->code,$description_long_en);                    
                //    
                //    $sql = "UPDATE " . $this->lang_properties_table . " SET description_long = '" . $translated . "' WHERE id=" . $parray['id'] . " AND language_code='" . $l->code. "';";
                //    die($sql);
                //    $wpdb->query($sql); 
                //}
                //
                //$details = $wpdb->get_var("SELECT description_long FROM " . $this->lang_properties_table . " WHERE id=" . $parray['id'] . " AND language_code='" . $l->code. "'");                
                //if (!$details || $details == $details_en) {
                //
                //    $translated = $this->translator ->translate('en',$l->code,$details_en);                    
                //                        
                //    $sql = "UPDATE " . $this->lang_properties_table . " SET details = '" . $translated . "' WHERE id=" . $parray['id'] . " AND language_code='" . $l->code. "';";
                //    $wpdb->query($sql); 
                //}                
                
            }
        }
        
        
         
        $taxes = $property['TaxesFeesDeposits']['Taxes'];
        if ($property['TaxesFeesDeposits']['Taxes']['Tax'][0])
            $taxes = $property['TaxesFeesDeposits']['Taxes']['Tax'];        
        foreach ($taxes as $tax)
        {     
            $taxarray = array();
            $taxarray['property_id'] = $parray['id'];
            $taxarray['title'] = $tax['Title'];
            $taxarray['value'] = $tax['Value'];                                    
            $taxarray['type'] = $tax['Type'];  
            $taxarray['frequency'] = $tax['Frequency'];                          
            $taxarray['is_flat'] = 0;
            if ($tax['IsFlat'] == 'Yes')
                $taxarray['is_flat'] = 1;          
            $sql = $this->get_insert_sql_from_array($this->taxes_table,$taxarray);
            $wpdb->query($sql);       
        }       
        
        $fees = $property['TaxesFeesDeposits']['Fees'];
        if ($property['TaxesFeesDeposits']['Fees']['Fee'][0])
            $fees = $property['TaxesFeesDeposits']['Fees']['Fee'];        
        foreach ($fees as $fee)
        {     
            $feearray = array();
            $feearray['property_id'] = $parray['id'];
            $feearray['title'] = $fee['Title'];
            $feearray['value'] = $fee['Value'];                                    
            $feearray['type'] = $fee['Type'];                     
            $feearray['is_flat'] = 0;
            if ($fee['IsFlat'] == 'Yes')
                $feearray['is_flat'] = 1;   
            $feearray['tax_exempt'] = 0;
            if ($fee['TaxExempt'] == 'Yes')
                $feearray['tax_exempt'] = 1;                          
            $sql = $this->get_insert_sql_from_array($this->fees_table,$feearray);
            $wpdb->query($sql);       
        }                           
         
        $deposits = $property['TaxesFeesDeposits']['Deposits'];
        if ($property['TaxesFeesDeposits']['Deposits']['Deposit'][0])
            $deposits = $property['TaxesFeesDeposits']['Deposits']['Deposit'];        
        foreach ($deposits as $deposit)
        {     
            $depositarray = array();
            $depositarray['property_id'] = $parray['id'];
            $depositarray['title'] = $deposit['Title'];
            $depositarray['value'] = $deposit['Value'];                                             
            $sql = $this->get_insert_sql_from_array($this->deposits_table,$depositarray);
            $wpdb->query($sql);       
        }              
        
        
        $reviews = $property['Reviews'];
        if ($property['Reviews']['Review'][0])
            $reviews = $property['Reviews']['Review'];          
        $revarray = array();
        if ($reviews)
        {
          foreach ($reviews as $review)
          { 
            $revarray = array();
            $revarray['property_id'] = $parray['id'];
            $revarray['date'] = $review['Date'];
            $revarray['name'] = $review['Name'];
            $revarray['description'] = $review['Description'];
            $revarray['language_code'] = $review['LanguageCode'];                        
            $sql = $this->get_insert_sql_from_array($this->reviews_table,$revarray);
            $wpdb->query($sql);        
          }     
        }             

        wp_schedule_single_event(time()+5, 'p_lodgix_download_images');
      }
     
      
	/*
        Builds areas page
    */
    function build_areas_pages()
    {
        global $sitepress, $wpdb;
        $areas = $wpdb->get_results('SELECT DISTINCT area FROM ' . $this->properties_table); 
        $active_languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
        $all_languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table);
        
        foreach ($all_languages as $l) {
            $translated_areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);
            if (is_array($translated_areas_pages) && count($translated_areas_pages) > 0) {
                foreach($translated_areas_pages as $key => $page)
                {
                    if (!get_post($page->page_id)) unset($translated_areas_pages[$key]);
                    $counter++;
                }
                $this->options['p_lodgix_areas_pages_' . $l->code] = serialize($translated_areas_pages);
            }
        
        }                    
        
        $this->saveAdminOptions();        
    
        foreach ($all_languages as $l) {
            $translated_areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);    
            if ((count($translated_areas_pages) > 0) && (count($areas) > 0) && is_array($translated_areas_pages))
            {
                foreach($translated_areas_pages as $key => $page)
                {
                    $found = false;
                    foreach($areas as $area)
                    {
                        if ($page->area == $area->area)
                        {
                            $found = true;
                            break;
                        }
                    }
        
                    if (!$found)
                    {
                        wp_delete_post($translated_areas_pages[$key]->page_id);
                        unset($translated_areas_pages[$key]);
                    }
        
                    $counter++;
                }
                
            }
            $this->options['p_lodgix_areas_pages_' . $l->code] = serialize($translated_areas_pages);
        }
        $this->saveAdminOptions();
        
        if ($active_languages)
        {
            foreach ($active_languages as $l)
            {
                $translated_areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);    
                if (count($areas) > 0 && count($translated_areas_pages) > 0 && is_array($translated_areas_pages))
                {
                    foreach($areas as $area)
                    {
                        $found = false;
                        if (count($translated_areas_pages) > 0)
                        {
                            foreach($translated_areas_pages as $page)
                            {
                                if ($page->area == $area->area)
                                {
                                    $found = true;
                                    break;
                                }
                            }
                        }
        
                        if (!$found)
                        {
                            $obj = (object)array(
                                'area' => $area->area,
                                'page_id' => NULL
                            );
                            $translated_areas_pages[] = $obj;
                        }
                    }
                }
            }
            $this->options['p_lodgix_areas_pages_' . $l->code] = serialize($translated_areas_pages);
        }
        $this->saveAdminOptions();
        
        if ($active_languages)
        {
            foreach ($active_languages as $l)
            {
                $translated_areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);
                if (count($translated_areas_pages) > 0 && is_array($translated_areas_pages))
                {
                    $counter = 0;
                    foreach($translated_areas_pages as $key => $page)
                    {
                        $post = array();
                        $post['post_title'] = $page->area;
                        $post['post_status'] = 'publish';
                        $post['post_author'] = 1;
                        $post['post_type'] = "page";
                        if ($page->page_id == NULL)
                        {
                            $post_id = wp_insert_post($post);
                            if ($post_id != 0)
                            {
                                $translated_areas_pages[$key]->page_id = (int)$post_id;
                            }
                        }
        
                        $counter++;
                    }
                }
                $this->options['p_lodgix_areas_pages_' . $l->code] = serialize($translated_areas_pages);
            }
        }
        $this->link_translated_pages();
        
    }
    
	function getPropertyIdsWithAmenities($amenities) {
        global $wpdb;
        
		if (!($amenities && is_array($amenities))) {
			return '';
		}
        
		$len = count($amenities);
		for ($i = 0; $i < $len; $i++) {
			$amenities[$i] = @mysql_real_escape_string($amenities[$i]);
		}
		$propertyIds = array();
		$properties = $wpdb->get_results('SELECT property_id, count(property_id) AS amenities FROM ' . $wpdb->prefix . "lodgix_amenities WHERE description IN ('" . join("','", $amenities) . "') GROUP BY property_id HAVING amenities=" . $len . "");
		foreach ($properties as $property) {
			array_push($propertyIds, $property->property_id);
		}
		return " id IN (" . join(",", $propertyIds) . ") AND ";
	}

    /*
      Returns table for vacation rentals (regular/ajax)
    */
    function get_vacation_rentals_html($sort = '',$area = '',$bedrooms=NULL,$id='',$arrival='',$nights='',$amenities=NULL)
    {
      global $wpdb;
      
      $content = '';
      
      $sort_sql = '';
      $direction = '';
      if ($sort != '')
      {
          $sort_sql =  $sort;
          if ($sort == 'pets')
            $direction = ' DESC';
      }
      else
      {
          $sort_sql =  '`order`';
      }
      $filter = '';
      if (is_numeric($id))
      {
          $filter .= " id='" . $id . "' AND ";
      }
      else
      {
          if ($area != '' && $area != 'ALL_AREAS')
              $filter .= " area='" . $wpdb->_real_escape($area) . "' AND ";
          if ($id != '')
              $filter .= " UPPER(description) like '%" . $wpdb->_real_escape(strtoupper($id)) . "%' AND ";
          if ($bedrooms != NULL && $bedrooms != 'ANY')
              $filter .= " bedrooms = " . $wpdb->_real_escape($bedrooms) . " AND ";
      }        
                          
      $available = 'ALL';
      $available_after_rules = '';
      $differentiate = false;
      if ((strtotime($arrival) !== false) && (is_numeric($nights)))
      {
          $differentiate = true;
          if (strpos('%m',$this->options['p_lodgix_date_format']) == 1)
              $arrival = str_replace('-','/');
          $arrival = date("Y-m-d", strtotime($arrival));
          $departure = $this->p_lodgix_add_days($arrival,$nights);
          $fetch_url = 'http://www.lodgix.com/system/api-lite/xml?Action=GetAvailableProperties&PropertyOwnerID=' . $this->options['p_lodgix_owner_id'] . '&FromDate=' . $arrival . '&ToDate=' . $departure;
          $r = new LogidxHTTPRequest($fetch_url);
          $xml = $r->DownloadToString(); 
          if ($xml)
          {         
              
              $root = new DOMDocument();  
              $root->loadXML($xml);
              $available_array = $this->domToArray($root);       			
              $available = $available_array['Response']['Results']['AvailableProperties'];
              $available_after_rules = $available_array['Response']['Results']['AvailablePropertiesAfterRules'];
              if (!(gettype($available_after_rules) == 'array'))
                  $available_after_rules = split(',',$available_after_rules);	         		
          }
      }                      

      if ($available != 'ALL' && $available != 'null')
      {
        $filter .= " id IN (" . $available . ") AND ";	  
      }
      else if ($available == 'null')
      {
         $filter .= " 1=0 AND ";	  
      }       

      $filter .= $this->getPropertyIdsWithAmenities($amenities);

      $sql = 'SELECT * FROM ' . $this->properties_table . '  WHERE ' . $filter . ' 1=1 ORDER BY ' . $wpdb->_real_escape($sort_sql) . ' ' . $direction ;
      $properties = $wpdb->get_results($sql);      

      if ($properties)
      {
          $really_available = false;
          foreach($properties as $property)
          {
              if (is_array($available_after_rules))
              {
                  foreach($available_after_rules as $pk)
                  {
                      if ($pk == $property->id)
                      {
                          $owner_id = $this->options['p_lodgix_owner_id'];
                          if ($owner_id == 2) {
                              $owner_id = 'rosewoodpointe';
                          } else if ($owner_id == 13) {
                              $owner_id = 'demo_booking_calendar';
                          }
                          $property->bookdates = $arrival . ',' . $departure;
                          $property->booklink = 'http://www.lodgix.com/' . $owner_id . '/?selected_reservations=' . $property->id . ',' . $property->bookdates . '&adult=1&children=0&gift=&discount=&tax=&external=1';
                          $property->really_available = true;
                          break;
                      }
                  }
              }
          
              if ($this->options['p_lodgix_display_daily_rates'])
              {
                $low_daily_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";",null));
                $high_daily_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";",null));
              }
              else
              {
                $low_daily_rate = $property->currency_symbol . '0';
                $high_daily_rate = $property->currency_symbol . '0';
              }
              $low_weekly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";",null));
              $high_weekly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";",null));
              $low_monthly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";",null));
              $high_monthly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";",null));
        

              if ($this->locale == 'en_US')
              {
                  $permalink = get_permalink($property->post_id);
              }
              else
              {                              
                  $sql = "SELECT * FROM " . $this->lang_properties_table . " WHERE language_code='" . $this->sufix . "' AND id=" . $property->id;
                  $translated_details = $wpdb->get_results($sql);
                  $translated_details = $translated_details[0];
                  $property->description = $translated_details->description;
                  $property->description_long = $translated_details->description_long;
                  $property->details = $translated_details->details;
                  $post_id = $wpdb->get_var("select page_id from " . $this->lang_pages_table . " WHERE property_id=" . $property->id . " AND language_code='" . $this->sufix. "';");                  
                  $permalink = get_permalink($post_id);
              }
              include('vacation_rentals.php');
              $content .= $vacation_rentals;          
          }
          $content .= '<script type="text/javascript">jQueryLodgix(".ldgxFeats").LodgixResponsiveTable()</script>';
          $content .= '<script type="text/javascript">jQueryLodgix(".ldgxListingDesc").LodgixTextExpander()</script>';
      }
      $link = '<a href="http://www.lodgix.com">Vacation Rental Software</a>';
      
      $sql = 'SELECT url,title FROM `' . $this->link_rotators_table . '` ORDER BY RAND() LIMIT 1';
          $rotators = $wpdb->get_results($sql);           
       
      if ($rotators)
      {
          foreach($rotators as $rotator)
           $link = '<a href="' . $rotator->url . '">' . $rotator->title . '</a>';  
      }
             
      $content .= '<div class="ldgxPowered">' . $link . ' by Lodgix.com</div>';
      return $content;
    }      


      /*
        Creates availability calendar page
      */
      function delete_availability_page()
      {
        $post_id = (int)$this->options['p_lodgix_availability_page_en'];
        wp_delete_post($post_id,$force=true);
        $this->options['p_lodgix_create_availability'] = NULL;
      }
      
      /*
        Creates availability calendar page
      */
      function build_availability_page()
      {
        global $wpdb;
        $post_id = (int)$this->options['p_lodgix_availability_page_en'];
        if ($post_id > 0)
        {
            $post = array();
            $post['ID'] = $post_id;
            $content = '
               <div id="content_lodgix">
            ';
            $properties = $wpdb->get_results('SELECT * FROM ' . $this->properties_table); 
                         
            if ($properties)
            {
             $number_properties = count($properties); 
             $multi_unit_helptext = $wpdb->get_var("SELECT multi_unit_helptext FROM " . $this->policies_table . " WHERE language_code='" . $this->sufix . "'");
             
             if ($number_properties >= 1)
             {
               $allow_booking = $properties[0]->allow_booking;
               $owner_id = $properties[0]->owner_id;
                 $owner_id_multiple =  $this->options['p_lodgix_owner_id'];
               $property_id = $properties[0]->id;
               include('availability.php');
               $content .= $availability;
             } 
            }
           $content .= '</div>';
           $post['post_content'] = $content;
           wp_update_post($post);

         }      
         $post_id = (int)$this->options['p_lodgix_availability_page_de'];
         if ($post_id > 0)
         {      
          $post['ID'] = $post_id;
          wp_update_post($post);
         } 
         
  
        $this->link_translated_pages();
                  
      }
      
      
    function get_sort_content($page) {
        $area = '';
        if ($page) {
            $area = $page->area;
        }
        $content = '<div id="content_lodgix_wrapper">
                    <div id="lodgix_sort_div">
                     <b>'.__('Sort Results by',$this->localizationDomain).':</b>&nbsp;<SELECT name="lodgix_sort" id="lodgix_sort" onchange="javascript:p_lodgix_sort_vr(\''.$this->sufix.'\',\'' . $area .  '\');">
                        <OPTION VALUE="">'.__('None').'</OPTION>
                        <OPTION VALUE="bedrooms">'.__('Bedrooms',$this->localizationDomain).'</OPTION>
                        <OPTION VALUE="bathrooms">'.__('Bathrooms',$this->localizationDomain).'</OPTION>
                        <OPTION VALUE="proptype">'.__('Rental Type',$this->localizationDomain).'</OPTION>
                        <OPTION VALUE="pets">'.__('Pets Allowed',$this->localizationDomain).'</OPTION>
                        <OPTION VALUE="min_daily_rate">'.__('Daily Rate',$this->localizationDomain).'</OPTION>
                        <OPTION VALUE="min_weekly_rate">'.__('Weekly Rate',$this->localizationDomain).'</OPTION>
                        <OPTION VALUE="min_monthly_rate">'.__('Monthly Rate',$this->localizationDomain).'</OPTION>
                     </SELECT><BR>
                     </div>
                     <div id="content_lodgix">';
        return $content;
    }
      
    /*
      Get area page content
    */
    function get_area_page_content($code)
    {      	
      	$content = '';
      	preg_match_all('/([\d]+)/', $code, $match);
		$id = (int) $match[0][0];    
				
		$loptions = get_option('p_lodgix_options');
		if (is_numeric($id))
		{
    		$areas_pages = unserialize($loptions['p_lodgix_areas_pages_' . $this->sufix]);
    	
    		foreach($areas_pages as $page)	
      		{
      			if ($page->page_id && ($page->page_id == $id))  		  				
      			{ 			  				
      				$wpost = array();
                    $wpost['ID'] = $page->page_id;
                    $content = $this->get_sort_content($page);
                    $content .= $this->get_vacation_rentals_html('',$page->area);
                    $content .= '</div></div>';
                }
            }            
		}
  
        return $content;
      }            
      
      /*
        Get search rentals page content
      */
      function get_search_rentals_page_content()
      {
        global $wpdb;
        $content = '
           <div id="content_lodgix">
        ';

      	$sort = @mysql_real_escape_string($_POST['sort']);
      	$language = @mysql_real_escape_string($_POST['lang']);
      	$area = @mysql_real_escape_string($_POST['lodgix-custom-search-area']);
      	$bedrooms = @mysql_real_escape_string($_POST['lodgix-custom-search-bedrooms']);
      	$id = @mysql_real_escape_string($_POST['lodgix-custom-search-id']);
      	$arrival = @mysql_real_escape_string($_POST['lodgix-custom-search-arrival']);
      	$nights = @mysql_real_escape_string($_POST['lodgix-custom-search-nights']);

		$amenities = $_POST['lodgix-custom-search-amenities'];

      	$content .= $this->get_vacation_rentals_html($sort,$area,$bedrooms,$id,$arrival,$nights,$amenities);      

        $content .= '</div>';
  
        return $content;
      }      
      
      
 			/*
        Get availability page content
      */
      function get_single_page_content($id)
      {

      	$bookdates = @mysql_real_escape_string($_GET['bookdates']);

        $content = $this->get_single_page_html($id,$bookdates);   
  
        return $content;
      }            
      
      /*
        Get availability page content
      */
      function get_availability_page_content()
      {
        global $wpdb;
        $content = '
           <div id="content_lodgix">
        ';
        $properties = $wpdb->get_results('SELECT * FROM ' . $this->properties_table); 
                      
        if ($properties)
        {
         $number_properties = count($properties); 
         
         if ($number_properties >= 1)
         {
           $multi_unit_helptext = $wpdb->get_var("SELECT multi_unit_helptext FROM " . $this->policies_table . " WHERE language_code='" . $this->sufix . "'");
           $allow_booking = $properties[0]->allow_booking;
           $owner_id = $properties[0]->owner_id;
           $owner_id_multiple =  $this->options['p_lodgix_owner_id'];
           $property_id = $properties[0]->id;
           include('availability.php');
           $content .= $availability;
         } 
        }
        $content .= '</div>';
  
        return $content;
      }      
      

    /*
      Get vacation rentals page content
    */
    function get_vacation_rentals_content()
    {
        $content = "";
		global $wpdb;
		$loptions = get_option('p_lodgix_options');

        $variable = 'p_lodgix_vacation_rentals_page_' . $this->sufix;
    
        $post_id = (int)$loptions[$variable];  					
     
        if ($post_id > 0)
        {
          $content = $this->get_sort_content(false);
          $content .= $this->get_vacation_rentals_html();
          $content .= '</div></div>';
        }
       return $content;
      }            
      
      
      
    function link_translated_pages()
    {
        global $sitepress,$wpdb;        
        $areas_pages = unserialize($this->options['p_lodgix_areas_pages_en']);
        
        $languages = $wpdb->get_results("SELECT * FROM " . $this->languages_table . " WHERE enabled = 1 and code <> 'en'");
        
        if ($languages)
        {
           
            foreach ($languages as $l)
            {
                $sql = "SELECT * FROM " . $this->lang_pages_table . " WHERE language_code = '" . $l->code . "'";
      
                $posts = $wpdb->get_results($sql);
           
                foreach($posts as $post)
                {
                    if ($post->property_id == -1)
                    {
                        $post_id = $this->options['p_lodgix_vacation_rentals_page_en'];
                    }
                    else if ($post->property_id == -2)
                    {
                        $post_id = $this->options['p_lodgix_availability_page_en'];    
                    }       
                    else if ($post->property_id == -3)
                    {
                        $post_id = $this->options['p_lodgix_search_rentals_page_en'];    
                    }                                    
                    else
                    {              
                        $post_id = (int)$wpdb->get_var($wpdb->prepare("SELECT page_id FROM " . $this->pages_table . " WHERE property_id=" . $post->property_id . ";",null));
                    }

                    $trid = (int)$wpdb->get_var($wpdb->prepare("SELECT trid FROM " . $this->translation_table . " WHERE element_id=" . $post_id . " AND language_code='en';",null));
                    $sitepress->set_element_language_details($post->page_id,'post_page',$trid,$l->code,'en');            
                }          
                
                
                $translated_areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);
                if (is_array($translated_areas_pages) && is_array($areas_pages)) {
                    foreach($translated_areas_pages as $translated_page)	
                    {
                        foreach($areas_pages as $page)	
                        {
                            if ($translated_page->area == $page->area)
                            {  			 			
                                $trid = (int)$wpdb->get_var($wpdb->prepare("SELECT trid FROM " . $this->translation_table . " WHERE element_id=" . $page->page_id . " AND language_code='en';",null));
                                $sitepress->set_element_language_details($translated_page->page_id,'post_page',$trid,$l->code,'en');	
                            }
                        }
                    }
                }
            }
        }
    }
      
    function get_single_page_html($id,$bookdates='')
    {      	
        global $wpdb;
        global $sitepress;
        
        $link = '<a href="http://www.lodgix.com">Vacation Rental Software</a>';
        $sql = 'SELECT url,title FROM `' . $this->link_rotators_table . '` ORDER BY RAND() LIMIT 1';
        $rotators = $wpdb->get_results($sql);           
                 
        if ($rotators)
        {
            foreach($rotators as $rotator)
            $link = '<a href="' . $rotator->url . '">' . $rotator->title . '</a>';  
        }        
        
        $single_property = '';
        $properties = $wpdb->get_results('SELECT * FROM ' . $this->properties_table . ' WHERE id=' . $id);  
  		if ($properties)
  		{
  			$property = $properties[0];

			if ($bookdates) {
					$owner_id = $this->options['p_lodgix_owner_id'];
					if ($owner_id == 2) {
						$owner_id = 'rosewoodpointe';
					} elseif ($owner_id == 13) {
						$owner_id = 'demo_booking_calendar';
					}
					$property->booklink = 'http://www.lodgix.com/' . $owner_id . '/?selected_reservations=' . $property->id . ',' . $bookdates . '&adult=1&children=0&gift=&discount=&tax=&external=1';
					$property->really_available = true;
			} else {
					$property->really_available = false;
			}
  			
        	$amenities = $wpdb->get_results('SELECT * FROM ' . $this->amenities_table . " WHERE property_id=" . $property->id);
            $amenities_list = array();
            if (count($amenities) >= 1)
			{ 
				$counter = 0;
 				foreach($amenities as $amenity)
				{
                    $aux = __(trim($amenity->description),$this->localizationDomain);
                    $amenity_name = $wpdb->get_var("select description_translated from " . $this->lang_amenities_table . " WHERE description='" . $amenity->description . "' AND language_code='" . $this->sufix . "';"); 
					if ($amenity_name != "")
						$aux = $amenity_name;

                    array_push($amenities_list,$aux);
                }
            }
            
            $merged_rates =  $wpdb->get_results('SELECT * FROM ' . $this->merged_rates_table . " WHERE property_id=" . $property->id . " ORDER BY from_date,to_date");
    

            $sql = "SELECT * FROM " . $this->reviews_table . " WHERE language_code='" . $this->sufix ."' AND property_id=" . $property->id . ' ORDER BY date DESC';
            $reviews = $wpdb->get_results($sql);
            
            $policies = $wpdb->get_results("SELECT * FROM " . $this->policies_table . " WHERE language_code='" . $this->sufix . "'");
            
            if ($this->locale == 'en_US')
            {
                $permalink = get_permalink($property->post_id);
            }
            else
            {                              
                $sql = "SELECT * FROM " . $this->lang_properties_table . " WHERE id=" . $property->id;
                $translated_details = $wpdb->get_results($sql);
                $translated_details = $translated_details[0];
                $property->description = $translated_details->description;
                $property->description_long = $translated_details->description_long;
                $property->details = $translated_details->details;
                $post_id = $wpdb->get_var("select page_id from " . $this->lang_pages_table . " WHERE property_id=" . $property->id . ";");
                $permalink = get_permalink($post_id);
                
            }
         
        	if ($this->options['p_lodgix_single_page_design'] == 1)
        	{
                include('single_property_tabbed.php');
        	}
        	else
        	{
      			include('single_property.php');
        	}
      	}
      	
      	return do_shortcode($single_property);
    }
      
	function is_iterable($var) {
		return (is_array($var) || $var instanceof Traversable);
	}		          
		      
      
    function set_thesis_2_custom_templates_for_page($page_id) { 
							
	    $thesis_skin = get_option('thesis_skin');
	    if ($thesis_skin) {
			$class = $thesis_skin['class'];
			$thesis_classic_r_templates = get_option('thesis_classic_r_templates');

			$template = Array('template' => $this->options['p_lodgix_thesis_2_template']);            	
			            		      
			if ($template != '') {
				add_post_meta($page_id,  '_' . $class, $template, true); 
			  	$meta_values = update_post_meta($page_id,  '_' . $class, $template);
			}
			else {
			  	delete_post_meta($page_id,  '_' . $class);
			}
	    }            	
    }	            	            	
	            	
    function set_thesis_2_custom_templates() { 
        
        global $wpdb;
      
        $this->set_thesis_2_custom_templates_for_page($this->options['p_lodgix_vacation_rentals_page_en']);
        $this->set_thesis_2_custom_templates_for_page($this->options['p_lodgix_availability_page_en']);
        $this->set_thesis_2_custom_templates_for_page($this->options['p_lodgix_search_rentals_page_en']);

 
        $posts = $wpdb->get_results('SELECT * FROM ' . $this->pages_table);   
        foreach($posts as $post)
        {
            $this->set_thesis_2_custom_templates_for_page($post->page_id);
        }         
        
        $posts_de = $wpdb->get_results('SELECT * FROM ' . $this->lang_pages_table);   
        foreach($posts_de as $post)
        {
          $this->set_thesis_2_custom_templates_for_page($post->page_id);
        }
        
        $active_languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
        foreach ($active_languages as $l) {
            $areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);
            foreach((array)$areas_pages as $key => $page)
            {
                $this->set_thesis_2_custom_templates_for_page((int)$page->page_id);
            }
        }
                     
    }
      
    function build_individual_pages() {
        global $wpdb;
        global $sitepress;
       
        
        
        $properties = $wpdb->get_results('SELECT * FROM ' . $this->properties_table . ' ORDER BY `order`'); 
        if ($properties)
        {
            foreach($properties as $property)
            {
              $exists = get_post($property->post_id);
              
                if (!$exists)
                {         
                    $post = array();
                    $post['post_title'] = $property->description;
                    $post['post_parent'] = (int)$this->options['p_lodgix_vacation_rentals_page_en'];
                    $post['post_status'] = 'pending';
                    $post['post_author'] = 1;
                    $post['post_type'] = "page";
                    if ($this->options['p_lodgix_vacation_rentals_page_en'] != NULL)
                    {
                        $post_id = wp_insert_post( $post );  
                        $sql = "UPDATE " . $this->properties_table . " SET post_id=" . $post_id . " WHERE id=" . $property->id;
                        $wpdb->query($sql);
                        $sql = "INSERT INTO " . $this->pages_table . "(page_id,property_id,parent_page_id) VALUES(" . $post_id . "," . $property->id."," . $post['post_parent'] . ")";
                        $wpdb->query($sql);
  
                    }     
                }
                
                $active_languages = $wpdb->get_results("SELECT * FROM " . $this->languages_table . " WHERE enabled = 1 and code <> 'en'");

                foreach ($active_languages as $l) {    

                    $post_id = $wpdb->get_var("SELECT page_id FROM " . $this->lang_pages_table . " WHERE property_id=" . $property->id . " AND language_code='" . $l->code . "'");
                    $exists = get_post($post_id);
                    if (!$exists)
                    {         
                        $post = array();
                        $post['post_title'] = $property->description;
                        $post['post_parent'] = (int)$this->options['p_lodgix_vacation_rentals_page_' . $l->code];
                        $post['post_status'] = 'pending';
                        $post['post_author'] = 1;
                        $post['post_type'] = "page";
                        
                        if ($this->options['p_lodgix_vacation_rentals_page_' . $l->code] != NULL)
                        {
                           
                            $post_id = (int)$wpdb->get_var($wpdb->prepare("SELECT post_id FROM " . $this->properties_table . " WHERE id=" . $property->id . ";",null));
                            $trid = (int)$wpdb->get_var($wpdb->prepare("SELECT trid FROM " . $this->translation_table . " WHERE element_id=" . $post_id . " AND language_code='en';",null));
                            $post['post_parent'] = (int)$this->options['p_lodgix_vacation_rentals_page_' . $l->code];
                            $post_id = wp_insert_post( $post );   
                            $sql = "INSERT INTO " . $this->lang_pages_table . "(page_id,property_id,source_page_id,language_code) VALUES(" . $post_id . "," . $property->id."," . $post_id   . ",'" . $l->code . "')";                              
                            $wpdb->query($sql);                  
                            update_post_meta($post_id, '_icl_translation', 1);     
                           
                        }     
                    }
                }
            }
         }
         
         
         $properties = $wpdb->get_results('SELECT * FROM ' . $this->properties_table . ' ORDER BY `order`'); 
         if ($properties)
         {
            foreach($properties as $property)
            {
                if ($property->post_id != NULL)
                {                
                    
                    $post = array();
                    $post['ID'] = $property->post_id;
                    $post['post_title'] = $property->description;
                    $single_property = '[lodgix_single_property ' . $property->id . ']';                
                    $post['post_status'] = 'publish';
                    $post_id = wp_update_post($post); 
                    $posts_table = $wpdb->prefix . "posts";
                    $sql = "UPDATE " . $posts_table . " SET post_content='" . $wpdb->_real_escape($single_property) . "' WHERE id=" . $post_id;
                    $wpdb->query($sql);
                    add_post_meta($post_id, 'thesis_description', trim(wptexturize($this->truncate_text($property->description_long,150))), true); 
                    update_post_meta($post_id , 'thesis_description', trim(wptexturize($this->truncate_text($property->description_long,150))));
                    $keywords = $property->description . ', vacation rental, vacation home, vacation, homes, rentals, cottages, condos, holiday';
                    if ($property->city != "")
                    $keywords .= ', ' . $property->city;                
                    add_post_meta($post_id, 'thesis_keywords', trim(wptexturize($keywords)), true); 
                    update_post_meta($post_id , 'thesis_keywords', trim(wptexturize($keywords)));  		
                                          
    
                    $active_languages = $wpdb->get_results("SELECT * FROM " . $this->languages_table . " WHERE enabled = 1 and code <> 'en'");
    
                    foreach ($active_languages as $l) {    
    
                        $post_id = $wpdb->get_var("SELECT page_id FROM " . $this->lang_pages_table . " WHERE property_id=" . $property->id . " AND language_code='" . $l->code . "'");
                      
                        $post = array();
                        $post['ID'] = $post_id;
                        $post['post_title'] = $wpdb->get_var("SELECT description FROM " . $this->lang_properties_table . " WHERE id =" . $property->id . " AND language_code='" . $l->code. "'");
                        if ($post['post_title'] == '')
                          $post['post_title'] = $property->description;
                        $single_property = '[lodgix_single_property ' . $property->id . ']';                
                        $post['post_status'] = 'publish';       
                        $post['post_content'] = htmlspecialchars($single_property);  
                        $post_id = wp_update_post($post);                      
                        $sql = "UPDATE " . $translation_table . " SET trid=" . $trid . ", language_code='" . $l->code . "' WHERE element_id=" . $post_id;
                        $wpdb->query($sql);           
                        $sql = "UPDATE " . $posts_table . " SET post_content='" . $wpdb->_real_escape($single_property) . "' WHERE id=" . $post_id;                  
                        $wpdb->query($sql);                    
                    }
                }              
            }
        }
         
   
        $this->link_translated_pages();
                  
         
        if ($this->options['p_lodgix_thesis_2_compatibility']) {
           $this->set_thesis_2_custom_templates();         	
        }
    }
      
    function remove_thesis_page($page_id)
    {
        if ($this->options['p_lodgix_thesis_compatibility'] || $this->options['p_lodgix_thesis_2_compatibility'])
        {
          $thesis_options = get_option('thesis_options');
          unset($thesis_options->nav['pages'][$page_id]);
          update_option('thesis_options',$thesis_options); 
        }
    }
      
	function p_lodgix_add_days($dt, $days) {
		$date = strtotime($dt);
		$date = strtotime("+" . $days . " day", $date);
		return date('Y-m-d',$date);
	}


    function p_lodgix_custom_search_get_details()
    {
        global $wpdb;
       
     	$areas = $wpdb->get_results('SELECT DISTINCT area FROM ' . $this->properties_table . ' WHERE area <> \'\' AND area IS NOT NULL');  
        $loptions = get_option('p_lodgix_options'); 
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
       
        $post_id = (int)$loptions['p_lodgix_search_rentals_page_' . $this->sufix];       
        $post_id = (int)$loptions['p_lodgix_search_rentals_page'];
        	
        $post_url = get_permalink($post_id);                
       
        $max_rooms = (int)$wpdb->get_var("SELECT MAX(bedrooms) FROM " . $this->properties_table);
       
        $areas_json = array();
		foreach($areas as $area)       				
		{
			array_push($areas_json, $area->area);	
		}
       
        $json = array('date_format' => $date_format, 'max_rooms' => $max_rooms, 'post_url' => $post_url, 'areas' => $areas_json);
        $json =  json_encode($json);
       
        die($json);
    }      
      
    function p_lodgix_custom_search()
    {
		global $wpdb;
		$area = @mysql_real_escape_string($_POST['area']);
		$bedrooms = @mysql_real_escape_string($_POST['bedrooms']);
		$id = @mysql_real_escape_string($_POST['id']);
		$arrival = @mysql_real_escape_string($_POST['arrival']);
		$nights = @mysql_real_escape_string($_POST['nights']);
       
	    $available = 'ALL';
	    if ((strtotime($arrival) !== false) && (is_numeric($nights)))
	    {

	     	$departure = $this->p_lodgix_add_days($arrival,$nights);
    	 	$fetch_url = 'http://www.lodgix.com/system/api-lite/xml?Action=GetAvailableProperties&PropertyOwnerID=' . $this->options['p_lodgix_owner_id'] . '&FromDate=' . $arrival . '&ToDate=' . $departure;
       		$r = new LogidxHTTPRequest($fetch_url);
			$xml = $r->DownloadToString(); 
       		if ($xml)
       		{         
				$root = new DOMDocument();  
                $root->loadXML($xml);
                $available_array = $this->domToArray($root);       			
         		$available = $available_array['Response']['Results']['AvailableProperties'];
       		}
        }
        
        $found = false;
        $sql = "SELECT COUNT(*) as num_results FROM " . $this->properties_table . " WHERE 1=1 AND ";
        if (is_numeric($id))
        {
             
             $testsql = $sql . "id=" . $wpdb->_real_escape($id);
             $testcount = $wpdb->get_results($testsql);
 
             if ($testcount[0]->num_results > 0)
             {
                 $found = true;
                 $sql .= "id=" . $wpdb->_real_escape($id) . ' AND ';
             }
        }	      
       
        if (!$found)
        {
            if ($area != 'ALL_AREAS')
            {
                $sql .= "area = '" . $wpdb->_real_escape($area) . "' AND ";
            }
       	
            if ($id != '')
            {       	
                $sql .= "UPPER(description) like '%" . $wpdb->_real_escape(strtoupper($id)) . "%' AND ";
            }
            
            if ($bedrooms != 'ANY')
                $sql .= "bedrooms = " . $wpdb->_real_escape($bedrooms) . ' AND ';
        }        
	  
        if ($available != 'ALL' && $available != 'null' && $available != Array())
        {
           $sql .= " id IN (" . $wpdb->_real_escape($available) . ") AND ";	  
        }
        else if ($available == 'null' || $available == Array())
        {
       	   $sql .= " 1=0 AND ";	  
        }

		$sql .= $this->getPropertyIdsWithAmenities($_POST['amenity']);

        $sql .= " 1=1 ";
       
        $count = $wpdb->get_results($sql);
        if ($language == "de")
          $content = $count[0]->num_results . ' Properties Found.';
        else
          $content = $count[0]->num_results . ' Properties Found.';
 
        if ($content == ' Properties Found.')       
             $content = '0 Properties Found.';
        die($content);
    }      
      
      
            // This is the function that outputs the form to let the users edit
    // the widget's title. It's an optional feature that users cry for.
    function widget_lodgix_custom_search_control_2() {

        // Get our options and see if we're handling a form submission.
        $options = get_option('widget_lodgix_custom_search_2');
    
        //Set the default options for the widget here
        if ( !is_array($options) )
            $options = array('title' => 'Rentals Search', 'amenities' => false);
    
        if ( $_POST['widget_lodgix_custom_search-submit'] ) {
            // Remember to sanitize and format use input appropriately.
            $options['title'] = strip_tags(stripslashes($_POST['widget_lodgix_custom_search-title']));
            $options['amenities'] = $_POST['widget_lodgix_custom_search-amenities'] == 't' ? true : false;
            update_option('widget_lodgix_custom_search_2', $options);
        }
    
        $this->widget_lodgix_custom_search_control_common($options);
    }       
  
    // This is the function that outputs our widget_lodgix_custom_search.
	function widget_lodgix_custom_search_common($args,$options) {
        global $wpdb;
        

        extract($args);
            
        $loptions = get_option('p_lodgix_options');
        $title = apply_filters('widget_title', empty($options['title']) ? __('Rentals Search') : $options['title']);
 
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
                                            buttonImage: "' . $this->p_plugin_path . 'images/calendar.png",
                                            buttonImageOnly: true,
                                            dateFormat: "' . $date_format . '",
                                            minDate: 0,
                                            beforeShow: function() {
                                                setTimeout(function(){
                                                    jQueryLodgix("#lodgix-datepicker-div").css("z-index", 99999999999999);
                                                }, 0);
                                            }                                                
                                    });
                                 });
              </script>';
        
        $post_id = (int)$loptions['p_lodgix_search_rentals_page_' . $this->sufix];
            
        $post_url = get_permalink($post_id);
        echo '<form name="lodgix_search_form" method="POST" action="' . $post_url .'">
                    <div class="lodgix-custom-search-listing" align="left" style="-moz-border-radius: 5px 5px 5px 5px;line-height:20px;">    
                    <table>
                      <tr>
                      <td>
                            <div>'.__('Arriving','p_lodgix').':</div> 			
                            <div style="vertical-align:bottom;"><input id="lodgix-custom-search-arrival" name="lodgix-custom-search-arrival" style="width:117px;" onchange="p_lodgix_search_properties()" readonly></div>
                        </td>
                        <td>&nbsp;
                        </td>
                        <td>
                        <div>'.__('Nights','p_lodgix').':</div>
                        <div><select id="lodgix-custom-search-nights" name="lodgix-custom-search-nights" style="width:54px;" onchange="p_lodgix_search_properties()">';
                        
        for ($i = 1 ; $i < 100 ; $i++)				
        {
            echo "<option value='" . $i . "'>" . $i . "</option>";
        }
        
        echo '</select>
                        </div>
                        </td>
                        </tr>
                    </table>
                    <div>'.__('Location','p_lodgix').':</div> 
                    <div><select id="lodgix-custom-search-area" style="width:95%" name="lodgix-custom-search-area" onchange="p_lodgix_search_properties()">
                    <option value="ALL_AREAS">'.__('All Areas','p_lodgix').'</option>';       	

        foreach($areas as $area)       				
        {
            if ($area->area == $area_post)
                echo '<option selected value="'.$area->area.'">'.$area->area.'</option>';
            else
                echo '<option value="'.$area->area.'">'.$area->area.'</option>';

        }
            
        echo	'</select></div>
                    <div>'.__('Bedrooms','p_lodgix') .':</div> 
                    <div><select id="lodgix-custom-search-bedrooms" name="lodgix-custom-search-bedrooms" onchange="p_lodgix_search_properties()">
                    <option value="ANY">Any</option> 
                    <option value="0">Studio</option>';
        $max_rooms = (int)$wpdb->get_var("SELECT MAX(bedrooms) FROM " . $this->properties_table);
        for($i = 1 ; $i < ($max_rooms+1) ; $i++)
        {
            
            if ($i == $bedrooms_post)
                echo '<option selected value="'.$i.'">'.$i.'</option>';
            else
                echo '<option value="'.$i.'">'.$i.'</option>';
        }
        echo '</select></div>';

        if ($options['amenities']) {
            echo '<div class="lodgix-custom-search-amenities-list">'.__('Amenities','p_lodgix') .':';
            $amenities = $wpdb->get_results("SELECT DISTINCT * FROM " . $wpdb->prefix . "lodgix_lang_amenities WHERE searchable=1 AND language_code='" . $this->sufix . "'");
            $a = 0;
            foreach($amenities as $amenity) {
                echo '<div><input type="checkbox" class="lodgix-custom-search-amenities" name="lodgix-custom-search-amenities[' . $a . ']" value="' . $amenity->description . '" onclick="p_lodgix_search_properties()"/> ';
                echo __($amenity->description_translated.$this->localizationDomain) . '</div>';
                //XXXXXXXXXXXXXXXXXXXXXXXXXXX Fix ABove
                $a++;
            }
            echo '</div>';
        }

        echo '<div>'.__('Search by Property Name or ID','p_lodgix') .':</div> 
                    <div><input id="lodgix-custom-search-id" name="lodgix-custom-search-id" style="width:95%" onkeyup="p_lodgix_search_properties()" value="' . $id_post .  '"></div>
                    <div id="lodgix-custom-search-results" align="center">
                    <div id="lodgix_search_spinner" style="display:none;"><img src="/wp-admin/images/wpspin_light.gif"></div>
                    <div id="search_results">
                    </div>
                    <input type="submit" value="'.__('Display Results','p_lodgix') .'" id="lodgix-custom-search-button">
                    </div>
              </div>';               
        echo '</div></form>';
        echo $after_widget;
	}
    
    function widget_lodgix_custom_search($args) {
        $options = get_option('widget_lodgix_custom_search');
        $this->widget_lodgix_custom_search_common($args,$options);
    }
    
    function widget_lodgix_custom_search_2($args) {
        $options = get_option('widget_lodgix_custom_search_2');
        $this->widget_lodgix_custom_search_common($args,$options);
    }
    
    function widget_lodgix_custom_search_control_common($options) {
        // Be sure you format your options to be valid HTML attributes.
        $title = htmlspecialchars($options['title'], ENT_QUOTES);
        $amenities = $options['amenities'] ? 'checked="checked"' : '';
        // Here is our little form segment. Notice that we don't need a
        // complete form. This will be embedded into the existing form.
        echo '<p style="text-align:left;"><label for="widget_lodgix_custom_search-title">' . __('Title:') . ' <input style="width: 200px;" id="widget_lodgix_custom_search-title" name="widget_lodgix_custom_search-title" type="text" value="'.$title.'" /></label></p>';
        echo '<p style="text-align:left;"><label for="widget_lodgix_custom_search-amenities">' . __('Amenities:') . ' <input id="widget_lodgix_custom_search-amenities" name="widget_lodgix_custom_search-amenities" type="checkbox" value="t" ' . $amenities . '/></label></p>';
        echo '<input type="hidden" id="widget_lodgix_custom_search-submit" name="widget_lodgix_custom_search-submit" value="1" />';    	
    
    }
    
    // This is the function that outputs the form to let the users edit
    // the widget's title. It's an optional feature that users cry for.
    function widget_lodgix_custom_search_control() {

        // Get our options and see if we're handling a form submission.
        $options = get_option('widget_lodgix_custom_search');
    
        //Set the default options for the widget here
        if ( !is_array($options) )
          $options = array(
            'title' => __('Rentals Search','p_lodgix'),
            'amenities' => false
          );
    
        if ( $_POST['widget_lodgix_custom_search-submit'] ) {
          // Remember to sanitize and format use input appropriately.
          $options['title'] = strip_tags(stripslashes($_POST['widget_lodgix_custom_search-title']));
          $options['amenities'] = $_POST['widget_lodgix_custom_search-amenities'] == 't' ? true : false;
          update_option('widget_lodgix_custom_search', $options);
        }

        $this->widget_lodgix_custom_search_control_common($options);
    } 
	    
      
    function widget_lodgix_custom_search_init()
    {
        // Check for the required plugin functions. This will prevent fatal
        // errors occurring when you deactivate the dynamic-sidebar plugin.
        if ( !function_exists('register_sidebar_widget') )
            return;
    
        register_sidebar_widget(array('Rentals Search', 'widgets'), array(&$this,'widget_lodgix_custom_search'));
        register_widget_control(array('Rentals Search', 'widgets'), array(&$this,'widget_lodgix_custom_search_control'));
	    
        register_sidebar_widget(array('Rentals Search 2', 'widgets'), array(&$this,'widget_lodgix_custom_search_2'));
        register_widget_control(array('Rentals Search 2', 'widgets'), array(&$this,'widget_lodgix_custom_search_control_2'));
	      
    }    
      

    // This is the function that outputs the form to let the users edit
    // the widget's title. It's an optional feature that users cry for.
    function widget_lodgix_featured_control()
    {
        
        // Get our options and see if we're handling a form submission.
        $options = get_option('widget_lodgix_featured');
    
        //Set the default options for the widget here
        if ( !is_array($options) )
          $options = array('title'=>'Featured Rentals');
    
        if ( $_POST['widget_lodgix_featured-submit'] ) {
          // Remember to sanitize and format use input appropriately.
          $options['title'] = strip_tags(stripslashes($_POST['widget_lodgix_featured-title']));
          update_option('widget_lodgix_featured', $options);
        }
    
        // Be sure you format your options to be valid HTML attributes.
        $title = htmlspecialchars($options['title'], ENT_QUOTES);
        $limit = $options['limit'];
        // Here is our little form segment. Notice that we don't need a
        // complete form. This will be embedded into the existing form.
        echo '<p style="text-align:left;"><label for="widget_lodgix_featured-title">' . __('Title:') . ' <input style="width: 200px;" id="widget_lodgix_featured-title" name="widget_lodgix_featured-title" type="text" value="'.$title.'" /></label></p>';
        echo '<input type="hidden" id="widget_lodgix_featured-submit" name="widget_lodgix_featured-submit" value="1" />';
    }
            
    // This is the function that outputs our widget_lodgix_featured.
    function widget_lodgix_featured($args)    
    {
        
        global $wpdb;
        extract($args);

        // Each widget can store its own options. We keep strings here.
        $options = get_option('widget_lodgix_featured');
        $loptions = get_option('p_lodgix_options');
        $title = apply_filters('widget_title', empty($options['title']) ? __('Featured Rentals') : $options['title']);


        echo $before_widget . $before_title . $title . $after_title;
        echo '<div class="lodgix-featured-properties" align="center">';
        
        $sql = 'SELECT ' . $this->properties_table . '.id,property_id,description,enabled,featured,main_image_thumb,bedrooms,bathrooms,proptype,city,post_id,area FROM ' . $this->properties_table . ' LEFT JOIN ' . $this->pages_table .  ' ON ' . $this->properties_table . '.id = ' . $this->pages_table .  '.property_id WHERE featured=1 order by rand()';
        $properties = $wpdb->get_results($sql);
        foreach($properties as $property)
        {
            //$page_id = $wpdb->get_var("SELECT page_id FROM " .$this->pages_table . " WHERE property_id=" . $page_id);
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
                $page_id = $wpdb->get_var("SELECT page_id FROM " . $this->lang_pages_table . " WHERE property_id=" . $property->id);
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
      
    function widget_lodgix_featured_init()
    {
        
        
        // Check for the required plugin functions. This will prevent fatal
        // errors occurring when you deactivate the dynamic-sidebar plugin.
        if ( !function_exists('register_sidebar_widget') )
            return;


        
        // This registers our widget so it appears with the other available
        // widgets and can be dragged and dropped into any active sidebars.
        register_sidebar_widget(array('Featured Rentals', 'widgets'), array(&$this,'widget_lodgix_featured'));
      
        // This registers our optional widget control form. Because of this
        // our widget will have a button that reveals a 300x100 pixel form.
        register_widget_control(array('Featured Rentals', 'widgets'), array(&$this,'widget_lodgix_featured_control'));        
    }
      
    function clean_all()
    {
        global $wpdb;
        $posts = $wpdb->get_results('SELECT * FROM ' . $this->pages_table);
        foreach($posts as $post)
        {
            wp_delete_post($post->page_id, $force_delete = true);
        }
    
        $posts_de = $wpdb->get_results('SELECT * FROM ' . $this->lang_pages_table);
        foreach($posts_de as $post)
        {
            wp_delete_post($post->page_id, $force_delete = true);
        }
    

        $languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
        if ($languages)
        {
            foreach($languages as $l)
            {
                wp_delete_post((int)$this->options['p_lodgix_vacation_rentals_page_' . $l->code], $force_delete = true);
                wp_delete_post((int)$this->options['p_lodgix_availability_page_' . $l->code], $force_delete = true);
                wp_delete_post((int)$this->options['p_lodgix_search_rentals_page_' . $l->code], $force_delete = true);
                
                $areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);
                foreach((array)$areas_pages as $key => $page)
                {
                    wp_delete_post((int)$page->page_id, $force_delete = true);
                    unset($areas_pages[$key]);
                }
            
                $this->options['p_lodgix_areas_pages_' . $l->code] = serialize($areas_pages);                
            }
        }

        $this->saveAdminOptions();
        $this->clear_tables();
    }
    
    function clean_languages($active_languages)
    {
        global $wpdb;        

        $sql = "SELECT * FROM " . $this->lang_pages_table . " WHERE language_code NOT IN (" . $active_languages . ")";
        $posts = $wpdb->get_results($sql);
 
        foreach($posts as $post)
        {
            wp_delete_post($post->page_id, $force_delete = true);
        }
        
        $wpdb->query("DELETE FROM " . $this->lang_pages_table . " WHERE language_code NOT IN (" . $active_languages . ")");  

        $languages = $wpdb->get_results("SELECT * FROM " . $this->languages_table . " WHERE code NOT IN (" . $active_languages . ")");
        
        if (is_array($languages)) {
            foreach ($languages as $l){
    
                wp_delete_post((int)$this->options['p_lodgix_vacation_rentals_page_' . $l->code], $force_delete = true);
                wp_delete_post((int)$this->options['p_lodgix_availability_page_' . $l->code], $force_delete = true);
                wp_delete_post((int)$this->options['p_lodgix_search_rentals_page_' . $l->code], $force_delete = true);
                $areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);
                if (count($areas_pages) > 0)
                {
                    foreach($areas_pages as $page)
                    {
                        wp_delete_post((int)$page->page_id, $force_delete = true);
                    }
                }
            
                $this->options['p_lodgix_areas_pages_' . $l->code] = serialize(array());
                $this->saveAdminOptions();
            }
        }
    }
    
    function p_lodgix_notify()
    {
        global $wpdb;
        ini_set('max_execution_time', 0);
        $owner_fetch_url = 'http://www.lodgix.com/api/xml/owners/get?Token=' . $this->options['p_lodgix_api_key'] . '&IncludeLanguages=No&IncludeRotators=No&IncludeAmenities=Yes&OwnerID=' . $this->options['p_lodgix_owner_id'];
        $r = new LogidxHTTPRequest($owner_fetch_url);
        $xml = $r->DownloadToString();
        $root = new DOMDocument();
        $root->loadXML($xml);
        $owner = $this->domToArray($root);
        $ownerAmenities = @$owner['Results']['Amenities']['Amenity'];
        $searchableAmenities = array();
        if (!empty($ownerAmenities))
        {
            foreach($ownerAmenities as $ownerAmenity)
            {
                $searchableAmenities[$ownerAmenity['Name']] = 1;
            }
        }
    
        $fetch_url = 'http://www.lodgix.com/api/xml/properties/get?Token=' . $this->options['p_lodgix_api_key'] . '&IncludeAmenities=Yes&IncludePhotos=Yes&IncludeConditions=Yes&IncludeRates=Yes&IncludeLanguages=Yes&IncludeTaxes=Yes&IncludeReviews=Yes&IncludeMergedRates=Yes&OwnerID=' . $this->options['p_lodgix_owner_id'];
        $r = new LogidxHTTPRequest($fetch_url);
        $xml = $r->DownloadToString();
        if ($xml)
        {
            $root = new DOMDocument();
            $root->loadXML($xml);
            $properties_array = $this->domToArray($root);
            if (!$owner['Errors'])
            {
                $sql = "DELETE FROM " . $this->lang_amenities_table;
                $wpdb->query($sql);
                $properties = $properties_array["Results"]["Properties"];
                if ($properties_array['Results']['Properties']['Property'][0]) $properties = $properties_array['Results']['Properties']['Property'];
                $active_properties = array(-1, -2, -3
                );
                $counter = 0;
                foreach($properties as $property)
                {
                    if (($property['ServingStatus'] == "ACTIVE") && ($property['WordpressStatus'] == "ACTIVE")) $active_properties[] = $property['ID'];
                    $this->update_tables($property, $counter, $searchableAmenities);
                    $counter++;
                }
    
                $active_properties = join(",", $active_properties);
                $this->clean_properties($active_properties);
                $this->build_individual_pages();
    
                // $this->build_areas_pages();
    
                die("OK");
            }
            else
            {
                die("ERROR");
            }
        }
        else
        {
            die("ERROR");
        }
    }

      
    function p_lodgix_geturls() {      		
      	header("Content-type: text/xml");
      	global $wpdb;
      	ini_set('max_execution_time', 0);
        $posts = $wpdb->get_results('SELECT * FROM ' . $this->pages_table);   
      	print "<Properties>";
      	foreach($posts as $post)        
      	{
            print "<Property>";
      		print "<ID>" . $post->property_id . "</ID>";
	        print '<URL>' .  htmlentities(urlencode(get_permalink($post->page_id))) . '</URL>';
     
            $lposts = $wpdb->get_results('SELECT * FROM ' . $this->lang_pages_table . ' WHERE property_id=' . $post->property_id);   
            foreach($lposts as $lpost)
            {
		        print '<URL' . strtoupper($lpost->language_code) . '>' . htmlentities(urlencode(get_permalink($lpost->page_id))) . '</URL' . strtoupper($lpost->language_code) . '>';
            }	          
	        print "</Property>";
  		}
        print "</Properties>";
  					      		
        die("");    
    }      
      
      
 	function p_lodgix_check() {
      	ini_set('max_execution_time', 0);         
        die("PLUGIN_INSTALLED");
    }      
      
    function set_page_options()
    {
        global $wpdb;
        
        $active_languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
        foreach ($active_languages as $l) {
                        
            $post_id = (int)$this->options['p_lodgix_vacation_rentals_page_' . $l->code];
            $post = array();
            $post['ID'] = $post_id;
            $exists = get_post($post_id);
            if ($exists)
            {
                if ($this->options['p_lodgix_allow_comments']) $post['comment_status'] = 'open';
                else $post['comment_status'] = 'closed';
                if ($this->options['p_lodgix_allow_pingback']) $post['ping_status'] = 'open';
                else $post['ping_status'] = 'closed';
                wp_update_post($post);
            }
        
            $post_id = (int)$this->options['p_lodgix_availability_page_' . $l->code];
            $post = array();
            $post['ID'] = $post_id;
            $exists = get_post($post_id);
            if ($exists)
            {
                if ($this->options['p_lodgix_allow_comments']) $post['comment_status'] = 'open';
                else $post['comment_status'] = 'closed';
                if ($this->options['p_lodgix_allow_pingback']) $post['ping_status'] = 'open';
                else $post['ping_status'] = 'closed';
                wp_update_post($post);
            }
        
            $post_id = (int)$this->options['p_lodgix_search_rentals_page_' . $l->code];
            $post = array();
            $post['ID'] = $post_id;
            $exists = get_post($post_id);
            if ($exists)
            {
                if ($this->options['p_lodgix_allow_comments']) $post['comment_status'] = 'open';
                else $post['comment_status'] = 'closed';
                if ($this->options['p_lodgix_allow_pingback']) $post['ping_status'] = 'open';
                else $post['ping_status'] = 'closed';
                wp_update_post($post);
            }
    
        }
        
        $pages = $wpdb->get_results('SELECT * FROM ' . $this->pages_table);
        foreach($pages as $page)
        {
            $post_id = $page->page_id;
            $post = array();
            $post['ID'] = $post_id;
            $exists = get_post($post_id);
            if ($exists)
            {
                if ($this->options['p_lodgix_allow_comments'])
                    $post['comment_status'] = 'open';
                else $post['comment_status'] = 'closed';
                if ($this->options['p_lodgix_allow_pingback']) $post['ping_status'] = 'open';
                else $post['ping_status'] = 'closed';
                wp_update_post($post);
            }
        }
    
        $areas_pages = unserialize($this->options['p_lodgix_areas_pages_en']);
        foreach($areas_pages as $page)
        {
            $post_id = $page->page_id;
            $post = array();
            $post['ID'] = $post_id;
            $exists = get_post($post_id);
            if ($exists)
            {
                if ($this->options['p_lodgix_allow_comments']) $post['comment_status'] = 'open';
                else $post['comment_status'] = 'closed';
                if ($this->options['p_lodgix_allow_pingback']) $post['ping_status'] = 'open';
                else $post['ping_status'] = 'closed';
                wp_update_post($post);
            }
        }
        
        $active_languages = $wpdb->get_results("SELECT * FROM " . $this->languages_table . " WHERE enabled = 1 and code <> 'en'");
        foreach ($active_languages as $l) {    
            $pages = $wpdb->get_results("SELECT * FROM " . $pages_lang_table . " WHERE language_code='" . $l->code . "'");
            foreach($pages as $page)
            {
                $post_id = $page->page_id;
                $post = array();
                $post['ID'] = $post_id;
                $exists = get_post($post_id);
                if ($exists)
                {
                    if ($this->options['p_lodgix_allow_comments']) $post['comment_status'] = 'open';
                    else $post['comment_status'] = 'closed';
                    if ($this->options['p_lodgix_allow_pingback']) $post['ping_status'] = 'open';
                    else $post['ping_status'] = 'closed';
                    wp_update_post($post);
                }
            }
    
            $areas_pages = unserialize($this->options['p_lodgix_areas_pages_'] . $l->code);
            if (is_array($areas_pages)) {
                foreach($areas_pages as $page)
                {
                    $post_id = $page->page_id;
                    $post = array();
                    $post['ID'] = $post_id;
                    $exists = get_post($post_id);
                    if ($exists)
                    {
                        if ($this->options['p_lodgix_allow_comments']) $post['comment_status'] = 'open';
                        else $post['comment_status'] = 'closed';
                        if ($this->options['p_lodgix_allow_pingback']) $post['ping_status'] = 'open';
                        else $post['ping_status'] = 'closed';
                        wp_update_post($post);
                    }
                }
            }
    
            $this->link_translated_pages();
        }
    }
    
    function format_date($date)
    {
        $formatted_date = strftime($this->options['p_lodgix_date_format'], strtotime($date));
        return $formatted_date;
    }

      
    function clean_properties($active_properties)
    {
        global $wpdb;
        
        $properties = $wpdb->get_results('SELECT * FROM ' . $this->properties_table . '  WHERE id not in (' . $active_properties . ')'); 
        if ($properties)
        {
            foreach($properties as $property)    	
            {
                wp_delete_post((int)$property->post_id,$force_delete = true);
            }
        }
        
        $sql = "SELECT FROM " . $this->properties_table . " WHERE id not in (" . $active_properties . ")";
        
        $sql = "DELETE FROM " . $this->properties_table . " WHERE id not in (" . $active_properties . ")";
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $this->amenities_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $this->rates_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $this->merged_rates_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);        
        $sql = "DELETE FROM " . $this->rules_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);          
        $sql = "DELETE FROM " . $this->pictures_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);      
        $sql = "DELETE FROM " . $this->pages_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql); 
        $sql = "DELETE FROM " . $this->lang_pages_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);         
        $sql = "DELETE FROM " . $this->properties_lang_table . " WHERE id not in (" . $active_properties . ")";
        $wpdb->query($sql);
    }      
      
    function p_lodgix_build() {
        global $wpdb;
        global $p_lodgix_db_version;
        
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
            
         $sql = "CREATE TABLE " . $table_name . " (
              `id` int(10) unsigned NOT NULL,
              `owner_id` int(10) unsigned,
              `description` varchar(255) default NULL,
              `description_long` text,
              `details` text,
              `main_image` varchar(255) default NULL,
              `main_image_thumb` varchar(255) default NULL,
              `address` varchar(500) default NULL,
              `city` varchar(100) default NULL,
              `zip` varchar(10) default NULL,
              `state_code` varchar(2) default NULL,
              `country_code` varchar(2) default NULL,
              `bedrooms` smallint(6) default '0',
              `bathrooms` float default '0',
              `minrate` float default '0',
              `maxrate` float default '0',
              `min_daily_rate` float default '0',
              `min_weekly_rate` float default '0',
              `min_monthly_rate` float default '0',        
              `sleeps` smallint(6) default '0',
              `smoking` tinyint(1) default '0',
              `pets` tinyint(1) default '0',
              `children` tinyint(1) default '0',
              `rates` text,
              `proptype` varchar(255) default NULL,
              `latitude` double default '-1',
              `longitude` double default '-1',
              `contact` varchar(255) default NULL,
              `phone_local` varchar(50) default NULL,
              `phone_free_toll` varchar(50) default NULL,
              `email` varchar(255) default NULL,
              `serving_status` tinyint(1) default '1',
              `deleted` smallint(6) default '0',
              `date_created` timestamp NULL default NULL,
              `date_modified` timestamp NULL default NULL,
              `ts` timestamp NULL default NULL,
              `web_address` varchar(255) default NULL,
              `arrival_times` text,
              `state` varchar(64) default NULL,
              `currency_code` varchar(3) default NULL,
              `currency_symbol` varchar(1) default NULL,
              `display_calendar` tinyint(1) default '1',
              `allow_booking` tinyint(1) default '1',
              `check_in` varchar(10) default NULL,
              `check_out` varchar(10) default NULL,
              `post_id` bigint,
              `area` varchar(255) default NULL,
               `order` int(10) unsigned NULL,
               `video_url` text default NULL,
               `virtual_tour_url` text default NULL,
               `beds_text` text default NULL,
               PRIMARY KEY  (`id`)
         ) DEFAULT CHARSET=utf8;";
         $wpdb->query($sql);
        }           
        $table_name = $wpdb->prefix . "lodgix_lang_properties";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
         $sql = "CREATE TABLE " . $table_name . " (
              `id` int(10) unsigned NOT NULL,
              `description` varchar(255) default NULL,
              `description_long` text,
              `details` text,
               `language_code` varchar(2) NOT NULL,
               PRIMARY KEY (`id`,`language_code`)
         ) DEFAULT CHARSET=utf8;";
         $wpdb->query($sql);
        }                 
        $table_name = $wpdb->prefix . "lodgix_amenities";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
            
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(10) NOT NULL auto_increment,
          `property_id` int(11) NOT NULL,
          `description` varchar(255) NOT NULL,
          PRIMARY KEY  (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);
        }     
        $table_name = $wpdb->prefix . "lodgix_rates";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
            
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL auto_increment,
          `property_id` int(11) NOT NULL,
          `from_date` date default NULL,
          `to_date` date default NULL,
          `sunday_rate` decimal(10,2) default NULL,
          `monday_rate` decimal(10,2) default NULL,
          `tuesday_rate` decimal(10,2) default NULL,
          `wednesday_rate` decimal(10,2) default NULL,
          `thursday_rate` decimal(10,2) default NULL,
          `friday_rate` decimal(10,2) default NULL,
          `saturday_rate` decimal(10,2) default NULL,
          `min_nights` int(11) NOT NULL default '1',
          `default_rate` decimal(10,2) NOT NULL,
          `is_default` tinyint(1) NOT NULL default '0',
          `name` varchar(128) default NULL,
          PRIMARY KEY  (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);   
        }
        
        $table_name = $wpdb->prefix . "lodgix_merged_rates";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
            
        $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL auto_increment,
          `property_id` int(11) NOT NULL,
          `from_date` date default NULL,
          `to_date` date default NULL,
          `nightly` decimal(10,2) default NULL,
          `weekend_nightly` decimal(10,2) default NULL,
          `weekly` decimal(10,2) default NULL,
          `monthly` decimal(10,2) default NULL,
          `min_stay` int(11) NOT NULL default '1',
          `rate_type` varchar(64) default NULL,
          `name` varchar(128) default NULL,
          PRIMARY KEY  (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);   
        }      
    
        
        $table_name = $wpdb->prefix . "lodgix_pictures";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
            
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL auto_increment,
          `property_id` int(11) NOT NULL,
          `position` smallint(6) default NULL,
          `caption` varchar(255) default NULL,
          `url` varchar(255) default NULL,
          `thumb_url` varchar(255) default NULL,      
           PRIMARY KEY  (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);             
        } 
        $table_name = $wpdb->prefix . "lodgix_rules";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
            
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL auto_increment,
          `property_id` int(11) NOT NULL,
          `from_date` date default NULL,
          `to_date` date default NULL,
          `min_nights` int(11) NOT NULL default '1',
          `is_default` tinyint(1) NOT NULL default '0',
          `name` varchar(128) default NULL,
           PRIMARY KEY  (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);             
        } 
        $table_name = $wpdb->prefix . "lodgix_pages";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL auto_increment,
          `property_id` int NOT NULL,
          `page_id` bigint NOT NULL,
          `parent_page_id` bigint default NULL,
          `enabled` tinyint(1) NOT NULL default '0',
          `featured` tinyint(1) NOT NULL default '0',        
           PRIMARY KEY  (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);             
        }     
        $table_name = $wpdb->prefix . "lodgix_lang_pages";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL auto_increment,
          `property_id` int NOT NULL,
          `page_id` bigint NOT NULL,
          `source_page_id` bigint default NULL,
          `language_code` varchar(2) NOT NULL,
           PRIMARY KEY  (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);             
        } 
    
        $table_name = $wpdb->prefix . "lodgix_lang_amenities";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
         $sql = "CREATE TABLE " . $table_name . " (
          `description` varchar(255) NOT NULL DEFAULT '',
          `description_translated` varchar(255) DEFAULT NULL,
          `language_code` varchar(2),
          `searchable` tinyint(1) NOT NULL default 0,
          PRIMARY KEY (`description`)
         ) DEFAULT CHARSET=utf8;";
         $wpdb->query($sql);
        }        
        
        $table_name = $wpdb->prefix . "lodgix_link_rotators";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL auto_increment,
          `url` varchar(255) NOT NULL DEFAULT '',
          `title` varchar(255) DEFAULT NULL,
          PRIMARY KEY (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);             
        }              
    
        $table_name = $wpdb->prefix . "lodgix_policies";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL auto_increment,
          `cancellation_policy` longtext NULL,
          `deposit_policy` longtext NULL,
          `single_unit_helptext` longtext NULL,        
          `multi_unit_helptext` longtext NULL, 
          `language_code` varchar(2) NOT NULL,
           PRIMARY KEY  (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);             
        }      
        
        $table_name = $wpdb->prefix . "lodgix_fees";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `property_id` int(11) NOT NULL,
          `title` varchar(255) NOT NULL,
          `value` double NOT NULL,
          `tax_exempt` tinyint(1) NOT NULL,
          `is_flat` tinyint(1) NOT NULL,
          `type` varchar(32) NOT NULL,
           PRIMARY KEY (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);           
        }                  
        
        $table_name = $wpdb->prefix . "lodgix_taxes";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `property_id` int(11) NOT NULL,
          `type` varchar(32) NOT NULL,
          `title` varchar(255) NOT NULL,
          `value` double NOT NULL,
          `is_flat` tinyint(1) NOT NULL,
          `frequency` varchar(16) NOT NULL,
           PRIMARY KEY (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);           
        }       
        
        $table_name = $wpdb->prefix . "lodgix_deposits";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `property_id` int(11) NOT NULL,
          `title` varchar(255) NOT NULL,
          `value` double NOT NULL,
           PRIMARY KEY (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);             
        }      
    
        $table_name = $wpdb->prefix . "lodgix_reviews";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
         $sql = "CREATE TABLE " . $table_name . " (
          `id` int(11) NOT NULL auto_increment,
          `property_id` int(11) NOT NULL,
          `date` datetime NOT NULL,
          `name` varchar(100) NOT NULL,
          `description` text NOT NULL,
          `language_code` varchar(2) NOT NULL,
          PRIMARY KEY  (`id`)
         ) DEFAULT CHARSET=utf8;";      
         $wpdb->query($sql);             
        }
    
        $table_name = $wpdb->prefix . "lodgix_languages";
        if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
            $sql = "CREATE TABLE " . $table_name . " (
             `id` int(11) NOT NULL auto_increment,
             `code` varchar(7) NOT NULL,
             `name` varchar(128) NOT NULL,
             `enabled` BOOL NOT NULL DEFAULT 0,
             `locale` varchar(8) DEFAULT NULL,
             PRIMARY KEY  (`id`)      
            ) DEFAULT CHARSET=utf8;";      
            $wpdb->query($sql);
         

            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('1', 'en', 'English', '1', 'en_US');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('2', 'es', 'Spanish', '0', 'es_ES');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('3', 'de', 'German', '1', 'de_DE');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('4', 'fr', 'French', '0', 'fr_FR');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('5', 'ar', 'Arabic', '0', 'ar');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('6', 'bs', 'Bosnian', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('7', 'bg', 'Bulgarian', '0', 'bg_BG');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('8', 'ca', 'Catalan', '0', 'ca');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('9', 'cs', 'Czech', '0', 'cs_CZ');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('10', 'sla', 'Slavic', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('11', 'cy', 'Welsh', '0', 'cy');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('12', 'da', 'Danish', '0', 'da_DK');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('13', 'el', 'Greek', '0', 'el');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('14', 'eo', 'Esperanto', '0', 'eo');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('15', 'et', 'Estonian', '0', 'et');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('16', 'eu', 'Basque', '0', 'eu');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('17', 'fa', 'Persian', '0', 'fa_IR');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('18', 'fi', 'Finnish', '0', 'fi_FI');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('19', 'ga', 'Irish', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('20', 'he', 'Hebrew', '0', 'he_IL');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('21', 'hi', 'Hindi', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('22', 'hr', 'Croatian', '0', 'hr');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('23', 'hu', 'Hungarian', '0', 'hu_HU');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('24', 'hy', 'Armenian', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('25', 'id', 'Indonesian', '0', 'id_ID');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('26', 'is', 'Icelandic', '0', 'is_IS');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('27', 'it', 'Italian', '0', 'it_IT');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('28', 'ja', 'Japanese', '0', 'ja');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('29', 'ko', 'Korean', '0', 'ko_KR');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('30', 'ku', 'Kurdish', '0', 'ku');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('31', 'la', 'Latin', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('32', 'lv', 'Latvian', '0', 'lv');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('33', 'lt', 'Lithuanian', '0', 'lt');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('34', 'mk', 'Macedonian', '0', 'mk_MK');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('35', 'mt', 'Maltese', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('36', 'mo', 'Moldavian', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('37', 'mn', 'Mongolian', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('38', 'ne', 'Nepali', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('39', 'nl', 'Dutch', '0', 'nl_NL');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('40', 'nb', 'Norwegian Bokmål', '0', 'nb_NO');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('41', 'pa', 'Punjabi', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('42', 'pl', 'Polish', '0', 'pl_PL');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('43', 'pt-pt', 'Portuguese, Portugal', '0', 'pt_PT');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('44', 'pt-br', 'Portuguese, Brazil', '0', 'pt_BR');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('45', 'qu', 'Quechua', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('46', 'ro', 'Romanian', '0', 'ro_RO');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('47', 'ru', 'Russian', '0', 'ru_RU');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('48', 'sl', 'Slovenian', '0', 'sl_SI');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('49', 'so', 'Somali', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('50', 'sq', 'Albanian', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('51', 'sr', 'Serbian', '0', 'sr_RS');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('52', 'sv', 'Swedish', '0', 'sv_SE');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('53', 'ta', 'Tamil', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('54', 'th', 'Thai', '0', 'th');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('55', 'tr', 'Turkish', '0', 'tr');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('56', 'uk', 'Ukrainian', '0', 'uk_UA');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('57', 'ur', 'Urdu', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('58', 'uz', 'Uzbek', '0', 'uz_UZ');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('59', 'vi', 'Vietnamese', '0', 'vi');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('60', 'yi', 'Yiddish', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('61', 'zh-hans', 'Chinese (Simplified)', '0', 'zh_CN');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('62', 'zu', 'Zulu', '0', '');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('63', 'zh-hant', 'Chinese (Traditional)', '0', 'zh_TW');");
            $wpdb->query("INSERT INTO " . $table_name . " VALUES ('64', 'ms', 'Malay', '0', 'ms_MY');");         
        }            
           
      
        add_option("p_lodgix_db_version", $p_lodgix_db_version); 
        if ($this->options['p_lodgix_create_availability'] == NULL)
            $this->options['p_lodgix_create_availability'] = true;
        $this->options['p_lodgix_page'] = array();
        $this->saveAdminOptions();
    }
    
    /**
    * Updates Database
    **/
    function update_db($old_db_version) {
        global $wpdb;
        global $p_lodgix_db_version;


        
        if ($old_db_version < 1.2)
        {
            $pictures_path = WP_CONTENT_DIR.'/lodgix_pictures'; 
            $this->rrmdir($pictures_path);        	          
        }
    
        if ($old_db_version < 1.3)
        {
            $sql = "ALTER TABLE " . $this->properties_table  . " MODIFY COLUMN `bathrooms` float default '0';";
            $wpdb->query($sql);        	
        }
        
        if ($old_db_version < 1.4)
        {
            $sql = "ALTER TABLE " . $this->pictures_table  . " MODIFY COLUMN `caption` varchar(255) default NULL;";
            $wpdb->query($sql);        	
        }        
    
        if ($old_db_version < 1.5)
        {
            $sql = "ALTER TABLE " . $this->properties_table  . " ADD COLUMN `video_url` text default NULL;";
            $wpdb->query($sql);        	
            $sql = "ALTER TABLE " . $this->properties_table  . " ADD COLUMN `virtual_tour_url` text default NULL;";
            $wpdb->query($sql);        	
        }        
    
        if ($old_db_version < 1.6)
        {
            $sql = "ALTER TABLE " . $this->properties_table  . " ADD COLUMN `beds_text` text default NULL;";
            $wpdb->query($sql);        	 	
        }        
        
        if ($old_db_version < 1.7)
        {
            $this->build_individual_pages();
        }                
    
        if ($old_db_version < 1.8)
        {
             $table_name = $wpdb->prefix . "lodgix_link_rotators";
             if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
                    $sql = "CREATE TABLE " . $table_name . " (
                        `id` int(11) NOT NULL auto_increment,
                        `url` varchar(255) NOT NULL DEFAULT '',
                        `title` varchar(255) DEFAULT NULL,
                        PRIMARY KEY (`id`)
             );";             		 
             $wpdb->query($sql);     
            }
        }                
    
        if ($old_db_version < 1.9) {
            $wpdb->query("ALTER TABLE " . $wpdb->prefix . "lodgix_lang_amenities ADD COLUMN searchable tinyint(1) NOT NULL default 0;");     
        }                

        if ($old_db_version < 2.0) {
            $this->options['p_lodgix_vacation_rentals_page_en'] = $this->options['p_lodgix_vacation_rentals_page'];
            $this->options['p_lodgix_contact_url_en'] = $this->options['p_lodgix_contact_url'];
            $this->options['p_lodgix_search_rentals_page_en'] = $this->options['p_lodgix_search_rentals_page'];
            $this->options['p_lodgix_availability_page_en'] = $this->options['p_lodgix_availability_page'];
            $this->options['p_lodgix_areas_pages_en'] = $this->options['p_lodgix_areas_pages'];
            if ($this->options['p_lodgix_generate_german'])
            {
                $wpdb->query("UPDATE " . $this->languages_table . " SET enabled=1 WHERE code = 'de'");
            }
            
            $languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table);
            
            foreach ($languages as $l) {        
                $areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);
                if (!is_array($areas_pages))
                    $this->options['p_lodgix_areas_pages_' . $l->code] = serialize(array());
            }
            
            $wpdb->query("ALTER TABLE " . $wpdb->prefix . "lodgix_lang_amenities ADD COLUMN `language_code` varchar(2);");
            $wpdb->query("ALTER TABLE " . $wpdb->prefix . "lodgix_lang_amenities CHANGE COLUMN `description_de` `description_translated` varchar(255) DEFAULT NULL;");
            $wpdb->query("UPDATE " . $wpdb->prefix . "lodgix_lang_amenities SET language_code = 'de';");
            
            $wpdb->query("ALTER TABLE " . $wpdb->prefix . "lodgix_lang_properties DROP PRIMARY KEY, ADD PRIMARY KEY(`id`,`language_code`);");
            
            $this->saveAdminOptions();
            wp_redirect($_SERVER["REQUEST_URI"]);
        }                
        
        
    }               
      

      
    function update_owner($owner)
    {
        global $wpdb;
        
        if ($owner) 
        {
            $this->options['p_lodgix_date_format'] = $owner["Results"]['DateTimeFormat']['DateFormat'];
            $this->options['p_lodgix_time_format'] = $owner["Results"]['DateTimeFormat']['TimeFormat'];
            
            $this->options['p_lodgix_root_width'] = $owner["Results"]['MultiWidgetSettings']['RootWidth'];   
            $this->options['p_lodgix_root_height'] = $owner["Results"]['MultiWidgetSettings']['RootHeight'];              
            $this->options['p_lodgix_show_header'] = '0';
            //if ($this->options['p_lodgix_show_header'] == '0')
            //{
            //  $this->options['p_lodgix_root_height'] = $owner["Results"]['MultiWidgetSettings']['RootHeight'] - $ROOT_HEIGHT;  
            //}                       
            $this->options['p_lodgix_block_corner_rad'] = $owner["Results"]['MultiWidgetSettings']['BlockCornerRad'];    
            $this->options['p_lodgix_days_number'] = $owner["Results"]['MultiWidgetSettings']['DaysNumber'];
            $this->options['p_lodgix_row_number'] = $owner["Results"]['MultiWidgetSettings']['RowNumber'];                    
            $this->options['p_lodgix_cell_color_serv'] = $owner["Results"]['MultiWidgetSettings']['CellColorServ'];
            $this->options['p_lodgix_cell_color'] = $owner["Results"]['MultiWidgetSettings']['CellColor'];                                        
            $this->options['p_lodgix_show_email'] = $owner["Results"]['MultiWidgetSettings']['ShowEmail'];    
            $this->options['p_lodgix_show_site'] = $owner["Results"]['MultiWidgetSettings']['ShowSite'];
            $this->options['p_lodgix_name_col_width'] = $owner["Results"]['MultiWidgetSettings']['NameColWidth'];                    
            $this->options['p_lodgix_labels_font_size'] = $owner["Results"]['MultiWidgetSettings']['LabelsFontSize'];
            $this->options['p_lodgix_use_property_hyperlinks'] = $owner["Results"]['MultiWidgetSettings']['UsePropertyHyperlinks']; 
            $this->options['p_lodgix_title_size'] = $owner["Results"]['MultiWidgetSettings']['TitleSize'];      
            
           
            $sql = "DELETE FROM " . $this->policies_table;
            $wpdb->query($sql);
                      $sql = "DELETE FROM " . $this->link_rotators_table;
                  $wpdb->query($sql);
            
            $policies = array();
            $policies['cancellation_policy'] = $owner["Results"]['Website']['CancellationPolicy'];
            $policies['deposit_policy'] = $owner["Results"]['Website']['DepositPolicy'];   
            $policies['single_unit_helptext'] = $owner["Results"]['Website']['CalendarHelpText'];
            $policies['multi_unit_helptext'] = $owner["Results"]['Website']['HTML5MultiCalendarHelpText'];
          
            $policies['language_code'] = 'en';    
            $sql = $this->get_insert_sql_from_array($this->policies_table,$policies);      
            $wpdb->query($sql);          
  
            $languages = $owner["Results"]['Languages'];        
            if ($owner["Results"]['Languages'][0])
                $languages = $owner["Results"]['Languages']['Language'];        
          
            if (($this->options['p_lodgix_generate_german']) && ($owner))
            {
    
                foreach ($languages as $language)
                {    
                    $langarray = array();
                    $langarray['language_code'] = $language['LanguageCode']; 
                    $langarray['cancellation_policy'] = $language['CancellationPolicy'];
                    $langarray['deposit_policy'] = $language['DepositPolicy']; 
                    $langarray['single_unit_helptext'] = $language['CalendarHelpText'];  
                    $langarray['multi_unit_helptext'] = $language['HTML5MultiCalendarHelpText'];  
                    
                    $sql = $this->get_insert_sql_from_array($this->policies_table,$langarray);
                    $wpdb->query($sql);     
                }
            }
           
            $rotators = $owner["Results"]['Rotators']['Rotator'];    
            foreach ($rotators as $rotator)
            {    
                $rotatorarray = array();
                $rotatorarray['url'] = $rotator['URL']; 
                $rotatorarray['title'] = $rotator['Title'];       
                $sql = $this->get_insert_sql_from_array($this->link_rotators_table,$rotatorarray);
                $wpdb->query($sql);     
            }           
        }                                     
        else
        {
            $this->options['p_lodgix_date_format'] = '%m/%d/%Y';
            $this->options['p_lodgix_time_format'] = '12';
        }        
    }
      

    /**
    * Returns Last Index
    **/
    function lastIndexOf($substr, $str){
        if(false !== ($r = strpos(strrev($str), strrev($substr))))
            return strlen($str)-$r-strlen($substr);
        return false;
    }
    
    /**
    * Truncates text
    **/
    function truncate_text($text,$limit)      
    {
        if (strlen($text) < $limit)
            return $text;
        
        $text = substr ($text, 0,$limit-1);
        $text = substr ($text, 0,$this->lastIndexOf(' ',$text));
        return $text . '.';
    }
      
    /**
    * Delete Folder
    **/      
    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
       }
    }       
      
 
    /**
    * Clears Posts Revisions
    */
	function clear_revisions() { 
        global $wpdb;   
					
        if ($this->options['p_lodgix_vacation_rentals_page_en'])
        {						
            $sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_vacation_rentals_page_en'];
            $wpdb->query($sql);
        }
        if ($this->options['p_lodgix_availability_page_en'])
        {						
            $sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_availability_page_en'];
            $wpdb->query($sql);
        }          
        if ($this->options['p_lodgix_search_rentals_page_en'])
        {						
            $sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_search_rentals_page_en'];
            $wpdb->query($sql);
        }          
         
					 
        $posts = $wpdb->get_results('SELECT * FROM ' . $this->pages_table);   
        foreach($posts as $post)
        {
			$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $post->page_id;
			$wpdb->query($sql);          	
        }
        
        $active_languages = $wpdb->get_results("SELECT * FROM " . $this->languages_table . " WHERE enabled = 1 and code <> 'en'");
		if (count($active_languages) > 0)
		{
						
			if ($this->options['p_lodgix_vacation_rentals_page_' . $l->code]) {						
				$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_vacation_rentals_page_de'];
				$wpdb->query($sql);
			}
					 
            if ($this->options['p_lodgix_availability_page_' . $l->code]) {						
				$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_availability_page_de'];
				$wpdb->query($sql);
			}          
			
            if ($this->options['p_lodgix_search_rentals_page_' . $l->code]) {						
				$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_search_rentals_page_de'];
				$wpdb->query($sql);
		    }          
					 
					 
            $posts = $wpdb->get_results("SELECT * FROM " . $this->lang_pages_table . " WHERE language_code = '" . $l->code . "'" );   
            foreach($posts as $post)
            {
                $sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $post->page_id;
				$wpdb->query($sql);          	
            }
        }
		
        $active_languages = $wpdb->get_results("SELECT * FROM " . $this->languages_table . " WHERE enabled = 1");
        foreach($active_languages as $l) {
            $areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);
            if ((count($areas_pages) > 0) && (is_array($areas_pages))) {
                foreach($areas_pages as $page) {
                    $sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $page->page_id;
                    $wpdb->query($sql);          	
                }
            }
        }
    }  
      
      /**
    * Adds settings/options page
    */
    function admin_options_page() { 
        global $p_lodgix_db_version;
        global $wpdb;
        
        //$this->link_translated_pages();
        //die();
        
        $this->p_lodgix_build();
          
        if (get_option('p_lodgix_db_version'))
        {
          $old_db_version = ((float)get_option('p_lodgix_db_version'));
          if ($old_db_version < ((float)$p_lodgix_db_version))
          {
            
            $this->update_db($old_db_version);
          }
        }
        update_option('p_lodgix_db_version',$p_lodgix_db_version);

        $languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table);
            
        foreach ($languages as $l) {        
            $areas_pages = unserialize($this->options['p_lodgix_areas_pages_' . $l->code]);
            if (!is_array($areas_pages))
                $this->options['p_lodgix_areas_pages_' . $l->code] = serialize(array());
                
        }
        $this->saveAdminOptions();

           
                   
        
          
        if($_POST['p_lodgix_save']) {
            
            
            ini_set('max_execution_time', 0);
            if (! wp_verify_nonce($_POST['_wpnonce'], 'p_lodgix-update-options') ) {
                die('Whoops! There was a problem with the data you posted. Please go back and try again.');
            }
            $cleaned = false;
            if (($this->options['p_lodgix_owner_id'] != ((int)$_POST['p_lodgix_owner_id'])) || ($this->options['p_lodgix_display_title'] != $_POST['p_lodgix_display_title'])) {                             
                $this->clean_all();
                $cleaned = true;
            }
            
            
       
                                                
            $this->clear_revisions();
            
            if ($_POST['p_lodgix_allow_comments'] == "on")
                $this->options['p_lodgix_allow_comments'] = true;
            else
                $this->options['p_lodgix_allow_comments'] = false;
            if ($_POST['p_lodgix_allow_pingback'] == "on")
                $this->options['p_lodgix_allow_pingback'] = true;
            else
                $this->options['p_lodgix_allow_pingback'] = false;
                
            if ($_POST['p_lodgix_thesis_compatibility'] == "on")
                $this->options['p_lodgix_thesis_compatibility'] = true;
            else
                $this->options['p_lodgix_thesis_compatibility'] = false;
    
            if ($_POST['p_lodgix_thesis_2_compatibility'] == "on")
                $this->options['p_lodgix_thesis_2_compatibility'] = true;
            else
                $this->options['p_lodgix_thesis_2_compatibility'] = false;
            
            if ($_POST['p_lodgix_full_size_thumbnails'] == "on")
                $this->options['p_lodgix_full_size_thumbnails'] = true;
            else
                $this->options['p_lodgix_full_size_thumbnails'] = false;                      
                
            
            
      
            if ($_POST['p_lodgix_display_daily_rates'] == "on")
                $this->options['p_lodgix_display_daily_rates'] = true;
            else
                $this->options['p_lodgix_display_daily_rates'] = false;                                  
            if ($_POST['p_lodgix_display_icons'] == "on")
                $this->options['p_lodgix_display_icons'] = true;
            else
                $this->options['p_lodgix_display_icons'] = false;                                  
            if ($_POST['p_lodgix_display_availability_icon'] == "on")
                $this->options['p_lodgix_display_availability_icon'] = true;
            else
                $this->options['p_lodgix_display_availability_icon'] = false;                 
                                     
            

            $active_languages = array("'en'");
            
            $languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table);
            if ($languages)
            {
                foreach ($languages as $l) {
                    if ($_POST['p_lodgix_contact_url_' . $l->code]) {
                        $this->options['p_lodgix_contact_url_' . $l->code] = $_POST['p_lodgix_contact_url_' . $l->code];
                    }
                    if ($_POST['p_lodgix_generate_' . $l->code] && ($l->code != 'en')) {
                        
                        array_push($active_languages,"'" . $l->code . "'");
                    }
                }
                $active_languages = implode(',',$active_languages);
                
                $wpdb->query("UPDATE " . $this->languages_table . " SET enabled = 0 WHERE code NOT IN (" . $active_languages . ")");
                $wpdb->query("UPDATE " . $this->languages_table . " SET enabled = 1 WHERE code IN (" . $active_languages . ")");
                
                $this->clean_languages($active_languages);
            }
            
            $this->saveAdminOptions();              

            if ((!$this->options['p_lodgix_vr_title']) || ($this->options['p_lodgix_vr_title'] == '')) {
                $this->options['p_lodgix_vr_title'] = "Vacation Rentals";    
            }
            
      
            
            $this->saveAdminOptions();
                                                
            $this->options['p_lodgix_display_featured_horizontally'] = (int)$_POST['p_lodgix_display_featured_horizontally'];                                         
            $this->options['p_lodgix_owner_id'] = $_POST['p_lodgix_owner_id'];  
            $this->options['p_lodgix_api_key'] = $_POST['p_lodgix_api_key'];           
            $this->options['p_google_maps_api'] = $_POST['p_google_maps_api']; 
            $this->options['p_lodgix_display_title'] = $_POST['p_lodgix_display_title'];
            $this->options['p_lodgix_display_multi_instructions'] = ((int)$_POST['p_lodgix_display_multi_instructions']);
            $this->options['p_lodgix_single_page_design'] = ((int)$_POST['p_lodgix_single_page_design']);                  
            $this->options['p_lodgix_display_single_instructions'] = ((int)$_POST['p_lodgix_display_single_instructions']);
            $this->options['p_lodgix_rates_display'] = ((int)$_POST['p_lodgix_rates_display']);                  
            $this->options['p_lodgix_display_featured'] = $_POST['p_lodgix_display_featured'];                                    
            $this->options['p_lodgix_vacation_rentals_page_pos'] = $_POST['p_lodgix_vacation_rentals_page_pos'];
            $this->options['p_lodgix_availability_page_pos'] = $_POST['p_lodgix_availability_page_pos'];                  
            $this->options['p_lodgix_vr_title'] = $_POST['p_lodgix_vr_title']; 
            $this->options['p_lodgix_vr_meta_description'] = $_POST['p_lodgix_vr_meta_description']; 
            $this->options['p_lodgix_vr_meta_keywords'] = $_POST['p_lodgix_vr_meta_keywords'];   
            $this->options['p_lodgix_custom_page_template'] = $_POST['p_lodgix_custom_page_template'];   
            $this->options['p_lodgix_thesis_2_template'] = $_POST['p_lodgix_thesis_2_template'];
            
            $this->p_lodgix_set_page_titles();
                 
            $languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
            if ($languages)
            {
                foreach ($languages as $l) {                  

                    $post = array();
                    $post['post_title'] = $this->page_titles[$l->code]['vacation_rentals'];
                    //if ($l->code == 'en') {
                    //    $post['post_title'] = $this->options['p_lodgix_vr_title'];
                    //}
                    $post['menu_order'] = 1;
                    $post['post_status'] = 'publish';                        
                    $post['post_content'] = '[lodgix_vacation_rentals]';  
                    $post['post_author'] = 1;
                    $post['post_type'] = "page";                  
                    $exists = get_post($this->options['p_lodgix_vacation_rentals_page_' . $l->code]);
                    
                    
                    if (!$exists)                 
                    {
                        $post_de_id = wp_insert_post( $post );   
                        if ($post_de_id != 0)
                        {
                            $this->options['p_lodgix_vacation_rentals_page_' . $l->code] = (int)$post_de_id;
                            if ($l->code != 'en') {
                                $sql = "INSERT INTO " . $this->lang_pages_table . "(page_id,property_id,source_page_id,language_code) VALUES(" . $post_de_id . ",-1,NULL,'" . $l->code ."')";
                                $wpdb->query($sql);
                            }
                        }         
                    }
                    else 
                    {
                        $post = array();
                        $post['post_title'] = $this->page_titles[$l->code]['vacation_rentals'];
                        //if ($l->code == 'en') {
                        //    $post['post_title'] = $this->options['p_lodgix_vr_title'];
                        //}
                        $post['post_name'] = sanitize_title($post['post_title']);
                        $post['post_content'] = '[lodgix_vacation_rentals]'; 
                        $post['ID'] = $this->options['p_lodgix_vacation_rentals_page_' . $l->code];
                        $post_id = wp_update_post($post);        
                        $posts_table = $wpdb->prefix . "posts";
                        $sql = "UPDATE " . $posts_table . " SET post_content='[lodgix_vacation_rentals]' WHERE id=" . $post_id;
                        $wpdb->query($sql);  
                    }
                }
            }
  
            $this->saveAdminOptions();            
              
            if ($this->options['p_lodgix_thesis_compatibility'] || $this->options['p_lodgix_thesis_2_compatibility'])
            {
                if (($this->options['p_lodgix_vr_title']) && ($this->options['p_lodgix_vr_title'] != ""))
                {
                  add_post_meta($this->options['p_lodgix_vacation_rentals_page_en'], 'thesis_title', $this->options['p_lodgix_vr_title'], true); 
                  update_post_meta($this->options['p_lodgix_vacation_rentals_page_en'], 'thesis_title', $this->options['p_lodgix_vr_title']);
                }
                else
                  delete_post_meta($this->options['p_lodgix_vacation_rentals_page_en'], 'thesis_title');
                
                if (($this->options['p_lodgix_vr_meta_description']) && ($this->options['p_lodgix_vr_meta_description'] != ""))
                {                       
                    add_post_meta($this->options['p_lodgix_vacation_rentals_page_en'], 'thesis_description', $this->options['p_lodgix_vr_meta_description'], true); 
                    update_post_meta($this->options['p_lodgix_vacation_rentals_page_en'], 'thesis_description', $this->options['p_lodgix_vr_meta_description']);
                }
                else
                    delete_post_meta($this->options['p_lodgix_vacation_rentals_page_en'], 'thesis_description');
                
                if (($this->options['p_lodgix_vr_meta_keywords']) && ($this->options['p_lodgix_vr_meta_keywords'] != ""))
                {                        
                    add_post_meta($this->options['p_lodgix_vacation_rentals_page_en'], 'thesis_keywords', $this->options['p_lodgix_vr_meta_keywords'], true); 
                    update_post_meta($this->options['p_lodgix_vacation_rentals_page_en'], 'thesis_keywords', $this->options['p_lodgix_vr_meta_keywords']);
                }
                else
                    delete_post_meta($this->options['p_lodgix_vacation_rentals_page_en'], 'thesis_keywords');                        
                
            }
            
            $languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
            if ($languages)
            {
                foreach ($languages as $l) {                  
            
                    $post = array();
                    $post['menu_order'] = 2;
                    $post['post_title'] =  $this->page_titles[$l->code]['availability'];
                    $post['post_content'] = '[lodgix_availability]';  
                    $post['post_status'] = 'publish';
                    $post['post_type'] = "page";                                  
                      
                    $exists = get_post($this->options['p_lodgix_availability_page_' . $l->code]);
                    if (!$exists)
                    {
                        $post_id = wp_insert_post( $post );               
                        if ($post_de_id != 0)
                        {
                            $this->options['p_lodgix_availability_page_' . $l->code] = (int)$post_id;
                            if ($l->code != 'en') {
                                $sql = "INSERT INTO " . $this->lang_pages_table . "(page_id,property_id,source_page_id,language_code) VALUES(" . $post_id . ",-2,NULL,'" . $l->code . "')";
                                $wpdb->query($sql);
                            }                           
                        }           
                    }
                    else 
                    {
                        $post = array();
                        $post['post_title'] =  $this->page_titles[$l->code]['availability'];
                        $post['post_name'] = '';
                        $post['post_content'] = '[lodgix_availability]'; 
                        $post['ID'] = $this->options['p_lodgix_availability_page_' . $l->code];
                        $post_id = wp_update_post($post);        
                        $posts_table = $wpdb->prefix . "posts";
                        $sql = "UPDATE " . $posts_table . " SET post_content='[lodgix_availability]' WHERE id=" . $post_id;
                        $wpdb->query($sql);  
                    }                    
                }
            }
            
            $languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
            if ($languages)
            {
                foreach ($languages as $l) {
                    
                    $post = array();
                    $post['post_title'] =  $this->page_titles[$l->code]['search'];
                    $post['post_content'] = '[lodgix_search_rentals]';  
                    $post['post_status'] = 'publish';
                    $post['post_type'] = "page";                    
              
                    $exists = get_post($this->options['p_lodgix_search_rentals_page_' . $l->code]);
                    if (!$exists)
                    {                               
                        $post_de_id = wp_insert_post( $post,true );               
            
                        if ($post_de_id != 0)
                        {
                            $this->options['p_lodgix_search_rentals_page_' . $l->code] = (int)$post_de_id;
                            if ($l->code != 'en')
                            {
                                $sql = "INSERT INTO " . $this->lang_pages_table . "(page_id,property_id,source_page_id,language_code) VALUES(" . $post_de_id . ",-3,NULL,'" . $l->code . "')";
                                $wpdb->query($sql);
                            }
                        }                                                             
                    }
                    else 
                    {
                        $post = array();
                        $post['post_title'] =  $this->page_titles[$l->code]['search'];
                        $post['post_name'] = '';
                        $post['post_content'] = '[lodgix_search_rentals]'; 
                        $post['ID'] = $this->options['p_lodgix_search_rentals_page_' . $l->code];
                        $post_id = wp_update_post($post);        
                        $posts_table = $wpdb->prefix . "posts";
                        $sql = "UPDATE " . $posts_table . " SET post_content='[lodgix_search_rentals]' WHERE id=" . $post_id;
                        $wpdb->query($sql);  
                    }                         
                }
            }
            
      
                                                     
            $this->saveAdminOptions();       									
            $owner_fetch_url = 'http://www.lodgix.com/api/xml/owners/get?Token=' . $this->options['p_lodgix_api_key']  . '&IncludeLanguages=Yes&IncludeRotators=Yes&IncludeAmenities=Yes&OwnerID=' . $this->options['p_lodgix_owner_id'];                  
            $fetch_url = 'http://www.lodgix.com/api/xml/properties/get?Token=' . $this->options['p_lodgix_api_key']  . '&IncludeAmenities=Yes&IncludePhotos=Yes&IncludeConditions=Yes&IncludeRates=Yes&IncludeLanguages=Yes&IncludeTaxes=Yes&IncludeReviews=Yes&IncludeMergedRates=Yes&OwnerID=' . $this->options['p_lodgix_owner_id'];    

            $r = new LogidxHTTPRequest($owner_fetch_url);
            $xml = $r->DownloadToString(); 
              
            
            $ROOT_HEIGHT = 84;
            $root = new DOMDocument();  
            $root->loadXML($xml);
            $owner = $this->domToArray($root);

            if ($owner['Errors'])
            {
                echo '<div class="updated"><p>Error: ' . $owner['Errors']['Error']['Message'] . '</p></div>';
            }
            else
            {  
                
                $this->update_owner($owner);                  
                $this->saveAdminOptions();  

                $ownerAmenities = @$owner['Results']['Amenities']['Amenity'];
                $searchableAmenities = array();
                if (!empty($ownerAmenities)) {
                    foreach ($ownerAmenities as $ownerAmenity) {
                        $searchableAmenities[$ownerAmenity['Name']] = 1;
                    }
                }
                                 
                           
                $r = new LogidxHTTPRequest($fetch_url);
                $xml = $r->DownloadToString();                     
                if ($xml)
                {
                    $root = new DOMDocument();  
                    $root->loadXML($xml);
                    $properties_array = $this->domToArray($root);
                    $properties = $properties_array["Results"]["Properties"];
                    if ($properties_array['Results']['Properties']['Property'][0])
                        $properties = $properties_array['Results']['Properties']['Property'];   
                    $active_properties = array(-1,-2,-3); 
                    $counter = 0;                  
                    $sql = "DELETE FROM " . $this->lang_amenities_table;
                    $wpdb->query($sql);
                    foreach ($properties as $property)
                    { 
                        if (($property['ServingStatus'] == "ACTIVE" ) && ($property['WordpressStatus'] == "ACTIVE" ))
                          $active_properties[] = $property['ID'];
                        $this->update_tables($property, $counter, $searchableAmenities);
                        $counter++;
                    }
                    $active_properties = join(",", $active_properties);
                    $this->clean_properties($active_properties);        
                    $this->build_individual_pages();
                    $this->build_areas_pages();
                    $this->set_page_options(); 
              
                }

            if (!$cleaned)  
            {
                $posts = $wpdb->get_results('SELECT * FROM ' . $this->pages_table);   
                foreach($posts as $post)
                {
                    $show = true;
                    if ($_POST['p_lodgix_page_' . $post->property_id] == 'on')
                      $sql = "UPDATE " . $this->pages_table . " SET enabled=1 WHERE id=" . $post->id;
                    else
                    {
                      $show = false;
                      $sql = "UPDATE " . $this->pages_table . " SET enabled=0 WHERE id=" . $post->id;
                    }
                    $wpdb->query($sql);
                    if ($_POST['p_lodgix_featured_' . $post->property_id] == 'on')
                      $sql = "UPDATE " . $this->pages_table . " SET featured=1 WHERE id=" . $post->id;
                    else
                    {
                      $sql = "UPDATE " . $this->pages_table . " SET featured=0 WHERE id=" . $post->id;
                    }
                    $wpdb->query($sql);             
                }   
            }             
            $this->clear_revisions();
            echo '<div class="updated"><p>Success! Your changes were sucessfully saved!</p></div>';
        }
    }
    else if ($_POST['p_lodgix_clean'])          
    {
        $this->p_lodgix_clean();
        echo '<div class="updated"><p>Success! Database sucessfully cleaned!</p></div>';
    }
      
    $thesis_2_template_options = Array();
    array_push($thesis_2_template_options,Array('class' => '','title' => 'Default'));
        
    try {
        $thesis_skin = get_option('thesis_skin');
        if ($thesis_skin) {
            $class = $thesis_skin['class'];
            $thesis_classic_r_templates = get_option('thesis_classic_r_templates');          
        }          
        
        if ($this->is_iterable($thesis_classic_r_templates)) {
            foreach ($thesis_classic_r_templates as $key => $value) {
                $title = ucwords($key);
                    if (0 === strpos($key, 'custom_')) {
                        $title = $value['title'];
                    }
                    array_push($thesis_2_template_options,Array('class' => $key,'title' => $title));
            }                     
        }
    }
    catch (SomeException $e)
    {
            
    } 			
          

?>                                   
<link href="<?php echo plugins_url('css/admin.css', __FILE__); ?>" rel="stylesheet" type="text/css">
<div class="wrap">
	<h2>Lodgix Settings</h2>
	<p style="width:900px;">
Please read through our <a target="_blank" href="http://docs.lodgix.com/spaces/vacation-rental/manuals/wordpress-vacation-rental">comprehensive manual</a> if you encounter issues with the plugin.
The manual is comprehensive and includes tutorials on proper setup techniques (including screenshot) as well as documentation on getting the plugin to work with various WordPress themes.  
Please visit our <a target="_blank" href="http://support.lodgix.com">support site</a> to submit a support ticket if the manual does not help to resolve your issues.
	</p>

	<div class="ldgxAdminMain">
		<form method="post" id="p_lodgix_options">
			<?php wp_nonce_field('p_lodgix-update-options'); ?>

			<p><b><?php _e('Lodgix Subscriber Settings', $this->localizationDomain); ?></b></p>

			<table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
				<tr valign="top"> 
					<th width="33%" scope="row">
						<?php _e('Customer ID:', $this->localizationDomain); ?>
					</th> 
					<td>
						<input name="p_lodgix_owner_id" type="text" id="p_lodgix_owner_id" size="45" value="<?php echo $this->options['p_lodgix_owner_id'] ;?>"/>
						<br><span class="setting-description"><?php _e('Please enter your Lodgix Customer ID', $this->localizationDomain); ?>
				  </td> 
				</tr>
				<tr valign="top"> 
					<th width="33%" scope="row">
						<?php _e('API Key:', $this->localizationDomain); ?>
					</th> 
					<td>
						<input name="p_lodgix_api_key" type="text" id="p_lodgix_api_key" size="45" value="<?php echo $this->options['p_lodgix_api_key'] ;?>"/>
						<br><span class="setting-description"><?php _e('Please enter your Lodgix API Key', $this->localizationDomain); ?>
				  </td> 
				</tr>   
				<tr valign="top"> 
					<td colspan="2">
To setup your properties for use with the plug-in, a Lodgix.com subscription is required. <a target="_blank" href="http://www.lodgix.com/register/0?wordpress=1">Sign-up for a free 30 day trial subscription at Lodgix.com</a>. 
No credit card is required. We do offer a a free starter subscription for plug-in users which is good for up to five properties, however it is restricted to payments via PayPal only and does not include use of automated trigger emails or any of the premium modules. This subscription is free and will not expire. Additionally, if you just wish to test the plug-in within your website using demo property images and data,  and do not wish to sign up for a Lodgix.com subscription at this time, click here to populate the Customer ID and API Key with demo credentials.<br><br>
If you are a current Lodgix.com subscriber, please login to your Lodgix.com account and go to "Settings >> Important Settings" to obtain your "Customer ID" and "API Key". In alternative click <a href="javascript:void(0)" onclick="p_lodgix_set_demo_credentials(); return false;">here</a> to setup Demo Credentials.
					</td> 
				</tr>                   
				</tr>     
				<tr valign="top"> 
					<td colspan="2">
					</td> 
				</tr>                                   
			</table>

			<p><b><?php _e('General Display Options', $this->localizationDomain); ?></b></p>

			<table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
				<tr valign="top"> 
					<th style="width:400px;" scope="row">
						<?php _e('Display daily rates on individual property pages?:', $this->localizationDomain); ?>
					</th> 
					<td>
						<input name="p_lodgix_display_daily_rates" type="checkbox" id="p_lodgix_display_daily_rates" <?php if ($this->options['p_lodgix_display_daily_rates']) echo "CHECKED"; ?>/>
					</td> 
				</tr>
				<tr valign="top"> 
					<th scope="row">
						<?php _e('Display Google Map, Contact Us & Details Icons on Search / Sort Page?:', $this->localizationDomain); ?>
					</th> 
					<td>
						<input name="p_lodgix_display_icons" type="checkbox" id="p_lodgix_display_icons" <?php if ($this->options['p_lodgix_display_icons']) echo "CHECKED"; ?>/>
					</td> 
				</tr>         
				<tr valign="top"> 
					<th scope="row">
						<?php _e('Display Availability Icon on Search / Sort Page?:', $this->localizationDomain); ?>
					</th> 
					<td>
						<input name="p_lodgix_display_availability_icon" type="checkbox" id="p_lodgix_display_availability_icon" <?php if ($this->options['p_lodgix_display_availability_icon']) echo "CHECKED"; ?>/>
				   </td> 
				</tr>         
				<tr valign="top">
					<th scope="row">
						<?php _e('Display Featured Widget horizontally ?:', $this->localizationDomain); ?>
					</th> 
					<td>                             
						<select name="p_lodgix_display_featured_horizontally"  id="p_lodgix_display_featured_horizontally" style="width:120px;">                              
							<option <?php if (($this->options['p_lodgix_display_featured_horizontally'] == 0) || (($this->options['p_lodgix_display_featured_horizontally'] != 1) && ($this->options['p_lodgix_display_featured_horizontally'] != 2))) echo "SELECTED"; ?> value='0'>No</option>
							<option <?php if ($this->options['p_lodgix_display_featured_horizontally'] == 1) echo "SELECTED"; ?> value='1'>Yes - Float Left</option>
							<option <?php if ($this->options['p_lodgix_display_featured_horizontally'] == 2) echo "SELECTED"; ?> value='2'>Yes - Float Right</option>
						</select>
					</td> 
				</tr>                                              
				<tr valign="top"> 
					<th scope="row">
						<?php _e('Property Name:', $this->localizationDomain); ?>
					</th> 
					<td>
						<select name="p_lodgix_display_title"  id="p_lodgix_display_title" style="width:120px;">                              
							<option <?php if ($this->options['p_lodgix_display_title'] == 'title') echo "SELECTED"; ?> value='title'>Marketing Title</option>
							<option <?php if ($this->options['p_lodgix_display_title'] == 'name') echo "SELECTED"; ?> value='name'>Name</option>
						</select>
					</td> 
				</tr>
				<tr valign="top"> 
					<th scope="row"><?php _e('Featured Rentals:', $this->localizationDomain); ?></th> 
					<td>
						<select name="p_lodgix_display_featured"  id="p_lodgix_display_featured" style="width:120px;">                              
							<option <?php if ($this->options['p_lodgix_display_featured'] == 'city') echo "SELECTED"; ?> value='city'>Display City</option>
							<option <?php if ($this->options['p_lodgix_display_featured'] == 'area') echo "SELECTED"; ?> value='area'>Display Area</option>
						</select>
					</td> 
				</tr> 
				<tr valign="top"> 
					<th scope="row">
						<?php _e('Display Instructions on Single Unit Calendar:', $this->localizationDomain); ?>
					</th> 
					<td>
						<select name="p_lodgix_display_single_instructions"  id="p_lodgix_display_single_instructions" style="width:120px;">                              
							<option <?php if ($this->options['p_lodgix_display_single_instructions'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
							<option <?php if ($this->options['p_lodgix_display_single_instructions'] == 0) echo "SELECTED"; ?> value='0'>No</option>
						</select>
					</td>
				</tr>
				<tr valign="top"> 
					<th scope="row">
						<?php _e('Display Instructions on Multi Unit Calendar:', $this->localizationDomain); ?>
					</th> 
					<td>
						<select name="p_lodgix_display_multi_instructions"  id="p_lodgix_display_multi_instructions" style="width:120px;">                              
							<option <?php if ($this->options['p_lodgix_display_multi_instructions'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
							<option  <?php if ($this->options['p_lodgix_display_multi_instructions'] == 0) echo "SELECTED"; ?> value='0'>No</option>
						</select>
					</td>             
				</tr>
				<tr valign="top"> 
					<th scope="row">
						<?php _e('Single Page Design:', $this->localizationDomain); ?>
					</th> 
					<td>
						<select name="p_lodgix_single_page_design"  id="p_lodgix_single_page_design" style="width:120px;">                              
							<option <?php if ($this->options['p_lodgix_single_page_design'] == 0) echo "SELECTED"; ?> value='0'>Regular</option>
							<option <?php if ($this->options['p_lodgix_single_page_design'] == 1) echo "SELECTED"; ?> value='1'>Tabbed</option>
						</select>
					</td>                                                                                                                           
				</tr>
				<tr valign="top"> 
					<th scope="row">
						<?php _e('Rates Display:', $this->localizationDomain); ?>
					</th> 
					<td>
						<select name="p_lodgix_rates_display"  id="p_lodgix_rates_display" style="width:120px;">                              
							<option <?php if ($this->options['p_lodgix_rates_display'] == 0) echo "SELECTED"; ?> value='0'>Regular</option>
							<option <?php if ($this->options['p_lodgix_rates_display'] == 1) echo "SELECTED"; ?> value='1'>Merged</option>
						</select>
					</td>                                                                                                                           
				</tr>                                
			</table><br>

			<p><b><?php _e('General Page Options', $this->localizationDomain); ?></b></p>

			<table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
				<tr valign="top"> 
					<th width="33%" scope="row">
						<?php _e('Allow Comments:', $this->localizationDomain); ?>
					</th>
					<td>
						<input name="p_lodgix_allow_comments" type="checkbox" id="p_lodgix_allow_comments" <?php if ($this->options['p_lodgix_allow_comments']) echo "CHECKED"; ?>/>
				  </td> 
				</tr>
				<tr valign="top"> 
					<th width="33%" scope="row">
						<?php _e('Allow PingBacks:', $this->localizationDomain); ?>
					</th>
					<td>
						<input name="p_lodgix_allow_pingback" type="checkbox" id="p_lodgix_allow_pingback" <?php if ($this->options['p_lodgix_allow_pingback']) echo "CHECKED"; ?>/>
				  </td> 
				</tr>
			</table><br>

			<p><b><?php _e('Menu Display Options', $this->localizationDomain); ?></b></p>

			<table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
				<tr valign="top"> 
					<th width="33%" scope="row">
						<?php _e('Vacation Rentals Menu Position:', $this->localizationDomain); ?>
					</th>
					<td>
						<select name="p_lodgix_vacation_rentals_page_pos"  id="p_lodgix_vacation_rentals_page_pos" style="width:120px;">                              
							<option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '-1') echo "SELECTED"; ?> value='-1'>None</option>
							<option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '1') echo "SELECTED"; ?> value='1'>1</option>
							<option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '2') echo "SELECTED"; ?> value='2'>2</option>
							<option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '3') echo "SELECTED"; ?> value='3'>3</option>
							<option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '4') echo "SELECTED"; ?> value='4'>4</option>
							<option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '5') echo "SELECTED"; ?> value='5'>5</option>
							<option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '6') echo "SELECTED"; ?> value='6'>6</option>
							<option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '7') echo "SELECTED"; ?> value='7'>7</option>
							<option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '8') echo "SELECTED"; ?> value='8'>8</option>
							<option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '9') echo "SELECTED"; ?> value='9'>9</option>
						</select>
					</td>
				</tr>   
				<tr valign="top"> 
					<th width="33%" scope="row">
						<?php _e('Availability Page Menu Position:', $this->localizationDomain); ?>
					</th> 
					<td>
						<select name="p_lodgix_availability_page_pos"  id="p_lodgix_availability_page_pos" style="width:120px;">                              
							<option <?php if ($this->options['p_lodgix_availability_page_pos'] == '-1') echo "SELECTED"; ?> value='-1'>None</option>
							<option <?php if ($this->options['p_lodgix_availability_page_pos'] == '1') echo "SELECTED"; ?> value='1'>1</option>
							<option <?php if ($this->options['p_lodgix_availability_page_pos'] == '2') echo "SELECTED"; ?> value='2'>2</option>
							<option <?php if ($this->options['p_lodgix_availability_page_pos'] == '3') echo "SELECTED"; ?> value='3'>3</option>
							<option <?php if ($this->options['p_lodgix_availability_page_pos'] == '4') echo "SELECTED"; ?> value='4'>4</option>
							<option <?php if ($this->options['p_lodgix_availability_page_pos'] == '5') echo "SELECTED"; ?> value='5'>5</option>
							<option <?php if ($this->options['p_lodgix_availability_page_pos'] == '6') echo "SELECTED"; ?> value='6'>6</option>
							<option <?php if ($this->options['p_lodgix_availability_page_pos'] == '7') echo "SELECTED"; ?> value='7'>7</option>
							<option <?php if ($this->options['p_lodgix_availability_page_pos'] == '8') echo "SELECTED"; ?> value='8'>8</option>
							<option <?php if ($this->options['p_lodgix_availability_page_pos'] == '9') echo "SELECTED"; ?> value='9'>9</option>
						</select>
					</td> 
				</tr>     
			</table><br>
            
			<p><b><?php _e('Language Options', $this->localizationDomain); ?></b></p>

			<table width="100%" cellspacing="2" cellpadding="5" class="form-table">
                    
                <tr>
                    <td colspan="2">To select other languages, please enable it within WPML setup first.</td>
                </tr>
                <?php
                    $wpml_lang_table = $wpdb->prefix . 'icl_languages';
                    $sql = "SELECT * FROM " . $this->languages_table . " WHERE code = 'en' OR code IN (SELECT code FROM " . $wpml_lang_table . " WHERE active = 1) order by case when code = 'en' then 0 else 1 end, name";
   
                    $languages = $wpdb->get_results($sql);
                    if (!$languages)
                    {
                        $languages = $wpdb->get_results("SELECT * FROM " . $this->languages_table . " WHERE code = 'en'");
                    }
                    if ($languages)
                    {
                        echo '<tr valign="top"><td colspan="2">';                                                        
                        echo '<ul style="list-style:none outside none;">';
                        foreach ($languages as $l) {
                            echo '<li style="width:190px; float:left;"><input name="p_lodgix_generate_' . $l->code .'" type="checkbox" id="p_lodgix_generate_' . $l->code .'"';
                            if ($l->enabled) echo "CHECKED";
                            if ($l->code == 'en') echo " disabled='disabled' onclick='return false'";
                            echo '/> ' . _($l->name, $this->localizationDomain);
                            echo '</li>';
                        }
                        echo '</ul></td></tr>';                        
                    }
                ?>                
			</table><br>            

			<p><b><?php _e('Contact Options', $this->localizationDomain); ?></b></p>

			<table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                <?php
                
                    $languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
                    if ($languages)
                    {
                        foreach ($languages as $l) {
                            ?>
                                <tr valign="top"> 
                                <th width="33%" scope="row">
                                <?php _e($l->name . ' Contact URL:', $this->localizationDomain); ?>
                                </th>
                                <td>
                                <input name="p_lodgix_contact_url_<?php echo $l->code; ?>" style="width:430px;" type="text" id="p_lodgix_contact_url_<?php echo $l->code; ?>" value="<?php echo $this->options['p_lodgix_contact_url_' . $l->code]; ?>" maxlength="255" />
                                </td>
                                </tr>
                            <?php
                        }
                        
                    }?>
			</table><br>                    

			<p><b><?php _e('Vacation Rentals Page Options', $this->localizationDomain); ?></b></p>

			<table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
				<tr valign="top"> 
					<th width="33%" scope="row"><?php _e('Page Title:', $this->localizationDomain); ?></th> 
					<td>
						<input name="p_lodgix_vr_title" style="width:430px;" type="text" id="p_lodgix_vr_title" value="<?php echo $this->options['p_lodgix_vr_title']; ?>" maxlength="70" />
					</td> 
				</tr>
				<tr valign="top"> 
					<th width="33%" scope="row"><?php _e('Meta Description:', $this->localizationDomain); ?></th> 
					<td>
						<textarea cols="55" name="p_lodgix_vr_meta_description" id="p_lodgix_vr_meta_description"><?php echo $this->options['p_lodgix_vr_meta_description']; ?></textarea>
					</td> 
				</tr>
				<tr valign="top"> 
					<th width="33%" scope="row"><?php _e('Meta Keywords:', $this->localizationDomain); ?></th> 
					<td>
						<textarea cols="55" name="p_lodgix_vr_meta_keywords" id="p_lodgix_vr_meta_keywords"><?php echo $this->options['p_lodgix_vr_meta_keywords']; ?></textarea>
					</td> 
				</tr>
				<tr valign="top">
					<th width="33%" scope="row">
						<?php _e('Full Size Thumbnails:', $this->localizationDomain); ?>
					</th>
					<td>
						<input name="p_lodgix_full_size_thumbnails" type="checkbox" id="p_lodgix_full_size_thumbnails" <?php if ($this->options['p_lodgix_full_size_thumbnails']) echo "CHECKED"; ?>/>
					</td>
				</tr>				
			</table><br>                    

			<p><b><?php _e('Theme Options', $this->localizationDomain); ?></b></p>

			<table width="100%" cellspacing="2" cellpadding="5" class="form-table">
				<tr valign="top">
					<th width="33%" scope="row">
						<?php _e('Thesis 1 Compatibility:', $this->localizationDomain); ?>
					</th>
					<td>
						<input name="p_lodgix_thesis_compatibility" type="checkbox" id="p_lodgix_thesis_compatibility" <?php if ($this->options['p_lodgix_thesis_compatibility']) echo "CHECKED";?> />
					</td>
				</tr>
				<tr valign="top">
					<th width="33%" scope="row">
						<?php _e('Thesis 2 Compatibility:', $this->localizationDomain); ?>
					</th>
					<td>
						<input name="p_lodgix_thesis_2_compatibility" type="checkbox" id="p_lodgix_thesis_2_compatibility" <?php if ($this->options['p_lodgix_thesis_2_compatibility']) echo "CHECKED"; ?> onchange="javascript:set_thesis_2_theme_enabled();"/>


						<select name="p_lodgix_thesis_2_template"  id="p_lodgix_thesis_2_template" style="width:120px;margin_left:10px;"  <?php if (!$this->options['p_lodgix_thesis_2_compatibility']) echo "DISABLED"; ?>>               
							<?php foreach($thesis_2_template_options as $to) { ?>              
							<option <?php if ($this->options['p_lodgix_thesis_2_template'] == $to['class']) echo "SELECTED"; ?> value='<?php echo $to['class'] ?>'><?php echo $to['title'] ?></option>
							<?php } ?>
				
						</select>
					</td>
				</tr>
				
				<tr valign="top">
					<th width="33%" scope="row">
						<?php _e('Custom Page Template:', $this->localizationDomain); ?>
					</th>
					<td>
						<input name="p_lodgix_custom_page_template" id="p_lodgix_custom_page_template" style="width:430px;" type="text" value="<?php echo $this->options['p_lodgix_custom_page_template']; ?>">
					</td>
				</tr>
			</table><br>


				 
			<p><b><?php _e('Property Display Settings', $this->localizationDomain); ?></b></p>

			<table width="100%" cellspacing="2" cellpadding="5" class="form-table">
				<tr valign="top">
					<th>Property</td>
					<td width="1%">Menu:</td>
					<td>Featured:</td>
				</tr>
				<?php
					$properties = $wpdb->get_results('SELECT ' . $this->properties_table . '.id,property_id,description,enabled,featured FROM ' . $this->properties_table . ' LEFT JOIN ' . $this->pages_table .  ' ON ' . $this->properties_table . '.id = ' . $this->pages_table .  '.property_id ORDER BY ' . $this->properties_table . '.`order`');      
					foreach($properties as $property) {                            
				?> 
					<tr valign="top">
						<th width="33%" scope="row">
							<?php _e($property->description, $this->localizationDomain); ?>
						</th>
						<td width="1%">
							<input name="p_lodgix_page_<?php echo $property->id ?>" type="checkbox" id="p_lodgix_page_<?php echo $property->id ?>" <?php if ($property->enabled) echo "CHECKED"; ?>/>
						</td>
						<td>
							<input name="p_lodgix_featured_<?php echo $property->id ?>" type="checkbox" id="p_lodgix_featured_<?php echo $property->id ?>" <?php if ($property->featured) echo "CHECKED"; ?>/>
						</td>
					</tr>
				<?php 
					} 
				?>
			</table><br>

			<p class="submit">
				<input type="submit" name="p_lodgix_save" class="button-primary" value="<?php _e('Save and Regenerate', $this->localizationDomain); ?>" />&nbsp;<input onclick="return confirm('Are you sure you want to clean the database ?');" type="submit" name="p_lodgix_clean" class="button-primary" value="<?php _e('Clean Database', $this->localizationDomain); ?>" /><br><br><br><br>
				<b>Please wait while database is updated. Time will depend on the number of properties to process.</b>
			</p>
		</form>
	</div>

	<div class="ldgxAdminRight">
		<div><a href="http://www.lodgix.com"><img src="<?php echo plugins_url('images/logo_250_63.png', __FILE__); ?>"></a></div>
		<div class="ldgxAdminBox">
			<h2>Like this Plugin?</h2>

			<a href="http://wordpress.org/plugins/lodgixcom-vacation-rental-listing-management-booking-plugin/" target="_blank"><button type="submit" class="ldgxAdminRateButton">Rate this plugin	&#9733;	&#9733;	&#9733;	&#9733;	&#9733;</button></a><br><br>

			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-href="<?php echo LODGIX_LIKE_URL; ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
			<br>

			<a href="https://twitter.com/share" class="twitter-share-button" data-text="Just been using #Lodgix #WordPress plugin" data-via="lodgix" data-related="lodgix">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			<br>

			<a href="http://bufferapp.com/add" class="buffer-add-button" data-text="Just been using #Lodgix #WordPress plugin" data-url="<?php echo LODGIX_LIKE_URL; ?>" data-count="horizontal" data-via="lodgix">Buffer</a><script type="text/javascript" src="http://static.bufferapp.com/js/button.js"></script>
			<br>


			<div class="g-plusone" data-size="medium" data-href="<?php echo LODGIX_LIKE_URL; ?>"></div>
			<script type="text/javascript">
			  (function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
			<br>

			<su:badge layout="2" location="<?php echo LODGIX_LIKE_URL; ?>"></su:badge>
			<script type="text/javascript">
			  (function() {
				var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
				li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
			  })();
			</script>			
      <script> 
      	   function set_thesis_2_theme_enabled() {
      	   		var is_checked = jQueryLodgix('#p_lodgix_thesis_2_compatibility').is(':checked');      	  	
      	   		if (is_checked) {
      	   			  jQueryLodgix('#p_lodgix_thesis_2_template').removeAttr('disabled');
      	   	  }
      	   	  else {
      	   	  		  jQueryLodgix('#p_lodgix_thesis_2_template').attr('disabled','disabled');
      	   	  }
      	   }
      	        
      		 jQuery('#p_lodgix_thesis_compatibility').click(function(){
      		 	 jQueryLodgix('#p_lodgix_thesis_2_compatibility').prop('checked', false);     
      		 	 set_thesis_2_theme_enabled(); 	  	
    			 });
      		 jQuery('#p_lodgix_thesis_2_compatibility').click(function(){
      		 	 jQueryLodgix('#p_lodgix_thesis_compatibility').prop('checked', false);      	  	
      		 	 set_thesis_2_theme_enabled();
    			 });
      	    
      </script>
		</div>
		<div class="ldgxAdminBox">
			<h2>About Lodgix.com</h2>
			<p>
				<img class="ldgxAdminAvatar" src="http://gravatar.com/avatar/b06319de949d4ce08bbafd6306a9f6f9?s=70">
				<a href="https://twitter.com/lodgix" class="twitter-follow-button" data-show-count="false">Follow @lodgix</a>
			</p>
			<p><a href="http://www.lodgix.com">Lodgix.com</a> is a leading provider of web-based vacation rental management software. We do not charge setup fees or require a contract of any kind. We do not collect a percentage of every reservation. We simply charge a flat monthly fee and seek to provide value to property owners and managers who seek an easy to use application to manage and grow their business.</p>
		</div>
	</div>

	<div class="clear"></div>
</div>
<?php
		}
	} //End Class
} //End if class exists statement



if (isset($_GET['p_lodgix_javascript'])) {
  //embed javascript
  Header("content-type: application/x-javascript");
  echo<<<ENDJS
/**
* @desc Lodgix
* @author Lodgix  - http://www.lodgix.com
*/

 function p_lodgix_set_demo_credentials()
  {
    jQueryLodgix('#p_lodgix_owner_id')[0].value = '13';
  	jQueryLodgix('#p_lodgix_api_key')[0].value = 'f89bd3b1bd098af107d727063c2736a6';
  }

jQueryLodgix(document).ready(function(){
  // add your jquery code here


  //validate plugin option form
    jQuery("#p_lodgix_options").validate({
    rules: {
        p_lodgix_owner_id: {
        required: true
      },
      p_lodgix_api_key: {
        required: true
      }
    },
    messages: {
      p_lodgix_owner_id: {
        // the p_lodgix_lang object is define using wp_localize_script() in function p_lodgix_script() 
        required: p_lodgix_lang.required,
        number: p_lodgix_lang.number,
        min: p_lodgix_lang.min
      },
      p_lodgix_api_key: {
        // the p_lodgix_lang object is define using wp_localize_script() in function p_lodgix_script() 
        required: p_lodgix_lang.required
      }
    }
  });
});

ENDJS;

} else {
    if (class_exists('p_lodgix')) { 
        $p_lodgix_var = new p_lodgix();
    }
}
?>