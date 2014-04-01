<?php

add_action( 'activated_plugin', 'p_lodgix_reorder_plugins' );

function p_lodgix_reorder_plugins() {
    $plugins = get_option( 'active_plugins');
    if ($plugins[count($plugins)-1] != 'lodgixcom-vacation-rental-listing-management-booking-plugin/lodgix.php') {
        $counter = 0;
        foreach($plugins as $plugin) {
            if ($plugin == 'lodgixcom-vacation-rental-listing-management-booking-plugin/lodgix.php') {
                unset($plugins[$counter]);
            }
            $counter = $counter + 1;
        }
        array_push($plugins,'lodgixcom-vacation-rental-listing-management-booking-plugin/lodgix.php');
        $plugins = array_values($plugins);
        
        update_option( 'active_plugins', $plugins );
   
    }        
}

?>