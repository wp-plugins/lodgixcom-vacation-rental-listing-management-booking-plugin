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

$single_property .= '
<script>
	jQueryLodgix(document).ready(function(){
		jQueryLodgix("#lodgix_tabbed_content" ).tabs();
   		jQueryLodgix("img[title]").qtip();
	});
</script>

<div id="lodgix_tabbed_content_box">
    <div id="lodgix_tabbed_content">
        <div class="lodgix_tabbed_headline_area">
            <div class="lodgix_tabbed_headline_areaLeft">
                <h1>Demo Condo #1</h1>
            </div>
            <div class="lodgix_tabbed_headline_areaRight">
                <div class="lodgix_tabbed_lodgix-sleep-icons">
                    <img border="0" alt="" src="http://subustudios.com/mtip/Person-4.png"/>&nbsp;&nbsp;
                    <img border="0" alt="" src="http://subustudios.com/mtip/Bed-Double.png"/>&nbsp;&nbsp;
                    <img border="0" alt="" src="http://subustudios.com/mtip/Bed-Single.png"/>&nbsp;&nbsp;
                    <img border="0" alt="" src="http://subustudios.com/mtip/Sofa-Single.png"/>
                </div>
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
                    <img border="0" alt="" src="http://subustudios.com/mtip/parking.png" title="Parking Available"/>&nbsp;&nbsp;
                    <img border="0" alt="" src="http://subustudios.com/mtip/computer.png" title="Computer" />&nbsp;&nbsp;
                    <img border="0" alt="" src="http://subustudios.com/mtip/internet.png" title="Internet" />&nbsp;&nbsp;
                    <img border="0" alt="" src="http://subustudios.com/mtip/tv.png" title="TV" />&nbsp;&nbsp;
                    <img border="0" alt="" src="http://subustudios.com/mtip/no_smoking.png" title="No Smoking" />&nbsp;&nbsp;
                    <img border="0" alt="" src="http://subustudios.com/mtip/no_pets.png" title="No Pets" />
                </div>
                <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur
                    nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper
                    ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus.
                    Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing.
                    Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam
                    molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor
                    nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
            </div>
            <div class="lodgix_tabbed_clearFix"></div>
        </div>
        <div id="lodgix_tabbed_content-2">
            <div id="lodgix_tabbed_lodgix_property_location">
                <h2>Property Location</h2>
                
            </div>
        </div>
        <div id="lodgix_tabbed_content-3">
            <div id="lodgix_tabbed_lodgix_property_amenities">
                <h2>Amenities</h2>
                <ul class="lodgix_tabbed_amenities">
                    <li>Parking</li>
                    <li>Lakefront</li>
                    <li>Kitchen</li>
                    <li>Hi Speed Internet</li>
                    <li>Gas Grill</li>
                    <li>Fire Pit</li>
                    <li>Dock</li>
                    <li>Charcoal Grill</li>
                    <li>Cable Television</li>
                    <li>Beachfront</li>
                    <li>Access to beach</li>
                    <li>Picnic Table</li>
                    <li>Window A/C</li>
                    <li>Wireless Internet</li>
                </ul>
            </div>
        </div>
        <div id="lodgix_tabbed_content-4">
            <div id="lodgix_tabbed_lodgix_property_rates">
                <h2>Rates</h2>
                <p>Daily Rate: $10 &#8211; $20 per night
                    <br/>Weekly Rate: $4 &#8211; $5 per week
                    <br/>- Rate varies due to seasonality and holidays.
                    <br/>- Please select your dates on our online booking calendar for an exact
                    quote.</p>
                <h2>Policies</h2>
                <p>
                    <strong>Taxes</strong>
                    <br/>Visitors Bureau tax &#8211; 2.00%
                    <br />Michigan Use Tax &#8211; 6.00%</p>
                <p>
                    <strong>Fees</strong>
                    <br/ Accidental Rental Damage Insurance $1500 Coverage &#8211;
                    USD45.00 &#8211; Tax Exempt<br />Cleaning Fee &#8211; 10.00%
                    <br />
                    </span>
                </p>
                <p>
                    <strong>Cancellation Policy</strong>
                    <br/>All cancellations >90 days from your arrival date will result in a full
                    refund less a 3% credit card processing fee if your deposit was paid via
                    credit card. All cancellations with
                    <90 days to your arrival date will only
                    result in a refund (less 3% cc fee) if the unit can be rented again.</p>
                        <p>
                            <strong>Deposit Policy</strong>
                            <br/>All reservations made >30 days from your arrival date require a 50% deposit.
                            Reservations with an arrival data
                            <30 days require 100% payment to confirm
                            your reservation.</p>
            </div>
        </div>
        <div id="lodgix_tabbed_content-5">
            <center>
                <object height="760" width="615" id="flashcontrol" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,5,0,0">
                    <param name="flashvars" value="propertyOwnerID=13&amp;propertyID=60&amp;root_width=615&amp;root_height=760&amp;show_header=1&amp;cell_color_serv=ff0000&amp;cell_color=">
                    <param name="src" value="http://www.lodgix.com/static/calendar12_widget.swf">
                    <param name="wmode" value="transparent">
                    <param name="allowscriptaccess" value="always">
                    <param name="allownetworking" value="external">
                    <embed height="760" width="615" allowscriptaccess="always" allownetworking="external"
                    id="flashcontrolemb" name="flashcontrol" pluginspage="http://www.macromedia.com/go/getflashplayer"
                    src="http://www.lodgix.com/static/calendar12_widget.swf" flashvars="propertyOwnerID=13&amp;propertyID=60&amp;root_width=615&amp;root_height=760&amp;show_header=1&amp;cell_color_serv=ff0000&amp;cell_color="
                    wmode="transparent">
                </object>
            </center>
        </div>
        <div id="lodgix_tabbed_content-6">
            <div id="lodgix_tabbed_lodgix_property_reviews">
                <h2>Guest Reviews</h2>
                <p>
                    <i>This is a great property. Absolutely loved it! We cannot wait to come
                        again!!!!</i>
                    <br />12/30/2010, Joe Schmoe</p>
                <p>
                    <i>Great vacation rental I have even stayed at!! The pool was amazing.</i>
                    <br
                    />06/10/2010, Jack Black</p>
            </div>
        </div>
    </div>
