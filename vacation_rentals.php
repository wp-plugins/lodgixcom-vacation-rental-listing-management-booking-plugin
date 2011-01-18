<?php

$pets = '<div class="lodgix_pets_friendly_no">';
if ($property->pets == 1)
  $pets = '<div class="lodgix_pets_friendly_yes">';

$permalink = get_permalink($property->post_id);

$vacation_rentals = '
<table cellspacing="0" class="lodgix_listing">
<tbody><tr><td class="lodgix_border_top_left"><div></div></td><td colspan="2" class="lodgix_border_top"><div></div></td><td class="lodgix_border_top_right"><div></div></td></tr>
<tr>
  <td class="lodgix_border_left"><div></div></td>
  <td class="lodgix_image_cell"><center><a href="'. $permalink .'"><img border="0" alt="" src="' . $property->main_image_thumb . '"></a></center></td>
  <td class="lodgix_description_cell"><div class="lodgix_description">
    <div class="lodgix_name"><a href="'. $permalink .'">' . $property->description . '</a></div>    
    <br>    
    <div class="lodgix_comments">
      <div>' . $property->details . '</div> 
    </div>
  </div></td>
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