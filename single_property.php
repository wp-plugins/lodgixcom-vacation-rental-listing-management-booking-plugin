<?php

$permalink = get_permalink($property->post_id);
$p_plugin_path = trailingslashit( plugin_dir_url( __FILE__ ) );  

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
	$mail_icon = '<a title="Contact Us" style="margin-left:5px;" href="' . $mail_url  . '"><img src="' .  $p_plugin_path  . '/images/mail_50.png"></a>';
}

$video_icon = '';
if ($property->video_url != '')
{
	$video_icon = '<span class="ceebox"><a style="margin-left:5px;" href="' . $property->video_url  . '"><img title="Display Video" src="' .  $p_plugin_path  . '/images/video_icon.png"></a></span>';
}

$virtual_tour_icon = '';
if ($property->virtual_tour_url != '')
{
	$virtual_tour_icon = '<a title="" target="_blank" style="margin-left:5px;" href="' . $property->virtual_tour_url  . '"><img title="Display Virtual Tour" src="' .  $p_plugin_path  . '/images/virtual_tour.png"></a>';
}
$bedrooms = $property->bedrooms .' Bedroom';
if ($property->bedrooms == 0)
{
   $bedrooms = 'Studio';
}

if ($property->really_available && $property->allow_booking) {
	$booklink = $property->booklink;
	$booklink = '<a href="' . $booklink . '" class="ldgxBookNow">Book Now</a>';
} else {
	$booklink = '<a href="#booking" class="ldgxBookNow">Book Now</a>';
}

$single_property .= '<div id="content_lodgix_wrapper">';
$single_property .= '
<div class="ldgxPropBadge ldgxPropBadgeSingle">
	<div class="ldgxPropBadgeLine">
		<div class="ldgxPropBadgeTitle">
			' .  $property->description . $property_area . '
			<div class="ldgxPropBadgeRooms">
				' . $bedrooms . ' | ' . $property->bathrooms .' Bathroom | ' . $property->proptype . $property_city . '
			</div>
		</div>
		<div class="ldgxPropBadgeRates">
			' . $min_daily_rate . $min_weekly_rate .  $booklink . '
		</div>
		<div class="ldgxPropBadgeSeparator"></div>
	</div>
	<hr>
	<div class="ldgxPropBadgeLine">
		<div class="ldgxPropBadgeIconsLeft">
			<a title="Display Google Map" href="' . $permalink . '#map_canvas"><img src="' .  $p_plugin_path  . 'images/map_50.png"></a>' . $video_icon . $virtual_tour_icon . $mail_icon . '
		</div>
		<div class="ldgxPropBadgeIconsRight">
			<img src="' .  $p_plugin_path  . 'images/no_pets.png" style="' . $pets . '"><img src="' .  $p_plugin_path  . 'images/no_smoke.png" style="' . $smoking . '">
		</div>
		<div class="ldgxPropBadgeSeparator"></div>
	</div>
</div>
';

$beds_text = "";
if ($property->beds_text != "")
{
	$beds_text = ' This property has ' . $property->beds_text . '.';
}

$single_property .= '<br><center><div id="lodgix-image-gallery" class="royalSlider default"><ul class="royalSlidesContainer dragme">';
foreach($photos as $photo)
{
      $photo_url = str_replace('media/gallery','photo/0/gallery',$photo->url);
      $single_property .= '<li class="royalSlide" data-thumb="' . $photo->thumb_url . '" data-src="' . $photo_url . '">';
      if ($photo->caption != '')
      {
      	$single_property .= '<div class="royalCaption"><div class="royalCaptionItem">' . $photo->caption . '</div></div>';
      }
      $single_property .= '</li>';
}

$single_property .= '</ul></div><p style="text-align:center;"><br/>';
if ($property->really_available && $property->allow_booking) {
	$single_property .= '<a title="Book Now" href="' . $property->booklink .
	'"><img src="' . $p_plugin_path  . '/images/booknow.png"></a>';
} else {
	$single_property .= '<a title="Check Availability" href="' . $permalink .
	'#booking"><img src="' . $p_plugin_path  . '/images/Lodgix200x50.png"></a>';
}
$single_property .= '</p></center>';

