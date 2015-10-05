<table width="100%" cellspacing="2" cellpadding="5" class="form-table lodgix_options_table">
    <tr valign="top"> 
        <th scope="row">
            <?php _e('Search / Sort Page Design:', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_vacation_rentals_page_design"  id="p_lodgix_vacation_rentals_page_design" >                              
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_design'] == 0) echo "SELECTED"; ?> value='0'>Rows</option>
                <option <?php if ($this->options['p_lodgix_vacation_rentals_page_design'] == 1) echo "SELECTED"; ?> value='1'>Grid</option>
            </select>
        </td>                                                                                                                           
    </tr>
    <tr valign="top"> 
        <th scope="row">
            <?php _e('Property Page Design:', $this->localizationDomain); ?>
        </th> 
        <td>
            <select name="p_lodgix_single_page_design"  id="p_lodgix_single_page_design" >                              
                <option <?php if ($this->options['p_lodgix_single_page_design'] == 0) echo "SELECTED"; ?> value='0'>One Page</option>
                <option <?php if ($this->options['p_lodgix_single_page_design'] == 1) echo "SELECTED"; ?> value='1'>Tabbed</option>
            </select>
        </td>                                                                                                                           
    </tr>
    <tr valign="top">
        <th scope="row">
            <?php _e('Icon Set:', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_icon_set"  id="p_lodgix_icon_set" >
                <option <?php if ($this->options['p_lodgix_icon_set'] == p_lodgix::ICON_SET_OLD) echo "SELECTED"; ?> value="<?php echo p_lodgix::ICON_SET_OLD ?>"><?php echo p_lodgix::ICON_SET_OLD ?></option>
                <option <?php if ($this->options['p_lodgix_icon_set'] == p_lodgix::ICON_SET_CIRCLE) echo "SELECTED"; ?> value="<?php echo p_lodgix::ICON_SET_CIRCLE ?>"><?php echo p_lodgix::ICON_SET_CIRCLE ?></option>
                <option <?php if ($this->options['p_lodgix_icon_set'] == p_lodgix::ICON_SET_FILLED) echo "SELECTED"; ?> value="<?php echo p_lodgix::ICON_SET_FILLED ?>"><?php echo p_lodgix::ICON_SET_FILLED ?></option>
                <option <?php if ($this->options['p_lodgix_icon_set'] == p_lodgix::ICON_SET_GRADIENT_COLOR) echo "SELECTED"; ?> value="<?php echo p_lodgix::ICON_SET_GRADIENT_COLOR ?>"><?php echo p_lodgix::ICON_SET_GRADIENT_COLOR ?></option>
                <option <?php if ($this->options['p_lodgix_icon_set'] == p_lodgix::ICON_SET_GRADIENT_GRAY) echo "SELECTED"; ?> value="<?php echo p_lodgix::ICON_SET_GRADIENT_GRAY ?>"><?php echo p_lodgix::ICON_SET_GRADIENT_GRAY ?></option>
                <option <?php if ($this->options['p_lodgix_icon_set'] == p_lodgix::ICON_SET_OUTLINED) echo "SELECTED"; ?> value="<?php echo p_lodgix::ICON_SET_OUTLINED ?>"><?php echo p_lodgix::ICON_SET_OUTLINED ?></option>
                <option <?php if ($this->options['p_lodgix_icon_set'] == p_lodgix::ICON_SET_SQUARED_COLOR) echo "SELECTED"; ?> value="<?php echo p_lodgix::ICON_SET_SQUARED_COLOR ?>"><?php echo p_lodgix::ICON_SET_SQUARED_COLOR ?></option>
                <option <?php if ($this->options['p_lodgix_icon_set'] == p_lodgix::ICON_SET_SQUARED_GRAY) echo "SELECTED"; ?> value="<?php echo p_lodgix::ICON_SET_SQUARED_GRAY ?>"><?php echo p_lodgix::ICON_SET_SQUARED_GRAY ?></option>
            </select>
        </td>
    </tr>
</table><br>

<p><b><?php _e('Theme Options', $this->localizationDomain); ?></b></p>

<table width="100%" cellspacing="2" cellpadding="5" class="form-table lodgix_options_table">
    <tr valign="top">
        <th width="33%" scope="row">
            <?php _e('Thesis 1 Compatibility:', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_thesis_compatibility"  id="p_lodgix_thesis_compatibility" >                              
                <option <?php if ($this->options['p_lodgix_thesis_compatibility'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_thesis_compatibility'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th width="33%" scope="row">
            <?php _e('Thesis 2 Compatibility:', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_thesis_2_compatibility"  id="p_lodgix_thesis_2_compatibility" >                              
                <option <?php if ($this->options['p_lodgix_thesis_2_compatibility'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_thesis_2_compatibility'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>

            <select name="p_lodgix_thesis_2_template"  id="p_lodgix_thesis_2_template" 
                <?php if (!$this->options['p_lodgix_thesis_2_compatibility']) echo 'DISABLED style="display:none;"'; ?>>               
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
            <select name="p_lodgix_page_template"  id="p_lodgix_page_template"  
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
            </select>
            <input name="p_lodgix_custom_page_template" id="p_lodgix_custom_page_template" type="text"
                <?php if ($this->options['p_lodgix_page_template'] != 'CUSTOM') echo 'DISABLED style="display:none;"'; ?> 
                value="<?php echo $this->options['p_lodgix_custom_page_template']; ?>">
        </td>
    </tr>


                    
                    
</table><br>

