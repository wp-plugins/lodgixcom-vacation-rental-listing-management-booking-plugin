
<p><b><?php _e('General Page Options', $this->localizationDomain); ?></b></p>

<table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
    <tr valign="top"> 
        <th width="33%" scope="row">
            <?php _e('Allow Comments:', $this->localizationDomain); ?>
        </th>
        <td>
            <input name="p_lodgix_allow_comments" type="checkbox" id="p_lodgix_allow_comments" <?php if ($this->options['p_lodgix_allow_comments']) echo "CHECKED"; ?>/>
      </td> 
    </tr>
    <tr valign="top"> 
        <th width="33%" scope="row">
            <?php _e('Allow PingBacks:', $this->localizationDomain); ?>
        </th>
        <td>
            <input name="p_lodgix_allow_pingback" type="checkbox" id="p_lodgix_allow_pingback" <?php if ($this->options['p_lodgix_allow_pingback']) echo "CHECKED"; ?>/>
      </td> 
    </tr>
</table><br>

<p><b><?php _e('Menu Display Options', $this->localizationDomain); ?></b></p>

<table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
    <tr valign="top"> 
        <th width="33%" scope="row">
            <?php _e('Vacation Rentals Menu Position:', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_vacation_rentals_page_pos"  id="p_lodgix_vacation_rentals_page_pos" style="width:160px;">                              
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
            <select name="p_lodgix_availability_page_pos"  id="p_lodgix_availability_page_pos" style="width:160px;">                              
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


