<?php

$sql = "SELECT * FROM " . $lang_properties_table . " WHERE id=" . $property->id;
$german_details = $wpdb->get_results($sql);
$german_details = $german_details[0];
$post_id_de = $wpdb->get_var("select page_id from " . $lang_pages_table . " WHERE property_id=" . $property->id . ";"); 
$permalink = get_permalink($post_id_de);

$sql = "SELECT * FROM " . $reviews_table . " WHERE language_code='de' AND property_id=" . $property->id . ' ORDER BY date DESC';
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
if ($this->options['p_lodgix_contact_url_de'] != "")
{
	$mail_url = $this->options['p_lodgix_contact_url_de'];
	
	if (strpos($mail_url,'__PROPERTY__') != false)
	{
		$mail_url = str_replace('__PROPERTY__',$property->description,$mail_url);
	}
  if (strpos($mail_url,'__PROPERTYID__') != false)
	{
		$mail_url = str_replace('__PROPERTYID__',$property->id,$mail_url);
	}		
	$mail_icon = '<a title="Contact Us" style="margin-left:5px;" href="' . $mail_url  . '"><img src="' . $p_plugin_path  . '/images/mail_50.png"></a>';
}

$video_icon = '';
if ($property->video_url != '')
{
	$video_icon = '<span class="ceebox"><a style="margin-left:5px;" href="' . $property->video_url  . '"><img title="Display Video" src="' . $p_plugin_path  . '/images/video_icon.png"></a></span>';
}

$virtual_tour_icon = '';
if ($property->virtual_tour_url != '')
{
	$virtual_tour_icon = '<a title="" target="_blank" style="margin-left:5px;" href="' . $property->virtual_tour_url  . '"><img title="Display Virtual Tour" src="' . $p_plugin_path  . '/images/virtual_tour.png"></a>';
}

