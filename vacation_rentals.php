<?php

if ($differentiate && $property->really_available) {
    $permalink = add_query_arg(array('bookdates' => $property->bookdates) , $permalink);
    $permalink = esc_url($permalink);
}

$mail_url = '';
if ($this->options['p_lodgix_contact_url_' . $this->sufix] != "") {
    $mail_url = $this->options['p_lodgix_contact_url_' . $this->sufix];
    if (strpos($mail_url, '__PROPERTY__') != false) {
        $mail_url = str_replace('__PROPERTY__', $property->description, $mail_url);
    }
    if (strpos($mail_url, '__PROPERTYID__') != false) {
        $mail_url = str_replace('__PROPERTYID__', $property->id, $mail_url);
    }
}

if ($differentiate && !$property->really_available) {
    $warning =
        '<div style="margin:10px"><span class="lodgix-icon lodgix-icon-alert" style="float: left; margin-right: .3em"></span><strong>'
        . __('Rules may exist that prevent this booking from proceeding. Please check availability.',
            $this->localizationDomain)
        . '</strong></div>';
} else {
    $warning = '';
}

$vacation_rentals = '<div class="ldgxShadow">';

if ($this->options['p_lodgix_full_size_thumbnails']) {
    $vacation_rentals .=
        '<div class="ldgxListingFullSizeImg"><a href="'
        . $permalink
        . '"><img border="0" src="'
        . $property->main_image
        . '"></a></div>';
} else {
    $vacation_rentals .=
        '<div class="ldgxListingImg"><a href="'
        . $permalink
        . '"><img border="0" src="'
        . $property->main_image_thumb
        . '"></a></div>';
}

$vacation_rentals .=
    '<div class="ldgxListingName"><a href="' . $permalink . '">' . $property->description . '</a></div>';

$vacation_rentals .=
    '<div class="ldgxListingBody">'
    . $property->area
    . $warning
    . '<div class="ldgxListingDesc">'
    . preg_replace('{(<br(\s*/)?>|&nbsp;)+$}i', '', html_entity_decode(nl2br($property->details)))
    . '</div></div>';

$vacation_rentals .= '<div class="ldgxListingSeparator"></div><table class="ldgxFeats">';

if ($this->options['p_lodgix_display_search_bedrooms']) {
    $vacation_rentals .=
        '<tr class="ldgxListingFeatCellBeds"><th width="70" altwidth="40" alt="Beds" class="ldgxListingFeatCell ldgxListingFeatCellHeader">'
        . __('Bedrooms', $this->localizationDomain)
        . '</th><td class="ldgxListingFeatCell ldgxListingFeatCellContent">'
        . ($property->bedrooms == 0 ? 'Studio' : $property->bedrooms)
        . '</td></tr>';
}

if ($this->options['p_lodgix_display_search_bathrooms']) {
    $vacation_rentals .=
        '<tr class="ldgxListingFeatCellBaths"><th width="70" altwidth="40" alt="Baths" class="ldgxListingFeatCell ldgxListingFeatCellHeader">'
        . __('Bathrooms', $this->localizationDomain)
        . '</th><td class="ldgxListingFeatCell ldgxListingFeatCellContent">'
        . $property->bathrooms
        . '</td></tr>';
}

if ($this->options['p_lodgix_display_search_type']) {
    $vacation_rentals .=
        '<tr class="ldgxListingFeatCellType"><th width="80" altwidth="40" alt="Type" class="ldgxListingFeatCell ldgxListingFeatCellHeader">'
        . __('Rental Type', $this->localizationDomain)
        . '</th><td class="ldgxListingFeatCell ldgxListingFeatCellContent">'
        . $property->proptype
        . '</td></tr>';
}

if ($this->options['p_lodgix_display_search_pets']) {
    $petsClass = 'ldgxPets' . ($property->pets == 1 ? 'Yes' : 'No');
    $petsClass .= ' ' . $petsClass . $this->ICON_SET_CLASS[$this->options['p_lodgix_icon_set']];
    $vacation_rentals .=
        '<tr class="ldgxListingFeatCellPets"><th width="80" altwidth="40" alt="Pets" class="ldgxListingFeatCell ldgxListingFeatCellHeader">'
        . __('Pet Friendly', $this->localizationDomain)
        . '?</th><td class="ldgxListingFeatCell ldgxListingFeatCellContent"><div class="'
        . $petsClass
        . '"></div></td></tr>';
}

