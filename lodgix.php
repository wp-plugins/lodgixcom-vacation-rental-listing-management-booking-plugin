<?php
/*

Plugin Name: Lodgix.com Vacation Rental Listing, Management & Booking Plugin
Plugin URI: http://www.lodgix.com/vacation-rental-wordpress-plugin.html
Description: Build a sophisticated vacation rental website in seconds using the Lodgix.com vacation rental software. Vacation rental CMS for WordPress.
Version: 1.0.51
Author: Lodgix 
Author URI: http://www.lodgix.com

*/
/*

Changelog:
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

global $p_lodgix_db_version;
$p_lodgix_db_version = "1.6";


if (!class_exists('LogidxHTTPRequest')) {
  class LogidxHTTPRequest
  {
      var $_fp;        // HTTP socket
      var $_url;        // full URL
      var $_host;        // HTTP host
      var $_protocol;    // protocol (HTTP/HTTPS)
      var $_uri;        // request URI
      var $_port;        // port
     
      // scan url
      function _scan_url()
      {
          $req = $this->_url;
         
          $pos = strpos($req, '://');
          $this->_protocol = strtolower(substr($req, 0, $pos));
         
          $req = substr($req, $pos+3);
          $pos = strpos($req, '/');
          if($pos === false)
              $pos = strlen($req);
          $host = substr($req, 0, $pos);
         
          if(strpos($host, ':') !== false)
          {
              list($this->_host, $this->_port) = explode(':', $host);
          }
          else
          {
              $this->_host = $host;
              $this->_port = ($this->_protocol == 'https') ? 443 : 80;
          }
         
          $this->_uri = substr($req, $pos);
          if($this->_uri == '')
              $this->_uri = '/';
      }
     
      // constructor
      function LogidxHTTPRequest($url)
      {
          $this->_url = $url;
          $this->_scan_url();
      }
     
      function RawResponse()
      {
          $crlf = "\r\n";
         
          // generate request
          $req = 'GET ' . $this->_uri . ' HTTP/1.0' . $crlf
              .    'Host: ' . $this->_host . $crlf
              .    $crlf;
              
          $response = NULL;
         
          // fetch
          $this->_fp = fsockopen(($this->_protocol == 'https' ? 'ssl://' : '') . $this->_host, $this->_port);
          fwrite($this->_fp, $req);
          while(is_resource($this->_fp) && $this->_fp && !feof($this->_fp))
              $response .= fread($this->_fp, 1024);
          fclose($this->_fp);
          
          return $response;
      }
      
      // download URL to string
      function DownloadToString()
      {
          $crlf = "\r\n";
         
          // generate request
          $req = 'GET ' . $this->_uri . ' HTTP/1.0' . $crlf
              .    'Host: ' . $this->_host . $crlf
              .    $crlf;
         
          // fetch
          $this->_fp = fsockopen(($this->_protocol == 'https' ? 'ssl://' : '') . $this->_host, $this->_port);
          stream_set_timeout($this->_fp, 360);
          fwrite($this->_fp, $req);          
          while(is_resource($this->_fp) && $this->_fp && !feof($this->_fp))
              $response .= fread($this->_fp, 1024);
          fclose($this->_fp);
         
          // split header and body
          $pos = strpos($response, $crlf . $crlf);
          if($pos === false)
              return($response);
          $header = substr($response, 0, $pos);
          $body = substr($response, $pos + 2 * strlen($crlf));
         
          // parse headers
          $headers = array();
          $lines = explode($crlf, $header);
          foreach($lines as $line)
              if(($pos = strpos($line, ':')) !== false)
                  $headers[strtolower(trim(substr($line, 0, $pos)))] = trim(substr($line, $pos+1));
         
          // redirection?
          if(isset($headers['location']))
          {
              $http = new LogidxHTTPRequest($headers['location']);
              return($http->DownloadToString($http));
          }
          else
          {
              return($body);
          }
      }
  } 
}

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
    function __construct(){
        //Language Setup
        $locale = get_locale();
      $mo = plugins_url("/languages/" . $this->localizationDomain . "-".$locale.".mo", __FILE__); 
        load_textdomain($this->localizationDomain, $mo);

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
      add_action('wp_ajax_p_lodgix_check', array(&$this,"p_lodgix_check"));
      add_action('wp_ajax_nopriv_p_lodgix_check', array(&$this,"p_lodgix_check"));      
      add_action('wp_ajax_p_lodgix_sort_vr', array(&$this,"p_lodgix_sort_vr"));
      add_action('wp_ajax_nopriv_p_lodgix_sort_vr', array(&$this,"p_lodgix_sort_vr"));
      add_action('wp_ajax_p_lodgix_custom_search', array(&$this,"p_lodgix_custom_search"));
      add_action('wp_ajax_nopriv_p_lodgix_custom_search', array(&$this,"p_lodgix_custom_search"));
      
      add_action('p_lodgix_download_images', array(&$this,"p_lodgix_download_images"));
      add_action("template_redirect", array(&$this,"p_lodgix_template_redirect"));
   
      register_activation_hook(__FILE__, array(&$this,'p_lodgix_activate'));
      register_deactivation_hook(__FILE__, array(&$this,'p_lodgix_deactivate'));
      add_filter( 'wp_list_pages_excludes', array(&$this,'p_lodgix_remove_pages_from_list'));

 
      // Featured widget
      add_action('widgets_init',  array(&$this,'widget_lodgix_featured_init'));
      add_action('widgets_init',  array(&$this,'widget_lodgix_custom_search_init'));
      
      // Menus
      add_filter('wp_get_nav_menu_items',array(&$this,'p_lodgix_nav_menus'),10,3);
      
      // Content
      add_filter('the_content', array(&$this,'p_lodgix_filter_content'));
    }
    
    function p_lodgix_download_images()
    {
      global $wpdb;
      set_time_limit(3600);
      
      $pictures_table = $wpdb->prefix . "lodgix_pictures";  
      $properties_table = $wpdb->prefix . "lodgix_properties";
      $pictures_path = WP_CONTENT_DIR.'/lodgix_pictures'; 
      $pictures_url = WP_CONTENT_URL.'/lodgix_pictures'; 
      $plugin_url = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); 
      $sql = "SELECT * FROM " . $pictures_table . " WHERE url LIKE 'http://www.lodgix.com/photo/0/gallery/%'";
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
          $wpdb->query("UPDATE " . $pictures_table . " SET thumb_url='" . $new_url . "' WHERE id=" . $pic->id);
          if ($pic->position == 1)
              $wpdb->query("UPDATE " . $properties_table . " SET main_image_thumb='" . $new_url . "' WHERE main_image_thumb='" . $pic->thumb_url . "'");
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
          $wpdb->query("UPDATE " . $pictures_table . " SET url='" . $new_url . "' WHERE id=" . $pic->id);
          if ($pic->position == 1)
            $wpdb->query("UPDATE " . $properties_table . " SET main_image='" . $new_url . "' WHERE main_image='" . $pic->url . "'");  
        }      
      }
      $this->build_individual_pages();
      $this->build_vacation_rentals_page();
      $this->build_areas_pages();
    }
    
    function p_lodgix_filter_content($content)
    { 
      if (strrpos($content,'[lodgix availability]') > 0)
        $content = str_replace('[lodgix availability]',$this->get_availability_page_content('en'),$content);
      if (strrpos($content,'[lodgix availability de]') > 0)
        $content = str_replace('[lodgix availability de]',$this->get_availability_page_content('de'),$content);        
      if (strrpos($content,'[lodgix search_rentals]') > 0)
        $content = str_replace('[lodgix search_rentals]',$this->get_search_rentals_page_content('en'),$content);        
      if (strrpos($content,'[lodgix search_rentals de]') > 0)
        $content = str_replace('[lodgix search_rentals de]',$this->get_search_rentals_page_content('de'),$content);        
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
        $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";
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
  
        if (!$_GET['lang'])
        {
          if ($pos1 != '-1')
          {
            $post = get_post($this->options['p_lodgix_vacation_rentals_page']);
            $item = wp_setup_nav_menu_item($post,'post_type');
            //$post->menu_item_parent = $term->db_id;
            $item->menu_order = $pos1;
            $items[] = $item;
          }
          if ($pos2 != '-1')
          {         
            $post = get_post($this->options['p_lodgix_availability_page']);
            $item = wp_setup_nav_menu_item($post);
            //$post->menu_item_parent = $term->db_id;
            $item->menu_order = $pos2;
            $items[] = $item;    
          } 
        }
        else if ($_GET['lang'] == 'de')
        {
          if ($pos1 != '-1')
          {
            $post_id_de = $wpdb->get_var("SELECT page_id FROM " . $lang_pages_table . " WHERE property_id=-1");
            $post = get_post($post_id_de);
            $item = wp_setup_nav_menu_item($post);
            $item->menu_order = $pos1;
            $items[] = $item;
          }
          if ($pos2 != '-1')
          {  
            $post_id_de = $wpdb->get_var("SELECT page_id FROM " . $lang_pages_table . " WHERE property_id=-2");
            $post = get_post($post_id_de);
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
      $pages_table = $wpdb->prefix . "lodgix_pages";    
      $posts = $wpdb->get_results('SELECT * FROM ' . $pages_table);   
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
      $sort = $_POST['sort'];
      $language = $_POST['lang'];
      $area = $_POST['area'];
      if ($language == "de")
        $content = $this->get_vacation_rentals_html_de($sort,$area);      
      else
        $content = $this->get_vacation_rentals_html($sort,$area);  
      die($content);
    }
    

    function p_lodgix_init() {

    }
        
    function p_is_lodgix_page($id)
    {
    	global $wpdb;
    	
    	switch ($id)
    	{
    		case $this->options['p_lodgix_vacation_rentals_page'] 		: return true;
    																														 		break;	

    		case $this->options['p_lodgix_vacation_rentals_page_de']  : return true;
    																														 		break;	

   		  case $this->options['p_lodgix_availability_page'] 				: return true;
    																														 		break;	

    		case $this->options['p_lodgix_availability_page_de'] 		  : return true;
    																														 		break;	    			

   		  case $this->options['p_lodgix_search_rentals_page'] 	 	  : return true;
    																														 		break;	

    		case $this->options['p_lodgix_search_rentals_page_de']	  : return true;
    																														 		break;	    			
    	  																											 		
    																														 		
    	}
    	
         
      $pages_table = $wpdb->prefix . "lodgix_pages";    	
    	$lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";
    	
    	$post_id = $wpdb->get_var("SELECT page_id FROM " . $pages_table . " WHERE page_id=" . $id);
    	if ($post_id == $id)
    	  return true;

    	$post_id = $wpdb->get_var("SELECT page_id FROM " . $lang_pages_table . " WHERE page_id=" . $id);    	    	
    	if ($post_id == $id)
    	  return true;

			$areas_pages = unserialize($this->options['p_lodgix_areas_pages']);
			$areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
			
			foreach($areas_pages as $key => $page)
			{
				if ($page->page_id == $id)
				  return true;
			}

			foreach($areas_pages_de as $key => $page)
			{
				if ($page->page_id == $id)
				  return true;
			}
    	
    	return false;
    }
      
    function p_lodgix_template_redirect()
    {
    	  global $wp_query;
        	$p_plugin_path = str_replace(home_url(),'',WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))); 
        	wp_enqueue_script('jquery');
        	wp_enqueue_script('thickbox');
        	wp_enqueue_style('thickbox');      
        	wp_enqueue_script('p_lodgix_pikachoose',$p_plugin_path . 'gallery/jquery.pikachoose.js');
        	wp_enqueue_script('p_lodgix_fancybox',$p_plugin_path . 'gallery/jquery.fancybox-1.3.4.pack.js');
        	wp_enqueue_script('p_lodgix_jquery_corner',$p_plugin_path . 'js/jquery.corner.js');          	  
        	wp_enqueue_script('p_lodgix_jquery_swf_object',$p_plugin_path . 'js/jquery.swfobject.js');            	    
        	wp_enqueue_script('p_lodgix_jquery_ceebox',$p_plugin_path . 'js/jquery.ceebox.js');          	  
    	  
    		if ($this->p_is_lodgix_page($wp_query->post->ID))
      	{	
        	
        	if ($this->options['p_lodgix_custom_page_template'] && $this->options['p_lodgix_custom_page_template'] != '')
        	{
        		 $template = WP_CONTENT_DIR . '/' . $this->options['p_lodgix_custom_page_template'];
        		 if (file_exists($template))
        		 {        		 	
 							include($template);              
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
            $p_plugin_path = str_replace(home_url(),'',WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))); 
            global $wpdb;
            
            $properties_table = $wpdb->prefix . "lodgix_properties";
            
            $post_id = $post->ID;
            echo "\n".'<!-- Start Lodgix -->'."\n";    
            if (!$this->options['p_lodgix_thesis_compatibility'])
            {
 
              if ($post_id == $this->options['p_lodgix_vacation_rentals_page'])
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
  					  	$properties = $wpdb->get_results('SELECT description,description_long,city,area FROM ' . $properties_table . ' WHERE post_id=' . $post_id);  
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
					  if (strpos(strtolower($p_plugin_path),'http') === false)
					  {
					  	 $p_plugin_path = home_url() . $p_plugin_path;
					  }
            echo '<link type="text/css" rel="stylesheet" href="' . $p_plugin_path  . 'css/directory.php" />' . "\n";            
            ?><script type="text/javascript">
                 function p_lodgix_sort_vr(val,filter)                 
                 {
                 	if (!filter)
                 		filter = '';
                   jQuery.ajax({
                      type: "POST",
                      url: "<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",
                      data: "action=p_lodgix_sort_vr&sort=" + jQuery('#lodgix_sort').val() + "&lang=" + val + "&area=" + filter,
                      success: function(response){
                        jQuery('#content_lodgix').html(response);
                      }
                   });
                 }
              </script>
              <script language="javascript">
									<!--
										jQuery(document).ready(
											function (){
												var a = function(self){
												self.anchor.fancybox();
											};
											jQuery("#pikame").PikaChoose({buildFinished:a,autoPlay:false,showTooltips:false,speed:5000});
											jQuery('#lodgix_property_badge').corner("round 8px");
											if (location.hash != '')
												location.hash = location.hash;
												
											jQuery(".ceebox").ceebox({videoGallery:'false'});
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
			$table_name = $wpdb->prefix . "lodgix_properties";
			if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      	$this->p_lodgix_build();
      }     
	  }
	  
    function p_lodgix_build() {
      global $wpdb;
      global $p_lodgix_db_version;
      
      $table_name = $wpdb->prefix . "lodgix_properties";
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
       );";
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
             PRIMARY KEY  (`id`)
       );";
       $wpdb->query($sql);
      }                 
      $table_name = $wpdb->prefix . "lodgix_amenities";
      if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
          
       $sql = "CREATE TABLE " . $table_name . " (
        `id` int(10) NOT NULL auto_increment,
        `property_id` int(11) NOT NULL,
        `description` varchar(255) NOT NULL,
        PRIMARY KEY  (`id`)
       );";      
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
       );";      
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
       );";      
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
       );";      
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
       );";      
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
       );";      
       $wpdb->query($sql);             
      } 

      $table_name = $wpdb->prefix . "lodgix_lang_amenities";
      if($wpdb->get_var("show tables like '$table_name'") != $table_name) {          
       $sql = "CREATE TABLE " . $table_name . " (
        `description` varchar(255) NOT NULL DEFAULT '',
        `description_de` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`description`)
       );";      
       $wpdb->query($sql);             
      }        
      
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Access to beach', 'Zugang zum Strand')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Balcony', 'Balkon')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Beachfront', 'Direkt am Strand')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Bed Linens', 'Bettw�sche')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Bike Rentals', 'Fahrrad Verleih')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Biking', 'Radfahren')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Cable Television', 'Kabelfernsehen')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Catering', 'Versorgung mit Lebensmitteln')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Central A/C', 'Zentrale Klimaanlage')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Central Heat', 'Zentralheizung')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Charcoal Grill', 'Holzkohlengrill')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Chef', 'Koch')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Coffee Maker', 'Kaffeemaschine')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Cookware', 'Kochutensilien')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Dishwasher', 'Geschirrsp�lmaschine')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Dock', 'Bootsanlegestelle')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Downhill Skiing', 'Abfahrts-Skilaufen')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('DVD', 'DVD-Spieler')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Fax', 'Faxger�t')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Fire Pit', 'offene Feuerstelle')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Fireplace', 'offener Kamin')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Fishing', 'Fischen und Angeln')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Gas Grill', 'Gasgrill')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Golfing', 'Golfspielen')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Hair Dryer', 'Haarf�n')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Handicap Accessible', 'Behindertengerecht')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('HDTV/Blu-ray', 'HDTV/Blu-ray')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Hi Speed Internet', 'Hi Speed Internet')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Hiking', 'Wandern')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Iron', 'B�geleisen')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Jacuzzi', 'Whirlpool')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Kayak', 'Kayak')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Kitchen', 'K�che')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Lakefront', 'See Lage')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Microwave', 'Mikrowelle')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Mountain Views', 'Bergpanorama')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Oceanfront', 'Blick aufs Meer')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Oven', 'Ofen')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Parking', 'Parkm�glichkeit')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Pedal Boat', 'Tretboot')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Phone', 'Telefon')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Picnic Table', 'Picknick Tisch')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Playground', 'Spielplatz')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Pontoon Boat', 'Pontoon Boot')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Pool', 'Swimming Pool')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Premium Cable Channels', 'Premium Kabel Kan�le')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Restaurant', 'Restaurant')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Riverfront', 'Lage am Fluss')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Row Boat', 'Ruderboot')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Safe', 'Tresor')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Satellite Television', 'Satelliten Fernsehen')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Scrapbooking Tables', 'Basteltisch')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Shopping', 'Einkaufsm�glichkeiten')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Shower', 'Dusche')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Snowmobile Rentals', 'Schneemobil Vermietung')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Spa', 'Spa')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Swimming', 'Schwimmen')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Tennis', 'Tennis')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Towels', 'Bade- und Handt�cher')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('VCR', 'Videorekorder')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Volleyball', 'Volleyball')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Washer and Dryer', 'Waschmaschine und Trockner')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Window A/C', 'Fenster Klimaanlage')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Wireless Internet', 'Wireless Internet')");
      $wpdb->query("INSERT INTO `wp_lodgix_lang_amenities` VALUES ('Workout Facilities', 'Sportstudio')");
      
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
       );";      
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
       );";      
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
       );";      
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
       );";      
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
       );";      
       $wpdb->query($sql);             
      }                                            
           
      
      add_option("p_lodgix_db_version", $p_lodgix_db_version); 
      if ($this->options['p_lodgix_create_availability'] == NULL)
          $this->options['p_lodgix_create_availability'] = true;
      $this->options['p_lodgix_page'] = array();
      $this->saveAdminOptions();
      
      
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
      
      //$this->p_lodgix_build();
    }

    function p_lodgix_script() {
      if (is_admin()){ 
        wp_enqueue_script('jquery'); 
        wp_enqueue_script('jquery-validate', 'http://ajax.microsoft.com/ajax/jquery.validate/1.6/jquery.validate.min.js', array('jquery'));
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
                                  'p_lodgix_vacation_rentals_page' => NULL,
                                  'p_lodgix_vacation_rentals_page' => NULL,
                                  'p_lodgix_vacation_rentals_page_de' => NULL,
                                  'p_lodgix_availability_page' => NULL,
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
                                  'p_lodgix_vacation_rentals_page_pos' => '3',
                                  'p_lodgix_availability_page_pos' => '4',                                  
                                  'p_lodgix_thesis_compatibility' => false,
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
                                  'p_lodgix_vr_title_de' => 'Ferienvillen &Uuml;bersicht',
                                  'p_lodgix_vr_meta_description' => NULL,
                                  'p_lodgix_vr_meta_description_de' => NULL,
                                  'p_lodgix_vr_meta_keywords' => NULL,
                                  'p_lodgix_vr_meta_keywords_de' => NULL,
                                  'p_lodgix_custom_page_template' => '',
                              		'p_lodgix_areas_pages' => serialize(array()),
                              		'p_lodgix_areas_pages_de' => serialize(array())                                                                     
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
                              'p_lodgix_vacation_rentals_page' => NULL,
                              'p_lodgix_vacation_rentals_page_de' => NULL,
                              'p_lodgix_availability_page' => NULL,
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
                              'p_lodgix_vacation_rentals_page_pos' => '3',                                                             
                              'p_lodgix_availability_page_pos' => '4',
                              'p_lodgix_thesis_compatibility' => false,
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
                              'p_lodgix_vr_title_de' => 'Ferienvillen &Uuml;bersicht',
                              'p_lodgix_vr_meta_description' => NULL,
                              'p_lodgix_vr_meta_description_de' => NULL,
                              'p_lodgix_vr_meta_keywords' => NULL,
                              'p_lodgix_vr_meta_keywords_de' => NULL,
                              'p_lodgix_custom_page_template' => '',
                              'p_lodgix_areas_pages' => serialize(array()),
                              'p_lodgix_areas_pages_de' => serialize(array())                                                              
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
         $settings_link = '<a href="options-general.php?page=' . basename(__FILE__) . '">' . __('Settings') . '</a>';
         array_unshift( $links, $settings_link ); // before other links

         return $links;
      }

      function clear_tables()
      {
        global $wpdb;
        
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $amenities_table = $wpdb->prefix . "lodgix_amenities";
        $rates_table = $wpdb->prefix . "lodgix_rates";      
        $rules_table = $wpdb->prefix . "lodgix_rules";           
        $pictures_table = $wpdb->prefix . "lodgix_pictures";    
        $pages_table = $wpdb->prefix . "lodgix_pages";
        $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";
        $properties_lang_table = $wpdb->prefix . "lodgix_lang_properties";
        $policies_table = $wpdb->prefix . "lodgix_policies";   
        $taxes_table = $wpdb->prefix . "lodgix_taxes";   
        $fees_table = $wpdb->prefix . "lodgix_fees";   
        $deposits_table = $wpdb->prefix . "lodgix_deposits";   
        $reviews_table = $wpdb->prefix . "lodgix_reviews";   
        
        $sql = "DELETE FROM " . $properties_table;
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $amenities_table;
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $rates_table;
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $rules_table;
        $wpdb->query($sql);          
        $sql = "DELETE FROM " . $pictures_table;
        $wpdb->query($sql);      
        $sql = "DELETE FROM " . $pages_table;
        $wpdb->query($sql); 
        $sql = "DELETE FROM " . $lang_pages_table;
        $wpdb->query($sql);         
        $sql = "DELETE FROM " . $properties_lang_table;
        $wpdb->query($sql);        
        $sql = "DELETE FROM " . $policies_table;
        $wpdb->query($sql);                     
        $sql = "DELETE FROM " . $taxes_table;
        $wpdb->query($sql);         
        $sql = "DELETE FROM " . $fees_table;
        $wpdb->query($sql);        
        $sql = "DELETE FROM " . $deposits_table;
        $wpdb->query($sql);    
        $sql = "DELETE FROM " . $reviews_table;
        $wpdb->query($sql);                    
      }

      function update_tables($property,$pos) {
        global $wpdb;
          
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $amenities_table = $wpdb->prefix . "lodgix_amenities";
        $rates_table = $wpdb->prefix . "lodgix_rates";      
        $rules_table = $wpdb->prefix . "lodgix_rules";           
        $pictures_table = $wpdb->prefix . "lodgix_pictures";    
        $lang_properties_table = $wpdb->prefix . "lodgix_lang_properties";   
        $taxes_table = $wpdb->prefix . "lodgix_taxes";   
        $fees_table = $wpdb->prefix . "lodgix_fees";   
        $deposits_table = $wpdb->prefix . "lodgix_deposits";
        $reviews_table = $wpdb->prefix . "lodgix_reviews";                   
        $sql = "DELETE FROM " . $amenities_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $rates_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $rules_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);          
        $sql = "DELETE FROM " . $pictures_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $lang_properties_table . " WHERE id=" . $property['ID'];
        $wpdb->query($sql);       
        $sql = "DELETE FROM " . $taxes_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);         
        $sql = "DELETE FROM " . $fees_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);        
        $sql = "DELETE FROM " . $deposits_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);   
        $sql = "DELETE FROM " . $reviews_table . " WHERE property_id=" . $property['ID'];
        $wpdb->query($sql);                          
        
        if ($property['ServingStatus'] != "ACTIVE")
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
        foreach ($conditions as $condition)
        {
          $name = strtolower($condition['Name']);
          if ($condition['Value'] == 'Allowed')
          {
            $parray[$name] = 1;
          }
        }
        $parray['serving_status'] = 1;
        $parray['display_calendar'] = 1;
        $parray['allow_booking'] = 1;             
        if ($property['ServingStatus'] == 'PAUSED')
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
          $sql = $this->get_insert_sql_from_array($pictures_table,$pharray);   
          $wpdb->query($sql);                    
        }

        $sql = $this->get_insert_sql_from_array($properties_table,$parray);
        $exists = (int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(id) FROM " . $properties_table . " WHERE id=" . $parray['id'] . ";"));        
        if ($exists > 0)        
          $sql = $this->get_update_sql_from_array($properties_table,$parray,$parray['id']);      
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
              $sql = $this->get_insert_sql_from_array($amenities_table,$amarray);
              $wpdb->query($sql);        
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
            $sql = $this->get_insert_sql_from_array($rules_table,$rulearray);
            $wpdb->query($sql);       
        }    
        
        $low_daily_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 1 AND property_id = " . $parray['id'] . ";"));        
        $low_weekly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 7 AND property_id = " . $parray['id'] . ";"));
        $low_monthly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 30 AND property_id = " . $parray['id'] . ";"));
        $sql = 'UPDATE ' . $properties_table .' SET min_daily_rate=' . $low_daily_rate . ',min_weekly_rate=' . $low_weekly_rate . ',min_monthly_rate=' . $low_monthly_rate . ' WHERE id=' . $parray['id'];
        $wpdb->query($sql);        
        

        $languages = $property['Languages'];
        if ($property['Languages']['Language'][0])
            $languages = $property['Languages']['Language'];      

        if (($this->options['p_lodgix_generate_german']) && ($languages))
        {

          foreach ($languages as $language)
          {    

            $langarray = array();
            $langarray['id'] = $parray['id'];
            $langarray['language_code'] = 'de'; 
            if ($this->options['p_lodgix_display_title'] == 'name')
              $langarray['description'] = $language['Name'];
            else
              $langarray['description'] = $language['MarketingTitle'];             
            $langarray['description_long'] = $language['MarketingTeaser']['_value']; 
            $langarray['details'] = $language['Description']['_value']; 
            $sql = $this->get_insert_sql_from_array($lang_properties_table,$langarray);
            $wpdb->query($sql);     
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
            $sql = $this->get_insert_sql_from_array($taxes_table,$taxarray);
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
            $sql = $this->get_insert_sql_from_array($fees_table,$feearray);
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
            $sql = $this->get_insert_sql_from_array($deposits_table,$depositarray);
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
            $sql = $this->get_insert_sql_from_array($reviews_table,$revarray);
            $wpdb->query($sql);        
          }     
        }             
        //$this->p_lodgix_download_images();
        wp_schedule_single_event(time()+5, 'p_lodgix_download_images');
      }

      function build_vacation_rentals_page()
      {
        global $wpdb;

        $post_id = (int)$this->options['p_lodgix_vacation_rentals_page'];

       
        if ($post_id > 0)
        {
           $wpost = array();
           $wpost['ID'] = $post_id;
           $content = '<div id="content_lodgix_wrapper">
                      <div id="lodgix_sort_div">
                       <b>Sort Results by:</b>&nbsp;<SELECT name="lodgix_sort" id="lodgix_sort" onchange="javascript:p_lodgix_sort_vr(\'en\');">
                          <OPTION VALUE="">None</OPTION>
                          <OPTION VALUE="bedrooms">Bedrooms</OPTION>
                          <OPTION VALUE="bathrooms">Bathrooms</OPTION>
                          <OPTION VALUE="proptype">Rental Type</OPTION>
                          <OPTION VALUE="pets">Pets Allowed</OPTION>
                          <OPTION VALUE="min_daily_rate">Daily Rate</OPTION>
                          <OPTION VALUE="min_weekly_rate">Weekly Rate</OPTION>
                          <OPTION VALUE="min_monthly_rate">Monthly Rate</OPTION>
                          <OPTION VALUE="area">Area</OPTION>
                       </SELECT><BR>
                       </div>
                       <div id="content_lodgix">';
           $content .= $this->get_vacation_rentals_html();
           $content .= '</div></div>';
           $wpost['post_content'] = $content;
           $post_id = wp_update_post($wpost);        
           $posts_table = $wpdb->prefix . "posts";
           $sql = "UPDATE " . $posts_table . " SET post_content='" . $wpdb->_real_escape($content) . "' WHERE id=" . $post_id;
           $wpdb->query($sql);    
           
       
        }
        $post_id = (int)$this->options['p_lodgix_vacation_rentals_page_de'];
        if ($post_id > 0)
        {
           $wpost = array();
           $wpost['ID'] = $post_id;
           $content = '<div id="content_lodgix_wrapper">
                      <div id="lodgix_sort_div">
                       <b>Sort Results by:</b>&nbsp;<SELECT name="lodgix_sort" id="lodgix_sort" onchange="javascript:p_lodgix_sort_vr(\'de\');">
                          <OPTION VALUE="">Keine</OPTION>
                          <OPTION VALUE="bedrooms">Schlafzimmer</OPTION>
                          <OPTION VALUE="bathrooms">Badezimmer</OPTION>
                          <OPTION VALUE="proptype">Mietart</OPTION>
                          <OPTION VALUE="pets">Haustiere erlaubt</OPTION>
                          <OPTION VALUE="min_daily_rate">Tageskurs</OPTION>
                          <OPTION VALUE="min_weekly_rate">Wochenpreis</OPTION>
                          <OPTION VALUE="min_monthly_rate">Monatspreis</OPTION>
                          <OPTION VALUE="area">Bereich</OPTION>
                       </SELECT><BR>
                       </div>
                       <div id="content_lodgix">';
           $content .= $this->get_vacation_rentals_html_de();
           $content .= '</div></div>';
           $wpost['post_content'] = $content;
           $post_id = wp_update_post($wpost);    
           $posts_table = $wpdb->prefix . "posts";           
           $sql = "UPDATE " . $posts_table . " SET post_content='" . $wpdb->_real_escape($content) . "' WHERE id=" . $post_id;
           $wpdb->query($sql);     
     
       
        }        
        if ($this->options['p_lodgix_generate_german'])
        {
            $this->link_translated_pages();
        }            
      }
      
      function build_search_vacation_rentals_page()
      {
        global $wpdb;

        $post_id = (int)$this->options['p_lodgix_vacation_rentals_page'];

       
        if ($post_id > 0)
        {
           $wpost = array();
           $wpost['ID'] = $post_id;
           $content = '<div id="content_lodgix_wrapper">
                      <div id="lodgix_sort_div">
                       <b>Sort Results by:</b>&nbsp;<SELECT name="lodgix_sort" id="lodgix_sort" onchange="javascript:p_lodgix_sort_vr(\'en\');">
                          <OPTION VALUE="">None</OPTION>
                          <OPTION VALUE="bedrooms">Bedrooms</OPTION>
                          <OPTION VALUE="bathrooms">Bathrooms</OPTION>
                          <OPTION VALUE="proptype">Rental Type</OPTION>
                          <OPTION VALUE="pets">Pets Allowed</OPTION>
                          <OPTION VALUE="min_daily_rate">Daily Rate</OPTION>
                          <OPTION VALUE="min_weekly_rate">Weekly Rate</OPTION>
                          <OPTION VALUE="min_monthly_rate">Monthly Rate</OPTION>
                          <OPTION VALUE="area">Area</OPTION>
                       </SELECT><BR>
                       </div>
                       <div id="content_lodgix">';
           $content .= '</div></div>';
           $wpost['post_content'] = $content;
           $post_id = wp_update_post($wpost);        
           $posts_table = $wpdb->prefix . "posts";
           $sql = "UPDATE " . $posts_table . " SET post_content='" . $wpdb->_real_escape($content) . "' WHERE id=" . $post_id;
           $wpdb->query($sql);    
           
       
        }
        $post_id = (int)$this->options['p_lodgix_vacation_rentals_page_de'];
        if ($post_id > 0)
        {
           $wpost = array();
           $wpost['ID'] = $post_id;
           $content = '<div id="content_lodgix_wrapper">
                      <div id="lodgix_sort_div">
                       <b>Sort Results by:</b>&nbsp;<SELECT name="lodgix_sort" id="lodgix_sort" onchange="javascript:p_lodgix_sort_vr(\'de\');">
                          <OPTION VALUE="">Keine</OPTION>
                          <OPTION VALUE="bedrooms">Schlafzimmer</OPTION>
                          <OPTION VALUE="bathrooms">Badezimmer</OPTION>
                          <OPTION VALUE="proptype">Mietart</OPTION>
                          <OPTION VALUE="pets">Haustiere erlaubt</OPTION>
                          <OPTION VALUE="min_daily_rate">Tageskurs</OPTION>
                          <OPTION VALUE="min_weekly_rate">Wochenpreis</OPTION>
                          <OPTION VALUE="min_monthly_rate">Monatspreis</OPTION>
                          <OPTION VALUE="area">Bereich</OPTION>
                       </SELECT><BR>
                       </div>
                       <div id="content_lodgix">';
           $content .= $this->get_vacation_rentals_html_de();
           $content .= '</div></div>';
           $wpost['post_content'] = $content;
           $post_id = wp_update_post($wpost);    
           $posts_table = $wpdb->prefix . "posts";           
           $sql = "UPDATE " . $posts_table . " SET post_content='" . $wpdb->_real_escape($content) . "' WHERE id=" . $post_id;
           $wpdb->query($sql);     
     
       
        }        
        if ($this->options['p_lodgix_generate_german'])
        {
            $this->link_translated_pages();
        }            
      }
      
      
			/*
        Builds areas page
      */
      function build_areas_pages()
      {
        global $sitepress,$wpdb;

				$properties_table = $wpdb->prefix . "lodgix_properties";
				$areas = $wpdb->get_results('SELECT DISTINCT area FROM ' . $properties_table);   
				$areas_pages = unserialize($this->options['p_lodgix_areas_pages']);
				$areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
				$counter=0;
				foreach($areas_pages as $key => $page)
				{
					if (!get_post($page->page_id))
					{
						unset($areas_pages[$key]);
					}
					$counter++;
				}

				$counter=0;
				foreach($areas_pages_de as $key => $page)
				{
					if (!get_post($page->page_id))
						unset($areas_pages_de[$key]);
					$counter++;
				}
								
				$this->options['p_lodgix_areas_pages'] = serialize($areas_pages);
				$this->options['p_lodgix_areas_pages_de'] = serialize($areas_pages_de);
				$this->saveAdminOptions();				
				$areas_pages = unserialize($this->options['p_lodgix_areas_pages']);
				$areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
				$counter = 0;
				if ((count($areas_pages) > 0) && (count($areas) > 0))
				{					
  				foreach($areas_pages as $key => $page)
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
  						wp_delete_post($areas_pages[$key]->page_id);
  						unset($areas_pages[$key]);
  					}
  					$counter++;	
  				}  				  				
  			}
  			
				if ((count($areas_pages_de) > 0) && (count($areas) > 0))
				{					
  				foreach($areas_pages_de as $key => $page)
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
  						wp_delete_post($areas_pages_de[$key]->page_id);
  						unset($areas_pages_de[$key]);
  					}
  					$counter++;	
  				}  				  				
  			}  			
  			
				$this->options['p_lodgix_areas_pages'] = serialize($areas_pages);
				$this->options['p_lodgix_areas_pages_de'] = serialize($areas_pages_de);
				$this->saveAdminOptions();				
				$areas_pages = unserialize($this->options['p_lodgix_areas_pages']);
				$areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
  
  		  if (count($areas) > 0)
				{				
  				foreach($areas as $area)
  				{
  					$found = false;
  					if (count($areas_pages) > 0)
  					{
      				foreach($areas_pages as $page)
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
      	    	$obj = (object) array('area' => $area->area, 'page_id' => NULL);      	    	      	    	
  						$areas_pages[] = $obj;	    	
      	    }
    			}	  									
			  }
			  
			  if ($this->options['p_lodgix_generate_german'])
			  {
  			  if (count($areas) > 0)
  				{				
    				foreach($areas as $area)
    				{
    					$found = false;
    					if (count($areas_pages_de) > 0)
    					{
        				foreach($areas_pages_de as $page)
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
        	    	$obj = (object) array('area' => $area->area, 'page_id' => NULL);      	    	      	    	
							  $areas_pages_de[] = $obj;    	    	
        	    }
      			}	  									
  			  }
  			 }
					 	
				$this->options['p_lodgix_areas_pages'] = serialize($areas_pages);
				$this->options['p_lodgix_areas_pages_de'] = serialize($areas_pages_de);
				$this->saveAdminOptions();				
				$areas_pages = unserialize($this->options['p_lodgix_areas_pages']);
				$areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);

			 	
			 	if(count($areas_pages) > 0) 
			 	{
			 	 $counter = 0;
			 	 foreach($areas_pages as $key => $page)	
			 	 {
          $post = array();
          $post['post_title'] = $page->area;
          $post['post_status'] = 'publish';
          $post['post_author'] = 1;
          $post['post_type'] = "page";			 	 	
			 	 	if ($page->page_id == NULL)
			 	 	{
			 	 	 $post_id = wp_insert_post( $post );               
           if ($post_id != 0)
           {
                  $areas_pages[$key]->page_id = (int)$post_id;
           }         	 	 		
			 	 	}
					$counter++;			 	 	
			 	 }
			 	}
				
				$this->options['p_lodgix_areas_pages'] = serialize($areas_pages);
				$this->options['p_lodgix_areas_pages_de'] = serialize($areas_pages_de);
				$this->saveAdminOptions();				
				$areas_pages = unserialize($this->options['p_lodgix_areas_pages']);
				$areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);

				
			 	if ($this->options['p_lodgix_generate_german'])
			 	{
  			 	if(count($areas_pages_de) > 0) 
  			 	{
  			 	 $counter = 0;
  			 	 foreach($areas_pages_de as $key => $page)	
  			 	 {
            $post = array();
            $post['post_title'] = $page->area;
            $post['post_status'] = 'publish';
            $post['post_author'] = 1;
            $post['post_type'] = "page";			 	 	
  			 	 	if ($page->page_id == NULL)
  			 	 	{
  			 	 	 $post_id = wp_insert_post( $post );               
             if ($post_id != 0)
             {
               $areas_pages_de[$key]->page_id = (int)$post_id;
             }         	 	 		
  			 	 	}
  					$counter++;			 	 	
  			 	 }
  			 	}			 
  			}	
				$this->options['p_lodgix_areas_pages'] = serialize($areas_pages);
				$this->options['p_lodgix_areas_pages_de'] = serialize($areas_pages_de);
				$this->saveAdminOptions();					
						
				$areas_pages = unserialize($this->options['p_lodgix_areas_pages']);
				foreach($areas_pages as $page)	
  			{
  				 if ($page->page_id)  		  				
  				 { 			  				
  				   $wpost = array();
             $wpost['ID'] = $page->page_id;
             $content = '<div id="content_lodgix_wrapper">
                        <div id="lodgix_sort_div">
                         <b>Sort Results by:</b>&nbsp;<SELECT name="lodgix_sort" id="lodgix_sort" onchange="javascript:p_lodgix_sort_vr(\'en\',\'' . $page->area .  '\');">
                            <OPTION VALUE="">None</OPTION>
                            <OPTION VALUE="bedrooms">Bedrooms</OPTION>
                            <OPTION VALUE="bathrooms">Bathrooms</OPTION>
                            <OPTION VALUE="proptype">Rental Type</OPTION>
                            <OPTION VALUE="pets">Pets Allowed</OPTION>
                            <OPTION VALUE="min_daily_rate">Daily Rate</OPTION>
                            <OPTION VALUE="min_weekly_rate">Weekly Rate</OPTION>
                            <OPTION VALUE="min_monthly_rate">Monthly Rate</OPTION>
                         </SELECT><BR>
                         </div>
                         <div id="content_lodgix">';
             $content .= $this->get_vacation_rentals_html('',$page->area);
             $content .= '</div></div>';
             $wpost['post_content'] = $content;
             $post_id = wp_update_post($wpost);        
             $posts_table = $wpdb->prefix . "posts";
             $sql = "UPDATE " . $posts_table . " SET post_content='" . $wpdb->_real_escape($content) . "' WHERE id=" . $post_id;
             $wpdb->query($sql);    
            }
        }
        
        $areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
        foreach($areas_pages_de as $page)	
  			{
  				 if ($page->page_id)  		  				
  				 { 				
             $wpost = array();
             $wpost['ID'] = $page->page_id;
             $content = '<div id="content_lodgix_wrapper">
                        <div id="lodgix_sort_div">
                         <b>Sort Results by:</b>&nbsp;<SELECT name="lodgix_sort" id="lodgix_sort" onchange="javascript:p_lodgix_sort_vr(\'de\',\'' . $page->area .  '\');">
                            <OPTION VALUE="">Keine</OPTION>
                            <OPTION VALUE="bedrooms">Schlafzimmer</OPTION>
                            <OPTION VALUE="bathrooms">Badezimmer</OPTION>
                            <OPTION VALUE="proptype">Mietart</OPTION>
                            <OPTION VALUE="pets">Haustiere erlaubt</OPTION>
                            <OPTION VALUE="min_daily_rate">Tageskurs</OPTION>
                            <OPTION VALUE="min_weekly_rate">Wochenpreis</OPTION>
                            <OPTION VALUE="min_monthly_rate">Monatspreis</OPTION>
                         </SELECT><BR>
                         </div>
                         <div id="content_lodgix">';
             $content .= $this->get_vacation_rentals_html_de('',$page->area);
             $content .= '</div></div>';
             $wpost['post_content'] = $content;
             $post_id = wp_update_post($wpost);    
             $posts_table = $wpdb->prefix . "posts";           
             $sql = "UPDATE " . $posts_table . " SET post_content='" . $wpdb->_real_escape($content) . "' WHERE id=" . $post_id;
             $wpdb->query($sql);   
            }
				}
				
				
				if ($this->options['p_lodgix_generate_german'])
        {
            $this->link_translated_pages();
        }      
        

      }
      
      /*
        Returns table for vacation rentals (regular/ajax)
      */
      function get_vacation_rentals_html($sort = '',$area = '',$bedrooms=NULL,$id='')
      {
        global $wpdb;
        
        $content = '';
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $rates_table = $wpdb->prefix . "lodgix_rates";        
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
        		$filter .= " area='" . $area . "' AND ";
        	if ($id != '')
        		$filter .= " UPPER(description) like '%" . strtoupper($id) . "%' AND ";
        	if ($bedrooms != NULL)
        		$filter .= " bedrooms = " . $bedrooms . " AND ";
        }
        
       	$sql = $wpdb->prepare('SELECT * FROM ' . $properties_table . '  WHERE ' . $filter . ' 1=1 ORDER BY ' . $wpdb->_real_escape($sort_sql) . ' ' . $direction );
        $properties = $wpdb->get_results($sql);      

        if ($properties)
        {
         foreach($properties as $property)
         {
          if ($this->options['p_lodgix_display_daily_rates'])
          {
            $low_daily_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";"));
            $high_daily_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";"));
          }
          else
          {
            $low_daily_rate = $property->currency_symbol . '0';
            $high_daily_rate = $property->currency_symbol . '0';
          }
          $low_weekly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";"));
          $high_weekly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";"));
          $low_monthly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";"));
          $high_monthly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";"));
          include('vacation_rentals.php');
          $content .= $vacation_rentals;          
         }
        }        
        $content .= '<br><div align="center" style="width:100%;font-size:10px;"><a href="http://www.lodgix.com">Vacation Rental Software</a> by Lodgix.com</div><br>';
        return $content;
      }      

      /*
        Returns table for vacation rentals (regular/ajax)
      */
      function get_vacation_rentals_html_de($sort = '',$area = '',$bedrooms=NULL,$id='')
      {
        global $wpdb;
                
        $content = '';
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $rates_table = $wpdb->prefix . "lodgix_rates";      
        $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";
        $lang_properties_table = $wpdb->prefix . "lodgix_lang_properties";
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
        		$filter .= " area='" . $area . "' AND ";
        	if ($id != '')
        		$filter .= " UPPER(description) like '%" . strtoupper($id) . "%' AND ";
        	if ($bedrooms != NULL)
        		$filter .= " bedrooms = " . $bedrooms . " AND ";
        }
        
       	$sql = $wpdb->prepare('SELECT * FROM ' . $properties_table . '  WHERE ' . $filter . ' 1=1 ORDER BY ' . $wpdb->_real_escape($sort_sql) . ' ' . $direction );
        	
        $properties = $wpdb->get_results($sql);      
         
        if ($properties)
        {
         foreach($properties as $property)
         {
          if ($this->options['p_lodgix_display_daily_rates'])
          {
            $low_daily_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";"));
            $high_daily_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";"));
          }
          else
          {
            $low_daily_rate = $property->currency_symbol . '0';
            $high_daily_rate = $property->currency_symbol . '0';
          }          $low_weekly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";"));
          $high_weekly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";"));
          $low_monthly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";"));
          $high_monthly_rate = $property->currency_symbol . (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";"));
          include('vacation_rentals_de.php');
          $content .= $vacation_rentals;
         }
        }        
				$content .= '<br><div align="center" style="width:100%;font-size:10px;"><a href="http://www.lodgix.com">Vacation Rental Software</a> by Lodgix.com</div><br>';
        return $content;
      }      

      /*
        Creates availability calendar page
      */
      function delete_availability_page()
      {
        $post_id = (int)$this->options['p_lodgix_availability_page'];
        wp_delete_post($post_id,$force=true);
        $this->options['p_lodgix_create_availability'] = NULL;
      }
      
      /*
        Creates availability calendar page
      */
      function build_availability_page()
      {
        global $wpdb;
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $post_id = (int)$this->options['p_lodgix_availability_page'];
        if ($post_id > 0)
        {
           $post = array();
           $post['ID'] = $post_id;
           $content = '
              <div id="content_lodgix">
           ';
           $properties = $wpdb->get_results('SELECT * FROM ' . $properties_table); 
                         
           if ($properties)
           {
            $number_properties = count($properties); 
            
            if ($number_properties >= 1)
            {
              $multi_unit_helptext = $wpdb->get_var("SELECT multi_unit_helptext FROM " . $policies_table . " WHERE language_code='" . $lang_code . "'");
              $allow_booking = $properties[0]->allow_booking;
              $owner_id = $properties[0]->owner_id;
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
         
         if ($this->options['p_lodgix_generate_german'])
         {
            $this->link_translated_pages();
         }          
      }
      
      /*
        Get search rentals page content
      */
      function get_search_rentals_page_content($lang_code)
      {
        global $wpdb;
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $policies_table = $wpdb->prefix . "lodgix_policies";
        $content = '
           <div id="content_lodgix">
        ';
      	
      	$sort = $_POST['sort'];
      	$language = $_POST['lang'];
      	$area = $_POST['lodgix-custom-search-area'];
      	$bedrooms = $_POST['lodgix-custom-search-bedrooms'];
      	$id = $_POST['lodgix-custom-search-id'];
      	             	      	
      	if ($lang_code == "de")
        	$content .= $this->get_vacation_rentals_html_de($sort,$area,$bedrooms,$id);      
      	else
        	$content .= $this->get_vacation_rentals_html($sort,$area,$bedrooms,$id);  
        
        
        $content .= '</div>';
  
        return $content;
      }      
      
      /*
        Get availability page content
      */
      function get_availability_page_content($lang_code)
      {
        global $wpdb;
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $policies_table = $wpdb->prefix . "lodgix_policies";
        $content = '
           <div id="content_lodgix">
        ';
        $properties = $wpdb->get_results('SELECT * FROM ' . $properties_table); 
                      
        if ($properties)
        {
         $number_properties = count($properties); 
         
         if ($number_properties >= 1)
         {
           $multi_unit_helptext = $wpdb->get_var("SELECT multi_unit_helptext FROM " . $policies_table . " WHERE language_code='" . $lang_code . "'");
           $allow_booking = $properties[0]->allow_booking;
           $owner_id = $properties[0]->owner_id;
           $property_id = $properties[0]->id;
           include('availability.php');
           $content .= $availability;
         } 
        }
        $content .= '</div>';
  
        return $content;
      }      
      
      
      
      function link_translated_pages()
      {
        global $sitepress,$wpdb;
        
        $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";
        $pages_table = $wpdb->prefix . "lodgix_pages";
        $translation_table =  $wpdb->prefix . "icl_translations";
        
        if ($this->options['p_lodgix_generate_german'])
        {
         $posts_de = $wpdb->get_results('SELECT * FROM ' . $lang_pages_table);   
         foreach($posts_de as $post)
         { 
            if ($post->property_id == -1)
            {
              $post_id = $this->options['p_lodgix_vacation_rentals_page'];
            }
            else if ($post->property_id == -2)
            {
              $post_id = $this->options['p_lodgix_availability_page'];    
            }       
            else if ($post->property_id == -3)
            {
              $post_id = $this->options['p_lodgix_search_rentals_page'];    
            }                                    
            else
            {              
             $post_id = (int)$wpdb->get_var($wpdb->prepare("SELECT page_id FROM " . $pages_table . " WHERE property_id=" . $post->property_id . ";"));
            }
            $trid = (int)$wpdb->get_var($wpdb->prepare("SELECT trid FROM " . $translation_table . " WHERE element_id=" . $post_id . " AND language_code='en';"));
            $sitepress->set_element_language_details($post->page_id,'post_page',$trid,'de','en');            
         }          
        }
				  $translation_table =  $wpdb->prefix . "icl_translations";			
				  $areas_pages = unserialize($this->options['p_lodgix_areas_pages']);					
				  $areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
  			 	foreach($areas_pages_de as $page_de)	
  			 	{
  			 		foreach($areas_pages as $page)	
  			 		{
  			 			if ($page_de->area == $page->area)
  			 			{  			 			
							 $trid = (int)$wpdb->get_var($wpdb->prepare("SELECT trid FROM " . $translation_table . " WHERE element_id=" . $page->page_id . " AND language_code='en';"));
        			 $sitepress->set_element_language_details($page_de->page_id,'post_page',$trid,'de','en');	
        			}
        		}
        		
        	}
        	
                
      }
      
      
      function build_individual_pages() {
        global $wpdb;
        global $sitepress;
        $p_plugin_path = str_replace(home_url(),'',WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))); 
        
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $amenities_table = $wpdb->prefix . "lodgix_amenities";
        $rates_table = $wpdb->prefix . "lodgix_rates";      
        $rules_table = $wpdb->prefix . "lodgix_rules";           
        $pictures_table = $wpdb->prefix . "lodgix_pictures";   
        $pages_table = $wpdb->prefix . "lodgix_pages";
        $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";
        $lang_properties_table = $wpdb->prefix . "lodgix_lang_properties";
        $lang_amenities_table = $wpdb->prefix . "lodgix_lang_amenities";
        $translation_table =  $wpdb->prefix . "icl_translations";
        $taxes_table = $wpdb->prefix . "lodgix_taxes";   
        $fees_table = $wpdb->prefix . "lodgix_fees";   
        $deposits_table = $wpdb->prefix . "lodgix_deposits";     
        $reviews_table = $wpdb->prefix . "lodgix_reviews";       
                
        
        $properties = $wpdb->get_results('SELECT * FROM ' . $properties_table . ' ORDER BY `order`'); 
        if ($properties)
        {
            foreach($properties as $property)
            {
              $exists = get_post($property->post_id);
              
              if (!$exists)
              {         
                  $post = array();
                  $post['post_title'] = $property->description;
                  $post['post_parent'] = (int)$this->options['p_lodgix_vacation_rentals_page'];
                  $post['post_status'] = 'pending';
                  $post['post_author'] = 1;
                  $post['post_type'] = "page";
                  if ($this->options['p_lodgix_vacation_rentals_page'] != NULL)
                  {
                      $post_id = wp_insert_post( $post );  
                      $sql = "UPDATE " . $properties_table . " SET post_id=" . $post_id . " WHERE id=" . $property->id;
                      $wpdb->query($sql);
                      $sql = "INSERT INTO " . $pages_table . "(page_id,property_id,parent_page_id) VALUES(" . $post_id . "," . $property->id."," . $post['post_parent'] . ")";
                      $wpdb->query($sql);

                  }     
              }   
              $post_id_de = $wpdb->get_var("SELECT page_id FROM " . $lang_pages_table . " WHERE property_id=" . $property->id);
              $exists = get_post($post_id_de);
              if (!$exists)
              {         
                  $post = array();
                  $post['post_title'] = $property->description;
                  $post['post_parent'] = (int)$this->options['p_lodgix_vacation_rentals_page_de'];
                  $post['post_status'] = 'pending';
                  $post['post_author'] = 1;
                  $post['post_type'] = "page";
                  
                  if ($this->options['p_lodgix_vacation_rentals_page_de'] != NULL)
                  {
                  	 
                      if ($this->options['p_lodgix_generate_german'])
                      {
                        $post_id = (int)$wpdb->get_var($wpdb->prepare("SELECT post_id FROM " . $properties_table . " WHERE id=" . $property->id . ";"));
                        $trid = (int)$wpdb->get_var($wpdb->prepare("SELECT trid FROM " . $translation_table . " WHERE element_id=" . $post_id . " AND language_code='en';"));
                        $post['post_parent'] = (int)$this->options['p_lodgix_vacation_rentals_page_de'];
                        $post_id_de = wp_insert_post( $post );   
                        $sql = "INSERT INTO " . $lang_pages_table . "(page_id,property_id,source_page_id,language_code) VALUES(" . $post_id_de . "," . $property->id."," . $post_id   . ",'de')";
                        
                        $wpdb->query($sql);                  
                        update_post_meta($post_id_de, '_icl_translation', 1);     
                     }
                  }     
              }                  
            }
         }
         
         
         $properties = $wpdb->get_results('SELECT * FROM ' . $properties_table . ' ORDER BY `order`'); 
         if ($properties)
         {
            foreach($properties as $property)
            {
              if ($property->post_id != NULL)
              {
                $amenities = $wpdb->get_results('SELECT * FROM ' . $amenities_table . " WHERE property_id=" . $property->id); 
                
                $post = array();
                $post['ID'] = $property->post_id;
                $post['post_title'] = $property->description;
                $single_property = '';
                include('single_property.php');
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
                			  			
                if ($this->options['p_lodgix_generate_german'])
                {
                	
                  $post_id_de = $wpdb->get_var("SELECT page_id FROM " . $lang_pages_table . " WHERE property_id=" . $property->id);
                  $post = array();
                  $post['ID'] = $post_id_de;
                  $post['post_title'] = $wpdb->get_var("SELECT description FROM " . $lang_properties_table . " WHERE property_id=" . $property->id);
                  if ($post['post_title'] == '')
                    $post['post_title'] = $property->description;
                  $single_property = '';
                  include('single_property_de.php');
                  $post['post_status'] = 'publish';       
                  $post['post_content'] = htmlspecialchars($single_property);  
                  $post_id_de = wp_update_post($post);                      
                  $sql = "UPDATE " . $translation_table . " SET trid=" . $trid . ", language_code='de' WHERE element_id=" . $post_id_de;
                  $wpdb->query($sql);           
                  $sql = "UPDATE " . $posts_table . " SET post_content='" . $wpdb->_real_escape($single_property) . "' WHERE id=" . $post_id_de;                  
                  $wpdb->query($sql);                                   
        
                }
              }
              
            }
         }
         
         
         if ($this->options['p_lodgix_generate_german'])
         {
           $this->link_translated_pages();
         }         
      }
      
      function remove_thesis_page($page_id)
      {
        if ($this->options['p_lodgix_thesis_compatibility'])
        {
          $thesis_options = get_option('thesis_options');
          unset($thesis_options->nav['pages'][$page_id]);
          update_option('thesis_options',$thesis_options); 
        }
      }
      
     function p_lodgix_custom_search()
     {
       global $wpdb;
       $properties_table = $wpdb->prefix . "lodgix_properties";
       $area = @mysql_real_escape_string($_POST['area']);
       $bedrooms = @mysql_real_escape_string($_POST['bedrooms']);
       $id = @mysql_real_escape_string($_POST['id']);
       $sql = "SELECT COUNT(*) as num_results FROM " . $properties_table . " WHERE 1=1 AND ";
       if (is_numeric($id))
       {
       	 	$sql .= "id=" . $id;
       }	      
       else
       {
       	if ($area != 'ALL_AREAS')
       	{
       	 	$sql .= "area = '" . $area. "' AND ";
       	}
       	
       	if ($id != '')
       	{       	
       		$sql .= "UPPER(description) like '%" . strtoupper($id) . "%' AND ";
       	}
       	
       	$sql .= "bedrooms = " . $bedrooms;
       } 
       $count = $wpdb->get_results($sql);
       if ($language == "de")
         $content = $count[0]->num_results . ' Properties Found.';
       else
         $content = $count[0]->num_results . ' Properties Found.';
       die($content);
      }      
      
      function widget_lodgix_custom_search_init() {
    
      // Check for the required plugin functions. This will prevent fatal
      // errors occurring when you deactivate the dynamic-sidebar plugin.
      if ( !function_exists('register_sidebar_widget') )
        return;
    
      // This is the function that outputs our widget_lodgix_custom_search.
      function widget_lodgix_custom_search($args) {
        global $wpdb;
        $p_plugin_path = plugin_dir_url(plugin_basename(__FILE__));
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $pages_table = $wpdb->prefix . "lodgix_pages";
        $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";


        extract($args);
    
        // Each widget can store its own options. We keep strings here.
        $options = get_option('widget_lodgix_custom_search');
        $loptions = get_option('p_lodgix_options');
        $title = apply_filters('widget_title', empty($options['title']) ? __('Rentals Search') : $options['title']);
 
      	$area_post = $_POST['lodgix-custom-search-area'];
      	$bedrooms_post = $_POST['lodgix-custom-search-bedrooms'];
      	$id_post = $_POST['lodgix-custom-search-id'];
      	$lang_code = $_GET['lang'];


        echo $before_widget . $before_title . $title . $after_title;
        echo '<div class="lodgix-search-properties" align="left">';

        $areas = $wpdb->get_results('SELECT DISTINCT area FROM ' . $properties_table . ' WHERE area <> \'\' AND area IS NOT NULL');   
        
        echo '<script type="text/javascript">
        				 var P_LODGIX_SEARCH_RESULTS = 0;
                 function p_lodgix_search_properties() {
                    jQuery(\'#search_results\').html(\'\');
                 		jQuery("#lodgix_search_spinner").show();
										jQuery.ajax({
                      type: "POST",
                      url: "' .  get_bloginfo('wpurl') . '/wp-admin/admin-ajax.php",
                      data: "action=p_lodgix_custom_search&area=" + jQuery(\'#lodgix-custom-search-area\').val() + "&bedrooms=" + jQuery(\'#lodgix-custom-search-bedrooms\').val() + "&id=" + jQuery(\'#lodgix-custom-search-id\').val(),
                      success: function(response){
                        //response_array = response.split(" ");
                        //P_LODGIX_SEARCH_RESULTS = parseInt(response_array[0]);
                        jQuery(\'#search_results\').html(response);
                        jQuery("#lodgix_search_spinner").hide();
                      },
                      failure: function(response){
                        jQuery("#lodgix_search_spinner").hide();
                      }
                   });                 	
                 	
                 }
              </script>';
        
        if ($lang_code == 'de')
        	$post_id = (int)$loptions['p_lodgix_search_rentals_page_de'];
        else
        	$post_id = (int)$loptions['p_lodgix_search_rentals_page'];
        	
        $post_url = get_permalink($post_id);
        echo '<form name="lodgix_search_form" method="POST" action="' . $post_url .'">
        			<div class="lodgix-custom-search-listing" style="-moz-border-radius: 5px 5px 5px 5px;line-height:20px;">       			
       				<div>Location:</div> 
       				<div><select id="lodgix-custom-search-area" style="width:95%" name="lodgix-custom-search-area" onchange="javascript:p_lodgix_search_properties();">
       				<option value="ALL_AREAS">All Areas</option>';       	

				foreach($areas as $area)       				
				{
					if ($area->area == $area_post)
						echo '<option selected value="'.$area->area.'">'.$area->area.'</option>';
					else
						echo '<option value="'.$area->area.'">'.$area->area.'</option>';
	
				}
  			
       	echo	'</select></div>
       				<div>Bedrooms:</div> 
       				<div><select id="lodgix-custom-search-bedrooms" name="lodgix-custom-search-bedrooms" onchange="javascript:p_lodgix_search_properties();">';
        for($i = 1 ; $i < 21 ; $i++)
        {
        	if ($i == $bedrooms_post)
        		echo '<option selected value="'.$i.'">'.$i.'</option>';
        	else
        		echo '<option value="'.$i.'">'.$i.'</option>';
        }
       	echo '</select></div>
       				<div>Search by Property Name or ID:</div> 
       				<div><input id="lodgix-custom-search-id" name="lodgix-custom-search-id" style="width:95%" onkeyup="javascript:p_lodgix_search_properties();" value="' . $id_post .  '"></div>
       				<div id="lodgix-custom-search-results">
       				<div id="lodgix_search_spinner" style="display:none;"><img src="/wp-admin/images/wpspin_light.gif"></div>
       				<div id="search_results">
       				</div>
       				<input type="submit" value="Display Results" id="lodgix-custom-search-button">
       				</div>
              </div>';               
        echo '</div></form>';
        echo $after_widget;
      }
    
      // This is the function that outputs the form to let the users edit
      // the widget's title. It's an optional feature that users cry for.
      function widget_lodgix_custom_search_control() {
    
        // Get our options and see if we're handling a form submission.
        $options = get_option('widget_lodgix_custom_search');
    
        //Set the default options for the widget here
        if ( !is_array($options) )
          $options = array('title'=>'Rentals Search');
    
        if ( $_POST['widget_lodgix_custom_search-submit'] ) {
          // Remember to sanitize and format use input appropriately.
          $options['title'] = strip_tags(stripslashes($_POST['widget_lodgix_custom_search-title']));
          update_option('widget_lodgix_custom_search', $options);
        }
    
        // Be sure you format your options to be valid HTML attributes.
        $title = htmlspecialchars($options['title'], ENT_QUOTES);
        $limit = $options['limit'];
        // Here is our little form segment. Notice that we don't need a
        // complete form. This will be embedded into the existing form.
        echo '<p style="text-align:left;"><label for="widget_lodgix_custom_search-title">' . __('Title:') . ' <input style="width: 200px;" id="widget_lodgix_custom_search-title" name="widget_lodgix_custom_search-title" type="text" value="'.$title.'" /></label></p>';
        echo '<input type="hidden" id="widget_lodgix_custom_search-submit" name="widget_lodgix_custom_search-submit" value="1" />';
      } 

      register_sidebar_widget(array('Rentals Search', 'widgets'), 'widget_lodgix_custom_search');

      register_widget_control(array('Rentals Search', 'widgets'), 'widget_lodgix_custom_search_control');
      }      
      
      function widget_lodgix_featured_init() {
    
      // Check for the required plugin functions. This will prevent fatal
      // errors occurring when you deactivate the dynamic-sidebar plugin.
      if ( !function_exists('register_sidebar_widget') )
        return;
    
      // This is the function that outputs our widget_lodgix_featured.
      function widget_lodgix_featured($args) {
        global $wpdb;
        $p_plugin_path = plugin_dir_url(plugin_basename(__FILE__));
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $pages_table = $wpdb->prefix . "lodgix_pages";
        $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";


        extract($args);
    
        // Each widget can store its own options. We keep strings here.
        $options = get_option('widget_lodgix_featured');
        $loptions = get_option('p_lodgix_options');
        $title = apply_filters('widget_title', empty($options['title']) ? __('Featured Rentals') : $options['title']);
 

        echo $before_widget . $before_title . $title . $after_title;
        echo '<div class="lodgix-featured-properties" align="center">';

        $sql = 'SELECT ' . $properties_table . '.id,property_id,description,enabled,featured,main_image_thumb,bedrooms,bathrooms,proptype,city,post_id,area FROM ' . $properties_table . ' LEFT JOIN ' . $pages_table .  ' ON ' . $properties_table . '.id = ' . $pages_table .  '.property_id WHERE featured=1 order by rand()';
        $properties = $wpdb->get_results($sql);
        foreach($properties as $property)
        {
          //$page_id = $wpdb->get_var("SELECT page_id FROM " . $pages_table . " WHERE property_id=" . $page_id);
          $permalink = get_permalink($property->post_id);
          $location = $property->city;
          if ($property->city != "")
            $location = '<span class="price"> in <strong>' . $location . '</strong></span>';
          else
            $location = '<span class="price"><strong>' . $location . '</strong></span>';
          if (($loptions['p_lodgix_display_featured'] == 'area') && ($property->area != ""))
            $location = $property->area;
            $location = '<span class="price"><strong>' . $location . '</strong></span>';
          if ($_GET['lang'] == "de")
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
          
          echo '<div class="lodgix-featured-listing" style="-moz-border-radius: 5px 5px 5px 5px;' . $position . '">
                <div class="imgset">
    	            <a href="' . $permalink . '">
    		            <img alt="View listing" src="' . $property->main_image_thumb . '">
    		            <img class="featured-flag" alt="featured-listings" src="' . $p_plugin_path . 'images/featured-flag.png">
    	            </a>
                </div>
                <a class="address-link" href="' . $permalink . '">' . $property->description . '</a>
                <div class="featured-details">' . $property->bedrooms . ' Bedrm, ' . $property->bathrooms . ' Bath' . $proptype . ''
                  . $location . '
                </div>    
              </div>'; 
        }
        echo '</div>';
        echo $after_widget;
      }
    
      // This is the function that outputs the form to let the users edit
      // the widget's title. It's an optional feature that users cry for.
      function widget_lodgix_featured_control() {
    
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
    
      // This registers our widget so it appears with the other available
      // widgets and can be dragged and dropped into any active sidebars.
      register_sidebar_widget(array('Featured Rentals', 'widgets'), 'widget_lodgix_featured');
    
      // This registers our optional widget control form. Because of this
      // our widget will have a button that reveals a 300x100 pixel form.
      register_widget_control(array('Featured Rentals', 'widgets'), 'widget_lodgix_featured_control');
      }
      
      function clean_all()
      {
         global $wpdb;
         
         $pages_table = $wpdb->prefix . "lodgix_pages"; 
         $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages"; 
         $posts = $wpdb->get_results('SELECT * FROM ' . $pages_table);   
         foreach($posts as $post)
         {
            wp_delete_post($post->page_id,$force_delete = true);
         }         
         $posts_de = $wpdb->get_results('SELECT * FROM ' . $lang_pages_table);   
         foreach($posts_de as $post)
         {
            wp_delete_post($post->page_id,$force_delete = true);
         }                   
         wp_delete_post((int)$this->options['p_lodgix_vacation_rentals_page'],$force_delete = true);
         wp_delete_post((int)$this->options['p_lodgix_vacation_rentals_page_de'],$force_delete = true);
         wp_delete_post((int)$this->options['p_lodgix_availability_page'],$force_delete = true);                           
         wp_delete_post((int)$this->options['p_lodgix_availability_page_de'],$force_delete = true);         
         wp_delete_post((int)$this->options['p_lodgix_search_rentals_page'],$force_delete = true);                           
         wp_delete_post((int)$this->options['p_lodgix_search_rentals_page_de'],$force_delete = true);         
	 			 $areas_pages = unserialize($this->options['p_lodgix_areas_pages']);
	 			 
	 			 
	 			 
				 foreach((array)$areas_pages as $key => $page)
				 {
      		 wp_delete_post((int)$page->page_id,$force_delete = true);         	
      		 unset($areas_pages[$key]);
				 }
					 
				 $this->options['p_lodgix_areas_pages'] = serialize($areas_pages);				 
	 			 $areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
				 foreach((array)$areas_pages_de as $key => $page)
				 {
      		 wp_delete_post((int)$page->page_id,$force_delete = true);    
      		 unset($areas_pages_de[$key]);     	
				 }
		             
				 
				 $this->options['p_lodgix_areas_pages_de'] = serialize($areas_pages_de);
				 $this->saveAdminOptions(); 
         $this->clear_tables();            
      }
      
      function clean_languages()
      {
         global $wpdb;
         
         $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages"; 
         $posts_de = $wpdb->get_results('SELECT * FROM ' . $lang_pages_table);   
         foreach($posts_de as $post)
         {
            wp_delete_post($post->page_id,$force_delete = true);
         }                   
         wp_delete_post((int)$this->options['p_lodgix_vacation_rentals_page_de'],$force_delete = true);
         wp_delete_post((int)$this->options['p_lodgix_availability_page_de'],$force_delete = true);    
         wp_delete_post((int)$this->options['p_lodgix_search_rentals_page_de'],$force_delete = true);    
         
				 $areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
				 if (count($areas_pages_de) > 0)
				 {
					foreach($areas_pages_de as $page)
					{
						
      		 wp_delete_post((int)$page->page_id,$force_delete = true);         	
					}
				 }         				 
				 $this->options['p_lodgix_areas_pages_de'] = serialize(array());
				 $this->saveAdminOptions(); 
      }
      
      function p_lodgix_notify() {
      		ini_set('max_execution_time', 0);
          $fetch_url = 'http://www.lodgix.com/api/xml/properties/get?Token=' . $this->options['p_lodgix_api_key'] . '&IncludeAmenities=Yes&IncludePhotos=Yes&IncludeConditions=Yes&IncludeRates=Yes&IncludeLanguages=Yes&IncludeTaxes=Yes&IncludeReviews=Yes&OwnerID=' . $this->options['p_lodgix_owner_id'];
          $r = new LogidxHTTPRequest($fetch_url);
					$xml = $r->DownloadToString(); 
          if ($xml)
          {  
            $root = new DOMDocument();  
            $root->loadXML($xml);
            $properties_array = $this->domToArray($root);
            if (!$owner['Errors'])
            {
               
              $properties = $properties_array["Results"]["Properties"];
              if ($properties_array['Results']['Properties']['Property'][0])
                  $properties = $properties_array['Results']['Properties']['Property'];    
              $active_properties = array(-1,-2,-3);
              $counter = 0;                  
              foreach ($properties as $property)
              {
               if ($property['ServingStatus'] == "ACTIVE")
                  $active_properties[] = $property['ID'];
               $this->update_tables($property,$counter);
               $counter++;
              }
              $active_properties = join(",", $active_properties);
              $this->clean_properties($active_properties);         
              $this->build_individual_pages();
              $this->build_vacation_rentals_page();
              $this->build_areas_pages();
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
      
      
 			function p_lodgix_check() {
      		ini_set('max_execution_time', 0);         
          die("PLUGIN_INSTALLED");
        
      }      
      
      function set_page_options()
      {
        global $wpdb;
        
        $post_id = (int)$this->options['p_lodgix_vacation_rentals_page'];
        $post = array();
        $post['ID'] = $post_id;
        if ($post_id)
        {
          if ($this->options['p_lodgix_allow_comments'])
              $post['comment_status'] = 'open';
          else
              $post['comment_status'] = 'closed';
          if ($this->options['p_lodgix_allow_pingback'])
              $post['ping_status'] = 'open';
          else
              $post['ping_status'] = 'closed';          
          wp_update_post($post);  
        }
        
        

        $post_id = (int)$this->options['p_lodgix_availability_page'];
        $post = array();
        $post['ID'] = $post_id;
        if ($post_id)
        {
          if ($this->options['p_lodgix_allow_comments'])
              $post['comment_status'] = 'open';
          else
              $post['comment_status'] = 'closed';
          if ($this->options['p_lodgix_allow_pingback'])
              $post['ping_status'] = 'open';
          else
              $post['ping_status'] = 'closed';          
          wp_update_post($post);             
        }

        $post_id = (int)$this->options['p_lodgix_search_rentals_page'];
        $post = array();
        $post['ID'] = $post_id;
        if ($post_id)
        {
          if ($this->options['p_lodgix_allow_comments'])
              $post['comment_status'] = 'open';
          else
              $post['comment_status'] = 'closed';
          if ($this->options['p_lodgix_allow_pingback'])
              $post['ping_status'] = 'open';
          else
              $post['ping_status'] = 'closed';          
          wp_update_post($post);             
        }
        
        $post_id = (int)$this->options['p_lodgix_vacation_rentals_page_de'];
        $post = array();
        $post['ID'] = $post_id;
        if ($post_id)
        {
          if ($this->options['p_lodgix_allow_comments'])
              $post['comment_status'] = 'open';
          else
              $post['comment_status'] = 'closed';
          if ($this->options['p_lodgix_allow_pingback'])
              $post['ping_status'] = 'open';
          else
              $post['ping_status'] = 'closed';          
          wp_update_post($post);  
        }        
        
        
   
  		  if ($this->options['p_lodgix_generate_german'])
        {
          $post_id = (int)$this->options['p_lodgix_availability_page_de'];
         $post = array();
         $post['ID'] = $post_id;
         if ($post_id)
         {
          if ($this->options['p_lodgix_allow_comments'])
              $post['comment_status'] = 'open';
          else
              $post['comment_status'] = 'closed';
          if ($this->options['p_lodgix_allow_pingback'])
              $post['ping_status'] = 'open';
          else
              $post['ping_status'] = 'closed';  
          $sql = "";
                  
          wp_update_post($post);             
         } 
		    }  
		    
  		  if ($this->options['p_lodgix_generate_german'])
        {
          $post_id = (int)$this->options['p_lodgix_search_rentals_page_de'];
         $post = array();
         $post['ID'] = $post_id;
         if ($post_id)
         {
          if ($this->options['p_lodgix_allow_comments'])
              $post['comment_status'] = 'open';
          else
              $post['comment_status'] = 'closed';
          if ($this->options['p_lodgix_allow_pingback'])
              $post['ping_status'] = 'open';
          else
              $post['ping_status'] = 'closed';  
          $sql = "";
                  
          wp_update_post($post);             
         } 
		    }      		         
		    

        $pages_table = $wpdb->prefix . "lodgix_pages";       
        $pages = $wpdb->get_results('SELECT * FROM ' . $pages_table);    
        foreach($pages as $page)
        {
          $post_id = $page->page_id;
          $post = array();
          $post['ID'] = $post_id;        
          if ($post_id)
          {
            if ($this->options['p_lodgix_allow_comments'])
                $post['comment_status'] = 'open';
            else
                $post['comment_status'] = 'closed';
            if ($this->options['p_lodgix_allow_pingback'])
                $post['ping_status'] = 'open';
            else
                $post['ping_status'] = 'closed';                   
            wp_update_post($post);  

          }
        }
        
        
        
        $areas_pages = unserialize($this->options['p_lodgix_areas_pages']);
        foreach($areas_pages as $page)
        {
          $post_id = $page->page_id;
          $post = array();
          $post['ID'] = $post_id;        
          if ($post_id)
          {
            if ($this->options['p_lodgix_allow_comments'])
                $post['comment_status'] = 'open';
            else
                $post['comment_status'] = 'closed';
            if ($this->options['p_lodgix_allow_pingback'])
                $post['ping_status'] = 'open';
            else
                $post['ping_status'] = 'closed';                  
            wp_update_post($post);  

          }
        }        
        
        
		    if ($this->options['p_lodgix_generate_german'])
		    {
         $pages_lang_table = $wpdb->prefix . "lodgix_lang_pages";       
         $pages_de = $wpdb->get_results('SELECT * FROM ' . $pages_lang_table);    
         foreach($pages_de as $page)
         {
          $post_id = $page->page_id;
          $post = array();
          $post['ID'] = $post_id;        
          if ($post_id)
          {
            if ($this->options['p_lodgix_allow_comments'])
                $post['comment_status'] = 'open';
            else
                $post['comment_status'] = 'closed';
            if ($this->options['p_lodgix_allow_pingback'])
                $post['ping_status'] = 'open';
            else
                $post['ping_status'] = 'closed';                   
            wp_update_post($post);  

          }
         }        


          $areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
          foreach($areas_pages_de as $page)
          {
            $post_id = $page->page_id;
            $post = array();
            $post['ID'] = $post_id;        
            if ($post_id)
            {
              if ($this->options['p_lodgix_allow_comments'])
                  $post['comment_status'] = 'open';
              else
                  $post['comment_status'] = 'closed';
              if ($this->options['p_lodgix_allow_pingback'])
                  $post['ping_status'] = 'open';
              else
                  $post['ping_status'] = 'closed';                  
              wp_update_post($post);  
  
            }
          }       

         $this->link_translated_pages();
       }
       
       
       
      }
      
      
      function format_date($date)
      {
        $formatted_date = strftime($this->options['p_lodgix_date_format'],strtotime($date));
        return $formatted_date;
      }
      
      function clean_properties($active_properties)
      {
        global $wpdb;
        
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $amenities_table = $wpdb->prefix . "lodgix_amenities";
        $rates_table = $wpdb->prefix . "lodgix_rates";      
        $rules_table = $wpdb->prefix . "lodgix_rules";           
        $pictures_table = $wpdb->prefix . "lodgix_pictures";    
        $pages_table = $wpdb->prefix . "lodgix_pages";
        $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";
        $properties_lang_table = $wpdb->prefix . "lodgix_lang_properties";
        
        $sql = "DELETE FROM " . $properties_table . " WHERE id not in (" . $active_properties . ")";
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $amenities_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $rates_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);
        $sql = "DELETE FROM " . $rules_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);          
        $sql = "DELETE FROM " . $pictures_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);      
        $sql = "DELETE FROM " . $pages_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql); 
        $sql = "DELETE FROM " . $lang_pages_table . " WHERE property_id not in (" . $active_properties . ")";
        $wpdb->query($sql);         
        $sql = "DELETE FROM " . $properties_lang_table . " WHERE id not in (" . $active_properties . ")";
        $wpdb->query($sql);                              
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
          if ($this->options['p_lodgix_show_header'] == '0')
          {
            $this->options['p_lodgix_root_height'] = $owner["Results"]['MultiWidgetSettings']['RootHeight'] - $ROOT_HEIGHT;  
          }                       
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
          
           
          $policies_table = $wpdb->prefix . "lodgix_policies";   
          $sql = "DELETE FROM " . $policies_table;
          $wpdb->query($sql);
          $policies = array();
          $policies['cancellation_policy'] = $owner["Results"]['Website']['CancellationPolicy'];
          $policies['deposit_policy'] = $owner["Results"]['Website']['DepositPolicy'];   
          $policies['single_unit_helptext'] = $owner["Results"]['Website']['CalendarHelpText'];
          $policies['multi_unit_helptext'] = $owner["Results"]['Website']['MultiCalendarHelpText'];
          
          $policies['language_code'] = 'en';    
          $sql = $this->get_insert_sql_from_array($policies_table,$policies);      
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
              $langarray['multi_unit_helptext'] = $language['MultiCalendarHelpText'];  
              
              $sql = $this->get_insert_sql_from_array($policies_table,$langarray);
              $wpdb->query($sql);     
            }
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
    		if(false !== ($r = strpos(strrev($str), strrev($substr)))) return strlen($str)-$r-strlen($substr);
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
      * Updates Database
      **/
      function update_db($old_db_version)
      {
        global $wpdb;
        global $p_lodgix_db_version;
        $properties_table = $wpdb->prefix . "lodgix_properties";
        $amenities_table = $wpdb->prefix . "lodgix_amenities";
        $rates_table = $wpdb->prefix . "lodgix_rates";      
        $rules_table = $wpdb->prefix . "lodgix_rules";           
        $pictures_table = $wpdb->prefix . "lodgix_pictures"; 
        
        if ($old_db_version < 1.2)
        {
        	$pictures_path = WP_CONTENT_DIR.'/lodgix_pictures'; 
        	$this->rrmdir($pictures_path);        	          
        }

        if ($old_db_version < 1.3)
        {
        	$sql = "ALTER TABLE " . $properties_table  . " MODIFY COLUMN `bathrooms` float default '0';";
        	$wpdb->query($sql);        	
        }
        
        if ($old_db_version < 1.4)
        {
        	$sql = "ALTER TABLE " . $pictures_table  . " MODIFY COLUMN `caption` varchar(255) default NULL;";
        	$wpdb->query($sql);        	
        }        

        if ($old_db_version < 1.5)
        {
        	$sql = "ALTER TABLE " . $properties_table  . " ADD COLUMN `video_url` text default NULL;";
        	$wpdb->query($sql);        	
        	$sql = "ALTER TABLE " . $properties_table  . " ADD COLUMN `virtual_tour_url` text default NULL;";
        	$wpdb->query($sql);        	
        }        

        if ($old_db_version < 1.6)
        {
        	$sql = "ALTER TABLE " . $properties_table  . " ADD COLUMN `beds_text` text default NULL;";
        	$wpdb->query($sql);        	 	
        }        
        
      }
      
      /**
      * Clears Posts Revisions
      */
	    function clear_revisions() { 
          global $wpdb;   
					$pages_table = $wpdb->prefix . "lodgix_pages";
					
					if ($this->options['p_lodgix_vacation_rentals_page'])
					{						
						$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_vacation_rentals_page'];
						$wpdb->query($sql);
					}
					 if ($this->options['p_lodgix_availability_page'])
					 {						
						$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_availability_page'];
						$wpdb->query($sql);
					 }          
					 if ($this->options['p_lodgix_search_rentals_page'])
					 {						
						$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_search_rentals_page'];
						$wpdb->query($sql);
					 }          
					 
					 
          $pages_table = $wpdb->prefix . "lodgix_pages";  
          $posts = $wpdb->get_results('SELECT * FROM ' . $pages_table);   
          foreach($posts as $post)
          {
						$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $post->page_id;
						$wpdb->query($sql);          	
          }
					if ($this->options['p_lodgix_generate_german'])
					{
						
					 if ($this->options['p_lodgix_vacation_rentals_page_de'])
					 {						
						$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_vacation_rentals_page_de'];
						$wpdb->query($sql);
					 }
					 if ($this->options['p_lodgix_availability_page_de'])
					 {						
						$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_availability_page_de'];
						$wpdb->query($sql);
					 }          
					 if ($this->options['p_lodgix_search_rentals_page_de'])
					 {						
						$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $this->options['p_lodgix_search_rentals_page_de'];
						$wpdb->query($sql);
					 }          
					 
					 
           $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";					
           $posts = $wpdb->get_results('SELECT * FROM ' . $lang_pages_table);   
           foreach($posts as $post)
           {
						$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $post->page_id;
						$wpdb->query($sql);          	
           }
          }
			  	$areas_pages = unserialize($this->options['p_lodgix_areas_pages']);					
					if (count($areas_pages) > 0)
					{
						foreach($areas_pages as $page)
						{
	      			$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $page->page_id;
							$wpdb->query($sql);          	
						}
					}
					$areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
					if (count($areas_pages_de) > 0)
					{
						foreach($areas_pages_de as $page)
						{
	      			$sql = "DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = 'revision' AND a.post_parent=" . $page->page_id;
							$wpdb->query($sql);          	
						}
					}
      }  
      
      /**
      * Adds settings/options page
      */
      function admin_options_page() { 
          global $p_lodgix_db_version;
          global $wpdb;
          $table_name = $wpdb->prefix . "lodgix_properties";
					if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      			$this->p_lodgix_build();
      		}               
          $properties_table = $wpdb->prefix . "lodgix_properties";
          $pages_table = $wpdb->prefix . "lodgix_pages";  
          $lang_pages_table = $wpdb->prefix . "lodgix_lang_pages";
          if (get_option('p_lodgix_db_version'))
          {
            $old_db_version = ((float)get_option('p_lodgix_db_version'));
            if ($old_db_version < ((float)$p_lodgix_db_version))
            {
              
              $this->update_db($old_db_version);
            }
          }
          update_option('p_lodgix_db_version',$p_lodgix_db_version);
          
          if($_POST['p_lodgix_save']){
          	  ini_set('max_execution_time', 0);
              if (! wp_verify_nonce($_POST['_wpnonce'], 'p_lodgix-update-options') ) die('Whoops! There was a problem with the data you posted. Please go back and try again.');                   
                  $cleaned = false;
                  if (($this->options['p_lodgix_owner_id'] != ((int)$_POST['p_lodgix_owner_id'])) || ($this->options['p_lodgix_display_title'] != $_POST['p_lodgix_display_title']))
                  {                             
                    $this->clean_all();
                    $cleaned = true;
                  }                   
                  
								  $areas_pages = unserialize($this->options['p_lodgix_areas_pages']);
									$areas_pages_de = unserialize($this->options['p_lodgix_areas_pages_de']);
									if (!is_array($areas_pages))
										$this->options['p_lodgix_areas_pages'] = serialize(array());
									if (!is_array($areas_pages_de))
										$this->options['p_lodgix_areas_pages_de'] = serialize(array());
									$this->saveAdminOptions();		
									                  
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
                  $old_generate_german_value = $this->options['p_lodgix_generate_german'];
                  if ($_POST['p_lodgix_generate_german'] == "on")
                      $this->options['p_lodgix_generate_german'] = true;
                  else
                      $this->options['p_lodgix_generate_german'] = false;  
									if ((!$this->options['p_lodgix_generate_german']) && ($old_generate_german_value))
									{
										$this->clean_languages();
									}                      
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
                                   
									$this->options['p_lodgix_display_featured_horizontally'] = (int)$_POST['p_lodgix_display_featured_horizontally'];                                         
                  $this->options['p_lodgix_owner_id'] = (int)$_POST['p_lodgix_owner_id'];  
                  $this->options['p_lodgix_api_key'] = $_POST['p_lodgix_api_key'];           
                  $this->options['p_google_maps_api'] = $_POST['p_google_maps_api']; 
                  $this->options['p_lodgix_display_title'] = $_POST['p_lodgix_display_title'];
                  $this->options['p_lodgix_display_multi_instructions'] = ((int)$_POST['p_lodgix_display_multi_instructions']);
                  $this->options['p_lodgix_display_single_instructions'] = ((int)$_POST['p_lodgix_display_single_instructions']);
                  $this->options['p_lodgix_display_featured'] = $_POST['p_lodgix_display_featured'];                                    
                  $this->options['p_lodgix_vacation_rentals_page_pos'] = $_POST['p_lodgix_vacation_rentals_page_pos'];
                  $this->options['p_lodgix_availability_page_pos'] = $_POST['p_lodgix_availability_page_pos'];                  
                  $this->options['p_lodgix_vr_title'] = $_POST['p_lodgix_vr_title']; 
                  $this->options['p_lodgix_vr_meta_description'] = $_POST['p_lodgix_vr_meta_description']; 
                  $this->options['p_lodgix_vr_meta_keywords'] = $_POST['p_lodgix_vr_meta_keywords'];   
                  $this->options['p_lodgix_custom_page_template'] = $_POST['p_lodgix_custom_page_template'];   
                  
                  $this->options['p_lodgix_contact_url'] = $_POST['p_lodgix_contact_url'];    
                  $this->options['p_lodgix_contact_url_de'] = $_POST['p_lodgix_contact_url_de'];    
                  
                  if ((!$this->options['p_lodgix_vr_title']) || ($this->options['p_lodgix_vr_title'] == ''))
                    $this->options['p_lodgix_vr_title'] = "Vacation Rentals";
									$this->saveAdminOptions();
									
								
					
                  $post = array();
                  $post['post_title'] = 'Vacation Rentals';
                  $post['menu_order'] = 1;
                  $post['post_status'] = 'publish';
                  $post['post_author'] = 1;
                  $post['post_type'] = "page";
                  $exists = get_post($this->options['p_lodgix_vacation_rentals_page']); 
                  if (!$exists)                 
                  {
                      $post_id = wp_insert_post( $post, true );               
                      if ($post_id != 0)
                      {
                          $this->options['p_lodgix_vacation_rentals_page'] = (int)$post_id;
                      }    
             
                  }

                  
                  $exists = get_post($this->options['p_lodgix_vacation_rentals_page_de']);              
                  if (!$exists)                 
                  {
                 			if ($this->options['p_lodgix_generate_german'])
                      {                              
                        $post['post_title'] = 'Ferienvillen &Uuml;bersicht'; 
                        $post_de_id = wp_insert_post( $post );   
                        if ($post_de_id != 0)
                        {
                            $this->options['p_lodgix_vacation_rentals_page_de'] = (int)$post_de_id;
                            $sql = "INSERT INTO " . $lang_pages_table . "(page_id,property_id,source_page_id,language_code) VALUES(" . $post_de_id . ",-1,NULL,'de')";
                            $wpdb->query($sql);         
                       
                        }         
                      }                       	
                            
                  }
                  
                  $this->saveAdminOptions();            
                  
                  if ($this->options['p_lodgix_thesis_compatibility'])
                  {
                    if (($this->options['p_lodgix_vr_title']) && ($this->options['p_lodgix_vr_title'] != ""))
                    {
                      add_post_meta($this->options['p_lodgix_vacation_rentals_page'], 'thesis_title', $this->options['p_lodgix_vr_title'], true); 
                      update_post_meta($this->options['p_lodgix_vacation_rentals_page'], 'thesis_title', $this->options['p_lodgix_vr_title']);
                    }
                    else
                      delete_post_meta($this->options['p_lodgix_vacation_rentals_page'], 'thesis_title');
                    
                    if (($this->options['p_lodgix_vr_meta_description']) && ($this->options['p_lodgix_vr_meta_description'] != ""))
                    {                       
                        add_post_meta($this->options['p_lodgix_vacation_rentals_page'], 'thesis_description', $this->options['p_lodgix_vr_meta_description'], true); 
                        update_post_meta($this->options['p_lodgix_vacation_rentals_page'], 'thesis_description', $this->options['p_lodgix_vr_meta_description']);
                    }
                    else
                        delete_post_meta($this->options['p_lodgix_vacation_rentals_page'], 'thesis_description');
                    
                    if (($this->options['p_lodgix_vr_meta_keywords']) && ($this->options['p_lodgix_vr_meta_keywords'] != ""))
                    {                        
                        add_post_meta($this->options['p_lodgix_vacation_rentals_page'], 'thesis_keywords', $this->options['p_lodgix_vr_meta_keywords'], true); 
                        update_post_meta($this->options['p_lodgix_vacation_rentals_page'], 'thesis_keywords', $this->options['p_lodgix_vr_meta_keywords']);
                    }
                    else
                        delete_post_meta($this->options['p_lodgix_vacation_rentals_page'], 'thesis_keywords');                        
                    
                  }
                  
                  $post = array();
                  $post['post_title'] = 'Availability';
                  $post['menu_order'] = 2;
                  $post['post_content'] = '[lodgix availability]';  
                  $post['post_status'] = 'publish';
                  $post['post_type'] = "page";                                  
                  $exists = get_post($this->options['p_lodgix_availability_page']);
                  if (!$exists)
                  {
                      $post_id = wp_insert_post($post);               
                      if ($post_id != 0)
                      {
                          $this->options['p_lodgix_availability_page'] = (int)$post_id;
                      }                                
                  }
                  
                  $exists = get_post($this->options['p_lodgix_availability_page_de']);
                  if (!$exists)
                  {
                      if ($this->options['p_lodgix_generate_german'])
                      {
                        $post['post_title'] = 'Verwendbarkeit';
                        $post['post_content'] = '[lodgix availability de]';  
                        $post_de_id = wp_insert_post( $post );               
                        if ($post_de_id != 0)
                        {
                            $this->options['p_lodgix_availability_page_de'] = (int)$post_de_id;
                            $sql = "INSERT INTO " . $lang_pages_table . "(page_id,property_id,source_page_id,language_code) VALUES(" . $post_de_id . ",-2,NULL,'de')";
                            $wpdb->query($sql);
                           
                        }           
                      }                                  
                  } 
                  
                  $post = array();
                  $post['post_title'] = 'Search Rentals';
                  $post['post_content'] = '[lodgix search_rentals]';  
                  $post['post_status'] = 'publish';
                  $post['post_type'] = "page";                                  
                  $exists = get_post($this->options['p_lodgix_search_rentals_page']);
                  if (!$exists)
                  {
                      $post_id = wp_insert_post($post,true);                       
                      if ($post_id != 0)
                      {
                          $this->options['p_lodgix_search_rentals_page'] = (int)$post_id;
                      }                                
                  }
           
                  
                  $exists = get_post($this->options['p_lodgix_search_rentals_page_de']);
                  if (!$exists)
                  {
                      if ($this->options['p_lodgix_generate_german'])
                      {
                                        	
                        $post['post_title'] = 'Vermietungen';
                        $post['post_content'] = '[lodgix search_rentals de]';  
                        $post_de_id = wp_insert_post( $post,true );               
            
                        if ($post_de_id != 0)
                        {
                            $this->options['p_lodgix_search_rentals_page_de'] = (int)$post_de_id;
                            $sql = "INSERT INTO " . $lang_pages_table . "(page_id,property_id,source_page_id,language_code) VALUES(" . $post_de_id . ",-3,NULL,'de')";
                            $wpdb->query($sql);
                           
                        }           
                      }                                  
                  }                   
                  
									
                  
                                           
                  $this->saveAdminOptions();       
									
                  $owner_fetch_url = 'http://www.lodgix.com/api/xml/owners/get?Token=' . $this->options['p_lodgix_api_key']  . '&IncludeLanguages=Yes&OwnerID=' . $this->options['p_lodgix_owner_id'];
                  
                  $fetch_url = 'http://www.lodgix.com/api/xml/properties/get?Token=' . $this->options['p_lodgix_api_key']  . '&IncludeAmenities=Yes&IncludePhotos=Yes&IncludeConditions=Yes&IncludeRates=Yes&IncludeLanguages=Yes&IncludeTaxes=Yes&IncludeReviews=Yes&OwnerID=' . $this->options['p_lodgix_owner_id'];    

 
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
                      foreach ($properties as $property)
                      { 
                        if ($property['ServingStatus'] == "ACTIVE")
                          $active_properties[] = $property['ID'];
                        $this->update_tables($property,$counter);
                        $counter++;
                      }
                      $active_properties = join(",", $active_properties);
                      $this->clean_properties($active_properties);        
                      $this->build_individual_pages();
                      $this->build_vacation_rentals_page();              
                      $this->build_areas_pages();
                      $this->set_page_options(); 
                  
                    }
                   
                  
                          
       
                  if (!$cleaned)  
                  {
                    $posts = $wpdb->get_results('SELECT * FROM ' . $pages_table);   
                    foreach($posts as $post)
                    {
                      $show = true;
                      if ($_POST['p_lodgix_page_' . $post->property_id] == 'on')
                        $sql = "UPDATE " . $pages_table . " SET enabled=1 WHERE id=" . $post->id;
                      else
                      {
                        $show = false;
                        $sql = "UPDATE " . $pages_table . " SET enabled=0 WHERE id=" . $post->id;
                      }
                      $wpdb->query($sql);
                      if ($_POST['p_lodgix_featured_' . $post->property_id] == 'on')
                        $sql = "UPDATE " . $pages_table . " SET featured=1 WHERE id=" . $post->id;
                      else
                      {
                        $sql = "UPDATE " . $pages_table . " SET featured=0 WHERE id=" . $post->id;
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
?>                                   
                <div class="wrap">
                <h2>Lodgix Settings</h2>
                <p style="width:900px;">Please read through our <a target="_blank" href="http://docs.lodgix.com/spaces/vacation-rental/manuals/wordpress-vacation-rental">comprehensive manual</a> if you encounter issues with the plugin.
                   The manual is comprehensive and includes tutorials on proper setup techniques (including screenshot) as well as documentation on getting the plugin to work with various WordPress themes.  
                 Please visit our <a target="_blank" href="http://support.lodgix.com">support site</a> to submit a support ticket if the manual does not help to resolve your issues.</p><br>
        <p>
        <b><?php _e('Lodgix Subscriber Settings', $this->localizationDomain); ?></b>
        </p>
                <form method="post" id="p_lodgix_options">
                <?php wp_nonce_field('p_lodgix-update-options'); ?>
                    <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                        <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('Customer ID:', $this->localizationDomain); ?></th> 
                            <td>
                <input name="p_lodgix_owner_id" type="text" id="p_lodgix_owner_id" size="45" value="<?php echo $this->options['p_lodgix_owner_id'] ;?>"/>
                <br /><span class="setting-description"><?php _e('Please enter your Lodgix Customer ID', $this->localizationDomain); ?>
                          </td> 
                        </tr>
                        <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('API Key:', $this->localizationDomain); ?></th> 
                            <td>
                <input name="p_lodgix_api_key" type="text" id="p_lodgix_api_key" size="45" value="<?php echo $this->options['p_lodgix_api_key'] ;?>"/>
                <br /><span class="setting-description"><?php _e('Please enter your Lodgix API Key', $this->localizationDomain); ?>
                          </td> 
                        </tr>   
                        <tr valign="top"> 
                            <th width="33%" scope="row"></th> 
                            <td></td> 
                        </tr>     
                            <tr valign="top"> 
                            <td colspan="2">
                            	To setup your properties for use with the plug-in, a Lodgix.com subscription is required. <a target="_blank" href="http://www.lodgix.com/register/0?wordpress=1">Sign-up for a free 30 day trial subscription at Lodgix.com</a>. 
                            	No credit card is required.<br>We do offer a a free starter subscription for plug-in users which is good for up to five properties, however it is restricted to payments via PayPal only and does not include use <br>of automated trigger emails or any of the premium modules. This subscription is free and will not expire.
													
															Additionally, if you just wish to test the plug-in within your website using<br> demo property images and data,  and do not wish to sign up for a Lodgix.com subscription at this time, click here to populate the Customer ID and API Key with demo credentials.
															<br><br>If you are a current Lodgix.com subscriber, please login to your Lodgix.com account and go to "Settings >> Important Settings" to obtain your "Customer ID" and "API Key". 
															<br>In alternative click <a href="javascript:void(0)" onclick="p_lodgix_set_demo_credentials(); return false;">here</a> to setup Demo Credentials.
                            	</td> 
                        </tr>                   
                          </tr>     
                            <tr valign="top"> 
                            <td colspan="2">
       
                            	</td> 
                        </tr>                                   
                    </table>
        <p>          
        <b><?php _e('General Display Options', $this->localizationDomain); ?></b>
        </p>
                    <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                        <tr valign="top"> 
                            <th style="width:400px;" scope="row"><?php _e('Display daily rates on individual property pages?:', $this->localizationDomain); ?></th> 
                            <td>
                             <input name="p_lodgix_display_daily_rates" type="checkbox" id="p_lodgix_display_daily_rates" <?php if ($this->options['p_lodgix_display_daily_rates']) echo "CHECKED"; ?>/>
                          
                          </td> 
                        </tr>
                        <tr valign="top"> 
                            <th scope="row"><?php _e('Display Google Map, Contact Us & Details Icons on Search / Sort Page?:', $this->localizationDomain); ?></th> 
                            <td>
                             <input name="p_lodgix_display_icons" type="checkbox" id="p_lodgix_display_icons" <?php if ($this->options['p_lodgix_display_icons']) echo "CHECKED"; ?>/>
                          
                          </td> 
                        </tr>         
                        <tr valign="top"> 
                            <th scope="row"><?php _e('Display Availability Icon on Search / Sort Page?:', $this->localizationDomain); ?></th> 
                            <td>
                             <input name="p_lodgix_display_availability_icon" type="checkbox" id="p_lodgix_display_availability_icon" <?php if ($this->options['p_lodgix_display_availability_icon']) echo "CHECKED"; ?>/>
                          
                          </td> 
                        </tr>         
                     		<tr valign="top"> 
                            <th scope="row"><?php _e('Display Featured Widget horizontally ?:', $this->localizationDomain); ?></th> 
                            <td>                             
                            <select name="p_lodgix_display_featured_horizontally"  id="p_lodgix_display_featured_horizontally" style="width:120px;">                              
                              <option <?php if (($this->options['p_lodgix_display_featured_horizontally'] == 0) || (($this->options['p_lodgix_display_featured_horizontally'] != 1) && ($this->options['p_lodgix_display_featured_horizontally'] != 2))) echo "SELECTED"; ?> value='0'>No</option>
                              <option  <?php if ($this->options['p_lodgix_display_featured_horizontally'] == 1) echo "SELECTED"; ?> value='1'>Yes - Float Left</option>
                              <option  <?php if ($this->options['p_lodgix_display_featured_horizontally'] == 2) echo "SELECTED"; ?> value='2'>Yes - Float Right</option>
                            </select>
                          </td> 
                        </tr>                                              
                        <tr valign="top"> 
                            <th scope="row"><?php _e('Property Name:', $this->localizationDomain); ?></th> 
                            <td>
                             <select name="p_lodgix_display_title"  id="p_lodgix_display_title" style="width:120px;">                              
                              <option <?php if ($this->options['p_lodgix_display_title'] == 'title') echo "SELECTED"; ?> value='title'>Marketing Title</option>
                              <option  <?php if ($this->options['p_lodgix_display_title'] == 'name') echo "SELECTED"; ?> value='name'>Name</option>
                            </select>
                              
                          
                          </td> 
                        </tr>
                        <tr valign="top"> 
                            <th scope="row"><?php _e('Featured Rentals:', $this->localizationDomain); ?></th> 
                            <td>
                             <select name="p_lodgix_display_featured"  id="p_lodgix_display_featured" style="width:120px;">                              
                              <option <?php if ($this->options['p_lodgix_display_featured'] == 'city') echo "SELECTED"; ?> value='city'>Display City</option>
                              <option  <?php if ($this->options['p_lodgix_display_featured'] == 'area') echo "SELECTED"; ?> value='area'>Display Area</option>
                            </select>
                              
                          
                          </td> 
                        </tr> 
                                  <tr valign="top"> 
                            <th scope="row"><?php _e('Display Instructions on Single Unit Calendar:', $this->localizationDomain); ?></th> 
                            <td>
                             <select name="p_lodgix_display_single_instructions"  id="p_lodgix_display_single_instructions" style="width:120px;">                              
                              <option <?php if ($this->options['p_lodgix_display_single_instructions'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                              <option  <?php if ($this->options['p_lodgix_display_single_instructions'] == 0) echo "SELECTED"; ?> value='0'>No</option>
                            </select>
                              
                          
                          </td>  
                                 <tr valign="top"> 
                            <th scope="row"><?php _e('Display Instructions on Multi Unit Calendar:', $this->localizationDomain); ?></th> 
                            <td>
                             <select name="p_lodgix_display_multi_instructions"  id="p_lodgix_display_multi_instructions" style="width:120px;">                              
                              <option <?php if ($this->options['p_lodgix_display_multi_instructions'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                              <option  <?php if ($this->options['p_lodgix_display_multi_instructions'] == 0) echo "SELECTED"; ?> value='0'>No</option>
                            </select>
                              
                          
                          </td>                                                                                                       

                    </table><br>
        <p>                  
        <b><?php _e('General Page Options', $this->localizationDomain); ?></b>
        </p>
                    <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                        <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('Allow Comments:', $this->localizationDomain); ?></th> 
                            <td>
                             <input name="p_lodgix_allow_comments" type="checkbox" id="p_lodgix_allow_comments" <?php if ($this->options['p_lodgix_allow_comments']) echo "CHECKED"; ?>/>
                          
                          </td> 
                        </tr>
                        <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('Allow PingBacks:', $this->localizationDomain); ?></th> 
                            <td>
                             <input name="p_lodgix_allow_pingback" type="checkbox" id="p_lodgix_allow_pingback" <?php if ($this->options['p_lodgix_allow_pingback']) echo "CHECKED"; ?>/>
                          
                          </td> 
                        </tr>
                    </table><br>
        <p>                  
        <b><?php _e('Menu Display Options', $this->localizationDomain); ?></b>
        </p>
                    <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                      <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('Vacation Rentals Menu Position:', $this->localizationDomain); ?></th> 
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
                            <th width="33%" scope="row"><?php _e('Availability Page Menu Position:', $this->localizationDomain); ?></th> 
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
        <p>
        <b><?php _e('Contact Options', $this->localizationDomain); ?></b>
        </p>
                    <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                        <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('Contact URL:', $this->localizationDomain); ?></th> 
                            <td>
                             <input name="p_lodgix_contact_url" style="width:430px;" type="text" id="p_lodgix_contact_url" value="<?php echo $this->options['p_lodgix_contact_url']; ?>" maxlength="255" />                   
                          </td> 
                        </tr>
                        <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('German Contact URL:', $this->localizationDomain); ?></th> 
                            <td>
                             <input name="p_lodgix_contact_url_de" style="width:430px;" type="text" id="p_lodgix_contact_url_de" value="<?php echo $this->options['p_lodgix_contact_url_de']; ?>" maxlength="255" />                   
                          </td> 
                        </tr>
                
                    </table><br>                    
        <p>                	  
        <b><?php _e('Vacation Rentals Page Options', $this->localizationDomain); ?></b>
        </p>
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
                    </table><br>                    
        <p>        
        <b><?php _e('Theme Options', $this->localizationDomain); ?></b>
        </p>
                    <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                        <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('Thesis Compatibility:', $this->localizationDomain); ?></th> 
                            <td>
                             <input name="p_lodgix_thesis_compatibility" type="checkbox" id="p_lodgix_thesis_compatibility" <?php if ($this->options['p_lodgix_thesis_compatibility']) echo "CHECKED"; ?>/>
                          
                          </td> 
                        </tr>
                       <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('Custom Page Template:', $this->localizationDomain); ?></th> 
                            <td>
                             <input name="p_lodgix_custom_page_template" id="p_lodgix_custom_page_template" style="width:430px;" type="text" value="<?php echo $this->options['p_lodgix_custom_page_template']; ?>">
                          </td> 
                        </tr>                            
                    </table><br>
        <b><?php _e('Language Options', $this->localizationDomain); ?></b>
        </p>
                    <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                        <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('Generate German:', $this->localizationDomain); ?></th> 
                            <td>
                             <input name="p_lodgix_generate_german" type="checkbox" id="p_lodgix_generate_german" <?php if ($this->options['p_lodgix_generate_german']) echo "CHECKED"; ?>/>
                          </td> 
                        </tr>
                    </table><br>                    
        <p>                                    
        <b><?php _e('Google Maps', $this->localizationDomain); ?></b>
        </p>
                     <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                        <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e('API Key:', $this->localizationDomain); ?></th> 
                            <td>
                <input name="p_google_maps_api" type="text" id="p_google_maps_api" size="85" value="<?php echo $this->options['p_google_maps_api'] ;?>"/>
                <br /><span class="setting-description"><?php _e('Please enter Google Maps API Key', $this->localizationDomain); ?>
                          </td> 
                        </tr>
                    </table>
                    </table>            
        <p>                    
        <b><?php _e('Property Display Settings', $this->localizationDomain); ?></b>
        </p>
                     <table width="100%" cellspacing="2" cellpadding="5" class="form-table">
                           <tr valign="top"> 
                            <th>Property</td>
                            <td width="1%">
                            Menu:
                          </td>    
                            <td>
                            Featured:
                          </td>    
                           </tr>                                                           
                        <?php
                          $properties = $wpdb->get_results('SELECT ' . $properties_table . '.id,property_id,description,enabled,featured FROM ' . $properties_table . ' LEFT JOIN ' . $pages_table .  ' ON ' . $properties_table . '.id = ' . $pages_table .  '.property_id ORDER BY ' . $properties_table . '.`order`');      
                          foreach($properties as $property)
                          {                            
                        ?> 
                           <tr valign="top"> 
                            <th width="33%" scope="row"><?php _e($property->description, $this->localizationDomain); ?></th> 
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
                    </table>
                    </table>                       
          <p class="submit"> 
            <input type="submit" name="p_lodgix_save" class="button-primary" value="<?php _e('Save and Regenerate', $this->localizationDomain); ?>" /><input onclick="return confirm('Are you sure you want to clean the database ?');" type="submit" name="p_lodgix_clean" class="button-primary" value="<?php _e('Clean Database', $this->localizationDomain); ?>" /><br><br><br><br>
            <b>
          Please wait while database is updated. Time will depend on the number of properties to process.</b>            
          </p>
                </form>       
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
    jQuery('#p_lodgix_owner_id')[0].value = '13';
  	jQuery('#p_lodgix_api_key')[0].value = 'f89bd3b1bd098af107d727063c2736a6';
  }

jQuery(document).ready(function(){
  // add your jquery code here


  //validate plugin option form
    jQuery("#p_lodgix_options").validate({
    rules: {
        p_lodgix_owner_id: {
        required: true,
        number: true,
        min: 1
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