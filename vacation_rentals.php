<?php
$lodgixoptions = get_option('p_lodgix_options');
if ($differentiate && $property->really_available)
{
    $permalink = add_query_arg(array(
        'bookdates' => $property->bookdates
    ) , $permalink);
}


$mail_url = '';
if ($lodgixoptions['p_lodgix_contact_url_' . $this->sufix] != "")
{
    $mail_url = $lodgixoptions['p_lodgix_contact_url'];
    if (strpos($mail_url, '__PROPERTY__') != false)
    {
        $mail_url = str_replace('__PROPERTY__', $property->description, $mail_url);
    }
    if (strpos($mail_url, '__PROPERTYID__') != false)
    {
        $mail_url = str_replace('__PROPERTYID__', $property->id, $mail_url);
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
    $warning = '<span style="color:red;font-size:9px;text-decoration:none;">' . __('Rules may exist that prevent this booking from proceeding. Please check availability.' . $this->localizationDomain) . '</span><br /><br />';
}
$main_image_thumb = $property->main_image_thumb;
if ($lodgixoptions['p_lodgix_full_size_thumbnails'])
{
    $main_image_thumb = $property->main_image;
}
$vacation_rentals = '
<div class="ldgxShadow">
<div class="ldgxListingImg">
<a href="' . $permalink . '"><img border="0" alt="" src="' . $main_image_thumb . '"></a>
</div>
<div class="ldgxListingName">
<a href="' . $permalink . '">' . $property->description . '</a>
</div>
<div class="ldgxListingBody">
' . $property->area . ($warning ? '<div class="ldgxListingWarn">' . $warning . '</div>' : '') . '
<div class="ldgxListingDesc">' . nl2br($property->details) . '</div>
</div>
<div class="ldgxListingSeparator"></div>
<table class="ldgxFeats">
<tr>
<th width="70" altwidth="40" alt="Beds" class="ldgxListingFeatCell">' . __('Bedrooms', $this->localizationDomain) . '</th>
<td class="ldgxListingFeatCell">' . $bedrooms . '</td>
</tr>
<tr>
<th width="70" altwidth="40" alt="Baths" class="ldgxListingFeatCell">' . __('Bathrooms', $this->localizationDomain) . '</th>
<td class="ldgxListingFeatCell">' . $property->bathrooms . '</td>
</tr>
<tr>
<th width="80" altwidth="40" alt="Type" class="ldgxListingFeatCell">' . __('Rental Type', $this->localizationDomain) . '</th>
<td class="ldgxListingFeatCell">' . $property->proptype . '</td>
</tr>
<tr class="ldgxListingFeatCellPets">
<th width="80" altwidth="40" alt="Pets" class="ldgxListingFeatCell">' . __('Pet Friendly', $this->localizationDomain) . '?</th>
<td class="ldgxListingFeatCell"><div class="ldgxPets' . ($property->pets == 1 ? __('Yes', $this->localizationDomain) : __('No', $this->localizationDomain)) . '"></div></td>
</tr>
<tr>
<th width="80" altwidth="80" alt="Daily" class="ldgxListingFeatCell ldgxListingFeatDaily">' . __('Daily Rate', $this->localizationDomain) . '</th>
<td class="ldgxListingFeatCell ldgxListingFeatDaily">' . $low_daily_rate . ' - ' . $high_daily_rate . '</td>
</tr>
<tr>
<th width="100" altwidth="100" alt="Weekly" class="ldgxListingFeatCell ldgxListingFeatWeekly">' . __('Weekly Rate', $this->localizationDomain) . '</th>
<td class="ldgxListingFeatCell ldgxListingFeatWeekly">' . $low_weekly_rate . ' - ' . $high_weekly_rate . '</td>
</tr>
<tr>
<th width="100" altwidth="100" alt="Monthly" class="ldgxListingFeatCell ldgxListingFeatMonthly">' . __('Monthly Rate', $this->localizationDomain) . '</th>
<td class="ldgxListingFeatCell ldgxListingFeatMonthly">' . $low_monthly_rate . ' - ' . $high_monthly_rate . '</td>
</tr>
</table>
';
if ($lodgixoptions['p_lodgix_display_availability_icon'] || $lodgixoptions['p_lodgix_display_icons'])
{
    $vacation_rentals.= '<div class="ldgxListingButs">';
    if ($lodgixoptions['p_lodgix_display_availability_icon'])
    {
        $vacation_rentals.= '<div class="ldgxListingButsBlock1">';
        if ($differentiate)
        {
            if ($property->really_available && $property->allow_booking)
            {
                $vacation_rentals.= '<a title="Book Now" href="' . $property->booklink . '"><img src="' . $this->p_plugin_path . '/images/booknow.png"></a>';
            }
            else
            {
                $vacation_rentals.= '<a title="' . __('Check Availability', $this->localizationDomain) . '" href="' . $permalink . '#booking"><img src="' . $this->p_plugin_path . '/images/Lodgix200x50.png"></a>';
            }
        }
        else
        {
            $vacation_rentals.= '<a title="' . __('Check Availability', $this->localizationDomain) . '" href="' . $permalink . '#booking"><img src="' . $this->p_plugin_path . '/images/Lodgix200x50.png"></a>';
        }
        $vacation_rentals.= '</div>';
    }
    if ($lodgixoptions['p_lodgix_display_icons'])
    {
        $vacation_rentals.= '<div class="ldgxListingButsBlock2">
			<a title="Display Google Map" href="' . $permalink . '#map_canvas"><img src="' . $this->p_plugin_path . '/images/map_50.png"></a>
			<a title="Contact Us" href="' . $mail_url . '"><img src="' . $this->p_plugin_path . '/images/mail_50.png"></a>
			<a title="Details" href="' . $permalink . '"><img src="' . $this->p_plugin_path . '/images/kappfinder_50.png"></a>
			</div>';
    }
    $vacation_rentals.= '</div>';
}
$vacation_rentals.= '</div>';