<table width="100%" cellspacing="2" cellpadding="5" class="form-table lodgix_options_table">
    <tr valign="top">
        <th width="33%" scope="row">
            <?php _e('Image Size:', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_image_size"  id="p_lodgix_image_size">
                <option <?php if ($this->options['p_lodgix_image_size'] == p_lodgix::IMAGE_640x480) echo "SELECTED"; ?> value="<?php echo p_lodgix::IMAGE_640x480 ?>">640 x 480</option>
                <option <?php if ($this->options['p_lodgix_image_size'] == p_lodgix::IMAGE_800x600) echo "SELECTED"; ?> value="<?php echo p_lodgix::IMAGE_800x600 ?>">800 x 600</option>
                <option <?php if ($this->options['p_lodgix_image_size'] == p_lodgix::IMAGE_ORIGINAL) echo "SELECTED"; ?> value="<?php echo p_lodgix::IMAGE_ORIGINAL ?>">Original Image</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th width="33%" scope="row">
            <?php _e('Full Size Thumbnails:', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_full_size_thumbnails"  id="p_lodgix_full_size_thumbnails">
                <option <?php if ($this->options['p_lodgix_full_size_thumbnails'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_full_size_thumbnails'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th width="33%" scope="row">
            <?php _e('HTTPS Gallery:', $this->localizationDomain); ?>
        </th>
        <td>
            <select name="p_lodgix_use_ssl_pictures"  id="p_lodgix_use_ssl_pictures">
                <option <?php if ($this->options['p_lodgix_use_ssl_pictures'] == 1) echo "SELECTED"; ?> value='1'>Yes</option>
                <option <?php if ($this->options['p_lodgix_use_ssl_pictures'] == 0) echo "SELECTED"; ?> value='0'>No</option>
            </select>
        </td>
    </tr>
</table><br>