$single_property .= '<div id="lodgix_property_description"><p><h2>Property Description</h2></p>' . str_replace(array("\r\n", "\n", "\r"),'<br>',$property->description_long) . '</div>';
$single_property .= '<div id="lodgix_property_details"><p><h2>Property Details</h2></p>' . str_replace(array("\r\n", "\n", "\r"),'<br>',$property->details) . $beds_text . '</div>';

if (count($amenities) >= 1)
{ 
 $single_property .= '<br><br><div id="lodgix_property_amenities"><h2>Amenities</h2><br><ul class="amenities">';
 foreach($amenities as $amenity)
 {
  $single_property .= '<li>' . $amenity->description . '</li>';
 }
 $single_property .= '</ul></div><br><br>';
} 

if (count($reviews) >= 1)
{ 
 $single_property .= '<br><br><div id="lodgix_property_reviews"><h2>Guest Reviews</h2><br>';
 $counter = 0;
 foreach($reviews as $review)
 {
  if ($counter > 0)
  {
    $single_property .= '<br   />';
  }
  $single_property .= '<p><i>' . str_replace(array("\r\n", "\n", "\r"),'<br>',$review->description) . '</i></p><p>' . $this->format_date($review->date) . ', ' . $review->name . '</p>';
  $counter++;
  if ($counter != count($reviews))
  	$single_property .= '<center><img src="' .  $p_plugin_path  . 'images/post_separator.png"></center>';
 }
 $single_property .= '</div><br><br>';
} 

$static = '';
if ($property->allow_booking == 0)
{
   $static = '_static';
}   

$low_daily_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";",null));
$high_daily_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";",null));
$low_weekly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";",null));
$high_weekly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";",null));
$low_monthly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";",null));
$high_monthly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";",null));

$single_property .= '<div id="lodgix_property_rates"><h2>Rates</h2>';

if (($this->options['p_lodgix_rates_display'] == 0) || (!$merged_rates)) {
	if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0)
		$single_property .= 'Daily Rate:	' . $property->currency_symbol . $low_daily_rate  . ' -  ' . $property->currency_symbol .  $high_daily_rate . ' per night<br/>';
	if ($low_weekly_rate > 0)	
		$single_property .= 'Weekly Rate:	' . $property->currency_symbol . $low_weekly_rate  . ' - ' . $property->currency_symbol . $high_weekly_rate . ' per week<br/>';
	if ($low_monthly_rate > 0)		
		$single_property .= 'Monthly Rate:	' . $property->currency_symbol . $low_monthly_rate  . ' - ' . $property->currency_symbol  . $high_monthly_rate  . ' per month<br/>';
}
else {
    $single_property .= '<table class="merged_rates_table">';
    $single_property .= '<thead><tr class="">';
    $single_property .= '<th class="lodgix_left lodgix_dates merged_rates_table_green">Dates</th>';
	if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0) {
        $single_property .= '<th class="lodgix_centered merged_rates_table_green">Weekday</th>';
        $single_property .= '<th class="lodgix_centered merged_rates_table_green">Weekend</th>';
    }
    $single_property .= '<th class="lodgix_centered merged_rates_table_green">Weekly</th>';
    $single_property .= '<th class="lodgix_centered merged_rates_table_green">Monthly</th>';        
    $single_property .= '</tr></thead><tbody>';
    $even = true;
    foreach($merged_rates as $mr) {
        if ($even)
            $single_property .= '<tr class="merged_rates_table-even">';
        else
            $single_property .= '<tr class="merged_rates_table-odd">';
        $single_property .= '<td class="lodgix_left lodgix_dates">';
        $single_property .= '<b>' . $mr->name . '</b><br>';
        $single_property .= '' . strftime($this->options['p_lodgix_date_format'], strtotime($mr->from_date)) . ' - ' . strftime($this->options['p_lodgix_date_format'], strtotime($mr->to_date)) ;
        if ($mr->min_stay > 1)
            $single_property .= '<br>' . $mr->min_stay . ' nights min stay';
        $single_property .= '</td>';        
        if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0) {
            $single_property .= '<td class="lodgix_centered">' . $property->currency_symbol . ((!$mr->nightly) ? "0.00" : $mr->nightly) . '</td>';
            $single_property .= '<td class="lodgix_centered">' . $property->currency_symbol . ((!$mr->nightly_weekend) ? "0.00" : $mr->nightly_weekend) . '</td>';
        }
        $single_property .= '<td class="lodgix_centered">' . $property->currency_symbol . ((!$mr->weekly) ? "0.00" : $mr->weekly)  . '</td>';
        $single_property .= '<td class="lodgix_centered">' . $property->currency_symbol . ((!$mr->monthly) ? "0.00" : $mr->monthly)  . '</td>';
        $single_property .= '</tr>';
        $even = !$even;
    }
    $single_property .= '</tbody></table><br>';
}


