<?php

if ($this->options['p_lodgix_gmap_zoom_level'] == 0) {
	$p_lodgix_gmap_zoom_level = 13;
} else {
    $p_lodgix_gmap_zoom_level = $this->options['p_lodgix_gmap_zoom_level'];
}

$property_area = "";
if ($property->area != "") {
    $property_area = " at " . $property->area;
}
$property_city = "";
if ($property->city != "") {
    $property_city = " in " . $property->city;
}
$min_daily_rate = "";
if (($property->min_daily_rate > 0) && $this->options['p_lodgix_display_daily_rates']) {
    $min_daily_rate = '<div class="ldgxPropBadgeRatesDaily">' . __('from', $this->localizationDomain) . ' ' . $property->currency_symbol . $property->min_daily_rate . __(' per /nt', $this->localizationDomain) . '</div>';
}
$min_weekly_rate = "";
if (($property->min_weekly_rate > 0) && $this->options['p_lodgix_display_weekly_rates']) {
    $min_weekly_rate = '<div class="ldgxPropBadgeRatesWeekly">' . __('from', $this->localizationDomain) . ' ' . $property->currency_symbol . $property->min_weekly_rate . __(' per /wk', $this->localizationDomain) . '</div>';
}
$min_monthly_rate = "";
if (($property->min_monthly_rate > 0) && $this->options['p_lodgix_display_monthly_rates']) {
    $min_monthly_rate = '<div class="ldgxPropBadgeRatesMonthly">' . __('from', $this->localizationDomain) . ' ' . $property->currency_symbol . $property->min_monthly_rate . __(' per /mo', $this->localizationDomain) . '</div>';
}
$pets = "";
if ($property->pets) {
    $pets = "display:none;";
}
$smoking = "";
if ($property->smoking) {
    $smoking = "display:none;";
}
$contact_var_name = 'p_lodgix_contact_url_' . $this->sufix;
if ($this->options[$contact_var_name] != "") {
    $mail_url = $this->options[$contact_var_name];
    if (strpos($mail_url, '__PROPERTY__') != false) {
        $mail_url = str_replace('__PROPERTY__', $property->description, $mail_url);
    }
    if (strpos($mail_url, '__PROPERTYID__') != false) {
        $mail_url = str_replace('__PROPERTYID__', $property->id, $mail_url);
    }
    $mail_icon =
        '<a title="Contact Us" style="margin-left:5px;" href="' . $mail_url
        . '" class="ldgxButton ldgxButtonMail ldgxButtonMail'
        . $this->ICON_SET_CLASS[$this->options['p_lodgix_icon_set']]
        . '"></a>';
} else {
    $mail_icon = '';
}
if ($property->video_url != '') {
    $video_icon =
        '<span class="ceebox"><a style="margin-left:5px;" href="' . $property->video_url
        . '" class="ldgxButton ldgxButtonVideo ldgxButtonVideo' . $this->ICON_SET_CLASS[$this->options['p_lodgix_icon_set']]
        . '"></a></span>';
} else {
    $video_icon = '';
}
if ($property->virtual_tour_url != '') {
    $virtual_tour_icon =
        '<a title="" target="_blank" style="margin-left:5px;" href="'
        . $property->virtual_tour_url . '" class="ldgxButton ldgxButtonTour ldgxButtonTour'
        . $this->ICON_SET_CLASS[$this->options['p_lodgix_icon_set']]
        . '"></a>';
} else {
    $virtual_tour_icon = '';
}
$bedrooms = $property->bedrooms . ' ' . __('Bedrooms', $this->localizationDomain);
if ($property->bedrooms == 0) {
    $bedrooms = 'Studio';
}
$static = '';
if ($property->allow_booking == 0) {
    $static = '_static';
}
$beds_text = "";
if ($this->options['p_lodgix_display_beds'] && $property->beds_text != "") {
    $beds_text = ' <span class="ldgxPropertyInfoBeds">' . __('This property has', $this->localizationDomain) . ' '
        . $property->beds_text . '.</span>';
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
if ($property->really_available && $property->allow_booking) {
    $booklink = '<div class="ldgxBookNow"><a href="' . $property->booklink . '">' . __('Book Now', $this->localizationDomain) . '</a></div>';
} else {
//    $booklink = '<div class="ldgxBookNow"><a href="javascript:void(0)" onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'select\',\'2\')">' . __('Book Now', $this->localizationDomain) . '</a></div>';
}
$single_property .= '

<div id="content_lodgix_wrapper" class="ldgxPropertyTabbedWrapper">

    <div class="ldgxPropBadge">
        <div class="ldgxPropBadgeLine">
            <div class="ldgxPropBadgeTitle">
                ' . $property->description . $property_area . '
                <div class="ldgxPropBadgeRooms">
                    <span class="ldgxPropBadgeRoomsBeedrooms">' . $bedrooms . '</span>
                    <span class="ldgxPropBadgeRoomsSeparator"></span>
                    <span class="ldgxPropBadgeRoomsBathrooms">' . $property->bathrooms . ' ' . __('Bathrooms', $this->localizationDomain) . '</span>
                    <span class="ldgxPropBadgeRoomsSeparator"></span>
                    <span class="ldgxPropBadgeRoomsType">' . $property->proptype . '</span>
                    <span class="ldgxPropBadgeRoomsCity">' . $property_city . '</span>
                </div>
            </div>
            <div class="ldgxPropBadgeRates">' . $min_daily_rate . $min_weekly_rate . $min_monthly_rate . $booklink . '</div>
            <div class="ldgxPropBadgeSeparator"></div>
        </div>
        <hr>
        <div class="ldgxPropBadgeLine">
            <div class="ldgxPropBadgeIconsLeft">
                ' . $video_icon . $virtual_tour_icon . $mail_icon . '
            </div>
            <div class="ldgxPropBadgeIconsRight">
                <span class="ldgxButton ldgxButtonPetsNo ldgxButtonPetsNo' . $this->ICON_SET_CLASS[$this->options['p_lodgix_icon_set']] . '" style="' . $pets . '"></span>
                <span class="ldgxButton ldgxButtonSmokeNo ldgxButtonSmokeNo' . $this->ICON_SET_CLASS[$this->options['p_lodgix_icon_set']] . '" style="' . $smoking . '"></span>
            </div>
            <div class="ldgxPropBadgeSeparator"></div>
        </div>
    </div>

    <link rel="stylesheet" href="' . $this->p_plugin_path . 'css/jquery-ui-1.8.17.custom.css" type="text/css">
    <script>
        jQueryLodgix(document).ready(function(){
            jQueryLodgix("#lodgix_tabbed_content").tabs({
                create: function(event, ui) {
                    [lodgix_slider_init]
                },
                show: function(event, ui) {
                    if (ui.index == 1 && typeof lodgixUnitCalendarInstance != "undefined") {
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
    </script>

    <div id="lodgix_tabbed_content_box" class="ldgxTabbedContentBox">
        <div id="lodgix_tabbed_content" class="ldgxTabbedContent">
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

            <div class="ldgxMobileTab" onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'1\',this)">
                ' . __('Details', $this->localizationDomain) . '
            </div>
            <div id="lodgix_tabbed_content-1">
                <div id="lodgix_tabbed_lodgix_property_details">
                    <h2>' . __('Property Details', $this->localizationDomain) . '</h2>

                    [lodgix_slider ' . $property->id . ']

                    <div class="ldgxPropertyInfoBlock">
                        <div class="ldgxPropertyInfoDesc">
                            ' . str_replace(array("\r\n","\n","\r"), '<br>', $property->description_long) . '
                        </div>
                        <div class="ldgxPropertyInfoDetails">
                            ' . str_replace(array("\r\n","\n","\r") , '<br>', $property->details) . $beds_text . '
                        </div>
                    </div>
                </div>
                <div class="lodgix_tabbed_clearFix"></div>
            </div>

            <div class="ldgxMobileTab" onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'2\',this)">
                ' . __('Booking Calendar', $this->localizationDomain) . '
            </div>
            <div id="lodgix_tabbed_content-2">
                [lodgix_calendar ' . $property->id . ' ' . $property->owner_id . ' "' . $static . '" ' . $property->allow_booking . ' ' . $this->options['p_lodgix_display_single_instructions'] . ' en]
            </div>

            <div class="ldgxMobileTab" onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'3\',this)">
                ' . __('Location', $this->localizationDomain) . '
            </div>
            <div id="lodgix_tabbed_content-3">
                <div id="lodgix_tabbed_lodgix_property_location">
                    <h2>' . __('Property Location', $this->localizationDomain) . '</h2>
                    <div id="lodgix_tabbed_map_canvas" style="width: 100%; height:500px"></div>
                </div>
            </div>

            <div class="ldgxMobileTab" onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'4\',this)">
                ' . __('Amenities', $this->localizationDomain) . '
            </div>
            <div id="lodgix_tabbed_content-4">
                <div id="lodgix_tabbed_lodgix_property_amenities">
                    <h2>' . __('Amenities', $this->localizationDomain) . '</h2>
                    <ul class="lodgix_tabbed_amenities">
';
if (count($amenities_list) >= 1) {
    $counter = 0;
    foreach($amenities_list as $amenity) {
        $single_property.= '<li>' . $amenity . '</li>';
        $counter++;
    }
}
$single_property.= '
                        <span class="lodgix_tabbed_content_clear"></span>
                    </ul>
                </div>
            </div>

            <div class="ldgxMobileTab" onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'5\',this)">
                ' . __('Policies', $this->localizationDomain) . '
            </div>
            <div id="lodgix_tabbed_content-5">
                <div id="lodgix_tabbed_lodgix_property_policies">
                    <h2>' . __('Policies', $this->localizationDomain) . '</h2>
                    <div id="lodgix_policies_rates">
';
if (($this->options['p_lodgix_rates_display'] == 0) || (!$merged_rates)) {
    if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0) {
        $single_property.= __('Daily Rate', $this->localizationDomain) . ': '
            . $property->currency_symbol . $low_daily_rate . ' - '
            . $property->currency_symbol . $high_daily_rate . ' ' . __('per night', $this->localizationDomain)
            . '<br>';
    }
    if ($this->options['p_lodgix_display_weekly_rates'] && $low_weekly_rate > 0) {
        $single_property.= __('Weekly Rate', $this->localizationDomain) . ': '
            . $property->currency_symbol . $low_weekly_rate . ' - '
            . $property->currency_symbol . $high_weekly_rate . ' ' . __('per week', $this->localizationDomain)
            . '<br>';
    }
    if ($this->options['p_lodgix_display_monthly_rates'] && $low_monthly_rate > 0) {
        $single_property.= __('Monthly Rate', $this->localizationDomain) . ': '
            . $property->currency_symbol . $low_monthly_rate . ' - '
            . $property->currency_symbol . $high_monthly_rate . ' ' . __('per month', $this->localizationDomain)
            . '<br>';
    }
    $single_property .= '<br>';
} else if ($this->options['p_lodgix_rates_display'] == 1) {
    include "merged_rates.php";
}
$single_property.= '
                        - ' . __('Rate varies due to seasonality and holidays', $this->localizationDomain) . '.<br>
                        - ' . __('Please select your dates on our online booking calendar for an exact quote', $this->localizationDomain) . '.<br>
                    </div>
';
$taxes = $wpdb->get_results("SELECT * FROM " . $this->taxes_table . " WHERE property_id=" . $property->id);
$fees = $wpdb->get_results("SELECT * FROM " . $this->fees_table . " WHERE property_id=" . $property->id);
$deposits = $wpdb->get_results("SELECT * FROM " . $this->deposits_table . " WHERE property_id=" . $property->id);
if ($policies || $taxes || $fees || $deposits) {
    $single_property.= "<br><table width='98%'>";
    if ($taxes) {
        $single_property.= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>" . __('Taxes', $this->localizationDomain) . "</b><br><br>";
        foreach($taxes as $tax) {
            $single_property.= __($tax->title, $this->localizationDomain) . ' - ';
            if ($tax->is_flat == 1) {
                $single_property.= $property->currency_code . number_format($tax->value, 2);
                if ($tax->frequency == 'ONETIME') {
                    $single_property.= ' - ' . __('One Time', $this->localizationDomain);
                } else {
                    $single_property.= ' - ' . __('Daily', $this->localizationDomain);
                }
            } else {
                $single_property.= number_format($tax->value, 2) . "%";
            }
            $single_property.= "<br>";
        }
        $single_property.= "</span></td></tr>";
        $single_property.= "<tr><td>&nbsp;</td></tr>";
    }
    if ($fees) {
        $single_property.= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>" . __('Fees', $this->localizationDomain) . "</b><br><br>";
        foreach($fees as $fee) {
            $single_property.= __($fee->title, $this->localizationDomain) . ' - ';
            if ($fee->is_flat == 1) {
                $single_property.= $property->currency_code . number_format($fee->value, 2);
            } else {
                $single_property.= number_format($fee->value, 2) . "%";
            }
            if ($fee->tax_exempt == 1) {
                $single_property.= ' - ' . __('Tax Exempt', $this->localizationDomain);
            }
            $single_property.= "<br>";
        }
        $single_property.= "</span></td></tr>";
        $single_property.= "<tr><td>&nbsp;</td></tr>";
    }
    if ($deposits) {
        $single_property.= "<tr><td class='lodgix_policies'><span class='lodgix_policies_span'><b>" . __('Deposits', $this->localizationDomain) . "</b><br><br>";
        foreach($deposits as $deposit) {
            $single_property.= __($deposit->title, $this->localizationDomain) . ' - ';
            $single_property.= $property->currency_code . number_format($deposit->value, 2);
            $single_property.= "<br />";
        }
        $single_property.= "</span></td></tr>";
        $single_property.= "<tr><td>&nbsp;</td></tr>";
    }
    if ($policies) {
        foreach($policies as $policy) {
            if ($policy->cancellation_policy) {
                $single_property.= "<tr><td class='lodgix_policies'><b>" . __('Cancellation Policy', $this->localizationDomain) . "</b><br><br>" . str_replace(array(
                    "\r\n",
                    "\n",
                    "\r"
                ) , '<br>', $policy->cancellation_policy) . "<br><br><i>Last updated " . $this->format_date($property->date_modified) . "</i></td></td></tr>";
            }
            if ($policy->deposit_policy) {
                $single_property.= "<tr><td class='lodgix_policies'><br /><b>" . __('Deposit Policy', $this->localizationDomain) . "</b><br><br>" . str_replace(array(
                    "\r\n",
                    "\n",
                    "\r"
                ) , '<br>', $policy->deposit_policy) . "<br><br><i>Last updated " . $this->format_date($property->date_modified) . "</i></td></td></tr>";
            }
            if ($policy->single_unit_helptext) {
                $single_unit_helptext = str_replace(array(
                    "\r\n",
                    "\n",
                    "\r"
                ) , '<br>', $policy->single_unit_helptext);
            } else {
                $single_unit_helptext = '';
            }
            $single_property.= "<tr><td>&nbsp;</td></tr>";
        }
    }
    $single_property.= "</table>";
}
$single_property.= '
                </div>
            </div>

            <div class="ldgxMobileTab" onclick="jQueryLodgix(\'#lodgix_tabbed_content\').tabs(\'toggle\',\'6\',this)">
                ' . __('Reviews', $this->localizationDomain) . '
            </div>
            <div id="lodgix_tabbed_content-6">
                <div id="lodgix_tabbed_lodgix_property_reviews">
                    <h2>' . __('Guest Reviews', $this->localizationDomain) . '</h2>

                    [lodgix_reviews ' . $property->id . ' ' . $this->sufix . ']

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
<script type="text/javascript">
    function lodgix_gmap_initialize() {
        var lodgixLatLng = new google.maps.LatLng(' . $property->latitude . ', ' . $property->longitude . ');
        var lodgixMapOptions = {
            zoom: ' . $p_lodgix_gmap_zoom_level . ',
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
</script>
';
