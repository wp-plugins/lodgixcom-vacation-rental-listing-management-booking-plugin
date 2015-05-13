<?php

$sql = "SELECT * FROM " . $this->pictures_table . " WHERE property_id=" . $property->id . ' ORDER BY position';
$photos = $wpdb->get_results($sql);

$property_area = "";
if ($property->area != "")
	$property_area = " at " . $property->area;

$property_city = "";
if ($property->city != "")
	$property_city = " in " . $property->city;

$min_weekly_rate = "";
if (($property->min_weekly_rate > 0) && $this->options['p_lodgix_display_weekly_rates'])
	$min_weekly_rate = __('from', $this->localizationDomain) . ' ' . $property->currency_symbol . $property->min_weekly_rate . __(' per /wk', $this->localizationDomain) . '<br />';

$min_daily_rate = "";
if (($property->min_daily_rate > 0) && $this->options['p_lodgix_display_daily_rates'])
	$min_daily_rate = __('from', $this->localizationDomain) . ' ' . $property->currency_symbol . $property->min_daily_rate . __(' per /nt', $this->localizationDomain) . '<br />';

if ($this->options['p_lodgix_gmap_zoom_level'] == 0) {
	$p_lodgix_gmap_zoom_level = 10;
}
else  {
    $p_lodgix_gmap_zoom_level = $this->options['p_lodgix_gmap_zoom_level'];
}

$pets = "";
if ($property->pets) $pets = "display:none;";
$smoking = "";
if ($property->smoking) $smoking = "display:none;";
$mail_icon = '';
$contact_var_name = $contact_var_name;
$contact_var_name = 'p_lodgix_contact_url_' . $this->sufix;
if ($this->options[$contact_var_name] != "")
{
    $mail_url = $this->options[$contact_var_name];
    if (strpos($mail_url, '__PROPERTY__') != false)
    {
        $mail_url = str_replace('__PROPERTY__', $property->description, $mail_url);
    }
    if (strpos($mail_url, '__PROPERTYID__') != false)
    {
        $mail_url = str_replace('__PROPERTYID__', $property->id, $mail_url);
    }
    $mail_icon = '<a title="Contact Us" style="margin-left:5px;" href="' . $mail_url . '" class="lodgix_email_icon"></a>';
}
$video_icon = '';
if ($property->video_url != '')
{
    $video_icon = '<span class="ceebox"><a style="margin-left:5px;" href="' . $property->video_url . '" class="lodgix_video_icon"></a></span>';
}
$virtual_tour_icon = '';
if ($property->virtual_tour_url != '')
{
    $virtual_tour_icon = '<a title="" target="_blank" style="margin-left:5px;" href="' . $property->virtual_tour_url . '" class="lodgix_virtual_tour_icon"></a>';
}
$bedrooms = $property->bedrooms . ' ' . __('Bedrooms', $this->localizationDomain);
if ($property->bedrooms == 0)
{
    $bedrooms = 'Studio';
}
if ($property->really_available && $property->allow_booking)
{
    $booklink = $property->booklink;
    $booklink = '<div class="ldgxBookNow ldgxBookNowSingle"><a href="' . $booklink . '">' . __('Book Now', $this->localizationDomain) . '</a></div>';
}
else
{
    $booklink = '<div class="ldgxBookNow ldgxBookNowSingle"><a href="#booking">' . __('Book Now', $this->localizationDomain) . '</a></div>';
}
$single_property.= '<div id="content_lodgix_wrapper">';
$single_property.= '

<div class="ldgxPropBadge ldgxPropBadgeSingle">

<div class="ldgxPropBadgeLine">

<div class="ldgxPropBadgeTitle">

' . $property->description . $property_area . '

<div class="ldgxPropBadgeRooms">

' . $bedrooms . ' | ' . $property->bathrooms . ' ' . __('Bathrooms', $this->localizationDomain) . ' | ' . $property->proptype . $property_city . '

</div>

</div>

<div class="ldgxPropBadgeRates">

' . $min_daily_rate . $min_weekly_rate . $booklink . '

</div>

<div class="ldgxPropBadgeSeparator"></div>

</div>

<hr>

<div class="ldgxPropBadgeLine">

<div class="ldgxPropBadgeIconsLeft">

