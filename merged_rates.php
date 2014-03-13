<?php
    $dates_text = 'Dates';
    $nightly_text = 'Weekday';
    $nightly_weekend_text = 'Weekend';
    $weekly_text = 'Weekly';
    $monthly_text = 'Monthly';
    if ($is_german) {
	$dates_text = 'Dates';
	$nightly_text = 'Wochentag';
	$nightly_weekend_text = 'Weekend';
	$weekly_text = 'Wochenpreis';
	$monthly_text = 'Monatspreis';	
    }

    $single_property .= '<table class="merged_rates_table">';
    $single_property .= '<thead><tr class="">';
    $single_property .= '<th class="lodgix_left lodgix_dates merged_rates_table_green">' . $dates_text  .'</th>';
	if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0) {
        $single_property .= '<th class="lodgix_centered merged_rates_table_green">' . $nightly_text  .'</th>';
        $single_property .= '<th class="lodgix_centered merged_rates_table_green">' . $nightly_weekend_text  .'</th>';
    }
    $single_property .= '<th class="lodgix_centered merged_rates_table_green">' . $weekly_text  .'</th>';
    $single_property .= '<th class="lodgix_centered merged_rates_table_green">' . $monthly_text  .'</th>';        
    $single_property .= '</tr></thead><tbody>';
    $even = true;
    foreach($merged_rates as $mr) {
        if ($even)
            $single_property .= '<tr class="merged_rates_table-even">';
        else
            $single_property .= '<tr class="merged_rates_table-odd">';
        $single_property .= '<td class="lodgix_left lodgix_dates">';
        $single_property .= '<b>' . $mr->name . '</b><br>';
        $single_property .= '' . strftime($this->options['p_lodgix_date_format'], strtotime($mr->from_date)) . ' - ' . strftime($this->options['p_lodgix_date_format'], strtotime($mr->to_date)) ;
        if ($mr->min_stay > 1)
            $single_property .= '<br>' . $mr->min_stay . ' nights min stay';
        $single_property .= '</td>';        
        if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0) {
            $single_property .= '<td class="lodgix_centered">' . ((!$mr->nightly) ? "-" : ($property->currency_symbol . $mr->nightly)) . '</td>';
            $single_property .= '<td class="lodgix_centered">' . ((!$mr->nightly_weekend) ? ((!$mr->nightly) ? "-" : ($property->currency_symbol . $mr->nightly)) : ($property->currency_symbol . $mr->nightly_weekend)) . '</td>';
        }
        $single_property .= '<td class="lodgix_centered">' . ((!$mr->weekly) ? "-" : ($property->currency_symbol . $mr->weekly))  . '</td>';
        $single_property .= '<td class="lodgix_centered">' . ((!$mr->monthly) ? "-" : ($property->currency_symbol . $mr->monthly))  . '</td>';
        $single_property .= '</tr>';
        $even = !$even;
    }
    $single_property .= '</tbody></table><br>';


?>