$bedrooms = $property->bedrooms .' Bedroom';
if ($property->bedrooms == 0)
{
   $bedrooms = 'Studio';
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

$single_property .= '<div id="content_lodgix_wrapper">';
$single_property .= '<div id="lodgix_property_badge_tabbed">';
$single_property .= '<table width="100%">												
													<tr>
														<td id="lodgix_property_badge_tabbed_title">' .  $property->description . $property_area . '<div id="lodgix_property_badge_rooms">' . $bedrooms . ' | ' . $property->bathrooms .' Badezimmer | ' . $property->proptype . $property_city . '</div></td>
														<td id="lodgix_property_badge_rates"><span class="lodgix_nowrap">' . $min_daily_rate . $min_weekly_rate .'<a href="javascript:void(0)" onclick=\'jQueryLodgix("#lodgix_tabbed_content").tabs("select","2");\'>Book Now</a></span></td>
													</tr>
										</table>
										<hr>
										<table width="100%">												
													<tr>
														<td id="lodgix_property_badge_icons_left">' . $video_icon . $virtual_tour_icon . $mail_icon . '</td>
														<td id="lodgix_property_badge_icons_right"><span class="lodgix_nowrap"><img src="' .  $p_plugin_path  . '/images/no_pets.png" style="' . $pets . '"><img src="' .  $p_plugin_path  . 'images/no_smoke.png" style="' . $smoking . '"></span></td>
													</tr>
										</table>';
$single_property .= '</div>';
$single_property .= '<br>';

$single_property .= '<link rel="stylesheet" href="' . $p_plugin_path . '/css/jquery-ui-1.8.17.custom.css" type="text/css" />';
$single_property .= '<script>
													jQueryLodgix(document).ready(function(){
															jQueryLodgix("#lodgix_tabbed_content" ).tabs();
															if(document.location.hash == "#booking") {					
																	window.scrollTo(0,0);
																	jQueryLodgix("#lodgix_tabbed_content").tabs("select",1);																					
														  }
															if(document.location.hash == "#map_canvas") {					
																jQueryLodgix().scrollTop();
																jQueryLodgix("#lodgix_tabbed_content").tabs("select",2);
																
														  }														  
													});
									  </script>';

$single_property .= '<div id="lodgix_tabbed_content_box">
    <div id="lodgix_tabbed_content">
        <ul>
            <li>
                <a href="#lodgix_tabbed_content-1">Beschreibung</a>
            </li>
            <li>
                <a href="#lodgix_tabbed_content-2">Verf&uuml;gbarkeit</a>
            </li>            
            <li>
                <a href="#lodgix_tabbed_content-3">Lage</a>
            </li>
            <li>
                <a href="#lodgix_tabbed_content-4">Annehmlichkeiten</a>
            </li>
            <li>
                <a href="#lodgix_tabbed_content-5">Kurs</a>
            </li>
            <li>
                <a href="#lodgix_tabbed_content-6">Bewertungen</a>
            </li>
        </ul>
        <div id="lodgix_tabbed_content-1">
            <div id="lodgix_tabbed_lodgix_property_details">
                <div class="lodgix_tabbed_detailPhotos">
   
                </div>
                <h2>Ausf&uuml;hrliche Beschreibung</h2>';

$single_property .= '<br><center><div id="lodgix-image-gallery" class="royalSlider default"><ul class="royalSlidesContainer dragme">';
foreach($photos as $photo)
{
      $photo_url = str_replace('media/gallery','photo/0/gallery',$photo->url);
      $single_property .= '<li class="royalSlide" data-thumb="' . $photo->thumb_url . '" data-src="' . $photo_url . '">';
      if ($photo->caption != '')
      {
      	$single_property .= '<div style="position: absolute;" class="staticTextBlock"><div class="staticTextBlockInner">' . $photo->caption . '</div></div>';
      }
      $single_property .= '</li>';
}

$single_property .= '</ul></div></center><br><p>' . str_replace(array("\r\n", "\n", "\r"),'<br>',$german_details->description_long)  .  '<br>' . str_replace(array("\r\n", "\n", "\r"),'<br>',$german_details->details) . '</p>';
                
$single_property .= '</div>

            <div class="lodgix_tabbed_clearFix"></div>
        </div>
        <div id="lodgix_tabbed_content-2">';
$single_property .= "[lodgix_calendar " . $property->id . " " . $property->owner_id . " '" . $static . "' " . $property->allow_booking . " " . $this->options['p_lodgix_display_single_instructions'] . " de]";
$single_property .= '</div>       
        <div id="lodgix_tabbed_content-3">
            <div id="lodgix_tabbed_lodgix_property_location">
                <h2>Lage</h2>
                <div id="lodgix_tabbed_map_canvas" style="width: 100%; height: 500px"></div>                          
            </div>
        </div>
        <div id="lodgix_tabbed_content-4">
            <div id="lodgix_tabbed_lodgix_property_amenities">
                <h2>Annehmlichkeiten</h2>
                <ul class="lodgix_tabbed_amenities">';  
								if (count($amenities) >= 1)
								{ 
 									foreach($amenities as $amenity)
									{
	
	  								$amenity_name = $wpdb->get_var("select description_de from " . $lang_amenities_table . " WHERE description='" . $amenity->description . "';"); 
  									if ($amenity_name != "")
  										$single_property .= '<li>' . $amenity_name . '</li>';
 									}

								} 
								$single_property .= '</ul>
            </div>
        </div>
        <div id="lodgix_tabbed_content-5">';
        
$single_property .= '<h2>Kurs</h2>';
if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0)
	$single_property .= 'Tageskurs:	' . $property->currency_symbol . $low_daily_rate  . ' -  ' . $property->currency_symbol .  $high_daily_rate . ' per night<br/>';
if ($low_weekly_rate > 0)	
	$single_property .= 'Wochenpreis:	' . $property->currency_symbol . $low_weekly_rate  . ' - ' . $property->currency_symbol . $high_weekly_rate . ' per week<br/>';
if ($low_monthly_rate > 0)		
	$single_property .= 'Monatspreis:	' . $property->currency_symbol . $low_monthly_rate  . ' - ' . $property->currency_symbol  . $high_monthly_rate  . ' per month<br/>';
