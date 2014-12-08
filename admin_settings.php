<link href="<?php echo plugins_url('css/admin.css', __FILE__); ?>" rel="stylesheet" type="text/css">

<form method="post" id="p_lodgix_options">

<div class="wrap">
    

	<div class="row">
        <div class=".col-md-8">    
            <ul class="nav nav-tabs p_lodgix_settings_tabs" data-tabs="tabs">
                <li role="presentation" class="active"><a href="#properties">Home</a></li>
                <li role="presentation"><a href="#orange" >Profile</a></li>
                <li role="presentation"><a href="#yellow">Messages</a></li>              
            </ul>
            
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="properties">
                    <?php require_once('admin/admin_tab_properties.php'); ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="orange">
                    <h1>Orange</h1>
                    <p>orange orange orange orange orange</p>
                </div>
                <div role="tabpanel" class="tab-pane" id="yellow">
                    <h1>Yellow</h1>
                    <p>yellow yellow yellow yellow yellow</p>
                </div>
            </div>
        </div>

        <div class=".col-md-4">
          
    
        </div>
    
    
     
</div>
</form>