<a title="' . __('Display Google Map', $this->localizationDomain) . '" href="' . $permalink . '#map_canvas" class="lodgix_map_icon"></a>' . $video_icon . $virtual_tour_icon . $mail_icon . '

</div>

<div class="ldgxPropBadgeIconsRight">

<span id="lodgix_no_pets_icon"  style="' . $pets . '"></span><span id="lodgix_no_smoke_icon" style="' . $smoking . '"></span>

</div>

<div class="ldgxPropBadgeSeparator"></div>

</div>

</div>

';
$beds_text = "";
if ($property->beds_text != "")
{
    $beds_text = ' ' . __('This property has', $this->localizationDomain) . ' ' . $property->beds_text . '.';
}
$single_property.= '<br /><center><div id="lodgix-image-gallery" class="royalSlider default"><ul class="royalSlidesContainer dragme">';
foreach($photos as $photo)
{
	
	$photo_url = $photo->url;
	
    $single_property.= '<li class="royalSlide" data-thumb="' . $photo->thumb_url . '" data-src="' . $photo_url . '">';
    if ($photo->caption != '')
    {
        $single_property.= '<div class="royalCaption"><div class="royalCaptionItem">' . $photo->caption . '</div></div>';
    }
    $single_property.= '</li>';
}
$single_property.= '</ul></div><p style="text-align:center;"><br/>';
if ($property->really_available && $property->allow_booking)
{
    $single_property.= '<a title="' . __('Book Now', $this->localizationDomain) . '" href="' . $property->booklink . '"><img src="' . $this->p_plugin_path . '/images/booknow.png"></a>';
}
else
{
    $single_property.= '<a title="' . __('Check Availability', $this->localizationDomain) . '" href="' . $permalink . '#booking" class="lodgix_check_availability_icon"></a>';
}
$single_property.= '</p></center>';

$single_property.= '<div id="lodgix_property_description"><p><h2>' . __('Property Description', $this->localizationDomain) . '</h2></p>' . str_replace(array(
    "\r\n",
    "\n",
    "\r"
) , '<br />', $property->description_long) . '</div>';
$single_property.= '<div id="lodgix_property_details"><p><h2>' . __('Property Details', $this->localizationDomain) . '</h2></p>' . str_replace(array(
    "\r\n",
    "\n",
    "\r"
) , '<br />', $property->details) . $beds_text . '</div>';
if (count($amenities_list) >= 1)
{
    $single_property.= '<br /><br /><div id="lodgix_property_amenities"><h2>' . __('Amenities', $this->localizationDomain) . '</h2><br /><ul class="amenities">';
    foreach($amenities_list as $amenity)
    {
        $single_property.= '<li>' . $amenity . '</li>';
    }
    $single_property.= '</ul></div><br /><br />';
}
if (count($reviews) >= 1)
{
    $single_property.= '<br /><br /><div id="lodgix_property_reviews"><h2>' . __('Guest Reviews', $this->localizationDomain) . '</h2><br />';
    $counter = 0;
    foreach($reviews as $review)
    {
        if ($counter > 0)
        {
            $single_property.= '<br   />';
        }
        $single_property.= '<p><i>' . str_replace(array(
            "\r\n",
            "\n",
            "\r"
        ) , '<br />', $review->description) . '</i></p><p>' . $this->format_date($review->date) . ', ' . $review->name . '</p>';
        $counter++;
        if ($counter != count($reviews)) $single_property.= '<center><img src="' . $this->p_plugin_path . 'images/post_separator.png"></center>';
    }
    $single_property.= '</div><br /><br />';
}
$static = '';
if ($property->allow_booking == 0)
{
    $static = '_static';
}