if ($this->options['p_lodgix_display_search_daily_rates']) {
    $vacation_rentals .=
        '<tr class="ldgxListingFeatCellDaily"><th width="80" altwidth="80" alt="Daily" class="ldgxListingFeatCell ldgxListingFeatCellHeader ldgxListingFeatDaily">'
        . __('Daily Rate', $this->localizationDomain)
        . '</th><td class="ldgxListingFeatCell ldgxListingFeatCellContent ldgxListingFeatDaily">'
        . $low_daily_rate . ' - ' . $high_daily_rate
        . '</td></tr>';
}

if ($this->options['p_lodgix_display_search_weekly_rates']) {
    $vacation_rentals .=
        '<tr class="ldgxListingFeatCellWeekly"><th width="100" altwidth="100" alt="Weekly" class="ldgxListingFeatCell ldgxListingFeatCellHeader ldgxListingFeatWeekly">'
        . __('Weekly Rate', $this->localizationDomain)
        . '</th><td class="ldgxListingFeatCell ldgxListingFeatCellContent ldgxListingFeatWeekly">'
        . $low_weekly_rate . ' - ' . $high_weekly_rate
        . '</td></tr>';
}

if ($this->options['p_lodgix_display_search_monthly_rates']) {
    $vacation_rentals .=
        '<tr class="ldgxListingFeatCellMonthly"><th width="100" altwidth="100" alt="Monthly" class="ldgxListingFeatCell ldgxListingFeatCellHeader ldgxListingFeatMonthly">'
        . __('Monthly Rate', $this->localizationDomain)
        . '</th><td class="ldgxListingFeatCell ldgxListingFeatCellContent ldgxListingFeatMonthly">'
        . $low_monthly_rate . ' - ' . $high_monthly_rate
        . '</td></tr>';
}

$vacation_rentals .= '</table>';

if ($this->options['p_lodgix_display_availability_icon'] || $this->options['p_lodgix_display_icons']) {
    $vacation_rentals .= '<div class="ldgxListingButs">';
    if ($this->options['p_lodgix_display_availability_icon']) {
        $vacation_rentals .= '<div class="ldgxListingButsBlock1">';
        if ($differentiate) {
            if ($property->really_available && $property->allow_booking) {
                $vacation_rentals .=
                    '<a title="Book Now" href="'
                    . $property->booklink
                    . '"><img src="'
                    . $this->p_plugin_path
                    . '/images/booknow.png"></a>';
            } else {
                $vacation_rentals .=
                    '<a title="'
                    . __('Check Availability', $this->localizationDomain)
                    . '" href="'
                    . $permalink
                    . '#booking" class="lodgix_check_availability_icon"></a>';
            }
        } else {
            $vacation_rentals .=
                '<a title="'
                . __('Check Availability', $this->localizationDomain)
                . '" href="'
                . $permalink
                . '#booking" class="lodgix_check_availability_icon"></a>';
        }
        $vacation_rentals .= '</div>';
    }
    if ($this->options['p_lodgix_display_icons']) {
        $vacation_rentals.= '<div class="ldgxListingButsBlock2">
			<a title="Display Google Map" href="' . $permalink . '#map_canvas" class="ldgxButton ldgxButtonMap ldgxButtonMap' . $this->ICON_SET_CLASS[$this->options['p_lodgix_icon_set']] . '"></a>
			<a title="Contact Us" href="' . $mail_url . '" class="ldgxButton ldgxButtonMail ldgxButtonMail' . $this->ICON_SET_CLASS[$this->options['p_lodgix_icon_set']] . '"></a>
		</div>';
    }
    $vacation_rentals .= '</div>';
}

$vacation_rentals .= '<br id="lodgix_optional_br" clear="all"/></div>';
