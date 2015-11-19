<?php

$dates_text = __('Dates',$this->localizationDomain);
$nightly_text =  __('Weekday',$this->localizationDomain);
$weekend_nightly_text =  __('Weekend',$this->localizationDomain);
$weekly_text =  __('Weekly',$this->localizationDomain);
$monthly_text =  __('Monthly',$this->localizationDomain);

$single_property .= '<table class="merged_rates_table">';
$single_property .= '<thead><tr class="">';
$single_property .= '<th class="lodgix_left lodgix_dates merged_rates_table_green">' . $dates_text  .'</th>';

if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0) {
    $single_property .= '<th class="lodgix_centered merged_rates_table_green">' . $nightly_text  .'</th>';
    $single_property .= '<th class="lodgix_centered merged_rates_table_green">' . $weekend_nightly_text  .'</th>';
}

if ($this->options['p_lodgix_display_weekly_rates']) {
    $single_property .= '<th class="lodgix_centered merged_rates_table_green">' . $weekly_text  .'</th>';
}

if ($this->options['p_lodgix_display_monthly_rates']) {
    $single_property .= '<th class="lodgix_centered merged_rates_table_green">' . $monthly_text  .'</th>';
}

$single_property .= '</tr></thead><tbody>';

$even = true;

foreach($merged_rates as $mr) {

    if ($even)
        $single_property .= '<tr class="merged_rates_table-even">';
    else
        $single_property .= '<tr class="merged_rates_table-odd">';

    $single_property .= '<td class="lodgix_left lodgix_dates">';
    $single_property .= '<b>' . __($mr->name,$this->localizationDomain) . '</b><br>';
    $single_property .= '' . strftime($this->options['p_lodgix_date_format'], strtotime($mr->from_date)) . ' - ' . strftime($this->options['p_lodgix_date_format'], strtotime($mr->to_date));

    if ($mr->min_stay > 1)
        $single_property .= '<br>' . $mr->min_stay . ' ' . __('nights min stay',$this->localizationDomain);

    $single_property .= '</td>';

    if ($this->options['p_lodgix_display_daily_rates'] && $low_daily_rate > 0) {
        $single_property .= '<td class="lodgix_centered">' . ((!$mr->nightly) ? "-" : ($property->currency_symbol . $mr->nightly)) . '</td>';
        $single_property .= '<td class="lodgix_centered">' . ((!$mr->weekend_nightly) ? ((!$mr->nightly) ? "-" : ($property->currency_symbol . $mr->nightly)) : ($property->currency_symbol . $mr->weekend_nightly)) . '</td>';
    }
    if ($this->options['p_lodgix_display_weekly_rates']) {
        $single_property .= '<td class="lodgix_centered">' . ((!$mr->weekly) ? "-" : ($property->currency_symbol . $mr->weekly))  . '</td>';
    }
    if ($this->options['p_lodgix_display_monthly_rates']) {
        $single_property .= '<td class="lodgix_centered">' . ((!$mr->monthly) ? "-" : ($property->currency_symbol . $mr->monthly))  . '</td>';
    }
    $single_property .= '</tr>';
    $even = !$even;

}

$single_property .= '</tbody></table>';
