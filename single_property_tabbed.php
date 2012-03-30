<?php

$permalink = get_permalink($property->post_id);
$p_plugin_path = str_replace(home_url(),'',WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))); 

$sql = "SELECT * FROM " . $reviews_table . " WHERE language_code='en' AND property_id=" . $property->id . ' ORDER BY date DESC';
$reviews = $wpdb->get_results($sql);   

$sql = "SELECT * FROM " . $pictures_table . " WHERE property_id=" . $property->id . ' ORDER BY position';
$photos = $wpdb->get_results($sql);

$property_area = "";
if ($property->area != "")
	$property_area = " at " . $property->area;

$property_city = "";
if ($property->city != "")
	$property_city = " in " . $property->city;

$min_weekly_rate = "";
if ($property->min_weekly_rate > 0)
	$min_weekly_rate = 'from '. $property->currency_symbol . $property->min_weekly_rate . ' per /wk<br>';

$min_daily_rate = "";
if (($property->min_daily_rate > 0) && $this->options['p_lodgix_display_daily_rates'])
	$min_daily_rate = 'from '. $property->currency_symbol . $property->min_daily_rate . ' per /nt<br>';
	
	
$pets = "";
if ($property->pets)
	$pets = "display:none;";

$smoking = "";
if ($property->smoking)
	$smoking = "display:none;";
	
$mail_icon = '';
if ($this->options['p_lodgix_contact_url'] != "")
{
	$mail_url = $this->options['p_lodgix_contact_url'];
	
	if (strpos($mail_url,'__PROPERTY__') != false)
	{
		$mail_url = str_replace('__PROPERTY__',$property->description,$mail_url);
	}
  if (strpos($mail_url,'__PROPERTYID__') != false)
	{
		$mail_url = str_replace('__PROPERTYID__',$property->id,$mail_url);
	}	
	$mail_icon = '<a title="Contact Us" style="margin-left:5px;" href="' . $mail_url  . '"><img src="' . home_url() . $p_plugin_path  . '/images/mail_50.png"></a>';
}

$video_icon = '';
if ($property->video_url != '')
{
	$video_icon = '<span class="ceebox"><a style="margin-left:5px;" href="' . $property->video_url  . '"><img title="Display Video" src="' . home_url() . $p_plugin_path  . '/images/video_icon.png"></a></span>';
}

$virtual_tour_icon = '';
if ($property->virtual_tour_url != '')
{
	$virtual_tour_icon = '<a title="" target="_blank" style="margin-left:5px;" href="' . $property->virtual_tour_url  . '"><img title="Display Virtual Tour" src="' . home_url() . $p_plugin_path  . '/images/virtual_tour.png"></a>';
}
$bedrooms = $property->bedrooms .' Bedroom';
if ($property->bedrooms == 0)
{
   $bedrooms = 'Studio';
}

$single_property .= '<link rel="stylesheet" href="' . $p_plugin_path . '/css/jquery-ui-1.8.17.custom.css" type="text/css" />';
$single_property .= '<script>jQueryLodgix(document).ready(function(){jQueryLodgix("#lodgix_tabbed_content" ).tabs();});</script>';