$low_daily_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";",null));
$low_weekend_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(weekend_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 1 AND weekend_rate_enabled = 1 and property_id = " . $property->id  . ";",null));        
if ($low_weekend_rate < $low_daily_rate && $low_weekend_rate > 0) {
    $low_daily_rate = $low_weekend_rate;
}      
$high_daily_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";",null));
$high_weekend_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(weekend_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 1 AND weekend_rate_enabled = 1 and property_id = " . $property->id  . ";",null));
if ($high_weekend_rate > $high_daily_rate) {
    $high_daily_rate = $high_weekend_rate;
}                      
$low_weekly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";", null));
$high_weekly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";", null));
$low_monthly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";", null));
$high_monthly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";", null));
$single_property.= '<div id="lodgix_property_rates"><h2><div id="lodgix_policies_rates">' . __('Rates', $this->localizationDomain) . '</h2>';
if (($this->options['p_lodgix_rates_display'] == 0) || (!$merged_rates))
{
    if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0) $single_property.= __('Daily Rate', $this->localizationDomain) . ': ' . $property->currency_symbol . $low_daily_rate . ' -  ' . $property->currency_symbol . $high_daily_rate . ' ' . __('per night', $this->localizationDomain) . '<br/>';
    if ($this->options['p_lodgix_display_weekly_rates'] && $low_weekly_rate > 0) $single_property.= __('Weekly Rate', $this->localizationDomain) . ': ' . $property->currency_symbol . $low_weekly_rate . ' - ' . $property->currency_symbol . $high_weekly_rate . ' ' . __('per week', $this->localizationDomain) . '<br/>';
    if ($this->options['p_lodgix_display_monthly_rates'] && $low_monthly_rate > 0) $single_property.= __('Monthly Rate', $this->localizationDomain) . ': ' . $property->currency_symbol . $low_monthly_rate . ' - ' . $property->currency_symbol . $high_monthly_rate . ' ' . __('per month', $this->localizationDomain) . '<br/>';
	$single_property.= '<br />';
}
else if ($this->options['p_lodgix_rates_display'] == 1)
{
    include "merged_rates.php";
	$single_property.= '<br />';
}
$single_property.= '- ' . __('Rate varies due to seasonality and holidays', $this->localizationDomain) . '.<br/>';
$single_property.= '- ' . __('Please select your dates on our online booking calendar for an exact quote', $this->localizationDomain) . '.<br/>';
$single_property.= '</div>';
$single_property.= "[lodgix_calendar " . $property->id . " " . $property->owner_id . " '" . $static . "' " . $property->allow_booking . " " . $this->options['p_lodgix_display_single_instructions'] . " en]";
$taxes = $wpdb->get_results("SELECT * FROM " . $this->taxes_table . " WHERE property_id=" . $property->id);
$fees = $wpdb->get_results("SELECT * FROM " . $this->fees_table . " WHERE property_id=" . $property->id);
$deposits = $wpdb->get_results("SELECT * FROM " . $this->deposits_table . " WHERE property_id=" . $property->id);
if ($policies || $taxes || $fees || $deposits)
{
    $single_property.= "<div id='property_policies'><h2>" . __('Policies', $this->localizationDomain) . "</h2><table width='98%'>";
    if ($taxes)
    {
        $single_property.= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>" . __('Taxes', $this->localizationDomain) . "</b><br /><br />";
        foreach($taxes as $tax)
        {
            $single_property.= __($tax->title, $this->localizationDomain). ' - ';
            if ($tax->is_flat == 1)
            {
                $single_property.= $property->currency_code . number_format($tax->value, 2);
                if ($tax->frequency == 'ONETIME')
                {
                    $single_property.= ' - ' . __('One Time', $this->localizationDomain);
                }
                else
                {
                    $single_property.= ' - ' . __('Daily', $this->localizationDomain);
                }
            }
            else
            {
                $single_property.= number_format($tax->value, 2) . "%";
            }
            $single_property.= "<br />";
        }
        $single_property.= "</span></td></tr>";
        $single_property.= "<tr><td>&nbsp;</td></tr>";
    }
    if ($fees)
    {
        $single_property.= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>" . __('Fees', $this->localizationDomain) . "</b><br /><br />";
        foreach($fees as $fee)
        {
            $single_property.= __($fee->title, $this->localizationDomain) . ' - ';
            if ($fee->is_flat == 1)
            {
                $single_property.= $property->currency_code . number_format($fee->value, 2);
            }
            else
            {
                $single_property.= number_format($fee->value, 2) . "%";
            }
            if ($fee->tax_exempt == 1)
            {
                $single_property.= ' - ' . __('Tax Exempt', $this->localizationDomain);
            }
            $single_property.= "<br />";
        }
        $single_property.= "</span></td></tr>";
        $single_property.= "<tr><td>&nbsp;</td></tr>";
    }
    if ($deposits)
    {
        $single_property.= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>" . __('Deposits', $this->localizationDomain) . "</b><br /><br />";
        foreach($deposits as $deposit)
        {
            $single_property.= __($deposit->title, $this->localizationDomain) . ' - ';
            $single_property.= $property->currency_code . number_format($deposit->value, 2);
            $single_property.= "<br />";
        }
        $single_property.= "</span></td></tr>";
        $single_property.= "<tr><td>&nbsp;</td></tr>";
    }
    if ($policies)
    {
        foreach($policies as $policy)
        {
            if ($policy->cancellation_policy)
            {
                $single_property.= "<tr><td class='lodgix_policies'><b>" . __('Cancellation Policy', $this->localizationDomain) . "</b><br /><br />" . str_replace(array(
                    "\r\n",
                    "\n",
                    "\r"
                ) , '<br />', $policy->cancellation_policy) . "<br><br><i>Last updated, " . $this->format_date($property->date_modified) . "</i></td></td></tr>";
                $single_property.= "<tr><td>&nbsp;</td></tr>";
            }
            if ($policy->deposit_policy)
            {
                $single_property.= "<tr><td class='lodgix_policies'><b>" . __('Deposit Policy', $this->localizationDomain) . "</b><br /><br />" . str_replace(array(
                    "\r\n",
                    "\n",
                    "\r"
                ) , '<br />', $policy->deposit_policy) . "<br><br><i>Last updated, " . $this->format_date($property->date_modified) . "</i></td></td></tr>";
                $single_property.= "<tr><td>&nbsp;</td></tr>";
            }
            if ($policy->single_unit_helptext)
            {
                $single_unit_helptext = str_replace(array(
                    "\r\n",
                    "\n",
                    "\r"
                ) , '<br />', $policy->single_unit_helptext);
                $single_property.= "<tr><td>&nbsp;</td></tr>";
            }
            else
            {
                $single_unit_helptext = '';
            }
        }
    }
    $single_property.= "</table></div>";
}
$single_property.= '<script type="text/javascript">tb_pathToImage = "/wp-includes/js/thickbox/loadingAnimation.gif";tb_closeImage = "/wp-includes/js/thickbox/tb-close.png";</script>';
$single_property.= '<div id="lodgix_property_location"><h2>' . __('Property Location', $this->localizationDomain) . '</h2><div id="map_canvas" style="width: 100%; height: 300px"></div></div>';
$single_property.= '<div id="lodgix_photo"><a id="lodgix_aGallery" href="#Gallery"></a>     
                        <div id="lodgix_photo_top"></div>      
                        <div id="lodgix_photo_body">
                        <div id="lodgix_photo_zoom"></div>       
                        <div align="left" style="width:100%;">
                        <table class="lodgix_gallery" cellpadding="0" cellspacing="12">';
