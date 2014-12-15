
<table width="100%" class="form-table lodgix_options_table"> 
    <tr valign="top">
        <th scope="row">
            <?php _e('Display Featured Widget horizontally?:', $this->localizationDomain); ?>
        </th> 
        <td>                             
            <select name="p_lodgix_display_featured_horizontally"  id="p_lodgix_display_featured_horizontally" >                              
                <option <?php if (($this->options['p_lodgix_display_featured_horizontally'] == 0) || (($this->options['p_lodgix_display_featured_horizontally'] != 1) && ($this->options['p_lodgix_display_featured_horizontally'] != 2))) echo "SELECTED"; ?> value='0'>No</option>
                <option <?php if ($this->options['p_lodgix_display_featured_horizontally'] == 1) echo "SELECTED"; ?> value='1'>Yes - Float Left</option>
                <option <?php if ($this->options['p_lodgix_display_featured_horizontally'] == 2) echo "SELECTED"; ?> value='2'>Yes - Float Right</option>
            </select>
        </td> 
    </tr>                                              
    <tr valign="top"> 
        <th scope="row"><?php _e('Featured Rentals:', $this->localizationDomain); ?></th> 
        <td>
            <select name="p_lodgix_display_featured"  id="p_lodgix_display_featured" >                              
                <option <?php if ($this->options['p_lodgix_display_featured'] == 'city') echo "SELECTED"; ?> value='city'>Display City</option>
                <option <?php if ($this->options['p_lodgix_display_featured'] == 'area') echo "SELECTED"; ?> value='area'>Display Area</option>
            </select>
        </td> 
    </tr> 
</table>

<br>

<p><b><?php _e('Language Options', $this->localizationDomain); ?></b></p>

<table width="100%" cellspacing="2" cellpadding="5" class="form-table lodgix_options_table">
        
    <tr>
        <td colspan="2">To select other languages, please enable it within WPML setup first.</td>
    </tr>
    <?php
        $wpml_lang_table = $wpdb->prefix . 'icl_languages';
        $sql = "SELECT * FROM " . $this->languages_table . " WHERE code = 'en' OR code IN (SELECT code FROM " . $wpml_lang_table . " WHERE active = 1) order by case when code = 'en' then 0 else 1 end, name";

        $languages = $wpdb->get_results($sql);
        if (!$languages)
        {
            $languages = $wpdb->get_results("SELECT * FROM " . $this->languages_table . " WHERE code = 'en'");
        }
        if ($languages)
        {
            echo '<tr valign="top"><td colspan="2">';                                                        
            echo '<ul style="list-style:none outside none;">';
            foreach ($languages as $l) {
                echo '<li style="width:190px; float:left;"><span style="vertical-align:middle;"><input name="p_lodgix_generate_' . $l->code .'" type="checkbox" id="p_lodgix_generate_' . $l->code .'"';
                if ($l->enabled) echo "CHECKED";
                if ($l->code == 'en') echo " disabled='disabled' onclick='return false'";
                echo '/> ' . __($l->name, $this->localizationDomain);
                echo '</span></li>';
            }
            echo '</ul></td></tr>';                        
        }
    ?>                
</table><br>      