</div>

';







































$single_property .= '<div id="content_lodgix_wrapper">';
$single_property .= '<div id="lodgix_property_badge">';
$single_property .= '<table width="100%">												
													<tr>
														<td id="lodgix_property_badge_title">' .  $property->description . $property_area . '<div id="lodgix_property_badge_rooms">' . $bedrooms . ' | ' . $property->bathrooms .' Bathroom | ' . $property->proptype . $property_city . '</div></td>
														<td id="lodgix_property_badge_rates"><span class="lodgix_nowrap">' . $min_daily_rate . $min_weekly_rate .'<a href="#booking">check rate</a></span></td>
													</tr>
										</table>
										<hr>
										<table width="100%">												
													<tr>
														<td id="lodgix_property_badge_icons_left"><a title="Display Google Map" href="' . $permalink . '#map_canvas"><img src="' . home_url() . $p_plugin_path  . 'images/map_50.png"></a>' . $video_icon . $virtual_tour_icon . $mail_icon . '</td>
														<td id="lodgix_property_badge_icons_right"><span class="lodgix_nowrap"><img src="' . home_url() . $p_plugin_path  . '/images/no_pets.png" style="' . $pets . '"><img src="' . home_url() . $p_plugin_path  . 'images/no_smoke.png" style="' . $smoking . '"></span></td>
													</tr>
										</table>';
$single_property .= '</div>';
$single_property .= '';

$beds_text = "";
if ($property->beds_text != "")
{
	$beds_text = ' This property has ' . $property->beds_text . '.';
}

$single_property .= '<center><ul id="pikame">';
foreach($photos as $photo)
{
      $photo_url = str_replace('media/gallery','photo/0/gallery',$photo->url);
      $single_property .= '<li><a href="' . $photo_url . '"><img width="74px" height="74px" src="' . $photo_url  .'" border=0 title="' . $photo->caption . '"></a><span>' . $photo->caption . '</span></li>';
}
$single_property .= '</ul><p style="text-align:center;"><br/><a title="Check Availability" href="' . $permalink . '#booking"><img src="' . home_url() . $p_plugin_path  . '/images/Lodgix200x50.png"></a></p></center>';

