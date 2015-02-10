<?php

$static = '';



if ($allow_booking == 0)
{
   $static = '_static';
}

$website = 'http://www.lodgix.com';
if (is_ssl()) {
    $website = 'https://www.lodgix.com';
}

if ($number_properties == 1)
{
   $availability = '
        <div id="lodgix_calendar" align="center">
            <script type="text/javascript">var __lodgix_origin="' . $website . '";</script>
            <script type="text/javascript" src="' . $website . '/static/scc/build/code.min.js">
            </script><script type="text/javascript">
                var lodgixUnitCalendarInstance = new LodgixUnitCalendar(' . $owner_id. ',' . $property_id . ', "' . $lang_code . '");
            </script>
    ';
}
else
{
  $availability = '
        <div id="lodgix_calendar" align="center">
            <script type="text/javascript">var __lodgix_origin="' . $website . '";</script>
            <script type="text/javascript" src="' . $website . '/static/muc/build/code.min.js"></script>
            <script type="text/javascript">new LodgixCalendar("' . $owner_id_multiple . '",0,true, "' . $lang_code . '")</script>';
}

$title = 'Online Booking Instructions';
if ($lang_code == 'de')
  $title = 'Online Buchungs Instruktionen';

if (($multi_unit_helptext != '') && ($allow_booking == 1) && ($this->options['p_lodgix_display_multi_instructions'] == 1))
{
  $availability .= '<div style="max-width:615px"><div style="padding:5px 20px 0px;text-align:center;"><div style="text-align:left;padding:5px 0px 0px 0px;"><h2 style="margin:0px;padding:0px;color:#0299FF;font-family:Arial,sans-serif;font-size:17px;">' . $title . '</h2><p style="font-family:Arial,sans-serif;font-size:12px;margin:0px;padding:0px;margin-top:10px;">' . $multi_unit_helptext . '</p></div></div></div></div><br>';
}
else
{
  $availability .= '</div>';
}



?>
