<?php

$static = '';
if ($allow_booking == 0)
{
   $static = '_static';
}   



if ($number_properties == 1)
{
   $availability = '<div id="lodgix_calendar" align="center"><script type="text/javascript">var __lodgix_origin="http://www.lodgix.com";</script><script type="text/javascript" src="http://www.lodgix.com/static/scc/build/code.min.js"></script><script type="text/javascript">new LodgixUnitCalendar(' . $owner_id. ',' . $property_id . ');</script>';
 
}
else
{
  $availability = '<div id="lodgix_calendar" align="center"><script type="text/javascript">var __lodgix_origin="http://www.lodgix.com";</script><script type="text/javascript" src="http://www.lodgix.com/static/muc/build/code.min.js"></script><script type="text/javascript">new LodgixCalendar("' . $owner_id_multiple . '",0,true)</script>';
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