$single_property .= '<div id="lodgix_property_description"><p><h2>Property Description</h2></p>' . $property->description_long . $beds_text . '</div>';
$single_property .= '<div id="lodgix_property_details"><p><h2>Property Details</h2></p>' . $property->details . '</div>';

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
  $single_property .= '<p><i>' . $review->description . '</i></p><p>' . $this->format_date($review->date) . ', ' . $review->name . '</p>';
  $counter++;
  if ($counter != count($reviews))
  	$single_property .= '<center><img src="' . home_url() . $p_plugin_path  . 'images/post_separator.png"></center>';
 }
 $single_property .= '</div><br><br>';
} 



/*

$sql = "SELECT from_date,to_date,default_rate,name FROM " . $rates_table . " WHERE property_id=" . $property->id . " AND (DATE(from_date) >= DATE(NOW()) OR from_date IS NULL) AND min_nights=1 ORDER BY is_default,from_date";
$daily_rates = $wpdb->get_results($sql);

$sql = "SELECT from_date,to_date,default_rate,name FROM " . $rates_table . " WHERE property_id=" . $property->id .  " AND (DATE(from_date) >= DATE(NOW()) OR from_date IS NULL) AND min_nights=7 ORDER BY is_default,from_date";
$weekly_rates = $wpdb->get_results($sql);
 
$sql = "SELECT from_date,to_date,default_rate,name FROM " . $rates_table . " WHERE property_id=" . $property->id .  " AND (DATE(from_date) >= DATE(NOW()) OR from_date IS NULL) AND min_nights=30 ORDER BY is_default,from_date";
$monthly_rates = $wpdb->get_results($sql);
 
$sql = "SELECT min_nights,from_date,to_date FROM " . $rules_table . " WHERE property_id=" . $property->id .  " AND (DATE(from_date) >= DATE(NOW()) OR from_date IS NULL) ORDER BY is_default,from_date";
$rules = $wpdb->get_results($sql);
  

$single_property .= '<div class="lodgix_rentalrates">';

if ((count($daily_rates) != 0) && $this->options['p_lodgix_display_daily_rates'])
{
 $single_property .= "<table width='98%'>";
 $single_property .= "<thead><tr><th align=left style='width:250px;'>Daily Rates</th><th align=left style='width:200px;'>Date</th><th>Rates</th></tr></thead>";
 
 foreach($daily_rates as $daily_rate)
 {
  if ($daily_rate->from_date == NULL) 
    $period = "All Periods";
  else
    $period = $this->format_date($daily_rate->from_date) . " to " . $this->format_date($daily_rate->to_date);
  $single_property .= "<tr><td>" .  $daily_rate->name .  "</td><td>" .  $period . "</td><td align=center>" . $property->currency_code . $daily_rate->default_rate . "</td></tr>"; 
 }
 $single_property .= "</table><br><br>";
} 



if (count($weekly_rates) != 0)
{
 $single_property .= "<table width='98%'>";
 $single_property .= "<thead><tr><th align=left style='width:250px;'>Weekly Rates</th><th align=left style='width:200px;'>Date</th><th>Rates</th></tr></thead>";
 
 foreach($weekly_rates as $weekly_rate)
 {
  if ($weekly_rate->from_date == NULL) 
    $period = "All Periods";
  else
    $period =$this->format_date($weekly_rate->from_date) . " to " . $this->format_date($weekly_rate->to_date);
  $single_property .= "<tr><td>" .  $weekly_rate->name .  "</td><td>" .  $period  . "</td><td align=center>" . $property->currency_code . $weekly_rate->default_rate . "</td></tr>"; 
 }
 $single_property .= "</table><br><br>";
} 
if (count($monthly_rates) != 0)
{
 $single_property .= "<table width='98%'>";
 $single_property .= "<thead><tr><th align=left style='width:250px;'>Monthly Rates</th><th align=left style='width:200px;'>Date</th><th>Rates</th></tr></thead>";
 
 foreach($monthly_rates as $monthly_rate)
 {
  if ($monthly_rate->from_date == NULL) 
    $period = "All Periods";
  else
    $period = $this->format_date($monthly_rate->from_date) . " to " . $this->format_date($monthly_rate->to_date);
  $single_property .= "<tr><td>" .  $monthly_rate->name .  "</td><td>" .  $period  . "</td><td align=center>" . $property->currency_code . $monthly_rate->default_rate . "</td></tr>"; 
 }
 $single_property .= "</table><br><br>";
} 

if (count($rules) != 0)
{
 $single_property .= "<table width='98%'>";
 $single_property .= "<thead><tr><th align=left style='width:250px;'>Minimum Nights</th><th>Nights</th></tr></thead>";
 
 foreach($rules as $rule)
 {
  if ($rule->from_date == NULL) 
    $period = "All Periods";
  else
    $period = $this->format_date($rule->from_date) . " to " . $this->format_date($rule->to_date);
 
  $single_property .= "<tr><td>" . $period  . "</td><td align=center>" . $rule->min_nights . "</td></tr>";
 }
 $single_property .= "</table><br><br><br><br>";
}
*/





