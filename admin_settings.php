<link href="<?php echo plugins_url('css/admin.css', __FILE__); ?>" rel="stylesheet" type="text/css">

<form method="post" id="p_lodgix_options">
    <div class="wrap">

        <div class="row">
      		<div class="col col-lg-12 col-sm-12">
       			<h1>Lodgix Settings</h1>
 				<p>&nbsp;</p>
  				<div class="row">
                
          			<div class="col col-lg-8 col-sm-8">
                        <ul class="nav nav-tabs p_lodgix_settings_tabs responsive" data-tabs="tabs" id="p_lodgix_settings_tabs">
                            <li role="presentation" class="active"><a data-toggle="tab" href="#subscriber">Subscriber</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#properties">Properties</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#page_design" >Page Design</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#display_options">Display Options</a></li>
                            <li role="presentation"><a data-toggle="tab" href="#widget_options">Widget Options</a></li>
                        </ul>

                        <div class="tab-content responsive">
                            <div role="tabpanel" class="tab-pane active" id="subscriber">
                                <div class="lodgix_postbox">
                                    <?php require_once('admin/admin_tab_subscriber.php'); ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="properties">
                                <div class="lodgix_postbox">
                                    <?php require_once('admin/admin_tab_properties.php'); ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="page_design">
                                <div class="lodgix_postbox">
                                    <?php require_once('admin/admin_tab_page_design.php'); ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="display_options">
                                <div class="lodgix_postbox">
                                    <?php require_once('admin/admin_tab_display_options.php'); ?>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="widget_options">
                                <div class="lodgix_postbox">
                                    <?php require_once('admin/admin_tab_widget_options.php'); ?>
                                </div>
                            </div>
                        </div>
                        <p class="submit">
                            <div id="lodgix_processing_throbber" style="display: none;">
                                <img src="<?php echo $this->p_plugin_path?>images/throbber.gif">&nbsp;
                                <b>Please wait while database is updated. Time will depend on the number of properties to process.</b>
                                <br><br>
                            </div>

                            <div id="lodgix_processing_message"></div>

                            <input type="button" onclick="javascript:lodgix_submit_save();" name="p_lodgix_save" id="p_lodgix_save" class="button-primary" value="<?php _e('Save and Regenerate', $this->localizationDomain); ?>" />&nbsp;
                            <input onclick="javascript:lodgix_submit_clean();" type="button" name="p_lodgix_clean" id="p_lodgix_clean" class="button-primary" value="<?php _e('Clean Database', $this->localizationDomain); ?>" />
                        </p>
                    </div>
           			<div class="col col-lg-4 col-sm-4" align="center">
                        <?php require_once('admin/admin_widget.php'); ?>
                    </div>
      			</div>
      		</div>
    </div> 

</form>
<div class="clear"></div>