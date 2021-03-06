<p><b><?php _e('Vacation Rentals Page', $this->localizationDomain); ?></b></p>

<table width="100%" cellspacing="2" cellpadding="5" class="form-table lodgix_options_table">
    <tr valign="top">
        <th width="33%" scope="row"><?php _e('Page Title:', $this->localizationDomain); ?></th>
        <td>
            <input name="p_lodgix_vr_title" type="text" id="p_lodgix_vr_title" value="<?php echo $this->options['p_lodgix_vr_title']; ?>" maxlength="70" />
        </td>
    </tr>
    <tr valign="top">
        <th width="33%" scope="row"><?php _e('Meta Description:', $this->localizationDomain); ?></th>
        <td>
            <textarea cols="55" name="p_lodgix_vr_meta_description" id="p_lodgix_vr_meta_description"><?php echo $this->options['p_lodgix_vr_meta_description']; ?></textarea>
        </td>
    </tr>
    <tr valign="top">
        <th width="33%" scope="row"><?php _e('Meta Keywords:', $this->localizationDomain); ?></th>
        <td>
            <textarea cols="55" name="p_lodgix_vr_meta_keywords" id="p_lodgix_vr_meta_keywords"><?php echo $this->options['p_lodgix_vr_meta_keywords']; ?></textarea>
        </td>
    </tr>

</table><br>

<p><b><?php _e('Property Listing and Search Results', $this->localizationDomain); ?></b></p>

