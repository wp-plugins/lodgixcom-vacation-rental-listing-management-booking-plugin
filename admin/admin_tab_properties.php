                
<br>
<p>
    Please read through our <a target="_blank" href="http://docs.lodgix.com/spaces/vacation-rental/manuals/wordpress-vacation-rental">comprehensive manual</a> if you encounter issues with the plugin.
    The manual is comprehensive and includes tutorials on proper setup techniques (including screenshot) as well as documentation on getting the plugin to work with various WordPress themes.  
    Please visit our <a target="_blank" href="http://support.lodgix.com">support site</a> to submit a support ticket if the manual does not help to resolve your issues.
</p>
    
<div class="ldgxAdminMain">
    
                <?php wp_nonce_field('p_lodgix-update-options'); ?>
    
                <p><b><?php _e('Lodgix Subscriber Settings', $this->localizationDomain); ?></b></p>
    
                <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                    <tr valign="top"> 
                        <th width="33%" scope="row">
                            <?php _e('Customer ID:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <input name="p_lodgix_owner_id" type="text" id="p_lodgix_owner_id" size="45" value="<?php echo $this->options['p_lodgix_owner_id'] ;?>"/>
                            <br><span class="setting-description"><?php _e('Please enter your Lodgix Customer ID', $this->localizationDomain); ?>
                      </td> 
                    </tr>
                    <tr valign="top"> 
                        <th width="33%" scope="row">
                            <?php _e('API Key:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <input name="p_lodgix_api_key" type="text" id="p_lodgix_api_key" size="45" value="<?php echo $this->options['p_lodgix_api_key'] ;?>"/>
                            <br><span class="setting-description"><?php _e('Please enter your Lodgix API Key', $this->localizationDomain); ?>
                      </td> 
                    </tr>   
                    <tr valign="top"> 
                        <td colspan="2">
    To setup your properties for use with the plug-in, a Lodgix.com subscription is required. <a target="_blank" href="http://www.lodgix.com/register/0?wordpress=1">Sign-up for a free 30 day trial subscription at Lodgix.com</a>. 
    No credit card is required. We do offer a a free starter subscription for plug-in users which is good for up to five properties, however it is restricted to payments via PayPal only and does not include use of automated trigger emails or any of the premium modules. This subscription is free and will not expire. Additionally, if you just wish to test the plug-in within your website using demo property images and data,  and do not wish to sign up for a Lodgix.com subscription at this time, click here to populate the Customer ID and API Key with demo credentials.<br><br>
    If you are a current Lodgix.com subscriber, please login to your Lodgix.com account and go to "Settings >> Important Settings" to obtain your "Customer ID" and "API Key". In alternative click <a href="javascript:void(0)" onclick="p_lodgix_set_demo_credentials(); return false;">here</a> to setup Demo Credentials.
                        </td> 
                    </tr>                   
                    </tr>     
                    <tr valign="top"> 
                        <td colspan="2">
                        </td> 
                    </tr>                                   
                </table>
    
                <p><b><?php _e('General Display Options', $this->localizationDomain); ?></b></p>
    
                <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                    <tr valign="top"> 
                        <th style="width:400px;" scope="row">
                            <?php _e('Display daily rates on individual property pages?:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <input name="p_lodgix_display_daily_rates" type="checkbox" id="p_lodgix_display_daily_rates" <?php if ($this->options['p_lodgix_display_daily_rates']) echo "CHECKED"; ?>/>
                        </td> 
                    </tr>
                    <tr valign="top"> 
                        <th style="width:400px;" scope="row">
                            <?php _e('Display weekly rates on individual property pages?:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <input name="p_lodgix_display_weekly_rates" type="checkbox" id="p_lodgix_display_weekly_rates" <?php if ($this->options['p_lodgix_display_weekly_rates']) echo "CHECKED"; ?>/>
                        </td> 
                    </tr>
                    <tr valign="top"> 
                        <th style="width:400px;" scope="row">
                            <?php _e('Display monthly rates on individual property pages?:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <input name="p_lodgix_display_monthly_rates" type="checkbox" id="p_lodgix_display_monthly_rates" <?php if ($this->options['p_lodgix_display_monthly_rates']) echo "CHECKED"; ?>/>
                        </td> 
                    </tr>
                    <tr valign="top"> 
                        <th scope="row">
                            <?php _e('Display Google Map, Contact Us & Details Icons on Search / Sort Page?:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <input name="p_lodgix_display_icons" type="checkbox" id="p_lodgix_display_icons" <?php if ($this->options['p_lodgix_display_icons']) echo "CHECKED"; ?>/>
                        </td> 
                    </tr>         
                    <tr valign="top"> 
                        <th scope="row">
                            <?php _e('Display Availability Icon on Search / Sort Page?:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <input name="p_lodgix_display_availability_icon" type="checkbox" id="p_lodgix_display_availability_icon" <?php if ($this->options['p_lodgix_display_availability_icon']) echo "CHECKED"; ?>/>
                       </td> 
                    </tr>         
                    <tr valign="top">
                        <th scope="row">
                            <?php _e('Display Featured Widget horizontally ?:', $this->localizationDomain); ?>
                        </th> 
                        <td>                             
                            <select name="p_lodgix_display_featured_horizontally"  id="p_lodgix_display_featured_horizontally" style="width:160px;">                              
                                <option <?php if (($this->options['p_lodgix_display_featured_horizontally'] == 0) || (($this->options['p_lodgix_display_featured_horizontally'] != 1) && ($this->options['p_lodgix_display_featured_horizontally'] != 2))) echo "SELECTED"; ?> value='0'>No</option>
                                <option <?php if ($this->options['p_lodgix_display_featured_horizontally'] == 1) echo "SELECTED"; ?> value='1'>Yes - Float Left</option>
                                <option <?php if ($this->options['p_lodgix_display_featured_horizontally'] == 2) echo "SELECTED"; ?> value='2'>Yes - Float Right</option>
                            </select>
                        </td> 
                    </tr>                                              
                    <tr valign="top"> 
                        <th scope="row">
                            <?php _e('Property Name:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <select name="p_lodgix_display_title"  id="p_lodgix_display_title" style="width:160px;">                              
                                <option <?php if ($this->options['p_lodgix_display_title'] == 'title') echo "SELECTED"; ?> value='title'>Marketing Title</option>
                                <option <?php if ($this->options['p_lodgix_display_title'] == 'name') echo "SELECTED"; ?> value='name'>Name</option>
                            </select>
                        </td> 
                    </tr>
                    <tr valign="top"> 
                        <th scope="row"><?php _e('Featured Rentals:', $this->localizationDomain); ?></th> 
                        <td>
                            <select name="p_lodgix_display_featured"  id="p_lodgix_display_featured" style="width:160px;">                              
                                <option <?php if ($this->options['p_lodgix_display_featured'] == 'city') echo "SELECTED"; ?> value='city'>Display City</option>
                                <option <?php if ($this->options['p_lodgix_display_featured'] == 'area') echo "SELECTED"; ?> value='area'>Display Area</option>
                            </select>
                        </td> 
                    </tr> 
                    <tr valign="top"> 
                        <th scope="row">
                            <?php _e('Display Instructions on Single Unit Calendar:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <select name="p_lodgix_display_single_instructions"  id="p_lodgix_display_single_instructions" style="width:160px;">                              
                                <option <?php if ($this->options['p_lodgix_display_single_instructions'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                                <option <?php if ($this->options['p_lodgix_display_single_instructions'] == 0) echo "SELECTED"; ?> value='0'>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top"> 
                        <th scope="row">
                            <?php _e('Display Instructions on Multi Unit Calendar:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <select name="p_lodgix_display_multi_instructions"  id="p_lodgix_display_multi_instructions" style="width:160px;">                              
                                <option <?php if ($this->options['p_lodgix_display_multi_instructions'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                                <option  <?php if ($this->options['p_lodgix_display_multi_instructions'] == 0) echo "SELECTED"; ?> value='0'>No</option>
                            </select>
                        </td>             
                    </tr>
                    <tr valign="top"> 
                        <th scope="row">
                            <?php _e('Single Page Design:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <select name="p_lodgix_single_page_design"  id="p_lodgix_single_page_design" style="width:160px;">                              
                                <option <?php if ($this->options['p_lodgix_single_page_design'] == 0) echo "SELECTED"; ?> value='0'>Regular</option>
                                <option <?php if ($this->options['p_lodgix_single_page_design'] == 1) echo "SELECTED"; ?> value='1'>Tabbed</option>
                            </select>
                        </td>                                                                                                                           
                    </tr>
                    <tr valign="top"> 
                        <th scope="row">
                            <?php _e('Rates Display:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <select name="p_lodgix_rates_display"  id="p_lodgix_rates_display" style="width:160px;">                                                        
                                <option <?php if ($this->options['p_lodgix_rates_display'] == 0) echo "SELECTED"; ?> value='0'>Regular</option>
                                <option <?php if ($this->options['p_lodgix_rates_display'] == 1) echo "SELECTED"; ?> value='1'>Merged</option>
                                <option <?php if ($this->options['p_lodgix_rates_display'] == 2) echo "SELECTED"; ?> value='2'>None</option>
                            </select>
                        </td>                                                                                                                           
                    </tr>                                
                </table><br>
    
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
                
                <p><b><?php _e('Language Options', $this->localizationDomain); ?></b></p>
    
                <table width="100%" cellspacing="2" cellpadding="5" class="form-table">
                        
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
                                echo '<li style="width:190px; float:left;"><input name="p_lodgix_generate_' . $l->code .'" type="checkbox" id="p_lodgix_generate_' . $l->code .'"';
                                if ($l->enabled) echo "CHECKED";
                                if ($l->code == 'en') echo " disabled='disabled' onclick='return false'";
                                echo '/> ' . __($l->name, $this->localizationDomain);
                                echo '</li>';
                            }
                            echo '</ul></td></tr>';                        
                        }
                    ?>                
                </table><br>            
    
                <p><b><?php _e('Contact Options', $this->localizationDomain); ?></b></p>
    
                <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
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
                                    <input name="p_lodgix_contact_url_<?php echo $l->code; ?>" style="width:430px;" type="text" id="p_lodgix_contact_url_<?php echo $l->code; ?>" value="<?php echo $this->options['p_lodgix_contact_url_' . $l->code]; ?>" maxlength="255" />
                                    </td>
                                    </tr>
                                <?php
                            }
                            
                        }?>
                </table><br>                    
    
                <p><b><?php _e('Vacation Rentals Page Options', $this->localizationDomain); ?></b></p>
    
                <table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
                    <tr valign="top"> 
                        <th width="33%" scope="row"><?php _e('Page Title:', $this->localizationDomain); ?></th> 
                        <td>
                            <input name="p_lodgix_vr_title" style="width:430px;" type="text" id="p_lodgix_vr_title" value="<?php echo $this->options['p_lodgix_vr_title']; ?>" maxlength="70" />
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
                    <tr valign="top"> 
                        <th scope="row">
                            <?php _e('Page Design:', $this->localizationDomain); ?>
                        </th> 
                        <td>
                            <select name="p_lodgix_vacation_rentals_page_design"  id="p_lodgix_vacation_rentals_page_design" style="width:160px;">                              
                                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_design'] == 0) echo "SELECTED"; ?> value='0'>Classic</option>
                                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_design'] == 1) echo "SELECTED"; ?> value='1'>Grid</option>
                            </select>
                        </td>                                                                                                                           
                    </tr>
                    <tr valign="top">
                        <th width="33%" scope="row">
                            <?php _e('Full Size Thumbnails:', $this->localizationDomain); ?>
                        </th>
                        <td>
                            <input name="p_lodgix_full_size_thumbnails" type="checkbox" id="p_lodgix_full_size_thumbnails" <?php if ($this->options['p_lodgix_full_size_thumbnails']) echo "CHECKED"; ?>/>
                        </td>
                    </tr>				
                </table><br>                    
    
                <p><b><?php _e('Theme Options', $this->localizationDomain); ?></b></p>
    
                <table width="100%" cellspacing="2" cellpadding="5" class="form-table">
                    <tr valign="top">
                        <th width="33%" scope="row">
                            <?php _e('Thesis 1 Compatibility:', $this->localizationDomain); ?>
                        </th>
                        <td>
                            <input name="p_lodgix_thesis_compatibility" type="checkbox" id="p_lodgix_thesis_compatibility" <?php if ($this->options['p_lodgix_thesis_compatibility']) echo "CHECKED";?> />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th width="33%" scope="row">
                            <?php _e('Thesis 2 Compatibility:', $this->localizationDomain); ?>
                        </th>
                        <td>
                            <input name="p_lodgix_thesis_2_compatibility" type="checkbox" id="p_lodgix_thesis_2_compatibility" <?php if ($this->options['p_lodgix_thesis_2_compatibility']) echo "CHECKED"; ?> onchange="javascript:set_thesis_2_theme_enabled();"/>
    
    
                            <select name="p_lodgix_thesis_2_template"  id="p_lodgix_thesis_2_template" style="width:160px;margin_left:10px;"  <?php if (!$this->options['p_lodgix_thesis_2_compatibility']) echo "DISABLED"; ?>>               
                                <?php foreach($thesis_2_template_options as $to) { ?>              
                                <option <?php if ($this->options['p_lodgix_thesis_2_template'] == $to['class']) echo "SELECTED"; ?> value='<?php echo $to['class'] ?>'><?php echo $to['title'] ?></option>
                                <?php } ?>
                    
                            </select>
                        </td>
                    </tr>
                                    <tr valign="top">
                        <th width="33%" scope="row">
                            <?php _e('Page Template:', $this->localizationDomain); ?>
                        </th>
                        <td>
                                                <select name="p_lodgix_page_template"  id="p_lodgix_page_template" style="width:160px;" 
                                                        onchange="javascript:set_lodgix_page_template_enabled();">
                                                    <option value="NONE">Lodgix Default</option>
                                                    <option value="page.php" <?php if ('page.php' == $this->options["p_lodgix_page_template"]) echo "SELECTED"; ?>>Theme Default</option>
                            <?php 
                                                        $templates = get_page_templates();
                                                        foreach ( $templates as $tn => $tf ) {
                                                            echo '<option ';
                                                            if ($tf == $this->options["p_lodgix_page_template"]) {
                                                                echo "SELECTED";
                                                            }
                                                            echo ' value="'. $tf . '">' . $tn . '</option>';
                                                        }
                                                    ?>
                                                    <option value="CUSTOM" <?php if ('CUSTOM' == $this->options["p_lodgix_page_template"]) echo "SELECTED"; ?>>Custom</option>
                                                </select> <input name="p_lodgix_custom_page_template" id="p_lodgix_custom_page_template"
                                                           style="width:280px;" type="text"
                                                            <?php if ($this->options['p_lodgix_page_template'] != 'CUSTOM') echo 'disabled'; ?> 
                                                           value="<?php echo $this->options['p_lodgix_custom_page_template']; ?>">
                        </td>
                    </tr>
    
    
                                    
                                    
                </table><br>
    
    
                     
                <p><b><?php _e('Property Display Settings', $this->localizationDomain); ?></b></p>
    
                <table width="100%" cellspacing="2" cellpadding="5" class="form-table">
                    <tr valign="top">
                        <th>Property</td>
                        <td width="1%">Menu:</td>
                        <td>Featured:</td>
                    </tr>
                    <?php
                        $properties = $wpdb->get_results('SELECT ' . $this->properties_table . '.id,property_id,description,enabled,featured FROM ' . $this->properties_table . ' LEFT JOIN ' . $this->pages_table .  ' ON ' . $this->properties_table . '.id = ' . $this->pages_table .  '.property_id ORDER BY ' . $this->properties_table . '.`order`');      
                        foreach($properties as $property) {                            
                    ?> 
                        <tr valign="top">
                            <th width="33%" scope="row">
                                <?php _e($property->description, $this->localizationDomain); ?>
                            </th>
                            <td width="1%">
                                <input name="p_lodgix_page_<?php echo $property->id ?>" type="checkbox" id="p_lodgix_page_<?php echo $property->id ?>" <?php if ($property->enabled) echo "CHECKED"; ?>/>
                            </td>
                            <td>
                                <input name="p_lodgix_featured_<?php echo $property->id ?>" type="checkbox" id="p_lodgix_featured_<?php echo $property->id ?>" <?php if ($property->featured) echo "CHECKED"; ?>/>
                            </td>
                        </tr>
                    <?php 
                        } 
                    ?>
                </table><br>
    
                <p class="submit">
                    <input type="submit" name="p_lodgix_save" class="button-primary" value="<?php _e('Save and Regenerate', $this->localizationDomain); ?>" />&nbsp;<input onclick="return confirm('Are you sure you want to clean the database ?');" type="submit" name="p_lodgix_clean" class="button-primary" value="<?php _e('Clean Database', $this->localizationDomain); ?>" /><br><br><br><br>
                    <b>Please wait while database is updated. Time will depend on the number of properties to process.</b>
                </p>
            
        </div>
    
        
        <div class="clear"></div>


