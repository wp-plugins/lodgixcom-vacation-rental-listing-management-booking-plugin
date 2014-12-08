<?php
$sql = "SELECT * FROM " . $this->reviews_table . " WHERE language_code='" . $this->sufix . "' AND property_id=" . $property->id . ' ORDER BY date DESC';

$reviews = $wpdb->get_results($sql);
$sql = "SELECT * FROM " . $this->pictures_table . " WHERE property_id=" . $property->id . ' ORDER BY position';
$photos = $wpdb->get_results($sql);
$property_area = "";
if ($property->area != "") $property_area = " at " . $property->area;
$property_city = "";
if ($property->city != "") $property_city = " in " . $property->city;
$min_weekly_rate = "";
if (($property->min_weekly_rate > 0) && $this->options['p_lodgix_display_weekly_rates']) $min_weekly_rate = __('from', $this->localizationDomain) . ' ' . $property->currency_symbol . $property->min_weekly_rate . __(' per /wk', $this->localizationDomain) . '<br />';
$min_daily_rate = "";
if (($property->min_daily_rate > 0) && $this->options['p_lodgix_display_daily_rates']) $min_daily_rate = __('from', $this->localizationDomain) . ' ' . $property->currency_symbol . $property->min_daily_rate . __(' per /nt', $this->localizationDomain) . '<br />';
$pets = "";
if ($property->pets) $pets = "display:none;";
$smoking = "";
if ($property->smoking) $smoking = "display:none;";
$mail_icon = '';
if ($this->options['p_lodgix_contact_url'] != "")
{
    $mail_url = $this->options['p_lodgix_contact_url'];
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
$static = '';
if ($property->allow_booking == 0)
{
    $static = '_static';
}
$beds_text = "";
if ($property->beds_text != "")
{
    $beds_text = ' This property has ' . $property->beds_text . '.';
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
                

$low_weekly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT
IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 7 AND
property_id = " . $property->id . ";", null));
$high_weekly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT
IFNULL(MAX(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 7 AND
property_id = " . $property->id . ";", null));
$low_monthly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT
IFNULL(MIN(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 30 AND
property_id = " . $property->id . ";", null));
$high_monthly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT
IFNULL(MAX(default_rate), 0) FROM " . $this->rates_table . " WHERE min_nights = 30 AND
property_id = " . $property->id . ";", null));
if ($property->really_available && $property->allow_booking)
{
    $booklink = $property->booklink;
    $booklink = '<a href="' . $booklink . '" class="ldgxBookNow">' . __('Book Now', $this->localizationDomain) . '</a>';
}
else
{
    $booklink = "javascript:jQueryLodgix('#lodgix_tabbed_content').tabs('select','2')";
    $booklink = '<a href="javascript:void(0);" onclick="' . $booklink . '"
class="ldgxBookNow">' . __('Book Now', $this->localizationDomain) . '</a>';
}
$single_property.= '<div id="content_lodgix_wrapper">';
$single_property.= '

<div class="ldgxPropBadge">

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

' . $video_icon . $virtual_tour_icon . $mail_icon . '

</div>

<div class="ldgxPropBadgeIconsRight">

<span id="lodgix_no_pets_icon"  style="' . $pets . '"></span><span id="lodgix_no_smoke_icon" style="' . $smoking . '"></span>

</div>

<div class="ldgxPropBadgeSeparator"></div>

</div>

</div>

';
$single_property.= '<link rel="stylesheet" href="' . $this->p_plugin_path . 'css/jquery-ui-1.8.17.custom.css" type="text/css" />';
$single_property.= '<script><!--//--><![CDATA[//><!--
jQueryLodgix(document).ready(function(){
		jQueryLodgix("#lodgix_tabbed_content").tabs({
			create: function( event, ui ) {
				var el = jQueryLodgix("#merged_rates_table");
				if (el) {
					
				}
			},
			show: function(event, ui) {
				if (ui.index == 1 && typeof(lodgixUnitCalendarInstance) != "undefined") {
					lodgixUnitCalendarInstance.resize();
				}
			}
		});
		if(document.location.hash == "#booking") {
			window.scrollTo(0,0);
			jQueryLodgix("#lodgix_tabbed_content").tabs("select",1);
	    }
		if(document.location.hash == "#map_canvas") {
			jQueryLodgix("#lodgix_tabbed_content").tabs("select",2);
		}
});
//--><!]]></script>';

$single_property.= '<div id="lodgix_tabbed_content_box">
<div id="lodgix_tabbed_content">
	<ul class="ldgxTabs">
		<li id="lodgix_tabbed_details">
			<a href="#lodgix_tabbed_content-1">' . __('Details', $this->localizationDomain) . '</a>
		</li>
		<li id="lodgix_tabbed_booking_calendar">
			<a href="#lodgix_tabbed_content-2">' . __('Booking Calendar', $this->localizationDomain) . '</a>
		</li>
		<li id="lodgix_tabbed_location">
			<a href="#lodgix_tabbed_content-3">' . __('Location', $this->localizationDomain) . '</a>
		</li>
		<li id="lodgix_tabbed_amenities">
			<a href="#lodgix_tabbed_content-4">' . __('Amenities', $this->localizationDomain) . '</a>
		</li>
		<li id="lodgix_tabbed_policies">		
			<a href="#lodgix_tabbed_content-5">' . __('Policies', $this->localizationDomain) . '</a>
		</li>
		<li id="lodgix_tabbed_reviews">
			<a href="#lodgix_tabbed_content-6">' . __('Reviews', $this->localizationDomain) . '</a>
		</li>
	</ul>
							
	<div class="ldgxMobileTab" onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'1\',this)">' . __('Details', $this->localizationDomain) . '</div>
		<div id="lodgix_tabbed_content-1">
			<div id="lodgix_tabbed_lodgix_property_details">
				<h2>' . __('Property Details', $this->localizationDomain) . '</h2>';

$single_property.= '<br /><center><div id="lodgix-image-gallery" class="royalSlider default"><ul class="royalSlidesContainer dragme">';
foreach($photos as $photo)
{
	
	$photo_url = $photo->url;

	
    $single_property.= '<li class="royalSlide" data-thumb="' . $photo->thumb_url . '" data-src="' . $photo_url . '">';
    if ($photo->caption != '')
    {
        $single_property.= '<div class="royalCaption">' . $photo->caption . '</div>';
    }
    $single_property.= '</li>';
}

$single_property.= '</ul></div></center><br /><p>' . str_replace(array("\r\n","\n","\r"), '<br />', $property->description_long) . '<br />'
. str_replace(array("\r\n","\n","\r") , '<br />', $property->details) . $beds_text . '</p>';

$single_property.= '</div>
					<div class="lodgix_tabbed_clearFix"></div>
					</div>

					<div class="ldgxMobileTab" onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'2\',this)">' . __('Booking Calendar', $this->localizationDomain) . '</div>

					<div id="lodgix_tabbed_content-2">';
						$single_property.= "[lodgix_calendar " . $property->id . " " . $property->owner_id . " '" . $static . "' " . $property->allow_booking . " " . $this->options['p_lodgix_display_single_instructions'] . " en]";
						$single_property.= '</div>

					<div class="ldgxMobileTab" onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'3\',this)">' . __('Location', $this->localizationDomain) . '</div>

<div id="lodgix_tabbed_content-3">

<div id="lodgix_tabbed_lodgix_property_location">

<h2>' . __('Property Location', $this->localizationDomain) . '</h2>

<div id="lodgix_tabbed_map_canvas" style="width: 100%; height:500px"></div>

</div>

</div>

<div class="ldgxMobileTab"
onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'4\',this)">' . __('Amenities', $this->localizationDomain) . '</div>

<div id="lodgix_tabbed_content-4">

<div id="lodgix_tabbed_lodgix_property_amenities">

<h2>' . __('Amenities', $this->localizationDomain) . '</h2>

<ul class="lodgix_tabbed_amenities">';
if (count($amenities_list) >= 1)
{
    $counter = 0;
    foreach($amenities_list as $amenity)
    {
        $single_property.= '<li>' . $amenity . '</li>';
        $counter++;
    }
}
$single_property.= '<span
class="lodgix_tabbed_content_clear"></span></ul>



</div>

</div>

<div id="lodgix_tabbed_content-5">';
$single_property.= '<h2>' . __('Policies', $this->localizationDomain) . '</h2><div id="lodgix_policies_rates">';
if (($this->options['p_lodgix_rates_display'] == 0) || (!$merged_rates))
{
    if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0) $single_property.= __('Daily Rate', $this->localizationDomain) . ': ' . $property->currency_symbol . $low_daily_rate . ' - ' . $property->currency_symbol . $high_daily_rate . ' ' . __('per night', $this->localizationDomain) . '<br/>';
    if ($this->options['p_lodgix_display_weekly_rates'] && $low_weekly_rate > 0) $single_property.= __('Weekly Rate', $this->localizationDomain) . ': ' . $property->currency_symbol . $low_weekly_rate . ' - ' . $property->currency_symbol . $high_weekly_rate . ' ' . __('per week', $this->localizationDomain) . '<br/>';
    if ($this->options['p_lodgix_display_monthly_rates'] && $low_monthly_rate > 0) $single_property.= __('Monthly Rate', $this->localizationDomain) . ': ' . $property->currency_symbol . $low_monthly_rate . ' - ' . $property->currency_symbol . $high_monthly_rate . ' ' . __('per month', $this->localizationDomain) . '<br/>';
	$single_property.= '<br />';
}
else if ($this->options['p_lodgix_rates_display'] == 1)
{
    include "merged_rates.php";
	$single_property.= '<br />';
}
$single_property.= '</div>';
$single_property.= '- ' . __('Rate varies due to seasonality and holidays', $this->localizationDomain) . '.<br/>';
$single_property.= '- ' . __('Please select your dates on our online booking calendar for an exact quote', $this->localizationDomain) . '.<br/>';
$single_property.= '';
$taxes = $wpdb->get_results("SELECT * FROM " . $this->taxes_table . " WHERE
property_id=" . $property->id);
$fees = $wpdb->get_results("SELECT * FROM " . $this->fees_table . " WHERE
property_id=" . $property->id);
$deposits = $wpdb->get_results("SELECT * FROM " . $this->deposits_table . " WHERE
property_id=" . $property->id);
if ($policies || $taxes || $fees || $deposits)
{
    $single_property.= "<br /><table width='98%'>";
    if ($taxes)
    {
        $single_property.= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>" . __('Taxes', $this->localizationDomain) . "</b><br /><br />";
        foreach($taxes as $tax)
        {
            $single_property.= __($tax->title, $this->localizationDomain) . ' - ';
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
                ) , '<br />', $policy->cancellation_policy) . "</td></td></tr>";
            }
            if ($policy->deposit_policy)
            {
                $single_property.= "<tr><td class='lodgix_policies'><br /><b>" . __('Deposit Policy', $this->localizationDomain) . "</b><br /><br />" . str_replace(array(
                    "\r\n",
                    "\n",
                    "\r"
                ) , '<br />', $policy->deposit_policy) . "</td></td></tr>";
            }
            if ($policy->single_unit_helptext)
            {
                $single_unit_helptext = str_replace(array(
                    "\r\n",
                    "\n",
                    "\r"
                ) , '<br />', $policy->single_unit_helptext);
            }
            else
            {
                $single_unit_helptext = '';
            }
            $single_property.= "<tr><td>&nbsp;</td></tr>";
        }
    }
    $single_property.= "</table>";
}
$single_property.= '</div>
<div class="ldgxMobileTab"
onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'6\',this)">' . __('Reviews', $this->localizationDomain) . '</div>
<div id="lodgix_tabbed_content-6">
<div id="lodgix_tabbed_lodgix_property_reviews">
<h2>' . __('Guest Reviews', $this->localizationDomain) . '</h2>';
if (count($reviews) >= 1)
{
    $counter = 0;
    foreach($reviews as $review)
    {
        $single_property.= '<p><i>' . str_replace(array(
            "\r\n",
            "\n",
            "\r"
        ) , '<br />', $review->description) . '</i><br />' . $this->format_date($review->date) . ', ' . $review->name . '</p>';
        $counter++;
        if ($counter != count($reviews)) $single_property.= '<center><img src="' . $this->p_plugin_path . 'images/post_separator.png"><br /><br /></center>';
    }
}
$single_property.= '

</div>

</div></div>';
$single_property.= '</div></div>';
$single_property.= '<script
src="https://maps.google.com/maps/api/js?sensor=true"
type="text/javascript"></script>';
$single_property.= '<script type="text/javascript"><!--//--><![CDATA[//><!--
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
//--><!]]></script>';
?>
