<?php

$pets = '<div class="lodgix_pets_friendly_no">';
if ($property->pets == 1)
  $pets = '<div class="lodgix_pets_friendly_yes">';
$sql = "SELECT * FROM " . $lang_properties_table . " WHERE id=" . $property->id;
$german_details = $wpdb->get_results($sql);
$german_details = $german_details[0];
$post_id_de = $wpdb->get_var("select page_id from " . $lang_pages_table . " WHERE property_id=" . $property->id . ";"); 
$permalink = get_permalink($post_id_de);
$table_name = $wpdb->prefix . "lodgix_lang_properties";

$icons = 'none';
$style= '';
if ($this->options['p_lodgix_display_icons'])
{
	$icons = 'block';
	$style = '<style>.lodgix_comments div { height: 220px;}</style>';
}

$p_plugin_path = str_replace(home_url(),'',WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__))); 

$vacation_rentals = $style . '
<table cellspacing="0" class="lodgix_listing">
<tbody><tr><td class="lodgix_border_top_left"><div></div></td><td colspan="2" class="lodgix_border_top"><div></div></td><td class="lodgix_border_top_right"><div></div></td></tr>
<tr>
  <td class="lodgix_border_left"><div></div></td>
  <td class="lodgix_image_cell"><a href="'. $permalink .'"><img border="0" alt="" src="' . $property->main_image_thumb . '"></a>
  <div style="display:' . $icons .';"><a href="' . $permalink . '#booking"><img src="' . $p_plugin_path  . '/images/Lodgix200x50.png"></a></div>
  <table class="lodgix_image_cell_icons" border="0" cellspacing="0" style="display:' . $icons . ';">
  	<tr><td class="lodgix_google_map_icon"><a href="' . $permalink . '#map_canvas"><img src="' . $p_plugin_path  . '/images/map_50.png"></a></td><td style="width:25px;">&nbsp;</td>
  			<td class="lodgix_contact_us_icon"><a href="' . $this->options['p_lodgix_contact_url'] . '"><img src="' . $p_plugin_path  . '/images/mail_50.png"></a></td><td style="width:25px;">&nbsp;</td>
  			<td class="lodgix_details_icon"><a href="' . $permalink . '"><img src="' . $p_plugin_path  . '/images/kappfinder_50.png"></a></td></tr></table></td><td class="lodgix_description_cell">
  			<div class="lodgix_description">
  	<div class="lodgix_name">
  			<a href="'. $permalink .'">' . $german_details->description . '</a></div><div>' . $property->area . '</div><div class="lodgix_comments">
      <div>' . str_replace('\n','<br />',$german_details->details) . '</div> 
    </div>
  <td class="lodgix_border_right"><div></div></td>
</tr>
<tr>
  <td class="lodgix_border_left"><div></div></td>
  <td colspan="2">
      <table class="lodgix_property_features">
				<tbody><tr>
					<td class="lodgix_gray_box">Schlafzimmer</td>
					<td class="lodgix_gray_box">Badezimmer</td>
					<td class="lodgix_gray_box">Mietart</td>
					<td class="lodgix_gray_box">Haustiere?</td>
					<td class="lodgix_gray_lower">Tageskurs</td>
					<td class="lodgix_gray_medium">Wochenpreis</td>
					<td class="lodgix_gray_highest">Monatspreis</td>
				</tr>
				<tr>
					<td class="lodgix_gray_box">' . $property->bedrooms . '</td>
					<td class="lodgix_gray_box">' . $property->bathrooms . '</td>
					<td class="lodgix_gray_box">' . $property->proptype . '</td>
					
					 <td class="lodgix_gray_box">' . $pets . '</div></td> 
					
					<th class="lodgix_gray_lower">' . $low_daily_rate . ' - ' . $high_daily_rate . '</th>
					<th class="lodgix_gray_medium">' . $low_weekly_rate . ' - ' . $high_weekly_rate . '</th>
					<th class="lodgix_gray_highest">' . $low_monthly_rate . ' - ' . $high_monthly_rate . '</th>
				</tr>
			</tbody></table>    
  </td>
  <td class="lodgix_border_right"><div></div></td>
</tr>
<tr><td class="lodgix_border_bot_left"><div></div></td><td colspan="2" class="lodgix_border_bot"><div></div></td><td class="lodgix_border_bot_right"><div></div></td></tr>
</tbody></table>

';

?>