$single_property .= '- Rate varies due to seasonality and holidays.<br/>';
$single_property .= '- Please select your dates on our online booking calendar for an exact quote.<br/>';
$single_property .= '</div>';



$single_property .= "[lodgix_calendar " . $property->id . " " . $property->owner_id . " '" . $static . "' " . $property->allow_booking . " " . $this->options['p_lodgix_display_single_instructions'] . " en]";


$policies_table = $wpdb->prefix . "lodgix_policies"; 
$policies = $wpdb->get_results("SELECT * FROM " . $policies_table . " WHERE language_code='en'"); 
$taxes = $wpdb->get_results("SELECT * FROM " . $taxes_table . " WHERE property_id=" . $property->id);
$fees = $wpdb->get_results("SELECT * FROM " . $fees_table . " WHERE property_id=" . $property->id);
$deposits = $wpdb->get_results("SELECT * FROM " . $deposits_table . " WHERE property_id=" . $property->id);
 
if ($policies || $taxes || $fees || $deposits)
{
 $single_property .= "<div id='property_policies'><h2>Policies</h2><table width='98%'>";

 if ($taxes)
 {
  $single_property .= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>Taxes</b><br><br>";  
  foreach($taxes as $tax)
  {
   $single_property .= $tax->title . ' - ';
   if ($tax->is_flat == 1)
   {
    $single_property .= $property->currency_code . number_format($tax->value,2);   
    if ($tax->frequency == 'ONETIME')
    {
     $single_property .= ' - One Time';
    }
    else
    {
     $single_property .= ' - Daily';
    }
   }
   else
   {
    $single_property .= number_format($tax->value,2) . "%"; 
   }
   $single_property .= "<br>";
  }   
  $single_property .="</span></td></tr>";
  $single_property .="<tr><td>&nbsp;</td></tr>";
  
 }
 
 if ($fees)
 {
  $single_property .= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>Fees</b><br><br>";  
  foreach($fees as $fee)
  {
   $single_property .= $fee->title . ' - ';
   if ($fee->is_flat == 1)
   {
    $single_property .= $property->currency_code . number_format($fee->value,2);   
   }
   else
   {
    $single_property .= number_format($fee->value,2) . "%"; 
   }
   if ($fee->tax_exempt == 1)
   {
    $single_property .= ' - Tax Exempt';   
   }
   $single_property .= "<br>";
  }   
  $single_property .="</span></td></tr>";
  $single_property .="<tr><td>&nbsp;</td></tr>";
 }
 

 if ($deposits)
 {
  $single_property .= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>Deposits</b><br><br>";  
  foreach($deposits as $deposit)
  {
   $single_property .= $deposit->title . ' - ';
   $single_property .= $property->currency_code . number_format($deposit->value,2);   
   $single_property .= "<br>";
  }   
  $single_property .="</span></td></tr>";
  $single_property .="<tr><td>&nbsp;</td></tr>";
 } 
 
 if ($policies)
 {
   foreach($policies as $policy)
   {
    if ($policy->cancellation_policy)
    {
      $single_property .= "<tr><td class='lodgix_policies'><b>Cancellation Policy</b><br><br>" . str_replace(array("\r\n", "\n", "\r"),'<br>',$policy->cancellation_policy)  . "</td></td></tr>";
      $single_property .= "<tr><td>&nbsp;</td></tr>";
    }
    if ($policy->deposit_policy)
    {
      $single_property .= "<tr><td class='lodgix_policies'><b>Deposit Policy</b><br><br>" . str_replace(array("\r\n", "\n", "\r"),'<br>',$policy->deposit_policy)  . "</td></td></tr>";
      $single_property .= "<tr><td>&nbsp;</td></tr>";
    } 
    if ($policy->single_unit_helptext)
    {
      $single_unit_helptext = str_replace(array("\r\n", "\n", "\r"),'<br>',$policy->single_unit_helptext);
      $single_property .= "<tr><td>&nbsp;</td></tr>";
    }       
    else
    {
      $single_unit_helptext = '';
    }    
   }
 }

 $single_property .= "</table></div>";  
}