$counter = 0;
$num_pics = 2;
$single_property.= '<h2>' . __('Property Images', $this->localizationDomain) . '</h2>';

foreach($photos as $photo)
{
	
	$photo_url = $photo->url;
	
    if (($counter % $num_pics == 0) && ($counter != 0))
    {
        $single_property.= "<tr>";
    }
    $single_property.= '<td valign="top" align="center" style="border-bottom: 0;">';
    $single_property.= '<a href="' . $photo_url . '" class="thickbox"  rel="gallery-images">
			<img src="' . $photo->thumb_url . '" height="150" width="200"  style="cursor:url(' . $this->p_plugin_path . 'images/zoomin.cur), pointer" border=0 title="' . $photo->caption . '"></a>
            <div class="image_desc"></div> 
            </td>
               <div style="align:left"></div>
            </td>';
    $counter++;
}
$single_property.= '</tr></table></div></div><div id="lodgix_photo_bottom"></div></div>';
$single_property.= '<div class="ldgxPowered">' . $link . ' by Lodgix.com</div></div>';
$single_property.= '<script src="https://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>';
$single_property.= '<script type="text/javascript"><!--//--><![CDATA[//><!--        
function lodgix_gmap_initialize() {    
    var lodgixLatLng = new google.maps.LatLng(' . $property->latitude . ', ' . $property->longitude . ');
    var lodgixMapOptions = {
       zoom: ' . $p_lodgix_gmap_zoom_level . ',
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
//--><!]]></script>';
?>