<table width="100%" class="form-table lodgix_options_table"> 
    <tr valign="top">
        <th scope="row">
            <?php _e('Display "Bedrooms"?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_display_search_bedrooms"  id="p_lodgix_display_search_bedrooms" >
                <option <?php if ($this->options['p_lodgix_display_search_bedrooms'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_search_bedrooms'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Display "Bathrooms"?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_display_search_bathrooms"  id="p_lodgix_display_search_bathrooms" >
                <option <?php if ($this->options['p_lodgix_display_search_bathrooms'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_search_bathrooms'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Display "Rental Type"?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_display_search_type"  id="p_lodgix_display_search_type" >
                <option <?php if ($this->options['p_lodgix_display_search_type'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_search_type'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Display "Pets"?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_display_search_pets"  id="p_lodgix_display_search_pets" >
                <option <?php if ($this->options['p_lodgix_display_search_pets'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_search_pets'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Display daily rates?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_display_search_daily_rates"  id="p_lodgix_display_search_daily_rates" >
                <option <?php if ($this->options['p_lodgix_display_search_daily_rates'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_search_daily_rates'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Display weekly rates?', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_display_search_weekly_rates"  id="p_lodgix_display_search_weekly_rates" >
                <option <?php if ($this->options['p_lodgix_display_search_weekly_rates'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_search_weekly_rates'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td> 
    </tr>
    <tr valign="top"> 
        <th scope="row">
            <?php _e('Display monthly rates?', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_display_search_monthly_rates"  id="p_lodgix_display_search_monthly_rates" >
                <option <?php if ($this->options['p_lodgix_display_search_monthly_rates'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_search_monthly_rates'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td> 
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Display Availability button?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_display_availability_icon"  id="p_lodgix_display_availability_icon" >
                <option <?php if ($this->options['p_lodgix_display_availability_icon'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_availability_icon'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Display Google Map, Contact Us and Details icons?', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_display_icons"  id="p_lodgix_display_icons" >                              
                <option <?php if ($this->options['p_lodgix_display_icons'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_icons'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td> 
    </tr>
</table><br>

<p><b><?php _e('Properties', $this->localizationDomain); ?></b></p>

<table width="100%" cellspacing="2" cellpadding="5" class="form-table lodgix_options_table">
    <tr valign="top">
        <th scope="row">
            <?php _e('Display daily rates?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_display_daily_rates"  id="p_lodgix_display_daily_rates" >
                <option <?php if ($this->options['p_lodgix_display_daily_rates'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_daily_rates'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Display weekly rates?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_display_weekly_rates"  id="p_lodgix_display_weekly_rates" >
                <option <?php if ($this->options['p_lodgix_display_weekly_rates'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_weekly_rates'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Display monthly rates?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_display_monthly_rates"  id="p_lodgix_display_monthly_rates" >
                <option <?php if ($this->options['p_lodgix_display_monthly_rates'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_monthly_rates'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Display beds in property details?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_display_beds"  id="p_lodgix_display_beds" >
                <option <?php if ($this->options['p_lodgix_display_beds'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_beds'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Google Map zoom level:', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_gmap_zoom_level"  id="p_lodgix_gmap_zoom_level" >                              
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 0) echo "SELECTED"; ?> value='0'>
                    Default (<?php if ($this->options['p_lodgix_single_page_design'] == 0) echo '10'; else echo '13'; ?>)
                </option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 1) echo "SELECTED"; ?> value='1'>1</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 2) echo "SELECTED"; ?> value='2'>2</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 3) echo "SELECTED"; ?> value='3'>3</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 4) echo "SELECTED"; ?> value='4'>4</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 5) echo "SELECTED"; ?> value='5'>5</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 6) echo "SELECTED"; ?> value='6'>6</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 7) echo "SELECTED"; ?> value='7'>7</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 8) echo "SELECTED"; ?> value='8'>8</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 9) echo "SELECTED"; ?> value='9'>9</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 10) echo "SELECTED"; ?> value='10'>10</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 11) echo "SELECTED"; ?> value='11'>11</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 12) echo "SELECTED"; ?> value='12'>12</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 13) echo "SELECTED"; ?> value='13'>13</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 14) echo "SELECTED"; ?> value='14'>14</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 15) echo "SELECTED"; ?> value='15'>15</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 16) echo "SELECTED"; ?> value='16'>16</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 17) echo "SELECTED"; ?> value='17'>17</option>
                <option <?php if ($this->options['p_lodgix_gmap_zoom_level'] == 18) echo "SELECTED"; ?> value='18'>18</option>
            </select>
            </select>
        </td> 
    </tr>     
    <tr valign="top">
        <th scope="row">
            <?php _e('Property Name:', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_display_title"  id="p_lodgix_display_title" >                              
                <option <?php if ($this->options['p_lodgix_display_title'] == 'title') echo "SELECTED"; ?> value='title'>Marketing Title</option>
                <option <?php if ($this->options['p_lodgix_display_title'] == 'name') echo "SELECTED"; ?> value='name'>Name</option>
            </select>
        </td> 
    </tr>
    <tr valign="top"> 
        <th scope="row">
            <?php _e('Display Instructions on Single Unit Calendar?', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_display_single_instructions"  id="p_lodgix_display_single_instructions" >                              
                <option <?php if ($this->options['p_lodgix_display_single_instructions'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_display_single_instructions'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top"> 
        <th scope="row">
            <?php _e('Display Instructions on Multi Unit Calendar?', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_display_multi_instructions"  id="p_lodgix_display_multi_instructions" >                              
                <option <?php if ($this->options['p_lodgix_display_multi_instructions'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option  <?php if ($this->options['p_lodgix_display_multi_instructions'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>             
    </tr>
    <tr valign="top"> 
        <th scope="row">
            <?php _e('Rates Display:', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_rates_display"  id="p_lodgix_rates_display" >                                                        
                <option <?php if ($this->options['p_lodgix_rates_display'] == 0) echo "SELECTED"; ?> value='0'>Regular</option>
                <option <?php if ($this->options['p_lodgix_rates_display'] == 1) echo "SELECTED"; ?> value='1'>Merged</option>
                <option <?php if ($this->options['p_lodgix_rates_display'] == 2) echo "SELECTED"; ?> value='2'>None</option>
            </select>
        </td>                                                                                                                           
    </tr>                                
    <tr valign="top">
        <th width="33%" scope="row">
            <?php _e('Allow Comments?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_allow_comments"  id="p_lodgix_allow_comments" >                              
                <option <?php if ($this->options['p_lodgix_allow_comments'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_allow_comments'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
      </td> 
    </tr>
    <tr valign="top"> 
        <th width="33%" scope="row">
            <?php _e('Allow PingBacks?', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_allow_pingback"  id="p_lodgix_allow_pingback" >                              
                <option <?php if ($this->options['p_lodgix_allow_pingback'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_allow_pingback'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
      </td> 
    </tr>
</table><br>

<p><b><?php _e('Contact Options', $this->localizationDomain); ?></b></p>

<table width="100%" cellspacing="2" cellpadding="5" class="form-table lodgix_options_table"> 
    <?php
    
        $languages = $wpdb->get_results('SELECT * FROM ' . $this->languages_table . ' WHERE enabled = 1');
        if ($languages)
        {
            foreach ($languages as $l) {
                ?>
                    <tr valign="top"> 
                    <th width="33%" scope="row">
                    <?php _e($l->name . ' Contact URL:', $this->localizationDomain); ?>
                    </th>
                    <td>
                    <input name="p_lodgix_contact_url_<?php echo $l->code; ?>" type="text" id="p_lodgix_contact_url_<?php echo $l->code; ?>" value="<?php echo $this->options['p_lodgix_contact_url_' . $l->code]; ?>" maxlength="255" />
                    </td>
                    </tr>
                <?php
            }
            
        }?>
</table><br>
	<p><b><?php _e('Menu Display Options', $this->localizationDomain); ?></b><br>[This option is no longer supported (or needed). Please set this option to "None" and add back the menu items using WordPress menus instead (Appearance > Menu).]</p>

<table width="100%" cellspacing="2" cellpadding="5" class="form-table lodgix_options_table"> 
    <tr valign="top"> 
        <th width="33%" scope="row">
            <?php _e('Vacation Rentals Menu Position:', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_vacation_rentals_page_pos"  id="p_lodgix_vacation_rentals_page_pos">                              
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '-1') echo "SELECTED"; ?> value='-1'>None</option>
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '1') echo "SELECTED"; ?> value='1'>1</option>
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '2') echo "SELECTED"; ?> value='2'>2</option>
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '3') echo "SELECTED"; ?> value='3'>3</option>
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '4') echo "SELECTED"; ?> value='4'>4</option>
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '5') echo "SELECTED"; ?> value='5'>5</option>
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '6') echo "SELECTED"; ?> value='6'>6</option>
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '7') echo "SELECTED"; ?> value='7'>7</option>
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '8') echo "SELECTED"; ?> value='8'>8</option>
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_pos'] == '9') echo "SELECTED"; ?> value='9'>9</option>
            </select>
        </td>
    </tr>   
    <tr valign="top"> 
        <th width="33%" scope="row">
            <?php _e('Availability Page Menu Position:', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_availability_page_pos"  id="p_lodgix_availability_page_pos">                              
                <option <?php if ($this->options['p_lodgix_availability_page_pos'] == '-1') echo "SELECTED"; ?> value='-1'>None</option>
                <option <?php if ($this->options['p_lodgix_availability_page_pos'] == '1') echo "SELECTED"; ?> value='1'>1</option>
                <option <?php if ($this->options['p_lodgix_availability_page_pos'] == '2') echo "SELECTED"; ?> value='2'>2</option>
                <option <?php if ($this->options['p_lodgix_availability_page_pos'] == '3') echo "SELECTED"; ?> value='3'>3</option>
                <option <?php if ($this->options['p_lodgix_availability_page_pos'] == '4') echo "SELECTED"; ?> value='4'>4</option>
                <option <?php if ($this->options['p_lodgix_availability_page_pos'] == '5') echo "SELECTED"; ?> value='5'>5</option>
                <option <?php if ($this->options['p_lodgix_availability_page_pos'] == '6') echo "SELECTED"; ?> value='6'>6</option>
                <option <?php if ($this->options['p_lodgix_availability_page_pos'] == '7') echo "SELECTED"; ?> value='7'>7</option>
                <option <?php if ($this->options['p_lodgix_availability_page_pos'] == '8') echo "SELECTED"; ?> value='8'>8</option>
                <option <?php if ($this->options['p_lodgix_availability_page_pos'] == '9') echo "SELECTED"; ?> value='9'>9</option>
            </select>
        </td> 
    </tr>     
</table><br>