$single_property .= '<script type="text/javascript">tb_pathToImage = "/wp-includes/js/thickbox/loadingAnimation.gif";tb_closeImage = "/wp-includes/js/thickbox/tb-close.png";</script>';

$single_property .= '<div id="lodgix_property_location"><h2>Property Location</h2><div id="map_canvas" style="width: 100%; height: 300px"></div></div>';

$single_property .= '<div id="lodgix_photo"><a id="lodgix_aGallery" href="#Gallery"></a>     
                        <div id="lodgix_photo_top"></div>      
                        <div id="lodgix_photo_body">
                        <div id="lodgix_photo_zoom"></div>       
                        <div align="center" style="width:100%;">
                        <table class="lodgix_gallery" cellpadding="0" cellspacing="12">';
$counter = 0;         
$num_pics = 2;
$single_property .= '<h2>Property Images</h2>';
//if (get_current_theme() == "Thesis")              
//  $num_pics = 3;
foreach($photos as $photo)
{
      $photo_url = str_replace('media/gallery','photo/0/gallery',$photo->url);
      if (($counter % $num_pics == 0) && ($counter != 0))
      {
         $single_property .= "<tr>";
      }  
                
      $single_property .= '<td valign="top" align="center" style="border-bottom: 0;">';
      $single_property .= '<a href="' . $photo_url . '" class="thickbox"  rel="gallery-images"><img src="' . $photo->thumb_url .'" height="150" width="200"  style="cursor:url(' .  $p_plugin_path . 'images/zoomin.cur), pointer" border=0 title="' . $photo->caption . '"></a>
            <div class="image_desc"></div> 
            </td>
               <div style="align:left"></div>
            </td>';
                          
        
   $counter++;
}


$single_property .= '</tr></table></div></div><div id="lodgix_photo_bottom"></div></div>';
$single_property .= '<div class="ldgxPowered">' . $link . ' by Lodgix.com</div></div>';

$single_property .= '<script src="https://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>';
$single_property .= '<script type="text/javascript">        
    // <![CDATA[
		function lodgix_gmap_initialize() {    
		    var lodgixLatLng = new google.maps.LatLng(' . $property->latitude . ', ' . $property->longitude . ');
    		var lodgixMapOptions = {
      	zoom: 10,
      	center: lodgixLatLng,
      	mapTypeId: google.maps.MapTypeId.ROADMAP
    		};
    
    		var map = new google.maps.Map(document.getElementById("map_canvas"),lodgixMapOptions);
				var marker = new google.maps.Marker({
      		position: lodgixLatLng,
      		map: map
  			});    		
    }
    window.onload = lodgix_gmap_initialize;
    // ]]>
    </script>';
  


?>