$static = '';
if ($property->allow_booking == 0)
{
   $static = '_static';
}   



$low_daily_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";"));
$high_daily_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 1 AND property_id = " . $property->id . ";"));
$low_weekly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";"));
$high_weekly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 7 AND property_id = " . $property->id . ";"));
$low_monthly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MIN(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";"));
$high_monthly_rate = (int)$wpdb->get_var($wpdb->prepare("SELECT IFNULL(MAX(default_rate), 0) FROM " . $rates_table . " WHERE min_nights = 30 AND property_id = " . $property->id . ";"));

$single_property .= '<div id="lodgix_property_rates"><h2>Rates</h2>';
if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0)
	$single_property .= 'Daily Rate:	' . $property->currency_symbol . $low_daily_rate  . ' -  ' . $property->currency_symbol .  $high_daily_rate . ' per night<br/>';
if ($low_weekly_rate > 0)	
	$single_property .= 'Weekly Rate:	' . $property->currency_symbol . $low_weekly_rate  . ' - ' . $property->currency_symbol . $high_weekly_rate . ' per week<br/>';
if ($low_monthly_rate > 0)		
	$single_property .= 'Monthly Rate:	' . $property->currency_symbol . $low_monthly_rate  . ' - ' . $property->currency_symbol  . $high_monthly_rate  . ' per month<br/>';
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
 } 
 
 if ($policies)
 {
   foreach($policies as $policy)
   {
    if ($policy->cancellation_policy)
    {
      $single_property .= "<tr><td class='lodgix_policies'><b>Cancellation Policy</b><br><br>" . $policy->cancellation_policy  . "</td></td></tr>";
    }
    if ($policy->deposit_policy)
    {
      $single_property .= "<tr><td class='lodgix_policies'><b>Deposit Policy</b><br><br>" . $policy->deposit_policy  . "</td></td></tr>";
    } 
    if ($policy->single_unit_helptext)
    {
      $single_unit_helptext = $policy->single_unit_helptext;
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
      $single_property .= '<a href="' . $photo_url . '" class="thickbox"  rel="gallery-images"><img src="' . $photo->thumb_url .'" height="150" width="200"  style="cursor:url(' . home_url() . $p_plugin_path . 'images/zoomin.cur), pointer" border=0 title="' . $photo->caption . '"></a>
            <div class="image_desc"></div> 
            </td>
               <div style="align:left"></div>
            </td>';
                          
        
   $counter++;
}
$single_property .= '</tr></table></div></div><div id="lodgix_photo_bottom"></div></div>';
$single_property .= '<div align="center" style="width:100%;font-size:10px;"><a href="http://www.lodgix.com">Vacation Rental Software</a> by Lodgix.com</div><br></div>';

$single_property .= '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=' . $this->options['p_google_maps_api'] . '"type="text/javascript"></script>';
$single_property .= '<script type="text/javascript">    
    function lodgix_gmap_initialize() {
    //<![CDATA[
      if (GBrowserIsCompatible()) {
        var map = new GMap(document.getElementById("map_canvas"));
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
    </script>
  </head>';
  


?>