$single_property .= '- Die Preise unterscheiden sich saisonbedingt.<br/>';
$single_property .= '- Bitte w&auml;hlen Sie die exakten Daten Ihrer Anreise und Abreise im online Buchungskalender um ein Preisangebot zu erhalten.<br/>';
$single_property .= ''; 

$policies_table = $wpdb->prefix . "lodgix_policies"; 
$policies = $wpdb->get_results("SELECT * FROM " . $policies_table . " WHERE language_code='de'"); 
$taxes = $wpdb->get_results("SELECT * FROM " . $taxes_table . " WHERE property_id=" . $property->id);
$fees = $wpdb->get_results("SELECT * FROM " . $fees_table . " WHERE property_id=" . $property->id);
$deposits = $wpdb->get_results("SELECT * FROM " . $deposits_table . " WHERE property_id=" . $property->id);

if ($policies || $taxes || $fees || $deposits)
{
 $single_property .= "<h2>Policies</h2><table width='98%'>";

 if ($taxes)
 {
  $single_property .= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>Steuern</b><br><br>";  
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
  $single_property .= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>Geb&uuml;hren</b><br><br>";  
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
  $single_property .= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>Kaution</b><br><br>";  
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
      $single_property .= "<tr><td class='lodgix_policies'><b>Stornierungsbedingungen</b><br><br>" .  str_replace(array("\r\n", "\n", "\r"),'<br>',$policy->cancellation_policy)  . "</td></td></tr>";
      $single_property .="<tr><td>&nbsp;</td></tr>";
    }
    if ($policy->deposit_policy)
    {
      $single_property .= "<tr><td class='lodgix_policies'><b>Kautionsbedingungen</b><br><br>" . str_replace(array("\r\n", "\n", "\r"),'<br>', $policy->deposit_policy) . "</td></td></tr>";
      $single_property .="<tr><td>&nbsp;</td></tr>";
    } 
    if ($policy->single_unit_helptext)
    {
      $single_unit_helptext = str_replace(array("\r\n", "\n", "\r"),'<br>', $policy->single_unit_helptext);
      $single_property .="<tr><td>&nbsp;</td></tr>";
    }       
    else
    {
      $single_unit_helptext = '';
    }
    
   }
   
 }

 $single_property .= "</table>";  
}
          
$single_property .= '</div>
        <div id="lodgix_tabbed_content-6">
            <div id="lodgix_tabbed_lodgix_property_reviews">
                <h2>Bewertungen</h2>';

if (count($reviews) >= 1)
{ 
 $counter = 0;	
 foreach($reviews as $review)
 {
  $single_property .= '<p><i>' . str_replace(array("\r\n", "\n", "\r"),'<br>', $review->description) . '</i><br>' . $this->format_date($review->date) . ', ' . $review->name . '</p>';
  $counter++;
  if ($counter != count($reviews))
  	$single_property .= '<center><img src="' . $p_plugin_path  . 'images/post_separator.png"><br><br></center>';    
 }
}                 
                
$single_property .= '
            </div>
        </div></div>';
        
$single_property .= '</div></div>';

  
$single_property .= '<script src="https://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>';
$single_property .= '<script type="text/javascript">        
    // <![CDATA[
            
		function lodgix_gmap_initialize() {    
		    var lodgixLatLng = new google.maps.LatLng(' . $property->latitude . ', ' . $property->longitude . ');
    		var lodgixMapOptions = {
      	zoom: 13,
      	center: lodgixLatLng,
      	mapTypeId: google.maps.MapTypeId.ROADMAP
    		};
    
    		var map = new google.maps.Map(document.getElementById("lodgix_tabbed_map_canvas"),lodgixMapOptions);
				var marker = new google.maps.Marker({
      		position: lodgixLatLng,
      		map: map
  			});    		
  			 			
    }
    window.onload = lodgix_gmap_initialize;    
    
    // ]]>
    </script>';

?>