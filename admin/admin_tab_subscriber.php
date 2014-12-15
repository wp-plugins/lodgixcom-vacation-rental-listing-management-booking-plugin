<!--<p>
    Please read through our <a target="_blank" href="http://docs.lodgix.com/spaces/vacation-rental/manuals/wordpress-vacation-rental">comprehensive manual</a> if you encounter issues with the plugin.
    The manual is comprehensive and includes tutorials on proper setup techniques (including screenshot) as well as documentation on getting the plugin to work with various WordPress themes.  
    Please visit our <a target="_blank" href="http://support.lodgix.com">support site</a> to submit a support ticket if the manual does not help to resolve your issues.
</p>-->

<?php wp_nonce_field('p_lodgix-update-options'); ?>
    
<!--<p><b><?php _e('Lodgix Subscriber Settings', $this->localizationDomain); ?></b></p>-->
    
<table width="100%" cellspacing="2" cellpadding="5" class="form-table"> 
    <tr valign="top"> 
        <th width="33%" scope="row">
            <?php _e('Customer ID:', $this->localizationDomain); ?>
        </th> 
        <td>
            <input name="p_lodgix_owner_id" type="text" id="p_lodgix_owner_id" value="<?php echo $this->options['p_lodgix_owner_id'] ;?>"/>
            <br><span class="setting-description"><?php _e('Enter your Lodgix Customer ID', $this->localizationDomain); ?> (<a href="javascript:void(0)" onclick="p_lodgix_set_demo_credentials(); return false;">use demo ID</a>)
      </td> 
    </tr>
    <tr valign="top"> 
        <th width="33%" scope="row">
            <?php _e('API Key:', $this->localizationDomain); ?>
        </th> 
        <td>
            <input name="p_lodgix_api_key" type="text" id="p_lodgix_api_key" value="<?php echo $this->options['p_lodgix_api_key'] ;?>"/>
            <br><span class="setting-description"><?php _e('Enter your Lodgix API Key', $this->localizationDomain); ?>
      </td> 
    </tr>                                    
</table>
<br>
<p>
    To setup your properties for use with the plug-in, a Lodgix.com subscription is required.
</p>

<div class="tryit">
    <a href="http://www.lodgix.com/register/0?wordpress=1">
        <h2>TRY IT FREE</h2>
        <div>No Credit Card Required</div>
    </a>
</div>

<p>We do offer a a free starter subscription for plug-in users which is good for up to five properties,
however it is restricted to payments via PayPal only and does not include use of automated trigger emails or any of
the premium modules. This subscription is free and will not expire.
</p>
<p>
    Additionally, if you just wish to test the plug-in within your website using demo property images and data, and do not wish
to sign up for a Lodgix.com subscription at this time, use the demo ID and API key provided. 
</p>
<p>
If you are a current Lodgix.com subscriber, please login to your Lodgix.com account and go to "Settings >> Important Settings"
to obtain your "Customer ID" and "API Key".
</p>

