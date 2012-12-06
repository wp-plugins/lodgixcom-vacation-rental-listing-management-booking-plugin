<?php

$lodgixoptions = get_option('p_lodgix_options');

$pets = '<div class="lodgix_pets_friendly_no">';
if ($property->pets == 1)
  $pets = '<div class="lodgix_pets_friendly_yes">';

$permalink = get_permalink($property->post_id);
$icon_margin_left = '';
$icons = 'display:none;';
if ($lodgixoptions['p_lodgix_display_icons'])
{
	$icons = '';
}
$icon_availability = 'display:none;';
if ($lodgixoptions['p_lodgix_display_availability_icon'])
{
	$icon_availability = '';
	$icon_margin_left = 'margin-left:25px;';
}

$global_icons = '';
if ((!$lodgixoptions['p_lodgix_display_availability_icon']) &&(!$lodgixoptions['p_lodgix_display_icons']))
{
	$global_icons = 'display:none;';
}

$p_plugin_path = str_replace(home_url(),'',WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))); 

$mail_url = '';
if ($lodgixoptions['p_lodgix_contact_url'] != "")
{
	$mail_url = $lodgixoptions['p_lodgix_contact_url'];
	
	if (strpos($mail_url,'__PROPERTY__') != false)
	{
		$mail_url = str_replace('__PROPERTY__',$property->description,$mail_url);
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
<table cellspacing="0" class="lodgix_listing">
<tbody><tr><td class="lodgix_border_top_left"><div></div></td><td colspan="2" class="lodgix_border_top"><div></div></td><td class="lodgix_border_top_right"><div></div></td></tr>
<tr>
  <td class="lodgix_border_left"><div></div></td>
  <td class="lodgix_image_cell"><a href="'. $permalink .'"><img border="0" alt="" src="' . $property->main_image_thumb . '"></a></td><td class="lodgix_description_cell">
  			<div class="lodgix_description">
  	<div class="lodgix_name">
  			<a href="'. $permalink .'">' . $property->description . '</a></div><div>' . $property->area . '</div><div class="lodgix_comments">' . $warning . '
      <div><p>' . str_replace('\n','<br />',$property->details) . '</p></div> 
    </div>
  <td class="lodgix_border_right"><div></div></td>
</tr>
<tr>
  <td class="lodgix_border_left"><div></div></td>
  <td colspan="2">
      <table class="lodgix_property_features">
				<tbody><tr>
					<td class="lodgix_gray_box">Bedrooms</td>
					<td class="lodgix_gray_box">Bathrooms</td>
					<td class="lodgix_gray_box">Rental Type</td>
					<td class="lodgix_gray_box">Pet Friendly</td>
					<td class="lodgix_gray_lower">Daily Rate</td>
					<td class="lodgix_gray_medium">Weekly Rate</td>
					<td class="lodgix_gray_highest">Monthly Rate</td>
				</tr>
				<tr>
					<td class="lodgix_gray_box">' . $bedrooms . '</td>
					<td class="lodgix_gray_box">' . $property->bathrooms . '</td>
					<td class="lodgix_gray_box">' . $property->proptype . '</td>
					
					 <td class="lodgix_gray_box">' . $pets . '</div></td> 
					
					<td class="lodgix_gray_lower">' . $low_daily_rate . ' - ' . $high_daily_rate . '</td>
					<td class="lodgix_gray_medium">' . $low_weekly_rate . ' - ' . $high_weekly_rate . '</td>
					<td class="lodgix_gray_highest">' . $low_monthly_rate . ' - ' . $high_monthly_rate . '</td>
				</tr>
			</tbody></table>    
  </td>
  <td class="lodgix_border_right"><div></div></td>
</tr>
<tr>
  <td class="lodgix_border_left"><div></div></td>
  <td colspan="2"><table class="lodgix_image_cell_icons" border="0" cellspacing="0" style="text-align:center;width:100%;' . $global_icons .'">
  	<tr><td>';
		
		if ($differentiate)
		{  	 	
			if ($property->really_available)
			{
  			$vacation_rentals .= '<a title="Book Now" style="' . $icon_availability . '" href="' . $property->booklink . '"><img src="' . $p_plugin_path  . '/images/booknow.png"></a>';
  		}
  		else
  		{
  		  $vacation_rentals .= '<a title="Check Availability" style="' . $icon_availability . '" href="' . $permalink . '#booking"><img src="' . $p_plugin_path  . '/images/Lodgix200x50.png"></a>';
  		}
  	}
  	else
  	{
  		$vacation_rentals .= '<a title="Check Availability" style="' . $icon_availability . '" href="' . $permalink . '#booking"><img src="' . $p_plugin_path  . '/images/Lodgix200x50.png"></a>';
  	}

$vacation_rentals .= '<a title="Display Google Map" style="' . $icon_margin_left . $icons . '" href="' . $permalink . '#map_canvas"><img src="' . $p_plugin_path  . '/images/map_50.png"></a><a title="Contact Us" style="margin-left:5px;' . $icons . '" href="' . $mail_url . '"><img src="' . $p_plugin_path  . '/images/mail_50.png"></a><a title="Details" style="margin-left:4px;' . $icons . '" href="' . $permalink . '"><img src="' . $p_plugin_path  . '/images/kappfinder_50.png"></a></td></tr>
  	</table></td>
  <td class="lodgix_border_right"><div></div></td> 			
</tr>

<tr><td class="lodgix_border_bot_left"><div></div></td><td colspan="2" class="lodgix_border_bot"><div></div></td><td class="lodgix_border_bot_right"><div></div></td></tr>
</tbody></table>

';

?>