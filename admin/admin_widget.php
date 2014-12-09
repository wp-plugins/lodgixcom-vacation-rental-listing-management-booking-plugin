<div class="ldgxAdminRight">
    <div><a href="http://www.lodgix.com"><img src="<?php echo plugins_url('../images/logo_250_63.png', __FILE__); ?>"></a></div>
    <div class="ldgxAdminBox">
        <h2>Like this Plugin?</h2>

        <a href="http://wordpress.org/plugins/lodgixcom-vacation-rental-listing-management-booking-plugin/" target="_blank"><button type="submit" class="ldgxAdminRateButton">Rate this plugin	&#9733;	&#9733;	&#9733;	&#9733;	&#9733;</button></a><br><br>

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like" data-href="<?php echo LODGIX_LIKE_URL; ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
        <br>

        <a href="https://twitter.com/share" class="twitter-share-button" data-text="Just been using #Lodgix #WordPress plugin" data-via="lodgix" data-related="lodgix">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <br>

        <a href="http://bufferapp.com/add" class="buffer-add-button" data-text="Just been using #Lodgix #WordPress plugin" data-url="<?php echo LODGIX_LIKE_URL; ?>" data-count="horizontal" data-via="lodgix">Buffer</a><script type="text/javascript" src="http://static.bufferapp.com/js/button.js"></script>
        <br>


        <div class="g-plusone" data-size="medium" data-href="<?php echo LODGIX_LIKE_URL; ?>"></div>
        <script type="text/javascript">
          (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>
        <br>
        <su:badge layout="2" location="<?php echo LODGIX_LIKE_URL; ?>"></su:badge>
        <script type="text/javascript">
          (function() {
            var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
            li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
          })();
        </script>			
        <script> 
            function set_thesis_2_theme_enabled() {
            var is_checked = jQueryLodgix('#p_lodgix_thesis_2_compatibility').is(':checked');      	  	
            if (is_checked) {
            jQueryLodgix('#p_lodgix_thesis_2_template').removeAttr('disabled');
                }
                else {
                    jQueryLodgix('#p_lodgix_thesis_2_template').attr('disabled','disabled');
                }
            }
            
            function set_lodgix_page_template_enabled() {
            var is_checked = jQueryLodgix('#p_lodgix_page_template').val() == 'CUSTOM';      	  	
            if (is_checked) {
            jQueryLodgix('#p_lodgix_custom_page_template').removeAttr('disabled');
                }
                else {
                    jQueryLodgix('#p_lodgix_custom_page_template').attr('disabled','disabled');
                }
            }                
            
            jQuery('#p_lodgix_thesis_compatibility').click(function(){
                jQueryLodgix('#p_lodgix_thesis_2_compatibility').prop('checked', false);     
                set_thesis_2_theme_enabled(); 	  	
            });
            jQuery('#p_lodgix_thesis_2_compatibility').click(function(){
                jQueryLodgix('#p_lodgix_thesis_compatibility').prop('checked', false);      	  	
                set_thesis_2_theme_enabled();
            });
           
  </script>
    </div>
    <div class="ldgxAdminBox">
        <h2>About Lodgix.com</h2>
        <p>
            <img class="ldgxAdminAvatar" src="http://gravatar.com/avatar/b06319de949d4ce08bbafd6306a9f6f9?s=70">
            <a href="https://twitter.com/lodgix" class="twitter-follow-button" data-show-count="false">Follow @lodgix</a>
        </p>
        <p>
            <a href="http://www.lodgix.com">Lodgix.com</a> is a leading provider of web-based vacation rental management software.
            We do not charge setup fees or require a contract of any kind. We do not collect a percentage of every reservation.
            We simply charge a flat monthly fee and seek to provide value to property owners and managers who seek an easy to
            use application to manage and grow their business.
        </p>
    </div>
</div>
