<?php

$lodgixoptions = get_option('p_lodgix_options');

$sql = "SELECT * FROM " . $lang_properties_table . " WHERE id=" . $property->id;
$german_details = $wpdb->get_results($sql);
$german_details = $german_details[0];
$post_id_de = $wpdb->get_var("select page_id from " . $lang_pages_table . " WHERE property_id=" . $property->id . ";"); 
$permalink = get_permalink($post_id_de);
$table_name = $wpdb->prefix . "lodgix_lang_properties";

//$p_plugin_path = str_replace(home_url(),'',WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))); 
$p_plugin_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

$mail_url = '';
if ($lodgixoptions['p_lodgix_contact_url_de'] != "")
{
	$mail_url = $lodgixoptions['p_lodgix_contact_url_de'];
	
	if (strpos($mail_url,'__PROPERTY__') != false)
	{
		$mail_url = str_replace('__PROPERTY__',$german_details->description,$mail_url);
	}
  if (strpos($mail_url,'__PROPERTYID__') != false)
	{
		$mail_url = str_replace('__PROPERTYID__',$property->id,$mail_url);
	}		
}

$bedrooms = $property->bedrooms;
if ($property->bedrooms == 0)
{
   $bedrooms = 'Studio';
}

$warning = '';
if ($differentiate && !$property->really_available)
{  	 	
  	$warning = '<span style="color:red;font-size:9px;text-decoration:none;">Rules may exist that prevent this booking from proceeding. Please check availability.</span><br><br>';
}

$vacation_rentals = '
<div class="ldgxShadow">
	<div class="ldgxListingImg">
		<a href="'. $permalink .'"><img border="0" alt="" src="' . $property->main_image_thumb . '"></a>
	</div>
	<div class="ldgxListingName">
		<a href="'. $permalink .'">' . $property->description . '</a>
	</div>
	<div class="ldgxListingBody">
		' . $property->area . ($warning ? '<div class="ldgxListingWarn">' . $warning . '</div>' : '') . '
		<div class="ldgxListingDesc">' . str_replace('\n','<br />',$property->details) . '</div>
	</div>
	<div class="ldgxListingFeats"><div class="ldgxListingFeat">
			<div class="ldgxListingFeatCell">Schlafzimmer</div>
			<div class="ldgxListingFeatCell">' . $bedrooms . '</div>
		</div><div class="ldgxListingFeat">
			<div class="ldgxListingFeatCell">Badezimmer</div>
			<div class="ldgxListingFeatCell">' . $property->bathrooms . '</div>
		</div><div class="ldgxListingFeat">
			<div class="ldgxListingFeatCell">Mietart</div>
			<div class="ldgxListingFeatCell">' . $property->proptype . '</div>
		</div><div class="ldgxListingFeat">
			<div class="ldgxListingFeatCell">Haustiere?</div>
			<div class="ldgxListingFeatCell"><div class="ldgxPets' . ($property->pets == 1 ? 'Yes' : 'No') . '"></div></div>
		</div><div class="ldgxListingFeat">
			<div class="ldgxListingFeatCell ldgxListingFeatDaily">Tageskurs</div>
			<div class="ldgxListingFeatCell ldgxListingFeatDaily">' . $low_daily_rate . ' - ' . $high_daily_rate . '</div>
		</div><div class="ldgxListingFeat">
			<div class="ldgxListingFeatCell ldgxListingFeatWeekly">Wochenpreis</div>
			<div class="ldgxListingFeatCell ldgxListingFeatWeekly">' . $low_weekly_rate . ' - ' . $high_weekly_rate . '</div>
		</div><div class="ldgxListingFeat">
			<div class="ldgxListingFeatCell ldgxListingFeatMonthly">Monatspreis</div>
			<div class="ldgxListingFeatCell ldgxListingFeatMonthly">' . $low_monthly_rate . ' - ' . $high_monthly_rate . '</div>
	</div></div>
	';

	if ($lodgixoptions['p_lodgix_display_availability_icon'] || $lodgixoptions['p_lodgix_display_icons']) {

		$vacation_rentals .= '<div class="ldgxListingButs">';

		if ($lodgixoptions['p_lodgix_display_availability_icon']) {
			$vacation_rentals .= '<div class="ldgxListingButsBlock1">';
			if ($differentiate) {  	 	
				if ($property->really_available) {
	  				$vacation_rentals .= '<a title="Book Now" href="' . $property->booklink .
	  				 '"><img src="' . $p_plugin_path  . '/images/booknow.png"></a>';
		  		} else {
 					$vacation_rentals .= '<a title="Check Availability" href="' . $permalink .
 					 '#booking"><img src="' . $p_plugin_path  . '/images/Lodgix200x50.png"></a>';
				}
			} else {
				$vacation_rentals .= '<a title="Check Availability" href="' . $permalink .
				 '#booking"><img src="' . $p_plugin_path  . '/images/Lodgix200x50.png"></a>';
			}
			$vacation_rentals .= '</div>';
		}
		
		if ($lodgixoptions['p_lodgix_display_icons']) {
			$vacation_rentals .= '<div class="ldgxListingButsBlock2">
				<a title="Display Google Map" href="' . $permalink . '#map_canvas"><img src="' . $p_plugin_path  . '/images/map_50.png"></a>
				<a title="Contact Us" href="' . $mail_url . '"><img src="' . $p_plugin_path  . '/images/mail_50.png"></a>
				<a title="Details" href="' . $permalink . '"><img src="' . $p_plugin_path  . '/images/kappfinder_50.png"></a>
			</div>';
		}

		$vacation_rentals .= '</div>';

	}

$vacation_rentals .= '</div>';
