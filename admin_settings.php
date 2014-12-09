<link href="<?php echo plugins_url('css/admin.css', __FILE__); ?>" rel="stylesheet" type="text/css">

<form method="post" id="p_lodgix_options">
    <div class="wrap">

        <div class="row">
      		<div class="col col-lg-12 col-sm-12">
       			<h1>Lodgix Settings</h1>
 				<p>&nbsp;</p>
  				<div class="row">
                
          			<div class="col col-lg-8 col-sm-8">
                        <ul class="nav nav-tabs p_lodgix_settings_tabs" data-tabs="tabs">
                            <li role="presentation" class="active"><a href="#properties">Properties</a></li>
                            <li role="presentation"><a href="#page_design" >Page Design</a></li>
                            <li role="presentation"><a href="#display_options">Display Options</a></li>
                            <li role="presentation"><a href="#widget_options">Widget Options</a></li>              
                        </ul>
                        




                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="properties">
                                <?php require_once('admin/admin_tab_properties.php'); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="page_design">
                                <h1>Orange</h1>
                                <p>orange orange orange orange orange</p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="display_options">
                                <h1>Yellow</h1>
                                <p>yellow yellow yellow yellow yellow</p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="widget_options">
                                <h1>Yellow</h1>
                                <p>yellow yellow yellow yellow yellow</p>
                            </div>
                        </div>
                        <p class="submit">
                            <input type="submit" name="p_lodgix_save" class="button-primary" value="<?php _e('Save and Regenerate', $this->localizationDomain); ?>" />&nbsp;<input onclick="return confirm('Are you sure you want to clean the database ?');" type="submit" name="p_lodgix_clean" class="button-primary" value="<?php _e('Clean Database', $this->localizationDomain); ?>" /><br><br><br><br>
                            <b>Please wait while database is updated. Time will depend on the number of properties to process.</b>
                        </p>
                    </div>
           			<div class="col col-lg-4 col-sm-4" align="center">
                        
                    </div>
      			</div>
      		</div>
    </div> 

</form>
<div class="clear"></div>