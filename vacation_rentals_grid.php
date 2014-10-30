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
    $mail_url = $lodgixoptions['p_lodgix_contact_url_' . $this->sufix];
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


$vacation_rentals = '';

if ($old_area != '') {
    if (($counter == 0) || ($old_area != $property->area)) {
        if ($property->area)
            $vacation_rentals .= '<h2>' . $property->area . '</h2>';
        else
            $vacation_rentals .= '<h2>Other Areas</h2>';
        $counter = 0;
    }
}

$new_row = '';
if ($counter % 3 == 0) {
    $new_row = 'new-row';
}



$old_area = $property->area;

$vacation_rentals .= '

    <div class="property_div_logix property clearfix ' . $new_row . '">
    
        <div class="property_image">
    
            <a class="property_overview_thumb property_overview_thumb_medium thumbnail"
                href="' . $permalink . '">
                    <img border="0" src="' . $property->main_image . '" alt=""></a>
    
        </div>
    
            
        <ul class="wpp_overview_data">		
            <li class="property_title"><a href="' . $permalink . '">' . $property->description . '</a></li>
            <li class="description"> ' . $property->description_long . '</li>
            <li><strong>' . __('Weekly Rate', $this->localizationDomain) . ':</strong> ' . $low_weekly_rate . ' - ' . $high_weekly_rate . '</li>
            <li><strong>' . __('Bedrooms', $this->localizationDomain) . ':</strong> ' . $property->bedrooms . '</li>';

if ($property->area) {
    $vacation_rentals .= '
            <li><strong>' . __('Location', $this->localizationDomain) . ':</strong> ' . $property->area . '</li>
    ';
}

$vacation_rentals .= '            
        </ul>
    </div> 
';


error_log($property->description);
error_log($vacation_rentals);