$single_property .= '<div id="lodgix_tabbed_content_box">
    <div id="lodgix_tabbed_content">
        <div class="lodgix_tabbed_headline_area">
            <div class="lodgix_tabbed_headline_areaRight">
                <div class="lodgix_tabbed_lodgix-sleep-icons">
                	<img border="0" alt="" src="' . $p_plugin_path . 'images/tabbed/Person-4.png"/>&nbsp;&nbsp;
                	<img border="0" alt="" src="' . $p_plugin_path . 'images/tabbed/Bed-Double.png"/>&nbsp;&nbsp;
                	<img border="0" alt="" src="' . $p_plugin_path . 'images/tabbed/Bed-Single.png"/>&nbsp;&nbsp;
                	<img border="0" alt="" src="' . $p_plugin_path . 'images/tabbed/Sofa-Single.png"/></div>
            </div>
            <div class="lodgix_tabbed_clearfix"></div>
        </div>
        <ul>
            <li>
                <a href="#lodgix_tabbed_content-1">Details</a>
            </li>
            <li>
                <a href="#lodgix_tabbed_content-2">Location</a>
            </li>
            <li>
                <a href="#lodgix_tabbed_content-3">Amenities</a>
            </li>
            <li>
                <a href="#lodgix_tabbed_content-4">Rates</a>
            </li>
            <li>
                <a href="#lodgix_tabbed_content-5">Availability</a>
            </li>
            <li>
                <a href="#lodgix_tabbed_content-6">Reviews</a>
            </li>
        </ul>
        <div id="lodgix_tabbed_content-1">
            <div id="lodgix_tabbed_lodgix_property_details">
                <div class="lodgix_tabbed_detailPhotos">
   
                </div>
                <h2>Property Details</h2>
                <div class="lodgix_tabbed_lodgix-listing-amenities">
                    <img border="0" alt="" src="' . $p_plugin_path . 'images/tabbed/parking.png" title="Parking Available"/>&nbsp;&nbsp;
                    <img border="0" alt="" src="' . $p_plugin_path . 'images/tabbed/computer.png" title="Computer" />&nbsp;&nbsp;
                    <img border="0" alt="" src="' . $p_plugin_path . 'images/tabbed/internet.png" title="Internet" />&nbsp;&nbsp;
                    <img border="0" alt="" src="' . $p_plugin_path . 'images/tabbed/tv.png" title="TV" />&nbsp;&nbsp;
                    <img border="0" alt="" src="' . $p_plugin_path . 'images/tabbed/no_smoking.png" title="No Smoking" />&nbsp;&nbsp;
                    <img border="0" alt="" src="' . $p_plugin_path . 'images/tabbed/no_pets.png" title="No Pets" />
                </div>
                ' . str_replace(array("\r", "\r\n", "\n"),'<br>',$property->details) . '
            </div>
            <div class="lodgix_tabbed_clearFix"></div>
        </div>
        <div id="lodgix_tabbed_content-2">
            <div id="lodgix_tabbed_lodgix_property_location">
                <h2>Property Location</h2>
                <div id="lodgix_tabbed_map_canvas" style="width: 100%; height: 500px"></div>                          
            </div>
        </div>
        <div id="lodgix_tabbed_content-3">
            <div id="lodgix_tabbed_lodgix_property_amenities">
                <h2>Amenities</h2>
                <ul class="lodgix_tabbed_amenities">';  
								if (count($amenities) >= 1)
								{ 
									$counter = 0;
 									foreach($amenities as $amenity)
									{
	
  									$single_property .= '<li>' . $amenity->description . '</li>';
  									$counter++;
 									}

								} 
								$single_property .= '</ul>
            </div>
        </div>
        <div id="lodgix_tabbed_content-4">
          
        </div>
        <div id="lodgix_tabbed_content-5">';

$single_property .= "[lodgix_calendar " . $property->id . " " . $property->owner_id . " '" . $static . "' " . $property->allow_booking . " " . $this->options['p_lodgix_display_single_instructions'] . " en]";        

$single_property .= '</div>
        <div id="lodgix_tabbed_content-6">
            <div id="lodgix_tabbed_lodgix_property_reviews">
                <h2>Guest Reviews</h2>';

if (count($reviews) >= 1)
{ 
 foreach($reviews as $review)
 {
  $single_property .= '<p><i>' . $review->description . '</i><br>' . $this->format_date($review->date) . ', ' . $review->name . '</p>';
 }
}                 
                
$single_property .= '
            </div>
        </div>';
        
$single_property .= '</div></div>';

  
$single_property .= '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=' . $this->options['p_google_maps_api'] . '"type="text/javascript"></script>';
$single_property .= '<script type="text/javascript">    
    function lodgix_gmap_initialize() {
    //<![CDATA[
      if (GBrowserIsCompatible()) {
        var map = new GMap(document.getElementById("lodgix_tabbed_map_canvas"));
    		map.addControl(new GSmallMapControl()); 
		    map.addControl(new GMapTypeControl());
        var point = new GPoint(' . $property->longitude . ', ' . $property->latitude . ');
		    map.centerAndZoom(point, 4);        
		    var marker = new GMarker(point);
		    map.addOverlay(marker)      
		   }
    }
    lodgix_gmap_initialize();
    //]]>
    </script>';

?>